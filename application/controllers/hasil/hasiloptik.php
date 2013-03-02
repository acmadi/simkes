<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hasiloptik extends CI_Controller {
   // $kun="";
    function __construct() 
    {
        parent::__construct();
        $this->load->model(array('m_rekomendasi','m_hasil_transaksi','m_transaksi','m_karyawan','m_tran_optik','m_tertanggung','m_item','m_dokter','m_optik','m_view_hasiloptik'));
		$this->load->helper('url'); // Load Helper URL CI
        $this->load->library(array('excel','validasi'));
        //$this->load->helper('form');
    }
    
    function index() 
    {
	$this->load->view('hasil/hasiloptik'); //Default di arahkan ke function grid
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
                //$rayon=1;

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



		$count = $this->m_hasil_transaksi->count_Optik($searchField,$searchString,$rayon,$wilayah,$mitra,$bulan,$tahun,$tgl1,$tgl2,$jns_tanggal);

		$count > 0 ? $total_pages = ceil($count/$limit) : $total_pages = 0;
		if ($page > $total_pages) $page=$total_pages;
		$start = $limit*$page - $limit;
		if($start <0) $start = 0;

		$data1 = $this->m_hasil_transaksi->get_Optik($searchField,$searchString, $sidx, $sord, $limit, $start,$rayon,$wilayah,$mitra,$bulan,$tahun,$tgl1,$tgl2,$jns_tanggal)->result();
	
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
                   
                }   $responce->rows[$i]['id_transaksi']   = $line->id_transaksi;
                    $responce->rows[$i]['cell'] = array($line->id_transaksi,$line->tgl_transaksi,$line->tgl_kunjungan,$line->no_surat,$line->no_bukti,$line->buku_besar,$line->restitusi,$line->nip,$line->nama_karyawan,$line->nama_tertanggung,'',$line->nama_dokter,$line->nama_provider,$diagnosa);

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
                //$rayon=1;

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



		$count = $this->m_hasil_transaksi->count_Optik($searchField,$searchString,$rayon,$wilayah,$mitra,$bulan,$tahun,$tgl1,$tgl2,$jns_tanggal);

		$count > 0 ? $total_pages = ceil($count/$limit) : $total_pages = 0;
		if ($page > $total_pages) $page=$total_pages;
		$start = $limit*$page - $limit;
		if($start <0) $start = 0;

		$data1 = $this->m_hasil_transaksi->get_Optik($searchField,$searchString, $sidx, $sord, $limit, $start,$rayon,$wilayah,$mitra,$bulan,$tahun,$tgl1,$tgl2,$jns_tanggal)->result();
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
                        $tulis->setCellValue('L1', "RUJUKAN");
                        $tulis->setCellValue('M1', "DOKTER");
                        $tulis->setCellValue('N1', "PROVIDER");
                        $tulis->setCellValue('O1', "DIAGNOSA");


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
                        $tulis->setCellValue('L'.$i, "");
                        $tulis->setCellValue('M'.$i, $line->nama_dokter);
                        $tulis->setCellValue('N'.$i, $line->nama_provider);
                        $tulis->setCellValue('N'.$i, $line->nama_diagnosa);
			$i++;
		}


      	// Rename worksheet
	$this->excel->getActiveSheet()->setTitle('Transaksi Optik');


	// Set active sheet index to the first sheet, so Excel opens this as the first sheet
	$this->excel->setActiveSheetIndex(0);


	// Redirect output to a client�s web browser (Excel5)
	header('Content-Type: application/vnd.ms-excel');
	header('Content-Disposition: attachment;filename="Transaksi Optik.xls"');
	header('Cache-Control: max-age=0');

	$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
	$objWriter->save('php://output');
	//exit;
	}

        function impor()
        {
            $data['data']='hasiloptik';
	    $this->load->view('impor/impor_hasil',$data);
            //$this->load->view('impor/tesimpor',$data);
        }

        function do_impor()
	{

        $rayon=$this->session->userdata('id_rayon');
        //$rayon=1;
        $wilayah=$this->session->userdata('id_wilayah');
        $mitra=$this->session->userdata('id_mitra');


    
        $id_transaksi=null;
        $id_diagnosa=null;

        $error = "";
	$msg = "";
	$pesan="";
	$fileElementName = 'uploadhasiloptik';

        $tgl_trans="";
        $tgl_kunj="";
        $nid="";
        $penanggung="";
        $pasien ="";
        $status ="";
        $nama_dokter ="";
        $nama_provider ="";
        $no_bukti ="";
        $no_surat ="";
        $buku_besar ="";
        $tagihan ="";
        $nama_item ="";
        $oral_item="";
        $jml = "";
        $disetujui ="";
        $harga_total ="";
        $total_biaya ="";
        $rekomendasi ="";
        $ket_rekom ="";
        $diagnosa = "";
        $jns_penyakit = "";
        $post_biaya ="";
        $jns_periksa="";
        

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
                            $id_rayon=1;
                            $dataexcel = Array();
                            $pesan .="Jumlah Data= ".  count($sheetData)." ";
                            $this->db->trans_begin();
                            for ($i = 7; $i <=count($sheetData); $i++)
                            {
                                $id_rekomendasi=null;
                                
                                $id_karyawan=null;
                                $id_pasien=null;
                                $id_rujukan=null;
                                $id_dokter=null;
                                $id_provider=null;
                                $restitusi = null;
                                $id_item=null;

                                $hba_item = "";
                                $harga_item ="";
                                $hrg_satuan ="";
                                $total=$sheetData[$i]['V'];

                                
                                $penanggung=$sheetData[$i]['E'];
                                $pasien =$sheetData[$i]['F'];
                                $status =$sheetData[$i]['G'];
                                $nama_dokter =$sheetData[$i]['H'];
                                $nama_provider =$sheetData[$i]['I'];
                                

                                
                                $buku_besar =$sheetData[$i]['L'];
                                $tagihan =$sheetData[$i]['M'];
                                $hrg_satuan = $sheetData[$i]['R'];
                                $jml = $sheetData[$i]['S'];
                                $disetujui = $sheetData[$i]['T'];
                                $diagnosa=$sheetData[$i]['Y'];
                                $jns_penyakit=$sheetData[$i]['Z'];
                                
                                $nama_item = $sheetData[$i]['N'];
                                $hba_item = $sheetData[$i]['P'];
                                $harga_item = $sheetData[$i]['Q'];
                                $rekomendasi =$sheetData[$i]['W'];
                                $axis_left=$sheetData[$i]['AG'];
                                $axis_right = $sheetData[$i]['AF'];
                                $basis_left = $sheetData[$i]['AK'];
                                $basis_right = $sheetData[$i]['AI'];
                                $sphere_left = $sheetData[$i]['AC'];
                                $sphere_right = $sheetData[$i]['AB'];
                                $cylinder_left = $sheetData[$i]['AE'];
                                $cylinder_right = $sheetData[$i]['AD'];
                                $prisma_left = $sheetData[$i]['AI'];
                                $prisma_right = $sheetData[$i]['AH'];
                                $pupil_left = $sheetData[$i]['AM'];
                                $pupil_right = $sheetData[$i]['AL'];

                                //$tes = $data['cells'][8][3]
                                if(!$this->validasi->cekLengthString($disetujui,5))
                                {
                                $error="Data Status di baris ke".$i." hanya boleh ya atau tidak";
                                break;
                                }

                                if( $sheetData[$i]['AA'] != null)
                                {
                                    $jns_periksa = strtolower($sheetData[$i]['AA']);
                                    if($jns_periksa == 'adisi')
                                    {
                                        $jns_periksa ='a';
                                    }
                                    else if($jns_periksa == 'lihat dekat')
                                    {
                                        $jns_periksa = 'ld';
                                    }
                                    else if($jns_periksa == 'lihat jauh')
                                    {
                                        $jns_periksa = 'lj';
                                    }
                                    else
                                    {
                                        $error ="Data Jenis Periksa Salah, harus adisi, lihat jauh atau lihat dekat";
                                        break;
                                    }
                                }

                                if($jml != null)
                                {
                                if(!is_numeric($jml))
                                {
                                    $error .="Kolom Jumlah dibaris ".$i." harus berisi Angka";
                                    break;
                                }

                                }
                                else if( $hrg_satuan != '')
                                {
                                 if(!is_numeric($hrg_satuan))
                                {
                                    $error .="Kolom Harga Satuan dibaris ".$i." harus berisi Angka";
                                    break;
                                }
                                }
                                if( $total != '')
                                {
                                 if(!is_numeric($total))
                                {
                                    $error .="Kolom Total dibaris ".$i." harus berisi Angka";
                                    break;
                                }
                                }
                                
                                
                                if($error==null)
                                {

                                if($nama_item != null)
                                {
                                
                                    if(($sheetData[$i]['C'])!=null)
                                    {
                                      //Cari ID_KARYAWAN
                                      $nid =  $sheetData[$i]['D'];
                                      if($nid != null && $penanggung != null)
                                      {
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
                                      
                                      }
                                      if($id_karyawan==null)
                                      {
                                          $error .="Tidak Ada id Karyawan atau Nama Karyawan di baris".$i;
                                          break;
                                      }
                                      
                                      //Cari ID_TErtanggung
                                      if($pasien!=null)
                                      {
                                      $data_pasien = $this->m_tran_optik->cek_pasien($id_karyawan,$pasien);
                                      if(count($data_pasien)>0)
                                      {
                                          $id_pasien = $data_pasien[0]['id_tertanggung'];
                                          $pesan .="ada pasien";
                                      }
                                      else
                                      {
                                          if($status==null)
                                            {
                                            $error="Status pasien tidak ada dibaris".$i;
                                            break;
                                            }

                                          $datapasien=array('nama_tertanggung'=>$pasien,'id_karyawan'=>$id_karyawan,'status'=>$status);
				          $this->m_tertanggung->insert_tertanggung($datapasien);
                                          $data_pasien = $this->m_tran_optik->cek_pasien($id_karyawan,$pasien);
                                          $id_pasien = $data_pasien[0]['id_tertanggung'];

                                      }
                                      }
                                      if($id_pasien==null)
                                      {
                                          $error .="Tidak Ada Nama Pasien di baris".$i;
                                          break;
                                      }
                                      
                                        //$tgl_trans = $sheetData[$i]['C'];
                                        $tgl_trans = $this->tanggal($sheetData[$i]['C']);
                                        $tgl_kunj = $this->tanggal($sheetData[$i]['B']);
                                        //$pesan .="tes".$tgl_trans.$id_pasien;
                                        $maxid= $this->m_transaksi->get_maxid();
                                        //$pesan .="maxid".$maxid[0]['id_transaksi'];
                                        $id_transaksi=$maxid[0]['id_transaksi']+1;
                                        //$pesan .="idtransaksi".$id_transaksi;
                                        $datatransaksi = array('id_transaksi'=>$id_transaksi,'id_tertanggung'=>$id_pasien,'tgl_transaksi'=>$tgl_trans,'tgl_kunjungan'=>$tgl_kunj);
                                        $tran=$this->m_tran_optik->simpan_transaksi($datatransaksi);
                                      
                                        if($tran)
                                        {
                                         //$id_transaksi=$maxid[0]['id_transaksi'] +1;//jangan lupa dihapus


                                        //$pesan .="nama dokter".$nama_dokter;
                                        if($nama_dokter != null)
                                        {$datadokter = $this->m_tran_optik->caridokter($nama_dokter);
                                        if($datadokter)
                                        {
                                        $id_dokter=$datadokter['0']['id_dokter'];
                                        }
                                        else
                                        {
                                        $datanya=array('nama_dokter'=>$nama_dokter);
				        $doktere=$this->m_dokter->insert_dokter($datanya);
                                        $datadokter = $this->m_tran_optik->caridokter($nama_dokter);
                                        $id_dokter=$datadokter['0']['id_dokter'];

                                        }

                                        }
                                        if($id_dokter==null)
                                        {
                                            $error .="Tidak ada Nama Dokter di baris".$i;
                                            break;
                                        }
                                       
                                        $pesan .="provider".$nama_provider;
                                        if($nama_provider != null)
                                        {
                                        $dataprovider = $this->m_tran_optik->carioptik($nama_provider);

                                        if($dataprovider)
                                        {
                                        $id_provider = $dataprovider[0]['id_provider'];
                                        //$pesan .="Ada provider".$dataprovider[0]['id_provider'];
                                        }
                                        else
                                        {
                                        $dataoptik=array('nama_provider'=>$nama_provider,'idjenis_provider'=>5);
				        $this->m_optik->insert_optik($dataoptik);
                                        $dataprovider = $this->m_tran_optik->carioptik($nama_provider);
                                        $id_provider = $dataprovider[0]['id_provider'];

                                        }

                                        }
                                        if($id_provider==null)
                                        {
                                            $error.="Nama Provider dibaris".$i." tidak ada";
                                            break;
                                        }

                                        if($sheetData[$i]['K']!=null)
                                        {
                                        $restitusi =strtoupper($sheetData[$i]['K']);
                                        if($restitusi == "TIDAK")
                                        {
                                        $restitusi = 't';
                                        }
                                        else
                                        {
                                        $restitusi = 'y';
                                        }
                                        }
                                        if($restitusi == null)
                                        {
                                            $error .="Tidak ada Restitusi dibaris".$i;
                                            break;
                                        }
                                        if($sheetData[$i]['J']!=null)
                                        {
                                        $no_bukti =$sheetData[$i]['J'];
                                        }
                                        if($no_bukti==null)
                                        {
                                            //$error .= "Tidak ada no bukti";
                                            //break;
                                        }
                                        $pesan .="bukti".$no_bukti;
                                        if($buku_besar==NULL)
                                        {
                                            $error.="Tidak ada buku besar di baris".$i;
                                            break;
                                        }
                                        if($error==null)
                                        {
                                        $pesan .="insert transaksi optik".$id_transaksi."dok".$id_dokter."optik".$id_provider."bukti".$no_bukti."resti".$restitusi;
                                        $datatransaksioptik =  array('id_transaksi'=>$id_transaksi,'id_dokter'=>$id_dokter,'id_provider'=>$id_provider,'no_bukti'=>$no_bukti,'no_surat'=>$no_surat,'restitusi'=>$restitusi);
                                        $query3 = $this->m_tran_optik->simpan_transaksi_optik($datatransaksioptik);
                                        //Jangan lupa diaktifkan ini belum insert ke master buku besar
                                        $databuku=array('id_transaksi'=>$id_transaksi,'buku_besar'=>$buku_besar);
                                        $query4 = $this->m_tran_optik->simpan_transaksi_buku($databuku);
                                        }
                                        

                                        }
                                        else
                                        {
                                            $pesan .="Tidak bertambah transaksi";
                                        }


                                    }

                                        

                                        $oral_item = strtoupper($sheetData[$i]['O']);

                                        $pesan .= $oral_item;
                                        if($oral_item == 'ORAL')
                                        {
                                        $pesan .= "Hai";

                                        $oral_item ='y';
                                        $pesan .=$oral_item;
                                        }
                                        else
                                        {
                                        $oral_item ="t";
                                        }



                                    $pesan .="sheetdata[".$i."][o]item = ".$nama_item;
                                    $cari_item=$this->m_tran_optik->caritagihan($nama_item,5);
                                    if( ! empty($cari_item))
                                    {
                                    $id_item=$cari_item[0]['id_item'];
                                    }
                                    else
                                    {   if($hba_item==null)
                                        {
                                            $error .="Data item tidak ada di Database jadi HBA perlu diisi dibaris".$i;
                                            break;
                                        }
                                        if($harga_item==null)
                                        {
                                            $error .="Data item tidak ada di Database jadi Harga Item perlu diisi dibaris".$i;
                                            break;
                                        }
                                        $datanya=array('nama_item'=>$nama_item,'idjns_item'=>'5','hba_item'=>$hba_item,'harga_item'=>$harga_item,'oral_item'=>$oral_item,'entri_item'=>'otomatis');
                                        $this->m_item->insert_item($datanya);
                                        $cari_item=$this->m_tran_optik->caritagihan($nama_item,5);
                                        $id_item=$cari_item[0]['id_item'];
                                    }
                                    if($id_item==null)
                                    {
                                        $error.="Tidak ada Item dibaris".$i;
                                        break;
                                    }
                                   
                                    
                                    
                                    if($disetujui!=null)
                                    {
                                        $disetujui = strtolower($disetujui);
                                        if($disetujui == 'ya')
                                        {
                                            $disetujui='y';
                                        }
                                        else
                                        {
                                            $disetujui='t';
                                        }
                                    }
                                    if($jml==null)
                                     {
                                         $error .="Kolom jml dibaris".$i." tidak ada";
                                         break;
                                     }
                                     if($hrg_satuan==null)
                                     {
                                         $error .="Kolom harga satuan dibaris".$i." tidak ada";
                                         break;
                                     }
                                     if($total==null)
                                     {
                                         $error .="Tidak ada total harga item dibaris".$i;
                                         break;
                                     }
                                     if($rekomendasi!=null)
                                     {
                                            $rekom=$this->m_rekomendasi->getIdrekomendasi($rekomendasi)->result_array();
                                            $id_rekomendasi=$rekom[0]['id_rekomendasi'];
                                     }

                                    $pesan .="item".$id_transaksi."setujui".$disetujui."Harga Saru".$hrg_satuan."JML".$jml.$id_item;
                                    $dataitemtransaksi=array('id_transaksi'=>$id_transaksi,'disetujui'=>$disetujui,'hrg_satuan'=>$hrg_satuan,'jumlah'=>$jml,'id_item'=>$id_item,'total'=>$total,'id_rekomendasi'=>$id_rekomendasi);
                                    $insertitem=$this->m_tran_optik->simpan_item_transaksi($dataitemtransaksi);

                                    if($jns_periksa != null)
                                    {
                                    $pesan .="JEnis PEriksa".$jns_periksa;
                                    $data_periksa_kiri=array('id_transaksi'=>$id_transaksi,'cylinder'=>$cylinder_left,'axis'=>$axis_left,'prisma'=>$prisma_left,'basis'=>$basis_left,'pupil_distance'=>$pupil_left,'spher'=>$sphere_left,'mata'=>'l','jns_periksa'=>$jns_periksa);
                                    
                                    $this->m_tran_optik->simpan_periksa_optik($data_periksa_kiri);

                                    $data_periksa_kanan=array('id_transaksi'=>$id_transaksi,'cylinder'=>$cylinder_left,'axis'=>$axis_left,'prisma'=>$prisma_left,'basis'=>$basis_left,'pupil_distance'=>$pupil_left,'spher'=>$sphere_left,'mata'=>'r','jns_periksa'=>$jns_periksa);

                                    $this->m_tran_optik->simpan_periksa_optik($data_periksa_kanan);

                                    }
                                    


                                }

                                if(($id_transaksi != null) && ($diagnosa!=null))
                                    {
                                        $caridiagnosa=$this->m_tran_optik->caridiagnosa($diagnosa);
                                        if($caridiagnosa)
                                        {
                                        $id_diagnosa = $caridiagnosa[0]['id_diagnosa'];

                                        }
                                        else
                                        {
                                        $jns_penyakit = strtolower($jns_penyakit);
                                            //$pesan .=$diagnosa.$jns_penyakit;
                                        $data_diagnosa=array('nama_diagnosa'=>$diagnosa,'jenis_penyakit'=>$jns_penyakit,'kelompok_penyakit'=>'penyakit');
                                        $this->m_tran_optik->simpan_diagnosa($data_diagnosa);
                                        $caridiagnosa=$this->m_tran_optik->caridiagnosa($diagnosa);
                                        $id_diagnosa = $caridiagnosa[0]['id_diagnosa'];

                                        }

                                        $pesan .=$id_transaksi."Semangat Mas Bro.".$id_diagnosa;
                                        $datatransaksidiagnosa = array('id_transaksi'=>$id_transaksi,'id_diagnosa'=>$id_diagnosa);

                                        $simpantransaksidiagnosa = $this->m_tran_optik->simpan_item_diagnosa($datatransaksidiagnosa);


                                    }

                                if(($sheetData[$i]['C'] != null) && ($nama_item == null))
                                {
                                    $error .="Nama Item dibaris".$i."tidak ada";
                                    break;
                                }
                                elseif (($sheetData[$i]['O'])==null && ($sheetData[$i]['C'])==null)
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


                            }
                        unlink($file); 
			}
                        
	    }

        $data['error']=$error;
        $data['pesan']=$pesan;
        //$data['isi']=$sheetData;
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
            $data['namafile']='hasiloptik';
            //$this->load->view('hasil/detailhasilapotek',$data);

	      $this->load->view('hasil/detailhasiloptik',$data); //Default di arahkan ke function grid
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
                $count = $this->m_view_hasiloptik->countDiagnosa($id_trans);
		//$count = 1;
		$count > 0 ? $total_pages = ceil($count/$limit) : $total_pages = 0;
		if ($page > $total_pages) $page=$total_pages;
		$start = $limit*$page - $limit;
		if($start <0) $start = 0;

		//$data1 = $this->m_hasil_transaksi->get_Apotek($searchField,$searchString, $sidx, $sord, $limit, $start,$rayon,$wilayah,$mitra,$bulan,$tahun,$tgl1,$tgl2)->result();
                $data1 = $this->m_view_hasiloptik->getDiagnosa($id_trans)->result();



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
                $count = $this->m_view_hasiloptik->countItem($id_trans);
		//$count = 1;
		$count > 0 ? $total_pages = ceil($count/$limit) : $total_pages = 0;
		if ($page > $total_pages) $page=$total_pages;
		$start = $limit*$page - $limit;
		if($start <0) $start = 0;

		//$data1 = $this->m_hasil_transaksi->get_Apotek($searchField,$searchString, $sidx, $sord, $limit, $start,$rayon,$wilayah,$mitra,$bulan,$tahun,$tgl1,$tgl2)->result();
                $data1 = $this->m_view_hasiloptik->getItem($id_trans)->result_array();


                $jumlah=0;
                $tothrg_standar=0;
                $tothrg_satuan=0;
                $total=0;

		$responce->page = $page;
		$responce->total = $total_pages;
		$responce->records = $count;
                $i=0;
                $tot=0;
		foreach($data1 as $row)
		{
			//$responce->rows[$i]['id_transaksi']   = $line->id_transaksi;
                        $responce->rows[$i]['id_transaksi']   = $row['id_item_transaksi_optik'];
                        $jumlah += $row['jumlah'];
                        $tothrg_standar += $row['harga_item'];
                        $tothrg_satuan += $row['hrg_satuan'];
                        if($row['total']==null)
                        {
                        $tot=$row['jumlah']*$row['hrg_satuan'];
                        $total += $tot;
                        }
                        else
                        {
                        $tot=$row['total'];
                        $total += $row['total'];

                        }
			//$responce->rows[$i]['cell'] = array($line->id_transaksi,$line->jenis_item,$line->nama_item,$line->jumlah,$line->harga_item,$line->hrg_satuan,null,null,$line->nama_dosis,$line->nama_rekomendasi,$line->total);
			$responce->rows[$i]['cell'] = array($row['id_item_transaksi_optik'],$row['jenis_item'],$row['nama_item'],$row['jumlah'],$row['harga_item'],$row['hrg_satuan'],$row['nama_rekomendasi'],$tot);
			$i++;
		}
                $responce->userdata['jenis_item'] = 'Totals:';
                $responce->userdata['jumlah'] = $jumlah;
                $responce->userdata['harga_item'] = $tothrg_standar;
                $responce->userdata['hrg_satuan'] = $tothrg_satuan;
                $responce->userdata['total'] = $total;
		echo json_encode($responce);
	}

                function detail_optik($id_trans)
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
                $count = $this->m_view_hasiloptik->countItem($id_trans);
		//$count = 1;
		$count > 0 ? $total_pages = ceil($count/$limit) : $total_pages = 0;
		if ($page > $total_pages) $page=$total_pages;
		$start = $limit*$page - $limit;
		if($start <0) $start = 0;

		//$data1 = $this->m_hasil_transaksi->get_Apotek($searchField,$searchString, $sidx, $sord, $limit, $start,$rayon,$wilayah,$mitra,$bulan,$tahun,$tgl1,$tgl2)->result();
                $data1 = $this->m_view_hasiloptik->getPeriksakiri($id_trans)->result_array();
                $data2 = $this->m_view_hasiloptik->getPeriksakanan($id_trans)->result_array();

                $jum = count($data1);
                for($i=0;$i<$jum;$i++)
                {
                 if($data1[$i]['jns_periksa'] == 'a')
                 {
                     $jns_periksa[$i]="adisi";
                 }
                 else if($data1[$i]['jns_periksa'] == 'ld')
                 {
                     $jns_periksa[$i]="lihat dekat";
                 }
                 else if($data1[$i]['jns_periksa'] == 'lj')
                 {
                     $jns_periksa[$i]="lihat jauh";
                 }
                 $id_transaksi[$i] = $data1[$i]['id_transaksi'];
                 $axis_left[$i] = $data1[$i]['axis'];
                 $axis_right[$i] = $data2[$i]['axis'];
                 $basis_left[$i] = $data1[$i]['basis'];
                 $basis_right[$i] = $data2[$i]['basis'];
                 $sphere_left[$i] = $data1[$i]['spher'];
                 $sphere_right[$i] = $data2[$i]['spher'];
                 $cylinder_left[$i] = $data1[$i]['cylinder'];
                 $cylinder_right[$i] = $data2[$i]['cylinder'];
                 $prisma_left[$i] = $data1[$i]['prisma'];
                 $prisma_right[$i] = $data2[$i]['prisma'];
                 $pupil_left[$i] = $data1[$i]['pupil_distance'];
                 $pupil_right[$i] = $data2[$i]['pupil_distance'];
                
                }
                //$i=0;
                 
                 

		$responce->page = $page;
		$responce->total = $total_pages;
		$responce->records = $count;
                $i=0;
                for($i=0;$i<$jum;$i++)
                {
                $responce->rows[$i]['cell'] = array($id_transaksi[$i],$jns_periksa[$i],$sphere_left[$i],$sphere_right[$i],$cylinder_left[$i],$cylinder_right[$i],$axis_left[$i],$axis_right[$i],$prisma_left[$i],$prisma_right[$i],$basis_left[$i],$basis_right[$i],$pupil_left[$i],$pupil_right[$i]);
                }

		echo json_encode($responce);
	}

        function cruddiagnosa()
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

        function cruditem()
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

        function simpandiagnosa()
    {
        $diagnosa = $this->input->get('diag');
        $id_kun = $this->input->get('id');
        $id_diag = $this->input->get('id_diag');
        $id_trans = $this->input->get('id_tran');

        if($id_diag=='undefined')
        {
            $data_diagnosa=array('id_diagnosa'=>'','nama_diagnosa'=>$diagnosa,'jenis_penyakit'=>'non_degeneratif','kelompok_penyakit'=>'penyakit');
            $this->m_tran_optik->simpan_diagnosa($data);
            $id_diag=$this->m_tran_optik->get_id_diagnosa();
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
            $query2 = $this->m_tran_optik->simpan_item_diagnosa($data2);
                if($query2){
                    echo "sukses";
                } else {
                    echo "gagal";
                }
            }
    }


    function plusitem($idtrans)
        {
              $data['modul']="optik";
              $data['idtrans']=$idtrans;
	      $this->load->view('hasil/plusitem',$data); //Default di arahkan ke function grid
        }

}