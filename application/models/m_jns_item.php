<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_jns_item extends CI_Model {
	function __construct() 
	{
        parent::__construct();
        }
	
        function getIdjnsitem($string)
        {
            $query ="select * from jenis_item j where j.jenis_item = '".$string."' ";
            $jumlah = $this->db->query($query);
            return $jumlah;
        }
}