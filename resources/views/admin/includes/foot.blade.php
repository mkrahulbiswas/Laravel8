<script>
    var resizefunc = [];
</script>
<script src="{{asset('assets/admin/js/jquery.min.js')}}"></script>
<script src="{{asset('assets/admin/js/popper.min.js')}}"></script>

{{-- <script src="{{asset('assets/plugins/bootstrap/v5/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/plugins/bootstrap/v5/js/bootstrap.esm.min.js')}}"></script>
<script src="{{asset('assets/plugins/bootstrap/v5/js/bootstrap.bundle.min.js')}}"></script> --}}
<script src="{{asset('assets/plugins/bootstrap/v4/js/bootstrap.min.js')}}"></script>

<script src="{{asset('assets/admin/js/detect.js')}}"></script>
<script src="{{asset('assets/admin/js/fastclick.js')}}"></script>
<script src="{{asset('assets/admin/js/jquery.slimscroll.js')}}"></script>
<script src="{{asset('assets/admin/js/jquery.blockUI.js')}}"></script>
<script src="{{asset('assets/admin/js/waves.js')}}"></script>
<script src="{{asset('assets/admin/js/wow.min.js')}}"></script>
<script src="{{asset('assets/admin/js/jquery.nicescroll.js')}}"></script>
<script src="{{asset('assets/admin/js/jquery.scrollTo.min.js')}}"></script>
<script src="{{asset('assets/admin/js/jquery.core.js')}}"></script>
<script src="{{asset('assets/admin/js/jquery.app.js')}}"></script>


<!-- ( Sweet Alart 2 ) -->
<script src="{{asset('assets/plugins/sweet-alert2/sweetalert2.min.js')}}"></script>
{{-- <script src="{{asset('assets/web/plugins/sweet-alert2/sweetalert.min.js')}}"></script> --}}

<!-- ( Jquery Toast ) -->
<script src="{{asset('assets/plugins/toast/jquery.toast.min.js')}}"></script>


@if ($checkOne == 'loginPage')

    <!-- Custom JS -->
    <script src="{{asset('assets/admin/custom_js/custom_login.js')}}"></script>

    <!--Custom Ajax-->
    <script src="{{asset('assets/admin/ajax/custom_ajax_login.js')}}"></script>

