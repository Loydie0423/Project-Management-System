@extends('admin.layouts.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">View Project</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item breadcrumb-item-dark"><a href="#">Home</a></li>
                            <li class="breadcrumb-item breadcrumb-item-primary">
                                <a style="color: #007BFF">View Project</a>
                            </li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-8 col-md-12 col-sm-12">
                        <div class="card shadow-lg px-4 py-4">
                            <div class="row d-flex align-items-center justify-content-center gap-2">
                                <div class="col-12 d-flex align-items-center justify-content-start gap-2">
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <div class="row d-flex flex-column align-items-start justify-content-center">
                                            <div class="col-12">
                                                <h4>
                                                    <span class="project-title">{{ $project->title }}</span>
                                                    <sup class="project-code">[{{ $project->code }}]</sup>
                                                </h4>
                                            </div>

                                            <div class="col-12">
                                                <div class="row d-flex align-items-center justify-content-start gap-2">
                                                    <div class="col-2 project-relationship-counter">
                                                        <i class="fas fa-list-check mr-1"></i>
                                                        <span class="font-weight-bold">{{ $project->tasks->count() }}</span>
                                                    </div>
                                                    <div class="col-2 project-relationship-counter">
                                                        <i class="fas fa-users mr-1"></i>
                                                        <span
                                                            class="font-weight-bold">{{ $project->collaborators->count() }}</span>
                                                    </div>
                                                    <div class="col-2 project-relationship-counter">
                                                        <i class="fas fa-file mr-1"></i>
                                                        <span
                                                            class="font-weight-bold">{{ $project->resources->count() }}</span>
                                                    </div>
                                                    <div class="col-2 project-relationship-counter">
                                                        <i class="fas fa-bullhorn mr-1"></i>
                                                        <span
                                                            class="font-weight-bold">{{ $project->announcements->count() }}</span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="col-12 project-detail-container">
                                                        <i class="fas fa-list mr-1"></i>
                                                        <span class="font-weight-bold">{{ $project->category->name }}</span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="col-12 project-detail-container">
                                                        <i class="fas fa-calendar mr-1"></i>
                                                        <span class="font-weight-bold">{{ $project->created_at }}</span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="col-12 project-detail-container">
                                                        <i class="fas fa-calendar mr-1"></i>
                                                        <span class="font-weight-bold">{{ $project->start_datetime }} to
                                                            {{ $project->end_datetime }}</span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="col-12 project-detail-container">
                                                        <i class="fas fa-user mr-1"></i>
                                                        <span
                                                            class="font-weight-bold">{{ $project->manager->first_name . ' ' . $project->manager->last_name }}</span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="col-12 project-detail-container">
                                                        <i class="fas fa-circle-dot mr-1"></i>

                                                        @switch($project->current_status)
                                                            @case('On-Going')
                                                                <span class="badge badge-primary font-weight-bold">On-Going</span>
                                                            @break

                                                            @case('Completed')
                                                                <span class="badge badge-success font-weight-bold">Completed</span>
                                                            @break

                                                            @default
                                                                <span
                                                                    class="badge badge-dark font-weight-bold">{{ $project->current_status }}</span>
                                                        @endswitch


                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div
                                        class="col-lg-4 col-md-6 col-sm-12 d-flex flex-column align-items-start justify-content-start gap-2 project-details-h-100">
                                        <label class="text-sm">Project Description</label>
                                        <span
                                            class="text-justify font-weight-normal project-description">{{ $project->description }}</span>
                                    </div>
                                    <div
                                        class="col-lg-4 col-md-6 col-sm-12 d-flex flex-column align-items-start justify-content-start gap-2 project-details-h-100">
                                        <label class="text-sm">Readme</label>
                                        <span
                                            class="text-justify font-weight-normal project-readme">{{ $project->readme }}</span>
                                    </div>
                                </div>
                                <div class="col-12 my-3">
                                    <div class="card shadow-lg">
                                        <div class="card-header">
                                            <span class="text-sm">Task</span>
                                        </div>
                                        <div class="card-body">
                                            <table class="table table-bordered" id="viewProjectTaskTable">
                                                <thead>
                                                    <tr>
                                                        <th>Title</th>
                                                        <th>Date Span</th>
                                                        <th>No. of Collaborators</th>
                                                        <th>Time Spent</th>
                                                        <th>Curent Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody></tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 my-1">
                                    <div class="card shadow-lg">
                                        <div class="card-header">
                                            <span class="text-sm">Project Collaborators</span>
                                        </div>
                                        <div class="card-body">
                                            <table class="table table-bordered" id="viewProjectCollaborators">
                                                <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Email</th>
                                                        <th>User Role</th>
                                                    </tr>
                                                </thead>
                                                <tbody></tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 my-1">
                                    <div class="col-12 my-1">
                                        <div class="card shadow-lg">
                                            <div class="card-header">
                                                <span class="text-sm">Project Resources</span>
                                            </div>
                                            <div class="card-body">
                                                <table class="table table-bordered" id="viewProjectResources">
                                                    <thead>
                                                        <tr>
                                                            <th>Type</th>
                                                            <th>Title</th>
                                                            <th>Description</th>
                                                            <th>Content</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody></tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 col-sm-12">
                        <div class="row d-flex flex-column align-items-center justify-content center gap-2">
                            <div class="col-12">
                                <div class="card shadow-lg">
                                    <div class="card-header">
                                        <span class="font-weight-bold">Announcement</span>
                                    </div>
                                    <div class="card-body">
                                        <div
                                            class="row d-flex flex-column-align-items-start justify-contetent-center gap-2">

                                            @forelse ($project->announcements as $announcement)
                                                <div
                                                    class="col-12 border-bottom border-bottom-secondary announcement-container">
                                                    <h5 class="announcement-title font-weight-bold">
                                                        {{ $announcement->title }}</h5>
                                                    <small
                                                        class="text-sm announcement-date">{{ $announcment->created_at }}</small>
                                                    <p class="text-justify announcement-description mt-1">
                                                        {{ $announcement->description }}</p>
                                                </div>
                                            @empty
                                                <label class="font-weight-bold text-center w-100">No Announcement
                                                    Found</label>
                                            @endforelse




                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="card shadow-lg">
                                    <div class="card-header">
                                        <span class="font-weight-bold">Project History</span>
                                    </div>
                                    <div class="card-body">
                                        <div
                                            class="row d-flex flex-column-align-items-start justify-contetent-center gap-2">


                                            @forelse ($project->updates as $history)
                                                <div
                                                    class="col-12 border-bottom border-bottom-secondary history-container mt-2">
                                                    <h5 class="history-title font-weight-bold">
                                                        {{ $history->project->title }}<sup
                                                            class="font-weight-normal text-info">
                                                            [{{ $history->update_code }}]</sup></h5>
                                                    <small
                                                        class="text-sm history-date d-block">{{ $history->created_at }}</small>
                                                    <p class="badge badge-primary mt-1">
                                                        @switch($history->status)
                                                            @case('On-Going')
                                                                <span class="badge badge-primary font-weight-bold">On-Going</span>
                                                            @break

                                                            @case('Completed')
                                                                <span class="badge badge-success font-weight-bold">Completed</span>
                                                            @break

                                                            @default
                                                                <span
                                                                    class="badge badge-dark font-weight-bold">{{ $history->status }}</span>
                                                        @endswitch
                                                    </p>
                                                    <p class="text-justify history-description mt-1">
                                                        {{ $history->description }}</p>
                                                </div>
                                                @empty
                                                    <label class="font-weight-bold text-center w-100">No History
                                                        Found</label>
                                                @endforelse



                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <script src="{{ asset('js/admin/project.js') }}"></script>
        <script>
            $(document).ready(function() {
                let projectId = "{{ $project->id }}";
                let viewProjectTaskTableUrl = `/admin/datatable/project/${projectId}/view/task`;
                let viewProjectTaskTable = $("#viewProjectTaskTable").DataTable({
                    serverSide: true,
                    paging: true,
                    processing: true,
                    ajax: viewProjectTaskTableUrl,
                    columns: [{
                            name: 'title',
                            data: 'title'
                        },
                        {
                            name: 'date_span',
                            data: 'date_span'
                        },
                        {
                            name: 'collaborators_count',
                            data: 'collaborators_count'
                        },
                        {
                            name: 'time_spent',
                            data: 'time_spent'
                        },
                        {
                            name: 'current_status',
                            data: 'current_status'
                        },
                        {
                            name: 'action',
                            data: 'action'
                        },
                    ],
                    columnDefs: [{
                        targets: '_all',
                        className: 'text-center'
                    }]
                });

                let viewProjectCollaboratorsTableUrl = `/admin/datatable/project/${projectId}/view/collaborators`;
                let viewProjectCollaborators = $("#viewProjectCollaborators").DataTable({
                    serverSide: true,
                    paging: true,
                    processing: true,
                    ajax: viewProjectCollaboratorsTableUrl,
                    columns: [{
                            name: 'user',
                            data: 'user'
                        },
                        {
                            name: 'email',
                            data: 'email'
                        },
                        {
                            name: 'role',
                            data: 'role'
                        },
                    ],
                    columnDefs: [{
                        targets: '_all',
                        className: 'text-center'
                    }]
                });

                let viewProjectResourcesTableUrl = `/admin/datatable/project/${projectId}/view/resources`;
                let viewProjectResources = $("#viewProjectResources").DataTable({
                    serverSide: true,
                    paging: true,
                    processing: true,
                    ajax: viewProjectResourcesTableUrl,
                    columns: [{
                            name: 'type',
                            data: 'type'
                        },
                        {
                            name: 'title',
                            data: 'title'
                        }, {
                            name: 'description',
                            data: 'description'
                        },
                        {
                            name: 'content',
                            data: 'content'
                        },
                    ],
                    columnDefs: [{
                        targets: [0, 1, 3],
                        className: 'text-center'
                    }]
                });
            });
        </script>
    @endsection
