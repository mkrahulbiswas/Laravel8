$(document).ready(function () {

    /*------Gallery Model View------*/
    $('.autograph_boximage').click(function(){
        $('#myModal .modal-title').text($(this).children('a').attr('data-name'));
        $('#myModal .autograph_image img:nth-child(1)').attr('src', $(this).children('a').attr('data-image'));
        $('#myModal .autograph_image img:nth-child(2)').attr('src', $(this).children('a').attr('data-signature'));

        $('#myModal .born').html('<strong>Born :  </strong>' + $(this).children('a').attr('data-born'));
        $('#myModal .place').html('<strong>Birth Place :  </strong>' + $(this).children('a').attr('data-place'));
        $('#myModal .achivement').html($(this).children('a').attr('data-achivement'));
        $('#myModal .description').html('<strong>NOTE:  </strong>' + $(this).children('a').attr('data-description'));
    });
});
