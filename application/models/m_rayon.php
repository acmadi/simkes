<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_rayon extends CI_Model {
	function __construct() 
	{
        parent::__construct();
    }
	
	function get_allrayon()
	{
	$bagian = $this->db->query("select * from v_master_rayon");
	if($bagian->num_rows()>0)
	{
	
	foreach($bagian->result() as $row)
	{
	 $data[]=$row;
	}
	return $data;
	}
	}

        function get_semuarayon($id_wilayah)
        {
            $this->db->where('id_wilayah',$id_wilayah);
            $rayon=$this->db->get('rayon_karyawan');
            if($rayon->num_rows()>0)
	{

	foreach($rayon->result() as $row)
	{
	 $data[]=$row;
	}
	return $data;
	}
        }

	
	
	
	function count_rayon($like) 
	{
		$like != '' ? $this->db->like($like) : '';
		
        return $this->db->count_all('rayon_karyawan');
    }
	function get_rayon($like, $sidx, $sord, $limit, $start) 
	{
		$like != '' ? $this->db->like($like) : '';
		$this->db->order_by($sidx, $sord);
		return $this->db->get('rayon_karyawan', $limit, $start);
	}
        function count_namarayon()
        {
            
        }

//	function get_namarayon($searchField,$searchString, $sidx, $sord, $limit, $start,$rayon,$wilayah,$mitra)
//	{
//
//                $query=('select * from rayon_karyawan rk
//                         join wilayah_karyawan wk on wk.id_wilayah = rk.id_wilayah
//                         join mitra_karyawan mk on mk.id_mitra = wk.id_mitra
//                         where id_rayon>0 ');
//
//
//                if($rayon != '')
//                {
//                $query=$query.(" and rk.id_rayon=".$rayon);
//                }if($wilayah != '')
//                {
//                $query=$query.(" and wk.id_wilayah=".$wilayah);
//                }
//                if($mitra != '')
//                {
//                $query=$query.(" and wk.id_mitra=".$mitra);
//                }
//
//                if($searchField != '')
//                {
//                $query=$query.(" and ".$searchField." LIKE '%".$searchString."%' ");
//                }
//                if($limit != '')
//                {
//                $query=$query." order by ".$sidx." ".$sord." LIMIT ".$start.", ".$limit;
//                }
//                //echo $query;
//                $jumlah = $this->db->query($query);
//
//                return $jumlah;
//	}
        function get_namarayon($searchField,$searchString, $sidx, $sord, $limit, $start,$rayon,$wilayah,$mitra)
	{

                $query=('select * from v_master_rayon
                         where id_rayon>0 ');


                if($rayon != '')
                {
                $query=$query.(" and id_rayon=".$rayon);
                }if($wilayah != '')
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
                if($limit != '')
                {
                $query=$query." order by ".$sidx." ".$sord." LIMIT ".$start.", ".$limit;
                }
                //echo $query;
                $jumlah = $this->db->query($query);

                return $jumlah;
	}

        
        

	function insert_rayon($datanya) 
	{
		return $this->db->insert('rayon_karyawan',$datanya);
	}
	function update_rayon($rayon_id,$datanya) 
	{
		$this->db->where('id_rayon',$rayon_id);
		return $this->db->update('rayon_karyawan',$datanya);
	}
	function delete_rayon($rayon_id) 
	{
		$this->db->where('id_rayon', $rayon_id);
		$this->db->delete('rayon_karyawan'); 
	}
}