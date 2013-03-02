<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Item extends CI_Controller {
	function __construct() {
        parent::__construct();
		$this->load->helper('url'); // Load Helper URL CI
		
		$this->load->model(array('m_jenis_item','m_item')); // Load Model m_jqgrid
                $this->load->library(array('excel','excel_reader','validasi'));
    }
	function index() 
	{
		$this->grid(); //Default di arahkan ke function grid
	}
	function grid() 
	{
		$this->load->view('master/item'); // Load View jqgrid
	}
	
	function add()
	{
		//$bagian=$this->m_bagian->count_bagian("");
		$data['item']=$this->m_item->get_jnsitem();
		$this->load->view('master/itemadd',$data);
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
		
	        		
		$count = $this->m_item->count_item($where);
		
		$count > 0 ? $total_pages = ceil($count/$limit) : $total_pages = 0;
		if ($page > $total_pages) $page=$total_pages;
		$start = $limit*$page - $limit;
		if($start <0) $start = 0;
		
		$data1 = $this->m_item->get_item($searchField,$searchString, $sidx, $sord, $limit, $start)->result();
		//print_r($data1);
		$responce->page = $page;
		$responce->total = $total_pages;
		$responce->records = $count;
		$i=0;
		foreach($data1 as $line)
		{
			$responce->rows[$i]['id_item']   = $line->id_item;
			$responce->rows[$i]['cell'] = array($line->id_item,$line->nama_item,$line->jenis_item,$line->hba_item,$line->harga_item,$line->frm_item,$line->oral_item,$line->kls_item,$line->provider_item,$line->entri_item);
			$i++;
		}
		
		echo json_encode($responce);
	}
	function crud() 
	{
		$oper=$this->input->post('oper');
		$id_item=$this->input->post('id');
		$nama_item=$this->input->post('nama_item');
		$jns_item=$this->input->post('idjns_item');
		$hba_item=$this->input->post('hba_item');
		$harga_item=$this->input->post('harga_item');
		$formularium_item=$this->input->post('formularium_item');
		$oral_item=$this->input->post('oral_item');
		$kls_item=$this->input->post('kls_item');
		$provider_item=$this->input->post('provider_item');
		$entri_item=$this->input->post('entri_item');
		
		echo "Bismillah";
		
	    switch ($oper) 
		{
	        case 'add':
				$datanya=array('nama_item'=>$nama_item,'idjns_item'=>$jns_item,'hba_item'=>$hba_item,'harga_item'=>$harga_item,'frm_item'=>$formularium_item,'oral_item'=>$oral_item,'kls_item'=>$kls_item,'provider_item'=>$provider_item,'entri_item'=>$entri_item);
				$this->m_item->insert_item($datanya);
				break;
	        case 'edit':
                                $datanya=array('nama_item'=>$nama_item,'idjns_item'=>$jns_item,'hba_item'=>$hba_item,'harga_item'=>$harga_item,'frm_item'=>$formularium_item,'oral_item'=>$oral_item,'kls_item'=>$kls_item,'provider_item'=>$provider_item,'entri_item'=>$entri_item);
				$this->m_item->update_item($id_item, $datanya);
                                break;
	        case 'del':
	            $this->m_item->delete_item($id_item);
	        break;
		}
        
	}
        function impor()
	{

        $data['data']='item';
	$this->load->view('impor/impor',$data);
	}
        function do_impor()
	{
	$error = '';
	$pesan= '';
	$fileElementName = 'uploaditem';

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
                                $error="Data Nama Item di baris ke".$i." terlalu Banyak";
                            }
                            else if(!$this->validasi->cekLengthString($data[$i]['B'],100))
                            {

                                $error="Data Alamat Provider di baris ke".$i." terlalu Banyak";
                            }
                            else if(!$this->validasi->cekLengthString($data[$i]['C'],4))
                            {

                                $error="Data Langganan di baris ke".$i." Harus oral atau kosong";
                            }
                            else if(!$this->validasi->cekLengthString($data[$i]['D'],50))
                            {

                                $error="Data Email Provider di baris ke".$i." terlalu Banyak";
                            }
                            else if(!$this->validasi->cekLengthString($data[$i]['E'],20))
                            {

                                $error="Data Fax Provider di baris ke".$i." terlalu Banyak";
                            }
                            else if(!$this->validasi->cekLengthString($data[$i]['F'],1))
                            {

                                $error="Data Formularium di baris ke".$i." hanya boleh isi y atau kosong";
                            }else if(!$this->validasi->cekLengthString($data[$i]['H'],1))
                            {

                                $error="Data Kelas ke".$i." hanya boleh di isi 0,1,2 atau 3";
                            }
                            else{


                            $dataexcel[$i-1]['nama_item'] = $data[$i]['A'];
                            $jns_item=strtolower($data[$i]['B']);
                            if($jns_item == "apotek")
                            {
                                $jns_item=1;
                            }
                            else if($jns_item == "alkes")
                            {
                                $jns_item=2;
                            }
                            else if($jns_item == "gigi")
                            {
                                $jns_item=3;
                            }
                            else if($jns_item == "kamar")
                            {
                                $jns_item=4;
                            }
                            else if($jns_item == "optik")
                            {
                                $jns_item=5;
                            }
                            else if($jns_item == "penunjang")
                            {
                                $jns_item=6;
                            }
                            else if($jns_item == "tindakan")
                            {
                                $jns_item=7;
                            }
                            else if($jns_item == "dokter")
                            {
                                $jns_item=9;
                            }
                            else
                            {
                                $jns_item=8;
                            }

                            $frm_item=strtolower($data[$i]['F']);
                            if($frm_item == 'y')
                            {
                                $frm_item='y';
                            }
                            else
                            {$frm_item='t';

                            }

                            $oral_item=strtolower($data[$i]['C']);
                            if($oral_item=="oral")
                            {
                                $oral_item='y';
                            }
                            else
                            {
                                $oral_item='t';

                            }
                            $dataexcel[$i-1]['hba_item'] = $data[$i]['D'];
                            $dataexcel[$i-1]['harga_item'] = $data[$i]['E'];
                            $dataexcel[$i-1]['frm_item'] = $frm_item;
                            $dataexcel[$i-1]['oral_item'] = $oral_item;
                            $dataexcel[$i-1]['kls_item'] = $data[$i]['H'];
                            $dataexcel[$i-1]['provider_item'] = $data[$i]['G'];
                            $dataexcel[$i-1]['entri_item'] = "manual";
                            $dataexcel[$i-1]['idjns_item'] = $jns_item;
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
                                     $this->m_item->insert_item($dataexcel[$i]);

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
          $data['isi']=$dataexcel;
          echo json_encode($data);
	}
        
        function ekspor()
	{

	error_reporting(E_ALL);

	date_default_timezone_set('Europe/London');
	
	// Add some data
                $limit = null;
		$sidx  = "id_item";
		$sord  = "desc";
                $start = null;
                $where = null;
            
        //$data1 = $this->m_apotek->get_apotek($where, $sidx, $sord, $limit, $start)->result();
        $data1 = $this->m_item->get_item($where, $sidx, $sord, $limit, $start)->result();
		
	$tulis=$this->excel->setActiveSheetIndex(0);
        
                        $tulis->setCellValue('A1', "No");
                        $tulis->setCellValue('B1', "Nama Item");
                        $tulis->setCellValue('C1', "Jenis");
                        $tulis->setCellValue('D1', "Jenis Obat");
                        $tulis->setCellValue('E1', "HBA");
                        $tulis->setCellValue('F1', "Harga");
                        $tulis->setCellValue('G1', "Formularium");
                        $tulis->setCellValue('H1', "Nama Provider");
                        $tulis->setCellValue('I1', "Kelas");
                        $tulis->setCellValue('J1', "Entri");

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
                        $tulis->setCellValue('B'.$i, $line->nama_item);
                        $tulis->setCellValue('C'.$i, $line->jenis_item);
                        $tulis->setCellValue('D'.$i, $line->oral_item);
                        $tulis->setCellValue('E'.$i, $line->hba_item);
                        $tulis->setCellValue('F'.$i, $line->harga_item);
                        $tulis->setCellValue('G'.$i, $line->frm_item);
                        $tulis->setCellValue('H'.$i, $line->provider_item);
                        $tulis->setCellValue('H'.$i, $line->kls_item);
                        $tulis->setCellValue('H'.$i, $line->entri_item);

			$i++;
		}
        
            
      	// Rename worksheet
	$this->excel->getActiveSheet()->setTitle('Item');

	
	// Set active sheet index to the first sheet, so Excel opens this as the first sheet
	$this->excel->setActiveSheetIndex(0);


	// Redirect output to a client�s web browser (Excel5)
	header('Content-Type: application/vnd.ms-excel');
	header('Content-Disposition: attachment;filename="Master Item.xls"');
	header('Cache-Control: max-age=0');

	$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
	$objWriter->save('php://output');
	//exit;
	}

        function jenis_item()
        {
                $rayon=$this->session->userdata('id_rayon');
                //$rayon=1;
                $wilayah=$this->session->userdata('id_wilayah');

                $mitra=$this->session->userdata('id_mitra');
                $data1 = $this->m_jenis_item->get_JenisItem()->result_array();
                $i=0;
                $data="";
                $jum = count($data1);
                for($i;$i<$jum;$i++)
                {
                    if($i>0)
                    {
                        $data .=";";
                    }
                    $data .= $data1[$i]['idjns_item'].":".$data1[$i]['jenis_item'];
                }
            echo $data;
        }

}