@extends('admin.layouts.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Dashboard</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item breadcrumb-item-dark"><a href="#">Home</a></li>
                            <li class="breadcrumb-item breadcrumb-item-primary"><a style="color: #007BFF">Dashboard</a></li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <div class="small-card-container bg-secondary">
                            <div class="sm-card-left-side">
                                <div class="sm-card-left-side-container">
                                    <p class="sm-card-count">0</p>
                                    <p class="sm-card-title">Categories</p>
                                </div>
                            </div>
                            <div class="sm-card-right-side">
                                <i class="fas fa-list"></i>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">
                        <div class="small-card-container bg-info">
                            <div class="sm-card-left-side">
                                <div class="sm-card-left-side-container">
                                    <p class="sm-card-count">0</p>
                                    <p class="sm-card-title">On-Going Projects</p>
                                </div>
                            </div>
                            <div class="sm-card-right-side">
                                <i class="fas fa-clipboard-list"></i>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">
                        <div class="small-card-container bg-success">
                            <div class="sm-card-left-side">
                                <div class="sm-card-left-side-container">
                                    <p class="sm-card-count">0</p>
                                    <p class="sm-card-title">Completed Projects</p>
                                </div>
                            </div>
                            <div class="sm-card-right-side">
                                <i class="fas fa-clipboard-check"></i>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">
                        <div class="card">
                            <div class="card-header">
                                <span class="dashboard-sm-card-title">Count</span>
                            </div>
                            <div class="card-body card-counter-body">
                                <div class="d-flex align-items-center justify-content-space-between flex-wrap">

                                    <span class="badge badge-dark px-2 py-2 mr-1">Categories<span
                                            class="font-weight-bold pill-count ml-2">0</span>
                                    </span>

                                    <span class="badge badge-dark px-2 py-2 mr-1">Projects<span
                                            class="font-weight-bold pill-count ml-2">0</span>
                                    </span>

                                    <span class="badge badge-dark px-2 py-2 mr-1">Task<span
                                            class="font-weight-bold pill-count ml-2">0</span>
                                    </span>

                                    <span class="badge badge-dark px-2 py-2 mr-1">Users<span
                                            class="font-weight-bold pill-count ml-2">0</span>
                                    </span>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6 mt-2">
                        <div class="small-card-container bg-warning">
                            <div class="sm-card-left-side">
                                <div class="sm-card-left-side-container">
                                    <p class="sm-card-count text-light">0</p>
                                    <p class="sm-card-title text-light">On-Going Task</p>
                                </div>
                            </div>
                            <div class="sm-card-right-side">
                                <i class="fas fa-list-check text-light"></i>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6 mt-2">
                        <div class="small-card-container bg-primary">
                            <div class="sm-card-left-side">
                                <div class="sm-card-left-side-container">
                                    <p class="sm-card-count">0</p>
                                    <p class="sm-card-title">Completed Task</p>
                                </div>
                            </div>
                            <div class="sm-card-right-side">
                                <i class="fas fa-clipboard-check"></i>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6 mt-2">
                        <div class="small-card-container bg-dark">
                            <div class="sm-card-left-side">
                                <div class="sm-card-left-side-container">
                                    <p class="sm-card-count">0</p>
                                    <p class="sm-card-title">Users</p>
                                </div>
                            </div>
                            <div class="sm-card-right-side">
                                <i class="fas fa-users"></i>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.row -->
                <!-- Main row -->
                <div class="row my-4">

                    <div class="col-lg-12 col-md-6 col-sm-6">
                        <div class="row">
                            <div class="col-6">
                                <div class="card">
                                    <div class="card-header">
                                        <span>Project Summary</span>
                                    </div>
                                    <div class="card-body">

                                        <table class="table table-bordered" id="projectSummary">
                                            <thead>
                                                <tr>
                                                    <th>Project</th>
                                                    <th>Project Code</th>
                                                    <th>Category</th>
                                                    <th>No. of Collaborators</th>
                                                    <th>Current Status</th>
                                                    <th>Last Update</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>


                                    </div>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="card">
                                    <div class="card-header">
                                        <span>Task Summary</span>
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-bordered" id="taskSummary">
                                            <thead>
                                                <tr>
                                                    <th>Task</th>
                                                    <th>Spended Time</th>
                                                    <th>No. of Collaborators</th>
                                                    <th>Current Status</th>
                                                    <th>Last Update</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row my-2">

                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <span>Logs</span>
                                    </div>
                                    <div class="card-body">

                                        <table class="table table-bordered" id="logs">
                                            <thead>
                                                <tr>
                                                    <th>User</th>
                                                    <th>Role</th>
                                                    <th>Module</th>
                                                    <th>Description</th>
                                                    <th>IP Address</th>
                                                    <th>Date Time</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <script src="{{ asset('js/admin/dashboard.js') }}"></script>
@endsection
