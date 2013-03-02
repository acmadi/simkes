<?php
//$jenis_file=
?>
<script type="text/javascript">
    var id='<?php echo $id;?>';
    var jenis='<?php echo $jenis;?>';
    $(document).ready(function()
    {
        
        var grid = $("#detaillaporandetailDiagnosa"+jenis);
	grid.jqGrid({
            url: '<?php echo base_url() ?>index.php/laporan/detailTemuan/json', //URL Tujuan Yg Mengenerate data Json nya
            datatype: "json", //Datatype yg di gunakan
            height: "auto", //Mengset Tinggi table jadi Auto menyesuaikan dengan isi table
            mtype: "GET",
            colNames: ['Diagnosa'],
            colModel: [
                        {name:'nama_diagnosa',index:'nama_diagnosa',width:100,editable:true,editrules:{required:true}}
            ],          
            rownumbers:true,
            rowNum: 10,
            postData:{
                id : function()
                {
                    return id;
                }},
            viewrecords: true,
            multiselect: false, 
            //grouping:true,
               
            caption: "Diagnosa Pasien" //Caption List					
        });
        
	var grid = $("#detaillaporandetailTemuan"+jenis);
	grid.jqGrid({
            url: '<?php echo base_url() ?>index.php/laporan/detailTemuan/json2', //URL Tujuan Yg Mengenerate data Json nya
            datatype: "json", //Datatype yg di gunakan
            height: "auto", //Mengset Tinggi table jadi Auto menyesuaikan dengan isi table
            mtype: "GET",
            colNames: ['Jenis','Item','Jumlah','Harga Satuan','Harga Item','Total'],
            colModel: [
                        //{name:'id_transaksi', key:true, index:'id_transaksi', hidden:true,editable:false,editrules:{required:true}},
                        {name:'jenis',index:'jenis',width:70,editable:true,editrules:{required:true},summaryType:'count', summaryTpl : '({0}) Total'},
			{name:'nama_item',index:'nama_item',width:100,editable:true,editrules:{required:true}},
                        {name:'jumlah',index:'jumlah',width:70,editable:true,editrules:{required:true}, align:'center',summaryType:'sum'},
                        {name:'hrg_satuan',index:'hrg_satuan',width:70,editable:true,editrules:{required:true},summaryType:'sum',align:'right',formatter:'currency',formatoptions: {thousandsSeparator:','}},
			{name:'harga_item',index:'harga_item',width:70,editable:true,editrules:{required:true},summaryType:'sum',align:'right',formatter:'currency',formatoptions: {thousandsSeparator:','}},
                        {name:'total',index:'total',width:80,editable:true,editrules:{required:true},summaryType:'sum',align:'right',formatter:'currency',formatoptions: {thousandsSeparator:','}}
            ],          
            rownumbers:true,
            rowNum: 10,
            rowList: [10,20,30],
            postData:{
                id : function()
                {
                    return id;
                }
            },
            viewrecords: true,
            sortorder: "desc",
            multiselect: false, 
            grouping:true, 
            groupingView : { 
                groupField : ['id_transaksi'], 
                groupSummary : [true], 
                groupColumnShow : [true],
                groupText : ['<b>ID Transaksi : '+id+' - {1} Item</b>'], 
                groupCollapse : false,
                groupOrder: ['asc'] },
               
            caption: "Item Transaksi" //Caption List					
        });
        
	//grid.jqGrid('navGrid','#pagerdetaildetailTemuan',{view:true,edit:false,add:false,del:false},{},{},{},{closeOnEscape:true,closeAfterSearch:false,multipleSearch:false, multipleGroup:false, showQuery:false,drag:true,showOnLoad:false,sopt:['cn'],resize:false,caption:'Cari Record', Find:'Cari', Reset:'Batalkan Pencarian'});
	                                                                                             
    });
</script>
<table border="0" height="100%">
    <tr>
        <td style="vertical-align: top">
            <div id="master_laporandetailDiagnosa<?php echo $jenis;?>" style="width: auto; height: auto;overflow: auto">
		<table id="detaillaporandetailDiagnosa<?php echo $jenis;?>"  cellpadding="0" cellspacing="0"></table>
		<div id="pagerdetaildetailDiagnosa<?php echo $jenis;?>"  style="text-align:center;"></div>
        </td>
        <td style="vertical-align: top">
            <div id="master_laporandetailTemuan<?php echo $jenis;?>" style="width: auto; height: auto;overflow: auto">
		<table id="detaillaporandetailTemuan<?php echo $jenis;?>"  cellpadding="0" cellspacing="0"></table>
		<div id="pagerdetaildetailTemuan<?php echo $jenis;?>"  style="text-align:center;"></div>                
        </td>
    </tr>
</table>
