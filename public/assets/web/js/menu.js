$(document).ready(function () {	
	var responsiveMenu = $("#menu").html();
	$('body').prepend("<div id='responsiveMenu'><p><span>Menu</span> <a href='javascript:void(0)' class='menuClose'></a></p>" + responsiveMenu + "</div>")
	
	$('#menu').prepend("<a href='javascript:void(0)' class='menuDown'><span>Menu</span></a>");
	
	
	$('#responsiveMenu ul li').each(function(index) {
		if ($(this).find('ul').length > 0) {
			$(this).append('<a href="javascript:void(0)" class="downarrow"></a>');
		}
		else {
			$(this).append('');
		}
	});
    $(".downarrow").click(function () {
		$(this).parent().find('ul:eq(0)').slideToggle();
		$(this).parent().addClass('selected');
    });
	

	/*************************************** main menu *******************************/
	$('#menu > ul > li').each(function(index) {
		if ($(this).find('ul').length > 0) {
			$(this).append('<span class="downarrow"></span>');
		}
		else {
			$(this).append('');
		}
	});
	$('#menu ul li ul li').each(function(index) {
		if ($(this).find('ul').length > 0) {
			$(this).append('<span class="rightarrow"></span>');
		}
		else {
			$(this).append('');
		}
	});
	
    $("#menu > ul > li").hover(function () {
        //var itemheight = $(this).height(); /* Getting the LI width */
        $(this).children("ul:eq(0)").slideDown(250);
        $(this).children("a:eq(0)").addClass('selected');
    }, function () {
        $(this).find("ul").slideUp(100); /* fading out the sub menu */
        $(this).children("a").removeClass('selected');
    });
    $("#menu li li").hover(function () {
        $(this).children("a:eq(0)").addClass('selected');
        $(this).children("ul:eq(0)").slideDown(250);
    }, function () {
        $(this).find("ul").slideUp(100); /* fading out the sub menu */
        $(this).children("a").removeClass('selected');
    });
	
	/*****************************************************************************************/
//	$('.responsivemenu ul li').each(function(index) {
//		if ($(this).find('ul').length > 0) {
//			$(this).append('<span class="downarrow"></span>');
//		}
//		else {
//			$(this).append('');
//		}
//	});
	
    $("#menu .menuDown").click(function () {
		$("#responsiveMenu").fadeIn(0).animate({marginTop:0, opacity:1}, 200);
    });
    $("#responsiveMenu .menuClose").click(function () {
		$("#responsiveMenu ").animate({marginTop:50, opacity:0}, 200).fadeOut(0);
    });
	
	$('#responsiveMenu li a').click(function(){
    $('#responsiveMenu').hide();
});
		
		
	$("#topMenu").find("ul li").addClass('hiddenNav');
	
	var topNav = $("#topMenu").find("ul").html();
	$("#menu > ul").append(topNav);
	
	/*****************************************************/
	$('img.facebook, img.rss').on('mouseover', function() {
		$(this).animate({height:80, marginLeft:'-13px'}, 300);
	});
	$('img.facebook, img.rss').on('mouseout', function() {
		$(this).animate({height:54, marginLeft:'0'}, 300);
	});
	$('img.twitter').on('mouseover', function() {
		$(this).animate({height:80, marginLeft:'-40px'}, 300);
	});
	$('img.twitter').on('mouseout', function() {
		$(this).animate({height:54, marginLeft:'-27px'}, 300);
	});
	
	var windowSize = $(window).width();
	if (windowSize <= 800) {
		var cont = $('.contactWith').html();
		$('.footerBox:eq(3)').after('<div class="contactWithIpd"></div>');
		$('.contactWith').fadeOut(0);
		$('.contactWithIpd').prepend(cont);
		$('.contactWithIpd').addClass('contactWith');
	}
	
	$('.rightBox_1:eq(0)').css({'margin-top': '15px'});
});

$(window).scroll(function() {
	if($(this).scrollTop() > 250) {
		$('#menu').addClass('menuScroll');	
		//$('.menu .menuDown').fadeIn();	
	} 
	else{
		$('#menu').removeClass('menuScroll');
	}
});