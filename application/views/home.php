<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SIMKES</title>
<script type="text/javascript" src="<?php echo base_url();?>/asset/js/FusionCharts.js"></script>


<script type='text/javascript'>
        var loading_image_large = "<?php echo base_url();?>asset/images/loading_large.gif";
        var loading_image_small = "<?php echo base_url();?>asset/images/loading.gif";
	//$(function()
	//{
	    //load("home/front","#content");
	    //load("home/front");
	//})
	
</script>

<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>asset/themes/style.css" />  
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url();?>asset/themes/redmond/jquery-ui-1.8.2.custom.css" />
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url();?>asset/themes/ui.jqgrid.css" />
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url();?>asset/themes/ui.multiselect.css" />

<script src="<?php echo base_url();?>asset/js/jquery.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>asset/js/jquery-ui-1.8.2.custom.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>asset/js/jquery.layout.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>asset/js/i18n/grid.locale-en.js" type="text/javascript"></script>



<script type="text/javascript">
	$.jgrid.no_legacy_api = true;
	$.jgrid.useJSON = true;
</script>
<script src="<?php echo base_url();?>asset/js/jquery.jqGrid.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>asset/js/jquery.tablednd.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>asset/js/jquery.contextmenu.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>asset/js/ui.multiselect.js" type="text/javascript"></script>

<script src="<?php echo base_url();?>asset/js/ui.datepicker-id.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>asset/js/script.js" type="text/javascript" ></script>



<script type="text/javascript">
var tahundashboard='';
var bulandashboard='';
function setdashboardbulan()
                {
                    //bulan= document.getElementById('laporandiagnosabulan');
                    bulandashboard = $('#dashboardbulan').val();
                    $('#isidashboard').load("<?php base_url()?>home/dashboard?bulan="+bulandashboard+"&tahun="+tahundashboard);
                    //$('#isidashboard').load("<?php base_url()?>laporan/executive/penyakit_obat?bulan="+bulandashboard+"&tahun="+tahundashboard);

                }

        function setdashboardtahun()
                {
                     tahundashboard = $('#dashboardtahun').val();
                      $('#isidashboard').load("<?php base_url()?>home/dashboard/?bulan="+bulandashboard+"&tahun="+tahundashboard);
                     // $('#isidashboard').load("<?php base_url()?>laporan/executive/penyakit_obat?bulan="+bulandashboard+"&tahun="+tahundashboard);

                }

jQuery(document).ready(function()
	{
        setTimeout(function(){
        window.location.href="<?php echo base_url() ?>index.php/home";

        },7200000
        );


        //$('#welcome').hide();
	$("#isidashboard").load("<?php base_url()?>home/dashboard");

        
        $('body').layout({
		resizerClass: 'ui-state-default',
        west__onresize: function (pane, $Pane) {
            jQuery("#west-grid").jqGrid('setGridWidth',$Pane.innerWidth()-2);
		}
	});
        
        $('#dialoglaporan').dialog({
                                        autoOpen:false,
                                        title:"Laporan",
                                        resizable:false,
                                        //width:465,
                                        //height:150,
                                        show: 'drop',
                                        hide: 'scale',
                                        modal:true
                                        }
                                        );
        $('a.lapming').click(function()
        {
            $('#dialoglaporan').load("<?php echo base_url() ?>index.php/laporan/mingguan");
            $('#dialoglaporan').dialog('open');
				return false; 
        });

        $('a.bulanan').click(function()
        {
            $('#dialoglaporan').load("<?php echo base_url() ?>index.php/laporan/bulanan");
            $('#dialoglaporan').dialog('open');
				return false;
        });
        $('a.uploaddata').click(function()
        {
            $('#dialoglaporan').load("<?php echo base_url() ?>index.php/laporan/upload");
            $('#dialoglaporan').dialog('open');
				return false;
        });
        $('a.downloaddata').click(function()
        {
            $('#dialoglaporan').load("<?php echo base_url() ?>index.php/laporan/download");
            $('#dialoglaporan').dialog('open');
				return false;
        });
	
	$.jgrid.defaults = $.extend($.jgrid.defaults,{loadui:"enable"});
	var maintab =jQuery('#tabs','#Content').tabs(
	{
        add: function(e, ui) 
		{	
			//alert("fungsi Add");
            // append close thingy
            $(ui.tab).parents('li:first')
                .append('<span class="ui-tabs-close ui-icon ui-icon-close" title="Close Tab"></span>')
                .find('span.ui-tabs-close')
                .click(function() {
                    maintab.tabs('remove', $('li', maintab).index($(this).parents('li:first')[0]));
                });
            // select just added tab
            maintab.tabs('select', '#' + ui.panel.id);
        }
    });
	$("#menu .logout").click(function(){
            load("home/logout");
        });
	$("#menu a").click(function()
	{
	var id=$(this).attr("id");
		var url=$(this).attr("href");
		var title=$(this).attr("rel");
		//alert("ID = "+id);
		//alert("url = "+url);
		
		var st = "#t"+id;
				if($(st).html() != null ) 
				{	
					//alert(st+" tidak null");
					maintab.tabs('select',st);
					return false;
				} 
				else 
				{	
					if(url == "#")
					{
					 return false;
					}
                    else if(url == "i")
					{
                     buatWindowImpor();
					 return false;
					}
					else
					{
					//alert(st+" null");
					//alert("Hai"+url);
					maintab.tabs('add',st, title);
					$(st,"#tabs").load(url);
					return false;
					}
				}
				
	});
	

});

	$("#impor a").click(function()
	{
	buatWindowImpor();
	}
	);

