
<script type="text/javascript">
    var bukuBesar='<?php echo $bukuBesar;?>';   
    var bulan='<?php echo $bulan;?>';
    var tahun='<?php echo $tahun;?>';
    var filter='<?php echo $filter;?>';
    var pegawai='<?php echo $pegawai;?>';
    
    $(document).ready(function()
    {
        $("#detail-bukuBesar").jqGrid({
                url: '<?php echo base_url() ?>index.php/laporan/bukuBesar/json2',
		datatype: "json",
		mtype: 'GET',
		colNames: ['No', 'NIP', 'Penanggung', 'Rawat', 'Tgl Trans', 'Tgl Kunj', 'Restitusi', 'Kwitansi', 'Kunjungan', 'Total'],
		colModel: [
                        {name:'id_transaksi', index:'id_transaksi',key:true, hidden:true, width: 40, align:'center', sortable: true},
			{name:'nip', index:'nip', align:'left', width: 100,sortable: true},
                        {name:'nama_karyawan', index:'nama_karyawan', align:'left', width: 170,sortable: true},
                        {name:'rawat', index:'rawat', align:'left', width: 120,sortable: true},
                        {name:'tgl_transaksi', index:'tgl_transaksi', align:'center', width: 120,sortable: true},
                        {name:'tgl_kunjungan', index:'tgl_kunjungan', align:'center', width: 120,sortable: true},
                        {name:'restitusi', index:'restitusi', align:'center', width: 100,sortable: true},
                        {name:'no_bukti', index:'no_bukti', align:'center', width: 100,sortable: true},
                        {name:'kunjungan', index:'kunjungan', align:'left', width: 100,sortable: true},
                        {name:'total', index:'total', sortable: true,width: 150,summaryType:'sum',align:'right',formatter:'currency',formatoptions: {thousandsSeparator:','}}
                        
		],
		rownumbers:true,
		rowNum:5,
		rowList:[5,10,15], 
		pager: '#pager-bukuBesar',
                //postData: {bukuBesar :function(){return bb}},
                postData:{bulan : function()
                                        {
                                         
                                         return bulan;
                                        },tahun : function()
                                        {
                                         
                                         return tahun;
                                        },bukuBesar:function()
                                        {
                                         return bukuBesar;
                                        },filter:function()
                                        {
                                         return filter;
                                        },pegawai:function()
                                        {
                                         return pegawai;
                                        }

                                        },
		viewrecords: true,
		sortname: 'id_transaksi',
		sortorder: "asc",
		width: 650,
		height: 'auto'
		//caption: '&nbsp;'
            });
            $("#detail-bukuBesar").jqGrid('navGrid','#pager-bukuBesar',{view:false,edit:false,add:false,del:false});
            
            $("#detail-bukuBesar")
                .jqGrid('navButtonAdd','#pager-bukuBesar',{caption:"Print",
                onClickButton:function()
                    {   
                        var sidx = grid.jqGrid('getGridParam','sortname');
                        var sord = grid.jqGrid('getGridParam','sortorder');
                        var page = grid.jqGrid('getGridParam','page');
                        var row  = grid.jqGrid('getGridParam','rowNum');
                                    
                        //window.location.href="<?php echo base_url() ?>index.php/laporan/bukuBesar/ekspor2?bukuBesar="+bukuBesar+"&tahun="+tahun+"&bulan="+bulan+"&filter="+filter+"&pegawai="+pegawai+"&sidx="+sidx+"&page="+page+"&rows="+row+"&sord="+sord;
                        alert("BERHASIL ayo SEMANGAT kalahkan skripsi");
                    }
            });
            
    });
</script>
<div id="master_laporanbiayaTerbesar" style="width: auto; height: auto;overflow: auto">
		<table id="detail-bukuBesar" class="scroll" cellpadding="0" cellspacing="0"></table> 
    <div id="pager-bukuBesar" class='ui-widget-header ui-corner-bl ui-corner-br' style="margin-top:0px;"></div>
</div>