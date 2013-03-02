<?php 
class Admin extends CI_Controller
{
function Home()
	{
		parent::__construct();
	}
	
	function index()
	{	
	 
	$data['footer']="pandalu.com";
	$this->load->view('admin',$data);
	}
}
?>