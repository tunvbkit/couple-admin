<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>@yield('title')</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{Asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
    <!-- Custom CSS -->
    <link href="{{Asset('assets/css/sb-admin.css')}}" rel="stylesheet" type="text/css">
    <!-- Morris Charts CSS -->
    <link href="{{Asset('assets/css/morris.css')}}" rel="stylesheet" type="text/css">
    <!-- Custom Fonts -->
    <link href="{{Asset('assets/font-awesome-4.1.0/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">

    <link href="{{Asset('assets/css/style.css')}}" rel="stylesheet" type="text/css">
    <link href="{{Asset('assets/css/sweet-alert.css')}}" rel="stylesheet">
    <script src="{{Asset('assets/js/sweet-alert.min.js')}}"></script>

    <script src="{{Asset('assets/js/jquery-1.11.0.js')}}"></script>

   <script src="//cdn.ckeditor.com/4.4.3/full/ckeditor.js"></script>

   <script src="{{Asset('assets/js/jquery-validate/jquery.validate.js')}}"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    

    <!-- Bootstrap Core JavaScript -->
    <script src="{{Asset('assets/js/bootstrap.min.js')}}"></script>

    <link href="{{Asset("assets/css/jquery.datetimepicker.css")}}" rel="stylesheet">
    <script src="{{Asset('assets/js/jquery.datetimepicker.js')}}"></script>

    <!-- CKEditor -->
    <script src="{{Asset('assets/ckeditor/ckeditor.js')}}"></script>
</head>

<body>
    <div id="wrapper">
        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Site Admin</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-envelope"></i> <b class="caret"></b></a>
                    <ul class="dropdown-menu message-dropdown">
                        <li class="message-preview">
                            <a href="#">
                                <div class="media">
                                    <span class="pull-left">
                                        <img class="media-object" src="http://placehold.it/50x50" alt="">
                                    </span>
                                    <div class="media-body">
                                        <h5 class="media-heading"><strong>Admin</strong>
                                        </h5>
                                        <p class="small text-muted"><i class="fa fa-clock-o"></i> Yesterday at 4:32 PM</p>
                                        <p>Lorem ipsum dolor sit amet, consectetur...</p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="message-preview">
                            <a href="#">
                                <div class="media">
                                    <span class="pull-left">
                                        <img class="media-object" src="http://placehold.it/50x50" alt="">
                                    </span>
                                    <div class="media-body">
                                        <h5 class="media-heading"><strong>Admin</strong>
                                        </h5>
                                        <p class="small text-muted"><i class="fa fa-clock-o"></i> Yesterday at 4:32 PM</p>
                                        <p>Lorem ipsum dolor sit amet, consectetur...</p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="message-preview">
                            <a href="#">
                                <div class="media">
                                    <span class="pull-left">
                                        <img class="media-object" src="http://placehold.it/50x50" alt="">
                                    </span>
                                    <div class="media-body">
                                        <h5 class="media-heading"><strong>Admin</strong>
                                        </h5>
                                        <p class="small text-muted"><i class="fa fa-clock-o"></i> Yesterday at 4:32 PM</p>
                                        <p>Lorem ipsum dolor sit amet, consectetur...</p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="message-footer">
                            <a href="#">Read All New Messages</a>
                        </li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell"></i> <b class="caret"></b></a>
                    <ul class="dropdown-menu alert-dropdown">
                        <li>
                            <a href="#">Alert Name <span class="label label-default">Alert Badge</span></a>
                        </li>
                        <li>
                            <a href="#">Alert Name <span class="label label-primary">Alert Badge</span></a>
                        </li>
                        <li>
                            <a href="#">Alert Name <span class="label label-success">Alert Badge</span></a>
                        </li>
                        <li>
                            <a href="#">Alert Name <span class="label label-info">Alert Badge</span></a>
                        </li>
                        <li>
                            <a href="#">Alert Name <span class="label label-warning">Alert Badge</span></a>
                        </li>
                        <li>
                            <a href="#">Alert Name <span class="label label-danger">Alert Badge</span></a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">View All</a>
                        </li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> Admin <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="#"><i class="fa fa-fw fa-user"></i> Profile</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-fw fa-envelope"></i> Inbox</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-fw fa-gear"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="{{URL::route('logout')}}"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav" >
                    <li >
                        <a href="{{URL::to('admin/main')}}"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>
                    <li>
                        <a href="{{URL::to('admin/users')}}"><i class="glyphicon glyphicon-user"></i> Users</a>
                    </li>
                    <li>
                        <a href="{{URL::route('vendors')}}"><i class="glyphicon glyphicon-th-list"></i> Vendors</a>
                    </li>
                    <li>
                        <a href="{{Asset('admin/categories')}}"><i class="glyphicon glyphicon-th-large"></i> Categories</a>
                    </li>
                    <li>
                        <a href="{{Asset('admin/location')}}"><i class="glyphicon glyphicon-map-marker"></i> Location</a>
                    </li>
                     <li>
                        <a href="{{Asset('admin/task')}}"><i class="glyphicon glyphicon-ok"></i> Task</a>
                    </li>
                    <li>
                        <a href="{{Asset('admin/range')}}"><i class="glyphicon glyphicon-ok"></i> Range</a>
                    </li>
                    <li>
                        <a href="{{Asset('admin/item')}}"><i class="glyphicon glyphicon-asterisk"></i> Item</a>
                    </li>
                    <li>
                        <a href="{{Asset('admin/songs')}}"><i class="fa fa-music"></i> Songs</a>
                    </li>
                    <li>
                        <a href="{{Asset('admin/imageslide')}}"><i class="glyphicon glyphicon-picture"></i> Images Slide</a>
                    </li>

                </ul>
               <script type="text/javascript">
                    // $('.nav li ').click(function(e) {
                    //     $('.nav li.active').removeClass('active');
                    //     var $this = $(this);
                    //     if (!$this.hasClass('active')) {
                    //         $this.addClass('active');
                           
                    //     }
                      
                        
                         
                    // });

               </script>
            </div>
            <!-- /.navbar-collapse -->
        </nav>
        <div id="page-wrapper">
        @yield('content')
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

</body>

</html>
