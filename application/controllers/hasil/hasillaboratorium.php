<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hasillaboratorium extends CI_Controller {
   // $kun="";
    function __construct() 
    {
        parent::__construct();
        $this->load->model(array('m_view_hasillab','m_hasil_transaksi','m_karyawan','m_tran_lab','m_tertanggung','m_transaksi','m_dokter','m_lab'));
		$this->load->helper('url'); // Load Helper URL CI
        $this->load->library(array('excel'));
        //$this->load->helper('form');
    }
    
    function index() 
    {
	$this->load->view('hasil/hasillaboratorium'); //Default di arahkan ke function grid
    //echo "Semangat";
	}
    
    function json() 
	{	$jt = $this->input->get('jns_tanggal');
                if($jt == 'k')
                {
                    $jns_tanggal="tgl_kunjungan";
                }
                else
                {
                    $jns_tanggal="tgl_transaksi";
                }
		$tgl1 = $this->input->get('tgl1');
                $tgl2 = $this->input->get('tgl2');
                $bulan = $this->input->get('bulan');
                $tahun = $this->input->get('tahun');

		$page  = $this->input->get('page');
		$limit = $this->input->get('rows');
		$sidx  = $this->input->get('sidx');
		$sord  = $this->input->get('sord');
		$rayon=$this->session->userdata('id_rayon');
                //$rayon=10;

                $wilayah=$this->session->userdata('id_wilayah');
                $mitra=$this->session->userdata('id_mitra');

		if(!$sidx) $sidx=1;
		
	
		# Untuk Single Searchingnya #		
		$where = ""; //if there is no search request sent by jqgrid, $where should be empty
		$searchField = isset($_GET['searchField']) ? $_GET['searchField'] : false;
		$searchString = isset($_GET['searchString']) ? $_GET['searchString'] : false;
		/*if ($_GET['_search'] == 'true')
		{
			$where = array($searchField => $searchString);
		}*/
		# End #



		$count = $this->m_hasil_transaksi->count_Lab($searchField,$searchString,$rayon,$wilayah,$mitra,$bulan,$tahun,$tgl1,$tgl2,$jns_tanggal);

		$count > 0 ? $total_pages = ceil($count/$limit) : $total_pages = 0;
		if ($page > $total_pages) $page=$total_pages;
		$start = $limit*$page - $limit;
		if($start <0) $start = 0;
		
		$data1 = $this->m_hasil_transaksi->get_Lab($searchField,$searchString, $sidx, $sord, $limit, $start,$rayon,$wilayah,$mitra,$bulan,$tahun,$tgl1,$tgl2,$jns_tanggal)->result();

		$responce->page = $page;
		$responce->total = $total_pages;
		$responce->records = $count;
		$i=0;
                $id_transaksi=null;
                $diagnosa=null;
		foreach($data1 as $line)
		{
                if($line->id_transaksi == $id_transaksi)
                 {
                    $diagnosa =$diagnosa.",".$line->nama_diagnosa;
                    $i=$i-1;
                 }
                else
                 {
                    $id_transaksi = $line->id_transaksi;
                    $diagnosa=$line->nama_diagnosa;
                 }
                    $responce->rows[$i]['id_transaksi']   = $line->id_transaksi;
                    $responce->rows[$i]['cell'] = array($line->id_transaksi,$line->tgl_transaksi,$line->tgl_kunjungan,$line->no_surat,$line->no_bukti,$line->buku_besar,$line->restitusi,$line->nip,$line->nama_karyawan,$line->nama_tertanggung,$line->nama_dokter,$line->nama_provider,$diagnosa);

			$i++;
		}
		echo json_encode($responce);
	}

        function crud()
	{
		$oper=$this->input->post('oper');
		$id_transaksi=$this->input->post('id');




	    switch ($oper)
		{
	        case 'del':
	            $this->m_transaksi->delete_transaksi($id_transaksi);
	        break;
		}
	}

        function ekspor()
	{

	error_reporting(E_ALL);

	date_default_timezone_set('Europe/London');

	// Add some data
                $jt = $this->input->get('jns_tanggal');
                if($jt == 'k')
                {
                    $jns_tanggal="tgl_kunjungan";
                }
                else
                {
                    $jns_tanggal="tgl_transaksi";
                }
                $tgl1 = $this->input->get('tgl1');
                $tgl2 = $this->input->get('tgl2');
                $bulan = $this->input->get('bulan');
                $tahun = $this->input->get('tahun');

		$page  = $this->input->get('page');
		$limit = $this->input->get('rows');
		$sidx  = $this->input->get('sidx');
		$sord  = $this->input->get('sord');
		$rayon=$this->session->userdata('id_rayon');
                //$rayon=10;

                $wilayah=$this->session->userdata('id_wilayah');
                $mitra=$this->session->userdata('id_mitra');

		if(!$sidx) $sidx=1;


		# Untuk Single Searchingnya #
		$where = ""; //if there is no search request sent by jqgrid, $where should be empty
		$searchField = isset($_GET['searchField']) ? $_GET['searchField'] : false;
		$searchString = isset($_GET['searchString']) ? $_GET['searchString'] : false;
		/*if ($_GET['_search'] == 'true')
		{
			$where = array($searchField => $searchString);
		}*/
		# End #



		$count = $this->m_hasil_transaksi->count_Lab($searchField,$searchString,$rayon,$wilayah,$mitra,$bulan,$tahun,$tgl1,$tgl2,$jns_tanggal);

		$count > 0 ? $total_pages = ceil($count/$limit) : $total_pages = 0;
		if ($page > $total_pages) $page=$total_pages;
		$start = $limit*$page - $limit;
		if($start <0) $start = 0;

		$data1 = $this->m_hasil_transaksi->get_Lab($searchField,$searchString, $sidx, $sord, $limit, $start,$rayon,$wilayah,$mitra,$bulan,$tahun,$tgl1,$tgl2,$jns_tanggal)->result();
                $tulis=$this->excel->setActiveSheetIndex(0);

                        $tulis->setCellValue('A1', 'NO');
                        $tulis->setCellValue('B1', "ID TRANSAKSI");
                        $tulis->setCellValue('C1', "TGL TRANSAKSI");
                        $tulis->setCellValue('D1', "TGL KUNJUNGAN");
                        $tulis->setCellValue('E1', "SURAT");
                        $tulis->setCellValue('F1', "BUKTI");
                        $tulis->setCellValue('G1', 'BUKU BESAR');
                        $tulis->setCellValue('H1', "RESTITUSI");
                        $tulis->setCellValue('I1', "NIP");
                        $tulis->setCellValue('J1', "PENANGGUNG");
                        $tulis->setCellValue('K1', "PASIEN");
                        $tulis->setCellValue('L1', "DOKTER");
                        $tulis->setCellValue('M1', "PROVIDER");
                        $tulis->setCellValue('N1', "DIAGNOSA");


        $i=2;
        foreach($data1 as $line)
		{
			$tulis->setCellValue('A'.$i, $i-1);
                        $tulis->setCellValue('B'.$i, $line->id_transaksi);
                        $tulis->setCellValue('C'.$i, $line->tgl_transaksi);
                        $tulis->setCellValue('D'.$i, $line->tgl_kunjungan);
                        $tulis->setCellValue('E'.$i, $line->no_surat);
                        $tulis->setCellValue('F'.$i, $line->no_bukti);
                        $tulis->setCellValue('G'.$i, 'buku besar');
                        $tulis->setCellValue('H'.$i, $line->restitusi);
                        $tulis->setCellValue('I'.$i, $line->nip);
                        $tulis->setCellValue('J'.$i, $line->nama_karyawan);
                        $tulis->setCellValue('K'.$i, $line->nama_tertanggung);
                        $tulis->setCellValue('L'.$i, $line->nama_dokter);
                        $tulis->setCellValue('M'.$i, $line->nama_provider);
                        $tulis->setCellValue('N'.$i, $line->nama_diagnosa);
			$i++;
		}


      	// Rename worksheet
	$this->excel->getActiveSheet()->setTitle('Laboratorium');


	// Set active sheet index to the first sheet, so Excel opens this as the first sheet
	$this->excel->setActiveSheetIndex(0);


	// Redirect output to a client�s web browser (Excel5)
	header('Content-Type: application/vnd.ms-excel');
	header('Content-Disposition: attachment;filename="Transaksi Laboratorium.xls"');
	header('Cache-Control: max-age=0');

	$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
	$objWriter->save('php://output');
	//exit;
	}
        
        function impor()
        {
            $data['data']='hasillaboratorium';
	    $this->load->view('impor/impor_hasil',$data);
            //$this->load->view('impor/tesimpor',$data);
        }

        function do_impor()
	{

        $rayon=$this->session->userdata('id_rayon');
        //$rayon=1;
        $wilayah=$this->session->userdata('id_wilayah');
        $mitra=$this->session->userdata('id_mitra');


        $id_karyawan='';
        $id_transaksi=null;
        $id_item=null;
        $id_dokter=null;
        $id_dosis=null;
        $id_diagnosa=null;
        
        $error = "";
	$msg = "";
	$pesan="";
	$fileElementName = 'uploadhasillaboratorium';

        $tgl_trans="";
        $tgl_kunj="";
        $nid="";
        $penanggung="";
        $pasien ="";
        $status ="";
        $nama_dokter ="";
        $nama_provider ="";
        $no_bukti ="";
        $restitusi ="";
        $surat ="";
        $tagihan ="";
        $nama_item ="";
        $formularium_item ="";
        $oral_item="";
        $hba_item = "";
        $harga_item ="";
        $hrg_satuan ="";
        $jml = "";
        $disetujui ="";
        $harga_total ="";
        $total_biaya ="";
        $dosis ="";
        $rekomendasi ="";
        $ket_rekom ="";
        $diagnosa = "";
        $jns_penyakit = "";
        $post_biaya ="";
        $rujukan ="";
        $buku_besar="";
        
	if(!empty($_FILES[$fileElementName]['error']))
	{
		switch($_FILES[$fileElementName]['error'])
		{

			case '1':
				$error = 'The uploaded file exceeds the upload_max_filesize directive in php.ini';
				break;
			case '2':
				$error = 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form';
				break;
			case '3':
				$error = 'The uploaded file was only partially uploaded';
				break;
			case '4':
				$error = 'No file was uploaded.';
				break;

			case '6':
				$error = 'Missing a temporary folder';
				break;
			case '7':
				$error = 'Failed to write file to disk';
				break;
			case '8':
				$error = 'File upload stopped by extension';
				break;
			case '999':
			default:
				$error = 'No error code avaiable';
		}
	}
	elseif(empty($_FILES[$fileElementName]['tmp_name']) || $_FILES[$fileElementName]['tmp_name'] == 'none')
	{
		$error = 'No file was uploaded..';
	}
        
	else
	{

			$msg .= " File Name: " . $_FILES[$fileElementName]['name'] . ", ";
			$msg .= " File Size: " . @filesize($_FILES[$fileElementName]['tmp_name']);

			//for security reason, we force to remove all uploaded file
			@unlink($_FILES[$fileElementName]);

			$config['upload_path'] = './temp_upload/';
			$config['allowed_types'] = 'xls';

			$this->load->library('upload', $config);
			//$tes=$this->upload->do_upload();

                        
			if ( ! $this->upload->do_upload($fileElementName))
			{
                           $data = array('error' => $this->upload->display_errors());
                           $this->session->set_flashdata('msg_excel', 'Insert failed. Please check your file, only .xls file allowed.');
			}

			else
			{
                            $upload_data = $this->upload->data();

                            $file =  $upload_data['full_path'];
                            //print_r($file);
                            $pesan = $file;
                            error_reporting(E_ALL ^ E_NOTICE);
                            set_time_limit(0);
                            date_default_timezone_set('Europe/London');

                            $inputFileName = $file;
                            $objReader = new PHPExcel_Reader_Excel5();
                            $objPHPExcel = $objReader->load($inputFileName);
                            $sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
                            
                            $pesan .= "Jumlah row = ".$data['numRows']."  ";
                            $pesan .= "Data Terakhir = ".$data['cells'][6][1]."      ";

                            //$id_rayon=$sheetData[4]['C'];
                            $dataexcel = Array();
                            $pesan .="Jumlah Data= ".  count($sheetData)." ";
                            $this->db->trans_begin();
                            for ($i = 7; $i <=count($sheetData); $i++)
                            {
                                $pesan.="Membaca sheetdata[".$i."][]";
                                //$nid=null;
                                //$tgl_trans=null;
                                //$id_pasien=null;
                                $penanggung=$sheetData[$i]['E'];
                                $pasien =$sheetData[$i]['F'];
                                $status =$sheetData[$i]['G'];
                                $nama_provider =$sheetData[$i]['H'];
                                $rujukan =$sheetData[$i]['I'];
                                $nama_dokter =$sheetData[$i]['J'];
                                $no_bukti =$sheetData[$i]['K'];
                                $surat =$sheetData[$i]['L'];
                                $jns_pemeriksaan = $sheetData[$i]['O'];
                                $hasil_pemeriksaan = $sheetData[$i]['P'];
                                $nilai = $sheetData[$i]['Q'];
                                $hasil_rontgen = $sheetData[$i]['R'];
                                $diagnosa = $sheetData[$i]['S'];
                                $jns_penyakit = $sheetData[$i]['S'];
                                $jns_penyakit = $sheetData[$i]['S'];
                                $jns_penyakit = $sheetData[$i]['S'];
                                $jns_penyakit = $sheetData[$i]['S'];
                                
                                $pesan .="Semangat Gannnnnnnnnn".$sheetData[$i]['R'];
                                if($sheetData[$i]['M'] != null)
                                {
                                    $buku_besar = $sheetData[$i]['M'];
                                }
                                if($sheetData[$i]['N'] != null)
                                {
                                    $restitusi = $sheetData[$i]['N'];
                                }
                                
                                if($sheetData[$i]['O'] != null)
                                {
                                $pesan .="tgl_transaksi = ".$sheetData[$i]['C']." tglx";

                                    if(($sheetData[$i]['C'])!=null)
                                    {
                                      //Cari ID_KARYAWAN
                                      $nid =  $sheetData[$i]['D'];
                                      $pesan .= "nid = ".$sheetData[$i]['D'];

                                      $data_karyawan = $this->m_karyawan->cek_karyawan($nid);
                                      if(count($data_karyawan)>0)
                                      {
                                          $id_karyawan = $data_karyawan[0]['id_karyawan'];

                                          $id_rayon_karyawan = $data_karyawan[0]['id_rayon'];

                                          $pesan .="Ada Karyawan".$id_karyawan;
                                          $pesan .="Rayon Karyawan".$id_rayon_karyawan;
                                          if($rayon != $id_rayon_karyawan)
                                          {
                                              $error .="Anda tidak berhak menambahkan data dari rayon lain";
                                              break;
                                          }
                                      }
                                      else
                                      {
                                          $datanya=array('nama_karyawan'=>$penanggung,'id_rayon'=>$rayon,'nip'=>$nid);
				          $this->m_karyawan->insert_karyawan($datanya);
                                          $data_karyawan = $this->m_karyawan->cek_karyawan($nid);
                                          $id_karyawan = $data_karyawan[0]['id_karyawan'];
                                          $pesan .="Ada Karyawan".$id_karyawan;
                                          $pesan .="Tdak Ada Karyawan";

                                      }
                                      //Cari ID_TErtanggung
                                      $data_pasien = $this->m_tran_lab->cek_pasien($id_karyawan,$pasien);
                                      if(count($data_pasien)>0)
                                      {
                                          $id_pasien = $data_pasien[0]['id_tertanggung'];
                                          $pesan .="ada pasien";
                                      }
                                      else
                                      {
                                          $datapasien=array('nama_tertanggung'=>$pasien,'id_karyawan'=>$id_karyawan,'status'=>$status);
				          $this->m_tertanggung->insert_tertanggung($datapasien);
                                          $data_pasien = $this->m_tran_lab->cek_pasien($id_karyawan,$pasien);
                                          $id_pasien = $data_pasien[0]['id_tertanggung'];
                                      }
                                      

                                        //$tgl_trans = $sheetData[$i]['C'];
                                        $tgl_trans = $this->tanggal($sheetData[$i]['C']);
                                        $tgl_kunj = $this->tanggal($sheetData[$i]['B']);
                                        $pesan .="tes".$tgl_trans.$id_pasien;
                                        $maxid= $this->m_transaksi->get_maxid();
                                        $pesan .="maxid".$maxid[0]['id_transaksi'];
                                        $id_transaksi=$maxid[0]['id_transaksi']+1;
                                        $pesan .="idtransaksi".$id_transaksi;
                                        $datatransaksi = array('id_transaksi'=>$id_transaksi,'id_tertanggung'=>$id_pasien,'tgl_transaksi'=>$tgl_trans,'tgl_kunjungan'=>$tgl_kunj);
                                        $tran=$this->m_tran_lab->simpan_transaksi($datatransaksi);

                                        if($tran)
                                        {
                                         //$pesan .="nama dokter".$nama_dokter;
                                        $datadokter = $this->m_tran_lab->caridokter($nama_dokter);
                                        if($datadokter)
                                        {
                                        $id_dokter=$datadokter['0']['id_dokter'];
                                        }
                                        else
                                        {
                                        $datanya=array('nama_dokter'=>$nama_dokter);
				        $doktere=$this->m_dokter->insert_dokter($datanya);
                                        $datadokter = $this->m_tran_lab->caridokter($nama_dokter);
                                        $id_dokter=$datadokter['0']['id_dokter'];

                                        }
                                        
                                        $pesan .="rujukan".$rujukan;
                                        $datarujukan = $this->m_tran_lab->carirujukan($rujukan);
                                        if($datarujukan)
                                        {
                                        $id_rujukan = $datarujukan[0]['id_rujukan'];
                                        }
                                        else
                                        {
                                        $error .="tidak ada rujukan";
                                        }
                                        
                                        $pesan .="provider".$nama_provider;
                                        $dataprovider = $this->m_tran_lab->cariprovider($nama_provider);
                                        if($dataprovider)
                                        {
                                        $id_provider = $dataprovider[0]['id_provider'];
                                        $pesan .="Ada provider".$dataprovider[0]['id_provider'];
                                        }
                                        else
                                        {
                                        $datagigi=array('nama_provider'=>$nama_provider,'idjenis_provider'=>2);
				        $this->m_lab->insert_lab($datagigi);
                                        $dataprovider = $this->m_tran_lab->cariprovider($nama_provider);
                                        $id_provider = $dataprovider[0]['id_provider'];
                                        }
                                        if($restitusi == "TIDAK")
                                        {
                                        $restitusi = 't';
                                        }
                                        else
                                        {
                                        $restitusi = 'y';
                                        }
                                        $pesan .="bukti".$no_bukti;
                                        $pesan .=$restitusi;
                                        $pesan .="buku besar gan".$buku_besar;
                                        $datatransaksilab =  array('id_transaksi'=>$id_transaksi,'id_dokter'=>$id_dokter,'id_provider'=>$id_provider,'no_bukti'=>$no_bukti,'restitusi'=>$restitusi,'id_rujukan'=>$id_rujukan,'no_surat'=>$surat);
                                        $query3 = $this->m_tran_lab->simpan_transaksi_lab($datatransaksilab);
                                        //Jangan lupa diaktifkan ini belum insert ke master buku besar
                                        $databuku=array('id_transaksi'=>$id_transaksi,'buku_besar'=>$buku_besar);
                                        $query4 = $this->m_tran_lab->simpan_transaksi_buku($databuku);

            
                                        }
                                        else
                                        {
                                                $pesan .="Tidak bertambah transaksi";
                                        }
       
                                    }
                                    
                                        $nama_tagihan = $sheetData[$i]['O'];

                                    $pesan .="sheetdata[".$i."][o]item = ".$nama_tagihan;

                                    $cari_tagihan = $this->m_tran_lab->caritagihan($nama_tagihan);
                                    if( ! empty($cari_tagihan))
                                    {
                                    $id_item=$cari_tagihan[0]['id_item'];
                                    }
                                    else
                                    {
                                        /*$datanya=array('nama_item'=>$nama_item,'idjns_item'=>'3','hba_item'=>$hba_item,'harga_item'=>$harga_item,'frm_item'=>$formularium_item,'oral_item'=>$oral_item,'entri_item'=>'otomatis');
                                        $this->m_item->insert_item($datanya);
                                        $cari_item=$this->m_tran_gigi->caritagihan($nama_item,3);
                                        $id_item=$cari_item[0]['id_item'];*/
                                        $error ="Tidak Ada nama Tagihan";
                                        break;
                                    }

                                   
                                    //$pesan .="id_item_transaksi,id_transaksi".$id_transaksi.",hasil,nilai,rontgent".$ro.",id_item,total";
                                    //$dataitemtransaksi=array('id_transaksi'=>$id_transaksi,'disetujui'=>$disetujui,'hrg_satuan'=>$hrg_satuan,'jumlah'=>$jml,'racikan'=>$formularium_item,'id_item'=>$id_item);
                                   //$dataitemtransaksi=array('id_transaksi'=>$id_transaksi,'disetujui'=>$disetujui,'hrg_satuan'=>$hrg_satuan,'jumlah'=>$jml,'id_item'=>$id_item);
                                    //$insertitem=$this->m_tran_gigi->simpan_item_transaksi($dataitemtransaksi);
                                    $datanya=array('id_transaksi'=>$id_transaksi,'hasil'=>$hasil_pemeriksaan,'nilai'=>$nilai,'rontgen'=>$hasil_rontgen,'id_item'=>$id_item);
                                    $insertitem=$this->m_tran_lab->simpan_item_transaksi($datanya);
                                }

                            if($diagnosa!=null)
                                    {
                                        $caridiagnosa=$this->m_tran_lab->caridiagnosa($diagnosa);
                                        if($caridiagnosa)
                                        {
                                        $id_diagnosa = $caridiagnosa[0]['id_diagnosa'];

                                        }
                                        else
                                        {
                                        $jns_penyakit = strtolower($jns_penyakit);
                                            //$pesan .=$diagnosa.$jns_penyakit;
                                        $data_diagnosa=array('nama_diagnosa'=>$diagnosa,'jenis_penyakit'=>$jns_penyakit,'kelompok_penyakit'=>'penyakit');
                                        $this->m_tran_lab->simpan_diagnosa($data_diagnosa);
                                        $caridiagnosa=$this->m_tran_lab->caridiagnosa($diagnosa);
                                        $id_diagnosa = $caridiagnosa[0]['id_diagnosa'];

                                        }

                                        $pesan .=$id_transaksi."Semangat Mas Bro.".$id_diagnosa;
                                        $datatransaksidiagnosa = array('id_transaksi'=>$id_transaksi,'id_diagnosa'=>$id_diagnosa);

                                        $simpantransaksidiagnosa = $this->m_tran_lab->simpan_item_diagnosa($datatransaksidiagnosa);


                                    }

                            else if (($sheetData[$i]['O'])==null && ($sheetData[$i]['C'])==null)
                            {
                                break;
                            }
                            
                            }
                            if($error=='')
                            {
                                $this->db->trans_commit();
                            }
                            else
                            {
                                $this->db->trans_rollback();
                            }

                            unlink($file);

			}
                  
	    }
            


        $data['error']=$error;
        $data['pesan']=$pesan;
        echo json_encode($data);
	}

        function tanggal($tanggal)
        {
        $tes=split("/",$tanggal);
        $hasil=$tes[count($tes)-1];
        for($i=count($tes)-2;$i>=0;$i--)
        {
        $hasil .="-".$tes[$i];
        }
        return $hasil;
        }
        function detail($id_trans)
        {
            $data['id_tran']=$id_trans;
            $data['namafile']='hasillaboratorium';
            //$this->load->view('hasil/detailhasilapotek',$data);

	      $this->load->view('hasil/detailhasillab',$data); //Default di arahkan ke function grid
        }



        function detail_diagnosa($id_trans)
        {

                 //$penanggung = $this->input->get('penanggung');
                $page  = $this->input->get('page');
		$limit = $this->input->get('rows');
		$sidx  = $this->input->get('sidx');
		$sord  = $this->input->get('sord');


		if(!$sidx) $sidx=1;


		# Untuk Single Searchingnya #
		$where = ""; //if there is no search request sent by jqgrid, $where should be empty
		$searchField = isset($_GET['searchField']) ? $_GET['searchField'] : false;
		$searchString = isset($_GET['searchString']) ? $_GET['searchString'] : false;
		/*if ($_GET['_search'] == 'true')
		{
			$where = array($searchField => $searchString);
		}*/
		# End #



		//$count = $this->m_hasil_transaksi->count_Apotek($searchField,$searchString,$rayon,$wilayah,$mitra,$bulan,$tahun,$tgl1,$tgl2);
                $count = $this->m_view_hasillab->countDiagnosa($id_trans);
		//$count = 1;
		$count > 0 ? $total_pages = ceil($count/$limit) : $total_pages = 0;
		if ($page > $total_pages) $page=$total_pages;
		$start = $limit*$page - $limit;
		if($start <0) $start = 0;

		//$data1 = $this->m_hasil_transaksi->get_Apotek($searchField,$searchString, $sidx, $sord, $limit, $start,$rayon,$wilayah,$mitra,$bulan,$tahun,$tgl1,$tgl2)->result();
                $data1 = $this->m_view_hasillab->getDiagnosa($id_trans)->result();



		$responce->page = $page;
		$responce->total = $total_pages;
		$responce->records = $count;
                $i=0;
		foreach($data1 as $line)
		{
			$responce->rows[$i]['id_transaksi']   = $line->id_transaksi_diagnosa;

			$responce->rows[$i]['cell'] = array($line->id_transaksi_diagnosa,$line->nama_diagnosa);
			$i++;
		}
		echo json_encode($responce);
        }

        function detail_item($id_trans)
	{

                 //$penanggung = $this->input->get('penanggung');
                $page  = $this->input->get('page');
		$limit = $this->input->get('rows');
		$sidx  = $this->input->get('sidx');
		$sord  = $this->input->get('sord');


		if(!$sidx) $sidx=1;


		# Untuk Single Searchingnya #
		$where = ""; //if there is no search request sent by jqgrid, $where should be empty
		$searchField = isset($_GET['searchField']) ? $_GET['searchField'] : false;
		$searchString = isset($_GET['searchString']) ? $_GET['searchString'] : false;
		/*if ($_GET['_search'] == 'true')
		{
			$where = array($searchField => $searchString);
		}*/
		# End #



		//$count = $this->m_hasil_transaksi->count_Apotek($searchField,$searchString,$rayon,$wilayah,$mitra,$bulan,$tahun,$tgl1,$tgl2);
                $count = $this->m_view_hasillab->countItem($id_trans);
		//$count = 1;
		$count > 0 ? $total_pages = ceil($count/$limit) : $total_pages = 0;
		if ($page > $total_pages) $page=$total_pages;
		$start = $limit*$page - $limit;
		if($start <0) $start = 0;

		//$data1 = $this->m_hasil_transaksi->get_Apotek($searchField,$searchString, $sidx, $sord, $limit, $start,$rayon,$wilayah,$mitra,$bulan,$tahun,$tgl1,$tgl2)->result();
                $data1 = $this->m_view_hasillab->getItem($id_trans)->result_array();


                $jumlah=0;
                $tothrg_standar=0;
                $tothrg_satuan=0;
                $total=0;

		$responce->page = $page;
		$responce->total = $total_pages;
		$responce->records = $count;
                $i=0;
		foreach($data1 as $row)
		{
			//$responce->rows[$i]['id_transaksi']   = $line->id_transaksi;
                        $responce->rows[$i]['id_transaksi']   = $row['id_transaksi'];
			//$responce->rows[$i]['cell'] = array($line->id_transaksi,$line->jenis_item,$line->nama_item,$line->jumlah,$line->harga_item,$line->hrg_satuan,null,null,$line->nama_dosis,$line->nama_rekomendasi,$line->total);
			$responce->rows[$i]['cell'] = array($row['id_transaksi'],$row['jenis_item'],$row['nama_item'],null,null,null,null,$row['nilai'],$row['hasil'],null,null);
			$i++;
		}
                $responce->userdata['jenis_item'] = 'Totals:';
		echo json_encode($responce);
	}

        function cruddiagnosa()
        {
                $oper=$this->input->post('oper');
		$id=$this->input->post('id');


	    switch ($oper)
		{
	        case 'del':
	           $this->m_tran_lab->delete_diagnosa($id);
	        break;
		}
        }

        function cruditem()
        {
                $oper=$this->input->post('oper');
		$id=$this->input->post('id');


	    switch ($oper)
		{
	        case 'del':
	           $this->m_tran_dokter->delete_item_transaksi($id);
	        break;
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
            $this->m_tran_lab->simpan_diagnosa($data);
            $id_diag=$this->m_tran_lab->get_id_diagnosa();
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
            $query2 = $this->m_tran_lab->simpan_item_diagnosa($data2);
                if($query2){
                    echo "sukses";
                } else {
                    echo "gagal";
                }
            }
    }



}