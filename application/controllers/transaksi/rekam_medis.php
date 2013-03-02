<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rekam_medis extends CI_Controller {
    function __construct() 
    {
        parent::__construct();
        $this->load->model('m_tran_rekam_medis');
	$this->load->helper('url'); // Load Helper URL CI
    }
    
    function index() 
    {
	$this->load->view('transaksi/rekam_medis'); //Default di arahkan ke function grid
    }
    
    function lookpegawai()
    {
        $keyword = $this->input->post('term');
        $data['response'] = 'false';
        $query = $this->m_tran_rekam_medis->caripegawai($keyword);
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
	
    function lookrs()
    {
        $keyword = $this->input->post('term');
        $data['response'] = 'false';
        $query = $this->m_tran_rekam_medis->carirs($keyword);
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
        $query = $this->m_tran_rekam_medis->get_bagian($id);
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
        $query = $this->m_tran_rekam_medis->get_pasien($id);
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
            
            $query = $this->m_tran_rekam_medis->get_id_provider();
            if( ! empty($query) )
            {
                foreach( $query as $row )
                {
                    $id_ap=$row['id_provider']+1;
                }
                $data=array('id_provider'=>$id_ap,'nama_provider'=>$rumah_sakit,'idjenis_provider'=>'5');
                $this->m_tran_rekam_medis->simpan_provider($data);
                $id_rs=$id_ap;
            }            
        }
        $nip = $this->input->get('nip');
        $tgl_trans = $this->input->get('tgl_trans');
        $tgl_masuk = $this->input->get('tgl_masuk');
        $tgl_keluar = $this->input->get('tgl_keluar');
        $tgl_kunjungan = date("Y-m-d");
        $no_surat = $this->input->get('no_surat');
        
        $diagnosa_masuk = $this->input->get('diagnosa_masuk');
        $diagnosa_keluar = $this->input->get('diagnosa_keluar');
        $riwayat_penyakit = $this->input->get('riwayat_penyakit');
        $pemeriksaan_fisik = $this->input->get('pemeriksaan_fisik');
        $hasil_lab = $this->input->get('hasil_lab');
        $hasil_rontgen = $this->input->get('hasil_rontgen');
        $pemeriksaan_lain = $this->input->get('pemeriksaan_lain');
        $progres_harian = $this->input->get('progres_harian');
        $pasca_rawat = $this->input->get('pasca_rawat');
        $tindakan = $this->input->get('tindakan');

        $query = $this->m_tran_rekam_medis->get_id_transaksi();
        $row = $query->row();
        $id_transaksi=$row->id_transaksi+1;
        
        //10 -> kode buat rekam medis
        /*
        $data1=array('id_pasien'=>$id_pasien,'id_jenis'=>'10','nip'=>$nip,'id_tertanggung'=>$pasien,'id_provider'=>$id_rs,
                    'tgl_transaksi'=>$tgl_trans,'tgl_masuk'=>$tgl_masuk,'tgl_keluar'=>$tgl_keluar,'no_surat'=>$no_surat);        
        $query3=$this->m_tran_rekam_medis->simpan_trans_pasien($data1);

        if ($query3){
            $data2=array('id_pasien'=>$id_pasien,'diagnosa_masuk'=>$diagnosa_masuk,'diagnosa_keluar'=>$diagnosa_keluar,'riwayat_penyakit'=>$riwayat_penyakit,
                    'pemeriksaan_fisik'=>$pemeriksaan_fisik,'hasil_lab'=>$hasil_lab,'hasil_rontgen'=>$hasil_rontgen,'pemeriksaan_lain'=>$pemeriksaan_lain,
                    'progres_harian'=>$progres_harian,'pasca_rawat'=>$pasca_rawat,'tindakan'=>$tindakan);        
            $query4=$this->m_tran_rekam_medis->simpan_trans_periksa($data2);
            
            if ($query4){
                echo "sukses";
            }
        }
         * 
         */
        $data1=array('id_transaksi'=>$id_transaksi,'id_tertanggung'=>$pasien,'tgl_transaksi'=>$tgl_trans,'tgl_kunjungan'=>$tgl_kunjungan);        
        $query3=$this->m_tran_rekam_medis->simpan_transaksi($data1);
        
        if($query3){
            $data2=array('id_transaksi'=>$id_transaksi,'id_provider'=>$id_rs,'no_kamar'=>$no_surat,
                            'tgl_masuk'=>$tgl_masuk,'tgl_keluar'=>$tgl_keluar);        
            $query4=$this->m_tran_rekam_medis->simpan_trans_rekam($data2);
            
            $data3=array('diagnosa_masuk'=>$diagnosa_masuk,'diagnosa_keluar'=>$diagnosa_keluar,'riwayat'=>$riwayat_penyakit,
                            'periksa_fisik'=>$pemeriksaan_fisik,'hasil_lab'=>$hasil_lab,'hasil_rontgen'=>$hasil_rontgen,'hasil_lain'=>$pemeriksaan_lain,
                            'progres_harian'=>$progres_harian,'pasca_rawat'=>$pasca_rawat,'tindakan'=>$tindakan,'id_transaksi'=>$id_transaksi);        
            $query5=$this->m_tran_rekam_medis->simpan_trans_periksa($data3);
            if($query4 && $query5){
                echo "sukses";
            }else{
                echo "gagal";
            }
        } else{
            echo "gagal";
        }
    }
    
    
}