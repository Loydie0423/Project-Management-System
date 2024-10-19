<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

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
            $data = [
                [
                    'user' => 'John Doe',
                    'role' => 'Admin',
                    'module' => 'Category',
                    'description' => 'Add new category [Category Name: Technologies]',
                    'ip_address' => '192.168.1.1',
                    'date_time' => date('Y-m-d h:i:s')
                ],
                [
                    'user' => 'John Doe',
                    'role' => 'Admin',
                    'module' => 'Category',
                    'description' => 'Add new category [Category Name: Technologies]',
                    'ip_address' => '192.168.1.1',
                    'date_time' => date('Y-m-d h:i:s')
                ],
                [
                    'user' => 'John Doe',
                    'role' => 'Admin',
                    'module' => 'Category',
                    'description' => 'Add new category [Category Name: Technologies]',
                    'ip_address' => '192.168.1.1',
                    'date_time' => date('Y-m-d h:i:s')
                ],
                [
                    'user' => 'John Doe',
                    'role' => 'Admin',
                    'module' => 'Category',
                    'description' => 'Add new category [Category Name: Technologies]',
                    'ip_address' => '192.168.1.1',
                    'date_time' => date('Y-m-d h:i:s')
                ],
                [
                    'user' => 'John Doe',
                    'role' => 'Admin',
                    'module' => 'Category',
                    'description' => 'Add new category [Category Name: Technologies]',
                    'ip_address' => '192.168.1.1',
                    'date_time' => date('Y-m-d h:i:s')
                ],
                [
                    'user' => 'John Doe',
                    'role' => 'Admin',
                    'module' => 'Category',
                    'description' => 'Add new category [Category Name: Technologies]',
                    'ip_address' => '192.168.1.1',
                    'date_time' => date('Y-m-d h:i:s')
                ],
                [
                    'user' => 'John Doe',
                    'role' => 'Admin',
                    'module' => 'Category',
                    'description' => 'Add new category [Category Name: Technologies]',
                    'ip_address' => '192.168.1.1',
                    'date_time' => date('Y-m-d h:i:s')
                ],
                [
                    'user' => 'John Doe',
                    'role' => 'Admin',
                    'module' => 'Category',
                    'description' => 'Add new category [Category Name: Technologies]',
                    'ip_address' => '192.168.1.1',
                    'date_time' => date('Y-m-d h:i:s')
                ],
                [
                    'user' => 'John Doe',
                    'role' => 'Admin',
                    'module' => 'Category',
                    'description' => 'Add new category [Category Name: Technologies]',
                    'ip_address' => '192.168.1.1',
                    'date_time' => date('Y-m-d h:i:s')
                ],
                [
                    'user' => 'John Doe',
                    'role' => 'Admin',
                    'module' => 'Category',
                    'description' => 'Add new category [Category Name: Technologies]',
                    'ip_address' => '192.168.1.1',
                    'date_time' => date('Y-m-d h:i:s')
                ],
                [
                    'user' => 'John Doe',
                    'role' => 'Admin',
                    'module' => 'Category',
                    'description' => 'Add new category [Category Name: Technologies]',
                    'ip_address' => '192.168.1.1',
                    'date_time' => date('Y-m-d h:i:s')
                ],
            ];

            return DataTables::of(collect($data))->addIndexColumn()->make(true);
        }
    }
}
