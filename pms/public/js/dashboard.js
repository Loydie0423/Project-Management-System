$(document).ready(function() {
    let projectSummaryTable = $('#projectSummary').DataTable({
        processing: true,
        serverSide: true,
        paging: true,
        ajax: "/datatable/project-summary",
        columns: [{
                data: 'project',
                name: 'project',
                orderable: false,
            },
            {
                data: 'project_code',
                name: 'project_code',
                orderable: false,
            },
            {
                data: 'category',
                name: 'category',
                orderable: false,
            },
            {
                data: 'collaborators_count',
                name: 'collaborators_count',
                orderable: false,
            },
            {
                data: 'current_status',
                name: 'current_status',
                orderable: false,
            },
            {
                data: 'last_update',
                name: 'last_update',
                orderable: false,
            },
        ],

    });

    let taskSummary = $('#taskSummary').DataTable({
        processing: true,
        serverSide: true,
        paging: true,
        ajax: "/datatable/task-summary",
        columns: [{
                data: 'task',
                name: 'task',
                orderable: false,
            },
            {
                data: 'spended_time',
                name: 'spended_time',
                orderable: false,
            },
            {
                data: 'collaborators_count',
                name: 'collaborators_count',
                orderable: false,
            },
            {
                data: 'current_status',
                name: 'current_status',
                orderable: false,
            },
            {
                data: 'last_update',
                name: 'last_update',
                orderable: false,
            },
        ],

    });

    let logs = $('#logs').DataTable({
        processing: true,
        serverSide: true,
        paging: true,
        ajax: "/datatable/logs",
        columns: [{
                data: 'user',
                name: 'user',
                orderable: false,
            },
            {
                data: 'role',
                name: 'role',
                orderable: false,
            },
            {
                data: 'module',
                name: 'module',
                orderable: false,
            },
            {
                data: 'description',
                name: 'description',
                orderable: false,
            },
            {
                data: 'ip_address',
                name: 'ip_address',
                orderable: false,
            },
            {
                data: 'date_time',
                name: 'date_time',
                orderable: false,
            },
        ],

    });
});