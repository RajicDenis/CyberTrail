<?php session_start();
//session_destroy(); die();
 ?>
<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>CyberTrail Admin Panel</title>

        <!-- Bootstrap -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Fira+Sans" rel="stylesheet">

        <!-- Styles --> 
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.3/components/icon.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.3/components/button.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.3/components/form.min.css">

        <!-- DataTables -->
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">

        <!-- Sweetalert -->
        <link rel="stylesheet" href="{{ URL::asset('CyberTrail/css/plugins/sweetalert.css') }}">

        <!-- Custom css -->
        <link rel="stylesheet" href="{{ URL::asset('CyberTrail/css/admin_app.css') }}">
        @yield('css')

         <!-- jQuery & jQuery UI-->
        <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.0/themes/smoothness/jquery-ui.css">

    </head>
    <body>

        <div class="admin_wrap">

            <div class="control_panel">
                
                <div class="img_wrap"><img class="cp_img" src="{{ URL::asset('CyberTrail/images/leaf.png') }}"></div>

                <div class="cp_options">

                    <a href="{{ route('admin_home') }}">
                        <div class="option-list-item mb-5">
                            <div class="cp_item_icn"><i class="home large icon"></i></div>
                            <div class="cp_item_txt"><strong>Dashboard</strong></div>
                        </div>
                    </a>

                    <div class="option-list-item custom-border nohover">
                        <div class="cp_item_icn"><i class="table large icon"></i></div>
                        <div class="cp_item_txt"><strong>Tables</strong></div>
                    </div>

                    @if(count($tables) != 0)
                        @foreach($tables as $table)
                            
                            <a href="{{ route('admin_showTable', ['slug' => $table]) }}">
                                <div class="option-list-item">
                                    <div class="cp_item_icn"></div>
                                    <div class="cp_item_txt">{{ str_replace('_', ' ', ucfirst($table)) }}</div>
                                </div>
                            </a>

                        @endforeach
                    @else
                        <div class="text-center mt-4"><i class="exclamation big icon white"></i></div>
                    @endif
                    
                    <a href="{{ route('admin_settings') }}">
                        <div class="option-list-item mt-5 custom-border">
                            <div class="cp_item_icn"><i class="code branch large icon"></i></div>
                            <div class="cp_item_txt"><strong>Settings</strong></div>
                        </div>
                    </a>
    
                <!-- END cp_options-->
                </div>

            <!-- END control_panel -->
            </div>

            <div class="admin_page">
                
                <div class="admin_top">
                    
                    <div class="at-left">
                        <span class="breadcrumb-title ml-5">CyberTrail</span>
                    </div>

                    <div class="at-right">
                        <img class="small_user_img" src="{{ URL::asset('CyberTrail/images/users/user-default.jpg') }}">
                    </div>

                </div>

                <div class="admin_container">

                    @yield('content')

                </div>
            
            <!-- END admin_page-->
            </div>

        <!-- END admin_wrap-->
        </div>

        <!-- Jquery js -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js" integrity="sha256-eGE6blurk5sHj+rmkfsGYeKyZx3M4bG+ZlFyA7Kns7E=" crossorigin="anonymous"></script>
        
        <!-- Bootstrap js -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

        <!-- FontAwesome js-->
        <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>

        <!-- DataTables -->
        <script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
        
        <!-- Semantic ui forms -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.3/components/form.min.js"></script>

        <!-- SweetAlert js -->
        <script src="{{ URL::asset('CyberTrail/js/sweetalert.min.js') }}"></script>

        <!-- Custom js -->
        <script src="{{ URL::asset('CyberTrail/js/main.js') }}"></script>
        @yield('js')
        
    </body>
</html>
