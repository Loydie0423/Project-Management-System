$(document).ready(function() {
    let categoryDataTable = $("#categoryDataTable").DataTable({
        processing : true,
        serverSide: true,
        paging : true,
        ajax : '/admin/datatable/category',
        columns : [
            {
                name : 'id',
                data : 'id'
            },
            {
                name : 'name',
                data : 'name'
            },
            {
                name : 'description',
                data : 'description'
            },
            {
                name : 'projects_count',
                data : 'projects_count'
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
                "targets" : [0,1,3,4,5],
                'className' : 'text-center'
            }
        ]
    });
});