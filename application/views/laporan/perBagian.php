		<script type="text/javascript">
                    var bulan='';
                    var tahun='';

                function setlaporanperBagianbulan()
                {
                    //bulan= document.getElementById('laporanperBagianbulan');
                    bulan = $('#laporanperBagianbulan').val();
                    $('#listlaporanperBagian').trigger('reloadGrid');
                }

                function setlaporanperBagiantahun()
                {
                     tahun = $('#laporanperBagiantahun').val();
                $('#listlaporanperBagian').trigger('reloadGrid');
                }

                

                

		$(document).ready(function()
			{
				var grid = $("#listlaporanperBagian");
				grid.jqGrid({
					url: '<?php echo base_url() ?>index.php/laporan/perBagian/json', //URL Tujuan Yg Mengenerate data Json nya
					datatype: "json", //Datatype yg di gunakan
                                        height: "auto", //Mengset Tinggi table jadi Auto menyesuaikan dengan isi table
					mtype: "GET",
                                        postData:{bulan : function()
                                        {
                                          return bulan;
                                        },tahun : function()
                                        {
                                         return tahun;
                                        }

                                        },
					colNames: ['Id Bagian','Nama Bagian','Sebelum Koreksi','Pengurangan','Sesudah Koreksi'],
					colModel: [
						{name:'id_bagian', key:true, index:'id_bagian', hidden:true,editable:false,editrules:{required:true}},//name untuk variabel post yang dikirim saat menambah data
						{name:'nama_bagian',index:'nama_bagian',width:320,editable:true,editrules:{required:true}},//index untuk variabel yang digunakan saat pencarian
						{name:'biaya',index:'biaya',width:150,editable:true,editrules:{required:true},summaryType:'sum',align:'right',formatter:'currency',formatoptions: {thousandsSeparator:','}},
                                                {name:'pengurangan',index:'pengurangan',width:150,editable:true,editrules:{required:true},summaryType:'sum',align:'right',formatter:'currency',formatoptions: {thousandsSeparator:','}},
                                                {name:'koreksi',index:'koreksi',width:150,editable:true,editrules:{required:true},summaryType:'sum',align:'right',formatter:'currency',formatoptions: {thousandsSeparator:','}}
					],
					rownumbers:true,
					rowNum: 10,
					rowList: [10,20,30],
					pager: '#pagerlaporanperBagian',
					sortname: 'id_bagian',
					viewrecords: true,
					sortorder: "asc",
					editurl: '<?php echo base_url() ?>index.php/laporan/perBagian/crud', //URL Proses CRUD Nya
					multiselect: false, 
					caption: "Data laporan perBagian" //Caption List					
				});
				grid.jqGrid('navGrid','#pagerlaporanperBagian',{view:true,edit:false,add:false,del:false},{},{},{},{closeOnEscape:true,closeAfterSearch:false,multipleSearch:false, multipleGroup:false, showQuery:false,drag:true,showOnLoad:false,sopt:['cn'],resize:false,caption:'Cari Record', Find:'Cari', Reset:'Batalkan Pencarian'});
				jQuery("#listlaporanperBagian")
                                .jqGrid('navButtonAdd','#pagerlaporanperBagian',{caption:"Print",
                                onClickButton:function()
                                {   var sidx = grid.jqGrid('getGridParam','sortname');
                                    var sord = grid.jqGrid('getGridParam','sortorder');
                                    var page = grid.jqGrid('getGridParam','page');
                                    var row  = grid.jqGrid('getGridParam','rowNum');
                                    
                                    window.location.href="<?php echo base_url() ?>index.php/laporan/perBagian/ekspor?tahun="+tahun+"&bulan="+bulan+"&sidx="+sidx+"&page="+page+"&rows="+row+"&sord="+sord;

                                    //alert("BERHASIL ayo SEMANGAT kalahkan skripsi");
				}
				});                                                                
                               
			});
		</script>
<form>
    <table border="0">
        <tr>
            <td>
                <b>Pilih Bulan :</b>
                <select id="laporanperBagianbulan" onchange="setlaporanperBagianbulan();">
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
            <td>
                <b> Tahun :</b>
                <input type="text" id="laporanperBagiantahun" onchange="setlaporanperBagiantahun();"/>
            </td> 
            <td>
                <input type="text" hidden="true" id="laporanperBagiantahun2"/>
            </td>
        </tr>
    </table>
</form>
<div id="laporanperBagian" style="width: auto; height: auto;overflow: auto">
		<table id="listlaporanperBagian" class="scroll" cellpadding="0" cellspacing="0"></table>
		<div id="pagerlaporanperBagian" class="scroll" style="text-align:center;"></div>
                <div id="laporanperBagianimpor"></div>
</div>