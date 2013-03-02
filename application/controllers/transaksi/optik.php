<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Optik extends CI_Controller {
    function __construct() 
    {
        parent::__construct();
        $this->load->model('m_tran_optik');
	$this->load->helper('url'); // Load Helper URL CI
    }
    
    function index() 
    {
	$this->load->view('transaksi/optik'); //Default di arahkan ke function grid
    }
    
    function lookpegawai()
    {
        $keyword = $this->input->post('term');
        $data['response'] = 'false';
        $query = $this->m_tran_optik->caripegawai($keyword);
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
        $query = $this->m_tran_optik->caridokter($keyword);
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
        $query = $this->m_tran_optik->cariapotek($keyword);
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
    
    function lookprovider()
    {
        $keyword = $this->input->post('term');
        $data['response'] = 'false';
        $query = $this->m_tran_optik->cariprovider($keyword);
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
        $query = $this->m_tran_optik->caridiagnosa($keyword);
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
    
     function looktagihan()
    {
        $keyword = $this->input->post('term');
        $id = $this->input->post('id');
        $data['response'] = 'false';
        $query = $this->m_tran_optik->caritagihan($keyword, $id);
        if( ! empty($query) )
        {
            $data['response'] = 'true';
            $data['message'] = array();
            foreach( $query as $row )
            {
                $data['message'][] = array(
                                        'id'=>  $row['id_item'],
                                        'value' => $row['nama_item'],
                                        'harga' => $row['harga_item']
                                       // 'nama_bagian' => $row['nama_bagian']
                                     );
            }
        }
        echo json_encode($data);
    }
    
    function lookrekomendasi()
    {
        $keyword = $this->input->post('term');
        $data['response'] = 'false';
        $query = $this->m_tran_optik->carirekomendasi($keyword);
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
        $query = $this->m_tran_optik->get_bagian($id);
        if( ! empty($query) )
        {
            foreach( $query as $row )
            {
                echo $row['nama_bagian'];
            }
        }
    }
    
    function tagihan()
    {
        $query = $this->m_tran_optik->get_tagihan();
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
        $query = $this->m_tran_optik->get_pasien($id);
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
        $dokter = $this->input->get('dokter');
        $id_dokter = $this->input->get('id_dokter');
        if ($id_dokter=='undefined')
        {            
            $query = $this->m_tran_optik->get_id_dokter();
            if( ! empty($query) )
            {
                foreach( $query as $row )
                {
                    $id_dok = $row['id_dokter']+1;
                }
                $data=array('id_dokter'=>$id_dok, 'nama_dokter'=>$dokter);
                $this->m_tran_optik->simpan_dokter($data);
                $id_dokter=$id_dok;
            }            
        }        
        $provider = $this->input->get('provider');
        $id_provider = $this->input->get('id_provider');
        if ($id_provider=='undefined') {
            
            $query = $this->m_tran_optik->get_id_provider();
            if( ! empty($query) )
            {
                foreach( $query as $row )
                {
                    $id_ap=$row['id_provider']+1;
                }
                $data=array('id_provider'=>$id_ap,'nama_provider'=>$apotek);
                $this->m_tran_optik->simpan_provider($data);
                $id_provider=$id_ap;
            }            
        }
        
        $nip = $this->input->get('nip');
        $tgl_trans = $this->input->get('tgl_trans');
        $no_surat = $this->input->get('no_surat');
        $no_bukti = $this->input->get('no_bukti');
        
        $bagian = $this->input->get('bagian');
        $tgl_kun = $this->input->get('tgl_kun');
        $buku_besar = $this->input->get('buku_besar');
        $restitusi = $this->input->get('restitusi');                
        /*
        $query_id_kun = $this->m_tran_optik->get_id_kunjungan();
        if( ! empty($query_id_kun) )
        {
            foreach( $query_id_kun as $row )
            {
                $id_kun=$row['id_kunjungan']+1;
            }
        }
         * 
         */
        $query = $this->m_tran_optik->get_id_transaksi();
        $row = $query->row();
        $id_transaksi=$row->id_transaksi+1;

        $data_tran=array('id_transaksi'=>$id_transaksi,'tgl_transaksi'=>$tgl_trans,'tgl_kunjungan'=>$tgl_kun,'id_tertanggung'=>$pasien);
        $query3=$this->m_tran_optik->simpan_transaksi($data_tran);
        if ($query3){
            $data_tran2=array('id_transaksi'=>$id_transaksi,'no_surat'=>$no_surat,'no_bukti'=>$no_bukti,'restitusi'=>$restitusi,'id_dokter'=>$id_dokter,'id_provider'=>$id_provider);
            $query4=$this->m_tran_optik->simpan_transaksi_optik($data_tran2);
            
            $data_tran3=array('id_transaksi'=>$id_transaksi,'buku_besar'=>$buku_besar);
            $query5=$this->m_tran_optik->simpan_transaksi_buku($data_tran3);
            
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
            $query = $this->m_tran_optik->get_id_diagnosa();
            if( ! empty($query) )
            {
                $row = $query->row();
                $id=$row->id_diagnosa+1;    
                $data = array('id_diagnosa'=>$id,'nama_diagnosa'=>$diagnosa);
                 $this->m_tran_optik->simpan_diagnosa($data);
                $id_diagnosa=$id;
            }
        } else {
            $id_diagnosa=$id_diag;
        }
        //$data2 = array('id_item'=>'','id_kunjungan'=>$id_kun,'id_diagnosa'=>$id_diagnosa);
        $data2 = array('id_transaksi'=>$id_kun,'id_diagnosa'=>$id_diagnosa);
        $query2 = $this->m_tran_optik->simpan_item_diagnosa($data2);
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
        $harga_standart = $this->input->get('harga_standart');
        $id_item = $this->input->get('id_item');
        if ($id_item=='undefined') {           
            $query = $this->m_tran_optik->get_id_item();
            if( ! empty($query) )
            {
                $row = $query->row();
                $idi=$row->id_item+1;
                $data=array('id_item'=>$idi,'nama_item'=>$nama,'harga_item'=>$harga_standart,'entri_item'=>'otomatis','idjns_item'=>$jenis);
                $this->m_tran_optik->simpan_item($data);                
                $id_item=$idi;
            }
        }
        
        $harga_satuan = $this->input->get('harga_satuan');
        $jumlah = $this->input->get('jumlah');
        //$total = $this->input->get('total');
        //$selisih = $this->input->get('selisih');
        //$racikan = $this->input->get('kandungan');
        $disetujui = $this->input->get('disetujui');
        
        $rekom = $this->input->get('id_rekomendasi');
        $nm_rekom = $this->input->get('rekomendasi');
        $rekomendasi;
        if ($rekom=='undefined') {           
            $query = $this->m_tran_optik->get_id_rekomendasi();
            if( ! empty($query) )
            {
                $row = $query->row();
                $id = $row->id_rekomendasi+1;
                $data = array('id_rekomendasi'=>$id,'nama_rekomendasi'=>$nm_rekom);
                $this->m_tran_optik->simpan_rekomendasi($data);                
                $rekomendasi = $id;
            }
        } else {
            $rekomendasi=$rekom;
        }
        /*
        $query = $this->m_tran_optik->get_id_harga();
        $id_harga;
        if( ! empty($query) )
        {
            $row = $query->row();
            $id = $row->id_harga+1;

            $data = array('id_harga'=>$id,'harga_standart'=>$harga_standart,'harga_satuan'=>$harga_satuan);
            $query2 = $this->m_tran_optik->simpan_harga($data);                
            if (!empty ($query2))
            {
                $id_harga = $id;
                $datanya=array('id_transaksi'=>'','id_kunjungan'=>$kunjungan,'id_jenis'=>$jenis,'nama_transaksi'=>$nama,'id_harga'=>$id_harga,'jumlah'=>$jumlah,'total'=>$total,'selisih'=>$selisih,
                        'racikan'=>$racikan,'disetujui'=>$disetujui,'id_dosis'=>'','id_rekomendasi'=>$rekomendasi);
                $query3=$this->m_tran_optik->simpan_transaksi($datanya);
                if ($query3){
                    echo "sukses";
                }
            }            
        }  
         * 
         */      
        $datanya=array('id_transaksi'=>$kunjungan,'hrg_satuan'=>$harga_satuan,'jumlah'=>$jumlah,'disetujui'=>$disetujui,
                        'id_item'=>$id_item,'id_rekomendasi'=>$rekomendasi);
        $query3=$this->m_tran_optik->simpan_item_transaksi($datanya);
        if ($query3){
            echo "sukses";           
        }else{
            echo "gagal";
        }
    } 
    
    function simpanperiksa()
    {
        $id_transaksi = $this->input->get('kunjungan');        
        $id_tertanggung = $this->input->get('id_tertanggung');        
        $spher1 = $this->input->get('spher1');
        $spher2 = $this->input->get('spher2'); 
        $cylinder1 = $this->input->get('cylinder1');
        $cylinder2 = $this->input->get('cylinder2');
        $axis1 = $this->input->get('axis1');
        $axis2 = $this->input->get('axis2');
        $prisma1 = $this->input->get('prisma1');
        $prisma2 = $this->input->get('prisma2');
        $basis1 = $this->input->get('basis1');
        $basis2 = $this->input->get('basis2');
        $pupil_distance1 = $this->input->get('pupil_distance1');
        $pupil_distance2 = $this->input->get('pupil_distance2');
        $jenis_periksa = $this->input->get('jenis_periksa');
                
        $data = array('cylinder'=>$cylinder1.'|'.$cylinder2,'axis'=>$axis1.'|'.$axis2
                ,'prisma'=>$prisma1.'|'.$prisma2,'basis'=>$basis1.'|'.$basis2
                ,'pupil_distance'=>$pupil_distance1.'|'.$pupil_distance2,'jenis_periksa'=>$jenis_periksa,'spher'=>$spher1.'|'.$spher2,'id_transaksi'=>$id_transaksi,'id_tertanggung'=>$id_tertanggung);
        $query = $this->m_tran_optik->simpan_periksa_optik($data);
        if($query){
                echo "sukses";
            } else {
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
			        		
	$count = $this->m_tran_optik->count_diagnosa2($where, $kun);
	
	$count > 0 ? $total_pages = ceil($count/$limit) : $total_pages = 0;
	if ($page > $total_pages) $page=$total_pages;
	$start = $limit*$page - $limit;
	if($start <0) $start = 0;
		
	$data1 = $this->m_tran_optik->get_diagnosa2($where, $sidx, $sord, $limit, $start, $kun)->result();
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
                $this->m_tran_optik->delete_diagnosa($id);
            break;
	}
    }    
    
    function crud2() 
    {
	$oper=$this->input->post('oper');
	$id=$this->input->post('id');
	    
        switch ($oper) 
	{
            case 'del':
                $this->m_tran_optik->delete_transaksi($id);
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
			        		
	$count = $this->m_tran_optik->count_transaksi($where, $kun);
	
	$count > 0 ? $total_pages = ceil($count/$limit) : $total_pages = 0;
	if ($page > $total_pages) $page=$total_pages;
	$start = $limit*$page - $limit;
	if($start <0) $start = 0;
		
	$data1 = $this->m_tran_optik->get_transaksi($where, $sidx, $sord, $limit, $start, $kun)->result();
	$responce->page = $page;
	$responce->total = $total_pages;
	$responce->records = $count;

	$i=0;
	foreach($data1 as $line)
            {
            /*
                $jenis = $this->m_tran_optik->nama_jenis($line->id_jenis);
                $row_jenis = $jenis->row();                
                
                $harga = $this->m_tran_optik->nama_harga($line->id_harga);
                $row_harga = $harga->row();
                
                $rekom = $this->m_tran_optik->nama_rekom($line->id_rekomendasi);
                $row_rekom = $rekom->row();
		*/
                $setuju=$line->disetujui;
                if ($setuju=="y") {
                    $setuj="Ya";
                } else {
                    $setuj="Tidak";
                }
                $responce->rows[$i]['id']   = $line->id_item_transaksi_optik;
                $responce->rows[$i]['cell'] = array($line->id_item_transaksi_optik,
                    '',
                    $line->jenis_item,
                    $line->nama_item,
                    $line->harga_item,
                    $line->hrg_satuan,                    
                    $line->jumlah,
                    $line->total,
                    $line->selisih,
                    $setuj,
                    $line->nama_rekomendasi);
		$i++;
            }
	echo json_encode($responce);
    }
    function crud3() 
    {
	$oper=$this->input->post('oper');
	$id=$this->input->post('id');
	    
        switch ($oper) 
	{
            case 'del':
                $this->m_tran_optik->delete_periksa($id);
            break;
	}
    }
        
    function json3() 
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
			        		
	$count = $this->m_tran_optik->count_periksa($where, $kun);
	
	$count > 0 ? $total_pages = ceil($count/$limit) : $total_pages = 0;
	if ($page > $total_pages) $page=$total_pages;
	$start = $limit*$page - $limit;
	if($start <0) $start = 0;
		
	$data1 = $this->m_tran_optik->get_periksa($where, $sidx, $sord, $limit, $start, $kun)->result();
	$responce->page = $page;
	$responce->total = $total_pages;
	$responce->records = $count;

	$i=0;
	foreach($data1 as $line)
            {
                $responce->rows[$i]['id']   = $line->id_periksa_optik;
                $responce->rows[$i]['cell'] = array($line->id_periksa_optik,
                    '',
                    $line->spher,
                    $line->cylinder,
                    $line->axis,
                    $line->prisma,
                    $line->basis,
                    $line->pupil_distance,
                    $line->jenis_periksa);
		$i++;
            }
	echo json_encode($responce);
    }
}