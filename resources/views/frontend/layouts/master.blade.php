<!DOCTYPE html>
<html lang="en">
<!-- Basic -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Site Metas -->
    <title>@yield('title')</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Site Icons -->
    <link rel="shortcut icon" href="{{ asset('frontend/images/favicon.ico') }}" type="image/x-icon">
    <link rel="apple-touch-icon" href="{{ asset('frontend/images/apple-touch-icon.png') }}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href=" {{ asset('frontend/css/bootstrap.min.css') }}">
    <!-- Site CSS -->
    <link rel="stylesheet" href=" {{ asset('frontend/css/style.css') }}">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href=" {{ asset('frontend/css/responsive.css') }}">
    <!-- Custom CSS -->
    {{-- <link rel="stylesheet" href=" {{ asset('frontend/css/custom.css') }}"> --}}
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    {{-- Custom Css --}}
    <link rel="stylesheet" href="{{ asset('css/frontend/mystyle.css') }}">

    {{-- Select 2 --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    {{-- Datatable Css starts --}}
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css"> --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.1/css/dataTables.bootstrap4.min.css">




    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>


    @include('frontend.layouts.header')

    <div class="container-fluid">
        @yield('content')
    </div>
       

    @include('frontend/layouts/footer')


    <a href="#" id="back-to-top" title="Back to top" style="display: none;">&uarr;</a>

    <!-- ALL JS FILES -->
    <script src="{{ asset('frontend/js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('frontend/js/popper.min.js') }}"></script>
    <script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
 
    <!-- ALL PLUGINS -->
    <script src="{{ asset('frontend/js/jquery.superslides.min.js') }}"></script>
    <script src="{{ asset('frontend/js/bootstrap-select.js') }}"></script>
    <script src="{{ asset('frontend/js/inewsticker.js') }}"></script>
    <script src="{{ asset('frontend/js/bootsnav.js.') }}"></script>
    <script src="{{ asset('frontend/js/images-loded.min.js') }}"></script>
    <script src="{{ asset('frontend/js/isotope.min.js') }}"></script>
    <script src="{{ asset('frontend/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('frontend/js/baguetteBox.min.js') }}"></script>
    <script src="{{ asset('frontend/js/form-validator.min.js') }}"></script>
    <script src="{{ asset('frontend/js/contact-form-script.js') }}"></script>
    <script src="{{ asset('frontend/js/custom.js') }}"></script>

    {{-- Sweet Alert Starts --}}
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- Select 2 --}}
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


    {{-- Datatable Js starts --}}.
    <script src="https://cdn.datatables.net/1.11.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.1/js/dataTables.bootstrap4.min.js"></script>




    @include('frontend.layouts.session')

    <script>
        $(document).ready(function() {
            $('#table').DataTable();

        });
    </script>

    
    @yield('foot')

</body>

</html>
