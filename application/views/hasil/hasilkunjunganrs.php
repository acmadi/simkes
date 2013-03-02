		<script type="text/javascript">
					var bulanhasilkunjunganrs='';
                    var tahunhasilkunjunganrs='';
                    var tgl1hasilkunjunganrs='';
                    var tgl2hasilkunjunganrs='';
                    var penanggunghasilkunjunganrs='';
					var jns_tanggalhasilkunjunganrs='';

                function sethasilkunjunganrsjns_tanggal()
                {
                   jns_tanggalhasilkunjunganrs= $('#hasilkunjunganrsjenis').val();
                   $('#listhasilkunjunganrs').trigger('reloadGrid');
                }



                function sethasilkunjunganrstanggal()
                {
                    if($('#hasilkunjunganrstanggal1').val()=='')
                        {
                            alert('Isi dulu tanggal awalnya');
                        }
                    else
                    {
                    tgl1hasilkunjunganrs=$('#hasilkunjunganrstanggal1').val();
                    tgl2hasilkunjunganrs=$('#hasilkunjunganrstanggal2').val();
                    //alert(tgl1);alert(tgl2);
                    $('#listhasilkunjunganrs').trigger('reloadGrid');
                    }

                }

                function sethasilkunjunganrsbulan()
                {
                    //bulan= document.getElementById('hasilkunjunganrsbulan');
                    bulanhasilkunjunganrs = $('#hasilkunjunganrsbulan').val();
                    $('#listhasilkunjunganrs').trigger('reloadGrid');
                }

                function sethasilkunjunganrstahun()
                {
                     tahunhasilkunjunganrs = $('#hasilkunjunganrstahun').val();
                $('#listhasilkunjunganrs').trigger('reloadGrid');
                }



                $( "#hasilkunjunganrstanggal1" ).datepicker({
                //dateFormat  : "dd MM yy",
                changeMonth: true,
                changeYear: true,
                showOn: "button",
                buttonImage : "<?php echo base_url();?>asset/images/calendar.gif",
                buttonImageOnly : true
                });

                $( "#hasilkunjunganrstanggal2" ).datepicker({
                //dateFormat  : "dd MM yy",
                changeMonth     : true, // menampilkan dropdown untuk ganti bulan
                changeYear      : true, // menampilkan dropdown untuk ganti Tahun
                showOn          : "button",
                buttonImage     : "<?php echo base_url();?>asset/images/calendar.gif",
                buttonImageOnly : true
                });
		$(document).ready(function()
			{       $('#hasilkunjunganrsimpor').dialog({
                                        autoOpen:false,
                                        title:"Import Data Kunjungan RS",
                                        resizable:false,
                                        width:350,
                                        height:150,
                                        show: 'drop',
                                        hide: 'scale',
                                        modal:true
                                        }
                                        );
				var grid = $("#listhasilkunjunganrs");
				grid.jqGrid({
					url: '<?php echo base_url() ?>index.php/hasil/hasilkunjunganrs/json', //URL Tujuan Yg Mengenerate data Json nya
					datatype: "json", //Datatype yg di gunakan
					height: "auto", //Mengset Tinggi table jadi Auto menyesuaikan dengan isi table
					mtype: "GET",
                                        postData:{
                                        jns_tanggal : function()
                                        {

                                         return jns_tanggalhasilkunjunganrs;
                                        },bulan : function()
                                        {

                                         return bulanhasilkunjunganrs;
                                        },tahun : function()
                                        {

                                         return tahunhasilkunjunganrs;
                                        },tgl1 : function()
                                        {

                                         return tgl1hasilkunjunganrs;
                                        },tgl2 : function()
                                        {

                                         return tgl2hasilkunjunganrs;
                                        }

                                        },
					colNames: ['Id Transaksi','Tl Trans.','Tgl Masuk','Tgl Keluar','Nomor RM','NIP','Penanggung','Pasien','Rumah Sakit','Diagnosa','Kondisi Umum','Jenis Rawat','Dokter','Tindakan','Jumlah Obat'],
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
						{name:'fax_provider',index:'kondisi',width:150,align:'center',editable:true,editrules:{required:true}},
						{name:'fax_provider',index:'dokter_rawat',width:150,align:'center',editable:true,editrules:{required:true}},
						{name:'fax_provider',index:'nama_dokter',width:150,align:'center',editable:true,editrules:{required:true}},
                                                {name:'tindakan',index:'hasil_lab',width:150,align:'center',editable:true,editrules:{required:true}},
                                                {name:'jenis_jml_obat',index:'hasil_rontgen',width:150,align:'center',editable:true,editrules:{required:true}}
                                               
					],
					rownumbers:true,
					rowNum: 10,
					rowList: [10,20,30],
					pager: '#pagerhasilkunjunganrs',
					sortname: 'id_transaksi',
					viewrecords: true,
					sortorder: "desc",
					editurl: '<?php echo base_url() ?>index.php/hasil/hasilkunjunganrs/crud', //URL Proses CRUD Nya
					multiselect: false, 
					caption: "Data hasilkunjunganrs" //Caption List					
				});
				grid.jqGrid('navGrid','#pagerhasilkunjunganrs',{view:true,edit:false,add:false,del:true},{},{},{},{closeOnEscape:true,closeAfterSearch:false,multipleSearch:false, multipleGroup:false, showQuery:false,drag:true,showOnLoad:false,sopt:['cn'],resize:false,caption:'Cari Record', Find:'Cari', Reset:'Batalkan Pencarian'});
				jQuery("#listhasilkunjunganrs")
                                .jqGrid('navButtonAdd','#pagerhasilkunjunganrs',{caption:"Excel",buttonicon:"ui-icon-print",
                                onClickButton:function()
                                {   var sidx = grid.jqGrid('getGridParam','sortname');
                                    var sord = grid.jqGrid('getGridParam','sortorder');
                                    var page = grid.jqGrid('getGridParam','page');
                                    var row  = grid.jqGrid('getGridParam','rowNum');
                                   window.location.href="<?php echo base_url() ?>index.php/hasil/hasilkunjunganrs/ekspor?tgl2="+tgl2hasilkunjunganrs+"&tgl1="+tgl1hasilkunjunganrs+"&tahun="+tahunhasilkunjunganrs+"&bulan="+bulanhasilkunjunganrs+"&sidx="+sidx+"&page="+page+"&rows="+row+"&sord="+sord;
				//alert("BERHASIL ayo SEMANGAT kalahkan skripsi");
				}
				})
                                .jqGrid('navButtonAdd','#pagerhasilkunjunganrs',{caption:"Impor",buttonicon:"ui-icon-folder-open",
                                onClickButton:function()
                                {
                                var status = <?php echo $this->session->userdata('level')?>;
                                if(status == 7)
                                {
                                $("#hasilkunjunganrsimpor").load("<?php echo base_url() ?>index.php/hasil/hasilkunjunganrs/impor");
                                $('#hasilkunjunganrsimpor').dialog('open');
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
                <select id="hasilkunjunganrsjenis" onchange="sethasilkunjunganrsjns_tanggal();">
                <option>Pilih Jenis</option>
                <option selected value="t">Transaksi</option>
                <option value="k">Kunjungan</option>
                </select>
            </td>
            <td width="300">
                Pilih Bulan :
                <select id="hasilkunjunganrsbulan" onchange="sethasilkunjunganrsbulan();">
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
                <select id="hasilkunjunganrstahun" onchange="sethasilkunjunganrstahun();">
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
                <input type="text" id="hasilkunjunganrstanggal1" name="hasilkunjunganrstanggal1"/>
            </td>
            <td>
                s/d
                <input type="text" id="hasilkunjunganrstanggal2" name="hasilkunjunganrstanggal2" onchange="sethasilkunjunganrstanggal();"/>
            </td>

        </tr>
    </table>
</form>
<div id="master_hasilkunjunganrs" style="width: auto; height: auto;overflow: auto">
		<table id="listhasilkunjunganrs" class="scroll" cellpadding="0" cellspacing="0"></table>
		<div id="pagerhasilkunjunganrs" class="scroll" style="text-align:center;"></div>
                <div id="hasilkunjunganrsimpor"></div>
</div>