		<script type="text/javascript">
					var bulanhasiloptik='';
                    var tahunhasiloptik='';
                    var tgl1hasiloptik='';
                    var tgl2hasiloptik='';
                    var penanggunghasiloptik='';
					var jns_tanggalhasiloptik='';

                function sethasiloptikjns_tanggal()
                {
                   jns_tanggalhasiloptik= $('#hasiloptikjenis').val();
                   $('#listhasiloptik').trigger('reloadGrid');
                }



                function sethasiloptiktanggal()
                {
                    if($('#hasiloptiktanggal1').val()=='')
                        {
                            alert('Isi dulu tanggal awalnya');
                        }
                    else
                    {
                    tgl1hasiloptik=$('#hasiloptiktanggal1').val();
                    tgl2hasiloptik=$('#hasiloptiktanggal2').val();
                    //alert(tgl1);alert(tgl2);
                    $('#listhasiloptik').trigger('reloadGrid');
                    }

                }

                function sethasiloptikbulan()
                {
                    //bulan= document.getElementById('hasiloptikbulan');
                    bulanhasiloptik = $('#hasiloptikbulan').val();
                    $('#listhasiloptik').trigger('reloadGrid');
                }

                function sethasiloptiktahun()
                {
                     tahunhasiloptik = $('#hasiloptiktahun').val();
                $('#listhasiloptik').trigger('reloadGrid');
                }



                $( "#hasiloptiktanggal1" ).datepicker({
                //dateFormat  : "dd MM yy",
                changeMonth: true,
                changeYear: true,
                showOn: "button",
                buttonImage : "<?php echo base_url();?>asset/images/calendar.gif",
                buttonImageOnly : true
                });

                $( "#hasiloptiktanggal2" ).datepicker({
                //dateFormat  : "dd MM yy",
                changeMonth     : true, // menampilkan dropdown untuk ganti bulan
                changeYear      : true, // menampilkan dropdown untuk ganti Tahun
                showOn          : "button",
                buttonImage     : "<?php echo base_url();?>asset/images/calendar.gif",
                buttonImageOnly : true
                });
                $(document).ready(function()
			{       $('#hasiloptikimpor').dialog({
                                        autoOpen:false,
                                        title:"Import Data optik",
                                        resizable:false,
                                        width:350,
                                        height:150,
                                        show: 'drop',
                                        hide: 'scale',
                                        modal:true
                                        }
                                        );
                                $('#detailhasiloptik').dialog({
                                        autoOpen:false,
                                        title:"Detail",
                                        resizable:false,
                                        width:750,
                                        show: 'drop',
                                        hide: 'scale',
                                        modal:true
                                        }
                                        );
				var grid = $("#listhasiloptik");
				grid.jqGrid({
					url: '<?php echo base_url() ?>index.php/hasil/hasiloptik/json', //URL Tujuan Yg Mengenerate data Json nya
					datatype: "json", //Datatype yg di gunakan
					height: "auto", //Mengset Tinggi table jadi Auto menyesuaikan dengan isi table
					mtype: "GET",
                                        postData:{
                                        jns_tanggal : function()
                                        {

                                         return jns_tanggalhasiloptik;
                                        },bulan : function()
                                        {

                                         return bulanhasiloptik;
                                        },tahun : function()
                                        {

                                         return tahunhasiloptik;
                                        },tgl1 : function()
                                        {

                                         return tgl1hasiloptik;
                                        },tgl2 : function()
                                        {

                                         return tgl2hasiloptik;
                                        }

                                        },
					colNames: ['Id Transaksi','Tl Trans.','Tgl Kunjungan','Surat','No. Bukti','No Buku Besar','Restitusi','NIP','Penanggung','Pasien','Rujukan','Dokter','Laboratorium','Diagnosa'],
					colModel: [
						{name:'id_transaksi', key:true, index:'id_transaksi', hidden:true,editable:false,editrules:{required:true}},//name untuk variabel post yang dikirim saat menambah data
						{name:'nama_provider',index:'nama_provider',width:120,editable:true,editrules:{required:true}},//index untuk variabel yang digunakan saat pencarian
						{name:'almt_provider',index:'almt_provider',width:150,editable:true,editrules:{required:true}},
						{name:'langg_provider',index:'langg_provider', width:90, editable: true,edittype:"checkbox",editoptions: {value:"y:n"}},
						{name:'langg_provider',index:'langg_provider', width:90, editable: true,edittype:"checkbox",editoptions: {value:"y:n"}},
						{name:'langg_provider',index:'langg_provider', width:90, editable: true,edittype:"checkbox",editoptions: {value:"y:n"}},
						{name:'langg_provider',index:'langg_provider', width:90, editable: true,edittype:"checkbox",editoptions: {value:"y:n"}},
						{name:'langg_provider',index:'langg_provider', width:90, editable: true,edittype:"checkbox",editoptions: {value:"y:n"}},
						{name:'langg_provider',index:'langg_provider', width:90, editable: true,edittype:"checkbox",editoptions: {value:"y:n"}},
						{name:'langg_provider',index:'langg_provider', width:90, editable: true,edittype:"checkbox",editoptions: {value:"y:n"}},
						{name:'langg_provider',index:'langg_provider', width:90, editable: true,edittype:"checkbox",editoptions: {value:"y:n"}},
						{name:'langg_provider',index:'langg_provider', width:90, editable: true,edittype:"checkbox",editoptions: {value:"y:n"}},
						{name:'fax_provider',index:'fax_provider',width:150,align:'center',editable:true,editrules:{required:true}},
                                                {name:'tlp_provider',index:'tlp_provider',width:150,align:'center',editable:true,editrules:{required:true}}
					],
					rownumbers:true,
					rowNum: 10,
					rowList: [10,20,30],
					pager: '#pagerhasiloptik',
					sortname: 'id_transaksi',
                                        ondblClickRow: function(id_transaksi)
                                                    {

                                                    alert("You double click row with id: "+id_transaksi);
                                                    $('#detailhasiloptik').dialog('open');
                                                    $("#detailhasiloptik").load("<?php echo base_url() ?>index.php/hasil/hasiloptik/detail/"+id_transaksi);
                                                    
                                                    return false;
                                                    },
					viewrecords: true,
					sortorder: "desc",
					editurl: '<?php echo base_url() ?>index.php/hasil/hasiloptik/crud', //URL Proses CRUD Nya
					multiselect: false, 
					caption: "Data hasiloptik" //Caption List					
				});
				grid.jqGrid('navGrid','#pagerhasiloptik',{view:true,edit:false,add:false,del:true},{},{},{},{closeOnEscape:true,closeAfterSearch:false,multipleSearch:false, multipleGroup:false, showQuery:false,drag:true,showOnLoad:false,sopt:['cn'],resize:false,caption:'Cari Record', Find:'Cari', Reset:'Batalkan Pencarian'});
				jQuery("#listhasiloptik")
                                .jqGrid('navButtonAdd','#pagerhasiloptik',{caption:"Excel",buttonicon:"ui-icon-print",
                                onClickButton:function()
                                {   var sidx = grid.jqGrid('getGridParam','sortname');
                                    var sord = grid.jqGrid('getGridParam','sortorder');
                                    var page = grid.jqGrid('getGridParam','page');
                                    var row  = grid.jqGrid('getGridParam','rowNum');
                                   window.location.href="<?php echo base_url() ?>index.php/hasil/hasiloptik/ekspor?tgl2="+tgl2hasiloptik+"&tgl1="+tgl1hasiloptik+"&tahun="+tahunhasiloptik+"&bulan="+bulanhasiloptik+"&sidx="+sidx+"&page="+page+"&rows="+row+"&sord="+sord;


                                    //alert("BERHASIL ayo SEMANGAT kalahkan skripsi");
				}
				})
                                .jqGrid('navButtonAdd','#pagerhasiloptik',{caption:"Impor",buttonicon:"ui-icon-folder-open",
                                onClickButton:function()
                                {
                                var status = <?php echo $this->session->userdata('level')?>;
                                if(status == 7)
                                {
                                $("#hasiloptikimpor").load("<?php echo base_url() ?>index.php/hasil/hasiloptik/impor");
                                $('#hasiloptikimpor').dialog('open');
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
                <select id="hasiloptikjenis" onchange="sethasiloptikjns_tanggal();">
                <option>Pilih Jenis</option>
                <option selected value="t">Transaksi</option>
                <option value="k">Kunjungan</option>
                </select>
            </td>
            <td width="300">
                Pilih Bulan :
                <select id="hasiloptikbulan" onchange="sethasiloptikbulan();">
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
                <select id="hasiloptiktahun" onchange="sethasiloptiktahun();">
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
                <input type="text" id="hasiloptiktanggal1" name="hasiloptiktanggal1"/>
            </td>
            <td>
                s/d
                <input type="text" id="hasiloptiktanggal2" name="hasiloptiktanggal2" onchange="sethasiloptiktanggal();"/>
            </td>

        </tr>
    </table>
</form>
<div id="master_hasiloptik" style="width: auto; height: auto;overflow: auto">
		<table id="listhasiloptik" class="scroll" cellpadding="0" cellspacing="0"></table>
		<div id="pagerhasiloptik" class="scroll" style="text-align:center;"></div>
                <div id="hasiloptikimpor"></div>
                <div id="detailhasiloptik"></div>
</div>