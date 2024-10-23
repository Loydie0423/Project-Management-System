$(document).ready(function() {
    $("#category_id").select2();
    $("#resources_type").select2();

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

    var selectedCollaboratorsTable = $("#selectedCollaboratorsTable").DataTable({
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
                data : function() {
                    return "<button class='btn btn-sm btn-danger' id='btnRemoveCollaborator'><i class='fas fa-trash'></i></button>"
                }
            }
        ],
        columnDefs : [
            {
                targets : "_all",
                className : "text-center"
            },
        ]
    });

    var resourcesTable = $("#resourcesTable").DataTable({
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
                data : function(d){
                    return "<button class='btn btn-sm btn-danger' id='btnRemoveResources'><i class='fas fa-trash'></i></button>";
                }
            }
        ],
        columnDefs : [
            {
                targets : [0,1,2,4],
                className : "text-center"
            }
        ]
    });

    $("#resourceType").change(function() {
        let selectedType = $("#resourceType :selected").val();
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

    $("#resourceAddBtn").on('click', function() {
        let requiredFields = ['resourceType', 'resourceTitle'];
        let resourceError = [];
        if($('#resourceType').val() == "Image"){
            requiredFields.push('resourceImage');
        }
        else if($('#resourceType').val() == "Link"){
            requiredFields.push('resourceLink');
        }
        requiredFields.forEach((fieldID) => {
            if($(`#${fieldID}`).val() == null || $(`#${fieldID}`).val() == ""){
                resourceError.push({key : fieldID ,message : `The ${fieldID} field is required`} );
            }
        })
        requiredFields.forEach((item) => {
            $(`#${item}`).closest('.col').find('span').text('');
            if($(`#${item}`).hasClass('is-invalid')){
                $(`#${item}`).removeClass('is-invalid');
            }
        });
        if(resourceError.length > 0) {
            resourceError.forEach((item) => {
                $(`#${item.key}`).closest('.col').find('span').text(item.message);
                $(`#${item.key}`).addClass('is-invalid');
            });
            return;
        }

        let resourceType = $("#resourceType").val();
        let resourceTitle = $("#resourceTitle").val();
        let content = null;
        if(resourceType == "Link"){
            content = $("#resourceLink").val();
        }else if(resourceType == "Image"){
            content = $("#resourceImage").val();
        }

        let resourceDescription = $("#resourceDescription").val() ?? null;
        let data = {type : resourceType, title : resourceTitle, content : content, description : resourceDescription};
        resourcesTable.row.add(data).draw();
        $("#resourceType").val();
        $("#resourceTitle").val("");
        $("#resourceLink").val("");
        $("#resourceImage").val("");
        $("#resourceDescription").val("");
    });

    $("#resourcesTable tbody").on('click','#btnRemoveResources', function() {
        let tableDataIndex = resourcesTable.row($(this).closest('tr')).index();
        resourcesTable.row(tableDataIndex).remove().draw();
    });

    $("#clearResourceFields").on('click', function() {
        $("#resourceType").val();
        $("#resourceTitle").val("");
        $("#resourceLink").val("");
        $("#resourceImage").val("");
        $("#resourceDescription").val("");
    });

    $("#collaboratorsTableSelection tbody").on('click', '#btnSelectCollab', function() {
        let selectedData = collaboratorsTableSelection.row($(this).closest('tr')).data();
        let validator = $.map(selectedCollaboratorsTable.rows().data(), function(item){
            if(item.username == selectedData.username){
                Swal.fire({
                    title : "Warning!",
                    text : `${item.first_name} ${item.last_name} already in the table`,
                    icon : 'warning'
                });
                return 1;
            }
        });

        if(validator == 1){
            return validator;
        }
        selectedCollaboratorsTable.row.add(selectedData).draw();
    });

    $("#selectedCollaboratorsTable tbody").on('click', '#btnRemoveCollaborator', function() {
        let selectedDataIndex = selectedCollaboratorsTable.row($(this).closest('tr')).index();
        selectedCollaboratorsTable.row(selectedDataIndex).remove().draw();
    });

    $("#btnSave").on('click',function() {
        let category_id = $("#category_id").val();
        let projectCode = $("#projectCode").val();
        let title = $("#title").val();
        let start_date_time = $("#start_date_time").val();
        let end_date_time = $("#end_date_time").val();
        let project_description = $("#project_description").val();
        let readme = $("#readme").val();
        let collaborators = [];
        let resources = [];
        $.map(selectedCollaboratorsTable.rows().data(), function(item){
            collaborators.push(item);
        });
        $.map(resourcesTable.rows().data(), function(item){
            resources.push(item);
        });

        let requiredFields = ['category_id', 'projectCode', 'title', 'start_date_time', 'end_date_time', 'project_description','readme'];
        let errors = [];

        requiredFields.forEach((item) => {
            $(`#${item}`).removeClass("is-invalid");
            $(`#${item}`).closest('.col').find('.text-danger').text("");

            if(item.field = "collaborators"){
                $("#selected-collaborator-card").removeClass('border');
                $("#selected-collaborator-card").removeClass('border-danger');
                $("#selectedCollaboratorErrContainer").text("");
            }
        });

        requiredFields.forEach((item) => {
            if(isEmpty(item)){
                newMessage = changeValidationMessage(item);
                errors.push({field : item, message : newMessage});
            }
        });

        if(!collaborators.length > 0){
            errors.push({field : "collaborators", message : "Select atleast one collaborator."})
        }
        if(!resources.length > 0){
            errors.push({field : "resources", message : "Upload atleast one resources."})
        }

        if(errors.length > 0){
            errors.forEach((item) => {
                $(`#${item.field}`).addClass("is-invalid");
                $(`#${item.field}`).closest('.col').find('.text-danger').text(item.message);

                let messageWithIcon = null;

                if(item.field == "collaborators"){
                    $("#selected-collaborator-card").addClass('border');
                    $("#selected-collaborator-card").addClass('border-danger');
                    messageWithIcon = `<i class='fa-solid fa-circle-exclamation mr-1'></i>${item.message}`; 
                    $("#selectedCollaboratorErrContainer").html(messageWithIcon);
                }

                if(item.field == "resources"){
                    $("#resources-card").addClass('border');
                    $("#resources-card").addClass('border-danger');
                    messageWithIcon = `<i class='fa-solid fa-circle-exclamation mr-1'></i>${item.message}`;
                    $("#resourcesErrContainer").html(messageWithIcon);
                }
            });
            return "Validation Error";
        }

        //to be continued submission of data to server
    });


});

