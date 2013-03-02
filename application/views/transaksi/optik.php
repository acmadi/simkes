<script type="text/javascript" >	 
$(this).ready( function() {
	var data_optik;        
        var id_kunjungan,
            id_tertanggung,
            id_dokter,
            id_item,
            id_pegawai,
            id_provider,
            id_diagnosa,
            id_rekom;
        $("#nip_optik").attr('disabled','disabled');
		$("#bagian_optik").attr('disabled','disabled');
        $("#selisih_optik").attr('disabled','disabled');
        $("#total_optik").attr('disabled','disabled');
        $("#selisih_trans_optik").attr('disabled','disabled');
        
        $(".button_optik").button();
        $(".button_diag_optik").button();
        $(".button_trans_optik").button();
        $(".button_periksa_optik").button();
        
        $( "#tgl_trans_optik" ).datepicker({
            changeMonth: true,
            changeYear: true,
            showOn: "button",
            buttonImage : "<?php echo base_url();?>asset/images/calendar.gif",				
            buttonImageOnly : true
	});
        
	$( "#tgl_kun_optik" ).datepicker({
            changeMonth     : true, // menampilkan dropdown untuk ganti bulan
            changeYear      : true, // menampilkan dropdown untuk ganti Tahun
            showOn          : "button",
            buttonImage     : "<?php echo base_url();?>asset/images/calendar.gif",				
            buttonImageOnly : true
	});	

        $("#pegawai_optik").autocomplete({
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
                        } else if(data.response =="false") {
                                $('.ui-autocomplete-loading').removeClass("ui-autocomplete-loading");
                                id_pegawai=undefined;
                            }                           
                    }                    
              });
            },
            select:
                function(event, ui) {
                    var id_bag=ui.item.bagian,
                        nip=ui.item.nip;
                    id_pegawai=nip;
                    $("#nip_optik").val(nip);
                    $("#id_bagian_optik").val(ui.item.id); 
                    bagian(id_bag);
                    pasien(ui.item.id);
                    tagihan();
                }
        });        
              
	function bagian(id_bag){
            $.ajax({
               url : "<?php echo base_url(); ?>index.php/transaksi/optik/bagian",
               data : "id="+id_bag,
               type: 'POST',
               success: function(data){
                   $("#bagian_optik").val(data);
               },
               error: function(e){
                   alert("error bagian : "+e)
               }
            });
        }
        
        function pasien(nip){
            $.ajax({
               url : "<?php echo base_url(); ?>index.php/transaksi/optik/pasien",
               data : "id="+nip,
               type: 'POST',
               success: function(data){
                   $('#pasien_optik').html(data);
               },
               error: function(e){
                   alert("error pasien : "+e)
               }
            });
        }
        
        $("#dokter_optik").autocomplete({
            minLength: 1,
            source:
            function(req, add){
                $.ajax({
                    url: "<?php echo base_url(); ?>index.php/transaksi/optik/lookdokter",
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
        
        $("#provider_optik").autocomplete({
            minLength: 1,
            source:
            function(req, add){
                $.ajax({
                    url: "<?php echo base_url(); ?>index.php/transaksi/optik/lookprovider",
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
            $('#pegawai_optik').val("");
            $('#pasien_optik').val("");
            $('#dokter_optik').val("");
            $('#provider_optik').val("");
            $('#nip_optik').val("");
            $('#tgl_trans_optik').val("");
            $('#no_surat_optik').val("");
            $('#no_bukti_optik').val("");
            $('#bagian_optik').val("");
            $('#tgl_kun_optik').val("");
            $('#buku_besar_optik').val("");          
            $('#restitusi_optik').attr('checked', false);
        }
        
        $(".button_optik").click(function() {                                         
            if ($('#pegawai_optik').val() == '') {
                alert('Pegawai harus di isi');
                $('#pegawai_optik').focus();
                return false;
            } 
            if ($('#buku_besar_optik').val() == '') {                
                alert('buku besar harus di isi');
                $('#buku_besar_optik').focus();
                return false;
            }
            
            var pegawai = $('#pegawai_optik').val(),
                pasien = $('#pasien_optik').val(),                
                dokter = $('#dokter_optik').val(),
                provider = $('#provider_optik').val(),
                nip = $('#nip_optik').val(),
                tgl_trans = $('#tgl_trans_optik').val(),
                no_surat = $('#no_surat_optik').val(),
                no_bukti = $('#no_bukti_optik').val(),
                bagian = $('#bagian_optik').val(),
                tgl_kun = $('#tgl_kun_optik').val(),                
                buku_besar = $('#buku_besar_optik').val(),                
                restitusi;                
                if ($("#restitusi_optik").is(":checked")){
                    restitusi="y";
                } else {
                    restitusi="t";
                }                                             
                 
            data_optik = "&pegawai="+pegawai+"&pasien="+pasien+"&id_dokter="+id_dokter+"&dokter="+dokter+"&id_provider="+id_provider+"&provider="+provider;
            data_optik = data_optik+"&nip="+nip+"&tgl_trans="+tgl_trans+"&no_surat="+no_surat+"&no_bukti="+no_bukti;
            data_optik = data_optik+"&bagian="+bagian+"&tgl_kun="+tgl_kun+"&buku_besar="+buku_besar+"&restitusi="+restitusi;            
            $.ajax({
               url : "<?php echo base_url(); ?>index.php/transaksi/optik/simpandata",
               data : data_optik,
               type: 'get',
               success: function(data){
                   if (data!=null){
                      alert("Data tersimpan : "+data);
                      id_kunjungan=data;
                      id_tertanggung=pasien;
                      resetKunjungan();
                      $('#list_diagnosa_optik').trigger('reloadGrid');
                      $('#list_transaksi_optik').trigger('reloadGrid');
                      $('#list_periksa_optik').trigger('reloadGrid');
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
        
        $("#diagnosa_optik").autocomplete({
            minLength: 1,
            source:
            function(req, add){
                $.ajax({
                    url: "<?php echo base_url(); ?>index.php/transaksi/optik/lookdiagnosa",
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
        
        $(".button_diag_optik").click(function() {
            var diagnosa = $('#diagnosa_optik').val();            
            if (diagnosa == '') {
                alert('Diagnosa harus di isi');
                $('#diagnosa_optik').focus();
                return false;
            }
            if (id_kunjungan == undefined) {                
                alert('Isi Data Kunjungan dulu');
                //alert(diagnosa+":"+id_diagnosa);
                $('#pegawai_optik').focus();
                return false;
            }
            //alert(diagnosa+":"+id_diagnosa+":"+id_kunjungan);
            $.ajax({
               url : "<?php echo base_url(); ?>index.php/transaksi/optik/simpandiagnosa",
               data : "id="+id_kunjungan+"&diag="+diagnosa+"&id_diagnosa="+id_diagnosa,
               type: 'get',
               success: function(data){
                   if (data=="sukses"){
                       //resetDiagnosa();
                       $('#list_diagnosa_optik').trigger('reloadGrid');
                   } else {
                       alert("Gagal Menyimpan data");
                   } 
               },
               error: function(e){
                   alert("error pasien : "+e)
               }
            });
            $('#diagnosa_optik').val("");
            return false;
        });
        
        var grid = $("#list_diagnosa_optik");
    grid.jqGrid({
        url: '<?php echo base_url() ?>index.php/transaksi/optik/json', 
        datatype: "json", 
	height: "auto", 
	mtype: "GET",
	colNames: ['Id','Diagnosa','Act'],
	colModel: [
                    {name:'id_transaksi_diagnosa', key:true, index:'id_transaksi_diagnosa', hidden:true,editable:false,editrules:{required:true}},
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
	pager: '#pager_diagnosa_optik',
	sortname: 'id_transaksi_diagnosa',
	viewrecords: true,
        shrinkToFit: false,
	sortorder: "desc",
	editurl: '<?php echo base_url() ?>index.php/transaksi/optik/crud', //URL Proses CRUD Nya
	multiselect: false, 
	caption: "Hasil Diagnosa" //Caption List					
    });
    grid.jqGrid('navGrid','#pager_diagnosa_optik',{search:false,view:false,edit:false,add:false,del:true},{},{},{});
                        
  //kanggo transaksi      
        function tagihan(){
            $.ajax({
               url : "<?php echo base_url(); ?>index.php/transaksi/optik/tagihan",
               type: 'POST',
               success: function(data){
                   $('#jenis_tagihan_optik').html(data);
               },
               error: function(e){
                   alert("error tagihan : "+e)
               }
            });
        }
        
        $("#nama_tagihan_optik").autocomplete({
            minLength: 1,
            source:
            function(requ, add){
                var id_jenis=$('#jenis_tagihan_optik').val();
                var isi =$("#nama_tagihan_optik").val();
                if (id_jenis == '') {
                    alert('Jenis Tagihan Harus Dipilih');
                    $("#nama_tagihan_optik").val("");
                    $('.ui-autocomplete-loading').removeClass("ui-autocomplete-loading");
                    $('#jenis_tagihan_optik').focus();
                    return false;
                }
                
                $.ajax({
                    url: "<?php echo base_url(); ?>index.php/transaksi/optik/looktagihan",
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
                                $("#harga_standart_optik").val(""); 
                            }                         
                        }                    
                });
            },
            select:
                function(event, ui) {
                    $("#harga_standart_optik").val(ui.item.harga); 
                    id_item=ui.item.id;
                }
        });
        
        $('#jenis_tagihan_optik').change(function(){
            $('#nama_tagihan_optik').val("");
            $('#harga_standart_optik').val("");
            id_item=undefined;
        });
        
        function hitungSelisih(){
            var a=$('#harga_standart_optik').val();
            var b=$('#harga_satuan_optik').val();            
            var c=$('#jumlah_optik').val();
            
            $('#total_optik').val(b*c);
            $('#selisih_trans_optik').val(a*c-b*c);
        }
        
        $('#harga_standart_optik').keyup(function(){
            hitungSelisih();
        });
        
        $('#harga_satuan_optik').keyup(function(){
            hitungSelisih();
        });
        
        $('#jumlah_optik').keyup(function(){
            hitungSelisih();       
        });
        
        $("#rekomendasi_optik").autocomplete({
            minLength: 1,
            source:
            function(req, add){
                $.ajax({
                    url: "<?php echo base_url(); ?>index.php/transaksi/optik/lookrekomendasi",
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
        
        $('#jumlah_optik').keyup(function(){
            var a=$('#harga_standart_optik').val();
            var b=$('#harga_satuan_optik').val();            
            var c=$('#jumlah_optik').val();
            if (a == '') {
                alert('harga standart harus di isi dulu');
                $('#harga_standart_optik').focus();
                return false;
            }
            if (b == '') {
                alert('harga satuan harus di isi dulu');
                $('#harga_satuan_optik').focus();
                return false;
            }
            $('#total_optik').val(b*c);
            $('#selisih_trans_optik').val(a*c-b*c);            
        });
        
        function resetTransaksi(){
            $('#jenis_tagihan_optik').val("");
            $('#nama_tagihan_optik').val("");
            $('#harga_standart_optik').val("");
            $('#harga_satuan_optik').val("");
            $('#jumlah_optik').val("");
            $('#total_optik').val("");
            $('#selisih_trans_optik').val("");
            $('#disetujui_optik').val("");
            $('#rekomendasi_optik').val("");
        }
        
        $(".button_trans_optik").click(function() {
            if ($('#nama_tagihan_optik').val() == '') {
                alert('Nama Tagihan harus di isi');
                $('#nama_tagihan_optik').focus();
                return false;
            }
            if (id_kunjungan == undefined) {                
                alert('Isi Data Kunjungan dulu');
                $('#pegawai_optik').focus();
                return false;
            }
            var jenis_tagihan = $('#jenis_tagihan_optik').val(),
                nama_tagihan = $('#nama_tagihan_optik').val(),
                harga_standart = $('#harga_standart_optik').val(),
                harga_satuan = $('#harga_satuan_optik').val(),
                jumlah = $('#jumlah_optik').val(),
                //total = $('#total_optik').val(),
                //selisih_transaksi = $('#selisih_trans_optik').val(),
                disetujui = $('#disetujui_optik').val(),
                rekomendasi = $('#rekomendasi_optik').val();
            var isi;             
            isi="&jenis_tagihan="+jenis_tagihan+"&id_item="+id_item+"&kunjungan="+id_kunjungan+"&nama_tagihan="+nama_tagihan+"&harga_standart="+harga_standart+"&harga_satuan="+harga_satuan
                +"&jumlah="+jumlah+"&disetujui="+disetujui+"&id_rekomendasi="+id_rekom+"&rekomendasi="+rekomendasi;
            //alert(isi);
            //return false;
            $.ajax({
               url : "<?php echo base_url(); ?>index.php/transaksi/optik/simpanitem",
               data : isi,
               type: 'get',
               success: function(data){
                   if (data!=null){
                      //alert("Sukses gan");
                      resetTransaksi();
                      $('#list_transaksi_optik').trigger('reloadGrid');
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
        
        var grid2 = $("#list_transaksi_optik");
        grid2.jqGrid({
        url: '<?php echo base_url() ?>index.php/transaksi/optik/json2',
        datatype: "json",
	height: "auto",
	mtype: "GET",
	colNames: ['Id','Action','Jenis Tagihan','Nama Tagihan','Harga Standart','Harga Satuan','Jumlah','Total','Selisih','Disetujui','Rekomendasi'],
	colModel: [
                    {name:'id_item_transaksi_optik', key:true, index:'id_item_transaksi_optik', hidden:true,editable:false,  editrules:{required:true}},
                    {name: 'myac', width:40, fixed:true, sortable:false, search:false, align:'center', viewable: false, resizable: false, resize:false, formatter:'actions',
                        formatoptions:{keys:true,editbutton:false, delbutton: true}
                    },
                    {name:'jenis_item',index:'jenis_item',width:70,editable:true,editrules:{required:true}},
                    {name:'nama_item',index:'nama_item',width:70,editable:true,editrules:{required:true}},
                    {name:'harga_item',index:'harga_item',width:70,editable:true,editrules:{required:true}},
                    {name:'hrg_satuan',index:'hrg_satuan',width:70,editable:true,editrules:{required:true}},                    
                    {name:'jumlah',index:'jumlah',width:70,editable:true,editrules:{required:true}},                    
                    {name:'total',index:'total',width:70,editable:true,editrules:{required:true}},
                    {name:'selisih',index:'selisih',width:70,editable:true,editrules:{required:true}},                    
                    {name:'disetujui',index:'disetujui',width:70,editable:true,editrules:{required:true}},
                    {name:'nama_rekomendasi',index:'nama_rekomendasi',width:100,editable:true,editrules:{required:true}},                    
                    ],
        rownumbers:true,
	rowNum: 10,
	rowList: [10,20,30],
        postData: {idkunj : function(){
                    return id_kunjungan;
                  }},
        width:630,
	pager: '#pager_transaksi_optik',
	sortname: 'id_item_transaksi_optik',
        shrinkToFit: false,
	viewrecords: true,
	sortorder: "desc",
	editurl: '<?php echo base_url() ?>index.php/transaksi/optik/crud2', //URL Proses CRUD Nya
	multiselect: false, 
	caption: "Hasil Transaksi" //Caption List					
    });
    grid2.jqGrid('navGrid','#pager_transaksi_optik',{search:false, view:true,edit:false,add:false,del:true},{},{},{});				    
    
    function resetPeriksa(){
        $('#spher1_optik').val("");
        $('#spher2_optik').val(""); 
        $('#cylinder1_optik').val("");
        $('#cylinder2_optik').val("");
        $('#axis1_optik').val("");
        $('#axis2_optik').val("");
        $('#prisma1_optik').val("");
        $('#prisma2_optik').val("");
        $('#basis1_optik').val("");
        $('#basis2_optik').val("");
        $('#pupil_distance1_optik').val("");
        $('#pupil_distance2_optik').val("");
        $('#jenis_periksa_optik').val("");
    }
    
    $(".button_periksa_optik").click(function() {
       if ($('#spher1_optik').val() == '') {
            alert('Spher harus di isi');
            $('#spher1_optik').focus();
            return false;
       }
       if (id_kunjungan == undefined) {                
            alert('Isi Data Kunjungan dulu');
            $('#pegawai_optik').focus();
            return false;
       }
       
       var spher1 = $('#spher1_optik').val(),
           spher2 = $('#spher2_optik').val(), 
           cylinder1 = $('#cylinder1_optik').val(),
           cylinder2 = $('#cylinder2_optik').val(),
           axis1 = $('#axis1_optik').val(),
           axis2 = $('#axis2_optik').val(),
           prisma1 = $('#prisma1_optik').val(),
           prisma2 = $('#prisma2_optik').val(),
           basis1 = $('#basis1_optik').val(),
           basis2 = $('#basis2_optik').val(),
           pupil_distance1 = $('#pupil_distance1_optik').val(),
           pupil_distance2 = $('#pupil_distance2_optik').val(),
           jenis_periksa = $('#jenis_periksa_optik').val();
       
       var isi = "&kunjungan="+id_kunjungan+"&id_tertanggung="+id_tertanggung+"&spher1="+spher1+"&spher2="+spher2+"&cylinder1="+cylinder1+"&cylinder2="+cylinder2
                  +"&axis1="+axis1+"&axis2="+axis2+"&prisma1="+prisma1+"&prisma2="+prisma2+"&basis1="+basis1+"&basis2="+basis2
                  +"&pupil_distance1="+pupil_distance1+"&pupil_distance2="+pupil_distance2+"&jenis_periksa="+jenis_periksa;
       //alert(isi);
       
       $.ajax({
               url : "<?php echo base_url(); ?>index.php/transaksi/optik/simpanperiksa",
               data : isi,
               type: 'get',
               success: function(data){
                   if (data=="sukses"){
                       resetPeriksa();
                      $('#list_periksa_optik').trigger('reloadGrid');
                      
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
    
        var grid3 = $("#list_periksa_optik");
    grid3.jqGrid({
        url: '<?php echo base_url() ?>index.php/transaksi/optik/json3', 
        datatype: "json", 
	height: "auto", 
	mtype: "GET",
	colNames: ['Id','Act','Spher','Cylinder','Axis','Prisma','Basis','Pupil Distance','Jenis_periksa'],
	colModel: [
                    {name:'id_periksa_optik', key:true, index:'id_periksa_optik', hidden:true,editable:false,editrules:{required:true}},                    
                    {name: 'myac', width:40, fixed:true, sortable:false, search:false, align:'center', viewable: false, resizable: false, resize:false, formatter:'actions',
                        formatoptions:{keys:true,editbutton:false, delbutton: true, position:'top'}
                    },
                    {name:'spher',index:'spher',align:'center',width:100,editable:true,editrules:{required:true}},
                    {name:'cylinder',index:'cylinder',align:'center',width:100,editable:true,editrules:{required:true}},
                    {name:'axis',index:'axis',align:'center',width:100,editable:true,editrules:{required:true}},
                    {name:'prisma',index:'prisma',align:'center',width:100,editable:true,editrules:{required:true}},
                    {name:'basis',index:'basis',align:'center',width:100,editable:true,editrules:{required:true}},
                    {name:'pupil_distance',index:'pupil_distance',align:'center',width:100,editable:true,editrules:{required:true}},
                    {name:'jenis_periksa',index:'jenis_periksa',align:'center',width:100,editable:true,editrules:{required:true}},
                    ],
        rownumbers:true,
	rowNum: 10,
	rowList: [10,20,30],
        //width:630,
        postData: {idkunj : function(){
                        return id_kunjungan;
                  }},
	pager: '#pager_periksa_optik',
	sortname: 'id_periksa_optik',
	viewrecords: true,
        shrinkToFit: true,
	sortorder: "desc",
	editurl: '<?php echo base_url() ?>index.php/transaksi/optik/crud3', //URL Proses CRUD Nya
	multiselect: false, 
	caption: "Hasil Periksa" //Caption List					
    });
    grid3.jqGrid('navGrid','#pager_periksa_optik',{search:false,view:true,edit:false,add:false,del:true});
    
});
function isNumberKey(evt)
    {
        var charCode = (evt.which) ? evt.which : event.keyCode
	if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
	
        return true;
    }
</script>
<div id="trans_optik" style="width: auto; height: auto; overflow: auto;">
<table  width="100%" border="0">
    <tr>
        <td>
            <fieldset>
                <legend>Data Kunjungan</legend>
                <form method="post" name="form">
                    <table cellpadding="3" border="0">
                        <tr>
                            <td>
                                <table width="265">
                                    <input type="hidden" name="id_kunjungan_optik" id="id_kunjungan_optik">
                                    <tr>
                                        <td>Pegawai:</td>
                                        <td><input type="text" name="pegawai_optik" id="pegawai_optik"></td>
                                    </tr>
                                    <tr>
                                        <td>Pasien:</td>
                                        <td><select id="pasien_optik" name="pasien_optik" style="width: 110px">
                                                <option>Pilih Pasien</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Dokter:</td>
                                        <td><input type="text" name="dokter_optik" id="dokter_optik"></td>
                                    </tr>
                                    <tr>
                                        <td>Provider:</td>
                                        <td><input type="text" name="provider_optik" id="provider_optik"></td>
                                    </tr>
                                </table>
                            </td>
                            <td style="vertical-align: top">
                                <table width="265">
                                    <tr>
                                        <td>NIP:</td>
                                        <td>
                                            <input type="text" name="nip_optik" id="nip_optik">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Tgl. Transaksi:</td>
                                        <td>
                                            <input type="text" name="tgl_trans_optik" id="tgl_trans_optik">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>No. Surat:</td>
                                        <td>
                                            <input type="text" name="no_surat_optik" id="no_surat_optik">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>No. Bukti:</td>
                                        <td>
                                            <input type="text" name="no_bukti_optik" id="no_bukti_optik">
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <td>
                                <table width="265">
                                    <tr>
                                        <td>Bagian:</td>
                                        <td><input type="text" name="bagian_optik" id="bagian_optik"></td>
                                    </tr>
                                    <tr>
                                        <td>Tgl. Kunjungan:</td>
                                        <td><input type="text" name="tgl_kun_optik" id="tgl_kun_optik"></td>
                                    </tr>
                                    <tr>
                                        <td>Buku Besar:</td>
                                        <td><input type="text" name="buku_besar_optik" id="buku_besar_optik"></td>
                                    </tr>
                                    <tr>
                                        <td>Restitusi:</td>
                                        <td><input type="checkbox" name="restitusi_optik" id="restitusi_optik"></td>
                                    </tr>
                                    <tr>
                                        <td><input type="submit" value="Simpan" class="button_optik"></td>
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
                                                 <input type="text" name="diagnosa_optik" id="diagnosa_optik">
                                            </td>
                                            <td>
                                            <input type="submit" value="add" class="button_diag_optik">
                                            </td>
                                            </tr>
                                           </table>
                                        </td>
                                    </tr>
                                </table>
                            </form>
                            <table id="list_diagnosa_optik" class="scroll" cellpadding="0" cellspacing="0"></table>
                            <div id="pager_diagnosa_optik" class="scroll" style="text-align:center;"></div>
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
                                                    <td>Jenis Tagihan:</td>
                                                    <td><select id="jenis_tagihan_optik" name="jenis_tagihan_optik" style="width: 110px">
                                                            <option>Jenis Tagihan</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Nama Tagihan:</td>
                                                    <td><input type="text" name="nama_tagihan_optik" id="nama_tagihan_optik"/></td>
                                                </tr>
                                                <tr>
                                                    <td>Harga Standart:</td>
                                                    <td><input type="text" name="harga_standart_optik" id="harga_standart_optik" onkeypress="return isNumberKey(event)"/></td>
                                                </tr>
                                                <tr>
                                                    <td>Harga Satuan:</td>
                                                    <td><input type="text" name="harga_satuan_optik" id="harga_satuan_optik" onkeypress="return isNumberKey(event)"/></td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td style="vertical-align: top">
                                            <table width="210">
                                                <tr>
                                                    <td>Jumlah:</td>
                                                    <td><input type="text" name="jumlah_optik" id="jumlah_optik" onkeypress="return isNumberKey(event)"/></td>
                                                </tr>
                                                <tr>
                                                    <td>Total:</td>
                                                    <td><input type="text" name="total_optik" id="total_optik"/></td>
                                                </tr>
                                                <tr>
                                                    <td>Selisih:</td>
                                                    <td><input type="text" name="selisih_trans_optik" id="selisih_trans_optik"/></td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td style="vertical-align: top">
                                            <table width="210">
                                                <tr>
                                                    <td>Disetujui:</td>
                                                    <td>
                                                        <select id="disetujui_optik" name="disetujui_optik" style="width: 110px">
                                                            <option value="y">Ya</option>
                                                            <option value="t">Tidak</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Rekomendasi:</td>
                                                    <td><input type="text" name="rekomendasi_optik" id="rekomendasi_optik"/></td>
                                                </tr>
                                                <tr>
                                                    <td><input type="submit" value="Tambah" class="button_trans_optik"/></td>
                                                    <td></td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </form>
                            <table id="list_transaksi_optik" class="scroll" cellpadding="0" cellspacing="0"></table>
                            <div id="pager_transaksi_optik" class="scroll" style="text-align:center;"></div>
                        </fieldset>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td>
            <fieldset>
                <legend>Periksa</legend>
                <table>
                    <tr>
                        <td>
                            <table>
                                <tr>
                                    <td>
                                        <table>
                                            <tr>
                                                <td>Spher</td>
                                            </tr>
                                            <tr>
                                                <td><input type="text" name="spher1_optik" id="spher1_optik"/></td>
                                            </tr>
                                            <tr>
                                                <td><input type="text" name="spher2_optik" id="spher2_optik"/></td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td>
                                        <table>
                                            <tr>
                                                <td>Cylinder</td>
                                            </tr>
                                            <tr>
                                                <td><input type="text" name="cylinder1_optik" id="cylinder1_optik"/></td>
                                            </tr>
                                            <tr>
                                                <td><input type="text" name="cylinder2_optik" id="cylinder2_optik"/></td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td>
                                        <table>
                                            <tr>
                                                <td>Axis</td>
                                            </tr>
                                            <tr>
                                                <td><input type="text" name="axis1_optik" id="axis1_optik"/></td>
                                            </tr>
                                            <tr>
                                                <td><input type="text" name="axis2_optik" id="axis2_optik"/></td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td>
                                        <table>
                                            <tr>
                                                <td>Prisma</td>
                                            </tr>
                                            <tr>
                                                <td><input type="text" name="prisma1_optik" id="prisma1_optik"/></td>
                                            </tr>
                                            <tr>
                                                <td><input type="text" name="prisma2_optik" id="prisma2_optik"/></td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td>
                                        <table>
                                            <tr>
                                                <td>Basis</td>
                                            </tr>
                                            <tr>
                                                <td><input type="text" name="basis1_optik" id="basis1_optik"/></td>
                                            </tr>
                                            <tr>
                                                <td><input type="text" name="basis2_optik" id="basis2_optik"/></td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td>
                                        <table>
                                            <tr>
                                                <td>Pupil Distance</td>
                                            </tr>
                                            <tr>
                                                <td><input type="text" name="pupil_distance1_optik" id="pupil_distance1_optik"/></td>
                                            </tr>
                                            <tr>
                                                <td><input type="text" name="pupil_distance2_optik" id="pupil_distance2_optik"/></td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td style="vertical-align: bottom">
                                        <table>
                                            <tr>
                                                <td><select name="jenis_periksa_optik" id="jenis_periksa_optik" style="width: 110px">
                                                        <option>Addisi</option>
                                                        <option>Lihat Dekat</option>
                                                        <option>Lihat Jauh</option>
                                                    </select></td>
                                            </tr>
                                            <tr>
                                                <td><input type="submit" value="Tambah" class="button_periksa_optik"/></td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
                <table id="list_periksa_optik" class="scroll" cellpadding="0" cellspacing="0"></table>
                            <div id="pager_periksa_optik" class="scroll" style="text-align:center;"></div>
            </fieldset>
        </td>
    </tr>
</table>
</div>
                                                                   