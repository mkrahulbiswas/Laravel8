$('document').ready(function () {

    /*--========================= ( Puja List START ) =========================--*/
    $('.DDDPujaZone, #DDDPujaZone').change(function () {

        var html = '<option value="">Select Sub Zone</option>';
        $('.DDDPujaSubZone, #DDDPujaSubZone').text('');
        if ($(this).val() == '') {
            $('.DDDPujaSubZone, #DDDPujaSubZone').append(html);
        } else {
            $.ajax({
                url: $(this).attr('data-action') + '/' + $(this).val(),
                type: 'get',
                dataType: 'json',
                beforeSend: function () {
                    $("#loader").css("display", 'block');
                },
                success: function (msg) {
                    $("#loader").css("display", 'none');
                    if (msg.status == 0) {
                        $('.DDDPujaSubZone, #DDDPujaSubZone').append(html);
                    } else {
                        $.each(msg.data, function (key, value) {
                            html += '<option value="' + value['id'] + '">' + value['subZoneName'] + '</option>'
                        });
                        $('.DDDPujaSubZone, #DDDPujaSubZone').append(html);
                    }
                }
            });
        }
    });
    /*--========================= ( Puja List END ) =========================--*/
    
});
