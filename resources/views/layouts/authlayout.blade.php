<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<html lang="en">
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>G.B.Convent</title>
    <link rel="shortcut icon" href="{{url('/')}}/assets/image/favicon.svg" type="image/x-icon">
    <link href="{{url('/')}}/assets/css/global.css" rel="stylesheet">
</head>
<body>
    @yield('content')
     <script src="{{url('/')}}/assets/js/jquery-3.5.1.min.js"></script>
       <script src="{{url('/')}}/assets/js/bootstrap.min.js"></script>
    <script src="{{url('/')}}/assets/js/validate.js"></script>
    <script type="text/javascript" src="{{url('/')}}/assets/js/sweetalert.min.js"></script>
    <script>
        function swalAlert(type, message) {
                        Swal.fire({
                        position: 'top-end',
                        icon: type,
                        title: message,
                        showConfirmButton: false,
                        timer: 1500,
                        })
                }
                </script>
                   @if(Session::has('success'))
    <script>
      swalAlert('success',"{{ Session::get('success') }}");
    </script>
    @endif
    @if(Session::has('error'))
    <script>
      swalAlert('error',"{{ Session::get('error') }}");
    </script>
    @endif

    @yield('additionalscripts')