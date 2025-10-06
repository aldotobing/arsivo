<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controllers_login;
use App\Http\Controllers\Controllers_main;
use App\Http\Controllers\Controllers_report;
use App\Http\Controllers\Controllers_transaksi;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [Controllers_login::class, 'login'])->name('login');
Route::post('loginaksi', [Controllers_login::class, 'loginaksi'])->name('loginaksi');
Route::get('home', [Controllers_main::class, 'home'])->name('home')->middleware('auth');

Route::controller(Controllers_report::class)->group(function () {
    Route::get('/preview', 'view_pdf')->name('admin')->middleware(['checkRole:user,admin']);
    
    Route::get('/cetakpenawaran', 'cetak_penawaran')->name('admin')->middleware(['checkRole:user,admin']);
    Route::get('/cetaksalesorder', 'cetak_sales_order')->name('admin')->middleware(['checkRole:user,admin']);
    Route::get('/cetakinvoice', 'cetak_invoice')->name('admin')->middleware(['checkRole:user,admin']);
    Route::get('/cetakkartuorder', 'cetak_kartu_order')->name('admin')->middleware(['checkRole:user,admin']);
    Route::get('/cetaksuratjalan', 'cetak_surat_jalan')->name('admin')->middleware(['checkRole:user,admin']);
    Route::get('/cetakpembelian', 'cetak_pembelian_pdf')->name('admin')->middleware(['checkRole:user,admin']);
    

    Route::get('/cetak_lap_penawaran_sudah_po', 'cetak_lap_penawaran_sudah_po')->name('admin')->middleware(['checkRole:user,admin']);

    
    Route::get('/lappenawaranbelumpo', 'lap_penawaran_belum_po')->name('admin')->middleware(['checkRole:user,admin']);
    Route::get('/preview_lap_penawaran_belum_po', 'preview_lap_penawaran_belum_po')->name('admin')->middleware(['checkRole:user,admin']);
    Route::get('/export_penawaran', 'export_penawaran_excel')->name('admin')->middleware(['checkRole:user,admin']);
    Route::get('/export_penawaran_pdf', 'export_penawaran_pdf')->name('admin')->middleware(['checkRole:user,admin']);

    Route::get('/lappenawaransudahpo', 'lap_penawaran_sudah_po')->name('admin')->middleware(['checkRole:user,admin']);
    Route::get('/preview_lap_penawaran_sudah_po', 'preview_lap_penawaran_sudah_po')->name('admin')->middleware(['checkRole:user,admin']);
    Route::get('/export_penawaran_sudah', 'export_penawaran_sudah_excel')->name('admin')->middleware(['checkRole:user,admin']);
    Route::get('/export_penawaran_sudah_pdf', 'export_penawaran_sudah_pdf')->name('admin')->middleware(['checkRole:user,admin']);

    Route::get('/lappenawaran', 'lap_penawaran')->name('admin')->middleware(['checkRole:user,admin']);
    Route::get('/preview_lap_penawaran', 'preview_lap_penawaran')->name('admin')->middleware(['checkRole:user,admin']);
    Route::get('/export_lap_penawaran', 'export_lap_penawaran')->name('admin')->middleware(['checkRole:user,admin']);
    Route::get('/export_lap_penawaran_pdf', 'export_lap_penawaran_pdf')->name('admin')->middleware(['checkRole:user,admin']);

    Route::get('/lapomset', 'lap_omset')->name('admin')->middleware(['checkRole:user,admin']);
    Route::get('/preview_lap_omset', 'preview_lap_omset')->name('admin')->middleware(['checkRole:user,admin']);
    Route::get('/export_lap_omset', 'export_lap_omset')->name('admin')->middleware(['checkRole:user,admin']);
    Route::get('/export_lap_omset_pdf', 'export_lap_omset_pdf')->name('admin')->middleware(['checkRole:user,admin']);
    
    Route::get('/laprevenue', 'lap_revenue')->name('admin')->middleware(['checkRole:user,admin']);
    Route::get('/preview_lap_revenue', 'preview_lap_revenue')->name('admin')->middleware(['checkRole:user,admin']);
    Route::get('/export_lap_revenue', 'export_lap_revenue')->name('admin')->middleware(['checkRole:user,admin']);
    Route::get('/export_lap_revenue_pdf', 'export_lap_revenue_pdf')->name('admin')->middleware(['checkRole:user,admin']);

    Route::get('/lappembelian', 'lap_pembelian')->name('admin')->middleware(['checkRole:user,admin']);
    Route::get('/preview_lap_pembelian', 'preview_lap_pembelian')->name('admin')->middleware(['checkRole:user,admin']);
    Route::get('/export_lap_pembelian', 'export_lap_pembelian')->name('admin')->middleware(['checkRole:user,admin']);
    Route::get('/export_lap_pembelian_pdf', 'export_lap_pembelian_pdf')->name('admin')->middleware(['checkRole:user,admin']);
});

Route::get('logoutaksi', [Controllers_login::class, 'logoutaksi'])->name('logoutaksi')->middleware('auth');
Route::get('/dropdown', [Controllers_main::class, 'dropdown'])->name('dropdown')->middleware('auth');

Route::controller(Controllers_transaksi::class)->group(function () {
    Route::get('/penawaran_sales', 'penawaran_sales')->name('admin')->middleware(['checkRole:user,admin']);
    Route::post('/get_data_penawaran', 'get_data_penawaran')->name('admin')->middleware(['checkRole:user,admin']);
    Route::post('/simpan_penawaran', 'simpan_penawaran')->name('admin')->middleware(['checkRole:user,admin']);
    Route::post('/update_penawaran', 'update_penawaran')->name('admin')->middleware(['checkRole:user,admin']);
    Route::get('/sales_order', 'sales_order')->name('admin')->middleware(['checkRole:user,admin']);
    Route::post('/simpan_purchase_order', 'simpan_purchase_order')->name('admin')->middleware(['checkRole:user,admin']);
    Route::post('/update_sales_order', 'update_sales_order')->name('admin')->middleware(['checkRole:user,admin']);
    Route::get('/kartu_order', 'kartu_order')->name('admin')->middleware(['checkRole:user,admin']);
    Route::get('/surat_jalan', 'surat_jalan')->name('admin')->middleware(['checkRole:user,admin']);
    
    Route::get('/pembelian', 'pembelian')->name('admin')->middleware(['checkRole:user,admin']);
    Route::post('/generate_no_pembelian', 'generate_no_pembelian')->name('admin')->middleware(['checkRole:user,admin']);
    Route::post('/simpan_pembelian', 'simpan_pembelian')->name('admin')->middleware(['checkRole:user,admin']);
    Route::post('/get_data_pembelian', 'get_data_pembelian')->name('admin')->middleware(['checkRole:user,admin']);
    Route::post('/update_pembelian', 'update_pembelian')->name('admin')->middleware(['checkRole:user,admin']);
    Route::post('/update_selesai_pekerjaan', 'update_selesai_pekerjaan')->name('admin')->middleware(['checkRole:user,admin']);
});