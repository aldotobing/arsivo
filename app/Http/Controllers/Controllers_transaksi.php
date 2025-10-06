<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class Controllers_transaksi extends Controller
{
    // --- Start ---
    public function penawaran_sales(){
        $response = array();
        $penawaran = DB::table('t_penawaran')->get();
        $i = 0;
        $response['res_penawaran'] = array();
        foreach($penawaran as $rec){
            $response['res_penawaran'][$i]['id'] = $rec->id;
            $response['res_penawaran'][$i]['no_transaksi'] = $rec->no_transaksi;
            $response['res_penawaran'][$i]['no_penawaran'] = $rec->no_penawaran;
            $response['res_penawaran'][$i]['nama_customer'] = $rec->nama_customer;
            $response['res_penawaran'][$i]['alamat_customer'] = $rec->alamat_customer;
            $response['res_penawaran'][$i]['flag_ppn'] = $rec->flag_ppn;
            $response['res_penawaran'][$i]['ppn'] = $rec->ppn;
            $response['res_penawaran'][$i]['tanggal_penawaran'] = $rec->tanggal_penawaran;
            $response['res_penawaran'][$i]['nama_sales'] = $rec->nama_sales;
            $response['res_penawaran'][$i]['diskon'] = $rec->diskon;
            $response['res_penawaran'][$i]['total_penawaran'] = $rec->total_penawaran;
            $response['res_penawaran'][$i]['keterangan'] = $rec->keterangan;
            $i++;
        }        
        return view('view_penawaran_sales',$response);
    }

    public function simpan_penawaran(){
        date_default_timezone_set("Asia/Jakarta");
        DB::beginTransaction();

        try {
            $tgl_penawaran  = $_POST['tgl_penawaran'].' '.date('H:i:s');
            $no_transaksi   = "PN" . date("ydm");

            // Ambil ID max untuk header
            $max = DB::table('t_penawaran')->max('id');
            $max = $max ? $max + 1 : 1;

            // Format nomor transaksi
            $no_transaksi .= str_pad($max, 3, "0", STR_PAD_LEFT);
            $no_penawaran       = $_POST['no_penawaran'];
            $nama_customer      = $_POST['nama_customer'];
            $alamat_customer    = $_POST['alamat_customer'];
            $flag_ppn           = $_POST['flag_ppn'];
            $ppn                = $_POST['ppn'];
            $nama_sales         = $_POST['nama_sales'];
            $tgl_penawaran      = $tgl_penawaran;
            $diskon             = $_POST['diskon'];
            $total_penawaran    = $_POST['total_penawaran'];
            $keterangan         = $_POST['keterangan'];

            // Decode detail pembelian dari JSON
            $arrDataDetailPenawaran = json_decode($_POST['detail_penawaran']);

            $result = DB::table('t_penawaran')->insert(
                [
                    'id'                => $max, 
                    'no_transaksi'      => $no_transaksi, 
                    'no_penawaran'      => $no_penawaran,
                    'nama_customer'     => $nama_customer,
                    'alamat_customer'   => $alamat_customer,
                    'nama_sales'        => $nama_sales,
                    'tanggal_penawaran' => $tgl_penawaran,
                    'flag_ppn'          => $flag_ppn,
                    'ppn'               => $ppn,
                    'diskon'            => $diskon,
                    'total_penawaran'   => $total_penawaran,
                    'keterangan'        => $keterangan,
                    'created_date'      => now()
                ]
            );

            // Ambil max ID detail sekali saja
            $maxDetail = DB::table('t_penawaran_detail')->max('id');
            $maxDetail = $maxDetail ? $maxDetail + 1 : 1;

            // Insert detail
            foreach ($arrDataDetailPenawaran as $detail) {
                DB::table('t_penawaran_detail')->insert([
                    'id'           => $maxDetail++,
                    'id_header'    => $max,
                    'nama_item'    => $detail->item,
                    'material'     => $detail->material,
                    'satuan'          => $detail->satuan,
                    'qty'          => $detail->jumlah,
                    'harga'        => $detail->harga,
                    'keterangan_detail' => $detail->keterangan,
                    'created_date' => now()
                ]);
            }

            DB::commit();

            return json_encode([
                'status'          => true,
                'title'           => 'Informasi',
                'message'         => 'Data Penawaran berhasil ditambahkan.',
                'id'              => $max,
                'nomor_transaksi' => $no_transaksi
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            /* echo "Terjadi error: " . $e->getMessage(); */
            $response['status'] = false;
            $response['title'] = 'Peringatan';
            $response['message'] = 'Data penawaran gagal ditambahkan.';
            $response['id'] = '';
            $response['nomor_transaksi'] = '';
            // something went wrong
        }
        return json_encode($response);
    }

    public function update_penawaran(){
        date_default_timezone_set("Asia/Jakarta");
        DB::beginTransaction();
        try {
            $response = array();
            $tgl_update = date('Y-m-d H:i:s');
            $id = $_POST['id_penawaran'];
            $no_penawaran = $_POST['no_penawaran'];
            $nama_customer = $_POST['nama_customer'];
            $alamat_customer = $_POST['alamat_customer'];
            $flag_ppn = $_POST['flag_ppn'];
            $ppn = $_POST['ppn'];
            $tanggal_penawaran = $_POST['tgl_penawaran'].' '.date('H:i:s');
            $nama_sales = $_POST['nama_sales'];
            $diskon = $_POST['diskon'];
            $total_penawaran = $_POST['total_penawaran'];
            $keterangan         = $_POST['keterangan'];

            // Decode detail pembelian dari JSON
            $arrDataDetailPenawaran = json_decode($_POST['detail_penawaran']);

            // Update header
            DB::table('t_penawaran')
                ->where('id', $id)
                ->update([
                    'no_penawaran' => $no_penawaran, 
                    'nama_customer' => $nama_customer,
                    'alamat_customer' => $alamat_customer,
                    'flag_ppn'      => $flag_ppn,
                    'ppn' => $ppn,
                    'tanggal_penawaran' => $tanggal_penawaran,
                    'nama_sales' => $nama_sales,
                    'diskon' => $diskon,
                    'total_penawaran' => $total_penawaran,
                    'keterangan' => $keterangan,
                    'updated_date' => now()
                ]);

            // Hapus detail lama
            DB::table('t_penawaran_detail')
                ->where('id_header', $id)
                ->delete();

            // Ambil max ID detail sekali saja
            $maxDetail = DB::table('t_penawaran_detail')->max('id');
            $maxDetail = $maxDetail ? $maxDetail + 1 : 1;

            // Insert detail baru
            foreach ($arrDataDetailPenawaran as $detail) {
                DB::table('t_penawaran_detail')->insert([
                    'id'           => $maxDetail++,
                    'id_header'    => $id,
                    'nama_item'    => $detail->item,
                    'material'     => $detail->material,
                    'qty'          => $detail->jumlah,
                    'satuan'          => $detail->satuan,
                    'harga'        => $detail->harga,
                    'keterangan_detail' => $detail->keterangan,
                    'created_date' => now()
                ]);
            }

            DB::commit();

            return json_encode([
                'status'  => true,
                'title'   => 'Informasi',
                'message' => 'Data penawaran berhasil diupdate.',
                'id'      => $id
            ]);
            
        } catch (\Exception $e) {
            DB::rollback();
            // something went wrong
            /* echo "Terjadi error: " . $e->getMessage(); */
            $response['status'] = false;
            $response['id'] = '';
            $response['title'] = 'Peringatan';
            $response['message'] = 'Data penawaran gagal disimpan.';
        }
        return json_encode($response);
    }

    public function sales_order(){
        $response = array();
        /* $penawaran = DB::table('t_penawaran')->get(); */
        $penawaran = DB::select("SELECT
                                        A.*, B.tanggal_invoice,
                                    CASE
                                            
                                            WHEN B.id IS NOT NULL THEN
                                            'Y' ELSE 'N' 
                                        END AS status_po 
                                    FROM
                                        t_penawaran A
                                        LEFT JOIN t_sales_order B ON B.id_penawaran = A.id");
        $i = 0;
        $response['res_penawaran'] = array();
        foreach($penawaran as $rec){
            $response['res_penawaran'][$i]['id'] = $rec->id;
            $response['res_penawaran'][$i]['no_transaksi'] = $rec->no_transaksi;
            $response['res_penawaran'][$i]['no_penawaran'] = $rec->no_penawaran;
            $response['res_penawaran'][$i]['nama_customer'] = $rec->nama_customer;
            $response['res_penawaran'][$i]['alamat_customer'] = $rec->alamat_customer;
            $response['res_penawaran'][$i]['flag_ppn'] = $rec->flag_ppn;
            $response['res_penawaran'][$i]['ppn'] = $rec->ppn;
            $response['res_penawaran'][$i]['tanggal_penawaran'] = $rec->tanggal_penawaran;
            $response['res_penawaran'][$i]['nama_sales'] = $rec->nama_sales;
            $response['res_penawaran'][$i]['diskon'] = $rec->diskon;
            $response['res_penawaran'][$i]['total_penawaran'] = $rec->total_penawaran;
            $response['res_penawaran'][$i]['keterangan'] = $rec->keterangan;
            $response['res_penawaran'][$i]['status_po'] = $rec->status_po;
            // Kondisi untuk tanggal_invoice
            if (!empty($rec->tanggal_invoice)) {
                $response['res_penawaran'][$i]['tanggal_invoice'] = date('Y-m-d', strtotime($rec->tanggal_invoice));
            } else {
                $response['res_penawaran'][$i]['tanggal_invoice'] = date('Y-m-d', strtotime('+1 day')); // default hari ini
            }

            $i++;
        }        
        return view('view_input_so',$response);
    }

    public function simpan_purchase_order(){
        DB::beginTransaction();
        try {
            $response = array();
            date_default_timezone_set("Asia/Jakarta");
            $tgl_po = $_POST['tgl_po'].' '.date('H:i:s');
            $no_transaksi = "SO";
            $no_transaksi = $no_transaksi.date("ydm");
            $getCount = DB::table('t_sales_order')->selectRaw('count( * ) as count')->get();
            if($getCount[0]->count > 0){
                $getidTransaksiMax = DB::table('t_sales_order')->selectRaw('max( id ) + 1 AS id')->get();
                $max   = $getidTransaksiMax[0]->id; 
            }else{
                $max   = 1;
            }
            
            if(strlen($max) == 1){
                $no_transaksi .= "00".$max;
            }else if(strlen($max) == 2){
                $no_transaksi .= "0".$max;
            }else{
                $no_transaksi .= $max;
            }

            $no_order           = $_POST['no_order'];
            $no_po              = $_POST['no_po'];
            $nama_customer      = $_POST['nama_customer'];
            $alamat_customer    = $_POST['alamat_customer'];
            $jenis_pembayaran   = $_POST['jenis_pembayaran'];
            $tgl_purchase_order = $tgl_po;
            $total_bayar        = $_POST['total_bayar'];
            $tgl_tempo        = $_POST['tgl_tempo'];
            $nominal_dp        = $_POST['nominal_dp'];
            $sisa_pembayaran        = $_POST['sisa_pembayaran'];

            $result = DB::table('t_sales_order')->insert(
                [
                    'id'                => $max, 
                    'no_transaksi'      => $no_transaksi, 
                    'no_order'          => $no_order,
                    'no_po_customer'    => $no_po,
                    'nama_customer'     => $nama_customer,
                    'alamat_customer'   => $alamat_customer,
                    'tanggal_po'        => $tgl_purchase_order,
                    'jenis_pembayaran'  => $jenis_pembayaran,
                    'total_pembayaran'  => $total_bayar,
                    'tanggal_tempo'     => $tgl_tempo,
                    'nominal_dp'        => $nominal_dp,
                    'sisa_pembayaran'   => $sisa_pembayaran
                ]
            );

            if($result){
                DB::commit();
                $response['status'] = true;
                $response['title'] = 'Informasi';
                $response['message'] = 'Data purchase order berhasil ditambahkan.';
                $response['id'] = $max;
                $response['nomor_transaksi'] = $no_transaksi;
            }else{
                DB::rollback();
                $response['status'] = false;
                $response['title'] = 'Peringatan';
                $response['message'] = 'Data purchase order gagal ditambahkan.';
                $response['id'] = '';
                $response['nomor_transaksi'] = '';
            }
        } catch (\Exception $e) {
            DB::rollback();
            /* echo "Terjadi error: " . $e->getMessage(); */
            $response['status'] = false;
            $response['title'] = 'Peringatan';
            $response['message'] = 'Data purchase order gagal ditambahkan.';
            $response['id'] = '';
            $response['nomor_transaksi'] = '';
            // something went wrong
        }
        return json_encode($response);
    }

    public function update_sales_order(){
        date_default_timezone_set("Asia/Jakarta");
        DB::beginTransaction();

        try {
            $response = array();
            $no_transaksi   = "SO" . date("ydm");

            // Ambil ID max untuk header
            $max = DB::table('t_sales_order')->max('id');
            $max = $max ? $max + 1 : 1;

            // Format nomor transaksi
            $no_transaksi .= str_pad($max, 3, "0", STR_PAD_LEFT);
            $id_penawaran       = $_POST['id_penawaran'];
            $total_pembayaran   = $_POST['total_penawaran'];
            $jenis_pembayaran = trim($_POST['jenis_pembayaran'] ?? '');
            if ($jenis_pembayaran === '') {
                $jenis_pembayaran = 'FULL PAYMENT';
            }
            $nominal_dp = isset($_POST['nominal_dp']) && $_POST['nominal_dp'] !== '' 
                ? $_POST['nominal_dp'] 
                : 0;

            $sisa_pembayaran = isset($_POST['sisa_pembayaran']) && $_POST['sisa_pembayaran'] !== '' 
                ? $_POST['sisa_pembayaran'] 
                : 0;

            $tgl_tempo          = $_POST['tgl_tempo'].' '.date('H:i:s');
            $keterangan         = $_POST['keterangan'];
            $no_po_customer     = $_POST['no_po_customer'];
            $nama_customer      = $_POST['nama_customer'];
            $alamat_customer    = $_POST['alamat_customer'];
            $no_telepon         = $_POST['no_telepon'];
            $untuk_perhatian    = $_POST['untuk_perhatian'];
            $no_ph              = $_POST['no_ph'];
            $diskon             = $_POST['diskon'];
            $flag_ppn           = $_POST['flag_ppn'];
            $ppn                = $_POST['ppn'];
            $tgl_invoice        = $_POST['tgl_invoice'].' '.date('H:i:s');
            if($no_po_customer != ''){
                $tgl_po              = $_POST['tgl_po'].' '.date('H:i:s');
            }else{
                $tgl_po              = null;
            }

            $result = DB::table('t_sales_order')->insert(
                [
                    'id'                => $max, 
                    'no_transaksi'      => $no_transaksi, 
                    'id_penawaran'      => $id_penawaran,
                    'total_pembayaran'  => $total_pembayaran,
                    'jenis_pembayaran'  => $jenis_pembayaran,
                    'nominal_dp'        => $nominal_dp,
                    'sisa_pembayaran'   => $sisa_pembayaran,
                    'tanggal_tempo'     => $tgl_tempo,
                    'keterangan'        => $keterangan,
                    'created_date'      => now(),
                    'no_po_customer'    => $no_po_customer,
                    'no_ph'             => $no_ph,
                    'nama_customer'     => $nama_customer,
                    'alamat_customer'   => $alamat_customer,
                    'no_telepon'        => $no_telepon,
                    'untuk_perhatian'   => $untuk_perhatian,
                    'tanggal_po'        => $tgl_po,
                    'tanggal_invoice'   => $tgl_invoice
                ]
            );

            DB::table('t_penawaran')
                ->where('id', $id_penawaran)
                ->update([
                    'diskon' => $diskon,
                    'total_penawaran' => $total_pembayaran,
                    'flag_ppn' => $flag_ppn,
                    'ppn' => $ppn
                ]);

            DB::commit();

            return json_encode([
                'status'          => true,
                'title'           => 'Informasi',
                'message'         => 'Data Purchase Order berhasil ditambahkan.',
                'id'              => $max,
                'nomor_transaksi' => $no_transaksi
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            echo "Terjadi error: " . $e->getMessage();
            /* $response['status'] = false;
            $response['title'] = 'Peringatan';
            $response['message'] = 'Data Purchase Order gagal ditambahkan.';
            $response['id'] = '';
            $response['nomor_transaksi'] = ''; */
            // something went wrong
        }
        return json_encode($response);
    }

    public function kartu_order(){
        $response['res_kartu_order'] = array(); // inisialisasi array kosong
        $penawaran = DB::select("SELECT
                                        A.id, 
                                        A.no_transaksi AS no_po,
                                        B.no_penawaran,
                                        B.nama_customer,
                                        B.nama_sales,
                                        B.created_date AS tgl_po,
                                        A.jenis_pembayaran
                                    FROM
                                        t_sales_order A
                                        inner join t_penawaran B ON B.id = A.id_penawaran");
        $response['res_kartu_order'] = array();
        $i=0;
        foreach($penawaran as $rec){
            $response['res_kartu_order'][$i]['id'] = $rec->id;
            $response['res_kartu_order'][$i]['no_po'] = $rec->no_po;
            $response['res_kartu_order'][$i]['no_penawaran'] = $rec->no_penawaran;
            $response['res_kartu_order'][$i]['nama_customer'] = $rec->nama_customer;
            $response['res_kartu_order'][$i]['nama_sales'] = $rec->nama_sales;
            $response['res_kartu_order'][$i]['tgl_po'] = $rec->tgl_po;
            $response['res_kartu_order'][$i]['jenis_pembayaran'] = $rec->jenis_pembayaran;
            $i++;
        }
        return view('view_kartu_order',$response);
    }
    
    public function surat_jalan(){
        $response['res_surat_jalan'] = array(); // inisialisasi array kosong
        $penawaran = DB::select("SELECT
                                        A.id, 
                                        A.no_transaksi AS no_po,
                                        B.no_penawaran,
                                        B.nama_customer,
                                        B.nama_sales,
                                        B.created_date AS tgl_po,
                                        A.jenis_pembayaran,
                                        A.no_surat_jalan,
                                        A.flag_selesai
                                    FROM
                                        t_sales_order A
                                        inner join t_penawaran B ON B.id = A.id_penawaran");
        $response['res_surat_jalan'] = array();
        $i=0;
        foreach($penawaran as $rec){
            $response['res_surat_jalan'][$i]['id'] = $rec->id;
            $response['res_surat_jalan'][$i]['no_po'] = $rec->no_po;
            $response['res_surat_jalan'][$i]['no_penawaran'] = $rec->no_penawaran;
            $response['res_surat_jalan'][$i]['nama_customer'] = $rec->nama_customer;
            $response['res_surat_jalan'][$i]['nama_sales'] = $rec->nama_sales;
            $response['res_surat_jalan'][$i]['tgl_po'] = $rec->tgl_po;
            $response['res_surat_jalan'][$i]['jenis_pembayaran'] = $rec->jenis_pembayaran;
            $response['res_surat_jalan'][$i]['no_surat_jalan'] = $rec->no_surat_jalan;
            $response['res_surat_jalan'][$i]['flag_selesai'] = $rec->flag_selesai;
            $i++;
        }
        return view('view_surat_jalan',$response);
    }

    public function pembelian(){
        $response = array();
        $penawaran = DB::table('t_pembelian')->get();
        $i = 0;
        $response['res_pembelian'] = array();
        foreach($penawaran as $rec){
            $response['res_pembelian'][$i]['id'] = $rec->id;
            $response['res_pembelian'][$i]['no_transaksi'] = $rec->no_transaksi;
            $response['res_pembelian'][$i]['no_pembelian'] = $rec->no_pembelian;
            $response['res_pembelian'][$i]['nama_customer'] = $rec->nama_customer;
            $response['res_pembelian'][$i]['nama_supplier'] = $rec->nama_supplier;
            $response['res_pembelian'][$i]['alamat'] = $rec->alamat;
            $response['res_pembelian'][$i]['total'] = $rec->total;
            $response['res_pembelian'][$i]['tanggal_pembelian'] = $rec->tanggal_pembelian;
            $response['res_pembelian'][$i]['jenis_order'] = $rec->jenis_order;
            $response['res_pembelian'][$i]['no_po_customer'] = $rec->no_po_customer;
            $response['res_pembelian'][$i]['flag_ppn'] = $rec->flag_ppn;
            $response['res_pembelian'][$i]['ppn'] = $rec->ppn;
            $i++;
        }
        
        return view('view_pembelian',$response);
    }

    public function generate_no_pembelian(){
        $nextNumber = DB::table('t_pembelian')
        ->selectRaw("
            LPAD(
                IFNULL(MAX(RIGHT(no_pembelian, 3)), 0) + 1, 
                3, 
                '0'
            ) as next_number
        ")
        ->whereRaw("LEFT(no_pembelian, 9) = CONCAT('PBL', DATE_FORMAT(NOW(), '%y%d%m'))")
        ->value('next_number');

        $no_pembelian = "PBL" . date("ydm") . '-' . $nextNumber;
        return json_encode([
                'status'          => true,
                'no_pembelian' => $no_pembelian
            ]);
    }

    public function simpan_pembelian(){
        date_default_timezone_set("Asia/Jakarta");
        DB::beginTransaction();

        try {
            $tgl_po         = $_POST['tgl_pembelian'].' '.date('H:i:s');
            $no_transaksi   = "PB" . date("ydm");

            // Ambil ID max untuk header
            $max = DB::table('t_pembelian')->max('id');
            $max = $max ? $max + 1 : 1;

            // Format nomor transaksi
            $no_transaksi .= str_pad($max, 3, "0", STR_PAD_LEFT);

            $no_pembelian    = $_POST['no_pembelian'];
            $nama_pembeli    = $_POST['nama_pembeli'];
            $tgl_pembelian   = $_POST['tgl_pembelian'];
            $total_pembelian = $_POST['total_pembelian'];
            $jenis_pembelian = $_POST['jenis_pembelian'];
            $no_po = $_POST['no_po'];
            $alamat = $_POST['alamat'];
            $flag_ppn = $_POST['flag_ppn'];
            $ppn = $_POST['ppn'];

            // Decode detail pembelian dari JSON
            $arrDataDetailPembelian = json_decode($_POST['detail_pembelian']);

            // Insert header
            DB::table('t_pembelian')->insert([
                'id'                => $max,
                'no_transaksi'      => $no_transaksi,
                'no_pembelian'      => $no_pembelian,
                'nama_customer'     => $nama_pembeli,
                'tanggal_pembelian' => $tgl_pembelian,
                'total'             => $total_pembelian,
                'jenis_order'       => $jenis_pembelian,
                'no_po_customer'    => $no_po,
                'alamat'            => $alamat,
                'flag_ppn'          => $flag_ppn,
                'ppn'               => $ppn,
                'created_date'      => now()
            ]);

            // Ambil max ID detail sekali saja
            $maxDetail = DB::table('t_pembelian_detail')->max('id');
            $maxDetail = $maxDetail ? $maxDetail + 1 : 1;

            // Insert detail
            foreach ($arrDataDetailPembelian as $detail) {
                DB::table('t_pembelian_detail')->insert([
                    'id'           => $maxDetail++,
                    'id_header'    => $max,
                    'nama_item'    => $detail->item,
                    'qty'          => $detail->jumlah,
                    'satuan'       => $detail->satuan,
                    'harga'        => $detail->harga,
                    'created_date' => now()
                ]);
            }

            DB::commit();

            return json_encode([
                'status'          => true,
                'title'           => 'Informasi',
                'message'         => 'Data purchase order berhasil ditambahkan.',
                'id'              => $max,
                'nomor_transaksi' => $no_transaksi
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return json_encode([
                'status'          => false,
                'title'           => 'Peringatan',
                'message'         => 'Data purchase order gagal ditambahkan. Error: ' . $e->getMessage(),
                'id'              => '',
                'nomor_transaksi' => ''
            ]);
        }
    }

    public function get_data_penawaran(){
        $response = array();
        $id = $_POST['id'];
        $result = DB::select("SELECT * FROM t_penawaran_detail WHERE id_header = '{$id}' ORDER BY id ASC");
        $i = 0;
        $response = array();
        foreach($result as $rec){
            $response[$i]['id'] = $rec->id;
            $response[$i]['id_header'] = $rec->id_header;
            $response[$i]['nama_item'] = $rec->nama_item;
            $response[$i]['material'] = $rec->material;
            $response[$i]['satuan'] = $rec->satuan;
            $response[$i]['jumlah'] = $rec->qty;
            $response[$i]['harga'] = $rec->harga;
            $response[$i]['keterangan_detail'] = $rec->keterangan_detail;
            $response[$i]['created_date'] = $rec->created_date;
            $i++;
        }
        
        return json_encode($response);
    }

    public function get_data_pembelian(){
        $response = array();
        $id = $_POST['id'];
        $result = DB::select("SELECT * FROM t_pembelian_detail WHERE id_header = '{$id}' ORDER BY id ASC");
        $i = 0;
        $response = array();
        foreach($result as $rec){
            $response[$i]['id'] = $rec->id;
            $response[$i]['id_header'] = $rec->id_header;
            $response[$i]['nama_item'] = $rec->nama_item;
            $response[$i]['jumlah'] = $rec->qty;
            $response[$i]['satuan'] = $rec->satuan;
            $response[$i]['harga'] = $rec->harga;
            $response[$i]['created_date'] = $rec->created_date;
            $i++;
        }
        
        return json_encode($response);
    }

    public function update_pembelian(){
        date_default_timezone_set("Asia/Jakarta");
        DB::beginTransaction();

        try {
            $id              = $_POST['id'];
            $no_pembelian    = $_POST['no_pembelian'];
            $nama_pembeli    = $_POST['nama_pembeli'];
            $tgl_pembelian   = $_POST['tgl_pembelian'];
            $total_pembelian = $_POST['total_pembelian'];
            $jenis_pembelian = $_POST['jenis_pembelian'];
            $no_po = $_POST['no_po'];
            $alamat = $_POST['alamat'];
            $flag_ppn = $_POST['flag_ppn'];
            $ppn = $_POST['ppn'];

            // Decode detail pembelian dari JSON
            $arrDataDetailPembelian = json_decode($_POST['detail_pembelian']);

            // Update header
            DB::table('t_pembelian')
                ->where('id', $id)
                ->update([
                    'no_pembelian'      => $no_pembelian,
                    'nama_customer'     => $nama_pembeli,
                    'tanggal_pembelian' => $tgl_pembelian,
                    'total'             => $total_pembelian,
                    'no_po_customer'    => $no_po,
                    'jenis_order'       => $jenis_pembelian,
                    'alamat'            => $alamat,
                    'flag_ppn'          => $flag_ppn,
                    'ppn'               => $ppn,
                    'updated_date'      => now()
                ]);

            // Hapus detail lama
            DB::table('t_pembelian_detail')
                ->where('id_header', $id)
                ->delete();

            // Ambil max ID detail sekali saja
            $maxDetail = DB::table('t_pembelian_detail')->max('id');
            $maxDetail = $maxDetail ? $maxDetail + 1 : 1;

            // Insert detail baru
            foreach ($arrDataDetailPembelian as $detail) {
                DB::table('t_pembelian_detail')->insert([
                    'id'           => $maxDetail++,
                    'id_header'    => $id,
                    'nama_item'    => $detail->item,
                    'qty'          => $detail->jumlah,
                    'satuan'       => $detail->satuan,
                    'harga'        => $detail->harga,
                    'created_date' => now()
                ]);
            }

            DB::commit();

            return json_encode([
                'status'  => true,
                'title'   => 'Informasi',
                'message' => 'Data pembelian berhasil diupdate.',
                'id'      => $id
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return json_encode([
                'status'  => false,
                'title'   => 'Peringatan',
                'message' => 'Data pembelian gagal diupdate. Error: ' . $e->getMessage(),
                'id'      => ''
            ]);
        }
    }

    public function update_selesai_pekerjaan(){
        date_default_timezone_set("Asia/Jakarta");
        DB::beginTransaction();

        try {
            $id              = $_POST['id'];
            
            DB::table('t_sales_order')
                ->where('id', $id)
                ->update([
                    'flag_selesai'      => 'Ya'
                ]);

            DB::commit();

            return json_encode([
                'status'  => true,
                'title'   => 'Informasi',
                'message' => 'Pekerjaan sudah selesai dilakukan.',
                'id'      => $id
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return json_encode([
                'status'  => false,
                'title'   => 'Peringatan',
                'message' => 'Data surat jalan gagal diupdate. Error: ' . $e->getMessage(),
                'id'      => ''
            ]);
        }
    }
    // --- End ---

    public function daftar_antrian(){
        function tanggal_indonesia($tanggal){
            $bulan = array (
                1 =>   'Januari',
                'Februari',
                'Maret',
                'April',
                'Mei',
                'Juni',
                'Juli',
                'Agustus',
                'September',
                'Oktober',
                'November',
                'Desember'
                );
                
            $pecahkan = explode('-', $tanggal);
            
            // variabel pecahkan 0 = tanggal
            // variabel pecahkan 1 = bulan
            // variabel pecahkan 2 = tahun
            
            return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
        }
        $response = array();

        $result = DB::select("SELECT
                                    pc.id_transaksi,
                                    pc.nomor_transaksi,
                                    pc.tgl_transaksi,
                                    plg.nama_pelanggan,
                                    pc.berat,
                                    jc.jenis_cucian,
                                CASE
                                    WHEN ( DATE( pc.tgl_ambil ) = CURRENT_DATE ( ) OR DATE( pc.tgl_ambil ) < CURRENT_DATE ( ) ) 
                                    AND tr.tgl_pengambilan IS NULL THEN
                                        'Selesai Cuci' 
                                        WHEN ( DATE( pc.tgl_ambil ) = CURRENT_DATE ( ) OR DATE( pc.tgl_ambil ) < CURRENT_DATE ( ) ) 
                                        AND tr.tgl_pengambilan IS NOT NULL THEN
                                            'Sudah selesai diAmbil' ELSE
                                        CASE
                                                WHEN p.id_pencucian IS NULL THEN
                                                'Belum Proses Cuci' ELSE 'Proses Cuci' 
                                            END 
                                            END AS status_cuci 
                                        FROM
                                            penerimaan_cucian pc
                                            INNER JOIN transaksi tr ON tr.id_transaksi = pc.id_transaksi
                                            INNER JOIN pelanggan plg ON plg.id_pelanggan = pc.id_pelanggan
                                            INNER JOIN jenis_cucian jc ON jc.id_jenis_cucian = pc.id_jenis_cucian
                                            LEFT JOIN pencucian p ON p.id_transaksi = pc.id_transaksi
                                            ORDER BY tgl_transaksi DESC");
                                            
        $i = 1;
        foreach($result as $rec){
            $response[$i]['no_urut'] = $i;
            $response[$i]['no_transaksi'] = $rec->nomor_transaksi;
            $response[$i]['tgl_transaksi'] = tanggal_indonesia(date_format(date_create($rec->tgl_transaksi), 'Y-m-d'));
            $response[$i]['nama_pelanggan'] = $rec->nama_pelanggan;
            $response[$i]['berat'] = $rec->berat;
            $response[$i]['jenis_cucian'] = $rec->jenis_cucian;
            $response[$i]['status_cuci'] = $rec->status_cuci;
            $i++;
        }
        return view('daftar_antrian',['daftarantrian'=>$response]);
    }

    public function get_harga_jenis_cucian(){
        $response = array();
        $id_jenis_cucian    = $_POST['id_jenis_cucian'];
        $getHarga = DB::table('jenis_cucian')->where('id_jenis_cucian',$id_jenis_cucian)->selectRaw('harga')->get();
        $response['success'] = true;
        $response['harga'] = $getHarga[0]->harga;
        return json_encode($response);
    }

    public function simpan_penerimaan(){
        DB::beginTransaction();
        try {
            $response = array();
            date_default_timezone_set("Asia/Jakarta");
            $jam_penerimaan = date('H:i:s');
            $no_transaksi = "TR";
            $no_transaksi = $no_transaksi.date("ydm");
            $getCount = DB::table('penerimaan_cucian')->selectRaw('count( * ) as count')->get();
            if($getCount[0]->count > 0){
                $getidTransaksiMax = DB::table('penerimaan_cucian')->selectRaw('max( id_transaksi ) + 1 AS id')->get();
                $max   = $getidTransaksiMax[0]->id; 
            }else{
                $max   = 1;
            }
            
            if(strlen($max) == 1){
                $no_transaksi .= "00".$max;
            }else if(strlen($max) == 2){
                $no_transaksi .= "0".$max;
            }else{
                $no_transaksi .= $max;
            }

            $tgl_transaksi      = date("Y-m-d");
            $id_pelanggan       = $_POST['id_pelanggan'];
            $tgl_penerimaan     = $_POST['tgl_penerimaan'];
            $tgl_ambil          = $_POST['tgl_pengambilan'];
            $id_jenis_cucian    = $_POST['id_jenis_cucian'];
            $estimasi_pengerjaan = $_POST['estimasi_pengerjaan'];
            $berat              = $_POST['berat_cucian'];
            $harga              = $_POST['harga'];
            $total              = $_POST['total_pembayaran'];
            $lunas              = $_POST['langsung_bayar'];

            $result = DB::table('penerimaan_cucian')->insert(
                [
                    'id_transaksi'          => $max, 
                    'nomor_transaksi'       => $no_transaksi,
                    'tgl_transaksi'         => $tgl_transaksi,
                    'id_pelanggan'          => $id_pelanggan,
                    'tgl_penerimaan'        => $tgl_penerimaan,
                    'tgl_ambil'             => $tgl_ambil,
                    'id_jenis_cucian'       => $id_jenis_cucian,
                    'estimasi_pengerjaan'   => $estimasi_pengerjaan,
                    'berat'                 => $berat,
                    'harga'                 => $harga,
                    'total'                 => $total,
                    'lunas'                 => $lunas,
                    'jam_penerimaan'        => $jam_penerimaan
                ]
            );

            if($result){
                // Proser insert transaksi
                $result = DB::table('transaksi')->insert(
                    [
                        'id_transaksi'          => $max, 
                        'id_pelanggan'          => $id_pelanggan,
                        'tgl_transaksi'         => $tgl_penerimaan,
                        'id_jenis_cucian'       => $id_jenis_cucian,
                        'berat'                 => $berat,
                        'harga'                 => $harga,
                        'total'                 => $total,
                        'status_ambil'          => 'false'
                    ]
                );
                if($result){
                    DB::commit();
                    $response['status'] = true;
                    $response['title'] = 'Informasi';
                    $response['message'] = 'Data penerimaan berhasil ditambahkan.';
                    $response['id'] = $max;
                    $response['nomor_transaksi'] = $no_transaksi;
                }else{
                    DB::rollback();
                    $response['status'] = false;
                    $response['title'] = 'Peringatan';
                    $response['message'] = 'Data penerimaan gagal ditambahkan.';
                    $response['id'] = '';
                    $response['nomor_transaksi'] = '';
                }
            }else{
                DB::rollback();
                $response['status'] = false;
                $response['title'] = 'Peringatan';
                $response['message'] = 'Data penerimaan gagal ditambahkan.';
                $response['id'] = '';
                $response['nomor_transaksi'] = '';
            }
        } catch (\Exception $e) {
            DB::rollback();
            $response['status'] = false;
            $response['title'] = 'Peringatan';
            $response['message'] = 'Data penerimaan gagal ditambahkan.';
            $response['id'] = '';
            $response['nomor_transaksi'] = '';
            // something went wrong
        }
        return json_encode($response);
    }

    public function pencucian(Request $request){
        function tanggal_indonesia($tanggal){
            $bulan = array (
                1 =>   'Januari',
                'Februari',
                'Maret',
                'April',
                'Mei',
                'Juni',
                'Juli',
                'Agustus',
                'September',
                'Oktober',
                'November',
                'Desember'
                );
                
            $pecahkan = explode('-', $tanggal);
            
            // variabel pecahkan 0 = tanggal
            // variabel pecahkan 1 = bulan
            // variabel pecahkan 2 = tahun
            
            return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
        }

        $response = array();
        $result = DB::select("SELECT
                                    pc.*,
                                    p.nama_pelanggan,
                                    jc.jenis_cucian,
                                    sc_d.id_sabun as id_detergent,
                                    sc_d.nama_sabun as nama_detergent,
                                    pcc.jml_detergent,
                                    sc_s.id_sabun as id_softener,
                                    sc_s.nama_sabun as nama_softener,
                                    pcc.jml_softener,
                                    case when sc_d.id_sabun is not null then 'Y' else 'N' end as flag_detergent,
                                    case when sc_s.id_sabun is not null then 'Y' else 'N' end as flag_softener 
                                FROM
                                    penerimaan_cucian pc
                                    INNER JOIN pelanggan p ON p.id_pelanggan = pc.id_pelanggan
                                    INNER JOIN jenis_cucian jc ON jc.id_jenis_cucian = pc.id_jenis_cucian
                                    LEFT JOIN pencucian pcc ON pcc.id_transaksi = pc.id_transaksi
                                    LEFT JOIN sabun_cuci sc_d ON sc_d.id_sabun = pcc.id_detergent 
                                    AND upper( sc_d.jenis_sabun ) = upper( 'detergent' )
                                    LEFT JOIN sabun_cuci sc_s ON sc_s.id_sabun = pcc.id_softener 
                                    AND upper( sc_s.jenis_sabun ) = upper( 'softener' ) 
                                ORDER BY
                                    id_transaksi DESC");
        $i = 0;
        $response['pencucian'] = array();
        foreach($result as $rec){
            $sabun = '';
            $response['pencucian'][$i]['id_transaksi'] = $rec->id_transaksi;
            $response['pencucian'][$i]['nomor_transaksi'] = $rec->nomor_transaksi;
            $response['pencucian'][$i]['tgl_transaksi'] = tanggal_indonesia(date_format(date_create($rec->tgl_transaksi), "Y-m-d"));
            $response['pencucian'][$i]['id_pelanggan'] = $rec->id_pelanggan;
            $response['pencucian'][$i]['nama_pelanggan'] = $rec->nama_pelanggan;
            $response['pencucian'][$i]['berat'] = $rec->berat;
            $response['pencucian'][$i]['id_jenis_cucian'] = $rec->id_jenis_cucian;
            $response['pencucian'][$i]['jenis_cucian'] = $rec->jenis_cucian;
            $response['pencucian'][$i]['id_detergent'] = $rec->id_detergent;
            $response['pencucian'][$i]['jml_detergent'] = $rec->jml_detergent;
            $response['pencucian'][$i]['id_softener'] = $rec->id_softener;
            $response['pencucian'][$i]['jml_softener'] = $rec->jml_softener;
            $response['pencucian'][$i]['flag_detergent'] = $rec->flag_detergent;
            $response['pencucian'][$i]['flag_softener'] = $rec->flag_softener;
            if($rec->nama_detergent != ''){
                $sabun .= ucwords(strtolower($rec->nama_detergent)).'('.$rec->jml_detergent.') ';
            }
            if($rec->nama_softener != ''){
                $sabun .= ucwords(strtolower($rec->nama_softener)).'('.$rec->jml_softener.')';
            }
            $response['pencucian'][$i]['kebutuhan_sabun'] = $sabun;
            $i++;
        }

        $result = DB::select("SELECT
                                    * 
                                FROM
                                    sabun_cuci 
                                WHERE
                                    upper( jenis_sabun ) = 'DETERGENT' 
                                    AND stok <> 0 
                                ORDER BY
                                    nama_sabun ASC");
        $i = 0;
        foreach($result as $rec){
            $response['detergent'][$i]['value'] = $rec->id_sabun;
            $response['detergent'][$i]['name'] = strtoupper($rec->nama_sabun);
            $i++;
        }

        $result = DB::select("SELECT
                                    * 
                                FROM
                                    sabun_cuci 
                                WHERE
                                    upper( jenis_sabun ) = 'SOFTENER' 
                                    AND stok <> 0 
                                ORDER BY
                                    nama_sabun ASC");
        $i = 0;
        foreach($result as $rec){
            $response['softener'][$i]['value'] = $rec->id_sabun;
            $response['softener'][$i]['name'] = strtoupper($rec->nama_sabun);
            $i++;
        }

        return view('pencucian',$response);
    }

    public function simpan_pencucian(){
        DB::beginTransaction();
        try {
            $response = array();
            $getCount = DB::table('pencucian')->selectRaw('count( * ) as count')->get();
            if($getCount[0]->count > 0){
                $getidTransaksiMax = DB::table('pencucian')->selectRaw('max( id_pencucian ) + 1 AS id')->get();
                $id_pencucian   = $getidTransaksiMax[0]->id; 
            }else{
                $id_pencucian   = 1;
            }
            
            $id_transaksi           = $_POST['id_transaksi'];
            $id_jenis_cucian        = $_POST['id_jenis_cucian'];
            $berat                  = $_POST['berat'];
            $id_detergent           = $_POST['id_detergent'];
            $jml_detergent          = $_POST['jml_detergent'];
            $id_softener            = $_POST['id_softener'];
            $jml_softener           = $_POST['jml_softener'];

            
            // Penambahan jumlah qty pakai untuk sabun detergent
            if($id_detergent != ''){
                $result = DB::select("SELECT CASE WHEN stok IS NULL THEN 0 ELSE stok END AS stok 
                                            FROM
                                                sabun_cuci 
                                            WHERE
                                            id_sabun = '$id_detergent'");
                $total_sisa = $result[0]->stok-$jml_detergent; 
                if($total_sisa >= 0){
                    DB::table('sabun_cuci')->where('id_sabun', $id_detergent)->update(['stok' => $total_sisa]);
                }else{
                    DB::rollback();
                    $response['status'] = false;
                    $response['title'] = 'Peringatan';
                    $response['message'] = 'Jumlah stok softergent minus.';
                    return json_encode($response);
                }
            }

            // Penambahan jumlah qty pakai untuk sabun softergent
            if($id_softener != ''){
                $result = DB::select("SELECT CASE WHEN stok IS NULL THEN 0 ELSE stok END AS stok 
                                            FROM
                                                sabun_cuci 
                                            WHERE
                                            id_sabun = '$id_softener'");
                $total_sisa = $result[0]->stok-$jml_softener; 
                if($total_sisa >= 0){
                    DB::table('sabun_cuci')->where('id_sabun', $id_softener)->update(['stok' => $total_sisa]);
                }else{
                    DB::rollback();
                    $response['status'] = false;
                    $response['title'] = 'Peringatan';
                    $response['message'] = 'Jumlah stok softergent minus.';
                    return json_encode($response);
                }
            }

            $dataParams = array(
                'id_transaksi'      => $id_transaksi,
                'id_jenis_cucian'   => $id_jenis_cucian
            );

            $getDataExisting = DB::table('pencucian')->where($dataParams)->selectRaw('count( * ) as count')->get();
            
            if($getDataExisting[0]->count == 0){
                $dataParams = array(
                    'id_pencucian'      => $id_pencucian, 
                    'id_transaksi'      => $id_transaksi,
                    'id_jenis_cucian'   => $id_jenis_cucian,
                    'berat'             => $berat,
                );
    
                if($id_detergent != ''){
                    $dataParams['id_detergent'] = $id_detergent;
                }
                if($jml_detergent != ''){
                    $dataParams['jml_detergent'] = $jml_detergent;
                }
                if($id_softener != ''){
                    $dataParams['id_softener'] = $id_softener;
                }
                if($jml_softener != ''){
                    $dataParams['jml_softener'] = $jml_softener;
                }
                $result = DB::table('pencucian')->insert($dataParams);
                
                if($result){
                    DB::commit();
                    $response['status'] = true;
                    $response['title'] = 'Informasi';
                    $response['message'] = 'Data pencucian berhasil ditambahkan.';
                }else{
                    DB::rollback();
                    $response['status'] = false;
                    $response['title'] = 'Peringatan';
                    $response['message'] = 'Data pencucian gagal ditambahkan.';
                }
            }else{
                DB::rollback();
                $response['status'] = false;
                $response['title'] = 'Peringatan';
                $response['message'] = 'Data tidak dapat diupdate kembali.';
            }
            
        } catch (\Exception $e) {
            DB::rollback();
            $response['status'] = false;
            $response['title'] = 'Peringatan';
            $response['message'] = 'Data pencucian gagal ditambahkan.';
            // something went wrong
        }
        return json_encode($response);
    }

    public function pengambilan_cucian(){
        function tanggal_indonesia($tanggal){
            $bulan = array (
                1 =>   'Januari',
                'Februari',
                'Maret',
                'April',
                'Mei',
                'Juni',
                'Juli',
                'Agustus',
                'September',
                'Oktober',
                'November',
                'Desember'
                );
                
            $pecahkan = explode('-', $tanggal);
            
            // variabel pecahkan 0 = tanggal
            // variabel pecahkan 1 = bulan
            // variabel pecahkan 2 = tahun
            
            return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
        }

        $response = array();
        $result = DB::select("SELECT
                                    t.id_transaksi,
                                    pc.nomor_transaksi,
                                    t.tgl_transaksi,
                                    p.nama_pelanggan,
                                    t.berat,
                                    jc.jenis_cucian,
                                    t.harga,
                                    t.total,
                                    CASE
                                        WHEN t.status_ambil = 'false' THEN
                                        'belum diambil' ELSE 'sudah diambil' 
                                        END AS status_ambil,
                                    pc.lunas 
                                FROM
                                    transaksi t
                                    INNER JOIN penerimaan_cucian pc ON pc.id_transaksi = t.id_transaksi
                                    INNER JOIN pelanggan p ON p.id_pelanggan = t.id_pelanggan
                                    INNER JOIN jenis_cucian jc ON jc.id_jenis_cucian = t.id_jenis_cucian 
                                -- WHERE
                                --     t.status_ambil = FALSE 
                                ORDER BY
                                    pc.nomor_transaksi DESC");
        $i = 0;
        $response['pengambilan'] = array();
        foreach($result as $rec){
            $response['pengambilan'][$i]['id_transaksi']        = $rec->id_transaksi;
            $response['pengambilan'][$i]['nomor_transaksi']     = $rec->nomor_transaksi;
            $response['pengambilan'][$i]['tgl_transaksi']       = tanggal_indonesia(date_format(date_create($rec->tgl_transaksi), "Y-m-d"));
            $response['pengambilan'][$i]['nama_pelanggan']      = $rec->nama_pelanggan;
            $response['pengambilan'][$i]['berat']               = $rec->berat;
            $response['pengambilan'][$i]['jenis_cucian']        = $rec->jenis_cucian;
            $response['pengambilan'][$i]['harga']               = $rec->harga;
            $response['pengambilan'][$i]['total']               = $rec->total;
            $response['pengambilan'][$i]['status_ambil']        = $rec->status_ambil;
            $response['pengambilan'][$i]['lunas']               = $rec->lunas;
            $i++;
        }
        return view('pengambilan_cucian',$response);
    }
    
    public function simpan_pengambilan(){
        DB::beginTransaction();
        try {
            $response = array();
            date_default_timezone_set("Asia/Jakarta");
            $tgl_pengambilan = date('Y-m-d');
            $jam_pengambilan = date('H:i:s');
            $id_transaksi = $_POST['id_transaksi'];
            $lunas = $_POST['lunas'];
            /* if($lunas == 'true'){
                $response['status'] = true;
                $response['title'] = 'Informasi';
                $response['message'] = 'sudah lunas.';
            }else{
                $response['status'] = true;
                $response['title'] = 'Informasi';
                $response['message'] = 'belum lunas.';
            }
            return json_encode($response);
            exit; */
            $result = DB::table('transaksi')->where('id_transaksi', $id_transaksi)->update(['status_ambil' => 'true', 'tgl_pengambilan' => $tgl_pengambilan,'jam_pengambilan' => $jam_pengambilan]);
            
            if($result){
                if($lunas == 'true'){
                    DB::commit();
                    $response['status'] = true;
                    $response['title'] = 'Informasi';
                    $response['message'] = 'Data pengambilan berhasil disimpan.';
                }else{
                    $result = DB::table('penerimaan_cucian')->where('id_transaksi', $id_transaksi)->update(['lunas' => 'true']);
                    if($result){
                        DB::commit();
                        $response['status'] = true;
                        $response['title'] = 'Informasi';
                        $response['message'] = 'Data pengambilan berhasil disimpan.';
                    }else{
                        DB::rollback();
                        $response['status'] = false;
                        $response['title'] = 'Peringatan';
                        $response['message'] = 'Data pengambilan gagal disimpan.';
                    }
                }
            }else{
                DB::rollback();
                $response['status'] = false;
                $response['title'] = 'Peringatan';
                $response['message'] = 'Sudah dilakukan pengambilan.';
            }
            
        } catch (\Exception $e) {
            DB::rollback();
            $response['status'] = false;
            $response['title'] = 'Peringatan';
            $response['message'] = 'Data pengambilan gagal disimpan.';
            // something went wrong
        }
        return json_encode($response);
    }
}
