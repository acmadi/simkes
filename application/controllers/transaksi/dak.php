<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dak extends CI_Controller {
    function __construct() 
    {
        parent::__construct();
        $this->load->model('m_tran_dak');
	$this->load->helper('url'); // Load Helper URL CI
    }
    
    function index() 
    {
	$this->load->view('transaksi/dak'); //Default di arahkan ke function grid
    }
    
    function lookpegawai()
    {
        $keyword = $this->input->post('term');
        $data['response'] = 'false';
        $query = $this->m_tran_dak->caripegawai($keyword);
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
        $kat_dokter = $this->input->post('kat_dokter');
        $gol_dokter = $this->input->post('gol_dokter');
        $data['response'] = 'false';
        $query = $this->m_tran_dak->caridokterrujukan($keyword,$kat_dokter,$gol_dokter);
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
    
    function lookapotek()
    {
        $keyword = $this->input->post('term');
        $data['response'] = 'false';
        $query = $this->m_tran_dak->cariapotek($keyword);
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
    function lookdiagnosa()
    {
        $keyword = $this->input->post('term');
        $data['response'] = 'false';
        $query = $this->m_tran_dak->caridiagnosa($keyword);
        if( ! empty($query) )
        {
            $data['response'] = 'true';
            $data['message'] = array();
            foreach( $query as $row )
            {
                $data['message'][] = array(
                                        'id'=>  $row['id_diagnosa'],
                                        'value' => $row['nama_diagnosa']
                                     );
            }
        }
        echo json_encode($data);
    }
    
    function lookdosis()
    {
        $keyword = $this->input->post('term');
        $data['response'] = 'false';
        $query = $this->m_tran_dak->caridosis($keyword);
        if( ! empty($query) )
        {
            $data['response'] = 'true';
            $data['message'] = array();
            foreach( $query as $row )
            {
                $data['message'][] = array(
                                        'id'=>  $row['id_dosis'],
                                        'value' => $row['nama_dosis']
                                     );
            }
        }
        echo json_encode($data);
    }
    
    function looktagihan()
    {
        $keyword = $this->input->post('term');
        $id = $this->input->post('id');
        $data['response'] = 'false';
        $query = $this->m_tran_dak->caritagihan($keyword, $id);
        if( ! empty($query) )
        {
            $data['response'] = 'true';
            $data['message'] = array();
            foreach( $query as $row )
            {
                $data['message'][] = array(
                                        'id'=>  $row['id_item'],
                                        'value' => $row['nama_item']
                                     );
            }
        }
        echo json_encode($data);
    }
    
    function lookrekomendasi()
    {
        $keyword = $this->input->post('term');
        $data['response'] = 'false';
        $query = $this->m_tran_dak->carirekomendasi($keyword);
        if( ! empty($query) )
        {
            $data['response'] = 'true';
            $data['message'] = array();
            foreach( $query as $row )
            {
                $data['message'][] = array(
                                        'id'=>  $row['id_rekomendasi'],
                                        'value' => $row['nama_rekomendasi']
                                     );
            }
        }
        echo json_encode($data);
    }
    
    function bagian()
    {
        //$id = "1";
        $id = $this->input->post('id');
        $query = $this->m_tran_dak->get_bagian($id);
        if( ! empty($query) )
        {
            foreach( $query as $row )
            {
                echo $row['nama_bagian'];
            }
        }
    }
    
    function rujukan()
    {
        $query = $this->m_tran_dak->get_rujukan();
        echo"<option value=''>--Pilih Rujukan--</option>";
        if( ! empty($query) )
        {
            foreach( $query as $row )
            {
                echo "<option value=";
                echo $row['id_rujukan'];
                echo ">";
                echo $row['nama_rujukan'];
                echo "</option>";
            }
        }
    }
    
    function kunjungan()
    {
        $query = $this->m_tran_dak->get_kunjungan();
        echo"<option value=''>--Pilih--</option>";
        if( ! empty($query) )
        {
            foreach( $query as $row )
            {
                echo "<option value=";
                echo $row['idjenis_kunjungan'];
                echo ">";
                echo $row['nama_kunjungan'];
                echo "</option>";
            }
        }        
    }
    
    function tagihan()
    {
        $query = $this->m_tran_dak->get_tagihan();
        echo"<option value=''>--Pilih--</option>";
        if( ! empty($query) )
        {
            foreach( $query as $row )
            {
                echo "<option value=";
                echo $row['idjns_item'];
                echo ">";
                echo $row['jenis_item'];
                echo "</option>";
            }
        }           
    }
    
    function pasien()
    {
        $id = $this->input->post('id');
        $query = $this->m_tran_dak->get_pasien($id);
        echo"<option value=''>--Pilih Pasien--</option>";
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
        //$pegawai = $this->input->get('pegawai');
        $pasien = $this->input->get('pasien');
        $rujukan = $this->input->get('rujukan');
        $dokter = $this->input->get('dokter');
        $id_dokter = $this->input->get('id_dokter');
        if ($id_dokter=='undefined')
        {            
            $query = $this->m_tran_dak->get_id_dokter();
            if( ! empty($query) )
            {
                foreach( $query as $row )
                {
                    $id_dok = $row['id_dokter']+1;
                }
                $data=array('id_dokter'=>$id_dok, 'nama_dokter'=>$dokter);
                $this->m_tran_dak->simpan_dokter($data);
                $id_dokter=$id_dok;
            }            
        }        
        //$nip = $this->input->get('nip');
        $tgl_trans = $this->input->get('tgl_trans');
        $no_surat = $this->input->get('no_surat');
        $no_bukti = $this->input->get('no_bukti');
        //$bagian = $this->input->get('bagian');
        $tgl_kun = $this->input->get('tgl_kun');
        
        $kunjungan = $this->input->get('kunjungan');
        $kond_pasien = $this->input->get('kond_pasien');
        $berat_bdn = $this->input->get('berat_bdn');
        $tinggi_bdn = $this->input->get('tinggi_bdn');
        //$bmi = $this->input->get('bmi');
        
        $keterangan = $this->input->get('keterangan');
        $kesadaran = $this->input->get('kesadaran');
        $suhu_bdn = $this->input->get('suhu_bdn');
        $tek_sistole = $this->input->get('tek_sistole');
        $tek_diastole = $this->input->get('tek_diastole');
        
        $anamnesis = $this->input->get('anamnesis');
        $pernafasan = $this->input->get('pernafasan');
        $nadi = $this->input->get('nadi');
        $riwayat_alergi = $this->input->get('riwayat_alergi');
        
        //ambil id transaksi
        $query = $this->m_tran_dak->get_id_transaksi();
        $row = $query->row();
        $id_transaksi=$row->id_transaksi+1;
        
        $data_tran=array('id_transaksi'=>$id_transaksi,'tgl_transaksi'=>$tgl_trans,'tgl_kunjungan'=>$tgl_kun,'id_tertanggung'=>$pasien);
        $query3=$this->m_tran_dak->simpan_transaksi($data_tran);
        if ($query3){
            $data_tran2=array('id_transaksi'=>$id_transaksi,'no_surat'=>$no_surat,'no_bukti'=>$no_bukti,'id_rujukan'=>$rujukan,'id_dokter'=>$id_dokter);
            $query4=$this->m_tran_dak->simpan_transaksi_dak($data_tran2);
            
            $data_tran3=array('id_transaksi'=>$id_transaksi,'kondisi'=>$kond_pasien,'berat'=>$berat_bdn,'tinggi'=>$tinggi_bdn,'kesadaran'=>$kesadaran,'suhu'=>$suhu_bdn,'sistole'=>$tek_sistole,
                                'diastole'=>$tek_diastole,'anamnesis'=>$anamnesis,'pernafasan'=>$pernafasan,'nadi'=>$nadi,'riwayat_alergi'=>$riwayat_alergi,'keterangan'=>$keterangan,'idjenis_kunjungan'=>$kunjungan);
            $query5=$this->m_tran_dak->simpan_transaksi_periksa($data_tran3);
            
            if($query4 && $query5){
                 echo $id_transaksi;
            }
           
        }
    }
    
    function simpandiagnosa()
    {
        $id_diag = $this->input->get('id_diagnosa');
        $diagnosa = $this->input->get('diag');
        $id_kun = $this->input->get('id');
        $id_diagnosa;
        if ($id_diag=='undefined')
        {
            $query = $this->m_tran_dak->get_id_diagnosa();
            if( ! empty($query) )
            {
                $row = $query->row();
                $id=$row->id_diagnosa+1;    
                $data = array('id_diagnosa'=>$id,'nama_diagnosa'=>$diagnosa);
                 $this->m_tran_dak->simpan_diagnosa($data);
                $id_diagnosa=$id;
            }
        } else {
            $id_diagnosa=$id_diag;
        }
        //$data2 = array('id_item'=>null,'id_kunjungan'=>$id_kun,'id_diagnosa'=>$id_diagnosa);
        $data2 = array('id_transaksi'=>$id_kun,'id_diagnosa'=>$id_diagnosa);
        $query2 = $this->m_tran_dak->simpan_item_diagnosa($data2);
        if($query2){
                echo "sukses";
            } else {
                echo "gagal";
            }                                   
    }
    
    function simpanitem()
    {
        $jenis = $this->input->get('jenis_tagihan');
        $kunjungan = $this->input->get('kunjungan');
        $nama = $this->input->get('nama_tagihan');
        $id_item = $this->input->get('id_item');
        if ($id_item=='undefined') {           
            $query = $this->m_tran_gigi->get_id_item();
            if( ! empty($query) )
            {
                $row = $query->row();
                $idi=$row->id_item+1;
                $data=array('id_item'=>$idi,'nama_item'=>$nama,'entri_item'=>'otomatis','idjns_item'=>$jenis);
                $this->m_tran_gigi->simpan_item($data);                
                $id_item=$idi;
            }
        }
        $jumlah = $this->input->get('jumlah');
        
        $racikan = $this->input->get('kandungan');
        $disetujui = $this->input->get('disetujui');
        $dos = $this->input->get('id_dosis');
        $nama_dosis = $this->input->get('dosis');
        $dosis;
        if ($dos=='undefined') {           
            $query = $this->m_tran_dak->get_id_dosis();
            if( ! empty($query) )
            {
                $row = $query->row();
                $id=$row->id_dosis+1;
                $data=array('id_dosis'=>$id,'nama_dosis'=>$nama_dosis);
                $this->m_tran_dak->simpan_dosis($data);                
                $dosis=$id;
            }
        } else {
            $dosis=$dos;
        }
        $rekom = $this->input->get('id_rekomendasi');
        $nm_rekom = $this->input->get('rekomendasi');
        $rekomendasi;
        if ($rekom=='undefined') {           
            $query = $this->m_tran_dak->get_id_rekomendasi();
            if( ! empty($query) )
            {
                $row = $query->row();
                $id = $row->id_rekomendasi+1;
                $data = array('id_rekomendasi'=>$id,'nama_rekomendasi'=>$nm_rekom);
                $this->m_tran_dak->simpan_rekomendasi($data);                
                $rekomendasi = $id;
            }
        } else {
            $rekomendasi=$rekom;
        }

        $data = array('id_item'=>$id_item,'id_dosis'=>$dosis,'id_transaksi'=>$kunjungan);
        $query4 = $this->m_tran_dak->simpan_item_dosis($data);
        if ($query4){
            $datanya=array('id_transaksi'=>$kunjungan,'jumlah'=>$jumlah,'racikan'=>$racikan,'disetujui'=>$disetujui,
                        'id_item'=>$id_item,'id_rekomendasi'=>$rekomendasi);
            $query3=$this->m_tran_dak->simpan_item_transaksi($datanya);
            if ($query3){
                echo "sukses";           
            }else{
                echo "gagal";
            }
        }else{
            echo "gagal";
        }                   
    }       
    
    function json() 
    {
	$page  = $this->input->get('page');
	$limit = $this->input->get('rows');
	$sidx  = $this->input->get('sidx');
	$sord  = $this->input->get('sord');
        $kun   = $this->input->get('idkunj');
	
	if(!$sidx) $sidx=1;		
	
	# Untuk Single Searchingnya #		
	$where = ""; //if there is no search request sent by jqgrid, $where should be empty
	$searchField = isset($_GET['searchField']) ? $_GET['searchField'] : false;
	$searchString = isset($_GET['searchString']) ? $_GET['searchString'] : false;
	if ($_GET['_search'] == 'true') 
	{
            $where = array($searchField => $searchString);
	}
            # End #
			        		
	$count = $this->m_tran_dak->count_diagnosa2($where, $kun);
	
	$count > 0 ? $total_pages = ceil($count/$limit) : $total_pages = 0;
	if ($page > $total_pages) $page=$total_pages;
	$start = $limit*$page - $limit;
	if($start <0) $start = 0;
		
	$data1 = $this->m_tran_dak->get_diagnosa2($where, $sidx, $sord, $limit, $start, $kun)->result();
	$responce->page = $page;
	$responce->total = $total_pages;
	$responce->records = $count;
	$i=0;
	foreach($data1 as $line)
            {
                $responce->rows[$i]['id']   = $line->id_transaksi_diagnosa;
                $responce->rows[$i]['cell'] = array($line->id_transaksi_diagnosa, $line->nama_diagnosa,'');
		$i++;
            }
	echo json_encode($responce);
    }
    
    function crud() 
    {
	$oper=$this->input->post('oper');
	$id=$this->input->post('id');
	    
        switch ($oper) 
	{
            case 'del':
                $this->m_tran_dak->delete_diagnosa($id);
            break;
	}
    }    
    
    function crud2() 
    {
	$oper=$this->input->post('oper');
	$id=$this->input->post('id');
	
        $query = $this->m_tran_dak->get_id_item_lain($id);
        $row = $query->row();
        $id_item = $row->id_item;
        $id_trans = $row->id_transaksi;
        switch ($oper) 
	{
            case 'del':
                $this->m_tran_dak->delete_item_transaksi($id);
                $this->m_tran_dak->delete_dosis($id_item,$id_trans);
            break;
	}
    }
        

function json2() 
    {
	$page  = $this->input->get('page');
	$limit = $this->input->get('rows');
	$sidx  = $this->input->get('sidx');
	$sord  = $this->input->get('sord');
        $kun   = $this->input->get('idkunj');
	
	if(!$sidx) $sidx=1;		
	
	# Untuk Single Searchingnya #		
	$where = ""; //if there is no search request sent by jqgrid, $where should be empty
	$searchField = isset($_GET['searchField']) ? $_GET['searchField'] : false;
	$searchString = isset($_GET['searchString']) ? $_GET['searchString'] : false;
	if ($_GET['_search'] == 'true') 
	{
            $where = array($searchField => $searchString);
	}
			        		
	$count = $this->m_tran_dak->count_transaksi($where, $kun);
	
	$count > 0 ? $total_pages = ceil($count/$limit) : $total_pages = 0;
	if ($page > $total_pages) $page=$total_pages;
	$start = $limit*$page - $limit;
	if($start <0) $start = 0;
		
	$data1 = $this->m_tran_dak->get_transaksi($where, $sidx, $sord, $limit, $start, $kun)->result();
	$responce->page = $page;
	$responce->total = $total_pages;
	$responce->records = $count;

	$i=0;
	foreach($data1 as $line)
            {
                $setuju=$line->disetujui;
                if ($setuju=="y") {
                    $setuj="Ya";
                } else {
                    $setuj="Tidak";
                }
                $responce->rows[$i]['id']   = $line->id_item_transaksi_dak;
                $responce->rows[$i]['cell'] = array($line->id_item_transaksi_dak,
                    '',
                    $line->jenis_item,
                    $line->nama_item,
                    $line->jumlah,
                    $line->racikan,
                    $setuj,
                    $line->nama_dosis,
                    $line->nama_rekomendasi);
		$i++;
            }
	echo json_encode($responce);
    }
}