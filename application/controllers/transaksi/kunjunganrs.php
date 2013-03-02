<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kunjunganrs extends CI_Controller {
    function __construct() 
    {
        parent::__construct();
        $this->load->model('m_tran_kunjunganrs');
	$this->load->helper('url'); // Load Helper URL CI
    }
    
    function index() 
    {
	$this->load->view('transaksi/kunjunganrs'); //Default di arahkan ke function grid
    }
    
    function lookpegawai()
    {
        $keyword = $this->input->post('term');
        $data['response'] = 'false';
        $query = $this->m_tran_kunjunganrs->caripegawai($keyword);
        if( ! empty($query) )
        {
            $data['response'] = 'true';
            $data['message'] = array();
            foreach( $query as $row )
            {
                $data['message'][] = array(
                                        'id'=>  $row['id_karyawan'],
                                        'value' => $row['nama_karyawan'],
                                        'bagian' => $row['id_bagian'],
                                        'nip' => $row['nip']
                                     );
            }
        }
        echo json_encode($data);
    }
	
    function lookdokter()
    {
        $keyword = $this->input->post('term');
        $data['response'] = 'false';
        $query = $this->m_tran_kunjunganrs->caridokter($keyword);
        if( ! empty($query) )
        {
            $data['response'] = 'true';
            $data['message'] = array();
            foreach( $query as $row )
            {
                $data['message'][] = array(
                                        'id'=>  $row['id_dokter'],
                                        'value' => $row['nama_dokter']

                                     );
            }
        }
        echo json_encode($data);
    }
    
    function lookrs()
    {
        $keyword = $this->input->post('term');
        $data['response'] = 'false';
        $query = $this->m_tran_kunjunganrs->carirs($keyword);
        if( ! empty($query) )
        {
            $data['response'] = 'true';
            $data['message'] = array();
            foreach( $query as $row )
            {
                $data['message'][] = array(
                                        'id'=>  $row['id_provider'],
                                        'value' => $row['nama_provider']
                                     );
            }
        }
        echo json_encode($data);
    }
    
    function bagian()
    {
        //$id = "1";
        $id = $this->input->post('id');
        $query = $this->m_tran_kunjunganrs->get_bagian($id);
        if( ! empty($query) )
        {
            foreach( $query as $row )
            {
                echo $row['nama_bagian'];
            }
        }
    }        
    
    function pasien()
    {
        $id = $this->input->post('id');
        $query = $this->m_tran_kunjunganrs->get_pasien($id);
        echo"<option>--Pilih Pasien--</option>";
        if( ! empty($query) )
        {
            foreach( $query as $row )
            {
                echo "<option value=";
                echo $row['id_tertanggung'];
                echo ">";
                echo $row['nama_tertanggung'];
                echo "</option>";
            }
        }
    }
    
    function simpandata()
    {
        $pegawai = $this->input->get('pegawai');
        $pasien = $this->input->get('pasien');
        $id_rs = $this->input->get('id_rs');
        $rumah_sakit = $this->input->get('rumah_sakit');
        if ($id_rs=='undefined') {
            
            $query = $this->m_tran_kunjunganrs->get_id_provider();
            if( ! empty($query) )
            {
                foreach( $query as $row )
                {
                    $id_ap=$row['id_provider']+1;
                }
                $data=array('id_provider'=>$id_ap,'nama_provider'=>$rumah_sakit,'idjenis_provider'=>'5');
                $this->m_tran_kunjunganrs->simpan_provider($data);
                $id_rs=$id_ap;
            }            
        }
        $nip = $this->input->get('nip');
        $tgl_trans = $this->input->get('tgl_trans');
        $tgl_masuk = $this->input->get('tgl_masuk');
        $tgl_keluar = $this->input->get('tgl_keluar');
        $tgl_kunjungan= date("Y-m-d");
        $no_surat = $this->input->get('no_surat');
        
        $diagnosa_masuk = $this->input->get('diagnosa_masuk');        
        $kondisi_umum = $this->input->get('kondisi_umum');
        $dokter_rawat = $this->input->get('dokter_rawat');
        if ($dokter_rawat=="Rawat Bersama"){
            $dokter_rawat="B";
        }else if ($dokter_rawat=="Rawat Tunggal"){
            $dokter_rawat="T";
        }
        $id_dokter = $this->input->get('id_dokter');
        $dokter = $this->input->get('dokter');
        if ($id_dokter=='undefined')
        {            
            $query = $this->m_tran_kunjunganrs->get_id_dokter();
            if( ! empty($query) )
            {
                foreach( $query as $row )
                {
                    $id_dok = $row['id_dokter']+1;
                }
                $data=array('id_dokter'=>$id_dok, 'nama_dokter'=>$dokter, 'gol_dokter'=>'2', 'kat_dokter'=>'2');
                $this->m_tran_kunjunganrs->simpan_dokter($data);
                $id_dokter=$id_dok;
            }            
        }
        $jumlah_obat = $this->input->get('jumlah_obat');
        $rencana_tindakan = $this->input->get('rencana_tindakan');
        
        $query = $this->m_tran_kunjunganrs->get_id_transaksi();
        $row = $query->row();
        $id_transaksi=$row->id_transaksi+1;
        
        //11 -> kode buat kunjungan rs
        /*
        $data1=array('id_pasien'=>$id_pasien,'id_jenis'=>'11','nip'=>$nip,'id_tertanggung'=>$pasien,'id_provider'=>$id_rs,
                    'tgl_transaksi'=>$tgl_trans,'tgl_masuk'=>$tgl_masuk,'tgl_keluar'=>$tgl_keluar,'no_surat'=>$no_surat);        
        $query3=$this->m_tran_kunjunganrs->simpan_trans_pasien($data1);

        if ($query3){
            $data2=array('id_pasien'=>$id_pasien,'diagnosa_masuk'=>$diagnosa_masuk,'kondisi_umum'=>$kondisi_umum,'dokter_rawat'=>$dokter_rawat,
                    'id_dokter'=>$id_dokter,'jenis_obat'=>$jumlah_obat,'rencana_tindakan'=>$rencana_tindakan);        
            $query4=$this->m_tran_kunjunganrs->simpan_trans_periksa($data2);
            
            if ($query4){
                echo "sukses";
            }
        }
         * 
         */
        $data1=array('id_transaksi'=>$id_transaksi,'id_tertanggung'=>$pasien,'tgl_transaksi'=>$tgl_trans,'tgl_kunjungan'=>$tgl_kunjungan);        
        $query3=$this->m_tran_kunjunganrs->simpan_transaksi($data1);
        if($query3){
            $data2=array('id_transaksi'=>$id_transaksi,'id_provider'=>$id_rs,'no_surat'=>$no_surat,
                            'tgl_masuk'=>$tgl_masuk,'tgl_keluar'=>$tgl_keluar);        
            $query4=$this->m_tran_kunjunganrs->simpan_trans_kunjungan($data2);
            
            $data3=array('diagnosa_masuk'=>$diagnosa_masuk,'kondisi'=>$kondisi_umum,'dokter_rawat'=>$dokter_rawat,
                            'jenis_jml_obat'=>$jumlah_obat,'id_transaksi'=>$id_transaksi,'id_dokter'=>$id_dokter,'tindakan'=>$rencana_tindakan);        
            $query5=$this->m_tran_kunjunganrs->simpan_trans_periksa($data3);
            if($query4 && $query5){
                echo "sukses";
            }else{
                echo "gagal";
            }
        } else{
            echo "gagal";
        }
    }
    function tes(){
        $query = $this->m_tran_kunjunganrs->get_id_transaksi();
        $row = $query->row();
        $id_transaksi=$row->id_transaksi+1;
        echo "id : ".$id_transaksi;
    }
    
    
    
}