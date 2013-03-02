<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_jenis_item extends CI_Model {
	function __construct() 
	{
        parent::__construct();
        }
	
	function get_JenisItem()
	{
	 return $this->db->get('jenis_item');
	}
	
	
	
	
}