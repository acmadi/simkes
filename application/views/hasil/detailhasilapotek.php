		<script type="text/javascript">
		
                $(document).ready(function()
			{       
				var grid = $("#listdiagnosahasilapotek");
				grid.jqGrid({
					url: '<?php echo base_url() ?>index.php/hasil/hasilapotek/detail_diagnosa/'+<?php echo $id_tran;?>, //URL Tujuan Yg Mengenerate data Json nya
					datatype: "json", //Datatype yg di gunakan
					height: "auto", //Mengset Tinggi table jadi Auto menyesuaikan dengan isi table
					mtype: "GET",
                                        
					colNames: ['Id Transaksi','Diagnosa'],
					colModel: [
						{name:'id_transaksi', key:true, index:'id_transaksi', hidden:true,editable:false,editrules:{required:true}},//name untuk variabel post yang dikirim saat menambah data
						{name:'nama_diagnosa',index:'nama_diagnosa',width:120,editable:true,editrules:{required:true}}//index untuk variabel yang digunakan saat pencarian
						
					],
					rownumbers:true,
					rowNum: 10,
					rowList: [10,20,30],
					//pager: '#pagerdiagnosahasilapotek',
					sortname: 'id_transaksi',
					viewrecords: true,
					sortorder: "desc",
					//editurl: '<?php echo base_url() ?>index.php/hasil/hasilapotek/crud', //URL Proses CRUD Nya
					multiselect: false,
					caption: "Diagnosa" //Caption List
				});
				//grid.jqGrid('navGrid','#pagerdiagnosahasilapotek',{view:false,edit:false,add:false,del:false},{},{},{},{closeOnEscape:true,closeAfterSearch:false,multipleSearch:false, multipleGroup:false, showQuery:false,drag:true,showOnLoad:false,sopt:['cn'],resize:false,caption:'Cari Record', Find:'Cari', Reset:'Batalkan Pencarian'});
				
   
				var tes = $("#listitemhasilapotek");
				tes.jqGrid({
					url: '<?php echo base_url() ?>index.php/hasil/hasilapotek/detail_item/'+<?php echo $id_tran;?>, //URL Tujuan Yg Mengenerate data Json nya
					datatype: "json", //Datatype yg di gunakan
					height: "auto", //Mengset Tinggi table jadi Auto menyesuaikan dengan isi table
					mtype: "GET",
                                        
					colNames: ['Id Transaksi','Jenis','Item','Jumlah','Hrg.Standar','Hrg.Satuan','Satuan','Kandungan','Dosis','Rekomendasi','Total'],
					colModel: [
						{name:'id_transaksi', key:true, index:'id_transaksi', hidden:true,editable:false,editrules:{required:true}},//name untuk variabel post yang dikirim saat menambah data
						{name:'jenis_item',index:'jenis_item',width:50,align:'center',editable:true,editrules:{required:true}},//index untuk variabel yang digunakan saat pencarian
						{name:'nama_item',index:'nama_item',width:40,align:'center',editable:true,editrules:{required:true}},
						{name:'jumlah',index:'jumlah', width:40,align:'center',editable:true,editrules:{required:true}},
						{name:'harga_item',index:'harga_item',width:55,align:'center',editable:true,editrules:{required:true}},
						{name:'hrg_satuan',index:'hrg_satuan',width:60,align:'center',editable:true,editrules:{required:true}},
						{name:'satuan',index:'satuan',width:40,align:'center',editable:true,editrules:{required:true}},
						{name:'kandungan',index:'kandungan',width:60,align:'center',editable:true,editrules:{required:true}},
						{name:'dosis',index:'dosis',width:30,align:'center',editable:true,editrules:{required:true}},
                                                {name:'rekomendasi',index:'rekomendasi',width:60,align:'center',editable:true,editrules:{required:true}},
                                                {name:'total',index:'total',width:50,align:'center',editable:true,editrules:{required:true}}
					],
					rownumbers:false,
                                        footerrow:true,
                                        userDataOnFooter:true,
                                        //altRows : true,
					rowNum: 10,
					rowList: [10,20,30],
					pager: '#pageritemhasilapotek',
					sortname: 'id_transaksi',
					viewrecords: true,
					sortorder: "desc",
					multiselect: false,
					caption: "Item Transaksi" //Caption List
				});
				tes.jqGrid('navGrid','#pageritemhasilapotek',{view:false,edit:false,add:false,del:false},{},{},{},{closeOnEscape:true,closeAfterSearch:false,multipleSearch:false, multipleGroup:false, showQuery:false,drag:true,showOnLoad:false,sopt:['cn'],resize:false,caption:'Cari Record', Find:'Cari', Reset:'Batalkan Pencarian'});
			});
		</script>
<table>
<tr>
    <td align="center" valign="top">
<div  style="width: auto; height: auto;overflow: auto">
		<table id="listdiagnosahasilapotek" class="scroll" cellpadding="0" cellspacing="0"></table>
		<div id="pagerdiagnosahasilapotek" class="scroll" style="text-align:center;"></div>
  
</div>
</td>
<td align="center" valign="top">
    <div  style="width: auto; height: auto;overflow: auto">
		<table id="listitemhasilapotek" class="scroll" cellpadding="0" cellspacing="0"></table>
		<div id="pageritemhasilapotek" class="scroll" style="text-align:center;"></div>
                
</div>
</td>
</tr>
</table>
