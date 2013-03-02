		<script type="text/javascript">
					var bulanhasildokter='';
                    var tahunhasildokter='';
                    var tgl1hasildokter='';
                    var tgl2hasildokter='';
                    var penanggunghasildokter='';
					var jns_tanggalhasildokter='';

                function sethasildokterjns_tanggal()
                {
                   jns_tanggalhasildokter= $('#hasildokterjenis').val();
                   $('#listhasildokter').trigger('reloadGrid');
                }
                

                function sethasildoktertanggal()
                {
                    if($('#hasildoktertanggal1').val()=='')
                        {
                            alert('Isi dulu tanggal awalnya');
                        }
                    else
                    {
                    tgl1hasildokter=$('#hasildoktertanggal1').val();
                    tgl2hasildokter=$('#hasildoktertanggal2').val();
                    $('#listhasildokter').trigger('reloadGrid');
                    }
                    
                }

                function sethasildokterbulan()
                {
                    bulanhasildokter = $('#hasildokterbulan').val();
                    $('#listhasildokter').trigger('reloadGrid');
                }

                function sethasildoktertahun()
                {
                     tahunhasildokter = $('#hasildoktertahun').val();
                $('#listhasildokter').trigger('reloadGrid');
                }

                

                $( "#hasildoktertanggal1" ).datepicker({
                //dateFormat  : "dd MM yy",
                changeMonth: true,
                changeYear: true,
                showOn: "button",
                buttonImage : "<?php echo base_url();?>asset/images/calendar.gif",
                buttonImageOnly : true
                });

                $( "#hasildoktertanggal2" ).datepicker({
                //dateFormat  : "dd MM yy",
                changeMonth     : true, // menampilkan dropdown untuk ganti bulan
                changeYear      : true, // menampilkan dropdown untuk ganti Tahun
                showOn          : "button",
                buttonImage     : "<?php echo base_url();?>asset/images/calendar.gif",
                buttonImageOnly : true
                });
                $(document).ready(function()
			{       $('#hasildokterimpor').dialog({
                                        autoOpen:false,
                                        title:"Import Data Transaksi Dokter",
                                        resizable:false,
                                        width:350,
                                        height:150,
                                        show: 'drop',
                                        hide: 'scale',
                                        modal:true
                                        }
                                        );
                                $('#detailhasildokter').dialog({
                                        autoOpen:false,
                                        title:"Detail",
                                        resizable:false,
                                        width:750,
                                        show: 'drop',
                                        hide: 'scale',
                                        modal:true
                                        }
                                        );


				var grid = $("#listhasildokter");
				grid.jqGrid({
					url: '<?php echo base_url() ?>index.php/hasil/hasildokter/json', //URL Tujuan Yg Mengenerate data Json nya
					datatype: "json", //Datatype yg di gunakan
					height: "auto", //Mengset Tinggi table jadi Auto menyesuaikan dengan isi table
					mtype: "GET",
                                        postData:{
                                        jns_tanggal : function()
                                        {

                                         return jns_tanggalhasildokter;
                                        },bulan : function()
                                        {

                                         return bulanhasildokter;
                                        },tahun : function()
                                        {

                                         return tahunhasildokter;
                                        },tgl1 : function()
                                        {

                                         return tgl1hasildokter;
                                        },tgl2 : function()
                                        {

                                         return tgl2hasildokter;
                                        }

                                        },
					colNames: ['Id Transaksi','Tl Trans.','Tgl Kunjungan','Surat','No. Bukti','No Buku Besar','Restitusi','NIP','Penanggung','Pasien','Dokter','Diagnosa','Tarif Standar','Tarif Satuan'],
					colModel: [
						{name:'id_transaksi', key:true, index:'id_transaksi', hidden:true,editable:false,editrules:{required:true}},//name untuk variabel post yang dikirim saat menambah data
						{name:'tgl_transaksi',index:'nama_provider',width:120,editable:true,editrules:{required:true}},//index untuk variabel yang digunakan saat pencarian
						{name:'tgl_kunjungan',index:'almt_provider',width:150,editable:true,editrules:{required:true}},
						{name:'no_surat',index:'langg_provider', width:90, editable: true,edittype:"checkbox",editoptions: {value:"y:n"}},
						{name:'no_bukti',index:'email_provider',width:150,align:'center',editable:true,editrules:{required:true}},
						{name:'fax_provider',index:'fax_provider',width:150,align:'center',editable:true,editrules:{required:true}},
						{name:'fax_provider',index:'fax_provider',width:150,align:'center',editable:true,editrules:{required:true}},
						{name:'fax_provider',index:'fax_provider',width:150,align:'center',editable:true,editrules:{required:true}},
						{name:'fax_provider',index:'fax_provider',width:150,align:'center',editable:true,editrules:{required:true}},
						{name:'fax_provider',index:'fax_provider',width:150,align:'center',editable:true,editrules:{required:true}},
						{name:'fax_provider',index:'fax_provider',width:150,align:'center',editable:true,editrules:{required:true}},
						{name:'fax_provider',index:'fax_provider',width:150,align:'center',editable:true,editrules:{required:true}},
						{name:'fax_provider',index:'fax_provider',width:150,align:'center',editable:true,editrules:{required:true}},
                                                {name:'tlp_provider',index:'tlp_provider',width:150,align:'center',editable:true,editrules:{required:true}}
					],
					rownumbers:true,
					rowNum: 10,
					rowList: [10,20,30],
					pager: '#pagerhasildokter',
					sortname: 'id_transaksi',
					viewrecords: true,
                                        ondblClickRow: function(id_transaksi)
                                                    {

                                                    alert("You double click row with id: "+id_transaksi);
                                                    $('#detailhasildokter').dialog('open');
                                                    $("#detailhasildokter").load("<?php echo base_url() ?>index.php/hasil/hasildokter/detail/"+id_transaksi);
                                                    
                                                    return false;
                                                    },
					sortorder: "desc",
					editurl: '<?php echo base_url() ?>index.php/hasil/hasildokter/crud', //URL Proses CRUD Nya
					multiselect: false, 
					caption: "Data hasildokter" //Caption List					
				});
				grid.jqGrid('navGrid','#pagerhasildokter',{view:true,edit:false,add:false,del:true},{},{},{},{closeOnEscape:true,closeAfterSearch:false,multipleSearch:false, multipleGroup:false, showQuery:false,drag:true,showOnLoad:false,sopt:['cn'],resize:false,caption:'Cari Record', Find:'Cari', Reset:'Batalkan Pencarian'});
				jQuery("#listhasildokter")
                                .jqGrid('navButtonAdd','#pagerhasildokter',{caption:"Excel",buttonicon:"ui-icon-print",
                                onClickButton:function()
                                {
                                    var sidx = grid.jqGrid('getGridParam','sortname');
                                    var sord = grid.jqGrid('getGridParam','sortorder');
                                    var page = grid.jqGrid('getGridParam','page');
                                    var row  = grid.jqGrid('getGridParam','rowNum');
                                   window.location.href="<?php echo base_url() ?>index.php/hasil/hasildokter/ekspor?tgl2="+tgl2hasildokter+"&tgl1="+tgl1hasildokter+"&tahun="+tahunhasildokter+"&bulan="+bulanhasildokter+"&sidx="+sidx+"&page="+page+"&rows="+row+"&sord="+sord;
				//alert("BERHASIL ayo SEMANGAT kalahkan skripsi");
				}
				})
                                .jqGrid('navButtonAdd','#pagerhasildokter',{caption:"Impor",buttonicon:"ui-icon-folder-open",
                                onClickButton:function()
                                {

                                var status = <?php echo $this->session->userdata('level')?>;
                                if(status == 7)
                                {
                                $("#hasildokterimpor").load("<?php echo base_url() ?>index.php/hasil/hasildokter/impor");
                                $('#hasildokterimpor').dialog('open');
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
                <select id="hasildokterjenis" onchange="sethasildokterjns_tanggal();">
                <option>Pilih Jenis</option>
                <option selected value="t">Transaksi</option>
                <option value="k">Kunjungan</option>
                </select>
            </td>
            <td width="300">
                Pilih Bulan :
                <select id="hasildokterbulan" onchange="sethasildokterbulan();">
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
                
                <select id="hasildoktertahun" onchange="sethasildoktertahun();">
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
                <input type="text" id="hasildoktertanggal1" name="hasildoktertanggal1"/>
            </td>
            <td>
                s/d
                <input type="text" id="hasildoktertanggal2" name="hasildoktertanggal2" onchange="sethasildoktertanggal();"/>
            </td>

        </tr>
    </table>
</form>

<div id="master_hasildokter" style="width: auto; height: auto;overflow: auto">
		<table id="listhasildokter" class="scroll" cellpadding="0" cellspacing="0"></table>
		<div id="pagerhasildokter" class="scroll" style="text-align:center;"></div>
                <div id="hasildokterimpor"></div>
                <div id="detailhasildokter"></div>
</div>