		<script type="text/javascript">
                    var bulan='';
                    var tahun='';
                    var tgl1='';
                    var tgl2='';
                    var penanggung='';
                    var ap='';
                    var jns='';
                    var pegawai = '';

                

               

                function setrekammedisbulan()
                {
                    //bulan= document.getElementById('rekammedisbulan');
                    bulan = $('#rekammedisbulan').val();
                    $('#listrekammedis').trigger('reloadGrid');
                }

                function setrekammedistahun()
                {
                     alert("Semangat");
                     tahun = $('#rekammedistahun').val();
                     $('#listrekammedis').trigger('reloadGrid');
                }
                function setrekammedisfilter()
                {
                     ap = $('#rekammedisfilter').val();
                     $('#listrekammedis').trigger('reloadGrid');
                }
               
                function setrekammedispegawai()
                {
                    pegawai = $('#rekammedispegawai').val();
                     $('#listrekammedis').trigger('reloadGrid');
                }
                
                

                

		$(document).ready(function()
			{
				var grid = $("#listrekammedis");
				grid.jqGrid({
					url: '<?php echo base_url() ?>index.php/laporan/rekammedis/json', //URL Tujuan Yg Mengenerate data Json nya
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
                                        },pegawai : function()
                                        {

                                         return pegawai;
                                        }

                                        },
					colNames: ['id_transaksi','NIP','Penanggung','Pasien','Status','Tgl Kunj','Tgl Keluar','Tgl Trans','Diagnosa','Dokter','Obat','Jumlah','Dosis','Harga','Total','jenis'],
					colModel: [
						{name:'rekammedisid_transaksi', key:true, index:'id_transaksi', hidden:true,editable:false,editrules:{required:true}},//name untuk variabel post yang dikirim saat menambah data
						{name:'rekammedisnip',index:'nip',width:120,editable:true,editrules:{required:true}},//index untuk variabel yang digunakan saat pencarian
						{name:'rekammedisnama_karyawan',index:'nama_karyawan',width:120,editable:true,editrules:{required:true}},//index untuk variabel yang digunakan saat pencarian
						{name:'rekammedisnama_tertanggung',index:'nama_tertanggung',width:120,editable:true,editrules:{required:true}},//index untuk variabel yang digunakan saat pencarian
						{name:'rekammedisstatus',index:'status',width:150,editable:true,editrules:{required:true}},
						{name:'rekammedistgl_kunjungan',index:'tgl_kunjungan', width:90, editable: true,edittype:"checkbox",editoptions: {value:"y:n"}},
						{name:'rekammedistgl_keluar',index:'tgl_keluar',width:150,align:'center',editable:true,editrules:{required:true}},
                                                {name:'rekammedistgl_transaksi',index:'tgl_transaksi',width:150,align:'center',editable:true,editrules:{required:true}},
                                                {name:'rekammedisnama_diagnosa',index:'nama_diagnosa',width:150,align:'center',editable:true,editrules:{required:true}},
                                                {name:'rekammedisnama_dokter',index:'nama_dokter',width:150,align:'center',editable:true,editrules:{required:true}},
                                                {name:'rekammedisnama_obat',index:'nama_obat',width:150,align:'center',editable:true,editrules:{required:true}},
                                                {name:'rekammedisjumlah',index:'jumlah',width:150,align:'center',editable:true,editrules:{required:true}},
                                                {name:'rekammedisdosis',index:'dosis',width:150,align:'center',editable:true,editrules:{required:true}},
                                                {name:'rekammedisharga',index:'harga',width:150,align:'center',editable:true,editrules:{required:true}},
                                                {name:'rekammedistotal_harga',index:'total_harga',width:150,align:'center',editable:true,editrules:{required:true}},
                                                {name:'rekammedisjenis_transaksi',index:'jenis_transaksi',width:150,align:'center',editable:true,editrules:{required:true}}
					],
					rownumbers:true,
					rowNum: 10,
					rowList: [10,20,30],
					pager: '#pagerrekammedis',
					sortname: 'id_transaksi',
					viewrecords: true,
					sortorder: "desc",
					editurl: '<?php echo base_url() ?>index.php/laporan/rekammedis/crud', //URL Proses CRUD Nya
					multiselect: false,
                                        grouping:true,
                                        groupingView : {
                                            groupField : ['rekammedisjenis_transaksi'],
                                            groupColumnShow : [false],
                                            groupText : ['<b>{0} - {1} Item(s)</b>'] },
					caption: "Data rekammedis" //Caption List					
				});
				grid.jqGrid('navGrid','#pagerrekammedis',{view:true,edit:false,add:false,del:true},{},{},{},{closeOnEscape:true,closeAfterSearch:false,multipleSearch:false, multipleGroup:false, showQuery:false,drag:true,showOnLoad:false,sopt:['cn'],resize:false,caption:'Cari Record', Find:'Cari', Reset:'Batalkan Pencarian'});
				jQuery("#listrekammedis")
                                .jqGrid('navButtonAdd','#pagerrekammedis',{caption:"Print",
                                onClickButton:function()
                                {   var sidx = grid.jqGrid('getGridParam','sortname');
                                    var sord = grid.jqGrid('getGridParam','sortorder');
                                    var page = grid.jqGrid('getGridParam','page');
                                    var row  = grid.jqGrid('getGridParam','rowNum');
                                    window.location.href="<?php echo base_url() ?>index.php/laporan/rekammedis/ekspor?jns="+jns+"&ap="+ap+"&penanggung="+penanggung+"&tgl2="+tgl2+"&tgl1="+tgl1+"&tahun="+tahun+"&bulan="+bulan+"&sidx="+sidx+"&page="+page+"&rows="+row+"&sord="+sord;
                                //alert("BERHASIL ayo SEMANGAT kalahkan skripsi");
				}
				})
                                .jqGrid('navButtonAdd','#pagerrekammedis',{caption:"Impor",
                                onClickButton:function()
                                {
                                //alert('impor');
				$("#rekammedisimpor").load("<?php echo base_url() ?>index.php/laporan/rekammedis/impor");
				return false;
                                }
				});
                                

                                
                               
			});
		</script>

    <table border="0">
        <tr>
            
            <td width="300">
                Pilih Bulan :
                <select id="rekammedisbulan" onchange="setrekammedisbulan();">
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
                <select id="rekammedistahun" onchange="setrekammedistahun();">
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
            <td>
             Nama Pegawai :
             <input type="text" id="rekammedispegawai" onchange="setrekammedispegawai();"/>
            </td>

            <td width="200">
                Karyawan :
                <select id="rekammedisfilter" onchange="setrekammedisfilter();" >
                    <option value="">Semua</option>
                    <option value="a">Karyawan</option>
                    <option value="p">Pensiunan</option>
                </select>
            </td>
           
            
        </tr>
    </table>

<div id="rekammedis" style="width: auto; height: auto;overflow: auto">
		<table id="listrekammedis" class="scroll" cellpadding="0" cellspacing="0"></table>
		<div id="pagerrekammedis" class="scroll" style="text-align:center;"></div>
                <div id="rekammedisimpor"></div>
</div>