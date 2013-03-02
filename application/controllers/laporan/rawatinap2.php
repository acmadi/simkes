<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rawatinap2 extends CI_Controller {
   // $kun="";
    

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
	$jenis=$this->m_laporan->getjnsitemrawatjalan()->result_array();
      
        $data['item']=$jenis;
        $this->load->view('laporan/rawatinap2',$data); //Default di arahkan ke function grid
    }
	
	function json() 
	{
                $bulan = $this->input->get('bulan');
                $tahun = $this->input->get('tahun');
		$page  = $this->input->get('page');
		$limit = $this->input->get('rows');
		$sidx  = $this->input->get('sidx');
		$sord  = $this->input->get('sord');
		$rayon=$this->session->userdata('id_rayon');
                //$rayon=10;
                $wilayah=$this->session->userdata('id_wilayah');
                $mitra=$this->session->userdata('id_mitra');
                $filter = $this->input->get('ap');
                $jenis = $this->input->get('jns');
                //$filter='p';
                //$filter=$this->session->userdata('filter');

                

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
		//$searchField='nama_diagnosa';
                //$searchString=$diagnosa;
                 
		
                $count = $this->m_laporan->count_Rawatinap($searchField,$searchString,$rayon,$wilayah,$mitra,$bulan,$tahun,$filter,$jenis);
		

		$count > 0 ? $total_pages = ceil($count/$limit) : $total_pages = 0;
		if ($page > $total_pages) $page=$total_pages;
		$start = $limit*$page - $limit;
		if($start <0) $start = 0;


                $data1 = $this->m_laporan->get_Rawatinap($searchField,$searchString, $sidx, $sord, $limit, $start,$rayon,$wilayah,$mitra,$bulan,$tahun,$filter,$jenis)->result();

		$responce->page = $page;
		$responce->total = $total_pages;
		$responce->records = $count;
                $responce->bulan = $bulan;
                $responce->tahun = $tahun;
		$i=0;
		foreach($data1 as $line)
		{
			$responce->rows[$i]['id_transaksi']   = $line->id_transaksi;

			$responce->rows[$i]['cell'] = array($line->id_transaksi,$line->tgl_masuk,$line->tgl_keluar,$line->tgl_transaksi,$line->nip,$line->nama_karyawan,$line->ap,$line->nama_tertanggung,$line->status,$line->nama_provider,$line->nama_dokter,$line->nama_diagnosa,$line->total);
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
		$page  = $this->input->get('page');
		$limit = $this->input->get('rows');
		$sidx  = $this->input->get('sidx');
		$sord  = $this->input->get('sord');
		//$rayon=$this->session->userdata('id_rayon');
                $rayon=10;
                $wilayah=$this->session->userdata('id_wilayah');
                $mitra=$this->session->userdata('id_mitra');
                $filter = $this->input->get('ap');
                $jenis = $this->input->get('jns');
                //$filter='p';
                //$filter=$this->session->userdata('filter');



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
		//$searchField='nama_diagnosa';
                //$searchString=$diagnosa;

		$count = $this->m_laporan->count_Rawatinap($searchField,$searchString,$rayon,$wilayah,$mitra,$bulan,$tahun,$filter,$jenis);

		$count > 0 ? $total_pages = ceil($count/$limit) : $total_pages = 0;
		if ($page > $total_pages) $page=$total_pages;
		$start = $limit*$page - $limit;
		if($start <0) $start = 0;

		$data1 = $this->m_laporan->get_Rawatinap($searchField,$searchString, $sidx, $sord, $limit, $start,$rayon,$wilayah,$mitra,$bulan,$tahun,$filter,$jenis)->result();
                $tulis=$this->excel->setActiveSheetIndex(0);

                        $tulis->setCellValue('A1', "No");
                        $tulis->setCellValue('B1', "Id Transaksi");
                        $tulis->setCellValue('C1', "Tgl Masuk");
                        $tulis->setCellValue('D1', "Tgl Keluar");
                        $tulis->setCellValue('E1', "Tgl Transaksi");
                        $tulis->setCellValue('F1', "NIP");
                        $tulis->setCellValue('G1', "Penanggung");
                        $tulis->setCellValue('H1', "A/P");
                        $tulis->setCellValue('I1', "Pasien");
                        $tulis->setCellValue('J1', "Status");
                        $tulis->setCellValue('K1', "Provider");
                        $tulis->setCellValue('L1', "Dokter");
                        $tulis->setCellValue('M1', "Diagnosa");
                        $tulis->setCellValue('N1', "Total");


        $i=2;
        foreach($data1 as $line)
		{


			$tulis->setCellValue('A'.$i, $i-1);
                        $tulis->setCellValue('B'.$i, $line->id_transaksi);
                        $tulis->setCellValue('C'.$i, $line->tgl_masuk);
                        $tulis->setCellValue('D'.$i, $line->tgl_keluar);
                        $tulis->setCellValue('E'.$i, $line->tgl_transaksi);
                        $tulis->setCellValue('F'.$i, $line->nip);
                        $tulis->setCellValue('G'.$i, $line->nama_karyawan);
                        $tulis->setCellValue('H'.$i, $line->ap);
                        $tulis->setCellValue('I'.$i, $line->nama_tertanggung);
                        $tulis->setCellValue('J'.$i, $line->status);
                        $tulis->setCellValue('K'.$i, $line->nama_provider);
                        $tulis->setCellValue('L'.$i, $line->nama_dokter);
                        $tulis->setCellValue('M'.$i, $line->nama_diagnosa);
                        $tulis->setCellValue('N'.$i, $line->total_harga);
			$i++;
		}


      	// Rename worksheet
	$this->excel->getActiveSheet()->setTitle('Laporan Rawat Inap');


	// Set active sheet index to the first sheet, so Excel opens this as the first sheet
	$this->excel->setActiveSheetIndex(0);


	// Redirect output to a client�s web browser (Excel5)
	header('Content-Type: application/vnd.ms-excel');
	header('Content-Disposition: attachment;filename="Laporan Rawat Inap.xls"');
	header('Cache-Control: max-age=0');

	$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
	$objWriter->save('php://output');
	//exit;
	}

}