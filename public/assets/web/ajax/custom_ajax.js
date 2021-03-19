$('document').ready(function () {
    var pathArray = window.location.pathname.split('/');

    if (location.hostname === "localhost") {
        // var baseUrl = "http://localhost/LARAVEL/project/Balvika/admin";
        var baseUrl = "http://localhost/Balvika/admin/";
    } else if (location.hostname === "192.168.0.126") {
        var baseUrl = "http://192.168.0.126/Balvika/admin/";
    } else if (location.hostname === "intelligentappsolutionsdemo.com") {
        var baseUrl = 'http://intelligentappsolutionsdemo.com/current-project/website/Balvika/admin/';
    }



    //////////////////////////////////////


    //----Contact Enquiry----//
    $("#saveContactForm").submit(function (event) {
        event.preventDefault();
        $.ajax({
            url: $(this).attr('action'),
            data: $(this).serializeArray(),
            type: $(this).attr('method'),
            dataType: 'json',
            beforeSend: function () {
                $("#saveContactButton").attr("disabled", "disabled").text('Please wait...');
            },
            success: function (msg) {

                $("#name_err").text('');
                $("#email_err").text('');
                $("#phone_err").text('');
                $("#message_err").text('');

                if (msg.status == 0) {
                    $("#saveContactButton").attr("disabled", false).text('submit');

                    $("#saveContactForm").find("#alert").removeClass("alert-success").addClass("alert-danger");
                    $("#saveContactForm").find("#alert").css("display", "block");
                    $("#saveContactForm").find("#validationAlert").html(msg.msg);

                    $.each(msg.errors.name, function (i) {
                        $("#name_err").text(msg.errors.name[i]);
                    });
                    $.each(msg.errors.email, function (i) {
                        $("#email_err").text(msg.errors.email[i]);
                    });
                    $.each(msg.errors.phone, function (i) {
                        $("#phone_err").text(msg.errors.phone[i]);
                    });
                    $.each(msg.errors.message, function (i) {
                        $("#message_err").text(msg.errors.message[i]);
                    });
                } else {
                    $("#saveContactForm").find("#alert").removeClass("alert-danger").addClass("alert-success");
                    $("#saveContactForm").find("#alert").css("display", "block");
                    $("#saveContactForm").find("#validationAlert").html(msg.msg);

                    $("#saveContactButton").attr("disabled", false).text('submit');

                    setTimeout(function () {
                        $("#saveContactForm").find("#alert").css('display', 'none');
                        $('#saveSubjectModal').modal('hide');
                    }, 1000);

                    $('#saveContactForm')[0].reset();

                    Swal.fire({
                        position: 'center-center',
                        icon: 'success',
                        title: 'We are received you messege!',
                        showConfirmButton: false,
                        timer: 3000
                    });
                }
            }
        });
    });


    //----Members Enquiry----//
    $("#saveMemberForm").submit(function (event) {
        event.preventDefault();
        $.ajax({
            url: $(this).attr('action'),
            data: $(this).serializeArray(),
            type: $(this).attr('method'),
            dataType: 'json',
            beforeSend: function () {
                $("#saveMemberButton").attr("disabled", "disabled").text('Please wait...');
            },
            success: function (msg) {

                $("#name_err").text('');
                $("#email_err").text('');
                $("#phone_err").text('');
                $("#message_err").text('');

                if (msg.status == 0) {
                    $("#saveMemberButton").attr("disabled", false).text('submit');

                    $("#saveMemberForm").find("#alert").removeClass("alert-success").addClass("alert-danger");
                    $("#saveMemberForm").find("#alert").css("display", "block");
                    $("#saveMemberForm").find("#validationAlert").html(msg.msg);

                    $.each(msg.errors.name, function (i) {
                        $("#name_err").text(msg.errors.name[i]);
                    });
                    $.each(msg.errors.email, function (i) {
                        $("#email_err").text(msg.errors.email[i]);
                    });
                    $.each(msg.errors.phone, function (i) {
                        $("#phone_err").text(msg.errors.phone[i]);
                    });
                    $.each(msg.errors.message, function (i) {
                        $("#message_err").text(msg.errors.message[i]);
                    });
                } else {
                    $("#saveMemberForm").find("#alert").removeClass("alert-danger").addClass("alert-success");
                    $("#saveMemberForm").find("#alert").css("display", "block");
                    $("#saveMemberForm").find("#validationAlert").html(msg.msg);

                    $("#saveMemberButton").attr("disabled", false).text('submit');

                    setTimeout(function () {
                        $("#saveMemberForm").find("#alert").css('display', 'none');
                        $('#saveSubjectModal').modal('hide');
                    }, 1000);

                    $('#saveMemberForm')[0].reset();

                    Swal.fire({
                        position: 'center-center',
                        icon: 'success',
                        title: 'We are received you messege!',
                        showConfirmButton: false,
                        timer: 3000
                    });
                }
            }
        });
    });


    //----Gallery Search----//
    $('#GallerySearch').keyup(function () {
        $.ajax({
            url: $(this).closest('form').attr('action'),
            data: $(this).closest('form').serializeArray(),
            type: $(this).closest('form').attr('method'),
            dataType: 'json',
            beforeSend: function () {

            },
            success: function (msg) {
                if (msg.status == 1) {
                    $('#SearchResult').html('');
                    $.each(msg.data, function (i) {
                        $('#SearchResult').append('<div class="SearchCommon"><a href="' + msg.data[i]['href'] + '/' + msg.data[i]['category'] + '/' + msg.data[i]['slug'] + '"><div class="Left"><img src="' + msg.data[i]['image'] + '" alt=""></div><div class="Right"><p>' + msg.data[i]['name'] + '</p></div></a></div>');
                    });
                } else {
                    $('#SearchResult').html('');
                }
            }
        });
    });

    $('.submit_search').click(function(){
        var ValOfSearch = $('#GallerySearch').val();
        if(ValOfSearch == '' || ValOfSearch == null){
            $('#GallerySearch').focus();
        } else {
            
        }
    });


});
