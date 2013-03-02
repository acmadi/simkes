<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Buku extends CI_Controller {
	function __construct() {
        parent::__construct();
		$this->load->helper('url'); // Load Helper URL CI
		$this->load->model('m_jqgrid'); // Load Model m_jqgrid
    }
	function index() 
	{
		$this->grid(); //Default di arahkan ke function grid
	}
	function grid() 
	{
		$this->load->view('master/buku'); // Load View jqgrid
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
		
	        		
		$count = $this->m_jqgrid->count_buku($where);
		
		$count > 0 ? $total_pages = ceil($count/$limit) : $total_pages = 0;
		if ($page > $total_pages) $page=$total_pages;
		$start = $limit*$page - $limit;
		if($start <0) $start = 0;
		
		$data1 = $this->m_jqgrid->get_buku($where, $sidx, $sord, $limit, $start)->result();
	
		$responce->page = $page;
		$responce->total = $total_pages;
		$responce->records = $count;
		$i=0;
		foreach($data1 as $line)
		{
			$responce->rows[$i]['id']   = $line->id;
			$responce->rows[$i]['cell'] = array($line->id,$line->nama,$line->pengarang,$line->tahun_terbit,$line->penerbit);
			$i++;
		}
		echo json_encode($responce);
	}
	function crud() 
	{
		$oper=$this->input->post('oper');
		$id=$this->input->post('id');
		$nama=$this->input->post('nama');
		$pengarang=$this->input->post('pengarang');
		$tahun_terbit=$this->input->post('tahun_terbit');
		$penerbit=$this->input->post('penerbit');
	    
	    switch ($oper) 
		{
	        case 'add':
				$datanya=array('nama'=>$nama,'pengarang'=>$pengarang,'tahun_terbit'=>$tahun_terbit,'penerbit'=>$penerbit);
				$this->m_jqgrid->insert_buku($datanya);
				break;
	        case 'edit':
	            $datanya=array('nama'=>$nama,'pengarang'=>$pengarang,'tahun_terbit'=>$tahun_terbit,'penerbit'=>$penerbit);
				$this->m_jqgrid->update_buku($id, $datanya);
	            break;
	        case 'del':
	            $this->m_jqgrid->delete_buku($id);
	        break;
		}
	}
}