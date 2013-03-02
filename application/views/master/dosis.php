		<script type="text/javascript">
			$(document).ready(function()
			{
                                $('#dosisimpor').dialog({
                                        autoOpen:false,
                                        title:"Import Data Dosis",
                                        resizable:false,
                                        width:350,
                                        height:150,
                                        show: 'drop',
                                        hide: 'scale',
                                        modal:true
                                        }
                                        );
                                            
				var grid = $("#listdosis");
				grid.jqGrid({
					url: '<?php echo base_url() ?>index.php/master/dosis/json', //URL Tujuan Yg Mengenerate data Json nya
					datatype: "json", //Datatype yg di gunakan
					height: "auto", //Mengset Tinggi table jadi Auto menyesuaikan dengan isi table
					mtype: "GET",
					colNames: ['Id','Nama Dosis','Jumlah'],
					colModel: [
						{name:'id_dosis', key:true, index:'id_dosis', hidden:true,editable:false,editrules:{required:true}},//name untuk variabel post yang dikirim saat menambah data
						{name:'nama_dosis',index:'nama_dosis',width:350,editable:true,editrules:{required:true}},//index untuk variabel yang digunakan saat pencarian
						{name:'jml_dosis',index:'jml_dosis',width:300,editable:true},
					],
					rownumbers:true,
					rowNum: 10,
					rowList: [10,20,30],
					pager: '#pagerdosis',
					sortname: 'id_dosis',
					viewrecords: true,
					sortorder: "desc",
					editurl: '<?php echo base_url() ?>index.php/master/dosis/crud', //URL Proses CRUD Nya
					multiselect: false, 
					caption: "Data dosis" //Caption List					
				});
				grid.jqGrid('navGrid','#pagerdosis',{view:true,edit:true,add:true,del:true},{},{},{},{closeOnEscape:true,closeAfterSearch:false,multipleSearch:false, multipleGroup:false, showQuery:false,drag:true,showOnLoad:false,sopt:['cn'],resize:false,caption:'Cari Record', Find:'Cari', Reset:'Batalkan Pencarian'});				
				jQuery("#listdosis")
                                .jqGrid('navButtonAdd','#pagerdosis',{caption:"Excel",buttonicon:"ui-icon-print",
                                onClickButton:function()
                                {

                                     window.location.href="<?php echo base_url() ?>index.php/master/dosis/ekspor";
				//alert("BERHASIL ayo SEMANGAT kalahkan skripsi");
				}
				})
                                .jqGrid('navButtonAdd','#pagerdosis',{caption:"Impor",buttonicon:"ui-icon-folder-open",
                                onClickButton:function()
                                {
                                //alert('impor');
				$("#dosisimpor").load("<?php echo base_url() ?>index.php/master/dosis/impor");
                                $('#dosisimpor').dialog('open');
				return false;
                                }
				});
			});
		</script>
<div id="master_dosis" style="width: auto; height: auto;overflow: auto">

		<table id="listdosis" class="scroll" cellpadding="0" cellspacing="0"></table>
		<div id="pagerdosis" class="scroll" style="text-align:center;"></div>
		<div id="dosisimpor"></div>
        <div id="dosisekspor"></div>
</div>