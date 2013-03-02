<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class  Mingguan extends CI_Controller {
   // $kun="";


    function __construct()
    {
        parent::__construct();
        $this->load->model(array('m_hasil_transaksi','m_transaksi','m_karyawan','m_tran_apotek','m_tertanggung','m_item','m_dokter','m_apotek'));
        $this->load->helper('url'); // Load Helper URL CI
        $this->load->library(array('excel'));
        //$this->load->helper('form');
    }




        function index()
        {
	$this->load->view('laporan/mingguan'); //Default di arahkan ke function grid

 	//$id= $this->session->userdata('id_user');

    //echo "Semangat";
	}

        function laporanmingguan()
        {

        $tanggal1=$this->input->post("tanggal1");
        $tanggal2=$this->input->post("tanggal2");

        $rayon=null;
        $wilayah=null;
        $mitra=null;
        $tot=$this->m_hasil_transaksi->get_total($rayon,$wilayah,$mitra,null,$tanggal1,$tanggal2)->result_array();
        $lang = $this->m_hasil_transaksi->count_langganan($rayon,$wilayah,$mitra,$tanggal1,$tanggal2)->result_array();
        $res = $this->m_hasil_transaksi->count_restitusi($rayon,$wilayah,$mitra,$tanggal1,$tanggal2)->result_array();
        $inap = $this->m_hasil_transaksi->count_rawat_inap($rayon,$wilayah,$mitra,$tanggal1,$tanggal2)->result_array();
        $langgumum = $this->m_hasil_transaksi->get_langgananumum($rayon,$wilayah,$mitra,$tanggal1,$tanggal2)->result_array();
        $langgspesialis = $this->m_hasil_transaksi->get_langgananspesialis($rayon,$wilayah,$mitra,$tanggal1,$tanggal2)->result_array();
        $resumum = $this->m_hasil_transaksi->get_restitusiumum($rayon,$wilayah,$mitra,$tanggal1,$tanggal2)->result_array();
        $resspesialis = $this->m_hasil_transaksi->get_restitusispesialis($rayon,$wilayah,$mitra,$tanggal1,$tanggal2)->result_array();
        $inap1 = $this->m_hasil_transaksi->get_rawatinap($rayon,$wilayah,$mitra,$tanggal1,$tanggal2)->result_array();
        $konsultasi = $this->m_hasil_transaksi->get_jmlperiksadak($rayon,$wilayah,$mitra,1,$tanggal1,$tanggal2)->result_array();
        $proaktif = $this->m_hasil_transaksi->get_jmlperiksadak($rayon,$wilayah,$mitra,3,$tanggal1,$tanggal2)->result_array();
        $berobat = $this->m_hasil_transaksi->get_jmlperiksadak($rayon,$wilayah,$mitra,2,$tanggal1,$tanggal2)->result_array();
        $mrs = $this->m_hasil_transaksi->get_jmlperiksadak($rayon,$wilayah,$mitra,6,$tanggal1,$tanggal2)->result_array();
        $laborat = $this->m_hasil_transaksi->get_jmlrujukan($rayon,$wilayah,$mitra,4,$tanggal1,$tanggal2)->result_array();
        $spesialis = $this->m_hasil_transaksi->get_jmlrujukan($rayon,$wilayah,$mitra,1,$tanggal1,$tanggal2)->result_array();

        error_reporting(E_ALL);

	date_default_timezone_set('Europe/London');

 
        //load Excel template file
        $objTpl = PHPExcel_IOFactory::load("./asset/template/laporanming.xls");
        $objTpl->setActiveSheetIndex(0);  //set first sheet as active
 
        $objTpl->getActiveSheet()->setCellValue('C5', date('Y-m-d'));  //set C1 to current date
        //$objTpl->getActiveSheet()->getStyle('C5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); //C1 is right-justified
 
        //$objTpl->getActiveSheet()->setCellValue('C3', stripslashes($_POST['txtName']));
        //$objTpl->getActiveSheet()->setCellValue('C4', stripslashes($_POST['txtMessage']));

$nama = $this->session->userdata('nama');
$jml_konsultasi = $konsultasi[0]['count(distinct id_transaksi)'];
$jml_proaktif = $proaktif[0]['count(distinct id_transaksi)'];
$jml_berobat = $berobat[0]['count(distinct id_transaksi)'];
$jml_mrs = $mrs[0]['count(distinct id_transaksi)'];
$jml_laborat = $laborat[0]['count(distinct id_transaksi)'];
$jml_spesialis = $spesialis[0]['count(distinct id_transaksi)'];
$jml_rawatinap = $inap[0]['count(distinct id_transaksi)'];;
$jml_dak = 0;
$jml_langg = 0;
$jml_res = 0;
$jml_rwtinap2 = 0;
$jml_ppk2 = 0;
$jml_ppk3 = 0;
$jml_dak1 = 0;
$polifarmasi = 0;
$mahal = 0;
$berlebih = 0;
$shoping_dokter = 0;
$berobat_keluarga = 0;
$tem_verifikasi = 0;
$tem_koreksi = 0;
$koreksi = 0;
$obat_het = 0;
$oral = 0;
$parenteral = 0;
$kip = 0;
$resep_berlebih = 0;
$tanpa_konfirmasi = 0;

$jml_langganan = $lang[0]['count(distinct id_transaksi)'];
$jml_restitusi = $res[0]['count(distinct id_transaksi)'];
$jml_rwtinap = $inap[0]['count(distinct id_transaksi)'];
$jml_langgumum = $langgumum[0]['sum(total)'];
$jml_langgspesialis = $langgspesialis[0]['sum(total)'];
$jml_resumum = $resumum[0]['sum(total)'];
$jml_resspesialis = $resspesialis[0]['sum(total)'];
$jml_rwtinap1 = $inap1[0]['sum(total_harga)'];
$total= $tot[0]['sum(total)'];

$objTpl->getActiveSheet()->setCellValue('C4', $nama);
$objTpl->getActiveSheet()->setCellValue('D9', $jml_konsultasi);
$objTpl->getActiveSheet()->setCellValue('D10', $jml_proaktif);
$objTpl->getActiveSheet()->setCellValue('D11', $jml_berobat);
$objTpl->getActiveSheet()->setCellValue('D12', $jml_mrs);
$objTpl->getActiveSheet()->setCellValue('D14', $jml_laborat);
$objTpl->getActiveSheet()->setCellValue('D15', $jml_spesialis);
$objTpl->getActiveSheet()->setCellValue('D16', $jml_rawatinap);
$objTpl->getActiveSheet()->setCellValue('D18', $jml_dak1);
$objTpl->getActiveSheet()->setCellValue('D19', $jml_langganan);
$objTpl->getActiveSheet()->setCellValue('D20', $jml_restitusi);
$objTpl->getActiveSheet()->setCellValue('D21', $jml_rwtinap);
$objTpl->getActiveSheet()->setCellValue('D24', $jml_dak1);
$objTpl->getActiveSheet()->setCellValue('D25', $jml_langganan);
$objTpl->getActiveSheet()->setCellValue('D26', $jml_restitusi);
$objTpl->getActiveSheet()->setCellValue('D28', $jml_ppk2);
$objTpl->getActiveSheet()->setCellValue('D30', $jml_ppk3);
$objTpl->getActiveSheet()->setCellValue('D33', $jml_dak1);
$objTpl->getActiveSheet()->setCellValue('D34', $jml_langgumum);
$objTpl->getActiveSheet()->setCellValue('D35', $jml_langgspesialis);
$objTpl->getActiveSheet()->setCellValue('D36', $jml_resumum);
$objTpl->getActiveSheet()->setCellValue('D37', $jml_resspesialis);
$objTpl->getActiveSheet()->setCellValue('D38', $jml_rwtinap1);
$objTpl->getActiveSheet()->setCellValue('D43', $polifarmasi);
$objTpl->getActiveSheet()->setCellValue('D44', $mahal);
$objTpl->getActiveSheet()->setCellValue('D45', $berlebih);
$objTpl->getActiveSheet()->setCellValue('D46', $shoping_dokter);
$objTpl->getActiveSheet()->setCellValue('D47', $berobat_keluarga);
$objTpl->getActiveSheet()->setCellValue('D49', $total);
$objTpl->getActiveSheet()->setCellValue('D50', $tem_verifikasi);
$objTpl->getActiveSheet()->setCellValue('D51', $tem_koreksi);
$objTpl->getActiveSheet()->setCellValue('D58', $obat_het);
$objTpl->getActiveSheet()->setCellValue('D63', $oral);
$objTpl->getActiveSheet()->setCellValue('D64', $parenteral);
$objTpl->getActiveSheet()->setCellValue('D65', $kip);
$objTpl->getActiveSheet()->setCellValue('D66', $resep_berlebih);
$objTpl->getActiveSheet()->setCellValue('D67', $tanpa_konfirmasi);
 
$objTpl->getActiveSheet()->getStyle('C4')->getAlignment()->setWrapText(true);  //set wrapped for some long text message
 
$objTpl->getActiveSheet()->getColumnDimension('C')->setWidth(40);  //set column C width
//$objTpl->getActiveSheet()->getRowDimension('4')->setRowHeight(120);  //set row 4 height
$objTpl->getActiveSheet()->getStyle('A4:C4')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP); //A4 until C4 is vertically top-aligned
 
//prepare download
$filename='Laporan Mingguan '.$tanggal1.'.xls'; //just some random filename
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="'.$filename.'"');
header('Cache-Control: max-age=0');
 
$objWriter = PHPExcel_IOFactory::createWriter($objTpl, 'Excel5');  //downloadable file is in Excel 2003 format (.xls)
$objWriter->save('php://output');  //send it to user, of course you can save it to disk also!
 

        }

        




}