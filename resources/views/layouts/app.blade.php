<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta content="" name="author" />
    <!--[if IE]>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <![endif]-->
    <!-- GLOBAL STYLES -->
    <!-- PAGE LEVEL STYLES -->
    <link rel="stylesheet" href="{{asset('assets/plugins/bootstrap/css/bootstrap.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/css/login.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/plugins/magic/magic.css')}}" />

    <link rel="stylesheet" href="{{asset('assets/css/main.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/css/theme.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/css/MoneAdmin.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/plugins/Font-Awesome/css/font-awesome.css')}}" />
    <!-- END PAGE LEVEL STYLES -->
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    @yield('content')

    <script src="{{asset('assets/plugins/jquery-2.0.3.min.js')}}"></script>
    <script src="{{asset('assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/plugins/modernizr-2.6.2-respond-1.1.0.min.js')}}"></script>
    <!-- PAGE LEVEL SCRIPTS -->
    <script src="{{asset('assets/js/login.js')}}"></script>
    <script src="{{asset('assets/plugins/validationengine/js/jquery.validationEngine.js')}}"></script>
    <script src="{{asset('assets/plugins/validationengine/js/languages/jquery.validationEngine-en.js')}}"></script>
    <script src="{{asset('assets/plugins/jquery-validation-1.11.1/dist/jquery.validate.min.js')}}"></script>
    <script src="{{asset('assets/js/validationInit.js')}}"></script>
    <script>
        $(function () { formValidation(); });
    </script>
    <!--END PAGE LEVEL SCRIPTS -->
</body>
</html>
