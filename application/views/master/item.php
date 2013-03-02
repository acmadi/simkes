		<script type="text/javascript">
			$(document).ready(function()
			{       $('#formitem').dialog({
                                        autoOpen:false,
                                        title:"Import Data Apotek",
                                        resizable:false,
                                        width:350,
                                        show: 'drop',
                                        hide: 'scale',
                                        modal:true
                                        }
                                        );
                                $('#itemimpor').dialog({
                                        autoOpen:false,
                                        title:"Import Data Item",
                                        resizable:false,
                                        width:350,
                                        height:150,
                                        show: 'drop',
                                        hide: 'scale',
                                        modal:true
                                        }
                                        );
                                var jenis_item = $.ajax({
                                    url : '<?php echo base_url() ?>index.php/master/item/jenis_item',
                                    type : 'POST',
                                    async : false,
                                    dataType : 'json'
                                }).responseText;

				var grid = $("#listitem");
				grid.jqGrid({
					url: '<?php echo base_url() ?>index.php/master/item/json', //URL Tujuan Yg Mengenerate data Json nya
					datatype: "json", //Datatype yg di gunakan
					height: "auto", //Mengset Tinggi table jadi Auto menyesuaikan dengan isi table
					mtype: "GET",
					colNames: ['id_item','Nama Item','Jenis Tagihan','HBA','Harga','Formularium','Obat Oral','Kelas','Provider','Entri'],
					colModel: [
						{name:'id_item', key:true, index:'id_item', hidden:true,editable:false,editrules:{required:true}},//name untuk variabel post yang dikirim saat menambah data
						{name:'nama_item',index:'nama_item',width:250,editable:true,editrules:{required:true}},//index untuk variabel yang digunakan saat pencarian
						{name:'idjns_item',index:'jenis_item',width:50,editable:true,edittype:"select",editoptions:{value:jenis_item},editrules:{required:false}},
						{name:'hba_item',index:'hba',width:50,editable:true,editrules:{required:false}},
						{name:'harga_item',index:'harga',width:50,editable:true,editrules:{required:false}},
						{name:'formularium_item',index:'frm_item',width:50,editable:true,edittype:"checkbox",editoptions: {value:"y:t"},editrules:{required:false}},
						{name:'oral_item',index:'oral_item',width:50,editable:true,edittype:"checkbox",editoptions: {value:"y:t"},editrules:{required:false}},
						{name:'kls_item',index:'kls_item',width:50,editable:true,edittype:"select",editoptions:{value:"1:1;2:2;3:3"},editrules:{required:false}},
						{name:'provider_item',index:'provider_item',width:100,editable:true,editrules:{required:false}},
						{name:'entri_item',index:'entri_item',width:50,editable:true,editrules:{required:false}},
					],
					rownumbers:true,
					rowNum: 10,
					rowList: [10,20,30],
					pager: '#pageritem',
					sortname: 'id_item',
					viewrecords: true,
					sortorder: "desc",
					editurl: '<?php echo base_url() ?>index.php/master/item/crud', //URL Proses CRUD Nya
					multiselect: false, 
					caption: "Data item" //Caption List					
				});
				grid.jqGrid('navGrid','#pageritem',
                                           {view:true,edit:true,add:true,del:true},
                                           {
                                               
                                           },
                                           {},
                                           {},
                                           {closeOnEscape:true,closeAfterSearch:false,multipleSearch:false, multipleGroup:false, showQuery:false,drag:true,showOnLoad:false,sopt:['cn'],resize:false,caption:'Cari Record', Find:'Cari', Reset:'Batalkan Pencarian'});
				
				jQuery("#listitem")
                                .jqGrid('navButtonAdd','#pageritem',{caption:"",buttonicon:"ui-icon-plus",
				onClickButton:function()
				{
				//alert("BERHASIL ayo SEMANGAT kalahkan skripsi");
				//$('#formInput').html('<img src="loading.gif">').load(page);
				$('#formitem').load("<?php echo base_url();?>index.php/master/item/add");
				$('#formitem').dialog('open');
					return false;
				} 
				})
                                .jqGrid('navButtonAdd','#pageritem',{caption:"Excel",buttonicon:"ui-icon-print",
                                onClickButton:function()
                                {
                                    window.location.href="<?php echo base_url() ?>index.php/master/item/ekspor";
				//alert("BERHASIL ayo SEMANGAT kalahkan skripsi");
				}
				})
                                .jqGrid('navButtonAdd','#pageritem',{caption:"Impor",buttonicon:"ui-icon-folder-open",
				onClickButton:function()
				{
				//alert("BERHASIL ayo SEMANGAT kalahkan skripsi");
				//$('#formInput').html('<img src="loading.gif">').load(page);
				$('#itemimpor').load("<?php echo base_url();?>index.php/master/item/impor");
				$('#itemimpor').dialog('open');
					return false;
				}
				})
                                ;
			});
		</script>
<div id="master_item" style="width: auto; height: auto;overflow: auto">
		<table id="listitem" class="scroll" cellpadding="0" cellspacing="0"></table>
		<div id="pageritem" class="scroll" style="text-align:center;"></div>
		<div id="formitem"></div>
		<div id="itemimpor"></div>
</div>