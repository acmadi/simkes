<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tes extends CI_Controller {
	function __construct() {
        parent::__construct();
		$this->load->helper('url'); // Load Helper URL CI
		$this->load->model('m_apotek','m_rayon'); // Load Model m_jqgrid
    }
	function index() 
	{
		$data1 = $this->m_rayon->get_namarayon(null,null, null, null, null, null,1,null,null)->result_array();
                print_r($data1);
	}
	function grid() 
	{
		$this->load->view('master/tes'); // Load View jqgrid
	}
	
	function add()
	{
	 $this->load->view('master/crudtes');
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
		
	        		
		$count = $this->m_apotek->count_apotek($where);
		
		$count > 0 ? $total_pages = ceil($count/$limit) : $total_pages = 0;
		if ($page > $total_pages) $page=$total_pages;
		$start = $limit*$page - $limit;
		if($start <0) $start = 0;
		
		$data1 = $this->m_apotek->get_apotek($where, $sidx, $sord, $limit, $start)->result();
	
		$responce->page = $page;
		$responce->total = $total_pages;
		$responce->records = $count;
		$responce->pilihan[0]['nama']="Perdana";
		$responce->pilihan[0]['id']="07650075";
		$responce->pilihan[1]['nama']="Iqbal";
		$responce->pilihan[1]['id']="07650080";
		
		$i=0;
		foreach($data1 as $line)
		{
			$responce->rows[$i]['id_provider']   = $line->id_provider;
			$responce->rows[$i]['cell'] = array($line->id_provider,$line->nama_provider,$line->almt_provider,$line->langg_provider,$line->email_provider,$line->tlp_provider,$line->fax_provider);
			$i++;
		}
		echo json_encode($responce);
	}
	function crud() 
	{
		$oper=$this->input->post('oper');
		$id_provider=$this->input->post('id');
		$apotek_nama=$this->input->post('nama_provider');
		$apotek_alamat=$this->input->post('almt_provider');
		$apotek_langg=$this->input->post('langg_provider');
		$apotek_email=$this->input->post('email_provider');
		$apotek_fax=$this->input->post('fax_provider');
		$apotek_telp=$this->input->post('tlp_provider');
	    
		
		
		
	    switch ($oper) 
		{
	        case 'add':
				$datanya=array('nama_provider'=>$apotek_nama,'almt_provider'=>$apotek_alamat,'langg_provider'=>$apotek_langg,'email_provider'=>$apotek_email,'fax_provider'=>$apotek_fax,'tlp_provider'=>$apotek_telp,'idjenis_provider'=>1);
				$this->m_apotek->insert_apotek($datanya);
				break;
	        case 'edit':
	            $datanya=array('nama_provider'=>$apotek_nama,'almt_provider'=>$apotek_alamat,'langg_provider'=>$apotek_langg,'email_provider'=>$apotek_email,'fax_provider'=>$apotek_fax,'tlp_provider'=>$apotek_telp,'idjenis_provider'=>1);
				$this->m_apotek->update_apotek($id_provider, $datanya);
	            break;
	        case 'del':
	            $this->m_apotek->delete_apotek($id_provider);
	        break;
		}
	}
}