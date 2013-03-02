<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_tran_rekam_medis extends CI_Model {
    function __construct() 
    {
        parent::__construct();
    }

    function caripegawai($keyword)
    {        
        $this->db->select('id_karyawan, nama_karyawan, id_bagian,nip'); 
        $this->db->like('nama_karyawan',$keyword,'after');        
        $query = $this->db->get('master_karyawan');
        return $query->result_array();       
    }
	
    function carirs($keyword)
    {
        $this->db->select('id_provider, nama_provider');
        $this->db->where('idjenis_provider','5');
        $this->db->like('nama_provider',$keyword,'after');
        $this->db->limit('10');
        $query = $this->db->get('master_provider');
        return $query->result_array();
    }
    
    function get_bagian($bagian)
    {
        $this->db->select('id_bagian, nama_bagian');
        $this->db->where('id_bagian',$bagian);
        $query = $this->db->get('bagian_karyawan');
        return $query->result_array();
    }
    
    function get_pasien($id)
    {
        $this->db->select('id_tertanggung, nama_tertanggung');
        $this->db->where('id_karyawan',$id);
        $query = $this->db->get('master_tertanggung');
        return $query->result_array();
    }
    
    function get_id_provider()
    {
        $this->db->select_max('id_provider');
        $query = $this->db->get('master_provider');
        return $query->result_array();
    }
    
    function simpan_provider($data)
    {
        return $this->db->insert('master_provider',$data);
    }
    
    function get_id_transaksi()
    {
        $this->db->select_max('id_transaksi');
        $query = $this->db->get('transaksi');
        return $query;
    }
    
    function simpan_transaksi($data)
    {
        return $this->db->insert('transaksi',$data);
    }  
    
    function simpan_trans_rekam($data)
    {
        return $this->db->insert('transaksi_rekam_medis',$data);
    }
    
    function simpan_trans_periksa($data)
    {
        return $this->db->insert('periksa_rekam_medis',$data);
    }
    function cek_pasien($id,$nama)
    {
        $this->db->select('id_tertanggung');
        $this->db->where('id_karyawan',$id);
        $this->db->where('nama_tertanggung',$nama);
        $query = $this->db->get('master_tertanggung');
        return $query->result_array();
    }
    function caridiagnosa($keyword)
    {
        $this->db->select('id_diagnosa, nama_diagnosa');
        $this->db->like('nama_diagnosa',$keyword,'after');
        $this->db->limit('10');
        $query = $this->db->get('master_diagnosa');
        return $query->result_array();
    }

    function simpan_diagnosa($data)
    {
        return $this->db->insert('master_diagnosa',$data);
    }
}