function generateProjectCode()
    {
        let categoryId = $("#category_id").val();
        let url = `/admin/project/generate/${categoryId}/projectCode`;
        let token = $("meta[title='token']").attr('content');
        $.ajax({
            url :url,
            method : "POST",
            headers : {
                'X-CSRF-TOKEN' : token
            },
            data : {
                categoryId : categoryId
            },
            success : function (response) {
                let projectCode = $("#projectCode");
                projectCode.val(response.data.projectCode);
            },
            error : function(error){
                let message = error.responseJSON.message;

                Swal.fire({
                    title : "Warning!",
                    text : message,
                    icon : "warning"
                });
            }
        });
}

function isEmpty(field){
    return ($(`#${field}`).val() == null || $(`#${field}`).val() == "") ? true : false;
}

function changeValidationMessage(field){
    let newMessage = null;
    switch(field){
        case "category_id" : newMessage = "The category field is required"; break;
        case "projectCode" : newMessage = "The code field is required"; break;
        case "title" : newMessage = "The title field is required"; break;
        case "start_date_time": newMessage = "The start date&time is required"; break;
        case "end_date_time": newMessage = "The end date&time is required"; break;
        case "project_description": newMessage = "The project description field is required"; break;
        case "readme" : newMessage = "The readme field is required"; break;
    }

    return newMessage;
}
