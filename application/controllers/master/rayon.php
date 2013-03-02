<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rayon extends CI_Controller {
	function __construct() {
        parent::__construct();
		$this->load->helper('url'); // Load Helper URL CI
		$this->load->model(array('m_mitra','m_rayon','m_wilayah')); // Load Model m_jqgrid
                $this->load->library(array('excel','validasi'));
    }
	function index() 
	{
		$this->grid(); //Default di arahkan ke function grid
	}
	function grid() 
	{
		$this->load->view('master/rayon'); // Load View jqgrid
	}
	
	function getwilayah()
	{
	 
        $index = $this->input->post('id');
	    $wilayah = $this->m_wilayah->get_allwilayah($index);
        //$wilayah = $this->m_wilayah->get_wil(2);
        if( ! empty($wilayah) )
        {
			echo "<option value= >Pilih Wilayah</option>";
            foreach( $wilayah as $row )
            {
                echo "<option value=";
                echo $row->id_wilayah;
                echo ">";
                echo $row->nama_wilayah;
                echo "</option>";
            }
        }
	}
	
	function add()
	{
		$data['mitra']=$this->m_mitra->get_allmitra()->result_array();
		$this->load->view('master/rayonadd',$data);
	}
	
	function edit()
	{
	
		$this->load->view('master/editrayon');
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
		
	        		
		$count = $this->m_rayon->count_rayon($where);
		
		$count > 0 ? $total_pages = ceil($count/$limit) : $total_pages = 0;
		if ($page > $total_pages) $page=$total_pages;
		$start = $limit*$page - $limit;
		if($start <0) $start = 0;
		
		$data1 = $this->m_rayon->get_namarayon($searchField,$searchString, $sidx, $sord, $limit, $start,$rayon,$wilayah,$mitra)->result();
	
		$responce->page = $page;
		$responce->total = $total_pages;
		$responce->records = $count;
		$i=0;
		foreach($data1 as $line)
		{
			$responce->rows[$i]['id_rayon']   = $line->id_rayon;
			$responce->rows[$i]['cell'] = array($line->id_rayon,$line->nama_rayon,$line->nama_wilayah);
			$i++;
		}
		echo json_encode($responce);
	}
	
	function tes()
	{
	echo "Hai";
	}
	
	function crud() 
	{
		$oper=$this->input->post('oper');
		$id_rayon=$this->input->post('id');
		$nama_rayon=$this->input->post('nama_rayon');
		$id_wilayah=$this->input->post('id_wilayah');
		
	    switch ($oper) 
		{
	        case 'add':
				$datanya=array('nama_rayon'=>$nama_rayon,'id_wilayah'=>$id_wilayah);
				$this->m_rayon->insert_rayon($datanya);
				break;
	        case 'edit':
	            $datanya=array('nama_rayon'=>$nama_rayon,'id_wilayah'=>$id_wilayah);
				$this->m_rayon->update_rayon($id_rayon, $datanya);
	            break;
	        case 'del':
	            $this->m_rayon->delete_rayon($id_rayon);
	        break;
		}
		
	}

        function impor()
	{

        $data['data']='rayon';
	$this->load->view('impor/impor',$data);
	}
        function do_impor()
	{
	$error = '';
	$pesan= '';
	$fileElementName = 'uploadrayon';

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
                            if(!$this->validasi->cekLengthString($data[$i]['A'],100))
                            {
                                $error="Data Nama Rayon di baris ke".$i." terlalu Banyak";
                            }
                            else if(!$this->validasi->cekLengthString($data[$i]['B'],8))
                            {

                                $error="Data id_wilayah Provider di baris ke".$i." terlalu Banyak";
                            }
                            else if($data[$i]['B'] == null)
                            {

                                $error="Data id_wilayah harus ada isinya";
                            }
                            else{
                            $dataexcel[$i-1]['nama_rayon'] = $data[$i]['A'];
                            $dataexcel[$i-1]['id_wilayah'] = $data[$i]['B'];
                            }
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
                                     $this->m_rayon->insert_rayon($dataexcel[$i]);

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
        $where=null;
        $sidx="id_rayon";
        $sord="desc";
        $limit=null;
        $start=null;
                $data1 = $this->m_rayon->get_rayon($where, $sidx, $sord, $limit, $start)->result();
                    $tulis=$this->excel->setActiveSheetIndex(0);

                        $tulis->setCellValue('A1', "No");
                        $tulis->setCellValue('B1', "ID RAYON");
                        $tulis->setCellValue('C1', "NAMA RAYON");

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
                        $tulis->setCellValue('B'.$i, $line->id_rayon);
                        $tulis->setCellValue('C'.$i, $line->nama_rayon);

			$i++;
		}


      	// Rename worksheet
	$this->excel->getActiveSheet()->setTitle('Data Rayon');


	// Set active sheet index to the first sheet, so Excel opens this as the first sheet
	$this->excel->setActiveSheetIndex(0);


	// Redirect output to a client�s web browser (Excel5)
	header('Content-Type: application/vnd.ms-excel');
	header('Content-Disposition: attachment;filename="Master Data Rayon.xls"');
	header('Cache-Control: max-age=0');

	$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
	$objWriter->save('php://output');
	//exit;
	}
        function wilayah()
        {
                $rayon=$this->session->userdata('id_rayon');
                //$rayon=1;
                $wilayah=$this->session->userdata('id_wilayah');

                $mitra=$this->session->userdata('id_mitra');
                $data1 = $this->m_wilayah->get_namaWilayah(null,null, null, null,null,null,$wilayah,$mitra)->result_array();
                $i=0;
                $data="";
                $jum = count($data1);
                for($i;$i<$jum;$i++)
                {
                    if($i>0)
                    {
                        $data .=";";
                    }
                    $data .= $data1[$i]['id_wilayah'].":".$data1[$i]['nama_wilayah'];
                }
            echo $data;
        }


}