var windowimpor = null;
function buatWindowImpor()
{
	if(windowimpor == null)
	{
		windowimpor = open("","","width=50, height=50");
		windowimpor.document.write("<html><head></head>");
		windowimpor.document.write("<body>");
		windowimpor.document.write("<body></html>");
	}
}
function tutupWindowImpor()
{
	if(windowimpor != null)
	{
		windowimpor.close();
		windowimpor = null;
	}
}



</script>
<style>
fieldset
    {
        border:solid 1px #8E846B;
        overflow-x:scroll;
	padding:10px 10px 10px 20px;

	-webkit-border-radius: 10px;
	-moz-border-radius: 10px;
	border-radius: 10px;
    }
legend
    {
        padding: 3px 15px 3px 10px;
	font:bold 1em "Trebuchet MS", Verdana, Helvetica, Arial, sans-serif;
	font-weight:bold;
	color:#666;
	text-transform:uppercase;
	border:1px solid #8E846B;
	background:#f4f4f4;
	letter-spacing:2px;
	-webkit-border-radius: 10px;
	-moz-border-radius: 10px;
	border-radius: 10px;
    }
</style>


</head>
<body>

	
<div id="Content" class="ui-layout-center ui-helper-reset ui-widget-content" ><!-- Tabs pane -->
   
  
<div id="main">
<!-- header begins -->
<div id="header">
   
   
   <div id="menu_atas">
  
   <ul class="menu" id="menu">
   
	<li><a href="<?php echo base_url();?>index.php/master/home" class="menulink">Home</a>

        </li>
	
	<?php
	$level = $this->session->userdata('level');
	if($level==1)
	{


	?>
        <li><a href="<?php echo base_url();?>index.php/master/user" id="master_user" class="menulink" rel="Master User" >Management User</a>
        </li>
        <?
	}
        $modulo=$level%2;
        if($modulo==1)
        {
	?>

        <li><a  href="#" class="menulink">Master Data</a>
		<ul>
			
			<li>
				<a href="#" class="sub">Kesehatan</a>
				<ul>
					<li class="topline"><a href="<?php echo base_url();?>index.php/master/apotek" id="apotek" rel="Master Apotek" >Apotek</a></li>
					<li><a href="<?php echo base_url();?>index.php/master/diagnosa" id="diagnosa" rel="Master Diagnosa" >Diagnosa</a></li>
					<li><a href="<?php echo base_url();?>index.php/master/dokter" id="dokter" rel="Master Dokter" >Dokter</a></li>
					<li><a href="<?php echo base_url();?>index.php/master/dosis" id="dosis" rel="Master Dosis" >Dosis</a></li>
					<li><a href="<?php echo base_url();?>index.php/master/lab_gigi" id="lab_gigi" rel="Master Lab Gigi" >Lab Gigi</a></li>
					<li><a href="<?php echo base_url();?>index.php/master/optik" id="optik" rel="Master Optik" >Optik</a></li>
					<li><a href="<?php echo base_url();?>index.php/master/lab" id="lab" rel="Master Laboratorium" >Laboratorium</a></li>
					<li><a href="<?php echo base_url();?>index.php/master/rmhsakit" id="rmhsakit" rel="Master Rumah Sakit" >Rumah Sakit</a></li>
				</ul>
			</li><li>
				<a href="#" class="sub">Kepegawaian</a>
				<ul>
					<li class="topline"><a href="<?php echo base_url();?>index.php/master/bagian" id="bagian" rel="Bagian" >Bagian</a></li>
					<li><a href="<?php echo base_url();?>index.php/master/karyawan" id="karyawan" rel="Karyawan" >Data Karyawan</a></li>
					<li><a href="<?php echo base_url();?>index.php/master/rayon" id="rayon" rel="Rayon" >Rayon</a></li>
					<li><a href="<?php echo base_url();?>index.php/master/tertanggung" id="tertanggung" rel="Tertanggung" >Tertanggung</a></li>
					
				</ul>
			</li>
			
			<li><a href="<?php echo base_url();?>index.php/master/item" id="item" rel="Item" >Item</a></li>
			
		</ul>
	</li>
	
	
	<li>
		<a href="#" class="menulink">Transaksi</a>
		<ul>
			<li>
				<a href="#" class="sub">Entri</a>
				<ul>
					<li class="topline"><a href="<?php echo base_url();?>index.php/transaksi/apotek" id="transapotek" rel="Transaksi Apotek">Apotek</a></li>
					<li><a href="<?php echo base_url();?>index.php/transaksi/dak" id="transdak" rel="Transaksi Dak">DAK</a></li>
					<li><a href="<?php echo base_url();?>index.php/transaksi/dokter" id="transdok" rel="Transaksi Dokter">Dokter</a></li>
					<li><a href="<?php echo base_url();?>index.php/transaksi/gigi" id="transgigi" rel="Transaksi Gigi">Gigi</a></li>
					<li><a href="<?php echo base_url();?>index.php/transaksi/lab" id="translab" rel="Transaksi Laboratorium">Laboratorium</a></li>
					<li><a href="<?php echo base_url();?>index.php/transaksi/lain" id="translain" rel="Transaksi Lain">Lain</a></li>
					<li><a href="<?php echo base_url();?>index.php/transaksi/optik" id="transoptik" rel="Transaksi Optik">Optik</a></li>
					<li><a href="<?php echo base_url();?>index.php/transaksi/penunjang" id="transpenunjang" rel="Transaksi Penunjang">Penunjang</a></li>
					<li><a href="<?php echo base_url();?>index.php/transaksi/rs" id="transrs" rel="Transaksi RS">Rumah Sakit</a></li>
					<li><a href="<?php echo base_url();?>index.php/transaksi/rekam_medis" id="transrm" rel="Transaksi Rekam Medis">Rekam Medis</a></li>
					<li><a href="<?php echo base_url();?>index.php/transaksi/kunjunganrs" id="transkunjunganrs" rel="Transaksi Kunjungan RS">Kunjungan Rumah Sakit</a></li>
				</ul>
			</li><li>
				<a href="#" class="sub">Hasil</a>
				<ul>
					<li class="topline"><a href="<?php echo base_url();?>index.php/hasil/hasilapotek" id="hasiltransapotek" rel="Hasil Apotek">Apotek</a></li>
					<li><a href="<?php echo base_url();?>index.php/hasil/hasildak" id="hasiltransdak" rel="Hasil DAK">DAK</a></li>
					<li><a href="<?php echo base_url();?>index.php/hasil/hasildokter" id="hasiltransdokter" rel="Hasil Dokter">Dokter</a></li>
					<li><a href="<?php echo base_url();?>index.php/hasil/hasilgigi" id="hasiltransgigi" rel="Hasil Gigi">Gigi</a></li>
					<li><a href="<?php echo base_url();?>index.php/hasil/hasillaboratorium" id="hasiltranslaboratorium" rel="Hasil Laborotorium">Laboratorium</a></li>
					<li><a href="<?php echo base_url();?>index.php/hasil/hasillain" id="hasiltranslain" rel="Hasil Lain">Lain</a></li>
					<li><a href="<?php echo base_url();?>index.php/hasil/hasiloptik" id="hasiltransoptik" rel="Hasil Optik">Optik</a></li>
					<li><a href="<?php echo base_url();?>index.php/hasil/hasilpenunjang" id="hasiltranspenunjang" rel="Hasil Penunjang">Penunjang</a></li>
					<li><a href="<?php echo base_url();?>index.php/hasil/hasilrumahsakit" id="hasiltransrs" rel="Hasil Transaksi RS">Rumah Sakit</a></li>
					<li><a href="<?php echo base_url();?>index.php/hasil/hasilrekammedis" id="hasiltransrm" rel="Hasil Rekam Medis">Rekam Medis</a></li>
                                        <li><a href="<?php echo base_url();?>index.php/hasil/hasilkunjunganrs" id="hasiltranskunjunganrs" rel="Hasil Kunjungan RS">Kunjungan Rumah Sakit</a></li>
					<li><a href="#">Klarifikasi Provider</a></li>
				</ul>
			</li>
			<!--<li><a href="#">Import</a></li>-->
		</ul>
	</li>
	<?
        }
        ?>
	
	
	<li>
		<a href="#" class="menulink">Laporan</a>
		<ul>
			<li>
				<a href="#" class="sub">Kesehatan</a>
				<ul>
					<li class="topline"><a href="#">Audit 100 Obat</a></li>
					<li><a href="<?php echo base_url();?>index.php/laporan/diagnosa" id="lapdiagnosa" rel="Laporan Diagnosa">Diagnosa Pasien</a></li>
					<li><a href="<?php echo base_url();?>index.php/laporan/kunjungandak" id="lapkunjdak" rel="Kunjungan DAK">Kunjungan DAK</a></li>
					<li><a href="<?php echo base_url();?>index.php/laporan/kunjungankesehatan" id="lapkunjkes" rel="Kunjungan Kesehatan">Kunjungan Kesehatan</a></li>

					<li>
						<a href="#" class="sub">Rawat Jalan</a>
						<ul>
							<li class="topline"><a href="<?php echo base_url();?>index.php/laporan/rawatjalan" id="laprawjal1" rel="Rawat Jalan I">Rawat Jalan I</a></li>
							<li><a href="<?php echo base_url();?>index.php/laporan/rawatjalan2" id="laprawjal2" rel="Rawat Jalan II">Rawat Jalan II</a></li>
							
						</ul>
					</li><li>
						<a href="#" class="sub">Rawat Inap</a>
						<ul>
							<li class="topline"><a href="<?php echo base_url();?>index.php/laporan/rawatinap" id="laprawinap1" rel="Rawat Inap I">Rawat Inap I</a></li>
							<li><a href="<?php echo base_url();?>index.php/laporan/rawatinap2" id="laprawinap2" rel="Rawat Inap II">Rawat Inap II</a></li>

						</ul>
					</li>
					
					<li><a href="<?php echo base_url();?>index.php/laporan/rekammedis" id="laprekammedis" rel="Rekam Medis">Rekam Medis</a></li>
				</ul>
			</li>
			<li>
			<a href="#" class="sub">Transaksi</a>
				<ul>
					<li class="topline"><a href="<?php echo base_url();?>index.php/laporan/biayaTerbesar" id="lapbiayaTerbesar" rel="biayaTerbesar">Biaya Terbesar</a></li>
					<li>
						<a href="#" class="sub">Hasil Temuan</a>
						<ul>
							<li class="topline"><a href="<?php echo base_url();?>index.php/laporan/verifikasi" id="lapverifikasi" rel="Verifikasi">Verifikasi</a></li>
							<li><a href="<?php echo base_url();?>index.php/laporan/biaya" id="lapbiaya" rel="Biaya">Biaya</a></li>
							<li><a href="<?php echo base_url();?>index.php/laporan/polifarmasi" id="lappolifarmasi" rel="Poli Farmasi">Poli Farmasi</a></li>
							<li><a href="<?php echo base_url();?>index.php/laporan/resepMahal" id="resepMahal" rel="Resep Mahal">Resep Mahal</a></li>
							<li><a href="<?php echo base_url();?>index.php/laporan/shopingDokter" id="shopingDokter" rel="Shoping Dokter">Shopping Dokter</a></li>
							<li><a href="<?php echo base_url();?>index.php/laporan/obatBerlebih" id="obatBerlebih" rel="Obat Berlebih">Obat Berlebih</a></li>
							<li><a href="<?php echo base_url();?>index.php/laporan/obatKeluarga" id="obatKeluarga" rel="Berobat Keluarga">Berobat Keluarga</a></li>
							<li><a href="<?php echo base_url();?>index.php/laporan/lebihHet" id="lebihHet" rel="Lebih Het">Lebih HET</a></li>
							
						</ul>
					</li>
                    
                    <li><a href="<?php echo base_url();?>index.php/laporan/bukuBesar" id="lapbukuBesar" rel="Buku Besar">Buku Besar</a></li>
                    <li><a href="<?php echo base_url();?>index.php/laporan/postBiaya" id="lappostBiaya" rel="Post Biaya">Post Biaya</a></li>
					<li><a href="<?php echo base_url();?>index.php/laporan/perBagian" id="lapperBagian" rel="Per Bagian">Per Bagian</a></li>
					<li><a href="<?php echo base_url();?>index.php/laporan/rekapBiaya" id="laprekapBiaya" rel="Rekap Biaya">Rekap Biaya</a></li>
					<li><a href="<?php echo base_url();?>index.php/laporan/rekapProvider" id="laprekapProvider" rel="Rekap Provider">Rekap Provider</a></li>
					<li><a href="<?php echo base_url();?>index.php/laporan/totalBiaya" id="laptotalBiaya" rel="Total Biaya">Total Biaya</a></li>
					
					
					
					
				</ul>
			</li>
                        <li><a href="<?php echo base_url();?>index.php/laporan/sap" id="lapsap" rel="Laporan SAP">S A P </a></li>
			<li><a href="#" class="lapming">Harian/Mingguan</a></li>
                        <li><a href="#" class="bulanan">Bulanan</a></li>
			<li><a href="<?php echo base_url();?>index.php/laporan/executive" id="lapexecutive" rel="Executive">Executive Summary</a></li>
			
                        <li>
				<a href="#" class="sub">28 Sheet Fixed</a>
				<ul>
                                    <li class="topline"><a href="#" class="uploaddata">Upload</a></li>
                                    <li><a href="#" class="downloaddata">Download</a></li>
				</ul>
			</li>
		</ul>
	</li>
	<li>
		<!--<a href="#" class="menulink" class="logout" onclick='window.location.href="index.php/home/logout"' >Logout</a>
	-->
        <a href="#" class="menulink" class="logout" onclick='window.location.href="<?php echo base_url();?>index.php/home/logout"' >Logout</a>
	</li>
	
