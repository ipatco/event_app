<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>@yield('title') | Admin Panel</title>
    <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="{{ asset('assets/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="//fengyuanchen.github.io/datepicker/css/datepicker.css"/>
    @yield('css')
    <style>
        body {
            color: #000 !important;
        }
        .bg-000{
            background-color: #000 !important;
        }
        jbt-headings{
            color: #4e73df;
            font-weight: bold;
        }
        .imgg{
            height: 300px;
            object-fit: cover;
        }
        .bg-dark-200{
            background-color: #eaecf4;
        }
        .fs-p{
            font-size: 24px;
        }
        .mt-c{
            margin-top: 7px;
        }
        .fs-30px{
            font-size: 30px;
        }
        .nav-menu-size{
            font-size: 20px;
        }
        .text-white{
            color: #fff !important;
        }
        .sidebar-color{
            background-color: #14224d !important;
        }
        .form-control, select{
            border: 1px solid #14224d !important;
        }
        .card, .card-header{
            background: #000 !important;
        }
        th, td, tr{
            color: #fff !important;
        }
        .card label{
            color: #fff !important;
        }
        input, select, textarea{
            border: 1px solid #14224d !important;
            background-color: #14224d !important;
            color: #fff !important;
        }
        ::placeholder{
            color: rgb(165, 165, 165) !important;
        }
    </style>
</head>

<body id="page-top">
    <div id="wrapper">
        <ul class="navbar-nav bg-dark sidebar sidebar-dark accordion sidebar-color" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.dashaboard') }}">
                <img src="/assets/img/logo.JPG" class="img-fluid" alt="" style="height: 65px;">
            </a>
            <hr class="sidebar-divider my-0">
            <li class="nav-item">
                <a class="nav-link text-white nav-menu-size" href="{{ route('admin.dashaboard') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <hr class="sidebar-divider">
            <div class="sidebar-heading">Catelog</div>
            <li class="nav-item">
                <a class="nav-link text-white nav-menu-size" href="{{ route('admin.events') }}">
                    <i class="fas fa-fw fa-calendar"></i>
                    <span>Events</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white nav-menu-size" href="{{ route('admin.services') }}">
                    <i class="fas fa-fw fa-calendar"></i>
                    <span>Services</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white nav-menu-size" href="{{ route('admin.categories') }}">
                    <i class="fas fa-fw fa-th"></i>
                    <span>Categories</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white nav-menu-size" href="{{ route('admin.transaction') }}">
                    <i class="fas fa-fw fa-th"></i>
                    <span>Transactions</span>
                </a>
            </li>
            <hr class="sidebar-divider">
            <div class="sidebar-heading">Data</div>
            <li class="nav-item">
                <a class="nav-link text-white nav-menu-size" href="{{ route('admin.bookings') }}">
                    <i class="fas fa-fw fa-edit"></i>
                    <span>Bookings</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white nav-menu-size" href="{{ route('admin.users') }}">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Users</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white nav-menu-size" href="{{ route('admin.password') }}">
                    <i class="fas fa-fw fa-key"></i>
                    <span>Change Password</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white nav-menu-size" href="{{ route('admin.profile') }}">
                    <i class="fas fa-fw fa-user"></i>
                    <span>Profile</span>
                </a>
            </li>
            <hr class="sidebar-divider d-none d-md-block">
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <nav class="navbar navbar-expand navbar-dark bg-dark topbar mb-4 static-top shadow bg-000">
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link text-white nav-menu-size dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 text-white nav-menu-size">{{ auth()->user()->name }} (Admin)</span>
                                <img class="img-profile rounded-circle"
                                    src="/assets/img/undraw_profile.svg">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="{{ route('home') }}">
                                    <i class="fas fa-globe fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Back to Website
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
                <div class="container-fluid">
                    @yield('page')
                </div>
            </div>
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; {{ env('APP_NAME') }} {{ date('Y') }}</span>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="btn btn-primary" type="submit">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('assets/js/sb-admin-2.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.25.1/moment.min.js"></script>
    <script src="//fengyuanchen.github.io/datepicker/js/datepicker.js"></script>
    <script>
        $('.date').datepicker({
            autoHide: true,
            zIndex: 2048,
            format: 'yyyy-mm-dd',
            autoPick: true,
            startDate: '{{ date("Y-m-d") }}',
        });
        $(function() {
            var $startDate = $('.start-date');
            var $endDate = $('.end-date');

            $startDate.change(function() {
                $endDate.val('');
            });
            $startDate.datepicker({
                autoHide: true,
                zIndex: 2048,
                format: 'yyyy-mm-dd',
                startDate: '{{ date("Y-m-d") }}',
                autoPick: true,
            });
            $endDate.datepicker({
                autoHide: true,
                zIndex: 2048,
                format: 'yyyy-mm-dd',
                autoPick: true,
                startDate: $startDate.datepicker('getDate'),
            });
            $startDate.on('change', function () {
                $endDate.datepicker('setStartDate', $startDate.datepicker('getDate'));
            });
        });
    </script>
    <script>
        $('#sale_price').on('keyup', function() {
            var price = $('#price').val();
            price = Number(price);
            var sale_price = $('#sale_price').val();
            sale_price = Number(sale_price);
            $('#price').attr('max', price);
            if(sale_price > price) {
                $('#sale_price').addClass("is-invalid");
                $('#sale_price').val('');
            }
        });
    </script>
    <script>
        // Disable form submissions if there are invalid fields
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                // Get the forms we want to add validation styles to
                var forms = document.getElementsByClassName('needs-validation');
                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script>
    @yield('js')
</body>

</html>
