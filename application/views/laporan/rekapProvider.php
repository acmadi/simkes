<script type="text/javascript">
    var bulan='';
    var tahun='';
    var jenis='';

    function setlaporanrekapProviderbulan()
    {
        //bulan= document.getElementById('laporanrekapProviderbulan');
        bulan = $('#laporanrekapProviderbulan').val();
        $('#listlaporanrekapProvider').trigger('reloadGrid');
    }

    function setlaporanrekapProvidertahun()
    {
        tahun = $('#laporanrekapProvidertahun').val();
        $('#listlaporanrekapProvider').trigger('reloadGrid');
    }
                
    function setlaporanrekapProviderjenis()
    {
        jenis = $('#laporanrekapProviderjenis').val();
        //alert(jenis);
        $('#listlaporanrekapProvider').trigger('reloadGrid');
    }
                
    $(document).ready(function()
    {
        var grid = $("#listlaporanrekapProvider");
	grid.jqGrid({
            url: '<?php echo base_url() ?>index.php/laporan/rekapProvider/json', //URL Tujuan Yg Mengenerate data Json nya
            datatype: "json", //Datatype yg di gunakan
            height: "auto", //Mengset Tinggi table jadi Auto menyesuaikan dengan isi table
            mtype: "GET",
            postData:{bulan : function()
                {
                    return bulan;
                },tahun : function()
                {
                    return tahun;
                },jenis : function()
                {
                    return jenis;
                }
            },
            colNames: ['Id Bagian','Nama Provider','Sebelum Koreksi','Sesudah Koreksi'],
            colModel: [
                {name:'idjenis_provider', key:true, index:'idjenis_provider', hidden:true,editable:false,editrules:{required:true}},//name untuk variabel post yang dikirim saat menambah data
		{name:'nama_provider',index:'nama_provider',width:350,editable:true,editrules:{required:true}},
                {name:'total_biaya',index:'total_biaya',width:150,editable:true,editrules:{required:true},summaryType:'sum',align:'right',formatter:'currency',formatoptions: {thousandsSeparator:','}},
                {name:'koreksi_biaya',index:'koreksi_biaya',width:150,editable:true,editrules:{required:true},summaryType:'sum',align:'right',formatter:'currency',formatoptions: {thousandsSeparator:','}}
            ],
            rownumbers:true,
            rowNum: 10,
            rowList: [10,20,30],
            pager: '#pagerlaporanrekapProvider',
            sortname: 'idjenis_provider',
            viewrecords: true,
            sortorder: "asc",
            editurl: '<?php echo base_url() ?>index.php/laporan/rekapProvider/crud', //URL Proses CRUD Nya
            multiselect: false, 
            caption: "Data laporan rekapProvider" //Caption List					
	});
	grid.jqGrid('navGrid','#pagerlaporanrekapProvider',{view:true,edit:false,add:false,del:false},{},{},{},{closeOnEscape:true,closeAfterSearch:false,multipleSearch:false, multipleGroup:false, showQuery:false,drag:true,showOnLoad:false,sopt:['cn'],resize:false,caption:'Cari Record', Find:'Cari', Reset:'Batalkan Pencarian'});
	jQuery("#listlaporanrekapProvider").jqGrid('navButtonAdd','#pagerlaporanrekapProvider',{caption:"Print",
            onClickButton:function()
            {   
                var sidx = grid.jqGrid('getGridParam','sortname');
                var sord = grid.jqGrid('getGridParam','sortorder');
                var page = grid.jqGrid('getGridParam','page');
                var row  = grid.jqGrid('getGridParam','rowNum');
                                    
                window.location.href="<?php echo base_url() ?>index.php/laporan/rekapProvider/ekspor?tahun="+tahun+"&bulan="+bulan+"&jenis="+jenis+"&sidx="+sidx+"&page="+page+"&rows="+row+"&sord="+sord;

                //alert("BERHASIL ayo SEMANGAT kalahkan skripsi");
            }
	});                                                                
                               
    });
</script>
<form>
    <table border="0">
        <tr>
            <td>
                <b>Jenis Provider : </b>
                <select id="laporanrekapProviderjenis" onchange="setlaporanrekapProviderjenis();">
                    <option value="" selected>Semua</option>
                    <option value="apotek">Apotek</option>
                    <option value="laboratorium">Laboratorium</option>
                    <option value="rumah sakit">Rumah Sakit</option>
                    <option value="dokter">Dokter</option>
                    <option value="lab gigi">Lab. Gigi</option>
                </select>
            </td>
            <td>
                <b>Pilih Bulan :</b>
                <select id="laporanrekapProviderbulan" onchange="setlaporanrekapProviderbulan();">
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
                <input type="text" id="laporanrekapProvidertahun" onchange="setlaporanrekapProvidertahun();"/>
            </td> 
            <td>
                <input type="text" hidden="true" id="laporanrekapProvidertahun2"/>
            </td>
        </tr>
    </table>
</form>
<div id="laporanrekapProvider" style="width: auto; height: auto;overflow: auto">
		<table id="listlaporanrekapProvider" class="scroll" cellpadding="0" cellspacing="0"></table>
		<div id="pagerlaporanrekapProvider" class="scroll" style="text-align:center;"></div>
                <div id="laporanrekapProviderimpor"></div>
</div>