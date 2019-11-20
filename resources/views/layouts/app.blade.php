
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, shrink-to-fit=no">

    <link rel="shortcut icon" href="{{ asset('images/logo/favicon.png') }}">

    <!-- plugins css -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}"/>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
    <link rel="stylesheet" href="{{ asset('css/pace-theme-minimal.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/perfect-scrollbar.min.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/dropzone.css') }}">


    <!-- page plugins css -->
    <link rel="stylesheet" href="{{ asset('css/jquery-jvectormap-1.2.2.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/nv.d3.min.css') }}"/>

    <link rel="stylesheet" href="{{ asset('css/selectize.default.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/daterangepicker.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/bootstrap-datepicker3.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/summernote.css') }}"/>

    <!-- jquery date time picker -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/jquery.datetimepicker.css') }}"/>

    <!-- core css -->
    <link href="{{ asset('css/ei-icon.css') }}" rel="stylesheet">
    <link href="{{ asset('css/themify-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-select.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/jquery.timepicker.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
 
    <script src="{{ asset('js/jquery.min.js') }}"></script>

    <script src="{{ asset('js/drbagency.js') }}"></script>
    <script src="{{ asset('js/dropzone.js') }}"></script>
   
  

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Hermers Workflow - Login Page') }}</title>

    <!-- Styles -->
    <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->
</head>
    <body>
    <div class="app">
        <div class="layout">

        @yield('content')

         <!-- Footer START -->
                <footer class="content-footer">
                    <div class="footer">
                        <div class="copyright">
                            <span>Copyright © 2017 - <?php echo date("Y"); ?> <b class="text-dark"><a href="http://beacon-link.com/" target="_blank">Beacon Link</a></b> Admin. All rights reserved. <!-- Built by <a target="_blank" href="http://drbagency.com/">DRB Agency</a></span> -->
                            <span class="go-right">
                                <ul class="list-footer">
                                    <li>
                                        <a href="https://www.facebook.com/BeaconLink/" target="_blank"><i class="fa fa-facebook"></i></a>
                                    </li>
                                    <li>
                                        <a href="https://www.instagram.com/beacon_link/" target="_blank"><i class="fa fa-instagram"></i></a>
                                    </li>
                                    <li>
                                        <a href="https://www.youtube.com/channel/UCfGBUWRuLztitQ_ko27YmoA" target="_blank"><i class="fa fa-youtube"></i></a>
                                    </li>
                                </ul>
                                <!-- <a href="#" class="text-gray mrg-right-15">Term &amp; Conditions</a>
                                <a href="#" class="text-gray">Privacy &amp; Policy</a> -->
                            </span>
                        </div>
                    </div>
                </footer>
                <!-- Footer END -->

            </div>
            <!-- Page Container END -->

        </div>
    </div>
    <a href="" class="back-to-top">
                <i class="fa fa-arrow-circle-o-up"></i>
            </a>    

    <!-- Scripts -->
    <script src="{{ asset('js/vendor.js') }}"></script>
    
    <!-- page plugins js -->
    <script src="{{ asset('js/jquery-jvectormap-1.2.2.min.js') }}"></script>
    <script src="{{ asset('js/maps/jquery-jvectormap-us-aea.js') }}"></script>
    <script src="{{ asset('js/d3.min.js') }}"></script>
    <script src="{{ asset('js/nv.d3.min.js') }}"></script>
    <script src="{{ asset('js/index.js') }}"></script>
    <script src="{{ asset('js/Chart.min.js') }}"></script>
    <script src="{{ asset('js/summernote.min.js') }}"></script>
     <script src="{{ asset('js/seccion.js') }}"></script>

    <!-- jquery date time picker -->
    <script src="{{ asset('js/node_modules/php-date-formatter/js/php-date-formatter.min.js') }}"></script>
    <script src="{{ asset('js/node_modules/jquery-mousewheel/jquery.mousewheel.js') }}"></script>
    <script src="{{ asset('js/jquery.datetimepicker.js') }}"></script>
    <script type="text/javascript">
        $('#request_datetimepicker').datetimepicker({format: "m/d/Y h:i A"});
        $('#invoice_date_datetimepicker').datetimepicker();
        $('#invoice_acceptance_date_datetimepicker').datetimepicker();
        $('#Appointment_Start_Date_id').datetimepicker({format: "m/d/Y h:i A"});
        $('#Appointment_End_Date_id').datetimepicker({format: "m/d/Y h:i A"});
        $('#Appointment_Start_Working_Time_id').datetimepicker();
        $('#Appointment_Finish_Working_Time_id').datetimepicker();
        $('#Invoice_Jobs_Scheduled_Appointment_Time_id').datetimepicker();
        $('#Invoice_Due_Date_id').datetimepicker({format: "m/d/Y h:i A"});
        $('#Actual_Start_Time_id').datetimepicker({format: "m/d/Y h:i A"});
        $('#Actual_Finish_Time_id').datetimepicker({format: "m/d/Y h:i A"});
        $('#date_of_birth').datetimepicker({format: "m/d/Y"});
    </script>
    <script src="{{ asset('js/app.min.js') }}"></script>

    <!-- page js -->
    <script src="{{ asset('js/dashboard/dashboard.js') }}"></script>

    <!-- page plugins js -->
    <script src="{{ asset('js/bootstrap-select.min.js') }}"></script>
   
    <script src="{{ asset('js/selectize.min.js') }}"></script>
    <script src="{{ asset('js/moment.min.js') }}"></script>
    <script src="{{ asset('js/daterangepicker.js') }}"></script>
    <script src="{{ asset('js/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('js/bootstrap-timepicker.js') }}"></script>
    <script src="{{ asset('js/forms/form-elements.js') }}"></script>
    <script src="{{ asset('js/jquery.timepicker.min.js') }}"></script>
   
    
</body>
</html>