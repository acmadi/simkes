<script type="text/javascript" >	 
$(this).ready( function() {
	var data_rs;        
        var id_kunjungan,
            id_karyawan,
            id_dokter,
            id_provider,
            id_item,
            id_doses,
            id_diagnosa,
            id_rekom,
            id_dokterov,
            id_rekomov;
        $("#nip_rs").attr('disabled','disabled');
	$("#bagian_rs").attr('disabled','disabled');
        $("#selisih_rs").attr('disabled','disabled');
        $("#total_rs").attr('disabled','disabled');
        $("#selisih_trans_rs").attr('disabled','disabled');
        $("#totalov_rs").attr('disabled','disabled');
        
        $(".button_rs").button();
        $(".button_diag_rs").button();
        $(".button_trans_rs").button();
        $(".button_ov_rs").button();
        
        $( "#tgl_trans_rs" ).datepicker({
            changeMonth: true,
            changeYear: true,
            showOn: "button",
            buttonImage : "<?php echo base_url();?>asset/images/calendar.gif",				
            buttonImageOnly : true
	});
        
        $( "#tgl_keluar_rs" ).datepicker({
            changeMonth: true,
            changeYear: true,
            showOn: "button",
            buttonImage : "<?php echo base_url();?>asset/images/calendar.gif",				
            buttonImageOnly : true
	});
        
        $( "#tgl_resep_rs" ).datepicker({
            changeMonth: true,
            changeYear: true,
            showOn: "button",
            buttonImage : "<?php echo base_url();?>asset/images/calendar.gif",				
            buttonImageOnly : true
	});
        
	$( "#tgl_kun_rs" ).datepicker({
            changeMonth     : true, // menampilkan dropdown untuk ganti bulan
            changeYear      : true, // menampilkan dropdown untuk ganti Tahun
            showOn          : "button",
            buttonImage     : "<?php echo base_url();?>asset/images/calendar.gif",				
            buttonImageOnly : true
	});	

        $("#pegawai_rs").autocomplete({
            minLength: 1,
            source:
            function(requ, add){
              $.ajax({
                  url: "<?php echo base_url(); ?>index.php/master/tertanggung/lookpegawai",
                dataType: 'json',
                type: 'POST',
                data: requ,
                success:
                    function(data){
                        if(data.response =="true"){
                            add(data.message);
                        }else if(data.response =="false") {
                            $('.ui-autocomplete-loading').removeClass("ui-autocomplete-loading");
                            id_karyawan=undefined;//$("#harga_standart_rs").val(""); 
                        }                         
                    }                    
              });
            },
            select:
                function(event, ui) {
                    var id_bag=ui.item.bagian,
                        nip=ui.item.nip;
                    $("#nip_rs").val(nip);
                    $("#id_bagian_rs").val(ui.item.id);
                    id_karyawan=nip;
                    bagian(id_bag);
                    pasien(ui.item.id);
                    tagihan();
                }
        });        
              
	function bagian(id_bag){
            $.ajax({
               url : "<?php echo base_url(); ?>index.php/transaksi/rs/bagian",
               data : "id="+id_bag,
               type: 'POST',
               success: function(data){
                   $("#bagian_rs").val(data);
               },
               error: function(e){
                   alert("error bagian : "+e)
               }
            });
        }
        
        function pasien(nip){
            $.ajax({
               url : "<?php echo base_url(); ?>index.php/transaksi/rs/pasien",
               data : "id="+nip,
               type: 'POST',
               success: function(data){
                   $('#pasien_rs').html(data);
               },
               error: function(e){
                   alert("error pasien : "+e)
               }
            });
        }
        
        $("#nama_tagihan_rs").autocomplete({
            minLength: 1,
            source:
            function(requ, add){
                var id_jenis=$('#jenis_tagihan_rs').val();
                var isi =$("#nama_tagihan_rs").val();
                if (id_jenis == '') {
                    alert('Jenis Tagihan Harus Dipilih');
                    $("#nama_tagihan_rs").val("");
                    $('.ui-autocomplete-loading').removeClass("ui-autocomplete-loading");
                    $('#jenis_tagihan_rs').focus();
                    return false;
                }
                
                $.ajax({
                    url: "<?php echo base_url(); ?>index.php/transaksi/rs/looktagihan",
                    data: "&term="+isi+"&id="+id_jenis,
                    //data: requ,
                    dataType: 'json',
                    type: 'POST',
                    success:
                        function(data){
                            if(data.response =="true"){
                                add(data.message);
                            } else if(data.response =="false") {
                                $('.ui-autocomplete-loading').removeClass("ui-autocomplete-loading");
                                id_item="undefined";
                                $("#harga_standart_rs").val(""); 
                            }                         
                        }                    
                });
            },
            select:
                function(event, ui) {
                    $("#harga_standart_rs").val(ui.item.harga); 
                    id_item=ui.item.id;
                }
        });
        
        $("#dokter_rs").autocomplete({
            minLength: 1,
            source:
            function(req, add){
                $.ajax({
                    url: "<?php echo base_url(); ?>index.php/transaksi/rs/lookdokter",
                    dataType: 'json',
                    type: 'POST',
                    data: req,
                    success:
                        function(data){
                            if(data.response =="true"){
                                add(data.message);
                            } else if(data.response =="false") {
                                $('.ui-autocomplete-loading').removeClass("ui-autocomplete-loading");
                                id_dokter="undefined";
                            }							
                        }          
                });
            },
            select:
                function(event, ui) {
                    id_dokter=ui.item.id;                    
                }
        });
        
        $("#rumah_sakit_rs").autocomplete({
            minLength: 1,
            source:
            function(req, add){
                $.ajax({
                    url: "<?php echo base_url(); ?>index.php/transaksi/rs/lookprovider",
                    dataType: 'json',
                    type: 'POST',
                    data: req,
                    success:
                        function(data){
                            if(data.response =="true"){
                                add(data.message);
                            } else if(data.response =="false") {
                                $('.ui-autocomplete-loading').removeClass("ui-autocomplete-loading");
                                id_provider="undefined";
                            }							
                        }          
                });
            },
            select:
                function(event, ui) {
                    id_provider=ui.item.id;                    
                }
        });        
                       
	function resetKunjungan(){
            $('#pegawai_rs').val("");
            $('#pasien_rs').val("");
            $('#rumah_sakit_rs').val("");
            $('#rawat_rs').val("");
            $('#nip_rs').val("");
            $('#tgl_trans_rs').val("");
            $('#tgl_keluar_rs').val("");
            $('#no_surat_rs').val("");
            $('#no_bukti_rs').val("");
            $('#bagian_rs').val("");
            $('#tgl_kun_rs').val("");
            $('#buku_besar_rs').val("");          
            $('#restitusi_rs').attr('checked', false);
        }
        
        $(".button_rs").click(function() {                                         
            if ($('#pegawai_rs').val() == '') {
                alert('Pegawai harus di isi');
                $('#pegawai_rs').focus();
                return false;
            }
            if (id_karyawan == undefined) {
                alert('Nama anda belum ada pada master karyawan');
                return false;
            }
            if ($('#buku_besar_rs').val() == '') {                
                alert('buku besar harus di isi');
                $('#buku_besar_rs').focus();
                return false;
            }
            
            var pegawai = $('#pegawai_rs').val(),
                pasien = $('#pasien_rs').val(),                
                rs = $('#rumah_sakit_rs').val(),
                rawat = $('#rawat_rs').val(),
                nip = $('#nip_rs').val(),
                tgl_trans = $('#tgl_trans_rs').val(),
                tgl_keluar = $('#tgl_keluar_rs').val(),
                no_surat = $('#no_surat_rs').val(),
                no_bukti = $('#no_bukti_rs').val(),
                tgl_kun = $('#tgl_kun_rs').val(),                
                buku_besar = $('#buku_besar_rs').val(),                
                restitusi;                
                if ($("#restitusi_rs").is(":checked")){
                    restitusi="y";
                } else {
                    restitusi="t";
                }                                             
                 
            data_rs = "&pegawai="+pegawai+"&pasien="+pasien+"&id_rs="+id_provider+"&rs="+rs+"&rawat="+rawat;
            data_rs = data_rs+"&nip="+nip+"&tgl_trans="+tgl_trans+"&tgl_keluar="+tgl_keluar+"&no_surat="+no_surat+"&no_bukti="+no_bukti;
            data_rs = data_rs+"&tgl_kun="+tgl_kun+"&buku_besar="+buku_besar+"&restitusi="+restitusi;            
            //alert(data_rs);
            
            $.ajax({
               url : "<?php echo base_url(); ?>index.php/transaksi/rs/simpandata",
               data : data_rs,
               type: 'get',
               success: function(data){
                   if (data!=null){
                      alert("Data tersimpan : "+data);
                      id_kunjungan=data;
                      resetKunjungan();
                      $('#list_diagnosa_rs').trigger('reloadGrid');
                      $('#list_transaksi_rs').trigger('reloadGrid');
                      $('#list_ov_rs').trigger('reloadGrid');
                   } else {
                       alert("gagal gan");
                   }                   
               },
               error: function(e){
                   alert("error : "+e)
               }
            }); 
            
            return false;
	});
        
        $("#diagnosa_rs").autocomplete({
            minLength: 1,
            source:
            function(req, add){
                $.ajax({
                    url: "<?php echo base_url(); ?>index.php/transaksi/rs/lookdiagnosa",
                    dataType: 'json',
                    type: 'POST',
                    data: req,
                    success:
                        function(data){
                            if(data.response =="true"){
                                add(data.message);
                            } else if(data.response =="false") {
                                $('.ui-autocomplete-loading').removeClass("ui-autocomplete-loading");
                                id_diagnosa=undefined;
                            }							
                        },
                    error: function(e){
                             alert("Error Diagnosa : "+e)
                        } 
                });
            },
                    select:
                        function(event, ui) {
                            id_diagnosa=ui.item.id;                    
                        }   
        });
        
        $(".button_diag_rs").click(function() {
            var diagnosa = $('#diagnosa_rs').val();            
            if (diagnosa == '') {
                alert('Diagnosa harus di isi');
                $('#diagnosa_rs').focus();
                return false;
            }
            if (id_kunjungan == undefined) {                
                alert('Isi Data Kunjungan dulu');
                //alert(diagnosa+":"+id_diagnosa);
                $('#pegawai_rs').focus();
                return false;
            }
            //alert(diagnosa+":"+id_diagnosa+":"+id_kunjungan);
            $.ajax({
               url : "<?php echo base_url(); ?>index.php/transaksi/rs/simpandiagnosa",
               data : "id="+id_kunjungan+"&diag="+diagnosa+"&id_diagnosa="+id_diagnosa,
               type: 'get',
               success: function(data){
                   if (data=="sukses"){
                       //resetDiagnosa();
                       $('#list_diagnosa_rs').trigger('reloadGrid');
                   } else {
                       alert("Gagal Menyimpan data");
                   } 
               },
               error: function(e){
                   alert("error pasien : "+e)
               }
            });
            $('#diagnosa_rs').val("");
            return false;
        });
        
        var grid = $("#list_diagnosa_rs");
    grid.jqGrid({
        url: '<?php echo base_url() ?>index.php/transaksi/rs/json', 
        datatype: "json", 
	height: "auto", 
	mtype: "GET",
	colNames: ['Id','Diagnosa','Act'],
	colModel: [
                    {name:'id_diagnosa', key:true,index:'id_diagnosa', hidden:true,editable:false,editrules:{required:true}},
                    //{name:'transaksi_id_transaksi', key:true, index:'transaksi_id_transaksi', hidden:true,editable:true,editrules:{required:true}},
                    {name:'nama_diagnosa',index:'nama_diagnosa',width:70,editable:true,editrules:{required:true}},
                    {name: 'myac', width:40, fixed:true, sortable:false, search:false, align:'center', viewable: false, resizable: false, resize:false, formatter:'actions',
                        formatoptions:{keys:true,editbutton:false, delbutton: true}
                    }
                    ],
        rownumbers:true,
	rowNum: 20,
	rowList: [10,20,30],
        postData: {idkunj : function(){
                        return id_kunjungan;
                  }},
        pager: '#pager_diagnosa_rs',
	sortname: 'id_transaksi_diagnosa',
	viewrecords: true,
        shrinkToFit: false,
	sortorder: "desc",
	editurl: '<?php echo base_url() ?>index.php/transaksi/rs/crud', //URL Proses CRUD Nya
	multiselect: false, 
	caption: "Hasil Diagnosa" //Caption List					
    });
    grid.jqGrid('navGrid','#pager_diagnosa_rs',{search:false,view:false,edit:false,add:false,del:true},{},{},{});
                        
  //kanggo transaksi      
        function tagihan(){
            $.ajax({
               url : "<?php echo base_url(); ?>index.php/transaksi/rs/tagihan",
               type: 'POST',
               success: function(data){
                   $('#jenis_tagihan_rs').html(data);
               },
               error: function(e){
                   alert("error rujukan : "+e)
               }
            });
        }
        
        $("#doses_rs").autocomplete({
            minLength: 1,
            source:
            function(req, add){
                $.ajax({
                    url: "<?php echo base_url(); ?>index.php/transaksi/rs/lookdosis",
                    dataType: 'json',
                    type: 'POST',
                    data: req,
                    success:
                        function(data){
                            if(data.response =="true"){
                                add(data.message);
                            } else if(data.response =="false"){
                                $('.ui-autocomplete-loading').removeClass("ui-autocomplete-loading");
                                id_doses=undefined;
                            }                            
                        },
                    error: function(e){
                        alert("error doses : "+e)
                    }  
                });
            },
                    select:
                    function(event, ui) {
                        id_doses=ui.item.id;
                    }  
        });
        
        $("#rekomendasi_rs").autocomplete({
            minLength: 1,
            source:
            function(req, add){
                $.ajax({
                    url: "<?php echo base_url(); ?>index.php/transaksi/rs/lookrekomendasi",
                    dataType: 'json',
                    type: 'POST',
                    data: req,
                    success:
                        function(data){
                            if(data.response =="true"){
                                add(data.message);
                            } else if(data.response =="false") {
                                $('.ui-autocomplete-loading').removeClass("ui-autocomplete-loading");
                                id_rekom="undefined";
                            }							
                        },
                    error: function(e){
                        alert("error rekomendasi : "+e)
                    }    
                });
            },
                    select:
                    function(event, ui) {
                        id_rekom=ui.item.id;                    
                    }  
        });
        
        function hitungSelisih(){
            var a=$('#harga_standart_rs').val();
            var b=$('#harga_satuan_rs').val();            
            var c=$('#jumlah_rs').val();
            
            $('#total_rs').val(b*c);
            $('#selisih_trans_rs').val(a*c-b*c);    
        }
        
        $('#harga_standart_rs').keyup(function(){
            hitungSelisih();
        });
        
        $('#harga_satuan_rs').keyup(function(){
            hitungSelisih();
        });
        
        $('#jumlah_rs').keyup(function(){
            hitungSelisih();       
        });
        
        function resetTransaksi(){
            $('#dokter_rs').val("");
            $('#jenis_tagihan_rs').val("");
            $('#nama_tagihan_rs').val("");
            $('#harga_standart_rs').val("");
            $('#harga_satuan_rs').val("");
            $('#jumlah_rs').val("");
            $('#total_rs').val("");
            $('#selisih_trans_rs').val("");
            $('#tgl_resep_rs').val("");
            $('#nilai_rs').val("");
            $('#disetujui_rs').val("");
            $('#doses_rs').val("");
            $('#kandungan_rs').val("");
            $('#rekomendasi_rs').val("");
        }
        
        $('#jenis_tagihan_rs').change(function(){
            $('#nama_tagihan_rs').val("");
            $('#harga_standart_rs').val("");
            id_item=undefined;
        });
        
        $(".button_trans_rs").click(function() {
            if ($('#nama_tagihan_rs').val() == '') {
                alert('Nama Tagihan harus di isi');
                $('#nama_tagihan_rs').focus();
                return false;
            }
            if (id_kunjungan == undefined) {                
                alert('Isi Data Kunjungan dulu');
                $('#pegawai_rs').focus();
                return false;
            }
            if ($('#doses_rs').val() == '') {
                alert('Doses harus di isi');
                $('#doses_rs').focus();
                return false;
            }
            var dokter = $('#dokter_rs').val(),
                jenis_tagihan = $('#jenis_tagihan_rs').val(),
                nama_tagihan = $('#nama_tagihan_rs').val(),
                harga_standart = $('#harga_standart_rs').val(),
                harga_satuan = $('#harga_satuan_rs').val(),
                jumlah = $('#jumlah_rs').val(),
                //total = $('#total_rs').val(),
                //selisih_transaksi = $('#selisih_trans_rs').val(),
                tgl_resep = $('#tgl_resep_rs').val(),
                nilai = $('#nilai_rs').val(),
                disetujui = $('#disetujui_rs').val(),
                doses = $('#doses_rs').val(),
                kandungan = $('#kandungan_rs').val(),
                rekomendasi = $('#rekomendasi_rs').val();
            var isi;             
            isi="&id_dokter="+id_dokter+"&dokter="+dokter+"&id_item="+id_item+"&jenis_tagihan="+jenis_tagihan
                +"&nama_tagihan="+nama_tagihan+"&id_transaksi="+id_kunjungan+"&harga_satuan="+harga_satuan+"&harga_standart="+harga_standart
                +"&jumlah="+jumlah+"&tgl_resep="+tgl_resep+"&nilai="+nilai+"&disetujui="+disetujui+"&id_dosis="+id_doses
                +"&dosis="+doses+"&kandungan="+kandungan+"&id_rekomendasi="+id_rekom+"&rekomendasi="+rekomendasi;
            //alert(isi);
            
            $.ajax({
               url : "<?php echo base_url(); ?>index.php/transaksi/rs/simpanitem",
               data : isi,
               type: 'get',
               success: function(data){
                   if (data!=null){
                      resetTransaksi();
                      $('#list_transaksi_rs').trigger('reloadGrid');
                   } else {
                       alert("gagal gan");
                   }                   
               },
               error: function(e){
                   alert("error : "+e);
               }
            });
            
            return false;
        });
        
        var grid2 = $("#list_transaksi_rs");
        grid2.jqGrid({
        url: '<?php echo base_url() ?>index.php/transaksi/rs/json2',
        datatype: "json",
	height: "auto",
	mtype: "GET",
	colNames: ['Id','Action','Dokter','Jenis Tagihan','Nama Tagihan','Harga Standart','Harga Satuan','Jumlah','Total','Selisih','Tgl. Resep','Nilai','Disetujui','Doses','Kandungan','Rekomendasi'],
	colModel: [
                    {name:'id_item_transaksi_rs', key:true, index:'id_item_transaksi_rs', hidden:true,editable:false,  editrules:{required:true}},
                    {name: 'myac', width:40, fixed:true, sortable:false, search:false, align:'center', viewable: false, resizable: false, resize:false, formatter:'actions',
                        formatoptions:{keys:true,editbutton:false, delbutton: true}
                    },
                    {name:'nama_dokter',index:'nama_dokter',width:70,editable:true,editrules:{required:true}},
                    {name:'jenis_item',index:'jenis_item',width:70,editable:true,editrules:{required:true}},
                    {name:'nama_item',index:'nama_item',width:70,editable:true,editrules:{required:true}},
                    {name:'harga_item',index:'harga_item',width:70,editable:true,editrules:{required:true}},
                    {name:'hrg_satuan',index:'hrg_satuan',width:70,editable:true,editrules:{required:true}},                    
                    {name:'jumlah',index:'jumlah',width:70,editable:true,editrules:{required:true}},                    
                    {name:'total',index:'total',width:70,editable:true,editrules:{required:true}},
                    {name:'selisih',index:'selisih',width:70,editable:true,editrules:{required:true}},
                    {name:'tgl_resep',index:'tgl_resep',width:70,editable:true,editrules:{required:true}},
                    {name:'nilai',index:'nilai',width:70,editable:true,editrules:{required:true}},
                    {name:'disetujui',index:'disetujui',width:70,editable:true,editrules:{required:true}},
                    {name:'nama_dosis',index:'nama_dosis',width:70,editable:true,editrules:{required:true}},
                    {name:'kandungan',index:'kandungan',width:70,editable:true,editrules:{required:true}},
                    {name:'nama_rekomendasi',index:'nama_rekomendasi',width:100,editable:true,editrules:{required:true}},                    
                    ],
        rownumbers:true,
	rowNum: 20,
	rowList: [10,20,30],
        postData: {idkunj : function(){
                    return id_kunjungan;
                  }},
        width:630,
	pager: '#pager_transaksi_rs',
	sortname: 'id_item_transaksi_rs',
        shrinkToFit: false,
	viewrecords: true,
	sortorder: "desc",
	editurl: '<?php echo base_url() ?>index.php/transaksi/rs/crud2', //URL Proses CRUD Nya
	multiselect: false, 
	caption: "Hasil Transaksi" //Caption List					
    });
    grid2.jqGrid('navGrid','#pager_transaksi_rs',{search:false, view:true,edit:false,add:false,del:true},{},{},{});				    
    
     $("#dokterov_rs").autocomplete({
            minLength: 1,
            source:
            function(req, add){
                $.ajax({
                    url: "<?php echo base_url(); ?>index.php/transaksi/rs/lookdokter",
                    dataType: 'json',
                    type: 'POST',
                    data: req,
                    success:
                        function(data){
                            if(data.response =="true"){
                                add(data.message);
                            } else if(data.response =="false") {
                                $('.ui-autocomplete-loading').removeClass("ui-autocomplete-loading");
                                id_dokterov="undefined";
                            }							
                        }          
                });
            },
            select:
                function(event, ui) {
                    id_dokterov=ui.item.id;    
                    $('#standartov_rs').val(ui.item.tarif);
                }
        });
        
     $("#rekomendasiov_rs").autocomplete({
            minLength: 1,
            source:
            function(req, add){
                $.ajax({
                    url: "<?php echo base_url(); ?>index.php/transaksi/rs/lookrekomendasi",
                    dataType: 'json',
                    type: 'POST',
                    data: req,
                    success:
                        function(data){
                            if(data.response =="true"){
                                add(data.message);
                            } else if(data.response =="false") {
                                $('.ui-autocomplete-loading').removeClass("ui-autocomplete-loading");
                                id_rekomov="undefined";
                            }							
                        },
                    error: function(e){
                        alert("error rekomendasi : "+e)
                    }    
                });
            },
                    select:
                    function(event, ui) {
                        id_rekomov=ui.item.id;                    
                    }  
        });
     
     $('#jumlahov_rs').keyup(function(){
            var a=$('#standartov_rs').val();
            var b=$('#satuanov_rs').val();            
            var c=$('#jumlahov_rs').val();
            if (a == '') {
                alert('harga standart harus di isi dulu');
                $('#standartov_rs').focus();
                $('#jumlahov_rs').val("");
                return false;
            }
            if (b == '') {
                alert('harga satuan harus di isi dulu');
                $('#satuanov_rs').focus();
                $('#jumlahov_rs').val("");
                return false;
            }
            $('#totalov_rs').val(b*c);           
        });
     
     function resetOv(){
         $('#dokterov_rs').val("");
         $('#standartov_rs').val("");
         $('#satuanov_rs').val("");
         $('#jumlahov_rs').val("");
         $('#totalov_rs').val("");
         $('#ov_rs').val("");
         $('#rekomendasiov_rs').val("");
         $('#disetujuiov_rs').val("");
     }
     
     $(".button_ov_rs").click(function() {
            if ($('#dokterov_rs').val() == '') {
                alert('Nama Dokter harus di isi');
                $('#dokterov_rs').focus();
                return false;
            }
            if (id_kunjungan == undefined) {                
                alert('Isi Data Kunjungan dulu');
                $('#pegawai_rs').focus();
                return false;
            }
            if ($('#ov_rs').val() == '') {
                alert('OV harus di isi');
                $('#ov_rs').focus();
                return false;
            }
            if ($('#disetujuiov_rs').val() == '') {
                alert('Disetujui harus di isi');
                $('#disetujuiov_rs').focus();
                return false;
            }
            
            var dokter = $('#dokterov_rs').val(),
                standart = $('#standartov_rs').val(),
                satuan = $('#satuanov_rs').val(),
                jumlah = $('#jumlahov_rs').val(),
                //total = $('#totalov_rs').val(),
                ov = $('#ov_rs').val(),
                rekomendasi = $('#rekomendasiov_rs').val(),
                disetujui = $('#disetujuiov_rs').val();
            
            var isi = "&id_kun="+id_kunjungan+"&dokter="+dokter+"&id_dokter="+id_dokterov+"&standart="+standart+"&satuan="+satuan+"&jumlah="+jumlah
                        +"&ov="+ov+"&id_rekom="+id_rekomov+"&rekomendasi="+rekomendasi+"&disetujui="+disetujui;
            //alert(isi);
            //return false;
            $.ajax({
               url : "<?php echo base_url(); ?>index.php/transaksi/rs/simpanov",
               data : isi,
               type: 'get',
               success: function(data){
                   if (data=="sukses"){
                     // alert("masuk");
                      resetOv();
                      $('#list_ov_rs').trigger('reloadGrid');
                   } else {
                       alert("gagal gan");
                   }                   
               },
               error: function(e){
                   alert("error : "+e);
               }
            });
            return false;
     }); 
     
     var grid3 = $("#list_ov_rs");
        grid3.jqGrid({
        url: '<?php echo base_url() ?>index.php/transaksi/rs/json3',
        datatype: "json",
	height: "auto",
	mtype: "GET",
	colNames: ['Id','Action','Dokter','Harga Standart','Harga Satuan','Jumlah','Total','OV','Rekomendasi','Disetujui'],
	colModel: [
                    {name:'id_transaksi_ov', key:true, index:'id_transaksi_ov', hidden:true,editable:false,  editrules:{required:true}},
                    {name: 'myac', width:40, fixed:true, sortable:false, search:false, align:'center', viewable: false, resizable: false, resize:false, formatter:'actions',
                        formatoptions:{keys:true,editbutton:false, delbutton: true}
                    },
                    {name:'nama_dokter',index:'nama_dokter',width:70,editable:true,editrules:{required:true}},
                    {name:'tarif_standart',index:'tarif_standart',width:70,editable:true,editrules:{required:true}},
                    {name:'hrg_satuan',index:'hrg_satuan',width:70,editable:true,editrules:{required:true}},                    
                    {name:'jumlah',index:'jumlah',width:70,editable:true,editrules:{required:true}},                    
                    {name:'total',index:'total',width:70,editable:true,editrules:{required:true}},
                    {name:'ov',index:'ov',align:'center',width:70,editable:true,editrules:{required:true}},
                    {name:'nama_rekomendasi',index:'nama_rekomendasi',width:100,editable:true,editrules:{required:true}},
                    {name:'disetujui',index:'disetujui',align:'center',width:70,editable:true,editrules:{required:true}},                                        
                    ],
        rownumbers:true,
	rowNum: 20,
	rowList: [10,20,30],
        postData: {idkunj : function(){
                    return id_kunjungan;
                  }},
        width:765,
	pager: '#pager_ov_rs',
	sortname: 'id_transaksi_ov',
        shrinkToFit: true,
	viewrecords: true,
	sortorder: "desc",
	editurl: '<?php echo base_url() ?>index.php/transaksi/rs/crud3', //URL Proses CRUD Nya
	multiselect: false, 
	caption: "Hasil OV" //Caption List					
    });
    grid3.jqGrid('navGrid','#pager_ov_rs',{search:false, view:true,edit:false,add:false,del:true},{},{},{});				    
    
});
function isNumberKey(evt)
    {
        var charCode = (evt.which) ? evt.which : event.keyCode
	if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
	
        return true;
    }
