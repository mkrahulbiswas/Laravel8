$('document').ready(function () {

    /*--========================= ( Customize Button START ) =========================--*/
    $('#filterCustomizeButtonForm').find('#buttonTypeFilter, #buttonStatusFilter, #buttonFromDateFilter, #buttonToDateFilter, .filterCustomizeButtonBtn').on('change click', function () {
        var formId = $('#filterCustomizeButtonForm'),
            dataTableId = $('#customizeAdmin-button-listing'),

            buttonType = $("#buttonTypeFilter").val(),
            buttonStatus = $("#buttonStatusFilter").val(),
            fromDate = $("#buttonFromDateFilter").val(),
            toDate = $("#buttonToDateFilter").val(),

            action = $(this).closest('form').attr('action').split('/'),
            newUrl = action[action.length - 3] + '/' + action[action.length - 2] + "/ajaxGetList?buttonType=" + buttonType + "&buttonStatus=" + buttonStatus + "&fromDate=" + fromDate + "&toDate=" + toDate;
        if ($(this).attr('title') == 'Reload') {
            $(this).closest(formId).find("#buttonFromDateFilter, #buttonToDateFilter, #buttonTypeFilter, #buttonStatusFilter").val(['']).trigger('change');
            newUrl = action[action.length - 3] + '/' + action[action.length - 2] + "/ajaxGetList?buttonType=" + '' + "&buttonStatus=" + '' + "&fromDate=" + '' + "&toDate=" + '';
            dataTableId.DataTable().ajax.url(newUrl).load();
        } else if ($(this).attr('title') == 'Search') {
            dataTableId.DataTable().ajax.url(newUrl).load();
        } else {
            dataTableId.DataTable().ajax.url(newUrl).load();
        }
    });
    /*--========================= ( Customize Button END ) =========================--*/



    /*--========================= ( Customize Table START ) =========================--*/
    $('#filterCustomizeTableForm').find('#tableFromDateFilter, #tableToDateFilter, #tableStatusFilter, .FilterCustomizeTableBtn').on('change click', function () {
        var formId = $('#filterCustomizeTableForm'),
            dataTableId = $('#customizeAdmin-table-listing'),

            tableStatus = $("#tableStatusFilter").val(),
            fromDate = $("#tableFromDateFilter").val(),
            toDate = $("#tableToDateFilter").val(),

            action = $(this).closest('form').attr('action').split('/'),
            newUrl = action[action.length - 3] + '/' + action[action.length - 2] + "/ajaxGetList?tableStatus=" + tableStatus + "&fromDate=" + fromDate + "&toDate=" + toDate;
        if ($(this).attr('title') == 'Reload') {
            $(this).closest(formId).find("#tableFromDateFilter, #tableToDateFilter, #tableStatusFilter").val(['']).trigger('change');
            newUrl = action[action.length - 3] + '/' + action[action.length - 2] + "/ajaxGetList?tableStatus=" + '' + "&fromDate=" + '' + "&toDate=" + '';
            dataTableId.DataTable().ajax.url(newUrl).load();
        } else if ($(this).attr('title') == 'Search') {
            dataTableId.DataTable().ajax.url(newUrl).load();
        } else {
            dataTableId.DataTable().ajax.url(newUrl).load();
        }
    });
    /*--========================= ( Customize Table END ) =========================--*/

});
