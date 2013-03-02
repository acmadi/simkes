<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_jqgrid extends CI_Model {
	function __construct() 
	{
        parent::__construct();
    }
	function count_buku($like) 
	{
		$like != '' ? $this->db->like($like) : '';
        return $this->db->count_all('buku');
    }
	function get_buku($like, $sidx, $sord, $limit, $start) 
	{
		$like != '' ? $this->db->like($like) : '';
		$this->db->order_by($sidx, $sord);
		return $this->db->get('buku', $limit, $start);
	}
	function insert_buku($datanya) 
	{
		return $this->db->insert('buku',$datanya);
	}
	function update_buku($id,$datanya) 
	{
		$this->db->where('id',$id);
		return $this->db->update('buku',$datanya);
	}
	function delete_buku($id) 
	{
		$this->db->where('id', $id);
		$this->db->delete('buku'); 
	}
}