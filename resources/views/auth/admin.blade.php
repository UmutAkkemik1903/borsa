<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>Yönetici Paneli</title>



    <link rel="stylesheet" href="{{ mix('/css/app.css')}} ">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="keywords" content="bootstrap, bootstrap admin template, admin theme, admin dashboard, dashboard template, admin template, responsive" />
    <meta name="author" content="Codedthemes" />
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700" rel="stylesheet">
    <link rel="stylesheet" href="asset/pages/waves/css/waves.min.css" type="text/css" media="all">
    <link rel="stylesheet" type="text/css" href="asset/css/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="asset/pages/waves/css/waves.min.css" type="text/css" media="all">
    <link rel="stylesheet" type="text/css" href="asset/icon/themify-icons/themify-icons.css">
    <link rel="stylesheet" type="text/css" href="asset/css/font-awesome-n.min.css">
    <link rel="stylesheet" type="text/css" href="asset/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="asset/css/jquery.mCustomScrollbar.css">
    <link rel="stylesheet" type="text/css" href="asset/css/style.css">
</head>

<body>
<!-- Pre-loader start -->
<div id="app"></div>
<script src="{{ mix('/js/app.js') }}"></script>

<script src="{{ URL::asset('asset/js/jquery/jquery.min.js')}}"></script>
<script src="{{ URL::asset('asset/js/jquery-ui/jquery-ui.min.js ')}}"></script>
<script src="{{ URL::asset('asset/js/popper.js/popper.min.js')}}"></script>
<script src="{{ URL::asset('asset/js/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{ URL::asset('asset/pages/waves/js/waves.min.js')}}"></script>
<script src="{{ URL::asset('asset/js/jquery-slimscroll/jquery.slimscroll.js')}}"></script>
<script src="{{ URL::asset('asset/js/jquery.mCustomScrollbar.concat.min.js')}}"></script>
<script src="{{ URL::asset('asset/js/pcoded.min.js')}}"></script>
<script src="{{ URL::asset('asset/js/vertical/vertical-layout.min.js ')}}"></script>
<script src="{{ URL::asset('asset/js/script.js ')}}"></script>

</body>
</html>





