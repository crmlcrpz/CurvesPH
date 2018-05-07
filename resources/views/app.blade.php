<!DOCTYPE html>
<html lang="en">
<!-- BEGIN HEAD -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <meta content="" name="description"/>
    <meta content="" name="author"/>
    
    <title>Curves</title>
    
    <!-- BEGIN CORE FRAMEWORK -->
    <link href="{{ URL::asset('assets/plugins/bootstrap/css/bootstrap.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/ionicons/css/ionicons.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" />
    <!-- END CORE FRAMEWORK -->
    
    <!-- BEGIN PLUGIN STYLES -->
    <link href="{{ URL::asset('assets/plugins/animate/animate.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/morris/morris.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/bootstrap-slider/css/slider.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datepicker/css/bootstrap-datepicker.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/rickshaw/rickshaw.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/jquery-jvectormap/jquery-jvectormap-1.2.2.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/bootstrapValidator/bootstrapValidator.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/sweetalert/sweetalert.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/bootstrap-select/css/bootstrap-select.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/bootstrap-tokenfield/css/bootstrap-tokenfield.min.css') }}" rel="stylesheet" />
    <!-- END PLUGIN STYLES -->
    
    <!-- BEGIN THEME STYLES -->
    <link href="{{ URL::asset('assets/css/material.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/css/style.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/css/plugins.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/css/helpers.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/css/responsive.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/css/mystyle.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/css/print.css') }}" media="print" rel="stylesheet" />
    <!-- END THEME STYLES -->
    @include('_jsVariables')
    @yield('header_scripts')
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="fixed-leftside fixed-header">
    <!-- BEGIN HEADER -->
    <header class="hidden-print">
        <span class="logo">Curves</span>
        <nav class="navbar navbar-static-top">
            <a href="#" class="navbar-btn sidebar-toggle">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>            
        </nav>
    </header>
    <!-- END HEADER -->
         
    <div class="wrapper">
        <!-- BEGIN LEFTSIDE -->
        <div class="leftside hidden-print">
            <div class="sidebar">
                <!-- BEGIN RPOFILE -->
                <div class="nav-profile">
                    <div class="thumb">
                        <?php
                            $media = Auth::user()->getMedia();
                            $image = ($media->isEmpty() ? 'https://placeholdit.imgix.net/~text?txtsize=18&txt=NA&w=50&h=50' : url($media[0]->getUrl('thumb')));
                        ?>
                        <img src="{{ $image }}" class="img-circle" alt="" />
                    </div>
                    <div class="info">
                        <span class="color-black-400">{{Utilities::getGreeting()}},</span><br />
                        <a>{{Auth::user()->name}}</a>
                    </div>
                    <a href="{{url('auth/logout')}}" class="button"><i class="ion-log-out"></i></a>
                </div>
                <!-- END RPOFILE -->
                <!-- BEGIN NAV -->
                <div class="title">Navigation</div>
                    <ul class="nav-sidebar">
                        <li class="{{ Utilities::setActiveMenu('dashboard*') }}">
                            <a href="{{ action('DashboardController@index') }}">
                                <i class="ion-home"></i> <span>Dashboard</span>
                            </a>
                        </li>

                        @permission(['manage-curves','manage-inquiries','view-inquiry'])
                        <li class="nav-dropdown {{ Utilities::setActiveMenu('inquiries*',true) }}">
                            <a href="#">
                                <i class="ion-ios-telephone"></i> <span>Inquiries</span>
                            </a>
                            <ul>
                                <li class="{{ Utilities::setActiveMenu('inquiries/all') }}"><a href="{{ action('InquiriesController@index') }}">All Inquiries</a></li>
                                @permission(['manage-curves','manage-inquiries','add-inquiry'])
                                <li class="{{ Utilities::setActiveMenu('inquiries/create') }}"><a href="{{ action('InquiriesController@create') }}">Add Inquiry</a></li>                            
                                @endpermission
                            </ul>
                        </li>
                        @endpermission

                        @permission(['manage-curves','manage-members','view-member'])
                        <li class="nav-dropdown {{ Utilities::setActiveMenu('members*',true) }}">
                            <a href="#">
                                <i class="ion-person-add"></i> <span>Members</span>
                            </a>
                            <ul>
                                <li class="{{ Utilities::setActiveMenu('members/all') }}"><a href="{{ action('MembersController@index') }}">All Members</a></li>
                                @permission(['manage-curves','manage-members','add-member'])
                                <li class="{{ Utilities::setActiveMenu('members/create') }}"><a href="{{ action('MembersController@create') }}">Add Member</a></li>                            
                                @endpermission
                                <li class="{{ Utilities::setActiveMenu('members/active') }}"><a href="{{ action('MembersController@active') }}">Active Members</a></li>
                                <li class="{{ Utilities::setActiveMenu('members/inactive') }}"><a href="{{ action('MembersController@inactive') }}">Archives</a></li>                                
                            </ul>
                        </li>
                        @endpermission

                        @permission(['manage-curves','manage-payments','view-payment'])
                        <li class="nav-dropdown {{ Utilities::setActiveMenu('payments*',true) }}">
                            <a href="#">
                                <i class="ion-cash"></i> <span>Payments</span>
                            </a>
                            <ul>
                                <li class="{{ Utilities::setActiveMenu('payments/all') }}"><a href="{{ action('PaymentsController@index') }}">All Payments</a></li>
                                @permission(['manage-curves','manage-payments','add-payment'])
                                <li class="{{ Utilities::setActiveMenu('payments/create') }}"><a href="{{ action('PaymentsController@create') }}">Add Payment</a></li>                            
                                @endpermission
                            </ul>
                        </li>
                        @endpermission

                        @permission(['manage-curves','manage-subscriptions','view-subscription'])
                        <li class="nav-dropdown {{ Utilities::setActiveMenu('subscriptions*',true) }}">
                            <a href="#">
                                <i class="ion-android-checkbox-outline"></i> <span>Subscriptions</span>
                            </a>
                            <ul>
                                <li class="{{ Utilities::setActiveMenu('subscriptions/all') }}"><a href="{{ action('SubscriptionsController@index') }}">All Subscriptions</a></li>
                                @permission(['manage-curves','manage-subscriptions','add-subscription'])
                                <li class="{{ Utilities::setActiveMenu('subscriptions/create') }}"><a href="{{ action('SubscriptionsController@create') }}">Add Subscription</a></li>
                                @endpermission
                                <li class="{{ Utilities::setActiveMenu('subscriptions/expiring') }}"><a href="{{ action('SubscriptionsController@expiring') }}">Expiring Subscriptions</a></li>
                                <li class="{{ Utilities::setActiveMenu('subscriptions/expired') }}"><a href="{{ action('SubscriptionsController@expired') }}">Expired Subscriptions</a></li>
                            </ul>
                        </li>
                        @endpermission

                        @permission(['manage-curves','manage-invoices','view-invoice'])
                        <li class="nav-dropdown {{ Utilities::setActiveMenu('invoices*',true) }}">
                            <a href="#">
                                <i class="ion-ios-paper"></i> <span>Invoices</span>
                            </a>
                            <ul>
                                <li class="{{ Utilities::setActiveMenu('invoices/all') }}"><a href="{{ action('InvoicesController@index') }}">All Invoices</a></li>
                                <li class="{{ Utilities::setActiveMenu('invoices/paid') }}"><a href="{{ action('InvoicesController@paid') }}">Paid Invoices</a></li>
                                <li class="{{ Utilities::setActiveMenu('invoices/unpaid') }}"><a href="{{ action('InvoicesController@unpaid') }}">Unpaid Invoices</a></li>
                                <li class="{{ Utilities::setActiveMenu('invoices/partial') }}"><a href="{{ action('InvoicesController@partial') }}">Partial Invoices</a></li>
                                <li class="{{ Utilities::setActiveMenu('invoices/overpaid') }}"><a href="{{ action('InvoicesController@overpaid') }}">Overpaid Invoices</a></li>
                            </ul>
                        </li>
                        @endpermission

                        @permission(['manage-curves','manage-plans','view-plan'])
                        <li class="nav-dropdown {{ Utilities::setActiveMenu('plans*',true) }}">
                            <a href="#">
                                <i class="ion-compose"></i> <span>Plans</span>
                            </a>
                            <ul>
                                <li class="{{ Utilities::setActiveMenu('plans/all') }}"><a href="{{ action('PlansController@index') }}">All Plans</a></li>
                                @permission(['manage-curves','manage-plans','add-plan'])
                                <li class="{{ Utilities::setActiveMenu('plans/create') }}"><a href="{{ action('PlansController@create') }}">Add Plan</a></li>                            
                                @endpermission
                                @permission(['manage-curves','manage-services','view-service'])
                                <li class="{{ Utilities::setActiveMenu('plans/services/all') }}"><a href="{{ action('ServicesController@index') }}">Gym Services</a></li>
                                @endpermission
                                @permission(['manage-curves','manage-services','add-service'])
                                <li class="{{ Utilities::setActiveMenu('plans/services/create') }}"><a href="{{ action('ServicesController@create') }}">Add Service</a></li>                            
                                @endpermission
                            </ul>
                        </li>
                        @endpermission

                        @permission(['manage-curves','manage-users'])
                        <li class="nav-dropdown {{ Utilities::setActiveMenu('user*',true) }}">
                            <a href="#">
                                <i class="fa fa-users"></i> <span>Users</span>
                            </a>
                            <ul>
                                <li class="{{ Utilities::setActiveMenu('user') }}"><a href="{{ action('AclController@userIndex') }}"><i class="fa fa-upload"></i> All Users</a></li>
                                <li class="{{ Utilities::setActiveMenu('user/create') }}"><a href="{{ action('AclController@createUser') }}"><i class="fa fa-list"></i> Add new user</a></li>
                                <li class="{{ Utilities::setActiveMenu('user/role') }}"><a href="{{ action('AclController@roleIndex') }}"><i class="fa fa-list"></i> Roles</a></li>
                                @role('Curves')
                                <li class="{{ Utilities::setActiveMenu('user/permission') }}"><a href="{{ action('AclController@permissionIndex') }}"><i class="fa fa-list"></i> Permissions</a></li>
                                @endrole
                            </ul>
                        </li>
                        @endpermission
                    
                        @permission(['manage-curves','manage-settings'])
                        <li class="{{ Utilities::setActiveMenu('settings*') }}">
                            <a href="{{ action('SettingsController@edit') }}">
                                <i class="fa fa-cogs fa-2x"></i> <span>Settings</span>
                            </a>
                        </li>
                        @endpermission
                        
                        <!-- Dummy Spacer -->
                        <li>
                            <a href=""></a>
                        </li>

                    </ul>

                </div>
            </div>

        @yield('content')
    </div><!-- /.wrapper -->
    <!-- END CONTENT -->
        
    <!-- BEGIN JAVASCRIPTS -->
    
    <!-- BEGIN CORE PLUGINS -->
    <script src="{{ URL::asset('assets/plugins/jquery-1.11.1.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('assets/plugins/pace/pace.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('assets/plugins/slimScroll/jquery.slimscroll.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('assets/plugins/bootstrap-select/js/bootstrap-select.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('assets/plugins/bootstrap-tokenfield/bootstrap-tokenfield.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('assets/plugins/sweetalert/sweetalert.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('assets/js/core.js') }}" type="text/javascript"></script>
    <!-- END CORE PLUGINS -->
    
    <!-- datepicker -->
    <script src="{{ URL::asset('assets/plugins/bootstrap-daterangepicker/moment.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('assets/plugins/bootstrap-daterangepicker/daterangepicker.js') }}" type="text/javascript"></script>
    
    <!-- counter -->
    <script src="{{ URL::asset('assets/plugins/jquery-countTo/jquery.countTo.js') }}" type="text/javascript"></script>
    
    <!-- datepicker -->
    <script src="{{ URL::asset('assets/plugins/datepicker/js/bootstrap-datepicker.min.js') }}" type="text/javascript"></script>

    <!--validator-->
    <script src="{{ URL::asset('assets/plugins/bootstrapValidator/bootstrapValidator.min.js') }}" type="text/javascript"></script>

    {{-- @include('_jsVariables') --}}
    
    <!--Footer scripts-->
    @yield('footer_scripts')

    <!-- maniac -->
    <script src="{{ URL::asset('assets/js/maniac.js') }}" type="text/javascript"></script>

    @yield('footer_script_init')

    <!-- dashboard -->
    <script type="text/javascript">

    $(document).ready(function(){
        curves.loadcounter();
        curves.loadprogress();
        curves.loaddatepicker();
        curves.loaddaterangepicker();
        curves.loadbsselect();
	});
    	
    </script> 

    <!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>