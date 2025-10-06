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
                        <a class="collapse-item" href="<?php URL::to('/'); ?>kartu_order">Kartu Order</a>
                        <a class="collapse-item" href="<?php URL::to('/'); ?>surat_jalan">Surat Jalan</a>
                        <a class="collapse-item active" href="<?php URL::to('/'); ?>pembelian">Pembelian</a>
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
                    <h1 class="h3 mb-2 text-gray-800">Pembelian</h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <!-- <button type="button" class="btn btn-primary">Tambah Data</button> -->
                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#Modal_add_pembelian" data-whatever="@mdo" data-test="oke"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Tambah Pembelian</button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th hidden>ID</th>
                                            <th hidden>No Transaksi</th>
                                            <th>No Pembelian</th>
                                            <th>Nama Vendor</th>
                                            <th>Alamat</th>
                                            <th>Tanggal Pembelian</th>
                                            <th>Total</th>
                                            <th>&nbsp;</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($res_pembelian as $key=>$value)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td hidden>{{ $value['id'] }}</td>
                                            <td hidden>{{ $value['no_transaksi'] }}</td>
                                            <td>{{ $value['no_pembelian'] }}</td>
                                            <td>{{ $value['nama_customer'] }}</td>
                                            <td>{{ $value['alamat'] }}</td>
                                            <td>{{ $value['tanggal_pembelian'] }}</td>
                                            <td>{{ $value['total'] }}</td>
                                            <td align="center">
                                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#Modal_detail_pembelian"
                                                    data-whatever="@mdo"
                                                    data-id="{{ $value['id'] }}"
                                                    data-no_transaksi="{{ $value['no_transaksi'] }}"
                                                    data-no_pembelian="{{ $value['no_pembelian'] }}"
                                                    data-nama_customer="{{ $value['nama_customer'] }}"
                                                    data-alamat="{{ $value['alamat'] }}"
                                                    data-total="{{ $value['total'] }}"
                                                    data-tanggal_pembelian="{{ $value['tanggal_pembelian'] }}"
                                                    data-jenis_order="{{ $value['jenis_order'] }}"
                                                    data-no_po_customer="{{ $value['no_po_customer'] }}"
                                                    data-flag_ppn="{{ $value['flag_ppn'] }}"
                                                    data-ppn="{{ $value['ppn'] }}">Detail</button>
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

    <div class="modal fade" id="Modal_add_pembelian" tabindex="-1" role="dialog" aria-labelledby="ModalLabel_add_pembelian" aria-hidden="true">
        <div class="modal-dialog modal-sm-custom" role="document">
            <div class="modal-content">
                <div class="modal-header py-2">
                    <h6 class="modal-title" id="ModalLabel_add_pembelian"><b>Tambah Pembelian</b></h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="font-size: 1.2rem;">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body py-2">
                    <form>
                        <div class="row">
                            <div class="col">
                                <div class="form-group mb-2">
                                    <label class="col-form-label col-form-label-sm-custom">No Pembelian :</label>
                                    <input type="text" class="form-control form-control-sm-custom" id="txt_no_pembelian" autocomplete="off" required>
                                </div>
                                <div class="form-group mb-2">
                                    <label class="col-form-label col-form-label-sm-custom">Nama Vendor :</label>
                                    <input type="text" class="form-control form-control-sm-custom" id="txt_nama_pembelian" autocomplete="off">
                                </div>
                                <div class="form-group mb-2" style="padding-top:10px;">
                                    <label class="col-form-label col-form-label-sm-custom">Jenis Order :</label>
                                    <select class="form-control form-control-sm-custom" id="txt_jenis_pembelian">
                                        <option value=""></option>
                                        <option value="ORDER PEMBELIAN">ORDER PEMBELIAN</option>
                                        <option value="ORDER KERJA">ORDER KERJA</option>
                                    </select>
                                </div>
                                <div class="form-group mb-2">
                                    <label class="col-form-label col-form-label-sm-custom">Alamat :</label>
                                    <input type="text" class="form-control form-control-sm-custom" id="txt_alamat" autocomplete="off">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group mb-2">
                                    <label class="col-form-label col-form-label-sm-custom">Tanggal Pembelian:</label>
                                    <input type="date" class="form-control form-control-sm-custom" id="txt_tgl_pembelian">
                                </div>
                                <div class="form-group mb-2">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group mb-2">
                                                <label class="col-form-label col-form-label-sm-custom">PPN :</label>
                                                <select class="form-control form-control-sm-custom" id="txt_pakai_ppn" onchange="pilihPPN(this.value)">
                                                    <option value="PPN">Ya</option>
                                                    <option value="NON_PPN" selected>Tidak</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group mb-2">
                                                <label class="col-form-label col-form-label-sm-custom">PPN :</label>
                                                <input type="number" class="form-control form-control-sm-custom" id="txt_ppn" autocomplete="off" value="0" onblur="hitungTotal(this)" disabled>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mb-2">
                                    <label class="col-form-label col-form-label-sm-custom">Total Pembelian :</label>
                                    <input type="text" class="form-control form-control-sm-custom" id="txt_total_pembelian" autocomplete="off" disabled>
                                </div>
                                <div class="form-group mb-2">
                                    <label class="col-form-label col-form-label-sm-custom">No PO :</label>
                                    <input type="text" class="form-control form-control-sm-custom" id="txt_no_po" autocomplete="off">
                                </div>
                            </div>
                        </div>

                        <div class="card shadow mb-3">
                            <div class="card-header py-1">

                            </div>
                            <div class="card-body p-2">
                                <div class="table-responsive" style="max-height: 200px; overflow-y: auto;">
                                    <table class="table table-bordered table-sm" id="dataTablePembelianDetail" width="100%" cellspacing="0">
                                        <thead style="position: sticky; top: 0; background: white; z-index: 2;">
                                            <tr>
                                                <th width="25px">No</th>
                                                <th width="200px">Item</th>
                                                <th width="50px">Jumlah</th>
                                                <th width="50px">Satuan</th>
                                                <th width="100px">Harga</th>
                                                <th width="10px"><button type="button" class="btn btn-primary btn-sm" id="btnTambahItem"><i class="fa fa-plus-circle" aria-hidden="true"></i></button></th>
                                            </tr>
                                        </thead>
                                        <tbody id="tableBody"></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer py-2">
                    <button type="button" class="btn btn-primary btn-sm" id="btn_simpan_pembelian" name="btn_simpan_pembelian">Simpan</button>
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                </div>
            </div>
        </div>
    </div>

    <!-- End Modal Tambah Data -->


    <!-- Modal Edit Data -->

    <div class="modal fade bd-example-modal-lg" id="Modal_detail_pembelian" tabindex="-1" role="dialog" aria-labelledby="ModalLabel_edit_admin" aria-hidden="true">
        <div class="modal-dialog modal-sm-custom" role="document">
            <div class="modal-content">
                <div class="modal-header py-2">
                    <h6 class="modal-title" id="ModalLabel_add_pembelian"><b>Detail Pembelian</b></h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="font-size: 1.2rem;">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body py-2">
                    <form>
                        <div class="row">
                            <div class="col">
                                <div class="form-group mb-2">
                                    <label class="col-form-label col-form-label-sm-custom">No Pembelian :</label>
                                    <input type="hidden" class="form-control form-control-sm-custom" id="txt_update_id" autocomplete="off" required>
                                    <input type="text" class="form-control form-control-sm-custom" id="txt_update_no_pembelian" autocomplete="off" required>
                                </div>
                                <div class="form-group mb-2">
                                    <label class="col-form-label col-form-label-sm-custom">Nama Vendor :</label>
                                    <input type="text" class="form-control form-control-sm-custom" id="txt_update_nama_pembelian" autocomplete="off">
                                </div>
                                <div class="form-group mb-2" style="padding-top:10px;">
                                    <label class="col-form-label col-form-label-sm-custom">Jenis Order :</label>
                                    <select class="form-control form-control-sm-custom" id="txt_update_jenis_pembelian">
                                        <option value=""></option>
                                        <option value="ORDER PEMBELIAN">ORDER PEMBELIAN</option>
                                        <option value="ORDER KERJA">ORDER KERJA</option>
                                    </select>
                                </div>
                                <div class="form-group mb-2">
                                    <label class="col-form-label col-form-label-sm-custom">Alamat :</label>
                                    <input type="text" class="form-control form-control-sm-custom" id="txt_update_alamat" autocomplete="off">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group mb-2">
                                    <label class="col-form-label col-form-label-sm-custom">Tanggal Pembelian:</label>
                                    <input type="date" class="form-control form-control-sm-custom" id="txt_update_tgl_pembelian">
                                </div>
                                <div class="form-group mb-2">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group mb-2">
                                                <label class="col-form-label col-form-label-sm-custom">PPN :</label>
                                                <select class="form-control form-control-sm-custom" id="txt_update_pakai_ppn" onchange="pilihUpdatePPN(this.value)">
                                                    <option value="PPN">Ya</option>
                                                    <option value="NON_PPN" selected>Tidak</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group mb-2">
                                                <label class="col-form-label col-form-label-sm-custom">PPN :</label>
                                                <input type="number" class="form-control form-control-sm-custom" id="txt_update_ppn" autocomplete="off" value="0" onblur="hitungTotal(this)" disabled>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mb-2">
                                    <label class="col-form-label col-form-label-sm-custom">Total Pembelian :</label>
                                    <input type="text" class="form-control form-control-sm-custom" id="txt_update_total_pembelian" autocomplete="off" disabled>
                                </div>
                                <div class="form-group mb-2">
                                    <label class="col-form-label col-form-label-sm-custom">No PO :</label>
                                    <input type="text" class="form-control form-control-sm-custom" id="txt_update_no_po" autocomplete="off">
                                </div>
                            </div>
                        </div>

                        <div class="card shadow mb-3">
                            <div class="card-header py-1">

                            </div>
                            <div class="card-body p-2">
                                <div class="table-responsive" style="max-height: 200px; overflow-y: auto;">
                                    <table class="table table-bordered table-sm" id="dataTablePembelianDetail_update" width="100%" cellspacing="0">
                                        <thead style="position: sticky; top: 0; background: white; z-index: 2;">
                                            <tr>
                                                <th width="25px">No</th>
                                                <th width="200px">Item</th>
                                                <th width="50px">Jumlah</th>
                                                <th width="50px">Satuan</th>
                                                <th width="100px">Harga</th>
                                                <th width="10px"><button type="button" class="btn btn-primary btn-sm" id="btnTambahItem_update"><i class="fa fa-plus-circle" aria-hidden="true"></i></button></th>
                                            </tr>
                                        </thead>
                                        <tbody id="tableBody_update"></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info" id="btn_cetak_pembelian" name="btn_cetak_pembelian">Cetak</button>
                    <button type="button" class="btn btn-success" id="btn_update_pembelian" name="btn_update_pembelian">Simpan</button>
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
                    <button type="button" class="btn btn-danger" data-dismiss="modal" id="btn_kembali">Kembali</button>
                    <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                </div>
            </div>
        </div>
    </div>
    <!-- ENd Modal Alert -->

    <!-- Modal Alert -->
    <div class="modal fade" id="Modal_alert_cetak" tabindex="-1" role="dialog" aria-labelledby="ModalLabel_alert" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Informasi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p id="alert_informasi_cetak" name="alert_informasi"></p>
                    <input type="hidden" id="view_nomor_transaksi" name="view_nomor_transaksi">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal" id="btn_kembali">Kembali</button>
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
            max-width: 750px;
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
    </style>

    <script type="text/javascript">
        var noUrut = 1; // nomor urut awal
        document.getElementById('btnTambahItem').addEventListener('click', function() {
            let tbody = document.getElementById('tableBody');

            // Buat elemen <tr>
            let tr = document.createElement('tr');

            tr.innerHTML = `
                <td width="25px" align="center">${noUrut++}</td>
                <td width="200px"><input type="text" name="item[]" class="form-control" autocomplete="off"></td>
                <td width="50px"><input type="number" name="jumlah[]" class="form-control" autocomplete="off"></td>
                <td width="50px"><input type="text" name="satuan[]" class="form-control" autocomplete="off"></td>
                <td width="100px"><input type="number" name="harga[]" class="form-control" autocomplete="off" onblur="hitungTotal(this)"></td>
                <td width="10px">
                    <button type="button" class="btn btn-danger btn-sm btnHapus"><i class="fa fa-minus-circle" aria-hidden="true"></i></button>
                </td>
            `;

            tbody.appendChild(tr);

            // Event hapus per baris
            tr.querySelector('.btnHapus').addEventListener('click', function() {
                tr.remove();
                updateNomor();
            });
        });

        // Update nomor setelah hapus
        function updateNomor() {
            let rows = document.querySelectorAll('#tableBody tr');
            rows.forEach((row, index) => {
                row.cells[0].textContent = index + 1;
            });
            noUrut = rows.length + 1;
        }


        function pilihPPN(value) {
            if (value === "PPN") {
                $('#txt_ppn').val(11).prop('disabled', false); // isi 11 dan aktifkan
            } else {
                $('#txt_ppn').val(0).prop('disabled', true); // isi 0 dan nonaktifkan
            }
            hitungTotal();
        }


        function pilihUpdatePPN(value) {
            if (value === "PPN") {
                $('#txt_update_ppn').val(11).prop('disabled', false); // isi 11 dan aktifkan
            } else {
                $('#txt_update_ppn').val(0).prop('disabled', true); // isi 0 dan nonaktifkan
            }
            hitungTotalUpdate();
        }

        function hitungTotal() {
            var totalPembelian = 0;
            var rows = document.querySelectorAll('#tableBody tr');

            rows.forEach(row => {
                var jumlah = parseFloat(row.querySelector('input[name="jumlah[]"]').value) || 0;
                var harga = parseFloat(row.querySelector('input[name="harga[]"]').value) || 0;
                var subtotal = jumlah * harga;
                totalPembelian += subtotal;
            });

            // Ambil nilai PPN
            var nominalPPN = (totalPembelian * parseFloat($('#txt_ppn').val()) / 100) || 0;

            // Total akhir ditambah PPN
            var totalAkhir = totalPembelian + nominalPPN;

            // Tampilkan total ke input total pembelian
            // document.getElementById('txt_update_total_pembelian').value = totalPembelian.toLocaleString();
            document.getElementById('txt_total_pembelian').value = totalAkhir;
        }

        var noUrutUpdate = 1; // nomor urut awal
        document.getElementById('btnTambahItem_update').addEventListener('click', function() {
            let tbody = document.getElementById('tableBody_update');

            let tr = document.createElement('tr');

            tr.innerHTML = `
                <td width="25px" align="center"></td>
                <td width="200px"><input type="text" name="update_item[]" class="form-control" autocomplete="off"></td>
                <td width="50px"><input type="number" name="update_jumlah[]" class="form-control" autocomplete="off"></td>
                <td width="50px"><input type="text" name="update_satuan[]" class="form-control" autocomplete="off"></td>
                <td width="100px"><input type="number" name="update_harga[]" class="form-control" autocomplete="off" onblur="hitungTotalUpdate(this)"></td>
                <td width="10px">
                    <button type="button" class="btn btn-danger btn-sm btnHapusUpdate">
                        <i class="fa fa-minus-circle" aria-hidden="true"></i>
                    </button>
                </td>
            `;

            tbody.appendChild(tr);

            // Event hapus per baris
            tr.querySelector('.btnHapusUpdate').addEventListener('click', function() {
                tr.remove();
                updateNomorUpdate();
            });

            // Update nomor setelah tambah
            updateNomorUpdate();
        });

        function updateNomorUpdate() {
            let rows = document.querySelectorAll('#tableBody_update tr');
            rows.forEach((row, index) => {
                row.cells[0].textContent = index + 1;
            });
            noUrutUpdate = rows.length + 1;
        }

        function hitungTotalUpdate() {
            var totalPembelian = 0;
            var rows = document.querySelectorAll('#tableBody_update tr');

            rows.forEach(row => {
                var jumlah = parseFloat(row.querySelector('input[name="update_jumlah[]"]').value) || 0;
                var harga = parseFloat(row.querySelector('input[name="update_harga[]"]').value) || 0;
                var subtotal = jumlah * harga;
                totalPembelian += subtotal;
            });

            // Ambil nilai PPN
            var nominalPPN = (totalPembelian * parseFloat($('#txt_update_ppn').val()) / 100) || 0;

            // Total akhir ditambah PPN
            var totalAkhir = totalPembelian + nominalPPN;

            // Tampilkan total ke input total pembelian
            // document.getElementById('txt_update_total_pembelian').value = totalPembelian.toLocaleString();
            document.getElementById('txt_update_total_pembelian').value = totalAkhir;
        }

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

        $('#Modal_detail_pembelian').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var modal = $(this);
            var id = button.data('id');
            var no_pembelian = button.data('no_pembelian');
            var nama_customer = button.data('nama_customer');
            var alamat = button.data('alamat');
            var total = button.data('total');
            var tanggal_pembelian = button.data('tanggal_pembelian');
            var jenis_order = button.data('jenis_order');
            var no_po_customer = button.data('no_po_customer');
            var onlyDate = tanggal_pembelian.split(" ")[0];
            var onlyDateTglTempo = tanggal_pembelian.split(" ")[0];
            var flag_ppn = button.data('flag_ppn');
            var ppn = button.data('ppn');

            $('#txt_update_id').val(id);
            $('#txt_update_no_pembelian').val(no_pembelian).prop('disabled', true);
            $('#txt_update_nama_pembelian').val(nama_customer).prop('disabled', true);
            $('#txt_update_tgl_pembelian').val(onlyDateTglTempo).prop('disabled', true);
            $('#txt_update_total_pembelian').val(total).prop('disabled', true);
            $('#txt_update_jenis_pembelian').val(jenis_order);
            $('#txt_update_no_po').val(no_po_customer);
            if (flag_ppn == 'PPN') {
                $('#txt_update_pakai_ppn').val('PPN');
                $('#txt_update_ppn').val(ppn);
            } else {
                $('#txt_update_pakai_ppn').val('NON_PPN');
                $('#txt_update_ppn').val(0);
            }

            $.ajax({
                type: 'POST',
                url: "<?php echo URL::to('/'); ?>/get_data_pembelian", // jangan lupa echo
                data: {
                    id: id
                },
                success: function(res) {
                    const cst = JSON.parse(res);
                    console.log(res);

                    let tbody = document.getElementById('tableBody_update');
                    tbody.innerHTML = ""; // clear table body
                    let noUrut = 1;

                    cst.forEach(item => {
                        let tr = document.createElement('tr');
                        tr.innerHTML = `
                            <td width="25px" align="center">${noUrut++}</td>
                            <td width="200px"><input type="text" name="update_item[]" value="${item.nama_item}" class="form-control" autocomplete="off"></td>
                            <td width="50px"><input type="number" name="update_jumlah[]" value="${item.jumlah}" class="form-control" autocomplete="off"></td>
                            <td width="50px"><input type="text" name="update_satuan[]" value="${item.satuan}" class="form-control" autocomplete="off"></td>
                            <td width="100px"><input type="number" name="update_harga[]" value="${item.harga}" class="form-control" autocomplete="off" onblur="hitungTotalUpdate(this)"></td>
                            <td width="10px"><button type="button" class="btn btn-danger btn-sm btnHapusUpdate"><i class="fa fa-minus-circle" aria-hidden="true"></i></button></td>
                        `;

                        // Event hapus baris
                        tr.querySelector('.btnHapusUpdate').addEventListener('click', function() {
                            tr.remove();
                            updateNomor();
                        });

                        tbody.appendChild(tr);
                    });
                }
            });
        });

        $('#Modal_add_pembelian').on('show.bs.modal', function(event) {
            $.ajax({
                type: 'POST',
                url: "<?php URL::to('/'); ?>generate_no_pembelian",
                data: {
                    id: '',
                },
                success: function(res) {
                    var cst = JSON.parse(res);
                    $('#txt_no_pembelian').val(cst.no_pembelian);
                }
            });
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#btn_simpan_pembelian').click(function(e) {
            e.preventDefault();
            var no_pembelian = $('#txt_no_pembelian').val();
            var nama_pembeli = $('#txt_nama_pembelian').val();
            var tgl_pembelian = $('#txt_tgl_pembelian').val();
            var total_pembelian = $('#txt_total_pembelian').val();
            var jenis_pembelian = $('#txt_jenis_pembelian').val();
            var no_po = $('#txt_no_po').val();
            var alamat = $('#txt_alamat').val();
            var flag_ppn = $('#txt_pakai_ppn').val();
            var ppn = $('#txt_ppn').val();

            // Ambil data dari tabel
            var detailPembelian = [];
            $('#dataTablePembelianDetail tbody tr').each(function() {
                var item = $(this).find('input[name="item[]"]').val();
                var jumlah = $(this).find('input[name="jumlah[]"]').val();
                var satuan = $(this).find('input[name="satuan[]"]').val();
                var harga = $(this).find('input[name="harga[]"]').val();


                if (item) { // hanya masukkan jika ada item
                    detailPembelian.push({
                        item: item,
                        jumlah: jumlah,
                        satuan: satuan,
                        harga: harga
                    });
                }
            });

            $.ajax({
                type: 'POST',
                url: "<?php URL::to('/'); ?>simpan_pembelian",
                data: {
                    no_pembelian: no_pembelian,
                    nama_pembeli: nama_pembeli,
                    tgl_pembelian: tgl_pembelian,
                    total_pembelian: total_pembelian,
                    jenis_pembelian: jenis_pembelian,
                    no_po: no_po,
                    alamat: alamat,
                    flag_ppn: flag_ppn,
                    ppn: ppn,
                    detail_pembelian: JSON.stringify(detailPembelian) // encode ke JSON string
                },
                success: function(res) {
                    const cst = JSON.parse(res);

                    $("#view_nomor_transaksi").val(cst.id);
                    $("#btn_oke_alert").show();
                    $("#btn_kembali").hide();
                    $('#Modal_detail_pembelian').modal('hide');
                    $("#alert_informasi").html(cst.message);
                    $("#Modal_alert").find('.modal-title').text(cst.title);
                    $('#Modal_alert').modal({
                        backdrop: 'static',
                        keyboard: false
                    });

                }
            });

        });

        $('#btn_update_pembelian').click(function(e) {
            e.preventDefault();
            var id = $('#txt_update_id').val();
            var no_pembelian = $('#txt_update_no_pembelian').val();
            var nama_pembeli = $('#txt_update_nama_pembelian').val();
            var tgl_pembelian = $('#txt_update_tgl_pembelian').val();
            var total_pembelian = $('#txt_update_total_pembelian').val();
            var jenis_pembelian = $('#txt_update_jenis_pembelian').val();
            var no_po = $('#txt_update_no_po').val();
            var alamat = $('#txt_update_alamat').val();
            var flag_ppn = $('#txt_update_pakai_ppn').val();
            var ppn = $('#txt_update_ppn').val();

            // Ambil data dari tabel
            var detailPembelian = [];
            $('#dataTablePembelianDetail_update tbody tr').each(function() {
                var item = $(this).find('input[name="update_item[]"]').val();
                var jumlah = $(this).find('input[name="update_jumlah[]"]').val();
                var satuan = $(this).find('input[name="update_satuan[]"]').val();
                var harga = $(this).find('input[name="update_harga[]"]').val();


                if (item) { // hanya masukkan jika ada item
                    detailPembelian.push({
                        item: item,
                        jumlah: jumlah,
                        satuan: satuan,
                        harga: harga
                    });
                }
            });

            $.ajax({
                type: 'POST',
                url: "<?php URL::to('/'); ?>update_pembelian",
                data: {
                    id: id,
                    no_pembelian: no_pembelian,
                    nama_pembeli: nama_pembeli,
                    tgl_pembelian: tgl_pembelian,
                    total_pembelian: total_pembelian,
                    jenis_pembelian: jenis_pembelian,
                    no_po: no_po,
                    alamat: alamat,
                    flag_ppn: flag_ppn,
                    ppn: ppn,
                    detail_pembelian: JSON.stringify(detailPembelian) // encode ke JSON string
                },
                success: function(res) {
                    const cst = JSON.parse(res);

                    $("#view_nomor_transaksi").val(cst.id);
                    $("#btn_oke_alert").show();
                    $("#btn_kembali").hide();
                    $('#Modal_detail_pembelian').modal('hide');
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
            /*if(id != ''){
                var url = "<?php URL::to('/'); ?>cetakpurchaseorder?params="+id;
                var W = window.open(url,'_blank');
                W.window.print();

            }*/
            window.location = "<?php URL::to('/'); ?>pembelian";
        });

        $('#btn_cetak_pembelian').click(function(e) {
            e.preventDefault();

            var id = $("#txt_update_id").val();
            var jenis_pembelian = $("#txt_update_jenis_pembelian").val();

            var tmpId = btoa(id); // encode base64
            var tmpJenisPembelian = btoa(jenis_pembelian); // encode base64

            // cek apakah jenis pembelian sudah dipilih
            if (jenis_pembelian == '' || jenis_pembelian == null) {
                $("#alert_informasi_cetak").html("Silakan pilih <b>Jenis Pembelian</b> terlebih dahulu!");
                // $("#btn_oke_alert").show();
                $("#btn_kembali").show();
                $("#Modal_alert_cetak").modal('show');
                return false; // hentikan proses
            }

            if (id != '') {
                var url = "{{ URL::to('/') }}/cetakpembelian?params=" + tmpId + "&paramsJenisPembelian=" + tmpJenisPembelian;
                var W = window.open(url, '_blank');
                W.window.print();
            }

            window.location = "{{ URL::to('/') }}/pembelian";
        });

        $(document).ready(function() {
            const today = new Date();
            const yyyy = today.getFullYear();
            const mm = String(today.getMonth() + 1).padStart(2, '0'); // bulan 0-11
            const dd = String(today.getDate()).padStart(2, '0');
            const todayStr = `${yyyy}-${mm}-${dd}`;
            document.getElementById('txt_tgl_pembelian').value = todayStr;
            document.getElementById('txt_tgl_tempo').value = todayStr;


            // let jenisPembayaran = document.getElementById('txt_total_pembelian');
            // let fgTempo = document.getElementById('fg_tgl_tempo');
            // let fgDP = document.getElementById('fg_nominal_dp');
            var txtNominalDP = document.getElementById('txt_nominal_dp');
            var txtTotalBayar = document.getElementById('txt_total_bayar');
            var txtSisa = document.getElementById('txt_sisa_pembayaran');

            $("#btn_kembali").hide();

            // Event hitung sisa pembayaran saat blur Nominal DP
            txtNominalDP.addEventListener('blur', function() {
                var total = parseFloat(txtTotalBayar.value) || 0;
                var dp = parseFloat(txtNominalDP.value) || 0;
                var sisa = total - dp;
                var v_sisa = 0;

                txtSisa.value = sisa >= 0 ? sisa : 0; // supaya tidak minus
                v_sisa = sisa >= 0 ? sisa : 0;
                document.getElementById('txt_sisa_pembayaran_view').value = new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR'
                }).format(v_sisa);
            });

        });
    </script>

</body>

</html>