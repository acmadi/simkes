<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_provider extends CI_Model {
	function __construct() 
	{
        parent::__construct();
    }
	
	
	
	/*function count_provider($like) 
	{
		$like != '' ? $this->db->like($like) : '';
		$this->db->where('idjenis_provider',1);
        return $this->db->count_all('master_provider');
    }*/
	function count_provider($like) 
	{
		$like != '' ? $this->db->like($like) : '';
		$this->db->where('idjenis_provider',1);
		$jumlah=$this->db->get('master_provider');
		
        return $jumlah->num_rows();
        }

        function get_provider($like, $sidx, $sord, $limit, $start)
	{
		$like != '' ? $this->db->like($like) : '';
		$this->db->where('idjenis_provider',1);
		$this->db->order_by($sidx, $sord);
		return $this->db->get('master_provider', $limit, $start);
	}

        
	function insert_provider($datanya) 
	{
		return $this->db->insert('master_provider',$datanya);
	}
	function update_provider($provider_id,$datanya) 
	{
		$this->db->where('id_provider',$provider_id);
		return $this->db->update('master_provider',$datanya);
	}
	function delete_provider($provider_id) 
	{
		$this->db->where('id_provider', $provider_id);
		$this->db->delete('master_provider'); 
	}
}