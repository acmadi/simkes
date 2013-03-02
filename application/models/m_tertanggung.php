<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_tertanggung extends CI_Model {
	function __construct() 
	{
        parent::__construct();
    }
	
	
	function ambil_bagian()
	{
	$bagian = $this->db->query("select * from bagian_tertanggung");
	if($bagian->num_rows()>0)
	{
	
	foreach($bagian->result() as $row)
	{
	 $data[]=$row;
	}
	return $data;
	}
	}
	
	function count_tertanggung($like, $sidx, $sord,$rayon,$wilayah,$mitra,$searchField,$searchString)
	{
		 $query=('select * from v_master_tertanggung where id_rayon>0 ');
                if($rayon != '')
                {
                $query=$query.(" and id_rayon=".$rayon);
                }
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

               //echo $query;
                $jumlah = $this->db->query($query);
                return $jumlah->num_rows();
		
     
    }
	function get_tertanggung($like, $sidx, $sord, $limit, $start,$rayon,$wilayah,$mitra,$searchField,$searchString)
	{
		 $query=('select * from v_master_tertanggung where id_rayon>0 ');
                if($rayon != '')
                {
                $query=$query.(" and id_rayon=".$rayon);
                }
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

                $query=$query." order by ".$sidx." ".$sord;


                if($limit != null)
                {
                 $query .= " LIMIT ".$start.", ".$limit;
                }
                
                $jumlah = $this->db->query($query);


                return $jumlah;
	}
	function insert_tertanggung($datanya) 
	{
		return $this->db->insert('master_tertanggung',$datanya);
	}
	function update_tertanggung($tertanggung_id,$datanya) 
	{
		$this->db->where('id_tertanggung',$tertanggung_id);
		return $this->db->update('master_tertanggung',$datanya);
	}
	function delete_tertanggung($tertanggung_id) 
	{
		$this->db->where('id_tertanggung', $tertanggung_id);
		$this->db->delete('master_tertanggung'); 
	}
        function cek_tertanggung($id,$nama)
        {
        $this->db->select('id_tertanggung');
        $this->db->where('id_karyawan',$id);
        $this->db->where('nama_tertanggung',$nama);
        $query = $this->db->get('master_tertanggung');
        return $query->result_array();
        }
}
