@php
    $urlArray = explode('/', url()->current());
    $x = 0; $count = 0;
    foreach ($urlArray as $key => $value) {
        $x = (($value == 'admin') ? ($x+1) : $x);
        $count = (($x >= 1) ? ($count+1) : 0);
    }
    $checkFor = ($count >= 2) ? 'dashboardPage' : 'loginPage';
@endphp


<!DOCTYPE html>
<html>

    <head>
        @include('admin.includes.head', ['checkOne' => $checkFor])
    </head>

    @if ($count >= 2)

        <body class="fixed-left">
            
            <!------ ( Loader Content Start ) ------>
            @include('admin.includes.dynamic_html_css_js', ['checkOne' => $checkFor, 'checkTwo' => 'loader'])
            <!------ ( Loader Content End ) ------>
            

            <!--== ( Wrapper Start ) ==-->
            <div id="wrapper">

                <!------ ( Header Start ) ------>
                    @include('admin.includes.header')
                <!------ ( Header End ) ------>


                <!------ ( Side-Bar Start ) ------>
                    @include('admin.includes.sidebar')
                <!------ ( Side-Bar End ) ------>



                <!------ ( Content Start ) ------>
                <div class="content-page">
                    <div class="content">
                        @include('admin.includes.dynamic_html_css_js', ['checkOne' => $checkFor, 'checkTwo' => 'alertMessage'])
                        <div class="container-fluid">
                            @yield('content')
                        </div>
                    </div>
                    @include('admin.includes.footer')
                </div>
                <!------ ( Content End ) ------>



            </div>
            <!--== ( Wrapper End ) ==-->

            @include('admin.includes.foot', ['checkOne' => 'dashboardPage'])
            @include('admin.includes.dynamic_html_css_js', ['checkOne' => $checkFor, 'checkTwo' => 'cssJs'])

        </body>

    @else
    
        <body>
            
            <!------ ( Loader Content Start ) ------>
            @include('admin.includes.dynamic_html_css_js', ['checkOne' => $checkFor, 'checkTwo' => 'loader'])
            <!------ ( Loader Content End ) ------>
            

            <!------ ( Alert Message Start ) ------>
            @include('admin.includes.dynamic_html_css_js', ['checkOne' => $checkFor, 'checkTwo' => 'alertMessage'])>
            <!------ ( Alert Message End ) ------>


            <!------ ( Content Start ) ------>
            @yield('content')
            <!------ ( Content End ) ------>


            @include('admin.includes.foot', ['checkOne' => 'loginPage'])
            @include('admin.includes.dynamic_html_css_js', ['checkOne' => $checkFor, 'checkTwo' => 'cssJs'])

        </body>

    @endif

</html>