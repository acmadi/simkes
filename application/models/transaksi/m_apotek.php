<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_apotek extends CI_Model {
	function __construct() 
	{
        parent::__construct();
    }
	
	    function caripegawai($keyword){
        $this->db->like('master_karyawan',$keyword);
        $query = $this->db->get('master_karyawan');

        return $query->result_array();

    }
	/*
	function count_apotek($like) 
	{
		$like != '' ? $this->db->like($like) : '';
        return $this->db->count_all('master_apotek');
    }
	function get_apotek($like, $sidx, $sord, $limit, $start) 
	{
		$like != '' ? $this->db->like($like) : '';
		$this->db->order_by($sidx, $sord);
		return $this->db->get('master_apotek', $limit, $start);
	}
	function insert_apotek($datanya) 
	{
		return $this->db->insert('master_apotek',$datanya);
	}
	function update_apotek($apotek_id,$datanya) 
	{
		$this->db->where('apotek_id',$apotek_id);
		return $this->db->update('master_apotek',$datanya);
	}
	function delete_apotek($apotek_id) 
	{
		$this->db->where('apotek_id', $apotek_id);
		$this->db->delete('master_apotek'); 
	}
	*/
}