<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="{{asset('assets/web/js/jquery.js')}}"></script>
<script src="{{asset('assets/web/js/custom.js')}}"></script>
<script src="{{asset('assets/web/js/bootstrap.js')}}"></script>
<script src="{{asset('assets/web/js/menu.js')}}"></script>
<script src="{{asset('assets/web/js/wow.js')}}"></script>

<!-- ( Sweet Alart 2 ) -->
<script src="{{asset('assets/web/plugins/sweet-alert2/sweetalert2.min.js')}}"></script>
<link href="{{asset('assets/web/plugins/sweet-alert2/sweetalert2.min.css')}}" rel="stylesheet">
<script src="{{asset('assets/web/plugins/sweet-alert2/sweetalert.min.js')}}"></script>


<script src="{{asset('assets/web/ajax/custom_ajax.js')}}"></script>
<script src="{{asset('assets/web/ajax/datatable.ajax.js')}}"></script>

<script src="https://kit.fontawesome.com/18fe14b833.js" crossorigin="anonymous"></script>


<script>
    $(function () {
        var shrinkHeader = 100;
        $(window).scroll(function () {
            var scroll = getCurrentScroll();
            if (scroll >= shrinkHeader) {
                $('.header').addClass('shrink');
            } else {
                $('.header').removeClass('shrink');
            }
        });
    });
</script>



<!-- Google Rechap -->
<script src="https://www.google.com/recaptcha/api.js"></script>
