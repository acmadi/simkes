<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hasilkunjunganrs extends CI_Controller {
   // $kun="";
    function __construct() 
    {
        parent::__construct();
        $this->load->model(array('m_hasil_transaksi','m_transaksi','m_karyawan','m_tran_kunjunganrs','m_tertanggung','m_item','m_dokter'));
		$this->load->helper('url'); // Load Helper URL CI
        $this->load->library(array('excel','validasi'));
        //$this->load->helper('form');
    }
    
    function index() 
    {
	$this->load->view('hasil/hasilkunjunganrs'); //Default di arahkan ke function grid
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



		$count = $this->m_hasil_transaksi->count_Kunjunganrs($searchField,$searchString,$rayon,$wilayah,$mitra,$bulan,$tahun,$tgl1,$tgl2,$jns_tanggal);

		$count > 0 ? $total_pages = ceil($count/$limit) : $total_pages = 0;
		if ($page > $total_pages) $page=$total_pages;
		$start = $limit*$page - $limit;
		if($start <0) $start = 0;

		$data1 = $this->m_hasil_transaksi->get_Kunjunganrs($searchField,$searchString, $sidx, $sord, $limit, $start,$rayon,$wilayah,$mitra,$bulan,$tahun,$tgl1,$tgl2,$jns_tanggal)->result();
	
		$responce->page = $page;
		$responce->total = $total_pages;
		$responce->records = $count;
		$i=0;
		foreach($data1 as $line)
		{
			$responce->rows[$i]['id_transaksi']   = $line->id_transaksi;
			
			$responce->rows[$i]['cell'] = array($line->id_transaksi,$line->tgl_transaksi,$line->tgl_masuk,$line->tgl_keluar,'nomor RM',$line->nip,$line->nama_karyawan,$line->nama_tertanggung,$line->nama_provider,$line->diagnosa_masuk,$line->kondisi,$line->dokter_rawat,$line->nama_dokter,$line->tindakan,$line->jenis_jml_obat);
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

		$count = $this->m_hasil_transaksi->count_Kunjunganrs($searchField,$searchString,$rayon,$wilayah,$mitra,$bulan,$tahun,$tgl1,$tgl2,$jns_tanggal);

		$count > 0 ? $total_pages = ceil($count/$limit) : $total_pages = 0;
		if ($page > $total_pages) $page=$total_pages;
		$start = $limit*$page - $limit;
		if($start <0) $start = 0;

		$data1 = $this->m_hasil_transaksi->get_Kunjunganrs($searchField,$searchString, $sidx, $sord, $limit, $start,$rayon,$wilayah,$mitra,$bulan,$tahun,$tgl1,$tgl2,$jns_tanggal)->result();
                $tulis=$this->excel->setActiveSheetIndex(0);

                        $tulis->setCellValue('A1', 'NO');
                        $tulis->setCellValue('B1', "ID TRANSAKSI");
                        $tulis->setCellValue('C1', "TGL TRANSAKSI");
                        $tulis->setCellValue('D1', "TGL MASUK");
                        $tulis->setCellValue('E1', "TGL KELUAR");
                        $tulis->setCellValue('F1', "No RM");
                        $tulis->setCellValue('G1', "NIP");
                        $tulis->setCellValue('H1', "Penanggung");
                        $tulis->setCellValue('I1', "Pasien");
                        $tulis->setCellValue('J1', "Provider");
                        $tulis->setCellValue('K1', "Diagnosa");
                        $tulis->setCellValue('L1', "Kondisi");
                        $tulis->setCellValue('M1', "Jenis Rawat");
                        $tulis->setCellValue('N1', "Dokter");
                        $tulis->setCellValue('O1', "Tindakan");
                        $tulis->setCellValue('P1', "Jumlah");


        $i=2;
        foreach($data1 as $line)
		{
			$tulis->setCellValue('A'.$i, $i-1);
                        $tulis->setCellValue('B'.$i, $line->id_transaksi);
                        $tulis->setCellValue('C'.$i, $line->tgl_transaksi);
                        $tulis->setCellValue('D'.$i, $line->tgl_masuk);
                        $tulis->setCellValue('E'.$i, $line->tgl_keluar);
                        $tulis->setCellValue('F'.$i, "No RM");
                        $tulis->setCellValue('G'.$i, $line->nip);
                        $tulis->setCellValue('H'.$i, $line->nama_karyawan);
                        $tulis->setCellValue('I'.$i, $line->nama_tertanggung);
                        $tulis->setCellValue('J'.$i, $line->nama_provider);
                        $tulis->setCellValue('K'.$i, $line->diagnosa_masuk);
                        $tulis->setCellValue('L'.$i, $line->kondisi);
                        $tulis->setCellValue('M'.$i, $line->dokter_rawat);
                        $tulis->setCellValue('N'.$i, $line->nama_dokter);
                        $tulis->setCellValue('O'.$i, $line->tindakan);
                        $tulis->setCellValue('P'.$i, $line->jenis_jml_obat);
			$i++;
		}


      	// Rename worksheet
	$this->excel->getActiveSheet()->setTitle('Transaksi Lain');


	// Set active sheet index to the first sheet, so Excel opens this as the first sheet
	$this->excel->setActiveSheetIndex(0);


	// Redirect output to a client�s web browser (Excel5)
	header('Content-Type: application/vnd.ms-excel');
	header('Content-Disposition: attachment;filename="Master Rumah Sakit.xls"');
	header('Cache-Control: max-age=0');

	$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
	$objWriter->save('php://output');
	//exit;
	}

        function impor()
        {
            $data['data']='hasilkunjunganrs';
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

        $error = "";
	$pesan="";
	$fileElementName = 'uploadhasilkunjunganrs';

        $tgl_trans="";
        $tgl_kunj="";
        $nid="";
        $penanggung="";
        $pasien ="";
        $status ="";
        $rujukan ="";
        $nama_dokter ="";
        $nama_provider ="";
        $no_surat ="";
        $tgl_masuk ="";
        $tgl_keluar ="";
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
        $jns_penyakit = "";
        $post_biaya ="";

        $diagnosa_masuk=null;
        $kondisi=null;
        $dokter_rawat=null;
        $jns_jml_obat=null;
        $tindakan=null;

                                

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
                                $id_karyawan=null;
                                $id_pasien=null;
                                $id_rujukan=null;
                                $id_dokter=null;
                                $id_provider=null;
                                $id_item=null;


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

                                $nama_dokter =$sheetData[$i]['H'];
                                $nama_provider =$sheetData[$i]['I'];
                                }
                                if($error=='')
                                {
                                   

                                if($sheetData[$i]['C'] != null)
                                {
                                 
                                $pesan .="tgl_transaksi = ".$sheetData[$i]['C']." tglx";
                                    if(($sheetData[$i]['C'])!= null)
                                    { //Cari ID_KARYAWAN
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
                                      $data_pasien = $this->m_tran_kunjunganrs->cek_pasien($id_karyawan,$pasien);
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
                                          $data_pasien = $this->m_tran_kunjunganrs->cek_pasien($id_karyawan,$pasien);
                                          $id_pasien = $data_pasien[0]['id_tertanggung'];
                                          //$pesan .="tidak ada data pasien".$pasien.$id_karyawan.$status.$error;
                                      }
                                      }

                                      if($id_pasien==null)
                                      {
                                          $error .="Tidak Ada Nama Pasien di baris".$i;
                                          break;
                                      }
                                        $tgl_trans = $this->tanggal($sheetData[$i]['C']);
                                        $tgl_kunj = $this->tanggal($sheetData[$i]['B']);
                                        $maxid= $this->m_transaksi->get_maxid();
                                        $id_transaksi=$maxid[0]['id_transaksi']+1;
                                        $datatransaksi = array('id_transaksi'=>$id_transaksi,'id_tertanggung'=>$id_pasien,'tgl_transaksi'=>$tgl_trans,'tgl_kunjungan'=>$tgl_kunj);
                                        $tran = $this->m_tran_kunjunganrs->simpan_transaksi($datatransaksi);
                                       
                                        if($tran)
                                        {
                                        if($nama_dokter != null)
                                        {
                                        $pesan .="Cari Dokter";
                                        $datadokter = $this->m_tran_kunjunganrs->caridokter($nama_dokter);
                                        if($datadokter)
                                        {
                                        $id_dokter=$datadokter['0']['id_dokter'];
                                        }
                                        else
                                        {
                                        $datanya=array('nama_dokter'=>$nama_dokter);
				        $doktere=$this->m_dokter->insert_dokter($datanya);
                                        $datadokter = $this->m_tran_kunjunganrs->caridokter($nama_dokter);
                                        $id_dokter=$datadokter['0']['id_dokter'];
                                        }
                                        }
                                        if($id_dokter==null)
                                        {
                                            $error .="Tidak ada Nama Dokter di baris".$i;
                                            break;
                                        }
                                        $pesan .="Nama Provider ".$nama_provider;
                                        if($nama_provider != null)
                                        {
                                        $dataprovider = $this->m_tran_kunjunganrs->carirs($nama_provider);
                                        if($dataprovider)
                                        {
                                        $id_provider = $dataprovider[0]['id_provider'];
                                        }
                                        else
                                        {
                                        $dataapotek=array('nama_provider'=>$nama_provider,'idjenis_provider'=>5);
				        $this->m_tran_kunjunganrs->simpan_provider($dataapotek);
                                        $dataprovider = $this->m_tran_kunjunganrs->carirs($nama_provider);
                                        $id_provider = $dataprovider[0]['id_provider'];
                                        }
                                        }
                                        if($id_provider==null)
                                        {
                                            $error.="Nama Rumah Sakit dibaris".$i." tidak ada";
                                            break;
                                        }
                                        if($sheetData[$i]['J']!=null)
                                        {
                                        $no_surat =$sheetData[$i]['J'];
                                        }
                                        if($no_surat==null)
                                        {
                                        }
                                        if($sheetData[$i]['K']!=null)
                                        {
                                        $tgl_masuk =$this->tanggal($sheetData[$i]['K']);
                                        $pesan .="tgl Masuk".$tgl_masuk;
                                        }

                                        if($sheetData[$i]['L']!=null)
                                        {
                                        $tgl_keluar =$this->tanggal($sheetData[$i]['L']);
                                        $pesan .="tgl Keluar".$tgl_keluar;
                                        }
                                        if($error == '')
                                        {
                                        $datatransaksikunjunganrs =  array('id_transaksi'=>$id_transaksi,'id_provider'=>$id_provider,'no_surat'=>$no_surat,'tgl_masuk'=>$tgl_masuk,'tgl_keluar'=>$tgl_keluar);
                                        $query3 = $this->m_tran_kunjunganrs->simpan_trans_kunjungan($datatransaksikunjunganrs);
                                        }
                                        else
                                        {
                                        $error.="Tidak bertambah kunjungan rs dibaris".$i;
                                        break;
                                        }

                                        }
                                        else
                                        {
                                            $error .="Tidak bertambah transaksi";
                                        }

                                    }
                                    if($sheetData[$i]['M'] != null)
                                    {
                                        $diagnosa_masuk =$sheetData[$i]['M'];
                                    }
                                    if($sheetData[$i]['N']!=null)
                                    {
                                        $kondisi =$sheetData[$i]['N'];
                                    }
                                    if($sheetData[$i]['O']!=null)
                                    {
                                        $dokter_rawat =$sheetData[$i]['O'];
                                    }

                                    if($sheetData[$i]['P']!=null)
                                    {
                                        $jns_jml_obat =$sheetData[$i]['P'];
                                    }

                                    if($sheetData[$i]['Q']!=null)
                                    {
                                        $tindakan =$sheetData[$i]['Q'];
                                    }

                                    if($error == null)
                                    {
                                    $dataperiksa=array('id_transaksi'=>$id_transaksi,'diagnosa_masuk'=>$diagnosa_masuk,'kondisi'=>$kondisi,'dokter_rawat'=>$dokter_rawat,'jenis_jml_obat'=>$jns_jml_obat,'tindakan'=>$tindakan,'id_dokter'=>$id_dokter);
                                    $insertperiksakunjungan=$this->m_tran_kunjunganrs->simpan_trans_periksa($dataperiksa);
                                    }
 
                                }
                                /*else if($sheetData[$i]['C'] != null)
                                {
                                    $error .="Nama Item dibaris".$i."tidak ada";
                                    break;
                                }
                                 * 
                                 */
                                else if($nama_item==null && ($sheetData[$i]['C'])==null)
                                {
                                $pesan.="Hai";
                                break;
                                }

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