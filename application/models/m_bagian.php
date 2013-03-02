<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_bagian extends CI_Model {
	function __construct() 
	{
        parent::__construct();
    }
	
	function get_allbagian()
	{
	 return $this->db->get('bagian_karyawan');
	}
	
	function ambil_bagian()
	{
	$bagian = $this->db->query("select * from bagian_karyawan");
	if($bagian->num_rows()>0)
	{
	
	foreach($bagian->result() as $row)
	{
	 $data[]=$row;
	}
	return $data;
	}
	}
	
	function count_bagian($like) 
	{
		$like != '' ? $this->db->like($like) : '';
		
        return $this->db->count_all('bagian_karyawan');
    }
	function get_bagian($like, $sidx, $sord, $limit, $start) 
	{
		$like != '' ? $this->db->like($like) : '';
		$this->db->order_by($sidx, $sord);
		return $this->db->get('bagian_karyawan', $limit, $start);
	}
	function insert_bagian($datanya) 
	{
		return $this->db->insert('bagian_karyawan',$datanya);
	}
	function update_bagian($bagian_id,$datanya) 
	{
		$this->db->where('id_bagian',$bagian_id);
		return $this->db->update('bagian_karyawan',$datanya);
	}
	function delete_bagian($bagian_id) 
	{
		$this->db->where('id_bagian', $bagian_id);
		$this->db->delete('bagian_karyawan'); 
	}
}