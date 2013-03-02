		<script type="text/javascript">
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