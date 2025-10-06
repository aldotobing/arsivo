<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use \Mpdf\Mpdf as PDF;
use Illuminate\Support\Facades\Storage;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\Facades\Auth;
// use PDF;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;

class Controllers_report extends Controller
{
    protected $url;
    public function __construct(UrlGenerator $url)
    {
        $this->url = $url;
    }

    // --- Start ---
    public function cetak_penawaran()
    {
        $users = DB::table('users')->select('name')->where('id', Auth::user()->id)->get();

        function tgl_indo($tanggal)
        {
            $bulan = array(
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

            return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
        }

        $html = '';
        $params = base64_decode($_GET['params']);

        $no_transaksi       = "";
        $no_penawaran       = "";
        $nama_customer      = "";
        $alamat_customer    = "";
        $nama_sales         = "";
        $tanggal_penawaran  = "";
        $ppn                = 0;
        $total_penawaran    = 0;

        $result = DB::select("SELECT * FROM t_penawaran where id = '" . $params . "'");
        foreach ($result as $rec) {
            $no_transaksi = $rec->no_transaksi;
            $no_penawaran = $rec->no_penawaran;
            $nama_customer = $rec->nama_customer;
            $alamat_customer = $rec->alamat_customer;
            $nama_sales = $rec->nama_sales;
            $tanggal_penawaran = $rec->tanggal_penawaran;
            $ppn = $rec->ppn;
            $total_penawaran = $rec->total_penawaran;
        }

        // Setup a filename  
        $documentFileName = "cetakpewaran.pdf";

        // Create the mPDF document
        $document = new PDF([
            'mode' => 'utf-8',
            'format' => 'A4-P',
            // 'format' => [240, 160,'L'],
            // 'format' => [60, 80],
            'margin_top' => '20',
            'margin_bottom' => '20',
            // 'margin_left' => '1',
            // 'margin_right' => '1',
        ]);

        // Set some header informations for output
        $header = [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . $documentFileName . '"'
        ];

        $resultHeader = DB::select("SELECT
                                    * 
                                FROM
                                    t_penawaran 
                                WHERE
                                    id = '" . $params . "'");
        $no = 1;
        $sub_total = 0;
        $total = 0;
        $ppn = 0;
        $diskon = 0;
        $no_penawaran = "";
        $nama_customer = "";
        $alamat_customer = "";
        $keterangan = "";
        $tgl_penawaran = "";
        $nama_sales = "";
        $no_transaksi = "";
        foreach ($resultHeader as $rec) {
            $no_penawaran = $rec->no_penawaran;
            $nama_customer = $rec->nama_customer;
            $alamat_customer = $rec->alamat_customer;
            $ppn = $rec->ppn;
            $diskon = $rec->diskon;
            $keterangan = $rec->keterangan;
            $tgl_penawaran = $rec->tanggal_penawaran;
            $nama_sales = $rec->nama_sales;
            $no_transaksi = $rec->no_transaksi;
        }

        $document->SetTitle('Cetak Penawaran');
        $document->SetHeader('<table width="100%" border="0" cellspacing="0">
                                    <tr>
                                        <td rowspan="7" align="left" width="100px"><img src="' . str_replace("/index.php", "", $this->url->to('/')) . '/public/icon_pt_ace.jpg" height="95px" width="110px"></td>
                                        <td align="left" style="font-family:arial;font-size:16px;"><strong>ARSIVO</strong></td>
                                    </tr>
                                    <tr>
                                        <td style="font-family:arial;font-size:10px;"><strong>Perum Graha Asri Sukodono Jl. Manggis AM.08 Pekarungan Sukodono</strong></td>
                                    </tr>
                                    <tr>
                                        <td style="font-family:arial;font-size:10px;"><strong>Sidoarjo 61258 (Head Office)</strong></td>
                                    </tr>
                                    <tr>
                                        <td style="font-family:arial;font-size:10px;"><strong>Phone : 0817-5076-543 / 0821-3187-6197</strong></td>
                                    </tr>
                                    <tr>
                                        <td style="font-family:arial;font-size:10px;"><strong>E-Mail : ace@anugrah-cipta-engineering.com</strong></td>
                                    </tr>
                                    <tr>
                                        <td style="font-family:arial;font-size:10px;"><strong>Website. www.anugrah-cipta-engineering.com</strong></td>
                                    </tr>
                                    <tr>
                                        <td align="right" style="font-family:arial;font-size:11px;"><b>No Transaksi : ' . strtoupper($no_transaksi) . '</b></td>
                                    </tr>
                                </table><br>');
        $document->SetHTMLFooter('<table border="0" width="100%" style="font-family:arial; font-size:9px; border-top:1px solid #000; padding-top:3px;">
                                    <tr>
                                        <td width="70%" style="vertical-align:top; text-align:left;">
                                            <b>Machining WorkShop</b><br>
                                            Jl. Merapi No. 11, Kel. Bambe, <br>
                                            Kec. Driyorejo, Gresik, <br>
                                            Jawa Timur 61177
                                        </td>
                                        <td width="30%" style="vertical-align:top; text-align:left;">
                                            <b>Fabrication WorkShop</b><br>
                                            Jl. Sawunggaling 3, No. 74 <br>
                                            Kel. Jemundo, Kec. Taman <br>
                                            Sidoarjo, Jawa Timur 61257
                                        </td>
                                    </tr>
                                </table>
                            ');

        $html .= '<br><br><br><br><br><br><table width="100%" border="0" cellspacing="0" style="font-family:arial;font-size:12px;">
                        <tr>
                            <td width="15%">Perihal</td>
                            <td width="1%">:</td>
                            <td width="25%">Penawaran Harga</td>
                            <td width="15%">Nama Pelanggan</td>
                            <td width="1%">:</td>
                            <td width="23%">' . strtoupper($nama_customer) . '</td>
                        </tr>
                        <tr>
                            <td>No Penawaran</td>
                            <td>:</td>
                            <td>' . strtoupper($no_penawaran) . '</td>
                            <td>Nama Sales</td>
                            <td>:</td>
                            <td>' . ucwords(strtolower($nama_sales)) . '</td>
                        </tr>
                        <tr>
                            <td>Tanggal Penawaran</td>
                            <td>:</td>
                            <td>' . tgl_indo(date_format(date_create($tgl_penawaran), "Y-m-d")) . '</td>
                            <td>Tanggal Cetak</td>
                            <td>:</td>
                            <td>' . tgl_indo(date("Y-m-d")) . '</td>
                        </tr>
                    </table>';
        $html .= '<br><table width="100%" border="1" cellspacing="0" style="font-family:arial;font-size:13px;">
                        <tr>
                            <th width="30px">No.</th>
                            <th width="300px">Jenis Pekerjaan</th>
                            <th width="100px">Material</th>
                            <th width="100px" colspan="2">Kuantum</th>
                            <th width="100px">Harga</th>
                            <th width="100px">Jumlah</th>
                        </tr>';

        $resultDetail = DB::select("SELECT
                                    * 
                                FROM
                                    t_penawaran_detail 
                                WHERE
                                    id_header = '" . $params . "'");
        $no = 1;
        $sub_total = 0;
        $total = 0;
        foreach ($resultDetail as $rec) {
            $jumlah = 0;
            $jumlah = $rec->qty * $rec->harga;
            $sub_total += $jumlah;

            // hitung PPN (11%) dan Diskon (8%)
            $nilai_ppn    = ($sub_total * $ppn) / 100;
            $nilai_diskon = ($sub_total * $diskon) / 100;

            // total akhir
            $total = $sub_total + $nilai_ppn - $nilai_diskon;

            $html .= '<tr>
                        <td valign="top" align="center" style="border-top:none;border-bottom:none;">' . $no . '</td>
                        <td valign="top" style="padding-left:5px;border-top:none;border-bottom:none;">' . $rec->nama_item . '</td>
                        <td valign="top" align="center" style="border-top:none;border-bottom:none;">' . $rec->material . '</td>
                        <td valign="top" align="right" style="border-top:none;border-bottom:none;border-right:none;">' . number_format($rec->qty, "0", ",", ".") . '</td>
                        <td valign="top" align="left" style="border-top:none;border-bottom:none;border-left:none;">' . ucwords(strtolower($rec->satuan)) . '</td>
                        <td valign="top" align="right" style="padding-right:5px;border-top:none;border-bottom:none;">' . number_format($rec->harga, "0", ",", ".") . '</td>
                        <td valign="top" align="right" style="padding-right:5px;border-top:none;border-bottom:none;">' . number_format(($jumlah), "0", ",", ".") . '</td>
                    </tr>';
            $no++;
        }

        $tinggi = 150;
        for ($i = 0; $i < $no; $i++) {
            if ($i < 10) {
                $tinggi = $tinggi - 15;
            } else {
                $tinggi = 0;
            }
        }
        $html .= '<tr>
                    <td height="' . $tinggi . 'px" valign="top" align="center" style="border-top:none;"></td>
                    <td valign="top" style="padding-left:5px;border-top:none;"></td>
                    <td valign="top" align="center" style="border-top:none;"></td>
                    <td valign="top" align="right" style="border-top:none;border-right:none;"></td>
                    <td valign="top" align="right" style="padding-right:5px;border-top:none;border-left:none;"></td>
                    <td valign="top" align="right" style="padding-right:5px;border-top:none;"></td>
                    <td valign="top" align="right" style="padding-right:5px;border-top:none;"></td>
                </tr>';
        $html .= '<tr>
                    <td valign="top" align="right" colspan="6" style="padding-right:5px;border-top:1px solid;border-bottom: none;">Sub Total</td>
                    <td valign="top" align="right" style="padding-right:5px;border-top:1px solid;border-bottom: none;">' . number_format($sub_total, "0", ",", ".") . '</td>
                </tr>';
        /* $html .= '<tr>
                    <td valign="top" align="right" colspan="6" style="padding-right:5px;border-top:none;border-bottom: none;">PPN ('.$ppn.'%)</td>
                    <td valign="top" align="right" style="padding-right:5px;border-top:none;border-bottom: none;">'.number_format($nilai_ppn,"0",",",".").'</td>
                </tr>';
        $html .= '<tr>
                    <td valign="top" align="right" colspan="6" style="padding-right:5px;border-top:none;border-bottom: none;">Diskon ('.$diskon.'%)</td>
                    <td valign="top" align="right" style="padding-right:5px;border-top:none;border-bottom: none;">'.number_format($nilai_diskon,"0",",",".").'</td>
                </tr>';
        $html .= '<tr>
                    <td valign="top" align="right" colspan="6" style="padding-right:5px;border-top:none;"><b>Total</b></td>
                    <td valign="top" align="right" style="padding-right:5px;border-top:none;"><b>'.number_format($total,"0",",",".").'</b></td>
                </tr>'; */
        $html .= '</table>';
        $html .= '<br><table width="100%" border="0" cellspacing="0" style="font-family:arial;font-size:12px;">
                        <tr>
                            <td style="padding-left:0px;" colspan="3">Syarat dan Ketentuan : </td>
                        </tr>
                        <tr>
                            <td style="padding-left:0px;" colspan="3">&nbsp;</td>
                        </tr>
                        <tr>
                            <td style="padding-left:0px;" colspan="3"><b>Harga belum termasuk PPN 11%</b></td>
                        </tr>
                        <tr>
                            <td width="170px" style="padding-left:0px;"><b>Penawaran Berlaku</b></td>
                            <td width="10px">:</td>
                            <td><b>7 Hari</b></td>
                        </tr>
                        <tr>
                            <td style="padding-left:0px;"><b>Waktu Penyelesaian</b></td>
                            <td>:</td>
                            <td><b>' . $keterangan . '</b></td>
                        </tr>
                        <tr>
                            <td style="padding-left:0px;"><b>Syarat Pembayaran</b></td>
                            <td>:</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td style="padding-left:60px;" colspan="3">A. DP 40% saat penerimaan SPK/PO</td>
                        </tr>
                        <tr>
                            <td style="padding-left:60px;" colspan="3">B. Pelunasan 60%, setelah barang selesai</td>
                        </tr>
                        <tr>
                            <td style="padding-left:60px;" colspan="3">C. Pembayaran dianggap sah apabila dibayarkan & dan diterima pada rekening PT. Anugrah Cipta Engineering</td>
                        </tr>
                        <tr>
                            <td style="padding-left:60px;" colspan="3">D. Pembayaran dengan cara tunai/cash baru dianggap sah apabila dibayarkan & dan diterima oleh </td>
                        </tr>
                        <tr>
                            <td style="padding-left:60px;" colspan="3">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;kasir PT. Anugrah Cipta Engineering</td>
                        </tr>
                        <tr>
                            <td style="padding-left:60px;" colspan="3">E. Kami tidak bertanggung jawab jika pembayaran dilakukan diluar ketentuan point C dan D</td>
                        </tr>
                        <tr>
                            <td style="padding-left:0px;" colspan="3">&nbsp;</td>
                        </tr>
                        <tr>
                            <td style="padding-left:0px;" colspan="3">Dengan penawaran ini kami ajukan , atas perhatian dan kerjasamanya  kami sampaikan terima kasih.</td>
                        </tr>
                    </table>';

        $html .= '<br><table width="100%" border="0" cellspacing="0" style="font-family:arial;font-size:12px;">
                        <tr>
                            <td align ="center" width="150px">Hormat Kami,</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td height="80px" colspan="2"></td>
                        </tr>
                        <tr>
                            <td align ="center" width="150px"><i><u>TEGUH PRAYITNO</u></i></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td align ="center" width="150px">OPERASIONAL MANAGER</td>
                            <td></td>
                        </tr>
                    </table>';
        $document->WriteHTML($html);

        // Save PDF on your public storage 
        Storage::disk('public')->put($documentFileName, $document->Output($documentFileName, "S"));

        // Get file back from storage with the give header informations
        return Storage::disk('public')->download($documentFileName, 'Request', $header);
    }

    public function cetak_sales_order()
    {
        $users = DB::table('users')->select('name')->where('id', Auth::user()->id)->get();

        function tgl_indo($tanggal)
        {
            $bulan = array(
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

            return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
        }

        $html = '';
        $params = $_GET['params'];

        // Setup a filename  
        $documentFileName = "cetaksalesorder.pdf";

        // Create the mPDF document
        $document = new PDF([
            'mode' => 'utf-8',
            'format' => 'A4-P',
            // 'format' => [240, 160,'L'],
            // 'format' => [60, 80],
            'margin_top' => '20',
            'margin_bottom' => '20',
            // 'margin_left' => '1',
            // 'margin_right' => '1',
        ]);

        // Set some header informations for output
        $header = [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . $documentFileName . '"'
        ];

        $resultHeader = DB::select("SELECT
                                        A.*,
                                        B.no_transaksi as no_po,
                                        B.created_date as tgl_po,
                                        B.total_pembayaran,
                                        B.nominal_dp,
                                        B.sisa_pembayaran,
                                        B.keterangan as keterangan_po,
                                        B.no_ph,
                                        B.jenis_pembayaran
                                    FROM
                                        t_penawaran A
                                        INNER JOIN t_sales_order B ON B.id_penawaran = A.id 
                                    WHERE
                                        A.id = '" . $params . "'");
        $no = 1;
        $sub_total = 0;
        $total = 0;
        $ppn = 0;
        $diskon = 0;
        $no_penawaran = "";
        $nama_customer = "";
        $alamat_customer = "";
        $keterangan = "";
        $no_po = "";
        $tgl_po = "";
        $nominal_dp = 0;
        $sisa_pembayaran = 0;
        $keterangan_po = "";
        $no_ph = "";
        $jenis_pembayaran = "";
        foreach ($resultHeader as $rec) {
            $no_penawaran = $rec->no_penawaran;
            $nama_customer = $rec->nama_customer;
            $alamat_customer = $rec->alamat_customer;
            $ppn = $rec->ppn;
            $diskon = $rec->diskon;
            $keterangan = $rec->keterangan;
            $no_po = $rec->no_po;
            $tgl_po = $rec->tgl_po;
            $nominal_dp = $rec->nominal_dp;
            $sisa_pembayaran = $rec->sisa_pembayaran;
            $keterangan_po = $rec->keterangan_po;
            $no_ph = $rec->no_ph;
            $jenis_pembayaran = $rec->jenis_pembayaran;
        }

        $document->SetTitle('Cetak Sales Order');
        $document->SetHeader('<table width="100%" border="0" cellspacing="0">
                                    <tr>
                                        <td rowspan="6" align="left" width="100px"><img src="' . str_replace("/index.php", "", $this->url->to('/')) . '/public/icon_pt_ace.jpg" height="95px" width="110px"></td>
                                        <td align="left" style="font-family:arial;font-size:16px;"><strong>ARSIVO</strong></td>
                                        <td rowspan="6" align="left" width="200px" valign="bottom" style="font-family:arial;font-size:14px;"><b><u>BON PESANAN    </u></b></td>
                                    </tr>                                    <tr>
                                        <td style="font-family:arial;font-size:10px;"><strong>Perum Graha Asri Sukodono Jl. Manggis AM.08 Pekarungan Sukodono</strong></td>
                                    </tr>
                                    <tr>
                                        <td style="font-family:arial;font-size:10px;"><strong>Sidoarjo 61258 (Head Office)</strong></td>
                                    </tr>
                                    <tr>
                                        <td style="font-family:arial;font-size:10px;"><strong>Phone : 0817-5076-543 / 0821-3187-6197</strong></td>
                                    </tr>
                                    <tr>
                                        <td style="font-family:arial;font-size:10px;"><strong>E-Mail : ace@anugrah-cipta-engineering.com</strong></td>
                                    </tr>
                                    <tr>
                                        <td style="font-family:arial;font-size:10px;"><strong>Website. www.anugrah-cipta-engineering.com</strong></td>
                                    </tr>
                                </table><br>');
        $document->SetHTMLFooter('<table border="0" width="100%" style="font-family:arial; font-size:9px; border-top:1px solid #000; padding-top:3px;">
                                    <tr>
                                        <td width="70%" style="vertical-align:top; text-align:left;">
                                            <b>Machining WorkShop</b><br>
                                            Jl. Merapi No. 11, Kel. Bambe, <br>
                                            Kec. Driyorejo, Gresik, <br>
                                            Jawa Timur 61177
                                        </td>
                                        <td width="30%" style="vertical-align:top; text-align:left;">
                                            <b>Fabrication WorkShop</b><br>
                                            Jl. Sawunggaling 3, No. 74 <br>
                                            Kel. Jemundo, Kec. Taman <br>
                                            Sidoarjo, Jawa Timur 61257
                                        </td>
                                    </tr>
                                </table>
                            ');

        $html .= '<br><br><br><br><table width="100%" border="0" cellspacing="0" style="font-family:arial;font-size:12px;">
                        <tr>
                            <td width="100px">Order By</td>
                            <td width="2px">:</td>
                            <td><b>' . strtoupper($nama_customer) . '</b></td>
                            <td width="100px">SO Number</td>
                            <td width="2px">:</td>
                            <td width="150px"><b>' . strtoupper($no_po) . '</b></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td rowspan="3" valign="top">' . ucwords(strtolower($alamat_customer)) . '</td>
                            <td>SO Date</td>
                            <td>:</td>
                            <td>' . tgl_indo(date_format(date_create($tgl_po), "Y-m-d")) . '</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>No PH</td>
                            <td>:</td>
                            <td>' . strtoupper($no_ph) . '</td>
                        </tr>
                    </table>';
        $html .= '<br><table width="100%" border="1" cellspacing="0" style="font-family:arial;font-size:13px;">
                        <tr>
                            <th width="30px">No</th>
                            <th width="400px">Pesanan</th>
                            <th width="100px">Kuantum</th>
                            <th width="100px">Satuan</th>
                            <th width="100px">Harga</th>
                            <th width="100px">Jumlah</th>
                        </tr>';

        $resultDetail = DB::select("SELECT
                                    * 
                                FROM
                                    t_penawaran_detail 
                                WHERE
                                    id_header = '" . $params . "'");
        $no = 1;
        $sub_total = 0;
        $total = 0;
        $total_sisa = 0;
        $nilai_ppn    = 0;
        $nilai_diskon = 0;
        foreach ($resultDetail as $rec) {
            $jumlah = 0;
            $jumlah = $rec->qty * $rec->harga;
            $sub_total += $jumlah;

            // hitung PPN (11%) dan Diskon (8%)
            $nilai_ppn    = ($sub_total * $ppn) / 100;
            $nilai_diskon = ($sub_total * $diskon) / 100;

            // total akhir
            $total = $sub_total + $nilai_ppn - $nilai_diskon;

            $html .= '<tr>
                        <td align="center" style="padding-left:5px;border-top:none;border-bottom:none;">' . $no . '</td>
                        <td valign="top" style="padding-left:5px;border-top:none;border-bottom:none;">' . $rec->nama_item . '</td>
                        <td valign="top" align="center" style="border-top:none;border-bottom:none;">' . number_format($rec->qty, "0", ",", ".") . '</td>
                        <td valign="top" align="center" style="border-top:none;border-bottom:none;">' . $rec->satuan . '</td>
                        <td valign="top" align="right" style="padding-right:5px;border-top:none;border-bottom:none;">' . number_format($rec->harga, "0", ",", ".") . '</td>
                        <td valign="top" align="right" style="padding-right:5px;border-top:none;border-bottom:none;">' . number_format(($jumlah), "0", ",", ".") . '</td>
                    </tr>';
            $no++;
        }

        $total_sisa = $total - $nominal_dp;

        $tinggi = 80;
        for ($i = 0; $i < $no; $i++) {
            if ($i < 6) {
                $tinggi = $tinggi - 10;
            } else {
                $tinggi = 0;
            }
        }
        $html .= '<tr>
                    <td height="' . $tinggi . 'px" valign="top" align="center" style="border-top:none;"></td>
                    <td valign="top" align="center" style="border-top:none;"></td>
                    <td valign="top" align="right" style="border-top:none;"></td>
                    <td valign="top" align="right" style="padding-right:5px;border-top:none;"></td>
                    <td valign="top" align="right" style="padding-right:5px;border-top:none;"></td>
                </tr>';

        $html .= '</table>';
        $html .= '<table width="100%" border="0" cellspacing="0" style="font-family:arial;font-size:12px;">
                        <tr>
                            <td width="280px" align="center" style="padding-left:150px;">Menyetujui,</td>
                            <td width="130px" align="center">Penerima,</td>
                            <td width="50px" align="right">Sub Total</td>
                            <td width="2px" align="center">:</td>
                            <td width="50px" align="right">' . number_format(($sub_total), "0", ",", ".") . '</td>
                        </tr>
                        <tr>
                            <td rowspan="4"></td>
                            <td rowspan="4"></td>
                            <td align="right">Diskon (' . $diskon . '%)</td>
                            <td align="center">:</td>
                            <td align="right">' . number_format(($nilai_diskon), "0", ",", ".") . '</td>
                        </tr>
                        <tr>
                            <td align="right">PPN (' . $ppn . '%)</td>
                            <td align="center">:</td>
                            <td align="right">' . number_format(($nilai_ppn), "0", ",", ".") . '</td>
                        </tr>
                        <tr>
                            <td align="right">Total Order</td>
                            <td align="center">:</td>
                            <td align="right">' . number_format(($total), "0", ",", ".") . '</td>
                        </tr>
                        <tr>
                            <td align="right">Uang Muka</td>
                            <td align="center">:</td>
                            <td align="right">' . number_format(($nominal_dp), "0", ",", ".") . '</td>
                        </tr>
                        <tr>
                            <td align="center" style="padding-left:150px;">(____________________)</td>
                            <td align="center">(____________________)</td>
                            <td align="right">Sisa</td>
                            <td align="center">:</td>
                            <td align="right">' . number_format(($total_sisa), "0", ",", ".") . '</td>
                        </tr>
                    </table>';

        /* $html .= '<br><table width="100%" border="0" cellspacing="0" style="font-family:arial;font-size:12px;">
                        <tr>
                            <td align ="left" colspan="2" width="150px">Keterangan : </td>
                        </tr>
                        <tr>
                            <td align ="left" colspan="2" width="150px" style="padding-left:10px;">'.ucwords(strtolower($keterangan_po)).'</td>
                        </tr>
                    </table>'; */

        $html .= '<br><br><br><table width="100%" border="0" cellspacing="0" style="font-family:arial;font-size:12px;">
                        <tr>
                            <td align ="left" colspan="2" width="150px" style="padding-left:0px;"><i>PERHATIAN : Barang selesai yang tidak diambil
                            dalam jangka waktu 3 bulan bukan menjadi tanggung jawab bengkel</i></td>
                        </tr>
                    </table>';

        $document->WriteHTML($html);

        // Save PDF on your public storage 
        Storage::disk('public')->put($documentFileName, $document->Output($documentFileName, "S"));

        // Get file back from storage with the give header informations
        return Storage::disk('public')->download($documentFileName, 'Request', $header);
    }

    public function cetak_invoice()
    {
        $users = DB::table('users')->select('name')->where('id', Auth::user()->id)->get();

        function tgl_indo($tanggal)
        {
            $bulan = array(
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

            return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
        }

        $html = '';
        $params = base64_decode($_GET['params']); // hasil base64 dari JavaScript]
        $params2 = base64_decode($_GET['params2']); // hasil base64 dari JavaScript]

        // Setup a filename  
        $documentFileName = "cetakinvoice.pdf";

        // Create the mPDF document
        $document = new PDF([
            'mode' => 'utf-8',
            'format' => 'A4-P',
            // 'format' => [240, 160,'L'],
            // 'format' => [60, 80],
            'margin_top' => '20',
            'margin_bottom' => '20',
            // 'margin_left' => '1',
            // 'margin_right' => '1',
        ]);

        // Set some header informations for output
        $header = [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . $documentFileName . '"'
        ];


        /* $nextNumber = DB::table('t_sales_order')
            ->selectRaw("LPAD(IFNULL(MAX(RIGHT(no_invoice, 3)), 0) + 1, 3, '0') as next_number")
            ->whereRaw("LEFT(no_invoice, 9) = CONCAT('INV', DATE_FORMAT(NOW(), '%y%d%m'))")
            ->value('next_number');

        $no_invoice = "INV" . date("ydm") . $nextNumber; */

        // cek apakah data sudah ada dan punya no_invoice
        /* $existing = DB::table('t_sales_order')
            ->where('id', $params)
            ->value('no_invoice');

        if (empty($existing)) {
            // kalau kosong -> generate baru
            $no_invoice = "INV" . date("ymdiHs");

            DB::table('t_sales_order')
                ->where('id', $params)
                ->update([
                    'no_invoice' => $no_invoice,
                ]);
        } else {
            // kalau sudah ada, pakai yang lama
            $no_invoice = $existing;
        } */

        // cek apakah data sudah ada dan punya no_invoice
        $existing = DB::table('t_sales_order')
            ->where('id', $params)
            ->value('no_invoice');

        if (empty($existing)) {
            // ambil bulan dan tahun sekarang
            $bulanTahun = date("m/y");

            // cari nomor urut terakhir di bulan ini
            $lastNumber = DB::table('t_sales_order')
                ->where('no_invoice', 'like', "INV/ACE-%/$bulanTahun")
                ->orderBy('no_invoice', 'desc')
                ->value('no_invoice');

            if ($lastNumber) {
                // extract nomor (0004 → 4)
                preg_match('/INV\/ACE-(\d+)\/' . str_replace('/', '\/', $bulanTahun) . '/', $lastNumber, $matches);
                $counter = isset($matches[1]) ? intval($matches[1]) + 1 : 1;
            } else {
                $counter = 1;
            }

            // format jadi 4 digit
            $nomorUrut = str_pad($counter, 4, '0', STR_PAD_LEFT);

            // bentuk nomor invoice
            $no_invoice = "INV/ACE-" . $nomorUrut . "/" . $bulanTahun;

            // update ke tabel
            DB::table('t_sales_order')
                ->where('id', $params)
                ->update([
                    'no_invoice' => $no_invoice,
                ]);
        } else {
            // kalau sudah ada, pakai yang lama
            $no_invoice = $existing;
        }

        // update ke tabel
        DB::table('t_sales_order')
            ->where('id', $params)
            ->update([
                'tanggal_invoice' => $params2,
            ]);

        $resultHeader = DB::select("SELECT
                                        A.*,
                                        B.no_transaksi as no_so,
                                        B.created_date as tgl_po,
                                        B.total_pembayaran,
                                        B.nominal_dp,
                                        B.sisa_pembayaran,
                                        B.keterangan as keterangan_po,
                                        B.no_invoice,
                                        B.no_po_customer,
                                        B.tanggal_invoice
                                    FROM
                                        t_penawaran A
                                        INNER JOIN t_sales_order B ON B.id_penawaran = A.id 
                                    WHERE
                                        A.id = '" . $params . "'");
        $no = 1;
        $sub_total = 0;
        $total = 0;
        $ppn = 0;
        $diskon = 0;
        $no_penawaran = "";
        $nama_customer = "";
        $alamat_customer = "";
        $keterangan = "";
        $no_so = "";
        $no_po = "";
        $tgl_po = "";
        $nominal_dp = 0;
        $sisa_pembayaran = 0;
        $keterangan_po = "";
        $tmp_no_invoice = "";
        $tgl_invoice = "";
        foreach ($resultHeader as $rec) {
            $no_penawaran = $rec->no_penawaran;
            $nama_customer = $rec->nama_customer;
            $alamat_customer = $rec->alamat_customer;
            $ppn = $rec->ppn;
            $diskon = $rec->diskon;
            $keterangan = $rec->keterangan;
            $no_so = $rec->no_so;
            $no_po = $rec->no_po_customer;
            $tgl_po = $rec->tgl_po;
            $nominal_dp = $rec->nominal_dp;
            $sisa_pembayaran = $rec->sisa_pembayaran;
            $keterangan_po = $rec->keterangan_po;
            $tmp_no_invoice = $rec->no_invoice;
            $tgl_invoice = $rec->tanggal_invoice;
        }

        $document->SetTitle('Cetak Invoice');
        $document->SetHeader('<table width="100%" border="0" cellspacing="0">
                                    <tr>
                                        <td rowspan="6" align="left" width="100px"><img src="' . str_replace("/index.php", "", $this->url->to('/')) . '/public/icon_pt_ace.jpg" height="95px" width="110px"></td>
                                        <td align="left" style="font-family:arial;font-size:16px;"><strong>ARSIVO</strong></td>
                                        <td rowspan="6" align="left" width="200px" valign="bottom" style="font-family:arial;font-size:14px;"><b><u>INVOICE</u></b></td>
                                    </tr>                                    <tr>
                                        <td style="font-family:arial;font-size:10px;"><strong>Perum Graha Asri Sukodono Jl. Manggis AM.08 Pekarungan Sukodono</strong></td>
                                    </tr>
                                    <tr>
                                        <td style="font-family:arial;font-size:10px;"><strong>Sidoarjo 61258 (Head Office)</strong></td>
                                    </tr>
                                    <tr>
                                        <td style="font-family:arial;font-size:10px;"><strong>Phone : 0817-5076-543 / 0821-3187-6197</strong></td>
                                    </tr>
                                    <tr>
                                        <td style="font-family:arial;font-size:10px;"><strong>E-Mail : ace@anugrah-cipta-engineering.com</strong></td>
                                    </tr>
                                    <tr>
                                        <td style="font-family:arial;font-size:10px;"><strong>Website. www.anugrah-cipta-engineering.com</strong></td>
                                    </tr>
                                </table><br>');
        $document->SetHTMLFooter('<table border="0" width="100%" style="font-family:arial; font-size:9px; border-top:1px solid #000; padding-top:3px;">
                                    <tr>
                                        <td width="70%" style="vertical-align:top; text-align:left;">
                                            <b>Machining WorkShop</b><br>
                                            Jl. Merapi No. 11, Kel. Bambe, <br>
                                            Kec. Driyorejo, Gresik, <br>
                                            Jawa Timur 61177
                                        </td>
                                        <td width="30%" style="vertical-align:top; text-align:left;">
                                            <b>Fabrication WorkShop</b><br>
                                            Jl. Sawunggaling 3, No. 74 <br>
                                            Kel. Jemundo, Kec. Taman <br>
                                            Sidoarjo, Jawa Timur 61257
                                        </td>
                                    </tr>
                                </table>
                            ');

        $html .= '<br><br><br><br><table width="100%" border="0" cellspacing="0" style="font-family:arial;font-size:12px;">
                        <tr>
                            <td width="100px">Bill To</td>
                            <td width="2px">:</td>
                            <td><b>' . strtoupper($nama_customer) . '</b></td>
                            <td width="100px">No Invoice</td>
                            <td width="2px">:</td>
                            <td width="150px"><b>' . $tmp_no_invoice . '</b></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td rowspan="3" valign="top">' . ucwords(strtolower($alamat_customer)) . '</td>
                            <td>Tgl Invoice</td>
                            <td>:</td>
                            <td>' . tgl_indo(date_format(date_create($tgl_invoice), "Y-m-d")) . '</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td></td>
                            <td>No SO</td>
                            <td>:</td>
                            <td>' . strtoupper($no_so) . '</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td></td>
                            <td>No PO</td>
                            <td>:</td>
                            <td>' . strtoupper($no_po) . '</td>
                        </tr>
                    </table>';
        $html .= '<br><table width="100%" border="1" cellspacing="0" style="font-family:arial;font-size:13px;">
                        <tr>
                            <th width="400px">Pesanan</th>
                            <th width="100px">Kuantum</th>
                            <th width="100px">Satuan</th>
                            <th width="100px">Harga</th>
                            <th width="100px">Jumlah</th>
                        </tr>';

        $resultDetail = DB::select("SELECT
                                    * 
                                FROM
                                    t_penawaran_detail 
                                WHERE
                                    id_header = '" . $params . "'");
        $no = 1;
        $sub_total = 0;
        $total = 0;
        $total_sisa = 0;
        $nilai_ppn    = 0;
        $nilai_diskon = 0;
        foreach ($resultDetail as $rec) {
            $jumlah = 0;
            $jumlah = $rec->qty * $rec->harga;
            $sub_total += $jumlah;

            // hitung PPN (11%) dan Diskon (8%)
            $nilai_ppn    = ($sub_total * $ppn) / 100;
            $nilai_diskon = ($sub_total * $diskon) / 100;

            // total akhir
            $total = $sub_total + $nilai_ppn - $nilai_diskon;

            $html .= '<tr>
                        <td valign="top" style="padding-left:5px;border-top:none;border-bottom:none;">' . ucwords(strtolower($rec->nama_item)) . '</td>
                        <td valign="top" align="center" style="border-top:none;border-bottom:none;">' . number_format($rec->qty, "0", ",", ".") . '</td>
                        <td valign="top" align="center" style="border-top:none;border-bottom:none;">' . ucwords(strtolower($rec->satuan)) . '</td>
                        <td valign="top" align="right" style="padding-right:5px;border-top:none;border-bottom:none;">' . number_format($rec->harga, "0", ",", ".") . '</td>
                        <td valign="top" align="right" style="padding-right:5px;border-top:none;border-bottom:none;">' . number_format(($jumlah), "0", ",", ".") . '</td>
                    </tr>';
            $no++;
        }

        $total_sisa = $total - $nominal_dp;

        $tinggi = 150;
        for ($i = 0; $i < $no; $i++) {
            if ($i < 6) {
                $tinggi = $tinggi - 15;
            } else {
                $tinggi = 0;
            }
        }
        $html .= '<tr>
                    <td height="' . $tinggi . 'px" valign="top" align="center" style="border-top:none;"></td>
                    <td valign="top" align="center" style="border-top:none;"></td>
                    <td valign="top" align="right" style="border-top:none;"></td>
                    <td valign="top" align="right" style="padding-right:5px;border-top:none;"></td>
                    <td valign="top" align="right" style="padding-right:5px;border-top:none;"></td>
                </tr>';

        $html .= '</table>';
        $html .= '<br><table width="100%" border="0" cellspacing="0" style="font-family:arial;font-size:12px;">
                        <tr>
                            <td align ="center" width="150px">Keterangan : </td>
                            <td width="130px" align="center">Pemesan,</td>
                            <td width="130px" align="center">Pembuat,</td>
                            <td width="85px" align="right">Sub Total</td>
                            <td width="2px" align="center">:</td>
                            <td width="50px" align="right">' . number_format(($sub_total), "0", ",", ".") . '</td>
                        </tr>
                        <tr>
                            <td rowspan="5" valign="top">' . ucwords(strtolower($keterangan_po)) . '</td>
                            <td rowspan="4"></td>
                            <td rowspan="4"></td>
                            <td align="right">Diskon (' . $diskon . '%)</td>
                            <td align="center">:</td>
                            <td align="right">' . number_format(($nilai_diskon), "0", ",", ".") . '</td>
                        </tr>
                        <tr>
                            <td align="right">PPN (' . $ppn . '%)</td>
                            <td align="center">:</td>
                            <td align="right">' . number_format(($nilai_ppn), "0", ",", ".") . '</td>
                        </tr>
                        <tr>
                            <td align="right">Total Order</td>
                            <td align="center">:</td>
                            <td align="right">' . number_format(($total), "0", ",", ".") . '</td>
                        </tr>
                        <tr>
                            <td align="right">Uang Muka</td>
                            <td align="center">:</td>
                            <td align="right">' . number_format(($nominal_dp), "0", ",", ".") . '</td>
                        </tr>
                        <tr>
                            <td align="center">(____________________)</td>
                            <td align="center">(____________________)</td>
                            <td align="right">Sisa</td>
                            <td align="center">:</td>
                            <td align="right">' . number_format(($total_sisa), "0", ",", ".") . '</td>
                        </tr>
                    </table>';

        $html .= '<br><br><table width="100%" border="0" cellspacing="0" style="font-family:arial;font-size:12px;">
                        <tr>
                            <td align ="left">Transfer : </td>
                        </tr>
                        <tr>
                            <td align ="left">Bank  Rakyat Indonesia  (BRI) KCU KRIAN</td>
                        </tr>
                        <tr>
                            <td align ="left">A/C	: 3168-01-000009-56-2</td>
                        </tr>
                        <tr>
                            <td align ="left">A/N	: Anugrah Cipta Engineering</td>
                        </tr>
                    </table>';

        $document->WriteHTML($html);

        // Save PDF on your public storage 
        Storage::disk('public')->put($documentFileName, $document->Output($documentFileName, "S"));

        // Get file back from storage with the give header informations
        return Storage::disk('public')->download($documentFileName, 'Request', $header);
    }

    public function cetak_kartu_order()
    {
        $users = DB::table('users')->select('name')->where('id', Auth::user()->id)->get();

        function tgl_indo($tanggal)
        {
            $bulan = array(
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

            return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
        }

        $html = '';
        $params = base64_decode($_GET['params']); // $decoded = base64_decode($params);


        $resultHeader = DB::select("SELECT
                                        A.*,
                                        B.no_transaksi as no_po,
                                        B.created_date as tgl_po,
                                        B.total_pembayaran,
                                        B.nominal_dp,
                                        B.sisa_pembayaran,
                                        B.keterangan as keterangan_po
                                    FROM
                                        t_penawaran A
                                        INNER JOIN t_sales_order B ON B.id_penawaran = A.id 
                                    WHERE
                                        B.id = '" . $params . "'");
        $no = 1;
        $sub_total = 0;
        $total = 0;
        $ppn = 0;
        $diskon = 0;
        $no_penawaran = "";
        $nama_customer = "";
        $alamat_customer = "";
        $keterangan = "";
        $no_po = "";
        $tgl_po = "";
        $nominal_dp = 0;
        $nama_sales = 0;
        $tgl_penawaran = "";
        foreach ($resultHeader as $rec) {
            $no_penawaran = $rec->no_penawaran;
            $nama_customer = $rec->nama_customer;
            $alamat_customer = $rec->alamat_customer;
            $ppn = $rec->ppn;
            $diskon = $rec->diskon;
            $keterangan = $rec->keterangan;
            $no_po = $rec->no_po;
            $tgl_po = $rec->tgl_po;
            $nominal_dp = $rec->nominal_dp;
            $nama_sales = $rec->nama_sales;
            $tgl_penawaran = $rec->tanggal_penawaran;
        }

        $resultDetail = DB::select("SELECT
                                            C.* 
                                        FROM
                                            t_penawaran A
                                            INNER JOIN t_sales_order B ON B.id_penawaran = A.id
                                            INNER JOIN t_penawaran_detail C ON C.id_header = A.id 
                                        WHERE
                                            B.id = '" . $params . "' ORDER BY C.ID ASC");
        $arrMaterial = array();
        foreach ($resultDetail as $rec) {
            array_push($arrMaterial, $rec->nama_item);
        }
        // Ubah array jadi string dipisahkan koma
        $listMaterial = implode(", ", $arrMaterial);

        // echo $listMaterial;

        // Setup a filename  
        $documentFileName = "cetakkartuorder.pdf";

        // Create the mPDF document
        $document = new PDF([
            'mode' => 'utf-8',
            // 'format' => 'A5-L',
            'format' => [240, 160, 'L'],
            // 'format' => [60, 80],
            'margin_top' => '20',
            'margin_bottom' => '20',
            // 'margin_left' => '1',
            // 'margin_right' => '1',
        ]);

        // Set some header informations for output
        $header = [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . $documentFileName . '"'
        ];

        $document->SetTitle('Cetak Kartu Order');
        $document->SetHeader('<table width="100%" border="0" style="font-family:arial;font-size:20px;">
                                    <tr>
                                        <th colspan="4" align="left">Kartu Order</th>
                                    </tr>
                                </table>');

        $html .= '<table width="40%" border="1" cellspacing="0" style="font-family:arial;font-size:12px;">
                        <tr>
                            <td width="35%">ARSIVO</td>
                        </tr>
                        <tr>
                            <td height="45px" valign="top">Jl. Merapi No.11, Kel. Bambe Driyorejo Kab. Gresik</td>
                        </tr>
                    </table>';

        $html .= '<br><table width="40%" border="1" cellspacing="0" style="font-family:arial;font-size:12px;">
                        <tr>
                            <td colspan="2" style="border-bottom:none;">' . strtoupper($no_po) . '</td>
                        </tr>
                        <tr>
                            <td width="50%" align="left" style="border-bottom:none;border-top:none;border-right:none;">' . tgl_indo(date_format(date_create($tgl_penawaran), "Y-m-d")) . '</td>
                            <td align="left" style="border-bottom:none;border-top:none;border-left:none;">Nama Sales</td>
                        </tr>
                        <tr>
                            <td width="50%" align="left" style="border-top:none;border-right:none;">' . tgl_indo(date_format(date_create($tgl_po), "Y-m-d")) . '</td>
                            <td align="left" style="border-top:none;border-left:none;">' . ucwords(strtolower($nama_sales)) . '</td>
                        </tr>
                    </table>';

        $html .= '<br><table width="100%" border="0" cellspacing="0" style="font-family:arial;font-size:13px;">
                        <tr>
                            <th colspan="4" valign="top" align="left" style="padding-left: 10px;">Pekerjaan ' . $listMaterial . '</th>
                        </tr>
                    </table>';

        $html .= '<table width="100%" border="1" cellspacing="0" style="font-family:arial;font-size:13px;">
                        <tr>
                            <th width="30px">No</th>
                            <th width="400px">Deskripsi</th>
                            <th width="100px">Qty</th>
                            <th width="300px">Keterangan</th>
                        </tr>';
        $no = 1;
        for ($i = 0; $i < 6; $i++) {
            $html .= '<tr>
                            <td align="center" style="border-top:1px solid;border-bottom:1px solid;">' . $no . '</td>
                            <td style="border-top:1px solid;border-bottom:1px solid;"></td>
                            <td style="border-top:1px solid;border-bottom:1px solid;"></td>
                            <td style="border-top:1px solid;border-bottom:1px solid;"></td>    
                        </tr>';
            $no++;
        }

        $html .= '<tr>
                            <td align="center" valign="top" style="border-top:1px solid;border-bottom:1px solid;">' . $no . '</td>
                            <td style="border-top:1px solid;border-bottom:1px solid;"></td>
                            <td style="border-top:1px solid;border-bottom:1px solid;"></td>
                            <td style="border-top:1px solid;border-bottom:1px solid;"></td>    
                        </tr>';
        $html .= '<tr>
                            <td align="center" valign="top" style="border-top:1px solid;border-bottom:1px solid;">&nbsp;</td>
                            <td style="border-top:1px solid;border-bottom:1px solid;"></td>
                            <td style="border-top:1px solid;border-bottom:1px solid;"></td>
                            <td style="border-top:1px solid;border-bottom:1px solid;"></td>    
                        </tr>';
        $html .= '<tr>
                            <td align="center" valign="top" style="border-top:1px solid;border-bottom:1px solid;">&nbsp;</td>
                            <td style="border-top:1px solid;border-bottom:1px solid;"></td>
                            <td style="border-top:1px solid;border-bottom:1px solid;"></td>
                            <td style="border-top:1px solid;border-bottom:1px solid;"></td>    
                        </tr>';
        $html .= '<tr>
                            <td align="center" valign="top" style="border-top:1px solid;border-bottom:1px solid;">&nbsp;</td>
                            <td style="border-top:1px solid;border-bottom:1px solid;"></td>
                            <td style="border-top:1px solid;border-bottom:1px solid;"></td>
                            <td style="border-top:1px solid;border-bottom:1px solid;"></td>    
                        </tr>';
        $html .= '</table>';

        $document->WriteHTML($html);

        // Save PDF on your public storage 
        Storage::disk('public')->put($documentFileName, $document->Output($documentFileName, "S"));

        // Get file back from storage with the give header informations
        return Storage::disk('public')->download($documentFileName, 'Request', $header);
    }

    public function cetak_surat_jalan()
    {
        $users = DB::table('users')->select('name')->where('id', Auth::user()->id)->get();

        function tgl_indo($tanggal)
        {
            $bulan = array(
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

            return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
        }

        $html = '';
        // $params = $_GET['params'];
        // $paramsbon = $_GET['paramsbon'];

        $params = base64_decode($_GET['params']);
        $paramsbon = base64_decode($_GET['paramsbon']);

        // ambil data sales order
        $salesOrder = DB::table('t_sales_order')->where('id', $params)->first();

        // cek kalau sudah ada nomor surat jalan dan bon, jangan update
        if (!empty($salesOrder->no_surat_jalan) && !empty($salesOrder->no_bon_surat_jalan)) {
            // sudah ada, tidak perlu update
            $no_surat_jalan = $salesOrder->no_surat_jalan;
        } else {
            // generate nomor baru
            $nextNumber = DB::table('t_sales_order')
                ->selectRaw("LPAD(IFNULL(MAX(RIGHT(no_surat_jalan, 3)), 0) + 1, 3, '0') as next_number")
                ->whereRaw("LEFT(no_surat_jalan, 9) = CONCAT('SJ', DATE_FORMAT(NOW(), '%y%d%m'))")
                ->value('next_number');

            $no_surat_jalan = "SJ" . date("ydm") . '-' . $nextNumber;

            DB::table('t_sales_order')
                ->where('id', $params)
                ->update([
                    'no_surat_jalan'     => $no_surat_jalan,
                    'no_bon_surat_jalan' => $paramsbon
                ]);
        }

        // Setup a filename  
        $documentFileName = "cetaksuratjalan.pdf";

        // Create the mPDF document
        $document = new PDF([
            'mode' => 'utf-8',
            // 'format' => 'A5-L',
            'format' => [240, 160, 'L'],
            // 'format' => [60, 80],
            'margin_top' => '20',
            'margin_bottom' => '20',
            // 'margin_left' => '1',
            // 'margin_right' => '1',
        ]);

        // Set some header informations for output
        $header = [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . $documentFileName . '"'
        ];


        $resultHeader = DB::select("SELECT
                                        A.*,
                                        B.no_transaksi as no_po,
                                        B.created_date as tgl_po,
                                        B.total_pembayaran,
                                        B.nominal_dp,
                                        B.sisa_pembayaran,
                                        B.keterangan as keterangan_sj,
                                        B.no_surat_jalan,
                                        B.no_bon_surat_jalan,
	                                    B.no_po_customer
                                    FROM
                                        t_penawaran A
                                        INNER JOIN t_sales_order B ON B.id_penawaran = A.id 
                                    WHERE
                                        B.id = '" . $params . "'");
        $no = 1;
        $sub_total = 0;
        $total = 0;
        $ppn = 0;
        $diskon = 0;
        $no_penawaran = "";
        $nama_customer = "";
        $alamat_customer = "";
        $keterangan = "";
        $no_po = "";
        $tgl_po = "";
        $nominal_dp = 0;
        $sisa_pembayaran = 0;
        $keterangan_sj = "";
        $no_sj = "";
        $no_bon_sj = "";
        foreach ($resultHeader as $rec) {
            $no_penawaran = $rec->no_penawaran;
            $nama_customer = $rec->nama_customer;
            $alamat_customer = $rec->alamat_customer;
            $ppn = $rec->ppn;
            $diskon = $rec->diskon;
            $keterangan = $rec->keterangan;
            $no_po = $rec->no_po_customer;
            $tgl_po = $rec->tgl_po;
            $nominal_dp = $rec->nominal_dp;
            $sisa_pembayaran = $rec->sisa_pembayaran;
            $keterangan_sj = $rec->keterangan_sj;
            $no_sj = $rec->no_surat_jalan;
            $no_bon_sj = $rec->no_bon_surat_jalan;
        }

        $document->SetTitle('Cetak Surat Jalan');
        $document->SetHeader('<table width="100%" border="0" cellspacing="0">
                                    <tr>
                                        <td rowspan="6" align="left" width="100px"><img src="' . str_replace("/index.php", "", $this->url->to('/')) . '/public/icon_pt_ace.jpg" height="95px" width="110px"></td>
                                        <td align="left" style="font-family:arial;font-size:16px;"><strong>ARSIVO</strong></td>
                                        <td rowspan="6" align="left" width="200px" valign="bottom" style="font-family:arial;font-size:14px;"><b><u>SURAT JALAN</u></b></td>
                                    </tr>
                                    <tr>
                                        <td style="font-family:arial;font-size:10px;"><strong>Perum Graha Asri Sukodono Jl. Manggis AM.08 Pekarungan Sukodono</strong></td>
                                    </tr>
                                    <tr>
                                        <td style="font-family:arial;font-size:10px;"><strong>Sidoarjo 61258 (Head Office)</strong></td>
                                    </tr>
                                    <tr>
                                        <td style="font-family:arial;font-size:10px;"><strong>Phone : 0817-5076-543 / 0821-3187-6197</strong></td>
                                    </tr>
                                    <tr>
                                        <td style="font-family:arial;font-size:10px;"><strong>E-Mail : ace@anugrah-cipta-engineering.com</strong></td>
                                    </tr>
                                    <tr>
                                        <td style="font-family:arial;font-size:10px;"><strong>Website. www.anugrah-cipta-engineering.com</strong></td>
                                    </tr>
                                </table><br>');
        $document->SetHTMLFooter('<table border="0" width="100%" style="font-family:arial; font-size:9px; border-top:1px solid #000; padding-top:3px;">
                                    <tr>
                                        <td width="70%" style="vertical-align:top; text-align:left;">
                                            <b>Machining WorkShop</b><br>
                                            Jl. Merapi No. 11, Kel. Bambe, <br>
                                            Kec. Driyorejo, Gresik, <br>
                                            Jawa Timur 61177
                                        </td>
                                        <td width="30%" style="vertical-align:top; text-align:left;">
                                            <b>Fabrication WorkShop</b><br>
                                            Jl. Sawunggaling 3, No. 74 <br>
                                            Kel. Jemundo, Kec. Taman <br>
                                            Sidoarjo, Jawa Timur 61257
                                        </td>
                                    </tr>
                                </table>
                            ');

        $html .= '<br><br><br><br><table width="100%" border="0" cellspacing="0" style="font-family:arial;font-size:12px;">
                        <tr>
                            <td width="100px">Bill To</td>
                            <td width="2px">:</td>
                            <td><b>' . strtoupper($nama_customer) . '</b></td>
                            <td width="100px">No SJ</td>
                            <td width="2px">:</td>
                            <td width="150px">' . $no_sj . '</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td rowspan="3" valign="top">' . ucwords(strtolower($alamat_customer)) . '</td>
                            <td>No Bon</td>
                            <td>:</td>
                            <td>' . $no_bon_sj . '</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>Tanggal</td>
                            <td>:</td>
                            <td>' . tgl_indo(date_format(date_create(now()), "Y-m-d")) . '</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td></td>
                            <td>No PO</td>
                            <td>:</td>
                            <td>' . strtoupper($no_po) . '</td>
                        </tr>
                    </table>';
        $html .= '<br><table width="100%" border="1" cellspacing="0" style="font-family:arial;font-size:13px;">
                        <tr>
                            <th width="50px">Kuantum</th>
                            <th width="250px">Pesanan</th>
                            <th width="250px">Keterangan</th>
                        </tr>';

        $resultDetail = DB::select("SELECT
                                            C.* 
                                        FROM
                                            t_penawaran A
                                            INNER JOIN t_sales_order B ON B.id_penawaran = A.id
                                            INNER JOIN t_penawaran_detail C ON C.id_header = A.id 
                                        WHERE
                                            B.id = '" . $params . "'");
        $no = 1;
        $sub_total = 0;
        $total = 0;
        $total_sisa = 0;
        $keterangan_detail = "";
        foreach ($resultDetail as $rec) {
            $jumlah = 0;
            $jumlah = $rec->qty * $rec->harga;
            $sub_total += $jumlah;

            // hitung PPN (11%) dan Diskon (8%)
            $nilai_ppn    = ($sub_total * $ppn) / 100;
            $nilai_diskon = ($sub_total * $diskon) / 100;

            // total akhir
            $total = $sub_total + $nilai_ppn - $nilai_diskon;

            $html .= '<tr>
                        <td valign="top" align="center" style="border-top:none;border-bottom:none;">' . number_format($rec->qty, "0", ",", ".") . '</td>
                        <td valign="top" style="padding-left:5px;border-top:none;border-bottom:none;">' . ucwords(strtolower($rec->nama_item)) . '</td>
                        <td valign="top" align="left" style="padding-left:5px;border-top:none;border-bottom:none;">' . ucfirst($rec->keterangan_detail) . '</td>
                    </tr>';
            $no++;
        }

        $total_sisa = $total - $nominal_dp;

        $tinggi = 100;
        for ($i = 0; $i < $no; $i++) {
            if ($i < 6) {
                $tinggi = $tinggi - 10;
            } else {
                $tinggi = 0;
            }
        }
        $html .= '<tr>
                    <td height="' . $tinggi . 'px" valign="top" align="center" style="border-top:none;"></td>
                    <td valign="top" align="center" style="border-top:none;"></td>
                    <td valign="top" align="right" style="border-top:none;"></td>
                </tr>';
        $html .= '</table>';
        $html .= '<br><table width="100%" border="0" cellspacing="0" style="font-family:arial;font-size:12px;">
                        <tr>
                            <td align ="center" width="150px" align="left">Keterangan : </td>
                            <td width="130px" align="center">Pemesan,</td>
                            <td width="130px" align="center">Gudang,</td>
                        </tr>
                        <tr>
                            <td height="60px" valign="top">' . $keterangan_sj . '</td>
                            <td ></td>
                            <td ></td>
                        </tr>
                        <tr>
                            <td ></td>
                            <td align="center">(____________________)</td>
                            <td align="center">(____________________)</td>
                        </tr>
                    </table>';

        $document->WriteHTML($html);

        // Save PDF on your public storage 
        Storage::disk('public')->put($documentFileName, $document->Output($documentFileName, "S"));

        // Get file back from storage with the give header informations
        return Storage::disk('public')->download($documentFileName, 'Request', $header);
    }

    public function cetak_pembelian_pdf()
    {
        $users = DB::table('users')->select('name')->where('id', Auth::user()->id)->get();

        function tgl_indo($tanggal)
        {
            $bulan = array(
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

            return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
        }

        $html = '';
        // $params = $_GET['params'];
        $params = base64_decode($_GET['params']);
        $paramsJenisPembelian = base64_decode($_GET['paramsJenisPembelian']);

        // Setup a filename  
        $documentFileName = "cetakpembelian.pdf";

        // Create the mPDF document
        $document = new PDF([
            'mode' => 'utf-8',
            // 'format' => 'A5-L',
            'format' => [240, 160, 'L'],
            // 'format' => [60, 80],
            'margin_top' => '20',
            'margin_bottom' => '20',
            // 'margin_left' => '1',
            // 'margin_right' => '1',
        ]);

        // Set some header informations for output
        $header = [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . $documentFileName . '"'
        ];

        $resultHeader = DB::select("SELECT
                                            *
                                        FROM
                                            t_pembelian
                                        WHERE
                                            id = '" . $params . "'");
        $no = 1;
        $nama_customer = "";
        $alamat_customer = "";
        $no_po = "";
        $tgl_po = "";
        $nominal_dp = 0;
        $keterangan_po = "";
        $flag_ppn = 0;
        $ppn = 0;
        $diskon = 0;
        $tgl_kirim = "";
        $no_po_customer = "";
        foreach ($resultHeader as $rec) {
            $nama_customer = $rec->nama_customer;
            $alamat_customer = $rec->alamat;
            $tgl_po = $rec->tanggal_pembelian;
            $ppn = $rec->ppn;
            $diskon = $rec->diskon;
            $tgl_kirim = $rec->tanggal_kirim;
            $no_po_customer = $rec->no_po_customer;
        }

        $document->SetTitle('Cetak Pembelian');
        $document->SetHeader('<table width="100%" border="0" cellspacing="0">
                                    <tr>
                                        <td rowspan="6" align="left" width="100px"><img src="' . str_replace("/index.php", "", $this->url->to('/')) . '/public/icon_pt_ace.jpg" height="95px" width="110px"></td>
                                        <td align="left" style="font-family:arial;font-size:16px;"><strong>ARSIVO</strong></td>
                                        <td rowspan="6" align="left" width="200px" valign="bottom" style="font-family:arial;font-size:14px;"><b><u>' . $paramsJenisPembelian . '</u></b></td>
                                    </tr>
                                    <tr>
                                        <td style="font-family:arial;font-size:10px;"><strong>Perum Graha Asri Sukodono Jl. Manggis AM.08 Pekarungan Sukodono</strong></td>
                                    </tr>
                                    <tr>
                                        <td style="font-family:arial;font-size:10px;"><strong>Sidoarjo 61258 (Head Office)</strong></td>
                                    </tr>
                                    <tr>
                                        <td style="font-family:arial;font-size:10px;"><strong>Phone : 0817-5076-543 / 0821-3187-6197</strong></td>
                                    </tr>
                                    <tr>
                                        <td style="font-family:arial;font-size:10px;"><strong>E-Mail : ace@anugrah-cipta-engineering.com</strong></td>
                                    </tr>
                                    <tr>
                                        <td style="font-family:arial;font-size:10px;"><strong>Website. www.anugrah-cipta-engineering.com</strong></td>
                                    </tr>
                                </table><br>');
        $document->SetHTMLFooter('<table border="0" width="100%" style="font-family:arial; font-size:9px; border-top:1px solid #000; padding-top:3px;">
                                    <tr>
                                        <td width="70%" style="vertical-align:top; text-align:left;">
                                            <b>Machining WorkShop</b><br>
                                            Jl. Merapi No. 11, Kel. Bambe, <br>
                                            Kec. Driyorejo, Gresik, <br>
                                            Jawa Timur 61177
                                        </td>
                                        <td width="30%" style="vertical-align:top; text-align:left;">
                                            <b>Fabrication WorkShop</b><br>
                                            Jl. Sawunggaling 3, No. 74 <br>
                                            Kel. Jemundo, Kec. Taman <br>
                                            Sidoarjo, Jawa Timur 61257
                                        </td>
                                    </tr>
                                </table>
                            ');

        $html .= '<br><br><br><br><table width="100%" border="0" cellspacing="0" style="font-family:arial;font-size:12px;">
                        <tr>
                            <td width="100px">Vendor</td>
                            <td width="2px">:</td>
                            <td><b>' . strtoupper($nama_customer) . '</b></td>
                            <td width="100px">Tgl Kirim</td>
                            <td width="2px">:</td>
                            <td width="120px">' . tgl_indo(date_format(date_create($tgl_kirim), "Y-m-d")) . '</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td rowspan="3" valign="top">' . ucwords(strtolower($alamat_customer)) . '</td>
                            <td>No PO</td>
                            <td>:</td>
                            <td>' . $no_po_customer . '</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td></td>
                        </tr>
                    </table>';
        $html .= '<br><table width="100%" border="1" cellspacing="0" style="font-family:arial;font-size:13px;">
                        <tr>
                            <th width="400px">Pesanan</th>
                            <th width="100px">Qty</th>
                            <th width="100px">Satuan</th>
                            <th width="100px">Harga</th>
                            <th width="100px">Jumlah</th>
                        </tr>';

        $resultDetail = DB::select("SELECT
                                            A.*,
                                            B.*
                                        FROM
                                            t_pembelian A
                                            INNER JOIN t_pembelian_detail B ON B.id_header = A.id 
                                        WHERE
                                            A.id = '" . $params . "'");
        $no = 1;
        $sub_total = 0;
        $total = 0;
        $total_sisa = 0;
        $nilai_ppn    = 0;
        $nilai_diskon = 0;
        foreach ($resultDetail as $rec) {
            $jumlah = 0;
            $jumlah = $rec->qty * $rec->harga;
            $sub_total += $jumlah;

            // hitung PPN (11%) dan Diskon (8%)
            $nilai_ppn    = ($sub_total * $ppn) / 100;
            $nilai_diskon = ($sub_total * $diskon) / 100;

            // total akhir
            $total = $sub_total + $nilai_ppn - $nilai_diskon;

            $html .= '<tr>
                        <td valign="top" style="padding-left:5px;border-top:none;border-bottom:none;">' . ucwords(strtolower($rec->nama_item)) . '</td>
                        <td valign="top" align="center" style="border-top:none;border-bottom:none;">' . number_format($rec->qty, "0", ",", ".") . '</td>
                        <td valign="top" align="center" style="border-top:none;border-bottom:none;">' . strtoupper($rec->satuan) . '</td>
                        <td valign="top" align="right" style="padding-right:5px;border-top:none;border-bottom:none;">' . number_format($rec->harga, "0", ",", ".") . '</td>
                        <td valign="top" align="right" style="padding-right:5px;border-top:none;border-bottom:none;">' . number_format(($jumlah), "0", ",", ".") . '</td>
                    </tr>';
            $no++;
        }

        $total_sisa = $total - $nominal_dp;

        $tinggi = 150;
        for ($i = 0; $i < $no; $i++) {
            if ($i < 6) {
                $tinggi = $tinggi - 15;
            } else {
                $tinggi = 0;
            }
        }
        $html .= '<tr>
                    <td height="' . $tinggi . 'px" valign="top" align="center" style="border-top:none;"></td>
                    <td valign="top" align="center" style="border-top:none;"></td>
                    <td valign="top" align="right" style="border-top:none;"></td>
                    <td valign="top" align="right" style="padding-right:5px;border-top:none;"></td>
                    <td valign="top" align="right" style="padding-right:5px;border-top:none;"></td>
                </tr>';

        $html .= '</table>';
        $html .= '<br><table width="100%" border="0" cellspacing="0" style="font-family:arial;font-size:12px;">
                        <tr>
                            <td align ="center" width="150px">Penerima : </td>
                            <td width="130px" align="center">Menyetujui,</td>
                            <td width="130px" align="center">Pembuat,</td>
                            <td width="85px" align="right">Sub Total</td>
                            <td width="2px" align="center">:</td>
                            <td width="50px" align="right">' . number_format(($sub_total), "0", ",", ".") . '</td>
                        </tr>
                        <tr>
                            <td rowspan="3" valign="top">' . ucwords(strtolower($keterangan_po)) . '</td>
                            <td rowspan="3"></td>
                            <td rowspan="3"></td>
                            <td align="right">Diskon (' . $diskon . '%)</td>
                            <td align="center">:</td>
                            <td align="right">' . number_format(($nilai_diskon), "0", ",", ".") . '</td>
                        </tr>
                        <tr>
                            <td align="right">PPN (' . $ppn . '%)</td>
                            <td align="center">:</td>
                            <td align="right">' . number_format(($nilai_ppn), "0", ",", ".") . '</td>
                        </tr>
                        <tr>
                            <td align="right">Total Order</td>
                            <td align="center">:</td>
                            <td align="right">' . number_format(($total), "0", ",", ".") . '</td>
                        </tr>
                        <tr>
                            <td align="center">(____________________)</td>
                            <td align="center">(____________________)</td>
                            <td align="center">(____________________)</td>
                            <td align="right"></td>
                            <td align="center"></td>
                            <td align="right"></td>
                        </tr>
                    </table>';

        $document->WriteHTML($html);

        // Save PDF on your public storage 
        Storage::disk('public')->put($documentFileName, $document->Output($documentFileName, "S"));

        // Get file back from storage with the give header informations
        return Storage::disk('public')->download($documentFileName, 'Request', $header);
    }


    // ---- ALL BELUM PO ----
    public function lap_penawaran_belum_po()
    {
        return view('view_lap_penawaran_belum_po');
    }

    public function preview_lap_penawaran_belum_po(Request $request)
    {
        $tgl_awal  = $request->input('tgl_awal');
        $tgl_akhir = $request->input('tgl_akhir');

        $data = DB::select("SELECT
                                    * 
                                FROM
                                    (
                                    SELECT
                                        A.*,
                                    CASE
                                            
                                            WHEN B.id IS NULL THEN
                                            'Belum PO' ELSE 'Sudah PO' 
                                    END AS status_po 
                                    FROM
                                        t_penawaran A
                                        LEFT JOIN t_sales_order B ON B.id_penawaran = A.ID 
                                    WHERE
                                        B.id IS NULL 
                                    ) AS C 
                                    WHERE CAST( tanggal_penawaran AS DATE ) BETWEEN ? AND ?
                                ORDER BY
                                    C.tanggal_penawaran ASC", [$tgl_awal, $tgl_akhir]);

        return response()->json($data);
    }

    /* public function export_penawaran_excel(Request $request)
    {
        $tgl_awal  = $request->input('tgl_awal');
        $tgl_akhir = $request->input('tgl_akhir');

        // Ambil data dari DB
        $data = DB::select("SELECT
                                    * 
                                FROM
                                    (
                                    SELECT
                                        A.*,
                                    CASE
                                        WHEN B.id IS NULL THEN
                                            'Belum PO' ELSE 'Sudah PO' 
                                    END AS status 
                                    FROM
                                        t_penawaran A
                                        LEFT JOIN t_sales_order B ON B.id_penawaran = A.ID 
                                    WHERE
                                        B.id IS NULL 
                                    ) AS C 
                                    WHERE CAST( tanggal_penawaran AS DATE ) BETWEEN ? AND ? 
                                ORDER BY
                                    C.tanggal_penawaran ASC", [$tgl_awal, $tgl_akhir]);

        // Inisialisasi Spreadsheet
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Lap Penawaran Belum PO');

        // ============================
        // Judul Laporan
        // ============================
        $sheet->mergeCells('A1:F1');
        $sheet->setCellValue('A1', 'Laporan Penawaran Belum PO');
        $sheet->getStyle('A1')->applyFromArray([
            'font' => [
                'bold' => true,
                'size' => 14,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical'   => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ]
        ]);

        // Periode
        $sheet->mergeCells('A2:F2');
        $sheet->setCellValue('A2', 'Periode: '.date('d-m-Y', strtotime($tgl_awal)).' s/d '.date('d-m-Y', strtotime($tgl_akhir)));
        $sheet->getStyle('A2')->applyFromArray([
            'font' => [
                'italic' => true,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            ]
        ]);

        // ============================
        // Header Tabel
        // ============================
        $sheet->setCellValue('A3', 'No');
        $sheet->setCellValue('B3', 'No Penawaran');
        $sheet->setCellValue('C3', 'Nama Customer');
        $sheet->setCellValue('D3', 'Tanggal Penawaran');
        $sheet->setCellValue('E3', 'Total Penawaran');
        $sheet->setCellValue('F3', 'Status');

        $sheet->getStyle('A3:F3')->applyFromArray([
            'font' => [
                'bold' => true,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical'   => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['rgb' => 'D9D9D9']
            ]
        ]);

        // ============================
        // Isi Data
        // ============================
        $row = 4; // data mulai dari baris 4
        $no = 1;
        foreach ($data as $item) {
            $sheet->setCellValue('A'.$row, $no);
            $sheet->setCellValueExplicit('B'.$row, $item->no_penawaran, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
            $sheet->setCellValue('C'.$row, $item->nama_customer);
            $sheet->setCellValue('D'.$row, date('d-m-Y', strtotime($item->tanggal_penawaran)));
            $sheet->setCellValueExplicit('E'.$row, number_format($item->total_penawaran, 0, ',', '.'), \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
            $sheet->getStyle('E'.$row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
            $sheet->setCellValue('F'.$row, $item->status);
            $row++;
            $no++;
        }

        // Auto width kolom
        foreach (range('A', 'F') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        // ============================
        // Download file Excel
        // ============================
        $filename = "laporan_penawaran_".date('YmdHis').".xlsx";
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment; filename=\"$filename\"");
        header('Cache-Control: max-age=0');

        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    } */

    public function export_penawaran_excel(Request $request)
    {
        $tgl_awal  = $request->input('tgl_awal');
        $tgl_akhir = $request->input('tgl_akhir');

        // Query data
        $data = DB::select("
            SELECT * FROM (
                SELECT
                    A.*,
                    CASE
                        WHEN B.id IS NULL THEN 'Belum PO' 
                        ELSE 'Sudah PO' 
                    END AS status 
                FROM t_penawaran A
                LEFT JOIN t_sales_order B ON B.id_penawaran = A.ID 
                WHERE B.id IS NULL
            ) AS C
            WHERE CAST(tanggal_penawaran AS DATE) BETWEEN ? AND ?
            ORDER BY C.tanggal_penawaran ASC
        ", [$tgl_awal, $tgl_akhir]);

        // Nama file
        $filename = "new_laporan_penawaran_" . date('YmdHis') . ".xls";

        // Header agar dikenali sebagai Excel
        header("Content-Type: application/vnd.ms-excel; charset=utf-8");
        header("Content-Disposition: attachment; filename=\"$filename\"");
        header("Cache-Control: max-age=0");

        echo "
            <table border='1' cellspacing='0' cellpadding='5'>
                <tr>
                    <th colspan='6' style='text-align:center; font-size:14px; font-weight:bold;'>
                        Laporan Penawaran Belum PO
                    </th>
                </tr>
                <tr>
                    <th colspan='6' style='text-align:center; font-style:italic;'>
                        Periode: " . date('d-m-Y', strtotime($tgl_awal)) . " s/d " . date('d-m-Y', strtotime($tgl_akhir)) . "
                    </th>
                </tr>
                <tr>
                    <th>No</th>
                    <th>No Penawaran</th>
                    <th>Nama Customer</th>
                    <th>Tanggal Penawaran</th>
                    <th>Total Penawaran</th>
                    <th>Status</th>
                </tr>
        ";

        $no = 1;
        foreach ($data as $item) {
            echo "
                <tr>
                    <td style='text-align:center;'>" . $no . "</td>
                    <td>" . $item->no_penawaran . "</td>
                    <td>" . $item->nama_customer . "</td>
                    <td>" . date('d-m-Y', strtotime($item->tanggal_penawaran)) . "</td>
                    <td style='text-align:right;'>" . number_format($item->total_penawaran, 0, ',', '.') . "</td>
                    <td>" . $item->status . "</td>
                </tr>
            ";
            $no++;
        }

        echo "</table>";
        exit;
    }

    public function export_penawaran_pdf()
    {
        function tgl_indo($tanggal)
        {
            $bulan = array(
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

            return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
        }

        $html = '';
        $tgl_awal           = $_GET['tgl_awal'];
        $tgl_akhir          = $_GET['tgl_akhir'];

        $documentFileName = "laporan_penawaran_belum_po.pdf";

        // Create the mPDF document
        $document = new PDF([
            'mode' => 'utf-8',
            'format' => 'A4-L',
        ]);

        // Set some header informations for output
        $header = [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . $documentFileName . '"'
        ];
        $document->SetTitle('Laporan Penawaran Belum PO');
        // $document->SetHeader('Laporan Laundry');
        // Write some simple Content

        $html .= "<table width='100%' border='0' style='font-family:arial;'>
                    <tr>
                        <td width='65%'>
                            <b>LAPORAN PENAWARAN BELUM PO</b><br>
                            <p style='font-size:12px;'>PERIODE : " . tgl_indo($tgl_awal) . " s/d " . tgl_indo($tgl_akhir) . "</p>
                        </td>
                        <td width='15%' align='right'>
                            <img src='" . str_replace("/index.php", "", $this->url->to('/')) . "/public/icon_pt_ace_BW.png' height='55px' width='70px'>
                        </td>
                        <td width='20%'>
                            <b><p style='font-size:12px;'>PT Anugrah Cipta Enginering</p></b>
                        </td>
                    </tr>
                  </table>";
        $html .= "<hr>";
        $html .= "<table border='1' width='100%' cellspacing='0' style='font-family:arial;font-size:11px;'>
                        <thead>
                            <tr>
                                <th width='4%'>No</th>
                                <th width='12%'>No Penawaran</th>
                                <th width='20%'>Nama Customer</th>
                                <th width='20%'>Alamat Customer</th>
                                <th width='15%'>Nama Sales</th>
                                <th width='12%'>Tanggal Penawaran</th>
                                <th width='12%'>Total Penawaran</th>
                                <th width='10%'>Status Penawaran</th>
                            </tr>
                        </thead>
                        <tbody>";

        // Query
        $result = DB::select("SELECT
                                    * 
                                FROM
                                    (
                                    SELECT
                                        A.*,
                                    CASE
                                        WHEN B.id IS NULL THEN
                                            'Belum PO' ELSE 'Sudah PO' 
                                    END AS status 
                                    FROM
                                        t_penawaran A
                                        LEFT JOIN t_sales_order B ON B.id_penawaran = A.ID 
                                    WHERE
                                        B.id IS NULL 
                                    ) AS C 
                                    WHERE CAST( tanggal_penawaran AS DATE ) BETWEEN ? AND ? 
                                ORDER BY
                                    C.tanggal_penawaran ASC", [$tgl_awal, $tgl_akhir]);
        $no = 1;
        foreach ($result as $rec) {
            $html .= "<tr>
                        <td align='center'>" . $no . "</td>
                        <td align='center'>" . $rec->no_penawaran . "</td>
                        <td style='padding-left:5px;'>" . ucwords(strtolower($rec->nama_customer)) . "</td>
                        <td style='padding-left:5px;'>" . ucwords(strtolower($rec->alamat_customer)) . "</td>
                        <td style='padding-left:5px;'>" . ucwords(strtolower($rec->nama_sales)) . "</td>
                        <td align='center'>" . date_format(date_create($rec->tanggal_penawaran), "d M Y") . "</td>
                        <td align='right' style='padding-right:5px;'>" . number_format($rec->total_penawaran, 0, ',', '.') . "</td>
                        <td align='center'>" . $rec->status . "</td>
                    </tr>";
            $no++;
        }
        $html .= "</tbody></table>";

        $document->WriteHTML($html);

        // Use Blade if you want
        //$document->WriteHTML(view('fun.testtemplate'));

        // Save PDF on your public storage 
        Storage::disk('public')->put($documentFileName, $document->Output($documentFileName, "S"));

        // Get file back from storage with the give header informations
        return Storage::disk('public')->download($documentFileName, 'Request', $header);
    }
    // ---- END ALL BELUM PO ----

    // ---- ALL SUDAH PO ----
    public function lap_penawaran_sudah_po()
    {
        return view('view_lap_penawaran_sudah_po');
    }

    public function preview_lap_penawaran_sudah_po(Request $request)
    {
        $tgl_awal  = $request->input('tgl_awal');
        $tgl_akhir = $request->input('tgl_akhir');

        $data = DB::select("SELECT
                                    * 
                                FROM
                                    (
                                    SELECT
                                        A.*,
                                    CASE
                                            
                                            WHEN B.id IS NULL THEN
                                            'Belum PO' ELSE 'Sudah PO' 
                                    END AS status_po 
                                    FROM
                                        t_penawaran A
                                        INNER JOIN t_sales_order B ON B.id_penawaran = A.ID 
                                    ) AS C 
                                WHERE
                                    CAST( tanggal_penawaran AS DATE ) BETWEEN ? AND ?
                                ORDER BY
                                    C.tanggal_penawaran ASC", [$tgl_awal, $tgl_akhir]);

        return response()->json($data);
    }

    public function preview_lap_pembelian(Request $request)
    {
        $tgl_awal      = $request->input('tgl_awal');
        $tgl_akhir     = $request->input('tgl_akhir');
        $jenis_order   = $request->input('jenis_order');
        $nama_customer = $request->input('nama_customer');

        /* $query = DB::table('t_pembelian')
            ->whereBetween(DB::raw('CAST(tanggal_pembelian AS DATE)'), [$tgl_awal, $tgl_akhir])
            ->when(!empty($jenis_order), function ($q) use ($jenis_order) {
                $q->where('jenis_order', $jenis_order);
            })
            ->when(!empty($nama_customer), function ($q) use ($nama_customer) {
                $q->where('nama_customer', 'like', "%{$nama_customer}%");
            })
            ->orderBy('tanggal_pembelian', 'asc');

        $data = $query->get(); */

        // Query
        $query = DB::table('t_pembelian')
            ->join('t_pembelian_detail', 't_pembelian_detail.id_header', '=', 't_pembelian.id')
            ->whereBetween(DB::raw('CAST(t_pembelian.tanggal_pembelian AS DATE)'), [$tgl_awal, $tgl_akhir]);

        if (!empty($nama_customer)) {
            $query->where('t_pembelian.nama_customer', 'like', "%$nama_customer%");
        }

        if (!empty($jenis_order)) {
            $query->where('t_pembelian.jenis_order', $jenis_order);
        }

        $data = $query->orderBy('t_pembelian.tanggal_pembelian', 'ASC')->get();

        return response()->json($data);
    }

    public function export_penawaran_sudah_excel(Request $request)
    {
        $tgl_awal  = $request->input('tgl_awal');
        $tgl_akhir = $request->input('tgl_akhir');

        // Ambil data dari DB
        $data = DB::select("SELECT
                                    * 
                                FROM
                                    (
                                    SELECT
                                        A.*,
                                    CASE
                                            
                                            WHEN B.id IS NULL THEN
                                            'Belum PO' ELSE 'Sudah PO' 
                                    END AS status_po 
                                    FROM
                                        t_penawaran A
                                        INNER JOIN t_sales_order B ON B.id_penawaran = A.ID 
                                    ) AS C 
                                WHERE
                                    CAST( tanggal_penawaran AS DATE ) BETWEEN ? AND ? 
                                ORDER BY
                                    C.tanggal_penawaran ASC", [$tgl_awal, $tgl_akhir]);

        // Inisialisasi Spreadsheet
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Lap Penawaran Sudah PO');

        // ============================
        // Judul Laporan
        // ============================
        $sheet->mergeCells('A1:F1');
        $sheet->setCellValue('A1', 'Laporan Penawaran Sudah PO');
        $sheet->getStyle('A1')->applyFromArray([
            'font' => [
                'bold' => true,
                'size' => 14,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical'   => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ]
        ]);

        // Periode
        $sheet->mergeCells('A2:F2');
        $sheet->setCellValue('A2', 'Periode: ' . date('d-m-Y', strtotime($tgl_awal)) . ' s/d ' . date('d-m-Y', strtotime($tgl_akhir)));
        $sheet->getStyle('A2')->applyFromArray([
            'font' => [
                'italic' => true,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            ]
        ]);

        // ============================
        // Header Tabel
        // ============================
        $sheet->setCellValue('A3', 'No');
        $sheet->setCellValue('B3', 'No Penawaran');
        $sheet->setCellValue('C3', 'Nama Customer');
        $sheet->setCellValue('D3', 'Tanggal Penawaran');
        $sheet->setCellValue('E3', 'Total Penawaran');
        $sheet->setCellValue('F3', 'Status');

        $sheet->getStyle('A3:F3')->applyFromArray([
            'font' => [
                'bold' => true,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical'   => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['rgb' => 'D9D9D9']
            ]
        ]);

        // ============================
        // Isi Data
        // ============================
        $row = 4; // data mulai dari baris 4
        $no = 1;
        foreach ($data as $item) {
            $sheet->setCellValue('A' . $row, $no);
            $sheet->setCellValueExplicit('B' . $row, $item->no_penawaran, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
            $sheet->setCellValue('C' . $row, $item->nama_customer);
            $sheet->setCellValue('D' . $row, date('d-m-Y', strtotime($item->tanggal_penawaran)));
            $sheet->setCellValueExplicit('E' . $row, number_format($item->total_penawaran, 0, ',', '.'), \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
            $sheet->getStyle('E' . $row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
            $sheet->setCellValue('F' . $row, $item->status_po);
            $row++;
            $no++;
        }

        // Auto width kolom
        foreach (range('A', 'F') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        // ============================
        // Download file Excel
        // ============================
        $filename = "laporan_penawaran_" . date('YmdHis') . ".xlsx";
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment; filename=\"$filename\"");
        header('Cache-Control: max-age=0');

        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }

    public function export_penawaran_sudah_pdf()
    {
        function tgl_indo($tanggal)
        {
            $bulan = array(
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

            return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
        }

        $html = '';
        $tgl_awal           = $_GET['tgl_awal'];
        $tgl_akhir          = $_GET['tgl_akhir'];

        $documentFileName = "laporan_penawaran_sudah_po.pdf";

        // Create the mPDF document
        $document = new PDF([
            'mode' => 'utf-8',
            'format' => 'A4-L',
        ]);

        // Set some header informations for output
        $header = [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . $documentFileName . '"'
        ];
        $document->SetTitle('Laporan Penawaran Sudah PO');
        // $document->SetHeader('Laporan Laundry');
        // Write some simple Content

        $html .= "<table width='100%' border='0' style='font-family:arial;'>
                    <tr>
                        <td width='65%'>
                            <b>LAPORAN PENAWARAN SUDAH PO</b><br>
                            <p style='font-size:12px;'>PERIODE : " . tgl_indo($tgl_awal) . " s/d " . tgl_indo($tgl_akhir) . "</p>
                        </td>
                        <td width='15%' align='right'>
                            <img src='" . str_replace("/index.php", "", $this->url->to('/')) . "/public/icon_pt_ace_BW.png' height='55px' width='70px'>
                        </td>
                        <td width='20%'>
                            <b><p style='font-size:12px;'>PT Anugrah Cipta Enginering</p></b>
                        </td>
                    </tr>
                  </table>";
        $html .= "<hr>";
        $html .= "<table border='1' width='100%' cellspacing='0' style='font-family:arial;font-size:11px;'>
                        <thead>
                            <tr>
                                <th width='4%'>No</th>
                                <th width='12%'>No Penawaran</th>
                                <th width='20%'>Nama Customer</th>
                                <th width='20%'>Alamat Customer</th>
                                <th width='15%'>Nama Sales</th>
                                <th width='12%'>Tanggal Penawaran</th>
                                <th width='12%'>Total Penawaran</th>
                                <th width='10%'>Status Penawaran</th>
                            </tr>
                        </thead>
                        <tbody>";

        // Query
        $result = DB::select("SELECT
                                    * 
                                FROM
                                    (
                                    SELECT
                                        A.*,
                                    CASE
                                            
                                            WHEN B.id IS NULL THEN
                                            'Belum PO' ELSE 'Sudah PO' 
                                    END AS status_po 
                                    FROM
                                        t_penawaran A
                                        INNER JOIN t_sales_order B ON B.id_penawaran = A.ID 
                                    ) AS C 
                                WHERE
                                    CAST( tanggal_penawaran AS DATE ) BETWEEN ? AND ? 
                                ORDER BY
                                    C.tanggal_penawaran ASC", [$tgl_awal, $tgl_akhir]);
        $no = 1;
        foreach ($result as $rec) {
            $html .= "<tr>
                        <td align='center'>" . $no . "</td>
                        <td align='center'>" . $rec->no_penawaran . "</td>
                        <td style='padding-left:5px;'>" . ucwords(strtolower($rec->nama_customer)) . "</td>
                        <td style='padding-left:5px;'>" . ucwords(strtolower($rec->alamat_customer)) . "</td>
                        <td style='padding-left:5px;'>" . ucwords(strtolower($rec->nama_sales)) . "</td>
                        <td align='center'>" . date_format(date_create($rec->tanggal_penawaran), "d M Y") . "</td>
                        <td align='right' style='padding-right:5px;'>" . number_format($rec->total_penawaran, 0, ',', '.') . "</td>
                        <td align='center'>" . $rec->status_po . "</td>
                    </tr>";
            $no++;
        }
        $html .= "</tbody></table>";

        $document->WriteHTML($html);

        // Use Blade if you want
        //$document->WriteHTML(view('fun.testtemplate'));

        // Save PDF on your public storage 
        Storage::disk('public')->put($documentFileName, $document->Output($documentFileName, "S"));

        // Get file back from storage with the give header informations
        return Storage::disk('public')->download($documentFileName, 'Request', $header);
    }


    // LAP PENAWARAN
    public function lap_penawaran()
    {
        return view('view_lap_penawaran');
    }

    public function preview_lap_penawaran(Request $request)
    {
        $tgl_awal      = $request->input('tgl_awal');
        $tgl_akhir     = $request->input('tgl_akhir');
        $nama_customer = $request->input('nama_customer');

        /* $query = DB::table('t_penawaran')
            ->whereBetween(DB::raw('CAST(tanggal_penawaran AS DATE)'), [$tgl_awal, $tgl_akhir])
            ->when(!empty($nama_customer), function ($q) use ($nama_customer) {
                $q->where('nama_customer', 'like', "%{$nama_customer}%");
            })
            ->orderBy('tanggal_penawaran', 'asc');

        $data = $query->get(); */

        // Query
        $query = DB::table('t_penawaran as h')
            ->join('t_penawaran_detail as d', 'd.id_header', '=', 'h.id')
            ->whereBetween(DB::raw('CAST(h.tanggal_penawaran AS DATE)'), [$tgl_awal, $tgl_akhir]);

        if (!empty($nama_customer)) {
            $query->where('h.nama_customer', 'like', "%$nama_customer%");
        }

        $data = $query->orderBy('h.tanggal_penawaran', 'ASC')->get();

        return response()->json($data);
    }

    /* public function export_lap_penawaran(Request $request)
    {
        $tgl_awal  = $request->input('tgl_awal');
        $tgl_akhir = $request->input('tgl_akhir');
        $nama_customer = $request->input('nama_customer');

        // Query
        $query = DB::table('t_penawaran as h')
            ->join('t_penawaran_detail as d', 'd.id_header', '=', 'h.id')
            ->whereBetween(DB::raw('CAST(h.tanggal_penawaran AS DATE)'), [$tgl_awal, $tgl_akhir]);

        if (!empty($nama_customer)) {
            $query->where('h.nama_customer', 'like', "%$nama_customer%");
        }

        $data = $query->orderBy('h.tanggal_penawaran', 'ASC')->get();

        // Inisialisasi Spreadsheet
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Lap Penawaran');

        // ============================
        // Judul Laporan
        // ============================
        $sheet->mergeCells('A1:I1');
        $sheet->setCellValue('A1', 'Laporan Penawaran');
        $sheet->getStyle('A1')->applyFromArray([
            'font' => [
                'bold' => true,
                'size' => 14,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical'   => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ]
        ]);

        // Periode
        $sheet->mergeCells('A2:I2');
        $sheet->setCellValue('A2', 'Periode: '.date('d-m-Y', strtotime($tgl_awal)).' s/d '.date('d-m-Y', strtotime($tgl_akhir)));
        $sheet->getStyle('A2')->applyFromArray([
            'font' => [
                'italic' => true,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            ]
        ]);

        // ============================
        // Header Tabel
        // ============================
        $sheet->setCellValue('A3', 'No');
        $sheet->setCellValue('B3', 'No Penawaran');
        $sheet->setCellValue('C3', 'Tanggal Penawaran');
        $sheet->setCellValue('D3', 'Nama Customer');
        $sheet->setCellValue('E3', 'Nama Sales');
        $sheet->setCellValue('F3', 'Nama Item');
        $sheet->setCellValue('G3', 'Qty');
        $sheet->setCellValue('H3', 'Harga Satuan');
        $sheet->setCellValue('I3', 'Harga Total');

        $sheet->getStyle('A3:I3')->applyFromArray([
            'font' => [
                'bold' => true,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical'   => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['rgb' => 'D9D9D9']
            ]
        ]);

        // ============================
        // Isi Data
        // ============================
        $row = 4; // data mulai dari baris 4
        $no = 1;
        $qty_satuan = "";
        $total = 0;
        foreach ($data as $item) {
            $qty_satuan = $item->qty." ".$item->satuan;
            $qty   = $item->qty   ?? 0;
            $harga = $item->harga ?? 0;

            $sheet->setCellValue('A'.$row, $no);
            $sheet->setCellValueExplicit('B'.$row, $item->no_penawaran, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
            $sheet->setCellValue('C'.$row, date('d-m-Y', strtotime($item->tanggal_penawaran)));
            $sheet->setCellValue('D'.$row, $item->nama_customer);
            $sheet->setCellValue('E'.$row, $item->nama_sales);
            $sheet->setCellValue('F'.$row, $item->nama_item);
            $sheet->setCellValue('G'.$row, $qty_satuan);
            // $sheet->setCellValue('H'.$row, );
            $sheet->setCellValueExplicit('H'.$row, number_format($item->harga, 0, ',', '.'), \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
            $sheet->getStyle('H'.$row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
            $sheet->setCellValueExplicit('I'.$row, number_format(($qty * $harga), 0, ',', '.'), \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
            $sheet->getStyle('I'.$row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);

            $total += ($qty * $harga);
            $row++;
            $no++;
        }
        
        // ============================
        // Total
        // ============================
        $sheet->mergeCells('A'.$row.':H'.$row);
        $sheet->setCellValue('A'.$row, 'TOTAL');
        $sheet->getStyle('A'.$row)->applyFromArray([
            'font' => [
                'bold' => true,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT,
            ],
        ]);
        $sheet->setCellValueExplicit('I'.$row, number_format($total, 0, ',', '.'), \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
        $sheet->getStyle('I'.$row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);

        // Auto width kolom
        foreach (range('A', 'I') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        // ============================
        // Download file Excel
        // ============================
        $filename = "laporan_penawaran_".date('YmdHis').".xlsx";
        
        $writer = new Xlsx($spreadsheet);
        // bersihkan buffer
        ob_clean();
        
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment; filename=\"$filename\"");
        header('Cache-Control: max-age=0');

        // $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);

        $writer->save('php://output');
        exit;
    } */

    public function export_lap_penawaran(Request $request)
    {
        $tgl_awal  = $request->input('tgl_awal');
        $tgl_akhir = $request->input('tgl_akhir');
        $nama_customer = $request->input('nama_customer');

        // Query
        $query = DB::table('t_penawaran as h')
            ->join('t_penawaran_detail as d', 'd.id_header', '=', 'h.id')
            ->whereBetween(DB::raw('CAST(h.tanggal_penawaran AS DATE)'), [$tgl_awal, $tgl_akhir]);

        if (!empty($nama_customer)) {
            $query->where('h.nama_customer', 'like', "%$nama_customer%");
        }

        $data = $query->orderBy('h.tanggal_penawaran', 'ASC')->get();

        // Nama file
        $filename = "new_laporan_penawaran_" . date('YmdHis') . ".xls";

        // Set header supaya browser download sebagai Excel
        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=\"$filename\"");
        header("Cache-Control: max-age=0");

        // Mulai HTML
        echo "<table border='1' cellspacing='0' cellpadding='5'>";
        echo "<tr><th colspan='9' style='font-weight:bold;font-size:14px;text-align:center;'>Laporan Penawaran</th></tr>";
        echo "<tr><th colspan='9' style='font-style:italic;text-align:center;'>Periode: " . date('d-m-Y', strtotime($tgl_awal)) . " s/d " . date('d-m-Y', strtotime($tgl_akhir)) . "</th></tr>";

        // Header tabel
        echo "<tr style='background:#D9D9D9;font-weight:bold;text-align:center;'>
                <th>No</th>
                <th>No Penawaran</th>
                <th>Tanggal Penawaran</th>
                <th>Nama Customer</th>
                <th>Nama Sales</th>
                <th>Nama Item</th>
                <th>Qty</th>
                <th>Harga Satuan</th>
                <th>Harga Total</th>
            </tr>";

        // Isi data
        $no = 1;
        $total = 0;
        foreach ($data as $item) {
            $qty   = $item->qty   ?? 0;
            $harga = $item->harga ?? 0;
            $harga_total = $qty * $harga;
            $total += $harga_total;

            echo "<tr>
                    <td align='center'>{$no}</td>
                    <td>{$item->no_penawaran}</td>
                    <td>" . date('d-m-Y', strtotime($item->tanggal_penawaran)) . "</td>
                    <td>{$item->nama_customer}</td>
                    <td>{$item->nama_sales}</td>
                    <td>{$item->nama_item}</td>
                    <td>{$qty} {$item->satuan}</td>
                    <td align='right'>" . number_format($harga, 0, ',', '.') . "</td>
                    <td align='right'>" . number_format($harga_total, 0, ',', '.') . "</td>
                </tr>";
            $no++;
        }

        // Total
        echo "<tr style='font-weight:bold;'>
                <td colspan='8' align='right'>TOTAL</td>
                <td align='right'>" . number_format($total, 0, ',', '.') . "</td>
            </tr>";

        echo "</table>";
        exit;
    }

    public function export_lap_penawaran_pdf(Request $request)
    {
        function tgl_indo($tanggal)
        {
            $bulan = array(
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

            return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
        }

        $html = '';
        $tgl_awal  = $request->input('tgl_awal');
        $tgl_akhir = $request->input('tgl_akhir');
        $nama_customer = $request->input('nama_customer');

        $documentFileName = "laporan_penawaran.pdf";

        // Create the mPDF document
        $document = new PDF([
            'mode' => 'utf-8',
            'format' => 'A4-L',
        ]);

        // Set some header informations for output
        $header = [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . $documentFileName . '"'
        ];
        $document->SetTitle('Laporan Penawaran');
        // $document->SetHeader('Laporan Laundry');
        // Write some simple Content

        $html .= "<table width='100%' border='0' style='font-family:arial;'>
                    <tr>
                        <td width='65%'>
                            <b>LAPORAN PENAWARAN</b><br>
                            <p style='font-size:12px;'>PERIODE : " . tgl_indo($tgl_awal) . " s/d " . tgl_indo($tgl_akhir) . "</p>
                        </td>
                        <td width='15%' align='right'>
                            <img src='" . str_replace("/index.php", "", $this->url->to('/')) . "/public/icon_pt_ace_BW.png' height='55px' width='70px'>
                        </td>
                        <td width='20%'>
                            <b><p style='font-size:12px;'>PT Anugrah Cipta Enginering</p></b>
                        </td>
                    </tr>
                  </table>";
        $html .= "<hr>";
        $html .= "<table border='1' width='100%' cellspacing='0' style='font-family:arial;font-size:11px;'>
                        <thead>
                            <tr>
                                <th width='4%'>No</th>
                                <th width='12%'>No Penawaran</th>
                                <th width='12%'>Tanggal Penawaran</th>
                                <th width='20%'>Nama Customer</th>
                                <th width='15%'>Nama Sales</th>
                                <th width='15%'>Nama Item</th>
                                <th width='5%'>Qty</th>
                                <th width='5%'>Harga Satuan</th>
                                <th width='5%'>Harga Total</th>
                            </tr>
                        </thead>
                        <tbody>";

        // Query
        $query = DB::table('t_penawaran as h')
            ->join('t_penawaran_detail as d', 'd.id_header', '=', 'h.id')
            ->whereBetween(DB::raw('CAST(h.tanggal_penawaran AS DATE)'), [$tgl_awal, $tgl_akhir]);

        if (!empty($nama_customer)) {
            $query->where('h.nama_customer', 'like', "%$nama_customer%");
        }

        $result = $query->orderBy('h.tanggal_penawaran', 'ASC')->get();

        $no = 1;
        $nama_cus = "";
        $total = 0;
        foreach ($result as $rec) {
            $html .= "<tr>
                        <td align='center'>" . $no . "</td>
                        <td align='center'>" . $rec->no_penawaran . "</td>
                        <td align='center'>" . date_format(date_create($rec->tanggal_penawaran), "d M Y") . "</td>
                        <td style='padding-left:5px;'>" . ucwords(strtolower($rec->nama_customer)) . "</td>
                        <td style='padding-left:5px;'>" . ucwords(strtolower($rec->nama_sales)) . "</td>
                        <td style='padding-left:5px;'>" . $rec->nama_item . "</td>
                        <td align='center' style='padding-left:5px;'>" . number_format($rec->qty, 0, ',', '.') . " " . $rec->satuan . "</td>
                        <td align='right' style='padding-left:5px;'>" . number_format($rec->harga, 0, ',', '.') . "</td>
                        <td align='right' style='padding-left:5px;'>" . number_format((($rec->qty ?? 0) * ($rec->harga ?? 0)), 0, ',', '.') . "</td>
                    </tr>";
            $total += ($rec->qty ?? 0) * ($rec->harga ?? 0);
            $no++;
        }
        $html .= "<tr>
                        <td align='right' colspan='8' style='padding-right:5px;'><b>Total</b></td>
                        <td align='right' style='padding-left:5px;'>" . number_format($total, 0, ',', '.') . "</td>
                    </tr>";
        $html .= "</tbody></table>";

        $document->WriteHTML($html);

        // Use Blade if you want
        //$document->WriteHTML(view('fun.testtemplate'));

        // Save PDF on your public storage 
        Storage::disk('public')->put($documentFileName, $document->Output($documentFileName, "S"));

        // Get file back from storage with the give header informations
        return Storage::disk('public')->download($documentFileName, 'Request', $header);
    }

    // LAP OMSET
    public function lap_omset()
    {
        return view('view_lap_omset');
    }

    public function preview_lap_omset(Request $request)
    {
        $tgl_awal      = $request->input('tgl_awal');
        $tgl_akhir     = $request->input('tgl_akhir');
        $nama_customer = $request->input('nama_customer');

        /* $query = DB::table('t_sales_order')
            ->whereBetween(DB::raw('CAST(created_date AS DATE)'), [$tgl_awal, $tgl_akhir])
            ->when(!empty($nama_customer), function ($q) use ($nama_customer) {
                $q->where('nama_customer', 'like', "%{$nama_customer}%");
            })
            ->orderBy('created_date', 'asc');

        $data = $query->get(); */

        // Query
        $query = DB::table('t_sales_order as b')
            ->join('t_penawaran as a', 'b.id_penawaran', '=', 'a.id')
            ->join('t_penawaran_detail as c', 'c.id_header', '=', 'a.id')
            ->whereBetween(DB::raw('CAST(b.created_date AS DATE)'), [$tgl_awal, $tgl_akhir]);

        if (!empty($nama_customer)) {
            $query->where('b.nama_customer', 'like', "%$nama_customer%");
        }

        $data = $query
            ->select('b.*', 'a.*', 'c.*') // atau pilih kolom tertentu biar tidak bentrok
            ->orderBy('b.created_date', 'ASC')
            ->get();

        return response()->json($data);
    }

    /* public function export_lap_omset(Request $request)
    {
        $tgl_awal  = $request->input('tgl_awal');
        $tgl_akhir = $request->input('tgl_akhir');
        $nama_customer = $request->input('nama_customer');

        // Query
        $query = DB::table('t_sales_order as b')
            ->join('t_penawaran as a', 'b.id_penawaran', '=', 'a.id')
            ->join('t_penawaran_detail as c', 'c.id_header', '=', 'a.id')
            ->whereBetween(DB::raw('CAST(b.created_date AS DATE)'), [$tgl_awal, $tgl_akhir]);

        if (!empty($nama_customer)) {
            $query->where('b.nama_customer', 'like', "%$nama_customer%");
        }

        $data = $query
            ->select('b.*', 'a.*', 'c.*') // atau pilih kolom tertentu biar tidak bentrok
            ->orderBy('b.created_date', 'ASC')
            ->get();

        // Inisialisasi Spreadsheet
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Lap Omset');

        // ============================
        // Judul Laporan
        // ============================
        $sheet->mergeCells('A1:G1');
        $sheet->setCellValue('A1', 'Laporan Omset');
        $sheet->getStyle('A1')->applyFromArray([
            'font' => [
                'bold' => true,
                'size' => 14,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical'   => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ]
        ]);

        // Periode
        $sheet->mergeCells('A2:G2');
        $sheet->setCellValue('A2', 'Periode: '.date('d-m-Y', strtotime($tgl_awal)).' s/d '.date('d-m-Y', strtotime($tgl_akhir)));
        $sheet->getStyle('A2')->applyFromArray([
            'font' => [
                'italic' => true,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            ]
        ]);

        // ============================
        // Header Tabel
        // ============================
        $sheet->setCellValue('A3', 'No');
        $sheet->setCellValue('B3', 'No Sales Order');
        $sheet->setCellValue('C3', 'Nama Customer');
        $sheet->setCellValue('D3', 'Nama Item');
        $sheet->setCellValue('E3', 'Qty');
        $sheet->setCellValue('F3', 'Harga Satuan');
        $sheet->setCellValue('G3', 'Harga Total');

        $sheet->getStyle('A3:G3')->applyFromArray([
            'font' => [
                'bold' => true,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical'   => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['rgb' => 'D9D9D9']
            ]
        ]);

        // ============================
        // Isi Data
        // ============================
        $row = 4; // data mulai dari baris 4
        $no = 1;
        $total = 0;
        $qty_satuan = "";
        foreach ($data as $item) {
            $qty   = $item->qty   ?? 0;
            $harga = $item->harga ?? 0;

            $qty_satuan = $item->qty." ".$item->satuan;
            $sheet->setCellValue('A'.$row, $no);
            $sheet->setCellValueExplicit('B'.$row, $item->no_transaksi, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
            $sheet->setCellValue('C'.$row, $item->nama_customer);
            $sheet->setCellValue('D'.$row, $item->nama_item);
            $sheet->setCellValue('E'.$row, $qty_satuan);
            // $sheet->setCellValue('F'.$row, );
            $sheet->setCellValueExplicit('F'.$row, number_format($item->harga, 0, ',', '.'), \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
            $sheet->getStyle('F'.$row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
            $sheet->setCellValueExplicit('G'.$row, number_format(($qty * $harga), 0, ',', '.'), \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
            $sheet->getStyle('G'.$row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);

            $total += ($qty * $harga);
            $row++;
            $no++;
        }

        // ============================
        // Total
        // ============================
        $sheet->mergeCells('A'.$row.':F'.$row);
        $sheet->setCellValue('A'.$row, 'TOTAL');
        $sheet->getStyle('A'.$row)->applyFromArray([
            'font' => [
                'bold' => true,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT,
            ],
        ]);
        $sheet->setCellValueExplicit('G'.$row, number_format($total, 0, ',', '.'), \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
        $sheet->getStyle('G'.$row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);

        // Auto width kolom
        foreach (range('A', 'G') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        // ============================
        // Download file Excel
        // ============================
        $filename = "laporan_omset_".date('YmdHis').".xlsx";
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment; filename=\"$filename\"");
        header('Cache-Control: max-age=0');

        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    } */

    public function export_lap_omset(Request $request)
    {
        $tgl_awal  = $request->input('tgl_awal');
        $tgl_akhir = $request->input('tgl_akhir');
        $nama_customer = $request->input('nama_customer');

        // Query
        $query = DB::table('t_sales_order as b')
            ->join('t_penawaran as a', 'b.id_penawaran', '=', 'a.id')
            ->join('t_penawaran_detail as c', 'c.id_header', '=', 'a.id')
            ->whereBetween(DB::raw('CAST(b.created_date AS DATE)'), [$tgl_awal, $tgl_akhir]);

        if (!empty($nama_customer)) {
            $query->where('b.nama_customer', 'like', "%$nama_customer%");
        }

        $data = $query
            ->select('b.*', 'a.*', 'c.*')
            ->orderBy('b.created_date', 'ASC')
            ->get();

        // ============================
        // Siapkan HTML
        // ============================
        $html  = "<table border='1' cellspacing='0' cellpadding='5'>";
        $html .= "<tr><th colspan='7' style='text-align:center;font-size:14pt;font-weight:bold'>Laporan Omset</th></tr>";
        $html .= "<tr><th colspan='7' style='text-align:center;font-style:italic'>Periode: " . date('d-m-Y', strtotime($tgl_awal)) . " s/d " . date('d-m-Y', strtotime($tgl_akhir)) . "</th></tr>";
        $html .= "<tr>
                    <th>No</th>
                    <th>No Sales Order</th>
                    <th>Nama Customer</th>
                    <th>Nama Item</th>
                    <th>Qty</th>
                    <th>Harga Satuan</th>
                    <th>Harga Total</th>
                </tr>";

        $no = 1;
        $total = 0;
        foreach ($data as $item) {
            $qty   = $item->qty   ?? 0;
            $harga = $item->harga ?? 0;
            $qty_satuan = $item->qty . " " . $item->satuan;

            $html .= "<tr>
                        <td>{$no}</td>
                        <td>{$item->no_transaksi}</td>
                        <td>{$item->nama_customer}</td>
                        <td>{$item->nama_item}</td>
                        <td>{$qty_satuan}</td>
                        <td style='text-align:right'>" . number_format($harga, 0, ',', '.') . "</td>
                        <td style='text-align:right'>" . number_format($qty * $harga, 0, ',', '.') . "</td>
                    </tr>";
            $total += ($qty * $harga);
            $no++;
        }

        $html .= "<tr>
                    <td colspan='6' style='text-align:right;font-weight:bold'>TOTAL</td>
                    <td style='text-align:right;font-weight:bold'>" . number_format($total, 0, ',', '.') . "</td>
                </tr>";
        $html .= "</table>";

        // ============================
        // Download sebagai Excel
        // ============================
        $filename = "laporan_omset_" . date('YmdHis') . ".xls"; // bisa juga .xlsx
        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=\"$filename\"");
        header("Cache-Control: max-age=0");

        echo $html;
        exit;
    }

    public function export_lap_omset_pdf(Request $request)
    {
        function tgl_indo($tanggal)
        {
            $bulan = array(
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

            return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
        }

        $html = '';
        $tgl_awal  = $request->input('tgl_awal');
        $tgl_akhir = $request->input('tgl_akhir');
        $nama_customer = $request->input('nama_customer');

        $documentFileName = "laporan_omset.pdf";

        // Create the mPDF document
        $document = new PDF([
            'mode' => 'utf-8',
            'format' => 'A4-L',
        ]);

        // Set some header informations for output
        $header = [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . $documentFileName . '"'
        ];
        $document->SetTitle('Laporan Omset');
        // $document->SetHeader('Laporan Laundry');
        // Write some simple Content

        $html .= "<table width='100%' border='0' style='font-family:arial;'>
                    <tr>
                        <td width='65%'>
                            <b>LAPORAN OMSET</b><br>
                            <p style='font-size:12px;'>PERIODE : " . tgl_indo($tgl_awal) . " s/d " . tgl_indo($tgl_akhir) . "</p>
                        </td>
                        <td width='15%' align='right'>
                            <img src='" . str_replace("/index.php", "", $this->url->to('/')) . "/public/icon_pt_ace_BW.png' height='55px' width='70px'>
                        </td>
                        <td width='20%'>
                            <b><p style='font-size:12px;'>PT Anugrah Cipta Enginering</p></b>
                        </td>
                    </tr>
                  </table>";
        $html .= "<hr>";
        $html .= "<table border='1' width='100%' cellspacing='0' style='font-family:arial;font-size:11px;'>
                        <thead>
                            <tr>
                                <th width='4%'>No</th>
                                <th width='12%'>No Sales Order</th>
                                <th width='20%'>Nama Customer</th>
                                <th width='25%'>Nama Item</th>
                                <th width='8%'>Qty</th>
                                <th width='8%'>Harga Satuan</th>
                                <th width='12%'>Harga Total</th>
                            </tr>
                        </thead>
                        <tbody>";

        // Query
        $query = DB::table('t_sales_order as b')
            ->join('t_penawaran as a', 'b.id_penawaran', '=', 'a.id')
            ->join('t_penawaran_detail as c', 'c.id_header', '=', 'a.id')
            ->whereBetween(DB::raw('CAST(b.created_date AS DATE)'), [$tgl_awal, $tgl_akhir]);

        if (!empty($nama_customer)) {
            $query->where('b.nama_customer', 'like', "%$nama_customer%");
        }

        $result = $query
            ->select('b.*', 'a.*', 'c.*') // atau pilih kolom tertentu biar tidak bentrok
            ->orderBy('b.created_date', 'ASC')
            ->get();

        $no = 1;
        $total = 0;
        foreach ($result as $rec) {
            $html .= "<tr>
                        <td align='center'>" . $no . "</td>
                        <td align='center'>" . $rec->no_transaksi . "</td>
                        <td style='padding-left:5px;'>" . ucwords(strtolower($rec->nama_customer)) . "</td>
                        <td style='padding-left:5px;'>" . $rec->nama_item . "</td>
                        <td align='center' style='padding-left:5px;'>" . $rec->qty . " " . $rec->satuan . "</td>
                        <td align='right' style='padding-left:5px;'>" . number_format($rec->harga, 0, ',', '.') . "</td>
                        <td align='right' style='padding-right:5px;'>" . number_format((($rec->qty ?? 0) * ($rec->harga ?? 0)), 0, ',', '.') . "</td>
                    </tr>";
            $total += (($rec->qty ?? 0) * ($rec->harga ?? 0));
            $no++;
        }
        $html .= "<tr>
                        <td colspan='6' align='right' style='padding-right:5px;'><b>Total</b></td>
                        <td align='right' style='padding-right:5px;'><b>" . number_format($total, 0, ',', '.') . "</b></td>
                    </tr>";
        $html .= "</tbody></table>";

        $document->WriteHTML($html);

        // Use Blade if you want
        //$document->WriteHTML(view('fun.testtemplate'));

        // Save PDF on your public storage 
        Storage::disk('public')->put($documentFileName, $document->Output($documentFileName, "S"));

        // Get file back from storage with the give header informations
        return Storage::disk('public')->download($documentFileName, 'Request', $header);
    }

    // LAP REVENUE
    public function lap_revenue()
    {
        return view('view_lap_revenue');
    }

    public function preview_lap_revenue(Request $request)
    {
        $tgl_awal      = $request->input('tgl_awal');
        $tgl_akhir     = $request->input('tgl_akhir');
        $nama_customer = $request->input('nama_customer');

        /* $query = DB::table('t_sales_order')
            ->whereBetween(DB::raw('CAST(created_date AS DATE)'), [$tgl_awal, $tgl_akhir])
            ->when(!empty($nama_customer), function ($q) use ($nama_customer) {
                $q->where('nama_customer', 'like', "%{$nama_customer}%");
            })
            ->where('flag_selesai', 'Ya') // tambahkan kondisi ini
            ->orderBy('created_date', 'asc');

        $data = $query->get(); */

        // Query
        $query = DB::table('t_sales_order as b')
            ->join('t_penawaran as a', 'b.id_penawaran', '=', 'a.id')
            ->join('t_penawaran_detail as c', 'c.id_header', '=', 'a.id')
            ->whereBetween(DB::raw('CAST(b.created_date AS DATE)'), [$tgl_awal, $tgl_akhir]);

        if (!empty($nama_customer)) {
            $query->where('b.nama_customer', 'like', "%$nama_customer%");
        }

        // tambahan filter flag_selesai
        $query->where('b.flag_selesai', 'Ya');

        $data = $query
            ->select('b.*', 'a.*', 'c.*') // ambil semua kolom, hati2 kalau ada bentrok
            ->orderBy('b.created_date', 'ASC')
            ->get();

        return response()->json($data);
    }

    /* public function export_lap_revenue(Request $request)
    {
        $tgl_awal  = $request->input('tgl_awal');
        $tgl_akhir = $request->input('tgl_akhir');
        $nama_customer = $request->input('nama_customer');

        // Query
        $query = DB::table('t_sales_order as b')
            ->join('t_penawaran as a', 'b.id_penawaran', '=', 'a.id')
            ->join('t_penawaran_detail as c', 'c.id_header', '=', 'a.id')
            ->whereBetween(DB::raw('CAST(b.created_date AS DATE)'), [$tgl_awal, $tgl_akhir]);

        if (!empty($nama_customer)) {
            $query->where('b.nama_customer', 'like', "%$nama_customer%");
        }

        // tambahan filter flag_selesai
        $query->where('b.flag_selesai', 'Ya');

        $data = $query
            ->select('b.*', 'a.*', 'c.*') // ambil semua kolom, hati2 kalau ada bentrok
            ->orderBy('b.created_date', 'ASC')
            ->get();

        // Inisialisasi Spreadsheet
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Lap Revenue');

        // ============================
        // Judul Laporan
        // ============================
        $sheet->mergeCells('A1:G1');
        $sheet->setCellValue('A1', 'Laporan Revenue');
        $sheet->getStyle('A1')->applyFromArray([
            'font' => [
                'bold' => true,
                'size' => 14,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical'   => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ]
        ]);

        // Periode
        $sheet->mergeCells('A2:G2');
        $sheet->setCellValue('A2', 'Periode: '.date('d-m-Y', strtotime($tgl_awal)).' s/d '.date('d-m-Y', strtotime($tgl_akhir)));
        $sheet->getStyle('A2')->applyFromArray([
            'font' => [
                'italic' => true,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            ]
        ]);

        // ============================
        // Header Tabel
        // ============================
        $sheet->setCellValue('A3', 'No');
        $sheet->setCellValue('B3', 'No Sales Order');
        $sheet->setCellValue('C3', 'Nama Customer');
        $sheet->setCellValue('D3', 'Nama Item');
        $sheet->setCellValue('E3', 'Qty');
        $sheet->setCellValue('F3', 'Harga Satuan');
        $sheet->setCellValue('G3', 'Harga Total');

        $sheet->getStyle('A3:G3')->applyFromArray([
            'font' => [
                'bold' => true,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical'   => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['rgb' => 'D9D9D9']
            ]
        ]);

        // ============================
        // Isi Data
        // ============================
        $row = 4; // data mulai dari baris 4
        $no = 1;
        $total = 0;
        $qty_satuan = "";
        foreach ($data as $item) {
            $qty   = $item->qty   ?? 0;
            $harga = $item->harga ?? 0;
            $qty_satuan = $item->qty." ".$item->satuan;
            $sheet->setCellValue('A'.$row, $no);
            $sheet->setCellValueExplicit('B'.$row, $item->no_transaksi, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
            $sheet->setCellValue('C'.$row, $item->nama_customer);
            $sheet->setCellValue('D'.$row, $item->nama_item);
            $sheet->setCellValue('E'.$row, $qty_satuan);
            // $sheet->setCellValue('F'.$row, $item->satuan);
            $sheet->setCellValueExplicit('F'.$row, number_format($item->harga, 0, ',', '.'), \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
            $sheet->getStyle('F'.$row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
            $sheet->setCellValueExplicit('G'.$row, number_format(($qty * $harga), 0, ',', '.'), \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
            $sheet->getStyle('G'.$row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
            
            $total += ($qty * $harga);
            $row++;
            $no++;
        }

        // ============================
        // Total
        // ============================
        $sheet->mergeCells('A'.$row.':F'.$row);
        $sheet->setCellValue('A'.$row, 'TOTAL');
        $sheet->getStyle('A'.$row)->applyFromArray([
            'font' => [
                'bold' => true,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT,
            ],
        ]);
        $sheet->setCellValueExplicit('G'.$row, number_format($total, 0, ',', '.'), \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
        $sheet->getStyle('G'.$row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);

        // Auto width kolom
        foreach (range('A', 'G') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        // ============================
        // Download file Excel
        // ============================
        $filename = "laporan_revenue_".date('YmdHis').".xlsx";
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment; filename=\"$filename\"");
        header('Cache-Control: max-age=0');

        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    } */

    public function export_lap_revenue(Request $request)
    {
        $tgl_awal  = $request->input('tgl_awal');
        $tgl_akhir = $request->input('tgl_akhir');
        $nama_customer = $request->input('nama_customer');

        // Query
        $query = DB::table('t_sales_order as b')
            ->join('t_penawaran as a', 'b.id_penawaran', '=', 'a.id')
            ->join('t_penawaran_detail as c', 'c.id_header', '=', 'a.id')
            ->whereBetween(DB::raw('CAST(b.created_date AS DATE)'), [$tgl_awal, $tgl_akhir]);

        if (!empty($nama_customer)) {
            $query->where('b.nama_customer', 'like', "%$nama_customer%");
        }

        // filter flag_selesai
        $query->where('b.flag_selesai', 'Ya');

        $data = $query
            ->select('b.*', 'a.*', 'c.*')
            ->orderBy('b.created_date', 'ASC')
            ->get();

        // ============================
        // Buat HTML
        // ============================
        $html  = "<table border='1' cellspacing='0' cellpadding='5'>";
        $html .= "<tr><th colspan='7' style='text-align:center;font-size:14pt;font-weight:bold'>Laporan Revenue</th></tr>";
        $html .= "<tr><th colspan='7' style='text-align:center;font-style:italic'>Periode: "
            . date('d-m-Y', strtotime($tgl_awal)) . " s/d " . date('d-m-Y', strtotime($tgl_akhir)) . "</th></tr>";
        $html .= "<tr>
                    <th>No</th>
                    <th>No Sales Order</th>
                    <th>Nama Customer</th>
                    <th>Nama Item</th>
                    <th>Qty</th>
                    <th>Harga Satuan</th>
                    <th>Harga Total</th>
                </tr>";

        $no = 1;
        $total = 0;
        foreach ($data as $item) {
            $qty   = $item->qty   ?? 0;
            $harga = $item->harga ?? 0;
            $qty_satuan = $item->qty . " " . $item->satuan;

            $html .= "<tr>
                        <td>{$no}</td>
                        <td>{$item->no_transaksi}</td>
                        <td>{$item->nama_customer}</td>
                        <td>{$item->nama_item}</td>
                        <td>{$qty_satuan}</td>
                        <td style='text-align:right'>" . number_format($harga, 0, ',', '.') . "</td>
                        <td style='text-align:right'>" . number_format($qty * $harga, 0, ',', '.') . "</td>
                    </tr>";

            $total += ($qty * $harga);
            $no++;
        }

        // Total
        $html .= "<tr>
                    <td colspan='6' style='text-align:right;font-weight:bold'>TOTAL</td>
                    <td style='text-align:right;font-weight:bold'>" . number_format($total, 0, ',', '.') . "</td>
                </tr>";
        $html .= "</table>";

        // ============================
        // Download sebagai Excel
        // ============================
        $filename = "laporan_revenue_" . date('YmdHis') . ".xls"; // gunakan .xls agar lebih kompatibel
        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=\"$filename\"");
        header("Cache-Control: max-age=0");

        echo $html;
        exit;
    }

    public function export_lap_revenue_pdf(Request $request)
    {
        function tgl_indo($tanggal)
        {
            $bulan = array(
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

            return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
        }

        $html = '';
        $tgl_awal  = $request->input('tgl_awal');
        $tgl_akhir = $request->input('tgl_akhir');
        $nama_customer = $request->input('nama_customer');

        $documentFileName = "laporan_revenue.pdf";

        // Create the mPDF document
        $document = new PDF([
            'mode' => 'utf-8',
            'format' => 'A4-L',
        ]);

        // Set some header informations for output
        $header = [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . $documentFileName . '"'
        ];
        $document->SetTitle('Laporan Revenue');
        // $document->SetHeader('Laporan Laundry');
        // Write some simple Content

        $html .= "<table width='100%' border='0' style='font-family:arial;'>
                    <tr>
                        <td width='65%'>
                            <b>LAPORAN REVENUE</b><br>
                            <p style='font-size:12px;'>PERIODE : " . tgl_indo($tgl_awal) . " s/d " . tgl_indo($tgl_akhir) . "</p>
                        </td>
                        <td width='15%' align='right'>
                            <img src='" . str_replace("/index.php", "", $this->url->to('/')) . "/public/icon_pt_ace_BW.png' height='55px' width='70px'>
                        </td>
                        <td width='20%'>
                            <b><p style='font-size:12px;'>PT Anugrah Cipta Enginering</p></b>
                        </td>
                    </tr>
                  </table>";
        $html .= "<hr>";
        $html .= "<table border='1' width='100%' cellspacing='0' style='font-family:arial;font-size:11px;'>
                        <thead>
                            <tr>
                                <th width='4%'>No</th>
                                <th width='12%'>No Sales Order</th>
                                <th width='20%'>Nama Customer</th>
                                <th width='20%'>Nama Item</th>
                                <th width='20%'>Qty</th>
                                <th width='20%'>Harga Satuan</th>
                                <th width='12%'>Harga Total</th>
                            </tr>
                        </thead>
                        <tbody>";

        // Query
        $query = DB::table('t_sales_order as b')
            ->join('t_penawaran as a', 'b.id_penawaran', '=', 'a.id')
            ->join('t_penawaran_detail as c', 'c.id_header', '=', 'a.id')
            ->whereBetween(DB::raw('CAST(b.created_date AS DATE)'), [$tgl_awal, $tgl_akhir]);

        if (!empty($nama_customer)) {
            $query->where('b.nama_customer', 'like', "%$nama_customer%");
        }

        // tambahan filter flag_selesai
        $query->where('b.flag_selesai', 'Ya');

        $result = $query
            ->select('b.*', 'a.*', 'c.*') // ambil semua kolom, hati2 kalau ada bentrok
            ->orderBy('b.created_date', 'ASC')
            ->get();

        $no = 1;
        $total = 0;
        $qty_satuan = "";
        foreach ($result as $rec) {
            $qty_satuan = "";
            $html .= "<tr>
                        <td align='center'>" . $no . "</td>
                        <td align='center'>" . $rec->no_transaksi . "</td>
                        <td style='padding-left:5px;'>" . ucwords(strtolower($rec->nama_customer)) . "</td>
                        <td style='padding-left:5px;'>" . $rec->nama_item . "</td>
                        <td align='center' style='padding-left:5px;'>" . $rec->qty . " " . $rec->satuan . "</td>
                        <td align='right' style='padding-left:5px;'>" . number_format($rec->harga, 0, ',', '.') . "</td>
                        <td align='right' style='padding-right:5px;'>" . number_format(($rec->qty ?? 0) * ($rec->harga ?? 0), 0, ',', '.') . "</td>
                    </tr>";
            $total += ($rec->qty ?? 0) * ($rec->harga ?? 0);
            $no++;
        }
        $html .= "<tr>
                        <td colspan='6' align='right' style='padding-right:5px;'><b>Total</b></td>
                        <td align='right' style='padding-right:5px;'><b>" . number_format($total, 0, ',', '.') . "</b></td>
                    </tr>";
        $html .= "</tbody></table>";

        $document->WriteHTML($html);

        // Use Blade if you want
        //$document->WriteHTML(view('fun.testtemplate'));

        // Save PDF on your public storage 
        Storage::disk('public')->put($documentFileName, $document->Output($documentFileName, "S"));

        // Get file back from storage with the give header informations
        return Storage::disk('public')->download($documentFileName, 'Request', $header);
    }

    // LAP PEMBELIAN
    public function lap_pembelian()
    {
        $response = array();
        $penawaran = DB::table('t_pembelian')->get();
        $i = 0;
        $response['res_pembelian'] = array();
        foreach ($penawaran as $rec) {
            $response['res_pembelian'][$i]['id'] = $rec->id;
            $response['res_pembelian'][$i]['no_pembelian'] = $rec->no_pembelian;
            $response['res_pembelian'][$i]['nama_customer'] = $rec->nama_customer;
            $response['res_pembelian'][$i]['alamat'] = $rec->alamat;
            $response['res_pembelian'][$i]['tanggal_pembelian'] = $rec->tanggal_pembelian;
            $response['res_pembelian'][$i]['jenis_order'] = $rec->jenis_order;
            $i++;
        }
        return view('view_lap_pembelian', $response);
        // return view('view_lap_pembelian');
    }

    /* public function export_lap_pembelian(Request $request)
    {
        $tgl_awal  = $request->input('tgl_awal');
        $tgl_akhir = $request->input('tgl_akhir');
        $jenis_order = $request->input('jenis_order');
        $nama_customer = $request->input('nama_customer');

        // Query
        $query = DB::table('t_pembelian')
            ->join('t_pembelian_detail', 't_pembelian_detail.id_header', '=', 't_pembelian.id')
            ->whereBetween(DB::raw('CAST(t_pembelian.tanggal_pembelian AS DATE)'), [$tgl_awal, $tgl_akhir]);

        if (!empty($nama_customer)) {
            $query->where('t_pembelian.nama_customer', 'like', "%$nama_customer%");
        }

        if (!empty($jenis_order)) {
            $query->where('t_pembelian.jenis_order', $jenis_order);
        }

        $data = $query->orderBy('t_pembelian.tanggal_pembelian', 'ASC')->get();

        // Inisialisasi Spreadsheet
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Lap Pembelian');

        // ============================
        // Judul Laporan
        // ============================
        $sheet->mergeCells('A1:I1');
        $sheet->setCellValue('A1', 'Laporan Pembelian');
        $sheet->getStyle('A1')->applyFromArray([
            'font' => [
                'bold' => true,
                'size' => 14,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical'   => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ]
        ]);

        // Periode
        $sheet->mergeCells('A2:I2');
        $sheet->setCellValue('A2', 'Periode: '.date('d-m-Y', strtotime($tgl_awal)).' s/d '.date('d-m-Y', strtotime($tgl_akhir)));
        $sheet->getStyle('A2')->applyFromArray([
            'font' => [
                'italic' => true,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            ]
        ]);

        // ============================
        // Header Tabel
        // ============================
        $sheet->setCellValue('A3', 'No');
        $sheet->setCellValue('B3', 'No Pembelian');
        $sheet->setCellValue('C3', 'Tanggal Pembelian');
        $sheet->setCellValue('D3', 'Nama Customer');
        $sheet->setCellValue('E3', 'Jenis Order');
        $sheet->setCellValue('F3', 'Nama Item');
        $sheet->setCellValue('G3', 'Qty');
        $sheet->setCellValue('H3', 'Harga Satuan');
        $sheet->setCellValue('I3', 'Harga Total');

        $sheet->getStyle('A3:I3')->applyFromArray([
            'font' => [
                'bold' => true,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical'   => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['rgb' => 'D9D9D9']
            ]
        ]);

        // ============================
        // Isi Data
        // ============================
        $row = 4; // data mulai dari baris 4
        $no = 1;
        $total = 0;
        $qty_satuan = "";
        foreach ($data as $item) {
            $qty   = $item->qty   ?? 0;
            $harga = $item->harga ?? 0;
            $qty_satuan = $item->qty." ".$item->satuan;
            $sheet->setCellValue('A'.$row, $no);
            $sheet->setCellValueExplicit('B'.$row, $item->no_pembelian, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
            $sheet->setCellValue('C'.$row, date('d-m-Y', strtotime($item->tanggal_pembelian)));
            $sheet->setCellValue('D'.$row, $item->nama_customer);
            $sheet->setCellValue('E'.$row, $item->jenis_order);
            $sheet->setCellValue('F'.$row, $item->nama_item);
            $sheet->setCellValue('G'.$row, $qty_satuan);
            // $sheet->setCellValue('F'.$row, $item->harga);
            // $sheet->setCellValue('F'.$row, );
            $sheet->setCellValueExplicit('H'.$row, number_format($item->harga, 0, ',', '.'), \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
            $sheet->getStyle('H'.$row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
            $sheet->setCellValueExplicit('I'.$row, number_format(($qty * $harga), 0, ',', '.'), \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
            $sheet->getStyle('I'.$row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
            
            $total += ($qty * $harga);
            $row++;
            $no++;
        }

        // ============================
        // Total
        // ============================
        $sheet->mergeCells('A'.$row.':H'.$row);
        $sheet->setCellValue('A'.$row, 'TOTAL');
        $sheet->getStyle('A'.$row)->applyFromArray([
            'font' => [
                'bold' => true,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT,
            ],
        ]);
        $sheet->setCellValueExplicit('I'.$row, number_format($total, 0, ',', '.'), \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
        $sheet->getStyle('I'.$row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);


        // Auto width kolom
        foreach (range('A', 'I') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        // ============================
        // Download file Excel
        // ============================
        $filename = "laporan_pembelian_".date('YmdHis').".xlsx";
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment; filename=\"$filename\"");
        header('Cache-Control: max-age=0');

        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    } */

    public function export_lap_pembelian(Request $request)
    {
        $tgl_awal  = $request->input('tgl_awal');
        $tgl_akhir = $request->input('tgl_akhir');
        $jenis_order = $request->input('jenis_order');
        $nama_customer = $request->input('nama_customer');

        // Query
        $query = DB::table('t_pembelian')
            ->join('t_pembelian_detail', 't_pembelian_detail.id_header', '=', 't_pembelian.id')
            ->whereBetween(DB::raw('CAST(t_pembelian.tanggal_pembelian AS DATE)'), [$tgl_awal, $tgl_akhir]);

        if (!empty($nama_customer)) {
            $query->where('t_pembelian.nama_customer', 'like', "%$nama_customer%");
        }

        if (!empty($jenis_order)) {
            $query->where('t_pembelian.jenis_order', $jenis_order);
        }

        $data = $query->orderBy('t_pembelian.tanggal_pembelian', 'ASC')->get();

        // ============================
        // Buat HTML
        // ============================
        $html  = "<table border='1' cellspacing='0' cellpadding='5'>";
        $html .= "<tr><th colspan='9' style='text-align:center;font-size:14pt;font-weight:bold'>Laporan Order Kerja</th></tr>";
        $html .= "<tr><th colspan='9' style='text-align:center;font-style:italic'>Periode: "
            . date('d-m-Y', strtotime($tgl_awal)) . " s/d " . date('d-m-Y', strtotime($tgl_akhir)) . "</th></tr>";
        $html .= "<tr>
                    <th>No</th>
                    <th>No Pembelian</th>
                    <th>Tanggal Pembelian</th>
                    <th>Nama Customer</th>
                    <th>Jenis Order</th>
                    <th>Nama Item</th>
                    <th>Qty</th>
                    <th>Harga Satuan</th>
                    <th>Harga Total</th>
                </tr>";

        $no = 1;
        $total = 0;
        foreach ($data as $item) {
            $qty   = $item->qty   ?? 0;
            $harga = $item->harga ?? 0;
            $qty_satuan = $item->qty . " " . $item->satuan;

            $html .= "<tr>
                        <td>{$no}</td>
                        <td>{$item->no_pembelian}</td>
                        <td>" . date('d-m-Y', strtotime($item->tanggal_pembelian)) . "</td>
                        <td>{$item->nama_customer}</td>
                        <td>{$item->jenis_order}</td>
                        <td>{$item->nama_item}</td>
                        <td>{$qty_satuan}</td>
                        <td style='text-align:right'>" . number_format($harga, 0, ',', '.') . "</td>
                        <td style='text-align:right'>" . number_format($qty * $harga, 0, ',', '.') . "</td>
                    </tr>";

            $total += ($qty * $harga);
            $no++;
        }

        // Total
        $html .= "<tr>
                    <td colspan='8' style='text-align:right;font-weight:bold'>TOTAL</td>
                    <td style='text-align:right;font-weight:bold'>" . number_format($total, 0, ',', '.') . "</td>
                </tr>";
        $html .= "</table>";

        // ============================
        // Download sebagai Excel
        // ============================
        $filename = "laporan_order_kerja_" . date('YmdHis') . ".xls"; // gunakan .xls biar aman
        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=\"$filename\"");
        header("Cache-Control: max-age=0");

        echo $html;
        exit;
    }

    public function export_lap_pembelian_pdf(Request $request)
    {
        function tgl_indo($tanggal)
        {
            $bulan = array(
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

            return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
        }

        $html = '';
        $tgl_awal  = $request->input('tgl_awal');
        $tgl_akhir = $request->input('tgl_akhir');
        $jenis_order = $request->input('jenis_order');
        $nama_customer = $request->input('nama_customer');

        $documentFileName = "laporan_order_kerja.pdf";

        // Create the mPDF document
        $document = new PDF([
            'mode' => 'utf-8',
            'format' => 'A4-L',
        ]);

        // Set some header informations for output
        $header = [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . $documentFileName . '"'
        ];
        $document->SetTitle('Laporan Order Kerja');
        // $document->SetHeader('Laporan Laundry');
        // Write some simple Content

        $html .= "<table width='100%' border='0' style='font-family:arial;'>
                    <tr>
                        <td width='65%'>
                            <b>LAPORAN ORDER KERJA</b><br>
                            <p style='font-size:12px;'>PERIODE : " . tgl_indo($tgl_awal) . " s/d " . tgl_indo($tgl_akhir) . "</p>
                        </td>
                        <td width='15%' align='right'>
                            <img src='" . str_replace("/index.php", "", $this->url->to('/')) . "/public/icon_pt_ace_BW.png' height='55px' width='70px'>
                        </td>
                        <td width='20%'>
                            <b><p style='font-size:12px;'>PT Anugrah Cipta Enginering</p></b>
                        </td>
                    </tr>
                  </table>";
        $html .= "<hr>";
        $html .= "<table border='1' width='100%' cellspacing='0' style='font-family:arial;font-size:11px;'>
                        <thead>
                            <tr>
                                <th width='4%'>No</th>
                                <th width='10%'>No Pembelian</th>
                                <th width='12%'>Tanggal Pembelian</th>
                                <th width='20%'>Nama Customer</th>
                                <th width='12%'>Jenis Order</th>
                                <th width='18%'>Nama Item</th>
                                <th width='5%'>Qty</th>
                                <th width='8%'>Harga Satuan</th>
                                <th width='8%'>Harga Total</th>
                            </tr>
                        </thead>
                        <tbody>";

        // Query
        $query = DB::table('t_pembelian')
            ->join('t_pembelian_detail', 't_pembelian_detail.id_header', '=', 't_pembelian.id')
            ->whereBetween(DB::raw('CAST(t_pembelian.tanggal_pembelian AS DATE)'), [$tgl_awal, $tgl_akhir]);

        if (!empty($nama_customer)) {
            $query->where('t_pembelian.nama_customer', 'like', "%$nama_customer%");
        }

        if (!empty($jenis_order)) {
            $query->where('t_pembelian.jenis_order', $jenis_order);
        }

        $result = $query->orderBy('t_pembelian.tanggal_pembelian', 'ASC')->get();

        $no = 1;
        $total = 0;
        foreach ($result as $rec) {
            $html .= "<tr>
                        <td align='center'>" . $no . "</td>
                        <td align='center'>" . $rec->no_pembelian . "</td>
                        <td align='center'>" . date_format(date_create($rec->tanggal_pembelian), "d M Y") . "</td>
                        <td style='padding-left:5px;'>" . ucwords(strtolower($rec->nama_customer)) . "</td>
                        <td align='left' style='padding-left:5px;'>" . ucwords(strtolower($rec->jenis_order)) . "</td>
                        <td style='padding-left:5px;'>" . $rec->nama_item . "</td>
                        <td align='center'>" . $rec->qty . " " . $rec->satuan . "</td>
                        <td align='right'>" . number_format($rec->harga, 0, ',', '.') . "</td>
                        <td align='right'>" . number_format((($rec->qty ?? 0) * ($rec->harga ?? 0)), 0, ',', '.') . "</td>
                    </tr>";
            $total += (($rec->qty ?? 0) * ($rec->harga ?? 0));
            $no++;
        }
        $html .= "<tr>
                        <td colspan='8' style='padding-right:5px;' align='right'><b>Total</b></td>
                        <td align='right'>" . number_format($total, 0, ',', '.') . "</td>
                    </tr>";
        $html .= "</tbody></table>";

        $document->WriteHTML($html);

        // Use Blade if you want
        //$document->WriteHTML(view('fun.testtemplate'));

        // Save PDF on your public storage 
        Storage::disk('public')->put($documentFileName, $document->Output($documentFileName, "S"));

        // Get file back from storage with the give header informations
        return Storage::disk('public')->download($documentFileName, 'Request', $header);
    }
    // ---- END ALL SUDAH PO ----

    // --- End ---


}
