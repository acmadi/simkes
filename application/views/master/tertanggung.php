<script type="text/javascript">
			$(document).ready(function()
			{       $('#formtertanggung').dialog({
                                        autoOpen:false,
                                        title:"",
                                        resizable:false,
                                        width:350,
                                        show: 'drop',
                                        hide: 'scale',
                                        modal:true
                                        }
                                        );
                                $('#tertanggungimpor').dialog({
                                        autoOpen:false,
                                        title:"Import Data Tertanggung",
                                        resizable:false,
                                        show: 'drop',
                                        hide: 'scale',
                                        modal:true
                                        }
                                        );
                                var karyawan_tertanggung = $.ajax({
                                    url : '<?php echo base_url() ?>index.php/master/tertanggung/karyawan',
                                    type : 'POST',
                                    async : false,
                                    dataType : 'json'
                                }).responseText;
				var grid = $("#listtertanggung");
				grid.jqGrid({
					url: '<?php echo base_url() ?>index.php/master/tertanggung/json', //URL Tujuan Yg Mengenerate data Json nya
					datatype: "json", //Datatype yg di gunakan
					height: "auto", //Mengset Tinggi table jadi Auto menyesuaikan dengan isi table
					mtype: "GET",
					colNames: ['Id','Nama Tertanggung','Sex','Tgl Lahir','Status','Usia','Penanggung','Ditanggung'],
					colModel: [
						{name:'id_tertanggung', key:true, index:'id_tertanggung', hidden:true,editable:false,editrules:{required:true}},//name untuk variabel post yang dikirim saat menambah data
						{name:'nama_tertanggung',index:'nama_tertanggung',width:350,editable:true,editrules:{required:true}},//index untuk variabel yang digunakan saat pencarian
						{name:'sex_tertanggung',index:'sex',width:150,editable:true,edittype:"select",editoptions:{value:"l:laki;p:perempuan"},editrules:{required:false}},
						{name:'tgl_lahir_tertanggung',index:'tgl_lahir',width:150,editable:true,editrules:{required:false}},
						{name:'status_tertanggung',index:'status',width:150,editable:true,edittype:"select",editoptions:{value:"ybs:ybs;istri:istri;anak:anak"},editrules:{required:false}},
						{name:'usia_tertanggung',index:'usia',width:150,editable:true,editrules:{required:false}},
						{name:'penanggung_tertanggung',index:'nama_karyawan',width:150,editable:true,edittype:"select",editoptions:{value:karyawan_tertanggung},editrules:{required:false}},
						{name:'ditanggung_tertanggung',index:'ditanggung',width:150,editable:true,edittype:"select",editoptions:{value:"y:ya;t:tidak"},editrules:{required:false}},
					],
					rownumbers:true,
					rowNum: 10,
					rowList: [10,20,30],
					pager: '#pagertertanggung',
					sortname: 'id_tertanggung',
					viewrecords: true,
					sortorder: "desc",
					editurl: '<?php echo base_url() ?>index.php/master/tertanggung/crud', //URL Proses CRUD Nya
					multiselect: false,
					caption: "Data tertanggung" //Caption List
				});

				grid.jqGrid('navGrid','#pagertertanggung',
                                            {view:true,edit:true,add:false,del:true},
                                            {
                                                 afterShowForm:function()
                                                {
                                                    $( "#tgl_lahir_tertanggung" ).datepicker({
                                                    //dateFormat  : "dd MM yy",
                                                    changeMonth: true,
                                                    changeYear: true,
                                                    showOn: "button",
                                                    buttonImage : "<?php echo base_url();?>asset/images/calendar.gif",
                                                    buttonImageOnly : true
                                                    });
                                                    $("#usia_tertanggung").autocomplete({
                                                    minLength: 1,
                                                    source:
                                                    function(requ, add){
                                                    $.ajax({
                                                    url: "<?php echo base_url(); ?>index.php/transaksi/apotek/lookpegawai",
                                                    dataType: 'json',
                                                    type: 'POST',
                                                    data: requ
                                                    });}
                                                 });
                                                }
                                            },
                                            {
                                                 afterShowForm:function()
                                                {
                                                    $( "#tgl_lahir_tertanggung" ).datepicker({
                                                    //dateFormat  : "dd MM yy",
                                                    changeMonth: true,
                                                    changeYear: true,
                                                    showOn: "button",
                                                    buttonImage : "<?php echo base_url();?>asset/images/calendar.gif",
                                                    buttonImageOnly : true
                                                    });
                                                }
                                            },
                                            {},
                                            {closeOnEscape:true,closeAfterSearch:false,multipleSearch:false, multipleGroup:false, showQuery:false,drag:true,showOnLoad:false,sopt:['cn'],resize:false,caption:'Cari Record', Find:'Cari', Reset:'Batalkan Pencarian'});
				jQuery("#listtertanggung")
                                .jqGrid('navButtonAdd','#pagertertanggung',{caption:"",buttonicon:"ui-icon-plus",
                                
				onClickButton:function()
				{
				//alert("BERHASIL ayo SEMANGAT kalahkan skripsi");
				//$('#formInput').html('<img src="loading.gif">').load(page);
				$('#formtertanggung').load("<?php echo base_url();?>index.php/master/tertanggung/add");
				$('#formtertanggung').dialog('open');
				return false;
				}
				})
                                .jqGrid('navButtonAdd','#pagertertanggung',{caption:"Excel",buttonicon:"ui-icon-print",
                                onClickButton:function()
                                {
                                    window.location.href="<?php echo base_url() ?>index.php/master/tertanggung/ekspor";
				//alert("BERHASIL ayo SEMANGAT kalahkan skripsi");
				}
				})
                                .jqGrid('navButtonAdd','#pagertertanggung',{caption:"Impor",buttonicon:"ui-icon-folder-open",
                                onClickButton:function()
                                {
				//$("#apotekimpor").load("<?php echo base_url() ?>index.php/master/apotek/impor");
				$('#tertanggungimpor').load("<?php echo base_url() ?>index.php/master/tertanggung/impor");
				$('#tertanggungimpor').dialog('open');
                                return false;
                                }
				})
                                ;



			});
		</script>
	<div id="master_tertanggung" style="width: auto; height: auto;overflow: auto">
		<table id="listtertanggung" class="scroll" cellpadding="0" cellspacing="0"></table>
		<div id="pagertertanggung" class="scroll" style="text-align:center;"></div>
		<div id="formtertanggung"></div>
		<div id="tertanggungimpor"></div>
	</div>