@else

    <!--For Dashboard-->
    <script src="{{asset('assets/plugins/peity/jquery.peity.min.js')}}"></script>

    <script src="{{asset('assets/plugins/waypoints/lib/jquery.waypoints.min.js')}}"></script>
    <script src="{{asset('assets/plugins/counterup/jquery.counterup.min.js')}}"></script>

    <script src="{{asset('assets/plugins/morris/morris.min.js')}}"></script>
    <script src="{{asset('assets/plugins/raphael/raphael-min.js')}}"></script>

    <script src="{{asset('assets/plugins/jquery-knob/jquery.knob.js')}}"></script>

    <script src="{{asset('assets/admin/pages/jquery.dashboard.js')}}"></script>

    <script src="https://kit.fontawesome.com/18fe14b833.js" crossorigin="anonymous"></script>
    <!--End-->

    <!-- Required datatable js -->
    <script src="{{asset('assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
    <!-- Buttons examples -->
    <script src="{{asset('assets/plugins/datatables/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatables/buttons.bootstrap4.min.js')}}"></script>
    <!-- <script src="{{asset('assets/plugins/datatables/jszip.min.js')}}"></script> -->
    <script src="{{asset('assets/plugins/datatables/pdfmake.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatables/vfs_fonts.js')}}"></script>
    <script src="{{asset('assets/plugins/datatables/buttons.html5.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatables/buttons.print.min.js')}}"></script>

    <!-- Key Tables -->
    <script src="{{asset('assets/plugins/datatables/dataTables.keyTable.min.js')}}"></script>

    <!-- Responsive examples -->
    <script src="{{asset('assets/plugins/datatables/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatables/responsive.bootstrap4.min.js')}}"></script>

    <!-- Selection table -->
    <script src="{{asset('assets/plugins/datatables/dataTables.select.min.js')}}"></script>


    <!-- Notify -->
    <script src="{{asset('assets/plugins/notifyjs/js/notify.js')}}"></script>
    <script src="{{asset('assets/plugins/notifications/notify-metro.js')}}"></script>

    <!-- Validation -->
    <script type="text/javascript" src="{{asset('assets/plugins/parsleyjs/parsley.min.js')}}"></script>

    <!--Check Box Js-->
    <script src="{{asset('assets/plugins/switchery/js/switchery.min.js')}}"></script>
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <!-- <script type="text/javascript" src="{{asset('assets/admin/pages/jquery.form-advanced.init.js')}}"></script> -->
    <!-- <script src="{{asset('assets/admin/js/jquery.core.js')}}"></script> -->


    <!-- Dropify -->
    <script type="text/javascript" src="{{asset('assets/plugins/dropify/js/dropify.min.js')}}"></script>
    <script src="{{asset('assets/admin/js/dropify.js')}}"></script>

    <!--Multi Tag JS-->
    <script src="{{asset('assets/plugins/bootstrap-tagsinput/js/bootstrap-tagsinput.min.js')}}"></script>

    <!--Boostrap select dropdown-->
    <script src="{{asset('assets/plugins/bootstrap-select/js/bootstrap-select.min.js')}}" type="text/javascript">
    </script>

    <!--Select2-->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

    <!--Date Time Picker-->
    <script src="{{asset('assets/plugins/moment/moment.js')}}"></script>
    <script src="{{asset('assets/plugins/timepicker/bootstrap-timepicker.js')}}"></script>
    <script src="{{asset('assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js')}}"></script>
    <script src="{{asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>
    <script src="{{asset('assets/plugins/clockpicker/js/bootstrap-clockpicker.min.js')}}"></script>
    <script src="{{asset('assets/plugins/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>


    <!-- Date Time Picker Init -->
    <script src="{{asset('assets/admin/pages/jquery.form-pickers.init.js')}}"></script>

    <!--Summernote Editor-->
    <script src="{{asset('assets/plugins/summernote/summernote-bs4.min.js')}}"></script>

    <!-- Custom JS -->
    <script src="{{asset('assets/admin/custom_js/custom.js')}}"></script>
    <script src="{{asset('assets/admin/custom_js/model_validation_error_remove.js')}}"></script>
    <script src="{{asset('assets/admin/custom_js/color_picker.js')}}"></script>
    <script src="{{asset('assets/admin/custom_js/select_two.js')}}"></script>
    <script src="{{asset('assets/admin/custom_js/editor.js')}}"></script>

    <!-- Custom Ajax -->
    <script src="{{asset('assets/admin/ajax/datatable_ajax.js')}}"></script>
    <script src="{{asset('assets/admin/ajax/custom_ajax.js')}}"></script>
    <script src="{{asset('assets/admin/ajax/filter_ajax.js')}}"></script>
    <script src="{{asset('assets/admin/ajax/ddd_ajax.js')}}"></script>

    <!-- LC Switch -->
    <script type="text/javascript" src="{{asset('assets/plugins/LC-switch-master/lc_switch.js')}}"></script>

    <!--for show image gallary-->
    <script type="text/javascript" src="{{asset('assets/plugins/isotope/js/isotope.pkgd.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/plugins/magnific-popup/js/jquery.magnific-popup.min.js')}}">
    </script>

    <!-- XEditable Plugin used in booking details page -->
    <script type="text/javascript" src="{{asset('assets/plugins/x-editable/js/bootstrap-editable.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/admin/pages/jquery.xeditable.js')}}"></script>


    <!-- XEditable Plugin used in booking details page -->
    <script type="text/javascript" src="{{asset('assets/plugins/zoom/zoom.js')}}"></script>

    <!-- Picker-Keep Color Picker js -->
    <script type="text/javascript" src="{{asset('assets/plugins/pickrKeep-colourPicker/js/pickr.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/plugins/pickrKeep-colourPicker/js/pickr.es5.min.js')}}"></script>

    {{-- <script src="https://cdn.jsdelivr.net/npm/@simonwep/pickr/dist/pickr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@simonwep/pickr/dist/pickr.es5.min.js"></script> --}}



    <!--for show image gallary-->
    <script type="text/javascript">
        $(window).on('load', function () {
            var $container = $('.portfolioContainer');
            $container.isotope({
                filter: '*',
                animationOptions: {
                    duration: 750,
                    easing: 'linear',
                    queue: false
                }
            });

            $('.portfolioFilter a').click(function () {
                $('.portfolioFilter .current').removeClass('current');
                $(this).addClass('current');

                var selector = $(this).attr('data-filter');
                $container.isotope({
                    filter: selector,
                    animationOptions: {
                        duration: 750,
                        easing: 'linear',
                        queue: false
                    }
                });
                return false;
            });
        });
        
        $(document).ready(function () {
            $('.image-popup').magnificPopup({
                type: 'image',
                closeOnContentClick: true,
                mainClass: 'mfp-fade',
                gallery: {
                    enabled: true,
                    navigateByImgClick: true,
                    preload: [0, 1] // Will preload 0 - before current, and 1 after the current image
                }
            });
        });
    </script>
    <!--End-->

    <script>
        $('.multi-field-wrapper').each(function () {
            var $wrapper = $('.multi-fields', this);
            $(".add-field", $(this)).click(function (e) {
                $('.multi-field:first-child', $wrapper).clone(true).appendTo($wrapper).find('input').val('').focus();
            });
            $('.multi-field .remove-field', $wrapper).click(function () {
                if ($('.multi-field', $wrapper).length > 1) $(this).parent('.multi-field').remove();
            });
        });
    </script>



    

    <!--For Dashboard-->
    <script type="text/javascript">
        jQuery(document).ready(function ($) {
            $('.counter').counterUp({
                delay: 100,
                time: 1200
            });

            $(".knob").knob();

        });
    </script>


    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>


    <script>
        $(document).ready(function () {

            $('.PermiAll').click(function () {
                $('#CheckAll').trigger('click');
            });

            $('.checkbox').lc_switch();

            $('#CheckAll').change(function () {
                if ($(this).prop("checked") == true) {
                    $('.checkbox').lcs_on();
                    $('.checkbox').val(1);
                } else if ($(this).prop("checked") == false) {
                    $('.checkbox').val(0);
                    $('.checkbox').lcs_off();
                }
            });

            $('.lcs_switch').click(function () {
                var val = $(this).closest('.lcs_wrap').find('.checkbox').val();
                if (val == 1) {
                    $(this).closest('.lcs_wrap').find('.checkbox').val(0);
                } else {
                    $(this).closest('.lcs_wrap').find('.checkbox').val(1);
                }
            });

        });
    </script>
    
@endif