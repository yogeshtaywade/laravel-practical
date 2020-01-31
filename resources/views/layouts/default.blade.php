<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') | Laravel</title>

    <!-- Bootstrap -->
    <link href="{{ asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ asset('css/font-awesome.min.css')}}" rel="stylesheet" type='text/css'>
    <!-- NProgress -->
    <link href="{{ asset('css/nprogress.css')}}" rel="stylesheet">
    
    
    @yield('styles')
    <!-- Custom Theme Style -->
    <link href="{{ asset('css/custom.min.css')}}" rel="stylesheet">
    <!-- Custom Style  Style -->
    <link href="{{ asset('css/style.css')}}" rel="stylesheet">

  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          @include('layouts.navigation')
          
        </div>

        <!-- top navigation -->
        <div class="top_nav">
             @include('layouts.header')
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          @yield('content')
        </div>
        <!-- /page content -->

        <!-- footer content -->
          @include('layouts.footer')
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="{{ asset('js/jquery.min.js')}}"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('js/bootstrap.min.js')}}"></script>
    <!-- bootstrap-progressbar -->
    <script src="{{ asset('js/bootstrap-progressbar.min.js')}}"></script>
     <!-- NProgress -->
    <script src="{{ asset('js/nprogress.js')}}"></script>
    

    @yield('js')

    <!-- Alert Message -->
    <script>
          $(document).ready (function(){
                          $("#success-alert").fadeTo(2000, 1500).slideUp(1500, function(){
                            $("#success-alert").slideUp(1500);
                          }); 

                            $("#danger-alert").fadeTo(2000, 1500).slideUp(1500, function(){
                            $("#danger-alert").slideUp(1500);
                          }); 
           });
  </script>
  <!-- Alert Message End -->

    <!-- Custom Theme Scripts -->
    <script src="{{ asset('js/custom.js')}}"></script>
    
  </body>
</html>
