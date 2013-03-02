		<script type="text/javascript">
			$(document).ready(function()
			{       $('#formrayon').dialog({
                                        autoOpen:false,
                                        title:"Import Data Apotek",
                                        resizable:false,
                                        width:350,
                                        show: 'drop',
                                        hide: 'scale',
                                        modal:true
                                        }
                                        );
                                $('#rayonimpor').dialog({
                                        autoOpen:false,
                                        title:"Import Data Rayon",
                                        resizable:false,
                                        width:350,
                                        height:150,
                                        show: 'drop',
                                        hide: 'scale',
                                        modal:true
                                        }
                                        );
                                var wilayah_rayon = $.ajax({
                                    url : '<?php echo base_url() ?>index.php/master/rayon/wilayah',
                                    type : 'POST',
                                    async : false,
                                    dataType : 'json'
                                }).responseText;

				var grid = $("#listrayon");
				grid.jqGrid({
					url: '<?php echo base_url() ?>index.php/master/rayon/json', //URL Tujuan Yg Mengenerate data Json nya
					datatype: "json", //Datatype yg di gunakan
					height: "auto", //Mengset Tinggi table jadi Auto menyesuaikan dengan isi table
					mtype: "GET",
					colNames: ['Id','Nama Rayon','Wilayah'],
					colModel: [
						{name:'id_rayon', key:true, index:'id_rayon', hidden:true,editable:false,editrules:{required:true}},//name untuk variabel post yang dikirim saat menambah data
						{name:'nama_rayon',index:'nama_rayon',width:450,editable:true,editrules:{required:true}},//name untuk variabel post yang dikirim saat menambah data
						{name:'id_wilayah',index:'nama_wilayah',width:250,editable:true,edittype:"select",editoptions:{value:wilayah_rayon},editrules:{required:false}},
					],
					rownumbers:true,
					rowNum: 10,
					rowList: [10,20,30],
					pager: '#pagerrayon',
					sortname: 'id_rayon',
					viewrecords: true,
					sortorder: "desc",
					editurl: '<?php echo base_url() ?>index.php/master/rayon/crud', //URL Proses CRUD Nya
					multiselect: false, 
					caption: "Data rayon" //Caption List					
				});
				
				grid.jqGrid('navGrid','#pagerrayon',{view:true,edit:true,add:true,del:true},{},{},{},{closeOnEscape:true,closeAfterSearch:false,multipleSearch:false, multipleGroup:false, showQuery:false,drag:true,showOnLoad:false,sopt:['cn'],resize:false,caption:'Cari Record', Find:'Cari', Reset:'Batalkan Pencarian'});
				jQuery("#listrayon")
                                .jqGrid('navButtonAdd','#pagerrayon',{caption:"Excel",buttonicon:"ui-icon-print",
                                onClickButton:function()
                                {
                                    window.location.href="<?php echo base_url() ?>index.php/master/rayon/ekspor";
				//alert("BERHASIL ayo SEMANGAT kalahkan skripsi");
				}
				})
                                .jqGrid('navButtonAdd','#pagerrayon',{caption:"Impor",buttonicon:"ui-icon-folder-open",
                                onClickButton:function()
                                {
				//$("#apotekimpor").load("<?php echo base_url() ?>index.php/master/apotek/impor");
				$('#rayonimpor').load("<?php echo base_url() ?>index.php/master/rayon/impor");
				$('#rayonimpor').dialog('open');
                                return false;
                                }
				})
                                ;
						
						
						
			});
		</script>
	<div id="master_rayon" style="width: auto; height: auto;overflow: auto">
		<table id="listrayon" class="scroll" cellpadding="0" cellspacing="0"></table>
		<div id="pagerrayon" class="scroll" style="text-align:center;"></div>
		<div id="formrayon"></div>
                <div id="rayonimpor"></div>
	</div>