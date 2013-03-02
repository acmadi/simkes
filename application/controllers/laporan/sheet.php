<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class  Sheet extends CI_Controller {
   // $kun="";


    function __construct()
    {
        parent::__construct();
        $this->load->model(array('m_hasil_transaksi','m_transaksi','m_karyawan','m_tran_apotek','m_tertanggung','m_item','m_dokter','m_apotek'));
        $this->load->helper('url'); // Load Helper URL CI
        $this->load->library(array('excel'));
        //$this->load->helper('form');
    }




        function index()
        {
	$this->load->view('laporan/sheet'); //Default di arahkan ke function grid

 	//$id= $this->session->userdata('id_user');

    //echo "Semangat";
	}

	

        function ekspor()
	{

	error_reporting(E_ALL);

	date_default_timezone_set('Europe/London');

	$tulis=$this->excel->setActiveSheetIndex(0);

                        $tulis->setCellValue('A1', "No");
                        $tulis->setCellValue('B1', "Id Transaksi");
                        $tulis->setCellValue('C1', "Tanggal Transaksi");
                        $tulis->setCellValue('D1', "Tanggal Kunjungan");
                        $tulis->setCellValue('E1', "No Surat");
                        $tulis->setCellValue('F1', "No Bukti");
                        $tulis->setCellValue('G1', "Buku Besar");
                        $tulis->setCellValue('H1', "Restitusi");
                        $tulis->setCellValue('I1', "NIP");
                        $tulis->setCellValue('J1', "Penanggung");
                        $tulis->setCellValue('K1', "Pasien");
                        $tulis->setCellValue('L1', "Rujukan");
                        $tulis->setCellValue('M1', "Dokter");
                        $tulis->setCellValue('N1', "Apotek");
                        $tulis->setCellValue('O1', "DAK");
                        $tulis->setCellValue('P1', "Diagnosa");

      	// Rename worksheet
	$this->excel->getActiveSheet()->setTitle('Apotek');
	// Set active sheet index to the first sheet, so Excel opens this as the first sheet
	

        $this->laporan1();
        $this->laporan2();
        $this->laporan3();
        $this->laporan4();
        $this->laporan5();
        $this->laporan6();
        $this->laporan7();
        $this->laporan8();
        $this->laporan9();
        $this->laporan10();
        $this->laporan11();
        $this->laporan12();
        $this->laporan13();
        $this->laporan14();
        $this->laporan15();
        $this->laporan16();
        $this->laporan17();
        $this->laporan18();
        $this->laporan19();
        $this->laporan20();
        $this->laporan21();
        $this->laporan22();
        $this->laporan23();
        $this->laporan24();
        $this->laporan25();
        $this->laporan26();
        $this->laporan27();
        $this->laporan28();


	// Redirect output to a client�s web browser (Excel5)
	header('Content-Type: application/vnd.ms-excel');
	header('Content-Disposition: attachment;filename="Transaksi Apotek.xls"');
	header('Cache-Control: max-age=0');

	$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
	$objWriter->save('php://output');
	//exit;
	}

        
        function laporan1()
        {
        $this->excel->createSheet(1);
        $tulis=$this->excel->setActiveSheetIndex(1);

                        $tulis->setCellValue('A1', "1");
                        $tulis->setCellValue('A2', "LAPORAN KONSULTASI INDIVIDUAL");
                        $tulis->setCellValue('A3', "(Lihat Lampiran 1 Laporan Konsultasi Individual)");
                        $tulis->setCellValue('A4', "(Nama Perusahaan)");
                        $tulis->setCellValue('A6', 1);
                        $tulis->setCellValue('A7', 2);
                        $tulis->setCellValue('A8', 3);
                        $tulis->setCellValue('A10', 4);
                        $tulis->setCellValue('A18', 5);
                        $tulis->setCellValue('A20', 6);
                        $tulis->setCellValue('A22', 7);
                        $tulis->setCellValue('B6', "Periode");
                        $tulis->setCellValue('B7', "Jumlah Kunjungan");
                        $tulis->setCellValue('B8', "Jumlah Kunjungan Konsultasi");
                        $tulis->setCellValue('B10', "Rujukan");
                        $tulis->setCellValue('B11', "Dokter Spesialis");
                        $tulis->setCellValue('B12', "Rumah Sakit");
                        $tulis->setCellValue('B13', "Laboratorium");
                        $tulis->setCellValue('B14', "Dokter Umum");
                        $tulis->setCellValue('B15', "Lainnya");
                        $tulis->setCellValue('B16', "Gigi");
                        $tulis->setCellValue('B18', "Catatan Khusus");
                        $tulis->setCellValue('B20', "Kesimpulan");
                        $tulis->setCellValue('B22', "Diagram Prosentase Konsultasi Terhadap Total Kunjungan");
                        $tulis->setCellValue('C6', " : ");
                        $tulis->setCellValue('C7', " : ");
                        $tulis->setCellValue('C8', " : ");
                        $tulis->setCellValue('C11', " : ");
                        $tulis->setCellValue('C12', " : ");
                        $tulis->setCellValue('C13', " : ");
                        $tulis->setCellValue('C14', " : ");
                        $tulis->setCellValue('C15', " : ");
                        $tulis->setCellValue('C16', " : ");
                        $tulis->setCellValue('C18', " : ");
                        $tulis->setCellValue('C20', " : ");
                        $tulis->setCellValue('D6', "(Bulan Tahun)");
                        $tulis->setCellValue('D7', "(jml kunjungan)");
                        $tulis->setCellValue('D8', "(jml kunjungan)");
                        $tulis->setCellValue('D12', "(jml rmh sakit)");
                        $tulis->setCellValue('D13', "(jml laborat)");
                        $tulis->setCellValue('D14', "(jml dr umum)");
                        $tulis->setCellValue('D15', "(jml Lainnya)");
                        $tulis->setCellValue('D16', "(jml Gigi)");
                        $tulis->setCellValue('D18', " Catatan");
                        $tulis->setCellValue('D20', " Kesimpulan");
                        $tulis->setCellValue('E6', "orang");
                        $tulis->setCellValue('E7', "orang");
                        $tulis->setCellValue('E8', "orang");
                        $tulis->setCellValue('E12', "orang");
                        $tulis->setCellValue('E13', "orang");
                        $tulis->setCellValue('E14', "orang");
                        $tulis->setCellValue('E15', "orang");
                        $tulis->setCellValue('E16', "orang");
                        $tulis->setCellValue('E18', "orang");
                        $tulis->setCellValue('E20', "orang");

        $this->excel->setActiveSheetIndex(1);
        $this->excel->getActiveSheet()->setTitle("1");

        }

        function laporan2()
        {
        $this->excel->createSheet(2);
        $tulis=$this->excel->setActiveSheetIndex(2);

                        $tulis->setCellValue('A1', "2A");
                        $tulis->setCellValue('A2', "LAPORAN KEGIATAN DIALOG KESEHATAN");
                        $tulis->setCellValue('A3', "(Lihat Lampiran 2A Laporan Kegiatan Dialog Kesehatan)");
                        $tulis->setCellValue('A4', "(Nama Perusahaan)");
                        $tulis->setCellValue('A6', 1);
                        $tulis->setCellValue('A7', 2);
                        $tulis->setCellValue('A9', 3);
                        $tulis->setCellValue('A11', 4);
                        $tulis->setCellValue('A14', 5);
                        $tulis->setCellValue('A17', 6);
                        $tulis->setCellValue('A23', 7);
                        $tulis->setCellValue('A27', 8);
                        $tulis->setCellValue('A30', 9);
                        $tulis->setCellValue('B6', "Periode");
                        $tulis->setCellValue('B7', "Judul Dialog");
                        $tulis->setCellValue('B9', "Target Jumlah Peserta");
                        $tulis->setCellValue('B11', "Kehadiran");
                        $tulis->setCellValue('B14', "Waktu");
                        $tulis->setCellValue('B17', "Tempat");
                        $tulis->setCellValue('B23', "Hasil Evaluasi Peserta");
                        $tulis->setCellValue('B27', "Catatan Khusus");
                        $tulis->setCellValue('B30', "Kesimpulan");
                        $tulis->setCellValue('C6', " : ");
                        $tulis->setCellValue('C7', " : ");
                        $tulis->setCellValue('C9', " : ");
                        $tulis->setCellValue('C11', " : ");
                        $tulis->setCellValue('C14', " : ");
                        $tulis->setCellValue('C17', " : ");
                        $tulis->setCellValue('C23', " : ");
                        $tulis->setCellValue('C27', " : ");
                        $tulis->setCellValue('C30', " : ");
                        $tulis->setCellValue('D6', "(bulan tahun)");
                        $tulis->setCellValue('D7', "(judul dialog)");
                        $tulis->setCellValue('D9', "(target peserta)");
                        $tulis->setCellValue('D11', "(jumlah hadir)");
                        $tulis->setCellValue('D14', "(waktu)");
                        $tulis->setCellValue('D17', "(tempat)");
                        $tulis->setCellValue('D23', "(hasil evaluasi)");
                        $tulis->setCellValue('D27', "(catatan khusus)");
                        $tulis->setCellValue('D30', "(kesimpulan)");
                        $tulis->setCellValue('E9', "Orang");
                        $tulis->setCellValue('E11', "Orang");

                        $tulis->setCellValue('H1', "2B");
                        $tulis->setCellValue('H2', "PROPOSAL DIALOG KESEHATAN");
                        $tulis->setCellValue('H4', "(Nama Perusahaan)");
                        $tulis->setCellValue('H6', "1");
                        $tulis->setCellValue('H7', "2");
                        $tulis->setCellValue('H10', "3");
                        $tulis->setCellValue('H14', "4");
                        $tulis->setCellValue('H16', "5");
                        $tulis->setCellValue('H23', "6");
                        $tulis->setCellValue('H25', "7");
                        $tulis->setCellValue('H27', "8");
                        $tulis->setCellValue('I6', "Periode");
                        $tulis->setCellValue('I7', "Judul Dialog");
                        $tulis->setCellValue('I10', "Tujuan");
                        $tulis->setCellValue('I14', "Target Jumlah");
                        $tulis->setCellValue('I16', "Waktu");
                        $tulis->setCellValue('I23', "Koordinator");
                        $tulis->setCellValue('I25', "Moderator");
                        $tulis->setCellValue('I27', "Pembicara");
                        $tulis->setCellValue('J6', " : ");
                        $tulis->setCellValue('J7', " : ");
                        $tulis->setCellValue('J10', " : ");
                        $tulis->setCellValue('J14', " : ");
                        $tulis->setCellValue('J16', " : ");
                        $tulis->setCellValue('J23', " : ");
                        $tulis->setCellValue('J25', " : ");
                        $tulis->setCellValue('J27', " : ");
                        $tulis->setCellValue('K6', "(BULAN TAHUN)");
                        $tulis->setCellValue('K7', " (judul dialog)");
                        $tulis->setCellValue('K10', " (tujuan)");
                        $tulis->setCellValue('K14', " (target jumlah)");
                        $tulis->setCellValue('K16', " (waktu)");
                        $tulis->setCellValue('K23', " (koordinator)");
                        $tulis->setCellValue('K25', " (Moderator)");
                        $tulis->setCellValue('K27', " (Pembicara)");
                        $tulis->setCellValue('L14', "Orang");

                        $this->excel->getActiveSheet()->setTitle("2");

        }
        
        function laporan3()
        {
        $this->excel->createSheet(3);
        $tulis=$this->excel->setActiveSheetIndex(3);

                        $tulis->setCellValue('A1', "3A");
                        $tulis->setCellValue('A2', "LAPORAN REALISASI LEAFLET / ARTIKEL KESEHATAN");
                        $tulis->setCellValue('A3', "(Lihat Lampiran 2a LAPORAN KEGIATAN DIALOG KESEHATAN)");
                        $tulis->setCellValue('A4', "NAMA PERUSAHAAN");
                        $tulis->setCellValue('A6', "1");
                        $tulis->setCellValue('A8', "2");
                        $tulis->setCellValue('A10', "3");
                        $tulis->setCellValue('A12', "4");
                        $tulis->setCellValue('A14', "5");
                        $tulis->setCellValue('A18', "6");
                        $tulis->setCellValue('A20', "7");
                        $tulis->setCellValue('B6', "Periode");
                        $tulis->setCellValue('B8', "Judul Leaflet");
                        $tulis->setCellValue('B10', "Tujuan");
                        $tulis->setCellValue('B12', "Jumlah yang dibagikan");
                        $tulis->setCellValue('B14', "Isi Leaflet");
                        $tulis->setCellValue('B18', "Catatan Khusus");
                        $tulis->setCellValue('B20', "Kesimpulan");
                        $tulis->setCellValue('C6', " : ");
                        $tulis->setCellValue('C8', " : ");
                        $tulis->setCellValue('C10', " : ");
                        $tulis->setCellValue('C12', " : ");
                        $tulis->setCellValue('C14', " : ");
                        $tulis->setCellValue('C18', " : ");
                        $tulis->setCellValue('C20', " : ");
                        $tulis->setCellValue('D6', "(bulan tahun)");
                        $tulis->setCellValue('H1', "3B");
                        $tulis->setCellValue('H2', "PROPOSAL LEAFLET / ARTIKEL KESEHATAN");
                        $tulis->setCellValue('H4', "(NAMA PERUSAHAAN)");
                        $tulis->setCellValue('H6', "1");
                        $tulis->setCellValue('H7', "2");
                        $tulis->setCellValue('H11', "3");
                        $tulis->setCellValue('H13', "4");
                        $tulis->setCellValue('H17', "5");
                        $tulis->setCellValue('H6', "Periode");
                        $tulis->setCellValue('H7', "Judul Leaflet / Artikel");
                        $tulis->setCellValue('H11', "Rencana Jumlah yang Diterbitkan");
                        $tulis->setCellValue('H13', "Isi Leaflet / Artikel");
                        $tulis->setCellValue('H17', "Rencana Muat");
                        $tulis->setCellValue('I6', " : ");
                        $tulis->setCellValue('I7', " : ");
                        $tulis->setCellValue('I11', " : ");
                        $tulis->setCellValue('I13', " : ");
                        $tulis->setCellValue('I17', " : ");
                        $tulis->setCellValue('J6', "(Bulan tahun)");
       $this->excel->getActiveSheet()->setTitle("3");

        }

        function laporan4()
        {
        $this->excel->createSheet(4);
        $tulis=$this->excel->setActiveSheetIndex(4);

                        $tulis->setCellValue('A1', "1");
                        $tulis->setCellValue('A2', "LAPORAN KEGIATAN PROAKTIF");
                        $tulis->setCellValue('A3', "(Lihat Lampiran 4 HASIL KEGIATAN PROAKTIF)");
                        $tulis->setCellValue('A4', "NAMA PERUSAHAAN");
                        $tulis->setCellValue('A6', "1");
                        $tulis->setCellValue('A7', "2");
                        $tulis->setCellValue('A8', "3");
                        $tulis->setCellValue('A9', "4");
                        $tulis->setCellValue('A20', "5");
                        $tulis->setCellValue('A28', "6");
                        $tulis->setCellValue('A30', "7");
                        $tulis->setCellValue('B6', "Periode");
                        $tulis->setCellValue('B7', "Jumlah Karyawan Terjadwal");
                        $tulis->setCellValue('B8', "Kehadiran");
                        $tulis->setCellValue('B9', "Kasus Terbanyak");
                        $tulis->setCellValue('B20', "Rujukan");
                        $tulis->setCellValue('B21', "Dokter Spesialis");
                        $tulis->setCellValue('B22', "Rumah Sakit");
                        $tulis->setCellValue('B23', "Laborat");
                        $tulis->setCellValue('B24', "Dokter Umum");
                        $tulis->setCellValue('B25', "Lainnya");
                        $tulis->setCellValue('B26', "Gigi");
                        $tulis->setCellValue('B28', "Catatan Khusus");
                        $tulis->setCellValue('B30', "Kesimpulan Effektifitas");
                        $tulis->setCellValue('C6', " : ");
                        $tulis->setCellValue('C7', " : ");
                        $tulis->setCellValue('C8', " : ");
                        $tulis->setCellValue('C9', " : ");
                        $tulis->setCellValue('C20', " : ");
                        $tulis->setCellValue('C21', " : ");
                        $tulis->setCellValue('C22', " : ");
                        $tulis->setCellValue('C23', " : ");
                        $tulis->setCellValue('C24', " : ");
                        $tulis->setCellValue('C25', " : ");
                        $tulis->setCellValue('C26', " : ");
                        $tulis->setCellValue('C28', " : ");
                        $tulis->setCellValue('C30', " : ");
                        $tulis->setCellValue('E21', "Orang");
                        $tulis->setCellValue('E22', "Orang");
                        $tulis->setCellValue('E23', "Orang");
                        $tulis->setCellValue('E24', "Orang");
                        $tulis->setCellValue('E25', "Orang");
                        $tulis->setCellValue('E26', "Orang");

        $this->excel->getActiveSheet()->setTitle("4");

        }

        function laporan5()
        {
        $this->excel->createSheet(5);
        $tulis=$this->excel->setActiveSheetIndex(5);

                        $tulis->setCellValue('A1', "1");
                        $tulis->setCellValue('A2', "LAPORAN ANALISIS LABORAT");
                        $tulis->setCellValue('A3', "(Lihat Lampiran 5 HASIL LABORAT DAN KESIMPULAN)");
                        $tulis->setCellValue('A4', "NAMA PERUSAHAAN");
                        $tulis->setCellValue('A6', "1");
                        $tulis->setCellValue('A7', "2");
                        $tulis->setCellValue('A8', "3");
                        $tulis->setCellValue('A9', "4");
                        $tulis->setCellValue('A15', "5");
                        $tulis->setCellValue('A26', "6");
                        $tulis->setCellValue('A30', "7");
                        $tulis->setCellValue('A32', "Diagram Jumlah Tagihan Lab terhadap Total Tagihan");
                        $tulis->setCellValue('B6', "Periode");
                        $tulis->setCellValue('B7', "Total Pemeriksaan Lab/Penunjang");
                        $tulis->setCellValue('B8', "Jumlah Hasil Lab/Penunjang");
                        $tulis->setCellValue('B9', "Rujukan oleh ");
                        $tulis->setCellValue('B15', "Kasus Terbanyak");
                        $tulis->setCellValue('B26', "Catatan Khusus");
                        $tulis->setCellValue('B30', "Kesimpulan");
                        $tulis->setCellValue('C6', " : ");
                        $tulis->setCellValue('C7', " : ");
                        $tulis->setCellValue('C8', " : ");
                        $tulis->setCellValue('C9', " : ");
                        $tulis->setCellValue('C15', " : ");
                        $tulis->setCellValue('C26', " : ");
                        $tulis->setCellValue('C30', " : ");
                        $tulis->setCellValue('D6', "(BULAN TAHUN)");

        $this->excel->getActiveSheet()->setTitle("5");

        }

        function laporan6()
        {
        $this->excel->createSheet(6);
        $tulis=$this->excel->setActiveSheetIndex(6);

                        $tulis->setCellValue('A1', "6");
                        $tulis->setCellValue('A2', "DATABASE KESEHATAN");
                        $tulis->setCellValue('A3', "NAMA PERUSAHAAN");
                        $tulis->setCellValue('A5', "1");
                        $tulis->setCellValue('A6', "2");
                        $tulis->setCellValue('A7', "3");
                        $tulis->setCellValue('A13', "4");
                        $tulis->setCellValue('A24', "5");
                        $tulis->setCellValue('A32', "6");
                        $tulis->setCellValue('A34', "7");
                        $tulis->setCellValue('B5', "Periode");
                        $tulis->setCellValue('B6', "Jumlah Kunjungan Total");
                        $tulis->setCellValue('B7', "Total Kunjungan");
                        $tulis->setCellValue('B13', "Kasus Terbanyak");
                        $tulis->setCellValue('B24', "Penyakit Terberat");
                        $tulis->setCellValue('B32', "Catatan Khusus");
                        $tulis->setCellValue('B34', "Kesimpulan");
                        $tulis->setCellValue('B36', "Diagram Kasus Terbanyak");
                        $tulis->setCellValue('C8', "Dokter Langganan");
                        $tulis->setCellValue('C9', "DAK");
                        $tulis->setCellValue('C10', "Restitusi/Spesialis");
                        $tulis->setCellValue('C11', "Rumah Sakit");
                        $tulis->setCellValue('C12', "Lain-lain");
                        $tulis->setCellValue('D5', " : ");
                        $tulis->setCellValue('D6', " : ");
                        $tulis->setCellValue('D7', " : ");
                        $tulis->setCellValue('D13', " : ");
                        $tulis->setCellValue('D24', " : ");
                        $tulis->setCellValue('D32', " : ");
                        $tulis->setCellValue('D34', " : ");
                        $tulis->setCellValue('E5', "(BULAN TAHUN)");
                        $tulis->setCellValue('E6', "Orang");
                        $tulis->setCellValue('E8', "Orang");
                        $tulis->setCellValue('E9', "Orang");
                        $tulis->setCellValue('E10', "Orang");
                        $tulis->setCellValue('E11', "Orang");
                        $tulis->setCellValue('E12', "Orang");

        $this->excel->getActiveSheet()->setTitle("6");

        }

        function laporan7()
        {
        $this->excel->createSheet(7);
        $tulis=$this->excel->setActiveSheetIndex(7);

                        $tulis->setCellValue('A1', "7");
                        $tulis->setCellValue('A2', "LAPORAN KEGIATAN FOLLOW UP");
                        $tulis->setCellValue('A3', "NAMA PERUSAHAAN");
                        $tulis->setCellValue('A6', "1");
                        $tulis->setCellValue('A7', "2");
                        $tulis->setCellValue('A8', "3");
                        $tulis->setCellValue('A9', "4");
                        $tulis->setCellValue('A10', "5");
                        $tulis->setCellValue('A17', "6");
                        $tulis->setCellValue('A21', "7");
                        $tulis->setCellValue('B6', "Periode");
                        $tulis->setCellValue('B7', "Jumlah Rencana");
                        $tulis->setCellValue('B8', "Realisasi");
                        $tulis->setCellValue('B9', "Keberhasilan Dihubungi");
                        $tulis->setCellValue('B10', "Hasil");
                        $tulis->setCellValue('B17', "Catatan Khusus");
                        $tulis->setCellValue('B21', "Kesimpulan");
                        $tulis->setCellValue('B26', "Diagram Realisasi");
                        $tulis->setCellValue('C11', "Membaik");
                        $tulis->setCellValue('C12', "Memburuk");
                        $tulis->setCellValue('C13', "Tetap");
                        $tulis->setCellValue('C14', "Bulan Berikutnya");
                        $tulis->setCellValue('C15', "Tidak bisa dihubungi");
                        $tulis->setCellValue('D6', " : ");
                        $tulis->setCellValue('D7', " : ");
                        $tulis->setCellValue('D8', " : ");
                        $tulis->setCellValue('D9', " : ");
                        $tulis->setCellValue('D10', " : ");
                        $tulis->setCellValue('D17', " : ");
                        $tulis->setCellValue('D21', " : ");
                        $tulis->setCellValue('E6', "(BULAN TAHUN)");
                        $tulis->setCellValue('F7', "Orang");
                        $tulis->setCellValue('F8', "Orang");
                        $tulis->setCellValue('F9', "Orang");
                        $tulis->setCellValue('F11', "Orang");
                        $tulis->setCellValue('F12', "Orang");
                        $tulis->setCellValue('F13', "Orang");
                        $tulis->setCellValue('F14', "Orang");
                        $tulis->setCellValue('F15', "Orang");

        $this->excel->getActiveSheet()->setTitle("7");

        }

        function laporan8()
        {
        $this->excel->createSheet(8);
        $tulis=$this->excel->setActiveSheetIndex(8);

                        $tulis->setCellValue('A1', "8");
                        $tulis->setCellValue('A2', "LAPORAN KONSULTASI 24 JAM");
                        $tulis->setCellValue('A3', "(LIHAT LAMPIRAN 8 RESUME KONSULTASI 24 JAM)");
                        $tulis->setCellValue('A4', "NAMA PERUSAHAAN");
                        $tulis->setCellValue('A6', "1");
                        $tulis->setCellValue('A8', "2");
                        $tulis->setCellValue('A11', "3");
                        $tulis->setCellValue('A23', "4");
                        $tulis->setCellValue('A31', "5");
                        $tulis->setCellValue('A33', "6");
                        $tulis->setCellValue('B6', "Periode");
                        $tulis->setCellValue('B8', "Jumlah Konsultasi");
                        $tulis->setCellValue('B11', "Kasus Terbanyak");
                        $tulis->setCellValue('B23', "Rujukan");
                        $tulis->setCellValue('B31', "Catatan Khusus");
                        $tulis->setCellValue('B33', "Kesimpulan");
                        $tulis->setCellValue('B35', "Diagram Prosentase Konsultasi Terhadap Total Kunjungan");
                        $tulis->setCellValue('C24', "DAK");
                        $tulis->setCellValue('C25', "Dokter Spesialis");
                        $tulis->setCellValue('C26', "Rumah Sakit");
                        $tulis->setCellValue('C27', "Laborat");
                        $tulis->setCellValue('C28', "Dokter Umum");
                        $tulis->setCellValue('C29', "Lainnya");
                        $tulis->setCellValue('C30', "Gigi");
                        $tulis->setCellValue('D6', " : ");
                        $tulis->setCellValue('D8', " : ");
                        $tulis->setCellValue('D11', " : ");
                        $tulis->setCellValue('D23', " : ");
                        $tulis->setCellValue('D31', " : ");
                        $tulis->setCellValue('D33', " : ");
                        $tulis->setCellValue('D24', " : ");
                        $tulis->setCellValue('D25', " : ");
                        $tulis->setCellValue('D26', " : ");
                        $tulis->setCellValue('D27', " : ");
                        $tulis->setCellValue('D28', " : ");
                        $tulis->setCellValue('D29', " : ");
                        $tulis->setCellValue('D30', " : ");
                        $tulis->setCellValue('E6', "(BULAN TAHUN)");
                        $tulis->setCellValue('F24', "Orang");
                        $tulis->setCellValue('F25', "Orang");
                        $tulis->setCellValue('F26', "Orang");
                        $tulis->setCellValue('F27', "Orang");
                        $tulis->setCellValue('F28', "Orang");
                        $tulis->setCellValue('F29', "Orang");
                        $tulis->setCellValue('F30', "Orang");

        $this->excel->getActiveSheet()->setTitle("8");

        }

        function laporan9()
        {
        $this->excel->createSheet(9);
        $tulis=$this->excel->setActiveSheetIndex(9);

                        $tulis->setCellValue('A1', "9");
                        $tulis->setCellValue('A2', "LAPORAN KEGIATAN MONITORING RAWAT INAP");
                        $tulis->setCellValue('A3', "(Lihat Lampiran 9 Daftar Kegiatan Monitoring RAWAT INAP)");
                        $tulis->setCellValue('A4', "NAMA PERUSAHAAN");
                        $tulis->setCellValue('A6', "1");
                        $tulis->setCellValue('A7', "2");
                        $tulis->setCellValue('A8', "3");
                        $tulis->setCellValue('A9', "4");
                        $tulis->setCellValue('A10', "5");
                        $tulis->setCellValue('A13', "6");
                        $tulis->setCellValue('A18', "7");
                        $tulis->setCellValue('A21', "8");
                        $tulis->setCellValue('A24', "9");
                        $tulis->setCellValue('B6', "Periode");
                        $tulis->setCellValue('B7', "Jumlah MRS");
                        $tulis->setCellValue('B8', "Jumlah Kunjungan RS");
                        $tulis->setCellValue('B9', "Jumlah Pemantauan per Telepon");
                        $tulis->setCellValue('B10', "Jenis Kasus");
                        $tulis->setCellValue('B13', "Hasil");
                        $tulis->setCellValue('B18', "Catatan Khusus");
                        $tulis->setCellValue('B21', "Kesimpulan");
                        $tulis->setCellValue('B24', "Rekomendasi");
                        $tulis->setCellValue('B27', "Diagram Hasil");
                        $tulis->setCellValue('C14', "Membaik");
                        $tulis->setCellValue('C15', "Tetap");
                        $tulis->setCellValue('C16', "Memburuk");
                        $tulis->setCellValue('D6', " : ");
                        $tulis->setCellValue('D7', " : ");
                        $tulis->setCellValue('D8', " : ");
                        $tulis->setCellValue('D9', " : ");
                        $tulis->setCellValue('D10', " : ");
                        $tulis->setCellValue('D14', " : ");
                        $tulis->setCellValue('D15', " : ");
                        $tulis->setCellValue('D16', " : ");
                        $tulis->setCellValue('D18', " : ");
                        $tulis->setCellValue('D21', " : ");
                        $tulis->setCellValue('D24', " : ");
                        $tulis->setCellValue('E6', "(BULAN TAHUN)");
                        $tulis->setCellValue('F24', "Orang");

        $this->excel->getActiveSheet()->setTitle("9");

        }

        function laporan10()
        {
        $this->excel->createSheet(10);
        $tulis=$this->excel->setActiveSheetIndex(10);

                        $tulis->setCellValue('A1', "10");
                        $tulis->setCellValue('A2', "LAPORAN KEGIATAN KUNJUNGAN RUMAH");
                        $tulis->setCellValue('A3', "(Lihat Lampiran 10 LAPORAN KEGIATAN KUNJUNGAN RUMAH)");
                        $tulis->setCellValue('A4', "NAMA PERUSAHAAN");
                        $tulis->setCellValue('A6', "1");
                        $tulis->setCellValue('A7', "2");
                        $tulis->setCellValue('A8', "3");
                        $tulis->setCellValue('A9', "4");
                        $tulis->setCellValue('A13', "5");
                        $tulis->setCellValue('A15', "6");
                        $tulis->setCellValue('A17', "7");
                        $tulis->setCellValue('B6', "Periode");
                        $tulis->setCellValue('B7', "Jumlah Rencana Kunjungan");
                        $tulis->setCellValue('B8', "Jumlah Kunjungan");
                        $tulis->setCellValue('B9', "Hasil");
                        $tulis->setCellValue('B13', "Kasus Terbanyak");
                        $tulis->setCellValue('B15', "Catatan Khusus");
                        $tulis->setCellValue('B17', "Catatan Khusus");
                        $tulis->setCellValue('C10', "Ketemu");
                        $tulis->setCellValue('C11', "Tidak Ketemu");
                        $tulis->setCellValue('C12', "Salah Alamat");
                        $tulis->setCellValue('D6', " : ");
                        $tulis->setCellValue('D7', " : ");
                        $tulis->setCellValue('D8', " : ");
                        $tulis->setCellValue('D11', " : ");
                        $tulis->setCellValue('D12', " : ");
                        $tulis->setCellValue('D13', " : ");
                        $tulis->setCellValue('D15', " : ");
                        $tulis->setCellValue('D17', " : ");
                        $tulis->setCellValue('E6', "(BULAN TAHUN)");
                        $tulis->setCellValue('F7', "Orang");
                        $tulis->setCellValue('F8', "Orang");
                        $tulis->setCellValue('F10', "Orang");
                        $tulis->setCellValue('F11', "Orang");
                        $tulis->setCellValue('F12', "Orang");

        $this->excel->getActiveSheet()->setTitle("10");

        }

        function laporan11()
        {
        $this->excel->createSheet(11);
        $tulis=$this->excel->setActiveSheetIndex(11);

                        $tulis->setCellValue('A1', "11");
                        $tulis->setCellValue('A2', "LAPORAN KEGIATAN KURATIF");
                        $tulis->setCellValue('A3', "(Lihat Lampiran 11 DAFTAR HADIR KUNJUNGAN BEROBAT)");
                        $tulis->setCellValue('A4', "NAMA PERUSAHAAN");
                        $tulis->setCellValue('A6', "1");
                        $tulis->setCellValue('A7', "2");
                        $tulis->setCellValue('A8', "3");
                        $tulis->setCellValue('A9', "4");
                        $tulis->setCellValue('A10', "5");
                        $tulis->setCellValue('A11', "6");
                        $tulis->setCellValue('A19', "7");
                        $tulis->setCellValue('A21', "8");
                        $tulis->setCellValue('B6', "Periode");
                        $tulis->setCellValue('B7', "Jumlah Kunjungan DAK");
                        $tulis->setCellValue('B8', "Jumlah Kunjungan Proaktif");
                        $tulis->setCellValue('B9', "Jumlah Kunjungan Berobat");
                        $tulis->setCellValue('B10', "Jumlah Konsultasi");
                        $tulis->setCellValue('B11', "Rujukan");
                        $tulis->setCellValue('B19', "Catatan Khusus");
                        $tulis->setCellValue('B21', "Kesimpulan Effektifitas");
                        $tulis->setCellValue('B24', "Diagram Kunjungan Terhada Total Kunjungan Disemua Pintu");
                        $tulis->setCellValue('B33', "Diagram Jenis Kunjungan");
                        $tulis->setCellValue('C12', "DAK");
                        $tulis->setCellValue('C13', "Dokter Spesialis");
                        $tulis->setCellValue('C14', "Rumah Sakit");
                        $tulis->setCellValue('C15', "Laborat");
                        $tulis->setCellValue('C16', "Dokter Umum");
                        $tulis->setCellValue('C17', "Lainnya");
                        $tulis->setCellValue('C18', "Gigi");
                        $tulis->setCellValue('D6', " : ");
                        $tulis->setCellValue('D7', " : ");
                        $tulis->setCellValue('D8', " : ");
                        $tulis->setCellValue('D9', " : ");
                        $tulis->setCellValue('D10', " : ");
                        $tulis->setCellValue('D11', " : ");
                        $tulis->setCellValue('D12', " : ");
                        $tulis->setCellValue('D13', " : ");
                        $tulis->setCellValue('D14', " : ");
                        $tulis->setCellValue('D15', " : ");
                        $tulis->setCellValue('D16', " : ");
                        $tulis->setCellValue('D17', " : ");
                        $tulis->setCellValue('D18', " : ");
                        $tulis->setCellValue('D19', " : ");
                        $tulis->setCellValue('D21', " : ");
                        $tulis->setCellValue('E6', "(BULAN TAHUN)");
                        $tulis->setCellValue('F7', "Orang");
                        $tulis->setCellValue('F8', "Orang");
                        $tulis->setCellValue('F9', "Orang");
                        $tulis->setCellValue('F10', "Orang");
                        $tulis->setCellValue('F11', "Orang");
                        $tulis->setCellValue('F12', "Orang");
                        $tulis->setCellValue('F13', "Orang");
                        $tulis->setCellValue('F14', "Orang");
                        $tulis->setCellValue('F15', "Orang");
                        $tulis->setCellValue('F17', "Orang");
                        $tulis->setCellValue('F18', "Orang");

        $this->excel->getActiveSheet()->setTitle("11");

        }

        function laporan12()
        {
        $this->excel->createSheet(12);
        $tulis=$this->excel->setActiveSheetIndex(12);

                        $tulis->setCellValue('A1', "12");
                        $tulis->setCellValue('A2', "LAPORAN POTRET KESEHATAN KARYAWAN");
                        $tulis->setCellValue('A3', "NAMA PERUSAHAAN");
                        $tulis->setCellValue('A6', "1");
                        $tulis->setCellValue('A7', "2");
                        $tulis->setCellValue('A8', "3");
                        $tulis->setCellValue('A17', "4");
                        $tulis->setCellValue('A20', "5");
                        $tulis->setCellValue('A24', "6");
                        $tulis->setCellValue('A26', "7");
                        $tulis->setCellValue('B6', "Periode");
                        $tulis->setCellValue('B7', "Jumlah Karyawan dan Pensiunan");
                        $tulis->setCellValue('B8', "Status Kesehatan Karyawan/Pensiunan");
                        $tulis->setCellValue('B17', "Jumlah Karyawan/Pensiunan dengan Perbaikan");
                        $tulis->setCellValue('B20', "Jumlah Konsultasi");
                        $tulis->setCellValue('B24', "Catatan Khusus");
                        $tulis->setCellValue('B26', "Rekomendasi");
                        $tulis->setCellValue('B28', "Diagram Status Kesehatan Sekarang");
                        $tulis->setCellValue('C9', "Sehat");
                        $tulis->setCellValue('C10', "Resiko Sakit");
                        $tulis->setCellValue('C11', "Sakit Single");
                        $tulis->setCellValue('C12', "Sakit Double");
                        $tulis->setCellValue('C13', "Sakit Triple");
                        $tulis->setCellValue('C14', "Sakit Multiple");
                        $tulis->setCellValue('D6', " : ");
                        $tulis->setCellValue('D7', " : ");
                        $tulis->setCellValue('D8', " : ");
                        $tulis->setCellValue('D9', " : ");
                        $tulis->setCellValue('D10', " : ");
                        $tulis->setCellValue('D11', " : ");
                        $tulis->setCellValue('D12', " : ");
                        $tulis->setCellValue('D13', " : ");
                        $tulis->setCellValue('D14', " : ");
                        $tulis->setCellValue('D17', " : ");
                        $tulis->setCellValue('D20', " : ");
                        $tulis->setCellValue('D24', " : ");
                        $tulis->setCellValue('D26', " : ");
                        $tulis->setCellValue('E6', "(BULAN TAHUN)");
                        $tulis->setCellValue('F7', "Orang");
                        $tulis->setCellValue('F9', "Orang");
                        $tulis->setCellValue('F10', "Orang");
                        $tulis->setCellValue('F11', "Orang");
                        $tulis->setCellValue('F12', "Orang");
                        $tulis->setCellValue('F13', "Orang");
                        $tulis->setCellValue('F14', "Orang");
                        $tulis->setCellValue('F17', "Orang");
                        $tulis->setCellValue('F20', "Status Kesehatan disusun berdasarkan data pemeriksaan fisik bulanan pada proaktif dan juga dari screening laboratorium dari hasil terapi.");
                        $tulis->setCellValue('F22', "Masih banyak pasien yang belum melakukan pemeriksaan laboratorium sehingga belum bisa ditentukan status kesehatannya.");

        $this->excel->getActiveSheet()->setTitle("12");

        }

        function laporan13()
        {
        $this->excel->createSheet(13);
        $tulis=$this->excel->setActiveSheetIndex(13);

                        $tulis->setCellValue('A1', "13");
                        $tulis->setCellValue('A2', "LAPORAN HASIL VERIFIKASI, KOREKSI, DAN REKOMENDASI");
                        $tulis->setCellValue('A3', "(Lihat Lampiran 13 HASIL VERIFIKASI, KOREKSI, DAN REKOMENDASI)");
                        $tulis->setCellValue('A4', "NAMA PERUSAHAAN");
                        $tulis->setCellValue('A6', "1");
                        $tulis->setCellValue('A7', "2");
                        $tulis->setCellValue('A8', "3");
                        $tulis->setCellValue('A30', "4");
                        $tulis->setCellValue('A32', "5");
                        $tulis->setCellValue('A37', "6");
                        $tulis->setCellValue('B6', "Periode");
                        $tulis->setCellValue('B7', "Jumlah Tagihan");
                        $tulis->setCellValue('B8', "Jumlah Pontensial Reduksi");
                        $tulis->setCellValue('B9', "Audit Biaya");
                        $tulis->setCellValue('B19', "Audit Pelayanan");
                        $tulis->setCellValue('B21', "Audit Obat");
                        $tulis->setCellValue('B25', "Analisa Khusus");
                        $tulis->setCellValue('B28', "Jumlah Real Reduksi");
                        $tulis->setCellValue('B28', "Catatan Khusus");
                        $tulis->setCellValue('B28', "Catatan Khusus");
                        $tulis->setCellValue('B28', "Diagram Total Biaya Tidak Wajar Terhadap Total Biaya");
                        $tulis->setCellValue('C10', "Tidak Sesuai Data Penanggung");
                        $tulis->setCellValue('C11', "Harga Obat");
                        $tulis->setCellValue('C12', "Hasil Laborat/Penunjang");
                        $tulis->setCellValue('C13', "Tarif Tindakan");
                        $tulis->setCellValue('C14', "Tarif Kamar");
                        $tulis->setCellValue('C15', "Tarif Dokter");
                        $tulis->setCellValue('C16', "Lain-lain");
                        $tulis->setCellValue('C17', "Tidak Sesuai SK Direksi");
                        $tulis->setCellValue('C22', "Rawat Inap");
                        $tulis->setCellValue('C23', "Rawat Jalan");
                        $tulis->setCellValue('C26', "Pilihan Obat");
                        $tulis->setCellValue('C27', "Penunjang");
                        $tulis->setCellValue('C28', "Tindakan tanpa Konfirmasi");
                        $tulis->setCellValue('C29', "Resep Berlebih");
                        $tulis->setCellValue('D6', " : ");
                        $tulis->setCellValue('D7', " : ");
                        $tulis->setCellValue('D8', " : ");
                        $tulis->setCellValue('D10', " : ");
                        $tulis->setCellValue('D11', " : ");
                        $tulis->setCellValue('D12', " : ");
                        $tulis->setCellValue('D13', " : ");
                        $tulis->setCellValue('D14', " : ");
                        $tulis->setCellValue('D17', " : ");
                        $tulis->setCellValue('D20', " : ");
                        $tulis->setCellValue('D24', " : ");
                        $tulis->setCellValue('D25', " : ");
                        $tulis->setCellValue('D26', " : ");
                        $tulis->setCellValue('D27', " : ");
                        $tulis->setCellValue('D28', " : ");
                        $tulis->setCellValue('D29', " : ");
                        $tulis->setCellValue('D30', " : ");
                        $tulis->setCellValue('D31', " : ");
                        $tulis->setCellValue('D32', " : ");
                        $tulis->setCellValue('D37', " : ");
                        $tulis->setCellValue('E6', "(BULAN TAHUN)");
                        $tulis->setCellValue('F7', "Tagihan");
                        $tulis->setCellValue('F9', "Tagihan");
                        $tulis->setCellValue('F10', "Tagihan");
                        $tulis->setCellValue('F11', "Tagihan");
                        $tulis->setCellValue('F12', "Tagihan");
                        $tulis->setCellValue('F13', "Tagihan");
                        $tulis->setCellValue('F14', "Tagihan");
                        $tulis->setCellValue('F17', "Tagihan");
                        $tulis->setCellValue('F19', "Tagihan");

        $this->excel->getActiveSheet()->setTitle("13");
        }

        function laporan14()
        {
        $this->excel->createSheet(14);
        $tulis=$this->excel->setActiveSheetIndex(14);

                        $tulis->setCellValue('A1', "14");
                        $tulis->setCellValue('A2', "DATABASE BIAYA KESEHATAN");
                        $tulis->setCellValue('A3', "(Lihat DATABASE BIAYA KESEHATAN)");
                        $tulis->setCellValue('A4', "NAMA PERUSAHAAN");
                        $tulis->setCellValue('A6', "1");
                        $tulis->setCellValue('A7', "2");
                        $tulis->setCellValue('A8', "3");
                        $tulis->setCellValue('A9', "4");
                        $tulis->setCellValue('A10', "5");
                        $tulis->setCellValue('A26', "6");
                        $tulis->setCellValue('A27', "7");
                        $tulis->setCellValue('A29', "8");
                        $tulis->setCellValue('A31', "9");
                        $tulis->setCellValue('B6', "Periode");
                        $tulis->setCellValue('B7', "Total biaya");
                        $tulis->setCellValue('B8', "Total tagihan");
                        $tulis->setCellValue('B9', "Jumlah Tagihan Rawat Jalan");
                        $tulis->setCellValue('B10', "Total Biaya Rawat Jalan");
                        $tulis->setCellValue('B12', "Jenis Tagihan");
                        $tulis->setCellValue('B16', "Rincian");
                        $tulis->setCellValue('B26', "Biaya per Penanggung Rawat Jalan");
                        $tulis->setCellValue('B27', "Total Biaya Rawat Inap");
                        $tulis->setCellValue('B29', "Catatan Khusus");
                        $tulis->setCellValue('B31', "Kesimpulan");
                        $tulis->setCellValue('B33', "Diagram Biaya Rawat Jalan dan Rawat Inap");
                        $tulis->setCellValue('B42', "Diagram Klasifikasi Biaya Rawat Jalan");
                        $tulis->setCellValue('C10', "Tidak Sesuai Data Penanggung");
                        $tulis->setCellValue('C11', "Jumlah Penanggung");
                        $tulis->setCellValue('C13', "Langganan");
                        $tulis->setCellValue('C14', "Restitusi");
                        $tulis->setCellValue('C15', "DAK");
                        $tulis->setCellValue('C17', "Apotek");
                        $tulis->setCellValue('C18', "Penunjang");
                        $tulis->setCellValue('C19', "Tindakan");
                        $tulis->setCellValue('C20', "Kamar");
                        $tulis->setCellValue('C21', "Dokter");
                        $tulis->setCellValue('C22', "Lain-lain");
                        $tulis->setCellValue('C23', "Gigi");
                        $tulis->setCellValue('C24', "Optik");
                        $tulis->setCellValue('C25', "Alkes");
                        $tulis->setCellValue('D6', " : ");
                        $tulis->setCellValue('D7', " : ");
                        $tulis->setCellValue('D8', " : ");
                        $tulis->setCellValue('D9', " : ");
                        $tulis->setCellValue('D10', " : ");
                        $tulis->setCellValue('D11', " : ");
                        $tulis->setCellValue('D13', " : ");
                        $tulis->setCellValue('D14', " : ");
                        $tulis->setCellValue('D15', " : ");
                        $tulis->setCellValue('D17', " : ");
                        $tulis->setCellValue('D18', " : ");
                        $tulis->setCellValue('D19', " : ");
                        $tulis->setCellValue('D20', " : ");
                        $tulis->setCellValue('D21', " : ");
                        $tulis->setCellValue('D22', " : ");
                        $tulis->setCellValue('D23', " : ");
                        $tulis->setCellValue('D24', " : ");
                        $tulis->setCellValue('D25', " : ");
                        $tulis->setCellValue('D26', " : ");
                        $tulis->setCellValue('D27', " : ");
                        $tulis->setCellValue('D29', " : ");
                        $tulis->setCellValue('D31', " : ");
                        $tulis->setCellValue('D32', " : ");
                        $tulis->setCellValue('D37', " : ");
                        $tulis->setCellValue('E6', "(BULAN TAHUN)");
                        $tulis->setCellValue('F8', "Tagihan");
                        $tulis->setCellValue('F9', "Tagihan");
                        $tulis->setCellValue('F11', "Orang");
        $this->excel->getActiveSheet()->setTitle("14");
        }

        function laporan15()
        {
        $this->excel->createSheet(15);
        $tulis=$this->excel->setActiveSheetIndex(15);

                        $tulis->setCellValue('A1', "15");
                        $tulis->setCellValue('A2', "ANALISIS BIAYA RAWAT INAP");
                        $tulis->setCellValue('A3', "(Lihat Lampiran 15 DATA BIAYA RAWAT INAP)");
                        $tulis->setCellValue('A4', "NAMA PERUSAHAAN");
                        $tulis->setCellValue('A6', "1");
                        $tulis->setCellValue('A7', "2");
                        $tulis->setCellValue('A8', "3");
                        $tulis->setCellValue('A9', "4");
                        $tulis->setCellValue('A18', "5");
                        $tulis->setCellValue('A20', "6");
                        $tulis->setCellValue('A22', "7");
                        $tulis->setCellValue('A27', "8");
                        $tulis->setCellValue('A31', "9");
                        $tulis->setCellValue('B6', "Periode");
                        $tulis->setCellValue('B7', "Total Tagihan");
                        $tulis->setCellValue('B8', "Jumlah Tagihan Rawat Inap");
                        $tulis->setCellValue('B9', "Total Biaya Rawat Inap");
                        $tulis->setCellValue('B10', "Jumlah Penanggung");
                        $tulis->setCellValue('B18', "Selisih Biaya Naik Kelas");
                        $tulis->setCellValue('B20', "Biaya per Penanggung");
                        $tulis->setCellValue('B22', "Catatan Khusus");
                        $tulis->setCellValue('B27', "Kesimpulan");
                        $tulis->setCellValue('B31', "Rekomendasi");
                        $tulis->setCellValue('B34', "Diagram Biaya Rawat Inap terhasap Total");
                        $tulis->setCellValue('B45', "Diagram Klasifikasi Biaya Rawat Inap");
                        $tulis->setCellValue('C11', "Dokter");
                        $tulis->setCellValue('D6', " : ");
                        $tulis->setCellValue('D7', " : ");
                        $tulis->setCellValue('D8', " : ");
                        $tulis->setCellValue('D9', " : ");
                        $tulis->setCellValue('D10', " : ");
                        $tulis->setCellValue('D11', " : ");
                        $tulis->setCellValue('D18', " : ");
                        $tulis->setCellValue('D20', " : ");
                        $tulis->setCellValue('D21', " : ");
                        $tulis->setCellValue('D22', " : ");
                        $tulis->setCellValue('D27', " : ");
                        $tulis->setCellValue('D31', " : ");
                        $tulis->setCellValue('E6', "(BULAN TAHUN)");
                        $tulis->setCellValue('F9', "Tagihan");
                        $tulis->setCellValue('F10', "Orang");
         $this->excel->getActiveSheet()->setTitle("15");
        }

        function laporan16()
        {
        $this->excel->createSheet(16);
        $tulis=$this->excel->setActiveSheetIndex(16);

                        $tulis->setCellValue('A1', "16");
                        $tulis->setCellValue('A2', "ANALISIS BIAYA 20% BIAYA TERBESAR");
                        $tulis->setCellValue('A3', "(Lihat Lampiran 16 DATA 20% BIAYA TERBESAR)");
                        $tulis->setCellValue('A4', "NAMA PERUSAHAAN");
                        $tulis->setCellValue('A6', "1");
                        $tulis->setCellValue('A7', "2");
                        $tulis->setCellValue('A8', "3");
                        $tulis->setCellValue('A10', "4");
                        $tulis->setCellValue('A12', "5");
                        $tulis->setCellValue('A14', "6");
                        $tulis->setCellValue('B6', "Periode");
                        $tulis->setCellValue('B7', "Total Tagihan");
                        $tulis->setCellValue('B8', "Jumlah Tagihan Rawat Inap");
                        $tulis->setCellValue('B10', "Jumlah Penanggung");
                        $tulis->setCellValue('B12', "Selisih Biaya Naik Kelas");
                        $tulis->setCellValue('B14', "Biaya per Penanggung");
                        $tulis->setCellValue('B17', "Diagram 20% Biaya Terbesar Terhadap Total Biaya");
                        $tulis->setCellValue('D6', " : ");
                        $tulis->setCellValue('D7', " : ");
                        $tulis->setCellValue('D8', " : ");
                        $tulis->setCellValue('D10', " : ");
                        $tulis->setCellValue('D12', " : ");
                        $tulis->setCellValue('D14', " : ");
                        $tulis->setCellValue('E6', "(BULAN TAHUN)");
        $this->excel->getActiveSheet()->setTitle("16");
        }

        function Templatelaporan()
        {
        $this->excel->createSheet(16);
        $tulis=$this->excel->setActiveSheetIndex(16);

                        $tulis->setCellValue('A1', "16");
                        $tulis->setCellValue('A2', "ANALISIS BIAYA 20% BIAYA TERBESAR");
                        $tulis->setCellValue('A3', "(Lihat Lampiran 16 DATA 20% BIAYA TERBESAR)");
                        $tulis->setCellValue('A4', "NAMA PERUSAHAAN");
                        $tulis->setCellValue('A6', "1");
                        $tulis->setCellValue('A7', "2");
                        $tulis->setCellValue('A8', "3");
                        $tulis->setCellValue('A9', "3");
                        $tulis->setCellValue('A10', "4");
                        $tulis->setCellValue('A11', "4");
                        $tulis->setCellValue('A12', "5");
                        $tulis->setCellValue('A13', "5");
                        $tulis->setCellValue('A14', "6");
                        $tulis->setCellValue('A15', "6");
                        $tulis->setCellValue('A16', "6");
                        $tulis->setCellValue('A17', "6");
                        $tulis->setCellValue('A18', "6");
                        $tulis->setCellValue('A19', "6");
                        $tulis->setCellValue('A20', "6");
                        $tulis->setCellValue('A21', "6");
                        $tulis->setCellValue('A22', "6");
                        $tulis->setCellValue('A23', "6");
                        $tulis->setCellValue('A24', "6");
                        $tulis->setCellValue('B1', "");
                        $tulis->setCellValue('B2', "");
                        $tulis->setCellValue('B3', "");
                        $tulis->setCellValue('B4', "");
                        $tulis->setCellValue('B6', "1");
                        $tulis->setCellValue('B7', "2");
                        $tulis->setCellValue('B8', "3");
                        $tulis->setCellValue('B9', "3");
                        $tulis->setCellValue('B10', "4");
                        $tulis->setCellValue('B11', "4");
                        $tulis->setCellValue('B12', "5");
                        $tulis->setCellValue('B13', "5");
                        $tulis->setCellValue('B14', "6");
                        $tulis->setCellValue('B15', "6");
                        $tulis->setCellValue('B16', "6");
                        $tulis->setCellValue('B17', "6");
                        $tulis->setCellValue('B18', "6");
                        $tulis->setCellValue('B19', "6");
                        $tulis->setCellValue('B20', "6");
                        $tulis->setCellValue('B21', "6");
                        $tulis->setCellValue('B22', "6");
                        $tulis->setCellValue('B23', "6");
                        $tulis->setCellValue('B24', "6");
                        $tulis->setCellValue('C1', "");
                        $tulis->setCellValue('C2', "");
                        $tulis->setCellValue('C3', "");
                        $tulis->setCellValue('C4', "");
                        $tulis->setCellValue('C6', "1");
                        $tulis->setCellValue('C7', "2");
                        $tulis->setCellValue('C8', "3");
                        $tulis->setCellValue('C9', "3");
                        $tulis->setCellValue('C10', "4");
                        $tulis->setCellValue('C11', "4");
                        $tulis->setCellValue('C12', "5");
                        $tulis->setCellValue('C13', "5");
                        $tulis->setCellValue('C14', "6");
                        $tulis->setCellValue('C15', "6");
                        $tulis->setCellValue('C16', "6");
                        $tulis->setCellValue('C17', "6");
                        $tulis->setCellValue('C18', "6");
                        $tulis->setCellValue('C19', "6");
                        $tulis->setCellValue('C20', "6");
                        $tulis->setCellValue('C21', "6");
                        $tulis->setCellValue('C22', "6");
                        $tulis->setCellValue('C23', "6");
                        $tulis->setCellValue('C24', "6");
                        $tulis->setCellValue('D1', " : ");
                        $tulis->setCellValue('D2', " : ");
                        $tulis->setCellValue('D3', " : ");
                        $tulis->setCellValue('D4', " : ");
                        $tulis->setCellValue('D6', " : ");
                        $tulis->setCellValue('D7', " : ");
                        $tulis->setCellValue('D8', " : ");
                        $tulis->setCellValue('D9', " : ");
                        $tulis->setCellValue('D10', " : ");
                        $tulis->setCellValue('D11', " : ");
                        $tulis->setCellValue('D12', " : ");
                        $tulis->setCellValue('D13', " : ");
                        $tulis->setCellValue('D14', " : ");
                        $tulis->setCellValue('D15', " : ");
                        $tulis->setCellValue('D16', " : ");
                        $tulis->setCellValue('D17', " : ");
                        $tulis->setCellValue('D18', " : ");
                        $tulis->setCellValue('D19', " : ");
                        $tulis->setCellValue('D20', " : ");
                        $tulis->setCellValue('D21', " : ");
                        $tulis->setCellValue('D22', " : ");
                        $tulis->setCellValue('D23', " : ");
                        $tulis->setCellValue('D24', " : ");
                        $tulis->setCellValue('F1', "");
                        $tulis->setCellValue('F2', "");
                        $tulis->setCellValue('F3', "");
                        $tulis->setCellValue('F4', "");
                        $tulis->setCellValue('F6', "1");
                        $tulis->setCellValue('F7', "2");
                        $tulis->setCellValue('F8', "3");
                        $tulis->setCellValue('F9', "3");
                        $tulis->setCellValue('F10', "4");
                        $tulis->setCellValue('F11', "4");
                        $tulis->setCellValue('F12', "5");
                        $tulis->setCellValue('F13', "5");
                        $tulis->setCellValue('F14', "6");
                        $tulis->setCellValue('F15', "6");
                        $tulis->setCellValue('F16', "6");
                        $tulis->setCellValue('F17', "6");
                        $tulis->setCellValue('F18', "6");
                        $tulis->setCellValue('F19', "6");
                        $tulis->setCellValue('F20', "6");
                        $tulis->setCellValue('F21', "6");
                        $tulis->setCellValue('F22', "6");
                        $tulis->setCellValue('F23', "6");
                        $tulis->setCellValue('F24', "6");
        $this->excel->getActiveSheet()->setTitle("16");
        }

        function laporan17()
        {
        $this->excel->createSheet(17);
        $tulis=$this->excel->setActiveSheetIndex(17);

                        $tulis->setCellValue('A1', "17");
                        $tulis->setCellValue('A2', "KLASIFIKASI BIAYA KESEHATAN - BIAYA KECELAKAAN");
                        $tulis->setCellValue('A3', "(Lihat Lampiran 17 DATA BIAYA KECELAKAAN)");
                        $tulis->setCellValue('A4', "NAMA PERUSAHAAN");
                        $tulis->setCellValue('A6', "1");
                        $tulis->setCellValue('A7', "2");
                        $tulis->setCellValue('A8', "3");
                        $tulis->setCellValue('A12', "4");
                        $tulis->setCellValue('A14', "5");
                        $tulis->setCellValue('A17', "6");
                        $tulis->setCellValue('B1', "");
                        $tulis->setCellValue('B2', "");
                        $tulis->setCellValue('B3', "");
                        $tulis->setCellValue('B4', "");
                        $tulis->setCellValue('B6', "Periode");
                        $tulis->setCellValue('B7', "Total Biaya");
                        $tulis->setCellValue('B8', "Biaya Kecelakaan/ Accident");
                        $tulis->setCellValue('B12', "Biaya Per kasus");
                        $tulis->setCellValue('B14', "Catatan Khusus");
                        $tulis->setCellValue('B17', "Kesimpulan");
                        $tulis->setCellValue('B20', "Diagram Klasifikasi Biaya");
                        $tulis->setCellValue('C9', "Rawat Inap");
                        $tulis->setCellValue('C10', "Rawat Jalan");
                        $tulis->setCellValue('D6', " : ");
                        $tulis->setCellValue('D7', " : ");
                        $tulis->setCellValue('D8', " : ");
                        $tulis->setCellValue('D9', " : ");
                        $tulis->setCellValue('D10', " : ");
                        $tulis->setCellValue('D12', " : ");
                        $tulis->setCellValue('D14', " : ");
                        $tulis->setCellValue('D17', " : ");
                        $tulis->setCellValue('E6', "(Bulan tahun)");
        $this->excel->getActiveSheet()->setTitle("17");
        }

        function laporan18()
        {
        $this->excel->createSheet(18);
        $tulis=$this->excel->setActiveSheetIndex(18);

                        $tulis->setCellValue('A1', "18");
                        $tulis->setCellValue('A2', "KLASIFIKASI BIAYA KESEHATAN-TIDAK SAKIT");
                        $tulis->setCellValue('A3', "(Lihat Lampiran 18 DATA BIAYA TIDAK SAKIT)");
                        $tulis->setCellValue('A4', "NAMA PERUSAHAAN");
                        $tulis->setCellValue('A6', "1");
                        $tulis->setCellValue('A7', "2");
                        $tulis->setCellValue('A8', "3");
                        $tulis->setCellValue('A15', "4");
                        $tulis->setCellValue('A17', "5");
                        $tulis->setCellValue('A18', "6");
                        $tulis->setCellValue('A20', "7");
                        $tulis->setCellValue('B6', "Periode");
                        $tulis->setCellValue('B7', "Total Biaya");
                        $tulis->setCellValue('B8', "Biaya Tidak Sakit");
                        $tulis->setCellValue('B15', "Biaya Per Penanggung");
                        $tulis->setCellValue('B17', "Catatan Khusus");
                        $tulis->setCellValue('B20', "Kesimpulan");
                        $tulis->setCellValue('B23', "Diagram Klasifikasi Biaya");
                        $tulis->setCellValue('C1', "");
                        $tulis->setCellValue('C2', "");
                        $tulis->setCellValue('C3', "");
                        $tulis->setCellValue('C4', "");
                        $tulis->setCellValue('C6', "1");
                        $tulis->setCellValue('C7', "2");
                        $tulis->setCellValue('C8', "3");
                        $tulis->setCellValue('C9', "Kehamilan");
                        $tulis->setCellValue('C10', "Imunisasi");
                        $tulis->setCellValue('C11', "Melahirkan");
                        $tulis->setCellValue('C12', "Lain-lain");
                        $tulis->setCellValue('C13', "Sirkumsisi");
                        $tulis->setCellValue('C14', "Penyakit");
                        $tulis->setCellValue('D6', " : ");
                        $tulis->setCellValue('D7', " : ");
                        $tulis->setCellValue('D8', " : ");
                        $tulis->setCellValue('D9', " : ");
                        $tulis->setCellValue('D10', " : ");
                        $tulis->setCellValue('D11', " : ");
                        $tulis->setCellValue('D12', " : ");
                        $tulis->setCellValue('D13', " : ");
                        $tulis->setCellValue('D14', " : ");
                        $tulis->setCellValue('D15', " : ");
                        $tulis->setCellValue('D17', " : ");
                        $tulis->setCellValue('D20', " : ");
                        $tulis->setCellValue('E6', "bulan tahun");
        $this->excel->getActiveSheet()->setTitle("18");
        }

        function laporan19()
        {
        $this->excel->createSheet(19);
        $tulis=$this->excel->setActiveSheetIndex(19);

                        $tulis->setCellValue('A1', "19");
                        $tulis->setCellValue('A2', "KLASIFIKASI BIAYA KESEHATAN-SAKIT DEGENERATIF/BERAT");
                        $tulis->setCellValue('A3', "(Lihat Lampiran 19 DATA BIAYA SAKIT DEGENERATIF/BERAT)");
                        $tulis->setCellValue('A4', "NAMA PERUSAHAAN");
                        $tulis->setCellValue('A6', "1");
                        $tulis->setCellValue('A7', "2");
                        $tulis->setCellValue('A8', "3");
                        $tulis->setCellValue('A14', "6");
                        $tulis->setCellValue('A16', "6");
                        $tulis->setCellValue('A20', "6");
                        $tulis->setCellValue('B6', "Periode");
                        $tulis->setCellValue('B7', "Total Biaya");
                        $tulis->setCellValue('B8', "Biaya Sakit Degeneratif/Berat");
                        $tulis->setCellValue('B14', "Biaya Per Penanggung");
                        $tulis->setCellValue('B16', "Catatan Khusus");
                        $tulis->setCellValue('B20', "Kesimpulan");
                        $tulis->setCellValue('B23', "Diagram Klasifikasi Biaya");
                        $tulis->setCellValue('C9', "Karyawan");
                        $tulis->setCellValue('C10', "Keluarga Karyawan");
                        $tulis->setCellValue('C11', "Pensiunan");
                        $tulis->setCellValue('C12', "Keluarga Pensiunan");
                        $tulis->setCellValue('D6', " : ");
                        $tulis->setCellValue('D7', " : ");
                        $tulis->setCellValue('D8', " : ");
                        $tulis->setCellValue('D9', " : ");
                        $tulis->setCellValue('D10', " : ");
                        $tulis->setCellValue('D11', " : ");
                        $tulis->setCellValue('D12', " : ");
                        $tulis->setCellValue('D14', " : ");
                        $tulis->setCellValue('D16', " : ");
                        $tulis->setCellValue('D20', " : ");
                        $tulis->setCellValue('E6', "(bulan tahun)");
                        $tulis->setCellValue('F23', "Diagram Biaya Sakit Degeneratif terhadap Total");
        $this->excel->getActiveSheet()->setTitle("19");
        }

        function laporan20()
        {
        $this->excel->createSheet(20);
        $tulis=$this->excel->setActiveSheetIndex(20);

                        $tulis->setCellValue('A1', "20");
                        $tulis->setCellValue('A2', "KLASIFIKASI BIAYA KESEHATAN-SAKIT NON DEGENERATIF");
                        $tulis->setCellValue('A3', "(Lihat Lampiran 20 DATA BIAYA SAKIT NON DEGENERATIF)");
                        $tulis->setCellValue('A4', "NAMA PERUSAHAAN");
                        $tulis->setCellValue('A6', "1");
                        $tulis->setCellValue('A7', "2");
                        $tulis->setCellValue('A8', "3");
                        $tulis->setCellValue('A14', "4");
                        $tulis->setCellValue('A16', "5");
                        $tulis->setCellValue('A19', "6");
                        $tulis->setCellValue('B6', "Periode");
                        $tulis->setCellValue('B7', "Total Biaya");
                        $tulis->setCellValue('B8', "Biaya Sakit Non Degeneratif");
                        $tulis->setCellValue('B14', "Biaya Per Penanggung");
                        $tulis->setCellValue('B16', "Catatan Khusus");
                        $tulis->setCellValue('B19', "Kesimpulan");
                        $tulis->setCellValue('B22', "Diagram Klasifikasi Biaya Sakit Non Degeneratif");
                        $tulis->setCellValue('C9', "Karyawan");
                        $tulis->setCellValue('C10', "Keluarga Karyawan");
                        $tulis->setCellValue('C11', "Pensiunan");
                        $tulis->setCellValue('C12', "Keluarga Pensiunan");
                        $tulis->setCellValue('D6', " : ");
                        $tulis->setCellValue('D7', " : ");
                        $tulis->setCellValue('D8', " : ");
                        $tulis->setCellValue('D9', " : ");
                        $tulis->setCellValue('D10', " : ");
                        $tulis->setCellValue('D11', " : ");
                        $tulis->setCellValue('D12', " : ");
                        $tulis->setCellValue('D14', " : ");
                        $tulis->setCellValue('D16', " : ");
                        $tulis->setCellValue('D19', " : ");
                        $tulis->setCellValue('E6', "bulan tahun");
        $this->excel->getActiveSheet()->setTitle("20");
        }

        function laporan21()
        {
        $this->excel->createSheet(21);
        $tulis=$this->excel->setActiveSheetIndex(21);

                        $tulis->setCellValue('A1', "21");
                        $tulis->setCellValue('A2', "KLASIFIKASI BIAYA KESEHATAN-TIDAK WAJAR");
                        $tulis->setCellValue('A3', "(Lihat Lampiran 21DATA BIAYA TIDAK WAJAR)");
                        $tulis->setCellValue('A4', "NAMA PERUSAHAAN");
                        $tulis->setCellValue('A6', "1");
                        $tulis->setCellValue('A7', "2");
                        $tulis->setCellValue('A8', "3");
                        $tulis->setCellValue('A13', "4");
                        $tulis->setCellValue('A15', "5");
                        $tulis->setCellValue('A19', "6");
                        $tulis->setCellValue('B6', "Periode");
                        $tulis->setCellValue('B7', "Total Biaya");
                        $tulis->setCellValue('B8', "Biaya Tidak Wajar");
                        $tulis->setCellValue('B13', "Catatn Khusus");
                        $tulis->setCellValue('B15', "Kesimpulan");
                        $tulis->setCellValue('B19', "Rekomendasi");
                        $tulis->setCellValue('B23', "Diagram Klasifikasi Biaya");
                        $tulis->setCellValue('C9', "Karyawan");
                        $tulis->setCellValue('C10', "Pensiunan");
                        $tulis->setCellValue('D6', " : ");
                        $tulis->setCellValue('D7', " : ");
                        $tulis->setCellValue('D8', " : ");
                        $tulis->setCellValue('D9', " : ");
                        $tulis->setCellValue('D10', " : ");
                        $tulis->setCellValue('D13', " : ");
                        $tulis->setCellValue('D15', " : ");
                        $tulis->setCellValue('D19', " : ");
                        $tulis->setCellValue('E6', "bulan tahun");
        $this->excel->getActiveSheet()->setTitle("21");
        }

        function laporan22()
        {
        $this->excel->createSheet(22);
        $tulis=$this->excel->setActiveSheetIndex(22);

                        $tulis->setCellValue('A1', "22");
                        $tulis->setCellValue('A2', "ANALISIS RASIONALISASI BIAYA");
                        $tulis->setCellValue('A3', "NAMA PERUSAHAAN");
                        $tulis->setCellValue('A5', "1");
                        $tulis->setCellValue('A6', "2");
                        $tulis->setCellValue('A7', "3");
                        $tulis->setCellValue('A8', "4");
                        $tulis->setCellValue('A9', "5");
                        $tulis->setCellValue('A10', "6");
                        $tulis->setCellValue('A11', "7");
                        $tulis->setCellValue('A12', "8");
                        $tulis->setCellValue('A13', "9");
                        $tulis->setCellValue('A15', "10");
                        $tulis->setCellValue('A17', "11");
                        $tulis->setCellValue('A20', "12");
                        $tulis->setCellValue('A25', "13");
                        $tulis->setCellValue('B5', "Periode");
                        $tulis->setCellValue('B6', "Jumlah Tagihan");
                        $tulis->setCellValue('B7', "Total Biaya");
                        $tulis->setCellValue('B8', "Rata-rata biaya per penanggung");
                        $tulis->setCellValue('B9', "Rata-rata biaya per Kunjungan");
                        $tulis->setCellValue('B10', "Biaya per penanggung Rawat jalan");
                        $tulis->setCellValue('B11', "Biaya per penanggung Rawat inap");
                        $tulis->setCellValue('B12', "Biaya per kasus Accident");
                        $tulis->setCellValue('B13', "Biaya per penanggung biaya tidak sakit");
                        $tulis->setCellValue('B15', "Biaya per penanggung biaya sakit degeneratif");
                        $tulis->setCellValue('B17', "Biaya per penanggung biaya sakit non degeneratif");
                        $tulis->setCellValue('B20', "Catatan Khusus");
                        $tulis->setCellValue('B25', "Kesimpulan");
                        $tulis->setCellValue('D5', " : ");
                        $tulis->setCellValue('D6', " : ");
                        $tulis->setCellValue('D7', " : ");
                        $tulis->setCellValue('D8', " : ");
                        $tulis->setCellValue('D9', " : ");
                        $tulis->setCellValue('D10', " : ");
                        $tulis->setCellValue('D11', " : ");
                        $tulis->setCellValue('D12', " : ");
                        $tulis->setCellValue('D13', " : ");
                        $tulis->setCellValue('D15', " : ");
                        $tulis->setCellValue('D17', " : ");
                        $tulis->setCellValue('D20', " : ");
                        $tulis->setCellValue('D25', " : ");
                        $tulis->setCellValue('E5', "bulan tahun");
        $this->excel->setActiveSheetIndex(22);
        $this->excel->getActiveSheet()->setTitle("22");
        }

        function laporan23()
        {
        $this->excel->createSheet(23);
        $tulis=$this->excel->setActiveSheetIndex(23);

                        $tulis->setCellValue('A1', "23");
                        $tulis->setCellValue('A2', "AUDIT PELAYANAN KESEHATAN-TREN POLIFARMASI");
                        $tulis->setCellValue('A3', "(Lihat Lampiran 23 DATA TREN POLIFARMASI)");
                        $tulis->setCellValue('A4', "NAMA PERUSAHAAN");
                        $tulis->setCellValue('A6', "1");
                        $tulis->setCellValue('A7', "2");
                        $tulis->setCellValue('A8', "3");
                        $tulis->setCellValue('A9', "4");
                        $tulis->setCellValue('A16', "5");
                        $tulis->setCellValue('A22', "6");
                        $tulis->setCellValue('A26', "7");
                        $tulis->setCellValue('B6', "Periode");
                        $tulis->setCellValue('B7', "Jumlah Dokter dengan polifarmasi");
                        $tulis->setCellValue('B8', "Jumlah Tagihan Polifarmasi");
                        $tulis->setCellValue('B9', "Dokter tersering");
                        $tulis->setCellValue('B16', "Catatan Khusus");
                        $tulis->setCellValue('B22', "Kesimpulan");
                        $tulis->setCellValue('B26', "Rekomendasi");
                        $tulis->setCellValue('B29', "Grafik Trend Dokter Polifarmasi ");
                        $tulis->setCellValue('D6', " : ");
                        $tulis->setCellValue('D7', " : ");
                        $tulis->setCellValue('D8', " : ");
                        $tulis->setCellValue('D9', " : ");
                        $tulis->setCellValue('D16', " : ");
                        $tulis->setCellValue('D17', " : ");
                        $tulis->setCellValue('D22', " : ");
                        $tulis->setCellValue('D26', " : ");
                        $tulis->setCellValue('E6', "Bulan tahun");
                        $tulis->setCellValue('F7', "Dokter");
                        $tulis->setCellValue('F8', "Tagihan");
        $this->excel->getActiveSheet()->setTitle("23");
        }

        function laporan24()
        {
        $this->excel->createSheet(24);
        $tulis=$this->excel->setActiveSheetIndex(24);

                        $tulis->setCellValue('A1', "24");
                        $tulis->setCellValue('A2', "AUDIT PELAYANAN KESEHATAN-TREN MAHAL");
                        $tulis->setCellValue('A3', "(Lihat Lampiran 24 DATA TREN MAHAL)");
                        $tulis->setCellValue('A4', "NAMA PERUSAHAAN");
                        $tulis->setCellValue('A6', "1");
                        $tulis->setCellValue('A7', "2");
                        $tulis->setCellValue('A8', "3");
                        $tulis->setCellValue('A9', "4");
                        $tulis->setCellValue('A16', "5");
                        $tulis->setCellValue('A20', "6");
                        $tulis->setCellValue('A24', "7");
                        $tulis->setCellValue('B6', "Periode");
                        $tulis->setCellValue('B7', "Jumlah Dokter ");
                        $tulis->setCellValue('B8', "Jumlah Tagihan Trend Mahal");
                        $tulis->setCellValue('B9', "Dokter tersering");
                        $tulis->setCellValue('B16', "Catatan Khusus");
                        $tulis->setCellValue('B20', "Kesimpulan");
                        $tulis->setCellValue('B24', "Rekomendasi");
                        $tulis->setCellValue('B27', "Grafik Trend Dokter Mahal");
                        $tulis->setCellValue('D6', " : ");
                        $tulis->setCellValue('D7', " : ");
                        $tulis->setCellValue('D8', " : ");
                        $tulis->setCellValue('D9', " : ");
                        $tulis->setCellValue('D16', " : ");
                        $tulis->setCellValue('D20', " : ");
                        $tulis->setCellValue('D24', " : ");
                        $tulis->setCellValue('E6', "blan tahun");
        $this->excel->getActiveSheet()->setTitle("24");
        }

        function laporan25()
        {
        $this->excel->createSheet(25);
        $tulis=$this->excel->setActiveSheetIndex(25);

                        $tulis->setCellValue('A1', "25");
                        $tulis->setCellValue('A2', "AUDIT PELAYANAN KESEHATAN-TREN BEROBAT SEKELUARGA");
                        $tulis->setCellValue('A3', "(Lihat Lampiran 24 DATA TREN MAHAL)");
                        $tulis->setCellValue('A4', "NAMA PERUSAHAAN");
                        $tulis->setCellValue('A6', "1");
                        $tulis->setCellValue('A7', "2");
                        $tulis->setCellValue('A8', "3");
                        $tulis->setCellValue('A9', "4");
                        $tulis->setCellValue('A16', "5");
                        $tulis->setCellValue('A20', "6");
                        $tulis->setCellValue('B6', "Periode");
                        $tulis->setCellValue('B7', "Karyawan Berobat Sekeluarga ");
                        $tulis->setCellValue('B8', "Jumlah Berobat Sekeluarga");
                        $tulis->setCellValue('B9', "Penanggung tersering");
                        $tulis->setCellValue('B16', "Catatan Khusus");
                        $tulis->setCellValue('B20', "Kesimpulan");
                        $tulis->setCellValue('B26', "Grafik Tren Berobat Sekeluarga6");
                        $tulis->setCellValue('D6', " : ");
                        $tulis->setCellValue('D7', " : ");
                        $tulis->setCellValue('D8', " : ");
                        $tulis->setCellValue('D9', " : ");
                        $tulis->setCellValue('D16', " : ");
                        $tulis->setCellValue('D20', " : ");
                        $tulis->setCellValue('F7', "Keluarga");
                        $tulis->setCellValue('F8', "Tagihan");;
        $this->excel->getActiveSheet()->setTitle("25");
        }

        function laporan26()
        {
        $this->excel->createSheet(26);
        $tulis=$this->excel->setActiveSheetIndex(26);

                        $tulis->setCellValue('A1', "26");
                        $tulis->setCellValue('A2', "AUDIT PELAYANAN KESEHATAN-TREN OBAT BERLEBIH");
                        $tulis->setCellValue('A3', "(Lihat Lampiran 26 DATA TREN OBAT BERLEBIH)");
                        $tulis->setCellValue('A4', "NAMA PERUSAHAAN");
                        $tulis->setCellValue('A6', "1");
                        $tulis->setCellValue('A7', "2");
                        $tulis->setCellValue('A8', "3");
                        $tulis->setCellValue('A9', "4");
                        $tulis->setCellValue('A16', "5");
                        $tulis->setCellValue('A20', "6");
                        $tulis->setCellValue('A22', "7");
                        $tulis->setCellValue('B6', "Periode");
                        $tulis->setCellValue('B7', "Jumlah Dokter Dengan Obat Berlebih ");
                        $tulis->setCellValue('B8', "Jumlah Tagihan Obat Berlebih");
                        $tulis->setCellValue('B9', "Dokter tersering");
                        $tulis->setCellValue('B16', "Catatan Khusus");
                        $tulis->setCellValue('B20', "Kesimpulan");
                        $tulis->setCellValue('B22', "Kesimpulan");
                        $tulis->setCellValue('B25', "Grafik Trend Dokter Obat Berlebih ");
                        $tulis->setCellValue('D6', " : ");
                        $tulis->setCellValue('D7', " : ");
                        $tulis->setCellValue('D8', " : ");
                        $tulis->setCellValue('D9', " : ");
                        $tulis->setCellValue('D16', " : ");
                        $tulis->setCellValue('D20', " : ");
                        $tulis->setCellValue('D22', " : ");
                        $tulis->setCellValue('E6', "Bulan tahun");
                        $tulis->setCellValue('F7', "Dokter");
                        $tulis->setCellValue('F8', "Tagihan");
        $this->excel->getActiveSheet()->setTitle("26");
        }

        function laporan27()
        {
        $this->excel->createSheet(27);
        $tulis=$this->excel->setActiveSheetIndex(27);

                        $tulis->setCellValue('A1', "27");
                        $tulis->setCellValue('A2', "MONITORING DAN ANALISIS SHOPPING DOKTER");
                        $tulis->setCellValue('A3', "NAMA PERUSAHAAN");
                        $tulis->setCellValue('A6', "1");
                        $tulis->setCellValue('A8', "3");
                        $tulis->setCellValue('A10', "4");
                        $tulis->setCellValue('A12', "5");
                        $tulis->setCellValue('A14', "6");
                        $tulis->setCellValue('A16', "6");
                        $tulis->setCellValue('A22', "6");
                        $tulis->setCellValue('B1', "");
                        $tulis->setCellValue('B2', "");
                        $tulis->setCellValue('B3', "");
                        $tulis->setCellValue('B4', "");
                        $tulis->setCellValue('B6', "Periode");
                        $tulis->setCellValue('B8', "Jumlah Penanggung ");
                        $tulis->setCellValue('B10', "Penanggung Tersering");
                        $tulis->setCellValue('B12', "Total Biaya Shoping Dokter");
                        $tulis->setCellValue('B14', "Catatan Khusus");
                        $tulis->setCellValue('B16', "Kesimpulan");
                        $tulis->setCellValue('B22', "Kesimpulan");
                        $tulis->setCellValue('B25', "Grafik Trend Dokter Obat Berlebih ");
                        $tulis->setCellValue('D6', " : ");
                        $tulis->setCellValue('D8', " : ");
                        $tulis->setCellValue('D10', " : ");
                        $tulis->setCellValue('D12', " : ");
                        $tulis->setCellValue('D14', " : ");
                        $tulis->setCellValue('D16', " : ");
                        $tulis->setCellValue('D22', " : ");
                        $tulis->setCellValue('E6', "bulan tahun");
                        $tulis->setCellValue('F8', "Orang");
        $this->excel->getActiveSheet()->setTitle("27");
        }

        function laporan28()
        {
        $this->excel->createSheet(28);
        $tulis=$this->excel->setActiveSheetIndex(28);

                        $tulis->setCellValue('A1', "16");
                        $tulis->setCellValue('A2', "KLARIFIKASI KEPADA PIHAK PROVIDER");
                        $tulis->setCellValue('A3', "(Lihat Lampiran 28 DATA KLARIFIKASI KEPADA PIHAK PROVIDER)");
                        $tulis->setCellValue('A4', "NAMA PERUSAHAAN");
                        $tulis->setCellValue('A6', "1");
                        $tulis->setCellValue('A7', "2");
                        $tulis->setCellValue('A8', "3");
                        $tulis->setCellValue('A13', "5");
                        $tulis->setCellValue('A16', "6");
                        $tulis->setCellValue('B1', "");
                        $tulis->setCellValue('B2', "");
                        $tulis->setCellValue('B3', "");
                        $tulis->setCellValue('B4', "");
                        $tulis->setCellValue('B6', "Periode");
                        $tulis->setCellValue('B7', "Total klarifikasi ");
                        $tulis->setCellValue('B8', "Jumlah Provider");
                        $tulis->setCellValue('B13', "Catatan Khusus");
                        $tulis->setCellValue('B16', "Kesimpulan");
                        $tulis->setCellValue('D6', " : ");
                        $tulis->setCellValue('D7', " : ");
                        $tulis->setCellValue('D8', " : ");
                        $tulis->setCellValue('D13', " : ");
                        $tulis->setCellValue('D16', " : ");
                        $tulis->setCellValue('E6', "bulan tahun");
        $this->excel->getActiveSheet()->setTitle("28");
        }




}