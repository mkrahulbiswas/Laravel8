$(document).ready(function () {

    if (location.hostname === "localhost") {
        var baseUrl = "http://localhost/KidsExam/admin/";
    } else if (location.hostname === "192.168.0.125") {
        var baseUrl = "http://192.168.0.125/KidsExam/admin/";
    } else if (location.hostname === "intelligentappsolutionsdemo.com") {
        var baseUrl = 'http://intelligentappsolutionsdemo.com/current-project/website/KidsExam/admin/';
    }

    // Responsive Datatable
    $('#responsive-datatable').DataTable();


    /*------( Executive Board Listing )--------*/
    var Category = $('#executive-board-listing').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": "executive-board/getDataAjax",
        "columns": [{
                "data": "count",
                "name": "count"
            },
            {
                "data": "post"
            },
            {
                "data": "name"
            },
            {
                "data": "address"
            },
            {
                "data": "city"
            },
            {
                "data": "pin"
            },
            {
                "data": "status",
                "render": function (data, type, row) {
                    if (data == '0') {
                        return '<span class="label label-danger">Blocked</span>';
                    } else if (data == '1') {
                        return '<span class="label label-success">Active</span>';
                    }
                }
            },
            {
                data: 'action',
                name: 'actions',
                orderable: false,
                searchable: false,
            }
        ]
    });


    /*------( Gallery Category Listing )--------*/
    var GalleryCategory = $('#gallery-category-listing').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": "category/getListAjax",
        "columns": [{
                "data": "count",
                "name": "count"
            },
            {
                "data": "name"
            },
            {
                "data": "status",
                "render": function (data, type, row) {
                    if (data == '0') {
                        return '<span class="label label-danger">Blocked</span>';
                    } else if (data == '1') {
                        return '<span class="label label-success">Active</span>';
                    }
                }
            },
            {
                data: 'action',
                name: 'actions',
                orderable: false,
                searchable: false,
            }
        ]
    });

    $('#GalleryCategory').click(function () {
        GalleryCategory.ajax.reload();
    });


    /*------( Gallery Autograph Listing )--------*/
    var GalleryAutograph = $('#gallery-autograph-listing').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": "autograph/getListAjax",
        "columns": [{
                "data": "count",
                "name": "count"
            },
            {
                "data": "image",
                "render": function (data, type, row) {
                    return '<img src="'+data+'" alt="image" width="100"/>';
                }
            },
            {
                "data": "signature",
                "render": function (data, type, row) {
                    return '<img src="'+data+'" alt="image" width="100"/>';
                }
            },
            {
                "data": "name"
            },
            {
                "data": "status",
                "render": function (data, type, row) {
                    if (data == '0') {
                        return '<span class="label label-danger">Blocked</span>';
                    } else if (data == '1') {
                        return '<span class="label label-success">Active</span>';
                    }
                }
            },
            {
                data: 'action',
                name: 'actions',
                orderable: false,
                searchable: false,
            },
            {
                "data": "galleryCategory"
            },
            
            {
                "data": "born"
            },
            {
                "data": "place"
            },
            {
                "data": "achivement",
                "render": function (data, type, row) {
                    return $('<div/>').html(data).text().substr(0, 50) + '...';
                }
            },
            {
                "data": "description",
                "render": function (data, type, row) {
                    return $('<div/>').html(data).text().substr(0, 50) + '...';
                }
            }
        ]
    });

    $('#GalleryAutograph').click(function () {
        GalleryAutograph.ajax.reload();
    });


});
