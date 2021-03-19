$('document').ready(function () {
    var pathArray = window.location.pathname.split('/'),
        submitForm, submitBtn;


    function loader($type) {
        if ($type == 1) {
            $("#internalLoader").fadeIn(500);
            $('body').css({
                'overflow-y': 'hidden'
            });
        } else {
            $("#internalLoader").fadeOut(500);
            $('body').css({
                'overflow-y': 'scroll'
            });
        }
    }


    /*--========================= ( USER START ) =========================--*/
    //====Save Sub Admin====//
    $("#saveAdminForm").submit(function (event) {
        event.preventDefault();
        $.ajax({
            url: $(this).attr('action'),
            data: new FormData(this),
            type: 'post',
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,

            beforeSend: function () {
                loader(1);
                $("#saveAdminBtn").attr("disabled", "disabled").find('span').text('Please wait...');
            },
            success: function (msg) {
                loader(0);
                $("#saveAdminBtn").attr("disabled", false).find('span').text('save');

                $("#fileErr").text('');
                $("#nameErr").text('');
                $("#emailErr").text('');
                $("#phoneErr").text('');
                //$("#passwordErr").text('');
                $("#roleErr").text('');
                $("#addressErr").text('');

                if (msg.status == 0) {
                    $("#alert").removeClass("alert-success").addClass("alert-danger");
                    $("#alert").css("display", "block");
                    $("#validationAlert").html(msg.msg);

                    $.each(msg.errors.file, function (i) {
                        $("#fileErr").text(msg.errors.file[i]);
                    });
                    $.each(msg.errors.name, function (i) {
                        $("#nameErr").text(msg.errors.name[i]);
                    });
                    $.each(msg.errors.email, function (i) {
                        $("#emailErr").text(msg.errors.email[i]);
                    });
                    $.each(msg.errors.phone, function (i) {
                        $("#phoneErr").text(msg.errors.phone[i]);
                    });
                    $.each(msg.errors.role, function (i) {
                        $("#roleErr").text(msg.errors.role[i]);
                    });
                    $.each(msg.errors.address, function (i) {
                        $("#addressErr").text(msg.errors.address[i]);
                    });
                } else if (msg.status == 1) {
                    $("#alert").removeClass("alert-danger").addClass("alert-success");
                    $("#alert").css("display", "block");
                    $("#validationAlert").html(msg.msg);

                    setTimeout(function () {
                        $("#alert").hide();
                    }, 2000);
                    setTimeout(function () {
                        location.reload();
                    }, 3000);

                }
            }
        });
    });

    //====Update Sub Admin====//
    $("#updateAdminForm").submit(function (event) {
        event.preventDefault();
        $.ajax({
            url: $(this).attr('action'),
            data: new FormData(this),
            type: 'post',
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,

            beforeSend: function () {
                loader(1);
                $("#updateAdminBtn").attr("disabled", "disabled").find('span').text('Please wait...');
            },
            success: function (msg) {
                loader(0);
                $("#updateAdminBtn").attr("disabled", false).find('span').text('Update');

                $("#fileErr").text('');
                $("#nameErr").text('');
                $("#emailErr").text('');
                $("#phoneErr").text('');
                $("#addressErr").text('');

                if (msg.status == 0) {
                    $("#alert").removeClass("alert-success").addClass("alert-danger");
                    $("#alert").css("display", "block");
                    $("#validationAlert").html(msg.msg);

                    $.each(msg.errors.file, function (i) {
                        $("#fileErr").text(msg.errors.file[i]);
                    });
                    $.each(msg.errors.name, function (i) {
                        $("#nameErr").text(msg.errors.name[i]);
                    });
                    $.each(msg.errors.email, function (i) {
                        $("#emailErr").text(msg.errors.email[i]);
                    });
                    $.each(msg.errors.phone, function (i) {
                        $("#phoneErr").text(msg.errors.phone[i]);
                    });
                    $.each(msg.errors.address, function (i) {
                        $("#addressErr").text(msg.errors.address[i]);
                    });
                } else if (msg.status == 1) {
                    $("#alert").removeClass("alert-danger").addClass("alert-success");
                    $("#alert").css("display", "block");
                    $("#validationAlert").html(msg.msg);

                    setTimeout(function () {
                        $("#alert").hide();
                    }, 2000);
                    setTimeout(function () {
                        location.reload();
                    }, 3000);
                }
            }
        });
    });

    //====Status / Delete Sub Admin====// 
    $('body').delegate('#admin-listing .action', 'click', function () {
        var type = $(this).attr('data-type'),
            id = $(this).attr('data-id'),
            action = $(this).attr('data-action') + '/' + id,
            adminListing = $('#admin-listing').DataTable();
        if (type == 'status') {

            if ($(this).attr('data-status') == 'block') {
                var res = confirm('Do yoy really want to block?');
                if (res === false) {
                    return;
                }
            } else {
                var res = confirm('Do yoy really want to unblock?');
                if (res === false) {
                    return;
                }
            }

            $.ajax({
                url: action,
                type: 'get',
                dataType: 'json',
                beforeSend: function () {
                    loader(1);
                },
                success: function (msg) {
                    loader(0);
                    if (msg.status == 0) {
                        $("#alert").removeClass("alert-success").addClass("alert-danger");
                        $("#alert").css("display", "block");
                        $("#validationAlert").html(msg.msg);
                    } else {
                        $("#alert").removeClass("alert-danger").addClass("alert-success");
                        $("#alert").css("display", "block");
                        $("#validationAlert").html(msg.msg);

                        adminListing.ajax.reload(null, false);
                    }
                    setTimeout(function () {
                        $("#alert").css('display', 'none');
                    }, 5000);
                }
            });
        } else if (type == 'delete') {
            id = $(this).attr('data-id');
            action = $(this).attr('data-action');
            $.ajax({
                url: action,
                data: {
                    id: id
                },
                type: 'post',
                beforeSend: function () {

                },
                success: function (msg) {
                    if (msg.status == 1) {
                        $('#userDoctorsReload').trigger('click');
                    } else {
                        alert('LOL');
                    }
                }
            });
        } else {

        }
    });



    //----Customer Status----//
    $('body').delegate('#user-customer-listing .actionDatatable', 'click', function () {
        var type = $(this).attr('data-type'),
            res = '',
            action = $(this).attr('data-action'),
            reloadDatatable = $('#user-customer-listing').DataTable();
        if (type == 'status') {

            if ($(this).attr('data-status') == 'block') {
                var res = confirm('Do yoy really want to block?');
                if (res === false) {
                    return;
                }
            } else {
                var res = confirm('Do yoy really want to unblock?');
                if (res === false) {
                    return;
                }
            }

            $.ajax({
                url: action,
                type: 'get',
                dataType: 'json',
                beforeSend: function () {
                    loader(1);
                },
                success: function (msg) {
                    loader(0);
                    if (msg.status == 0) {
                        $("#alert").removeClass("alert-success").addClass("alert-danger");
                        $("#alert").css("display", "block");
                        $("#validationAlert").html(msg.msg);
                    } else {
                        $("#alert").removeClass("alert-danger").addClass("alert-success");
                        $("#alert").css("display", "block");
                        $("#validationAlert").html(msg.msg);

                        reloadDatatable.ajax.reload(null, false);
                    }
                    setTimeout(function () {
                        $("#alert").css('display', 'none');
                    }, 5000);
                }
            });
        } else {

        }
    });
    /*--========================= ( USER END ) =========================--*/






    /*--========================= ( Role START ) =========================--*/
    //---- ( Role Add ) ----//
    $('#saveRoleForm').submit(function (event) {

        submitForm = $(this);
        submitBtn = $(this).find('#saveRoleBtn');

        event.preventDefault();
        $.ajax({
            url: $(this).attr('action'),
            data: new FormData(this),
            type: 'post',
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function () {
                loader(1);
                submitBtn.attr("disabled", "disabled").find('span').text('Please wait...');
            },
            success: function (msg) {
                loader(0);
                submitBtn.attr("disabled", false).find('span').text('save');
                submitForm.find("#roleErr, #descriptionErr").text('');

                if (msg.status == 0) {
                    Swal.fire({
                        position: 'center-center',
                        icon: 'warning',
                        title: 'Opps....!',
                        text: msg.msg,
                        showConfirmButton: false,
                        timer: 3000
                    });

                    $.each(msg.errors.role, function (i) {
                        submitForm.find("#roleErr").text(msg.errors.role[i]);
                    });
                    $.each(msg.errors.description, function (i) {
                        submitForm.find("#descriptionErr").text(msg.errors.description[i]);
                    });

                } else {
                    Swal.fire({
                        position: 'center-center',
                        icon: 'success',
                        title: 'Opps....!',
                        text: msg.msg,
                        showConfirmButton: false,
                        timer: 3000
                    });

                    submitForm[0].reset();
                    $('#rolePermision-role-listing').DataTable().ajax.reload(null, false);
                }
            }
        });
    });

    sfsfdsssf

    //---- ( Role Update ) ----//
    $("#updateRoleForm").submit(function (event) {
        submitForm = $(this);
        submitBtn = $(this).find('#updateRoleBtn');

        event.preventDefault();
        $.ajax({
            url: $(this).attr('action'),
            data: new FormData(this),
            type: 'post',
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function () {
                loader(1);
                submitBtn.attr("disabled", "disabled").find('span').text('Please wait...');
            },
            success: function (msg) {
                loader(0);
                submitBtn.attr("disabled", false).find('span').text('update');

                submitForm.find("#roleErr, #descriptionErr").text('');

                if (msg.status == 0) {
                    Swal.fire({
                        position: 'center-center',
                        icon: 'warning',
                        title: 'Opps....!',
                        text: msg.msg,
                        showConfirmButton: false,
                        timer: 3000
                    });

                    $.each(msg.errors.role, function (i) {
                        submitForm.find("#roleErr").text(msg.errors.role[i]);
                    });
                    $.each(msg.errors.description, function (i) {
                        submitForm.find("#descriptionErr").text(msg.errors.description[i]);
                    });

                } else {
                    Swal.fire({
                        position: 'center-center',
                        icon: 'success',
                        title: 'Success',
                        text: msg.msg,
                        showConfirmButton: false,
                        timer: 3000
                    });

                    setTimeout(function () {
                        submitForm.find("#alert").css('display', 'none');
                    }, 2000);

                    setTimeout(function () {
                        $('#cms-logo-listing').DataTable().ajax.reload(null, false);
                    }, 1000);
                }
            }
        });
    });

    //---- ( Role Update ) ----//
    $('body').delegate('#rolePermision-role-listing .actionDatatable', 'click', function () {
        var type = $(this).attr('data-type'),
            res = '',
            action = $(this).attr('data-action'),
            reloadDatatable = $('#rolePermision-role-listing').DataTable(),
            targetClass = '';
        if (type == 'status') {

            if ($(this).attr('data-status') == 'block') {
                res = confirm('Do yoy really want to block?');
                if (res === false) {
                    return;
                }
            } else {
                res = confirm('Do yoy really want to unblock?');
                if (res === false) {
                    return;
                }
            }

            $.ajax({
                url: action,
                type: 'get',
                dataType: 'json',
                beforeSend: function () {
                    loader(1);
                },
                success: function (msg) {
                    loader(0);
                    if (msg.status == 0) {
                        $("#alert").removeClass("alert-success").addClass("alert-danger");
                        $("#alert").css("display", "block");
                        $("#validationAlert").html(msg.msg);
                    } else {
                        $("#alert").removeClass("alert-danger").addClass("alert-success");
                        $("#alert").css("display", "block");
                        $("#validationAlert").html(msg.msg);

                        reloadDatatable.ajax.reload(null, false);
                    }
                    setTimeout(function () {
                        $("#alert").css('display', 'none');
                    }, 5000);
                }
            });
        } else if (type == 'edit') {
            targetClass = $('#con-edit-modal');
            targetClass.modal('show');
            editData = JSON.parse($(this).attr('data-array'));
            targetClass.find('#id').val(editData.id);
            targetClass.find('#role').val(editData.role);
            targetClass.find('#description').val(editData.description);
        } else {

        }
    });
    /*--========================= ( Role END ) =========================--*/





    /*--========================= ( CMS START ) =========================--*/
    //---- ( Logo Add ) ----//
    $('#saveLogoForm').submit(function (event) {

        submitForm = $(this);
        submitBtn = $(this).find('#saveLogoBtn');

        event.preventDefault();
        $.ajax({
            url: $(this).attr('action'),
            data: new FormData(this),
            type: 'post',
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function () {
                loader(1);
                submitBtn.attr("disabled", "disabled").find('span').text('Please wait...');
            },
            success: function (msg) {
                loader(0);
                submitBtn.attr("disabled", false).find('span').text('save');

                submitForm.find("#bigLogoErr").text('');
                submitForm.find("#smallLogoErr").text('');
                submitForm.find("#favIconErr").text('');

                if (msg.status == 0) {
                    submitForm.find("#alert").removeClass("alert-success").addClass("alert-danger");
                    submitForm.find("#alert").css("display", "block");
                    submitForm.find("#validationAlert").html(msg.msg);

                    $.each(msg.errors.bigLogo, function (i) {
                        submitForm.find("#bigLogoErr").text(msg.errors.bigLogo[i]);
                    });
                    $.each(msg.errors.smallLogo, function (i) {
                        submitForm.find("#smallLogoErr").text(msg.errors.smallLogo[i]);
                    });
                    $.each(msg.errors.favIcon, function (i) {
                        submitForm.find("#favIconErr").text(msg.errors.favIcon[i]);
                    });

                } else {
                    submitForm.find("#alert").removeClass("alert-danger").addClass("alert-success");
                    submitForm.find("#alert").css("display", "block");
                    submitForm.find("#validationAlert").html(msg.msg);

                    setTimeout(function () {
                        submitForm.find("#alert").css('display', 'none');
                    }, 2000);

                    setTimeout(function () {
                        submitForm.find('.dropify-clear').trigger('click');
                        $('#cms-logo-listing').DataTable().ajax.reload(null, false);
                    }, 1000);
                }
            }
        });
    });

    //---- ( Logo Update ) ----//
    $("#updateLogoForm").submit(function (event) {
        submitForm = $(this);
        submitBtn = $(this).find('#updateLogoBtn');

        event.preventDefault();
        $.ajax({
            url: $(this).attr('action'),
            data: new FormData(this),
            type: 'post',
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function () {
                loader(1);
                submitBtn.attr("disabled", "disabled").find('span').text('Please wait...');
            },
            success: function (msg) {
                loader(0);
                submitBtn.attr("disabled", false).find('span').text('update');

                submitForm.find("#bigLogoErr").text('');
                submitForm.find("#smallLogoErr").text('');
                submitForm.find("#favIconErr").text('');

                if (msg.status == 0) {
                    submitForm.find("#alert").removeClass("alert-success").addClass("alert-danger");
                    submitForm.find("#alert").css("display", "block");
                    submitForm.find("#validationAlert").html(msg.msg);

                    $.each(msg.errors.bigLogo, function (i) {
                        submitForm.find("#bigLogoErr").text(msg.errors.bigLogo[i]);
                    });
                    $.each(msg.errors.smallLogo, function (i) {
                        submitForm.find("#smallLogoErr").text(msg.errors.smallLogo[i]);
                    });
                    $.each(msg.errors.favIcon, function (i) {
                        submitForm.find("#favIconErr").text(msg.errors.favIcon[i]);
                    });

                } else {
                    submitForm.find("#alert").removeClass("alert-danger").addClass("alert-success");
                    submitForm.find("#alert").css("display", "block");
                    submitForm.find("#validationAlert").html(msg.msg);

                    setTimeout(function () {
                        submitForm.find("#alert").css('display', 'none');
                    }, 2000);

                    setTimeout(function () {
                        $('#cms-logo-listing').DataTable().ajax.reload(null, false);
                    }, 1000);
                }
            }
        });
    });

    $('body').delegate('#cms-logo-listing .actionDatatable', 'click', function () {
        var type = $(this).attr('data-type'),
            res = '',
            action = $(this).attr('data-action'),
            reloadDatatable = $('#cms-logo-listing').DataTable();
        if (type == 'status') {

            if ($(this).attr('data-status') == 'block') {
                res = confirm('Do yoy really want to block?');
                if (res === false) {
                    return;
                }
            } else {
                res = confirm('Do yoy really want to unblock?');
                if (res === false) {
                    return;
                }
            }

            $.ajax({
                url: action,
                type: 'get',
                dataType: 'json',
                beforeSend: function () {
                    loader(1);
                },
                success: function (msg) {
                    loader(0);
                    if (msg.status == 0) {
                        $("#alert").removeClass("alert-success").addClass("alert-danger");
                        $("#alert").css("display", "block");
                        $("#validationAlert").html(msg.msg);
                    } else {
                        $("#alert").removeClass("alert-danger").addClass("alert-success");
                        $("#alert").css("display", "block");
                        $("#validationAlert").html(msg.msg);

                        reloadDatatable.ajax.reload(null, false);
                    }
                    setTimeout(function () {
                        $("#alert").css('display', 'none');
                    }, 5000);
                }
            });
        } else if (type == 'delete') {

            if ($(this).attr('data-status') == 'block') {
                res = confirm('Do yoy really want to block?');
                if (res === false) {
                    return;
                }
            } else {
                res = confirm('Do yoy really want to unblock?');
                if (res === false) {
                    return;
                }
            }

            $.ajax({
                url: action,
                type: 'get',
                dataType: 'json',
                beforeSend: function () {
                    loader(1);
                },
                success: function (msg) {
                    loader(0);
                    if (msg.status == 0) {
                        $("#alert").removeClass("alert-success").addClass("alert-danger");
                        $("#alert").css("display", "block");
                        $("#validationAlert").html(msg.msg);
                    } else {
                        $("#alert").removeClass("alert-danger").addClass("alert-success");
                        $("#alert").css("display", "block");
                        $("#validationAlert").html(msg.msg);

                        reloadDatatable.ajax.reload(null, false);
                    }
                    setTimeout(function () {
                        $("#alert").css('display', 'none');
                    }, 5000);
                }
            });
        } else if (type == 'edit') {
            $('#con-edit-modal').modal('show');
            editData = JSON.parse($(this).attr('data-array'));
            $('#con-edit-modal #id').val(editData.id);
            $('#con-edit-modal .bigLogo').attr('src', editData.bigLogo);
            $('#con-edit-modal .smallLogo').attr('src', editData.smallLogo);
            $('#con-edit-modal .favIcon').attr('src', editData.favIcon);
        } else {

        }
    });




    //----Banner Add, Edit, Delete, Status----//
    $("#saveBannerForm").submit(function (event) {
        event.preventDefault();
        $.ajax({
            url: $(this).attr('action'),
            data: new FormData(this),
            type: $(this).attr('method'),
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function () {
                loader(1);
                $("#saveBannerBtn").attr("disabled", "disabled");
                $("#saveBannerBtn span").text('Please wait...');
            },
            success: function (msg) {
                loader(0);
                $("#saveBannerBtn").attr("disabled", false);
                $("#saveBannerBtn span").text('Save');

                $("#saveBannerForm #fileErr").text('');

                if (msg.status == 0) {
                    $("#saveBannerForm").find("#alert").removeClass("alert-success").addClass("alert-danger");
                    $("#saveOfferForm").find("#alert").css("display", "block");
                    $("#saveOfferForm").find("#validationAlert").html(msg.msg);

                    $.each(msg.errors.file, function (i) {
                        $("#saveBannerForm #fileErr").text(msg.errors.file[i]);
                    });

                } else {
                    $("#saveBannerForm").find("#alert").removeClass("alert-danger").addClass("alert-success");
                    $("#saveBannerForm").find("#alert").css("display", "block");
                    $("#saveBannerForm").find("#validationAlert").html(msg.msg);

                    setTimeout(function () {
                        $("#saveBannerForm").find("#alert").css('display', 'none');
                    }, 2000);

                    setTimeout(function () {
                        $('#saveBannerForm').find('.dropify-clear').trigger('click');
                        $('#cms-banner-listing').DataTable().ajax.reload(null, false);
                    }, 1000);
                }
            }
        });
    });

    $("#updateBannerForm").submit(function (event) {
        event.preventDefault();
        $.ajax({
            url: $(this).attr('action'),
            data: new FormData(this),
            type: $(this).attr('method'),
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function () {
                loader(1);
                $("#updateBannerBtn").attr("disabled", "disabled");
                $("#updateBannerBtn span").text('Please wait...');
            },
            success: function (msg) {
                loader(0);
                $("#updateBannerBtn").attr("disabled", false);
                $("#updateBannerBtn span").text('Update');

                $("#updateBannerForm #fileErr").text('');

                if (msg.status == 0) {
                    $("#updateBannerForm").find("#alert").removeClass("alert-success").addClass("alert-danger");
                    $("#updateBannerForm").find("#alert").css("display", "block");
                    $("#updateBannerForm").find("#validationAlert").html(msg.msg);

                    $.each(msg.errors.file, function (i) {
                        $("#updateBannerForm #fileErr").text(msg.errors.file[i]);
                    });

                } else {
                    $("#updateBannerForm").find("#alert").removeClass("alert-danger").addClass("alert-success");
                    $("#updateBannerForm").find("#alert").css("display", "block");
                    $("#updateBannerForm").find("#validationAlert").html(msg.msg);

                    setTimeout(function () {
                        $("#updateBannerForm").find("#alert").css('display', 'none');
                        $('#cms-banner-listing').DataTable().ajax.reload(null, false);
                    }, 2000);
                }
            }
        });
    });

    $('body').delegate('#cms-banner-listing .actionDatatable', 'click', function () {
        var type = $(this).attr('data-type'),
            res = '',
            action = $(this).attr('data-action'),
            reloadDatatable = $('#cms-banner-listing').DataTable();
        if (type == 'status') {

            if ($(this).attr('data-status') == 'block') {
                res = confirm('Do yoy really want to block?');
                if (res === false) {
                    return;
                }
            } else {
                res = confirm('Do yoy really want to unblock?');
                if (res === false) {
                    return;
                }
            }

            $.ajax({
                url: action,
                type: 'get',
                dataType: 'json',
                beforeSend: function () {
                    loader(1);
                },
                success: function (msg) {
                    loader(0);
                    if (msg.status == 0) {
                        $("#alert").removeClass("alert-success").addClass("alert-danger");
                        $("#alert").css("display", "block");
                        $("#validationAlert").html(msg.msg);
                    } else {
                        $("#alert").removeClass("alert-danger").addClass("alert-success");
                        $("#alert").css("display", "block");
                        $("#validationAlert").html(msg.msg);


                        reloadDatatable.ajax.reload(null, false);
                    }
                    setTimeout(function () {
                        $("#alert").css('display', 'none');
                    }, 5000);
                }
            });
        } else if (type == 'delete') {

            if ($(this).attr('data-status') == 'block') {
                res = confirm('Do yoy really want to block?');
                if (res === false) {
                    return;
                }
            } else {
                res = confirm('Do yoy really want to unblock?');
                if (res === false) {
                    return;
                }
            }

            $.ajax({
                url: action,
                type: 'get',
                dataType: 'json',
                beforeSend: function () {
                    loader(1);
                },
                success: function (msg) {
                    loader(0);
                    if (msg.status == 0) {
                        $("#alert").removeClass("alert-success").addClass("alert-danger");
                        $("#alert").css("display", "block");
                        $("#validationAlert").html(msg.msg);
                    } else {
                        $("#alert").removeClass("alert-danger").addClass("alert-success");
                        $("#alert").css("display", "block");
                        $("#validationAlert").html(msg.msg);

                        reloadDatatable.ajax.reload(null, false);
                    }
                    setTimeout(function () {
                        $("#alert").css('display', 'none');
                    }, 5000);
                }
            });
        } else if (type == 'edit') {
            $('#con-edit-modal').modal('show');
            editData = JSON.parse($(this).attr('data-array'));
            $('#con-edit-modal #id').val(editData.id);
            $('#con-edit-modal img').attr('src', editData.image);
        } else {

        }
    });
    /*--========================= ( CMS END ) =========================--*/





    /*--========================= ( Customize Admin Apperance START ) =========================--*/
    //---- ( Button Save ) ----//
    $('#saveCustomizeButtonForm').submit(function (event) {

        submitForm = $(this);
        submitBtn = $(this).find('#saveCustomizeButtonBtn');

        event.preventDefault();
        $.ajax({
            url: $(this).attr('action'),
            data: new FormData(this),
            type: 'post',
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function () {
                loader(1);
                submitBtn.attr("disabled", "disabled").find('span').text('Please wait...');
            },
            success: function (msg) {
                loader(0);
                submitBtn.attr("disabled", false).find('span').text('save');

                submitForm.find("#buttonTypeErr, #buttonIconErr").text('');

                if (msg.status == 0) {
                    Swal.fire({
                        position: 'center-center',
                        icon: 'warning',
                        title: 'Opps....!',
                        text: msg.msg,
                        showConfirmButton: false,
                        timer: 3000
                    });

                    $.each(msg.errors.buttonType, function (i) {
                        submitForm.find("#buttonTypeErr").text(msg.errors.buttonType[i]);
                    });
                    $.each(msg.errors.buttonIcon, function (i) {
                        submitForm.find("#buttonIconErr").text(msg.errors.buttonIcon[i]);
                    });

                } else {
                    Swal.fire({
                        position: 'center-center',
                        icon: 'success',
                        title: 'Success',
                        text: msg.msg,
                        showConfirmButton: false,
                        timer: 3000
                    });

                    setTimeout(function () {
                        submitForm.find("[name~='buttonType'], [name~='buttonIcon']").val(['']).trigger('change');
                        submitForm.find("#btnBackColor, #btnHoverBackColor").val('40, 70, 155, 1');
                        submitForm.find("#btnTextColor, #btnHoverTextColor").val('255, 255, 255, 1');
                        submitForm.find(".btnDemo, .btnHoverDemo").css({
                            backgroundColor: 'rgba(255,255,255,1)'
                        });
                        submitForm.find(".btnDemo p, .btnHoverDemo p").css({
                            color: 'rgba(0,0,0,1)'
                        });
                    }, 2000);

                    setTimeout(function () {
                        $('#customizeAdmin-button-listing').DataTable().ajax.reload(null, false);
                    }, 1000);
                }
            }
        });
    });

    //---- ( Button Update ) ----//
    $("#updateCustomizeButtonForm").submit(function (event) {
        submitForm = $(this);
        submitBtn = $(this).find('#updateCustomizeButtonBtn');

        event.preventDefault();
        $.ajax({
            url: $(this).attr('action'),
            data: new FormData(this),
            type: 'post',
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function () {
                loader(1);
                submitBtn.attr("disabled", "disabled").find('span').text('Please wait...');
            },
            success: function (msg) {
                loader(0);
                submitBtn.attr("disabled", false).find('span').text('save');

                submitForm.find("#buttonTypeErr, #buttonIconErr").text('');

                if (msg.status == 0) {
                    Swal.fire({
                        position: 'center-center',
                        icon: 'warning',
                        title: 'Opps....!',
                        text: msg.msg,
                        showConfirmButton: false,
                        timer: 3000
                    });

                    $.each(msg.errors.buttonType, function (i) {
                        submitForm.find("#buttonTypeErr").text(msg.errors.buttonType[i]);
                    });
                    $.each(msg.errors.buttonIcon, function (i) {
                        submitForm.find("#buttonIconErr").text(msg.errors.buttonIcon[i]);
                    });

                } else {
                    Swal.fire({
                        position: 'center-center',
                        icon: 'success',
                        title: 'Success',
                        text: msg.msg,
                        showConfirmButton: false,
                        timer: 3000
                    });

                    setTimeout(function () {
                        $('#customizeAdmin-button-listing').DataTable().ajax.reload(null, false);
                    }, 1000);
                }
            }
        });
    });

    //---- ( Button Status, Delete ) ----//
    $('body').delegate('#customizeAdmin-button-listing .actionDatatable', 'click', function () {
        var type = $(this).attr('data-type'),
            res = '',
            action = $(this).attr('data-action'),
            roloadDatatble = $('#customizeAdmin-button-listing').DataTable(),
            id = '';

        if (type == 'status') {

            if ($(this).attr('data-status') == 'block') {
                res = confirm('Do yoy really want to block?');
                if (res === false) {
                    return;
                }
            } else {
                res = confirm('Do yoy really want to unblock?');
                if (res === false) {
                    return;
                }
            }

            $.ajax({
                url: action,
                type: 'get',
                dataType: 'json',
                beforeSend: function () {
                    loader(1);
                },
                success: function (msg) {
                    loader(0);
                    if (msg.status == 0) {
                        Swal.fire({
                            position: 'center-center',
                            icon: 'success',
                            title: 'Success',
                            text: msg.msg,
                            showConfirmButton: false,
                            timer: 3000
                        });
                    } else {
                        Swal.fire({
                            position: 'center-center',
                            icon: 'success',
                            title: 'Success',
                            text: msg.msg,
                            showConfirmButton: false,
                            timer: 3000
                        });

                        roloadDatatble.ajax.reload(null, false);
                    }
                    setTimeout(function () {
                        $("#alert").css('display', 'none');
                    }, 5000);
                }
            });

        } else if (type == 'delete') {

            res = confirm('Do yoy really want to delete?');
            if (res === false) {
                return;
            }

            $.ajax({
                url: action,
                type: 'get',
                dataType: 'json',
                beforeSend: function () {
                    loader(1);
                },
                success: function (msg) {
                    loader(0);
                    if (msg.status == 0) {
                        Swal.fire({
                            position: 'center-center',
                            icon: 'warning',
                            title: 'Opps....!',
                            text: msg.msg,
                            showConfirmButton: false,
                            timer: 3000
                        });
                    } else {
                        Swal.fire({
                            position: 'center-center',
                            icon: 'success',
                            title: 'Success',
                            text: msg.msg,
                            showConfirmButton: false,
                            timer: 3000
                        });

                        roloadDatatble.ajax.reload(null, false);
                    }
                    setTimeout(function () {
                        $("#alert").css('display', 'none');
                    }, 5000);
                }
            });

        } else if (type == 'detail') {

            id = $('#con-detail-modal-button');

            id.modal('show');
            editData = JSON.parse($(this).attr('data-array'));

            id.find('#buttonType span').text(editData.btnFor);
            id.find('#btnBackColor span').text('rgba(' + editData.backColor + ')');
            id.find('#btnTextColor span').text('rgba(' + editData.textColor + ')');
            id.find('#btnHoverBackColor span').text('rgba(' + editData.backHoverColor + ')');
            id.find('#btnHoverTextColor span').text('rgba(' + editData.textHoverColor + ')');

            id.find('#btnDemo button')
                .css({
                    backgroundColor: 'rgba(' + editData.backColor + ')',
                    color: 'rgba(' + editData.textColor + ')'
                })
                .hover(function () {
                    $(this).css({
                        backgroundColor: 'rgba(' + editData.backHoverColor + ')',
                        color: 'rgba(' + editData.textHoverColor + ')'
                    });
                }, function () {
                    $(this).css({
                        backgroundColor: 'rgba(' + editData.backColor + ')',
                        color: 'rgba(' + editData.textColor + ')'
                    })
                })
                .closest('div').find('span').text(editData.btnFor)
                .closest('div').find('i').attr('class', editData.btnIcon);

        } else {
            id = $('#con-edit-modal-button');

            id.modal('show');
            editData = JSON.parse($(this).attr('data-array'));

            id.find('#id').val(editData.id);
            id.find('#buttonTypeEdit').val([editData.btnFor]).trigger('change');
            id.find('#buttonIconEdit').val([editData.btnIcon]).trigger('change');

            id.find('.btnDemo').attr('style', 'background-color:rgba(' + editData.backColor + ')');
            id.find('.btnDemo p').attr('style', 'color:rgba(' + editData.textColor + ')');
            id.find('.btnDemo #btnBackColor').val(editData.backColor);
            id.find('.btnDemo #btnTextColor').val(editData.textColor);

            id.find('.btnHoverDemo').attr('style', 'background-color:rgba(' + editData.backHoverColor + ')');
            id.find('.btnHoverDemo p').attr('style', 'color:rgba(' + editData.textHoverColor + ')');
            id.find('.btnHoverDemo #btnHoverBackColor').val(editData.backHoverColor);
            id.find('.btnHoverDemo #btnHoverTextColor').val(editData.textHoverColor);
        }
    });



    //---- ( Table Style Save ) ----//
    $('#saveCustomizeTableStyleForm').submit(function (event) {

        submitForm = $(this);
        submitBtn = $(this).find('#saveCustomizeTableStyleBtn');

        event.preventDefault();
        $.ajax({
            url: $(this).attr('action'),
            data: new FormData(this),
            type: 'post',
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function () {
                loader(1);
                submitBtn.attr("disabled", "disabled").find('span').text('Please wait...');
            },
            success: function (msg) {
                loader(0);
                submitBtn.attr("disabled", false).find('span').text('save');

                if (msg.status == 0) {
                    Swal.fire({
                        position: 'center-center',
                        icon: 'warning',
                        title: 'Opps....!',
                        text: msg.msg,
                        showConfirmButton: false,
                        timer: 3000
                    });
                } else {
                    Swal.fire({
                        position: 'center-center',
                        icon: 'success',
                        title: 'Success',
                        text: msg.msg,
                        showConfirmButton: false,
                        timer: 3000
                    });

                    setTimeout(function () {
                        submitForm.find("select, input").val(['']).trigger('change');
                        submitForm.find(".fontStyleCommon .applyStyle").attr('style', '');
                    }, 2000);
                }
            }
        });
    });



    //---- ( Table Color Save ) ----//
    $('#saveCustomizeTableColorForm').submit(function (event) {

        submitForm = $(this);
        submitBtn = $(this).find('#saveCustomizeTableColorBtn');

        event.preventDefault();
        $.ajax({
            url: $(this).attr('action'),
            data: new FormData(this),
            type: 'post',
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function () {
                loader(1);
                submitBtn.attr("disabled", "disabled").find('span').text('Please wait...');
            },
            success: function (msg) {
                loader(0);
                submitBtn.attr("disabled", false).find('span').text('save');

                submitForm.find("#tableTypeErr").text('');

                if (msg.status == 0) {
                    Swal.fire({
                        position: 'center-center',
                        icon: 'warning',
                        title: 'Opps....!',
                        text: msg.msg,
                        showConfirmButton: false,
                        timer: 3000
                    });

                    $.each(msg.errors.tableType, function (i) {
                        submitForm.find("#tableTypeErr").text(msg.errors.tableType[i]);
                    });

                } else {
                    Swal.fire({
                        position: 'center-center',
                        icon: 'success',
                        title: 'Success',
                        text: msg.msg,
                        showConfirmButton: false,
                        timer: 3000
                    });

                    setTimeout(function () {
                        submitForm.find("#tableHeadBackColor, #tableHeadHoverBackColor, #tableBodyBackColor, #tableBodyHoverBackColor").val('40, 70, 155, 1');
                        submitForm.find("#tableHeadTextColor, #tableHeadHoverTextColor, #tableBodyTextColor, #tableBodyHoverTextColor").val('255, 255, 255, 1');
                        submitForm.find(".tableHeadDemo, .tableHeadHoverDemo, .tableBodyDemo, .tableBodyHoverDemo").css({
                            backgroundColor: 'rgba(255,255,255,1)'
                        }).closest('div').find("p").css({
                            color: 'rgba(0,0,0,1)'
                        });
                    }, 2000);

                    setTimeout(function () {
                        $('#customizeAdmin-table-listing').DataTable().ajax.reload(null, false);
                    }, 1000);
                }
            }
        });
    });

    //---- ( Table Color Update ) ----//
    $("#updateCustomizeTableColorForm").submit(function (event) {
        submitForm = $(this);
        submitBtn = $(this).find('#updateCustomizeTableColorBtn');

        event.preventDefault();
        $.ajax({
            url: $(this).attr('action'),
            data: new FormData(this),
            type: 'post',
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function () {
                loader(1);
                submitBtn.attr("disabled", "disabled").find('span').text('Please wait...');
            },
            success: function (msg) {
                loader(0);
                submitBtn.attr("disabled", false).find('span').text('save');

                submitForm.find("#tableTypeErr").text('');

                if (msg.status == 0) {
                    Swal.fire({
                        position: 'center-center',
                        icon: 'warning',
                        title: 'Opps....!',
                        text: msg.msg,
                        showConfirmButton: false,
                        timer: 3000
                    });

                    $.each(msg.errors.tableType, function (i) {
                        submitForm.find("#tableTypeErr").text(msg.errors.tableType[i]);
                    });

                } else {
                    Swal.fire({
                        position: 'center-center',
                        icon: 'success',
                        title: 'Success',
                        text: msg.msg,
                        showConfirmButton: false,
                        timer: 3000
                    });

                    setTimeout(function () {
                        $('#customizeAdmin-table-listing').DataTable().ajax.reload(null, false);
                    }, 1000);
                }
            }
        });
    });

    //---- ( Table Status, Delete ) ----//
    $('body').delegate('#customizeAdmin-table-listing .actionDatatable', 'click', function () {
        var type = $(this).attr('data-type'),
            res = '',
            action = $(this).attr('data-action'),
            roloadDatatble = $('#customizeAdmin-table-listing').DataTable(),
            id = '';

        if (type == 'status') {

            if ($(this).attr('data-status') == 'block') {
                res = confirm('Do yoy really want to block?');
                if (res === false) {
                    return;
                }
            } else {
                res = confirm('Do yoy really want to unblock?');
                if (res === false) {
                    return;
                }
            }

            $.ajax({
                url: action,
                type: 'get',
                dataType: 'json',
                beforeSend: function () {
                    loader(1);
                },
                success: function (msg) {
                    loader(0);
                    if (msg.status == 0) {
                        Swal.fire({
                            position: 'center-center',
                            icon: 'success',
                            title: 'Success',
                            text: msg.msg,
                            showConfirmButton: false,
                            timer: 3000
                        });

                    } else {
                        Swal.fire({
                            position: 'center-center',
                            icon: 'success',
                            title: 'Success',
                            text: msg.msg,
                            showConfirmButton: false,
                            timer: 3000
                        });

                        roloadDatatble.ajax.reload(null, false);
                    }
                    setTimeout(function () {
                        $("#alert").css('display', 'none');
                    }, 5000);
                }
            });

        } else if (type == 'delete') {

            res = confirm('Do yoy really want to delete?');
            if (res === false) {
                return;
            }

            $.ajax({
                url: action,
                type: 'get',
                dataType: 'json',
                beforeSend: function () {
                    loader(1);
                },
                success: function (msg) {
                    loader(0);
                    if (msg.status == 0) {
                        Swal.fire({
                            position: 'center-center',
                            icon: 'warning',
                            title: 'Opps...!',
                            text: msg.msg,
                            showConfirmButton: false,
                            timer: 3000
                        });
                    } else {
                        Swal.fire({
                            position: 'center-center',
                            icon: 'success',
                            title: 'Success',
                            text: msg.msg,
                            showConfirmButton: false,
                            timer: 3000
                        });

                        roloadDatatble.ajax.reload(null, false);
                    }
                    setTimeout(function () {
                        $("#alert").css('display', 'none');
                    }, 5000);
                }
            });

        } else if (type == 'detail') {

            $('#con-detail-modal').modal('show');
            editData = JSON.parse($(this).attr('data-array'));

            $('#con-detail-modal #buttonType span').text(editData.btnFor);
            $('#con-detail-modal #btnBackColor span').text('rgba(' + editData.backColor + ')');
            $('#con-detail-modal #btnTextColor span').text('rgba(' + editData.textColor + ')');
            $('#con-detail-modal #btnHoverBackColor span').text('rgba(' + editData.backHoverColor + ')');
            $('#con-detail-modal #btnHoverTextColor span').text('rgba(' + editData.textHoverColor + ')');

            $('#con-detail-modal #btnDemo button')
                .css({
                    backgroundColor: 'rgba(' + editData.backColor + ')',
                    color: 'rgba(' + editData.textColor + ')'
                })
                .hover(function () {
                    $(this).css({
                        backgroundColor: 'rgba(' + editData.backHoverColor + ')',
                        color: 'rgba(' + editData.textHoverColor + ')'
                    });
                }, function () {
                    $(this).css({
                        backgroundColor: 'rgba(' + editData.backColor + ')',
                        color: 'rgba(' + editData.textColor + ')'
                    })
                })
                .find('span').text(editData.btnFor)
                .closest('div').find('i').attr('class', editData.btnIcon);

        } else {
            id = $('#con-edit-modal-table');
            id.modal('show');
            editData = JSON.parse($(this).attr('data-array'));
            id.find('#id').val(editData.id);
            id.find('#tableTypeEdit').val([editData.tableFor]).trigger('change');

            id.find('.tableDemo').attr('style', 'background-color:rgba(' + editData.backColor + ')');
            id.find('.tableDemo p').attr('style', 'color:rgba(' + editData.textColor + ')');
            id.find('.tableDemo #tableBackColor').val(editData.backColor);
            id.find('.tableDemo #tableTextColor').val(editData.textColor);

            id.find('.tableHoverDemo').attr('style', 'background-color:rgba(' + editData.backHoverColor + ')');
            id.find('.tableHoverDemo p').attr('style', 'color:rgba(' + editData.textHoverColor + ')');
            id.find('.tableHoverDemo #tableHoverBackColor').val(editData.backHoverColor);
            id.find('.tableHoverDemo #tableHoverTextColor').val(editData.textHoverColor);
        }
    });
    /*--========================= ( Customize Admin Apperance END ) =========================--*/







    /*--========================= ( Customize Admin START ) =========================--*/
    //---- ( Loader Save ) ----//
    $('#saveCustomizeLoaderForm').submit(function (event) {

        submitForm = $(this);
        submitBtn = $(this).find('#saveCustomizeLoaderBtn');

        event.preventDefault();
        $.ajax({
            url: $(this).attr('action'),
            data: new FormData(this),
            type: 'post',
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function () {
                loader(1);
                submitBtn.attr("disabled", "disabled").find('span').text('Please wait...');
            },
            success: function (msg) {
                loader(0);
                submitBtn.attr("disabled", false).find('span').text('save');

                submitForm.find("#loaderForErr, #htmlErr, #cssErr, #jsErr").text('');

                if (msg.status == 0) {
                    Swal.fire({
                        position: 'center-center',
                        icon: 'warning',
                        title: 'Opps....!',
                        text: msg.msg,
                        showConfirmButton: false,
                        timer: 3000
                    });

                    $.each(msg.errors.loaderFor, function (i) {
                        submitForm.find("#loaderForErr").text(msg.errors.loaderFor[i]);
                    });
                    $.each(msg.errors.html, function (i) {
                        submitForm.find("#htmlErr").text(msg.errors.html[i]);
                    });
                    $.each(msg.errors.css, function (i) {
                        submitForm.find("#cssErr").text(msg.errors.css[i]);
                    });
                    $.each(msg.errors.js, function (i) {
                        submitForm.find("#jsErr").text(msg.errors.js[i]);
                    });

                } else {
                    Swal.fire({
                        position: 'center-center',
                        icon: 'success',
                        title: 'Success',
                        text: msg.msg,
                        showConfirmButton: false,
                        timer: 3000
                    });

                    setTimeout(function () {
                        submitForm.find("[name~='loaderFor[]'], [name~='html'], [name~='css'], [name~='js']").val(['']).trigger('change');
                    }, 2000);

                    setTimeout(function () {
                        $('#customizeAdmin-pageLoader-listing').DataTable().ajax.reload(null, false);
                        $('#customizeAdmin-internalLoader-listing').DataTable().ajax.reload(null, false);
                    }, 1000);
                }
            }
        });
    });

    //---- ( Loader Update ) ----//
    $("#updateCustomizeLoaderForm").submit(function (event) {
        submitForm = $(this);
        submitBtn = $(this).find('#updateCustomizeLoaderBtn');

        event.preventDefault();
        $.ajax({
            url: $(this).attr('action'),
            data: new FormData(this),
            type: 'post',
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function () {
                loader(1);
                submitBtn.attr("disabled", "disabled").find('span').text('Please wait...');
            },
            success: function (msg) {
                loader(0);
                submitBtn.attr("disabled", false).find('span').text('save');

                submitForm.find("#loaderForErr, #htmlErr, #cssErr, #jsErr").text('');

                if (msg.status == 0) {
                    Swal.fire({
                        position: 'center-center',
                        icon: 'warning',
                        title: 'Opps....!',
                        text: msg.msg,
                        showConfirmButton: false,
                        timer: 3000
                    });

                    $.each(msg.errors.loaderFor, function (i) {
                        submitForm.find("#loaderForErr").text(msg.errors.loaderFor[i]);
                    });
                    $.each(msg.errors.html, function (i) {
                        submitForm.find("#htmlErr").text(msg.errors.html[i]);
                    });
                    $.each(msg.errors.css, function (i) {
                        submitForm.find("#cssErr").text(msg.errors.css[i]);
                    });
                    $.each(msg.errors.js, function (i) {
                        submitForm.find("#jsErr").text(msg.errors.js[i]);
                    });

                } else {
                    Swal.fire({
                        position: 'center-center',
                        icon: 'success',
                        title: 'Success',
                        text: msg.msg,
                        showConfirmButton: false,
                        timer: 3000
                    });

                    setTimeout(function () {
                        $('#customizeAdmin-pageLoader-listing').DataTable().ajax.reload(null, false);
                    }, 1000);
                }
            }
        });
    });

    //---- ( Loader Status, Delete ) ----//
    $('body').delegate('#customizeAdmin-pageLoader-listing .actionDatatable, #customizeAdmin-internalLoader-listing .actionDatatable', 'click', function () {
        var type = $(this).attr('data-type'),
            res = '',
            action = $(this).attr('data-action'),
            roloadDatatble = $('#customizeAdmin-pageLoader-listing, #customizeAdmin-internalLoader-listing').DataTable(),
            id = '';

        if (type == 'status') {

            if ($(this).attr('data-status') == 'block') {
                res = confirm('Do yoy really want to block?');
                if (res === false) {
                    return;
                }
            } else {
                res = confirm('Do yoy really want to unblock?');
                if (res === false) {
                    return;
                }
            }

            $.ajax({
                url: action,
                type: 'get',
                dataType: 'json',
                beforeSend: function () {
                    loader(1);
                },
                success: function (msg) {
                    loader(0);
                    if (msg.status == 0) {
                        Swal.fire({
                            position: 'center-center',
                            icon: 'success',
                            title: 'Success',
                            text: msg.msg,
                            showConfirmButton: false,
                            timer: 3000
                        });
                    } else {
                        Swal.fire({
                            position: 'center-center',
                            icon: 'success',
                            title: 'Success',
                            text: msg.msg,
                            showConfirmButton: false,
                            timer: 3000
                        });

                        roloadDatatble.ajax.reload(null, false);
                    }
                    setTimeout(function () {
                        $("#alert").css('display', 'none');
                    }, 5000);
                }
            });

        } else if (type == 'delete') {

            res = confirm('Do yoy really want to delete?');
            if (res === false) {
                return;
            }

            $.ajax({
                url: action,
                type: 'get',
                dataType: 'json',
                beforeSend: function () {
                    loader(1);
                },
                success: function (msg) {
                    loader(0);
                    if (msg.status == 0) {
                        Swal.fire({
                            position: 'center-center',
                            icon: 'warning',
                            title: 'Opps....!',
                            text: msg.msg,
                            showConfirmButton: false,
                            timer: 3000
                        });
                    } else {
                        Swal.fire({
                            position: 'center-center',
                            icon: 'success',
                            title: 'Success',
                            text: msg.msg,
                            showConfirmButton: false,
                            timer: 3000
                        });

                        roloadDatatble.ajax.reload(null, false);
                    }
                    setTimeout(function () {
                        $("#alert").css('display', 'none');
                    }, 5000);
                }
            });

        } else if (type == 'detail') {} else {}
    });
    /*--========================= ( Customize Loader END ) =========================--*/
});
