<!DOCTYPE html>
<html>

    <head>
        @include('web.includes.head')
    </head>


    <body class="fixed-left">

        @include('web.includes.header')

        @yield('content')

        @include('web.includes.footer')
        
        @include('web.includes.foot')

    </body>


</html>
