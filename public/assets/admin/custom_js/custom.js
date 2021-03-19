$(document).ready(function () {

    var pathArray = window.location.pathname.split('/');

    // $("#board").select2({
    //   	tags: false,
    //   	placeholder: "Select Board"
    // });

    $('#responsive-datatable2').DataTable();

    $('.date-picker').datepicker({
        format: 'dd-mm-yyyy',
        autoclose: true,
    });

    $('.time-picker').timepicker({
        autoclose: true,
    });


    ////////Contact Model/////////
    $("#contact-listing").on("click", ".show_full_msg", function () {
        var subject = $(this).attr('data-subject');
        var msg = $(this).attr('data-msg');

        $('#read-msg-modal').find("#full_subject").text(subject);
        $('#read-msg-modal').find("#full_msg").text(msg);
    });


    /*-------Add Role--------*/
    $('#AddRole #role_id').change(function () {
        $('#AddRole #role').val($(this).children('option:selected').text());
    });


    /*-------Add Multiple Row Data------*/
    $('.Field .AddRow').click(function () {
        html = '<div class="Field FieldDelete"><input type="text" name="name[]" parsley-trigger="change" required placeholder="Enter Category Name" class="form-control" id="name"><div class="DeleteRow"><i class="md-close" style="font-size: 20px; color:white"></i></div></div>';
        $(this).closest('.form-group').append(html);
    });

    $('.form-group').delegate('.DeleteRow', 'click', function () {
        $(this).closest('.FieldDelete').remove();
    });

    $('.Edit').click(function () {
        $('#EditClick').trigger('click');
        $('#Edit #id').val($(this).closest('tr').attr('data-id'));
        $('#Edit #name').val($(this).closest('tr').find('td:nth-child(2)').attr('data-name'));
        $('#Edit #category').val($(this).closest('tr').find('td:nth-child(3)').attr('data-category'));
    });


    // $('#productSubCategory').children('option[class="' + $(this).val() + '"]').show();


    $('#addCustomizeTableForm').submit(function (event) {

        submitForm = $(this);
        submitBtn = $(this).find('#addCustomizeButtonBtn');

        event.preventDefault();

        var selectedVal = submitForm.find('#customizeTableAdd').val();

        if (selectedVal == 1) {
            let timerInterval
            Swal.fire({
                title: submitForm.find('#customizeTableAdd option:selected').text(),
                html: 'Page will open in <b>2</b> second.',
                timer: 2000,
                timerProgressBar: true,
                allowOutsideClick: false,
                onBeforeOpen: () => {
                    Swal.showLoading()
                    timerInterval = setInterval(() => {
                        Swal.getContent().querySelector('b')
                            .textContent = Swal.getTimerLeft();
                    }, 100);
                },
                onClose: () => {
                    clearInterval(timerInterval)
                }
            }).then((result) => {
                if (result.dismiss === Swal.DismissReason.timer) {
                    window.open(submitForm.find('#customizeTableAdd option:selected').attr('data-action'), '_blank');
                }
            });
        } else if (selectedVal == 2) {
            if ($('.customizeTableCheckbox').is(":checked")) {
                var id = $('.customizeTableCheckbox:checked').map(function (_, el) {
                    return $(el).val();
                }).get()

                let timerInterval
                Swal.fire({
                    title: submitForm.find('#customizeTableAdd option:selected').text(),
                    html: 'Page will open in <b>2</b> second.',
                    timer: 2000,
                    timerProgressBar: true,
                    allowOutsideClick: false,
                    onBeforeOpen: () => {
                        Swal.showLoading()
                        timerInterval = setInterval(() => {
                            Swal.getContent().querySelector('b')
                                .textContent = Swal.getTimerLeft();
                        }, 100);
                    },
                    onClose: () => {
                        clearInterval(timerInterval)
                    }
                }).then((result) => {
                    if (result.dismiss === Swal.DismissReason.timer) {
                        window.open(submitForm.find('#customizeTableAdd option:selected').attr('data-action') + '/' + id, '_blank');
                    }
                });

            } else {
                Swal.fire({
                    position: 'center-center',
                    icon: 'warning',
                    title: 'Opps....!',
                    text: 'Must select a style from table...',
                    showConfirmButton: false,
                    timer: 3000
                });
            }
        } else if (selectedVal == 3) {
            alert(selectedVal);
        } else {
            Swal.fire({
                position: 'center-center',
                icon: 'warning',
                title: 'Opps....!',
                text: 'Must select a option to continue....',
                showConfirmButton: false,
                timer: 3000
            });
        }

    });


    $('#saveCustomizeTableStyleForm select').change(function () {
        var routeClass = $(this).closest('.fontStyleCommon'),
            check = routeClass.attr('data-check'),
            applyCss = routeClass.find('.applyStyle');

        if (check == 'fontType') {
            applyCss.css({
                'fontFamily': $(this).val()
            });
        } else if (check == 'fontStyle') {
            applyCss.css({
                'fontStyle': $(this).val()
            });
        } else if (check == 'fontWeight') {
            applyCss.css({
                'fontWeight': $(this).val()
            });
        } else if (check == 'fontSize') {
            applyCss.css({
                'fontSize': $(this).val() + 'px'
            });
        } else {
            applyCss.css({
                'text-decoration': routeClass.find('.advance-select-table-decorationType').val() + ' ' +
                    routeClass.find('.advance-select-table-decorationStyle').val() +
                    ' rgba(' + routeClass.find('input').val() + ') ' +
                    routeClass.find('.advance-select-table-decorationSize').val() + 'px'
            });
        }
    });


});
