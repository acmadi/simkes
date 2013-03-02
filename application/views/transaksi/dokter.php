<script type="text/javascript" >	 
$(this).ready( function() {
	var data_dokter;        
        var id_kunjungan,
            id_dokter,
            //id_apotek,
            id_pegawai,
            id_item,
            id_doses,
            id_diagnosa,
            id_rekom;
        $("#nip_dokter").attr('disabled','disabled');
		$("#bagian_dokter").attr('disabled','disabled');
        $("#selisih_dokter").attr('disabled','disabled');
        $("#total_dokter").attr('disabled','disabled');
        $("#selisih_trans_dokter").attr('disabled','disabled');
        
        $(".button_dokter").button();
        $(".button_diag_dokter").button();
        $(".button_trans_dokter").button();
        
        $( "#tgl_trans_dokter" ).datepicker({
            changeMonth: true,
            changeYear: true,
            showOn: "button",
            buttonImage : "<?php echo base_url();?>asset/images/calendar.gif",				
            buttonImageOnly : true
	});
        
	$( "#tgl_kun_dokter" ).datepicker({
            changeMonth     : true, // menampilkan dropdown untuk ganti bulan
            changeYear      : true, // menampilkan dropdown untuk ganti Tahun
            showOn          : "button",
            buttonImage     : "<?php echo base_url();?>asset/images/calendar.gif",				
            buttonImageOnly : true
	});	

        $("#pegawai_dokter").autocomplete({
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
                    $("#nip_dokter").val(nip);
                    $("#id_bagian_dokter").val(ui.item.id); 
                    id_pegawai=nip;
                    bagian(id_bag);
                    pasien(ui.item.id);
                    tagihan();
                }
        });        
              
	function bagian(id_bag){
            $.ajax({
               url : "<?php echo base_url(); ?>index.php/transaksi/dokter/bagian",
               data : "id="+id_bag,
               type: 'POST',
               success: function(data){
                   $("#bagian_dokter").val(data);
               },
               error: function(e){
                   alert("error bagian : "+e)
               }
            });
        }
        
        function pasien(nip){
            $.ajax({
               url : "<?php echo base_url(); ?>index.php/transaksi/dokter/pasien",
               data : "id="+nip,
               type: 'POST',
               success: function(data){
                   $('#pasien_dokter').html(data);
               },
               error: function(e){
                   alert("error pasien : "+e)
               }
            });
        }
        
        $("#dokter_dokter").autocomplete({
            minLength: 1,
            source:
            function(req, add){
                $.ajax({
                    url: "<?php echo base_url(); ?>index.php/transaksi/dokter/lookdokter",
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
                    $('#tarif_standart_dokter').val(ui.item.satuan);
                    $('#tarif_satuan_dokter').val(ui.item.standar);
                    selisihDokter();
                }
        });

        function selisihDokter(){
            var a=$('#tarif_standart_dokter').val();
            var b=$('#tarif_satuan_dokter').val();
            $('#selisih_dokter').val(a-b);
        }
        
        $('#tarif_standart_dokter').keyup(function(){
            selisihDokter();
        }); 
        
        $('#tarif_satuan_dokter').keyup(function(){
            selisihDokter();
        });
                       
	function resetKunjungan(){
            $('#pegawai_dokter').val("");
            $('#pasien_dokter').val("");
            $('#dokter_dokter').val("");
            $('#tarif_standart_dokter').val("");
            $('#tarif_satuan_dokter').val("");
            $('#nip_dokter').val("");
            $('#tgl_trans_dokter').val("");
            $('#no_surat_dokter').val("");
            $('#no_bukti_dokter').val("");
            $('#selisih_dokter').val("");
            $('#bagian_dokter').val("");
            $('#tgl_kun_dokter').val("");
            $('#buku_besar_dokter').val("");          
            $('#restitusi_dokter').attr('checked', false);
        }
        
        $(".button_dokter").click(function() {                                         
            if ($('#pegawai_dokter').val() == '') {
                alert('Pegawai harus di isi');
                $('#pegawai_dokter').focus();
                return false;
            } 
            if ($('#buku_besar_dokter').val() == '') {                
                alert('buku besar harus di isi');
                $('#buku_besar_dokter').focus();
                return false;
            }
            if (id_pegawai == undefined) {                
                alert('Anda harus memasukkan data karyawan di master karyawan');
                return false;
            }
            
            var //pegawai = $('#pegawai_dokter').val(),
                pasien = $('#pasien_dokter').val(),                
                dokter = $('#dokter_dokter').val(),
                tarif_standart = $('#tarif_standart_dokter').val(),
                tarif_satuan = $('#tarif_satuan_dokter').val(),
                //nip = $('#nip_dokter').val(),
                tgl_trans = $('#tgl_trans_dokter').val(),
                no_surat = $('#no_surat_dokter').val(),
                no_bukti = $('#no_bukti_dokter').val(),
                //selisih = $('#selisih_dokter').val(),
                //bagian = $('#bagian_dokter').val(),
                tgl_kun = $('#tgl_kun_dokter').val(),                
                buku_besar = $('#buku_besar_dokter').val(),                
                restitusi;                
                if ($("#restitusi_dokter").is(":checked")){
                    restitusi="y";
                } else {
                    restitusi="t";
                } 
                                            
            data_dokter = "&pasien="+pasien+"&id_dokter="+id_dokter+"&dokter="+dokter+"&tarif_standart="+tarif_standart+"&tarif_satuan="+tarif_satuan
                            +"&tgl_trans="+tgl_trans+"&no_surat="+no_surat+"&no_bukti="+no_bukti
                            +"&tgl_kun="+tgl_kun+"&buku_besar="+buku_besar+"&restitusi="+restitusi;            
            $.ajax({
               url : "<?php echo base_url(); ?>index.php/transaksi/dokter/simpandata",
               data : data_dokter,
               type: 'get',
               success: function(data){
                   if (data!=null){
                      alert("Data tersimpan : "+data);
                      id_kunjungan=data;
                      resetKunjungan(); 
                      $('#list_diagnosa_dokter').trigger('reloadGrid');
                      $('#list_transaksi_dokter').trigger('reloadGrid');
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
        
        $("#diagnosa_dokter").autocomplete({
            minLength: 1,
            source:
            function(req, add){
                $.ajax({
                    url: "<?php echo base_url(); ?>index.php/transaksi/dokter/lookdiagnosa",
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
        
        $(".button_diag_dokter").click(function() {
            var diagnosa = $('#diagnosa_dokter').val();            
            if (diagnosa == '') {
                alert('Diagnosa harus di isi');
                $('#diagnosa_dokter').focus();
                return false;
            }
            if (id_kunjungan == undefined) {                
                alert('Isi Data Kunjungan dulu');
                //alert(diagnosa+":"+id_diagnosa);
                $('#pegawai_dokter').focus();
                return false;
            }
            //alert(diagnosa+":"+id_diagnosa+":"+id_kunjungan);
            $.ajax({
               url : "<?php echo base_url(); ?>index.php/transaksi/dokter/simpandiagnosa",
               data : "id="+id_kunjungan+"&diag="+diagnosa+"&id_diagnosa="+id_diagnosa,
               type: 'get',
               success: function(data){
                   if (data=="sukses"){
                       //resetDiagnosa();
                       $('#list_diagnosa_dokter').trigger('reloadGrid');
                   } else {
                       alert("Gagal Menyimpan data");
                   } 
               },
               error: function(e){
                   alert("error pasien : "+e)
               }
            });
            $('#diagnosa_dokter').val("");
            return false;
        });
        
        var grid = $("#list_diagnosa_dokter");
    grid.jqGrid({
        url: '<?php echo base_url() ?>index.php/transaksi/dokter/json', 
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
	pager: '#pager_diagnosa_dokter',
	sortname: 'id_transaksi_diagnosa',
	viewrecords: true,
        shrinkToFit: false,
	sortorder: "desc",
	editurl: '<?php echo base_url() ?>index.php/transaksi/dokter/crud', //URL Proses CRUD Nya
	multiselect: false, 
	caption: "Hasil Diagnosa" //Caption List					
    });
    grid.jqGrid('navGrid','#pager_diagnosa_dokter',{search:false,view:false,edit:false,add:false,del:true},{},{},{});
                        
  //kanggo transaksi      
        function tagihan(){
            $.ajax({
               url : "<?php echo base_url(); ?>index.php/transaksi/dokter/tagihan",
               type: 'POST',
               success: function(data){
                   $('#jenis_tagihan_dokter').html(data);
               },
               error: function(e){
                   alert("error rujukan : "+e)
               }
            });
        }
        
        $("#nama_tagihan_dokter").autocomplete({
            minLength: 1,
            source:
            function(requ, add){
                var id_jenis=$('#jenis_tagihan_dokter').val();
                var isi =$("#nama_tagihan_dokter").val();
                if (id_jenis == '') {
                    alert('Jenis Tagihan Harus Dipilih');
                    $("#nama_tagihan_dokter").val("");
                    $('.ui-autocomplete-loading').removeClass("ui-autocomplete-loading");
                    $('#jenis_tagihan_dokter').focus();
                    return false;
                }
                
                $.ajax({
                    url: "<?php echo base_url(); ?>index.php/transaksi/dokter/looktagihan",
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
                                id_item=undefined;
                                $("#harga_standart_dokter").val(""); 
                            }                         
                        }                    
                });
            },
            select:
                function(event, ui) {
                    $("#harga_standart_dokter").val(ui.item.harga); 
                    id_item=ui.item.id;
                }
        });
        
        $('#jenis_tagihan_dokter').change(function(){
            $('#nama_tagihan_dokter').val("");
            $('#harga_standart_dokter').val("");
            id_item=undefined;
        });
        
        function hitungSelisih(){
            var a=$('#harga_standart_dokter').val();
            var b=$('#harga_satuan_dokter').val();            
            var c=$('#jumlah_dokter').val();
            
            $('#total_dokter').val(b*c);
            $('#selisih_trans_dokter').val(a*c-b*c);
        }
        
        $('#harga_standart_dokter').keyup(function(){
            hitungSelisih();
        });
        
        $('#harga_satuan_dokter').keyup(function(){
            hitungSelisih();
        });
        
        $('#jumlah_dokter').keyup(function(){
            hitungSelisih();       
        });
        
        $("#doses_dokter").autocomplete({
            minLength: 1,
            source:
            function(req, add){
                $.ajax({
                    url: "<?php echo base_url(); ?>index.php/transaksi/dokter/lookdosis",
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
        
        $("#rekomendasi_dokter").autocomplete({
            minLength: 1,
            source:
            function(req, add){
                $.ajax({
                    url: "<?php echo base_url(); ?>index.php/transaksi/dokter/lookrekomendasi",
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
        
        $('#jumlah_dokter').keyup(function(){
            var a=$('#harga_standart_dokter').val();
            var b=$('#harga_satuan_dokter').val();            
            var c=$('#jumlah_dokter').val();
            if (a == '') {
                alert('harga standart harus di isi dulu');
                $('#harga_standart_dokter').focus();
                return false;
            }
            if (b == '') {
                alert('harga satuan harus di isi dulu');
                $('#harga_satuan_dokter').focus();
                return false;
            }
            $('#total_dokter').val(b*c);
            $('#selisih_trans_dokter').val(a*c-b*c);            
        });
        
        function resetTransaksi(){
            $('#jenis_tagihan_dokter').val("");
            $('#nama_tagihan_dokter').val("");
            $('#harga_standart_dokter').val("");
            $('#harga_satuan_dokter').val("");
            $('#jumlah_dokter').val("");
            $('#total_dokter').val("");
            $('#selisih_trans_dokter').val("");
            $('#disetujui_dokter').val("");
            $('#doses_dokter').val("");
            $('#rekomendasi_dokter').val("");
        }
        
        $(".button_trans_dokter").click(function() {
            if ($('#nama_tagihan_dokter').val() == '') {
                alert('Nama Tagihan harus di isi');
                $('#nama_tagihan_dokter').focus();
                return false;
            }
            if (id_kunjungan == undefined) {                
                alert('Isi Data Kunjungan dulu');
                $('#pegawai_dokter').focus();
                return false;
            }
            if ($('#doses_dokter').val() == '') {
                alert('Doses harus di isi');
                $('#doses_dokter').focus();
                return false;
            }
            var jenis_tagihan = $('#jenis_tagihan_dokter').val(),
                nama_tagihan = $('#nama_tagihan_dokter').val(),
                harga_standart = $('#harga_standart_dokter').val(),
                harga_satuan = $('#harga_satuan_dokter').val(),
                jumlah = $('#jumlah_dokter').val(),
                //total = $('#total_dokter').val(),
                //selisih_transaksi = $('#selisih_trans_dokter').val(),
                disetujui = $('#disetujui_dokter').val(),
                doses = $('#doses_dokter').val(),
                rekomendasi = $('#rekomendasi_dokter').val();
            var isi;             
            isi="&jenis_tagihan="+jenis_tagihan+"&kunjungan="+id_kunjungan+"&nama_tagihan="+nama_tagihan+"&harga_standart="+harga_standart+"&harga_satuan="+harga_satuan
                +"&id_item="+id_item+"&jumlah="+jumlah+"&disetujui="+disetujui+"&id_dosis="+id_doses+"&dosis="+doses+"&id_rekomendasi="+id_rekom+"&rekomendasi="+rekomendasi;
            
            $.ajax({
               url : "<?php echo base_url(); ?>index.php/transaksi/dokter/simpanitem",
               data : isi,
               type: 'get',
               success: function(data){
                   if (data!=null){
                      //alert("Sukses gan");
                      resetTransaksi();
                      $('#list_transaksi_dokter').trigger('reloadGrid');
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
        
        var grid2 = $("#list_transaksi_dokter");
        grid2.jqGrid({
        url: '<?php echo base_url() ?>index.php/transaksi/dokter/json2',
        datatype: "json",
	height: "auto",
	mtype: "GET",
	colNames: ['Id','Action','Jenis Tagihan','Nama Tagihan','Harga Standart','Harga Satuan','Jumlah','Total','Selisih','Disetujui','Doses','Rekomendasi'],
	colModel: [
                    {name:'id_transaksi_dokter', key:true, index:'id_transaksi_dokter', hidden:true,editable:false,  editrules:{required:true}},
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
	pager: '#pager_transaksi_dokter',
	sortname: 'id_transaksi_dokter',
        shrinkToFit: false,
	viewrecords: true,
	sortorder: "desc",
	editurl: '<?php echo base_url() ?>index.php/transaksi/dokter/crud2', //URL Proses CRUD Nya
	multiselect: false, 
	caption: "Hasil Transaksi" //Caption List					
    });
    grid2.jqGrid('navGrid','#pager_transaksi_dokter',{search:false, view:true,edit:false,add:false,del:true},{},{},{});				    
});
function isNumberKey(evt)
    {
        var charCode = (evt.which) ? evt.which : event.keyCode
	if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
	
        return true;
    }
</script>
<div id="trans_dokter" style="width: auto; height: auto; overflow: auto;">
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
                                    <input type="hidden" name="id_kunjungan_dokter" id="id_kunjungan_dokter">
                                    <tr>
                                        <td>Pegawai:</td>
                                        <td><input type="text" name="pegawai_dokter" id="pegawai_dokter"></td>
                                    </tr>
                                    <tr>
                                        <td>Pasien:</td>
                                        <td><select id="pasien_dokter" name="pasien_dokter" style="width: 110px">
                                                <option>Pilih Pasien</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Dokter:</td>
                                        <td><input type="text" name="dokter_dokter" id="dokter_dokter"></td>
                                    </tr>
                                    <tr>
                                        <td>Tarif Standart:</td>
                                        <td><input type="text" name="tarif_standart_dokter" id="tarif_standart_dokter" onkeypress="return isNumberKey(event)"></td>
                                    </tr>
                                    <tr>
                                        <td>Tarif Satuan:</td>
                                        <td><input type="text" name="tarif_satuan_dokter" id="tarif_satuan_dokter" onkeypress="return isNumberKey(event)"></td>
                                    </tr>
                                </table>
                            </td>
                            <td>
                                <table width="265">
                                    <tr>
                                        <td>NIP:</td>
                                        <td>
                                            <input type="text" name="nip_dokter" id="nip_dokter">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Tgl. Transaksi:</td>
                                        <td>
                                            <input type="text" name="tgl_trans_dokter" id="tgl_trans_dokter">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>No. Surat:</td>
                                        <td>
                                            <input type="text" name="no_surat_dokter" id="no_surat_dokter">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>No. Bukti:</td>
                                        <td>
                                            <input type="text" name="no_bukti_dokter" id="no_bukti_dokter">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Selisih:</td>
                                        <td><input type="text" name="selisih_dokter" id="selisih_dokter"></td>
                                    </tr>
                                </table>
                            </td>
                            <td style="vertical-align: top">
                                <table width="265">
                                    <tr>
                                        <td>Bagian:</td>
                                        <td><input type="text" name="bagian_dokter" id="bagian_dokter"></td>
                                    </tr>
                                    <tr>
                                        <td>Tgl. Kunjungan:</td>
                                        <td><input type="text" name="tgl_kun_dokter" id="tgl_kun_dokter"></td>
                                    </tr>
                                    <tr>
                                        <td>Buku Besar:</td>
                                        <td><input type="text" name="buku_besar_dokter" id="buku_besar_dokter"></td>
                                    </tr>
                                    <tr>
                                        <td>Restitusi:</td>
                                        <td><input type="checkbox" name="restitusi_dokter" id="restitusi_dokter"></td>
                                    </tr>
                                    <tr>
                                        <td><input type="submit" value="Simpan" class="button_dokter"></td>
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
                                                 <input type="text" name="diagnosa_dokter" id="diagnosa_dokter">
                                            </td>
                                            <td>
                                            <input type="submit" value="add" class="button_diag_dokter">
                                            </td>
                                            </tr>
                                           </table>
                                        </td>
                                    </tr>
                                </table>
                            </form>
                            <table id="list_diagnosa_dokter" class="scroll" cellpadding="0" cellspacing="0"></table>
                            <div id="pager_diagnosa_dokter" class="scroll" style="text-align:center;"></div>
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
                                                    <td><select id="jenis_tagihan_dokter" name="jenis_tagihan_dokter" style="width: 110px">
                                                            <option>Jenis Tagihan</option>
                                                        </select>

                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Nama Tagihan:</td>
                                                    <td><input type="text" name="nama_tagihan_dokter" id="nama_tagihan_dokter" /></td>
                                                </tr>
                                                <tr>
                                                    <td>Harga Standart:</td>
                                                    <td><input type="text" name="harga_standart_dokter" id="harga_standart_dokter" onkeypress="return isNumberKey(event)" /></td>
                                                </tr>
                                                <tr>
                                                    <td>Harga Satuan:</td>
                                                    <td><input type="text" name="harga_satuan_dokter" id="harga_satuan_dokter" onkeypress="return isNumberKey(event)" /></td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td style="vertical-align: top">
                                            <table width="210">
                                                <tr>
                                                    <td>Jumlah:</td>
                                                    <td><input type="text" name="jumlah_dokter" id="jumlah_dokter" onkeypress="return isNumberKey(event)" /></td>
                                                </tr>
                                                <tr>
                                                    <td>Total:</td>
                                                    <td><input type="text" name="total_dokter" id="total_dokter" /></td>
                                                </tr>
                                                <tr>
                                                    <td>Selisih:</td>
                                                    <td><input type="text" name="selisih_trans_dokter" id="selisih_trans_dokter" /></td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td style="vertical-align: top">
                                            <table width="210">
                                                <tr>
                                                    <td>Disetujui:</td>
                                                    <td>
                                                        <select id="disetujui_dokter" name="disetujui_dokter" style="width: 110px">
                                                            <option>Ya</option>
                                                            <option>Tidak</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Doses:</td>
                                                    <td><input type="text" name="doses_dokter" id="doses_dokter" /></td>
                                                </tr>
                                                <tr>
                                                    <td>Rekomendasi:</td>
                                                    <td><input type="text" name="rekomendasi_dokter" id="rekomendasi_dokter" /></td>
                                                </tr>
                                                <tr>
                                                    <td><input type="submit" value="Tambah" class="button_trans_dokter" /></td>
                                                    <td></td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </form>
                            <table id="list_transaksi_dokter" class="scroll" cellpadding="0" cellspacing="0"></table>
                            <div id="pager_transaksi_dokter" class="scroll" style="text-align:center;"></div>
                        </fieldset>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</div>
                                                                   