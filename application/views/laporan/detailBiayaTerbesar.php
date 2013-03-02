
<script type="text/javascript">
    var nip='<?php echo $nip;?>';
    var bulan='<?php echo $bulan;?>';
    var tahun='<?php echo $tahun;?>';
    $(document).ready(function()
    {
        
        var grid = $("#detaillaporanbiayaTerbesar");
	grid.jqGrid({
            url: '<?php echo base_url() ?>index.php/laporan/biayaTerbesar/json2', //URL Tujuan Yg Mengenerate data Json nya
            datatype: "json", //Datatype yg di gunakan
            height: "auto", //Mengset Tinggi table jadi Auto menyesuaikan dengan isi table
            mtype: "GET",
            colNames: ['Id Trans','NIP','Penanggung','Pasien','A/P','Status','Tgl Kunjungan','Tgl Transaksi','Diagnosa','Dokter','Obat','Jumlah','Harga','Total'],
            colModel: [
                        {name:'id_transaksi', key:true,width:70, index:'id_transaksi', hidden:true,editable:false,editrules:{required:true},align:'center'},//name untuk variabel post yang dikirim saat menambah data
                        //{name:'id_transaksi', index:'id_transaksi',width:70,editable:true,editrules:{required:true},summaryType:'count', summaryTpl : '({0}) Total'},
			{name:'nip',index:'nip',width:70,editable:true,editrules:{required:true},align:'center'},
			{name:'nama_karyawan',index:'nama_karyawan',width:120,editable:true,editrules:{required:true}},
                        {name:'nama_tertanggung',index:'nama_tertanggung',width:100,editable:true,editrules:{required:true}},
			{name:'ap',index:'ap',width:30,align:'center',editable:true,editrules:{required:true}},
                        {name:'status',index:'status',width:40,editable:true,editrules:{required:true}, align:'center'},
                        {name:'tgl_kunjungan',index:'tgl_kunjungan',width:70,editable:true,editrules:{required:true}, align:'center'},
                        {name:'tgl_transaksi',index:'tgl_transaksi',width:70,editable:true,editrules:{required:true}, align:'center'},
                        {name:'nama_diagnosa',index:'nama_diagnosa',width:70,editable:true,editrules:{required:true}},
                        {name:'nama_dokter',index:'nama_dokter',width:70,editable:true,editrules:{required:true}},
                        {name:'nama_item',index:'nama_item',width:70,editable:true,editrules:{required:true}},
                        {name:'jumlah',index:'jumlah',width:70,editable:true,editrules:{required:true}, align:'center'},
                        {name:'hrg_satuan',index:'hrg_satuan',width:70,editable:true,editrules:{required:true},summaryType:'sum',align:'right',formatter:'currency',formatoptions: {thousandsSeparator:','}},
                        {name:'total',index:'total',width:70,editable:true,editrules:{required:true},summaryType:'sum',align:'right',formatter:'currency',formatoptions: {thousandsSeparator:','}}
            ],          
            rownumbers:true,
            rowNum: 10,
            rowList: [10,20,30],
            postData:{
                nip : function()
                {
                    return nip;
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
            pager: '#pagerdetailbiayaTerbesar',
            sortname: 'id_transaksi',
            viewrecords: true,
            sortorder: "desc",
            multiselect: false, 
            grouping:true, 
            groupingView : { 
                groupField : ['id_transaksi'], 
                groupColumnShow : [true],
                groupText : ['<b>ID Transaksi : {0} - {1} Item</b>'], 
                groupCollapse : false,
                groupOrder: ['asc'] }
               
            //caption: "" //Caption List					
        });
        
	grid.jqGrid('navGrid','#pagerdetailbiayaTerbesar',{view:true,edit:false,add:false,del:false},{},{},{},{closeOnEscape:true,closeAfterSearch:false,multipleSearch:false, multipleGroup:false, showQuery:false,drag:true,showOnLoad:false,sopt:['cn'],resize:false,caption:'Cari Record', Find:'Cari', Reset:'Batalkan Pencarian'});
	                                                                                             
    });
</script>
<div id="master_laporanbiayaTerbesar" style="width: auto; height: auto;overflow: auto">
		<table id="detaillaporanbiayaTerbesar"  cellpadding="0" cellspacing="0"></table>
		<div id="pagerdetailbiayaTerbesar"  style="text-align:center;"></div>
                <div id="laporanbiayaTerbesarimpor"></div>
</div>