<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_hasil_transaksi extends CI_Model {
	function __construct() 
	{
        parent::__construct();
    }
	
	function count_Rumahsakit($like) 
	{
		$like != '' ? $this->db->like($like) : '';
		$this->db->where('idjenis_provider',1);
		$jumlah=$this->db->get('master_provider');
		
        return $jumlah->num_rows();
        }

        function get_Rumahsakit($like, $sidx, $sord, $limit, $start)
	{
		$like != '' ? $this->db->like($like) : '';
		$this->db->where('idjenis_provider',1);
		$this->db->order_by($sidx, $sord);
		return $this->db->get('master_provider', $limit, $start);
	}
	
	

        function count_Apotek($searchField,$searchString,$rayon,$wilayah,$mitra,$bulan,$tahun,$tgl1,$tgl2,$jns_tanggal)
	{
		
                $query=('select *, sum(total) as total, sum(koreksi) as koreksi, sum(selisih) as selisih from v_hasiltransaksiapotek where id_rayon>0 ');
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


                if($searchField != '')
                {
                $query=$query.(" and ".$searchField." LIKE '%".$searchString."%' ");
                }

                if($tgl2 != '')
                {
                $query=$query.(" and ".$jns_tanggal." BETWEEN '".$tgl1."' AND '".$tgl2."'");
                }
                $query.=" group by id_transaksi";
                $jumlah = $this->db->query($query);
                return $jumlah->num_rows();


	}
	
	function get_Apotek($searchField,$searchString, $sidx, $sord, $limit, $start,$rayon,$wilayah,$mitra,$bulan,$tahun,$tgl1,$tgl2,$jns_tanggal)
	{
		
                 $query=('select *, sum(total) as total, sum(koreksi) as koreksi, sum(selisih) as selisih from v_hasiltransaksiapotek where id_rayon>0 ');
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


                if($searchField != '')
                {
                $query=$query.(" and ".$searchField." LIKE '%".$searchString."%' ");
                }

                if($tgl2 != '')
                {
                $query=$query.(" and ".$jns_tanggal." BETWEEN '".$tgl1."' AND '".$tgl2."'");
                }

                $query.=" group by id_transaksi";
                $query=$query." order by ".$sidx." ".$sord." LIMIT ".$start.", ".$limit;
               //echo $query;
                $jumlah = $this->db->query($query);

                
                return $jumlah;
	}

        function export_Apotek($like, $sidx, $sord, $limit, $start)
	{
		$like != '' ? $this->db->like($like) : '';
		$this->db->order_by($sidx, $sord);
		return $this->db->get('v_hasiltransapotek', $limit, $start);
	}

	function count_Dak($searchField,$searchString,$rayon,$wilayah,$mitra,$bulan,$tahun,$tgl1,$tgl2,$jns_tanggal)
	{

                $query=('select * from v_hasiltransaksidak where id_rayon>0 ');
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


                if($searchField != '')
                {
                $query=$query.(" and ".$searchField." LIKE '%".$searchString."%' ");
                }

                if($tgl2 != '')
                {
                $query=$query.(" and ".$jns_tanggal." BETWEEN '".$tgl1."' AND '".$tgl2."'");
                }
                $jumlah = $this->db->query($query);

                return $jumlah->num_rows();


	}

	
	function get_Dak($searchField,$searchString, $sidx, $sord, $limit, $start,$rayon,$wilayah,$mitra,$bulan,$tahun,$tgl1,$tgl2,$jns_tanggal)
	{

                 $query=('select * from v_hasiltransaksidak where id_rayon>0 ');
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


                if($searchField != '')
                {
                $query=$query.(" and ".$searchField." LIKE '%".$searchString."%' ");
                }

                if($tgl2 != '')
                {
                $query=$query.(" and ".$jns_tanggal." BETWEEN '".$tgl1."' AND '".$tgl2."'");
                }
                if($limit != '')
                {
                $query=$query." order by ".$sidx." ".$sord." LIMIT ".$start.", ".$limit;

                }
                //echo $query;
                $jumlah = $this->db->query($query);

                //echo $query;
                return $jumlah;
	}
	
	function count_Dokter($searchField,$searchString,$rayon,$wilayah,$mitra,$bulan,$tahun,$tgl1,$tgl2,$jns_tanggal)
	{

                $query=('select * from v_hasiltransaksidokter where id_rayon>0 ');
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


                if($searchField != '')
                {
                $query=$query.(" and ".$searchField." LIKE '%".$searchString."%' ");
                }

                if($tgl2 != '')
                {
                $query=$query.(" and ".$jns_tanggal." BETWEEN '".$tgl1."' AND '".$tgl2."'");
                }
                $jumlah = $this->db->query($query);

                return $jumlah->num_rows();


	}


	function get_Dokter($searchField,$searchString, $sidx, $sord, $limit, $start,$rayon,$wilayah,$mitra,$bulan,$tahun,$tgl1,$tgl2,$jns_tanggal)
	{

                 $query=('select * from v_hasiltransaksidokter where id_rayon>0 ');
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


                if($searchField != '')
                {
                $query=$query.(" and ".$searchField." LIKE '%".$searchString."%' ");
                }

                if($tgl2 != '')
                {
                $query=$query.(" and ".$jns_tanggal." BETWEEN '".$tgl1."' AND '".$tgl2."'");
                }
                if($limit != '')
                {
                $query=$query." order by ".$sidx." ".$sord." LIMIT ".$start.", ".$limit;

                }
                //echo $query;
                $jumlah = $this->db->query($query);


                return $jumlah;
	}

	
	function count_Gigi($searchField,$searchString,$rayon,$wilayah,$mitra,$bulan,$tahun,$tgl1,$tgl2,$jns_tanggal)
	{

                $query=('select * from v_hasiltransaksigigi where id_rayon>0 ');
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


                if($searchField != '')
                {
                $query=$query.(" and ".$searchField." LIKE '%".$searchString."%' ");
                }

                if($tgl2 != '')
                {
                $query=$query.(" and ".$jns_tanggal." BETWEEN '".$tgl1."' AND '".$tgl2."'");
                }
                $jumlah = $this->db->query($query);

                return $jumlah->num_rows();


	}


	function get_Gigi($searchField,$searchString, $sidx, $sord, $limit, $start,$rayon,$wilayah,$mitra,$bulan,$tahun,$tgl1,$tgl2,$jns_tanggal)
	{

                 $query=('select * from v_hasiltransaksigigi where id_rayon>0 ');
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


                if($searchField != '')
                {
                $query=$query.(" and ".$searchField." LIKE '%".$searchString."%' ");
                }

                if($tgl2 != '')
                {
                $query=$query.(" and ".$jns_tanggal." BETWEEN '".$tgl1."' AND '".$tgl2."'");
                }

                if($limit != '')
                {
                $query=$query." order by ".$sidx." ".$sord." LIMIT ".$start.", ".$limit;

                }
                ////echo $query;
                $jumlah = $this->db->query($query);


                return $jumlah;
	}

	
	function count_Lab($searchField,$searchString,$rayon,$wilayah,$mitra,$bulan,$tahun,$tgl1,$tgl2,$jns_tanggal)
	{

                $query=('select * from v_hasiltransaksilab where id_rayon>0 ');
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


                if($searchField != '')
                {
                $query=$query.(" and ".$searchField." LIKE '%".$searchString."%' ");
                }

                if($tgl2 != '')
                {
                $query=$query.(" and ".$jns_tanggal." BETWEEN '".$tgl1."' AND '".$tgl2."'");
                }
                $jumlah = $this->db->query($query);

                return $jumlah->num_rows();


	}


	function get_Lab($searchField,$searchString, $sidx, $sord, $limit, $start,$rayon,$wilayah,$mitra,$bulan,$tahun,$tgl1,$tgl2,$jns_tanggal)
	{

                 $query=('select * from v_hasiltransaksilab where id_rayon>0 ');
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


                if($searchField != '')
                {
                $query=$query.(" and ".$searchField." LIKE '%".$searchString."%' ");
                }

                if($tgl2 != '')
                {
                $query=$query.(" and ".$jns_tanggal." BETWEEN '".$tgl1."' AND '".$tgl2."'");
                }
                if($limit != '')
                {
                $query=$query." order by ".$sidx." ".$sord." LIMIT ".$start.", ".$limit;

                }
               //echo $query;
                $jumlah = $this->db->query($query);


                return $jumlah;
	}

	
	function count_Lain($searchField,$searchString,$rayon,$wilayah,$mitra,$bulan,$tahun,$tgl1,$tgl2,$jns_tanggal)
	{

                $query=('select * from v_hasiltransaksilain where id_rayon>0 ');
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


                if($searchField != '')
                {
                $query=$query.(" and ".$searchField." LIKE '%".$searchString."%' ");
                }

                if($tgl2 != '')
                {
                $query=$query.(" and ".$jns_tanggal." BETWEEN '".$tgl1."' AND '".$tgl2."'");
                }
                $jumlah = $this->db->query($query);

                return $jumlah->num_rows();


	}


	function get_Lain($searchField,$searchString, $sidx, $sord, $limit, $start,$rayon,$wilayah,$mitra,$bulan,$tahun,$tgl1,$tgl2,$jns_tanggal)
	{

                 $query=('select * from v_hasiltransaksilain where id_rayon>0 ');
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


                if($searchField != '')
                {
                $query=$query.(" and ".$searchField." LIKE '%".$searchString."%' ");
                }

                if($tgl2 != '')
                {
                $query=$query.(" and ".$jns_tanggal." BETWEEN '".$tgl1."' AND '".$tgl2."'");
                }
                if($limit != '')
                {
                $query=$query." order by ".$sidx." ".$sord." LIMIT ".$start.", ".$limit;

                }
               //echo $query;
                $jumlah = $this->db->query($query);


                return $jumlah;
	}

	
	
	function count_Optik($searchField,$searchString,$rayon,$wilayah,$mitra,$bulan,$tahun,$tgl1,$tgl2,$jns_tanggal)
	{

                $query=('select * from v_hasiltransaksioptik where id_rayon>0 ');
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


                if($searchField != '')
                {
                $query=$query.(" and ".$searchField." LIKE '%".$searchString."%' ");
                }

                if($tgl2 != '')
                {
                $query=$query.(" and ".$jns_tanggal." BETWEEN '".$tgl1."' AND '".$tgl2."'");
                }
                $jumlah = $this->db->query($query);

                return $jumlah->num_rows();


	}


	function get_Optik($searchField,$searchString, $sidx, $sord, $limit, $start,$rayon,$wilayah,$mitra,$bulan,$tahun,$tgl1,$tgl2,$jns_tanggal)
	{

                 $query=('select * from v_hasiltransaksioptik where id_rayon>0 ');
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


                if($searchField != '')
                {
                $query=$query.(" and ".$searchField." LIKE '%".$searchString."%' ");
                }

                if($tgl2 != '')
                {
                $query=$query.(" and ".$jns_tanggal." BETWEEN '".$tgl1."' AND '".$tgl2."'");
                }
                if($limit != '')
                {
                $query=$query." order by ".$sidx." ".$sord." LIMIT ".$start.", ".$limit;

                }
               //echo $query;
                $jumlah = $this->db->query($query);


                return $jumlah;
	}

	
	function count_Penunjang($searchField,$searchString,$rayon,$wilayah,$mitra,$bulan,$tahun,$tgl1,$tgl2,$jns_tanggal)
	{

                $query=('select * from v_hasiltransaksipenunjang where id_rayon>0 ');
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


                if($searchField != '')
                {
                $query=$query.(" and ".$searchField." LIKE '%".$searchString."%' ");
                }

                if($tgl2 != '')
                {
                $query=$query.(" and ".$jns_tanggal." BETWEEN '".$tgl1."' AND '".$tgl2."'");
                }
                $jumlah = $this->db->query($query);

                return $jumlah->num_rows();


	}


	function get_Penunjang($searchField,$searchString, $sidx, $sord, $limit, $start,$rayon,$wilayah,$mitra,$bulan,$tahun,$tgl1,$tgl2,$jns_tanggal)
	{

                 $query=('select * from v_hasiltransaksipenunjang where id_rayon>0 ');
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


                if($searchField != '')
                {
                $query=$query.(" and ".$searchField." LIKE '%".$searchString."%' ");
                }

                if($tgl2 != '')
                {
                $query=$query.(" and ".$jns_tanggal." BETWEEN '".$tgl1."' AND '".$tgl2."'");
                }
                if($limit != '')
                {
                $query=$query." order by ".$sidx." ".$sord." LIMIT ".$start.", ".$limit;

                }
               //echo $query;
                $jumlah = $this->db->query($query);


                return $jumlah;
	}

	
	function count_Rs($searchField,$searchString,$rayon,$wilayah,$mitra,$bulan,$tahun,$tgl1,$tgl2,$jns_tanggal)
	{

                $query=('select * from v_hasiltransaksirs where id_rayon>0 ');
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


                if($searchField != '')
                {
                $query=$query.(" and ".$searchField." LIKE '%".$searchString."%' ");
                }

                if($tgl2 != '')
                {
                $query=$query.(" and ".$jns_tanggal." BETWEEN '".$tgl1."' AND '".$tgl2."'");
                }
                $jumlah = $this->db->query($query);

                return $jumlah->num_rows();


	}


	function get_Rs($searchField,$searchString, $sidx, $sord, $limit, $start,$rayon,$wilayah,$mitra,$bulan,$tahun,$tgl1,$tgl2,$jns_tanggal)
	{

                 $query=('select * from v_hasiltransaksirs where id_rayon>0 ');
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


                if($searchField != '')
                {
                $query=$query.(" and ".$searchField." LIKE '%".$searchString."%' ");
                }

                if($tgl2 != '')
                {
                $query=$query.(" and ".$jns_tanggal." BETWEEN '".$tgl1."' AND '".$tgl2."'");
                }
                if($limit != '')
                {
                $query=$query." order by ".$sidx." ".$sord." LIMIT ".$start.", ".$limit;

                }
               //echo $query;
                $jumlah = $this->db->query($query);


                return $jumlah;
	}

        function count_Rm($searchField,$searchString,$rayon,$wilayah,$mitra,$bulan,$tahun,$tgl1,$tgl2,$jns_tanggal)
	{

                $query=('select * from v_hasiltransaksirm where id_rayon>0 ');
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


                if($searchField != '')
                {
                $query=$query.(" and ".$searchField." LIKE '%".$searchString."%' ");
                }

                if($tgl2 != '')
                {
                $query=$query.(" and ".$jns_tanggal." BETWEEN '".$tgl1."' AND '".$tgl2."'");
                }
                $jumlah = $this->db->query($query);

                return $jumlah->num_rows();


	}


	function get_Rm($searchField,$searchString, $sidx, $sord, $limit, $start,$rayon,$wilayah,$mitra,$bulan,$tahun,$tgl1,$tgl2,$jns_tanggal)
	{

                 $query=('select * from v_hasiltransaksirm where id_rayon>0 ');
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


                if($searchField != '')
                {
                $query=$query.(" and ".$searchField." LIKE '%".$searchString."%' ");
                }

                if($tgl2 != '')
                {
                $query=$query.(" and ".$jns_tanggal." BETWEEN '".$tgl1."' AND '".$tgl2."'");
                }
                if($limit != '')
                {
                $query=$query." order by ".$sidx." ".$sord." LIMIT ".$start.", ".$limit;

                }
               //echo $query;
                $jumlah = $this->db->query($query);


                return $jumlah;
	}

	function count_Kunjunganrs($searchField,$searchString,$rayon,$wilayah,$mitra,$bulan,$tahun,$tgl1,$tgl2,$jns_tanggal)
	{

                $query=('select * from v_hasiltransaksikunjunganrs where id_rayon>0 ');
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


                if($searchField != '')
                {
                $query=$query.(" and ".$searchField." LIKE '%".$searchString."%' ");
                }

                if($tgl2 != '')
                {
                $query=$query.(" and ".$jns_tanggal." BETWEEN '".$tgl1."' AND '".$tgl2."'");
                }
                $jumlah = $this->db->query($query);

                return $jumlah->num_rows();


	}


	function get_Kunjunganrs($searchField,$searchString, $sidx, $sord, $limit, $start,$rayon,$wilayah,$mitra,$bulan,$tahun,$tgl1,$tgl2,$jns_tanggal)
	{

                 $query=('select * from v_hasiltransaksikunjunganrs where id_rayon>0 ');
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


                if($searchField != '')
                {
                $query=$query.(" and ".$searchField." LIKE '%".$searchString."%' ");
                }

                if($tgl2 != '')
                {
                $query=$query.(" and ".$jns_tanggal." BETWEEN '".$tgl1."' AND '".$tgl2."'");
                }
                if($limit != '')
                {
                $query=$query." order by ".$sidx." ".$sord." LIMIT ".$start.", ".$limit;

                }
               //echo $query;
                $jumlah = $this->db->query($query);


                return $jumlah;
	}

        function get_total($rayon,$wilayah,$mitra,$id_rekomendasi,$bulan,$tahun)
        {
        $query = ("select sum(total) from v_totaltransaksi where id_rayon>0");
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
        if($id_rekomendasi != null)
        {
            $query .= " and id_rekomendasi= '".$id_rekomendasi."'";

        }
//        if($tgl2 != '')
//        {
//                $query=$query.(" and tgl_transaksi BETWEEN '".$tgl1."' AND '".$tgl2."'");
//        }
        if($bulan != '')
                {
                $query=$query.(" and month(tgl_transaksi)=".$bulan);
                }
        if($tahun != '')
                {
                $query=$query.(" and YEAR(tgl_transaksi)=".$tahun);
                }
         $jumlah=$this->db->query($query);
        //return $jumlah->result_array();
        return $jumlah;
                
	}
        function count_langganan($rayon,$wilayah,$mitra,$tgl1,$tgl2)
        {
        $query = ("select count(distinct id_transaksi) from v_laporanrawatjalan where id_rayon>0 and restitusi='t' ");
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
        if($tgl2 != '')
        {
                $query=$query.(" and tgl_transaksi BETWEEN '".$tgl1."' AND '".$tgl2."'");
        }
         $jumlah=$this->db->query($query);
        return $jumlah;

        }
        function count_restitusi($rayon,$wilayah,$mitra,$tgl1,$tgl2)
        {
        $query = ("select count(distinct id_transaksi) from v_laporanrawatjalan where id_rayon>0 and restitusi='y' ");
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
        if($tgl2 != '')
        {
                $query=$query.(" and tgl_transaksi BETWEEN '".$tgl1."' AND '".$tgl2."'");
        }
         $jumlah=$this->db->query($query);
        return $jumlah;

        }
        function count_rawat_inap($rayon,$wilayah,$mitra,$tgl1,$tgl2)
        {
        $query = ("select count(distinct id_transaksi) from v_laporanrawatinap where id_rayon>0 ");
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
        if($tgl2 != '')
        {
                $query=$query.(" and tgl_transaksi BETWEEN '".$tgl1."' AND '".$tgl2."'");
        }
         $jumlah=$this->db->query($query);
        return $jumlah;

        }
        function count_rawat_jalan($rayon,$wilayah,$mitra,$bulan,$tahun)
        {
        $query = ("select count(distinct id_transaksi) from v_laporanrawatjalan where id_rayon>0 ");
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
//        if($tgl2 != '')
//        {
//                $query=$query.(" and tgl_transaksi BETWEEN '".$tgl1."' AND '".$tgl2."'");
//        }
        if($bulan != '')
                {
                $query=$query.(" and month(tgl_transaksi)=".$bulan);
                }
        if($tahun != '')
                {
                $query=$query.(" and YEAR(tgl_transaksi)=".$tahun);
                }
         $jumlah=$this->db->query($query);
        return $jumlah;

        }
        function get_langgananumum($rayon,$wilayah,$mitra,$tgl1,$tgl2)
        {
        $query = ("select sum(total) from v_totaltransaksi where id_rayon>0 and restitusi='t' and kat_dokter=2");
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
        if($tgl2 != '')
        {
                $query=$query.(" and tgl_transaksi BETWEEN '".$tgl1."' AND '".$tgl2."'");
        }
         $jumlah=$this->db->query($query);
        //return $jumlah->result_array();
        return $jumlah;

	}
        function get_langgananspesialis($rayon,$wilayah,$mitra,$tgl1,$tgl2)
        {
        $query = ("select sum(total) from v_totaltransaksi where id_rayon>0 and restitusi='t' and kat_dokter=1");
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
        if($tgl2 != '')
        {
                $query=$query.(" and tgl_transaksi BETWEEN '".$tgl1."' AND '".$tgl2."'");
        }
         $jumlah=$this->db->query($query);
        //return $jumlah->result_array();
        return $jumlah;

	}
        function get_restitusiumum($rayon,$wilayah,$mitra,$tgl1,$tgl2)
        {
        $query = ("select sum(total) from v_totaltransaksi where id_rayon>0 and restitusi='y' and kat_dokter=2");
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
        if($tgl2 != '')
        {
                $query=$query.(" and tgl_transaksi BETWEEN '".$tgl1."' AND '".$tgl2."'");
        }
         $jumlah=$this->db->query($query);
        //return $jumlah->result_array();
        return $jumlah;

	}
        function get_restitusispesialis($rayon,$wilayah,$mitra,$tgl1,$tgl2)
        {
        $query = ("select sum(total) from v_totaltransaksi where id_rayon>0 and restitusi='y' and kat_dokter=1");
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
        if($tgl2 != '')
        {
                $query=$query.(" and tgl_transaksi BETWEEN '".$tgl1."' AND '".$tgl2."'");
        }
         $jumlah=$this->db->query($query);
        //return $jumlah->result_array();
        return $jumlah;

	}
        function get_rawatinap($rayon,$wilayah,$mitra,$bulan,$tahun)
        {
        $query = ("select sum(total_harga) from v_laporanrawatinap where id_rayon>0 ");
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
//        if($tgl2 != '')
//        {
//                $query=$query.(" and tgl_transaksi BETWEEN '".$tgl1."' AND '".$tgl2."'");
//        }
          if($bulan != '')
                {
                $query=$query.(" and month(tgl_transaksi)=".$bulan);
                }
         if($tahun != '')
                {
                $query=$query.(" and YEAR(tgl_transaksi)=".$tahun);
                }
         $jumlah=$this->db->query($query);
        //return $jumlah->result_array();
        return $jumlah;
	}
        function get_jmlperiksadak($rayon,$wilayah,$mitra,$jns_kunjungan,$tgl1,$tgl2)
        {
        $query = ("select count(distinct id_transaksi) from v_laporanperiksadak where idjenis_kunjungan=".$jns_kunjungan);
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
        if($tgl2 != '')
        {
                $query=$query.(" and tgl_transaksi BETWEEN '".$tgl1."' AND '".$tgl2."'");
        }
         $jumlah=$this->db->query($query);
        //return $jumlah->result_array();
        return $jumlah;

        }
        function get_jmlrujukan($rayon,$wilayah,$mitra,$kat_dokter,$tgl1,$tgl2)
        {
        $query = ("select count(distinct id_transaksi) from v_totaltransaksi where id_rayon>0 and kat_dokter=".$kat_dokter);
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
        if($tgl2 != '')
        {
                $query=$query.(" and tgl_transaksi BETWEEN '".$tgl1."' AND '".$tgl2."'");
        }
         $jumlah=$this->db->query($query);
        return $jumlah;

        }
        function get_jmlkunjungan($rayon,$wilayah,$mitra,$idjenis_kunjungan,$id_rujukan,$bulan,$tahun)
        {
        $query = ("select count(distinct id_transaksi) from v_hasiltransaksidak where id_rayon>0 ");
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
        if($idjenis_kunjungan != null)
        {
            $query .= " and idjenis_kunjungan=".$idjenis_kunjungan;
        }
        if($id_rujukan != null)
        {
            $query .= " and id_rujukan=".$id_rujukan;

        }
//        if($tgl2 != '')
//        {
//                $query=$query.(" and tgl_transaksi BETWEEN '".$tgl1."' AND '".$tgl2."'");
//        }

        if($bulan != '')
                {
                $query=$query.(" and month(tgl_transaksi)=".$bulan);
                }
        if($tahun != '')
                {
                $query=$query.(" and YEAR(tgl_transaksi)=".$tahun);
                }
         $jumlah=$this->db->query($query);
        return $jumlah;

        }
        function get_jmltagihan($rayon,$wilayah,$mitra,$id_rekomendasi,$bulan,$tahun)
        {
        $query = ("select count(distinct id_transaksi) from v_totaltransaksi where id_rayon>0 ");
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
        if($id_rekomendasi != null)
        {
            $query .= " and id_rekomendasi='".$id_rekomendasi."'";

        }
//        if($tgl2 != '')
//        {
//                $query=$query.(" and tgl_transaksi BETWEEN '".$tgl1."' AND '".$tgl2."'");
//        }
        if($bulan != '')
                {
                $query=$query.(" and month(tgl_transaksi)=".$bulan);
                }
        if($tahun != '')
                {
                $query=$query.(" and YEAR(tgl_transaksi)=".$tahun);
                }
         $jumlah=$this->db->query($query);
        return $jumlah;

        }
        function get_jmlrawatjalan($rayon,$wilayah,$mitra,$restitusi,$idjns_item,$bulan,$tahun)
        {
        $query = ("select sum(total) from v_laporanrawatjalan where id_rayon>0 ");
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
        if($restitusi != '')
        {
        $query=$query.(" and restitusi= '".$restitusi."'");
        }
        if($idjns_item != '')
        {
        $query=$query.(" and idjns_item= '".$idjns_item)."'";
        }
//        if($tgl2 != '')
//        {
//                $query=$query.(" and tgl_transaksi BETWEEN '".$tgl1."' AND '".$tgl2."'");
//        }
        if($bulan != '')
                {
                $query=$query.(" and month(tgl_transaksi)=".$bulan);
                }
        if($tahun != '')
                {
                $query=$query.(" and YEAR(tgl_transaksi)=".$tahun);
                }
        //echo $query;
        $jumlah=$this->db->query($query);
        return $jumlah;
        }
        function get_jmlpenanggungrawatjalan($rayon,$wilayah,$mitra,$bulan,$tahun)
        {
        $query = ("select count(distinct nip) from v_laporanrawatjalan where id_rayon>0 ");
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
//        if($tgl2 != '')
//        {
//                $query=$query.(" and tgl_transaksi BETWEEN '".$tgl1."' AND '".$tgl2."'");
//        }
        if($bulan != '')
                {
                $query=$query.(" and month(tgl_transaksi)=".$bulan);
                }
        if($tahun != '')
                {
                $query=$query.(" and YEAR(tgl_transaksi)=".$tahun);
                }
         $jumlah=$this->db->query($query);
        return $jumlah;
        }
        function get_jmltransaksikeluarga($rayon,$wilayah,$mitra,$bulan,$tahun,$ap,$jenis_penyakit)
        {
        $query = ("select sum(total) from v_totaltransaksi vt WHERE (vt.`status`='istri' OR 'anak') and id_rayon>0  ");
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
                if($ap != '')
                {
                $query=$query.(" and ap='".$ap."'");
                }
                if($jenis_penyakit != '')
                {
                $query=$query.(" and jenis_penyakit='".$jenis_penyakit."'");
                }
//        if($tgl2 != '')
//        {
//                $query=$query.(" and tgl_transaksi BETWEEN '".$tgl1."' AND '".$tgl2."'");
//        }
        if($bulan != '')
                {
                $query=$query.(" and month(tgl_transaksi)=".$bulan);
                }
        if($tahun != '')
                {
                $query=$query.(" and YEAR(tgl_transaksi)=".$tahun);
                }
         $jumlah=$this->db->query($query);
        return $jumlah;
        }
        function get_jmltransaksiybs($rayon,$wilayah,$mitra,$bulan,$tahun,$ap,$jenis_penyakit)
        {
        $query = ("select sum(total) from v_totaltransaksi vt WHERE vt.`status`='ybs' and id_rayon>0  ");
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
                if($ap != '')
                {
                $query=$query.(" and ap='".$ap."'");
                }
                if($jenis_penyakit != '')
                {
                $query=$query.(" and jenis_penyakit='".$jenis_penyakit."'");
                }
//        if($tgl2 != '')
//        {
//                $query=$query.(" and tgl_transaksi BETWEEN '".$tgl1."' AND '".$tgl2."'");
//        }
        if($bulan != '')
                {
                $query=$query.(" and month(tgl_transaksi)=".$bulan);
                }
        if($tahun != '')
                {
                $query=$query.(" and YEAR(tgl_transaksi)=".$tahun);
                }
         $jumlah=$this->db->query($query);
        return $jumlah;
        }
        function get_jmltransaksidiagnosa($rayon,$wilayah,$mitra,$bulan,$tahun,$jenis_penyakit)
        {

        $query = ("select sum(total) from v_totaltransaksi vt WHERE id_rayon>0  ");
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
                if($jenis_penyakit != '')
                {
                $query=$query.(" and jenis_penyakit='".$jenis_penyakit."'");
                }
//        if($tgl2 != '')
//        {
//                $query=$query.(" and tgl_transaksi BETWEEN '".$tgl1."' AND '".$tgl2."'");
//        }
        if($bulan != '')
                {
                $query=$query.(" and month(tgl_transaksi)=".$bulan);
                }
        if($tahun != '')
                {
                $query=$query.(" and YEAR(tgl_transaksi)=".$tahun);
                }
         $jumlah=$this->db->query($query);
        return $jumlah;

        }

        function get_LapSAP($rayon,$wilayah,$mitra,$buku_besar)
        {

        $query = ("select id_transaksi,rj,tgl_transaksi,nip,sum(total) as total,no_bukti from v_totaltransaksi vt WHERE id_rayon>0  ");
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
                if($buku_besar != '')
                {
                $query=$query.(" and buku_besar='".$buku_besar."'");
                }
       
        $query.=" group by id_transaksi";
         $jumlah=$this->db->query($query);
        return $jumlah;

        }

        function get_jmlpenanggungrawatinap($rayon,$wilayah,$mitra,$tgl1,$tgl2)
        {
        $query = ("select count(distinct nip) from v_laporanrawatinap where id_rayon>0 ");
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
        if($tgl2 != '')
        {
                $query=$query.(" and tgl_transaksi BETWEEN '".$tgl1."' AND '".$tgl2."'");
        }
         $jumlah=$this->db->query($query);
        return $jumlah;
        }
        function get_jmlpenanggung($rayon,$wilayah,$mitra,$bulan,$tahun)
        {
        $query = ("select count(distinct nip) from v_totaltransaksi where id_rayon>0 ");
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
//        if($tgl2 != '')
//        {
//                $query=$query.(" and tgl_transaksi BETWEEN '".$tgl1."' AND '".$tgl2."'");
//        }
        if($bulan != '')
                {
                $query=$query.(" and month(tgl_transaksi)=".$bulan);
                }
        if($tahun != '')
                {
                $query=$query.(" and YEAR(tgl_transaksi)=".$tahun);
                }
         $jumlah=$this->db->query($query);
        return $jumlah;
        }
        function get_jmltransaksidiagnosarawat($rayon,$wilayah,$mitra,$bulan,$tahun,$jenis_penyakit,$rawat)
        {

        $query = ("select sum(total) from v_totaltransaksi vt WHERE id_rayon>0  ");
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
                if($jenis_penyakit != '')
                {
                $query=$query.(" and jenis_penyakit='".$jenis_penyakit."'");
                }
                if($rawat != '')
                {
                $query=$query.(" and rj='".$rawat."'");
                }
//        if($tgl2 != '')
//        {
//                $query=$query.(" and tgl_transaksi BETWEEN '".$tgl1."' AND '".$tgl2."'");
//        }
        if($bulan != '')
                {
                $query=$query.(" and month(tgl_transaksi)=".$bulan);
                }
        if($tahun != '')
                {
                $query=$query.(" and YEAR(tgl_transaksi)=".$tahun);
                }
         $jumlah=$this->db->query($query);
        return $jumlah;

        }
        function get_jmlpenanggungdiagnosa($rayon,$wilayah,$mitra,$bulan,$tahun,$jenis_penyakit,$rawat)
        {
        $query = ("select count(distinct nip) from v_totaltransaksi where id_rayon>0 ");
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

                if($jenis_penyakit != '')
                {
                $query=$query.(" and jenis_penyakit='".$jenis_penyakit."'");
                }
                if($rawat != '')
                {
                $query=$query.(" and rj='".$rawat."'");
                }
//        if($tgl2 != '')
//        {
//                $query=$query.(" and tgl_transaksi BETWEEN '".$tgl1."' AND '".$tgl2."'");
//        }
        if($bulan != '')
                {
                $query=$query.(" and month(tgl_transaksi)=".$bulan);
                }
        if($tahun != '')
                {
                $query=$query.(" and YEAR(tgl_transaksi)=".$tahun);
                }
         $jumlah=$this->db->query($query);
        return $jumlah;
        }

}