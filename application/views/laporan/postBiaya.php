<script type="text/javascript">
    var bulan='';
    var tahun='';
    var jenis='';

    function setlaporanpostBiayabulan()
    {
        //bulan= document.getElementById('laporanpostBiayabulan');
        bulan = $('#laporanpostBiayabulan').val();
        $('#listlaporanpostBiaya').trigger('reloadGrid');
    }

    function setlaporanpostBiayatahun()
    {
        tahun = $('#laporanpostBiayatahun').val();
        $('#listlaporanpostBiaya').trigger('reloadGrid');
    }
                
    function setlaporanpostBiayajenis()
    {
        jenis = $('#laporanpostBiayajenis').val();
        //alert(jenis);
        $('#listlaporanpostBiaya').trigger('reloadGrid');
    }
                
    $(document).ready(function()
    {
        var grid = $("#listlaporanpostBiaya");
	grid.jqGrid({
            url: '<?php echo base_url() ?>index.php/laporan/postBiaya/json', //URL Tujuan Yg Mengenerate data Json nya
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
            colNames: ['No','Id Transaksi','NIP','Diagnosa','Penanggung','Pasien','Dokter','Tgl Transaksi','Tgl Kunjungan','Total Biaya'],
            colModel: [
                {name:'no', key:true, index:'no', hidden:true,editable:false,editrules:{required:true}},//name untuk variabel post yang dikirim saat menambah data
		{name:'id_transaksi',index:'id_transaksi',width:80,editable:true,editrules:{required:true}},
		{name:'nip',index:'nip',width:80,editable:true,editrules:{required:true}},
        {name:'nama_diagnosa',index:'nama_diagnosa',width:100,editable:true,editrules:{required:true}},
		{name:'nama_karyawan',index:'nama_karyawan',width:150,editable:true,editrules:{required:true}},
		{name:'nama_tertanggung',index:'nama_tertanggung',width:150,editable:true,editrules:{required:true}},
		{name:'nama_dokter',index:'nama_dokter',width:150,editable:true,editrules:{required:true}},
		{name:'tgl_transaksi',index:'tgl_transaksi',width:100,editable:true,editrules:{required:true}},
		{name:'tgl_kunjungan',index:'tgl_kunjungan',width:100,editable:true,editrules:{required:true}},
		{name:'biaya_satuan',index:'biaya_satuan',width:150,editable:true,editrules:{required:true},summaryType:'sum',align:'right',formatter:'currency',formatoptions: {thousandsSeparator:','}}
            ],
            rownumbers:true,
            rowNum: 10,
            rowList: [10,20,30],
            pager: '#pagerlaporanpostBiaya',
            sortname: 'tgl_transaksi',
            viewrecords: true,
            sortorder: "desc",
            //editurl: '<?php echo base_url() ?>index.php/laporan/postBiaya/crud', //URL Proses CRUD Nya
            multiselect: false, 
            caption: "Data laporan postBiaya" //Caption List					
	});
	grid.jqGrid('navGrid','#pagerlaporanpostBiaya',{view:true,edit:false,add:false,del:false},{},{},{},{closeOnEscape:true,closeAfterSearch:false,multipleSearch:false, multipleGroup:false, showQuery:false,drag:true,showOnLoad:false,sopt:['cn'],resize:false,caption:'Cari Record', Find:'Cari', Reset:'Batalkan Pencarian'});
	jQuery("#listlaporanpostBiaya").jqGrid('navButtonAdd','#pagerlaporanpostBiaya',{caption:"Print",
            onClickButton:function()
            {   
                var sidx = grid.jqGrid('getGridParam','sortname');
                var sord = grid.jqGrid('getGridParam','sortorder');
                var page = grid.jqGrid('getGridParam','page');
                var row  = grid.jqGrid('getGridParam','rowNum');
                                    
                window.location.href="<?php echo base_url() ?>index.php/laporan/postBiaya/ekspor?tahun="+tahun+"&bulan="+bulan+"&jenis="+jenis+"&sidx="+sidx+"&page="+page+"&rows="+row+"&sord="+sord;

                //alert("BERHASIL ayo SEMANGAT kalahkan skripsi");
            }
	});                                                                
                               
    });
</script>
<form>
    <table border="0">
        <tr>
            <td>
                <b>Jenis Diagnosa: </b>
                <select id="laporanpostBiayajenis" onchange="setlaporanpostBiayajenis();">
                    <option value="" selected>Semua</option>
                    <option value="degeneratif">Degeneratif</option>
                    <option value="non degeneratif">Non Degeneratif</option>
                    <option value="kecelakaan">Kecelakaan</option>
                    <option value="tidak sakit">Tidak Sakit</option>
                </select>
            </td>
            <td>
                <b>Pilih Bulan :</b>
                <select id="laporanpostBiayabulan" onchange="setlaporanpostBiayabulan();">
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
                <input type="text" id="laporanpostBiayatahun" onchange="setlaporanpostBiayatahun();"/>
            </td> 
            <td>
                <input type="text" hidden="true" id="laporanpostBiayatahun2"/>
            </td>
        </tr>
    </table>
</form>
<div id="laporanpostBiaya" style="width: auto; height: auto;overflow: auto">
		<table id="listlaporanpostBiaya" class="scroll" cellpadding="0" cellspacing="0"></table>
		<div id="pagerlaporanpostBiaya" class="scroll" style="text-align:center;"></div>
                <div id="laporanpostBiayaimpor"></div>
</div>