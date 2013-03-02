<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Validasi
{
	public function cekLengthString($kata,$jumlah)
	{
		$jum=strlen($kata);
                //echo $jum;
		if($jum > $jumlah)
		{
		return false;
		}
		else
		{
		return true;
		}
                 
                
	}

        public function cetak($kata)
        {
            echo $kata;
        }
}