<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Apotek extends CI_Controller {
   // $kun="";
    function __construct() 
    {
        parent::__construct();
        $this->load->model('m_tran_apotek');
	$this->load->helper('url'); // Load Helper URL CI
        //$this->load->helper('form');
    }
    
    function index() 
    {
	$this->load->view('transaksi/apotek'); //Default di arahkan ke function grid
    }
    
    function lookpegawai()
    {
        $keyword = $this->input->post('term');
        $data['response'] = 'false';
        $query = $this->m_tran_apotek->caripegawai($keyword);
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
                                       // 'nama_bagian' => $row['nama_bagian']
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
        $query = $this->m_tran_apotek->caridokterrujukan($keyword,$kat_dokter,$gol_dokter);
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

    function looktagihan()
    {
       $keyword = $this->input->post('term');
        $id = $this->input->post('id');
        //$keyword="o";
        //$id="1";
        $data['response'] = 'false';
        $query = $this->m_tran_apotek->caritagihan($keyword, $id);
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

    
    
    function lookapotek()
    {
        $keyword = $this->input->post('term');
        $data['response'] = 'false';
        $query = $this->m_tran_apotek->cariapotek($keyword);
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
        $query = $this->m_tran_apotek->caridiagnosa($keyword);
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
        $query = $this->m_tran_apotek->caridosis($keyword);
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
    
    function lookrekomendasi()
    {
        $keyword = $this->input->post('term');
        $data['response'] = 'false';
        $query = $this->m_tran_apotek->carirekomendasi($keyword);
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
        $query = $this->m_tran_apotek->get_bagian($id);
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
        $query = $this->m_tran_apotek->get_rujukan();
        echo"<option>--Pilih Rujukan--</option>";
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
    
    function pasien()
    {
        $id = $this->input->post('id');
        $query = $this->m_tran_apotek->get_pasien($id);
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
    
    function tagihan()
    {
        $query = $this->m_tran_apotek->get_tagihan();
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

    function simpan()
    {
        $pasien = $this->input->get('pasien');
        $rujukan = $this->input->get('rujukan');
        $dokter = $this->input->get('dokter');
        $id_dokter = $this->input->get('id_dokter');
        if ($id_dokter=='undefined')
        {
            $query = $this->m_tran_apotek->get_id_dokter();
            if( ! empty($query) )
            {
                foreach( $query as $row )
                {
                    $id_dok = $row['id_dokter']+1;
                }
                $data=array('id_dokter'=>$id_dok, 'nama_dokter'=>$dokter);
                $this->m_tran_apotek->simpan_dokter($data);
                $id_dokter=$id_dok;
            }
        }
        $apotek = $this->input->get('apotek');
        $id_apotek = $this->input->get('id_apotek');

        if ($id_apotek=='undefined') {

            $query = $this->m_tran_apotek->get_id_apotek();
            if( ! empty($query) )
            {
                foreach( $query as $row )
                {
                    $id_ap=$row['id_provider']+1;
                }
                $data=array('id_provider'=>$id_ap,'nama_provider'=>$apotek,'idjenis_provider'=>'1');
                $this->m_tran_apotek->simpan_apotek($data);
                $id_apotek=$id_ap;
            }
        }
        $tgl_trans = $this->input->get('tgl_trans');
        $no_surat = $this->input->get('no_surat');
        $no_bukti = $this->input->get('no_bukti');
        $no_dak = $this->input->get('no_dak');
        $tgl_kun = $this->input->get('tgl_kun');
        $buku_besar = $this->input->get('buku_besar');
        $restitusi = $this->input->get('restitusi');

        $query_id_kun = $this->m_tran_apotek->get_id_kunjungan();
        if( ! empty($query_id_kun) )
        {
            foreach( $query_id_kun as $row )
            {
                $id_trans=$row['id_transaksi']+1;
            }
        }
        $datanya = array('id_transaksi'=>$id_trans,'id_tertanggung'=>$pasien,'tgl_transaksi'=>$tgl_trans,'tgl_kunjungan'=>$tgl_kun);
        $query2 = $this->m_tran_apotek->simpan_transaksi($datanya);
       if ($query2)
           {
           $dataitem =  array('id_transaksi'=>$id_trans,'id_rujukan'=>$rujukan,'id_dokter'=>$id_dokter,'id_provider'=>$id_apotek,'no_surat'=>$no_surat,'no_bukti'=>$no_bukti,'no_dak'=>$no_dak,'restitusi'=>$restitusi);
        $query3 = $this->m_tran_apotek->simpan_data_transaksi($dataitem);

        $databuku=array('id_transaksi'=>$id_trans,'buku_besar'=>$buku_besar);
        $query4 = $this->m_tran_apotek->simpan_transaksi_buku($databuku);
            if ($query3 && $query4){
                echo $id_trans;
            }else{
                echo 'gagal';
            }
       }else{
           echo 'gagal';
       }
        
        //$query3=$this->m_tran_apotek->simpan_transaksi($datanya);
    }

    function simpandata()
    {
        $pegawai = $this->input->get('pegawai');
        $pasien = $this->input->get('pasien');
        $rujukan = $this->input->get('rujukan');
        $dokter = $this->input->get('dokter');
        $id_dokter = $this->input->get('id_dokter');
        if ($id_dokter=='undefined')
        {            
            $query = $this->m_tran_apotek->get_id_dokter();
            if( ! empty($query) )
            {
                foreach( $query as $row )
                {
                    $id_dok = $row['id_dokter']+1;
                }
                $data=array('id_dokter'=>$id_dok, 'nama_dokter'=>$dokter);
                $this->m_tran_apotek->simpan_dokter($data);
                $id_dokter=$id_dok;
            }            
        }
        $apotek = $this->input->get('apotek');
        $id_apotek = $this->input->get('id_apotek');
       
        if ($id_apotek=='undefined') {
            
            $query = $this->m_tran_apotek->get_id_apotek();
            if( ! empty($query) )
            {
                foreach( $query as $row )
                {
                    $id_ap=$row['id_provider']+1;
                }
                $data=array('id_provider'=>$id_ap,'nama_provider'=>$apotek,'idjenis_provider'=>'1');
                $this->m_tran_apotek->simpan_apotek($data);
                $id_apotek=$id_ap;
            }            
        }
        $tgl_trans = $this->input->get('tgl_trans');
        $no_surat = $this->input->get('no_surat');
        $no_bukti = $this->input->get('no_bukti');
        $no_dak = $this->input->get('no_dak');
        //$bagian = $this->input->get('bagian');
        $tgl_kun = $this->input->get('tgl_kun');
        $buku_besar = $this->input->get('buku_besar');
        $restitusi = $this->input->get('restitusi');
        
        $query_id_kun = $this->m_tran_apotek->get_id_kunjungan();
        if( ! empty($query_id_kun) )
        {
            foreach( $query_id_kun as $row )
            {
                $id_trans=$row['id_transaksi']+1;
            }
        }
       
        /*$datanya=array('id_transaksi'=>$id_kun,'id_jenis'=>'1','nip'=>$nip,'id_tertanggung'=>$pasien,'id_rujukan'=>$rujukan,'id_dokter'=>$id_dokter,'id_apotek'=>$id_apotek,'tgl_trans'=>$tgl_trans,
                        'no_surat'=>$no_surat,'no_bukti'=>$no_bukti,'no_dak'=>$no_dak,'tgl_kun'=>$tgl_kun,'buku_besar'=>$buku_besar,'restitusi'=>$restitusi);
        */
        //$query3=$this->m_tran_apotek->simpan_transaksi($datanya);
        $datanya=array('');
        if ($query3)
        {
            echo $id_kun;
        }
    }
    
    function simpandiagnosa()
    {
        $diagnosa = $this->input->get('diag');
        $id_kun = $this->input->get('id');
        $id_diag = $this->input->get('id_diag');
        $id_trans = $this->input->get('id_tran');

        if($id_diag=='undefined')
        {
            $data_diagnosa=array('id_diagnosa'=>'','nama_diagnosa'=>$diagnosa,'jenis_penyakit'=>'non_degeneratif','kelompok_penyakit'=>'penyakit');
            $this->m_tran_apotek->simpan_diagnosa($data);
            $id_diag=$this->m_tran_apotek->get_max_id_diagnosa();
        }

        //$query = $this->m_tran_apotek->get_id_diagnosa($diagnosa);

        $data = array('id_transaksi'=>'','id_diagnosa'=>$id_diag);
        //mengecek diagnosa sdh ada apa g' di db
        
            //$query = $this->m_tran_apotek->get_id_diagnosa($diagnosa);
            //$row = $query->row();
            //$id = $row->id_diagnosa;
            $data2 = array('id_transaksi'=>$id_kun,'id_diagnosa'=>$id_diag);
            if (!empty($id_kun))
            {
            $query2 = $this->m_tran_apotek->simpan_item_diagnosa($data2);
                if($query2){
                    echo "sukses";
                } else {
                    echo "gagal";
                }    
            }                                    
    }
    
    function simpanitem()
    {
        $jenis = $this->input->get('jenis_tagihan');
        $kunjungan = $this->input->get('kunjungan');
        $nama = $this->input->get('nama_tagihan');
        $hrg_std = $this->input->get('harga_standart');
        $id_item = $this->input->get('id_item');
        if ($id_item=='undefined') {           
            $query = $this->m_tran_apotek->get_id_item();
            if( ! empty($query) )
            {
                $row = $query->row();
                $idi=$row->id_item+1;
                $data=array('id_item'=>$idi,'nama_item'=>$nama,'harga_item'=>$hrg_std,'entri_item'=>'otomatis','idjns_item'=>$jenis);
                $this->m_tran_apotek->simpan_item($data);                
                $id_item=$idi;
            }
        }
        $hrg_sta = $this->input->get('harga_satuan');
        $jumlah = $this->input->get('jumlah');
        //$total = $this->input->get('total');
        //$selisih = $this->input->get('selisih');
        $racikan = $this->input->get('racikan');
        $disetujui = $this->input->get('disetujui');
        $dos = $this->input->get('id_dosis');
        $nama_dosis = $this->input->get('dosis');
        $dosis;
        if ($dos=='undefined') {           
            $query = $this->m_tran_apotek->get_id_dosis();
            if( ! empty($query) )
            {
                $row = $query->row();
                $id=$row->id_dosis+1;
                $data=array('id_dosis'=>$id,'nama_dosis'=>$nama_dosis);
                $this->m_tran_apotek->simpan_dosis($data);                
                $dosis=$id;
            }
        } else {
            $dosis=$dos;
        }
        $rekom = $this->input->get('id_rekomendasi');
        $nm_rekom = $this->input->get('rekomendasi');
        $rekomendasi;
        if ($rekom=='undefined') {           
            $query = $this->m_tran_apotek->get_id_rekomendasi();
            if( ! empty($query) )
            {
                $row = $query->row();
                $id = $row->id_rekomendasi+1;
                $data = array('id_rekomendasi'=>$id,'nama_rekomendasi'=>$nm_rekom);
                $this->m_tran_apotek->simpan_rekomendasi($data);                
                $rekomendasi = $id;
            }
        } else {
            $rekomendasi=$rekom;
        }
        
        $data = array('id_item'=>$id_item,'id_dosis'=>$dosis,'id_transaksi'=>$kunjungan);
        $query4 = $this->m_tran_apotek->simpan_item_dosis($data);
        if ($query4){
            $datanya=array('id_transaksi'=>$kunjungan,'disetujui'=>$disetujui,'hrg_satuan'=>$hrg_sta,'jumlah'=>$jumlah,'racikan'=>$racikan,
                        'id_item'=>$id_item,'id_rekomendasi'=>$rekomendasi);
            $query3=$this->m_tran_apotek->simpan_item_transaksi($datanya);
            if ($query3){
                echo "sukses";
            }else{
                echo "gagal";
            }           
        }else{
            echo "gagal";
        }
    }
    
    function diagnosa()
    {
        $id = $this->input->get('id');
        $query = $this->m_tran_apotek->get_diagnosa($id);
        echo "<table border='1'>";
        echo "<tr><td>No</td><td>Diagnosa</td><td>Action</td></tr>";
        if( ! empty($query) )
        {
            $no=1;
            foreach( $query as $row )
            {
                echo "<input type='hidden' name='id_kunjungan' id='id_kunjungan' value='".$row['id_item']."'>";
                echo "<tr><td>".$no."</td>";
                
                echo "<td>".$row['nama_diagnosa']."</td>";
                echo "<td><a href='' id='ok' class='bro' onClick='coba()' >del</a></td></tr>";
                $no++;
            }
        } else {
            echo "kosong";
        }
        echo "</table>";
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
			        		
	$count = $this->m_tran_apotek->count_diagnosa2($where, $kun);
	
	$count > 0 ? $total_pages = ceil($count/$limit) : $total_pages = 0;
	if ($page > $total_pages) $page=$total_pages;
	$start = $limit*$page - $limit;
	if($start <0) $start = 0;
		
	$data1 = $this->m_tran_apotek->get_diagnosa2($where, $sidx, $sord, $limit, $start, $kun)->result();
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

    function json_diagnosa()
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

	$count = $this->m_tran_apotek->count_diagnosa2($where, $kun);

	$count > 0 ? $total_pages = ceil($count/$limit) : $total_pages = 0;
	if ($page > $total_pages) $page=$total_pages;
	$start = $limit*$page - $limit;
	if($start <0) $start = 0;

	$data1 = $this->m_tran_apotek->get_diagnosa2($where, $sidx, $sord, $limit, $start, $kun)->result();
	$responce->page = $page;
	$responce->total = $total_pages;
	$responce->records = $count;
	$i=0;
	foreach($data1 as $line)
            {
                $id=$line->id_diagnosa;
                $datadiag = $this->m_tran_apotek->nama_diagnosa21($id);
                $row = $datadiag->row();
		$responce->rows[$i]['id']   = $line->id_item;
		$responce->rows[$i]['cell'] = array($line->id_item,$row->nama_diagnosa, '');
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
                $this->m_tran_apotek->delete_diagnosa($id);
            break;
	}
    }    
    
    function crud2() 
    {
	$oper=$this->input->post('oper');
	$id=$this->input->post('id');
	
        $query = $this->m_tran_apotek->get_id_item_apotek($id);
        $row = $query->row();
        $id_item = $row->id_item;
        $id_trans = $row->id_transaksi;
        
        switch ($oper) 
	{
            case 'del':
                $this->m_tran_apotek->delete_item_transaksi($id);
                $this->m_tran_apotek->delete_dosis($id_item,$id_trans);
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
			        		
	$count = $this->m_tran_apotek->count_transaksi($where, $kun);
	
	$count > 0 ? $total_pages = ceil($count/$limit) : $total_pages = 0;
	if ($page > $total_pages) $page=$total_pages;
	$start = $limit*$page - $limit;
	if($start <0) $start = 0;
		
	$data1 = $this->m_tran_apotek->get_transaksi($where, $sidx, $sord, $limit, $start, $kun)->result();
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
                $responce->rows[$i]['id']   = $line->id_item_transaksi_apotek;
                $responce->rows[$i]['cell'] = array($line->id_item_transaksi_apotek,
                    '',
                    $line->jenis_item,
                    $line->nama_item,
                    $line->harga_item,
                    $line->hrg_satuan,                    
                    $line->jumlah,
                    $line->total,
                    $line->selisih,
                    $line->racikan,
                    $setuj,
                    $line->nama_dosis,
                    $line->nama_rekomendasi);
		$i++;
            }
	echo json_encode($responce);
    }

}