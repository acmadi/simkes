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
               <?php
                $namafile="hasilapotek";
                $id_tran=2;
                $idgriddiagnosa="listdiagnosa".$namafile;
                $idpagergriddiagnosa="pagerdiagnosa".$namafile;
                $idgriditem="listitem".$namafile;
                $idpagergriditem="pageritem".$namafile;
                $fungsiadddiagnosa="adddiagnosa".$namafile;
                $idedititem=$namafile."edititem";
                ?>
		var idgriddiagnosa='#'+'<?php echo $idgriddiagnosa;?>';
                var idpagergriddiagnosa='#'+'<?php echo $idpagergriddiagnosa;?>';
                var idgriditem='#'+'<?php echo $idgriditem;?>';
                var idpagergriditem='#'+'<?php echo $idpagergriditem;?>';
                var idadddetaildiagnosa='#'+'<?php echo $fungsiadddiagnosa;?>';
                var idedititem='#'+'<?php echo $idedititem;?>';

                var id_diagnosa;



                    var bulan='';
                    var tahun='';
                    var tgl1='';
                    var tgl2='';
                    var penanggung='';
                    var jns_tanggal='';

                function sethasilapotekjns_tanggal()
                {
                   jns_tanggal= $('#hasilapotekjenis').val();
                   $('#listhasilapotek').trigger('reloadGrid');
                }


                function sethasilapotektanggal()
                {
                    if($('#hasilapotektanggal1').val()=='')
                        {
                            alert('Isi dulu tanggal awalnya');
                        }
                    else
                    {
                    tgl1=$('#hasilapotektanggal1').val();
                    tgl2=$('#hasilapotektanggal2').val();
                    //alert(tgl1);alert(tgl2);
                    $('#listhasilapotek').trigger('reloadGrid');
                    }

                }

                function sethasilapotekbulan()
                {
                    //bulan= document.getElementById('hasilapotekbulan');
                    bulan = $('#hasilapotekbulan').val();
                    $('#listhasilapotek').trigger('reloadGrid');
                }

                function sethasilapotektahun()
                {
                     tahun = $('#hasilapotektahun').val();
                $('#listhasilapotek').trigger('reloadGrid');
                }



                $( "#hasilapotektanggal1" ).datepicker({
                //dateFormat  : "dd MM yy",
                changeMonth: true,
                changeYear: true,
                showOn: "button",
                buttonImage : "<?php echo base_url();?>asset/images/calendar.gif",
                buttonImageOnly : true
                });

                $( "#hasilapotektanggal2" ).datepicker({
                //dateFormat  : "dd MM yy",
                changeMonth     : true, // menampilkan dropdown untuk ganti bulan
                changeYear      : true, // menampilkan dropdown untuk ganti Tahun
                showOn          : "button",
                buttonImage     : "<?php echo base_url();?>asset/images/calendar.gif",
                buttonImageOnly : true
                });

		$(document).ready(function()
			{

				var grid = $(idgriddiagnosa);
				grid.jqGrid({
					url: '<?php echo base_url() ?>index.php/hasil/<?php echo $namafile;?>/detail_diagnosa/'+<?php echo $id_tran;?>, //URL Tujuan Yg Mengenerate data Json nya
					datatype: "json", //Datatype yg di gunakan
					height: "auto", //Mengset Tinggi table jadi Auto menyesuaikan dengan isi table
					mtype: "GET",

					colNames: ['Id Transaksi','Diagnosa'],
					colModel: [
						{name:'id_transaksi_diagnosa', key:true, index:'id_transaksi_diagnosa', hidden:true,editable:false,editrules:{required:true}},//name untuk variabel post yang dikirim saat menambah data
						{name:'nama_diagnosa',index:'nama_diagnosa',width:150,editable:true,editrules:{required:true}}//index untuk variabel yang digunakan saat pencarian

					],
					rownumbers:true,
					rowNum: 10,
					rowList: [10,20,30],
					pager: idpagergriddiagnosa,
					sortname: 'id_transaksi_diagnosa',
					viewrecords: true,
					sortorder: "desc",
					editurl: '<?php echo base_url() ?>index.php/hasil/<?php echo $namafile;?>/cruddiagnosa', //URL Proses CRUD Nya
					multiselect: false,
					caption: "Diagnosa" //Caption List
				});
				grid.jqGrid('navGrid',idpagergriddiagnosa,{view:false,edit:false,add:false,del:true},{},{},{},{closeOnEscape:true,closeAfterSearch:false,multipleSearch:false, multipleGroup:false, showQuery:false,drag:true,showOnLoad:false,sopt:['cn'],resize:false,caption:'Cari Record', Find:'Cari', Reset:'Batalkan Pencarian'});

				var tes = $(idgriditem);
				tes.jqGrid({
					url: '<?php echo base_url() ?>index.php/hasil/<?php echo $namafile;?>/detail_item/'+<?php echo $id_tran;?>, //URL Tujuan Yg Mengenerate data Json nya
					datatype: "json", //Datatype yg di gunakan
					height: "auto", //Mengset Tinggi table jadi Auto menyesuaikan dengan isi table
					mtype: "GET",

					colNames: ['Id Transaksi','Jenis','Item','Jumlah','Hrg.Standar','Hrg.Satuan','Satuan','Kandungan','Dosis','Rekomendasi','Total'],
					colModel: [
						{name:'id_transaksi', key:true, index:'id_transaksi', hidden:true,editable:false,editrules:{required:true}},//name untuk variabel post yang dikirim saat menambah data
						{name:'jenis_item',index:'jenis_item',width:50,align:'center',editable:true,editrules:{required:true}},//index untuk variabel yang digunakan saat pencarian
						{name:'nama_item',index:'nama_item',width:40,align:'center',editable:true,editrules:{required:true}},
						{name:'jumlah',index:'jumlah', width:40,align:'center',editable:true,editrules:{required:true}},
						{name:'harga_item',index:'harga_item',width:55,align:'center',editable:true,editrules:{required:true}},
						{name:'hrg_satuan',index:'hrg_satuan',width:60,align:'center',editable:true,editrules:{required:true}},
						{name:'satuan',index:'satuan',width:40,align:'center',editable:true,editrules:{required:true}},
						{name:'kandungan',index:'kandungan',width:60,align:'center',editable:true,editrules:{required:true}},
						{name:'dosis',index:'dosis',width:30,align:'center',editable:true,editrules:{required:true}},
                                                {name:'rekomendasi',index:'rekomendasi',width:60,align:'center',editable:true,editrules:{required:true}},
                                                {name:'total',index:'total',width:50,align:'center',editable:true,editrules:{required:true}}
					],
					rownumbers:false,
                                        footerrow:true,
                                        userDataOnFooter:true,
                                        //altRows : true,
					rowNum: 10,
					rowList: [10,20,30],
					pager: idpagergriditem,
					sortname: 'id_transaksi',
					viewrecords: true,
					sortorder: "desc",
					editurl: '<?php echo base_url() ?>index.php/hasil/<?php echo $namafile;?>/cruditem', //URL Proses CRUD Nya
					multiselect: false,
                                        ondblClickRow: function(id_transaksi){

                                                    alert("You double click row with id: "+id_transaksi);
                                                    return false;
                                                    },
					caption: "Item Transaksi" //Caption List
				});
				tes.jqGrid('navGrid',idpagergriditem,{view:false,edit:false,add:false,del:true},{},{},{},{closeOnEscape:true,closeAfterSearch:false,multipleSearch:false, multipleGroup:false, showQuery:false,drag:true,showOnLoad:false,sopt:['cn'],resize:false,caption:'Cari Record', Find:'Cari', Reset:'Batalkan Pencarian'});
                                jQuery(idgriditem)
                                .jqGrid('navButtonAdd',idpagergriditem,{caption:"",buttonicon:"ui-icon-pencil",
                                onClickButton:function(){
                                var id = tes.jqGrid('getGridParam','selrow');
                                if (id) { var ret = tes.jqGrid('getRowData',id);
                                 }
                                else { alert("Please select row");}
                                alert("You double click row with id: "+id);
                                $('#hasilapotekedititem').dialog('open');
                                $("#hasilapotekedititem").load("<?php echo base_url() ?>index.php/hasil/hasilapotek/edititem/"+id);
                                return false;
                                }
				})
                                .jqGrid('navButtonAdd',idpagergriditem,{caption:"",buttonicon:"ui-icon-plus",
                                onClickButton:function()
                                {
                                     $("#hasilapotekedititem").load("<?php echo base_url() ?>index.php/hasil/<?php echo $namafile;?>/plusitem/"+<?php echo $id_tran;?>);
                                     $('#hasilapotekedititem').dialog('open');
                                }
				})
                         

            function <?php echo $fungsiadddiagnosa;?>()
            {
             var diagnosa = $(idadddetaildiagnosa).val();
            if (diagnosa == '')
            {
                alert('Diagnosa harus di isi');
                $('#adddetaildiagnosa').focus();
                return false;
            }
            $.ajax({
               url : "<?php echo base_url(); ?>index.php/hasil/<?php echo $namafile?>/simpandiagnosa",
               data : "id="+<?php echo $id_tran;?>+"&diag="+diagnosa+"&id_diag="+id_diagnosa,
               type: 'get',
               success: function(data){
                   if (data=="sukses"){
                       resetDiagnosa();
                       $(idgriddiagnosa).trigger('reloadGrid');
                   } else {
                       alert("Gagal Menyimpan data");
                   }

               },
               error: function(e){
                   alert("error pasien : "+e)
               }
            });
            return false;
            }

            function resetDiagnosa(){
            $('#adddetaildiagnosa').val("");
            }



                                $('#hasilapotekimpor').dialog({
                                        autoOpen:false,
                                        title:"Import Data Transaksi Apotek",
                                        resizable:false,
                                        width:350,
                                        height:150,
                                        show: 'drop',
                                        hide: 'scale',
                                        modal:true
                                        }
                                        );
                                 $('#detailhasilapotek').dialog({
                                        autoOpen:false,
                                        title:"Detail",
                                        resizable:false,
                                        width:800,
                                        show: 'drop',
                                        hide: 'scale',
                                        modal:true
                                        }
                                        );

				var grid = $("#listhasilapotek");
				grid.jqGrid({
					url: '<?php echo base_url() ?>index.php/hasil/hasilapotek/json', //URL Tujuan Yg Mengenerate data Json nya
					datatype: "json", //Datatype yg di gunakan
                                        height: "auto", //Mengset Tinggi table jadi Auto menyesuaikan dengan isi table
					mtype: "GET",
                                        postData:{jns_tanggal : function()
                                        {

                                         return jns_tanggal;
                                        },bulan : function()
                                        {

                                         return bulan;
                                        },tahun : function()
                                        {

                                         return tahun;
                                        },tgl1 : function()
                                        {

                                         return tgl1;
                                        },tgl2 : function()
                                        {

                                         return tgl2;
                                        }

                                        },
					colNames: ['Id Transaksi','Tl Trans.','Tgl Kunjungan','Surat','No. Bukti','No Buku Besar','Restitusi','NIP','Penanggung','Pasien','Rujukan','Dokter','Apotek','DAK','Diagnosa','Total','Setelah Koreksi','Selisih','Keterangan'],
					colModel: [
						{name:'id_transaksi', key:true, index:'id_transaksi', hidden:true,editable:false,editrules:{required:true}},//name untuk variabel post yang dikirim saat menambah data
						{name:'tgl_transaksi',index:'tgl_transaksi',width:120,editable:true,editrules:{required:true}},//index untuk variabel yang digunakan saat pencarian
						{name:'almt_provider',index:'tgl_kunjungan',width:150,editable:true,editrules:{required:true}},
						{name:'langg_provider',index:'no_surat', width:90, editable: true,edittype:"checkbox",editoptions: {value:"y:n"}},
						{name:'email_provider',index:'no_bukti',width:150,align:'center',editable:true,editrules:{required:true}},
						{name:'fax_provider',index:'buku_besar',width:150,align:'center',editable:true,editrules:{required:true}},
						{name:'fax_provider',index:'restitusi',width:150,align:'center',editable:true,editrules:{required:true}},
						{name:'fax_provider',index:'nip',width:150,align:'center',editable:true,editrules:{required:true}},
						{name:'fax_provider',index:'nama_karyawan',width:150,align:'center',editable:true,editrules:{required:true}},
						{name:'fax_provider',index:'nama_tertanggung',width:150,align:'center',editable:true,editrules:{required:true}},
						{name:'fax_provider',index:'nama_rujukan',width:150,align:'center',editable:true,editrules:{required:true}},
						{name:'fax_provider',index:'nama_dokter',width:150,align:'center',editable:true,editrules:{required:true}},
						{name:'fax_provider',index:'nama_provider',width:150,align:'center',editable:true,editrules:{required:true}},
						{name:'fax_provider',index:'no_dak',width:150,align:'center',editable:true,editrules:{required:true}},
						{name:'fax_provider',index:'nama_diagnosa',width:150,align:'center',editable:true,editrules:{required:true}},
						{name:'fax_provider',index:'fax_provider',width:150,align:'center',editable:true,editrules:{required:true}},
						{name:'fax_provider',index:'fax_provider',width:150,align:'center',editable:true,editrules:{required:true}},
						{name:'fax_provider',index:'fax_provider',width:150,align:'center',editable:true,editrules:{required:true}},
                                        {name:'tlp_provider',index:'tlp_provider',width:150,align:'center',editable:true,editrules:{required:true}}
					],
					rownumbers:true,
					rowNum: 10,
					rowList: [10,20,30],
					pager: '#pagerhasilapotek',
					sortname: 'id_transaksi',
					viewrecords: true,
					sortorder: "desc",
                                        ondblClickRow: function(id_transaksi){

                                                    alert("You double click row with id: "+id_transaksi);
                                                    $('#detailhasilapotek').dialog('open');
                                                    $("#detailhasilapotek").load("<?php echo base_url() ?>index.php/hasil/hasilapotek/detail/"+id_transaksi);

                                                    return false;
//                                                      alert("You double click row with id: "+id_transaksi);
//                                                    $("#detailbismillah").load("<?php echo base_url() ?>index.php/hasil/hasilapotek/detail/"+id_transaksi);
//
//                                                    return false;
                                                    },
					editurl: '<?php echo base_url() ?>index.php/hasil/hasilapotek/crud', //URL Proses CRUD Nya
					multiselect: false,
					caption: "Data hasilapotek" //Caption List
				});
				grid.jqGrid('navGrid','#pagerhasilapotek',{view:true,edit:false,add:false,del:true},{},{},{},{closeOnEscape:true,closeAfterSearch:false,multipleSearch:false, multipleGroup:false, showQuery:false,drag:true,showOnLoad:false,sopt:['cn'],resize:false,caption:'Cari Record', Find:'Cari', Reset:'Batalkan Pencarian'});
				jQuery("#listhasilapotek")
                                .jqGrid('navButtonAdd','#pagerhasilapotek',{caption:"Excel",buttonicon:"ui-icon-print",
                                onClickButton:function()
                                {
                                    var sidx = grid.jqGrid('getGridParam','sortname');
                                    var sord = grid.jqGrid('getGridParam','sortorder');
                                    var page = grid.jqGrid('getGridParam','page');
                                    var row  = grid.jqGrid('getGridParam','rowNum');

                                    window.location.href="<?php echo base_url() ?>index.php/hasil/hasilapotek/ekspor?tgl2="+tgl2+"&tgl1="+tgl1+"&tahun="+tahun+"&bulan="+bulan+"&sidx="+sidx+"&page="+page+"&rows="+row+"&sord="+sord;
				//alert("BERHASIL ayo SEMANGAT kalahkan skripsi");
				}
				})
                                .jqGrid('navButtonAdd','#pagerhasilapotek',{caption:"Impor",buttonicon:"ui-icon-folder-open",
                                onClickButton:function()
                                {

                                var status = <?php echo $this->session->userdata('level')?>;
                                //alert(status);
                                if(status == 7)
                                {
                                $("#hasilapotekimpor").load("<?php echo base_url() ?>index.php/hasil/hasilapotek/impor");
                                $('#hasilapotekimpor').dialog('open');
				}
                                else
                                {
                                alert("Tidak Bisa Impor Karena Anda Administrator");
                                }

                                return false;
                                }
				});




			});


		</script>

