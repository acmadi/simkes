		<script type="text/javascript">
			$(document).ready(function()
			{       $('#formkaryawan').dialog({
                                        autoOpen:false,
                                        title:"Add Data Karyawan",
                                        resizable:false,
                                        width:350,
                                        height:400,
                                        show: 'drop',
                                        hide: 'scale',
                                        modal:true
                                        }
                                        );
                                $('#karyawanimpor').dialog({
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
                                //var rayon = "1:bismillah;2:alhamdulillah";
                                var rayon_karyawan = $.ajax({
                                    url : '<?php echo base_url() ?>index.php/master/karyawan/rayon',
                                    type : 'POST',
                                    async : false,
                                    dataType : 'json'
                                }).responseText;
                                var bagian_karyawan = $.ajax({
                                    url : '<?php echo base_url() ?>index.php/master/karyawan/bagian',
                                    type : 'POST',
                                    async : false,
                                    dataType : 'json'
                                }).responseText;
                                var status_karyawan = $.ajax({
                                    url : '<?php echo base_url() ?>index.php/master/karyawan/status',
                                    type : 'POST',
                                    async : false,
                                    dataType : 'json'
                                }).responseText;

                                $( "#tgl_lahir" ).datepicker({
                                //dateFormat  : "dd MM yy",
                                changeMonth: true,
                                changeYear: true,
                                showOn: "button",
                                buttonImage : "<?php echo base_url();?>asset/images/calendar.gif",
                                buttonImageOnly : true
                                });

				var grid = $("#listkaryawan");
				grid.jqGrid({
					url: '<?php echo base_url() ?>index.php/master/karyawan/json', //URL Tujuan Yg Mengenerate data Json nya
					datatype: "json", //Datatype yg di gunakan
					height: "auto", //Mengset Tinggi table jadi Auto menyesuaikan dengan isi table
					mtype: "GET",
					colNames: ['id','NIP','Nama karyawan','Rayon','Bagian','Alamat','Sex','Telepon','Tgl Lahir','A/P','Status','Kelas'],
					colModel: [
						{name:'id_karyawan', key:true, index:'id_karyawan', hidden:true,editable:false,editrules:{required:true}},//name untuk variabel post yang dikirim saat menambah data
						{name:'nip_karyawan',index:'nip',width:150,editable:true,editrules:{required:true}},//index untuk variabel yang digunakan saat pencarian
						{name:'nama_karyawan',index:'nama_karyawan',width:50,editable:true,editrules:{required:true}},//index untuk variabel yang digunakan saat pencarian
						{name:'rayon_karyawan',index:'nama_rayon',width:100,editable:true,edittype:"select",editoptions:{value:rayon_karyawan},editrules:{required:false}},
						{name:'bagian_karyawan',index:'nama_bagian',width:100,editable:true,edittype:"select",editoptions:{value:bagian_karyawan},editrules:{required:false}},
						{name:'alamat_karyawan',index:'alamat',width:50,editable:true,editrules:{required:false}},
						{name:'sex_karyawan',index:'sex',width:50,editable:true,edittype:"select",editoptions:{value:'l:Laki-laki;p:Perempuan'},editrules:{required:false}},
						{name:'telp_karyawan',index:'telp',width:50,editable:true,editrules:{required:false},
                                                 editoption:{
                                                 maxlength:15,
                                                 dataInit:function(element)
                                                          {
                                                              $(element).keyup(function(){
                                                              var val1 = element.value;
                                                              var num = new Number(val1);
                                                              if(isNan(num))
                                                                  {
                                                                      alert("No Telp harus Angka");
                                                                  }
                                                              })
                                                          }
                                                 }},
						{name:'tgl_lahir_karyawan',index:'tgl_lahir',width:100,editable:true,editrules:{required:false}},
						{name:'ap_karyawan',index:'ap',width:50,editable:true,edittype:"select",editoptions:{value:'a:aktif;p:pensiun'},editrules:{required:false}},
						{name:'status_karyawan',index:'nama_status',width:50,editable:true,edittype:"select",editoptions:{value:status_karyawan},editrules:{required:false}},
						{name:'kelas_kamar_karyawan',index:'kelas_kamar',width:50,editable:true,edittype:"select",editoptions:{value:'1:1;2:2;3:3'},editrules:{required:false}},
					],
					rownumbers:true,
					rowNum: 10,
					rowList: [10,20,30],
					pager: '#pagerkaryawan',
					sortname: 'id_karyawan',
					viewrecords: true,
					sortorder: "desc",
					editurl: '<?php echo base_url() ?>index.php/master/karyawan/crud', //URL Proses CRUD Nya
					multiselect: false, 
					caption: "Data karyawan" //Caption List					
				});
				grid.jqGrid('navGrid',
                                            '#pagerkaryawan',
                                            {view:true,edit:true,add:true,del:true},
                                            {
                                                afterShowForm:function()
                                                {
                                                    $( "#tgl_lahir_karyawan" ).datepicker({
                                                    //dateFormat  : "dd MM yy",
                                                    changeMonth: true,
                                                    changeYear: true,
                                                    showOn: "button",
                                                    buttonImage : "<?php echo base_url();?>asset/images/calendar.gif",
                                                    buttonImageOnly : true
                                                    });
                                                }
                                            },
                                            {
                                            afterShowForm:function()
                                                {
                                                    $( "#tgl_lahir_karyawan" ).datepicker({
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
                                            {
                                                closeOnEscape:true,
                                                closeAfterSearch:false,
                                                multipleSearch:false,
                                                multipleGroup:false,
                                                showQuery:false,
                                                drag:true,
                                                showOnLoad:false,
                                                sopt:['cn'],
                                                resize:false,
                                                caption:'Cari Record',
                                                Find:'Cari',
                                                  Reset:'Batalkan Pencarian'
                                                  
                                            }
                                            );
				grid
                                .jqGrid('navButtonAdd','#pagerkaryawan',{caption:"Excel",buttonicon:"ui-icon-print",
                                onClickButton:function()
                                {
                                    window.location.href="<?php echo base_url() ?>index.php/master/karyawan/ekspor";
				//alert("BERHASIL ayo SEMANGAT kalahkan skripsi");
				}
				})
                                .jqGrid('navButtonAdd','#pagerkaryawan',{caption:"Impor",buttonicon:"ui-icon-folder-open",
                                onClickButton:function()
                                {
				//$("#apotekimpor").load("<?php echo base_url() ?>index.php/master/apotek/impor");
				$('#karyawanimpor').load("<?php echo base_url() ?>index.php/master/karyawan/impor");
				$('#karyawanimpor').dialog('open');
                                return false;
                                }
				})
                                ;
			});
		</script>
<div id="master_karyawan" style="width: auto; height: auto;overflow: auto">
		<table id="listkaryawan" class="scroll" cellpadding="0" cellspacing="0"></table>
		<div id="pagerkaryawan" class="scroll" style="text-align:center;"></div>
		<div id="formkaryawan"></div>
		<div id="karyawanimpor"></div>
	</div>