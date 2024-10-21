<?php

namespace App\Http\Controllers\Admin;

use App\Helper\LogsHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Category\StoreCategoryRequest;
use App\Http\Requests\Admin\Category\UpdateCategoryRequest;
use App\Models\ProjectCategory;
use DB;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{

    private LogsHelper $logsHelper;

    public function __construct()
    {
        $this->logsHelper = new LogsHelper();
    }

    public function index()
    {
        return view('admin.category.index');
    }

    public function categoryDataTable(Request $request)
    {
        if ($request->ajax()) {
            $data = ProjectCategory::withCount('projects')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($category) {
                    $editCategoryRoute = route('admin.category.edit', $category);
                    return "<a class='btn btn-sm btn-primary' href='$editCategoryRoute'><i class='fas fa-edit'></i></a>";
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function store(StoreCategoryRequest $request)
    {
        try {
            DB::beginTransaction();
            $projectCategory = ProjectCategory::create([
                'name' => $request->category_name,
                'description' => $request->description
            ]);
            $logs = [
                'user_id' => auth()->user()->id,
                'module_name' => 'Admin Category',
                'description' => 'Added new Category [Name: ' . $projectCategory->name . ']',
                'ip_address' => $request->ip(),
                'date_time' => now()
            ];
            $this->logsHelper->insertToLogs($logs['user_id'], $logs['module_name'], $logs['description'], request()->ip(), $logs['date_time']);
            DB::commit();
            return redirect()->route('admin.category.index')->with('success', 'Project Category Added Successfully');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('admin.category.index')->with('error', $th->getMessage());
        }
    }

    public function edit(ProjectCategory $category)
    {
        return view('admin.category.edit', compact('category'));
    }

    public function update(ProjectCategory $category, UpdateCategoryRequest $request)
    {
        try {
            DB::beginTransaction();

            $category->update([
                'name' => $request->category_name,
                'description' => $request->description
            ]);

            $logs = [
                'user_id' => auth()->user()->id,
                'module_name' => 'Admin Category',
                'description' => 'Updated Category',
                'ip_address' => $request->ip(),
                'date_time' => now()
            ];
            $this->logsHelper->insertToLogs($logs['user_id'], $logs['module_name'], $logs['description'], request()->ip(), $logs['date_time']);

            DB::commit();
            return redirect()->route('admin.category.index')->with('success', 'Project Category Updated Successfully');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('admin.category.index')->with('error', $th->getMessage());
        }
    }
}
