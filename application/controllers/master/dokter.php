<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dokter extends CI_Controller {
	function __construct() {
        parent::__construct();
		$this->load->helper('url'); // Load Helper URL CI
		$this->load->model('m_dokter'); // Load Model m_jqgrid
                $this->load->library(array('excel','validasi'));
    }
	function index() 
	{
		$this->grid(); //Default di arahkan ke function grid
	}
	function grid() 
	{
		$this->load->view('master/dokter'); // Load View jqgrid
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
		
	        		
		$count = $this->m_dokter->count_dokter($where);
		
		$count > 0 ? $total_pages = ceil($count/$limit) : $total_pages = 0;
		if ($page > $total_pages) $page=$total_pages;
		$start = $limit*$page - $limit;
		if($start <0) $start = 0;
		
		$data1 = $this->m_dokter->get_dokter($where, $sidx, $sord, $limit, $start)->result();
	
		$responce->page = $page;
		$responce->total = $total_pages;
		$responce->records = $count;
		$i=0;
		foreach($data1 as $line)
		{
			$responce->rows[$i]['id_dokter']   = $line->id_dokter;
			
			
			
			$responce->rows[$i]['cell'] = array($line->id_dokter,$line->nama_dokter,$line->langg_dokter,$line->kat_nama,$line->gol_nama,$line->tarif_dokter,null);
			$i++;
		}
		echo json_encode($responce);
	}

        function get_goldokter()
        {
            //echo "<select><option value='1'>Bismillah</option><option value='2'>Alhamdulillah</option></select>";

            $responce->value[1]='satu';
            $responce->value[2]='dua';
            echo json_encode($responce);
        }

	function crud() 
	{
		$oper=$this->input->post('oper');
		$id_dokter=$this->input->post('id');
		$nama_dokter=$this->input->post('nama_dokter');
		$langg_dokter=$this->input->post('langg_dokter');
		$kat_dokter=$this->input->post('kat_dokter');
		$gol_dokter=$this->input->post('gol_dokter');
		$tarif_dokter=$this->input->post('tarif_dokter');
		
		
		
	    switch ($oper) 
		{
	        case 'add':
				$datanya=array('nama_dokter'=>$nama_dokter,'langg_dokter'=>$langg_dokter,'kat_dokter'=>$kat_dokter,'gol_dokter'=>$gol_dokter,'tarif_dokter'=>$tarif_dokter);
				$this->m_dokter->insert_dokter($datanya);
				break;
	        case 'edit':
	            $datanya=array('nama_dokter'=>$nama_dokter,'langg_dokter'=>$langg_dokter,'kat_dokter'=>$kat_dokter,'gol_dokter'=>$gol_dokter,'tarif_dokter'=>$tarif_dokter);
				$this->m_dokter->update_dokter($id_dokter, $datanya);
	            break;
	        case 'del':
	            $this->m_dokter->delete_dokter($id_dokter);
	        break;
		}
	}

        function ekspor()
	{



	error_reporting(E_ALL);

	date_default_timezone_set('Europe/London');

	// Add some data
                $limit = null;
		$sidx  = "id_dokter";
		$sord  = "desc";
                $start = null;
                $where = null;

        $data1 = $this->m_dokter->get_dokter($where, $sidx, $sord, $limit, $start)->result();
	$tulis=$this->excel->setActiveSheetIndex(0);

                        $tulis->setCellValue('A1', "No");
                        $tulis->setCellValue('B1', "Id Dokter");
                        $tulis->setCellValue('C1', "Nama Dokter");
                        $tulis->setCellValue('D1', "Langganan");
                        $tulis->setCellValue('E1', "Kategori");
                        $tulis->setCellValue('F1', "Golongan");
                        $tulis->setCellValue('G1', "Tarif");


        $i=2;
        foreach($data1 as $line)
		{
						$tulis->setCellValue('A'.$i, $i-1);
                        $tulis->setCellValue('B'.$i, $line->id_dokter);
                        $tulis->setCellValue('C'.$i, $line->nama_dokter);
                        $tulis->setCellValue('D'.$i, $line->langg_dokter);
                        $tulis->setCellValue('E'.$i, $line->kat_dokter);
                        $tulis->setCellValue('F'.$i, $line->gol_dokter);
                        $tulis->setCellValue('G'.$i, $line->tarif_dokter);

			$i++;
		}


      	// Rename worksheet
	$this->excel->getActiveSheet()->setTitle('Dokter');


	// Set active sheet index to the first sheet, so Excel opens this as the first sheet
	$this->excel->setActiveSheetIndex(0);


	// Redirect output to a client�s web browser (Excel5)
	header('Content-Type: application/vnd.ms-excel');
	header('Content-Disposition: attachment;filename="Master Dokter.xls"');
	header('Cache-Control: max-age=0');

	$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
	$objWriter->save('php://output');
	//exit;
	}

        function impor()
	{

        $data['data']='dokter';
	$this->load->view('impor/impor',$data);
	}
        function do_impor()
	{
	$error = '';
	$pesan= '';
	$fileElementName = 'uploaddokter';

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
                            if(!$this->validasi->cekLengthString($data[$i]['A'],50))
                            {
                                $error="Data Nama Dokter di baris ke".$i." terlalu Banyak";
                                break;
                            }
                            else if(!$this->validasi->cekLengthString($data[$i]['B'],5))
                            {

                                $error="Data Langganan di baris ke".$i." terlalu Banyak. Data ini hanya boleh berisi ya atau tidak";
                            }
                            else if(!$this->validasi->cekLengthString($data[$i]['C'],10))
                            {

                                $error="Data Tarif Dokter di baris ke".$i." Harus y atau t";
                            }
                            else if(!$this->validasi->cekLengthString($data[$i]['D'],10))
                            {

                                $error="Data Tarif Standar di baris ke".$i." terlalu Banyak";
                            }
                            else if(!$this->validasi->cekLengthString($data[$i]['E'],9))
                            {

                                $error="Data Gol Dokter di baris ke".$i." terlalu Banyak. Data ini hanya boleh dak, rmh sakit dan klinik";
                            }
                            else if(!$this->validasi->cekLengthString($data[$i]['F'],20))
                            {

                                $error="Data Kategori Dokter di baris ke".$i." terlalu Banyak";
                            }
                            else if(!is_numeric($data[$i]['C']))
                            {
                                $error ="Data Tarif Dokter harus Angka";
                            }
                            else if(!is_numeric($data[$i]['D']))
                            {
                                $error ="Data Tarif Dokter harus Angka";
                            }
                            else{
                            $dataexcel[$i-1]['nama_dokter'] = $data[$i]['A'];
                            $langgdokter=strtolower($data[$i]['B']);
                            if($langgdokter == 'ya')
                            {
                                $langgdokter = 'y';
                            }
                            else
                            {
                                $langgdokter = 't';
                            }
                            $dataexcel[$i-1]['langg_dokter'] = $langgdokter;
                            $dataexcel[$i-1]['tarif_dokter'] = $data[$i]['C'];
                            $dataexcel[$i-1]['tarif_standar'] = $data[$i]['D'];

                            $gol_dokter=strtolower($data[$i]['E']);
                            if($gol_dokter == 'dak')
                            {
                                $gol_dokter=1;
                            }
                            else if($gol_dokter == 'klinik')
                            {
                                $gol_dokter=3;
                            }
                            else
                            {
                                $gol_dokter=2;
                            }

                            $dataexcel[$i-1]['gol_dokter'] = $gol_dokter;
                            $kat_dokter=strtolower($data[$i]['F']);

                            if($kat_dokter == 'spesialis')
                            {
                                $kat_dokter = 1;
                            }
                            else if($kat_dokter == 'umum')
                            {
                                $kat_dokter = 2;
                            }
                            else if($kat_dokter == 'gigi')
                            {
                                $kat_dokter = 3;
                            }
                            else if($kat_dokter == 'laboratorium')
                            {
                                $kat_dokter = 4;
                            }
                            else if($kat_dokter == 'dak')
                            {
                                $kat_dokter = 5;
                            }
                            else if($kat_dokter == 'rumah sakit')
                            {
                                $kat_dokter = 6;
                            }
                            else
                            {
                                $error .="Data Kategori dibaris".$i." Dokter Tidak Ada. Data hanya boleh spesialis, umum, gigi, laboratorium, dak dan rumah sakit";
                                break;

                            }

                            $dataexcel[$i-1]['kat_dokter'] = $kat_dokter;
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
                                     $this->m_dokter->insert_dokter($dataexcel[$i]);

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

        function gol_dokter()
        {
            $data[1]='DAK';
            $data[2]='Rumah Sakit';
            $data[3]='Klinik';
            $hai='';
            for($i=1;$i<=3;$i++)
            {
                if($i==3)
                {
                    $hai=$hai.$i.':'.$data[$i].'';
                }
                else
                {
                    $hai=$hai.$i.':'.$data[$i].';';
                }
            }
            //echo "{1:'DAK',2:'Rumah Sakit',3:'Klinik'}";
            echo $hai;

        }

}