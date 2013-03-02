<script type="text/javascript">
    $(document).ready(function(){

        var grid = $('#sum_auditbiaya');
	grid.jqGrid({
	url: '<?php echo base_url() ?>index.php/laporan/executive/getAuditjson', //URL Tujuan Yg Mengenerate data Json nya
	datatype: "json", //Datatype yg di gunakan
	height: "auto", //Mengset Tinggi table jadi Auto menyesuaikan dengan isi table
	mtype: "GET",
        colNames: ['Id Transaksi','Nama Transaksi','Jumlah Tagihan','Total Tagihan'],
	colModel: [
                    {name:'id_provider', key:true, index:'id_provider', hidden:true,editable:false,editrules:{required:true}},//name untuk variabel post yang dikirim saat menambah data
                    {name:'nama_transaksi',index:'nama_transaksi',width:120,editable:true,editrules:{required:true}},
                    {name:'jml_tagihan',index:'jml_tagihan',width:120,editable:true,editrules:{required:true}},
                    {name:'total_tagihan',index:'total_tagihan',width:120,editable:true,editrules:{required:true}}
                  ],
	rownumbers:true,
	rowNum: 10,
	rowList: [10,20,30],
	pager: '#sum_pager_auditbiaya',
	sortname: 'id_provider',
	viewrecords: true,
	sortorder: "desc",
	multiselect: false,
	caption: "Detail Audit Biaya" //Caption List
	});
	grid.jqGrid('navGrid','#sum_pager_auditbiaya',{view:false,edit:false,add:false,del:false},{},{},{},{closeOnEscape:true,closeAfterSearch:false,multipleSearch:false, multipleGroup:false, showQuery:false,drag:true,showOnLoad:false,sopt:['cn'],resize:false,caption:'Cari Record', Find:'Cari', Reset:'Batalkan Pencarian'});

    })
</script>
<div>
    <table>
        <tr>
        <td>
            <h4>Hasil Audit</h4>
                                <div id="chartpostbiaya">
				  This text is replaced by chart.
				</div>
				<script type="text/javascript">
				   var chartpostbiaya = new FusionCharts("<?php echo base_url();?>/asset/chart/FCF_Column2D.swf", "ChId1", "440", "400");
				   chartpostbiaya.setDataURL(escape("<?php echo base_url();?>index.php/laporan/executive/getAudit"));
				   chartpostbiaya.render("chartpostbiaya");
				</script>
        </td>
        <td align="center" valign="top">
        <div  style="width: auto; height: auto;overflow: auto">
		<table id="sum_auditbiaya" class="scroll" cellpadding="0" cellspacing="0"></table>
                <div id="sum_pager_auditbiaya" class="scroll" style="text-align:center;"></div>
        </div>
        </td>
        </tr>
    </table>
</div>
