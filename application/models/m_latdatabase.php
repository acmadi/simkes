<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_latdatabase extends CI_Model {
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
		$data[] = $row;
		
		}
		return $data;
		}
	}
	
	function arqtangkapdb()
	{
		$tangkap = $this->db->get('master_karyawan');
		if($tangkap->num_rows() >0)
		{
		foreach($tangkap->result() as $row)
		{
		$data[] = $row;
		}
		return $data;
		}
	}
	
	function tangkapkolom()
	{
		$tangkap = $this->db->query("select id_karyawan,nama_karyawan from master_karyawan");
		if($tangkap->num_rows() > 0)
		{foreach($tangkap->result() as $row)
		{
		$data[] = $row;
		
		}
		return $data;
		}
	}
	
	function arqtangkapkolom()
	{
	    $this->db->select("id_karyawan,nama_karyawan");
		$tangkap = $this->db->get('master_karyawan');
		if($tangkap->num_rows() >0)
		{
		foreach($tangkap->result() as $row)
		{
		$data[] = $row;
		}
		return $data;
		}
	}
	
	function cobawhere()
	{
		$query = "select id_karyawan,nama_karyawan from master_karyawan where id_karyawan = ? ";
		$tangkap = $this->db->query($query,2);
		if($tangkap->num_rows() > 0)
		{foreach($tangkap->result() as $row)
		{
		$data[] = $row;
		
		}
		return $data;
		}
	}
	
	function arqcobawhere()
	{
		$this->db->select("id_karyawan,nama_karyawan");
		$this->db->where('id_karyawan',2);
		$tangkap = $this->db->get('master_karyawan');
		if($tangkap->num_rows() >0)
		{
		foreach($tangkap->result() as $row)
		{
		$data[] = $row;
		}
		return $data;
		}
	}
	
	function coba()
	{
		$query = "select a.id_karyawan,a.nama_karyawan,b.nama_rayon,c.nama_bagian,a.alamat,a.sex,a.telp,a.ttl,a.ap,a.status,a.kelas_kamar from master_karyawan as a,rayon_karyawan as b,bagian_karyawan as c where a.id_rayon = b.id_rayon and a.id_bagian = c.id_bagian ";
		$tangkap = $this->db->query($query,2);
		if($tangkap->num_rows() > 0)
		{foreach($tangkap->result() as $row)
		{
		$data[] = $row;
		
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