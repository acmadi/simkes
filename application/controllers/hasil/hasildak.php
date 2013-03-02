<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hasildak extends CI_Controller {
   // $kun="";
    function __construct() 
    {
        parent::__construct();
        $this->load->model(array('m_rekomendasi','m_hasil_transaksi','m_karyawan','m_tertanggung','m_transaksi','m_dokter','m_item','m_tran_dak'));
		$this->load->helper('url'); // Load Helper URL CI
        $this->load->library(array('excel','validasi'));
        //$this->load->helper('form');
    }
    
    function index() 
    {
	$this->load->view('hasil/hasildak'); //Default di arahkan ke function grid
    //echo "Semangat";
	}
	
	function json() 
	{
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



		$count = $this->m_hasil_transaksi->count_Dak($searchField,$searchString,$rayon,$wilayah,$mitra,$bulan,$tahun,$tgl1,$tgl2,$jns_tanggal);

		$count > 0 ? $total_pages = ceil($count/$limit) : $total_pages = 0;
		if ($page > $total_pages) $page=$total_pages;
		$start = $limit*$page - $limit;
		if($start <0) $start = 0;
		
		$data1 = $this->m_hasil_transaksi->get_Dak($searchField,$searchString, $sidx, $sord, $limit, $start,$rayon,$wilayah,$mitra,$bulan,$tahun,$tgl1,$tgl2,$jns_tanggal)->result();

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
                    $responce->rows[$i]['cell'] = array($line->id_transaksi,$line->tgl_transaksi,$line->tgl_kunjungan,$line->nama_kunjungan,$line->no_bukti,$line->nip,$line->nama_karyawan,$line->nama_tertanggung,$line->nama_rujukan,$line->nama_dokter,$line->anamnesis,$line->kondisi,$line->kesadaran,$line->suhu,$line->berat,$line->tinggi,'Berat',$line->nadi,$line->sistole,$line->diastole,$line->pernafasan,$line->riwayat_alergi,$diagnosa,'follow up','tgl follow up','entri');

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



		$count = $this->m_hasil_transaksi->count_Dak($searchField,$searchString,$rayon,$wilayah,$mitra,$bulan,$tahun,$tgl1,$tgl2,$jns_tanggal);

		$count > 0 ? $total_pages = ceil($count/$limit) : $total_pages = 0;
		if ($page > $total_pages) $page=$total_pages;
		$start = $limit*$page - $limit;
		if($start <0) $start = 0;

		$data1 = $this->m_hasil_transaksi->get_Dak($searchField,$searchString, $sidx, $sord, $limit, $start,$rayon,$wilayah,$mitra,$bulan,$tahun,$tgl1,$tgl2,$jns_tanggal)->result();
                $tulis=$this->excel->setActiveSheetIndex(0);

                        $tulis->setCellValue('A1', 'NO');
                        $tulis->setCellValue('B1', 'ID TRANSAKSI');
                        $tulis->setCellValue('C1', 'TGL TRANSAKSI');
                        $tulis->setCellValue('D1', 'TGL KUNJUNGAN');
                        $tulis->setCellValue('E1', 'KUNJUNGAN');
                        $tulis->setCellValue('F1', 'BUKTI');
                        $tulis->setCellValue('G1', 'NIP');
                        $tulis->setCellValue('H1', 'PENANGGUNG');
                        $tulis->setCellValue('I1', 'PASIEN');
                        $tulis->setCellValue('J1', 'RUJUKAN');
                        $tulis->setCellValue('K1', 'DOKTER');
                        $tulis->setCellValue('L1', 'ANAMNESIS');
                        $tulis->setCellValue('M1', 'KONDISI');
                        $tulis->setCellValue('N1', 'KESADARAN');
                        $tulis->setCellValue('O1', 'SUHU');
                        $tulis->setCellValue('P1', 'BERAT');
                        $tulis->setCellValue('Q1', 'TINGGI');
                        $tulis->setCellValue('R1', "Berat");
                        $tulis->setCellValue('S1', 'NADI');
                        $tulis->setCellValue('T1', 'SISTOLE');
                        $tulis->setCellValue('U1', 'DIASTOLE');
                        $tulis->setCellValue('V1', 'PERNAFASAN');
                        $tulis->setCellValue('W1', 'ALERGI');
                        $tulis->setCellValue('X1', 'DIAGNOSA');
                        $tulis->setCellValue('Y1', "Follow up");
                        $tulis->setCellValue('Z1', "tgl_follow up");
                        $tulis->setCellValue('AA1', "Entri");


        $i=2;
        foreach($data1 as $line)
		{
			$tulis->setCellValue('A'.$i, $i-1);
                        $tulis->setCellValue('B'.$i, $line->id_transaksi);
                        $tulis->setCellValue('C'.$i, $line->tgl_transaksi);
                        $tulis->setCellValue('D'.$i, $line->tgl_kunjungan);
                        $tulis->setCellValue('E'.$i, $line->nama_kunjungan);
                        $tulis->setCellValue('F'.$i, $line->no_bukti);
                        $tulis->setCellValue('G'.$i, $line->nip);
                        $tulis->setCellValue('H'.$i, $line->nama_karyawan);
                        $tulis->setCellValue('I'.$i, $line->nama_tertanggung);
                        $tulis->setCellValue('J'.$i, $line->nama_rujukan);
                        $tulis->setCellValue('K'.$i, $line->nama_dokter);

                        $tulis->setCellValue('L'.$i, $line->anamnesis);
                        $tulis->setCellValue('M'.$i, $line->kondisi);
                        $tulis->setCellValue('N'.$i, $line->kesadaran);
                        $tulis->setCellValue('O'.$i, $line->suhu);
                        $tulis->setCellValue('P'.$i, $line->berat);
                        $tulis->setCellValue('Q'.$i, $line->tinggi);
                        $tulis->setCellValue('R'.$i, "Berat");
                        $tulis->setCellValue('S'.$i, $line->nadi);
                        $tulis->setCellValue('T'.$i, $line->sistole);
                        $tulis->setCellValue('U'.$i, $line->diastole);
                        $tulis->setCellValue('V'.$i, $line->pernafasan);
                        $tulis->setCellValue('W'.$i, $line->riwayat_alergi);
                        $tulis->setCellValue('X'.$i, $line->nama_diagnosa);
                        $tulis->setCellValue('Y'.$i, "Follow up");
                        $tulis->setCellValue('Z'.$i, "tgl_follow up");
                        $tulis->setCellValue('AA'.$i, "Entri");
			$i++;
		}


      	// Rename worksheet
	$this->excel->getActiveSheet()->setTitle('DAK');


	// Set active sheet index to the first sheet, so Excel opens this as the first sheet
	$this->excel->setActiveSheetIndex(0);


	// Redirect output to a client�s web browser (Excel5)
	header('Content-Type: application/vnd.ms-excel');
	header('Content-Disposition: attachment;filename="Transaksi DAK.xls"');
	header('Cache-Control: max-age=0');

	$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
	$objWriter->save('php://output');
	//exit;
	}

        function impor()
        {
            $data['data']='hasildak';
	    $this->load->view('impor/impor_hasil',$data);
        }

        function do_impor()
	{

        $rayon=$this->session->userdata('id_rayon');
        //$rayon=1;
        $wilayah=$this->session->userdata('id_wilayah');
        $mitra=$this->session->userdata('id_mitra');



        $id_transaksi=null;

        $id_dokter=null;

        $id_dosis=null;
        $id_diagnosa=null;

        $error = "";
	$pesan="";
	$fileElementName = 'uploadhasildak';

        $tgl_trans="";
        $tgl_kunj="";
        $nid="";
        $penanggung="";
        $pasien ="";
        $status ="";
        $rujukan ="";
        $nama_dokter ="";
        $no_surat ="";
        $no_bukti ="";
        $restitusi ="";
        $buku_besar ="";
        $tagihan ="";
        $nama_item ="";
        $formularium_item ="";
        $oral_item="";
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

			$pesan .= " File Name: " . $_FILES[$fileElementName]['name'] . ", ";
			$pesan .= " File Size: " . @filesize($_FILES[$fileElementName]['tmp_name']);

			//for security reason, we force to remove all uploaded file
			@unlink($_FILES[$fileElementName]);

			$config['upload_path'] = './temp_upload/';
			$config['allowed_types'] = 'xls';

			$this->load->library('upload', $config);
			//$tes=$this->upload->do_upload();


			if ( ! $this->upload->do_upload($fileElementName))
			{
                           $data = array('error' => $this->upload->display_errors());
                           $error = "Insert failed. Please check your file, only .xls file allowed.";
			}

			else
			{
                            $upload_data = $this->upload->data();

                            $file =  $upload_data['full_path'];
                            //print_r($file);
                            //$pesan = $file;
                            error_reporting(E_ALL ^ E_NOTICE);
                            set_time_limit(0);
                            date_default_timezone_set('Europe/London');

                            $inputFileName = $file;
                            $objReader = new PHPExcel_Reader_Excel5();
                            $objPHPExcel = $objReader->load($inputFileName);
                            $sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
                            $pesan .=$sheetData;
                            //$pesan .= "Jumlah row = ".$data['numRows']."  ";
                            //$pesan .= "Data Terakhir = ".$data['cells'][6][1]."      ";

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

                                $pesan.="Membaca sheetdata[".$i."][O]";
                                $pesan.=$sheetData[$i]['O'];
                                if(!$this->validasi->cekLengthString($sheetData[$i]['D'],45))
                                {
                                $error="Data NID di baris ke".$i." terlalu Banyak";
                                }
                                else if(!$this->validasi->cekLengthString($sheetData[$i]['E'],200))
                                {
                                $error="Data Nama Karyawan di baris ke".$i." terlalu Banyak";
                                }
                                else if(!$this->validasi->cekLengthString($sheetData[$i]['F'],100))
                                {
                                $error="Data Nama Pasien di baris ke".$i." terlalu Banyak";
                                }
                                else if(!$this->validasi->cekLengthString($sheetData[$i]['G'],20))
                                {
                                $error="Data Status di baris ke".$i." yang boleh hanya anak, ybs, istri";
                                }

                                else
                                {

                                $nid =  $sheetData[$i]['D'];
                                $penanggung=$sheetData[$i]['E'];
                                $pasien =$sheetData[$i]['F'];
                                $status =$sheetData[$i]['G'];
                                $rujukan =$sheetData[$i]['H'];

                                $nama_dokter =$sheetData[$i]['I'];
                                $no_surat =$sheetData[$i]['K'];


                                $buku_besar =$sheetData[$i]['M'];
                                $tagihan =$sheetData[$i]['N'];

                                $nama_item = $sheetData[$i]['O'];
                                $formularium_item = $sheetData[$i]['P'];
                                $oral_item = strtoupper($sheetData[$i]['Q']);
                                $hba_item = $sheetData[$i]['R'];
                                $harga_item = $sheetData[$i]['S'];
                                $hrg_satuan = $sheetData[$i]['T'];

                                $jml = $sheetData[$i]['U'];
                                $disetujui = $sheetData[$i]['V'];
                                $total=$sheetData[$i]['W'];
                                $dosis=$sheetData[$i]['Y'];
                                $diagnosa=$sheetData[$i]['AB'];
                                $jns_penyakit=$sheetData[$i]['AC'];
                                $jns_kunjungan=$sheetData[$i]['AD'];
                                $kondisi=$sheetData[$i]['AE'];
                                $berat=$sheetData[$i]['AF'];
                                $tinggi=$sheetData[$i]['AG'];
                                $kesadaran=$sheetData[$i]['AH'];
                                $suhu=$sheetData[$i]['AI'];
                                $sistole=$sheetData[$i]['AJ'];
                                $diastole=$sheetData[$i]['AK'];
                                $anamnesis=$sheetData[$i]['AL'];
                                $pernafasan=$sheetData[$i]['AM'];
                                $nadi=$sheetData[$i]['AN'];
                                $alergi=$sheetData[$i]['AO'];
                                $keterangan=$sheetData[$i]['AP'];
                                $rekomendasi =$sheetData[$i]['Z'];
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


                                

                                if($error=='')
                                {
                                //$this->db->trans_start();
                                        if($formularium_item!=null)
                                        {
                                            $formularium_item=strtolower($formularium_item);
                                            if($formularium_item=='r')
                                            {
                                                $formularium_item='y';
                                            }
                                            else
                                            {
                                                $formularium_item='t';
                                            }
                                        }

                                //$pesan .="item = ".$sheetData[$i]['O']." ";
                                //$pesan .=$sheetData[$i]['O'];
                                if($nama_item != null)
                                {

                                

                                $pesan .="tgl_transaksi = ".$sheetData[$i]['C']." tglx";


                                    if(($sheetData[$i]['C'])!= null)
                                    {
                                      //Cari ID_KARYAWAN

                                      $pesan .= "Cari nid = ".$sheetData[$i]['D'];
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
                                      $data_pasien = $this->m_tran_dak->cek_pasien($id_karyawan,$pasien);
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
                                          $data_pasien = $this->m_tran_dak->cek_pasien($id_karyawan,$pasien);
                                          $id_pasien = $data_pasien[0]['id_tertanggung'];

                                          //$pesan .="tidak ada data pasien".$pasien.$id_karyawan.$status.$error;
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
                                        $tran = $this->m_tran_dak->simpan_transaksi($datatransaksi);
                                        if($tran)
                                        {
                                        if($rujukan!=null)
                                        {
                                        $datarujukan = $this->m_tran_dak->carirujukan($rujukan);
                                        if($datarujukan)
                                        {
                                        $id_rujukan = $datarujukan[0]['id_rujukan'];
                                        }
                                        else
                                        {
                                        $error .="tidak ada rujukan dengan nama ".$rujukan;
                                        break;
                                        }
                                        }
                                        if($id_rujukan==null)
                                        {
                                            $error .="Rujukan Tidak Ada di baris".$i;
                                            break;
                                        }
                                        //$pesan .="nama dokter".$nama_dokter;
                                        if($nama_dokter != null)
                                        {
                                        $pesan .="Cari Dokter";
                                        $datadokter = $this->m_tran_dak->caridokterrujukan($nama_dokter,$id_rujukan,3);
                                        if($datadokter)
                                        {
                                        $id_dokter=$datadokter['0']['id_dokter'];
                                        }

                                        else
                                        {
                                        $datanya=array('nama_dokter'=>$nama_dokter,'gol_dokter'=>3,'kat_dokter'=>$id_rujukan);
				        $doktere=$this->m_dokter->insert_dokter($datanya);
                                        $datadokter = $this->m_tran_dak->caridokterrujukan($nama_dokter,$id_rujukan,3);
                                        $id_dokter=$datadokter['0']['id_dokter'];

                                        }
                                        $pesan .=$id_dokter;

                                        }
                                        if($id_dokter==null)
                                        {
                                            $error .="Tidak ada Nama Dokter di baris".$i;
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

                                        


                                        if($error=='')
                                        {
                                        $pesan .="insert transaksi apotek".$id_transaksi."ruj".$id_rujukan."dok".$id_dokter."apotek".$id_provider."bukti".$no_bukti."resti".$restitusi;
                                        $datatransaksidak =  array('id_transaksi'=>$id_transaksi,'id_rujukan'=>$id_rujukan,'id_dokter'=>$id_dokter,'no_bukti'=>$no_bukti,'no_surat'=>$no_surat);
                                        $query3 = $this->m_tran_dak->simpan_transaksi_dak($datatransaksidak);
                                        
                                        }
                                        else
                                        {
                                        $error.="Tidak bertambah transaksi apotek dibaris".$i;
                                        break;
                                        }


                                        }
                                        else
                                        {
                                            $error .="Tidak bertambah transaksi";
                                        }

                                    }

                                    
                                        if($oral_item == 'ORAL')
                                        {
                                        $oral_item ='y';

                                        }
                                        else
                                        {
                                        $oral_item ="t";
                                        }





                                    //$pesan .="Cari sheetdata[".$i."][o]item = ".$nama_item;

                                        $cari_item=$this->m_tran_dak->caritagihan($nama_item,1);
                                    if( ! empty($cari_item))
                                    {
                                    $id_item=$cari_item[0]['id_item'];
                                    }
                                    else
                                    {
                                        if($hba_item==null)
                                        {
                                            $error .="Data item tidak ada di Database jadi HBA perlu diisi dibaris".$i;
                                            break;
                                        }
                                        if($harga_item==null)
                                        {
                                            $error .="Data item tidak ada di Database jadi Harga Item perlu diisi dibaris".$i;
                                            break;
                                        }
                                        $datanya=array('nama_item'=>$nama_item,'idjns_item'=>'1','hba_item'=>$hba_item,'harga_item'=>$harga_item,'frm_item'=>$formularium_item,'oral_item'=>$oral_item,'entri_item'=>'otomatis');
                                        $this->m_item->insert_item($datanya);
                                        $cari_item=$this->m_tran_dak->caritagihan($nama_item,1);
                                        $id_item=$cari_item[0]['id_item'];
                                    }
                                    

                                    if($id_item==null)
                                    {
                                        $error.="Tidak ada Item dibaris".$i;
                                        break;
                                    }




                                    if($dosis!=null)
                                    {
                                        $caridosis = $this->m_tran_dak->caridosis($dosis);
                                        if($caridosis)
                                        {
                                            //$row = $caridosis->row();
                                            //$id_dosis=$row->id_dosis;
                                            $id_dosis=$caridosis[0]['id_dosis'];

                                        }
                                        else
                                        {
                                            $query = $this->m_tran_dak->get_id_dosis();
                                            if( ! empty($query) )
                                            {
                                            $row = $query->row();
                                            $id=$row->id_dosis+1;
                                            $pesan .="id_dosis".$id;
                                            $pesan .="dosis".$dosis;
                                            $datadosis=array('id_dosis'=>$id,'nama_dosis'=>$dosis);
                                            $pesan .="Insert master Dosis";
                                            $this->m_tran_dak->simpan_dosis($datadosis);
                                            $id_dosis=$id;
                                            }
                                        }
                                        $dataitemdosis = array('id_item'=>$id_item,'id_dosis'=>$id_dosis,'id_transaksi'=>$id_transaksi);
                                        //$pesan .="Insert Item Dosis";
                                        $query4 = $this->m_tran_dak->simpan_item_dosis($dataitemdosis);

                                    }
                                    

                                    //$pesan .="id_dosis".$id_dosis;
                                    
                                    //$pesan .="id_diagnosa = ".$id_diagnosa;

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
                                    
                                    if($error=='')
                                    {
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

                                    //$pesan .="item".$id_transaksi."setujui".$disetujui."Harga Satu".$hrg_satuan."JML".$jml."formularium".$formularium_item.$id_item;
                                    //$dataitemtransaksi=array('id_transaksi'=>$id_transaksi,'disetujui'=>$disetujui,'id_item'=>$id_item,'total'=>$total);
                                    $dataitemtransaksi=array('id_transaksi'=>$id_transaksi,'disetujui'=>$disetujui,'jumlah'=>$jml,'racikan'=>$formularium_item,'id_item'=>$id_item,'total'=>$total,'id_rekomendasi'=>$id_rekomendasi);
                                    //$pesan .="Insert Item Transaksi";
                                    $insertitem=$this->m_tran_dak->simpan_item_transaksi($dataitemtransaksi);
                                    }

                                  
                                 
                                    if($jns_kunjungan != null)
                                    {
                                       $cariidjns_kunjungan=$this->m_tran_dak->getIdjnskunjungan($jns_kunjungan);
                                       if($cariidjns_kunjungan)
                                       {
                                           $idjns_kunjungan=$cariidjns_kunjungan['0']['idjenis_kunjungan'];
                                       }
                                       else
                                       {
                                           $error.="Tidakk ada id jenis kunjungan";
                                       }
                                       $dataperiksadak=array('id_transaksi'=>$id_transaksi,'kondisi'=>$kondisi,'berat'=>$berat,'tinggi'=>$tinggi,'kesadaran'=>$kesadaran,'suhu'=>$suhu,'sistole'=>$sistole,'diastole'=>$diastole,'anamnesis'=>$anamnesis,'pernafasan'=>$pernafasan,'nadi'=>$nadi,'riwayat_alergi'=>$alergi,'keterangan'=>$keterangan,'idjenis_kunjungan'=>$idjns_kunjungan);
                                       $insertperiksadak=$this->m_tran_dak->simpan_transaksi_periksa($dataperiksadak);

                                    }
                                    
                                    
                                }

                                if(($id_transaksi != null) && ($diagnosa!=null))
                                    {
                                        $caridiagnosa=$this->m_tran_dak->caridiagnosa($diagnosa);
                                        if($caridiagnosa)
                                        {
                                        $id_diagnosa = $caridiagnosa[0]['id_diagnosa'];

                                        }
                                        else
                                        {
                                        $jns_penyakit = strtolower($jns_penyakit);
                                            //$pesan .=$diagnosa.$jns_penyakit;
                                        $data_diagnosa=array('nama_diagnosa'=>$diagnosa,'jenis_penyakit'=>$jns_penyakit,'kelompok_penyakit'=>'penyakit');
                                        $pesan .="Simpan Master Diagnosa";
                                        $this->m_tran_dak->simpan_diagnosa($data_diagnosa);
                                        $caridiagnosa=$this->m_tran_dak->caridiagnosa($diagnosa);
                                        $id_diagnosa = $caridiagnosa[0]['id_diagnosa'];

                                        }

                                        $pesan .=$id_transaksi."Semangat Mas Bro.".$id_diagnosa;
                                        $datatransaksidiagnosa = array('id_transaksi'=>$id_transaksi,'id_diagnosa'=>$id_diagnosa);
                                        $pesan .="Insert Item Diagnosa";
                                        $simpantransaksidiagnosa = $this->m_tran_dak->simpan_item_diagnosa($datatransaksidiagnosa);


                                    }


                                if(($sheetData[$i]['C'] != null) && ($nama_item == null))
                                {
                                    $error .="Nama Item dibaris".$i."tidak ada";
                                    break;
                                }
                                else if($nama_item==null && ($sheetData[$i]['C'])==null)
                                {

                                $pesan.="Hai";
                                break;
                                }

                                //$this->db->trans_complete();
                                //$pesan=$this->db->trans_status();

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



}