		<script type="text/javascript">
                    var bulan='';
                    var tahun='';
                    var diagnosa='';

                function setlaporandiagnosadiagnosa()
                {
                    //bulan= document.getElementById('laporandiagnosabulan');
                    diagnosa = $('#laporandiagnosadiagnosa').val();
                    $('#listlaporandiagnosa').trigger('reloadGrid');
                }
                

                

                function setlaporandiagnosabulan()
                {
                    //bulan= document.getElementById('laporandiagnosabulan');
                    bulan = $('#laporandiagnosabulan').val();
                    $('#listlaporandiagnosa').trigger('reloadGrid');
                }

                function setlaporandiagnosatahun()
                {
                     tahun = $('#laporandiagnosatahun').val();
                $('#listlaporandiagnosa').trigger('reloadGrid');
                }

                

                

		$(document).ready(function()
			{
				var grid = $("#listlaporandiagnosa");
				grid.jqGrid({
					url: '<?php echo base_url() ?>index.php/laporan/diagnosa/json', //URL Tujuan Yg Mengenerate data Json nya
					datatype: "json", //Datatype yg di gunakan
                                        height: "auto", //Mengset Tinggi table jadi Auto menyesuaikan dengan isi table
					mtype: "GET",
                                        postData:{bulan : function()
                                        {
                                         
                                         return bulan;
                                        },tahun : function()
                                        {
                                         
                                         return tahun;
                                        },diagnosa:function()
                                        {
                                         return diagnosa;
                                        }

                                        },
					colNames: ['Id Transaksi','Diagnosa','NIP','Penanggung','Status','Pasien'],
					colModel: [
						{name:'laporanid_transaksi', key:true, index:'id_transaksi', hidden:true,editable:false,editrules:{required:true}},//name untuk variabel post yang dikirim saat menambah data
						{name:'laporannama_diagnosa',index:'nama_diagnosa',width:120,editable:true,editrules:{required:true}},//index untuk variabel yang digunakan saat pencarian
						{name:'laporannip',index:'nip',width:150,editable:true,editrules:{required:true}},
						{name:'laporannama_karyawan',index:'nama_karyawan', width:90, editable: true,edittype:"checkbox",editoptions: {value:"y:n"}},
						{name:'laporanstatus',index:'status',width:150,align:'center',editable:true,editrules:{required:true}},
                                                {name:'laporannama_tertanggung',index:'nama_tertanggung',width:150,align:'center',editable:true,editrules:{required:true}}
					],
					rownumbers:true,
					rowNum: 10,
					rowList: [10,20,30],
					pager: '#pagerlaporandiagnosa',
					sortname: 'id_transaksi',
					viewrecords: true,
					sortorder: "desc",
					editurl: '<?php echo base_url() ?>index.php/laporan/diagnosa/crud', //URL Proses CRUD Nya
					multiselect: false,
                                        grouping :true,
                                        groupingView : {
                                                     groupField : ['laporannama_diagnosa'],
                                                     groupText : ['<b>{0} - {1} Orang</b>']
                                        },
					caption: "Data laporandiagnosa" //Caption List					
				});
				grid.jqGrid('navGrid','#pagerlaporandiagnosa',{view:true,edit:false,add:false,del:true},{},{},{},{closeOnEscape:true,closeAfterSearch:false,multipleSearch:false, multipleGroup:false, showQuery:false,drag:true,showOnLoad:false,sopt:['cn'],resize:false,caption:'Cari Record', Find:'Cari', Reset:'Batalkan Pencarian'});
				jQuery("#listlaporandiagnosa")
                                .jqGrid('navButtonAdd','#pagerlaporandiagnosa',{caption:"Print",
                                onClickButton:function()
                                {   var sidx = grid.jqGrid('getGridParam','sortname');
                                    var sord = grid.jqGrid('getGridParam','sortorder');
                                    var page = grid.jqGrid('getGridParam','page');
                                    var row  = grid.jqGrid('getGridParam','rowNum');
                                    window.location.href="<?php echo base_url() ?>index.php/laporan/diagnosa/ekspor?diagnosa="+diagnosa+"&tahun="+tahun+"&bulan="+bulan+"&sidx="+sidx+"&page="+page+"&rows="+row+"&sord="+sord;

                                    //alert("BERHASIL ayo SEMANGAT kalahkan skripsi");
				}
				})
                                .jqGrid('navButtonAdd','#pagerlaporandiagnosa',{caption:"Impor",
                                onClickButton:function()
                                {
                                //alert('impor');
				$("#laporandiagnosaimpor").load("<?php echo base_url() ?>index.php/hasil/laporandiagnosa/impor");
				return false;
                                }
				});
                                

                                
                               
			});
		</script>
<form>
    <table border="0">
        <tr>
            
            <td width="200">
                Pilih Bulan :
                <select id="laporandiagnosabulan" onchange="setlaporandiagnosabulan();">
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
                <select id="laporandiagnosatahun" onchange="setlaporandiagnosatahun();">
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
                Diagnosa :
                <input type="text" id="laporandiagnosadiagnosa" onchange="setlaporandiagnosadiagnosa();"/>
            </td>
            
            
        </tr>
    </table>
</form>
<div id="laporandiagnosa" style="width: auto; height: auto;overflow: auto">
		<table id="listlaporandiagnosa" class="scroll" cellpadding="0" cellspacing="0"></table>
		<div id="pagerlaporandiagnosa" class="scroll" style="text-align:center;"></div>
                <div id="laporandiagnosaimpor"></div>
</div>