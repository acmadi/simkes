<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_mitra extends CI_Model {
	function __construct() 
	{
        parent::__construct();
    }
	
	
	function get_allmitra()
	{
	 $mitra = $this->db->query("select * from mitra_karyawan");

	return $mitra;
	}
	
	function count_mitra($like) 
	{
		$like != '' ? $this->db->like($like) : '';
		
        return $this->db->count_all('mitra_karyawan');
    }
	function get_mitra($like, $sidx, $sord, $limit, $start) 
	{
		$like != '' ? $this->db->like($like) : '';
		$this->db->order_by($sidx, $sord);
		return $this->db->get('mitra_karyawan', $limit, $start);
	}
	function insert_mitra($datanya) 
	{
		return $this->db->insert('mitra_karyawan',$datanya);
	}
	function update_mitra($mitra_id,$datanya) 
	{
		$this->db->where('id_mitra',$mitra_id);
		return $this->db->update('mitra_karyawan',$datanya);
	}
	function delete_mitra($mitra_id) 
	{
		$this->db->where('id_mitra', $mitra_id);
		$this->db->delete('mitra_karyawan'); 
	}
}