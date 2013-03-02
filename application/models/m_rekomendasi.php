<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_rekomendasi extends CI_Model
{
	function __construct()
	{
        parent::__construct();
        }

        function getIdrekomendasi($string)
        {
            $query=('select * from master_rekomendasi');
            $query .=" where nama_rekomendasi like '".$string."' ";
            $jumlah = $this->db->query($query);
            return $jumlah;
        }
}