<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>JQGrid CodeIgniter</title>
                <!-- Mengincludekan JQueryUI CSS. Rename nama sunny dan sesuaikan Folder yg ada di dalam Folder CSS -->
		<!--<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url() ?>css/sunny/jquery-ui-1.8.16.custom.css" />
                -->
                <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url() ?>tedd/css/sunny/jquery-ui-1.8.16.custom.css" />
                <!-- Mengincludekan CSS Jqgrid -->
		<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url() ?>tedd/css/ui.jqgrid.css" />

		<!--<style>
		html, body {
			margin: 0;
			padding: 0;
			font-size: 75%;
		}
		</style>-->

                <!-- Mengincludekan Library Jquery -->
		<script src="<?php echo base_url() ?>tedd/js/jquery-1.7.2.min.js" type="text/javascript"></script>
                <!-- Mengincludekan Locale untuk JQGrid -->
		<script src="<?php echo base_url() ?>tedd/js/i18n/grid.locale-en.js" type="text/javascript"></script>
                <!-- Mengincludekan Library untuk JQGrid -->
		<script src="<?php echo base_url() ?>tedd/js/jquery.jqGrid.min.js" type="text/javascript"></script>

		<script type="text/javascript">
			$(document).ready(function()
                        {
				var grid = $("#list2");
				grid.jqGrid({
					url: '<?php echo base_url() ?>index.php/welcome/json', //URL Tujuan Yg Mengenerate data Json nya
					datatype: "json", //Datatype yg di gunakan
					height: "auto", //Mengset Tinggi table jadi Auto menyesuaikan dengan isi table
					mtype: "GET",
					colNames: ['id','Nama','Pengarang','Tahun Terbit','Penerbit'],
					colModel: [
						{name:'id', key:true, index:'id', hidden:true,editable:false,frozen:true,editrules:{required:true}},
						{name:'nama',index:'nama',editable:true,frozen:true,editrules:{required:true}},
						{name:'pengarang',index:'pengarang',frozen:true,editable:true,editrules:{required:true}},
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
					caption: "Bismillah", //Caption List
                                        shrinkToFit: false,
                                        rownumbers: true
				});
                                jQuery("#list2").jqGrid('setGroupHeaders',
                                        { useColSpanStyle: false,
                                            groupHeaders:
                                                [ {startColumnName: 'id',
                                                    numberOfColumns: 3,
                                                    titleText: 'Client Details'}
                                            ] });
                                jQuery("##list2").jqGrid('setFrozenColumns');
				grid.jqGrid('navGrid','#pager2',{view:true,edit:true,add:true,del:true},{},{},{},{closeOnEscape:true,closeAfterSearch:false,multipleSearch:false, multipleGroup:false, showQuery:false,drag:true,showOnLoad:false,sopt:['cn'],resize:false,caption:'Cari Record', Find:'Cari', Reset:'Batalkan Pencarian'});
			});
		</script>
	</head>
	<body>
		<table id="list2" class="scroll" cellpadding="0" cellspacing="0"></table>
		<div id="pager2" class="scroll" style="text-align:center;"></div>
	</body>
</html>