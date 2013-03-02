<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_rmhsakit extends CI_Model {
	function __construct() 
	{
        parent::__construct();
    }
	
	
	
	
	/*function count_rmhsakit($like) 
	{
		$like != '' ? $this->db->like($like) : '';
		$this->db->where('idjenis_provider',5);
        return $this->db->count_all('master_provider');
    }*/
	function count_rmhsakit($like) 
	{
		$like != '' ? $this->db->like($like) : '';
		$this->db->where('idjenis_provider',5);
		$jumlah=$this->db->get('v_master_provider');
		
        return $jumlah->num_rows();
    }
	function get_rmhsakit($like, $sidx, $sord, $limit, $start) 
	{
		$like != '' ? $this->db->like($like) : '';
		$this->db->where('idjenis_provider',5);
		$this->db->order_by($sidx, $sord);
		return $this->db->get('v_master_provider', $limit, $start);
	}
	function insert_rmhsakit($datanya) 
	{
		return $this->db->insert('master_provider',$datanya);
	}
	function update_rmhsakit($rmhsakit_id,$datanya) 
	{
		$this->db->where('id_provider',$rmhsakit_id);
		return $this->db->update('master_provider',$datanya);
	}
	function delete_rmhsakit($rmhsakit_id) 
	{
		$this->db->where('id_provider', $rmhsakit_id);
		$this->db->delete('master_provider'); 
	}
}