$(document).ready(function () {

    var pathArray = window.location.pathname.split('/');
    if (jQuery.inArray("table", pathArray) >= 1 && jQuery.inArray("appearance", pathArray) >= 1) {
        $('.advance-select-table-fontType').select2({
            tags: false,
            placeholder: "Select Font Type"
        });

        $('.advance-select-table-fontStyle').select2({
            tags: false,
            placeholder: "Select Font Style"
        });

        $('.advance-select-table-fontWeight').select2({
            tags: false,
            placeholder: "Select Font Weight"
        });

        $('.advance-select-table-fontSize').select2({
            tags: false,
            placeholder: "Select Font Size"
        });


        $('.advance-select-table-decorationType').select2({
            tags: false,
            placeholder: "Select Type"
        });

        $('.advance-select-table-decorationStyle').select2({
            tags: false,
            placeholder: "Select Style"
        });

        $('.advance-select-table-decorationSize').select2({
            tags: false,
            placeholder: "Select Size"
        });
    } else if (jQuery.inArray("loader", pathArray) >= 1) {
        $('.advance-select-loaderFor').select2({
            tags: false,
            placeholder: "Select Loader For"
        });
    } else {
        $('.advance-select-country').select2({
            tags: false,
            placeholder: "Select Country"
        });

        $('.advance-select-state').select2({
            tags: false,
            placeholder: "Select State"
        });

        $('.advance-select-city').select2({
            tags: false,
            placeholder: "Select City"
        });

        $('.advance-select-button').select2({
            tags: false,
            placeholder: "Select Button Type"
        });


        // var data = [{
        //     id: 0,
        //     text: '<div style="color:green">Add Button</div>',
        //     html: '<i class="ion-plus-circled"></i>',
        //     title: 'Add Button'
        // }, {
        //     id: 1,
        //     text: '<div style="color:red">Save Button</div>',
        //     html: '<i class="ti-save"></i>',
        //     title: 'Save Button'
        // }, {
        //     id: 2,
        //     text: '<div style="color:green">Update Button</div>',
        //     html: '<i class="ti-save"></i>',
        //     title: 'Update Button'
        // }, {
        //     id: 3,
        //     text: '<div style="color:red">Search Button</div>',
        //     html: '<i class="ti-search"></i>',
        //     title: 'Search Button'
        // }, {
        //     id: 4,
        //     text: '<div style="color:green">Reload Button</div>',
        //     html: '<i class="ti-reload"></i>',
        //     title: 'Reload Button'
        // }, {
        //     id: 5,
        //     text: '<div style="color:red">Close Button</div>',
        //     html: '<i class="ti-close"></i>',
        //     title: 'Close Button'
        // }, ];

        // $(".advance-select-icon").select2({
        //     data: data,
        //     escapeMarkup: function (markup) {
        //         return markup;
        //     },
        //     templateResult: function (data) {
        //         return data.html;
        //     },
        //     templateSelection: function (data) {
        //         return data.text;
        //     }
        // });

        var data = [{
            id: 'ion-plus-circled',
            text: '<span><i class="ion-plus-circled"></i> Add Button</span>',
            title: 'Add Button'
        }, {
            id: 'ti-save',
            text: '<span><i class="ti-save"></i> Save Button</span>',
            title: 'Save Button'
        }, {
            id: 'ti-save',
            text: '<span><i class="ti-save"></i> Update Button</span>',
            title: 'Update Button'
        }, {
            id: 'ti-search',
            text: '<span><i class="ti-search"></i> Search Button</span>',
            title: 'Search Button'
        }, {
            id: 'ti-reload',
            text: '<span><i class="ti-reload"></i> Reload Button</span>',
            title: 'Reload Button'
        }, {
            id: 'ti-close',
            text: '<span><i class="ti-close"></i> Close Button</span>',
            title: 'Close Button'
        }, {
            id: 'ti-arrow-left',
            text: '<span><i class="ti-arrow-left"></i> Back Button</span>',
            title: 'Close Button'
        }];

        $(".advance-select-icon").select2({
            data: data,
            escapeMarkup: function (markup) {
                return markup;
            },
            placeholder: "Select Button Icon"
        });

        $('.advance-select-status').select2({
            tags: false,
            placeholder: "Select Status"
        });

        $('.advance-select-table').select2({
            tags: false,
            placeholder: "Select Table Parts"
        });
    }

});
