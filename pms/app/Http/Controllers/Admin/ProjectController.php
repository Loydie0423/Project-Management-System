<?php

namespace App\Http\Controllers\Admin;

use App\Helper\ProjectHelper;
use App\Http\Controllers\Controller;
use App\Http\HttpResponse\JsonResponse;
use App\Models\Project;
use App\Models\ProjectCategory;
use App\Models\ProjectCollaborator;
use App\Models\ProjectResources;
use App\Models\ProjectUpdate;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class ProjectController extends Controller
{

    private ProjectHelper $projectHelper;
    private JsonResponse $jsonResponse;

    public function __construct()
    {
        $this->projectHelper = new ProjectHelper();
        $this->jsonResponse = new JsonResponse();

    }

    public function index()
    {
        return view('admin.project.index');
    }

    public function projectDataTable(Request $request)
    {
        if ($request->ajax()) {
            $data = Project::with(['category', 'collaborators', 'updates'])->withCount('collaborators')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('datetime_span', function ($project) {
                    $isExceeded = $this->projectHelper->checkIfEstimatedEndDateIsExceeded($project->end_datetime);
                    if ($isExceeded) {
                        return "<p class='badge badge-danger'>$project->start_datetime to $project->end_datetime</p>";
                    }
                    return "<p class='badge badge-primary'>$project->start_datetime to $project->end_datetime</p>";
                })
                ->addColumn('last_update', function ($project) {
                    if (!($project->updates->count()) > 0) {
                        return "No Update Found";
                    }
                    $lastUpdate = ProjectUpdate::where('project_id', $project->id)->orderBy('id', 'DESC')->first();
                    return (string) $lastUpdate->status . " [" . $lastUpdate->update_code . "]";
                })
                ->addColumn('current_status', function ($project) {
                    $html = "";
                    switch ($project->current_status) {
                        case "On-Going":
                            $html .= "<p class='badge badge-primary'>On-Going<p>";
                            break;
                        case "Completed":
                            $html .= "<p class='badge badge-success'>Completed<p>";
                            break;
                        default:
                            $html .= "<p class='badge badge-dark'>$project->status<p>";
                    }
                    return $html;
                })
                ->addColumn('action', function ($project) {
                    $viewProjectRoute = route('admin.project.show', $project);
                    return "<div class='dropdown dropleft'>
                                <button class='btn btn-sm btn-dark dropdown-toggle' type='button' id='dropdownMenuButton' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                    <i class='fas fa-cog'></i>
                                </button>
                                <div class='dropdown-menu' aria-labelledby='dropdownMenuButton'>
                                    <a class='dropdown-item' href='$viewProjectRoute'>View</a>
                                    <a class='dropdown-item' href='#'>Edit Details</a>
                                    <a class='dropdown-item' href='#'>Manage Collaborators</a>
                                    <a class='dropdown-item' href='#'>Manage Resources</a>
                                    <a class='dropdown-item' href='#'>Publish Announcement</a>
                                    <a class='dropdown-item' href='#'>Update Status</a>
                                </div>
                            </div>";
                })
                ->rawColumns(['datetime_span', 'current_status', 'last_update', 'action'])
                ->make(true);
        }
    }

    public function create()
    {
        $categories = ProjectCategory::pluck('name', 'id')->toArray();
        return view('admin.project.create', compact('categories'));
    }

    public function collaboratorSelectionDataTable(Request $request)
    {
        if ($request->ajax()) {
            $data = User::with(['role'])->withCount('tasks')->where('id', '!=', auth()->user()->id)->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('name', function ($user) {
                    return (string) $user->first_name . " " . $user->last_name;
                })
                ->addColumn('action', function ($user) {
                    return "<button class='btn btn-sm btn-primary font-weight-bold' id='btnSelectCollab'>Select</button>";
                })
                ->rawColumns(['name', 'action'])
                ->make(true);
        }
    }
    public function generateProjectCode(string $categoryId, Request $request)
    {
        try {
            $category = ProjectCategory::findOrFail($categoryId ?? $request->categoryId);
            $categoryName = $category->name;
            $projectCode = $this->projectHelper->generateProjectCode($categoryName);
            return $this->jsonResponse->successJsonResponse(data: ['projectCode' => $projectCode]);
        } catch (\Throwable $th) {
            return $this->jsonResponse->serverErrorJsonResponse(message: $th->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $validator = Validator::make($request->all(), [
                'category_id' => ['required', 'max:255'],
                'projectCode' => ['required', 'max:255', 'unique:projects,code'],
                'title' => ['required', 'max:255'],
                'project_description' => ['required', 'max:255'],
                'start_date_time' => ['required', 'date'],
                'end_date_time' => ['required', 'date'],
                'readme' => ['required', 'max:255']
            ], [
                'category_id.required' => 'The category field is required',
                'category_id.max' => 'The category may not be greater than 255 characters.',
                'projectCode.required' => 'The code field is required',
                'projectCode.max' => 'The code may not be greater than 255 characters.',
                'start_date_time' => 'The start date&time field is required',
                'end_date_time' => 'The end date&time field is required'
            ]);
            $errors = $validator->errors()->toArray();
            $collaborators = $request->collaborators ?? [];
            $resources = $request->resources ?? [];
            if (!count($collaborators) > 0) {
                $errors['collaborators'] = ['Atleast one collaborator is required.'];
            }
            if (!count($resources) > 0) {
                $errors['resources'] = ['Upload atleast one resources.'];
            }
            if ($validator->fails()) {
                return $this->jsonResponse->failedValidationJsonResponse(errors: $errors);
            }

            $project = Project::create([
                'category_id' => $request->category_id,
                'manager_id' => auth()->user()->id,
                'code' => $request->projectCode,
                'title' => $request->title,
                'description' => $request->project_description,
                'start_datetime' => $request->start_date_time,
                'end_datetime' => $request->end_date_time,
                'current_status' => 'On-Going',
                'readme' => $request->readme
            ]);

            foreach ($collaborators as $collaborator) {
                ProjectCollaborator::create([
                    'project_id' => $project->id,
                    'user_id' => $collaborator['id'],
                    'role' => $collaborator['role']['name']
                ]);
            }

            $loggedInUser = User::with('role')->where('id', auth()->user()->id)->first();

            ProjectCollaborator::create([
                'project_id' => $project->id,
                'user_id' => auth()->user()->id,
                'role' => $loggedInUser->role->name
            ]);

            foreach ($resources as $resource) {
                ProjectResources::create([
                    'project_id' => $project->id,
                    'uploader_id' => auth()->user()->id,
                    'title' => $resource['title'],
                    'description' => $resource['description'],
                    'type' => $resource['type'],
                    'image_path' => (string) ($resource['type'] == "Image") ? $resource['content'] : null,
                    'link' => (string) ($resource['type'] == "Link") ? $resource['content'] : null
                ]);
            }
            DB::commit();
            return $this->jsonResponse->successJsonResponse(message: "Project Added Successfully");
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->jsonResponse->serverErrorJsonResponse(message: $th->getMessage());
        }
    }

    public function show(Project $project)
    {
        $project->load(['category', 'tasks', 'collaborators', 'resources', 'announcements', 'updates', 'manager']);
        return view('admin.project.show', compact('project'));
    }

    public function viewProjectTaskDataTable(Request $request, string|int $projectId)
    {
        if ($request->ajax()) {
            $tasks = Task::with(['collaborators'])->withCount('collaborators')->where('project_id', $projectId)->orderBy('id', 'DESC')->get();

            return DataTables::of($tasks)
                ->addIndexColumn()
                ->addColumn('date_span', function ($task) {
                    return (string) $task->start_datetime . " to " . $task->end_datetime;
                })
                ->addColumn('time_spent', function ($task) {
                    return "<p class='badge badge-danger'>pending ticket</p>";
                })
                ->addColumn('action', function () {
                    return "wew";
                })
                ->rawColumns(['date_span', 'action'])
                ->make(true);
        }
    }

    public function viewProjectCollaboratorsDataTable(Request $request, string|int $projectId)
    {
        if ($request->ajax()) {
            $collaborators = ProjectCollaborator::with(['user', 'user.role'])->where('project_id', $projectId)->orderBy('role', 'ASC')->get();

            return DataTables::of($collaborators)
                ->addIndexColumn()
                ->addColumn('user', function ($collaborator) {
                    return $collaborator->user->first_name . " " . $collaborator->user->last_name;
                })
                ->addColumn('email', function ($collaborator) {
                    return $collaborator->user->email;
                })
                ->rawColumns(['user', 'email', 'user_role'])
                ->make(true);
        }
    }

    public function viewProjectResourcesDataTable(Request $request, string|int $projectId)
    {
        if ($request->ajax()) {
            $resources = ProjectResources::where('project_id', $projectId)->orderBy('id', 'DESC')->get();

            return DataTables::of($resources)
                ->addIndexColumn()
                ->addColumn('content', function ($resource) {

                    if (in_array($resource->type, ['link', 'Link'])) {
                        $link = $resource->link;
                        return "<a class='font-weight-normal text-link text-primary text-underline' href='$link' target='_blank'>$link</a>";
                    }

                    //show image if type is image
                })
                ->rawColumns(['content'])
                ->make(true);
        }
    }


}
