<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_wilayah extends CI_Model {
	function __construct() 
	{
        parent::__construct();
    }
	
	function get_allwilayah($id)
	{
	$bagian = $this->db->query("select * from wilayah_karyawan where id_mitra='".$id."'");
	if($bagian->num_rows()>0)
	{
	
	foreach($bagian->result() as $row)
	{
	 $data[]=$row;
	}
	return $data;
	}
	}
	
	function get_wil($id)
	{
	$this->db->where('id_mitra',$id);
	return $this->db->get('wilayah_karyawan');
	}
	
	
	function count_wilayah($like) 
	{
		$like != '' ? $this->db->like($like) : '';
		
        return $this->db->count_all('wilayah_karyawan');
    }
	function get_wilayah($like, $sidx, $sord, $limit, $start) 
	{
		$like != '' ? $this->db->like($like) : '';
		$this->db->order_by($sidx, $sord);
		return $this->db->get('wilayah_karyawan', $limit, $start);
	}
	function insert_wilayah($datanya) 
	{
		return $this->db->insert('wilayah_karyawan',$datanya);
	}
	function update_wilayah($wilayah_id,$datanya) 
	{
		$this->db->where('id_wilayah',$wilayah_id);
		return $this->db->update('wilayah_karyawan',$datanya);
	}
	function delete_wilayah($wilayah_id) 
	{
		$this->db->where('id_wilayah', $wilayah_id);
		$this->db->delete('wilayah_karyawan'); 
	}
        function get_namaWilayah($searchField,$searchString, $sidx, $sord, $limit, $start,$wilayah,$mitra)
	{

                $query=('select * from wilayah_karyawan where id_wilayah>0 ');

                if($wilayah != '')
                {
                $query=$query.(" and id_wilayah=".$wilayah);
                }
                if($mitra != '')
                {
                $query=$query.(" and id_mitra=".$mitra);
                }


                if($searchField != '')
                {
                $query=$query.(" and ".$searchField." LIKE '%".$searchString."%' ");
                }

                if($start != '')
                {
                $query=$query." order by ".$sidx." ".$sord." LIMIT ".$start.", ".$limit;
                }
                
                $jumlah = $this->db->query($query);


                return $jumlah;

	}
}