		<script type="text/javascript">
					var bulanhasildak ='';
                    var tahunhasildak='';
                    var tgl1hasildak='';
                    var tgl2hasildak='';
                    var penanggunghasildak='';
                    var jns_tanggalhasildak='';

                function sethasildakjns_tanggal()
                {
                   jns_tanggalhasildak= $('#hasildakjenis').val();
                   $('#listhasildak').trigger('reloadGrid');
                }
                

                function sethasildaktanggal()
                {
                    if($('#hasildaktanggal1').val()=='')
                        {
                            alert('Isi dulu tanggal awalnya');
                        }
                    else
                    {
                    tgl1hasildak=$('#hasildaktanggal1').val();
                    tgl2hasildak=$('#hasildaktanggal2').val();
                    $('#listhasildak').trigger('reloadGrid');
                    }
                    
                }

                function sethasildakbulan()
                {
                    //bulan= document.getElementById('hasildakbulan');
                    bulanhasildak = $('#hasildakbulan').val();
                    $('#listhasildak').trigger('reloadGrid');
                }

                function sethasildaktahun()
                {
                     tahunhasildak = $('#hasildaktahun').val();
                $('#listhasildak').trigger('reloadGrid');
                }

                

                $( "#hasildaktanggal1" ).datepicker({
                //dateFormat  : "dd MM yy",
                changeMonth: true,
                changeYear: true,
                showOn: "button",
                buttonImage : "<?php echo base_url();?>asset/images/calendar.gif",
                buttonImageOnly : true
                });

                $( "#hasildaktanggal2" ).datepicker({
                //dateFormat  : "dd MM yy",
                changeMonth     : true, // menampilkan dropdown untuk ganti bulan
                changeYear      : true, // menampilkan dropdown untuk ganti Tahun
                showOn          : "button",
                buttonImage     : "<?php echo base_url();?>asset/images/calendar.gif",
                buttonImageOnly : true
                });
                $(document).ready(function()
			{       $('#hasildakimpor').dialog({
                                        autoOpen:false,
                                        title:"Import Data Transaksi DAK",
                                        resizable:false,
                                        width:350,
                                        height:150,
                                        show: 'drop',
                                        hide: 'scale',
                                        modal:true
                                        }
                                        );
				var grid = $("#listhasildak");
				grid.jqGrid({
					url: '<?php echo base_url() ?>index.php/hasil/hasildak/json', //URL Tujuan Yg Mengenerate data Json nya
					datatype: "json", //Datatype yg di gunakan
					height: "auto", //Mengset Tinggi table jadi Auto menyesuaikan dengan isi table
					mtype: "GET",
                                        postData:{
                                        jns_tanggal : function()
                                        {

                                         return jns_tanggalhasildak;
                                        },bulan : function()
                                        {

                                         return bulanhasildak;
                                        },tahun : function()
                                        {

                                         return tahunhasildak;
                                        },tgl1 : function()
                                        {

                                         return tgl1hasildak;
                                        },tgl2 : function()
                                        {

                                         return tgl2hasildak;
                                        }

                                        },
					colNames: ['Id Transaksi','Tl Trans.','Tgl Kunjungan','Kunjungan','No. Bukti','NIP','Penanggung','Pasien','Rujukan','Dokter','Anamnesis','Kondisi','Kesadaran','Suhu','Berat','Tinggi','Bosy Mass Index','Nadi','Sistole','Diastole','Nafas','Alergi','Diagnosa','Folow Up','Entri dari'],
					colModel: [
						{name:'id_provider', key:true, index:'id_provider', hidden:true,editable:false,editrules:{required:true}},//name untuk variabel post yang dikirim saat menambah data
						{name:'nama_provider',index:'nama_provider',width:120,editable:true,editrules:{required:true}},//index untuk variabel yang digunakan saat pencarian
						{name:'almt_provider',index:'almt_provider',width:150,editable:true,editrules:{required:true}},
						{name:'langg_provider',index:'langg_provider', width:90, editable: true,edittype:"checkbox",editoptions: {value:"y:n"}},
						{name:'email_provider',index:'email_provider',width:150,align:'center',editable:true,editrules:{required:true}},
						{name:'fax_provider',index:'fax_provider',width:150,align:'center',editable:true,editrules:{required:true}},
						{name:'fax_provider',index:'fax_provider',width:150,align:'center',editable:true,editrules:{required:true}},
						{name:'fax_provider',index:'fax_provider',width:150,align:'center',editable:true,editrules:{required:true}},
						{name:'fax_provider',index:'fax_provider',width:150,align:'center',editable:true,editrules:{required:true}},
                        {name:'fax_provider',index:'fax_provider',width:150,align:'center',editable:true,editrules:{required:true}},
                        {name:'fax_provider',index:'fax_provider',width:150,align:'center',editable:true,editrules:{required:true}},
						{name:'fax_provider',index:'fax_provider',width:150,align:'center',editable:true,editrules:{required:true}},
						{name:'fax_provider',index:'fax_provider',width:150,align:'center',editable:true,editrules:{required:true}},
						{name:'fax_provider',index:'fax_provider',width:150,align:'center',editable:true,editrules:{required:true}},
						{name:'fax_provider',index:'fax_provider',width:150,align:'center',editable:true,editrules:{required:true}},
                        {name:'fax_provider',index:'fax_provider',width:150,align:'center',editable:true,editrules:{required:true}},
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
					pager: '#pagerhasildak',
					sortname: 'id_transaksi',
					viewrecords: true,
					sortorder: "desc",
					editurl: '<?php echo base_url() ?>index.php/hasil/hasildak/crud', //URL Proses CRUD Nya
					multiselect: false, 
					caption: "Data hasildak" //Caption List					
				});
				grid.jqGrid('navGrid','#pagerhasildak',{view:true,edit:false,add:false,del:true},{},{},{},{closeOnEscape:true,closeAfterSearch:false,multipleSearch:false, multipleGroup:false, showQuery:false,drag:true,showOnLoad:false,sopt:['cn'],resize:false,caption:'Cari Record', Find:'Cari', Reset:'Batalkan Pencarian'});
				jQuery("#listhasildak")
                                .jqGrid('navButtonAdd','#pagerhasildak',{caption:"Excel",buttonicon:"ui-icon-print",
                                onClickButton:function()
                                {
                                    var sidx = grid.jqGrid('getGridParam','sortname');
                                    var sord = grid.jqGrid('getGridParam','sortorder');
                                    var page = grid.jqGrid('getGridParam','page');
                                    var row  = grid.jqGrid('getGridParam','rowNum');
                                   window.location.href="<?php echo base_url() ?>index.php/hasil/hasildak/ekspor?tgl2="+tgl2hasildak+"&tgl1="+tgl1hasildak+"&tahun="+tahunhasildak+"&bulan="+bulanhasildak+"&sidx="+sidx+"&page="+page+"&rows="+row+"&sord="+sord;
				//alert("BERHASIL ayo SEMANGAT kalahkan skripsi");
				}
				})
                                .jqGrid('navButtonAdd','#pagerhasildak',{caption:"Impor",buttonicon:"ui-icon-folder-open",
                                onClickButton:function()
                                {
                                //alert('impor');
                                var status = <?php echo $this->session->userdata('level')?>;
                                if(status == 7)
                                {
                                $("#hasildakimpor").load("<?php echo base_url() ?>index.php/hasil/hasildak/impor");
                                $('#hasildakimpor').dialog('open');
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
                <select id="hasildakjenis" onchange="sethasildakjns_tanggal();">
                <option>Pilih Jenis</option>
                <option selected value="t">Transaksi</option>
                <option value="k">Kunjungan</option>
                </select>
            </td>
            <td width="300">
                Pilih Bulan :
                <select id="hasildakbulan" onchange="sethasildakbulan();">
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
                <select id="hasildaktahun" onchange="sethasildaktahun();">
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
                <input type="text" id="hasildaktanggal1" name="hasildaktanggal1"/>
            </td>
            <td>
                s/d
                <input type="text" id="hasildaktanggal2" name="hasildaktanggal2" onchange="sethasildaktanggal();"/>
            </td>

        </tr>
    </table>
</form>
<div id="master_hasildak" style="width: auto; height: auto;overflow: auto">
		<table id="listhasildak" class="scroll" cellpadding="0" cellspacing="0"></table>
		<div id="pagerhasildak" class="scroll" style="text-align:center;"></div>
                <div id="hasildakimpor"></div>
</div>