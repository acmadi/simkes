<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Excell extends CI_Controller {

	
	public function index()
	{
		$array = array(
			array('Last Name', 'First Name', 'Gender'),
			array('Furtado', 'Nelly', 'female'),
			array('Twain', 'Shania', 'female'),
			array('Farmer', 'Mylene', 'female')
		);
		 
		$this->load->helper('xls');
		array_to_xls($array, 'coba.xls');
                
                //echo "sukses";
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */