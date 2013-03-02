<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_dosis extends CI_Model {
	function __construct() 
	{
        parent::__construct();
    }
	
	
	
	function count_dosis($like) 
	{
		$like != '' ? $this->db->like($like) : '';
		
        return $this->db->count_all('master_dosis');
    }
	function get_dosis($like, $sidx, $sord, $limit, $start) 
	{
		$like != '' ? $this->db->like($like) : '';
		$this->db->order_by($sidx, $sord);
		return $this->db->get('master_dosis', $limit, $start);
	}
	function insert_dosis($datanya) 
	{
		return $this->db->insert('master_dosis',$datanya);
	}
	function update_dosis($dosis_id,$datanya) 
	{
		$this->db->where('id_dosis',$dosis_id);
		return $this->db->update('master_dosis',$datanya);
	}
	function delete_dosis($dosis_id) 
	{
		$this->db->where('id_dosis', $dosis_id);
		$this->db->delete('master_dosis'); 
	}
}