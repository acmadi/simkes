<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_transaksi extends CI_Model {
    function __construct() 
    {
        parent::__construct();
    }

    
    function get_maxid()
    {
        $this->db->select_max('id_transaksi');
        $hasil=$this->db->get('transaksi');
        return $hasil->result_array();
    }
    function delete_transaksi($id_transaksi)
    {

        $this->db->where('id_transaksi', $id_transaksi);
	$this->db->delete('transaksi');
    }
    function count_transaksiterbesar($searchField,$searchString,$rayon,$wilayah,$mitra,$bulan,$tahun)
	{
		$query=('select * from v_summarytransaksiterbesar where id_rayon > 0 ');
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


                $jumlah = $this->db->query($query);
                return $jumlah->num_rows();
        }
    function getTransaksiterbesar($searchField,$searchString, $sidx, $sord, $limit, $start,$rayon,$wilayah,$mitra,$bulan,$tahun)
    {
        $query=('select * from v_summarytransaksiterbesar where id_rayon > 0 ');
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



                $query=$query." order by ".$sidx." ".$sord." LIMIT ".$start.", ".$limit;
               //echo $query;
                $jumlah = $this->db->query($query);

                //echo $query;
                return $jumlah;
    }

    function count_jabatanterbesar($searchField,$searchString,$rayon,$wilayah,$mitra,$bulan,$tahun)
	{
		$query=('select * from v_summaryjabatanterbanyak where id_rayon>0 ');
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


                $jumlah = $this->db->query($query);
                return $jumlah->num_rows();
        }
    function getJabatanterbesar($searchField,$searchString, $sidx, $sord, $limit, $start,$rayon,$wilayah,$mitra,$bulan,$tahun)
    {
        $query=('select *, sum(total) as total1 from v_summaryjabatanterbanyak where id_rayon>0 ');
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
                $query=$query." group by  nama_bagian order by nama_bagian desc";
               //echo $query;
                $jumlah = $this->db->query($query);

                //echo $query;
                return $jumlah;
    }

    function getPostbiaya($searchField,$searchString, $sidx, $sord, $limit, $start,$rayon,$wilayah,$mitra,$bulan,$tahun)
    {        
//                $query=('SELECT  *, COUNT(*) AS jumlah, SUM(`total_transaksi`) AS total FROM `v_summarypostbiayaall`
//                        where id_rayon>0 ');
                $query=('SELECT  *, COUNT(*) AS jumlah, SUM(`total`) AS total FROM `v_totaltransaksi` v
                        where id_rayon>0 ');
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
                $query .=" GROUP BY `id_rayon`,`jenis_penyakit`,`ap`,v.`status` ";
                //echo $query;
                

        $jumlah = $this->db->query($query);

                //echo $query;
                return $jumlah;
    }
    
}