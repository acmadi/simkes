<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hasillain extends CI_Controller {
   // $kun="";
    function __construct() 
    {
        parent::__construct();
        $this->load->model(array('m_jns_item','m_rekomendasi','m_hasil_transaksi','m_view_hasillain','m_karyawan','m_tran_lain','m_tertanggung','m_item','m_dokter','m_provider','m_transaksi'));
		$this->load->helper('url'); // Load Helper URL CI
        $this->load->library(array('excel','validasi'));
        //$this->load->helper('form');
    }
    
    function index() 
    {
	$this->load->view('hasil/hasillain'); //Default di arahkan ke function grid
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



		$count = $this->m_hasil_transaksi->count_Lain($searchField,$searchString,$rayon,$wilayah,$mitra,$bulan,$tahun,$tgl1,$tgl2,$jns_tanggal);
		
		$count > 0 ? $total_pages = ceil($count/$limit) : $total_pages = 0;
		if ($page > $total_pages) $page=$total_pages;
		$start = $limit*$page - $limit;
		if($start <0) $start = 0;
		
		$data1 = $this->m_hasil_transaksi->get_Lain($searchField,$searchString, $sidx, $sord, $limit, $start,$rayon,$wilayah,$mitra,$bulan,$tahun,$tgl1,$tgl2,$jns_tanggal)->result();

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
                    $responce->rows[$i]['cell'] = array($line->id_transaksi,$line->tgl_transaksi,$line->tgl_kunjungan,$line->no_surat,$line->no_bukti,$line->buku_besar,$line->restitusi,$line->nip,$line->nama_karyawan,$line->nama_tertanggung,$line->nama_rujukan,$line->nama_dokter,$line->nama_provider,$diagnosa);

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



		$count = $this->m_hasil_transaksi->count_Lain($searchField,$searchString,$rayon,$wilayah,$mitra,$bulan,$tahun,$tgl1,$tgl2,$jns_tanggal);

		$count > 0 ? $total_pages = ceil($count/$limit) : $total_pages = 0;
		if ($page > $total_pages) $page=$total_pages;
		$start = $limit*$page - $limit;
		if($start <0) $start = 0;

		$data1 = $this->m_hasil_transaksi->get_Lain($searchField,$searchString, $sidx, $sord, $limit, $start,$rayon,$wilayah,$mitra,$bulan,$tahun,$tgl1,$tgl2,$jns_tanggal)->result();
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
                        $tulis->setCellValue('L'.$i, $line->nama_rujukan);
                        $tulis->setCellValue('M'.$i, $line->nama_dokter);
                        $tulis->setCellValue('N'.$i, $line->nama_provider);
                        $tulis->setCellValue('N'.$i, $line->nama_diagnosa);
			$i++;
		}


      	// Rename worksheet
	$this->excel->getActiveSheet()->setTitle('Transaksi Lain');


	// Set active sheet index to the first sheet, so Excel opens this as the first sheet
	$this->excel->setActiveSheetIndex(0);


	// Redirect output to a client�s web browser (Excel5)
	header('Content-Type: application/vnd.ms-excel');
	header('Content-Disposition: attachment;filename="Transaksi Lain.xls"');
	header('Cache-Control: max-age=0');

	$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
	$objWriter->save('php://output');
	//exit;
	}
        function detail($id_trans)
        {
            $data['id_tran']=$id_trans;
            $data['namafile']='hasillain';
            //$this->load->view('hasil/detailhasilapotek',$data);

	      $this->load->view('hasil/detailhasil',$data); //Default di arahkan ke function grid
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
                $count = $this->m_view_hasillain->countDiagnosa($id_trans);
		//$count = 1;
		$count > 0 ? $total_pages = ceil($count/$limit) : $total_pages = 0;
		if ($page > $total_pages) $page=$total_pages;
		$start = $limit*$page - $limit;
		if($start <0) $start = 0;

		//$data1 = $this->m_hasil_transaksi->get_Apotek($searchField,$searchString, $sidx, $sord, $limit, $start,$rayon,$wilayah,$mitra,$bulan,$tahun,$tgl1,$tgl2)->result();
                $data1 = $this->m_view_hasillain->getDiagnosa($id_trans)->result();



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
                $count = $this->m_view_hasillain->countItem($id_trans);
		//$count = 1;
		$count > 0 ? $total_pages = ceil($count/$limit) : $total_pages = 0;
		if ($page > $total_pages) $page=$total_pages;
		$start = $limit*$page - $limit;
		if($start <0) $start = 0;

		//$data1 = $this->m_hasil_transaksi->get_Apotek($searchField,$searchString, $sidx, $sord, $limit, $start,$rayon,$wilayah,$mitra,$bulan,$tahun,$tgl1,$tgl2)->result();
                $data1 = $this->m_view_hasillain->getItem($id_trans)->result_array();


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
                        $responce->rows[$i]['id_transaksi']   = $row['id_transaksi'];
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
			$responce->rows[$i]['cell'] = array($row['id_transaksi'],$row['jenis_item'],$row['nama_item'],$row['jumlah'],$row['harga_item'],$row['hrg_satuan'],null,null,$row['nama_dosis'],$row['nama_rekomendasi'],$tot);
			$i++;
		}
                $responce->userdata['jenis_item'] = 'Totals:';
                $responce->userdata['jumlah'] = $jumlah;
                $responce->userdata['harga_item'] = $tothrg_standar;
                $responce->userdata['hrg_satuan'] = $tothrg_satuan;
                $responce->userdata['total'] = $total;
		echo json_encode($responce);
	}
        function impor()
        {
            $data['data']='hasillain';
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

        $id_dokter=null;

        $id_dosis=null;
        $id_diagnosa=null;

        $error = "";
	$pesan="";
	$fileElementName = 'uploadhasillain';

        $tgl_trans="";
        $tgl_kunj="";
        $nid="";
        $penanggung="";
        $pasien ="";
        $status ="";
        $rujukan ="";
        $nama_dokter ="";
        $nama_provider ="";
        $no_bukti ="";
        $no_surat ="";
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
                                $nama_provider =$sheetData[$i]['J'];


                                $buku_besar =$sheetData[$i]['N'];
                                $tagihan =$sheetData[$i]['O'];

                                $nama_item = $sheetData[$i]['P'];
                                $formularium_item = $sheetData[$i]['Q'];
                                $oral_item = strtoupper($sheetData[$i]['R']);
                                $hba_item = $sheetData[$i]['S'];
                                $harga_item = $sheetData[$i]['T'];
                                $hrg_satuan = $sheetData[$i]['U'];

                                $jml = $sheetData[$i]['V'];
                                $disetujui = $sheetData[$i]['W'];
                                $total=$sheetData[$i]['X'];
                                $dosis=$sheetData[$i]['Z'];
                                $diagnosa=$sheetData[$i]['AC'];
                                $jns_penyakit=$sheetData[$i]['AB'];
                                $rekomendasi =$sheetData[$i]['AA'];
                                }

                                $pesan .="Jumlahhhhhh =".$jml;
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
                                      $data_pasien = $this->m_tran_lain->cek_pasien($id_karyawan,$pasien);
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
                                          $data_pasien = $this->m_tran_lain->cek_pasien($id_karyawan,$pasien);
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
                                        $tran = $this->m_tran_lain->simpan_transaksi($datatransaksi);
                                        
                                        if($tran)
                                        {

                                        if($rujukan!=null)
                                        {
                                        $datarujukan = $this->m_tran_lain->carirujukan($rujukan);
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
                                        $datadokter = $this->m_tran_lain->caridokterrujukan($nama_dokter,$id_rujukan,3);
                                        if($datadokter)
                                        {
                                        $id_dokter=$datadokter['0']['id_dokter'];
                                        }

                                        else
                                        {
                                        $datanya=array('nama_dokter'=>$nama_dokter,'gol_dokter'=>3,'kat_dokter'=>$id_rujukan);
				        $doktere=$this->m_dokter->insert_dokter($datanya);
                                        $datadokter = $this->m_tran_lain->caridokterrujukan($nama_dokter,$id_rujukan,3);
                                        $id_dokter=$datadokter['0']['id_dokter'];

                                        }
                                        $pesan .=$id_dokter;

                                        }
                                        if($id_dokter==null)
                                        {
                                            $error .="Tidak ada Nama Dokter di baris".$i;
                                            break;
                                        }


                                        if($nama_provider != null)
                                        {
                                        //$pesan .="Cari provider".$nama_provider;
                                        $dataprovider = $this->m_tran_lain->cariprovider($nama_provider);
                                        if($dataprovider)
                                        {
                                        $id_provider = $dataprovider[0]['id_provider'];
                                        //$pesan .="Ada provider".$dataprovider[0]['id_provider'];
                                        }
                                        else
                                        {
                                        $dataapotek=array('nama_provider'=>$nama_provider,'idjenis_provider'=>1);
				        $this->m_apotek->insert_apotek($dataapotek);
                                        $dataprovider = $this->m_tran_lain->cariprovider($nama_provider);
                                        $id_provider = $dataprovider[0]['id_provider'];

                                        }
                                        }
                                        if($id_provider==null)
                                        {
                                            $error.="Nama Provider dibaris".$i." tidak ada";
                                            break;
                                        }
                                        


                                        if($sheetData[$i]['M']!=null)
                                        {
                                        $restitusi =strtoupper($sheetData[$i]['M']);
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


                                        if($sheetData[$i]['K']!=null)
                                        {
                                        $no_bukti =$sheetData[$i]['K'];
                                        }
                                        if($no_bukti==null)
                                        {
                                            //$error .= "Tidak ada no bukti";
                                            //break;
                                        }
                                        if($sheetData[$i]['L']!=null)
                                        {
                                        $no_surat =$sheetData[$i]['L'];
                                        }

                                        if($buku_besar==NULL)
                                        {
                                            $error.="Tidak ada buku besar di baris".$i;
                                            break;
                                        }


                                        if($error=='')
                                        {
                                        $pesan .="insert transaksi apotek".$id_transaksi."ruj".$id_rujukan."dok".$id_dokter."apotek".$id_provider."bukti".$no_bukti."resti".$restitusi;
                                        $datatransaksiapotek =  array('id_transaksi'=>$id_transaksi,'id_rujukan'=>$id_rujukan,'id_dokter'=>$id_dokter,'id_provider'=>$id_provider,'no_bukti'=>$no_bukti,'restitusi'=>$restitusi,'no_surat'=>$no_surat);
                                        $query3 = $this->m_tran_lain->simpan_transaksi_lain($datatransaksiapotek);
                                        //Jangan lupa diaktifkan ini belum insert ke master buku besar
                                        $databuku=array('id_transaksi'=>$id_transaksi,'buku_besar'=>$buku_besar);
                                        $query4 = $this->m_tran_lain->simpan_transaksi_buku($databuku);
                                        }
                                        else
                                        {
                                        $error.="Tidak bertambah transaksi lain dibaris".$i;
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





                                    $pesan .="Cari sheetdata[".$i."][o]item = ".$nama_item;

                                    $pesan .="Tagggiihhhaaan".$tagihan;
                                    if($tagihan!=null)
                                    {
                                        $tag = $this->m_jns_item->getIdjnsitem($tagihan)->result_array();
                                        $id_tag=$tag[0]['idjns_item'];
                                        $cari_item=$this->m_tran_lain->caritagihan($nama_item,$id_tag);
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
                                        $datanya=array('nama_item'=>$nama_item,'idjns_item'=>$id_tag,'hba_item'=>$hba_item,'harga_item'=>$harga_item,'frm_item'=>$formularium_item,'oral_item'=>$oral_item,'entri_item'=>'otomatis');
                                        $this->m_item->insert_item($datanya);
                                        $cari_item=$this->m_tran_lain->caritagihan($nama_item,$id_tag);
                                        $id_item=$cari_item[0]['id_item'];
                                        }
                                    }

                                    

                                    if($id_item==null)
                                    {
                                        $error.="Tidak ada Item dibaris".$i;
                                        break;
                                    }


                                    

                                    if($dosis!=null)
                                    {
                                        $caridosis = $this->m_tran_lain->caridosis($dosis);
                                        if($caridosis)
                                        {
                                            //$row = $caridosis->row();
                                            //$id_dosis=$row->id_dosis;
                                            $id_dosis=$caridosis[0]['id_dosis'];

                                        }
                                        else
                                        {
                                            $query = $this->m_tran_lain->get_id_dosis();
                                            if( ! empty($query) )
                                            {
                                            $row = $query->row();
                                            $id=$row->id_dosis+1;
                                            $pesan .="id_dosis".$id;
                                            $pesan .="dosis".$dosis;
                                            $datadosis=array('id_dosis'=>$id,'nama_dosis'=>$dosis);
                                            $pesan .="Insert master Dosis";
                                            $this->m_tran_lain->simpan_dosis($datadosis);
                                            $id_dosis=$id;
                                            }
                                        }
                                        $dataitemdosis = array('id_item'=>$id_item,'id_dosis'=>$id_dosis,'id_transaksi'=>$id_transaksi);
                                        //$pesan .="Insert Item Dosis";
                                        $query4 = $this->m_tran_lain->simpan_item_dosis($dataitemdosis);

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

                                    $pesan .="item".$id_transaksi."setujui".$disetujui."Harga Satu".$hrg_satuan."JML".$jml."formularium".$formularium_item.$id_item;
                                    $dataitemtransaksi=array('id_transaksi'=>$id_transaksi,'disetujui'=>$disetujui,'hrg_satuan'=>$hrg_satuan,'jumlah'=>$jml,'id_item'=>$id_item,'total'=>$total,'id_rekomendasi'=>$id_rekomendasi);
                                    //$dataitemtransaksi=array('id_transaksi'=>'83','disetujui'=>'y','hrg_satuan'=>'44000','jumlah'=>'1','id_item'=>'16','total'=>'44000');
                                    //$pesan .="Insert Item Transaksi";
                                    $insertitem=$this->m_tran_lain->simpan_item_transaksi($dataitemtransaksi);
                                    }
                                    

                                }

                                if(($id_transaksi != null) && ($diagnosa!=null))
                                    {
                                        $caridiagnosa=$this->m_tran_lain->caridiagnosa($diagnosa);
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
                                        $this->m_tran_lain->simpan_diagnosa($data_diagnosa);
                                        $caridiagnosa=$this->m_tran_lain->caridiagnosa($diagnosa);
                                        $id_diagnosa = $caridiagnosa[0]['id_diagnosa'];

                                        }

                                        //$pesan .=$id_transaksi."Semangat Mas Bro.".$id_diagnosa;
                                        $datatransaksidiagnosa = array('id_transaksi'=>$id_transaksi,'id_diagnosa'=>$id_diagnosa);
                                        $pesan .="Insert Item Diagnosa";
                                        $simpantransaksidiagnosa = $this->m_tran_lain->simpan_item_diagnosa($datatransaksidiagnosa);


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

        function cruddiagnosa()
        {
                $oper=$this->input->post('oper');
		$id=$this->input->post('id');


	    switch ($oper)
		{
	        case 'del':
	           $this->m_tran_lain->delete_diagnosa($id);
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
            $this->m_tran_lain->simpan_diagnosa($data);
            $id_diag=$this->m_tran_lain->get_id_diagnosa();
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
            $query2 = $this->m_tran_lain->simpan_item_diagnosa($data2);
                if($query2){
                    echo "sukses";
                } else {
                    echo "gagal";
                }
            }
    }

    function plusitem($idtrans)
        {
              $data['modul']="lain";
              $data['idtrans']=$idtrans;
	      $this->load->view('hasil/plusitem',$data); //Default di arahkan ke function grid
        }


}