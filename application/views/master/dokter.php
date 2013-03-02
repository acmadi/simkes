		<script type="text/javascript">
                    var gol_dokter= $.ajax({
                                    mtype:"GET",
                                    async:false,

                                    url:"<?php echo base_url() ?>index.php/master/dokter/gol_dokter",
                                    dataType:'json'
                                    }).responseText;
			$(document).ready(function()
			{       $('#dokterimpor').dialog({
                                        autoOpen:false,
                                        title:"Import Data Dokter",
                                        resizable:false,
                                        width:350,
                                        height:150,
                                        show: 'drop',
                                        hide: 'scale',
                                        modal:true
                                        }
                                        );


                                



				var grid = $("#listdokter");
				grid.jqGrid({
					url: '<?php echo base_url() ?>index.php/master/dokter/json', //URL Tujuan Yg Mengenerate data Json nya
					datatype: "json", //Datatype yg di gunakan
					height: "auto", //Mengset Tinggi table jadi Auto menyesuaikan dengan isi table
					mtype: "GET",
					colNames: ['Id','Nama Dokter','Langganan','Kategori','Golongan','Tarif','Kelas'],
					colModel: [
						{name:'id_dokter', key:true, index:'id_dokter', hidden:true,editable:false,editrules:{required:true}},//name untuk variabel post yang dikirim saat menambah data
						{name:'nama_dokter',index:'nama_dokter',width:150,editable:true,editrules:{required:true}},//index untuk variabel yang digunakan saat pencarian
						{name:'langg_dokter',index:'langg_dokter', width:90, editable: true,edittype:"checkbox",editoptions: {value:"y:n"}},
						{name:'kat_dokter',index:'kat_nama',width:200,align:'center',editable:true,edittype:"select",editoptions:{value:{1:'DAK',2:'Dokter Spesialis',3:'Rumah Sakit',4:'Laboratorium',5:'Dokter Umum',6:'Lainnya',7:'Gigi'}},editrules:{required:false}},
						{name:'gol_dokter',index:'gol_nama',width:200,align:'center',editable:true,edittype:"select",editoptions:{value:gol_dokter},editrules:{required:false}},
                                                {name:'tarif_dokter',index:'tarif_dokter',width:140,align:'center',editable:true,editrules:{required:false}},
                                                {name:'kelas_dokter',index:'kelas_dokter',width:140,align:'center',editable:true,editrules:{required:false}},
					],
					rownumbers:true,
					rowNum: 10,
					rowList: [10,20,30],
					pager: '#pagerdokter',
					sortname: 'id_dokter',
					viewrecords: true,
					sortorder: "desc",
					editurl: '<?php echo base_url() ?>index.php/master/dokter/crud', //URL Proses CRUD Nya
//					
                                        multiselect: false,
					caption: "Data dokter" //Caption List					
				});
				grid.jqGrid('navGrid','#pagerdokter',{view:true,edit:true,add:true,del:true},{},{},{},{closeOnEscape:true,closeAfterSearch:false,multipleSearch:false, multipleGroup:false, showQuery:false,drag:true,showOnLoad:false,sopt:['cn'],resize:false,caption:'Cari Record', Find:'Cari', Reset:'Batalkan Pencarian'});				
                                jQuery("#listdokter")
                                .jqGrid('navButtonAdd','#pagerdokter',{caption:"Excel",buttonicon:"ui-icon-print",
                                onClickButton:function()
                                {

                                     window.location.href="<?php echo base_url() ?>index.php/master/dokter/ekspor";
				//alert("BERHASIL ayo SEMANGAT kalahkan skripsi");
				}
				})
                                .jqGrid('navButtonAdd','#pagerdokter',{caption:"Impor",buttonicon:"ui-icon-folder-open",
                                onClickButton:function()
                                {
                                //alert('impor');
				$("#dokterimpor").load("<?php echo base_url() ?>index.php/master/dokter/impor");
                                $('#dokterimpor').dialog('open');
				return false;
                                }
				});
                        });
		</script>
<div id="master_dokter" style="width: auto; height: auto;overflow: auto">
		<table id="listdokter" class="scroll" cellpadding="0" cellspacing="0"></table>
		<div id="pagerdokter" class="scroll" style="text-align:center;"></div>
                <div id="dokterimpor"></div>
                <div id="dokterekspor"></div>
        </div>