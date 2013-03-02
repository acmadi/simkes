		<script type="text/javascript">
			$(document).ready(function()
			{
				var grid = $("#list2");
				grid.jqGrid({
					url: '<?php echo base_url() ?>index.php/master/buku/json', //URL Tujuan Yg Mengenerate data Json nya
					datatype: "json", //Datatype yg di gunakan
					height: "auto", //Mengset Tinggi table jadi Auto menyesuaikan dengan isi table
					mtype: "GET",
					colNames: ['id','Nama','Pengarang','Tahun Terbit','Penerbit'],
					colModel: [
						{name:'id', key:true, index:'id', hidden:true,editable:false,editrules:{required:true}},
						{name:'nama',index:'nama',editable:true,editrules:{required:true}},
						{name:'pengarang',index:'pengarang',editable:true,editrules:{required:true}},
						{name:'tahun_terbit',index:'tahun_terbit',align:'center',editable:true,editrules:{required:true}},
                        {name:'penerbit',index:'penerbit',align:'center',editable:true,editrules:{required:true}}
					],
					rownumbers:true,
					rowNum: 10,
					rowList: [10,20,30],
					pager: '#pager2',
					sortname: 'id',
					viewrecords: true,
					sortorder: "desc",
					editurl: '<?php echo base_url() ?>index.php/welcome/crud', //URL Proses CRUD Nya
					multiselect: false, 
					caption: "Record Test", //Caption List					
				});
				grid.jqGrid('navGrid','#pager2',{view:true,edit:true,add:true,del:true},{},{},{},{closeOnEscape:true,closeAfterSearch:false,multipleSearch:false, multipleGroup:false, showQuery:false,drag:true,showOnLoad:false,sopt:['cn'],resize:false,caption:'Cari Record', Find:'Cari', Reset:'Batalkan Pencarian'});				
			});
		</script>
	
		<table id="list2" class="scroll" cellpadding="0" cellspacing="0"></table>
		<div id="pager2" class="scroll" style="text-align:center;"></div>
	