</script>
<div id="trans_rs" style="width: auto; height: auto; overflow: auto;">

<table  width="100%" border="0">
    <tr>
        <td>
            <fieldset>
                <legend>Data Kunjungan</legend>
                <form method="post" name="form">
                    <table cellpadding="3" border="0">
                        <tr>
                            <td style="vertical-align: top">
                                <table width="265">
                                    <tr>
                                        <td>Pegawai:</td>
                                        <td><input type="text" name="pegawai_rs" id="pegawai_rs"></td>
                                    </tr>
                                    <tr>
                                        <td>Pasien:</td>
                                        <td><select id="pasien_rs" name="pasien_rs" style="width: 110px">
                                                <option>Pilih Pasien</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Rumah Sakit:</td>
                                        <td><input type="text" id="rumah_sakit_rs" name="rumah_sakit_rs"></td>
                                    </tr>
                                    <tr>
                                        <td>Rawat:</td>
                                        <td><select name="rawat_rs" id="rawat_rs" style="width: 110px">
                                                <option></option>
                                                <option>Rawat Inap</option>
                                                <option>Rawat Jalan</option>
                                            </select></td>
                                    </tr>
                                </table>
                            </td>
                            <td style="vertical-align: top">
                                <table width="265">
                                    <tr>
                                        <td>NIP:</td>
                                        <td>
                                            <input type="text" name="nip_rs" id="nip_rs">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Tgl. Transaksi:</td>
                                        <td>
                                            <input type="text" name="tgl_trans_rs" id="tgl_trans_rs">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Tgl. Keluar:</td>
                                        <td>
                                            <input type="text" name="tgl_keluar_rs" id="tgl_keluar_rs">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>No. Surat:</td>
                                        <td>
                                            <input type="text" name="no_surat_rs" id="no_surat_rs">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>No. Bukti:</td>
                                        <td>
                                            <input type="text" name="no_bukti_rs" id="no_bukti_rs">
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <td>
                                <table width="265">
                                    <tr>
                                        <td>Bagian:</td>
                                        <td><input type="text" name="bagian_rs" id="bagian_rs"></td>
                                    </tr>
                                    <tr>
                                        <td>Tgl. Kunjungan:</td>
                                        <td><input type="text" name="tgl_kun_rs" id="tgl_kun_rs"></td>
                                    </tr>
                                    <tr>
                                        <td>Buku Besar:</td>
                                        <td><input type="text" name="buku_besar_rs" id="buku_besar_rs"></td>
                                    </tr>
                                    <tr>
                                        <td>Restitusi:</td>
                                        <td><input type="checkbox" name="restitusi_rs" id="restitusi_rs"></td>
                                    </tr>
                                    <tr>
                                        <td><input type="submit" value="Simpan" class="button_rs"></td>
                                        <td></td>
                                    </tr>
                                </table>
                            </td>
                       </tr>
                    </table>
                </form>
                </fieldset>
        </td>
    </tr>
    <tr>
        <td>
            <table>
                <tr>
                    <td style="vertical-align: top">
                        <fieldset>
                            <legend>Diagnosa</legend>
                            <form id="form2">
                                <table>
                                    <tr>
                                        <td>
                                           <table width="150" align="left">
                                            <tr>
                                            <td>
                                                 <input type="text" name="diagnosa_rs" id="diagnosa_rs">
                                            </td>
                                            <td>
                                            <input type="submit" value="add" class="button_diag_rs">
                                            </td>
                                            </tr>
                                           </table>
                                        </td>
                                    </tr>
                                </table>
                            </form>
                            <table id="list_diagnosa_rs" class="scroll" cellpadding="0" cellspacing="0"></table>
                            <div id="pager_diagnosa_rs" class="scroll" style="text-align:center;"></div>
                        </fieldset>
                    </td>
                    <td style="vertical-align: top">
                        <fieldset >
                            <legend>Item Transaksi</legend>
                            <form method="post" name="form3" action="" id="form3">
                                <table>
                                    <tr>
                                        <td>
                                            <table width="210">
                                                <tr>
                                                    <td>Dokter:</td>
                                                    <td><input type="text" id="dokter_rs" name="dokter_rs" /></td>
                                                </tr>
                                                <tr>
                                                    <td>Jenis Tagihan:</td>
                                                    <td><select id="jenis_tagihan_rs" name="jenis_tagihan_rs" style="width: 110px" >
                                                            <option>Jenis Tagihan</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Nama Tagihan:</td>
                                                    <td><input type="text" name="nama_tagihan_rs" id="nama_tagihan_rs" /></td>
                                                </tr>
                                                <tr>
                                                    <td>Harga Standart:</td>
                                                    <td><input type="text" name="harga_standart_rs" id="harga_standart_rs" onkeypress="return isNumberKey(event)" /></td>
                                                </tr>
                                                <tr>
                                                    <td>Harga Satuan:</td>
                                                    <td><input type="text" name="harga_satuan_rs" id="harga_satuan_rs" onkeypress="return isNumberKey(event)" /></td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td style="vertical-align: top">
                                            <table width="210">
                                                <tr>
                                                    <td>Jumlah:</td>
                                                    <td><input type="text" name="jumlah_rs" id="jumlah_rs" onkeypress="return isNumberKey(event)" /></td>
                                                </tr>
                                                <tr>
                                                    <td>Total:</td>
                                                    <td><input type="text" name="total_rs" id="total_rs" /></td>
                                                </tr>
                                                <tr>
                                                    <td>Selisih:</td>
                                                    <td><input type="text" name="selisih_trans_rs" id="selisih_trans_rs" /></td>
                                                </tr>
                                                <tr>
                                                    <td>Tanggal Resep:</td>
                                                    <td><input type="text" name="tgl_resep_rs" id="tgl_resep_rs" /></td>
                                                </tr>
                                                <tr>
                                                    <td>Nilai:</td>
                                                    <td><input type="text" name="nilai_rs" id="nilai_rs" /></td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td style="vertical-align: top">
                                            <table width="210">
                                                <tr>
                                                    <td>Disetujui:</td>
                                                    <td>
                                                        <select id="disetujui_rs" name="disetujui_rs" style="width: 110px">
                                                            <option value="y">Ya</option>
                                                            <option value="t">Tidak</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Doses:</td>
                                                    <td><input type="text" name="doses_rs" id="doses_rs" /></td>
                                                </tr>
                                                <tr>
                                                    <td>Kandungan:</td>
                                                    <td><input type="text" name="kandungan_rs" id="kandungan_rs" /></td>
                                                </tr>
                                                <tr>
                                                    <td>Rekomendasi:</td>
                                                    <td><input type="text" name="rekomendasi_rs" id="rekomendasi_rs" /></td>
                                                </tr>
                                                <tr>
                                                    <td><input type="submit" value="Tambah" class="button_trans_rs" /></td>
                                                    <td></td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </form>
                            <table id="list_transaksi_rs" class="scroll" cellpadding="0" cellspacing="0"></table>
                            <div id="pager_transaksi_rs" class="scroll" style="text-align:center;"></div>
                        </fieldset>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
        <tr>
        <td>
            <fieldset>
                <legend>OV</legend>
                <form method="post" name="form">
                    <table cellpadding="3" border="0">
                        <tr>
                            <td>
                                <table width="265">
                                    <tr>
                                        <td>Dokter:</td>
                                        <td><input type="text" name="dokterov_rs" id="dokterov_rs"></td>
                                    </tr>
                                    <tr>
                                        <td>Harga Standart:</td>
                                        <td><input type="text" id="standartov_rs" name="standartov_rs" onkeypress="return isNumberKey(event)" /></td>
                                    </tr>
                                    <tr>
                                        <td>Harga Satuan:</td>
                                        <td><input type="text" id="satuanov_rs" name="satuanov_rs" onkeypress="return isNumberKey(event)" /></td>
                                    </tr>
                                </table>
                            </td>
                            <td style="vertical-align: top">
                                <table width="265">
                                    <tr>
                                        <td>Jumlah:</td>
                                        <td>
                                            <input type="text" name="jumlahov_rs" id="jumlahov_rs" onkeypress="return isNumberKey(event)">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Total:</td>
                                        <td>
                                            <input type="text" name="totalov_rs" id="totalov_rs">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>OV:</td>
                                        <td>
                                            <select name="ov_rs" id="ov_rs" style="width: 110px">
                                                <option></option>
                                                <option>Operating</option>
                                                <option>Visiting</option>
                                            </select>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <td>
                                <table width="265">
                                    <tr>
                                        <td>Rekomendasi:</td>
                                        <td><input type="text" name="rekomendasiov_rs" id="rekomendasiov_rs"></td>
                                    </tr>
                                    <tr>
                                        <td>Disetujui:</td>
                                        <td>
                                            <select id="disetujuiov_rs" name="disetujuiov_rs" style="width: 110px">
                                                <option></option>
                                                <option value="y">Ya</option>
                                             <option value="t">Tidak</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><input type="submit" value="Simpan" class="button_ov_rs"></td>
                                        <td></td>
                                    </tr>
                                </table>
                            </td>
                       </tr>
                    </table>
                </form>
                <table id="list_ov_rs" class="scroll" cellpadding="0" cellspacing="0"></table>
                            <div id="pager_ov_rs" class="scroll" style="text-align:center;"></div>
                </fieldset>
        </td>
    </tr>
</table>

</div>
                                                                 