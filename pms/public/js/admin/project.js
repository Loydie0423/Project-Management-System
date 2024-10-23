$(document).ready(function() {
    $("#category_id").select2();
    $("#resources_type").select2();

    $("#resources_type").change(function() {
        let selectedType = $("#resources_type :selected").val();
        let addProjectUploadImageContainer = $("#addProjectUploadImageContainer");
        let addProjectLinkContainer = $("#addProjectLinkContainer");

        if (selectedType == "Link") {
            addProjectLinkContainer.removeClass("d-none").addClass("d-block");
            addProjectUploadImageContainer.removeClass("d-block").addClass("d-none");
        } else if (selectedType == "Image") {
            addProjectUploadImageContainer.removeClass("d-none").addClass("d-block");
            addProjectLinkContainer.removeClass("d-block").addClass("d-none");
        }
    });

    $("#cancelBtn").on('click', function() {

        Swal.fire({
            title : "Warning",
            text : "Are you sure you want to cancel? All data will be erase?",
            icon : "warning",
            showCancelButton : true,
            confirmButtonText : "Yes, Cancel it"
        }).then((result) => {
            if(result.isConfirmed){
                window.location = "/admin/project";
            }
        });

    });

    let projectDataTable = $("#projectDataTable").DataTable({
        processing : true,
        serverSide: true,
        paging : true,
        ajax : '/admin/datatable/project',
        columns : [
            {
                name : 'id',
                data : 'id'
            },
            {
                name : 'category.name',
                data : 'category.name'
            },
            {
                name : 'code',
                data : 'code'
            },
            {
                name : 'title',
                data : 'title'
            },
            {
                name : 'datetime_span',
                data : 'datetime_span'
            },
            {
                name : 'collaborators_count',
                data : 'collaborators_count'
            },
            {
                name : 'current_status',
                data : 'current_status'
            },
            {
                name : 'last_update',
                data : 'last_update'
            },
            {
                name : 'created_at',
                data : 'created_at'
            },
            {
                name : 'action',
                data : 'action'
            }
        ],
        columnDefs : [
            {
                targets : "_all",
                className : "text-center"
            }
        ]
    });

    let collaboratorsTableSelection = $("#collaboratorsTableSelection").DataTable({
        processing : true,
        serverSide : true,
        paging : true,
        ajax : "/admin/datatable/collaborator/selection",
        columns : [
            {
                name : "action",
                data : "action"
            },
            {
                name : "username",
                data : "username"
            },
            {
                name : "name",
                data : "name"
            },
            {
                name : "role.name",
                data : "role.name"
            },
            {
                name : "tasks_count",
                data : "tasks_count"
            },
        ],
        columnDefs : [
            {
                targets : "_all",
                className : "text-center"
            },
        ]
    });

    let selectedCollaboratorsTable = $("#selectedCollaboratorsTable").DataTable({
        searching : false,
        columns : [
            {
                name : "username",
                data : "username"
            },
            {
                name : "name",
                data : "name"
            },
            {
                name : "role.name",
                data : "role.name"
            },
            {
                name : "tasks_count",
                data : "tasks_count"
            },
            {
                name : "action",
                data : "action"
            }
        ],
        columnDefs : [
            {
                targets : "_all",
                className : "text-center"
            },
        ]
    });

    let resourcesTable = $("#resourcesTable").DataTable({
        searching : false,
        columns : [
            {
                name : "type",
                data : "type"
            },
            {
                name : "title",
                data : "title"
            },
            {
                name : "content",
                data : "content"
            },
            {
                name : "description",
                data : "description"
            },
            {
                name : "action",
                data : "action"
            }
        ],
        columnDefs : [
            {
                targets : [0,1,2,4],
                className : "text-center"
            }
        ]
    });

   
});