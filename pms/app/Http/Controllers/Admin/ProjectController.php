<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectCategory;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ProjectController extends Controller
{
    public function index()
    {
        return view('admin.project.index');
    }

    public function projectDataTable(Request $request)
    {
        if ($request->ajax()) {
            $data = Project::with(['category', 'collaborators'])->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('datetime_span', function ($project) {
                    return (string) $project->start_datetime . " to " . $project->end_datetime;
                })
                ->addColumn('action', function () {
                    return "wew";
                })
                ->rawColumns(['datetime_span'])
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
            $data = User::with(['role'])->withCount('tasks')->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('name', function ($user) {
                    return (string) $user->first_name . " " . $user->last_name;
                })
                ->addColumn('action', function ($user) {
                    return "<button class='btn btn-sm btn-primary font-weight-bold'>Select</button>";
                })
                ->rawColumns(['name', 'action'])
                ->make(true);
        }
    }
}
