<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Teslibrary extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
                $this->load->library('validasi');
	}

        function index()
        {
            $str="Haieeeeee";
            
            if($this->validasi->cekLengthString($str,15))
            {echo "Benar";}
            else
            {echo "Salahc";}
            
            $this->validasi->cetak("Hai");

        }
}
