<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dosis extends CI_Controller {
	function __construct() {
        parent::__construct();
		$this->load->helper('url'); // Load Helper URL CI
		$this->load->model('m_dosis'); // Load Model m_jqgrid
                $this->load->library(array('excel','validasi'));
    }
	function index() 
	{
		$this->grid(); //Default di arahkan ke function grid
	}
	function grid() 
	{
		$this->load->view('master/dosis'); // Load View jqgrid
	}
	function json() 
	{
		$page  = $this->input->get('page');
		$limit = $this->input->get('rows');
		$sidx  = $this->input->get('sidx');
		$sord  = $this->input->get('sord');
		
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
		
	        		
		$count = $this->m_dosis->count_dosis($where);
		
		$count > 0 ? $total_pages = ceil($count/$limit) : $total_pages = 0;
		if ($page > $total_pages) $page=$total_pages;
		$start = $limit*$page - $limit;
		if($start <0) $start = 0;
		
		$data1 = $this->m_dosis->get_dosis($where, $sidx, $sord, $limit, $start)->result();
	
		$responce->page = $page;
		$responce->total = $total_pages;
		$responce->records = $count;
		$i=0;
		foreach($data1 as $line)
		{
			$responce->rows[$i]['id_dosis']   = $line->id_dosis;
			$responce->rows[$i]['cell'] = array($line->id_dosis,$line->nama_dosis,$line->jml_dosis);
			$i++;
		}
		echo json_encode($responce);
	}
	function crud() 
	{
		$oper=$this->input->post('oper');
		$id_dosis=$this->input->post('id');
		$nama_dosis=$this->input->post('nama_dosis');
		$jml_dosis=$this->input->post('jml_dosis');
		
		
		
	    switch ($oper) 
		{
	        case 'add':
				$datanya=array('nama_dosis'=>$nama_dosis,'jml_dosis'=>$jml_dosis);
				$this->m_dosis->insert_dosis($datanya);
				break;
	        case 'edit':
	            $datanya=array('nama_dosis'=>$nama_dosis,'jml_dosis'=>$jml_dosis);
				$this->m_dosis->update_dosis($id_dosis, $datanya);
	            break;
	        case 'del':
	            $this->m_dosis->delete_dosis($id_dosis);
	        break;
		}
	}

        function impor()
	{

        $data['data']='dosis';
	$this->load->view('impor/impor',$data);
	}

        function do_impor()
	{
	$error = "";
	$pesan="";
	$fileElementName = 'uploaddosis';

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
			{
                            $upload_data = $this->upload->data();
                            $file =  $upload_data['full_path'];
                            error_reporting(E_ALL ^ E_NOTICE);

                            
                            $inputFileName = $file;
                            $objReader = new PHPExcel_Reader_Excel5();
                            $objPHPExcel = $objReader->load($file);
                            $data = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);

                            $dataexcel = Array();
                            for ($i = 2; $i <= count($data); $i++)
                            {
                            if($data[$i]['A'] == '') break;
                            if(!$this->validasi->cekLengthString($data[$i]['A'],50))
                            {
                                $error="Data Nama Dosis di baris ke".$i." terlalu Banyak";
                            }
                            else if(!$this->validasi->cekLengthString($data[$i]['B'],50))
                            {

                                $error="Data Jumlah Dosis di baris ke".$i." terlalu Banyak";
                            }
                            else {
                            $dataexcel[$i-1]['nama_dosis'] = $data[$i]['A'];
                            $dataexcel[$i-1]['jml_dosis'] = $data[$i]['B'];

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
                            $this->db->trans_start();
                            for($i=1;$i<=count($dataexcel);$i++)
                            {

                            try
                            {
                            $this->m_dosis->insert_dosis($dataexcel[$i]);
                            }
                            catch(Exception $e)
                            {
                                 $error=$e->getMessage();
                            }
                            }
                            $this->db->trans_complete();
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
                $limit = null;
		$sidx  = "id_dosis";
		$sord  = "desc";
                $start = null;
                $where = null;

        $data1 = $this->m_dosis->get_dosis($where, $sidx, $sord, $limit, $start)->result();
	$tulis=$this->excel->setActiveSheetIndex(0);

                        $tulis->setCellValue('A1', "No");
                        $tulis->setCellValue('B1', "Id Dosis");
                        $tulis->setCellValue('C1', "Nama Dosis");
                        $tulis->setCellValue('D1', "Jml Dosis");


        $i=2;
        foreach($data1 as $line)
		{
						$tulis->setCellValue('A'.$i, $i-1);
                        $tulis->setCellValue('B'.$i, $line->id_dosis);
                        $tulis->setCellValue('C'.$i, $line->nama_dosis);
                        $tulis->setCellValue('D'.$i, $line->jml_dosis);

			$i++;
		}


      	// Rename worksheet
	$this->excel->getActiveSheet()->setTitle('Dosis');


	// Set active sheet index to the first sheet, so Excel opens this as the first sheet
	$this->excel->setActiveSheetIndex(0);


	// Redirect output to a client�s web browser (Excel5)
	header('Content-Type: application/vnd.ms-excel');
	header('Content-Disposition: attachment;filename="Master Dosis.xls"');
	header('Cache-Control: max-age=0');

	$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
	$objWriter->save('php://output');
	//exit;
	}

}