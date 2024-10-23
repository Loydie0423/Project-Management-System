@extends('admin.layouts.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Add Project</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item breadcrumb-item-dark"><a href="#">Home</a></li>
                            <li class="breadcrumb-item breadcrumb-item-primary"><a style="color: #007BFF">Add Project</a>
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
                <div class="card shadow-lg px-4 py-5">
                    <div class="card px-2 py-2">
                        <div class="card-header">
                            <span>Project Details</span>
                        </div>
                        <div class="card-body">
                            <div class="row my-1">
                                <div class="col col-md-2 col-lg-2 col-sm-6">
                                    <label>Category</label>
                                    <select name="category_id" id="category_id" class="form-control"
                                        onchange="generateProjectCode()">
                                        <option disabled selected>--SELECT CATEGORY--</option>
                                        @forelse ($categories as $categoryId => $categoryName)
                                            <option value="{{ $categoryId }}">{{ $categoryName }}</option>
                                        @empty
                                            <option disabled>No Category Found</option>
                                        @endforelse
                                    </select>
                                    <span class="text-danger"></span>
                                </div>
                                <div class="col col-md-2 col-lg-2 col-sm-6">
                                    <label>Project Code</label>
                                    <input type="text" name="code" id="projectCode" class="form-control" readonly>
                                    <span class="text-danger"></span>
                                </div>
                                <div class="col col-md-4 col-lg-4 col-sm-6">
                                    <label>Title</label>
                                    <input type="text" name="title" id="title" class="form-control">
                                    <span class="text-danger"></span>
                                </div>
                                <div class="col col-md-2 col-lg-2 col-sm-6">
                                    <label>Start Date and Time</label>
                                    <input type="date" name="start_date_time" id="start_date_time" class="form-control">
                                    <span class="text-danger"></span>
                                </div>
                                <div class="col col-md-2 col-lg-2 col-sm-6">
                                    <label>End Date and Time [<span
                                            class="text-info font-weight-bold">Estimated</span>]</label>
                                    <input type="date" name="start_date_time" id="end_date_time" class="form-control">
                                    <span class="text-danger"></span>
                                </div>
                            </div>
                            <div class="row my-2">
                                <div class="col col-12">
                                    <label>Description</label>
                                    <textarea name="description" id="project_description" cols="3" rows="3" class="form-control"></textarea>
                                    <span class="text-danger"></span>
                                </div>
                            </div>
                            <div class="row my-2">
                                <div class="col col-12">
                                    <label>Readme</label>
                                    <textarea name="readme" id="readme" cols="3" rows="3" class="form-control"></textarea>
                                    <span class="text-danger"></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card px-2 py-2">
                        <div class="card-header d-flex align-items-center justify-content-between w-100">
                            <span>Collaborators</span>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 col-lg-6 col-sm-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <span class="text-sm">Collaborator Selection</span>
                                        </div>
                                        <div class="card-body">
                                            <table class="table table-bordered" id="collaboratorsTableSelection">
                                                <thead>
                                                    <tr>
                                                        <th>Action</th>
                                                        <th>Username</th>
                                                        <th>Name</th>
                                                        <th>Role</th>
                                                        <th>Active Task</th>
                                                    </tr>
                                                </thead>
                                                <tbody></tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6 col-sm-12">

                                    <div class="card" id="selected-collaborator-card">
                                        <div class="card-header">
                                            <span class="text-sm">Selected Collaborator</span>
                                        </div>
                                        <div class="card-body">
                                            <table class="table table-bordered" id="selectedCollaboratorsTable">
                                                <thead>
                                                    <tr>
                                                        <th>Username</th>
                                                        <th>Name</th>
                                                        <th>Role</th>
                                                        <th>Active Task</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="selectedCollaboratorsTableBody"></tbody>
                                            </table>
                                            <span class="my-1 text-danger font-weight-normal"
                                                id="selectedCollaboratorErrContainer"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card px-2 py-2">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <span>Resources</span>
                        </div>
                        <div class="card-body">
                            <div class="row my-2">
                                <div class="col col-md-2 col-lg-2 col-sm-6">
                                    <label>Type</label>
                                    <select name="resources_type" id="resourceType" class="form-control">
                                        <option value="Image">Image</option>
                                        <option value="Link">Link</option>
                                    </select>
                                    <span class="text-danger"></span>
                                </div>
                                <div class="col col-md-6 col-lg-6 col-sm-12">
                                    <label>Title</label>
                                    <input type="text" name="title" id="resourceTitle" class="form-control">
                                    <span class="text-danger"></span>
                                </div>
                                <div class="col-md-4 col-lg-4 col-sm-6">
                                    <div class="row" id="addProjectUploadImageContainer">
                                        <div class="col col-12">
                                            <label>Upload Image</label>
                                            <input type="file" name="image" id="resourceImage"
                                                class="form-control">
                                            <span class="text-danger"></span>
                                        </div>
                                    </div>
                                    <div class="row d-none" id="addProjectLinkContainer">
                                        <div class="col col-12">
                                            <label>Link</label>
                                            <input type="text" name="link" id="resourceLink" class="form-control">
                                            <span class="text-danger"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row my-2">
                                <div class="col col-12">
                                    <label>Description</label>
                                    <textarea name="resources_description" id="resourceDescription" cols="3" rows="3" class="form-control"></textarea>
                                    <span class="text-danger"></span>
                                </div>

                                <div class="col-12 mt-2">
                                    <div class="d-flex align-items-center justify-content-end gap-2">
                                        <button class="btn btn-warning mr-2" id="clearResourceFields">
                                            <i class="fas fa-trash mr-1"></i><span>Clear</span>
                                        </button>
                                        <button class="btn btn-primary" id="resourceAddBtn">
                                            <i class="fas fa-plus mr-1"></i><span>Add</span>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="row my-2">
                                <div class="col-12 mt-3">
                                    <div class="card" id="resources-card">
                                        <div class="card-header">
                                            <span class="text-sm">Uploaded Resources</span>
                                        </div>
                                        <div class="card-body">
                                            <table class="table table-bordered" id="resourcesTable">
                                                <thead>
                                                    <tr>
                                                        <th>Type</th>
                                                        <th>Title</th>
                                                        <th>Content</th>
                                                        <th>Description</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody></tbody>
                                            </table>
                                            <span class="my-1 text-danger font-weight-normal"
                                                id="resourcesErrContainer"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="my-2">
                        <div class="d-flex align-items-center justify-content-center gap-2">
                            <button class="btn btn-secondary mr-2" id="cancelBtn">
                                <i class="fas fa-close mr-1"></i><span>Cancel</span>
                            </button>
                            <button class="btn btn-primary" id="btnSave">
                                <i class="fas fa-save mr-1"></i><span>Save</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <script src="{{ asset('js/admin/project.js') }}"></script>
@endsection
