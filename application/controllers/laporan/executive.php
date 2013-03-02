<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Executive extends CI_Controller {
   // $kun="";
   

    function __construct()
    {
        parent::__construct();
        $this->load->model(array('m_laporan','m_transaksi','m_diagnosa','m_item','m_apotek','m_transaksi','m_hasil_transaksi','m_dokter'));
        $this->load->helper('url'); // Load Helper URL CI
        $this->load->library(array('excel'));
        //$this->load->helper('form');
    }


   
    
        function index()
        {
	$this->load->view('laporan/executive'); //Default di arahkan ke function grid

 	//$id= $this->session->userdata('id_user');
        
    //echo "Semangat";
	}
        function dokter_keluarga()
        {
            $data['bulan'] = $this->input->get('bulan');
            $data['tahun'] = $this->input->get('tahun');
            $this->load->view('laporan/executive_dk',$data);

        }

        function getPpk()
        {
            $jns_tanggal="tgl_transaksi";
            $bulan = $this->input->get('bulan');
            $tahun = $this->input->get('tahun');
            $rayon=$this->session->userdata('id_rayon');
            $wilayah=$this->session->userdata('id_wilayah');
            $mitra=$this->session->userdata('id_mitra');
            $tgl1=null;
            $tgl2=null;
            $limit=10;
            $start=0;
            $sidx='id_transaksi';
            $sord='asc';
            $searchField=null;
            $searchString=null;
            $data1 = $this->m_hasil_transaksi->get_Dak($searchField,$searchString, $sidx, $sord, $limit, $start,$rayon,$wilayah,$mitra,$bulan,$tahun,$tgl1,$tgl2,$jns_tanggal)->result();


            $konsultasi = 0;
            $berobat = 0;
            $proaktif = 0;
            $jam24=0;
            $kun_rmh =0;
            $kun_rs = 0;
            
            foreach($data1 as $line)
            {
                if($line->idjenis_kunjungan == 1)
                {
                    $konsultasi += 1;
                }
                else if($line->idjenis_kunjungan == 2)
                {
                    $berobat += 1;
                }
                else if($line->idjenis_kunjungan == 3)
                {
                    $proaktif += 1;
                }
                else if($line->idjenis_kunjungan == 4)
                {
                    $jam24 += 1;
                }
                else if($line->idjenis_kunjungan == 5)
                {
                    $kun_rmh += 1;
                }
                else if($line->idjenis_kunjungan == 6)
                {
                    $kun_rs += 1;
                }
            } 
        

            echo "<graph caption='' canvasBorderColor='333333' animation='1' numdivlines='4' showNames='1' showValues='0' chartLeftMargin='5' chartRightMargin='5'  chartTopMargin='5' showLegend='0' showAnchors='0' rotateNames='1' formatNumberScale='1' decimalPrecision='2' formatNumber='0' yAxisName='Jumlah' xAxisName='' divLineColor='CCCCCC'  showAlternateHGridColor='1'>";
            echo "<set name='Konsultasi' value='".$konsultasi."' color='AFD8F8'/>";
            echo "<set name='Berobat' value='".$berobat."' color='AFD8F8'/>";
            echo "<set name='Proaktif' value='".$proaktif."' color='AFD8F8'/>";
            echo "<set name='24 Jam' value='".$jam24."' color='AFD8F8'/>";
            echo "<set name='Kunjungan Rumah' value='".$kun_rmh."' color='AFD8F8'/>";
            echo "<set name='Kunjungan RS' value='".$kun_rs."' color='AFD8F8'/>";
            echo "</graph>";
        }

        function getPotretkunjungan()
        {
            $bulan = $this->input->get('bulan');
            $tahun = $this->input->get('tahun');
            $rayon=$this->session->userdata('id_rayon');
            $wilayah=$this->session->userdata('id_wilayah');
            $mitra=$this->session->userdata('id_mitra');

            $rawatinap = $this->m_item->get_rawatinap($rayon,$wilayah,$mitra,$bulan,$tahun)->result_array();
            $jmlrawatinap = $rawatinap[0]['jumlah'];
            $dak = $this->m_item->get_dak($rayon,$wilayah,$mitra,$bulan,$tahun)->result_array();
            $jmldak = $dak[0]['jumlah'];
            $restitusi = $this->m_item->get_restitusi($rayon,$wilayah,$mitra,$bulan,$tahun)->result_array();
            $jmlrestitusi = $restitusi[0]['jumlah'];
            $spesialis = $this->m_item->get_spesialis($rayon,$wilayah,$mitra,$bulan,$tahun)->result_array();
            $jmlspesialis = $spesialis[0]['jumlah'];

            echo "<graph caption='' canvasBorderColor='333333' animation='1' numdivlines='4' showNames='1' showValues='0' chartLeftMargin='5' chartRightMargin='5'  chartTopMargin='5' showLegend='0' showAnchors='0' rotateNames='1' formatNumberScale='1' decimalPrecision='2' formatNumber='0' yAxisName='Jumlah' xAxisName='' divLineColor='CCCCCC'  showAlternateHGridColor='1'>";
            echo "<set name='DAK' value='".$jmldak."' color='AFD8F8'/>";
            echo "<set name='Rawat Inap' value='".$jmlrawatinap."' color='AFD8F8'/>";
            echo "<set name='Restitusi' value='".$jmlrestitusi."' color='AFD8F8'/>";
            echo "<set name='Langganan' value='".$jmlrestitusi."' color='AFD8F8'/>";
            echo "<set name='Spesialis' value='".$jmlspesialis."' color='AFD8F8'/>";
            echo "</graph>";
        }

        function potret_kunjungan()
        {
            $data['bulan'] = $this->input->get('bulan');
            $data['tahun'] = $this->input->get('tahun');

            $this->load->view('laporan/executive_pk',$data);
        }

        function getBiayapotretkunjungan()
        {
            echo "<graph caption='' canvasBorderColor='333333' animation='1' numdivlines='4' showNames='1' showValues='0' chartLeftMargin='5' chartRightMargin='5'  chartTopMargin='5' showLegend='0' showAnchors='0' rotateNames='1' formatNumberScale='1' decimalPrecision='2' formatNumber='0' yAxisName='Jumlah' xAxisName='Penyakit' divLineColor='CCCCCC'  showAlternateHGridColor='1'>";
            echo "<set name='PPK I' value='62' color='AFD8F8'/>";
            echo "<set name='PPK II' value='62' color='8BBA00'/>";
            echo "<set name='PPK III' value='62' color='D64646'/>";
            echo "</graph>";
        }

        function getJumlahpotretkunjungan()
        {
            $bulan = $this->input->get('bulan');
            $tahun = $this->input->get('tahun');
            $rayon=$this->session->userdata('id_rayon');
            $wilayah=$this->session->userdata('id_wilayah');
            $mitra=$this->session->userdata('id_mitra');
            $tgl1=null;
            $tgl2=null;
            $limit=10;
            $start=0;
            $sidx='id_transaksi';
            $sord='asc';
            $searchField=null;
            $searchString=null;
            $data1 = $this->m_dokter->getDokterterbesar($searchField,$searchString, $sidx, $sord, $limit, $start,$rayon,$wilayah,$mitra,$bulan,$tahun,$tgl1,$tgl2)->result();

            $dokter=0;
            $spesialis=0;
            $rawatinap=0;


            $i=0;
            foreach($data1 as $line)
            {
                if($line->kat_dokter == 1)
                {
                    $spesialis += 1;
                }
                else if($line->kat_dokter == 6 or $line->kat_dokter == 4 )
                {
                    $rawatinap += 1;
                }
                else
                {
                    $dokter += 1 ;
                }

                $i++;
            }




            echo "<graph caption='' canvasBorderColor='333333' animation='1' numdivlines='4' showNames='1' showValues='0' chartLeftMargin='5' chartRightMargin='5'  chartTopMargin='5' showLegend='0' showAnchors='0' rotateNames='1' formatNumberScale='1' decimalPrecision='2' formatNumber='0' yAxisName='Jumlah' xAxisName='Penyakit' divLineColor='CCCCCC'  showAlternateHGridColor='1'>";
            echo "<set name='Dokter Umum, DAK, Gigi' value='".$dokter."' color='AFD8F8'/>";
            echo "<set name='Spesialis' value='".$spesialis."' color='8BBA00'/>";
            echo "<set name='Rawat Inap' value='".$rawatinap."' color='D64646'/>";
            echo "</graph>";
        }

        function penyakit_obat()
        {
            $data['bulan'] = $this->input->get('bulan');
            $data['tahun'] = $this->input->get('tahun');
            $this->load->view('laporan/executive_op',$data);

        }

        function getPenyakit()
        {
            $bulan = $this->input->get('bulan');
            $tahun = $this->input->get('tahun');
            $rayon=$this->session->userdata('id_rayon');
            $wilayah=$this->session->userdata('id_wilayah');
            $mitra=$this->session->userdata('id_mitra');

             $penyakit = $this->m_diagnosa->get_penyakitterbanyak($rayon,$wilayah,$mitra,$bulan,$tahun)->result_array();
             echo "<graph caption='' canvasBorderColor='333333' animation='1' numdivlines='4' showNames='1' showValues='0' chartLeftMargin='5' chartRightMargin='5'  chartTopMargin='5' showLegend='0' showAnchors='0' rotateNames='1' formatNumberScale='1' decimalPrecision='2' formatNumber='0' yAxisName='Jumlah' xAxisName='' divLineColor='CCCCCC'  showAlternateHGridColor='1'>";

             for ($i=0;$i<count($penyakit);$i++)
		{	//$data[] = array('label'=>$penyakit[$i]['nama_diagnosa'], 'value'=>rand(0,200));
                  echo "<set name='".$penyakit[$i]['nama_diagnosa']."' hoverText='".$penyakit[$i]['nama_diagnosa']."' value='".$penyakit[$i]['jumlah']."' color='AFD8F8'/>";

                }
                echo "</graph>";
        }

        function getObat()
        {
            $bulan = $this->input->get('bulan');
            $tahun = $this->input->get('tahun');
            $rayon=$this->session->userdata('id_rayon');
            $wilayah=$this->session->userdata('id_wilayah');
            $mitra=$this->session->userdata('id_mitra');

            $obat = $this->m_item->get_obatterbanyak($rayon,$wilayah,$mitra,$bulan,$tahun)->result_array();
           echo "<graph caption='' subcaption='' rotateNames='1' xAxisName='' yAxisMinValue='' yAxisName='Jumlah' decimalPrecision='0' numberPrefix='' showNames='1' showValues='0' showAlternateHGridColor='1' AlternateHGridColor='ff5904' divLineColor='ff5904' divLineAlpha='20' alternateHGridAlpha='5'>";
           for ($i=0;$i<count($obat);$i++)
	   {
              echo "<set name='".$obat[$i]['nama_item']."' value='".$obat[$i]['jumlah']."' hoverText='".$obat[$i]['nama_item']."'/>";
           }

         echo "</graph>";
        }

        function rincian_rirj()
        {
            $data['bulan'] = $this->input->get('bulan');
            $data['tahun'] = $this->input->get('tahun');

            $this->load->view('laporan/executive_rirj',$data);
        }

        function getRawatjalan()
        {   $alkes =0;
            $apotek=0;
            $dokter=0;
            $gigi=0;
            $kamar=0;
            $lain=0;
            $optik=0;
            $penunjang=0;
            $tindakan=0;

            $bulan = $this->input->get('bulan');;
            $tahun = $this->input->get('tahun');
            $rayon=$this->session->userdata('id_rayon');
            $wilayah=$this->session->userdata('id_wilayah');
            $mitra=$this->session->userdata('id_mitra');
            $tgl1=null;
            $tgl2=null;
            $limit=10;
            $start=0;
            $sidx='id_transaksi';
            $sord='asc';
            $searchField=null;
            $searchString=null;
            $filter=null;
            $data1 = $this->m_laporan->get_Rawatjalan2($searchField,$searchString, $sidx, $sord, $limit, $start,$rayon,$wilayah,$mitra,$bulan,$tahun,$filter,'')->result();

            foreach($data1 as $line)
		{
                    if($line->idjns_item == 1)
                    {
                        $apotek +=1;
                    }
                    else if($line->idjns_item == 2)
                    {
                        $alkes +=1;
                    }
                    else if($line->idjns_item == 3)
                    {
                        $gigi +=1;
                    }
                    else if($line->idjns_item == 4)
                    {
                        $kamar +=1;
                    }
                    else if($line->idjns_item == 5)
                    {
                        $optik +=1;
                    }
                    else if($line->idjns_item == 6)
                    {
                        $penunjang +=1;
                    }
                    else if($line->idjns_item == 7)
                    {
                        $tindakan +=1;
                    }
                    else if($line->idjns_item == 8)
                    {
                        $lain +=1;
                    }
                    else if($line->idjns_item == 9)
                    {
                        $dokter +=1;
                    }
		}

            echo "<graph caption='' canvasBorderColor='333333' animation='1' numdivlines='4' showNames='1' showValues='0' chartLeftMargin='5' chartRightMargin='5'  chartTopMargin='5' showLegend='0' showAnchors='0' rotateNames='1' formatNumberScale='1' decimalPrecision='2' formatNumber='0' yAxisName='Jumlah' xAxisName='Penyakit' divLineColor='CCCCCC'  showAlternateHGridColor='1'>";
            echo "<set name='Alkes' value='".$alkes."' color='AFD8F8'/>";
            echo "<set name='Apotek' value='".$apotek."' color='8BBA00'/>";
            echo "<set name='Dokter' value='".$dokter."' color='D64646'/>";
            echo "<set name='Gigi' value='".$gigi."' color='588526'/>";
            echo "<set name='Kamar' value='".$kamar."' color='B3AA00'/>";
            echo "<set name='Lain-lain' value='".$lain."' color='008ED6'/>";
            echo "<set name='Optik' value='".$optik."' color='9D080D'/>";
            echo "<set name='Penunjang' value='".$penunjang."' color='A186BE'/>";
            echo "<set name='Tindakan' value='".$tindakan."' color='F6BD0F'/>";
            echo "</graph>";
        }

        function getRawatinap()
        {
            $alkes =0;
            $apotek=0;
            $dokter=0;
            $gigi=0;
            $kamar=0;
            $lain=0;
            $optik=0;
            $penunjang=0;
            $tindakan=0;

            $bulan = $this->input->get('bulan');;
            $tahun = $this->input->get('tahun');
            $rayon=$this->session->userdata('id_rayon');
            $wilayah=$this->session->userdata('id_wilayah');
            $mitra=$this->session->userdata('id_mitra');
            $tgl1=null;
            $tgl2=null;
            $limit=10;
            $start=0;
            $sidx='id_transaksi';
            $sord='asc';
            $searchField=null;
            $searchString=null;
            $filter=null;
            $data1 = $this->m_laporan->get_Rawatinap($searchField,$searchString, $sidx, $sord, $limit, $start,$rayon,$wilayah,$mitra,$bulan,$tahun,$filter,'')->result();

		
		foreach($data1 as $line)
		{
                    if($line->idjns_item == 1)
                    {
                        $apotek +=1;
                    }
                    else if($line->idjns_item == 2)
                    {
                        $alkes +=1;
                    }
                    else if($line->idjns_item == 3)
                    {
                        $gigi +=1;
                    }
                    else if($line->idjns_item == 4)
                    {
                        $kamar +=1;
                    }
                    else if($line->idjns_item == 5)
                    {
                        $optik +=1;
                    }
                    else if($line->idjns_item == 6)
                    {
                        $penunjang +=1;
                    }
                    else if($line->idjns_item == 7)
                    {
                        $tindakan +=1;
                    }
                    else if($line->idjns_item == 8)
                    {
                        $lain +=1;
                    }
                    else if($line->idjns_item == 9)
                    {
                        $dokter +=1;
                    }
		}

            echo "<graph caption='' canvasBorderColor='333333' animation='1' numdivlines='4' showNames='1' showValues='0' chartLeftMargin='5' chartRightMargin='5'  chartTopMargin='5' showLegend='0' showAnchors='0' rotateNames='1' formatNumberScale='1' decimalPrecision='2' formatNumber='0' yAxisName='Jumlah' xAxisName='Penyakit' divLineColor='CCCCCC'  showAlternateHGridColor='1'>";
            echo "<set name='Alkes' value='".$alkes."' color='AFD8F8'/>";
            echo "<set name='Apotek' value='".$apotek."' color='8BBA00'/>";
            echo "<set name='Dokter' value='".$dokter."' color='D64646'/>";
            echo "<set name='Gigi' value='".$gigi."' color='588526'/>";
            echo "<set name='Kamar' value='".$kamar."' color='B3AA00'/>";
            echo "<set name='Lain-lain' value='".$lain."' color='008ED6'/>";
            echo "<set name='Optik' value='".$optik."' color='9D080D'/>";
            echo "<set name='Penunjang' value='".$penunjang."' color='A186BE'/>";
            echo "<set name='Tindakan' value='".$tindakan."' color='F6BD0F'/>";
            echo "</graph>";
        }


        function post_biaya()
        {

            $bulan = $this->input->get('bulan');
            $tahun = $this->input->get('tahun');
            $data['bulan']=$bulan;
            $data['tahun']=$tahun;
            $this->load->view('laporan/executive_pb',$data);
        }

        function getPostbiaya()

        {
            
                $bulan = $this->input->get('bulan');
                //$bulan = 4;
                $tahun = $this->input->get('tahun');

		$rayon=$this->session->userdata('id_rayon');
                $wilayah=$this->session->userdata('id_wilayah');
                $mitra=$this->session->userdata('id_mitra');
                $searchField=null;
                $start=null;
                $tgl1=null;
                $tgl2=null;
                $limit=null;
                $sord=null;
                $sidx=null;
                $searchString=null;
		
		$data1 = $this->m_transaksi->getPostbiaya($searchField,$searchString, $sidx, $sord, $limit, $start,$rayon,$wilayah,$mitra,$bulan,$tahun,$tgl1,$tgl2)->result();

		
                $degeneratif=0;
                $non_degeneratif=0;
                $tdk_sakit=0;
                $kecelakaan=0;
		foreach($data1 as $line)
		{
			//$responce->rows[$i]['cell'] = array($line->tgl_transaksi,$line->tgl_kunjungan);
                        if($line->jenis_penyakit == "non degeneratif")
                        {$non_degeneratif += $line->total;
                        }
                        else if($line->jenis_penyakit == "degeneratif")
                        {$degeneratif += $line->total;
                        }
                        else if(strtolower ($line->jenis_penyakit) == "tidak sakit")
                        {$tdk_sakit += $line->total;
                        }
                        else
                        {$kecelakaan += $line->total;
                        }
		}
                //$tahun=2000;
                
                
 
            echo "<graph caption='' canvasBorderColor='333333' animation='1' numdivlines='4' showNames='1' showValues='0' chartLeftMargin='5' chartRightMargin='5'  chartTopMargin='5' showLegend='0' showAnchors='0' rotateNames='1' formatNumberScale='1' decimalPrecision='2' formatNumber='0' yAxisName='Jumlah' xAxisName='Penyakit' divLineColor='CCCCCC'  showAlternateHGridColor='1'>";
            echo "<set name='Degeneratif' value='".$degeneratif."' color='AFD8F8'/>";
            echo "<set name='Non Degeneratif' value='".$non_degeneratif."' color='8BBA00'/>";
            echo "<set name='Accident' value='".$kecelakaan."' color='D64646'/>";
            echo "<set name='Tidak Sakit' value='".$tdk_sakit."' color='588526'/>";
            echo "</graph>";

           // $this->load->view('laporan/executive_pb',$data);
        }

        function getBiayajson()
        {
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



		//$count = $this->m_transaksi->count_Apotek($searchField,$searchString,$rayon,$wilayah,$mitra,$bulan,$tahun,$tgl1,$tgl2,$jns_tanggal);
		$count = 5;
		$count > 0 ? $total_pages = ceil($count/$limit) : $total_pages = 0;
		if ($page > $total_pages) $page=$total_pages;
		$start = $limit*$page - $limit;
		if($start <0) $start = 0;

		$data1 = $this->m_transaksi->getPostbiaya($searchField,$searchString, $sidx, $sord, $limit, $start,$rayon,$wilayah,$mitra,$bulan,$tahun,$tgl1,$tgl2)->result();



		$responce->page = $page;
		$responce->total = $total_pages;
		$responce->records = $count;
                $responce->bulan = $bulan;
                $responce->tahun = $tahun;
		$i=0;
                $postdata['degeneratif']['karyawan']=0;
                $postdata['degeneratif']['kel_karyawan']=0;
                $postdata['degeneratif']['pensiun']=0;
                $postdata['degeneratif']['kel_pensiun']=0;
                $postdata['non degeneratif']['karyawan']=0;
                $postdata['non degeneratif']['kel_karyawan']=0;
                $postdata['non degeneratif']['pensiun']=0;
                $postdata['non degeneratif']['kel_pensiun']=0;
                $postdata['accident']['karyawan']=0;
                $postdata['accident']['kel_karyawan']=0;
                $postdata['accident']['pensiun']=0;
                $postdata['accident']['kel_pensiun']=0;
                $postdata['tdk sakit']['karyawan']=0;
                $postdata['tdk sakit']['kel_karyawan']=0;
                $postdata['tdk sakit']['pensiun']=0;
                $postdata['tdk sakit']['kel_pensiun']=0;
		foreach($data1 as $line)
		{
			//$responce->rows[$i]['cell'] = array($line->tgl_transaksi,$line->tgl_kunjungan);
                        if(strtolower ($line->jenis_penyakit) == "non degeneratif")
                        {
                            if($line->ap == "a")
                            {
                                
                                if(strtoupper($line->status) == "ANAK")
                                {
                                   $postdata['non degeneratif']['kel_karyawan']+=$line->total;
                                }
                                elseif(strtoupper($line->status) == "ISTRI")
                                {
                                   $postdata['non degeneratif']['kel_karyawan']+=$line->total;
                                }
                                else
                                {
                                   $postdata['non degeneratif']['karyawan']+=$line->total;
                                }
                            }

                            else
                            {
                                if($line->status == "anak")
                                {
                                   $postdata['non degeneratif']['kel_pensiun']+=$line->total;
                                }
                                else if($line->status == "istri")
                                {
                                   $postdata['non degeneratif']['kel_pensiun']+=$line->total;
                                }
                                else
                                {
                                   $postdata['non degeneratif']['pensiun']+=$line->total;
                                }
                            }

                        }
                        else if(strtolower ($line->jenis_penyakit) == "degeneratif")
                        {
                            if($line->ap == "a")
                            {

                                if(strtoupper($line->status) == "ANAK")
                                {
                                   $postdata['degeneratif']['kel_karyawan']+=$line->total;
                                }
                                elseif(strtoupper($line->status) == "ISTRI")
                                {
                                   $postdata['degeneratif']['kel_karyawan']+=$line->total;
                                }
                                else
                                {
                                   $postdata['degeneratif']['karyawan']+=$line->total;
                                }
                            }

                            else
                            {
                                if($line->status == "anak")
                                {
                                   $postdata['degeneratif']['kel_pensiun']+=$line->total;
                                }
                                else if($line->status == "istri")
                                {
                                   $postdata['degeneratif']['kel_pensiun']+=$line->total;
                                }
                                else
                                {
                                   $postdata['degeneratif']['pensiun']+=$line->total;
                                }
                            }

                        }
                        else if(strtolower ($line->jenis_penyakit) == "tidak sakit")
                        {
                            if($line->ap == "a")
                            {

                                if(strtoupper($line->status) == "ANAK")
                                {
                                   $postdata['tdk sakit']['kel_karyawan']+=$line->total;
                                }
                                elseif(strtoupper($line->status) == "ISTRI")
                                {
                                   $postdata['tdk sakit']['kel_karyawan']+=$line->total;
                                }
                                else
                                {
                                   $postdata['tdk sakit']['karyawan']+=$line->total;
                                }
                            }

                            else
                            {
                                if($line->status == "anak")
                                {
                                   $postdata['tdk sakit']['kel_pensiun']+=$line->total;
                                }
                                else if($line->status == "istri")
                                {
                                   $postdata['tdk sakit']['kel_pensiun']+=$line->total;
                                }
                                else
                                {
                                   $postdata['tdk sakit']['pensiun']+=$line->total;
                                }
                            }

                        }
                        else if(strtolower ($line->jenis_penyakit) == "accident")

                        {
                            if($line->ap == "a")
                            {

                                if(strtoupper($line->status) == "ANAK")
                                {
                                   $postdata['accident']['kel_karyawan']+=$line->total;
                                }
                                elseif(strtoupper($line->status) == "ISTRI")
                                {
                                   $postdata['accident']['kel_karyawan']+=$line->total;
                                }
                                else
                                {
                                   $postdata['accident']['karyawan']+=$line->total;
                                }
                            }

                            else
                            {
                                if($line->status == "anak")
                                {
                                   $postdata['accident']['kel_pensiun']+=$line->total;
                                }
                                else if($line->status == "istri")
                                {
                                   $postdata['accident']['kel_pensiun']+=$line->total;
                                }
                                else
                                {
                                   $postdata['accident']['pensiun']+=$line->total;
                                }
                            }

                        }
			$i++;
		}
                
                
		
                $responce->rows[0]['cell'] = array(1,"Degeneratif",$postdata['degeneratif']['karyawan'],$postdata['degeneratif']['kel_karyawan'],$postdata['degeneratif']['pensiun'],$postdata['degeneratif']['kel_pensiun']);
                $responce->rows[1]['cell'] = array(2,"Non Degeneratif",$postdata['non degeneratif']['karyawan'],$postdata['non degeneratif']['kel_karyawan'],$postdata['non degeneratif']['pensiun'],$postdata['non degeneratif']['kel_pensiun']);
                $responce->rows[2]['cell'] = array(3,"Accident",$postdata['accident']['karyawan'],$postdata['accident']['kel_karyawan'],$postdata['accident']['pensiun'],$postdata['accident']['kel_pensiun']);
                $responce->rows[3]['cell'] = array(4,"Tidak Sakit",$postdata['tdk sakit']['karyawan'],$postdata['tdk sakit']['kel_karyawan'],$postdata['tdk sakit']['pensiun'],$postdata['tdk sakit']['kel_pensiun']);
                

		echo json_encode($responce);
        }

        function ad_biaya()
        {
            $data['bulan'] = $this->input->get('bulan');
            $data['tahun'] = $this->input->get('tahun');

            $this->load->view('laporan/executive_hab',$data);
        }

        function getAudit()
        {
            echo "<graph caption='' canvasBorderColor='333333' animation='1' numdivlines='4' showNames='1' showValues='0' chartLeftMargin='5' chartRightMargin='5'  chartTopMargin='5' showLegend='0' showAnchors='0' rotateNames='1' formatNumberScale='1' decimalPrecision='2' formatNumber='0' yAxisName='Jumlah' xAxisName='Penyakit' divLineColor='CCCCCC'  showAlternateHGridColor='1'>";
            echo "<set name='Total Biaya' value='62' color='AFD8F8'/>";
            echo "<set name='Audit Biaya' value='62' color='8BBA00'/>";
            echo "<set name='Hasil Verifikasi' value='62' color='D64646'/>";
            echo "<set name='Potensial Reduksi' value='22' color='588526'/>";
            echo "<set name='Biaya Setelah Koreksi' value='80' color='A186BE'/>";
            echo "</graph>";
        }

        function getAuditjson()
        {
                $page  = $this->input->get('page');
		$limit = $this->input->get('rows');
		$sidx  = $this->input->get('sidx');
		$sord  = $this->input->get('sord');

		$responce->page = 1;
		$responce->total = 1;
		$responce->records = 1;

                $responce->rows[0]['id_provider']=1;
                $responce->rows[0]['cell'] = array(1,"tes","tes","ya","tes",213,"fsda");


		echo json_encode($responce);
        }

        function biaya_perjabatan()
        {
            $bulan = $this->input->get('bulan');
            $tahun = $this->input->get('tahun');
            $data['bulan']=$bulan;
            $data['tahun']=$tahun;
            $this->load->view('laporan/executive_bt',$data);
        }

        function getBiayaterbesarjson()
        {
                
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
		$count = $this->m_transaksi->count_transaksiterbesar($searchField,$searchString,$rayon,$wilayah,$mitra,$bulan,$tahun);
		$count > 0 ? $total_pages = ceil($count/$limit) : $total_pages = 0;
		if ($page > $total_pages) $page=$total_pages;
		$start = $limit*$page - $limit;
		if($start <0) $start = 0;
		$data1 = $this->m_transaksi->getTransaksiterbesar($searchField,$searchString, $sidx, $sord, $limit, $start,$rayon,$wilayah,$mitra,$bulan,$tahun)->result();
                $responce->page = $page;
		$responce->total = $total_pages;
		$responce->records = $count;
                $responce->bulan = $bulan;
                $responce->tahun = $tahun;
		$i=0;
		foreach($data1 as $line)
		{
			$responce->rows[$i]['nip']   = $line->nip;

			$responce->rows[$i]['cell'] = array($line->nip,$line->nama_karyawan,$line->total);
			$i++;
		}
		echo json_encode($responce);
        }

        function getBiayajabatanjson()
        {
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
		$count = $this->m_transaksi->count_jabatanterbesar($searchField,$searchString,$rayon,$wilayah,$mitra,$bulan,$tahun);
		$count > 0 ? $total_pages = ceil($count/$limit) : $total_pages = 0;
		if ($page > $total_pages) $page=$total_pages;
		$start = $limit*$page - $limit;
		if($start <0) $start = 0;
		$data1 = $this->m_transaksi->getJabatanterbesar($searchField,$searchString, $sidx, $sord, $limit, $start,$rayon,$wilayah,$mitra,$bulan,$tahun)->result();
                $responce->page = $page;
		$responce->total = $total_pages;
		$responce->records = $count;
                $responce->bulan = $bulan;
                $responce->tahun = $tahun;
		$i=0;
		foreach($data1 as $line)
		{
			$responce->rows[$i]['nip']   = $line->id_bagian;

			$responce->rows[$i]['cell'] = array($line->id_bagian,$line->nama_bagian,$line->total1);
			$i++;
		}
		echo json_encode($responce);
        }

        function kesehatan_tahunan()
        {
            $data['bulan'] = $this->input->get('bulan');
            $data['tahun'] = $this->input->get('tahun');

            $this->load->view('laporan/executive_bk',$data);
        }

        function getKesehatan()
        {
            echo "<graph caption='' canvasBorderColor='333333' animation='1' numdivlines='4' showNames='1' showValues='0' chartLeftMargin='5' chartRightMargin='5'  chartTopMargin='5' showLegend='0' showAnchors='0' rotateNames='1' formatNumberScale='1' decimalPrecision='2' formatNumber='0' yAxisName='Jumlah' xAxisName='Penyakit' divLineColor='CCCCCC'  showAlternateHGridColor='1'>";
            echo "<set name='Total Biaya Dalam Setahun' value='62' color='AFD8F8'/>";
            echo "<set name='Kenaikan 10% Dari Tahun Sebelumnya' value='62' color='8BBA00'/>";
            echo "<set name='Kenaikan 25% Dari Tahun Sebelumnya' value='62' color='D64646'/>";
            echo "</graph>";
        }

	

}