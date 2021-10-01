<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from thememinister.com/crm/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 02 Jun 2019 11:06:57 GMT -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <!-- Favicon and touch icons -->
    <link rel="shortcut icon" href="{{ asset('backend/assets/dist/img/ico/favicon.png') }}" type="image/x-icon">
    <!-- Start Global Mandatory Style
         =====================================================================-->

    {{-- My Custom Css --}}

    <link rel="stylesheet" href="{{ asset('css/backend/mystyle.css') }}">

    <!-- jquery-ui css -->
    <link href="{{ asset('backend/assets/plugins/jquery-ui-1.12.1/jquery-ui.min.css') }}" rel="stylesheet"
        type="text/css" />
    <!-- Bootstrap -->
    <link href="{{ asset('backend/assets/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Bootstrap rtl -->
    <!--<link href="assets/bootstrap-rtl/bootstrap-rtl.min.css" rel="stylesheet" type="text/css"/>-->
    <!-- Lobipanel css -->
    <link href="{{ asset('backend/assets/plugins/lobipanel/lobipanel.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Pace css -->
    <link href="{{ asset('backend/assets/plugins/pace/flash.css') }}" rel="stylesheet" type="text/css" />
    <!-- Font Awesome -->
    <link href="{{ asset('backend/assets/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet"
        type="text/css" />
    <!-- Pe-icon -->
    <link href="{{ asset('backend/assets/pe-icon-7-stroke/css/pe-icon-7-stroke.css') }}" rel="stylesheet"
        type="text/css" />
    <!-- Themify icons -->
    <link href="{{ asset('backend/assets/themify-icons/themify-icons.css') }}" rel="stylesheet" type="text/css" />
    <!-- End Global Mandatory Style
         =====================================================================-->
    <!-- Start page Label Plugins 
         =====================================================================-->
    <!-- Emojionearea -->

    <link href="{{ asset('backend/assets/plugins/emojionearea/emojionearea.min.css') }}" rel="stylesheet"
        type="text/css" />
    <!-- Monthly css -->
    <link href="{{ asset('backend/assets/plugins/monthly/monthly.css') }}" rel="stylesheet" type="text/css" />
    <!-- End page Label Plugins 
         =====================================================================-->
    <!-- Start Theme Layout Style
         =====================================================================-->
    <!-- Theme style -->
    <link href="{{ asset('backend/assets/dist/css/stylecrm.css') }}" rel="stylesheet" type="text/css" />
    <!-- Theme style rtl -->
    <!--<link href="assets/dist/css/stylecrm-rtl.css" rel="stylesheet" type="text/css"/>-->




    {{-- Custom Plugin --}}


    {{-- Datatable Css starts --}}
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href=" https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap.min.css">
    {{-- Datatable Css ends --}}


    {{-- Bootstrap Toogle --}}
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">



    <!-- End Theme Layout Style
         =====================================================================-->
</head>

