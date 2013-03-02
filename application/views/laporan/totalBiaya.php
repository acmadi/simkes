<script type="text/javascript">
    var bulan='';
    var tahun='';
    var jenis='';

    function setlaporantotalBiayabulan()
    {
        //bulan= document.getElementById('laporantotalBiayabulan');
        bulan = $('#laporantotalBiayabulan').val();
        $('#listlaporantotalBiaya').trigger('reloadGrid');
    }

    function setlaporantotalBiayatahun()
    {
        tahun = $('#laporantotalBiayatahun').val();
        $('#listlaporantotalBiaya').trigger('reloadGrid');
    }
                
    function setlaporantotalBiayajenis()
    {
        jenis = $('#laporantotalBiayajenis').val();
        //alert(jenis);
        $('#listlaporantotalBiaya').trigger('reloadGrid');
    }
                
    $(document).ready(function()
    {
        var grid = $("#listlaporantotalBiaya");
	grid.jqGrid({
            url: '<?php echo base_url() ?>index.php/laporan/totalBiaya/json', //URL Tujuan Yg Mengenerate data Json nya
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
            colNames: ['Id Bagian','NIP','Penanggung','Status','Sebelum Koreksi','Sesudah Koreksi'],
            colModel: [
                {name:'id_bagian', key:true, index:'id_bagian', hidden:true,editable:false,editrules:{required:true}},//name untuk variabel post yang dikirim saat menambah data
		{name:'nip',index:'nip',width:100,editable:true,align:'center',editrules:{required:true}},//index untuk variabel yang digunakan saat pencarian
                {name:'nama_karyawan',index:'nama_karyawan',width:250,editable:true,editrules:{required:true}},
                {name:'ap',index:'ap',width:70,editable:true,align:'center',editrules:{required:true}},
		{name:'total_biaya',index:'total_biaya',width:100,editable:true,editrules:{required:true},summaryType:'sum',align:'right',formatter:'currency',formatoptions: {thousandsSeparator:','}},
                {name:'koreksi_biaya',index:'koreksi_biaya',width:100,editable:true,editrules:{required:true},summaryType:'sum',align:'right',formatter:'currency',formatoptions: {thousandsSeparator:','}}
            ],
            rownumbers:true,
            rowNum: 10,
            rowList: [10,20,30],
            pager: '#pagerlaporantotalBiaya',
            sortname: 'nip',
            viewrecords: true,
            sortorder: "asc",
            editurl: '<?php echo base_url() ?>index.php/laporan/totalBiaya/crud', //URL Proses CRUD Nya
            multiselect: false, 
            caption: "Data laporan totalBiaya" //Caption List					
	});
	grid.jqGrid('navGrid','#pagerlaporantotalBiaya',{view:true,edit:false,add:false,del:false},{},{},{},{closeOnEscape:true,closeAfterSearch:false,multipleSearch:false, multipleGroup:false, showQuery:false,drag:true,showOnLoad:false,sopt:['cn'],resize:false,caption:'Cari Record', Find:'Cari', Reset:'Batalkan Pencarian'});
	jQuery("#listlaporantotalBiaya").jqGrid('navButtonAdd','#pagerlaporantotalBiaya',{caption:"Print",
            onClickButton:function()
            {   
                var sidx = grid.jqGrid('getGridParam','sortname');
                var sord = grid.jqGrid('getGridParam','sortorder');
                var page = grid.jqGrid('getGridParam','page');
                var row  = grid.jqGrid('getGridParam','rowNum');
                                    
                window.location.href="<?php echo base_url() ?>index.php/laporan/totalBiaya/ekspor?tahun="+tahun+"&bulan="+bulan+"&jenis="+jenis+"&sidx="+sidx+"&page="+page+"&rows="+row+"&sord="+sord;

                //alert("BERHASIL ayo SEMANGAT kalahkan skripsi");
            }
	});                                                                
                               
    });
</script>
<form>
    <table border="0">
        <tr>
            <td>
                <b>Jenis Laporan : </b>
                <select id="laporantotalBiayajenis" onchange="setlaporantotalBiayajenis();">
                    <option value="" selected>Total Biaya</option>
                    <option value="y">Restitusi</option>
                    <option value="t">Langganan</option>
                </select>
            </td>
            <td>
                <b>Pilih Bulan :</b>
                <select id="laporantotalBiayabulan" onchange="setlaporantotalBiayabulan();">
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
                <input type="text" id="laporantotalBiayatahun" onchange="setlaporantotalBiayatahun();"/>
            </td> 
            <td>
                <input type="text" hidden="true" id="laporantotalBiayatahun2"/>
            </td>
        </tr>
    </table>
</form>
<div id="laporantotalBiaya" style="width: auto; height: auto;overflow: auto">
		<table id="listlaporantotalBiaya" class="scroll" cellpadding="0" cellspacing="0"></table>
		<div id="pagerlaporantotalBiaya" class="scroll" style="text-align:center;"></div>
                <div id="laporantotalBiayaimpor"></div>
</div>