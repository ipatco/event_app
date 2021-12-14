<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>@yield('title')</title>
        <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
        <link href="{{ asset('assets/css/sb-admin-2.min.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="//fengyuanchen.github.io/datepicker/css/datepicker.css"/>
        @yield('css')
        <style>
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
            s, strike{text-decoration:none;position:relative;}
            s::before, strike::before {
                top: 50%; /*tweak this to adjust the vertical position if it's off a bit due to your font family */
                background:red; /*this is the color of the line*/
                opacity:.7;
                content: '';
                width: 110%;
                position: absolute;
                height:.1em;
                border-radius:.1em;
                left: -5%;
                white-space:nowrap;
                display: block;
                transform: rotate(-15deg);
            }
            s.straight::before, strike.straight::before{transform: rotate(0deg);left:-1%;width:102%;}
            body {
                color: #000;
            }
            .text-gray-800 {
                color: #000 !important;
            }
            .h3{
                font-size: 30px;
            }
            .card {
                border: 1px solid black !important;
            }
            .shadow, .nav, .card-header {
                box-shadow: 0 .15rem 1.75rem 0 rgb(0, 0, 0) !important;
            }
            .trim-text{
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
            }
            .center-of-card-img{
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
            }
            .detail-btn{
                display: none;
            }
            .showbtn:hover .detail-btn{
                display: block;
            }
            .showBtns:hover .detail-btn{
                display: block;
            }
            </style>
    </head>
    <body id="page-top">
        <div id="wrapper">
            <div id="content-wrapper" class="d-flex flex-column">
                <div id="content">
                    <nav class="navbar navbar-expand navbar-dark bg-dark topbar mb-4 static-top shadow bg-000">
                        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                            <i class="fa fa-bars"></i>
                        </button>
                        <h4 class="text-center">
                            <a class="text-white" href="{{ '/' }}">
                                <img src="/assets/img/logo.JPG" alt="logo" height="65px" class="mt-c">
                                {{-- <span class="fs-30px">{{env('APP_NAME')}}</span> --}}
                            </a>
                        </h4>
                        <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-5 my-2 my-md-0 mw-100 navbar-search" action="{{ route('search') }}" method="GET">
                            <div class="input-group">
                                <input type="text" class="form-control bg-dark-200 border-0 small" placeholder="Search for..." name="q" value="{{ request()->q }}">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit">
                                        <i class="fas fa-search fa-sm"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                        <x-nav-menu />
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
        @if(session('success_mail'))
            alert('{{ session('success_mail') }}')
        @endif
        $('.date').datepicker({
            autoHide: true,
            zIndex: 2048,
            format: 'yyyy-mm-dd',
            autoPick: true,
        });
        $(function() {
            var $startDate = $('.start-date');
            var $endDate = $('.end-date');

            $startDate.datepicker({
            autoHide: true,
            });
            $endDate.datepicker({
            autoHide: true,
            startDate: $startDate.datepicker('getDate'),
            });

            $startDate.on('change', function () {
            $endDate.datepicker('setStartDate', $startDate.datepicker('getDate'));
            });
        });
    </script>
    @yield('js')
</body>

</html>
