<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tertanggung extends CI_Controller {
	function __construct() {
        parent::__construct();
		$this->load->helper('url'); // Load Helper URL CI
		
		$this->load->model(array('m_tran_dokter','m_status_karyawan','m_bagian','m_tertanggung','m_rayon','m_karyawan')); // Load Model m_jqgrid
                $this->load->library(array('excel','validasi'));
    }
	function index() 
	{
		$this->grid(); //Default di arahkan ke function grid
	}
	function grid() 
	{
                
		$this->load->view('master/tertanggung'); // Load View jqgrid
	}
	
	function add()
	{
		//$bagian=$this->m_bagian->count_bagian("");
                $data['karyawan']=$this->m_karyawan->get_allkaryawan()->result();
		$data['bagian'] = $this->m_bagian->ambil_bagian();
		$data['rayon']=$this->m_rayon->get_allrayon();
		$this->load->view('master/tertanggungadd',$data);
	}
	
	function json() 
	{
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
		if ($_GET['_search'] == 'true') 
		{
			$where = array($searchField => $searchString);
		}
		# End #
		
	        		
		$count = $this->m_tertanggung->count_tertanggung($where, $sidx, $sord,$rayon,$wilayah,$mitra,$searchField,$searchString);
		
		$count > 0 ? $total_pages = ceil($count/$limit) : $total_pages = 0;
		if ($page > $total_pages) $page=$total_pages;
		$start = $limit*$page - $limit;
		if($start <0) $start = 0;
		
		$data1 = $this->m_tertanggung->get_tertanggung($where, $sidx, $sord, $limit, $start,$rayon,$wilayah,$mitra,$searchField,$searchString)->result();
	
		$responce->page = $page;
		$responce->total = $total_pages;
		$responce->records = $count;
		$i=0;
		foreach($data1 as $line)
		{
			$responce->rows[$i]['id_tertanggung']   = $line->id_tertanggung;
			$responce->rows[$i]['cell'] = array($line->id_tertanggung,$line->nama_tertanggung,$line->sex,$line->tgl_lahir,$line->status,$line->usia,$line->nama_karyawan,$line->ditanggung);
			$i++;
		}
		echo json_encode($responce);
	}
	function crud() 
	{
		$oper=$this->input->post('oper');
		$id_tertanggung=$this->input->post('id');
		$nama_tertanggung=$this->input->post('nama_tertanggung');
		//$id_karyawan=$this->input->post('penanggung_tertanggung');
		$id_karyawan=$this->input->post('id_karyawan_tertanggung');
		$alamat_tertanggung=$this->input->post('alamat_tertanggung');
		$sex_tertanggung=$this->input->post('sex_tertanggung');
		$ttl_tertanggung = null;
                $tgl_tertanggung=$this->input->post('tgl_lahir_tertanggung');
                if($tgl_tertanggung!='')
                {
                  $ttl_tertanggung = $tgl_tertanggung;
                }
		//$ap_tertanggung=$this->input->post('ap_tertanggung');
		$status_tertanggung=$this->input->post('status_tertanggung');
		$ditanggung_tertanggung=$this->input->post('ditanggung_tertanggung');
		echo "Bismillah";
		
	    switch ($oper) 
		{
	        case 'add':
				$datanya=array('nama_tertanggung'=>$nama_tertanggung,'id_karyawan'=>$id_karyawan,'sex'=>$sex_tertanggung,'tgl_lahir'=>$ttl_tertanggung,'status'=>$status_tertanggung,'ditanggung'=>$ditanggung_tertanggung);
				$this->m_tertanggung->insert_tertanggung($datanya);
				break;
	        case 'edit':
                                $datanya=array('nama_tertanggung'=>$nama_tertanggung,'id_karyawan'=>$id_karyawan,'sex'=>$sex_tertanggung,'tgl_lahir'=>$ttl_tertanggung,'status'=>$status_tertanggung,'ditanggung'=>$ditanggung_tertanggung);
				$this->m_tertanggung->update_tertanggung($id_tertanggung, $datanya);
	                        break;
	        case 'del':
                                $this->m_tertanggung->delete_tertanggung($id_tertanggung);
                                break;
		}
        
	}
        function impor()
	{

        $data['data']='tertanggung';
	$this->load->view('impor/impor',$data);
	}
        function do_impor()
	{
	$error = '';
	$pesan= '';
	$fileElementName = 'uploadtertanggung';

	if(!empty($_FILES[$fileElementName]['error']))
	{
		switch($_FILES[$fileElementName]['error'])
		{

			case '1':
				$error = 'The uploaded file exceeds the upload_max_filesize directive in php.ini';
				break;
			case '2':
				$error = 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form';
				break;
			case '3':
				$error = 'The uploaded file was only partially uploaded';
				break;
			case '4':
				$error = 'No file was uploaded.';
				break;

			case '6':
				$error = 'Missing a temporary folder';
				break;
			case '7':
				$error = 'Failed to write file to disk';
				break;
			case '8':
				$error = 'File upload stopped by extension';
				break;
			case '999':
			default:
				$error = 'No error code avaiable';
		}
	}
	elseif(empty($_FILES[$fileElementName]['tmp_name']) || $_FILES[$fileElementName]['tmp_name'] == 'none')
	{
		$error = 'No file was uploaded..';
	}
	else
	{
                        $pesan .= " File Name: " . $_FILES[$fileElementName]['name'] . ", ";
			$pesan .= " File Size: " . @filesize($_FILES[$fileElementName]['tmp_name']);

			//for security reason, we force to remove all uploaded file
			@unlink($_FILES[$fileElementName]);

			$config['upload_path'] = './temp_upload/';
			$config['allowed_types'] = 'xls';

			$this->load->library('upload', $config);
			//$tes=$this->upload->do_upload();

                        if ( ! $this->upload->do_upload($fileElementName))
			{
                           $data = array('error' => $this->upload->display_errors());
                           $error="Insert failed. Please check your file, only .xls file allowed.";
                        }
			else
			{   $upload_data = $this->upload->data();
                            $file =  $upload_data['full_path'];
                            error_reporting(E_ALL ^ E_NOTICE);
                            $inputFileName = $file;
                            $objReader = new PHPExcel_Reader_Excel5();
                            $objPHPExcel = $objReader->load($file);
                            $data = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);

                            //$data = $this->excel_reader->sheets[0] ;
                            $dataexcel = Array();

                            for ($i = 2; $i <= count($data); $i++)
                            {
                            if($data[$i]['A'] == '') break;
                            if(!$this->validasi->cekLengthString($data[$i]['A'],45))
                            {
                                $error="Data Nama Tertanggung di baris ke".$i." terlalu Banyak";
                                break;
                            }
                            else if(!$this->validasi->cekLengthString($data[$i]['B'],1))
                            {

                                $error="Data Jenis Kelamin di baris ke".$i." hanya boleh l atau p";
                                break;
                            }
                            else if(!$this->validasi->cekLengthString($data[$i]['C'],6))
                            {

                                $error="Data Status di baris ke".$i." hanya boleh diisi anak, istri, ybs";
                                break;
                            }
                            else if(!$this->validasi->cekLengthString($data[$i]['D'],100))
                            {

                                $error="Data Alamat di baris ke".$i." terlalu Banyak";
                                break;
                            }
                            else if(!$this->validasi->cekLengthString($data[$i]['E'],3))
                            {

                                $error="Data Usia di baris ke".$i." terlalu Banyak";
                                break;
                            }
                            else if(!$this->validasi->cekLengthString($data[$i]['G'],8))
                            {

                                $error="Data Jenis Kelamin di baris ke".$i." terlalu Banyak";
                                break;
                            }
                            else if(!$this->validasi->cekLengthString($data[$i]['B'],8))
                            {

                                $error="Data Jenis Kelamin di baris ke".$i." terlalu Banyak";
                                break;
                            }
                            
                            $dataexcel[$i-1]['nama_tertanggung'] = $data[$i]['A'];
                            $dataexcel[$i-1]['sex'] = $data[$i]['B'];
                            $dataexcel[$i-1]['ttl'] = $data[$i]['D'];
                            $dataexcel[$i-1]['status'] = $data[$i]['C'];
                            $dataexcel[$i-1]['usia'] = $data[$i]['E'];
                            $dataexcel[$i-1]['ditanggung'] = $data[$i]['G'];
                            $id_karyawan = $data[$i]['F'];
                            if($id_karyawan != null)
                            {
                                $cari_id = $this->m_karyawan->cek_karyawan($id_karyawan);
                                if(count($cari_id) == 1)
                                      {
                                          $id_karyawan = $cari_id[0]['id_karyawan'];

                                      }
                                else if(count($cari_id) > 1)
                                {
                                    $error ="Data karyawan nip".$id_karyawan." dobel";
                                }
                                else
                                {
                                    $error ="Tidak ada data karyawan dengan nip".$id_karyawan;
                                }
                            }

                            $dataexcel[$i-1]['id_karyawan'] = $id_karyawan;
                            
                            }

                            $check=$data[2]['A'];
                            $data['check']=$check;
                            if ($check == "")
                            {
                            $error="Data Tidak Ada";
                            }
                            else if($error == '')
                            {

                            //$pesan.=count($dataexcel);
                            $this->db->trans_start();
                            for($i=1;$i<=count($dataexcel);$i++)
                            {
                             try
                             {
                                     $this->m_tertanggung->insert_tertanggung($dataexcel[$i]);

                             }
                             catch(Exception $e)
                             {
                                 $error=$e->getMessage();
                             }
                            }
                            $this->db->trans_complete();
                            //$pesan=$this->db->trans_status();
                            }

			}
        }

          $data['error']=$error;
          $data['pesan']=$pesan;
          echo json_encode($data);
	}

        function ekspor()
	{

	error_reporting(E_ALL);

	date_default_timezone_set('Europe/London');

	// Add some data
                $page  = NULL;
		$limit = $this->input->get('rows');
		$sidx  = $this->input->get('sidx');
		$sidx  = "id_tertanggung";
		$sord  = "desc";

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
		}
                 *
                 */

                $start = null;
                $where = null;

                $data1 = $this->m_tertanggung->get_tertanggung($where, $sidx, $sord, $limit, $start,$rayon,$wilayah,$mitra,$searchField,$searchString)->result();
                $tulis=$this->excel->setActiveSheetIndex(0);

                        $tulis->setCellValue('A1', "No");
                        $tulis->setCellValue('B1', "NAMA");
                        $tulis->setCellValue('C1', "ID");
                        $tulis->setCellValue('D1', "JK");
                        $tulis->setCellValue('E1', "STATUS");
                        $tulis->setCellValue('F1', "TGL LAHIR");
                        $tulis->setCellValue('G1', "USIA");
                        $tulis->setCellValue('H1', "NAMA PENANGGUNG");
                        $tulis->setCellValue('I1', "DITANGGUNG");

        $tulis->getStyle('A1')->getFont()->setSize(16);
        $tulis->getStyle('B1')->getFont()->setSize(16);
        $tulis->getStyle('C1')->getFont()->setSize(16);
        $tulis->getStyle('D1')->getFont()->setSize(16);
        $tulis->getStyle('E1')->getFont()->setSize(16);
        $tulis->getStyle('F1')->getFont()->setSize(16);
        $tulis->getStyle('G1')->getFont()->setSize(16);
        $tulis->getStyle('H1')->getFont()->setSize(16);
        $i=2;
        foreach($data1 as $line)
		{
			$tulis->setCellValue('A'.$i, $i-1);
                        $tulis->setCellValue('B'.$i, $line->nama_tertanggung);
                        $tulis->setCellValue('C'.$i, $line->id_tertanggung);
                        $tulis->setCellValue('D'.$i, $line->sex);
                        $tulis->setCellValue('E'.$i, $line->status);
                        $tulis->setCellValue('F'.$i, $line->tgl_lahir);
                        $tulis->setCellValue('G'.$i, $line->usia);
                        $tulis->setCellValue('H'.$i, $line->nama_karyawan);
                        $tulis->setCellValue('I'.$i, $line->ditanggung);

			$i++;
		}


      	// Rename worksheet
	$this->excel->getActiveSheet()->setTitle('Data Tertanggung');


	// Set active sheet index to the first sheet, so Excel opens this as the first sheet
	$this->excel->setActiveSheetIndex(0);


	// Redirect output to a client�s web browser (Excel5)
	header('Content-Type: application/vnd.ms-excel');
	header('Content-Disposition: attachment;filename="Master Data Tertanggung.xls"');
	header('Cache-Control: max-age=0');

	$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
	$objWriter->save('php://output');
	//exit;
	}
        function karyawan()
        {
                $rayon=$this->session->userdata('id_rayon');
                //$rayon=1;
                $wilayah=$this->session->userdata('id_wilayah');

                $mitra=$this->session->userdata('id_mitra');
                $data1 = $this->m_karyawan->get_karyawan(null, null, null, null, null,$rayon,$wilayah,$mitra,null,null)->result_array();
                $i=0;
                $data="";
                $jum = count($data1);
                for($i;$i<$jum;$i++)
                {
                    if($i>0)
                    {
                        $data .=";";
                    }
                    $data .= $data1[$i]['id_karyawan'].":".$data1[$i]['nama_karyawan'];
                }
            echo $data;
        }

        function lookpegawai()
    {
                $rayon=$this->session->userdata('id_rayon');
                //$rayon=1;
                $wilayah=$this->session->userdata('id_wilayah');

                $mitra=$this->session->userdata('id_mitra');
        $keyword = $this->input->post('term');
        $data['response'] = 'false';
        $query = $this->m_karyawan->get_karyawan(null,null,null,10,0,$rayon,$wilayah,$mitra,'nama_karyawan',$keyword)->result_array();
        //$query = $this->m_tran_dokter->caripegawai($keyword);
        
        if( ! empty($query) )
        {
            $data['response'] = 'true';
            $data['message'] = array();
            foreach( $query as $row )
            {
                $data['message'][] = array(
                                        'id'=>  $row['id_karyawan'],
                                        'value' => $row['nama_karyawan'],
                                        'bagian' => $row['id_bagian'],
                                        'nip' => $row['nip']
                                     );
            }
        }
        echo json_encode($data);
    }

}