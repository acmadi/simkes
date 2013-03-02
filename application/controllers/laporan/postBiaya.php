<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class PostBiaya extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->model(array('m_laporan','m_transaksi'));
        $this->load->helper('url'); // Load Helper URL CI
        $this->load->library(array('excel'));
        //$this->load->helper('form');
    }
       
    function index()
    {
	$this->load->view('laporan/postBiaya'); //Default di arahkan ke function grid
    }
    
    function json() 
    {
        $bulan = $this->input->get('bulan');
        $tahun = $this->input->get('tahun');
        $jenis = $this->input->get('jenis');
	$page  = $this->input->get('page');
	$limit = $this->input->get('rows');
	$sidx  = $this->input->get('sidx');
	$sord  = $this->input->get('sord');
	$rayon=$this->session->userdata('id_rayon');
        //$rayon=1;
        $wilayah=$this->session->userdata('id_wilayah');
        $mitra=$this->session->userdata('id_mitra');
                

	if(!$sidx) $sidx=1;
			
	# Untuk Single Searchingnya #		
	$where = ""; //if there is no search request sent by jqgrid, $where should be empty
	$searchField = isset($_GET['searchField']) ? $_GET['searchField'] : false;
	$searchString = isset($_GET['searchString']) ? $_GET['searchString'] : false;
	/*if ($_GET['_search'] == 'true')
	{
			$where = array($searchField => $searchString);
		}*/
		# End #
	//$searchField='nama_karyawan';
        //$searchString=$pegawai;
                 
	$count = $this->m_laporan->count_postBiaya($searchField,$searchString,$rayon,$wilayah,$mitra,$bulan,$tahun,$jenis);
		
	$count > 0 ? $total_pages = ceil($count/$limit) : $total_pages = 0;
	if ($page > $total_pages) $page=$total_pages;
	$start = $limit*$page - $limit;
	if($start <0) $start = 0;
		
	$data1 = $this->m_laporan->get_postBiaya($searchField,$searchString, $sidx, $sord, $limit, $start,$rayon,$wilayah,$mitra,$bulan,$tahun,$jenis)->result();
               
	$responce->page = $page;
	$responce->total = $total_pages;
	$responce->records = $count;
        $responce->bulan = $bulan;
        $responce->tahun = $tahun;
	$i=0;
	foreach($data1 as $line)
	{
            $responce->rows[$i]['id']   = $line->id_transaksi;
			$data2=$this->m_laporan->get_diag($line->id_transaksi)->result();
			$isi_diag="";
			foreach($data2 as $isi)
			{
				if($isi_diag==""){
					$isi_diag=$isi->nama_diagnosa;
				}else{
					$isi_diag=$isi_diag."<br>".$isi->nama_diagnosa;
				}
			}
            $responce->rows[$i]['cell'] = array('',$line->id_transaksi,$line->nip,$isi_diag,$line->nama_karyawan,$line->nama_tertanggung,$line->nama_dokter,$line->tgl_transaksi,$line->tgl_kunjungan,$line->biaya);
            $i++;
	}
	echo json_encode($responce);
    }

    function crud()
    {
        $oper=$this->input->post('oper');
	$id_transaksi=$this->input->post('id');

        switch ($oper)
	{
            case 'del':
                $this->m_transaksi->delete_transaksi($id_transaksi);
	    break;
	}
    }
        
    function ekspor()
    {
        error_reporting(E_ALL);
	date_default_timezone_set('Europe/London');

	// Add some data
        $bulan = $this->input->get('bulan');
        $tahun = $this->input->get('tahun');
        $jenis = $this->input->get('jenis');
	$page  = $this->input->get('page');
	$limit = $this->input->get('rows');
	$sidx  = $this->input->get('sidx');
	$sord  = $this->input->get('sord');
	$rayon=$this->session->userdata('id_rayon');
        //$rayon=1;
        $wilayah=$this->session->userdata('id_wilayah');
        $mitra=$this->session->userdata('id_mitra');
        
	if(!$sidx) $sidx=1;
		# Untuk Single Searchingnya #
	$where = ""; //if there is no search request sent by jqgrid, $where should be empty
	$searchField = isset($_GET['searchField']) ? $_GET['searchField'] : false;
	$searchString = isset($_GET['searchString']) ? $_GET['searchString'] : false;
		/*if ($_GET['_search'] == 'true')
		{
			$where = array($searchField => $searchString);
		}*/
		# End #
	//$searchField='nama_postBiaya';
        //$searchString=$postBiaya;

	$count = $this->m_laporan->count_postBiaya($searchField,$searchString,$rayon,$wilayah,$mitra,$bulan,$tahun,$jenis);

	$count > 0 ? $total_pages = ceil($count/$limit) : $total_pages = 0;
	if ($page > $total_pages) $page=$total_pages;
	$start = $limit*$page - $limit;
	if($start <0) $start = 0;

	$data1 = $this->m_laporan->get_postBiaya($searchField,$searchString, $sidx, $sord, $limit, $start,$rayon,$wilayah,$mitra,$bulan,$tahun,$jenis)->result();
        $tulis=$this->excel->setActiveSheetIndex(0);

        $tulis->setCellValue('A1', "No");
        $tulis->setCellValue('B1', "ID Transaksi");
        $tulis->setCellValue('C1', "NIP");
        $tulis->setCellValue('D1', "Diagnosa");
        $tulis->setCellValue('E1', "Penanggung");
		$tulis->setCellValue('F1', "Pasien");
		$tulis->setCellValue('G1', "Dokter");
		$tulis->setCellValue('H1', "Tgl Transaksi");
		$tulis->setCellValue('I1', "Tgl Kunjungan");
		$tulis->setCellValue('J1', "Total Biaya");

        $i=2;
        foreach($data1 as $line)
	{
			$data2=$this->m_laporan->get_diag($line->id_transaksi)->result();
			$isi_diag="";
			foreach($data2 as $isi)
			{
				if($isi_diag==""){
					$isi_diag=$isi->nama_diagnosa;
				}else{
					$isi_diag=$isi_diag.",".$isi->nama_diagnosa;
				}
			}
            $tulis->setCellValue('A'.$i, $i-1);
            $tulis->setCellValue('B'.$i, $line->id_transaksi);
            $tulis->setCellValue('C'.$i, $line->nip);
            $tulis->setCellValue('D'.$i, $isi_diag);
            $tulis->setCellValue('E'.$i, $line->nama_karyawan);
			$tulis->setCellValue('F'.$i, $line->nama_tertanggung);
			$tulis->setCellValue('G'.$i, $line->nama_dokter);
			$tulis->setCellValue('H'.$i, $line->tgl_transaksi);
			$tulis->setCellValue('I'.$i, $line->tgl_kunjungan);
			$tulis->setCellValue('J'.$i, $line->biaya);
            $i++;
	}

      	// Rename worksheet
	$this->excel->getActiveSheet()->setTitle('Laporan postBiaya');


	// Set active sheet index to the first sheet, so Excel opens this as the first sheet
	$this->excel->setActiveSheetIndex(0);

	// Redirect output to a client�s web browser (Excel5)
	header('Content-Type: application/vnd.ms-excel');
	header('Content-Disposition: attachment;filename="Laporan postBiaya.xls"');
	header('Cache-Control: max-age=0');

	$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
	$objWriter->save('php://output');
	//exit;
    }
}