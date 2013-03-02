<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Polifarmasi extends CI_Controller {
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
	$this->load->view('laporan/polifarmasi'); //Default di arahkan ke function grid

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
        $namaTb = $this->input->get('namaTb');
        $jenis = $this->input->get('jenis');
        $bulan = $this->input->get('bulan');
        $tahun = $this->input->get('tahun');
        $tgl1 = $this->input->get('tgl1');
        $tgl2 = $this->input->get('tgl2');
        $karyawan = $this->input->get('karyawan');
        $dokter = $this->input->get('dokter');
	$page  = $this->input->get('page');
	$limit = $this->input->get('rows');
	$sidx  = $this->input->get('sidx');
	$sord  = $this->input->get('sord');
	$rayon=$this->session->userdata('id_rayon');
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
		//$searchField='nama_polifarmasi';
                //$searchField='';
                //$searchString=$polifarmasi;
                //$searchString='';
                 
	$count = $this->m_laporan->count_data($searchField,$searchString,$rayon,$wilayah,$mitra,$namaTb,$jenis,$bulan,$tahun,$tgl1,$tgl2,$karyawan,$dokter);
		
	$count > 0 ? $total_pages = ceil($count/$limit) : $total_pages = 0;
	if ($page > $total_pages) $page=$total_pages;
	$start = $limit*$page - $limit;
	if($start <0) $start = 0;
		
	$data1 = $this->m_laporan->get_data($searchField,$searchString, $sidx, $sord, $limit, $start,$rayon,$wilayah,$mitra,$namaTb,$jenis,$bulan,$tahun,$tgl1,$tgl2,$karyawan,$dokter)->result();
               
	$responce->page = $page;
	$responce->total = $total_pages;
	$responce->records = $count;
        $responce->bulan = $bulan;
        $responce->tahun = $tahun;
	$i=0;
	foreach($data1 as $line)
	{
            $responce->rows[$i]['id_transaksi']   = $line->id_transaksi;
			$detail="<a href='$line->id_transaksi' class='detail_poli'><span class='ui-icon ui-icon-document'></span></a>";
            $responce->rows[$i]['cell'] = array($line->id_transaksi,$line->tgl_transaksi,$line->tgl_kunjungan,
                                $line->nip,$line->nama_karyawan,$line->ap,$line->nama_tertanggung,$line->status,
                                $line->nama_dokter,$line->biaya,$line->jumlah_item,$line->selisih,$detail);
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
        $namaTb = $this->input->get('namaTb');
        $jenis = $this->input->get('jenis');
        $bulan = $this->input->get('bulan');
        $tahun = $this->input->get('tahun');
        $tgl1 = $this->input->get('tgl1');
        $tgl2 = $this->input->get('tgl2');
        $karyawan = $this->input->get('karyawan');
        $dokter = $this->input->get('dokter');
        $limit = '';
        $sidx  = "id_transaksi";
	$sord  = "desc";
        $start = '';
        $where = '';
        $rayon=$this->session->userdata('id_rayon');
        $wilayah=$this->session->userdata('id_wilayah');
        $mitra=$this->session->userdata('id_mitra');
        
        $searchField = isset($_GET['searchField']) ? $_GET['searchField'] : false;
	$searchString = isset($_GET['searchString']) ? $_GET['searchString'] : false;

        //$data1 = $this->m_lab_gigi->get_lab_gigi($where, $sidx, $sord, $limit, $start)->result();
        $data1 = $this->m_laporan->get_data($searchField,$searchString, $sidx, $sord, $limit, $start,$rayon,$wilayah,$mitra,$namaTb,$jenis,$bulan,$tahun,$tgl1,$tgl2,$karyawan,$dokter)->result();
	$tulis=$this->excel->setActiveSheetIndex(0);

        $tulis->setCellValue('A1', "ID Transaksi");
        $tulis->setCellValue('B1', "Tgl. Transaksi");
        $tulis->setCellValue('C1', "Tgl. Kunjungan");
        $tulis->setCellValue('D1', "NIP");
        $tulis->setCellValue('E1', "Penanggung");
        $tulis->setCellValue('F1', "A/P");
        $tulis->setCellValue('G1', "Pasien");
        $tulis->setCellValue('H1', "Status");
        $tulis->setCellValue('I1', "Dokter");
        $tulis->setCellValue('J1', "Biaya");
        $tulis->setCellValue('K1', "Jml. Item");
        $tulis->setCellValue('L1', "Selisih");

        $i=2;
        foreach($data1 as $line)
	{
            $tulis->setCellValue('A'.$i, $line->id_transaksi);
            $tulis->setCellValue('B'.$i, $line->tgl_transaksi);
            $tulis->setCellValue('C'.$i, $line->tgl_kunjungan);
            $tulis->setCellValue('D'.$i, $line->nip);
            $tulis->setCellValue('E'.$i, $line->nama_karyawan);
            $tulis->setCellValue('F'.$i, $line->ap);
            $tulis->setCellValue('G'.$i, $line->nama_tertanggung);
            $tulis->setCellValue('H'.$i, $line->status);
            $tulis->setCellValue('I'.$i, $line->nama_dokter);
            $tulis->setCellValue('J'.$i, $line->biaya);
            $tulis->setCellValue('K'.$i, $line->jumlah_item);
            $tulis->setCellValue('L'.$i, $line->selisih);

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
}