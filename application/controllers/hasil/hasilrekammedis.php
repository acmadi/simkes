<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hasilrekammedis extends CI_Controller {
   // $kun="";
    function __construct() 
    {
        parent::__construct();
        $this->load->model(array('m_hasil_transaksi','m_karyawan','m_tran_rekam_medis','m_transaksi'));
		$this->load->helper('url'); // Load Helper URL CI
        $this->load->library(array('excel','validasi'));
        //$this->load->helper('form');
    }
    
    function index() 
    {
	$this->load->view('hasil/hasilrekammedis'); //Default di arahkan ke function grid
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



		$count = $this->m_hasil_transaksi->count_Rm($searchField,$searchString,$rayon,$wilayah,$mitra,$bulan,$tahun,$tgl1,$tgl2,$jns_tanggal);

		$count > 0 ? $total_pages = ceil($count/$limit) : $total_pages = 0;
		if ($page > $total_pages) $page=$total_pages;
		$start = $limit*$page - $limit;
		if($start <0) $start = 0;

		$data1 = $this->m_hasil_transaksi->get_Rm($searchField,$searchString, $sidx, $sord, $limit, $start,$rayon,$wilayah,$mitra,$bulan,$tahun,$tgl1,$tgl2,$jns_tanggal)->result();
	
		$responce->page = $page;
		$responce->total = $total_pages;
		$responce->records = $count;
		$i=0;
		foreach($data1 as $line)
		{
			$responce->rows[$i]['id_transaksi']   = $line->id_transaksi;
			
			$responce->rows[$i]['cell'] = array($line->id_transaksi,$line->tgl_transaksi,$line->tgl_masuk,$line->tgl_keluar,$line->no_rm,$line->nip,$line->nama_karyawan,$line->nama_tertanggung,$line->nama_provider,$line->diagnosa_masuk,$line->diagnosa_keluar,$line->riwayat,$line->periksa_fisik,$line->hasil_lab,$line->hasil_rontgen,$line->hasil_lain,$line->progres_harian,$line->pasca_rawat,$line->tindakan);
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



		$count = $this->m_hasil_transaksi->count_Rm($searchField,$searchString,$rayon,$wilayah,$mitra,$bulan,$tahun,$tgl1,$tgl2,$jns_tanggal);

		$count > 0 ? $total_pages = ceil($count/$limit) : $total_pages = 0;
		if ($page > $total_pages) $page=$total_pages;
		$start = $limit*$page - $limit;
		if($start <0) $start = 0;

		$data1 = $this->m_hasil_transaksi->get_Rm($searchField,$searchString, $sidx, $sord, $limit, $start,$rayon,$wilayah,$mitra,$bulan,$tahun,$tgl1,$tgl2,$jns_tanggal)->result();
                $tulis=$this->excel->setActiveSheetIndex(0);

                        $tulis->setCellValue('A1', 'NO');
                        $tulis->setCellValue('B1', "ID TRANSAKSI");
                        $tulis->setCellValue('C1', "TGL TRANSAKSI");
                        $tulis->setCellValue('D1', "TGL MASUK");
                        $tulis->setCellValue('E1', "TGL KELUAR");
                        $tulis->setCellValue('F1', "NIP");
                        $tulis->setCellValue('G1', "Penanggung");
                        $tulis->setCellValue('H1', "Pasien");
                        $tulis->setCellValue('I1', "Provider");
                        $tulis->setCellValue('J1', "Diagnosa Masuk");
                        $tulis->setCellValue('K1', "Diagnosa Keluar");
                        $tulis->setCellValue('L1', "Riwayat");
                        $tulis->setCellValue('M1', "Periksa Fisik");
                        $tulis->setCellValue('N1', "Hasil Lab");
                        $tulis->setCellValue('O1', "Rontgen");
                        $tulis->setCellValue('P1', "Hasil Lain");
                        $tulis->setCellValue('Q1', "Progres Harian");
                        $tulis->setCellValue('R1', "Pasca Rawat");
                        $tulis->setCellValue('S1', "Tindakan");


        $i=2;
        foreach($data1 as $line)
		{
			$tulis->setCellValue('A'.$i, $i-1);
                        $tulis->setCellValue('B'.$i, $line->id_transaksi);
                        $tulis->setCellValue('C'.$i, $line->tgl_transaksi);
                        $tulis->setCellValue('D'.$i, $line->tgl_masuk);
                        $tulis->setCellValue('E'.$i, $line->tgl_keluar);
                        $tulis->setCellValue('F'.$i, $line->nip);
                        $tulis->setCellValue('G'.$i, $line->nama_karyawan);
                        $tulis->setCellValue('H'.$i, $line->nama_tertanggung);
                        $tulis->setCellValue('I'.$i, $line->nama_provider);
                        $tulis->setCellValue('J'.$i, $line->diagnosa_masuk);
                        $tulis->setCellValue('K'.$i, $line->diagnosa_keluar);
                        $tulis->setCellValue('L'.$i, $line->riwayat);
                        $tulis->setCellValue('M'.$i, $line->periksa_fisik);
                        $tulis->setCellValue('N'.$i, $line->hasil_lab);
                        $tulis->setCellValue('O'.$i, $line->hasil_rontgen);
                        $tulis->setCellValue('P'.$i, $line->hasil_lain);
                        $tulis->setCellValue('Q'.$i, $line->progres_harian);
                        $tulis->setCellValue('R'.$i, $line->pasca_rawat);
                        $tulis->setCellValue('S'.$i, $line->tindakan);
			$i++;
		}


      	// Rename worksheet
	$this->excel->getActiveSheet()->setTitle('Transaksi Lain');


	// Set active sheet index to the first sheet, so Excel opens this as the first sheet
	$this->excel->setActiveSheetIndex(0);


	// Redirect output to a client�s web browser (Excel5)
	header('Content-Type: application/vnd.ms-excel');
	header('Content-Disposition: attachment;filename="Master Rekam Medist.xls"');
	header('Cache-Control: max-age=0');

	$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
	$objWriter->save('php://output');
	//exit;
	}

        function impor()
        {
            $data['data']='hasilrekammedis';
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

        $error = "";
	$pesan="";
	$fileElementName = 'uploadhasilrekammedis';

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
                                $restitusi = null;
                                $id_item=null;


                                $hba_item = "";
                                $harga_item ="";
                                $hrg_satuan ="";

                                $pesan.="Membaca sheetdata[".$i."][O]";
                                $pesan.=$sheetData[$i]['O'];
                                if(!$this->validasi->cekLengthString($sheetData[$i]['E'],45))
                                {
                                $error="Data NID di baris ke".$i." terlalu Banyak";
                                }
                                else if(!$this->validasi->cekLengthString($sheetData[$i]['F'],200))
                                {
                                $error="Data Nama Karyawan di baris ke".$i." terlalu Banyak";
                                }
                                else if(!$this->validasi->cekLengthString($sheetData[$i]['G'],100))
                                {
                                $error="Data Nama Pasien di baris ke".$i." terlalu Banyak";
                                }
                                else if(!$this->validasi->cekLengthString($sheetData[$i]['H'],20))
                                {
                                $error="Data Status di baris ke".$i." yang boleh hanya anak, ybs, istri";
                                }

                                else
                                {

                                $tgl_masuk =  $this->tanggal($sheetData[$i]['D']);
                                $tgl_kunjungan =  $this->tanggal($sheetData[$i]['C']);
                                $nid =  $sheetData[$i]['E'];
                                $penanggung=$sheetData[$i]['F'];
                                $pasien =$sheetData[$i]['G'];
                                $status =$sheetData[$i]['H'];
                                $nama_provider =$sheetData[$i]['I'];
                                $no_rm =$sheetData[$i]['J'];


                                $diag_masuk =strtolower($sheetData[$i]['K']);
                                $jnspenyakit_masuk =strtolower($sheetData[$i]['L']);
                                $diag_keluar =strtolower($sheetData[$i]['M']);
                                $jnspenyakit_keluar =strtolower($sheetData[$i]['N']);
                                $riwayat =$sheetData[$i]['O'];
                                $fisik =$sheetData[$i]['P'];
                                $hasil_lab =$sheetData[$i]['Q'];
                                $hasil_rontgen =$sheetData[$i]['R'];
                                $hasil_lain =$sheetData[$i]['S'];
                                $progres_harian =$sheetData[$i]['T'];
                                $pasca_rawat =$sheetData[$i]['U'];
                                $tindakan =$sheetData[$i]['V'];

                                }


                                if($error=='')
                                {
                                
                                    if(($sheetData[$i]['C'])!= null)
                                    {
                                      //Cari ID_KARYAWAN

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
                                      $data_pasien = $this->m_tran_rekam_medis->cek_pasien($id_karyawan,$pasien);
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
                                          $data_pasien = $this->m_tran_rekam_medis->cek_pasien($id_karyawan,$pasien);
                                          $id_pasien = $data_pasien[0]['id_tertanggung'];

                                          //$pesan .="tidak ada data pasien".$pasien.$id_karyawan.$status.$error;
                                      }
                                      }

                                      if($id_pasien==null)
                                      {
                                          $error .="Tidak Ada Nama Pasien di baris".$i;
                                          break;
                                      }


                                      

                                        //$tgl_trans = $sheetData[$i]['B'];
                                        $tgl_trans = $this->tanggal($sheetData[$i]['B']);
                                        $tgl_kunj = $this->tanggal($sheetData[$i]['C']);
                                        //$pesan .="tes".$tgl_trans.$id_pasien;
                                        $maxid= $this->m_transaksi->get_maxid();
                                        //$pesan .="maxid".$maxid[0]['id_transaksi'];
                                        $id_transaksi=$maxid[0]['id_transaksi']+1;
                                        //$pesan .="idtransaksi".$id_transaksi;
                                        $datatransaksi = array('id_transaksi'=>$id_transaksi,'id_tertanggung'=>$id_pasien,'tgl_transaksi'=>$tgl_trans,'tgl_kunjungan'=>$tgl_kunj);
                                        $tran = $this->m_tran_rekam_medis->simpan_transaksi($datatransaksi);
                                       
                                        if($tran)
                                        {
                                        
                                        

                                        if($nama_provider != null)
                                        {
                                        //$pesan .="Cari provider".$nama_provider;
                                        $dataprovider = $this->m_tran_rekam_medis->carirs($nama_provider);
                                        if($dataprovider)
                                        {
                                        $id_provider = $dataprovider[0]['id_provider'];
                                        //$pesan .="Ada provider".$dataprovider[0]['id_provider'];
                                        }
                                        else
                                        {
                                        $dataapotek=array('nama_provider'=>$nama_provider,'idjenis_provider'=>5);
				        $this->m_tran_rekam_medis->simpan_provider($dataapotek);
                                        $dataprovider = $this->m_tran_rekam_medis->carirs($nama_provider);
                                        $id_provider = $dataprovider[0]['id_provider'];

                                        }
                                        }
                                        if($id_provider==null)
                                        {
                                            $error.="Nama Provider dibaris".$i." tidak ada";
                                            break;
                                        }
                                        


                                        



                                        if($error=='')
                                        {
                                        $pesan .="id_transaksi".$id_transaksi.",tgl_masuk".$tgl_masuk.",no_kamar".$no_rm.",id_provider".$id_provider;
                                        $datatransaksirm =  array('id_transaksi'=>$id_transaksi,'tgl_masuk'=>$tgl_masuk,'no_kamar'=>$no_rm,'id_provider'=>$id_provider);
                                        $query3 = $this->m_tran_rekam_medis->simpan_trans_rekam($datatransaksirm);
                                        
                                        }
                                        else
                                        {
                                        $error.="Tidak bertambah transaksi rekam medis dibaris".$i;
                                        break;
                                        }

                                        
                                        }
                                        else
                                        {
                                            $error .="Tidak bertambah transaksi";
                                        }

                                    

                                        



                                    
                                    //$pesan .="id_dosis".$id_dosis;
                                    $pesan .="diag_masuk".$diag_masuk;
                                    if($diag_masuk!=null)
                                    {
                                        $caridiagnosa=$this->m_tran_rekam_medis->caridiagnosa($diag_masuk);
                                        if($caridiagnosa)
                                        {
                                        $id_diagnosa_masuk = $caridiagnosa[0]['id_diagnosa'];
                                        }
                                        else
                                        {
                                        
                                        $data_diagnosa=array('nama_diagnosa'=>$diagnosa,'jenis_penyakit'=>$jnspenyakit_masuk,'kelompok_penyakit'=>'penyakit');
                                        $pesan .="Simpan Master Diagnosa";
                                        $this->m_tran_rekam_medis->simpan_diagnosa($data_diagnosa);
                                        $caridiagnosa=$this->m_tran_rekam_medis->caridiagnosa($diag_masuk);
                                        $id_diagnosa_masuk = $caridiagnosa[0]['id_diagnosa'];
                                        }
                                    }
                                    
                                    if($diag_keluar!=null)
                                    {
                                        $caridiagnosa=$this->m_tran_rekam_medis->caridiagnosa($diag_keluar);
                                        if($caridiagnosa)
                                        {
                                        $id_diagnosa_keluar = $caridiagnosa[0]['id_diagnosa'];
                                        }
                                        else
                                        {
                                        $data_diagnosa=array('nama_diagnosa'=>$diagnosa,'jenis_penyakit'=>$jnspenyakit_keluar,'kelompok_penyakit'=>'penyakit');
                                        $pesan .="Simpan Master Diagnosa";
                                        $this->m_tran_rekam_medis->simpan_diagnosa($data_diagnosa);
                                        $caridiagnosa=$this->m_tran_rekam_medis->caridiagnosa($diag_keluar);
                                        $id_diagnosa_keluar = $caridiagnosa[0]['id_diagnosa'];
                                        }
                                    }

                                  
                                    if($error=='')
                                    {
                                    $dataitemtransaksi=array('id_transaksi'=>$id_transaksi,'diagnosa_masuk'=>$diag_masuk,'diagnosa_keluar'=>$diag_keluar,'riwayat'=>$riwayat,'periksa_fisik'=>$fisik,'hasil_lab'=>$hasil_lab,'hasil_rontgen'=>$hasil_rontgen,'hasil_lain'=>$hasil_lain,'progres_harian'=>$progres_harian,'pasca_rawat'=>$pasca_rawat,'tindakan'=>$tindakan);
                                    //$pesan .="Insert Item Transaksi";
                                    $insertitem=$this->m_tran_rekam_medis->simpan_trans_periksa($dataitemtransaksi);
                                    }
                                    
                                    

                                }
                                else if($sheetData[$i]['C'] != null)
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