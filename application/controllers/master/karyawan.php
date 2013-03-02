<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Karyawan extends CI_Controller {
	function __construct() {
        parent::__construct();
		$this->load->helper('url'); // Load Helper URL CI
		
		$this->load->model(array('m_status_karyawan','m_bagian','m_karyawan','m_rayon')); // Load Model m_jqgrid
                $this->load->library(array('excel','validasi'));
    }
	function index() 
	{
		$this->grid(); //Default di arahkan ke function grid
	}
	function grid() 
	{
		$this->load->view('master/karyawan'); // Load View jqgrid
	}
	
	function add()
	{
		//$bagian=$this->m_bagian->count_bagian("");

                $wilayah=$this->session->userdata('id_wilayah');

		$data['bagian'] = $this->m_bagian->ambil_bagian();
		$data['rayon']=$this->m_rayon->get_semuarayon($wilayah);
		$this->load->view('master/karyawanadd',$data);
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
		
	        		
		$count = $this->m_karyawan->count_karyawan($where, $sidx, $sord,$rayon,$wilayah,$mitra,$searchField,$searchString);
		
		$count > 0 ? $total_pages = ceil($count/$limit) : $total_pages = 0;
		if ($page > $total_pages) $page=$total_pages;
		$start = $limit*$page - $limit;
		if($start <0) $start = 0;
		
		//$data1 = $this->m_karyawan->get_karyawan($where, $sidx, $sord, $limit, $start)->result();
		$data1 = $this->m_karyawan->get_karyawan($where, $sidx, $sord, $limit, $start,$rayon,$wilayah,$mitra,$searchField,$searchString)->result();
		
		$responce->page = $page;
		$responce->total = $total_pages;
		$responce->records = $count;
		$i=0;
		foreach($data1 as $line)
		{
			$responce->rows[$i]['id_karyawan']   = $line->id_karyawan;
			$responce->rows[$i]['cell'] = array($line->id_karyawan,$line->nip,$line->nama_karyawan,$line->nama_rayon,$line->nama_bagian,$line->alamat,$line->sex,$line->telp,$line->tgl_lahir,$line->ap,$line->nama_status,$line->kelas_kamar);
			$i++;
		}
		echo json_encode($responce);
	}
	function crud() 
	{
		$oper=$this->input->post('oper');
		$id_karyawan=$this->input->post('id');

		$nip=$this->input->post('nip_karyawan');
		$nama_karyawan=$this->input->post('nama_karyawan');
		$id_rayon=$this->input->post('rayon_karyawan');
		$id_bagian=$this->input->post('bagian_karyawan');
		$alamat_karyawan=$this->input->post('alamat_karyawan');
		$sex_karyawan=$this->input->post('sex_karyawan');
		$telp_karyawan=$this->input->post('telp_karyawan');
		$tgl_lahir=$this->input->post('tgl_lahir_karyawan');
                $tgl_lahir_karyawan = null;
		if($tgl_lahir != '')
                {
                    $tgl_lahir_karyawan = $tgl_lahir;
                }
                $ap_karyawan=$this->input->post('ap_karyawan');
		$status_karyawan=$this->input->post('status_karyawan');
		$kls_kmr=$this->input->post('kelas_kamar_karyawan');
		//echo "Bismillah";
		
	    switch ($oper) 
		{
	        case 'add':
				$datanya=array('nip'=>$nip,'nama_karyawan'=>$nama_karyawan,'id_rayon'=>$id_rayon,'id_bagian'=>$id_bagian,'alamat'=>$alamat_karyawan,'sex'=>$sex_karyawan,'telp'=>$telp_karyawan,'tgl_lahir'=>$tgl_lahir_karyawan,'ap'=>$ap_karyawan,'status'=>$status_karyawan,'kelas_kamar'=>$kls_kmr);
				$this->m_karyawan->insert_karyawan($datanya);
				break;
	        case 'edit':
                                $datanya=array('nip'=>$nip,'nama_karyawan'=>$nama_karyawan,'id_rayon'=>$id_rayon,'id_bagian'=>$id_bagian,'alamat'=>$alamat_karyawan,'sex'=>$sex_karyawan,'telp'=>$telp_karyawan,'tgl_lahir'=>$tgl_lahir_karyawan,'ap'=>$ap_karyawan,'status'=>$status_karyawan,'kelas_kamar'=>$kls_kmr);
					$this->m_karyawan->update_karyawan($id_karyawan, $datanya);
	            break;
	        case 'del':
	            $this->m_karyawan->delete_karyawan($id_karyawan);
	        break;
		}
        
	}

        function impor()
	{

        $data['data']='karyawan';
	$this->load->view('impor/impor',$data);
	}
        function do_impor()
	{
	$error = '';
	$pesan= '';
	$fileElementName = 'uploadkaryawan';

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
                                $error="Data NIP di baris ke".$i." terlalu Banyak";
                                break;
                            }
                            else if(!$this->validasi->cekLengthString($data[$i]['B'],8))
                            {

                                $error="Data Id Rayon di baris ke".$i." terlalu Banyak";
                                break;
                            }
                            else if(!$this->validasi->cekLengthString($data[$i]['C'],8))
                            {

                                $error="Data Id Bagian di baris ke".$i." terlalu Banyak";
                                break;
                            }
                            else if(!$this->validasi->cekLengthString($data[$i]['D'],100))
                            {

                                $error="Data Nama Karyawan di baris ke".$i." terlalu Banyak";
                                break;
                            }
                            else if(!$this->validasi->cekLengthString($data[$i]['E'],200))
                            {

                                $error="Data Alamat di baris ke".$i." terlalu Banyak";
                                break;
                            }
                            else if(!$this->validasi->cekLengthString($data[$i]['F'],1))
                            {

                                $error="Data Jenis Kelamin di baris ke".$i." hanya boleh di isi l atau p";
                                break;
                            }
                            else if(!$this->validasi->cekLengthString($data[$i]['G'],20))
                            {

                                $error="Data Tanggal di baris ke".$i." harus berformat dd/mm/yyyy";
                                break;
                            }
                            else if(!$this->validasi->cekLengthString($data[$i]['H'],100))
                            {

                                $error="Data Tempat Tanggal Lahir di baris ke".$i." terlalu Banyak";
                                break;
                            }
                            else if(!$this->validasi->cekLengthString($data[$i]['I'],1))
                            {

                                $error="Data Aktif di baris ke".$i." hanya boleh di isi a atau p";
                                break;
                            }
                            else if(!$this->validasi->cekLengthString($data[$i]['J'],15))
                            {

                                $error="Data Telp di baris ke".$i." terlalu Banyak";
                                break;
                            }
                            else if(!$this->validasi->cekLengthString($data[$i]['K'],2))
                            {

                                $error="Data Kelas Kamar di baris ke".$i." terlalu Banyak";
                                break;
                            }
                            else{
                            $dataexcel[$i-1]['nip'] = $data[$i]['A'];
                            $dataexcel[$i-1]['nama_karyawan'] = $data[$i]['D'];
                            $dataexcel[$i-1]['alamat'] = $data[$i]['E'];
                            $dataexcel[$i-1]['sex'] = $data[$i]['F'];
                            $dataexcel[$i-1]['telp'] = $data[$i]['J'];
                            if($data[$i]['G'] != null)
                            {
                            $dataexcel[$i-1]['tgl_lahir'] = $this->tanggal($data[$i]['G']);    
                            }
                            $dataexcel[$i-1]['ap'] = $data[$i]['I'];
                            $status_karyawan=strtolower($data[$i]['L']);
                            if($status_karyawan == "suami")
                            {
                                $status_karyawan = 1;
                            }
                            else if($status_karyawan == "istri")
                            {
                                $status_karyawan = 2;
                            }
                            else if($status_karyawan == "anak")
                            {
                                $status_karyawan = 3;
                            }
                            else if($status_karyawan == "menikah")
                            {
                                $status_karyawan = 4;
                            }
                            else if($status_karyawan == "single")
                            {
                                $status_karyawan = 5;
                            }
                            else
                            {
                                $status_karyawan = 0;
                            }
                            $dataexcel[$i-1]['status'] = $status_karyawan;
                            $dataexcel[$i-1]['kelas_kamar'] = $data[$i]['K'];
                            $dataexcel[$i-1]['id_rayon'] =  $data[$i]['B'];
                            $dataexcel[$i-1]['id_bagian'] =  $data[$i]['C'];
                            $dataexcel[$i-1]['ttl'] =  $data[$i]['H'];
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
                                     $this->m_karyawan->insert_karyawan($dataexcel[$i]);

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
        function tanggal($tanggal)
        {
        $tes=split("/",$tanggal);
        $hasil=$tes[count($tes)-1];
        for($i=count($tes)-2;$i>=0;$i--)
        {
        $hasil .="-".$tes[$i];
        }
        return $hasil;
        }

        function ekspor()
	{

	error_reporting(E_ALL);

	date_default_timezone_set('Europe/London');

	// Add some data
                $page  = NULL;
		$limit = $this->input->get('rows');
		$sidx  = $this->input->get('sidx');
		$sidx  = "id_karyawan";
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

                $data1 = $this->m_karyawan->get_karyawan($where, $sidx, $sord, $limit, $start,$rayon,$wilayah,$mitra,$searchField,$searchString)->result();
		$tulis=$this->excel->setActiveSheetIndex(0);

                        $tulis->setCellValue('A1', "No");
                        $tulis->setCellValue('B1', "NIP");
                        $tulis->setCellValue('C1', "RAYON");
                        $tulis->setCellValue('D1', "BAGIAN");
                        $tulis->setCellValue('E1', "NAMA");
                        $tulis->setCellValue('F1', "ALAMAT");
                        $tulis->setCellValue('G1', "JK");
                        $tulis->setCellValue('H1', "TGL LAHIR");
                        $tulis->setCellValue('I1', "TMPT LAHIR");
                        $tulis->setCellValue('J1', "AKTIF");
                        $tulis->setCellValue('K1', "TELP");
                        $tulis->setCellValue('L1', "KELAS KAMAR");
                        $tulis->setCellValue('M1', "STATUS");

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
                        $tulis->setCellValue('B'.$i, $line->nip);
                        $tulis->setCellValue('C'.$i, $line->id_rayon);
                        $tulis->setCellValue('D'.$i, $line->nama_bagian);
                        $tulis->setCellValue('E'.$i, $line->nama_karyawan);
                        $tulis->setCellValue('F'.$i, $line->alamat);
                        $tulis->setCellValue('G'.$i, $line->sex);
                        $tulis->setCellValue('H'.$i, $line->tgl_lahir);
                        $tulis->setCellValue('I'.$i, $line->ttl);
                        $tulis->setCellValue('J'.$i, $line->ap);
                        $tulis->setCellValue('K'.$i, $line->telp);
                        $tulis->setCellValue('L'.$i, $line->kelas_kamar);
                        $tulis->setCellValue('M'.$i, $line->status);

			$i++;
		}


      	// Rename worksheet
	$this->excel->getActiveSheet()->setTitle('Data Karyawan');


	// Set active sheet index to the first sheet, so Excel opens this as the first sheet
	$this->excel->setActiveSheetIndex(0);


	// Redirect output to a client�s web browser (Excel5)
	header('Content-Type: application/vnd.ms-excel');
	header('Content-Disposition: attachment;filename="Master Data Karyawan.xls"');
	header('Cache-Control: max-age=0');

	$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
	$objWriter->save('php://output');
	//exit;
	}
        function rayon()
        {
                $rayon=$this->session->userdata('id_rayon');
                //$rayon=1;
                $wilayah=$this->session->userdata('id_wilayah');

                $mitra=$this->session->userdata('id_mitra');
                $data1 = $this->m_rayon->get_namarayon(null,null, null, null, null, null,$rayon,$wilayah,$mitra)->result_array();
                $i=0;
                $data="";
                $jum = count($data1);
                for($i;$i<$jum;$i++)
                {
                    if($i>0)
                    {
                        $data .=";";
                    }
                    $data .= $data1[$i]['id_rayon'].":".$data1[$i]['nama_rayon'];
                }
            echo $data;
        }
        function bagian()
        {
                $rayon=$this->session->userdata('id_rayon');
                //$rayon=1;
                $wilayah=$this->session->userdata('id_wilayah');

                $mitra=$this->session->userdata('id_mitra');
                $data1 = $this->m_bagian->get_allbagian()->result_array();
                $i=0;
                $data="";
                $jum = count($data1);
                for($i;$i<$jum;$i++)
                {
                    if($i>0)
                    {
                        $data .=";";
                    }
                    $data .= $data1[$i]['id_bagian'].":".$data1[$i]['nama_bagian'];
                }
            echo $data;
        }
        function status()
        {
                $rayon=$this->session->userdata('id_rayon');
                //$rayon=1;
                $wilayah=$this->session->userdata('id_wilayah');

                $mitra=$this->session->userdata('id_mitra');
                $data1 = $this->m_status_karyawan->get_status()->result_array();
                $i=0;
                $data="";
                $jum = count($data1);
                for($i;$i<$jum;$i++)
                {
                    if($i>0)
                    {
                        $data .=";";
                    }
                    $data .= $data1[$i]['id_status'].":".$data1[$i]['nama_status'];
                }
            echo $data;
        }

}