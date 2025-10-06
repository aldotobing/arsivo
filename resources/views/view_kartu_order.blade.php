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
                <div>ARSIVO</div>
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
            <li class="nav-item active">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-list-alt"></i>
                    <span>Transaksi</span>
                </a>
                <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Transaksi:</h6>
                        <a class="collapse-item" href="<?php URL::to('/'); ?>penawaran_sales">Penawaran Sales</a>
                        <a class="collapse-item" href="<?php URL::to('/'); ?>sales_order">Sales Order (SO)</a>
                        <a class="collapse-item active" href="<?php URL::to('/'); ?>kartu_order">Kartu Order</a>
                        <a class="collapse-item" href="<?php URL::to('/'); ?>surat_jalan">Surat Jalan</a>
                        <a class="collapse-item" href="<?php URL::to('/'); ?>pembelian">Pembelian</a>
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
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-file"></i>
                    <span>Laporan</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Laporan:</h6>
                        <a hidden class="collapse-item" href="<?php URL::to('/'); ?>lappenawaranbelumpo">Penawaran Belum PO</a>
                        <a hidden class="collapse-item" href="<?php URL::to('/'); ?>lappenawaransudahpo">Penawaran Sudah PO</a>
                        <a class="collapse-item" href="<?php URL::to('/'); ?>lappenawaran">Penawaran</a>
                        <a class="collapse-item" href="<?php URL::to('/'); ?>lapomset">Omset</a>
                        <a class="collapse-item" href="<?php URL::to('/'); ?>laprevenue">Revenue</a>
                        <a class="collapse-item" href="<?php URL::to('/'); ?>lappembelian">Order Kerja</a>
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
                    <h1 class="h3 mb-2 text-gray-800">Kartu Order</h1>

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
                                            <th hidden>ID</th>
                                            <th>No Penawaran</th>
                                            <th>No Purchase Order</th>
                                            <th>Nama Customer</th>
                                            <th>Sales</th>
                                            <th>Tanggal PO</th>
                                            <th>Jenis Pembayaran</th>
                                            <th>&nbsp;</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($res_kartu_order as $key=>$value)
                                        <tr>
                                            <td align="center">{{ $key + 1 }}</td>
                                            <td hidden>{{ $value['id'] }}</td>
                                            <td>{{ $value['no_po'] }}</td>
                                            <td>{{ $value['no_penawaran'] }}</td>
                                            <td>{{ $value['nama_customer'] }}</td>
                                            <td>{{ $value['nama_sales'] }}</td>
                                            <td>{{ $value['tgl_po'] }}</td>
                                            <td>{{ $value['jenis_pembayaran'] }}</td>
                                            <td align="center">
                                                <button type="button"
                                                    class="btn btn-success btn-sm btn-cetak-po"
                                                    data-id_po="{{ $value['id'] }}">
                                                    Cetak
                                                </button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
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


    <!-- Modal Tambah Data -->

    <div class="modal fade" id="Modal_add_purchase_order" tabindex="-1" role="dialog" aria-labelledby="ModalLabel_add_purchase_order" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel_add_purchase_order"><b>Tambah Kartu Order</b></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">No Order :</label>
                                    <input type="text" class="form-control" id="txt_no_order" autocomplete="off" required>
                                    <div class="invalid-feedback">
                                        Please choose a username.
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">No Kartu Order :</label>
                                    <input type="text" class="form-control" id="txt_no_po" autocomplete="off" required>
                                    <div class="invalid-feedback">
                                        Please choose a username.
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="message-text" class="col-form-label">Nama Customer :</label>
                                    <input type="text" class="form-control" id="txt_nama_customer" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label for="message-text" class="col-form-label">Alamat Customer :</label>
                                    <input type="text" class="form-control" id="txt_alamat_customer" autocomplete="off">
                                    <!-- <input type="number" class="form-control" id="txt_tambah_no_telepon"> -->
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="message-text" class="col-form-label">Tanggal Kartu Order :</label>
                                    <input type="date" class="form-control" id="txt_tgl_purchase_order">
                                </div>
                                <div class="form-group">
                                    <label for="message-text" class="col-form-label">Jenis Pembayaran :</label>
                                    <select class="form-control" id="txt_jenis_pembayaran">
                                        <option value="">-- Pilih Jenis Pembayaran --</option>
                                        <option value="DP">DP</option>
                                        <option value="FULL PAYMENT">FULL PAYMENT</option>
                                        <option value="TEMPO">TEMPO</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="message-text" class="col-form-label">Total Pembayaran :</label>
                                    <input type="number" class="form-control" id="txt_total_bayar">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="btn_add_purchase_order" name="btn_add_purchase_order">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                </div>
            </div>
        </div>
    </div>

    <!-- End Modal Tambah Data -->


    <!-- Modal Edit Data -->

    <div class="modal fade bd-example-modal-lg" id="Modal_detail_purchase_order" tabindex="-1" role="dialog" aria-labelledby="ModalLabel_edit_admin" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel_edit_admin">Detail Kartu Order</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">No Order :</label>
                                    <input type="hidden" class="form-control" id="txt_update_id" autocomplete="off" required>
                                    <input type="text" class="form-control" id="txt_update_no_order" autocomplete="off" required>
                                    <div class="invalid-feedback">
                                        Please choose a username.
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">No Kartu Order :</label>
                                    <input type="text" class="form-control" id="txt_update_no_po" autocomplete="off" required>
                                    <div class="invalid-feedback">
                                        Please choose a username.
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="message-text" class="col-form-label">Nama Customer :</label>
                                    <input type="text" class="form-control" id="txt_update_nama_customer" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label for="message-text" class="col-form-label">Alamat Customer :</label>
                                    <input type="text" class="form-control" id="txt_update_alamat_customer" autocomplete="off">
                                    <!-- <input type="number" class="form-control" id="txt_tambah_no_telepon"> -->
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="message-text" class="col-form-label">Tanggal Kartu Order :</label>
                                    <input type="date" class="form-control" id="txt_update_tgl_purchase_order">
                                </div>
                                <div class="form-group">
                                    <label for="message-text" class="col-form-label">Jenis Pembayaran :</label>
                                    <select class="form-control" id="txt_update_jenis_pembayaran">
                                        <option value="">-- Pilih Jenis Pembayaran --</option>
                                        <option value="DP">DP</option>
                                        <option value="FULL PAYMENT">FULL PAYMENT</option>
                                        <option value="TEMPO">TEMPO</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="message-text" class="col-form-label">Total Pembayaran :</label>
                                    <input type="number" class="form-control" id="txt_update_total_bayar">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info" id="btn_cetak_purchase_order" name="btn_cetak_purchase_order" hidden>Cetak</button>
                    <button type="button" class="btn btn-success" id="btn_update_purchase_order" name="btn_update_purchase_order">Simpan</button>
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Batal</button>
                </div>
            </div>
        </div>
    </div>

    <!-- End Modal Edit Data -->

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
                    <input type="hidden" id="view_nomor_transaksi" name="view_nomor_transaksi">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info" data-dismiss="modal" id="btn_oke_alert" name="btn_oke_alert">Kembali</button>
                    <button type="button" class="btn btn-info" data-dismiss="modal" id="btn_kembali">Kembali</button>
                    <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
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
            max-width: 900px;
            /* Ubah sesuai kebutuhan */
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
        table.table th,
        table.table td {
            font-size: 0.85rem;
            padding: 0.4rem;
        }

        .table-input {
            padding: 2px 4px;
            /* lebih kecil dari default */
            font-size: 12px;
            /* perkecil font */
            height: 25px;
            /* atur tinggi */
        }
    </style>

    <script type="text/javascript">
        $('#Modal_add_admin').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var recipient = button.data('whatever') // Extract info from data-* attributes
            var test = button.data('test');
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this)
            // modal.find('.modal-title').text('New message to ' + recipient + test)
            // modal.find('.modal-body input').val(recipient)
            // $('#txt_nama_admin').val(test);

            // $('#message-text').val(test)

            $('#txt_nama_admin').val('');
            $('#txt_user_name').val('');
            $('#txt_password').val('');
        });

        $('#Modal_detail_purchase_order').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var modal = $(this);
            var id_po = button.data('id_po');
            var no_order = button.data('no_order');
            var no_po_customer = button.data('no_po_customer');
            var nama_customer = button.data('nama_customer');
            var alamat_customer = button.data('alamat_customer');
            var tanggal_po = button.data('tanggal_po');
            var jenis_pembayaran = button.data('jenis_pembayaran');
            var total_pembayaran = button.data('total_pembayaran');
            var onlyDate = tanggal_po.split(" ")[0];


            $('#txt_update_id').prop('disabled', true);
            $('#txt_update_no_order').prop('disabled', true);

            $('#txt_update_id').val(id_po);
            $('#txt_update_no_order').val(no_order);
            $('#txt_update_no_po').val(no_po_customer);
            $('#txt_update_nama_customer').val(nama_customer);
            $('#txt_update_alamat_customer').val(alamat_customer);
            $('#txt_update_tgl_purchase_order').val(onlyDate);
            $('#txt_update_jenis_pembayaran').val(jenis_pembayaran);
            $('#txt_update_total_bayar').val(total_pembayaran);
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#btn_add_purchase_order').click(function(e) {
            e.preventDefault();
            var no_order = $('#txt_no_order').val();
            var no_po = $('#txt_no_po').val();
            var nama_customer = $('#txt_nama_customer').val();
            var alamat_customer = $('#txt_alamat_customer').val();
            var tgl_po = $('#txt_tgl_purchase_order').val();
            var jenis_pembayaran = $('#txt_jenis_pembayaran').val();
            var total_bayar = $('#txt_total_bayar').val();

            $.ajax({
                type: 'POST',
                url: "<?php URL::to('/'); ?>simpan_purchase_order",
                data: {
                    no_order: no_order,
                    no_po: no_po,
                    nama_customer: nama_customer,
                    alamat_customer: alamat_customer,
                    tgl_po: tgl_po,
                    jenis_pembayaran: jenis_pembayaran,
                    total_bayar: total_bayar
                },
                success: function(res) {
                    const cst = JSON.parse(res);

                    $("#view_nomor_transaksi").val(cst.id);
                    $("#btn_oke_alert").show();
                    $("#btn_kembali").hide();
                    $('#Modal_detail_purchase_order').modal('hide');
                    $("#alert_informasi").html(cst.message);
                    $("#Modal_alert").find('.modal-title').text(cst.title);
                    $('#Modal_alert').modal({
                        backdrop: 'static',
                        keyboard: false
                    });

                }
            });

        });

        $('#btn_update_purchase_order').click(function(e) {
            e.preventDefault();
            var id_po = $('#txt_update_id').val();
            var no_order = $('#txt_update_no_order').val();
            var no_po = $('#txt_update_no_po').val();
            var nama_customer = $('#txt_update_nama_customer').val();
            var alamat_customer = $('#txt_update_alamat_customer').val();
            var tgl_po = $('#txt_update_tgl_purchase_order').val();
            var jenis_pembayaran = $('#txt_update_jenis_pembayaran').val();
            var total_bayar = $('#txt_update_total_bayar').val();

            $.ajax({
                type: 'POST',
                url: "<?php URL::to('/'); ?>update_purchase_order",
                data: {
                    id_po: id_po,
                    no_order: no_order,
                    no_po: no_po,
                    nama_customer: nama_customer,
                    alamat_customer: alamat_customer,
                    tgl_po: tgl_po,
                    jenis_pembayaran: jenis_pembayaran,
                    total_bayar: total_bayar
                },
                success: function(res) {
                    const cst = JSON.parse(res);

                    $("#view_nomor_transaksi").val(cst.id);
                    $("#btn_oke_alert").show();
                    $("#btn_kembali").hide();
                    $('#Modal_detail_purchase_order').modal('hide');
                    $("#alert_informasi").html(cst.message);
                    $("#Modal_alert").find('.modal-title').text(cst.title);
                    $('#Modal_alert').modal({
                        backdrop: 'static',
                        keyboard: false
                    });
                }
            });
        });

        $('#btn_oke_alert').click(function(e) {
            e.preventDefault();
            var id = $("#view_nomor_transaksi").val();
            if (id != '') {
                var url = "<?php URL::to('/'); ?>cetakkartuorder?params=" + id;
                var W = window.open(url, '_blank');
                W.window.print();

            }
            // window.location = "<?php URL::to('/'); ?>kartu_order";
        });

        $(document).on('click', '.btn-cetak-po', function(e) {
            e.preventDefault();
            var id = $(this).data('id_po');
            var id_base64 = btoa(id); // convert ke base64
            if (id !== '') {
                var url = "{{ URL::to('/') }}/cetakkartuorder?params=" + id_base64;
                var W = window.open(url, '_blank');
                W.focus(); // Optional: focus ke window baru
                W.print(); // Otomatis langsung cetak
            }

            // Redirect ke halaman purchase_order (bisa dihapus kalau tidak diinginkan)
            window.location = "{{ URL::to('/') }}/kartu_order";
        });


        $(document).ready(function() {
            const today = new Date();
            const yyyy = today.getFullYear();
            const mm = String(today.getMonth() + 1).padStart(2, '0'); // bulan 0-11
            const dd = String(today.getDate()).padStart(2, '0');
            const todayStr = `${yyyy}-${mm}-${dd}`;
            document.getElementById('txt_tgl_purchase_order').value = todayStr;

            $("#btn_kembali").hide();

        });
    </script>
</body>

</html>