		<script type="text/javascript">
                    var bulan='';
                    var tahun='';
                    var tgl1='';
                    var tgl2='';
                    var penanggung='';
                    var ap='';
                    var jns='';
                

               

                function setrawatjalan2bulan()
                {
                    //bulan= document.getElementById('rawatjalan2bulan');
                    bulan = $('#rawatjalan2bulan').val();
                    $('#listrawatjalan2').trigger('reloadGrid');
                }

                
				function setrawatjalan2tahun()
                {
                     //alert("Semangat");
                     tahun = $('#rawatjalan2tahun').val();
                     $('#listrawatjalan2').trigger('reloadGrid');
                }
				
		function setrawatjalan2jenis()
                {
                     //alert("Semangat");
                     jns = $('#rawatjalan2jenis').val();
                     $('#listrawatjalan2').trigger('reloadGrid');
                }
				
                function setrawatjalan2filter()
                {
                     ap = $('#rawatjalan2filter').val();
                     $('#listrawatjalan2').trigger('reloadGrid');
                }
                
                
                

                

		$(document).ready(function()
			{
				var grid = $("#listrawatjalan2");
				grid.jqGrid({
					url: '<?php echo base_url() ?>index.php/laporan/rawatjalan2/json', //URL Tujuan Yg Mengenerate data Json nya
					datatype: "json", //Datatype yg di gunakan
                                        height: "auto", //Mengset Tinggi table jadi Auto menyesuaikan dengan isi table
					mtype: "GET",
                                        postData:{bulan : function()
                                        {
                                         
                                         return bulan;
                                        },tahun : function()
                                        {

                                         return tahun;
                                        },ap : function()
                                        {

                                         return ap;
                                        },jns : function()
                                        {

                                         return jns;
                                        }

                                        },
					colNames: ['Id Transaksi','Tgl Kunjungan','NIP','Penanggung','A/P','Pasien','Status','Provider','Buku Besar','Diagnosa','Item Trans','Jumlah','Total'],
					colModel: [
						{name:'id_transaksi', key:true, index:'id_transaksi', hidden:true,editable:false,editrules:{required:true}},//name untuk variabel post yang dikirim saat menambah data
						{name:'nama_provider',index:'tgl_kunjungan',width:120,editable:true,editrules:{required:true}},//index untuk variabel yang digunakan saat pencarian
						{name:'almt_provider',index:'nip',width:150,editable:true,editrules:{required:true}},
						{name:'langg_provider',index:'nama_karyawan', width:90, editable: true,edittype:"checkbox",editoptions: {value:"y:n"}},
						{name:'fax_provider',index:'ap',width:150,align:'center',editable:true,editrules:{required:true}},
                                                {name:'tlp_provider',index:'nama_tertanggung',width:150,align:'center',editable:true,editrules:{required:true}},
                                                {name:'tlp_provider',index:'status',width:150,align:'center',editable:true,editrules:{required:true}},
                                                {name:'tlp_provider',index:'nama_provider',width:150,align:'center',editable:true,editrules:{required:true}},
                                                {name:'tlp_provider',index:'buku_besar',width:150,align:'center',editable:true,editrules:{required:true}},
                                                {name:'tlp_provider',index:'nama_diagnosa',width:150,align:'center',editable:true,editrules:{required:true}},
                                                {name:'tlp_provider',index:'nama_item',width:150,align:'center',editable:true,editrules:{required:true}},
                                                {name:'tlp_provider',index:'jumlah',width:150,align:'center',editable:true,editrules:{required:true}},
                                                {name:'tlp_provider',index:'total_harga',width:150,align:'center',editable:true,editrules:{required:true}}
					],
					rownumbers:true,
					rowNum: 10,
					rowList: [10,20,30],
					pager: '#pagerrawatjalan2',
					sortname: 'id_transaksi',
					viewrecords: true,
					sortorder: "desc",
					editurl: '<?php echo base_url() ?>index.php/laporan/rawatjalan2/crud', //URL Proses CRUD Nya
					multiselect: false, 
					caption: "Data rawatjalan2" //Caption List					
				});
				grid.jqGrid('navGrid','#pagerrawatjalan2',{view:true,edit:false,add:false,del:true},{},{},{},{closeOnEscape:true,closeAfterSearch:false,multipleSearch:false, multipleGroup:false, showQuery:false,drag:true,showOnLoad:false,sopt:['cn'],resize:false,caption:'Cari Record', Find:'Cari', Reset:'Batalkan Pencarian'});
				jQuery("#listrawatjalan2")
                                .jqGrid('navButtonAdd','#pagerrawatjalan2',{caption:"Print",
                                onClickButton:function()
                                {   var sidx = grid.jqGrid('getGridParam','sortname');
                                    var sord = grid.jqGrid('getGridParam','sortorder');
                                    var page = grid.jqGrid('getGridParam','page');
                                    var row  = grid.jqGrid('getGridParam','rowNum');
                                    window.location.href="<?php echo base_url() ?>index.php/laporan/rawatjalan2/ekspor?jns="+jns+"&ap="+ap+"&tgl2="+tgl2+"&tgl1="+tgl1+"&tahun="+tahun+"&bulan="+bulan+"&sidx="+sidx+"&page="+page+"&rows="+row+"&sord="+sord;
//alert("BERHASIL ayo SEMANGAT kalahkan skripsi");
				}
				})
                                .jqGrid('navButtonAdd','#pagerrawatjalan2',{caption:"Impor",
                                onClickButton:function()
                                {
                                //alert('impor');
				$("#rawatjalan2impor").load("<?php echo base_url() ?>index.php/laporan/rawatjalan2/impor");
				return false;
                                }
				});
                                

                                
                               
			});
		</script>
<form>
    <table border="0">
        <tr>
            <td width="200">
                Jenis Rawat Jalan :
                <select id="rawatjalan2jenis" onchange="setrawatjalan2jenis();">
                    <option value=''> - </option>
                    <?php
                    for($i=0;$i<count($item);$i++)
                    {?>
		     <option value="<?php echo $item[$i]['idjns_item'];?>">
                     <?php	echo $item[$i]['jenis_item']; ?></option>

		    <?php
		     }
                    ?>
                </select>
            </td>
            
            <td width="300">
                Pilih Bulan :
                <select id="rawatjalan2bulan" onchange="setrawatjalan2bulan();">
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
                <select id="rawatjalan2tahun" onchange="setrawatjalan2tahun();">
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
            
            <td width="200">
                Karyawan :
                <select id="rawatjalan2filter" onchange="setrawatjalan2filter();" >
                    <option value="">Semua</option>
                    <option value="a">Karyawan</option>
                    <option value="p">Pensiunan</option>
                </select>
            </td>
           
            
        </tr>
    </table>
</form>
<div id="rawatjalan2" style="width: auto; height: auto;overflow: auto">
		<table id="listrawatjalan2" class="scroll" cellpadding="0" cellspacing="0"></table>
		<div id="pagerrawatjalan2" class="scroll" style="text-align:center;"></div>
                <div id="rawatjalan2impor"></div>
</div>