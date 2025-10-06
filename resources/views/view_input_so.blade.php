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
                        <a class="collapse-item active" href="<?php URL::to('/'); ?>sales_order">Sales Order (SO)</a>
                        <a class="collapse-item" href="<?php URL::to('/'); ?>kartu_order">Kartu Order</a>
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
                    <h1 class="h3 mb-2 text-gray-800">Sales Order</h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3" hidden>
                            <!-- <button type="button" class="btn btn-primary">Tambah Data</button> -->
                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#Modal_add_penawaran" data-whatever="@mdo" data-test="oke"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Tambah Penawaran</button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th hidden>ID</th>
                                            <th>No Penawaran</th>
                                            <th>Nama Customer</th>
                                            <th>Alamat Customer</th>
                                            <th>Nama Sales</th>
                                            <th>Tanggal Penawaran</th>
                                            <th>Ppn</th>
                                            <th>Total</th>
                                            <th width="140px">&nbsp;</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($res_penawaran as $key=>$value)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td hidden>{{ $value['id'] }}</td>
                                            <td>{{ $value['no_penawaran'] }}</td>
                                            <td>{{ $value['nama_customer'] }}</td>
                                            <td>{{ $value['alamat_customer'] }}</td>
                                            <td>{{ $value['nama_sales'] }}</td>
                                            <td>{{ $value['tanggal_penawaran'] }}</td>
                                            <td align='right'>{{ $value['ppn'] }}</td>
                                            <td align='right'>{{ number_format($value['total_penawaran'], 0, ',', '.') }}</td>
                                            <td align="center">
                                                @if ($value['status_po'] === 'Y')
                                                <!-- Tampilkan tombol Cetak -->
                                                <button type="button" class="btn btn-success btn-sm" id="btn_cetak_po" name="btn_cetak_po" onclick="cetakSO('{{ $value['id'] }}')"><i class="fas fa-print"></i> SO</button>
                                                <!-- <button type="button" class="btn btn-success btn-sm" id="btn_cetak_invoice" name="btn_cetak_invoice" onclick="cetakInvoice('{{ $value['id'] }}')"><i class="fas fa-print"></i> Invoice</button> -->
                                                <button type="button"
                                                    class="btn btn-info btn-sm btn-cetak-inv"
                                                    data-id_so="{{ $value['id'] }}"
                                                    data-no_penawaran="{{ $value['no_penawaran'] }}"
                                                    data-tanggal_invoice="{{ $value['tanggal_invoice'] }}">
                                                    <i class="fas fa-print"></i> Invoice
                                                </button>
                                                @else
                                                <!-- Tampilkan tombol Proses SO -->
                                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#Modal_detail_penawaran"
                                                    data-whatever="@mdo"
                                                    data-id_penawaran="{{ $value['id'] }}"
                                                    data-no_penawaran="{{ $value['no_penawaran'] }}"
                                                    data-nama_customer="{{ $value['nama_customer'] }}"
                                                    data-alamat_customer="{{ $value['alamat_customer'] }}"
                                                    data-flag_ppn="{{ $value['flag_ppn'] }}"
                                                    data-ppn="{{ $value['ppn'] }}"
                                                    data-tanggal_penawaran="{{ $value['tanggal_penawaran'] }}"
                                                    data-nama_sales="{{ $value['nama_sales'] }}"
                                                    data-diskon="{{ $value['diskon'] }}"
                                                    data-total_penawaran="{{ $value['total_penawaran'] }}"
                                                    data-keterangan="{{ $value['keterangan'] }}">
                                                    Proses SO
                                                </button>
                                                @endif
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

    <div class="modal fade" id="Modal_add_penawaran" tabindex="-1" role="dialog" aria-labelledby="ModalLabel_add_penawaran" aria-hidden="true">
        <div class="modal-dialog modal-sm-custom" role="document">
            <div class="modal-content">
                <div class="modal-header py-2">
                    <h6 class="modal-title" id="ModalLabel_add_penawaran"><b>Tambah Penawaran</b></h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="font-size: 1.2rem;">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body py-2">
                    <form>
                        <div class="row">
                            <div class="col">
                                <div class="form-group mb-2">
                                    <label class="col-form-label col-form-label-sm-custom">No Penawaran :</label>
                                    <input type="text" class="form-control form-control-sm-custom" id="txt_no_penawaran" autocomplete="off" required>
                                </div>
                                <div class="form-group mb-2">
                                    <label class="col-form-label col-form-label-sm-custom">Nama Customer :</label>
                                    <input type="text" class="form-control form-control-sm-custom" id="txt_nama_customer" autocomplete="off">
                                </div>
                                <div class="form-group mb-2">
                                    <label class="col-form-label col-form-label-sm-custom">Alamat Customer :</label>
                                    <input type="text" class="form-control form-control-sm-custom" id="txt_alamat_customer" autocomplete="off">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group mb-2">
                                    <label class="col-form-label col-form-label-sm-custom">Tanggal Penawaran:</label>
                                    <input type="date" class="form-control form-control-sm-custom" id="txt_tgl_penawaran">
                                </div>
                                <div class="form-group mb-2">
                                    <label class="col-form-label col-form-label-sm-custom">Nama Sales :</label>
                                    <input type="text" class="form-control form-control-sm-custom" id="txt_nama_sales" autocomplete="off">
                                </div>
                                <div class="form-group mb-2">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group mb-2">
                                                <label class="col-form-label col-form-label-sm-custom">PPN :</label>
                                                <input type="number" class="form-control form-control-sm-custom" id="txt_ppn" autocomplete="off" value="11" onblur="hitungTotal(this)">
                                            </div>
                                        </div>
                                        <div class="col-5">
                                            <div class="form-group mb-2">
                                                <label class="col-form-label col-form-label-sm-custom">Total Penawaran :</label>
                                                <input type="text" class="form-control form-control-sm-custom" id="txt_total_penawaran_view" autocomplete="off" disabled>
                                                <input type="hidden" class="form-control form-control-sm-custom" id="txt_total_penawaran" autocomplete="off" disabled>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card shadow mb-3">
                            <div class="card-header py-1">

                            </div>
                            <div class="card-body p-2">
                                <div class="table-responsive" style="max-height: 200px; overflow-y: auto;">
                                    <table class="table table-bordered table-sm" id="dataTablePenawaranDetail" width="100%" cellspacing="0">
                                        <thead style="position: sticky; top: 0; background: white; z-index: 2;">
                                            <tr>
                                                <th width="25px">No</th>
                                                <th width="200px">Item</th>
                                                <th width="50px">Jumlah</th>
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
                    <button type="button" class="btn btn-primary btn-sm" id="btn_simpan_penawaran" name="btn_simpan_penawaran">Simpan</button>
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                </div>
            </div>
        </div>
    </div>

    <!-- End Modal Tambah Data -->


    <!-- Modal Edit Data -->

    <div class="modal fade bd-example-modal-lg" id="Modal_detail_penawaran" tabindex="-1" role="dialog" aria-labelledby="ModalLabel_edit_admin" aria-hidden="true">
        <div class="modal-dialog modal-sm-custom" role="document">
            <div class="modal-content">
                <div class="modal-header py-2">
                    <h6 class="modal-title" id="ModalLabel_add_penawaran"><b>Detail Sales Order</b></h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="font-size: 1.2rem;">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body py-2">
                    <form>
                        <div class="row">
                            <div class="col">
                                <div class="form-group mb-2">
                                    <label class="col-form-label col-form-label-sm-custom">No Penawaran :</label>
                                    <input type="hidden" class="form-control form-control-sm-custom" id="txt_update_id" autocomplete="off" required>
                                    <input type="text" class="form-control form-control-sm-custom" id="txt_update_no_penawaran" autocomplete="off" required>
                                </div>
                                <div class="form-group mb-2">
                                    <label class="col-form-label col-form-label-sm-custom">Nama Customer :</label>
                                    <input type="text" class="form-control form-control-sm-custom" id="txt_update_nama_customer" autocomplete="off">
                                </div>
                                <div class="form-group mb-2">
                                    <label class="col-form-label col-form-label-sm-custom">Alamat Customer :</label>
                                    <input type="text" class="form-control form-control-sm-custom" id="txt_update_alamat_customer" autocomplete="off">
                                </div>
                                <div class="form-group mb-2">
                                    <label class="col-form-label col-form-label-sm-custom">Untuk Perhatian (UP) :</label>
                                    <input type="text" class="form-control form-control-sm-custom" id="txt_update_untuk_perhatian" autocomplete="off">
                                </div>
                                <div class="form-group mb-2">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group mb-2">
                                                <label class="col-form-label col-form-label-sm-custom">PPN :</label>
                                                <select class="form-control form-control-sm-custom" id="txt_update_pakai_ppn" onchange="pilihPPN(this.value)">
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
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group mb-2">
                                                <label class="col-form-label col-form-label-sm-custom">No PO Customer :</label>
                                                <input type="text" class="form-control form-control-sm-custom" id="txt_update_no_po_customer" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group mb-2">
                                                <label class="col-form-label col-form-label-sm-custom">Tanggal PO:</label>
                                                <input type="date" class="form-control form-control-sm-custom" id="txt_update_tgl_po" value="{{ date('Y-m-d') }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group mb-2">
                                    <label class="col-form-label col-form-label-sm-custom">Tanggal SO:</label>
                                    <input type="date" class="form-control form-control-sm-custom" id="txt_update_tgl_penawaran">
                                </div>
                                <div class="form-group mb-2">
                                    <label class="col-form-label col-form-label-sm-custom">Nama Sales :</label>
                                    <input type="text" class="form-control form-control-sm-custom" id="txt_update_nama_sales" autocomplete="off">
                                </div>
                                <div class="form-group mb-2">
                                    <label class="col-form-label col-form-label-sm-custom">Nomor Telepon :</label>
                                    <input type="number" class="form-control form-control-sm-custom" id="txt_update_no_telepon" autocomplete="off">
                                </div>
                                <div class="form-group mb-2">
                                    <label class="col-form-label col-form-label-sm-custom">Diskon% :</label>
                                    <input type="number" class="form-control form-control-sm-custom" id="txt_update_diskon" autocomplete="off" value="0" onblur="hitungTotal(this)">
                                </div>
                                <div class="form-group mb-2">
                                    <div class="row">
                                        <div class="col">
                                            <label class="col-form-label col-form-label-sm-custom">Total Penawaran :</label>
                                            <input type="text" class="form-control form-control-sm-custom" id="txt_update_total_penawaran_view" value="0" autocomplete="off" disabled>
                                            <input type="hidden" class="form-control form-control-sm-custom" id="txt_update_total_penawaran" value="0" autocomplete="off" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mb-2" style="padding-top: 8px;">
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group mb-2">
                                                <label class="col-form-label col-form-label-sm-custom">No PH :</label>
                                                <input type="text" class="form-control form-control-sm-custom" id="txt_update_no_ph" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group mb-2">
                                    <label class="col-form-label col-form-label-sm-custom">Keterangan Penawaran :</label>
                                    <input type="textarea" class="form-control form-control-sm-custom" id="txt_update_keterangan_penawaran" autocomplete="off">
                                </div>
                            </div>
                        </div>

                        <!-- Start Update pembayaran -->
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group mb-2">
                                    <label class="col-form-label col-form-label-sm-custom">Jenis Pembayaran :</label>
                                    <select class="form-control form-control-sm-custom" id="txt_update_jenis_pembayaran">
                                        <option value="">-- Pilih Jenis Pembayaran --</option>
                                        <option value="DP">DP</option>
                                        <option value="FULL PAYMENT" selected>FULL PAYMENT</option>
                                        <option value="TEMPO">TEMPO</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-8">
                                <div class="form-group mb-2" id="fg_tgl_tempo">
                                    <label class="col-form-label col-form-label-sm-custom">Tanggal Tempo :</label>
                                    <input type="date" class="form-control form-control-sm-custom" id="txt_tgl_tempo" style="width:200px;">
                                </div>
                                <div class="form-group mb-2" id="fg_nominal_dp">
                                    <div class="row w-100">
                                        <div class="col">
                                            <label class="col-form-label col-form-label-sm-custom">Nominal DP :</label>
                                            <input type="number" class="form-control form-control-sm-custom" id="txt_update_nominal_dp">
                                        </div>
                                        <div class="col">
                                            <label class="col-form-label col-form-label-sm-custom">Sisa Pembayaran :</label>
                                            <input type="number" class="form-control form-control-sm-custom" id="txt_update_sisa_pembayaran" hidden>
                                            <input type="text" class="form-control form-control-sm-custom" id="txt_update_sisa_pembayaran_view">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Update pembayaran -->

                        <div class="row">
                            <div class="col">
                                <div class="form-group mb-2">
                                    <label class="col-form-label col-form-label-sm-custom">Keterangan :</label>
                                    <input type="textarea" class="form-control form-control-sm-custom" id="txt_update_keterangan" autocomplete="off">
                                </div>
                            </div>
                        </div>

                        <div class="row" hidden>
                            <div class="col-4">
                                <div class="form-group mb-2">
                                    <label class="col-form-label col-form-label-sm-custom">Tanggal Invoice :</label>
                                    <input type="date" class="form-control form-control-sm-custom" id="txt_update_tgl_invoice" value="<?= date('Y-m-d'); ?>">
                                </div>
                            </div>
                        </div>

                        <div class="card shadow mb-3">
                            <div class="card-header py-1">

                            </div>
                            <div class="card-body p-2">
                                <div class="table-responsive" style="max-height: 200px; overflow-y: auto;">
                                    <table class="table table-bordered table-sm" id="dataTablePenawaranDetail_update" width="100%" cellspacing="0">
                                        <thead style="position: sticky; top: 0; background: white; z-index: 2;">
                                            <tr>
                                                <th width="25px">No</th>
                                                <th width="200px">Item</th>
                                                <th width="150px">Material</th>
                                                <th width="100px">Satuan</th>
                                                <th width="50px">Jumlah</th>
                                                <th width="100px">Harga</th>
                                                <th width="10px" hidden><button type="button" class="btn btn-primary btn-sm" id="btnTambahItem_update"><i class="fa fa-plus-circle" aria-hidden="true"></i></button></th>
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
                    <button type="button" class="btn btn-success" id="btn_update_penawaran" name="btn_update_penawaran">Simpan</button>
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



    <!-- Modal Input Tanggal Invoice -->
    <div class="modal fade" id="Modal_InputTglInvoice" tabindex="-1" role="dialog" aria-labelledby="ModalLabel_InputTglInvoice" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Informasi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p id="alert_informasi_input_tgl_invoice" name="alert_informasi_input_tgl_invoice"></p>
                    <input type="hidden" id="txt_id_no_so_input_tgl_invoice" name="txt_id_no_so_input_tgl_invoice">

                    <!-- Tambahan label + input -->
                    <div class="form-group">
                        <label for="txt_nomor_bon">Tanggal Invoice</label>
                        <input type="date" class="form-control form-control-sm-custom" id="txt_tgl_invoice" value="<?= date('Y-m-d'); ?>">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info" data-dismiss="modal" id="btn_cetak_invoice" name="btn_cetak_invoice">Cetak Invoice</button>
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Kembali</button>
                    <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                </div>
            </div>
        </div>
    </div>
    <!-- ENd Modal Input Tanggal Invoice -->

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
        var noUrut = 1; // nomor urut awal
        document.getElementById('btnTambahItem').addEventListener('click', function() {
            let tbody = document.getElementById('tableBody');

            // Buat elemen <tr>
            let tr = document.createElement('tr');

            tr.innerHTML = `
                <td width="25px" align="center">${noUrut++}</td>
                <td width="200px"><input type="text" name="item[]" class="form-control" autocomplete="off"></td>
                <td width="50px"><input type="number" name="jumlah[]" class="form-control" autocomplete="off"></td>
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
                $('#txt_update_ppn').val(11).prop('disabled', false); // isi 11 dan aktifkan
            } else {
                $('#txt_update_ppn').val(0).prop('disabled', true); // isi 0 dan nonaktifkan
            }
            hitungTotal();
        }

        function hitungTotal() {
            var totalPenawaran = 0;
            var rows = document.querySelectorAll('#tableBody_update tr');

            // Ambil status PPN
            var pakaiPpn = $('#txt_update_pakai_ppn').val();
            var ppn = pakaiPpn ? (parseFloat($('#txt_update_ppn').val()) / 100) || 0 : 0;
            var diskon = (parseFloat($('#txt_update_diskon').val()) / 100) || 0;

            console.log(pakaiPpn);

            rows.forEach(row => {
                var jumlah = parseFloat(row.querySelector('input[name="update_jumlah[]"]').value) || 0;
                var harga = parseFloat(row.querySelector('input[name="update_harga[]"]').value) || 0;
                var subtotal = jumlah * harga;

                // Tambahkan PPN hanya jika pakaiPpn = true txt_diskon
                if (pakaiPpn == 'PPN') {
                    subtotal += subtotal * ppn;
                }

                totalPenawaran += subtotal;
            });

            // Kurangi diskon setelah total dihitung
            totalPenawaran = totalPenawaran - (totalPenawaran * diskon);

            // Tampilkan total ke input
            document.getElementById('txt_update_total_penawaran_view').value = totalPenawaran.toLocaleString();
            document.getElementById('txt_update_total_penawaran').value = totalPenawaran;
        }

        var noUrutUpdate = 1; // nomor urut awal
        document.getElementById('btnTambahItem_update').addEventListener('click', function() {
            let tbody = document.getElementById('tableBody_update');

            let tr = document.createElement('tr');

            tr.innerHTML = `
                <td width="25px" align="center"></td>
                <td width="200px"><input type="text" name="update_item[]" class="form-control" autocomplete="off"></td>
                <td width="50px"><input type="number" name="update_jumlah[]" class="form-control" autocomplete="off"></td>
                <td width="100px"><input type="number" name="update_harga[]" class="form-control" autocomplete="off" onblur="hitungTotalUpdate(this)"></td>
                <td width="10px" hidden>
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
            var totalPenawaran = 0;
            var rows = document.querySelectorAll('#tableBody_update tr');
            console.log('tesss');
            rows.forEach(row => {
                var ppn = parseFloat(($('#txt_update_ppn').val() / 100)) || 0;
                var jumlah = parseFloat(row.querySelector('input[name="update_jumlah[]"]').value) || 0;
                var harga = parseFloat(row.querySelector('input[name="update_harga[]"]').value) || 0;
                var subtotal = jumlah * harga;

                // Tambahkan PPN 11%
                subtotal = subtotal + (subtotal * ppn);

                totalPenawaran += subtotal;
            });

            // Tampilkan total ke input total pembelian
            $('#txt_update_total_penawaran_view').val(totalPenawaran.toLocaleString('id-ID')).prop('disabled', true);
            document.getElementById('txt_update_total_penawaran').value = totalPenawaran;
        }

        function hitungSisaPembayaran() {
            var txtTotalDP = document.getElementById('txt_update_nominal_dp') || 0;
            var txtTotalBayar = document.getElementById('txt_update_total_penawaran') || 0;
            var txtSisa = document.getElementById('txt_update_sisa_pembayaran') || 0;
            var total = parseFloat(txtTotalBayar.value) || 0;
            var dp = parseFloat(txtTotalDP.value) || 0;
            var sisa = total - dp;
            var v_sisa = sisa >= 0 ? sisa : 0; // supaya tidak minus

            txtSisa.value = v_sisa;

            $('#txt_update_sisa_pembayaran_view')
                .val(v_sisa.toLocaleString('id-ID'))
                .prop('disabled', true);

            // Kalau mau format currency:
            // document.getElementById('txt_update_sisa_pembayaran_view').value = 
            //     new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(v_sisa);
        }

        function cetakSO(id_po) {
            if (id_po !== '') {
                var url = "{{ URL::to('/') }}/cetaksalesorder?params=" + id_po;

                var W = window.open(url, '_blank');

                // Tunggu tab baru selesai load sebelum print
                W.onload = function() {
                    W.print();
                };
            }

            // Redirect setelah cetak
            // window.location = "{{ URL::to('/') }}/sales_order";
        }

        function cetakInvoice(id_po) {
            if (id_po !== '') {
                var encodedId = btoa(id_po); // encode ke Base64
                var url = "{{ URL::to('/') }}/cetakinvoice?params=" + encodedId;

                var W = window.open(url, '_blank');

                // Tunggu tab baru selesai load sebelum print
                W.onload = function() {
                    W.print();
                };
            }

            // Redirect setelah cetak
            // window.location = "{{ URL::to('/') }}/sales_order";
        }


        $(document).on('click', '.btn-cetak-inv', function(e) {
            e.preventDefault();

            // ambil id_po dari atribut data-id_so
            var id_so = $(this).data("id_so");
            var no_penawaran = $(this).data("no_penawaran");
            var tanggal_invoice = $(this).data("tanggal_invoice");

            // isi ke input hidden di modal
            $("#txt_id_no_so_input_tgl_invoice").val(id_so);
            $("#txt_tgl_invoice").val(tanggal_invoice);
            // if (tanggal_invoice) {
            //     // kalau ada datanya
            //     $("#txt_tgl_invoice").val(tanggal_invoice);
            // } else {
            //     // kalau tidak ada datanya
            //     $("#txt_tgl_invoice").val('');
            // }

            // kalau mau isi pesan di modal
            $("#alert_informasi_input_tgl_invoice").html("Apakah Anda yakin ingin cetak PO nomor: <i><b>" + no_penawaran + "</b></i> ?");

            // tampilkan modal
            $("#Modal_InputTglInvoice").modal("show");
        });

        $('#btn_cetak_invoice').click(function(e) {
            e.preventDefault();

            var id = $('#txt_id_no_so_input_tgl_invoice').val();
            var tanggal_invoice = $('#txt_tgl_invoice').val();
            var idEncoded = btoa(id); // encode base64
            var tglInvEncoded = btoa(tanggal_invoice); // encode base64

            if (id !== '') {
                var url = "{{ URL::to('/') }}/cetakinvoice?params=" + idEncoded + "&params2=" + tglInvEncoded;
                var W = window.open(url, '_blank');
                W.focus(); // Optional: focus ke window baru
                W.print(); // Otomatis langsung cetak

                // kasih delay sebelum redirect halaman utama
                setTimeout(function() {
                    window.location.href = "{{ URL::to('/') }}/sales_order";
                }, 3000); // delay 3 detik (bisa diatur)
            }

        });

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

        $('#Modal_detail_penawaran').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var modal = $(this);
            var id = button.data('id_penawaran');
            var no_penawaran = button.data('no_penawaran');
            var nama_customer = button.data('nama_customer');
            var alamat_customer = button.data('alamat_customer');
            var flag_ppn = button.data('flag_ppn');
            var ppn = button.data('ppn');
            var tanggal_penawaran = button.data('tanggal_penawaran');
            var nama_sales = button.data('nama_sales');
            var diskon = button.data('diskon');
            var total_penawaran = button.data('total_penawaran');
            var keterangan_penawaran = button.data('keterangan');
            var onlyDate = tanggal_penawaran.split(" ")[0];
            var onlyDateTglTempo = tanggal_penawaran.split(" ")[0];

            $('#txt_update_id').val(id);
            $('#txt_update_no_penawaran').val(no_penawaran).prop('disabled', true);
            $('#txt_update_nama_customer').val(nama_customer);
            $('#txt_update_alamat_customer').val(alamat_customer);
            $('#txt_update_pakai_ppn').val(flag_ppn);
            $('#txt_update_ppn').val(ppn);
            $('#txt_update_tgl_penawaran').val(onlyDateTglTempo).prop('disabled', true);
            $('#txt_update_nama_sales').val(nama_sales).prop('disabled', true);
            $('#txt_update_diskon').val(diskon);
            $('#txt_update_total_penawaran_view').val(total_penawaran.toLocaleString('id-ID')).prop('disabled', true);
            $('#txt_update_total_penawaran').val(total_penawaran).prop('disabled', true);
            $('#txt_update_keterangan_penawaran').val(keterangan_penawaran).prop('disabled', true);


            $("#txt_update_jenis_pembayaran").val('FULL PAYMENT');
            $('#txt_update_nominal_dp').val('');
            $('#txt_update_sisa_pembayaran').val('');
            $('#txt_update_sisa_pembayaran_view').val('');

            var fgTempo = document.getElementById('fg_tgl_tempo');
            var fgNominalDp = document.getElementById('fg_nominal_dp');
            fgTempo.style.display = 'none'; // sembunyikan
            fgNominalDp.style.display = 'none'; // sembunyikan

            $.ajax({
                type: 'POST',
                url: "<?php echo URL::to('/'); ?>/get_data_penawaran", // jangan lupa echo 
                data: {
                    id: id
                },
                success: function(res) {
                    const cst = JSON.parse(res);

                    let tbody = document.getElementById('tableBody_update');
                    tbody.innerHTML = ""; // clear table body
                    let noUrut = 1;

                    cst.forEach(item => {
                        let tr = document.createElement('tr');
                        tr.innerHTML = `
                            <td width="25px" align="center">${noUrut++}</td>
                            <td width="200px"><input type="text" name="update_item[]" value="${item.nama_item}" class="form-control" autocomplete="off" disabled></td>
                            <td width="150px"><input type="text" name="update_material[]" value="${item.material}" class="form-control" autocomplete="off" disabled></td>
                            <td width="100px"><input type="text" name="update_satuan[]" value="${item.satuan}" class="form-control" autocomplete="off" disabled></td>
                            <td width="50px"><input type="number" name="update_jumlah[]" value="${item.jumlah}" class="form-control" autocomplete="off" disabled></td>
                            <td width="100px"><input type="number" name="update_harga[]" value="${item.harga}" class="form-control" autocomplete="off" onblur="hitungTotalUpdate(this)" disabled></td>
                            <td width="10px" hidden><button type="button" class="btn btn-danger btn-sm btnHapusUpdate"><i class="fa fa-minus-circle" aria-hidden="true"></i></button></td>
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

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#btn_simpan_penawaran').click(function(e) {
            e.preventDefault();
            var no_penawaran = $('#txt_no_penawaran').val();
            var nama_customer = $('#txt_nama_customer').val();
            var alamat_customer = $('#txt_alamat_customer').val();
            var nama_sales = $('#txt_nama_sales').val();
            var tgl_penawaran = $('#txt_tgl_penawaran').val();
            var ppn = $('#txt_ppn').val();
            var total_penawaran = $('#txt_total_penawaran').val();

            // Ambil data dari tabel
            var detailPenawaran = [];
            $('#dataTablePenawaranDetail tbody tr').each(function() {
                var item = $(this).find('input[name="item[]"]').val();
                var jumlah = $(this).find('input[name="jumlah[]"]').val();
                var harga = $(this).find('input[name="harga[]"]').val();


                if (item) { // hanya masukkan jika ada item
                    detailPenawaran.push({
                        item: item,
                        jumlah: jumlah,
                        harga: harga
                    });
                }
            });

            $.ajax({
                type: 'POST',
                url: "<?php URL::to('/'); ?>simpan_penawaran",
                data: {
                    no_penawaran: no_penawaran,
                    nama_customer: nama_customer,
                    alamat_customer: alamat_customer,
                    nama_sales: nama_sales,
                    tgl_penawaran: tgl_penawaran,
                    ppn: ppn,
                    total_penawaran: total_penawaran,
                    detail_penawaran: JSON.stringify(detailPenawaran) // encode ke JSON string
                },
                success: function(res) {
                    const cst = JSON.parse(res);

                    $("#view_nomor_transaksi").val(cst.id);
                    $("#btn_oke_alert").show();
                    $("#btn_kembali").hide();
                    $('#Modal_detail_penawaran').modal('hide');
                    $("#alert_informasi").html(cst.message);
                    $("#Modal_alert").find('.modal-title').text(cst.title);
                    $('#Modal_alert').modal({
                        backdrop: 'static',
                        keyboard: false
                    });

                }
            });

        });

        $('#btn_update_penawaran').click(function(e) {
            e.preventDefault();
            var id_penawaran = $('#txt_update_id').val();
            var no_penawaran = $('#txt_update_no_penawaran').val();
            var no_po_customer = $('#txt_update_no_po_customer').val();
            var nama_customer = $('#txt_update_nama_customer').val();
            var alamat_customer = $('#txt_update_alamat_customer').val();
            var nama_sales = $('#txt_update_nama_sales').val();
            var tgl_penawaran = $('#txt_update_tgl_penawaran').val();
            var ppn = $('#txt_update_ppn').val();
            var total_penawaran = $('#txt_update_total_penawaran').val();
            var jenis_pembayaran = $('#txt_update_jenis_pembayaran').val();
            var nominal_dp = $('#txt_update_nominal_dp').val();
            var sisa_pembayaran = $('#txt_update_sisa_pembayaran').val();
            var tgl_tempo = $('#txt_tgl_tempo').val();
            var keterangan = $('#txt_update_keterangan').val();
            var no_telepon = $('#txt_update_no_telepon').val();
            var untuk_perhatian = $('#txt_update_untuk_perhatian').val();
            var no_ph = $('#txt_update_no_ph').val();
            var tgl_po = $('#txt_update_tgl_po').val();
            var diskon = $('#txt_update_diskon').val();
            var flag_ppn = $('#txt_update_pakai_ppn').val();
            var tgl_invoice = $('#txt_update_tgl_invoice').val();

            // Ambil data dari tabel
            var detailPenawaran = [];
            $('#dataTablePenawaranDetail_update tbody tr').each(function() {
                var item = $(this).find('input[name="update_item[]"]').val();
                var material = $(this).find('input[name="update_material[]"]').val();
                var satuan = $(this).find('input[name="update_satuan[]"]').val();
                var jumlah = $(this).find('input[name="update_jumlah[]"]').val();
                var harga = $(this).find('input[name="update_harga[]"]').val();


                if (item) { // hanya masukkan jika ada item
                    detailPenawaran.push({
                        item: item,
                        material: material,
                        satuan: satuan,
                        jumlah: jumlah,
                        harga: harga
                    });
                }
            });

            $.ajax({
                type: 'POST',
                url: "<?php URL::to('/'); ?>update_sales_order",
                data: {
                    id_penawaran: id_penawaran,
                    no_penawaran: no_penawaran,
                    nama_customer: nama_customer,
                    alamat_customer: alamat_customer,
                    nama_sales: nama_sales,
                    tgl_penawaran: tgl_penawaran,
                    flag_ppn: flag_ppn,
                    ppn: ppn,
                    total_penawaran: total_penawaran,
                    jenis_pembayaran: jenis_pembayaran,
                    nominal_dp: nominal_dp,
                    sisa_pembayaran: sisa_pembayaran,
                    tgl_tempo: tgl_tempo,
                    keterangan: keterangan,
                    no_po_customer: no_po_customer,
                    no_telepon: no_telepon,
                    untuk_perhatian: untuk_perhatian,
                    no_ph: no_ph,
                    tgl_po: tgl_po,
                    diskon: diskon,
                    tgl_invoice: tgl_invoice,
                    detail_penawaran: JSON.stringify(detailPenawaran) // encode ke JSON string
                },
                success: function(res) {
                    const cst = JSON.parse(res);

                    $("#view_nomor_transaksi").val(cst.id);
                    $("#btn_oke_alert").show();
                    $("#btn_kembali").hide();
                    $('#Modal_detail_penawaran').modal('hide');
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
                var url = "<?php URL::to('/'); ?>cetaksalesorder?params="+id;
                var W = window.open(url,'_blank');
                W.window.print();

            }*/
            window.location = "<?php URL::to('/'); ?>sales_order";
        });

        /* $('#btn_cetak_po').click(function(e){
            console.log('texxx');
            e.preventDefault();
            var id = $("#txt_update_id").val();
            if(id != ''){
                var url = "<?php URL::to('/'); ?>cetakpenawaran?params="+id;
                var W = window.open(url,'_blank');
                W.window.print();

            }
            window.location = "<?php URL::to('/'); ?>sales_order";
        }); */

        $(document).ready(function() {
            const today = new Date();
            const yyyy = today.getFullYear();
            const mm = String(today.getMonth() + 1).padStart(2, '0'); // bulan 0-11
            const dd = String(today.getDate()).padStart(2, '0');
            const todayStr = `${yyyy}-${mm}-${dd}`;
            document.getElementById('txt_tgl_penawaran').value = todayStr;
            document.getElementById('txt_tgl_tempo').value = todayStr;


            var txtNominalDP = document.getElementById('txt_update_nominal_dp');

            $("#btn_kembali").hide();


            // Sembunyikan default saat pertama kali load
            document.getElementById('fg_tgl_tempo').style.display = 'none';
            document.getElementById('fg_nominal_dp').style.display = 'none';

            document.getElementById('txt_update_jenis_pembayaran').addEventListener('change', function() {
                var selected = this.value;
                var fgTempo = document.getElementById('fg_tgl_tempo');
                var fgNominalDp = document.getElementById('fg_nominal_dp');

                $('#txt_update_nominal_dp').val('');
                $('#txt_update_sisa_pembayaran').val('');
                $('#txt_update_sisa_pembayaran_view').val('');
                if (selected === 'TEMPO') {
                    fgTempo.style.display = 'block'; // tampilkan
                    fgNominalDp.style.display = 'none'; // sembunyikan
                } else if (selected === 'DP') {
                    fgTempo.style.display = 'none'; // sembunyikan
                    fgNominalDp.style.display = 'block'; // tampilkan
                } else {
                    fgTempo.style.display = 'none'; // sembunyikan
                    fgNominalDp.style.display = 'none'; // sembunyikan
                }
                hitungSisaPembayaran();
            });


            // Event hitung sisa pembayaran saat blur Nominal DP
            txtNominalDP.addEventListener('blur', hitungSisaPembayaran);
            // txtNominalDP.addEventListener('blur', function () {
            //     var total = parseFloat(txtTotalBayar.value) || 0;
            //     var dp = parseFloat(txtNominalDP.value) || 0;
            //     var sisa = total - dp;
            //     var v_sisa = 0;
            //     console.log('oke');

            //     txtSisa.value = sisa >= 0 ? sisa : 0; // supaya tidak minus
            //     v_sisa = sisa >= 0 ? sisa : 0;
            //     $('#txt_update_sisa_pembayaran_view').val(v_sisa.toLocaleString('id-ID')).prop('disabled', true);
            //     // document.getElementById('txt_update_sisa_pembayaran_view').value = new Intl.NumberFormat('id-ID', {
            //     //     style: 'currency',
            //     //     currency: 'IDR'
            //     // }).format(v_sisa);
            // });

        });
    </script>

</body>

</html>