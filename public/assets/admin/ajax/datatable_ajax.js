$(document).ready(function () {

    if (location.hostname === "localhost") {
        var baseUrl = "http://localhost/Saheti/admin/";
    } else if (location.hostname === "192.168.0.125") {
        var baseUrl = "http://192.168.0.125/Saheti/admin/";
    } else if (location.hostname === "intelligentappsolutionsdemo.com") {
        var baseUrl = 'http://intelligentappsolutionsdemo.com/current-project/website/Saheti/admin/';
    }

    // Responsive Datatable
    $('#responsive-datatable').DataTable();



    /*--========================= ( USER START ) =========================--*/
    /*------( Users Admin Listing )--------*/
    $('#admin-listing').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": "sub-admins/ajaxGetSubAdmins",

        "columns": [{
                "data": "count",
                "name": "count"
            },
            {
                "data": "name",
                "name": "name"
            },
            {
                "data": "email"
            },
            {
                "data": "phone"
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
                "data": "profilePic",
                "name": "profilePic",
                "render": function (data, type, row) {
                    return '<img src="' + data + '" class="img-fluid rounded" width="100"/>';
                }
            },
            {
                data: 'action',
                name: 'actions',
                orderable: false,
                searchable: false
            }
        ]
    });



    /*------( Customer Listing )--------*/
    $('#user-customer-listing').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": "users/ajaxGetList",
        "language": {
            "searchPlaceholder": "Name, Email, Phone"
        },
        "columns": [{
                "data": "DT_RowIndex",
                orderable: false,
                searchable: false
            },
            {
                "data": "image",
            },
            {
                "data": "name",
            },
            {
                "data": "email",
            },
            {
                "data": "phone",
                name: "phone",
            },
            {
                "data": "country",
                name: 'countryId',
            },
            {
                "data": "status",
            },
            {
                data: 'action',
                name: 'actions',
                orderable: false,
                searchable: false,
            }
        ]
    });
    /*--========================= ( USER END ) =========================--*/



    /*--========================= ( ROLE PERMISSION START ) =========================--*/
    /*------( Role Listing )--------*/
    $('#rolePermision-role-listing').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": "roles/ajaxGetList",
        "language": {
            "searchPlaceholder": "None"
        },
        "columns": [{
                "data": "DT_RowIndex",
                orderable: false,
                searchable: false
            },
            {
                "data": "role"
            },
            {
                "data": "description"
            },
            {
                "data": "status",
            },
            {
                data: 'action',
                name: 'actions',
                orderable: false,
                searchable: false
            }
        ]
    });



    /*------( Customer Listing )--------*/
    $('#user-customer-listing').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": "users/ajaxGetList",
        "language": {
            "searchPlaceholder": "Name, Email, Phone"
        },
        "columns": [{
                "data": "DT_RowIndex",
                orderable: false,
                searchable: false
            },
            {
                "data": "image",
            },
            {
                "data": "name",
            },
            {
                "data": "email",
            },
            {
                "data": "phone",
                name: "phone",
            },
            {
                "data": "country",
                name: 'countryId',
            },
            {
                "data": "status",
            },
            {
                data: 'action',
                name: 'actions',
                orderable: false,
                searchable: false,
            }
        ]
    });
    /*--========================= ( ROLE PERMISSION END ) =========================--*/




    /*--========================= ( CMS START ) =========================--*/
    /*------( Banner Listing )------*/
    $('#cms-banner-listing').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": "banner/ajaxGetList",
        "language": {
            "searchPlaceholder": "None"
        },
        "columns": [{
                "data": "DT_RowIndex",
                orderable: false,
                searchable: false
            },
            {
                "data": "image",
            },
            {
                "data": "status",
            },
            {
                data: 'action',
                name: 'actions',
                orderable: false,
                searchable: false,
            }
        ]
    });


    /*------( Logo Listing )------*/
    $('#cms-logo-listing').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": "logo/ajaxGetList",
        "language": {
            "searchPlaceholder": "None"
        },
        "columns": [{
                "data": "DT_RowIndex",
                orderable: false,
                searchable: false
            },
            {
                "data": "bigLogo",
            },
            {
                "data": "smallLogo",
            },
            {
                "data": "favIcon",
            },
            {
                "data": "status",
            },
            {
                data: 'action',
                name: 'actions',
                orderable: false,
                searchable: false,
            }
        ]
    });
    /*--========================= ( CMS END ) =========================--*/





    /*--======================== ( Customize Admin Apperance START ) ========================--*/
    /*------( Button Listing )------*/
    $('#customizeAdmin-button-listing').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": "appearance/button/ajaxGetList",
        "language": {
            "searchPlaceholder": "Button For"
        },
        "columns": [{
                "data": "DT_RowIndex",
                orderable: false,
                searchable: false
            },
            {
                "data": "backColor",
            },
            {
                "data": "backHoverColor",
            },
            {
                "data": "btnIcon",
            },
            {
                "data": "btnFor",
            },
            {
                "data": "status",
            },
            {
                data: 'action',
                name: 'actions',
                orderable: false,
                searchable: false,
            }
        ]
    });

    /*------( Table Listing )------*/
    $('#customizeAdmin-table-listing').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": "appearance/table/ajaxGetList",
        "language": {
            "searchPlaceholder": "Button For"
        },
        "columns": [{
                "data": "DT_RowIndex",
                orderable: false,
                searchable: false
            },
            {
                "data": "checkBox",
            },
            {
                "data": "tableHead",
            },
            {
                "data": "tableBody",
            },
            {
                "data": "status",
            },
            {
                data: 'action',
                name: 'actions',
                orderable: false,
                searchable: false,
            }
        ]
    });
    /*--========================= ( Customize Admin Apperance END ) =========================--*/





    /*--======================== ( Customize Admin Loader START ) ========================--*/
    /*------( Internal Loader Listing )------*/
    $('#customizeAdmin-internalLoader-listing').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": "loader/internal/ajaxGetList",
        "language": {
            "searchPlaceholder": ""
        },
        "columns": [{
                "data": "DT_RowIndex",
                orderable: false,
                searchable: false
            },
            {
                "data": "html",
            },
            {
                "data": "css",
            },
            {
                "data": "js",
            },
            {
                "data": "status",
            },
            {
                data: 'action',
                name: 'actions',
                orderable: false,
                searchable: false,
            }
        ]
    });

    /*------( Page Loader Listing )------*/
    $('#customizeAdmin-pageLoader-listing').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": "loader/page/ajaxGetList",
        "language": {
            "searchPlaceholder": ""
        },
        "columns": [{
                "data": "DT_RowIndex",
                orderable: false,
                searchable: false
            },
            {
                "data": "html",
            },
            {
                "data": "css",
            },
            {
                "data": "js",
            },
            {
                "data": "status",
            },
            {
                data: 'action',
                name: 'actions',
                orderable: false,
                searchable: false,
            }
        ]
    });
    /*--========================= ( Customize Admin Loader END ) =========================--*/

});
