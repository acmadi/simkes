<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_karyawan extends CI_Model {
	function __construct() 
	{
        parent::__construct();
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

        function get_allkaryawan()
        {
            $query=("SELECT * from master_karyawan ");
            $jumlah = $this->db->query($query);
            return $jumlah;

        }
	
	
	function count_karyawan($like, $sidx, $sord,$rayon,$wilayah,$mitra,$searchField,$searchString)
	{
		 $query=('select * from v_master_karyawan where id_rayon>0 ');
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
	function get_karyawan($like, $sidx, $sord, $limit, $start,$rayon,$wilayah,$mitra,$searchField,$searchString)
	{
		 $query=('select * from v_master_karyawan where id_rayon>0 ');
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

                if($sidx != '')
                {
                $query=$query." order by ".$sidx." ".$sord;
                }
                

                if($limit != null)
                {
                 $query .= " LIMIT ".$start.", ".$limit;
                }
                
               //echo $query;
                $jumlah = $this->db->query($query);


                return $jumlah;
	}

        function cek_karyawan($id)
        {
        $query = ("select * from master_karyawan where nip='".$id."'");
        //$this->db->where('nip',$id);
        //$query = $this->db->get('master_karyawan');
        $jumlah=$this->db->query($query);
        return $jumlah->result_array();
        }
	
	function get_kar($like, $sidx, $sord, $limit, $start)
	{
		
		$query = "select a.id_karyawan,a.tgl_lahir,a.nama_karyawan,b.nama_rayon,c.nama_bagian,a.alamat,a.sex,a.telp,a.ttl,a.ap,a.status,a.kelas_kamar from master_karyawan as a,rayon_karyawan as b,bagian_karyawan as c
				  where a.id_rayon = b.id_rayon and a.id_bagian = c.id_bagian order by ? ? limit ".$start." ,".$limit." ?";
		$tangkap = $this->db->query($query,array($sidx,$sord));
		if($tangkap->num_rows() > 0)
		{foreach($tangkap->result() as $row)
		{
		$data[] = $row;
		
		}
		return $data;
		}
	}
	
	
	function insert_karyawan($datanya) 
	{
		return $this->db->insert('master_karyawan',$datanya);
	}
	function update_karyawan($karyawan_id,$datanya) 
	{
		$this->db->where('id_karyawan',$karyawan_id);
		return $this->db->update('master_karyawan',$datanya);
	}
	function delete_karyawan($karyawan_id) 
	{
		$this->db->where('id_karyawan', $karyawan_id);
		$this->db->delete('master_karyawan'); 
	}
}