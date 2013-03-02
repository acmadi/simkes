<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class bukuBesar extends CI_Controller {
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
	$this->load->view('laporan/bukuBesar'); //Default di arahkan ke function grid
    }
    
    function lookpegawai()
    {
        $keyword = $this->input->post('term');
        $data['response'] = 'false';
        $query = $this->m_laporan->caripegawai($keyword);
        if( ! empty($query) )
        {
            $data['response'] = 'true';
            $data['message'] = array();
            foreach( $query as $row )
            {
                $data['message'][] = array(
                                        'id'=>  $row['nip'],
                                        'value' => $row['nama_karyawan']
                                     );
            }
        }
        echo json_encode($data);
    }
	
    function json() 
    {
        $bukuBesar = $this->input->get('bukuBesar');
        $karyawan = $this->input->get('filter');
        $pegawai = $this->input->get('pegawai');
        $bulan = $this->input->get('bulan');
        $tahun = $this->input->get('tahun');
	$page  = $this->input->get('page');
	$limit = $this->input->get('rows');
	$sidx  = $this->input->get('sidx');
	$sord  = $this->input->get('sord');
	
        $rayon=$this->session->userdata('id_rayon');
        $wilayah=$this->session->userdata('id_wilayah');
        $mitra=$this->session->userdata('id_mitra');
        
        $group='y';
        
        $query="SELECT buku_besar,COUNT(buku_besar) AS jml_buku_besar,SUM(total) AS total
                FROM v_laporan_detail_bukubesar";
                

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
	$searchField='nama_karyawan';
        $searchString=$pegawai;
                 
	$count = $this->m_laporan->count_bukuBesar($query,$group,$searchField,$searchString,$rayon,$wilayah,$mitra,$bulan,$tahun,$bukuBesar,$karyawan,$pegawai);
		
	$count > 0 ? $total_pages = ceil($count/$limit) : $total_pages = 0;
	if ($page > $total_pages) $page=$total_pages;
	$start = $limit*$page - $limit;
	if($start <0) $start = 0;
		
	$data1 = $this->m_laporan->get_bukuBesar($query,$group,$searchField,$searchString, $sidx, $sord, $limit, $start,$rayon,$wilayah,$mitra,$bulan,$tahun,$bukuBesar,$karyawan,$pegawai)->result();
               
	$responce->page = $page;
	$responce->total = $total_pages;
	$responce->records = $count;
        $responce->bulan = $bulan;
        $responce->tahun = $tahun;
	$i=0;
	foreach($data1 as $line)
	{
            $detail_bb="<a href='$line->buku_besar' class='detail_bb'><span class='ui-icon ui-icon-document'></span></a>";
            $responce->rows[$i]['buku_besar']   = $line->buku_besar;
            $responce->rows[$i]['cell'] = array('',$line->buku_besar,$line->total,$detail_bb);
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
        $bukuBesar = $this->input->get('bukuBesar');
        //$bukuBesar = $this->input->get('bukuBesar');
        $karyawan = $this->input->get('filter');
        $pegawai = $this->input->get('pegawai');
        $bulan = $this->input->get('bulan');
        $tahun = $this->input->get('tahun');
	$page  = $this->input->get('page');
	$limit = $this->input->get('rows');
	$sidx  = $this->input->get('sidx');
	$sord  = $this->input->get('sord');
        
	$rayon=$this->session->userdata('id_rayon');
        $wilayah=$this->session->userdata('id_wilayah');
        $mitra=$this->session->userdata('id_mitra');
        
        $group='y';
        $query="SELECT buku_besar,COUNT(buku_besar) AS jml_buku_besar,SUM(total) AS total
                FROM v_laporan_detail_bukubesar";
        
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
	$searchField='buku_besar';
        $searchString=$bukuBesar;

	$count = $this->m_laporan->count_bukuBesar($query,$group,$searchField,$searchString,$rayon,$wilayah,$mitra,$bulan,$tahun,$bukuBesar,$karyawan,$pegawai);

	$count > 0 ? $total_pages = ceil($count/$limit) : $total_pages = 0;
	if ($page > $total_pages) $page=$total_pages;
	$start = $limit*$page - $limit;
	if($start <0) $start = 0;

	$data1 = $this->m_laporan->get_bukuBesar($query,$group,$searchField,$searchString, $sidx, $sord, $limit, $start,$rayon,$wilayah,$mitra,$bulan,$tahun,$bukuBesar,$karyawan,$pegawai)->result();
        $tulis=$this->excel->setActiveSheetIndex(0);

        $tulis->setCellValue('A1', "No");
        $tulis->setCellValue('B1', "Buku Besar");
        $tulis->setCellValue('C1', "Jumlah");
        $tulis->setCellValue('D1', "Total");


        $i=2;
        foreach($data1 as $line)
	{
            $tulis->setCellValue('A'.$i, $i-1);
            $tulis->setCellValue('B'.$i, $line->buku_besar);
            $tulis->setCellValue('C'.$i, $line->jml_buku_besar);
            $tulis->setCellValue('D'.$i, $line->total);
            $i++;
	}

      	// Rename worksheet
	$this->excel->getActiveSheet()->setTitle('Laporan bukuBesar');


	// Set active sheet index to the first sheet, so Excel opens this as the first sheet
	$this->excel->setActiveSheetIndex(0);

	// Redirect output to a client�s web browser (Excel5)
	header('Content-Type: application/vnd.ms-excel');
	header('Content-Disposition: attachment;filename="Laporan bukuBesar.xls"');
	header('Cache-Control: max-age=0');

	$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
	$objWriter->save('php://output');
	//exit;
    }
    
    function json2() 
    {
        $bukuBesar = $this->input->get('bukuBesar');
        $karyawan =$this->input->get('filter');
        $pegawai =$this->input->get('pegawai');
        $bulan = $this->input->get('bulan');
        $tahun = $this->input->get('tahun');
	$page  = $this->input->get('page');
	$limit = $this->input->get('rows');
	$sidx  = $this->input->get('sidx');
	$sord  = $this->input->get('sord');
	
        $rayon=$this->session->userdata('id_rayon');
        $wilayah=$this->session->userdata('id_wilayah');
        $mitra=$this->session->userdata('id_mitra');
        
        $query="SELECT * FROM v_laporan_detail_bukubesar";
        $group='t';
                

	if(!$sidx) $sidx=1;
			
	# Untuk Single Searchingnya #		
	$where = ""; //if there is no search request sent by jqgrid, $where should be empty
	$searchField = isset($_GET['searchField']) ? $_GET['searchField'] : false;
	$searchString = isset($_GET['searchString']) ? $_GET['searchString'] : false;
	if ($_GET['_search'] == 'true')
	{
			$where = array($searchField => $searchString);
		}
		# End #
	//$searchField='nama_karyawan';
        //$searchString=$pegawai;
                 
	$count = $this->m_laporan->count_bukuBesar($query,$group,$searchField,$searchString,$rayon,$wilayah,$mitra,$bulan,$tahun,$bukuBesar,$karyawan,$pegawai);
		
	$count > 0 ? $total_pages = ceil($count/$limit) : $total_pages = 0;
	if ($page > $total_pages) $page=$total_pages;
	$start = $limit*$page - $limit;
	if($start <0) $start = 0;
		
	$data1 = $this->m_laporan->get_bukuBesar($query,$group,$searchField,$searchString, $sidx, $sord, $limit, $start,$rayon,$wilayah,$mitra,$bulan,$tahun,$bukuBesar,$karyawan,$pegawai)->result();
               
	$responce->page = $page;
	$responce->total = $total_pages;
	$responce->records = $count;
        $responce->bulan = $bulan;
        $responce->tahun = $tahun;
	$i=0;
	foreach($data1 as $line)
	{
            $responce->rows[$i]['id']   = $line->id_transaksi;
            $responce->rows[$i]['cell'] = array($line->id_transaksi,$line->nip,$line->nama_karyawan,$line->rawat,$line->tgl_transaksi,$line->tgl_kunjungan
                                                ,$line->restitusi,$line->no_bukti,$line->kunjungan,$line->total);
            $i++;
	}
	echo json_encode($responce);
    }    
    
    function ekspor2()
    {
        error_reporting(E_ALL);
	date_default_timezone_set('Europe/London');

	// Add some data
        $bukuBesar = $this->input->get('bukuBesar');
        $karyawan = $this->input->get('filter');
        $pegawai = $this->input->get('pegawai');
        $bulan = $this->input->get('bulan');
        $tahun = $this->input->get('tahun');
	$page  = $this->input->get('page');
	$limit = $this->input->get('rows');
	$sidx  = $this->input->get('sidx');
	$sord  = $this->input->get('sord');
	$rayon=$this->session->userdata('id_rayon');
        //$rayon=1;
        $wilayah=$this->session->userdata('id_wilayah');
        $mitra=$this->session->userdata('id_mitra');
        $group='t';
        $query="SELECT * FROM v_laporan_detail_bukubesar";
        
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
	$searchField='buku_besar';
        $searchString=$bukuBesar;

	$count = $this->m_laporan->count_bukuBesar($query,$group,$searchField,$searchString,$rayon,$wilayah,$mitra,$bulan,$tahun,$bukuBesar,$karyawan,$pegawai);

	$count > 0 ? $total_pages = ceil($count/$limit) : $total_pages = 0;
	if ($page > $total_pages) $page=$total_pages;
	$start = $limit*$page - $limit;
	if($start <0) $start = 0;

	$data1 = $this->m_laporan->get_bukuBesar($query,$group,$searchField,$searchString, $sidx, $sord, $limit, $start,$rayon,$wilayah,$mitra,$bulan,$tahun,$bukuBesar,$karyawan,$pegawai)->result();
        $tulis=$this->excel->setActiveSheetIndex(0);

        $tulis->setCellValue('A1', "No");
        $tulis->setCellValue('B1', "NIP");
        $tulis->setCellValue('C1', "Penanggung");
        $tulis->setCellValue('D1', "Rawat");
        $tulis->setCellValue('E1', "Tgl Transaksi");
        $tulis->setCellValue('F1', "Tgl Kunjungan");
        $tulis->setCellValue('G1', "Restitusi");
        $tulis->setCellValue('H1', "Kwintansi");
        $tulis->setCellValue('I1', "Kunjungan");
        $tulis->setCellValue('J1', "Total");


        $i=2;
        foreach($data1 as $line)
	{
            $tulis->setCellValue('A'.$i, $i-1);
            $tulis->setCellValue('B'.$i, $line->nip);
            $tulis->setCellValue('C'.$i, $line->nama_karyawan);
            $tulis->setCellValue('D'.$i, $line->rawat);
            $tulis->setCellValue('E'.$i, $line->tgl_transaksi);
            $tulis->setCellValue('F'.$i, $line->tgl_kunjungan);
            $tulis->setCellValue('G'.$i, $line->restitusi);
            $tulis->setCellValue('H'.$i, $line->no_bukti);
            $tulis->setCellValue('I'.$i, $line->kunjungan);
            $tulis->setCellValue('J'.$i, $line->total);
            $i++;
	}

      	// Rename worksheet
	$this->excel->getActiveSheet()->setTitle('Laporan bukuBesar'.$bukuBesar);


	// Set active sheet index to the first sheet, so Excel opens this as the first sheet
	$this->excel->setActiveSheetIndex(0);

	// Redirect output to a client�s web browser (Excel5)
	header('Content-Type: application/vnd.ms-excel');
	header('Content-Disposition: attachment;filename="Laporan bukuBesar '.$bukuBesar.'.xls"');
	header('Cache-Control: max-age=0');

	$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
	$objWriter->save('php://output');
	//exit;
    }
    
    function detail()
    {

        //$nip= $this->input->get('nip');
	$data['bukuBesar']=$this->input->get('bukuBesar');
        $data['tahun']=$this->input->get('tahun');
        $data['bulan']=$this->input->get('bulan');
        $data['filter']=$this->input->get('filter');
        $data['pegawai']=$this->input->get('pegawai');
	$this->load->view('laporan/detailBukuBesar',$data);
    }
}