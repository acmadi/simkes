<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class BiayaTerbesar extends CI_Controller {
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
	$this->load->view('laporan/biayaTerbesar'); //Default di arahkan ke function grid

    }
    
    function lookdokter()
    {
        $keyword = $this->input->post('term');
        $data['response'] = 'false';
        $query = $this->m_laporan->caridokter($keyword);
        if( ! empty($query) )
        {
            $data['response'] = 'true';
            $data['message'] = array();
            foreach( $query as $row )
            {
                $data['message'][] = array(
                                        'id'=>  $row['id_dokter'],
                                        'value' => $row['nama_dokter']
                                     );
            }
        }
        echo json_encode($data);
    }
	
    function json() 
    {
        //$namaTb = $this->input->get('namaTb');
        $jenis = $this->input->get('jenis');
        /*
        if($jenis=='20ot'){
            $jenis='20';
        }else if($jenis='20pt'){
            $hsl=$this->m_laporan->count_20pt();
            //$hsl as $row;
            $jenis=$hsl['jml'];
        }
         * 
         */        
        
        $bulan = $this->input->get('bulan');
        $tahun = $this->input->get('tahun');
        //$tgl1 = $this->input->get('tgl1');
        //$tgl2 = $this->input->get('tgl2');
        $karyawan = $this->input->get('karyawan');
        //$dokter = $this->input->get('dokter');
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
		//$searchField='nama_biayaTerbesar';
                //$searchField='';
                //$searchString=$biayaTerbesar;
                //$searchString='';
                 
	$count = $this->m_laporan->count_biayaTerbesar($searchField,$searchString,$rayon,$wilayah,$mitra,$bulan,$tahun,$karyawan,$jenis);
		
	$count > 0 ? $total_pages = ceil($count/$limit) : $total_pages = 0;
	if ($page > $total_pages) $page=$total_pages;
	$start = $limit*$page - $limit;
	if($start <0) $start = 0;
		
	$data1 = $this->m_laporan->get_biayaTerbesar($searchField,$searchString, $sidx, $sord, $limit, $start,$rayon,$wilayah,$mitra,$bulan,$tahun,$karyawan,$jenis)->result();
               
	$responce->page = $page;
	$responce->total = $total_pages;
	$responce->records = $count;
        $responce->bulan = $bulan;
        $responce->tahun = $tahun;
	$i=0;
	foreach($data1 as $line)
	{
            $responce->rows[$i]['id_transaksi']   = $line->nip;
		$detail="<a href='$line->nip' class='detail_terbesar'>$line->nama_karyawan</a>";	
            $responce->rows[$i]['cell'] = array('',$line->nip,$detail,$line->ap,
                        $line->kunj_apotek,$line->biaya_apotek,$line->kunj_gigi,$line->biaya_gigi,$line->kunj_lab,$line->biaya_lab,
                        $line->kunj_optik,$line->biaya_optik,$line->kunj_rs,$line->biaya_rs,$line->kunj_umum,$line->biaya_umum,
                        $line->kunj_spesialis,$line->biaya_spesialis,$line->total);
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
        $namaTb = 'biaya_terbesar';
        $jenis = $this->input->get('jenis');
        /*
        if($jenis=='20ot'){
            $jenis='20';
        }else if($jenis='20pt'){
            $jenis=$this->m_laporan->count_20pt()->result();
        }
         * 
         */
        $bulan = $this->input->get('bulan');
        $tahun = $this->input->get('tahun');
        //$tgl1 = $this->input->get('tgl1');
        //$tgl2 = $this->input->get('tgl2');
        $karyawan = $this->input->get('karyawan');
        //$dokter = $this->input->get('dokter');
        $limit = '';
        $sidx  = "a.nip";
	$sord  = "desc";
        $start = '';
        $where = '';
        //$rayon=1;
        $rayon=$this->session->userdata('id_rayon');
        $wilayah=$this->session->userdata('id_wilayah');
        $mitra=$this->session->userdata('id_mitra');
        
        $searchField = isset($_GET['searchField']) ? $_GET['searchField'] : false;
	$searchString = isset($_GET['searchString']) ? $_GET['searchString'] : false;

        //$data1 = $this->m_lab_gigi->get_lab_gigi($where, $sidx, $sord, $limit, $start)->result();
        $data1 = $this->m_laporan->get_biayaTerbesar($searchField,$searchString, $sidx, $sord, $limit, $start,$rayon,$wilayah,$mitra,$bulan,$tahun,$karyawan,$jenis)->result();
	$tulis=$this->excel->setActiveSheetIndex(0);

        $tulis->setCellValue('A1', "NIP");
        $tulis->setCellValue('B1', "Penanggung");
        $tulis->setCellValue('C1', "A/P");
        $tulis->setCellValue('D1', "Kunjungan Apotek");
        $tulis->setCellValue('E1', "Biaya Apotek");
        $tulis->setCellValue('F1', "Kunjungan Gigi");
        $tulis->setCellValue('G1', "Biaya Gigi");
        $tulis->setCellValue('H1', "Kunjungan Lab");
        $tulis->setCellValue('I1', "Biaya Lab");
        $tulis->setCellValue('J1', "Kunjungan Optik");
        $tulis->setCellValue('K1', "Biaya Optik");
        $tulis->setCellValue('L1', "Kunjungan rs");
        $tulis->setCellValue('M1', "Biaya rs");
        $tulis->setCellValue('N1', "Kunjungan Dokter Umum");
        $tulis->setCellValue('O1', "Biaya Dokter Umum");
        $tulis->setCellValue('P1', "Kunjungan Dokter Spesialis");
        $tulis->setCellValue('Q1', "Biaya Dokter Spesialis");
        $tulis->setCellValue('R1', "Total");

        $i=2;
        foreach($data1 as $line)
	{
            $tulis->setCellValue('A'.$i, $line->nip);
            $tulis->setCellValue('B'.$i, $line->nama_karyawan);
            $tulis->setCellValue('C'.$i, $line->ap);
            $tulis->setCellValue('D'.$i, $line->kunj_apotek);
            $tulis->setCellValue('E'.$i, $line->biaya_apotek);
            $tulis->setCellValue('F'.$i, $line->kunj_gigi);
            $tulis->setCellValue('G'.$i, $line->biaya_gigi);
            $tulis->setCellValue('H'.$i, $line->kunj_lab);
            $tulis->setCellValue('I'.$i, $line->biaya_lab);
            //$tulis->setCellValue('K'.$i, $line->nama_item);
            $tulis->setCellValue('J'.$i, $line->kunj_optik);
            $tulis->setCellValue('K'.$i, $line->biaya_optik);
            $tulis->setCellValue('L'.$i, $line->kunj_rs);
            $tulis->setCellValue('M'.$i, $line->biaya_rs);
            $tulis->setCellValue('N'.$i, $line->kunj_umum);
            $tulis->setCellValue('O'.$i, $line->biaya_umum);
            $tulis->setCellValue('P'.$i, $line->kunj_spesialis);
            $tulis->setCellValue('Q'.$i, $line->biaya_spesialis);
            $tulis->setCellValue('R'.$i, $line->total);

            $i++;
	}

      	// Rename worksheet
	$this->excel->getActiveSheet()->setTitle('Laporan '.$namaTb);

	// Set active sheet index to the first sheet, so Excel opens this as the first sheet
	$this->excel->setActiveSheetIndex(0);

	// Redirect output to a client�s web browser (Excel5)
	header('Content-Type: application/vnd.ms-excel');
	header('Content-Disposition: attachment;filename="laporan_'.$namaTb.'_'.date('dMY').'.xls"');
	header('Cache-Control: max-age=0');

	$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
	$objWriter->save('php://output');
    }
    
    function detail()
    {

        //$nip= $this->input->get('nip');
	$data['nip']=$this->input->get('nip');
        $data['bulan']=$this->input->get('bulan');
        $data['tahun']=$this->input->get('tahun');
	$this->load->view('laporan/detailBiayaTerbesar',$data);
    }
    
    function json2() 
    {
        $namaTb = 'detail';
        $nip = $this->input->get('nip');
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
		//$searchField='nama_biayaTerbesar';
                //$searchField='';
                //$searchString=$biayaTerbesar;
                //$searchString='';
                 
	$count = $this->m_laporan->count_detailTerbesar($searchField,$searchString,$rayon,$wilayah,$mitra,$namaTb,$nip,$bulan,$tahun);
		
	$count > 0 ? $total_pages = ceil($count/$limit) : $total_pages = 0;
	if ($page > $total_pages) $page=$total_pages;
	$start = $limit*$page - $limit;
	if($start <0) $start = 0;
		
	$data1 = $this->m_laporan->get_detailTerbesar($searchField,$searchString, $sidx, $sord, $limit, $start,$rayon,$wilayah,$mitra,$namaTb,$nip,$bulan,$tahun)->result();
               
	$responce->page = $page;
	$responce->total = $total_pages;
	$responce->records = $count;
        $responce->bulan = $bulan;
        $responce->tahun = $tahun;
	$i=0;
        
	foreach($data1 as $line)
	{
            $responce->rows[$i]['id_transaksi']   = $line->id_transaksi;
		//$detail="<a href='$line->nip' class='detail_terbesar'>$line->nama_karyawan</a>";	
            $responce->rows[$i]['cell'] = array($line->id_transaksi,$line->nip,$line->nama_karyawan,$line->nama_tertanggung,$line->ap,
                        $line->status,$line->tgl_kunjungan,$line->tgl_transaksi,$line->nama_diagnosa,$line->nama_dokter,$line->nama_item,
                        $line->jumlah,$line->hrg_satuan,$line->total);
            $i++;
	}
	echo json_encode($responce);
    }
    
}