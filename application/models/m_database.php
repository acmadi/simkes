<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_apotek extends CI_Model {
	function __construct() 
	{
        parent::__construct();
    }
	
	function tangkapdb()
	{
		$tangkap = $this->db->query("select * from master_karyawan");
		if($tangkap->num_rows() > 0)
		{foreach($tangkap->result() as $row)
		{
		$data[] = row;
		
		}
		return $data;
		}
	}
	
	
	function count_apotek($like) 
	{
		$like != '' ? $this->db->like($like) : '';
		$this->db->where('idjenis_provider',1);
        return $this->db->count_all('master_provider');
    }
	function get_apotek($like, $sidx, $sord, $limit, $start) 
	{
		$like != '' ? $this->db->like($like) : '';
		$this->db->order_by($sidx, $sord);
		return $this->db->get('master_provider', $limit, $start);
	}
	function insert_apotek($datanya) 
	{
		return $this->db->insert('master_provider',$datanya);
	}
	function update_apotek($apotek_id,$datanya) 
	{
		$this->db->where('id_provider',$apotek_id);
		return $this->db->update('master_provider',$datanya);
	}
	function delete_apotek($apotek_id) 
	{
		$this->db->where('id_provider', $apotek_id);
		$this->db->delete('master_provider'); 
	}
}