</head>
<body
<form>
    <table border="0">
        <tr>
            <td width="300">Tampilkan Berdasarkan :
                <select id="hasilapotekjenis" onchange="sethasilapotekjns_tanggal();">
                <option>Pilih Jenis</option>
                <option selected value="t">Transaksi</option>
                <option value="k">Kunjungan</option>
                </select>
            </td>
            <td width="300">
                Pilih Bulan :
                <select id="hasilapotekbulan" onchange="sethasilapotekbulan();">
                    <option value="" selected>Pilih Bulan</option>
                    <option value="1">Januari</option>
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
                <select id="hasilapotektahun" onchange="sethasilapotektahun();">
                    <option value=''> - </option>
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
            <td width="250">
                atau dari Tanggal :
                <input type="text" id="hasilapotektanggal1" name="hasilapotektanggal1"/>
            </td>
            <td>
                s/d
                <input type="text" id="hasilapotektanggal2" name="hasilapotektanggal2" onchange="sethasilapotektanggal();"/>
            </td>

        </tr>
    </table>
</form>
<div id="master_hasilapotek" style="width: auto; height: auto;overflow: auto">
		<table id="listhasilapotek" class="scroll" cellpadding="0" cellspacing="0"></table>
		<div id="pagerhasilapotek" class="scroll" style="text-align:center;"></div>
                <div id="hasilapotekimpor"></div>
                <div id="detailbismillah"></div>
                <div id="detailhasilapotek"></div>
</div>

<table>

<tr>
    <form>


      <td>
             <input type="text" name="<?php echo $fungsiadddiagnosa;?>" id="<?php echo $fungsiadddiagnosa;?>" />
             <input type="button" value="add"  onclick="<?php echo $fungsiadddiagnosa."()";?>;" /></td>
             <td>&nbsp;</td>





</form>
</tr>
<tr>
    <td align="center" valign="top">
<div  style="width: auto; height: auto;overflow: auto">
                <table id="<?php echo $idgriddiagnosa;?>" class="scroll" cellpadding="0" cellspacing="0"></table>
                   <div id="<?php echo $idpagergriddiagnosa;?>" class="scroll" style="text-align:center;"></div>


</div>
</td>
<td align="center" valign="top">
    <div  style="width: auto; height: auto;overflow: auto">
		<table id="<?php echo $idgriditem?>" class="scroll" cellpadding="0" cellspacing="0"></table>
                <div id="<?php echo $idpagergriditem?>" class="scroll" style="text-align:center;"></div>

</div>
</td>
</tr>
</table>

</body>
</html>