<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Log as LogModel;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function projectSummaryDataTable(Request $request)
    {
        if ($request->ajax()) {
            $data = [
                [
                    'project' => 'Sample Project 1',
                    'project_code' => 'SP-01',
                    'category' => 'Technology',
                    'collaborators_count' => 10,
                    'current_status' => 'On-going',
                    'last_update' => date('Y-m-d h:i:s')
                ],
                [
                    'project' => 'Sample Project 1',
                    'project_code' => 'SP-01',
                    'category' => 'Technology',
                    'collaborators_count' => 10,
                    'current_status' => 'On-going',
                    'last_update' => date('Y-m-d h:i:s')
                ],
                [
                    'project' => 'Sample Project 1',
                    'project_code' => 'SP-01',
                    'category' => 'Technology',
                    'collaborators_count' => 10,
                    'current_status' => 'On-going',
                    'last_update' => date('Y-m-d h:i:s')
                ],
                [
                    'project' => 'Sample Project 1',
                    'project_code' => 'SP-01',
                    'category' => 'Technology',
                    'collaborators_count' => 10,
                    'current_status' => 'On-going',
                    'last_update' => date('Y-m-d h:i:s')
                ],
                [
                    'project' => 'Sample Project 1',
                    'project_code' => 'SP-01',
                    'category' => 'Technology',
                    'collaborators_count' => 10,
                    'current_status' => 'On-going',
                    'last_update' => date('Y-m-d h:i:s')
                ],
                [
                    'project' => 'Sample Project 1',
                    'project_code' => 'SP-01',
                    'category' => 'Technology',
                    'collaborators_count' => 10,
                    'current_status' => 'On-going',
                    'last_update' => date('Y-m-d h:i:s')
                ],
                [
                    'project' => 'Sample Project 1',
                    'project_code' => 'SP-01',
                    'category' => 'Technology',
                    'collaborators_count' => 10,
                    'current_status' => 'On-going',
                    'last_update' => date('Y-m-d h:i:s')
                ],
                [
                    'project' => 'Sample Project 1',
                    'project_code' => 'SP-01',
                    'category' => 'Technology',
                    'collaborators_count' => 10,
                    'current_status' => 'On-going',
                    'last_update' => date('Y-m-d h:i:s')
                ],
                [
                    'project' => 'Sample Project 1',
                    'project_code' => 'SP-01',
                    'category' => 'Technology',
                    'collaborators_count' => 10,
                    'current_status' => 'On-going',
                    'last_update' => date('Y-m-d h:i:s')
                ],
                [
                    'project' => 'Sample Project 1',
                    'project_code' => 'SP-01',
                    'category' => 'Technology',
                    'collaborators_count' => 10,
                    'current_status' => 'On-going',
                    'last_update' => date('Y-m-d h:i:s')
                ],
                [
                    'project' => 'Sample Project 1',
                    'project_code' => 'SP-01',
                    'category' => 'Technology',
                    'collaborators_count' => 10,
                    'current_status' => 'On-going',
                    'last_update' => date('Y-m-d h:i:s')
                ],
            ];

            return DataTables::of(collect($data))->addIndexColumn()->make(true);
        }
    }

    public function taskSummaryDataTable(Request $request)
    {
        if ($request->ajax()) {
            $data = [
                [
                    'task' => 'Sample Task Title',
                    'spended_time' => '104 hours and 32 mins',
                    'collaborators_count' => 10,
                    'current_status' => 'On-going',
                    'last_update' => date('Y-m-d h:i:s')
                ],
                [
                    'task' => 'Sample Task Title',
                    'spended_time' => '104 hours and 32 mins',
                    'collaborators_count' => 10,
                    'current_status' => 'On-going',
                    'last_update' => date('Y-m-d h:i:s')
                ],
                [
                    'task' => 'Sample Task Title',
                    'spended_time' => '104 hours and 32 mins',
                    'collaborators_count' => 10,
                    'current_status' => 'On-going',
                    'last_update' => date('Y-m-d h:i:s')
                ],
                [
                    'task' => 'Sample Task Title',
                    'spended_time' => '104 hours and 32 mins',
                    'collaborators_count' => 10,
                    'current_status' => 'On-going',
                    'last_update' => date('Y-m-d h:i:s')
                ],
                [
                    'task' => 'Sample Task Title',
                    'spended_time' => '104 hours and 32 mins',
                    'collaborators_count' => 10,
                    'current_status' => 'On-going',
                    'last_update' => date('Y-m-d h:i:s')
                ],
                [
                    'task' => 'Sample Task Title',
                    'spended_time' => '104 hours and 32 mins',
                    'collaborators_count' => 10,
                    'current_status' => 'On-going',
                    'last_update' => date('Y-m-d h:i:s')
                ],
                [
                    'task' => 'Sample Task Title',
                    'spended_time' => '104 hours and 32 mins',
                    'collaborators_count' => 10,
                    'current_status' => 'On-going',
                    'last_update' => date('Y-m-d h:i:s')
                ],
                [
                    'task' => 'Sample Task Title',
                    'spended_time' => '104 hours and 32 mins',
                    'collaborators_count' => 10,
                    'current_status' => 'On-going',
                    'last_update' => date('Y-m-d h:i:s')
                ],
                [
                    'task' => 'Sample Task Title',
                    'spended_time' => '104 hours and 32 mins',
                    'collaborators_count' => 10,
                    'current_status' => 'On-going',
                    'last_update' => date('Y-m-d h:i:s')
                ],
                [
                    'task' => 'Sample Task Title',
                    'spended_time' => '104 hours and 32 mins',
                    'collaborators_count' => 10,
                    'current_status' => 'On-going',
                    'last_update' => date('Y-m-d h:i:s')
                ],
                [
                    'task' => 'Sample Task Title',
                    'spended_time' => '104 hours and 32 mins',
                    'collaborators_count' => 10,
                    'current_status' => 'On-going',
                    'last_update' => date('Y-m-d h:i:s')
                ],
            ];

            return DataTables::of(collect($data))->addIndexColumn()->make(true);
        }
    }

    public function logsDataTable(Request $request)
    {
        if ($request->ajax()) {

            $data = LogModel::with('user')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('user', function ($data) {
                    return $data->user->first_name . " " . $data->user->last_name;
                })
                ->addColumn('user_role', function ($data) {
                    return $data->user->role->name;
                })
                ->rawColumns(['user' . 'user_role'])
                ->make(true);
        }
    }
}
