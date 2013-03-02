<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Download extends CI_Controller {
   // $kun="";


    function __construct()
    {
        parent::__construct();
        //$this->load->model(array('m_karyawan','m_penunjang','m_hasil_transaksi','m_transaksi','m_karyawan','m_tran_apotek','m_tertanggung','m_item','m_dokter','m_apotek'));
        $this->load->helper(array('download','file')); // Load Helper URL CI
        //$this->load->library(array('excel'));

    }




        function index()
        {
	$this->load->view('laporan/download');
 	}

        function tes()
        {
            $bulan = $this->input->post('bulan');
            $tahun = $this->input->post('tahun');
            $namafile = "laporan".$bulan.$tahun.".xls";
            //echo $bulan.$tahun;
            $string = read_file('./temp_upload/'.$namafile);
            if($string)
            {
                echo $namafile;
            }
            else
            {
                echo "";
            }
        }

	function do_download($file)
	{
            $bulan = $this->input->post('bulan');
            $tahun = $this->input->post('tahun');
            $namafile = "laporan".$bulan.$tahun.".xls";

        $data = file_get_contents('./temp_upload/'.$file); // Read the file's contents
        $name = $file;
        force_download($name, $data);
	}

}