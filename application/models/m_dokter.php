<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_dokter extends CI_Model {
	function __construct() 
	{
        parent::__construct();
    }
	
	
	
	function count_dokter($like) 
	{
		$like != '' ? $this->db->like($like) : '';
		
        return $this->db->count_all('v_master_dokter');
    }
	function get_dokter($like, $sidx, $sord, $limit, $start) 
	{
		$like != '' ? $this->db->like($like) : '';
		$this->db->order_by($sidx, $sord);
		return $this->db->get('v_master_dokter', $limit, $start);
	}
	function insert_dokter($datanya) 
	{
		return $this->db->insert('master_dokter',$datanya);
	}
	function update_dokter($dokter_id,$datanya) 
	{
		$this->db->where('id_dokter',$dokter_id);
		return $this->db->update('master_dokter',$datanya);
	}
	function delete_dokter($dokter_id) 
	{
		$this->db->where('id_dokter', $dokter_id);
		$this->db->delete('master_dokter'); 
	}

        function getDokterterbesar($searchField,$searchString, $sidx, $sord, $limit, $start,$rayon,$wilayah,$mitra,$bulan,$tahun)
        {
        $query=('select * from v_summarydokter where id_rayon>0 ');
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
                if($bulan != '')
                {
                $query=$query.(" and month(tgl_transaksi)=".$bulan);
                }
                if($tahun != '')
                {
                $query=$query.(" and YEAR(tgl_transaksi)=".$tahun);
                }


                if($searchField != '')
                {
                $query=$query.(" and ".$searchField." LIKE '%".$searchString."%' ");
                }



               // $query=$query." order by ".$sidx." ".$sord." LIMIT ".$start.", ".$limit;
                $query=$query." group by  kat_dokter ";
               //echo $query;
                $jumlah = $this->db->query($query);

                //echo $query;
                return $jumlah;
        }
    function caridokterrujukan($keyword,$kat_dokter,$gol_dokter)
    {
        $this->db->select('id_dokter, nama_dokter,tarif_standar, tarif_dokter');
        $this->db->where('kat_dokter',$kat_dokter);
        $this->db->where('gol_dokter',$gol_dokter);
        $this->db->like('nama_dokter',$keyword,'after');
        $this->db->limit('10');
        $query = $this->db->get('master_dokter');
        return $query->result_array();
    }
}