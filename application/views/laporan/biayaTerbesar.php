<script type="text/javascript">
    var jenis='',
        karyawan='',
        bulan='',
        tahun='';

    function setbiayaTerbesarBerdasarkan()
    {
        jenis = $('#biayaTerbesar_berdasarkan').val();
        $('#listlaporanbiayaTerbesar').trigger('reloadGrid');
    }
    
    function setlaporanbiayaTerbesarkaryawan()
    {
        karyawan = $('#laporanbiayaTerbesarkaryawan').val();
        $('#listlaporanbiayaTerbesar').trigger('reloadGrid');
    }
                
    function setlaporanbiayaTerbesarbulan()
    {
        bulan = $('#laporanbiayaTerbesarbulan').val();
        $('#listlaporanbiayaTerbesar').trigger('reloadGrid');
    }

    function setlaporanbiayaTerbesartahun()
    {
        tahun = $('#laporanbiayaTerbesartahun').val();
        $('#listlaporanbiayaTerbesar').trigger('reloadGrid');
        return false;
    }        
                
    $(document).ready(function()
    {
        var grid = $("#listlaporanbiayaTerbesar");
	grid.jqGrid({
            url: '<?php echo base_url() ?>index.php/laporan/biayaTerbesar/json', //URL Tujuan Yg Mengenerate data Json nya
            datatype: "json", //Datatype yg di gunakan
            height: "auto", //Mengset Tinggi table jadi Auto menyesuaikan dengan isi table
            mtype: "GET",
            postData:{
                jenis : function()
                {
                    return jenis;
                },
                karyawan : function()
                {
                    return karyawan;
                },
                bulan : function()
                {
                    return bulan;
                },
                tahun : function()
                {
                    return tahun;
                }
            },
            colNames: ['Id Trans','NIP','Penanggung','A/P','Kunj','Biaya','Kunj','Biaya','Kunj','Biaya','Kunj','Biaya','Kunj','Biaya','Kunj','Biaya','Kunj','Biaya','Total'],
            colModel: [
                        {name:'id_transaksi', key:true, index:'id_transaksi', hidden:true,editable:false,editrules:{required:true}},//name untuk variabel post yang dikirim saat menambah data
                        //{name:'id_transaksi', index:'id_transaksi',width:70,editable:true,editrules:{required:true},summaryType:'count', summaryTpl : '({0}) Total'},
			{name:'nip',index:'nip',width:70,editable:true,editrules:{required:true},align:'center'},
			{name:'nama_karyawan',index:'nama_karyawan',width:150,editable:true,editrules:{required:true}},
                        {name:'A/P',index:'A/P',width:30,align:'center',editable:true,editrules:{required:true}},
                        {name:'kunj_apotek',index:'kunj_apotek',width:70,editable:true,editrules:{required:true}, align:'center'},
                        {name:'biaya_apotek',index:'biaya_apotek',width:70,editable:true,editrules:{required:true},summaryType:'sum',align:'right',formatter:'currency',formatoptions: {thousandsSeparator:','}},
                        {name:'kunj_gigi',index:'kunj_gigi',width:70,editable:true,editrules:{required:true}, align:'center'},
                        {name:'biaya_gigi',index:'biaya_gigi',width:70,editable:true,editrules:{required:true},summaryType:'sum',align:'right',formatter:'currency',formatoptions: {thousandsSeparator:','}},
                        {name:'kunj_lab',index:'kunj_lab',width:70,editable:true,editrules:{required:true}, align:'center'},
                        {name:'biaya_lab',index:'biaya_lab',width:70,editable:true,editrules:{required:true},summaryType:'sum',align:'right',formatter:'currency',formatoptions: {thousandsSeparator:','}},
                        {name:'kunj_optik',index:'kunj_optik',width:70,editable:true,editrules:{required:true}, align:'center'},
                        {name:'biaya_optik',index:'biaya_optik',width:70,editable:true,editrules:{required:true},summaryType:'sum',align:'right',formatter:'currency',formatoptions: {thousandsSeparator:','}},
                        {name:'kunj_rs',index:'kunj_rs',width:70,editable:true,editrules:{required:true}, align:'center'},
                        {name:'biaya_rs',index:'biaya_rs',width:70,editable:true,editrules:{required:true},summaryType:'sum',align:'right',formatter:'currency',formatoptions: {thousandsSeparator:','}},
                        {name:'kunj_umum',index:'kunj_umum',width:70,editable:true,editrules:{required:true}, align:'center'},
                        {name:'biaya_umum',index:'biaya_umum',width:70,editable:true,editrules:{required:true},summaryType:'sum',align:'right',formatter:'currency',formatoptions: {thousandsSeparator:','}},
                        {name:'kunj_spesialis',index:'kunj_spesialis',width:70,editable:true,editrules:{required:true}, align:'center'},
                        {name:'biaya_spesialis',index:'biaya_spesialis',width:70,editable:true,editrules:{required:true},summaryType:'sum',align:'right',formatter:'currency',formatoptions: {thousandsSeparator:','}},
                        {name:'total',index:'total',width:70,editable:true,editrules:{required:true},summaryType:'sum',align:'right',formatter:'currency',formatoptions: {thousandsSeparator:','}}
            ],          
            rownumbers:true,
            rowNum: 10,
            rowList: [10,20,30],
            pager: '#pagerlaporanbiayaTerbesar',
            sortname: 'a.nip',
            viewrecords: true,
            sortorder: "desc",
            editurl: '<?php echo base_url() ?>index.php/laporan/biayaTerbesar/crud', //URL Proses CRUD Nya
            multiselect: false, 
            //sortname: 'nama_dokter', 
            //grouping:true, 
            /*
            groupingView : { 
                groupField : ['nama_dokter'], 
                groupSummary : [true], 
                groupColumnShow : [true],
                groupText : ['<b>Dokter: {0} - {1} Item</b>'], 
                groupCollapse : false,
                groupOrder: ['asc'] },
                */
            caption: "Data Laporan Biaya Terbesar" //Caption List					
        });
        grid.jqGrid('setGroupHeaders',
                                        { useColSpanStyle: false,
                                            groupHeaders:
                                                [
                                                {startColumnName: 'kunj_apotek',
                                                    numberOfColumns: 2,
                                                    titleText: 'Apotek'},
                                                {startColumnName: 'kunj_gigi',
                                                    numberOfColumns: 2,
                                                    titleText: 'Gigi'},
                                                {startColumnName: 'kunj_lab',
                                                    numberOfColumns: 2,
                                                    titleText: 'Laboratorium'},
                                                {startColumnName: 'kunj_optik',
                                                    numberOfColumns: 2,
                                                    titleText: 'Optik'},
                                                {startColumnName: 'kunj_rs',
                                                    numberOfColumns: 2,
                                                    titleText: 'Rumah Sakit'},
                                                {startColumnName: 'kunj_umum',
                                                    numberOfColumns: 2,
                                                    titleText: 'Dokter Umum'},
                                                {startColumnName: 'kunj_spesialis',
                                                    numberOfColumns: 2,
                                                    titleText: 'Dokter Spesialis'}
                                            ] });
                                grid.jqGrid('setFrozenColumns');
        /*
        grid.jqGrid('setGroupHeaders',
        {
            useColSpanStyle: true,
            groupHeaders:
            [ 
                {startColumnName: 'kunj_apotek', numberOfColumns: 2, titleText: 'Apotek'}, 
                {startColumnName: 'kunj_gigi', numberOfColumns: 2, titleText: 'Gigi'},
                {startColumnName: 'kunj_lab', numberOfColumns: 2, titleText: 'Laboratorium'},
                {startColumnName: 'kunj_optik', numberOfColumns: 2, titleText: 'Optik'},
                {startColumnName: 'kunj_rs', numberOfColumns: 2, titleText: 'Rumah Sakit'},
                {startColumnName: 'kunj_umum', numberOfColumns: 2, titleText: 'Dokter Umum'},
                {startColumnName: 'kunj_spesialis', numberOfColumns: 2, titleText: 'Dokter Spesialis'}
            ]
        });
        */
	grid.jqGrid('navGrid','#pagerlaporanbiayaTerbesar',{view:true,edit:false,add:false,del:false},{},{},{},{closeOnEscape:true,closeAfterSearch:false,multipleSearch:false, multipleGroup:false, showQuery:false,drag:true,showOnLoad:false,sopt:['cn'],resize:false,caption:'Cari Record', Find:'Cari', Reset:'Batalkan Pencarian'});
	jQuery("#listlaporanbiayaTerbesar").jqGrid('navButtonAdd','#pagerlaporanbiayaTerbesar',{caption:"Print",
            onClickButton:function()
            {
                var isi="?jenis="+jenis+"&bulan="+bulan+"&tahun="+tahun+"&karyawan="+karyawan;
                window.location.href="<?php echo base_url() ?>index.php/laporan/biayaTerbesar/ekspor"+isi;
		//alert("BERHASIL ayo SEMANGAT kalahkan skripsi");
                return false;
            }
	});

	$('a.detail_terbesar').live('click',function(){
            var buku_besar=$(this).attr("href");
            bb=buku_besar;
            //alert(buku_besar);
            $("#dialog-biayaTerbesar").dialog({
                title:"Detail Biaya Terbesar : "+bb, 
		resizable:true, 
		width:675, 
		height:250,
		show: 'drop',
		hide: 'scale',
		modal:true,
                open:function(){
                    $("#dialog-biayaTerbesar").load("<?php echo base_url() ?>index.php/laporan/biayaTerbesar/detail?nip="+bb+"&bulan="+bulan+"&tahun="+tahun);
                },
		close:function(){
                    $(this).dialog('destroy');
		}
            });

            return false;
        });
    });
