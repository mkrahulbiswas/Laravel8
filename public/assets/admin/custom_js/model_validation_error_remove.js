$(document).ready(function () {

    /*------Model Close-------*/
    $('#con-add-modal, #con-edit-modal, .con-add-modal, .con-edit-modal').on("hidden.bs.modal", function () {

        var forPage = $(this).attr('data-for-page').split('/');

        if (forPage == 'customizeButton') {

            $(this).find("[name~='buttonType']").val(['']).trigger('change');
            $(this).find("[name~='buttonIcon']").val(['']).trigger('change');
            $(this).find(".btnDemo, .btnHoverDemo").css({
                backgroundColor: 'rgba(255,255,255,1)'
            });
            $(this).find(".btnDemo p, .btnHoverDemo p").css({
                color: 'rgba(0,0,0,1)'
            });

            $("#saveCustomizeButtonForm, #updateCustomizeButtonForm").find("#alert").css('display', 'none');
            $('#saveCustomizeButtonForm, #updateCustomizeButtonForm').find("#buttonTypeErr, #buttonIconErr").text('');

        } else if (forPage == 'customizeTable') {

            $(this).find("[name~='tableType'], [name~='tableIcon'], [name~='customizeTableAdd']").val(['']).trigger('change');
            $(this).find(".tableDemo, .tableHoverDemo").css({
                backgroundColor: 'rgba(255,255,255,1)'
            });
            $(this).find(".tableDemo p, .tableHoverDemo p").css({
                color: 'rgba(0,0,0,1)'
            });

            $("#saveCustomizeTableForm, #updateCustomizeTableForm").find("#alert").css('display', 'none');
            $('#saveCustomizeTableForm, #updateCustomizeTableForm').find("#tableTypeErr").text('');

            $("#addCustomizeTableForm").find("#alert").css('display', 'none');
            $('#addCustomizeTableForm').find("#customizeTableAddErr").text('');

        } else if (forPage == 'customizeLoader') {

            $(this).find("[name~='loaderFor'], [name~='html'], [name~='css'], [name~='js']").val(['']).trigger('change');

            $("#saveCustomizeLoaderForm, #updateCustomizeLoaderForm").find("#alert").css('display', 'none');
            $('#saveCustomizeLoaderForm, #updateCustomizeLoaderForm').find("#loaderForErr, #htmlErr, #cssErr, #jsErr").text('');

        } else if (forPage == 'logo') {

            $(this).find('.dropify-clear').trigger('click');

            $("#saveLogoForm, #updateLogoForm").find("#alert").css('display', 'none');
            $('#saveLogoForm, #updateLogoForm').find("#bigLogoErr, #smallLogoErr, #favIconErr").text('');

        } else if ($.inArray("roles-permissions", pathArray)) {

            $("#saveRoleForm, #updateRoleForm").find("#alert").css('display', 'none');
            $('#saveRoleForm, #updateRoleForm').find("#roleErr, #descriptionErr").text('');

        } else {

            $(this).find('form')[0].reset();
            alert('lol');

        }

    });

});