</ul>

<script type="text/javascript">
	var menu=new menu.dd("menu");
	menu.init("menu","menuhover");
</script>

  
  </div> 
   
   <label id="welcome1">
   	<?php
 	$nama = $this->session->userdata('nama');
 	$id= $this->session->userdata('id_user');
 
 	$tes= $this->session->userdata('logged_in');
 	//echo $tes;
 	//echo $id;
 	echo $nama;

 	//echo $level;
 	?>
   </label>
   
   <label id="welcome">Selamat Datang</label>
   
   
  

</div>
<!-- header ends -->
<div id="content">
<!--<div id="login">
ini Nanti tempat LOGIN
</div>-->
	<div id="menu" >
	</div>
	<div id="switcher"></div>
		<div id="tabs" class="jqgtabs">
			<ul>
				<li><a href="#tabs-1">Dashboard</a></li>
				
			</ul>
			<div id="tabs-1" style="width: auto; height: auto;overflow: auto">
                          <table width="800" border="0" align="center">
                            <tr>
                              <td width="200" >
                            Bulan :
                    <select id="dashboardbulan" onchange="setdashboardbulan();">
                    <option value="" selected>Pilih Bulan</option>
                    <option value="1" >Januari</option>
                    <option value="2">Februari</option>
                    <option value="3">Maret</option>
                    <option value="4">April</option>
                    <option value="5">Mei</option>
                    <option value="6">Juni</option>
                    <option value="7">Juli</option>
                    <option value="8">Agustus</option>
                    <option value="9">September</option>
                    <option value="10">Oktober</option>
                    <option value="11">November</option>
                    <option value="12">Desember</option>
                    </select>
            </td>

                              <td width="200">
                Tahun :
                <select id="dashboardtahun" onchange="setdashboardtahun();">
                    <option value='' selected> -- </option>
                    <?php
                    $tahun=date('Y');
                    for($i=2011;$i<=$tahun;$i++)
                    {?>
		     <option value="<?php echo $i;?>">
                     <?php	echo $i; ?></option>

		    <?php
		     }
                    ?>
                </select>
            </td>
                            </tr>
                          </table>
			  <div id="isidashboard">
                          </div>
			</div>
			
			
		</div>
	<!--
<div id="isi">
<p>Ini NAnti ISInya</p>
<table id="listapotek">
</table>
</div> -->


</div>
<div id="footer">
<div id="kiri">
<p>E-SIMDAK � 2012 by Perdana Khairul HP & Iqbal Fahmi</p></div>
<div id="kanan">
<p>Script powered by Codeigniter and jQuery</p>
</div>
<div id="clear"></div>
</div>
</div>




</div>
	<!--</div>  #Content -->
<div id="dialoglaporan">

</div>
</body>
</html>