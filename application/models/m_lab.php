<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_lab extends CI_Model {
	function __construct() 
	{
        parent::__construct();
    }
	
	
	
	
	/*function count_lab($like) 
	{
		$like != '' ? $this->db->like($like) : '';
		$this->db->where('idjenis_provider',3);
        return $this->db->count_all('master_provider');
    }*/
	function count_lab($like) 
	{
		$like != '' ? $this->db->like($like) : '';
		$this->db->where('idjenis_provider',3);
		$jumlah=$this->db->get('v_master_provider');
		
        return $jumlah->num_rows();
    }
	function get_lab($like, $sidx, $sord, $limit, $start) 
	{
		$like != '' ? $this->db->like($like) : '';
		$this->db->where('idjenis_provider',3);
		$this->db->order_by($sidx, $sord);
		return $this->db->get('v_master_provider', $limit, $start);
	}
	function insert_lab($datanya) 
	{
		return $this->db->insert('master_provider',$datanya);
	}
	function update_lab($lab_id,$datanya) 
	{
		$this->db->where('id_provider',$lab_id);
		return $this->db->update('master_provider',$datanya);
	}
	function delete_lab($lab_id) 
	{
		$this->db->where('id_provider', $lab_id);
		$this->db->delete('master_provider'); 
	}
}