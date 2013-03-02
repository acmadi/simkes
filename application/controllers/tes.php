<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Tes extends CI_Controller 
{

	function __construct()
	{
		parent::__construct();
                $this->load->model(array('m_wilayah','m_bagian','m_rayon','m_diagnosa','m_tran_lab','m_tran_apotek','m_transaksi','muser','m_view_hasilapotek','m_hasil_transaksi'));

	}

	function index()
	{
           //$data['id_tran']=2;
            //$this->load->view('hasil/detailhasilapotek',$data);
           // $data['namafile']='hasilapotek';
            //$this->load->view('hasil/detailhasilapotek',$data);

	      $this->load->view('hasil/detailcoba');
        }
}
