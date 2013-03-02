<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Upload extends CI_Controller {
   // $kun="";


    function __construct()
    {
        parent::__construct();
        $this->load->model(array('m_karyawan','m_penunjang','m_hasil_transaksi','m_transaksi','m_karyawan','m_tran_apotek','m_tertanggung','m_item','m_dokter','m_apotek'));
        $this->load->helper(array('url','file')); // Load Helper URL CI
        $this->load->library(array('excel'));
        //$this->load->helper('form');
    }




        function index()
        {
	//$this->load->view('laporan/upload'); //Default di arahkan ke function grid
        $data['data']='uploaddata';
	$this->load->view('laporan/upload',$data);
 	
	}

	function do_impor()
	{

        $rayon=$this->session->userdata('id_rayon');
        $wilayah=$this->session->userdata('id_wilayah');
        $mitra=$this->session->userdata('id_mitra');
        $bulan = $this->input->post('bulan');
        $tahun = $this->input->post('tahun');
        $pesan='';
        $error='';

	$fileElementName = 'uploaddata';

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

			$config['upload_path'] = './temp_upload/';
			$config['allowed_types'] = 'xls';
                        $config['file_name'] = "laporan".$bulan.$tahun;


			$this->load->library('upload', $config);
			//$tes=$this->upload->do_upload();


			if ( ! $this->upload->do_upload($fileElementName))
			{
                           $data = array('error' => $this->upload->display_errors());
                           $error = "Insert failed. Please check your file, only .xls file allowed.";
			}

			else
			{
                            $upload_data = $this->upload->data();

                            $file =  $upload_data['full_path'];
                            //print_r($file);
                            //$pesan .= $file;
                            $pesan .="Berhasil";
			}




	    }



        $data['error']=$error;
        $data['pesan']=$pesan;
        //$data['isi']=$sheetData;
        echo json_encode($data);

	}

}