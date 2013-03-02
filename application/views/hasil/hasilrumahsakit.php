		<script type="text/javascript">
					var bulanhasilrumahsakit='';
                    var tahunhasilrumahsakit='';
                    var tgl1hasilrumahsakit='';
                    var tgl2hasilrumahsakit='';
                    var penanggunghasilrumahsakit='';
					var jns_tanggalhasilrumahsakit='';

                function sethasilrumahsakitjns_tanggal()
                {
                   jns_tanggalhasilrumahsakit= $('#hasilrumahsakitjenis').val();
                   $('#listhasilrumahsakit').trigger('reloadGrid');
                }



                function sethasilrumahsakittanggal()
                {
                    if($('#hasilrumahsakittanggal1').val()=='')
                        {
                            alert('Isi dulu tanggal awalnya');
                        }
                    else
                    {
                    tgl1hasilrumahsakit=$('#hasilrumahsakittanggal1').val();
                    tgl2hasilrumahsakit=$('#hasilrumahsakittanggal2').val();
                    //alert(tgl1);alert(tgl2);
                    $('#listhasilrumahsakit').trigger('reloadGrid');
                    }

                }

                function sethasilrumahsakitbulan()
                {
                    //bulan= document.getElementById('hasilrumahsakitbulan');
                    bulanhasilrumahsakit = $('#hasilrumahsakitbulan').val();
                    $('#listhasilrumahsakit').trigger('reloadGrid');
                }

                function sethasilrumahsakittahun()
                {
                     tahunhasilrumahsakit = $('#hasilrumahsakittahun').val();
                $('#listhasilrumahsakit').trigger('reloadGrid');
                }



                $( "#hasilrumahsakittanggal1" ).datepicker({
                //dateFormat  : "dd MM yy",
                changeMonth: true,
                changeYear: true,
                showOn: "button",
                buttonImage : "<?php echo base_url();?>asset/images/calendar.gif",
                buttonImageOnly : true
                });

                $( "#hasilrumahsakittanggal2" ).datepicker({
                //dateFormat  : "dd MM yy",
                changeMonth     : true, // menampilkan dropdown untuk ganti bulan
                changeYear      : true, // menampilkan dropdown untuk ganti Tahun
                showOn          : "button",
                buttonImage     : "<?php echo base_url();?>asset/images/calendar.gif",
                buttonImageOnly : true
                });
		$(document).ready(function()
			{       $('#hasilrumahsakitimpor').dialog({
                                        autoOpen:false,
                                        title:"Import Data Rumah Sakit",
                                        resizable:false,
                                        width:350,
                                        height:150,
                                        show: 'drop',
                                        hide: 'scale',
                                        modal:true
                                        }
                                        );
                                 $('#detailhasilrumahsakit').dialog({

                                        autoOpen:false,
                                        title:"Detail",
                                        resizable:false,
                                        width:750,
                                        show: 'drop',
                                        hide: 'scale',
                                        modal:true
                                        }
                                        );
				var grid = $("#listhasilrumahsakit");
				grid.jqGrid({
					url: '<?php echo base_url() ?>index.php/hasil/hasilrumahsakit/json', //URL Tujuan Yg Mengenerate data Json nya
					datatype: "json", //Datatype yg di gunakan
					height: "auto", //Mengset Tinggi table jadi Auto menyesuaikan dengan isi table
					mtype: "GET",
                                        postData:{
                                        jns_tanggal : function()
                                        {

                                         return jns_tanggalhasilrumahsakit;
                                        },bulan : function()
                                        {

                                         return bulanhasilrumahsakit;
                                        },tahun : function()
                                        {

                                         return tahunhasilrumahsakit;
                                        },tgl1 : function()
                                        {

                                         return tgl1hasilrumahsakit;
                                        },tgl2 : function()
                                        {

                                         return tgl2hasilrumahsakit;
                                        }

                                        },
					colNames: ['Id Transaksi','Tl Trans.','Tgl Masuk','Tgl Keluar','Surat','No. Bukti','No Buku Besar','Restitusi','NIP','Penanggung','Pasien','Rumah Sakit','Rawat','Diagnosa'],
					colModel: [
						{name:'id_transaksi', key:true, index:'id_transaksi', hidden:true,editable:false,editrules:{required:true}},//name untuk variabel post yang dikirim saat menambah data
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
                        {name:'tlp_provider',index:'tlp_provider',width:150,align:'center',editable:true,editrules:{required:true}}
					],
					rownumbers:true,
					rowNum: 10,
					rowList: [10,20,30],
					pager: '#pagerhasilrumahsakit',
					sortname: 'id_transaksi',
                                        ondblClickRow: function(id_transaksi)
                                                    {

                                                    alert("You double click row with id: "+id_transaksi);
                                                    $('#detailhasilrumahsakit').dialog('open');
                                                    $("#detailhasilrumahsakit").load("<?php echo base_url() ?>index.php/hasil/hasilrumahsakit/detail/"+id_transaksi);
                                                    
                                                    return false;
                                                    },
					viewrecords: true,
					sortorder: "desc",
					editurl: '<?php echo base_url() ?>index.php/hasil/hasilrumahsakit/crud', //URL Proses CRUD Nya
					multiselect: false, 
					caption: "Data hasilrumahsakit" //Caption List					
				});
				grid.jqGrid('navGrid','#pagerhasilrumahsakit',{view:true,edit:false,add:false,del:true},{},{},{},{closeOnEscape:true,closeAfterSearch:false,multipleSearch:false, multipleGroup:false, showQuery:false,drag:true,showOnLoad:false,sopt:['cn'],resize:false,caption:'Cari Record', Find:'Cari', Reset:'Batalkan Pencarian'});
				jQuery("#listhasilrumahsakit")
                                .jqGrid('navButtonAdd','#pagerhasilrumahsakit',{caption:"Excel",buttonicon:"ui-icon-print",
                                onClickButton:function()
                                {   var sidx = grid.jqGrid('getGridParam','sortname');
                                    var sord = grid.jqGrid('getGridParam','sortorder');
                                    var page = grid.jqGrid('getGridParam','page');
                                    var row  = grid.jqGrid('getGridParam','rowNum');
                                    window.location.href="<?php echo base_url() ?>index.php/hasil/hasilrumahsakit/ekspor?tgl2="+tgl2hasilrumahsakit+"&tgl1="+tgl1hasilrumahsakit+"&tahun="+tahunhasilrumahsakit+"&bulan="+bulanhasilrumahsakit+"&sidx="+sidx+"&page="+page+"&rows="+row+"&sord="+sord;

                                  //alert("BERHASIL ayo SEMANGAT kalahkan skripsi");
				}
				})
                                .jqGrid('navButtonAdd','#pagerhasilrumahsakit',{caption:"Impor",buttonicon:"ui-icon-folder-open",
                                onClickButton:function()
                                {
                                var status = <?php echo $this->session->userdata('level')?>;
                                if(status == 7)
                                {
                                $("#hasilrumahsakitimpor").load("<?php echo base_url() ?>index.php/hasil/hasilrumahsakit/impor");
                                $('#hasilrumahsakitimpor').dialog('open');
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
                <select id="hasilrumahsakitjenis" onchange="sethasilrumahsakitjns_tanggal();">
                <option>Pilih Jenis</option>
                <option selected value="t">Transaksi</option>
                <option value="k">Kunjungan</option>
                </select>
            </td>
            <td width="300">
                Pilih Bulan :
                <select id="hasilrumahsakitbulan" onchange="sethasilrumahsakitbulan();">
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
                <select id="hasilrumahsakittahun" onchange="sethasilrumahsakittahun();">
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
                <input type="text" id="hasilrumahsakittanggal1" name="hasilrumahsakittanggal1"/>
            </td>
            <td>
                s/d
                <input type="text" id="hasilrumahsakittanggal2" name="hasilrumahsakittanggal2" onchange="sethasilrumahsakittanggal();"/>
            </td>

        </tr>
    </table>
</form>
<div id="master_hasilrumahsakit" style="width: auto; height: auto;overflow: auto">
		<table id="listhasilrumahsakit" class="scroll" cellpadding="0" cellspacing="0"></table>
		<div id="pagerhasilrumahsakit" class="scroll" style="text-align:center;"></div>
                <div id="hasilrumahsakitimpor"></div>
                <div id="detailhasilrumahsakit"></div>
</div>