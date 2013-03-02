<script type="text/javascript">
    $(document).ready(function(){

        var grid = $('#sum_postbiaya');
	grid.jqGrid({
	url: '<?php echo base_url() ?>index.php/laporan/executive/getBiayajson', //URL Tujuan Yg Mengenerate data Json nya
	datatype: "json", //Datatype yg di gunakan
	height: "auto", //Mengset Tinggi table jadi Auto menyesuaikan dengan isi table
	mtype: "GET",
        postData:{bulan : function()
                 {
                     return bulan1;
                 },tahun : function()
                 {
                     return tahun1;
                 }
                 },
        colNames: ['Id Transaksi','Post Biaya','Karyawan','Keluarga Karyawan','Pensiunan','Keluarga Pensiunan'],
	colModel: [
                    {name:'id_provider', key:true, index:'id_provider', hidden:true,editable:false,editrules:{required:true}},//name untuk variabel post yang dikirim saat menambah data
                    {name:'post_biaya',index:'post_biaya',width:120,editable:true,editrules:{required:true}},
                    {name:'karyawan',index:'karyawan',width:120,editable:true,editrules:{required:true}},
                    {name:'kel_karyawan',index:'kel_karyawan',width:120,editable:true,editrules:{required:true}},
                    {name:'pensiunan',index:'pensiunan',width:120,editable:true,editrules:{required:true}},
                    {name:'kel_pensiunan',index:'kel_pensiunan',width:120,editable:true,editrules:{required:true}}
                  ],
	rownumbers:true,
	rowNum: 10,
	rowList: [10,20,30],
	pager: '#sum_pager_postbiaya',
	sortname: 'id_provider',
	viewrecords: true,
	sortorder: "desc",
	multiselect: false,
	caption: "Detail Post Biaya" //Caption List
	});
	grid.jqGrid('navGrid','#sum_pager_postbiaya',{view:false,edit:false,add:false,del:false},{},{},{},{closeOnEscape:true,closeAfterSearch:false,multipleSearch:false, multipleGroup:false, showQuery:false,drag:true,showOnLoad:false,sopt:['cn'],resize:false,caption:'Cari Record', Find:'Cari', Reset:'Batalkan Pencarian'});

    })
</script>
<div>
    <table>
        <tr>
        <td>
           
            <h4>Rincian Post Biaya</h4>
                                <div id="chartpostbiaya">
				  This text is replaced by chart.
				</div>
				<script type="text/javascript">
				   var chartpostbiaya = new FusionCharts("<?php echo base_url();?>/asset/chart/FCF_Pie2D.swf", "ChId1", "440", "400");
				   chartpostbiaya.setDataURL(escape("<?php echo base_url();?>index.php/laporan/executive/getPostbiaya?bulan=<?php echo $bulan;?>&tahun=<?php echo $tahun;?>"));
				   chartpostbiaya.render("chartpostbiaya");
				</script>
        </td>
        <td>
        </td>
        <td align="center" valign="top">
        <div  style="width: auto; height: auto;overflow: auto">
		<table id="sum_postbiaya" class="scroll" cellpadding="0" cellspacing="0"></table>
                <div id="sum_pager_postbiaya" class="scroll" style="text-align:center;"></div>
        </div>
        </td>
        </tr>
    </table>
</div>
