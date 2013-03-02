<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_status_karyawan extends CI_Model {
	function __construct()
	{
        parent::__construct();
        }

        function get_status()
        {
            $query=("SELECT * from status_karyawan ");
            $jumlah = $this->db->query($query);
            return $jumlah;
        }


}
