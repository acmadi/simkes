<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_penunjang extends CI_Model {
	function __construct() 
	{
        parent::__construct();
    }
	
	
	function get_jmlPenunjang($rayon,$wilayah,$mitra,$bulan,$tahun,$tgl1,$tgl2,$jns_tanggal,$id_rujukan)
	{

                $query=('select count(distinct id_transaksi) from v_hasiltransaksipenunjang where id_rayon>0 ');
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
                $query=$query.(" and month(".$jns_tanggal.")=".$bulan);
                }
                if($tahun != '')
                {
                $query=$query.(" and YEAR(".$jns_tanggal.")=".$tahun);
                }
                if($id_rujukan != '')
                {
                $query=$query.(" and id_rujukan=".$id_rujukan);
                }



                if($tgl2 != '')
                {
                $query=$query.(" and ".$jns_tanggal." BETWEEN '".$tgl1."' AND '".$tgl2."'");
                }
                $jumlah = $this->db->query($query);

                return $jumlah;


	}

}