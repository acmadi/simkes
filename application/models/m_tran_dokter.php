<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_tran_dokter extends CI_Model {
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
        $this->db->select('id_dokter, nama_dokter,tarif_standar, tarif_dokter');
        $this->db->where('gol_dokter','3');
        $this->db->like('nama_dokter',$keyword,'after');
        $this->db->limit('10');
        $query = $this->db->get('master_dokter');
        return $query->result_array();
    }
    function caridokterrujukan($keyword,$kat_dokter,$gol_dokter)
    {
        $this->db->select('id_dokter, nama_dokter,tarif_standar, tarif_dokter');
        $this->db->where('kat_dokter',$kat_dokter);
        $this->db->where('gol_dokter',$gol_dokter);
        $this->db->like('nama_dokter',$keyword,'after');
        $this->db->limit('10');
        $query = $this->db->get('master_dokter');
        return $query->result_array();
    }
    

    
    function cariapotek($keyword)
    {
        $this->db->select('id_provider, nama_provider');
        $this->db->like('nama_provider',$keyword,'after');
        $this->db->where('idjenis_provider','1');
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
    
    function caritagihan($keyword, $id)
    {        
        $this->db->select('id_item, nama_item, harga_item'); 
        $this->db->where('idjns_item',$id);
        $this->db->like('nama_item',$keyword,'after');        
        $query = $this->db->get('master_item');
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
    function carirujukan($keyword)
    {
        $this->db->select('id_rujukan, nama_rujukan');
        $this->db->like('nama_rujukan',$keyword,'after');
        $query = $this->db->get('master_rujukan');
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
    
    function get_id_diagnosa()
    {
        $this->db->select_max('id_diagnosa');
        $query = $this->db->get('master_diagnosa');
        return $query;
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
    
    function simpan_transaksi_dokter($datanya)
    {
        return $this->db->insert('transaksi_dokter',$datanya);
    }
    
    function simpan_transaksi_buku($datanya)
    {
        return $this->db->insert('master_buku_besar',$datanya);
    }
    
    
    function get_id_item()
    {
        $this->db->select_max('id_item');
        $query = $this->db->get('master_item');
        return $query;
    }
    
    function simpan_item($data)
    {
        return $this->db->insert('master_item',$data);
    }
    
    
    function simpan_dosis($data)
    {
        return $this->db->insert('master_dosis',$data);
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
    
    function simpan_diagnosa($data)
    {
        return $this->db->insert('master_diagnosa',$data);
    }
    function simpan_item_diagnosa($data2)
    {
        return $this->db->insert('transaksi_diagnosa',$data2);
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
    
    function delete_diagnosa($id) 
    {
	$this->db->where('id_transaksi_diagnosa', $id);
	$this->db->delete('transaksi_diagnosa');
    }
    
    function simpan_item_dosis($data)
    {
        return $this->db->insert('dosis_item',$data);
    }
    
    function simpan_item_transaksi($data)
    {
        return $this->db->insert('item_transaksi_dokter',$data);
    }
    
    function count_transaksi($like, $id) 
    {
         $like != '' ? $this->db->like($like) : '';
        $this->db->where('id_transaksi',$id);
        return $this->db->count_all_results('v_item_transaksi_dokter');
    }    
    function get_transaksi($like, $sidx, $sord, $limit, $start, $kun) 
    {
        $like != '' ? $this->db->like($like) : '';
        $this->db->where('id_transaksi', $kun);
        $this->db->order_by($sidx, $sord);
        return $this->db->get('v_item_transaksi_dokter', $limit, $start);
    }
    
    function get_id_item_lain($id)
    {
        $this->db->select('id_item,id_transaksi');
        $this->db->where('id_transaksi_dokter',$id);
        $query = $this->db->get('item_transaksi_dokter');
        //return $query->result_array();
        return $query;
    }
    
    function delete_item_transaksi($id) 
    {
	$this->db->where('id_transaksi_dokter', $id);
	$this->db->delete('item_transaksi_dokter'); 
    }
    
    function delete_dosis($id_item,$id) 
    {
	$this->db->where('id_item', $id_item);
        $this->db->where('id_transaksi', $id);
	$this->db->delete('dosis_item'); 
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