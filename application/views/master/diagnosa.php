		<script type="text/javascript">
			$(document).ready(function()
			{
                                $('#diagnosaimpor').dialog({
                                        autoOpen:false,
                                        title:"Import Data Diagnosa",
                                        resizable:false,
                                        width:350,
                                        height:150,
                                        show: 'drop',
                                        hide: 'scale',
                                        modal:true
                                        }
                                        );
                                var jen_penyakit= $.ajax({
                                    mtype:"GET",
                                    async:false,
                                    url:"<?php echo base_url() ?>index.php/master/diagnosa/jen_penyakit",
                                    dataType:'json'
                                    }).responseText;
                                var kel_penyakit= $.ajax({
                                    mtype:"GET",
                                    async:false,
                                    url:"<?php echo base_url() ?>index.php/master/diagnosa/kel_penyakit",
                                    dataType:'json'
                                    }).responseText;

				var grid = $("#listdiagnosa");
				grid.jqGrid({
					url: '<?php echo base_url() ?>index.php/master/diagnosa/json', //URL Tujuan Yg Mengenerate data Json nya
					datatype: "json", //Datatype yg di gunakan
					height: "auto", //Mengset Tinggi table jadi Auto menyesuaikan dengan isi table
					mtype: "GET",
					colNames: ['Id','Nama Penyakit','Jenis Penyakit','Kolompok Penyakit'],
					colModel: [
						{name:'id_diagnosa', key:true, index:'id_diagnosa', hidden:true,editable:false,editrules:{required:true}},//name untuk variabel post yang dikirim saat menambah data
						{name:'nama_diagnosa',index:'nama_diagnosa',width:350,editable:true,editrules:{required:true}},//index untuk variabel yang digunakan saat pencarian
						{name:'jenis_penyakit',index:'jenis_penyakit',width:200,align:'center',editable:true,edittype:"select",editoptions:{value:jen_penyakit},editrules:{required:true}},
						{name:'kelompok_penyakit',index:'kelompok_penyakit',width:200,align:'center',editable:true,edittype:"select",editoptions:{value:kel_penyakit},editrules:{required:true}},

					],
					rownumbers:true,
					rowNum: 10,
					rowList: [10,20,30],
					pager: '#pagerdiagnosa',
					sortname: 'id_diagnosa',
					viewrecords: true,
					sortorder: "desc",
					editurl: '<?php echo base_url() ?>index.php/master/diagnosa/crud', //URL Proses CRUD Nya
					multiselect: false, 
					caption: "Data Diagnosa" //Caption List					
				});
				grid.jqGrid('navGrid','#pagerdiagnosa',{view:true,edit:true,add:true,del:true},{},{},{},{closeOnEscape:true,closeAfterSearch:false,multipleSearch:false, multipleGroup:false, showQuery:false,drag:true,showOnLoad:false,sopt:['cn'],resize:false,caption:'Cari Record', Find:'Cari', Reset:'Batalkan Pencarian'});				
				jQuery("#listdiagnosa")
                                .jqGrid('navButtonAdd','#pagerdiagnosa',{caption:"Excel",buttonicon:"ui-icon-print",
                                onClickButton:function()
                                {
                                   window.location.href="<?php echo base_url() ?>index.php/master/diagnosa/ekspor";

				//alert("BERHASIL ayo SEMANGAT kalahkan skripsi");
				}
				})
                                .jqGrid('navButtonAdd','#pagerdiagnosa',{caption:"Impor",buttonicon:"ui-icon-folder-open",
                                onClickButton:function()
                                {
                                //alert('impor');
				$('#diagnosaimpor').load("<?php echo base_url() ?>index.php/master/diagnosa/impor");
				$('#diagnosaimpor').dialog('open');
                                return false;
                                }
				});
			});
		</script>
<div id="master_diagnosa" style="width: auto; height: auto;overflow: auto">
		<table id="listdiagnosa" class="scroll" cellpadding="0" cellspacing="0"></table>
		<div id="pagerdiagnosa" class="scroll" style="text-align:center;"></div>
		<div id="diagnosaimpor"></div>
        <div id="diagnosaekspor"></div>
        </div>