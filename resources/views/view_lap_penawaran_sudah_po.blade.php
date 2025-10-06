<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <!-- <link href="{{asset('public/template/vendor/bootstrap-5.0.2-dist/css/bootstrap.min.css')}}" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->
    <!-- Custom fonts for this template-->
    <link href="{{asset('public/template/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
      <link
          href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
          rel="stylesheet">

      <!-- Custom styles for this template-->
    <link href="{{asset('public/template/css/sb-admin-2.min.css')}}" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="{{asset('public/template/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">

    <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js" rel="stylesheet"> -->
    

    <link rel="icon" type="image/x-icon" href="{{asset('public/icon_pt_ace.png')}}">

    <title>PT ACE</title>

    
  </head>
  <body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
            <div class="sidebar-brand-icon rotate-n-0">
                <!-- <i class="fas fa-laugh-wink"></i> -->
                <img src="{{asset('public/icon_pt_ace.png')}}" height="70px" width="80px">
            </div>
        </a>
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
            <div>PT Anugrah Cipta Enginering</div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item">
            <a class="nav-link" href="<?php URL::to('/'); ?>home">
                <i class="fas fa-fw fa-home"></i>
                <span>Menu Utama</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            service
        </div>

        

        <!-- Menu Pelayanan -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-list-alt"></i>
                <span>Transaksi</span>
            </a>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Transaksi:</h6>
                    <a class="collapse-item" href="<?php URL::to('/'); ?>penawaran_sales">Penawaran Sales</a>
                    <a class="collapse-item" href="<?php URL::to('/'); ?>sales_order">Sales Order (SO)</a>
                    <a class="collapse-item" href="<?php URL::to('/'); ?>kartu_order">Kartu Order</a>
                    <a class="collapse-item" href="<?php URL::to('/'); ?>surat_jalan">Surat Jalan</a>
                        <a class="collapse-item" href="<?php URL::to('/'); ?>pembelian">Pembelian</a>
                </div>
            </div>
        </li>

        <!-- Nav Item - Utilities Collapse Menu -->
        <li class="nav-item" hidden>
            <a class="nav-link collapsed " href="#" data-toggle="collapse" data-target="#collapseUtilities"
                aria-expanded="true" aria-controls="collapseUtilities">
                <i class="fas fa-fw fa-database"></i>
                <span>Data Master</span>
            </a>
            <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Data Master:</h6>
                    <a class="collapse-item" href="<?php URL::to('/'); ?>admin">Admin</a>
                    <a class="collapse-item" href="<?php URL::to('/'); ?>pelanggan">Pelanggan</a>
                    <a class="collapse-item" href="<?php URL::to('/'); ?>sabun">Softergent & Softener</a>
                    <a class="collapse-item" href="<?php URL::to('/'); ?>reset_database">Reset</a>
                </div>
            </div>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Addons
        </div>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item active">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                aria-expanded="true" aria-controls="collapsePages">
                <i class="fas fa-fw fa-file"></i>
                <span>Laporan</span>
            </a>
            <div id="collapsePages" class="collapse show" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Laporan:</h6>
                    <a class="collapse-item" href="<?php URL::to('/'); ?>lappenawaranbelumpo">Penawaran Belum PO</a>
                    <a class="collapse-item active" href="<?php URL::to('/'); ?>lappenawaransudahpo">Penawaran Sudah PO</a>
                    <a class="collapse-item" href="<?php URL::to('/'); ?>lappembelian">Pembelian</a>
                </div>
            </div>
        </li>

        <!-- Nav Item - Charts -->
        <li class="nav-item">
            <a class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal">
                <i class="fas fa-fw fa-sign-out-alt"></i>
                <span>Logout</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 stphoatic-top shadow">

                <!-- Sidebar Toggle (Topbar) -->
                <form class="form-inline">
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                </form>

                <!-- Topbar Search -->
                <form
                    class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                    <div class="input-group">
                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                            aria-label="Search" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>
                </form>

                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">

                    <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                    <li class="nav-item dropdown no-arrow d-sm-none">
                        <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-search fa-fw"></i>
                        </a>
                        <!-- Dropdown - Messages -->
                        <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                            aria-labelledby="searchDropdown">
                            <form class="form-inline mr-auto w-100 navbar-search">
                                <div class="input-group">
                                    <input type="text" class="form-control bg-light border-0 small"
                                        placeholder="Search for..." aria-label="Search"
                                        aria-describedby="basic-addon2">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="button">
                                            <i class="fas fa-search fa-sm"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </li>

                    <div class="topbar-divider d-none d-sm-block"></div>

                    <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small"><b>{{ Auth::user()->name }}</span>
                            <img class="img-profile rounded-circle"
                                src="{{asset('public/template/img/undraw_profile.svg')}}">
                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                            aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                Logout
                            </a>
                        </div>
                    </li>

                </ul>

            </nav>
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->
                <h1 class="h3 mb-2 text-gray-800">Laporan Penawaran Sudah PO</h1>

                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <table border="0">
                            <tr>
                                <td width="200px">
                                    <label for="message-text" class="col-form-label">Tanggal Periode :</label>
                                </td>
                                <td width="300px">
                                    <input type="date" id="start_tgl_penawaran" name="start_tgl_penawaran" class="form-control form-control-sm-custom" value="{{ date('Y-m-d') }}"/>
                                </td>
                                <td width="30px" align="center">
                                    <label for="message-text" class="col-form-label"> s/d </label>
                                </td>
                                <td width="300px">
                                    <input type="date" id="end_tgl_penawaran" name="end_tgl_penawaran" class="form-control form-control-sm-custom" value="{{ date('Y-m-d') }}"/>
                                </td>
                            </tr>
                        </table><br>
                        <!-- <button type="button" class="btn btn-primary">Tambah Data</button> -->
                        <button type="button" class="btn btn-info btn-sm" id="preview_laporan" name="preview_laporan"><i class="fa fa-search" aria-hidden="true"></i>&nbsp;Preview</button>
                        <button type="button" class="btn btn-primary btn-sm" id="export_pdf" name="export_pdf"><i class="fas fa-print"></i>&nbsp;Export PDF</button>
                        <button type="button" class="btn btn-primary btn-sm" id="export_excel" name="export_excel"><i class="fa fa-download" aria-hidden="true"></i>&nbsp;Export Excel</button>
                    </div>
                </div>

                <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <!-- <button type="button" class="btn btn-primary">Tambah Data</button> -->
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Modal_add_purchase_order" data-whatever="@mdo" data-test="oke" hidden><i class="fas fa-user-plus"></i>&nbsp;Tambah Kartu Order</button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th width="15px">No</th>
                                            <th>No Penawaran</th>
                                            <th>Nama Customer</th>
                                            <th>Alamat Customer</th>
                                            <th>Nama Sales</th>
                                            <th>Tanggal Penawaran</th>
                                            <th>Total Penawaran</th>
                                            <th>Status Penawaran</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tableBody_ReportSudahPO"></tbody>
                                </table>
                            </div>
                        </div>
                    </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; 2025</span>
                </div>
            </div>
        </footer>
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

      <!-- Scroll to Top Button-->
      <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
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
                    <a class="btn btn-primary" href="{{ route('logoutaksi') }}">Logout</a>
                </div>
            </div>
        </div>
    </div>

    
    <!-- Modal Alert -->
    <div class="modal fade" id="Modal_alert" tabindex="-1" role="dialog" aria-labelledby="ModalLabel_alert" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Informasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p id="alert_informasi" name="alert_informasi"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-dismiss="modal" id="btn_kembali">Kembali</button>
            </div>
            </div>
        </div>
    </div>
    <!-- ENd Modal Alert -->

    <!-- Bootstrap core JavaScript-->
    <script src="{{asset('public/template/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('public/template/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{asset('public/template/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{asset('public/template/js/sb-admin-2.min.js')}}"></script>

    <!-- Page level plugins -->
    <script src="{{asset('public/template/vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('public/template/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

    <!-- Page level custom scripts -->
    <script src="{{asset('public/template/js/demo/datatables-demo.js')}}"></script>
    <!-- <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> -->
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    
    <style>
        /* Kecilkan ukuran modal */
        .modal-sm-custom {
            max-width: 900px; /* Ubah sesuai kebutuhan */
        }

        /* Kecilkan form-control */
        .form-control-sm-custom {
            padding: 0.25rem 0.5rem;
            font-size: 0.85rem;
            height: auto;
        }

        /* Kecilkan label */
        .col-form-label-sm-custom {
            font-size: 0.85rem;
            padding-top: 0.25rem;
            padding-bottom: 0.25rem;
        }

        /* Kecilkan table header */
        table.table th, table.table td {
            font-size: 0.85rem;
            padding: 0.4rem;
        }

        .table-input {
            padding: 2px 4px;   /* lebih kecil dari default */
            font-size: 12px;    /* perkecil font */
            height: 25px;       /* atur tinggi */
        }
    </style>

    <script type="text/javascript">
        function formatTanggal(tanggal) {
            if (!tanggal) return '';
            var d = new Date(tanggal);
            var options = { day: '2-digit', month: 'short', year: 'numeric' };
            return d.toLocaleDateString('en-GB', options).replace(/ /g, '-');
        }

        function formatRupiah(angka) {
            if (!angka) return "Rp 0";
            return new Intl.NumberFormat('id-ID', { 
                style: 'currency', 
                currency: 'IDR', 
                minimumFractionDigits: 0 
            }).format(angka);
        }

        $('#export_pdf').click(function(e){
            e.preventDefault();
            var validasi = 0;
            var msg = '';
            if($('#end_tgl_penawaran').val() == ''){
                validasi = 1;
                msg = 'Periode tanggal akhir belum diisi.';
            }
            if($('#start_tgl_penawaran').val() == ''){
                validasi = 1;
                msg = 'Periode tanggal awal belum di isi.';
            }
            
            if(validasi == 0){
                var params = "";
                var start_tgl_penawaran    = $('#start_tgl_penawaran').val();
                var end_tgl_penawaran      = $('#end_tgl_penawaran').val();
                
                var url = "<?php URL::to('/'); ?>export_penawaran_sudah_pdf?tgl_awal="+start_tgl_penawaran+"&tgl_akhir="+end_tgl_penawaran;
                var W = window.open(url,'_blank');
            }else{
                $("#alert_informasi").html(msg);
                $("#Modal_alert").find('.modal-title').text('Peringatan');
                $('#Modal_alert').modal({backdrop: 'static', keyboard: false});
            }

        });

        $('#export_excel').click(function(){
            var start_tgl_penawaran    = $('#start_tgl_penawaran').val();
            var end_tgl_penawaran      = $('#end_tgl_penawaran').val();
            // redirect untuk download
            window.open("{{ URL::to('/') }}/export_penawaran_sudah?tgl_awal=" + start_tgl_penawaran + "&tgl_akhir=" + end_tgl_penawaran, '_blank');
        });

        $('#preview_laporan').click(function (e) {
            e.preventDefault(); // cegah reload form/button default

            let validasi = 0;
            let msg = '';

            let start_tgl_penawaran = $('#start_tgl_penawaran').val();
            let end_tgl_penawaran   = $('#end_tgl_penawaran').val();

            if (end_tgl_penawaran === '') {
                validasi = 1;
                msg = 'Periode tanggal akhir belum diisi.';
            }
            if (start_tgl_penawaran === '') {
                validasi = 1;
                msg = 'Periode tanggal awal belum diisi.';
            }

            if (validasi === 0) {
                $.ajax({
                    url: "{{ url('/preview_lap_penawaran_sudah_po') }}",
                    type: "GET",
                    data: {
                        tgl_awal: start_tgl_penawaran,
                        tgl_akhir: end_tgl_penawaran
                    },
                    success: function (res) {
                        let tbody = $("#tableBody_ReportSudahPO");
                        tbody.empty(); // kosongkan isi tabel dulu

                        if (res.length > 0) {
                            $.each(res, function (i, item) {
                                let row = `
                                    <tr>
                                        <td>${i + 1}</td>
                                        <td>${item.no_transaksi}</td>
                                        <td>${item.nama_customer}</td>
                                        <td>${item.alamat_customer}</td>
                                        <td>${item.nama_sales}</td>
                                        <td>${formatTanggal(item.tanggal_penawaran)}</td>
                                        <td align="right">${formatRupiah(item.total_penawaran)}</td>
                                        <td>${item.status_po}</td>
                                    </tr>
                                `;
                                tbody.append(row);
                            });
                        } else {
                            tbody.append(`<tr><td colspan="5" class="text-center">Data tidak ditemukan</td></tr>`);
                        }
                    },
                    error: function (xhr) {
                        console.error(xhr.responseText);
                        alert("Gagal mengambil data laporan!");
                    }
                });
            } else {
                $("#alert_informasi").html(msg);
                $("#Modal_alert").find('.modal-title').text('Peringatan');
                $('#Modal_alert').modal({ backdrop: 'static', keyboard: false });
            }
        });


    </script> 