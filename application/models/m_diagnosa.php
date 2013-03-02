<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_diagnosa extends CI_Model {
	function __construct() 
	{
        parent::__construct();
    }
        function get_penyakitterbanyak($rayon,$wilayah,$mitra,$bulan,$tahun)
	{

                 $query=('select *,count(*) as jumlah from v_summarypenyakitterbanyak v where id_rayon>0');
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



                $query .=" group by nama_diagnosa ";
                 //echo $query;
                $jumlah = $this->db->query($query);


                return $jumlah;
	}
    
	
	function count_diagnosa($like) 
	{
		$like != '' ? $this->db->like($like) : '';
		
        return $this->db->count_all('master_diagnosa');
    }
	function get_diagnosa($like, $sidx, $sord, $limit, $start) 
	{
		$like != '' ? $this->db->like($like) : '';
		$this->db->order_by($sidx, $sord);
		return $this->db->get('master_diagnosa', $limit, $start);
	}

	function insert_diagnosa($datanya) 
	{
		return $this->db->insert('master_diagnosa',$datanya);
	}
	function update_diagnosa($diagnosa_id,$datanya) 
	{
		$this->db->where('id_diagnosa',$diagnosa_id);
		return $this->db->update('master_diagnosa',$datanya);
	}
	function delete_diagnosa($diagnosa_id) 
	{
		$this->db->where('id_diagnosa', $diagnosa_id);
		$this->db->delete('master_diagnosa'); 
	}
        function get10penyakit($rayon,$wilayah,$mitra,$bulan,$tahun)
        {
                 $query=('select nama_diagnosa, count(*) as jumlah from v_laporandiagnosa where id_rayon>0');
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



                $query .=" group by nama_diagnosa ";
                $query .=" order by jumlah desc";
                $query .=" limit 0,9 ";
                 //echo $query;
                $jumlah = $this->db->query($query);


                return $jumlah;
        }

        function get10penyakitpenunjang($rayon,$wilayah,$mitra,$bulan,$tahun)
        {
                 $query=('select nama_diagnosa, count(*) as jumlah from v_laporandiagnosa vl, transaksi_penunjang tp where id_rayon>0 and vl.id_transaksi = tp.id_transaksi' );
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



                $query .=" group by nama_diagnosa ";
                $query .=" order by jumlah desc";
                $query .=" limit 0,9 ";
                 //echo $query;
                $jumlah = $this->db->query($query);


                return $jumlah;
        }
}