<body class="hold-transition sidebar-mini">
    <!--preloader-->
    {{-- <div id="preloader">
        <div id="status"></div>
    </div> --}}
    <!-- Site wrapper -->
    <div class="wrapper">

        {{-- header starts --}}
        @include('backend.layouts.header')
        {{-- header ends --}}

        {{-- sidebar starts --}}
        @include('backend.layouts.sidebar')
        {{-- sidebar ends --}}

        <div class="content-wrapper">

            <!-- Main content -->
            @yield('content')
            <!-- /.content -->
        </div>

        @include('backend.layouts.footer')
    </div>


    <!-- Start Core Plugins
         =====================================================================-->

    <!-- jQuery -->
    <script src="{{ asset('backend/assets/plugins/jQuery/jquery-1.12.4.min.js') }}" type="text/javascript"></script>
    <!-- jquery-ui -->
    <script src="{{ asset('backend/assets/plugins/jquery-ui-1.12.1/jquery-ui.min.js') }}" type="text/javascript">
    </script>

    {{-- Date Picker Jquery --}}
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script>
        $(function() {
            $("#datepicker").datepicker({
                minDate: 0,
                dateFormat: 'yy-mm-dd'
            });
        });
    </script>

    <!-- Bootstrap -->
    <script src="{{ asset('backend/assets/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
    <!-- lobipanel -->
    <script src="{{ asset('backend/assets/plugins/lobipanel/lobipanel.min.js') }}" type="text/javascript"></script>
    <!-- Pace js -->
    <script src="{{ asset('backend/assets/plugins/pace/pace.min.js') }}" type="text/javascript"></script>
    <!-- SlimScroll -->
    <script src="{{ asset('backend/assets/plugins/slimScroll/jquery.slimscroll.min.js') }}" type="text/javascript">
    </script>
    <!-- FastClick -->
    <script src="{{ asset('backend/assets/plugins/fastclick/fastclick.min.js') }}" type="text/javascript"></script>
    <!-- CRMadmin frame -->
    <script src="{{ asset('backend/assets/dist/js/custom.js') }}" type="text/javascript"></script>
    <!-- End Core Plugins
         =====================================================================-->
    <!-- Start Page Lavel Plugins
         =====================================================================-->
    <!-- ChartJs JavaScript -->
    <script src="{{ asset('backend/assets/plugins/chartJs/Chart.min.js') }}" type="text/javascript"></script>
    <!-- Counter js -->
    <script src="{{ asset('backend/assets/plugins/counterup/waypoints.js') }}" type="text/javascript"></script>
    <script src="{{ asset('backend/assets/plugins/counterup/jquery.counterup.min.js') }}" type="text/javascript">
    </script>
    <!-- Monthly js -->
    <script src="{{ asset('backend/assets/plugins/monthly/monthly.js') }}" type="text/javascript"></script>
    <!-- End Page Lavel Plugins
         =====================================================================-->
    <!-- Start Theme label Script
         =====================================================================-->
    <!-- Dashboard js -->
    <script src="{{ asset('backend/assets/dist/js/dashboard.js') }}" type="text/javascript"></script>
    <!-- End Theme label Script
         =====================================================================-->



    {{-- Custom Plugin --}}

    {{-- Datatable Js starts --}}
    {{-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> --}}
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap.min.js"></script>
    {{-- Datatable Js ends --}}

    {{-- Sweet Alert Starts --}}
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- Add Input Filed --}}
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> --}}

    {{-- Bootstrap Toggle --}}
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>




    @include('backend.layouts.session')

    @yield('foot')

    <script>
        $(document).ready(function() {
            $('.table').DataTable();
        });

        function dash() {   
            // single bar chart
            var ctx = document.getElementById("singelBarChart");
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ["Sun", "Mon", "Tu", "Wed", "Th", "Fri", "Sat"],
                    datasets: [{
                        label: "My First dataset",
                        data: [40, 55, 75, 81, 56, 55, 40],
                        borderColor: "rgba(0, 150, 136, 0.8)",
                        width: "1",
                        borderWidth: "0",
                        backgroundColor: "rgba(0, 150, 136, 0.8)"
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
            //monthly calender
            $('#m_calendar').monthly({
                mode: 'event',
                //jsonUrl: 'events.json',
                //dataType: 'json'
                xmlUrl: 'events.xml'
            });

            //bar chart
            var ctx = document.getElementById("barChart");
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ["January", "February", "March", "April", "May", "June", "July", "august", "september",
                        "october", "Nobemver", "December"
                    ],
                    datasets: [{
                            label: "My First dataset",
                            data: [65, 59, 80, 81, 56, 55, 40, 65, 59, 80, 81, 56],
                            borderColor: "rgba(0, 150, 136, 0.8)",
                            width: "1",
                            borderWidth: "0",
                            backgroundColor: "rgba(0, 150, 136, 0.8)"
                        },
                        {
                            label: "My Second dataset",
                            data: [28, 48, 40, 19, 86, 27, 90, 28, 48, 40, 19, 86],
                            borderColor: "rgba(51, 51, 51, 0.55)",
                            width: "1",
                            borderWidth: "0",
                            backgroundColor: "rgba(51, 51, 51, 0.55)"
                        }
                    ]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
            //counter
            $('.count-number').counterUp({
                delay: 10,
                time: 5000
            });
        }
        dash();
    </script>
</body>

<!-- Mirrored from thememinister.com/crm/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 02 Jun 2019 11:08:11 GMT -->

</html>
