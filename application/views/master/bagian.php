		<script type="text/javascript">
			$(document).ready(function()
			{
                                $('#bagianimpor').dialog({
                                        autoOpen:false,
                                        title:"Import Data Bagian Karyawan",
                                        resizable:false,
                                        width:350,
                                        height:150,
                                        show: 'drop',
                                        hide: 'scale',
                                        modal:true
                                        }
                                        );

				var grid = $("#listbagian");
				grid.jqGrid({
					url: '<?php echo base_url() ?>index.php/master/bagian/json', //URL Tujuan Yg Mengenerate data Json nya
					datatype: "json", //Datatype yg di gunakan
					height: "auto", //Mengset Tinggi table jadi Auto menyesuaikan dengan isi table
					mtype: "GET",
					colNames: ['Id','Nama Bagian'],
					colModel: [
						{name:'id_bagian', key:true, index:'id_bagian', hidden:true,editable:false,editrules:{required:true}},//name untuk variabel post yang dikirim saat menambah data
						{name:'nama_bagian',index:'nama_bagian',width:320,editable:true,editrules:{required:true}},//index untuk variabel yang digunakan saat pencarian
					],
					rownumbers:true,
					rowNum: 10,
					rowList: [10,20,30],
					pager: '#pagerbagian',
					sortname: 'id_bagian',
					viewrecords: true,
					sortorder: "desc",
					editurl: '<?php echo base_url() ?>index.php/master/bagian/crud', //URL Proses CRUD Nya
					multiselect: false, 
					caption: "Data bagian" //Caption List					
				});
				grid.jqGrid('navGrid','#pagerbagian',{view:true,edit:true,add:true,del:true},{},{},{},{closeOnEscape:true,closeAfterSearch:false,multipleSearch:false, multipleGroup:false, showQuery:false,drag:true,showOnLoad:false,sopt:['cn'],resize:false,caption:'Cari Record', Find:'Cari', Reset:'Batalkan Pencarian'});				
                                jQuery("#listbagian")
                                .jqGrid('navButtonAdd','#pagerbagian',{caption:"excel",buttonicon:"ui-icon-print",
                                onClickButton:function()
                                {
                                    window.location.href="<?php echo base_url() ?>index.php/master/bagian/ekspor";
				//alert("BERHASIL ayo SEMANGAT kalahkan skripsi");
				}
				})
//                                .jqGrid('navButtonAdd','#pagerbagian',{caption:"Impor",buttonicon:"ui-icon-folder-open",
//                                onClickButton:function()
//                                {
//				//$("#apotekimpor").load("<?php echo base_url() ?>index.php/master/apotek/impor");
//				$('#bagianimpor').load("<?php echo base_url() ?>index.php/master/bagian/impor");
//				$('#bagianimpor').dialog('open');
//                                return false;
//                                }
//				})
                                ;
                        });
		</script>
<div id="master_bagian" style="width: auto; height: auto;overflow: auto">
		<table id="listbagian" class="scroll" cellpadding="0" cellspacing="0"></table>
		<div id="pagerbagian" class="scroll" style="text-align:center;"></div>
                <div id="bagianimpor"></div>
        </div>