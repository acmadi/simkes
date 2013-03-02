<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_item extends CI_Model {
	function __construct() 
	{
        parent::__construct();
    }
	function get_spesialis($rayon,$wilayah,$mitra,$bulan,$tahun)
        {
             $query=('select count(*) as jumlah from v_summaryspesialis v where id_rayon>0');
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



                 //echo $query;
                $jumlah = $this->db->query($query);


                return $jumlah;
        }
        function get_restitusi($rayon,$wilayah,$mitra,$bulan,$tahun)
        {
             $query=('select count(*) as jumlah from v_summaryrestitusi v where id_rayon>0');
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



                 //echo $query;
                $jumlah = $this->db->query($query);


                return $jumlah;
        }
        function get_dak($rayon,$wilayah,$mitra,$bulan,$tahun)
        {
             $query=('select count(*) as jumlah from v_hasiltransaksidak v where id_rayon>0');
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



                 //echo $query;
                $jumlah = $this->db->query($query);


                return $jumlah;
        }
        function get_rawatinap($rayon,$wilayah,$mitra,$bulan,$tahun)
        {
             $query=('select count(*) as jumlah from v_summaryrawatinap v where id_rayon>0');
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


                 //echo $query;
                $jumlah = $this->db->query($query);


                return $jumlah;
        }

        function get_obatterbanyak($rayon,$wilayah,$mitra,$bulan,$tahun)
        {
             $query=('select *,count(nama_item) as jumlah from v_summaryobatterbanyak v where id_rayon>0');
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



                $query .=" group by nama_item ";
                 //echo $query;
                $jumlah = $this->db->query($query);


                return $jumlah;
        }


	function get_jnsitem()
	{
		$query = $this->db->get('jenis_item');
		if($query->num_rows() >0)
		{
		foreach($query->result() as $row)
		{
		$data[] = $row;
		}
		return $data;
		}

	}
	
	function count_item($like) 
	{
		$like != '' ? $this->db->like($like) : '';
		
        return $this->db->count_all('master_item');
    }
	function get_item($searchField,$searchString, $sidx, $sord, $limit, $start)
	{

                $query=('select * from v_master_item');

                if($searchField != '')
                {
                $query=$query.(" where ".$searchField." LIKE '%".$searchString."%' ");
                }



                if($limit != '')
                {
                $query=$query." order by ".$sidx." ".$sord." LIMIT ".$start.", ".$limit;
                }
                //echo $query;
                $jumlah = $this->db->query($query);


                return $jumlah;
	}
	
	function insert_item($datanya) 
	{
		return $this->db->insert('master_item',$datanya);
	}
	function update_item($item_id,$datanya) 
	{
		$this->db->where('id_item',$item_id);
		return $this->db->update('master_item',$datanya);
	}
	function delete_item($item_id) 
	{
		$this->db->where('id_item', $item_id);
		$this->db->delete('master_item'); 
	}
}