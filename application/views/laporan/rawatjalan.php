		<script type="text/javascript">
                    var bulan='';
                    var tahun='';
                    var tgl1='';
                    var tgl2='';
                    var penanggung='';
                    var ap='';
                    var jns='';
                    var res='';
                    var jenis='';

                

               

                function setrawatjalanbulan()
                {
                    //bulan= document.getElementById('rawatjalanbulan');
                    bulan = $('#rawatjalanbulan').val();
                    $('#listrawatjalan').trigger('reloadGrid');
                }

                function setrawatjalantahun()
                {
                     alert("Semangat");
                     tahun = $('#rawatjalantahun').val();
                     $('#listrawatjalan').trigger('reloadGrid');
                }
                function setrawatjalanfilter()
                {
                     ap = $('#rawatjalanfilter').val();
                     $('#listrawatjalan').trigger('reloadGrid');
                }
                function setrawatjalanjns()
                {
                     jns = $('#rawatjalanjenis').val();
                     if(jns=='')
                     {
                         res='';
                         jenis='';
                     }
                     if(jns==1)
                     {
                         res='t';
                         jenis='';
                     }
                     if(jns==2)
                     {
                         res='y';
                         jenis=''
                     }
                     if(jns==3)
                     {
                         jenis='dak';
                         res='';
                     }
                     if(jns==4)
                     {
                         jenis='dokter';
                         res='';
                     }
                     
                     $('#listrawatjalan').trigger('reloadGrid');
                }

                
                

                

		$(document).ready(function()
			{
				var grid = $("#listrawatjalan");
				grid.jqGrid({
					url: '<?php echo base_url() ?>index.php/laporan/rawatjalan/json', //URL Tujuan Yg Mengenerate data Json nya
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
                                        },res : function()
                                        {

                                         return res;
                                        },jenis : function()
                                        {

                                         return jenis;
                                        }

                                        },
					colNames: ['Id Transaksi','Tgl Kunjungan','NIP','Penanggung','A/P','Pasien','Status','Restitusi','Dokter','Total'],
					colModel: [
						{name:'id_provider', key:true, index:'id_transaksi', hidden:true,editable:false,editrules:{required:true}},//name untuk variabel post yang dikirim saat menambah data
						{name:'nama_provider',index:'tgl_kunjungan',width:120,editable:true,editrules:{required:true}},//index untuk variabel yang digunakan saat pencarian
						{name:'almt_provider',index:'nip',width:150,editable:true,editrules:{required:true}},
						{name:'langg_provider',index:'nama_karyawan', width:90, editable: true,edittype:"checkbox",editoptions: {value:"y:n"}},
						{name:'fax_provider',index:'ap',width:150,align:'center',editable:true,editrules:{required:true}},
                                                {name:'tlp_provider',index:'nama_tertanggung',width:150,align:'center',editable:true,editrules:{required:true}},
                                                {name:'tlp_provider',index:'status',width:150,align:'center',editable:true,editrules:{required:true}},
                                                {name:'tlp_provider',index:'restitusi',width:150,align:'center',editable:true,editrules:{required:true}},
                                                {name:'tlp_provider',index:'nama_dokter',width:150,align:'center',editable:true,editrules:{required:true}},
                                                {name:'tlp_provider',index:'total_harga',width:150,align:'center',editable:true,editrules:{required:true}}
					],
					rownumbers:true,
					rowNum: 10,
					rowList: [10,20,30],
					pager: '#pagerrawatjalan',
					sortname: 'id_transaksi',
					viewrecords: true,
					sortorder: "desc",
					editurl: '<?php echo base_url() ?>index.php/laporan/rawatjalan/crud', //URL Proses CRUD Nya
					multiselect: false, 
					caption: "Data rawatjalan" //Caption List					
				});
				grid.jqGrid('navGrid','#pagerrawatjalan',{view:true,edit:false,add:false,del:true},{},{},{},{closeOnEscape:true,closeAfterSearch:false,multipleSearch:false, multipleGroup:false, showQuery:false,drag:true,showOnLoad:false,sopt:['cn'],resize:false,caption:'Cari Record', Find:'Cari', Reset:'Batalkan Pencarian'});
				jQuery("#listrawatjalan")
                                .jqGrid('navButtonAdd','#pagerrawatjalan',{caption:"Print",
                                onClickButton:function()
                                {
                                    var sidx = grid.jqGrid('getGridParam','sortname');
                                    var sord = grid.jqGrid('getGridParam','sortorder');
                                    var page = grid.jqGrid('getGridParam','page');
                                    var row  = grid.jqGrid('getGridParam','rowNum');
                                    window.location.href="<?php echo base_url() ?>index.php/laporan/rawatjalan/ekspor?res="+res+"&ap="+ap+"&penanggung="+penanggung+"&tgl2="+tgl2+"&tgl1="+tgl1+"&tahun="+tahun+"&bulan="+bulan+"&sidx="+sidx+"&page="+page+"&rows="+row+"&sord="+sord;
                                    //alert("BERHASIL ayo SEMANGAT kalahkan skripsi");
				}
				})
                                .jqGrid('navButtonAdd','#pagerrawatjalan',{caption:"Impor",
                                onClickButton:function()
                                {
                                //alert('impor');
				$("#rawatjalanimpor").load("<?php echo base_url() ?>index.php/laporan/rawatjalan/impor");
				return false;
                                }
				});
                                

                                
                               
			});
		</script>
<form>
    <table border="0">
        <tr>
            <td>
             Jenis Rawat Jalan:
             <select id="rawatjalanjenis" onchange="setrawatjalanjns();">
                 <option value=""> - </option>
                 <option value="">Rekap</option>
                 <option value="1">Langganan</option>
                 <option value="2">Restitusi</option>
                 <option value="3">DAK</option>
                 <option value="4">Dokter</option>
             </select>
            </td>
            
            <td width="300">
                Pilih Bulan :
                <select id="rawatjalanbulan" onchange="setrawatjalanbulan();">
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
                <select id="rawatjalantahun" onchange="setrawatjalantahun();">
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
                <select id="rawatjalanfilter" onchange="setrawatjalanfilter();" >
                    <option value="">Semua</option>
                    <option value="a">Karyawan</option>
                    <option value="p">Pensiunan</option>
                </select>
            </td>
           
            
        </tr>
    </table>
</form>
<div id="rawatjalan" style="width: auto; height: auto;overflow: auto">
		<table id="listrawatjalan" class="scroll" cellpadding="0" cellspacing="0"></table>
		<div id="pagerrawatjalan" class="scroll" style="text-align:center;"></div>
                <div id="rawatjalanimpor"></div>
</div>