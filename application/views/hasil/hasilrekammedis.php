		<script type="text/javascript">
                    var bulanhasilrekammedis='';
                    var tahunhasilrekammedis='';
                    var tgl1hasilrekammedis='';
                    var tgl2hasilrekammedis='';
                    var penanggunghasilrekammedis='';
					var jns_tanggalhasilrekammedis='';

                function sethasilrekammedisjns_tanggal()
                {
                   jns_tanggalhasilrekammedis= $('#hasilrekammedisjenis').val();
                   $('#listhasilrekammedis').trigger('reloadGrid');
                }



                function sethasilrekammedistanggal()
                {
                    if($('#hasilrekammedistanggal1').val()=='')
                        {
                            alert('Isi dulu tanggal awalnya');
                        }
                    else
                    {
                    tgl1hasilrekammedis=$('#hasilrekammedistanggal1').val();
                    tgl2hasilrekammedis=$('#hasilrekammedistanggal2').val();
                    //alert(tgl1);alert(tgl2);
                    $('#listhasilrekammedis').trigger('reloadGrid');
                    }

                }

                function sethasilrekammedisbulan()
                {
                    //bulan= document.getElementById('hasilrekammedisbulan');
                    bulanhasilrekammedis = $('#hasilrekammedisbulan').val();
                    $('#listhasilrekammedis').trigger('reloadGrid');
                }

                function sethasilrekammedistahun()
                {
                     tahunhasilrekammedis = $('#hasilrekammedistahun').val();
                $('#listhasilrekammedis').trigger('reloadGrid');
                }



                $( "#hasilrekammedistanggal1" ).datepicker({
                //dateFormat  : "dd MM yy",
                changeMonth: true,
                changeYear: true,
                showOn: "button",
                buttonImage : "<?php echo base_url();?>asset/images/calendar.gif",
                buttonImageOnly : true
                });

                $( "#hasilrekammedistanggal2" ).datepicker({
                //dateFormat  : "dd MM yy",
                changeMonth     : true, // menampilkan dropdown untuk ganti bulan
                changeYear      : true, // menampilkan dropdown untuk ganti Tahun
                showOn          : "button",
                buttonImage     : "<?php echo base_url();?>asset/images/calendar.gif",
                buttonImageOnly : true
                });
		$(document).ready(function()
			{       $('#hasilrekammedisimpor').dialog({
                                        autoOpen:false,
                                        title:"Import Data Rekam Medis",
                                        resizable:false,
                                        width:350,
                                        height:150,
                                        show: 'drop',
                                        hide: 'scale',
                                        modal:true
                                        }
                                        );
				var grid = $("#listhasilrekammedis");
				grid.jqGrid({
					url: '<?php echo base_url() ?>index.php/hasil/hasilrekammedis/json', //URL Tujuan Yg Mengenerate data Json nya
					datatype: "json", //Datatype yg di gunakan
					height: "auto", //Mengset Tinggi table jadi Auto menyesuaikan dengan isi table
					mtype: "GET",
                                        postData:{
                                        jns_tanggal : function()
                                        {

                                         return jns_tanggalhasilrekammedis;
                                        },bulan : function()
                                        {

                                         return bulanhasilrekammedis;
                                        },tahun : function()
                                        {

                                         return tahunhasilrekammedis;
                                        },tgl1 : function()
                                        {

                                         return tgl1hasilrekammedis;
                                        },tgl2 : function()
                                        {

                                         return tgl2hasilrekammedis;
                                        }

                                        },
					colNames: ['Id Transaksi','Tl Trans.','Tgl Masuk','Tgl Keluar','Nomor RM','NIP','Penanggung','Pasien','Rumah Sakit','Diagnosa Masuk','Diagnosa Keluar','Riwayat Penyakit','Pemeriksaan Fisik','Hasil Lab','Hasil Rontgen','Pemeriksaan Lain','Progres Harian','Keadaan Pasca Rawat','Tindakan'],
					colModel: [
						{name:'id_provider', key:true, index:'id_transaksi', hidden:true,editable:false,editrules:{required:true}},//name untuk variabel post yang dikirim saat menambah data
						{name:'nama_provider',index:'tgl_transaksi',width:120,editable:true,editrules:{required:true}},//index untuk variabel yang digunakan saat pencarian
						{name:'almt_provider',index:'tgl_masuk',width:150,editable:true,editrules:{required:true}},
						{name:'langg_provider',index:'tgl_keluar', width:90, editable: true,edittype:"checkbox",editoptions: {value:"y:n"}},
						{name:'email_provider',index:'nomor rm',width:150,align:'center',editable:true,editrules:{required:true}},
						{name:'fax_provider',index:'nip',width:150,align:'center',editable:true,editrules:{required:true}},
						{name:'fax_provider',index:'nama_karyawan',width:150,align:'center',editable:true,editrules:{required:true}},
						{name:'fax_provider',index:'nama_tertanggung',width:150,align:'center',editable:true,editrules:{required:true}},
						{name:'fax_provider',index:'nama_provider',width:150,align:'center',editable:true,editrules:{required:true}},
						{name:'fax_provider',index:'diagnosa_masuk',width:150,align:'center',editable:true,editrules:{required:true}},
						{name:'fax_provider',index:'diagnosa_keluar',width:150,align:'center',editable:true,editrules:{required:true}},
						{name:'fax_provider',index:'riwayat',width:150,align:'center',editable:true,editrules:{required:true}},
						{name:'fax_provider',index:'periksa_fisik',width:150,align:'center',editable:true,editrules:{required:true}},
                                                {name:'tlp_provider',index:'hasil_lab',width:150,align:'center',editable:true,editrules:{required:true}},
                                                {name:'tlp_provider',index:'hasil_rontgen',width:150,align:'center',editable:true,editrules:{required:true}},
                                                {name:'tlp_provider',index:'hasil_lain',width:150,align:'center',editable:true,editrules:{required:true}},
                                                {name:'tlp_provider',index:'progres_harian',width:150,align:'center',editable:true,editrules:{required:true}},
                                                {name:'tlp_provider',index:'pasca_rawat',width:150,align:'center',editable:true,editrules:{required:true}},
                                                {name:'tlp_provider',index:'tindakan',width:150,align:'center',editable:true,editrules:{required:true}}
					],
					rownumbers:true,
					rowNum: 10,
					rowList: [10,20,30],
					pager: '#pagerhasilrekammedis',
					sortname: 'id_transaksi',
					viewrecords: true,
					sortorder: "desc",
					editurl: '<?php echo base_url() ?>index.php/hasil/hasilrekammedis/crud', //URL Proses CRUD Nya
					multiselect: false, 
					caption: "Data hasilrekammedis" //Caption List					
				});
				grid.jqGrid('navGrid','#pagerhasilrekammedis',{view:true,edit:false,add:false,del:true},{},{},{},{closeOnEscape:true,closeAfterSearch:false,multipleSearch:false, multipleGroup:false, showQuery:false,drag:true,showOnLoad:false,sopt:['cn'],resize:false,caption:'Cari Record', Find:'Cari', Reset:'Batalkan Pencarian'});
				jQuery("#listhasilrekammedis")
                                .jqGrid('navButtonAdd','#pagerhasilrekammedis',{caption:"Excel",buttonicon:"ui-icon-print",
                                onClickButton:function()
                                {   var sidx = grid.jqGrid('getGridParam','sortname');
                                    var sord = grid.jqGrid('getGridParam','sortorder');
                                    var page = grid.jqGrid('getGridParam','page');
                                    var row  = grid.jqGrid('getGridParam','rowNum');
                                    window.location.href="<?php echo base_url() ?>index.php/hasil/hasilrekammedis/ekspor?tgl2="+tgl2hasilrekammedis+"&tgl1="+tgl1hasilrekammedis+"&tahun="+tahunhasilrekammedis+"&bulan="+bulanhasilrekammedis+"&sidx="+sidx+"&page="+page+"&rows="+row+"&sord="+sord;

                                  //alert("BERHASIL ayo SEMANGAT kalahkan skripsi");
				}
				})
                                .jqGrid('navButtonAdd','#pagerhasilrekammedis',{caption:"Impor",buttonicon:"ui-icon-folder-open",
                                onClickButton:function()
                                {
                                var status = <?php echo $this->session->userdata('level')?>;
                                if(status == 7)
                                {
                                $("#hasilrekammedisimpor").load("<?php echo base_url() ?>index.php/hasil/hasilrekammedis/impor");
                                $('#hasilrekammedisimpor').dialog('open');
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
                <select id="hasilrekammedisjenis" onchange="sethasilrekammedisjns_tanggal();">
                <option>Pilih Jenis</option>
                <option selected value="t">Transaksi</option>
                <option value="k">Kunjungan</option>
                </select>
            </td>
            <td width="300">
                Pilih Bulan :
                <select id="hasilrekammedisbulan" onchange="sethasilrekammedisbulan();">
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
                <select id="hasilrekammedistahun" onchange="sethasilrekammedistahun();">
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
                <input type="text" id="hasilrekammedistanggal1" name="hasilrekammedistanggal1"/>
            </td>
            <td>
                s/d
                <input type="text" id="hasilrekammedistanggal2" name="hasilrekammedistanggal2" onchange="sethasilrekammedistanggal();"/>
            </td>

        </tr>
    </table>
</form>
<div id="master_hasilrekammedis" style="width: auto; height: auto;overflow: auto">
		<table id="listhasilrekammedis" class="scroll" cellpadding="0" cellspacing="0"></table>
		<div id="pagerhasilrekammedis" class="scroll" style="text-align:center;"></div>
                <div id="hasilrekammedisimpor"></div>
</div>