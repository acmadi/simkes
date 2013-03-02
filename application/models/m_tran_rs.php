<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_tran_rs extends CI_Model {
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
    
    function caritagihan($keyword, $id)
    {        
        $this->db->select('id_item, nama_item, harga_item'); 
        $this->db->where('idjns_item',$id);
        $this->db->like('nama_item',$keyword,'after');        
        $query = $this->db->get('master_item');
        return $query->result_array();       
    }
	
    function caridokter($keyword)
    {
        $this->db->select('id_dokter, nama_dokter,tarif_standar');
        $this->db->where('gol_dokter','2');
        $this->db->like('nama_dokter',$keyword,'after');
        $this->db->limit('10');
        $query = $this->db->get('master_dokter');
        return $query->result_array();
    }
    
    function cariprovider($keyword)
    {
        $this->db->select('id_provider, nama_provider');
        $this->db->like('nama_provider',$keyword,'after');
        $this->db->where('idjenis_provider','5');
        $this->db->limit('10');
        $query = $this->db->get('master_provider');
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
    
    function caridosis($keyword)
    {
        $this->db->select('id_dosis, nama_dosis');
        $this->db->like('nama_dosis',$keyword,'after');        
        $this->db->limit('10');
        $query = $this->db->get('master_dosis');
        return $query->result_array();
    }
    
    function carirekomendasi($keyword)
    {
        $this->db->select('id_rekomendasi, nama_rekomendasi');
        $this->db->like('nama_rekomendasi',$keyword,'after');        
        $this->db->limit('10');
        $query = $this->db->get('master_rekomendasi');
        return $query->result_array();
    }
    
    function get_bagian($bagian)
    {
        $this->db->select('id_bagian, nama_bagian');
        $this->db->where('id_bagian',$bagian);
        $query = $this->db->get('bagian_karyawan');
        return $query->result_array();
    }
    
    function get_tagihan()
    {
        $this->db->select('idjns_item, jenis_item');
        $query = $this->db->get('jenis_item');
        return $query->result_array();
    }
    
    function get_pasien($id)
    {
        $this->db->select('id_tertanggung, nama_tertanggung');
        $this->db->where('id_karyawan',$id);
        $query = $this->db->get('master_tertanggung');
        return $query->result_array();
    }
    
    function get_id_transaksi()
    {
        $this->db->select_max('id_transaksi');
        $query = $this->db->get('transaksi');
        return $query;
    }
    
    function simpan_transaksi($datanya)
    {
        return $this->db->insert('transaksi',$datanya);
    }
    
    function simpan_transaksi_rs($datanya)
    {
        return $this->db->insert('transaksi_rmh_sakit',$datanya);
    }
    
    function simpan_transaksi_buku($datanya)
    {
        return $this->db->insert('master_buku_besar',$datanya);
    }
    
    function simpan_trans_tarif($data)
    {
        return $this->db->insert('harga_dokter',$data);
    }
        
    function count_diagnosa($data)
    {
        $this->db->where('nama_diagnosa',$data);
        return $this->db->count_all_results('master_diagnosa');
    }
    
    function count_diagnosa2($like, $id) 
    {
        $like != '' ? $this->db->like($like) : '';
        $this->db->where('id_transaksi',$id);
        return $this->db->count_all_results('v_diagnosa');
    }       
    
    function get_diagnosa2($like, $sidx, $sord, $limit, $start, $kun) 
	{
            $like != '' ? $this->db->like($like) : '';
            $this->db->where('id_transaksi', $kun);
            $this->db->order_by($sidx, $sord);
            return $this->db->get('v_diagnosa', $limit, $start);
	}
    
    function get_id_diagnosaxx($diagnosa)
    {
        $this->db->select('id_diagnosa, nama_diagnosa');
        $this->db->where('nama_diagnosa',$diagnosa);
        $query = $this->db->get('master_diagnosa');
        //return $query->result_array();
        return $query;
    }
    
    function get_id_dosis()
    {
        $this->db->select_max('id_dosis');
        $query = $this->db->get('master_dosis');
        //return $query->result_array();
        return $query;
    }
    
    function get_id_item()
    {
        $this->db->select_max('id_item');
        $query = $this->db->get('master_item');
        return $query;
    }
    
    function get_id_diagnosa()
    {
        $this->db->select_max('id_diagnosa');
        $query = $this->db->get('master_diagnosa');
        return $query;
    }
    
    function simpan_dosis($data)
    {
        return $this->db->insert('master_dosis',$data);
    }
    
    function simpan_item($data)
    {
        return $this->db->insert('master_item',$data);
    }
    
    function simpan_item_dosis($data)
    {
        return $this->db->insert('dosis_item',$data);
    }
    
    function get_id_rekomendasi()
    {
        $this->db->select_max('id_rekomendasi');
        $query = $this->db->get('master_rekomendasi');
        return $query;
    }
    
    function simpan_rekomendasi($data)
    {
        return $this->db->insert('master_rekomendasi',$data);
    }
    
    function simpan_item_transaksi($data)
    {
        return $this->db->insert('item_transaksi_rs',$data);
    }
    
    function simpan_diagnosa($data)
    {
        return $this->db->insert('master_diagnosa',$data);
    }
    function simpan_item_diagnosa($data2)
    {
        return $this->db->insert('transaksi_diagnosa',$data2);
    }
    function get_diagnosa($id)
    {
        $query = $this->db->query('select item_diagnosa.id_item, master_diagnosa.nama_diagnosa from item_diagnosa, master_diagnosa
                                where item_diagnosa.id_diagnosa= master_diagnosa.id_diagnosa and id_kunjungan='.$id);
        //$this->db->select('idjenis_provider, jenis_provider');
        //$query = $this->db->get('jenis_provider');
        return $query->result_array();
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
    function get_id_provider()
    {
        $this->db->select_max('id_provider');
        //$this->db->where('idjenis_provider','2');
        $query = $this->db->get('master_provider');
        return $query->result_array();
    }
    function simpan_provider($data)
    {
        return $this->db->insert('master_provider',$data);
    }

    function nama_diagnosa21($id)
    {
        $this->db->select('nama_diagnosa');
        $this->db->where('id_diagnosa',$id);
        $query = $this->db->get('master_diagnosa');
        //return $query->result_array();
        return $query;
    }
    function delete_diagnosa($id) 
    {
	//$this->db->where('id_diagnosa', $id_diag);
        $this->db->where('id_transaksi_diagnosa', $id);
	$this->db->delete('transaksi_diagnosa'); 
    }
    
    function count_transaksi($like, $id) 
    {
        $like != '' ? $this->db->like($like) : '';
        $this->db->where('id_transaksi',$id);
        return $this->db->count_all_results('v_item_transaksi_rs');
    }    
    function get_transaksi($like, $sidx, $sord, $limit, $start, $kun) 
    {
        $like != '' ? $this->db->like($like) : '';
        $this->db->where('id_transaksi', $kun);
        $this->db->order_by($sidx, $sord);
        return $this->db->get('v_item_transaksi_rs', $limit, $start);
    }
    
    function nama_jenis($id)
    {
        $this->db->select('nama_tagihan');
        $this->db->where('id_jenis',$id);
        $query = $this->db->get('jenis_tagihan');
        return $query;
    }
    function nama_dokter($id)
    {
        $this->db->select('nama_dokter');
        $this->db->where('id_dokter',$id);
        $query = $this->db->get('master_dokter');
        return $query;
    }
    /*
    function nama_harga($id)
    {
        $this->db->select('harga_standart,harga_satuan');
        $this->db->where('id_harga',$id);
        $query = $this->db->get('master_harga');
        return $query;
    }
     * 
     */
    function nama_dosis($id)
    {
        $this->db->select('nama_dosis');
        $this->db->where('id_dosis',$id);
        $query = $this->db->get('master_dosis');
        return $query;
    }
    function nama_rekom($id)
    {
        $this->db->select('nama_rekomendasi');
        $this->db->where('id_rekomendasi',$id);
        $query = $this->db->get('master_rekomendasi');
        return $query;
    }
    function delete_transaksi($id) 
    {
	$this->db->where('id_item_transaksi_rs', $id);
	$this->db->delete('item_transaksi_rs'); 
    }
    
    function simpan_ov($data)
    {
        return $this->db->insert('transaksi_ov',$data);
    }
    
    function count_ov($like, $id) 
    {
        $like != '' ? $this->db->like($like) : '';
        $this->db->where('id_transaksi',$id);
        return $this->db->count_all_results('v_item_transaksi_ov');
    }
    
    function get_ov($like, $sidx, $sord, $limit, $start, $kun) 
    {
        $like != '' ? $this->db->like($like) : '';
        $this->db->where('id_transaksi', $kun);
        $this->db->order_by($sidx, $sord);
        return $this->db->get('v_item_transaksi_ov', $limit, $start);
    }
    
    function delete_ov($id) 
    {
	$this->db->where('id_transaksi_ov', $id);
	$this->db->delete('transaksi_ov'); 
    }

    function cek_pasien($id,$nama)
    {
        $this->db->select('id_tertanggung');
        $this->db->where('id_karyawan',$id);
        $this->db->where('nama_tertanggung',$nama);
        $query = $this->db->get('master_tertanggung');
        return $query->result_array();
    }

    function cariidtagihan($keyword)
    {
        $this->db->select('idjns_item');
        $this->db->like('jenis_item',$keyword,'after');
        $query = $this->db->get('jenis_item');
        return $query->result_array();
    }
    function carirujukan($keyword)
    {
        $this->db->select('id_rujukan, nama_rujukan');
        $this->db->like('nama_rujukan',$keyword,'after');
        $query = $this->db->get('master_rujukan');
        return $query->result_array();
    }
}