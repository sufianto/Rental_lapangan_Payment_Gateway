<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('image/icon_univ_bsi.png') }}">
    <title>tokoonline</title>
    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/extralibs/multicheck/multicheck.css') }}">
    <link href="{{ asset('backend/libs/datatables.net-bs4/css/dataTables.bootstrap4.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/dist/css/style.min.css') }}" rel="stylesheet">


    {{-- 
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" /> --}}



    {{-- <link href="{{ asset('backend/main.min.css') }}" rel="stylesheet">
<script src="{{ asset('backend/main.min.js') }}"></script> --}}

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar" data-navbarbg="skin5">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <div class="navbar-header" data-logobg="skin5">
                    <!-- This is for the sidebar toggle which is visible on mobile only -->
                    <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i
                            class="ti-menu ti-close"></i></a>
                    <!-- ============================================================== -->
                    <!-- Logo -->
                    <!-- ============================================================== -->
                    <a class="navbar-brand" href="index.html">
                        <!-- Logo icon -->
                        <b class="logo-icon p-l-10">
                            <!--You can put here icon as well // <i class="wi wisunset"></i> //-->
                            <!-- Dark Logo icon -->
                            {{-- <img src="{{ asset('image/icon_univ_bsi.png') }}" alt="homepage" class="light-logo" /> --}}
                            <img src="{{ asset('image/Black and White Y2K Sport Streetwear Logo.png') }}" alt="homepage" class="light-logo" width="100"height="50"/>
                        </b>
                        <!--End Logo icon -->
                        <!-- Logo text -->
                        <span class="logo-text">
                            <!-- dark Logo text -->
                            {{-- <img src="{{ asset('image/Black and White Y2K Sport Streetwear Logo.png') }}" alt="homepage" class="light-logo" width="100"height="50"/> --}}
                            <h3>Vyn Sport</h3>
                        </span>
                        <!-- Logo icon -->
                        <!-- <b class="logo-icon"> -->
                        <!--You can put here icon as well // <i class="wi wi-sunset"></i>
//-->
                        <!-- Dark Logo icon -->
                        <!-- <img src="assets/images/logo-text.png" alt="homepage"
class="light-logo" /> -->
                        <!-- </b> -->
                        <!--End Logo icon -->
                    </a>
                    <!-- ============================================================== -->
                    <!-- End Logo -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- Toggle which is visible on mobile only -->
                    <!-- ============================================================== -->
                    <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)"
                        data-toggle="collapse" data-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle
navigation"><i
                            class="ti-more"></i></a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse collapse" id="navbarSupportedContent" datanavbarbg="skin5">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav float-left mr-auto">
                        <li class="nav-item d-none d-md-block"><a
                                class="nav-link
sidebartoggler waves-effect waves-light" href="javascript:void(0)"
                                data-sidebartype="minisidebar"><i class="mdi mdi-menu font-24"></i></a></li>
                        <!-- ==============================================================
-->
                        <!-- create new -->
                        <!-- ==============================================================
-->
                        <!-- ==============================================================
-->
                        <!-- Search -->
                        <!-- ==============================================================
-->
                    </ul>
                    <!-- ============================================================== -->
                    <!-- Right side toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav float-right">
                        <!-- ==============================================================
-->
                        <!-- Comment -->
                        <!-- ==============================================================
-->
                        <!-- ==============================================================
-->
                        <!-- End Comment -->
                        <!-- ==============================================================
-->
                        <!-- ==============================================================
-->
                        <!-- Messages -->
                        <!-- ==============================================================
-->
                        <!-- ==============================================================
-->
                        <!-- End Messages -->
                        <!-- ==============================================================
-->
                        <!-- ==============================================================
-->
                        <!-- User profile and search -->
                        <!-- ==============================================================
-->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted waves-effect
waves-dark pro-pic"
                                href="" data-toggle="dropdown" aria-haspopup="true" ariaexpanded="false">
                                @if (Auth::user()->foto)
                                    <img src="{{ asset('storage/img-user/' . Auth::user()->foto) }}" alt="user"
                                        class="rounded-circle" width="31">
                                @else
                                    <img src="{{ asset('storage/img-user/img-default.jpg') }}" alt="user"
                                        class="rounded-circle" width="31">
                                @endif
                            </a>
                            <div class="dropdown-menu dropdown-menu-right user-dd
animated">
                                <a class="dropdown-item" href="{{ route('backend.user.edit', Auth::user()->id) }}"><i
                                        class="ti-user m-r-5 m-l-5"></i> Profil
                                    Saya</a>
                                <a class="dropdown-item" href=""
                                    onclick="event.preventDefault(); document.getElementById('keluar-app').submit();"><i
                                        class="fa fa-power-off m-r-5 m-l-5"></i> Keluar</a>
                                <div class="dropdown-divider"></div>
                            </div>
                        </li>
                        <!-- ==============================================================
-->
                        <!-- User profile and search -->
                        <!-- ==============================================================
-->
                    </ul>
                </div>
            </nav>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss -->
        <!-- ============================================================== -->
        <aside class="left-sidebar" data-sidebarbg="skin5">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav" class="p-t-30">
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="{{ route('backend.beranda') }}" aria-expanded="false">
                                <i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Beranda</span>
                            </a>
                        </li>

                        @if (Auth::user()->role == '1')
                            <li class="sidebar-item">
                                <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                    href="{{ route('backend.user.index') }}" aria-expanded="false">
                                    <i class="mdi mdi-account"></i><span class="hide-menu">User</span>
                                </a>
                            </li>
                        @endif


                        <li class="sidebar-item">
                            <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)"
                                aria-expanded="false">
                                <i class="mdi mdi-shopping"></i><span class="hide-menu">Data Lapangan</span>
                            </a>
                            <ul aria-expanded="false" class="collapse first-level">
                                @if (Auth::user()->role == '1' || Auth::user()->role == '0')
                                    <li class="sidebar-item">
                                        <a href="{{ route('backend.biaya.index') }}" class="sidebar-link">
                                            <i class="mdi mdi-chevron-right"></i><span class="hide-menu">Biaya</span>
                                        </a>
                                    </li>
                                @endif
                                @if (Auth::user()->role == '0' || Auth::user()->role == '1' || Auth::user()->role == '2')
                                    <li class="sidebar-item">
                                        <a href="{{ route('backend.lapangan.index') }}" class="sidebar-link">
                                            <i class="mdi mdi-chevron-right"></i><span
                                                class="hide-menu">Lapangan</span>
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </li>



                        {{-- @if (Auth::user()->role == '0' || Auth::user()->role == '1')
                            <li class="sidebar-item">
                                <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                   href="{{ route('backend.oprasional.index') }}" aria-expanded="false">
                                    <i class="mdi mdi-file"></i><span class="hide-menu">oprasional</span>
                                </a>
                            </li>
                        @endif
                    
                        @if (Auth::user()->role == '0' || Auth::user()->role == '1' || Auth::user()->role == '2')
                            <li class="sidebar-item">
                                <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                   href="{{ route('backend.penyewa.index') }}" aria-expanded="false">
                                    <i class="mdi mdi-file"></i><span class="hide-menu">Sewa</span>
                                </a>
                            </li>
                        @endif --}}
                        {{-- @if (Auth::user()->role == '0' || Auth::user()->role == '1' || Auth::user()->role == '2')
                            <li class="sidebar-item">
                                <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                   href="{{ route('backend.penyewa.show') }}" aria-expanded="false">
                                    <i class="mdi mdi-calendar"></i><span class="hide-menu">Jadwal Sewa</span>
                                </a>
                            </li>
                        @endif --}}

                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark"
                                href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-calendar"></i><span
                                    class="hide-menu">Data Sewa </span></a>
                            <ul aria-expanded="false" class="collapse first-level">
                                @if (Auth::user()->role == '0' || Auth::user()->role == '1')
                                    <li class="sidebar-item"><a href="{{ route('backend.oprasional.index') }}"
                                            class="sidebar-link"><i class="mdi mdi-chevron-right"></i><span
                                                class="hide-menu"> Oprasional dan Stok </span></a></li>
                                @endif
                                @if (Auth::user()->role == '0' || Auth::user()->role == '1' || Auth::user()->role == '2')
                                    <li class="sidebar-item"><a href="{{ route('backend.v_penyewa.show') }}"
                                            class="sidebar-link"><i class="mdi mdi-chevron-right"></i><span
                                                class="hide-menu"> Daftar Booking </span></a></li>
                                @endif
                                @if (Auth::user()->role == '0' || Auth::user()->role == '1' || Auth::user()->role == '2')
                                    <li class="sidebar-item"><a href="{{ route('backend.penyewa.index') }}"
                                            class="sidebar-link"><i class="mdi mdi-chevron-right"></i><span
                                                class="hide-menu"> Sewa </span></a></li>
                                @endif
                            </ul>
                        </li>


                        @if (Auth::user()->role == '0' || Auth::user()->role == '1')
                            <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark"
                                    href="javascript:void(0)" aria-expanded="false"><i
                                        class="mdi mdi-receipt"></i><span class="hide-menu">Laporan </span></a>
                                <ul aria-expanded="false" class="collapse first-level">
                                    <li class="sidebar-item"><a href="{{ route('backend.laporan.formuser') }}"
                                            class="sidebar-link"><i class="mdi mdi-chevron-right"></i><span
                                                class="hide-menu"> Laporan User </span></a></li>
                                    <li class="sidebar-item"><a href="{{ route('backend.laporan.formlapangan') }}"
                                            class="sidebar-link"><i class="mdi mdi-chevron-right"></i><span
                                                class="hide-menu">Laporan Produk </span></a></li>
                                    <li class="sidebar-item"><a href="{{ route('backend.laporan.formpenyewa') }}"
                                            class="sidebar-link"><i class="mdi mdi-chevron-right"></i><span
                                                class="hide-menu"> Laporan Penyewa </span></a></li>
                                </ul>
                            </li>
                        @endif
                        {{-- <li class="sidebar-item"> <a class="sidebar-link has-arrow waveseffect waves-dark"
                            href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-folder"></i><span
                                class="hide-menu">Tugas matkul</span></a>
                        <ul aria-expanded="false" class="collapse first-level">
                            <li class="sidebar-item"><a href="{{ route('anggota.index') }}"
                                class="sidebar-link"><i class="mdi mdi-chevron-right"></i><span class="hidemenu">CRUD Anggota </span></a>
                                </li>
                                <li class="sidebar-item"><a href="{{ ('/helloworld') }}" 
                                    class="sidebar-link"><i class="mdi mdi-chevron-right"></i><span class="hide-menu"> Hello World </span></a>
                                        </li>
                                    </li>
                            <li class="sidebar-item"><a href="{{ ('ambilfile') }}" 
                                    class="sidebar-link"><i class="mdi mdi-chevron-right"></i><span class="hide-menu"> Ambilfile </span></a>
                                        </li>
                            <li class="sidebar-item"><a href="{{ ('getlorem') }}" 
                            class="sidebar-link"><i class="mdi mdi-chevron-right"></i><span class="hide-menu"> Getlorem </span></a>
                                </li>
                            </li>
                            <li class="sidebar-item"><a href="{{ ('getTabel') }}" 
                                class="sidebar-link"><i class="mdi mdi-chevron-right"></i><span class="hide-menu"> GetTabel </span></a>
                                    </li>
                                </li>
                                <li class="sidebar-item"><a href="{{ ('getForm') }}" 
                                    class="sidebar-link"><i class="mdi mdi-chevron-right"></i><span class="hide-menu"> GetForm </span></a>
                                        </li>
                                    </li>
                                
                            
                        </ul>
                    </li>
                    --}}



                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid -->
            <!-- ============================================================== -->

            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <!-- @yieldAwal -->
                @yield('content')
                {{-- @yield('content1') --}}

                <!-- @yieldAkhir-->
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Right sidebar -->
                <!-- ============================================================== -->
                <!-- .right-sidebar -->
                <!-- ============================================================== -->
                <!-- End Right sidebar -->
                <!-- ============================================================== -->
            </div>

            <!-- ============================================================== -->
            <!-- End Container fluid -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer text-center">
                Web Programming. Studi Kasus Toko Online <a href="https://bsi.ac.id/">Kuliah..? BSI Aja !!!</a>
            </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="{{ asset('backend/libs/jquery/dist/jquery.min.js') }}"></script>
    <!-- Moment.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>

    <!-- FullCalendar -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.css" />


    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{ asset('backend/libs/popper.js/dist/umd/popper.min.js') }}"></script>
    <script src="{{ asset('backend/libs/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="{{ asset('backend/libs/perfect-scrollbar/dist/perfectscrollbar.jquery.min.js') }}"></script>
    <script src="{{ asset('backend/extra-libs/sparkline/sparkline.js') }}"></script>
    <!--Wave Effects -->
    <script src="{{ asset('backend/dist/js/waves.js') }}"></script>
    <!--Menu sidebar -->
    <script src="{{ asset('backend/dist/js/sidebarmenu.js') }}"></script>
    <!--Custom JavaScript -->
    <script src="{{ asset('backend/dist/js/custom.min.js') }}"></script>
    <!-- this page js -->
    <script src="{{ asset('backend/extra-libs/multicheck/datatable-checkbox-init.js') }}"></script>
    <script src="{{ asset('backend/extra-libs/multicheck/jquery.multicheck.js') }}"></script>
    <script src="{{ asset('backend/extra-libs/DataTables/datatables.min.js') }}"></script>

    <script>
        /****************************************
         * Basic Table *
         ****************************************/
        $('#zero_config').DataTable();
    </script>
    <!-- form keluar app -->
    <form id="keluar-app" action="{{ route('backend.logout') }}" method="POST" class="dnone">
        @csrf
    </form>
    <!-- form keluar app end -->
    <!-- sweetalert -->
    <script src="{{ asset('sweetalert/sweetalert2.all.min.js') }}"></script>
    <!-- sweetalert End -->
    <!-- konfirmasi success-->
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: "{{ session('success') }}"
            });
        </script>
    @endif
    <!-- konfirmasi success End-->
    <script type="text/javascript">
        //Konfirmasi delete
        $('.show_confirm').click(function(event) {
            var form = $(this).closest("form");
            var konfdelete = $(this).data("konf-delete");
            event.preventDefault();
            Swal.fire({
                title: 'Konfirmasi Hapus Data?',
                html: "Data yang dihapus <strong>" + konfdelete + "</strong> tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, dihapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire('Terhapus!', 'Data berhasil dihapus.', 'success')
                        .then(() => {
                            form.submit();
                        });
                }
            });
        });
    </script>
    <script>
        // previewFoto
        function previewFoto() {
            const foto = document.querySelector('input[name="foto"]');
            const fotoPreview = document.querySelector('.foto-preview');
            fotoPreview.style.display = 'block';
            const fotoReader = new FileReader();
            fotoReader.readAsDataURL(foto.files[0]);
            fotoReader.onload = function(fotoEvent) {
                fotoPreview.src = fotoEvent.target.result;
                fotoPreview.style.width = '100%';
            }
        }
    </script>
    {{-- <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
        <!-- <script
        src="https://cdn.ckeditor.com/ckeditor5/30.0.0/classic/ckeditor.js"></script> -->
        <script>
        ClassicEditor.create(document.querySelector('#ckeditor')).catch(error => {
        console.error(error);
        });
    </script>
     --}}
    <script>
        document.getElementById('resetButton').addEventListener('click', function() {
            // Menghapus parameter query dari URL
            const url = window.location.origin + window.location.pathname;
            window.location.href = url; // Memuat ulang halaman tanpa query string
        });
    </script>



</body>

</html>
