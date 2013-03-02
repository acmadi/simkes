<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_tran_kunjunganrs extends CI_Model {
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
	
    function caridokter($keyword)
    {
        $this->db->select('id_dokter, nama_dokter');
        $this->db->where('gol_dokter','2');
        $this->db->like('nama_dokter',$keyword,'after');
        $this->db->limit('10');
        $query = $this->db->get('master_dokter');
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
    
    function get_id_kunjungan()
    {
        $this->db->select_max('id_kunjungan');
        $query = $this->db->get('master_kunjungan');
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
    
    function get_id_dokter()
    {
        $this->db->select_max('id_dokter');
        $query = $this->db->get('master_dokter');
        return $query->result_array();
    }
    
    function simpan_dokter($data)
    {
        return $this->db->insert('master_dokter',$data);
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
    
    function simpan_trans_kunjungan($data)
    {
        return $this->db->insert('transaksi_kunjungan_rs',$data);
    }
    
    function simpan_trans_periksa($data)
    {
        return $this->db->insert('periksa_kunjungan_rs',$data);
    }
    function cek_pasien($id,$nama)
    {
        $this->db->select('id_tertanggung');
        $this->db->where('id_karyawan',$id);
        $this->db->where('nama_tertanggung',$nama);
        $query = $this->db->get('master_tertanggung');
        return $query->result_array();
    }
}