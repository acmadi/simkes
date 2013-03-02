<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class DetailTemuan extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model(array('m_laporan','m_transaksi'));
        $this->load->helper('url');
        $this->load->library(array('excel'));
    }
    

    function json() 
    {
        $id  = $this->input->get('id');
	
        $data1 = $this->m_laporan->get_diag($id)->result();
        
	$responce->page = 1;
	$responce->total = 1;
	$i=0;
	foreach($data1 as $line)
	{
            $responce->rows[$i]['id_transaksi']   = $line->id_transaksi;			
            $responce->rows[$i]['cell'] = array($line->nama_diagnosa);
            $i++;
	}
	echo json_encode($responce);
    }
    
    function json2() 
    {
        $id  = $this->input->get('id');
	
        $data1 = $this->m_laporan->get_detailTemuan($id)->result();
        
	$responce->page = 1;
	$responce->total = 1;
	$i=0;
	foreach($data1 as $line)
	{
            $responce->rows[$i]['id_transaksi']   = $line->id_transaksi;
            $total=$line->jumlah*$line->hrg_satuan;
            $responce->rows[$i]['cell'] = array($line->jenis_provider,$line->nama_item,$line->jumlah,$line->hrg_satuan,$line->harga_item,$total);
            $i++;
	}
	echo json_encode($responce);
    }
    
    function detail()
    {
        $data['id']=$this->input->get('idTrans');
        $data['jenis']=$this->input->get('jenis');
	$this->load->view('laporan/detailTemuan',$data);
    }
}