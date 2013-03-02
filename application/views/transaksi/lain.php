<script type="text/javascript" >	 
$(this).ready( function() {
	var data_lain;        
        var id_kunjungan,
            id_dokter,
            id_item,
            id_apotek,
            id_pegawai,
            id_provider,
            id_doses,
            id_diagnosa,
            id_rekom;
        $("#nip_lain").attr('disabled','disabled');
		$("#bagian_lain").attr('disabled','disabled');
        $("#selisih_lain").attr('disabled','disabled');
        $("#total_lain").attr('disabled','disabled');
        $("#selisih_trans_lain").attr('disabled','disabled');
        
        $(".button_lain").button();
        $(".button_diag_lain").button();
        $(".button_trans_lain").button();
        
        $( "#tgl_trans_lain" ).datepicker({
            changeMonth: true,
            changeYear: true,
            showOn: "button",
            buttonImage : "<?php echo base_url();?>asset/images/calendar.gif",				
            buttonImageOnly : true
	});
        
	$( "#tgl_kun_lain" ).datepicker({
            changeMonth     : true, // menampilkan dropdown untuk ganti bulan
            changeYear      : true, // menampilkan dropdown untuk ganti Tahun
            showOn          : "button",
            buttonImage     : "<?php echo base_url();?>asset/images/calendar.gif",				
            buttonImageOnly : true
	});	

        $("#pegawai_lain").autocomplete({
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
                                id_pegawai=undefined;
                            }                           
                    }                    
              });
            },
            select:
                function(event, ui) {
                    var id_bag=ui.item.bagian,
                        nip=ui.item.nip;
                    $("#nip_lain").val(nip);
                    $("#id_bagian_lain").val(ui.item.id); 
                    id_pegawai=nip;
                    bagian(id_bag);
                    rujukan();
                    pasien(ui.item.id);
                    //kunjungan();
                    tagihan();
                }
        });        
              
	function bagian(id_bag){
            $.ajax({
               url : "<?php echo base_url(); ?>index.php/transaksi/lain/bagian",
               data : "id="+id_bag,
               type: 'POST',
               success: function(data){
                   $("#bagian_lain").val(data);
               },
               error: function(e){
                   alert("error bagian : "+e)
               }
            });
        }
        
        function pasien(nip){
            $.ajax({
               url : "<?php echo base_url(); ?>index.php/transaksi/lain/pasien",
               data : "id="+nip,
               type: 'POST',
               success: function(data){
                   $('#pasien_lain').html(data);
               },
               error: function(e){
                   alert("error pasien : "+e)
               }
            });
        }
        
        function rujukan(){
            $.ajax({
               url : "<?php echo base_url(); ?>index.php/transaksi/lain/rujukan",
               type: 'POST',
               success: function(data){
                   $('#rujukan_lain').html(data);
               },
               error: function(e){
                   alert("error rujukan : "+e)
               }
            });
        }
        /*
        function kunjungan(){
            $.ajax({
               url : "<?php echo base_url(); ?>index.php/transaksi/lain/kunjungan",
               type: 'POST',
               success: function(data){
                   $('#kunjungan_lain').html(data);
               },
               error: function(e){
                   alert("Error Kunjungan : "+e)
               }
            });
        }
        */
        $("#dokter_lain").autocomplete({
            minLength: 1,
            source:
            function(req, add){
                var id_rujukan=$('#rujukan_lain').val();
                var isi =$("#dokter_lain").val();
                if (id_rujukan == '')
                {
                    alert('Jenis Rujukan Harus Dipilih');
                    $("#dokter_lain").val("");
                    $('.ui-autocomplete-loading').removeClass("ui-autocomplete-loading");
                    $('#rujukan_lain').focus();
                    return false;
                }

                $.ajax({
                    url: "<?php echo base_url(); ?>index.php/transaksi/lain/lookdokter",
                    dataType: 'json',
                    type: 'POST',
                    data: "&term="+isi+"&kat_dokter="+id_rujukan,
                    
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
        
        $("#provider_lain").autocomplete({
            minLength: 1,
            source:
            function(req, add){
                $.ajax({
                    url: "<?php echo base_url(); ?>index.php/transaksi/lain/lookprovider",
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
            $('#pegawai_lain').val("");
            $('#pasien_lain').val("");
            $('#dokter_lain').val("");
            $('#rujukan_lain').val("");
            $('#provider_lain').val("");
            $('#nip_lain').val("");
            $('#tgl_trans_lain').val("");
            $('#no_surat_lain').val("");
            $('#no_bukti_lain').val("");
            $('#bagian_lain').val("");
            $('#tgl_kun_lain').val("");
            $('#buku_besar_lain').val("");          
            $('#restitusi_lain').attr('checked', false);
        }
        
        $(".button_lain").click(function() {                                         
            if ($('#pegawai_lain').val() == '') {
                alert('Pegawai harus di isi');
                $('#pegawai_lain').focus();
                return false;
            } 
            if ($('#buku_besar_lain').val() == '') {                
                alert('buku besar harus di isi');
                $('#buku_besar_lain').focus();
                return false;
            }
            if (id_pegawai == undefined) {                
                alert('Anda harus memasukkan data karyawan di master karyawan');
                return false;
            }
            
            var pegawai = $('#pegawai_lain').val(),
                pasien = $('#pasien_lain').val(),                
                dokter = $('#dokter_lain').val(),
                rujukan = $('#rujukan_lain').val(),
                provider = $('#provider_lain').val(),
                //nip = $('#nip_lain').val(),
                tgl_trans = $('#tgl_trans_lain').val(),
                no_surat = $('#no_surat_lain').val(),
                no_bukti = $('#no_bukti_lain').val(),
                //selisih = $('#selisih_lain').val(),
                //bagian = $('#bagian_lain').val(),
                tgl_kun = $('#tgl_kun_lain').val(),                
                buku_besar = $('#buku_besar_lain').val(),                
                restitusi;                
                if ($("#restitusi_lain").is(":checked")){
                    restitusi="y";
                } else {
                    restitusi="t";
                }                                             
                 
            data_lain = "&pegawai="+pegawai+"&pasien="+pasien+"&id_dokter="+id_dokter+"&dokter="+dokter+"&rujukan="+rujukan+"&id_provider="+id_provider+"&provider="+provider;
            data_lain = data_lain+"&tgl_trans="+tgl_trans+"&no_surat="+no_surat+"&no_bukti="+no_bukti;
            data_lain = data_lain+"&tgl_kun="+tgl_kun+"&buku_besar="+buku_besar+"&restitusi="+restitusi;            
            $.ajax({
               url : "<?php echo base_url(); ?>index.php/transaksi/lain/simpandata",
               data : data_lain,
               type: 'get',
               success: function(data){
                   if (data!=null){
                      alert("Data tersimpan : "+data);
                      id_kunjungan=data;
                      resetKunjungan();  
                      $('#list_diagnosa_lain').trigger('reloadGrid');
                      $('#list_transaksi_lain').trigger('reloadGrid');
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
        
        $("#diagnosa_lain").autocomplete({
            minLength: 1,
            source:
            function(req, add){
                $.ajax({
                    url: "<?php echo base_url(); ?>index.php/transaksi/lain/lookdiagnosa",
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
        
        $(".button_diag_lain").click(function() {
            var diagnosa = $('#diagnosa_lain').val();            
            if (diagnosa == '') {
                alert('Diagnosa harus di isi');
                $('#diagnosa_lain').focus();
                return false;
            }
            if (id_kunjungan == undefined) {                
                alert('Isi Data Kunjungan dulu');
                //alert(diagnosa+":"+id_diagnosa);
                $('#pegawai_lain').focus();
                return false;
            }
            //alert(diagnosa+":"+id_diagnosa+":"+id_kunjungan);
            $.ajax({
               url : "<?php echo base_url(); ?>index.php/transaksi/lain/simpandiagnosa",
               data : "id="+id_kunjungan+"&diag="+diagnosa+"&id_diagnosa="+id_diagnosa,
               type: 'get',
               success: function(data){
                   if (data=="sukses"){
                       //resetDiagnosa();
                       $('#list_diagnosa_lain').trigger('reloadGrid');
                   } else {
                       alert("Gagal Menyimpan data");
                   } 
               },
               error: function(e){
                   alert("error pasien : "+e)
               }
            });
            $('#diagnosa_lain').val("");
            return false;
        });
        
        var grid = $("#list_diagnosa_lain");
    grid.jqGrid({
        url: '<?php echo base_url() ?>index.php/transaksi/lain/json', 
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
	pager: '#pager_diagnosa_lain',
	sortname: 'id_transaksi_diagnosa',
	viewrecords: true,
        shrinkToFit: false,
	sortorder: "desc",
	editurl: '<?php echo base_url() ?>index.php/transaksi/lain/crud', //URL Proses CRUD Nya
	multiselect: false, 
	caption: "Hasil Diagnosa" //Caption List					
    });
    grid.jqGrid('navGrid','#pager_diagnosa_lain',{search:false,view:false,edit:false,add:false,del:true},{},{},{});
                        
  //kanggo transaksi      
        function tagihan(){
            $.ajax({
               url : "<?php echo base_url(); ?>index.php/transaksi/lain/tagihan",
               type: 'POST',
               success: function(data){
                   $('#jenis_tagihan_lain').html(data);
               },
               error: function(e){
                   alert("error rujukan : "+e)
               }
            });
        }
        
        $("#doses_lain").autocomplete({
            minLength: 1,
            source:
            function(req, add){
                $.ajax({
                    url: "<?php echo base_url(); ?>index.php/transaksi/lain/lookdosis",
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
        
        $("#rekomendasi_lain").autocomplete({
            minLength: 1,
            source:
            function(req, add){
                $.ajax({
                    url: "<?php echo base_url(); ?>index.php/transaksi/lain/lookrekomendasi",
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
        
        $("#nama_tagihan_lain").autocomplete({
            minLength: 1,
            source:
            function(requ, add){
                var id_jenis=$('#jenis_tagihan_lain').val();
                var isi =$("#nama_tagihan_lain").val();
                if (id_jenis == '') {
                    alert('Jenis Tagihan Harus Dipilih');
                    $("#nama_tagihan_lain").val("");
                    $('.ui-autocomplete-loading').removeClass("ui-autocomplete-loading");
                    $('#jenis_tagihan_lain').focus();
                    return false;
                }
                
                $.ajax({
                    url: "<?php echo base_url(); ?>index.php/transaksi/lain/looktagihan",
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
                                $("#harga_standart_lain").val(""); 
                            }                         
                        }                    
                });
            },
            select:
                function(event, ui) {
                    $("#harga_standart_lain").val(ui.item.harga); 
                    id_item=ui.item.id;
                }
        });
        
        $('#jenis_tagihan_lain').change(function(){
            $('#nama_tagihan_lain').val("");
            $('#harga_standart_lain').val("");
            id_item=undefined;
        });
        
        function hitungSelisih(){
            var a=$('#harga_standart_lain').val();
            var b=$('#harga_satuan_lain').val();            
            var c=$('#jumlah_lain').val();
            
            $('#total_lain').val(b*c);
            $('#selisih_trans_lain').val(a*c-b*c);
        }
        
        $('#harga_standart_lain').keyup(function(){
            hitungSelisih();
        });
        
        $('#harga_satuan_lain').keyup(function(){
            hitungSelisih();
        });
        
        $('#jumlah_lain').keyup(function(){
            hitungSelisih();       
        });
        
        function resetTransaksi(){
            $('#jenis_tagihan_lain').val("");
            $('#nama_tagihan_lain').val("");
            $('#harga_standart_lain').val("");
            $('#harga_satuan_lain').val("");
            $('#jumlah_lain').val("");
            $('#total_lain').val("");
            $('#selisih_trans_lain').val("");
            $('#disetujui_lain').val("");
            $('#doses_lain').val("");
            $('#rekomendasi_lain').val("");
        }
        
        $(".button_trans_lain").click(function() {
            if ($('#nama_tagihan_lain').val() == '') {
                alert('Nama Tagihan harus di isi');
                $('#nama_tagihan_lain').focus();
                return false;
            }
            if (id_kunjungan == undefined) {                
                alert('Isi Data Kunjungan dulu');
                $('#pegawai_lain').focus();
                return false;
            }
            if ($('#doses_lain').val() == '') {
                alert('Doses harus di isi');
                $('#doses_lain').focus();
                return false;
            }
            var jenis_tagihan = $('#jenis_tagihan_lain').val(),
                nama_tagihan = $('#nama_tagihan_lain').val(),
                harga_standart = $('#harga_standart_lain').val(),
                harga_satuan = $('#harga_satuan_lain').val(),
                jumlah = $('#jumlah_lain').val(),
                total = $('#total_lain').val(),
                selisih_transaksi = $('#selisih_trans_lain').val(),
                disetujui = $('#disetujui_lain').val(),
                doses = $('#doses_lain').val(),
                rekomendasi = $('#rekomendasi_lain').val();
            var isi;             
            isi="&jenis_tagihan="+jenis_tagihan+"&id_item="+id_item+"&kunjungan="+id_kunjungan+"&nama_tagihan="+nama_tagihan+"&harga_standart="+harga_standart+"&harga_satuan="+harga_satuan;
            isi=isi+"&jumlah="+jumlah+"&total="+total+"&selisih="+selisih_transaksi;
            isi=isi+"&disetujui="+disetujui+"&id_dosis="+id_doses+"&dosis="+doses+"&id_rekomendasi="+id_rekom+"&rekomendasi="+rekomendasi;
            
            $.ajax({
               url : "<?php echo base_url(); ?>index.php/transaksi/lain/simpanitem",
               data : isi,
               type: 'get',
               success: function(data){
                   if (data=="sukses"){
                      //alert("Sukses gan");
                      resetTransaksi();
                      $('#list_transaksi_lain').trigger('reloadGrid');
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
        
        var grid2 = $("#list_transaksi_lain");
        grid2.jqGrid({
        url: '<?php echo base_url() ?>index.php/transaksi/lain/json2',
        datatype: "json",
	height: "auto",
	mtype: "GET",
	colNames: ['Id','Action','Jenis Tagihan','Nama Tagihan','Harga Standart','Harga Satuan','Jumlah','Total','Selisih','Disetujui','Doses','Rekomendasi'],
	colModel: [
                    {name:'id_item_transaksi_lain', key:true, index:'id_item_transaksi_lain', hidden:true,editable:false,  editrules:{required:true}},
                    {name: 'myac', width:40, fixed:true, sortable:false, search:false, align:'center', viewable: false, resizable: false, resize:false, formatter:'actions',
                        formatoptions:{keys:true,editbutton:false, delbutton: true}
                    },
                    {name:'jenis_item',index:'jenis_item',width:70,editable:true,editrules:{required:true}},
                    {name:'nama_item',index:'nama_item',width:70,editable:true,editrules:{required:true}},
                    {name:'harga_item',index:'harga_item',width:70,editable:true,editrules:{required:true}},
                    {name:'harga_satuan',index:'harga_satuan',width:70,editable:true,editrules:{required:true}},                    
                    {name:'jumlah',index:'jumlah',width:70,editable:true,editrules:{required:true}},                    
                    {name:'total',index:'total',width:70,editable:true,editrules:{required:true}},
                    {name:'selisih',index:'selisih',width:70,editable:true,editrules:{required:true}},                    
                    {name:'disetujui',index:'disetujui',width:70,editable:true,editrules:{required:true}},
                    {name:'nama_dosis',index:'nama_dosis',width:70,editable:true,editrules:{required:true}},
                    {name:'nama_rekomendasi',index:'nama_rekomendasi',width:100,editable:true,editrules:{required:true}},                    
                    ],
        rownumbers:true,
	rowNum: 20,
	rowList: [10,20,30],
        postData: {idkunj : function(){
                    return id_kunjungan;
                  }},
        width:630,
	pager: '#pager_transaksi_lain',
	sortname: 'id_item_transaksi_lain',
        shrinkToFit: false,
	viewrecords: true,
	sortorder: "desc",
	editurl: '<?php echo base_url() ?>index.php/transaksi/lain/crud2', //URL Proses CRUD Nya
	multiselect: false, 
	caption: "Hasil Transaksi" //Caption List					
    });
    grid2.jqGrid('navGrid','#pager_transaksi_lain',{search:false, view:true,edit:false,add:false,del:true},{},{},{});				    
});
function isNumberKey(evt)
    {
        var charCode = (evt.which) ? evt.which : event.keyCode
	if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
	
        return true;
    }
</script>
<div id="trans_lain" style="width: auto; height: auto; overflow: auto;">
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
                                    <input type="hidden" name="id_kunjungan_lain" id="id_kunjungan_lain">
                                    <tr>
                                        <td>Pegawai:</td>
                                        <td><input type="text" name="pegawai_lain" id="pegawai_lain" /></td>
                                    </tr>
                                    <tr>
                                        <td>Pasien:</td>
                                        <td><select id="pasien_lain" name="pasien_lain" style="width: 110px">
                                                <option>Pilih Pasien</option>
                                            </select></td>
                                    </tr>
                                    <tr>
                                        <td>Rujukan:</td>
                                        <td><select id="rujukan_lain" name="rujukan_lain" style="width: 110px">
                                                <option>Pilih Rujukan</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Dokter:</td>
                                        <td><input type="text" name="dokter_lain" id="dokter_lain"></td>
                                    </tr>
                                    <tr>
                                        <td>Provider:</td>
                                        <td><input type="text" name="provider_lain" id="provider_lain"></td>
                                    </tr>
                                </table>
                            </td>
                            <td style="vertical-align: top">
                                <table width="265">
                                    <tr>
                                        <td>NIP:</td>
                                        <td>
                                            <input type="text" name="nip_lain" id="nip_lain">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Tgl. Transaksi:</td>
                                        <td>
                                            <input type="text" name="tgl_trans_lain" id="tgl_trans_lain">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>No. Surat:</td>
                                        <td>
                                            <input type="text" name="no_surat_lain" id="no_surat_lain">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>No. Bukti:</td>
                                        <td>
                                            <input type="text" name="no_bukti_lain" id="no_bukti_lain">
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <td>
                                <table width="265">
                                    <tr>
                                        <td>Bagian:</td>
                                        <td><input type="text" name="bagian_lain" id="bagian_lain"></td>
                                    </tr>
                                    <tr>
                                        <td>Tgl. Kunjungan:</td>
                                        <td><input type="text" name="tgl_kun_lain" id="tgl_kun_lain"></td>
                                    </tr>
                                    <tr>
                                        <td>Buku Besar:</td>
                                        <td><input type="text" name="buku_besar_lain" id="buku_besar_lain"></td>
                                    </tr>
                                    <tr>
                                        <td>Restitusi:</td>
                                        <td><input type="checkbox" name="restitusi_lain" id="restitusi_lain"></td>
                                    </tr>
                                    <tr>
                                        <td><input type="submit" value="Simpan" class="button_lain"></td>
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
                                                 <input type="text" name="diagnosa_lain" id="diagnosa_lain">
                                            </td>
                                            <td>
                                            <input type="submit" value="add" class="button_diag_lain">
                                            </td>
                                            </tr>
                                           </table>
                                        </td>
                                    </tr>
                                </table>
                            </form>
                            <table id="list_diagnosa_lain" class="scroll" cellpadding="0" cellspacing="0"></table>
                            <div id="pager_diagnosa_lain" class="scroll" style="text-align:center;"></div>
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
                                                    <td><select id="jenis_tagihan_lain" name="jenis_tagihan_lain" style="width: 110px">
                                                            <option>Jenis Tagihan</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Nama Tagihan:</td>
                                                    <td><input type="text" name="nama_tagihan_lain" id="nama_tagihan_lain"/></td>
                                                </tr>
                                                <tr>
                                                    <td>Harga Standart:</td>
                                                    <td><input type="text" name="harga_standart_lain" id="harga_standart_lain" onkeypress="return isNumberKey(event)"/></td>
                                                </tr>
                                                <tr>
                                                    <td>Harga Satuan:</td>
                                                    <td><input type="text" name="harga_satuan_lain" id="harga_satuan_lain" onkeypress="return isNumberKey(event)"/></td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td style="vertical-align: top">
                                            <table width="210">
                                                <tr>
                                                    <td>Jumlah:</td>
                                                    <td><input type="text" name="jumlah_lain" id="jumlah_lain" onkeypress="return isNumberKey(event)"/></td>
                                                </tr>
                                                <tr>
                                                    <td>Total:</td>
                                                    <td><input type="text" name="total_lain" id="total_lain"/></td>
                                                </tr>
                                                <tr>
                                                    <td>Selisih:</td>
                                                    <td><input type="text" name="selisih_trans_lain" id="selisih_trans_lain"/></td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td style="vertical-align: top">
                                            <table width="210">
                                                <tr>
                                                    <td>Disetujui:</td>
                                                    <td>
                                                        <select id="disetujui_lain" name="disetujui_lain" style="width: 110px">
                                                            <option value="y">Ya</option>
                                                            <option value="t">Tidak</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Doses:</td>
                                                    <td><input type="text" name="doses_lain" id="doses_lain"/></td>
                                                </tr>
                                                <tr>
                                                    <td>Rekomendasi:</td>
                                                    <td><input type="text" name="rekomendasi_lain" id="rekomendasi_lain"/></td>
                                                </tr>
                                                <tr>
                                                    <td><input type="submit" value="Tambah" class="button_trans_lain"/></td>
                                                    <td></td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </form>
                            <table id="list_transaksi_lain" class="scroll" cellpadding="0" cellspacing="0"></table>
                            <div id="pager_transaksi_lain" class="scroll" style="text-align:center;"></div>
                        </fieldset>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>  
</div>
                                                                 