<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_laporan extends CI_Model {
	function __construct() 
	{
        parent::__construct();
    }
	
        function count_Diagnosa($searchField,$searchString,$rayon,$wilayah,$mitra,$bulan,$tahun)
	{

                $query=('select * from v_laporandiagnosa where id_rayon > 0');
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

	function get_Diagnosa($searchField,$searchString, $sidx, $sord, $limit, $start,$rayon,$wilayah,$mitra,$bulan,$tahun)
	{

                 $query=('select * from v_laporandiagnosa where id_rayon > 0');
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
                if($limit != '')
                {
                $query=$query." order by ".$sidx." ".$sord." LIMIT ".$start.", ".$limit;

                }


               //echo $query;
                $jumlah = $this->db->query($query);


                return $jumlah;
	}

	function get_Diagnosa1($searchField,$searchString, $sidx, $sord, $limit, $start,$rayon,$wilayah,$mitra,$bulan,$tahun)
	{

                 $query=('select * from v_laporandiagnosa where id_rayon > 0');
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

                $query .=" group by nama_diagnosa ";

                if($limit != '')
                {
                $query=$query." order by ".$sidx." ".$sord." LIMIT ".$start.", ".$limit;

                }


               //echo $query;
                $jumlah = $this->db->query($query);


                return $jumlah;
	}

        function gettahunkunjungandak()
        {
            $query=("SELECT DISTINCT YEAR(vlap.`tgl_kunjungan`) as tahun FROM `v_laporankunjungandak` AS vlap ");
            $jumlah = $this->db->query($query);
            return $jumlah;

        }
        function count_Kunjungandak($searchField,$searchString,$rayon,$wilayah,$mitra,$bulan,$tahun,$filter,$jenis)
	{

                $query=('select * from v_laporankunjungandak where id_rayon > 0');
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
                $query=$query.(" and month(tgl_kunjungan)=".$bulan);
                }
                if($tahun != '')
                {
                $query=$query.(" and YEAR(tgl_kunjungan)=".$tahun);
                }
                if($filter != '')
                {
                $query=$query.(" and ap="."'".$filter."'");
                }
                if($jenis != '')
                {
                $query=$query.(" and idjenis_kunjungan="."'".$jenis."'");
                }

                if($searchField != '')
                {
                $query=$query.(" and ".$searchField." LIKE '%".$searchString."%' ");
                }


                $jumlah = $this->db->query($query);

                return $jumlah->num_rows();


	}

	function get_Kunjungandak($searchField,$searchString, $sidx, $sord, $limit, $start,$rayon,$wilayah,$mitra,$bulan,$tahun,$filter,$jenis)
	{

                 $query=('select * from v_laporankunjungandak where id_rayon > 0');
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
                $query=$query.(" and month(tgl_kunjungan)=".$bulan);
                }
                if($tahun != '')
                {
                $query=$query.(" and YEAR(tgl_kunjungan)=".$tahun);
                }
                if($filter != '')
                {
                $query=$query.(" and ap="."'".$filter."'");
                }
                if($jenis != '')
                {
                $query=$query.(" and idjenis_kunjungan="."'".$jenis."'");
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
        function gettahunkunjungankesehatan()
        {
            $query=("SELECT DISTINCT YEAR(vlap.`tgl_kunjungan`) as tahun FROM `v_laporankunjungankesehatan` AS vlap ");
            $jumlah = $this->db->query($query);
            return $jumlah;

        }
        function count_Kunjungankesehatan($searchField,$searchString,$rayon,$wilayah,$mitra,$bulan,$tahun,$filter,$jenis)
	{

                $query=('select * from v_laporankunjungankesehatan where id_rayon > 0');
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
                $query=$query.(" and month(tgl_kunjungan)=".$bulan);
                }
                if($tahun != '')
                {
                $query=$query.(" and YEAR(tgl_kunjungan)=".$tahun);
                }
                if($filter != '')
                {
                $query=$query.(" and ap="."'".$filter."'");
                }
                if($jenis != '')
                {
                $query=$query.(" and idjenis_rawat="."'".$jenis."'");
                }

                if($searchField != '')
                {
                $query=$query.(" and ".$searchField." LIKE '%".$searchString."%' ");
                }


                $jumlah = $this->db->query($query);

                return $jumlah->num_rows();


	}

	function get_Kunjungankesehatan($searchField,$searchString, $sidx, $sord, $limit, $start,$rayon,$wilayah,$mitra,$bulan,$tahun,$filter,$jenis)
	{

                 $query=('select * from v_laporankunjungankesehatan where id_rayon > 0');
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
                $query=$query.(" and month(tgl_kunjungan)=".$bulan);
                }
                if($tahun != '')
                {
                $query=$query.(" and YEAR(tgl_kunjungan)=".$tahun);
                }
                if($filter != '')
                {
                $query=$query.(" and ap="."'".$filter."'");
                }

                if($jenis != '')
                {
                $query=$query.(" and idjenis_rawat="."'".$jenis."'");
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

        function gettahunrawatjalan()
        {
            $query=("SELECT DISTINCT YEAR(vlap.`tgl_kunjungan`) as tahun FROM `v_laporanrawatjalan` AS vlap ");
            $jumlah = $this->db->query($query);
            return $jumlah;

        }

        function getjnsitemrawatjalan()
        {
            $query=("SELECT * from jenis_item ");
            $jumlah = $this->db->query($query);
            return $jumlah;

        }

        function count_Rawatjalan1($searchField,$searchString,$rayon,$wilayah,$mitra,$bulan,$tahun,$filter,$restitusi)
	{

                $query=('select *, sum(total) as total from v_laporanrawatjalan where id_rayon > 0 ');
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
                $query=$query.(" and month(tgl_kunjungan)=".$bulan);
                }
                if($tahun != '')
                {
                $query=$query.(" and YEAR(tgl_kunjungan)=".$tahun);
                }
                if($filter != '')
                {
                $query=$query.(" and ap="."'".$filter."'");
                }
                if($restitusi != '')
                {
                $query=$query.(" and restitusi="."'".$restitusi."'");
                }
                
                $query .= " group by id_transaksi ";

                if($searchField != '')
                {
                $query=$query.(" and ".$searchField." LIKE '%".$searchString."%' ");
                }
             

                $jumlah = $this->db->query($query);

                return $jumlah->num_rows();


	}

	function get_Rawatjalan1($searchField,$searchString, $sidx, $sord, $limit, $start,$rayon,$wilayah,$mitra,$bulan,$tahun,$filter,$restitusi)
	{

                $query=('select *, sum(total) as total from v_laporanrawatjalan where id_rayon > 0 ');
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
                $query=$query.(" and month(tgl_kunjungan)=".$bulan);
                }
                if($tahun != '')
                {
                $query=$query.(" and YEAR(tgl_kunjungan)=".$tahun);
                }
                if($filter != '')
                {
                $query=$query.(" and ap="."'".$filter."'");
                }

                if($restitusi != '')
                {
                $query=$query.(" and restitusi="."'".$restitusi."'");
                }
               

                if($searchField != '')
                {
                $query=$query.(" and ".$searchField." LIKE '%".$searchString."%' ");
                }

                $query .= " group by id_transaksi ";
                if($limit != '')
                {
                $query=$query." order by ".$sidx." ".$sord." LIMIT ".$start.", ".$limit;

                }
                //echo $query;
             

                $jumlah = $this->db->query($query);


                return $jumlah;
	

        }
        function count_RawatjalanDokter($searchField,$searchString,$rayon,$wilayah,$mitra,$bulan,$tahun,$filter,$restitusi)
	{

                $query=('select *, sum(total) as total from v_laporanrawatjalan where id_rayon > 0 ');
                $query = $query.(" AND (jenis_transaksi = 'dd' OR jenis_transaksi = 'dr') ");
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
                $query=$query.(" and month(tgl_kunjungan)=".$bulan);
                }
                if($tahun != '')
                {
                $query=$query.(" and YEAR(tgl_kunjungan)=".$tahun);
                }
                if($filter != '')
                {
                $query=$query.(" and ap="."'".$filter."'");
                }
                if($restitusi != '')
                {
                $query=$query.(" and restitusi="."'".$restitusi."'");
                }

                $query .= " group by id_transaksi ";

                if($searchField != '')
                {
                $query=$query.(" and ".$searchField." LIKE '%".$searchString."%' ");
                }


                $jumlah = $this->db->query($query);

                return $jumlah->num_rows();


	}

	function get_RawatjalanDokter($searchField,$searchString, $sidx, $sord, $limit, $start,$rayon,$wilayah,$mitra,$bulan,$tahun,$filter,$restitusi)
	{

                $query=('select *, sum(total) as total from v_laporanrawatjalan where id_rayon > 0 ');
                $query = $query.(" AND (jenis_transaksi = 'dd' OR jenis_transaksi = 'dr') ");
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
                $query=$query.(" and month(tgl_kunjungan)=".$bulan);
                }
                if($tahun != '')
                {
                $query=$query.(" and YEAR(tgl_kunjungan)=".$tahun);
                }
                if($filter != '')
                {
                $query=$query.(" and ap="."'".$filter."'");
                }

                if($restitusi != '')
                {
                $query=$query.(" and restitusi="."'".$restitusi."'");
                }


                if($searchField != '')
                {
                $query=$query.(" and ".$searchField." LIKE '%".$searchString."%' ");
                }

                $query .= " group by id_transaksi ";
                if($limit != '')
                {
                $query=$query." order by ".$sidx." ".$sord." LIMIT ".$start.", ".$limit;

                }
                //echo $query;


                $jumlah = $this->db->query($query);


                return $jumlah;


        }
        function count_Rawatjalan2($searchField,$searchString,$rayon,$wilayah,$mitra,$bulan,$tahun,$filter,$jenis)
	{

                $query=('select * from v_laporanrawatjalan where id_rayon>0');
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
                $query=$query.(" and month(tgl_kunjungan)=".$bulan);
                }
                if($tahun != '')
                {
                $query=$query.(" and YEAR(tgl_kunjungan)=".$tahun);
                }
                if($filter != '')
                {
                $query=$query.(" and ap="."'".$filter."'");
                }
                if($jenis != '')
                {
                $query=$query.(" and idjns_item="."'".$jenis."'");
                }



                if($searchField != '')
                {
                $query=$query.(" and ".$searchField." LIKE '%".$searchString."%' ");
                }


                $jumlah = $this->db->query($query);

                return $jumlah->num_rows();


	}

	function get_Rawatjalan2($searchField,$searchString, $sidx, $sord, $limit, $start,$rayon,$wilayah,$mitra,$bulan,$tahun,$filter,$jenis)
	{

                 $query=('select * from v_laporanrawatjalan where id_rayon > 0');
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
                $query=$query.(" and month(tgl_kunjungan)=".$bulan);
                }
                if($tahun != '')
                {
                $query=$query.(" and YEAR(tgl_kunjungan)=".$tahun);
                }
                if($filter != '')
                {
                $query=$query.(" and ap="."'".$filter."'");
                }

                if($jenis != '')
                {
                $query=$query.(" and idjns_item="."'".$jenis."'");
                }

                if($searchField != '')
                {
                $query=$query.(" and ".$searchField." LIKE '%".$searchString."%' ");
                }



                //$query=$query." order by ".$sidx." ".$sord." LIMIT ".$start.", ".$limit;
                //echo $query;
                $jumlah = $this->db->query($query);


                return $jumlah;


        }

        function gettahunrawatinap()
        {
            $query=("SELECT DISTINCT YEAR(vlap.`tgl_transaksi`) as tahun FROM `v_laporanrawatinap` AS vlap ");
            $jumlah = $this->db->query($query);
            return $jumlah;

        }

        function getjnsitemrawatinap()
        {
            $query=("SELECT * from jenis_item ");
            $jumlah = $this->db->query($query);
            return $jumlah;

        }

        function count_Rawatinap($searchField,$searchString,$rayon,$wilayah,$mitra,$bulan,$tahun,$filter,$jenis)
	{

                $query=('select *, sum(total_harga) as total from v_laporanrawatinap where id_rayon > 0');
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
                $query=$query.(" and month(tgl_kunjungan)=".$bulan);
                }
                if($tahun != '')
                {
                $query=$query.(" and YEAR(tgl_kunjungan)=".$tahun);
                }
                if($filter != '')
                {
                $query=$query.(" and ap="."'".$filter."'");
                }
                if($jenis != '')
                {
                $query=$query.(" and idjns_item="."'".$jenis."'");
                }


                $query .=" group by id_transaksi";

                if($searchField != '')
                {
                $query=$query.(" and ".$searchField." LIKE '%".$searchString."%' ");
                }

                $jumlah = $this->db->query($query);

                return $jumlah->num_rows();


	}

	function get_Rawatinap($searchField,$searchString, $sidx, $sord, $limit, $start,$rayon,$wilayah,$mitra,$bulan,$tahun,$filter,$jenis)
	{

                 $query=('select *, sum(total_harga) as total from v_laporanrawatinap where id_rayon > 0');
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
                $query=$query.(" and month(tgl_kunjungan)=".$bulan);
                }
                if($tahun != '')
                {
                $query=$query.(" and YEAR(tgl_kunjungan)=".$tahun);
                }
                if($filter != '')
                {
                $query=$query.(" and ap="."'".$filter."'");
                }
                if($jenis != '')
                {
                $query=$query.(" and idjns_item="."'".$jenis."'");
                }




                if($searchField != '')
                {
                $query=$query.(" and ".$searchField." LIKE '%".$searchString."%' ");
                }

                $query .=" group by id_transaksi";

                if($limit != '')
                {
                $query=$query." order by ".$sidx." ".$sord." LIMIT ".$start.", ".$limit;

                }
                //echo $query;

                $jumlah = $this->db->query($query);


                return $jumlah;


        }

        function count_RawatinapDokter($searchField,$searchString,$rayon,$wilayah,$mitra,$bulan,$tahun,$filter,$jenis)
	{

                $query=('select *, sum(total_harga) as total from v_laporanrawatinap where id_rayon > 0');
                $query = $query.(" AND  jenis = 'd' ");
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
                $query=$query.(" and month(tgl_kunjungan)=".$bulan);
                }
                if($tahun != '')
                {
                $query=$query.(" and YEAR(tgl_kunjungan)=".$tahun);
                }
                if($filter != '')
                {
                $query=$query.(" and ap="."'".$filter."'");
                }
                if($jenis != '')
                {
                $query=$query.(" and idjns_item="."'".$jenis."'");
                }


                if($searchField != '')
                {
                $query=$query.(" and ".$searchField." LIKE '%".$searchString."%' ");
                }


                $jumlah = $this->db->query($query);

                return $jumlah->num_rows();


	}

	function get_RawatinapDokter($searchField,$searchString, $sidx, $sord, $limit, $start,$rayon,$wilayah,$mitra,$bulan,$tahun,$filter,$jenis)
	{

                 $query=('select *, sum(total_harga) as total from v_laporanrawatinap where id_rayon > 0');
                $query = $query.(" AND jenis = 'd' ");
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
                $query=$query.(" and month(tgl_kunjungan)=".$bulan);
                }
                if($tahun != '')
                {
                $query=$query.(" and YEAR(tgl_kunjungan)=".$tahun);
                }
                if($filter != '')
                {
                $query=$query.(" and ap="."'".$filter."'");
                }
                if($jenis != '')
                {
                $query=$query.(" and idjns_item="."'".$jenis."'");
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

        function gettahunrekammedis()
        {
            $query=("SELECT DISTINCT YEAR(vlap.`tgl_kunjungan`) as tahun FROM `v_laporanrekammedis` AS vlap ");
            $jumlah = $this->db->query($query);
            return $jumlah;

        }


        function count_Rekammedis($searchField,$searchString,$rayon,$wilayah,$mitra,$bulan,$tahun,$filter,$pegawai)
	{

                $query=('select * from v_laporanrekammedis where id_rayon > 0 ');
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
                $query=$query.(" and month(tgl_kunjungan)=".$bulan);
                }
                if($tahun != '')
                {
                $query=$query.(" and YEAR(tgl_kunjungan)=".$tahun);
                }
                if($filter != '')
                {
                $query=$query.(" and ap="."'".$filter."'");
                }
                if($pegawai != '')
                {
                $query=$query.(" and nama_karyawan LIKE '%".$pegawai."%'");
                }


                if($searchField != '')
                {
                $query=$query.(" and ".$searchField." LIKE '%".$searchString."%' ");
                }


                $jumlah = $this->db->query($query);

                return $jumlah->num_rows();


	}

	function get_Rekammedis($searchField,$searchString, $sidx, $sord, $limit, $start,$rayon,$wilayah,$mitra,$bulan,$tahun,$filter,$pegawai)
	{

                 $query=('select * from v_laporanrekammedis where id_rayon > 0');
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
                $query=$query.(" and month(tgl_kunjungan)=".$bulan);
                }
                if($tahun != '')
                {
                $query=$query.(" and YEAR(tgl_kunjungan)=".$tahun);
                }
                if($filter != '')
                {
                $query=$query.(" and ap="."'".$filter."'");
                }
                 if($pegawai != '')
                {
                $query=$query.(" and nama_karyawan LIKE '%".$pegawai."%'");
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
        function count_Sap($searchField,$searchString,$rayon,$wilayah,$mitra,$bulan,$tahun)
	{

                $query=('select *,sum(total) as totalkoreksi from v_totaltransaksi v where id_rayon>0');
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

                $query .=" group by v.buku_besar order by totalkoreksi desc ";


                $jumlah = $this->db->query($query);
                //echo $query;
                return $jumlah->num_rows();


	}

	function get_Sap($searchField,$searchString, $sidx, $sord, $limit, $start,$rayon,$wilayah,$mitra,$bulan,$tahun)
	{

                 $query=('select *,sum(total) as totalkoreksi from v_totaltransaksi v where id_rayon>0');
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



                $query .=" group by v.buku_besar order by totalkoreksi desc ";
                 //echo $query;
                $jumlah = $this->db->query($query);


                return $jumlah;
	}
        
        //gawenane iqbal
        //Laporan Temuan kabeh
        function caridokter($keyword)
        {
            $this->db->select('id_dokter, nama_dokter');
            $this->db->like('nama_dokter',$keyword,'after');
            $this->db->limit('10');
            $query = $this->db->get('master_dokter');
            return $query->result_array();
        }
    
        function count_data($searchField,$searchString,$rayon,$wilayah,$mitra,$namaTb,$jenis,$bulan,$tahun,$tgl1,$tgl2,$karyawan,$dokter)
	{
            $query=('SELECT * FROM v_laporan_'.$namaTb);
            if($rayon != '')
            {
                $query=$query.(" WHERE id_rayon=".$rayon);
            }
            else if($wilayah != '')
            {
                $query=$query.(" WHERE id_wilayah=".$wilayah);
            }
            else if($mitra != '')
            {
                $query=$query.(" WHERE id_mitra=".$mitra);
            }
            else
            {
                $query=$query.(" WHERE id_rayon>0");
            }
            
            if($jenis=='transaksi')
            {
                if($bulan != '')
                {
                    $query=$query.(" AND month(tgl_transaksi)=".$bulan);
                }
                if($tahun != '')
                {
                    $query=$query.(" AND YEAR(tgl_transaksi)=".$tahun);
                }
                if($tgl1!= '' && $tgl2 !='')
                {
                    $query=$query.(" AND tgl_transaksi BETWEEN '".$tgl1."' AND '".$tgl2."'");
                }
            } else {
			if($bulan != '')
                {
                    $query=$query.(" AND month(tgl_kunjungan)=".$bulan);
                }
                if($tahun != '')
                {
                    $query=$query.(" AND YEAR(tgl_kunjungan)=".$tahun);
                }
                if($tgl1!= '' && $tgl2 !='')
                {
                    $query=$query.(" AND tgl_kunjungan BETWEEN '".$tgl1."' AND '".$tgl2."'");
                }
            }
            
            if($karyawan != '')
            {
                $query=$query.(" AND ap='".$karyawan."'");
            }
            if($dokter != '')
            {
                $query=$query.(" AND nama_dokter='".$dokter."'");
            }

            if($searchField != '')
            {
                $query=$query.(" and ".$searchField." LIKE '%".$searchString."%' ");
            }

            $jumlah = $this->db->query($query);
            return $jumlah->num_rows();
	}

	function get_data($searchField,$searchString, $sidx, $sord, $limit, $start,$rayon,$wilayah,$mitra,$namaTb,$jenis,$bulan,$tahun,$tgl1,$tgl2,$karyawan,$dokter)
	{

            $filter = '';     
            //$query=('select * from v_laporan_polifarmasi');
            $query=('SELECT * FROM v_laporan_'.$namaTb);
            if($rayon != '')
            {
                $query=$query.(" WHERE id_rayon=".$rayon);
            }
            else if($wilayah != '')
            {
                $query=$query.(" WHERE id_wilayah=".$wilayah);
            }
            else if($mitra != '')
            {
                $query=$query.(" WHERE id_mitra=".$mitra);
            }
            else
            {
                $query=$query.(" WHERE id_rayon>0");
            }
            
            if($jenis=='transaksi')
            {
                if($bulan != '')
                {
                    $query=$query.(" AND month(tgl_transaksi)=".$bulan);
                }
                if($tahun != '')
                {
                    $query=$query.(" AND YEAR(tgl_transaksi)=".$tahun);
                }
                if($tgl1!= '' && $tgl2 !='')
                {
                    $query=$query.(" AND tgl_transaksi BETWEEN '".$tgl1."' AND '".$tgl2."'");
                }
            } else {
			if($bulan != '')
                {
                    $query=$query.(" AND month(tgl_kunjungan)=".$bulan);
                }
                if($tahun != '')
                {
                    $query=$query.(" AND YEAR(tgl_kunjungan)=".$tahun);
                }
                if($tgl1!= '' && $tgl2 !='')
                {
                    $query=$query.(" AND tgl_kunjungan BETWEEN '".$tgl1."' AND '".$tgl2."'");
                }
            }
            /*
            if($bulan != '')
            {
                $query=$query.(" AND month(tgl_kunjungan)=".$bulan);
            }
            if($tahun != '')
            {
                $query=$query.(" AND YEAR(tgl_kunjungan)=".$tahun);
            }
            if($tgl1!= '' && $tgl2 !='')
            {
                $query=$query.(" AND tgl_transaksi BETWEEN '".$tgl1."' AND '".$tgl2."'");
            }
             * 
             */
            
            if($karyawan != '')
            {
                $query=$query.(" AND ap='".$karyawan."'");
            }
            if($dokter != '')
            {
                $query=$query.(" AND nama_dokter='".$dokter."'");
            }


            if($searchField != '')
            {
                $query=$query.(" and ".$searchField." LIKE '%".$searchString."%' ");
            }
            if ($sidx !='' && $sord!='') {
                $query=$query." order by ".$sidx." ".$sord;
            }
            if ($start !='' && $limit !='')
            {
                $query=$query." LIMIT ".$start.", ".$limit;
            }
            //echo $query;
            $jumlah = $this->db->query($query);

            return $jumlah;
	}
        
        //Biaya Terbesar
        function count_20pt()
        {
            $jumlah = $this->db->query("SELECT ROUND(COUNT(nip)*0.2) as jml FROM master_karyawan");
            return $jumlah->result_array();
        }
        
        function count_biayaTerbesar($searchField,$searchString,$rayon,$wilayah,$mitra,$bulan,$tahun,$karyawan,$jenis)
	{
            /*
            $query=("SELECT a.nip,a.nama_karyawan,a.ap,
                    (SELECT COUNT(DISTINCT aa.id_transaksi) FROM v_transaksi_provider aa
                        WHERE aa.nip=a.nip AND aa.jenis_provider='apotek') AS kunj_apotek,
                    (SELECT SUM(aa.jumlah*aa.hrg_satuan) FROM v_transaksi_provider aa
                        WHERE aa.nip=a.nip AND aa.jenis_provider='apotek') AS biaya_apotek,
                    (SELECT COUNT(DISTINCT aa.id_transaksi) FROM v_transaksi_provider aa
                        WHERE aa.nip=a.nip AND aa.jenis_provider='lab gigi') AS kunj_gigi,
                    (SELECT SUM(aa.jumlah*aa.hrg_satuan) FROM v_transaksi_provider aa
                        WHERE aa.nip=a.nip AND aa.jenis_provider='lab gigi') AS biaya_gigi,
                    (SELECT COUNT(DISTINCT aa.id_transaksi) FROM v_transaksi_provider aa
                        WHERE aa.nip=a.nip AND aa.jenis_provider='laboratorium') AS kunj_lab,
                    (SELECT SUM(aa.jumlah*aa.hrg_satuan) FROM v_transaksi_provider aa
                        WHERE aa.nip=a.nip AND aa.jenis_provider='laboratorium') AS biaya_lab,
                    (SELECT COUNT(DISTINCT aa.id_transaksi) FROM v_transaksi_provider aa
                        WHERE aa.nip=a.nip AND aa.jenis_provider='optik') AS kunj_optik,
                    (SELECT SUM(aa.jumlah*aa.hrg_satuan) FROM v_transaksi_provider aa
                        WHERE aa.nip=a.nip AND aa.jenis_provider='optik') AS biaya_optik,
                    (SELECT COUNT(DISTINCT aa.id_transaksi) FROM v_transaksi_provider aa
                        WHERE aa.nip=a.nip AND aa.jenis_provider='rumah sakit') AS kunj_rs,
                    (SELECT SUM(aa.jumlah*aa.hrg_satuan) FROM v_transaksi_provider aa
                        WHERE aa.nip=a.nip AND aa.jenis_provider='rumah sakit') AS biaya_rs,
                    (SELECT COUNT(DISTINCT aa.id_transaksi) FROM v_transaksi_provider aa
                        WHERE aa.nip=a.nip AND aa.jenis_provider='umum') AS kunj_umum,
                    (SELECT SUM(aa.jumlah*aa.hrg_satuan) FROM v_transaksi_provider aa
                        WHERE aa.nip=a.nip AND aa.jenis_provider='umum') AS biaya_umum,
                    (SELECT COUNT(DISTINCT aa.id_transaksi) FROM v_transaksi_provider aa
                        WHERE aa.nip=a.nip AND aa.jenis_provider='spesialis') AS kunj_spesialis,
                    (SELECT SUM(aa.jumlah*aa.hrg_satuan) FROM v_transaksi_provider aa
                        WHERE aa.nip=a.nip AND aa.jenis_provider='spesialis') AS biaya_spesialis,
                    (SELECT SUM(aa.jumlah*aa.hrg_satuan) FROM v_transaksi_provider aa
                        WHERE aa.nip=a.nip) AS total
                    FROM v_transaksi_provider a");
             * 
             */
            $query=("");
            if($rayon != '')
            {
                $query=$query.(" and aa.id_rayon=".$rayon);
            }
            else if($wilayah != '')
            {
                $query=$query.(" and aa.id_wilayah=".$wilayah);
            }
            else if($mitra != '')
            {
                $query=$query.(" and aa.id_mitra=".$mitra);
            }
            else
            {
                $query=$query.(" and aa.id_rayon>0");
            }
            
            if($bulan != '')
            {
                $query=$query.(" and month(aa.tgl_kunjungan)=".$bulan);
            }
            if($tahun != '')
            {
                $query=$query.(" and YEAR(aa.tgl_kunjungan)=".$tahun);
            }
            
			if($searchField != '')
            {
                $query=$query.(" and ".$searchField." LIKE '%".$searchString."%' ");
            }
            //$query=$query.(" GROUP BY aa.nip");
            /*
            if($jenis!='')
            {
                
                    $query=$query.(" LIMIT ".$jenis);
                
            }
             * 
             */
            
            $query2=("SELECT a.`nip`,a.`ap`,a.`nama_karyawan`,
	(SELECT COUNT(DISTINCT aa.id_transaksi) FROM v_transaksi_provider aa
		WHERE aa.nip=a.nip AND aa.jenis_provider='apotek' ".$query."
		) kunj_apotek,
	(SELECT SUM(aa.jumlah*aa.hrg_satuan) FROM v_transaksi_provider aa
		WHERE aa.nip=a.nip AND aa.jenis_provider='apotek'".$query."
		) AS biaya_apotek,
	(SELECT COUNT(DISTINCT aa.id_transaksi) FROM v_transaksi_provider aa
		WHERE aa.nip=a.nip AND aa.jenis_provider='lab gigi' ".$query."
		) AS kunj_gigi,
	(SELECT SUM(aa.jumlah*aa.hrg_satuan) FROM v_transaksi_provider aa
		WHERE aa.nip=a.nip AND aa.jenis_provider='lab gigi' ".$query."
		) AS biaya_gigi,
	(SELECT COUNT(DISTINCT aa.id_transaksi) FROM v_transaksi_provider aa
		WHERE aa.nip=a.nip AND aa.jenis_provider='laboratorium' ".$query."
		) AS kunj_lab,
	(SELECT SUM(aa.jumlah*aa.hrg_satuan) FROM v_transaksi_provider aa
		WHERE aa.nip=a.nip AND aa.jenis_provider='laboratorium' ".$query."
		) AS biaya_lab,
	(SELECT COUNT(DISTINCT aa.id_transaksi) FROM v_transaksi_provider aa
		WHERE aa.nip=a.nip AND aa.jenis_provider='optik' ".$query."
		) AS kunj_optik,
	(SELECT SUM(aa.jumlah*aa.hrg_satuan) FROM v_transaksi_provider aa
		WHERE aa.nip=a.nip AND aa.jenis_provider='optik' ".$query."
		) AS biaya_optik,
	(SELECT COUNT(DISTINCT aa.id_transaksi) FROM v_transaksi_provider aa
		WHERE aa.nip=a.nip AND aa.jenis_provider='rumah sakit' ".$query."
		) AS kunj_rs,
	(SELECT SUM(aa.jumlah*aa.hrg_satuan) FROM v_transaksi_provider aa
		WHERE aa.nip=a.nip AND aa.jenis_provider='rumah sakit' ".$query."
		) AS biaya_rs,
	(SELECT COUNT(DISTINCT aa.id_transaksi) FROM v_transaksi_provider aa
		WHERE aa.nip=a.nip AND aa.jenis_provider='umum' ".$query."
		) AS kunj_umum,
	(SELECT SUM(aa.jumlah*aa.hrg_satuan) FROM v_transaksi_provider aa
		WHERE aa.nip=a.nip AND aa.jenis_provider='umum' ".$query."
		) AS biaya_umum,
	(SELECT COUNT(DISTINCT aa.id_transaksi) FROM v_transaksi_provider aa
		WHERE aa.nip=a.nip AND aa.jenis_provider='spesialis' ".$query."
		) AS kunj_spesialis,
	(SELECT SUM(aa.jumlah*aa.hrg_satuan) FROM v_transaksi_provider aa
		WHERE aa.nip=a.nip AND aa.jenis_provider='spesialis' ".$query."
		) AS biaya_spesialis,
	(SELECT SUM(aa.jumlah*aa.hrg_satuan) FROM v_transaksi_provider aa
		WHERE aa.nip=a.nip ".$query."
		) AS total
FROM `master_karyawan` a
WHERE a.`nip` IN (SELECT DISTINCT aa.`nip` FROM `v_transaksi_provider` aa)");
            
            if($karyawan != '')
            {
                $query2=$query2.(" and a.ap="."'".$karyawan."'");
            }
			
			$jumlah = $this->db->query($query2);

            return $jumlah->num_rows();
	}

	function get_biayaTerbesar($searchField,$searchString, $sidx, $sord, $limit, $start,$rayon,$wilayah,$mitra,$bulan,$tahun,$karyawan,$jenis)
	{
            $query=("");
            if($rayon != '')
            {
                $query=$query.(" AND aa.id_rayon=".$rayon);
            }
            else if($wilayah != '')
            {
                $query=$query.(" AND aa.id_wilayah=".$wilayah);
            }
            else if($mitra != '')
            {
                $query=$query.(" AND aa.id_mitra=".$mitra);
            }
            else
            {
                $query=$query.(" and aa.id_rayon>0");
            }
            
            if($bulan != '')
            {
                $query=$query.(" and month(aa.tgl_kunjungan)=".$bulan);
            }
            if($tahun != '')
            {
                $query=$query.(" and YEAR(aa.tgl_kunjungan)=".$tahun);
            }
            
			if($searchField != '')
            {
                $query=$query.(" and ".$searchField." LIKE '%".$searchString."%' ");
            }
            //$query=$query.(" GROUP BY a.nip");
            //$query=$query." order by ".$sidx." ".$sord;
            $query2=("SELECT a.`nip`,a.`ap`,a.`nama_karyawan`,
	(SELECT COUNT(DISTINCT aa.id_transaksi) FROM v_transaksi_provider aa
		WHERE aa.nip=a.nip AND aa.jenis_provider='apotek' ".$query."
		) kunj_apotek,
	(SELECT SUM(aa.jumlah*aa.hrg_satuan) FROM v_transaksi_provider aa
		WHERE aa.nip=a.nip AND aa.jenis_provider='apotek'".$query."
		) AS biaya_apotek,
	(SELECT COUNT(DISTINCT aa.id_transaksi) FROM v_transaksi_provider aa
		WHERE aa.nip=a.nip AND aa.jenis_provider='lab gigi' ".$query."
		) AS kunj_gigi,
	(SELECT SUM(aa.jumlah*aa.hrg_satuan) FROM v_transaksi_provider aa
		WHERE aa.nip=a.nip AND aa.jenis_provider='lab gigi' ".$query."
		) AS biaya_gigi,
	(SELECT COUNT(DISTINCT aa.id_transaksi) FROM v_transaksi_provider aa
		WHERE aa.nip=a.nip AND aa.jenis_provider='laboratorium' ".$query."
		) AS kunj_lab,
	(SELECT SUM(aa.jumlah*aa.hrg_satuan) FROM v_transaksi_provider aa
		WHERE aa.nip=a.nip AND aa.jenis_provider='laboratorium' ".$query."
		) AS biaya_lab,
	(SELECT COUNT(DISTINCT aa.id_transaksi) FROM v_transaksi_provider aa
		WHERE aa.nip=a.nip AND aa.jenis_provider='optik' ".$query."
		) AS kunj_optik,
	(SELECT SUM(aa.jumlah*aa.hrg_satuan) FROM v_transaksi_provider aa
		WHERE aa.nip=a.nip AND aa.jenis_provider='optik' ".$query."
		) AS biaya_optik,
	(SELECT COUNT(DISTINCT aa.id_transaksi) FROM v_transaksi_provider aa
		WHERE aa.nip=a.nip AND aa.jenis_provider='rumah sakit' ".$query."
		) AS kunj_rs,
	(SELECT SUM(aa.jumlah*aa.hrg_satuan) FROM v_transaksi_provider aa
		WHERE aa.nip=a.nip AND aa.jenis_provider='rumah sakit' ".$query."
		) AS biaya_rs,
	(SELECT COUNT(DISTINCT aa.id_transaksi) FROM v_transaksi_provider aa
		WHERE aa.nip=a.nip AND aa.jenis_provider='umum' ".$query."
		) AS kunj_umum,
	(SELECT SUM(aa.jumlah*aa.hrg_satuan) FROM v_transaksi_provider aa
		WHERE aa.nip=a.nip AND aa.jenis_provider='umum' ".$query."
		) AS biaya_umum,
	(SELECT COUNT(DISTINCT aa.id_transaksi) FROM v_transaksi_provider aa
		WHERE aa.nip=a.nip AND aa.jenis_provider='spesialis' ".$query."
		) AS kunj_spesialis,
	(SELECT SUM(aa.jumlah*aa.hrg_satuan) FROM v_transaksi_provider aa
		WHERE aa.nip=a.nip AND aa.jenis_provider='spesialis' ".$query."
		) AS biaya_spesialis,
	(SELECT SUM(aa.jumlah*aa.hrg_satuan) FROM v_transaksi_provider aa
		WHERE aa.nip=a.nip ".$query."
		) AS total
FROM `master_karyawan` a
WHERE a.`nip` IN (SELECT DISTINCT aa.`nip` FROM `v_transaksi_provider` aa) order by total desc");
            if($karyawan != '')
            {
                $query2=$query2.(" and a.ap="."'".$karyawan."'");
            }
			if($start!='' && $limit!='')
            {
                $query2=$query2." LIMIT ".$start.", ".$limit;
            }
            //echo $query;
            $jumlah = $this->db->query($query2);

            return $jumlah;
        }
        
        //BUku Besar
        function count_bukuBesar($que,$group,$searchField,$searchString,$rayon,$wilayah,$mitra,$bulan,$tahun,$bukuBesar,$karyawan,$pegawai)
	{
            $query=($que);
            
            if($rayon != '')
            {
                $query=$query.(" where id_rayon=".$rayon);
            }
            else if($wilayah != '')
            {
                $query=$query.(" where id_wilayah=".$wilayah);
            }
            else if($mitra != '')
            {
                $query=$query.(" where id_mitra=".$mitra);
            }
            else
            {
                $query=$query.(" where id_rayon>0");
            }
            if($bulan != '')
            {
                $query=$query.(" and month(tgl_kunjungan)=".$bulan);
            }
            if($tahun != '')
            {
                $query=$query.(" and YEAR(tgl_kunjungan)=".$tahun);
            }
            
            if($bukuBesar!='')
            {
                $query=$query.(" and buku_besar ="."'".$bukuBesar."'");
            }
            if($karyawan != '')
            {
                $query=$query.(" and ap="."'".$karyawan."'");
            }
            
            if($searchField != '' && $searchString!='')
            {
                if($pegawai!=''){
                    $query=$query.(" and nama_karyawan LIKE '%".$pegawai."%' ");
                }else{
                    $query=$query.(" and ".$searchField." LIKE '%".$searchString."%' ");
                }
            }             
          
            if($group=='y'){
                $query=$query.(" GROUP BY buku_besar");
            }
           
            $jumlah = $this->db->query($query);

            return $jumlah->num_rows();
	}

	function get_bukuBesar($que,$group,$searchField,$searchString, $sidx, $sord, $limit, $start,$rayon,$wilayah,$mitra,$bulan,$tahun,$bukuBesar,$karyawan,$pegawai)
	{
           
            $query=($que);
            
            if($rayon != '')
            {
                $query=$query.(" where id_rayon=".$rayon);
            }
            else if($wilayah != '')
            {
                $query=$query.(" where id_wilayah=".$wilayah);
            }
            else if($mitra != '')
            {
                $query=$query.(" where id_mitra=".$mitra);
            }
            else
            {
                $query=$query.(" where id_rayon>0");
            }
            if($bulan != '')
            {
                $query=$query.(" and month(tgl_kunjungan)=".$bulan);
            }
            if($tahun != '')
            {
                $query=$query.(" and YEAR(tgl_kunjungan)=".$tahun);
            }
            if($bukuBesar!='')
            {
                $query=$query.(" and buku_besar ="."'".$bukuBesar."'");
            }
            if($karyawan != '')
            {
                $query=$query.(" and ap="."'".$karyawan."'");
            }
            
            if($searchField != '' && $searchString!='')
            {
                if($pegawai!=''){
                    $query=$query.(" and nama_karyawan LIKE '%".$pegawai."%' ");
                }else{
                    $query=$query.(" and ".$searchField." LIKE '%".$searchString."%' ");
                }
            }         
            
            if($group=='y'){
                $query=$query.(" GROUP BY buku_besar");
            }
            
            $query=$query." order by ".$sidx." ".$sord;
            if($start!='' && $limit!='')
            {
                $query=$query." LIMIT ".$start.", ".$limit;
            }
             
            
            //echo $query;
            $jumlah = $this->db->query($query);

            return $jumlah;
        }
        
        function caripegawai($keyword)
        {
            $this->db->select('nip, nama_karyawan');
            $this->db->like('nama_karyawan',$keyword,'after');
            $this->db->limit('10');
            $query = $this->db->get('master_karyawan');
            return $query->result_array();
        }
        
        function count_perBagian($searchField,$searchString,$rayon,$wilayah,$mitra,$bulan,$tahun)
	{
            $query=("SELECT id_bagian,nama_bagian, SUM(biaya_satuan) AS biaya, 
                        IF(SUM(biaya_satuan-biaya_standar)>0,SUM(biaya_satuan-biaya_standar),0) AS pengurangan,
                        (SUM(biaya_satuan)-IF(SUM(biaya_satuan-biaya_standar)>0,SUM(biaya_satuan-biaya_standar),0)) AS koreksi
                    FROM v_transaksi");
            
            if($rayon != '')
            {
                $query=$query.(" where id_rayon=".$rayon);
            }
            else if($wilayah != '')
            {
                $query=$query.(" where id_wilayah=".$wilayah);
            }
            else if($mitra != '')
            {
                $query=$query.(" where id_mitra=".$mitra);
            }
            else
            {
                $query=$query.(" where id_rayon>0");
            }
            
            if($bulan != '')
            {
                $query=$query.(" and month(tgl_kunjungan)=".$bulan);
            }
            if($tahun != '')
            {
                $query=$query.(" and YEAR(tgl_kunjungan)=".$tahun);
            }
            
            if($searchField != '' && $searchString!='')
            {
                $query=$query.(" and ".$searchField." LIKE '%".$searchString."%' ");
            }             
          
            $query=$query.(" GROUP BY id_bagian");
            /*
            if($jenis!='')
            {
                
                    $query=$query.(" LIMIT ".$jenis);
                
            }
             * 
             */
            $jumlah = $this->db->query($query);

            return $jumlah->num_rows();
	}

	function get_perBagian($searchField,$searchString, $sidx, $sord, $limit, $start,$rayon,$wilayah,$mitra,$bulan,$tahun)
	{
            $query=("SELECT id_bagian,nama_bagian, SUM(biaya_satuan) AS biaya, 
                        IF(SUM(biaya_satuan-biaya_standar)>0,SUM(biaya_satuan-biaya_standar),0) AS pengurangan,
                        (SUM(biaya_satuan)-IF(SUM(biaya_satuan-biaya_standar)>0,SUM(biaya_satuan-biaya_standar),0)) AS koreksi
                    FROM v_transaksi");
            
            if($rayon != '')
            {
                $query=$query.(" where id_rayon=".$rayon);
            }
            else if($wilayah != '')
            {
                $query=$query.(" where id_wilayah=".$wilayah);
            }
            else if($mitra != '')
            {
                $query=$query.(" where id_mitra=".$mitra);
            }
            else
            {
                $query=$query.(" where id_rayon>0");
            }
            
            if($bulan != '')
            {
                $query=$query.(" and month(tgl_kunjungan)=".$bulan);
            }
            if($tahun != '')
            {
                $query=$query.(" and YEAR(tgl_kunjungan)=".$tahun);
            }
            
            if($searchField != '' && $searchString!='')
            {
                $query=$query.(" and ".$searchField." LIKE '%".$searchString."%' ");
            }         
            
            $query=$query.(" GROUP BY id_bagian");
            
            $query=$query." order by ".$sidx." ".$sord;
            if($start!='' && $limit!='')
            {
                $query=$query." LIMIT ".$start.", ".$limit;
            }
             
            
            //echo $query;
            $jumlah = $this->db->query($query);

            return $jumlah;
        }
        
        function count_totalBiaya($searchField,$searchString,$rayon,$wilayah,$mitra,$bulan,$tahun,$jenis)
	{
            $query=("SELECT nip,nama_karyawan,restitusi,SUM(biaya_satuan)AS total_biaya,SUM(biaya_koreksi)AS koreksi_biaya
                    FROM v_transaksi");
            
            if($rayon != '')
            {
                $query=$query.(" where id_rayon=".$rayon);
            }
            else if($wilayah != '')
            {
                $query=$query.(" where id_wilayah=".$wilayah);
            }
            else if($mitra != '')
            {
                $query=$query.(" where id_mitra=".$mitra);
            }
            else
            {
                $query=$query.(" where id_rayon>0");
            }
            
            if($bulan != '')
            {
                $query=$query.(" and month(tgl_kunjungan)=".$bulan);
            }
            if($tahun != '')
            {
                $query=$query.(" and YEAR(tgl_kunjungan)=".$tahun);
            }
            if($jenis != '')
            {
                $query=$query.(" and restitusi = '".$jenis."'");
            }
            
            if($searchField != '' && $searchString!='')
            {
                $query=$query.(" and ".$searchField." LIKE '%".$searchString."%' ");
            }             
          
            $query=$query.(" GROUP BY nip");
            /*
            if($jenis!='')
            {
                
                    $query=$query.(" LIMIT ".$jenis);
                
            }
             * 
             */
            $jumlah = $this->db->query($query);

            return $jumlah->num_rows();
	}

	function get_totalBiaya($searchField,$searchString, $sidx, $sord, $limit, $start,$rayon,$wilayah,$mitra,$bulan,$tahun,$jenis)
	{
            $query=("SELECT nip,nama_karyawan,restitusi,SUM(biaya_satuan)AS total_biaya,SUM(biaya_koreksi)AS koreksi_biaya
                    FROM v_transaksi");
            
            if($rayon != '')
            {
                $query=$query.(" where id_rayon=".$rayon);
            }
            else if($wilayah != '')
            {
                $query=$query.(" where id_wilayah=".$wilayah);
            }
            else if($mitra != '')
            {
                $query=$query.(" where id_mitra=".$mitra);
            }
            else
            {
                $query=$query.(" where id_rayon>0");
            }
            
            if($bulan != '')
            {
                $query=$query.(" and month(tgl_kunjungan)=".$bulan);
            }
            if($tahun != '')
            {
                $query=$query.(" and YEAR(tgl_kunjungan)=".$tahun);
            }
            if($jenis != '')
            {
                $query=$query.(" and restitusi ='".$jenis."'");
            }
            
            if($searchField != '' && $searchString!='')
            {
                $query=$query.(" and ".$searchField." LIKE '%".$searchString."%' ");
            }         
            
            $query=$query.(" GROUP BY nip");
            
            $query=$query." order by ".$sidx." ".$sord;
            if($start!='' && $limit!='')
            {
                $query=$query." LIMIT ".$start.", ".$limit;
            }
             
            
            //echo $query;
            $jumlah = $this->db->query($query);

            return $jumlah;
        }
        
        function count_rekapProvider($searchField,$searchString,$rayon,$wilayah,$mitra,$bulan,$tahun,$jenis)
	{
            $query=("SELECT idjenis_provider,
                        CASE WHEN jenis_provider ='umum' THEN 'dokter' WHEN jenis_provider='spesialis' THEN 'dokter' ELSE jenis_provider END AS jenis,
                        nama_provider,SUM(hrg_satuan*jumlah) AS total_biaya,
                        SUM(IF(((hrg_satuan*jumlah)-(harga_item*jumlah))>0,(harga_item*jumlah),(hrg_satuan*jumlah))) AS koreksi_biaya
                    FROM v_transaksi_provider");
            
            if($rayon != '')
            {
                $query=$query.(" where id_rayon=".$rayon);
            }
            else if($wilayah != '')
            {
                $query=$query.(" where id_wilayah=".$wilayah);
            }
            else if($mitra != '')
            {
                $query=$query.(" where id_mitra=".$mitra);
            }
            else
            {
                $query=$query.(" where id_rayon>0");
            }
            
            if($bulan != '')
            {
                $query=$query.(" and month(tgl_kunjungan)=".$bulan);
            }
            if($tahun != '')
            {
                $query=$query.(" and YEAR(tgl_kunjungan)=".$tahun);
            }
            
            
            if($searchField != '' && $searchString!='')
            {
                $query=$query.(" and ".$searchField." LIKE '%".$searchString."%' ");
            }             
          
            $query=$query.(" GROUP BY nama_provider");
            
            if($jenis != '')
            {
                $query=$query.(" HAVING jenis = '".$jenis."'");
            }
            /*
            if($jenis!='')
            {
                
                    $query=$query.(" LIMIT ".$jenis);
                
            }
             * 
             */
            $jumlah = $this->db->query($query);

            return $jumlah->num_rows();
	}

	function get_rekapProvider($searchField,$searchString, $sidx, $sord, $limit, $start,$rayon,$wilayah,$mitra,$bulan,$tahun,$jenis)
	{
            $query=("SELECT idjenis_provider,
                        CASE WHEN jenis_provider ='umum' THEN 'dokter' WHEN jenis_provider='spesialis' THEN 'dokter' ELSE jenis_provider END AS jenis,
                        nama_provider,SUM(hrg_satuan*jumlah) AS total_biaya,
                        SUM(IF(((hrg_satuan*jumlah)-(harga_item*jumlah))>0,(harga_item*jumlah),(hrg_satuan*jumlah))) AS koreksi_biaya
                    FROM v_transaksi_provider");
            
            if($rayon != '')
            {
                $query=$query.(" where id_rayon=".$rayon);
            }
            else if($wilayah != '')
            {
                $query=$query.(" where id_wilayah=".$wilayah);
            }
            else if($mitra != '')
            {
                $query=$query.(" where id_mitra=".$mitra);
            }
            else
            {
                $query=$query.(" where id_rayon>0");
            }
            
            if($bulan != '')
            {
                $query=$query.(" and month(tgl_kunjungan)=".$bulan);
            }
            if($tahun != '')
            {
                $query=$query.(" and YEAR(tgl_kunjungan)=".$tahun);
            }
            
            if($searchField != '' && $searchString!='')
            {
                $query=$query.(" and ".$searchField." LIKE '%".$searchString."%' ");
            }         
            
            $query=$query.(" GROUP BY nama_provider");
            
            if($jenis != '')
            {
                $query=$query.(" HAVING jenis = '".$jenis."'");
            }
            
            $query=$query." order by ".$sidx." ".$sord;
            if($start!='' && $limit!='')
            {
                $query=$query." LIMIT ".$start.", ".$limit;
            }
             
            
            //echo $query;
            $jumlah = $this->db->query($query);

            return $jumlah;
        }
        
        function count_detailTerbesar($searchField,$searchString,$rayon,$wilayah,$mitra,$namaTb,$nip,$bulan,$tahun)
	{
            $query=('SELECT * FROM v_laporan_'.$namaTb);
            if($rayon != '')
            {
                $query=$query.(" WHERE id_rayon=".$rayon);
            }
            else if($wilayah != '')
            {
                $query=$query.(" WHERE id_wilayah=".$wilayah);
            }
            else if($mitra != '')
            {
                $query=$query.(" WHERE id_mitra=".$mitra);
            }
            else
            {
                $query=$query.(" WHERE id_rayon>0");
            }
            
            if($nip != '')
            {
                $query=$query.(" AND nip=".$nip);
            }
            if($bulan != '')
            {
                $query=$query.(" AND month(tgl_kunjungan)=".$bulan);
            }
            if($tahun != '')
            {
                $query=$query.(" AND YEAR(tgl_kunjungan)=".$tahun);
            }
             

            if($searchField != '')
            {
                $query=$query.(" and ".$searchField." LIKE '%".$searchString."%' ");
            }

            $jumlah = $this->db->query($query);
            return $jumlah->num_rows();
	}

	function get_detailTerbesar($searchField,$searchString, $sidx, $sord, $limit, $start,$rayon,$wilayah,$mitra,$namaTb,$nip,$bulan,$tahun)
	{

            $filter = '';     
            //$query=('select * from v_laporan_polifarmasi');
            $query=('SELECT * FROM v_laporan_'.$namaTb);
            if($rayon != '')
            {
                $query=$query.(" WHERE id_rayon=".$rayon);
            }
            else if($wilayah != '')
            {
                $query=$query.(" WHERE id_wilayah=".$wilayah);
            }
            else if($mitra != '')
            {
                $query=$query.(" WHERE id_mitra=".$mitra);
            }
            else
            {
                $query=$query.(" WHERE id_rayon>0");
            }
            
            if($nip != '')
            {
                $query=$query.(" AND nip=".$nip);
            }
            if($bulan != '')
            {
                $query=$query.(" AND month(tgl_kunjungan)=".$bulan);
            }
            if($tahun != '')
            {
                $query=$query.(" AND YEAR(tgl_kunjungan)=".$tahun);
            }


            if($searchField != '')
            {
                $query=$query.(" and ".$searchField." LIKE '%".$searchString."%' ");
            }
            if ($sidx !='' && $sord!='') {
                $query=$query." order by ".$sidx." ".$sord;
            }
            if ($start !='' && $limit !='')
            {
                $query=$query." LIMIT ".$start.", ".$limit;
            }
            //echo $query;
            $jumlah = $this->db->query($query);

            return $jumlah;
	}
	
	//Reap BiAYA
	function count_rekapBiaya($searchField,$searchString,$rayon,$wilayah,$mitra,$bulan,$tahun)
	{
            $query=("");
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
                $query=$query.(" and month(tgl_kunjungan)=".$bulan);
            }
            if($tahun != '')
            {
                $query=$query.(" and YEAR(tgl_kunjungan)=".$tahun);
            }
            
			if($searchField != '')
            {
                $query=$query.(" and ".$searchField." LIKE '%".$searchString."%' ");
            }
            
			$query2=("SELECT ('Apotek') AS jenis,
	(SELECT COUNT(DISTINCT nip) FROM `v_transaksi_provider` WHERE `jenis_provider`='apotek'
		AND `ap`='a' ".$query."
		) AS jmlh_peg,
	(SELECT SUM(`jumlah`*`hrg_satuan`) FROM `v_transaksi_provider` WHERE `jenis_provider`='apotek'
		AND `ap`='a' ".$query."
		) AS biaya_peg,
	(SELECT SUM(IF(`hrg_satuan`>`harga_item`,`jumlah`*`harga_item`,`jumlah`*`hrg_satuan`)) FROM `v_transaksi_provider` WHERE `jenis_provider`='apotek'
		AND `ap`='a' ".$query.") AS biaya_peg_k,
	(SELECT COUNT(DISTINCT nip) FROM `v_transaksi_provider` WHERE `jenis_provider`='apotek'
		AND `ap`='p' ".$query.") AS jmlh_pen,
	(SELECT SUM(`jumlah`*`hrg_satuan`) FROM `v_transaksi_provider` WHERE `jenis_provider`='apotek'
		AND `ap`='p' ".$query.") AS biaya_pen,
	(SELECT SUM(IF(`hrg_satuan`>`harga_item`,`jumlah`*`harga_item`,`jumlah`*`hrg_satuan`)) FROM `v_transaksi_provider` WHERE `jenis_provider`='apotek'
		AND `ap`='p' ".$query.") AS biaya_pen_k,
	(SELECT SUM(`jumlah`*`hrg_satuan`) FROM `v_transaksi_provider` WHERE `jenis_provider`='apotek' ".$query.") AS total
UNION ALL
-- transaksi dokter
SELECT ('Dokter') AS jenis,
	(SELECT COUNT(DISTINCT nip) FROM `v_transaksi_provider` WHERE (`jenis_provider`='umum' OR `jenis_provider`='spesialis')
		AND `ap`='a' ".$query.") AS jmlh_peg,
	(SELECT SUM(`jumlah`*`hrg_satuan`) FROM `v_transaksi_provider` WHERE (`jenis_provider`='umum' OR `jenis_provider`='spesialis')
		AND `ap`='a' ".$query.") AS biaya_peg,
	(SELECT SUM(IF(`hrg_satuan`>`harga_item`,`jumlah`*`harga_item`,`jumlah`*`hrg_satuan`))
		FROM `v_transaksi_provider` WHERE (`jenis_provider`='umum' OR `jenis_provider`='spesialis') AND `ap`='a' ".$query.") AS biaya_peg_k,
	(SELECT COUNT(DISTINCT nip) FROM `v_transaksi_provider` WHERE (`jenis_provider`='umum' OR `jenis_provider`='spesialis')
		AND `ap`='p' ".$query.") AS jmlh_pen,
	(SELECT SUM(`jumlah`*`hrg_satuan`) FROM `v_transaksi_provider` WHERE (`jenis_provider`='umum' OR `jenis_provider`='spesialis')
		AND `ap`='p' ".$query.") AS biaya_pen,
	(SELECT SUM(IF(`hrg_satuan`>`harga_item`,`jumlah`*`harga_item`,`jumlah`*`hrg_satuan`)) FROM `v_transaksi_provider`
		WHERE (`jenis_provider`='umum' OR `jenis_provider`='spesialis') AND `ap`='p' ".$query.") AS biaya_pen_k,
	(SELECT SUM(`jumlah`*`hrg_satuan`) FROM `v_transaksi_provider` WHERE (`jenis_provider`='umum' OR `jenis_provider`='spesialis') ".$query.") AS total
UNION ALL
-- transaksi Lab gigi
SELECT ('Gigi') AS jenis,
	(SELECT COUNT(DISTINCT nip) FROM `v_transaksi_provider` WHERE `jenis_provider`='lab gigi'
		AND `ap`='a' ".$query.") AS jmlh_peg,
	(SELECT SUM(`jumlah`*`hrg_satuan`) FROM `v_transaksi_provider` WHERE `jenis_provider`='lab gigi'
		AND `ap`='a' ".$query.") AS biaya_peg,
	(SELECT SUM(IF(`hrg_satuan`>`harga_item`,`jumlah`*`harga_item`,`jumlah`*`hrg_satuan`)) FROM `v_transaksi_provider` WHERE `jenis_provider`='lab gigi'
		AND `ap`='a' ".$query.") AS biaya_peg_k,
	(SELECT COUNT(DISTINCT nip) FROM `v_transaksi_provider` WHERE `jenis_provider`='lab gigi'
		AND `ap`='p' ".$query.") AS jmlh_pen,
	(SELECT SUM(`jumlah`*`hrg_satuan`) FROM `v_transaksi_provider` WHERE `jenis_provider`='lab gigi'
		AND `ap`='p' ".$query.") AS biaya_pen,
	(SELECT SUM(IF(`hrg_satuan`>`harga_item`,`jumlah`*`harga_item`,`jumlah`*`hrg_satuan`)) FROM `v_transaksi_provider` WHERE `jenis_provider`='lab gigi'
		AND `ap`='p' ".$query.") AS biaya_pen_k,
	(SELECT SUM(`jumlah`*`hrg_satuan`) FROM `v_transaksi_provider` WHERE `jenis_provider`='lab gigi' ".$query.") AS total
UNION ALL
-- transaksi lab
SELECT ('Laboratorium') AS jenis,
	(SELECT COUNT(DISTINCT nip) FROM `v_transaksi_provider` WHERE `jenis_provider`='laboratorium'
		AND `ap`='a' ".$query.") AS jmlh_peg,
	(SELECT SUM(`jumlah`*`hrg_satuan`) FROM `v_transaksi_provider` WHERE `jenis_provider`='laboratorium'
		AND `ap`='a' ".$query.") AS biaya_peg,
	(SELECT SUM(IF(`hrg_satuan`>`harga_item`,`jumlah`*`harga_item`,`jumlah`*`hrg_satuan`)) FROM `v_transaksi_provider` WHERE `jenis_provider`='laboratorium'
		AND `ap`='a' ".$query.") AS biaya_peg_k,
	(SELECT COUNT(DISTINCT nip) FROM `v_transaksi_provider` WHERE `jenis_provider`='laboratorium'
		AND `ap`='p' ".$query.") AS jmlh_pen,
	(SELECT SUM(`jumlah`*`hrg_satuan`) FROM `v_transaksi_provider` WHERE `jenis_provider`='laboratorium'
		AND `ap`='p' ".$query.") AS biaya_pen,
	(SELECT SUM(IF(`hrg_satuan`>`harga_item`,`jumlah`*`harga_item`,`jumlah`*`hrg_satuan`)) FROM `v_transaksi_provider` WHERE `jenis_provider`='laboratorium'
		AND `ap`='p' ".$query.") AS biaya_pen_k,
	(SELECT SUM(`jumlah`*`hrg_satuan`) FROM `v_transaksi_provider` WHERE `jenis_provider`='laboratorium' ".$query.") AS total
UNION ALL
-- transaksi lain lain
SELECT ('Lain-lain') AS jenis,
	(SELECT COUNT(DISTINCT nip) FROM `v_transaksi_provider` WHERE `jenis_provider`='optik'
		AND `ap`='a' ".$query.") AS jmlh_peg,
	(SELECT SUM(`jumlah`*`hrg_satuan`) FROM `v_transaksi_provider` WHERE `jenis_provider`='optik'
		AND `ap`='a' ".$query.") AS biaya_peg,
	(SELECT SUM(IF(`hrg_satuan`>`harga_item`,`jumlah`*`harga_item`,`jumlah`*`hrg_satuan`)) FROM `v_transaksi_provider` WHERE `jenis_provider`='optik'
		AND `ap`='a' ".$query.") AS biaya_peg_k,
	(SELECT COUNT(DISTINCT nip) FROM `v_transaksi_provider` WHERE `jenis_provider`='optik'
		AND `ap`='p' ".$query.") AS jmlh_pen,
	(SELECT SUM(`jumlah`*`hrg_satuan`) FROM `v_transaksi_provider` WHERE `jenis_provider`='optik'
		AND `ap`='p' ".$query.") AS biaya_pen,
	(SELECT SUM(IF(`hrg_satuan`>`harga_item`,`jumlah`*`harga_item`,`jumlah`*`hrg_satuan`)) FROM `v_transaksi_provider` WHERE `jenis_provider`='optik'
		AND `ap`='p' ".$query.") AS biaya_pen_k,
	(SELECT SUM(`jumlah`*`hrg_satuan`) FROM `v_transaksi_provider` WHERE `jenis_provider`='optik' ".$query.") AS total
UNION ALL
-- transaksi rs
SELECT ('rumah sakit') AS jenis,
	(SELECT COUNT(DISTINCT nip) FROM `v_transaksi_provider` WHERE `jenis_provider`='rumah sakit'
		AND `ap`='a' ".$query.") AS jmlh_peg,
	(SELECT SUM(`jumlah`*`hrg_satuan`) FROM `v_transaksi_provider` WHERE `jenis_provider`='rumah sakit'
		AND `ap`='a' ".$query.") AS biaya_peg,
	(SELECT SUM(IF(`hrg_satuan`>`harga_item`,`jumlah`*`harga_item`,`jumlah`*`hrg_satuan`)) FROM `v_transaksi_provider` WHERE `jenis_provider`='rumah sakit'
		AND `ap`='a' ".$query.") AS biaya_peg_k,
	(SELECT COUNT(DISTINCT nip) FROM `v_transaksi_provider` WHERE `jenis_provider`='rumah sakit'
		AND `ap`='p' ".$query.") AS jmlh_pen,
	(SELECT SUM(`jumlah`*`hrg_satuan`) FROM `v_transaksi_provider` WHERE `jenis_provider`='rumah sakit'
		AND `ap`='p' ".$query.") AS biaya_pen,
	(SELECT SUM(IF(`hrg_satuan`>`harga_item`,`jumlah`*`harga_item`,`jumlah`*`hrg_satuan`)) FROM `v_transaksi_provider` WHERE `jenis_provider`='rumah sakit'
		AND `ap`='p' ".$query.") AS biaya_pen_k,
	(SELECT SUM(`jumlah`*`hrg_satuan`) FROM `v_transaksi_provider` WHERE `jenis_provider`='rumah sakit' ".$query.") AS total");
                        			
			$jumlah = $this->db->query($query2);

            return $jumlah->num_rows();
	}

	function get_rekapBiaya($searchField,$searchString, $sidx, $sord, $limit, $start,$rayon,$wilayah,$mitra,$bulan,$tahun)
	{
            $query=("");
            if($rayon != '')
            {
                $query=$query.(" AND id_rayon=".$rayon);
            }
            if($wilayah != '')
            {
                $query=$query.(" AND id_wilayah=".$wilayah);
            }
            if($mitra != '')
            {
                $query=$query.(" AND id_mitra=".$mitra);
            }
            if($bulan != '')
            {
                $query=$query.(" and month(tgl_kunjungan)=".$bulan);
            }
            if($tahun != '')
            {
                $query=$query.(" and YEAR(tgl_kunjungan)=".$tahun);
            }
            
			if($searchField != '')
            {
                $query=$query.(" and ".$searchField." LIKE '%".$searchString."%' ");
            }
            
			$query2=("SELECT ('Apotek') AS jenis,
	(SELECT COUNT(DISTINCT nip) FROM `v_transaksi_provider` WHERE `jenis_provider`='apotek'
		AND `ap`='a' ".$query."
		) AS jmlh_peg,
	(SELECT SUM(`jumlah`*`hrg_satuan`) FROM `v_transaksi_provider` WHERE `jenis_provider`='apotek'
		AND `ap`='a' ".$query."
		) AS biaya_peg,
	(SELECT SUM(IF(`hrg_satuan`>`harga_item`,`jumlah`*`harga_item`,`jumlah`*`hrg_satuan`)) FROM `v_transaksi_provider` WHERE `jenis_provider`='apotek'
		AND `ap`='a' ".$query.") AS biaya_peg_k,
	(SELECT COUNT(DISTINCT nip) FROM `v_transaksi_provider` WHERE `jenis_provider`='apotek'
		AND `ap`='p' ".$query.") AS jmlh_pen,
	(SELECT SUM(`jumlah`*`hrg_satuan`) FROM `v_transaksi_provider` WHERE `jenis_provider`='apotek'
		AND `ap`='p' ".$query.") AS biaya_pen,
	(SELECT SUM(IF(`hrg_satuan`>`harga_item`,`jumlah`*`harga_item`,`jumlah`*`hrg_satuan`)) FROM `v_transaksi_provider` WHERE `jenis_provider`='apotek'
		AND `ap`='p' ".$query.") AS biaya_pen_k,
	(SELECT SUM(`jumlah`*`hrg_satuan`) FROM `v_transaksi_provider` WHERE `jenis_provider`='apotek' ".$query.") AS total
UNION ALL
-- transaksi dokter
SELECT ('Dokter') AS jenis,
	(SELECT COUNT(DISTINCT nip) FROM `v_transaksi_provider` WHERE (`jenis_provider`='umum' OR `jenis_provider`='spesialis')
		AND `ap`='a' ".$query.") AS jmlh_peg,
	(SELECT SUM(`jumlah`*`hrg_satuan`) FROM `v_transaksi_provider` WHERE (`jenis_provider`='umum' OR `jenis_provider`='spesialis')
		AND `ap`='a' ".$query.") AS biaya_peg,
	(SELECT SUM(IF(`hrg_satuan`>`harga_item`,`jumlah`*`harga_item`,`jumlah`*`hrg_satuan`))
		FROM `v_transaksi_provider` WHERE (`jenis_provider`='umum' OR `jenis_provider`='spesialis') AND `ap`='a' ".$query.") AS biaya_peg_k,
	(SELECT COUNT(DISTINCT nip) FROM `v_transaksi_provider` WHERE (`jenis_provider`='umum' OR `jenis_provider`='spesialis')
		AND `ap`='p' ".$query.") AS jmlh_pen,
	(SELECT SUM(`jumlah`*`hrg_satuan`) FROM `v_transaksi_provider` WHERE (`jenis_provider`='umum' OR `jenis_provider`='spesialis')
		AND `ap`='p' ".$query.") AS biaya_pen,
	(SELECT SUM(IF(`hrg_satuan`>`harga_item`,`jumlah`*`harga_item`,`jumlah`*`hrg_satuan`)) FROM `v_transaksi_provider`
		WHERE (`jenis_provider`='umum' OR `jenis_provider`='spesialis') AND `ap`='p' ".$query.") AS biaya_pen_k,
	(SELECT SUM(`jumlah`*`hrg_satuan`) FROM `v_transaksi_provider` WHERE (`jenis_provider`='umum' OR `jenis_provider`='spesialis') ".$query.") AS total
UNION ALL
-- transaksi Lab gigi
SELECT ('Gigi') AS jenis,
	(SELECT COUNT(DISTINCT nip) FROM `v_transaksi_provider` WHERE `jenis_provider`='lab gigi'
		AND `ap`='a' ".$query.") AS jmlh_peg,
	(SELECT SUM(`jumlah`*`hrg_satuan`) FROM `v_transaksi_provider` WHERE `jenis_provider`='lab gigi'
		AND `ap`='a' ".$query.") AS biaya_peg,
	(SELECT SUM(IF(`hrg_satuan`>`harga_item`,`jumlah`*`harga_item`,`jumlah`*`hrg_satuan`)) FROM `v_transaksi_provider` WHERE `jenis_provider`='lab gigi'
		AND `ap`='a' ".$query.") AS biaya_peg_k,
	(SELECT COUNT(DISTINCT nip) FROM `v_transaksi_provider` WHERE `jenis_provider`='lab gigi'
		AND `ap`='p' ".$query.") AS jmlh_pen,
	(SELECT SUM(`jumlah`*`hrg_satuan`) FROM `v_transaksi_provider` WHERE `jenis_provider`='lab gigi'
		AND `ap`='p' ".$query.") AS biaya_pen,
	(SELECT SUM(IF(`hrg_satuan`>`harga_item`,`jumlah`*`harga_item`,`jumlah`*`hrg_satuan`)) FROM `v_transaksi_provider` WHERE `jenis_provider`='lab gigi'
		AND `ap`='p' ".$query.") AS biaya_pen_k,
	(SELECT SUM(`jumlah`*`hrg_satuan`) FROM `v_transaksi_provider` WHERE `jenis_provider`='lab gigi' ".$query.") AS total
UNION ALL
-- transaksi lab
SELECT ('Laboratorium') AS jenis,
	(SELECT COUNT(DISTINCT nip) FROM `v_transaksi_provider` WHERE `jenis_provider`='laboratorium'
		AND `ap`='a' ".$query.") AS jmlh_peg,
	(SELECT SUM(`jumlah`*`hrg_satuan`) FROM `v_transaksi_provider` WHERE `jenis_provider`='laboratorium'
		AND `ap`='a' ".$query.") AS biaya_peg,
	(SELECT SUM(IF(`hrg_satuan`>`harga_item`,`jumlah`*`harga_item`,`jumlah`*`hrg_satuan`)) FROM `v_transaksi_provider` WHERE `jenis_provider`='laboratorium'
		AND `ap`='a' ".$query.") AS biaya_peg_k,
	(SELECT COUNT(DISTINCT nip) FROM `v_transaksi_provider` WHERE `jenis_provider`='laboratorium'
		AND `ap`='p' ".$query.") AS jmlh_pen,
	(SELECT SUM(`jumlah`*`hrg_satuan`) FROM `v_transaksi_provider` WHERE `jenis_provider`='laboratorium'
		AND `ap`='p' ".$query.") AS biaya_pen,
	(SELECT SUM(IF(`hrg_satuan`>`harga_item`,`jumlah`*`harga_item`,`jumlah`*`hrg_satuan`)) FROM `v_transaksi_provider` WHERE `jenis_provider`='laboratorium'
		AND `ap`='p' ".$query.") AS biaya_pen_k,
	(SELECT SUM(`jumlah`*`hrg_satuan`) FROM `v_transaksi_provider` WHERE `jenis_provider`='laboratorium' ".$query.") AS total
UNION ALL
-- transaksi lain lain
SELECT ('Lain-lain') AS jenis,
	(SELECT COUNT(DISTINCT nip) FROM `v_transaksi_provider` WHERE `jenis_provider`='optik'
		AND `ap`='a' ".$query.") AS jmlh_peg,
	(SELECT SUM(`jumlah`*`hrg_satuan`) FROM `v_transaksi_provider` WHERE `jenis_provider`='optik'
		AND `ap`='a' ".$query.") AS biaya_peg,
	(SELECT SUM(IF(`hrg_satuan`>`harga_item`,`jumlah`*`harga_item`,`jumlah`*`hrg_satuan`)) FROM `v_transaksi_provider` WHERE `jenis_provider`='optik'
		AND `ap`='a' ".$query.") AS biaya_peg_k,
	(SELECT COUNT(DISTINCT nip) FROM `v_transaksi_provider` WHERE `jenis_provider`='optik'
		AND `ap`='p' ".$query.") AS jmlh_pen,
	(SELECT SUM(`jumlah`*`hrg_satuan`) FROM `v_transaksi_provider` WHERE `jenis_provider`='optik'
		AND `ap`='p' ".$query.") AS biaya_pen,
	(SELECT SUM(IF(`hrg_satuan`>`harga_item`,`jumlah`*`harga_item`,`jumlah`*`hrg_satuan`)) FROM `v_transaksi_provider` WHERE `jenis_provider`='optik'
		AND `ap`='p' ".$query.") AS biaya_pen_k,
	(SELECT SUM(`jumlah`*`hrg_satuan`) FROM `v_transaksi_provider` WHERE `jenis_provider`='optik' ".$query.") AS total
UNION ALL
-- transaksi rs
SELECT ('rumah sakit') AS jenis,
	(SELECT COUNT(DISTINCT nip) FROM `v_transaksi_provider` WHERE `jenis_provider`='rumah sakit'
		AND `ap`='a' ".$query.") AS jmlh_peg,
	(SELECT SUM(`jumlah`*`hrg_satuan`) FROM `v_transaksi_provider` WHERE `jenis_provider`='rumah sakit'
		AND `ap`='a' ".$query.") AS biaya_peg,
	(SELECT SUM(IF(`hrg_satuan`>`harga_item`,`jumlah`*`harga_item`,`jumlah`*`hrg_satuan`)) FROM `v_transaksi_provider` WHERE `jenis_provider`='rumah sakit'
		AND `ap`='a' ".$query.") AS biaya_peg_k,
	(SELECT COUNT(DISTINCT nip) FROM `v_transaksi_provider` WHERE `jenis_provider`='rumah sakit'
		AND `ap`='p' ".$query.") AS jmlh_pen,
	(SELECT SUM(`jumlah`*`hrg_satuan`) FROM `v_transaksi_provider` WHERE `jenis_provider`='rumah sakit'
		AND `ap`='p' ".$query.") AS biaya_pen,
	(SELECT SUM(IF(`hrg_satuan`>`harga_item`,`jumlah`*`harga_item`,`jumlah`*`hrg_satuan`)) FROM `v_transaksi_provider` WHERE `jenis_provider`='rumah sakit'
		AND `ap`='p' ".$query.") AS biaya_pen_k,
	(SELECT SUM(`jumlah`*`hrg_satuan`) FROM `v_transaksi_provider` WHERE `jenis_provider`='rumah sakit' ".$query.") AS total");
            
			if($start!='' && $limit!='')
            {
                $query2=$query2." LIMIT ".$start.", ".$limit;
            }
            //echo $query;
            $jumlah = $this->db->query($query2);

            return $jumlah;
        }
		
		 function count_postBiaya($searchField,$searchString,$rayon,$wilayah,$mitra,$bulan,$tahun,$jenis)
	{
            $query=("SELECT * FROM v_laporan_postbiaya");
            
            if($rayon != '')
            {
                $query=$query.(" where id_rayon=".$rayon);
            }
            else if($wilayah != '')
            {
                $query=$query.(" where id_wilayah=".$wilayah);
            }
            else if($mitra != '')
            {
                $query=$query.(" where id_mitra=".$mitra);
            }
            else
            {
                $query=$query.(" where id_rayon>0");
            }
            
            if($bulan != '')
            {
                $query=$query.(" and month(tgl_kunjungan)=".$bulan);
            }
            if($tahun != '')
            {
                $query=$query.(" and YEAR(tgl_kunjungan)=".$tahun);
            }
            if($jenis != '')
            {
                $query=$query.(" and jenis_penyakit = '".$jenis."'");
            }
            
            if($searchField != '' && $searchString!='')
            {
                $query=$query.(" and ".$searchField." LIKE '%".$searchString."%' ");
            }             
          
            $jumlah = $this->db->query($query);

            return $jumlah->num_rows();
	}

	function get_postBiaya($searchField,$searchString, $sidx, $sord, $limit, $start,$rayon,$wilayah,$mitra,$bulan,$tahun,$jenis)
	{
            $query=("SELECT * FROM v_laporan_postbiaya");
            
            if($rayon != '')
            {
                $query=$query.(" where id_rayon=".$rayon);
            }
            else if($wilayah != '')
            {
                $query=$query.(" where id_wilayah=".$wilayah);
            }
            else if($mitra != '')
            {
                $query=$query.(" where id_mitra=".$mitra);
            }
            else
            {
                $query=$query.(" where id_rayon>0");
            }
            
            if($bulan != '')
            {
                $query=$query.(" and month(tgl_kunjungan)=".$bulan);
            }
            if($tahun != '')
            {
                $query=$query.(" and YEAR(tgl_kunjungan)=".$tahun);
            }
			if($jenis != '')
            {
                $query=$query.(" and jenis_penyakit = '".$jenis."'");
            }
            
            if($searchField != '' && $searchString!='')
            {
                $query=$query.(" and ".$searchField." LIKE '%".$searchString."%' ");
            }         
            
            $query=$query." order by ".$sidx." ".$sord;
            if($start!='' && $limit!='')
            {
                $query=$query." LIMIT ".$start.", ".$limit;
            }
             
            
            //echo $query;
            $jumlah = $this->db->query($query);

            return $jumlah;
        }
		
	function get_diag($id)
        {
            $query=("SELECT * FROM v_diagnosa where id_transaksi='".$id."'");
            
            $jumlah = $this->db->query($query);
            return $jumlah;
	}
        
        function get_detailTemuan($id)
        {
            $query=("SELECT * FROM v_transaksi_provider where id_transaksi='".$id."'"); 
               // AND NOT `jenis_provider`='umum' AND NOT `jenis_provider`='spesialis'");
            
            $jumlah = $this->db->query($query);
            return $jumlah;
	}
        //gawenane iqbal

        function get_totalpolifarmasi($rayon,$wilayah,$mitra,$bulan,$tahun)
        {
            $query = ("select sum(biaya) from v_laporan_polifarmasi WHERE  id_rayon>0  ");
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
         $jumlah=$this->db->query($query);
        return $jumlah;
        }
        function get_jmldokterpolifarmasi($rayon,$wilayah,$mitra,$bulan,$tahun)
        {
            $query = ("select count(DISTINCT nama_dokter) as jml_dokter from v_laporan_polifarmasi WHERE  id_rayon>0  ");
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
         $jumlah=$this->db->query($query);
        return $jumlah;
        }
        function get_jmltagihanpolifarmasi($rayon,$wilayah,$mitra,$bulan,$tahun)
        {
            $query = ("select count(id_transaksi) from v_laporan_polifarmasi WHERE  id_rayon>0  ");
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
         $jumlah=$this->db->query($query);
        return $jumlah;
        }

        function get_dokterpolifarmasi($rayon,$wilayah,$mitra,$bulan,$tahun)
        {
            $query = ("select nama_dokter,count(DISTINCT nama_dokter) as jumlah from v_laporan_polifarmasi WHERE  id_rayon>0  ");
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
                $query=$query.(" order by jumlah desc limit 0,5");

         $jumlah=$this->db->query($query);
        return $jumlah;
        }
        function get_totalresepmahal($rayon,$wilayah,$mitra,$bulan,$tahun)
        {
            $query = ("select sum(biaya) from v_laporan_resepmahal WHERE  id_rayon>0  ");
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
         $jumlah=$this->db->query($query);
        return $jumlah;
        }
        function get_jmldokterresepmahal($rayon,$wilayah,$mitra,$bulan,$tahun)
        {
            $query = ("select count(DISTINCT nama_dokter) as jml_dokter from v_laporan_resepmahal WHERE  id_rayon>0  ");
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
         $jumlah=$this->db->query($query);
        return $jumlah;
        }
        function get_jmltagihanresepmahal($rayon,$wilayah,$mitra,$bulan,$tahun)
        {
            $query = ("select count(id_transaksi) from v_laporan_resepmahal WHERE  id_rayon>0  ");
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
         $jumlah=$this->db->query($query);
        return $jumlah;
        }

        function get_dokterresepmahal($rayon,$wilayah,$mitra,$bulan,$tahun)
        {
            $query = ("select nama_dokter,count(DISTINCT nama_dokter) as jumlah from v_laporan_resepmahal WHERE  id_rayon>0  ");
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
                $query=$query.(" order by jumlah desc limit 0,5");

         $jumlah=$this->db->query($query);
        return $jumlah;
        }

        function get_totalobatkeluarga($rayon,$wilayah,$mitra,$bulan,$tahun)
        {
            $query = ("select sum(biaya) from v_laporan_obatkeluarga WHERE  id_rayon>0  ");
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
         $jumlah=$this->db->query($query);
        return $jumlah;
        }
        function get_jmlkeluargaobatkeluarga($rayon,$wilayah,$mitra,$bulan,$tahun)
        {
            $query = ("select count(DISTINCT nama_karyawan) as jml_keluarga from v_laporan_obatkeluarga WHERE  id_rayon>0  ");
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
         $jumlah=$this->db->query($query);
        return $jumlah;
        }
        function get_jmltagihanobatkeluarga($rayon,$wilayah,$mitra,$bulan,$tahun)
        {
            $query = ("select count(id_transaksi) from v_laporan_obatkeluarga WHERE  id_rayon>0  ");
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
         $jumlah=$this->db->query($query);
        return $jumlah;
        }

        function get_dokterobatkeluarga($rayon,$wilayah,$mitra,$bulan,$tahun)
        {
            $query = ("select nama_dokter,count(DISTINCT nama_dokter) as jumlah from v_laporan_obatkeluarga WHERE  id_rayon>0  ");
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
                $query=$query.(" order by jumlah desc limit 0,5");

         $jumlah=$this->db->query($query);
        return $jumlah;
        }

        function get_totalobatberlebih($rayon,$wilayah,$mitra,$bulan,$tahun)
        {
            $query = ("select sum(jumlah * hrg_satuan) as biaya, sum(selisih) as selisih from v_laporan_obatberlebih WHERE  id_rayon>0  ");
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
         $jumlah=$this->db->query($query);
        return $jumlah;
        }
        function get_jmldokterobatberlebih($rayon,$wilayah,$mitra,$bulan,$tahun)
        {
            $query = ("select count(DISTINCT nama_dokter) as jumlah from v_laporan_obatberlebih WHERE  id_rayon>0  ");
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
         $jumlah=$this->db->query($query);
        return $jumlah;
        }
        function get_jmltagihanobatberlebih($rayon,$wilayah,$mitra,$bulan,$tahun)
        {
            $query = ("select count(id_transaksi) from v_laporan_obatberlebih WHERE  id_rayon>0  ");
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
         $jumlah=$this->db->query($query);
        return $jumlah;
        }

        function get_dokterobatberlebih($rayon,$wilayah,$mitra,$bulan,$tahun)
        {
            $query = ("select nama_dokter,count(DISTINCT nama_dokter) as jumlah from v_laporan_obatberlebih WHERE  id_rayon>0  ");
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
                $query=$query.(" order by jumlah desc limit 0,5");

         $jumlah=$this->db->query($query);
        return $jumlah;
        }

        function get_totalshopingdokter($rayon,$wilayah,$mitra,$bulan,$tahun)
        {
            $query = ("select sum(biaya) as biaya from v_laporan_shopingdokter WHERE  id_rayon>0  ");
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
         $jumlah=$this->db->query($query);
        return $jumlah;
        }
        function get_jmlpenanggungshopingdokter($rayon,$wilayah,$mitra,$bulan,$tahun)
        {
            $query = ("select count(DISTINCT nama_karyawan) as jumlah from v_laporan_shopingdokter WHERE  id_rayon>0  ");
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
         $jumlah=$this->db->query($query);
        return $jumlah;
        }
        function get_jmltagihanshopingdokter($rayon,$wilayah,$mitra,$bulan,$tahun)
        {
            $query = ("select count(id_transaksi) from v_laporan_shopingdokter WHERE  id_rayon>0  ");
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
         $jumlah=$this->db->query($query);
        return $jumlah;
        }

        function get_penanggungshopingdokter($rayon,$wilayah,$mitra,$bulan,$tahun)
        {
            $query = ("select nama_karyawan,count(DISTINCT nama_karyawan) as jumlah from v_laporan_shopingdokter WHERE  id_rayon>0  ");
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
                $query=$query.(" order by jumlah desc limit 0,2");

         $jumlah=$this->db->query($query);
        return $jumlah;
        }

}
