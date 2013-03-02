<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_lab_gigi extends CI_Model {
	function __construct() 
	{
        parent::__construct();
    }
	
	
	
	/*function count_lab_gigi($like) 
	{
		$like != '' ? $this->db->like($like) : '';
		$this->db->where('idjenis_provider',2);
        return $this->db->count_all('master_provider');
    }*/
	
	function count_lab_gigi($like) 
	{
		$like != '' ? $this->db->like($like) : '';
		$this->db->where('idjenis_provider',2);
		$jumlah=$this->db->get('v_master_provider');
		
        return $jumlah->num_rows();
    }
	function get_lab_gigi($like, $sidx, $sord, $limit, $start) 
	{
		$like != '' ? $this->db->like($like) : '';
		$this->db->where('idjenis_provider',2);
		$this->db->order_by($sidx, $sord);
		return $this->db->get('v_master_provider', $limit, $start);
	}
	function insert_lab_gigi($datanya) 
	{
		return $this->db->insert('master_provider',$datanya);
	}
	function update_lab_gigi($lab_gigi_id,$datanya) 
	{
		$this->db->where('id_provider',$lab_gigi_id);
		return $this->db->update('master_provider',$datanya);
	}
	function delete_lab_gigi($lab_gigi_id) 
	{
		$this->db->where('id_provider', $lab_gigi_id);
		$this->db->delete('master_provider'); 
	}
}