</script>
<form>
    <table border="0">
        <tr>
            <td>
                <b>Jenis Laporan : </b>
                <select id="biayaTerbesar_berdasarkan" onchange="setbiayaTerbesarBerdasarkan();">
                    <option value="" selected></option>
                    <option value="20pt">20 % Terbesar</option>
                    <option value="20ot">20 Orang Terbesar</option>
                </select>
            </td>
            <td>
                Status Karyawan :
                <select id="laporanbiayaTerbesarkaryawan" onchange="setlaporanbiayaTerbesarkaryawan();">
                    <option value="" selected>Semua</option>
                    <option value="a">Karyawan</option>
                    <option value="p">Pensiunan</option>
                </select>
            </td>
            <td>
                Bulan :
                <select id="laporanbiayaTerbesarbulan" onchange="setlaporanbiayaTerbesarbulan();">
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
                Tahun :
                <input type="text" id="laporanbiayaTerbesartahun" onchange="setlaporanbiayaTerbesartahun();"/>
            </td>
            <td>
                <input type="text" hidden="true" id="laporanbiayaTerbesartahun" onchange="setlaporanbiayaTerbesartahun();"/>
            </td>
        </tr>
    </table>
</form>
<div id="master_laporanbiayaTerbesar" style="width: auto; height: auto;overflow: auto">
		<table id="listlaporanbiayaTerbesar" class="scroll" cellpadding="0" cellspacing="0"></table>
		<div id="pagerlaporanbiayaTerbesar" class="scroll" style="text-align:center;"></div>
                <div id="laporanbiayaTerbesarimpor"></div>
</div>
<div id="dialog-biayaTerbesar" class=""></div> 