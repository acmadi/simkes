		<script type="text/javascript">
			$(document).ready(function()
			{       $('#labimpor').dialog({
                                        autoOpen:false,
                                        title:"Import Data Lab",
                                        resizable:false,
                                        width:350,
                                        height:150,
                                        show: 'drop',
                                        hide: 'scale',
                                        modal:true
                                        }
                                        );

				var grid = $("#listlab");
				grid.jqGrid({
					url: '<?php echo base_url() ?>index.php/master/lab/json', //URL Tujuan Yg Mengenerate data Json nya
					datatype: "json", //Datatype yg di gunakan
					height: "auto", //Mengset Tinggi table jadi Auto menyesuaikan dengan isi table
					mtype: "GET",
					colNames: ['Id','Nama Lab','Alamat','Langganan','Email','Fax','Telp'],
					colModel: [
						{name:'id_provider', key:true, index:'id_provider', hidden:true,editable:false,editrules:{required:true}},//name untuk variabel post yang dikirim saat menambah data
						{name:'nama_provider',index:'nama_provider',width:150,editable:true,editrules:{required:true}},//index untuk variabel yang digunakan saat pencarian
						{name:'almt_provider',index:'almt_provider',width:150,editable:true},
						{name:'langg_provider',index:'langg_provider', width:90, editable: true,edittype:"checkbox",editoptions: {value:"y:n"}},
						{name:'email_provider',index:'email_provider',width:150,align:'center',editable:true},
						{name:'fax_provider',index:'fax_provider',width:150,align:'center',editable:true},
                        {name:'tlp_provider',index:'tlp_provider',width:150,align:'center',editable:true}
					],
					rownumbers:true,
					rowNum: 10,
					rowList: [10,20,30],
					pager: '#pagerlab',
					sortname: 'id_provider',
					viewrecords: true,
					sortorder: "desc",
					editurl: '<?php echo base_url() ?>index.php/master/lab/crud', //URL Proses CRUD Nya
					multiselect: false, 
					caption: "Data Laboratorium" //Caption List					
				});
				grid.jqGrid('navGrid','#pagerlab',{view:true,edit:true,add:true,del:true},{},{},{},{closeOnEscape:true,closeAfterSearch:false,multipleSearch:false, multipleGroup:false, showQuery:false,drag:true,showOnLoad:false,sopt:['cn'],resize:false,caption:'Cari Record', Find:'Cari', Reset:'Batalkan Pencarian'});				
                                jQuery("#listlab")
                                .jqGrid('navButtonAdd','#pagerlab',{caption:"Excel",buttonicon:"ui-icon-print",
                                onClickButton:function()
                                {
                                     window.location.href="<?php echo base_url() ?>index.php/master/lab/ekspor";

				//alert("BERHASIL ayo SEMANGAT kalahkan skripsi");
				}
				})
                                .jqGrid('navButtonAdd','#pagerlab',{caption:"Impor",buttonicon:"ui-icon-folder-open",
                                onClickButton:function()
                                {
                                //alert('impor');
				$("#labimpor").load("<?php echo base_url() ?>index.php/master/lab/impor");
				$('#labimpor').dialog('open');
                                return false;
                                }
				});
                        });
		</script>
<div id="master_lab" style="width: auto; height: auto;overflow: auto">
		<table id="listlab" class="scroll" cellpadding="0" cellspacing="0"></table>
		<div id="pagerlab" class="scroll" style="text-align:center;"></div>
                <div id="labimpor"></div>
                <div id="labekspor"></div>
        </div>