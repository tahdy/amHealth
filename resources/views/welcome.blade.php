<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- Mobile Metas -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="viewport" content="initial-scale=1, maximum-scale=1">
        <!-- Site Metas -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>AmHealth</title>
        <meta name="keywords" content="">
        <meta name="description" content="">
        <meta name="author" content="">
        <!-- Favicons -->
        <link href="{{asset('img/favicon.png')}}" rel="icon">
        <link href="{{asset('images/apple-touch-icon.png')}}" rel="apple-touch-icon">

        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

        <!-- Vendor CSS Files -->
        <link href="{{asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet">
        <link href="{{asset('vendor/animate.css/animate.min.css')}}" rel="stylesheet">
        <link href="{{asset('vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
        <link href="{{asset('vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
        <link href="{{asset('vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
        <link href="{{asset('vendor/glightbox/css/glightbox.min.css')}}" rel="stylesheet">
        <link href="{{asset('vendor/remixicon/remixicon.css')}}" rel="stylesheet">
        <link href="{{asset('vendor/swiper/swiper-bundle.min.css')}}" rel="stylesheet">

        <!-- Template Main CSS File -->
        <link href="{{asset('css/style.css')}}" rel="stylesheet">


       <style href="{{ mix('css/app.css') }}">

       </style>
        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>

        @if (Auth::check())
            <script>
                window.Laravel = {!!json_encode([
            'isLoggedin' => true,
            'user' => Auth::user()
        ])!!}
            </script>
        @else
            <script>
                window.Laravel = {!!json_encode([
            'isLoggedin' => false
        ])!!}
            </script>
        @endif
        <script>
            window._locale = '{{ app()->getLocale() }}';
            window._translations = {!! cache('translations') !!};
        </script>
    </head>
    <body  class="clinic_version antialiased">

                <div id="app">

                </div>
    </body>
    <script src="{{ mix('js/app.js') }}"></script>

    <!-- Vendor JS Files -->
    <script src="{{asset('vendor/purecounter/purecounter_vanilla.js')}}"></script>
    <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('vendor/glightbox/js/glightbox.min.js')}}"></script>
    <script src="{{asset('vendor/swiper/swiper-bundle.min.js')}}"></script>
    <script src="{{asset('vendor/php-email-form/validate.js')}}"></script>

    <!-- Template Main JS File -->
    <script src="{{asset('js/main.js')}}"></script>
</html>
