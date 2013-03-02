<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_optik extends CI_Model {
	function __construct() 
	{
        parent::__construct();
    }
	
	
	
	/*function count_optik($like) 
	{
		$like != '' ? $this->db->like($like) : '';
		$this->db->where('idjenis_provider',4);
        return $this->db->count_all('master_provider');
    }*/
	function count_optik($like) 
	{
		$like != '' ? $this->db->like($like) : '';
		$this->db->where('idjenis_provider',4);
		$jumlah=$this->db->get('v_master_provider');
		
        return $jumlah->num_rows();
    }
	function get_optik($like, $sidx, $sord, $limit, $start) 
	{
		$like != '' ? $this->db->like($like) : '';
		$this->db->where('idjenis_provider',4);
		$this->db->order_by($sidx, $sord);
		return $this->db->get('v_master_provider', $limit, $start);
	}
	function insert_optik($datanya) 
	{
		return $this->db->insert('master_provider',$datanya);
	}
	function update_optik($optik_id,$datanya) 
	{
		$this->db->where('id_provider',$optik_id);
		return $this->db->update('master_provider',$datanya);
	}
	function delete_optik($optik_id) 
	{
		$this->db->where('id_provider', $optik_id);
		$this->db->delete('master_provider'); 
	}
}