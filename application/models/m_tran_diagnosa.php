<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_tran_diagnosa extends CI_Model {
    function __construct() 
    {
        parent::__construct();
    }

    function getDiagnosa($id)
    {        
        $query=('select md.nama_diagnosa from transaksi_diagnosa td join master_diagnosa md on md.id_diagnosa = td.id_diagnosa where td.id_transaksi='.$id);

                $jumlah = $this->db->query($query);
                return $jumlah;
     
    }


}