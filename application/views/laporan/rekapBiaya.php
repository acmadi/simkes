<script type="text/javascript">
    var bulan='';
    var tahun='';

    function setlaporanrekapBiayabulan()
    {
        bulan = $('#laporanrekapBiayabulan').val();
        $('#listlaporanrekapBiaya').trigger('reloadGrid');
    }

    function setlaporanrekapBiayatahun()
    {
        tahun = $('#laporanrekapBiayatahun').val();
        $('#listlaporanrekapBiaya').trigger('reloadGrid');
    }
                    
    $(document).ready(function()
    {
        var grid = $("#listlaporanrekapBiaya");
	grid.jqGrid({
            url: '<?php echo base_url() ?>index.php/laporan/rekapBiaya/json', //URL Tujuan Yg Mengenerate data Json nya
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
            colNames: ['No','Pos Pengeluaran','Jumlah Pegawai','Biaya Pegawai','Biaya Pegawai(K)','Jumlah Pensiunan','Biaya Pensiunan','Biaya Pensiunan(K)','Jumlah Biaya'],
            colModel: [
                {name:'idjenis', key:true, index:'idjenis', hidden:true,editable:false,editrules:{required:true}},//name untuk variabel post yang dikirim saat menambah data
		{name:'jenis',index:'jenis',width:150,editable:true,editrules:{required:true}},
		{name:'jml_peg',index:'jml_peg',width:100,align:'center',editable:true,editrules:{required:true}},
                {name:'biaya_peg',index:'biaya_peg',width:100,editable:true,editrules:{required:true},summaryType:'sum',align:'right',formatter:'currency',formatoptions: {thousandsSeparator:','}},
                {name:'biaya_peg_k',index:'biaya_peg_k',width:100,editable:true,editrules:{required:true},summaryType:'sum',align:'right',formatter:'currency',formatoptions: {thousandsSeparator:','}},
				{name:'jml_pen',index:'jml_pen',width:100,align:'center',editable:true,editrules:{required:true}},
                {name:'biaya_pen',index:'biaya_pen',width:100,editable:true,editrules:{required:true},summaryType:'sum',align:'right',formatter:'currency',formatoptions: {thousandsSeparator:','}},
                {name:'biaya_pen_k',index:'biaya_pen_k',width:100,editable:true,editrules:{required:true},summaryType:'sum',align:'right',formatter:'currency',formatoptions: {thousandsSeparator:','}},
                {name:'total',index:'total',width:100,editable:true,editrules:{required:true},summaryType:'sum',align:'right',formatter:'currency',formatoptions: {thousandsSeparator:','}}
            ],
            rownumbers:true,
            rowNum: 10,
            rowList: [10,20,30],
            pager: '#pagerlaporanrekapBiaya',
            sortname: 'jenis',
            viewrecords: true,
            sortorder: "asc",
            editurl: '<?php echo base_url() ?>index.php/laporan/rekapBiaya/crud', //URL Proses CRUD Nya
            multiselect: false, 
            caption: "Data laporan rekapBiaya" //Caption List					
	});
	grid.jqGrid('navGrid','#pagerlaporanrekapBiaya',{view:true,edit:false,add:false,del:false},{},{},{},{closeOnEscape:true,closeAfterSearch:false,multipleSearch:false, multipleGroup:false, showQuery:false,drag:true,showOnLoad:false,sopt:['cn'],resize:false,caption:'Cari Record', Find:'Cari', Reset:'Batalkan Pencarian'});
	jQuery("#listlaporanrekapBiaya").jqGrid('navButtonAdd','#pagerlaporanrekapBiaya',{caption:"Print",
            onClickButton:function()
            {   
                var sidx = grid.jqGrid('getGridParam','sortname');
                var sord = grid.jqGrid('getGridParam','sortorder');
                var page = grid.jqGrid('getGridParam','page');
                var row  = grid.jqGrid('getGridParam','rowNum');
                                    
                window.location.href="<?php echo base_url() ?>index.php/laporan/rekapBiaya/ekspor?tahun="+tahun+"&bulan="+bulan+"&jenis="+jenis+"&sidx="+sidx+"&page="+page+"&rows="+row+"&sord="+sord;

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
                <select id="laporanrekapBiayabulan" onchange="setlaporanrekapBiayabulan();">
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
                <input type="text" id="laporanrekapBiayatahun" onchange="setlaporanrekapBiayatahun();"/>
            </td> 
            <td>
                <input type="text" hidden="true" id="laporanrekapBiayatahun2"/>
            </td>
        </tr>
    </table>
</form>
<div id="laporanrekapBiaya" style="width: auto; height: auto;overflow: auto">
		<table id="listlaporanrekapBiaya" class="scroll" cellpadding="0" cellspacing="0"></table>
		<div id="pagerlaporanrekapBiaya" class="scroll" style="text-align:center;"></div>
                <div id="laporanrekapBiayaimpor"></div>
</div>