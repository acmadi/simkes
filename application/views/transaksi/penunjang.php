<script type="text/javascript" >	 
$(this).ready( function() {
	var data_penunjang;        
        var id_kunjungan,
            id_dokter,
            id_pegawai,
            id_item,
            id_provider,
            id_diagnosa,
            id_rekom;
        $("#nip_penunjang").attr('disabled','disabled');
		$("#bagian_penunjang").attr('disabled','disabled');
        $("#selisih_penunjang").attr('disabled','disabled');
        $("#total_penunjang").attr('disabled','disabled');
        $("#selisih_trans_penunjang").attr('disabled','disabled');
        
        $(".button_penunjang").button();
        $(".button_diag_penunjang").button();
        $(".button_trans_penunjang").button();
        
        $( "#tgl_trans_penunjang" ).datepicker({
            changeMonth: true,
            changeYear: true,
            showOn: "button",
            buttonImage : "<?php echo base_url();?>asset/images/calendar.gif",				
            buttonImageOnly : true
	});
        
	$( "#tgl_kun_penunjang" ).datepicker({
            changeMonth     : true, // menampilkan dropdown untuk ganti bulan
            changeYear      : true, // menampilkan dropdown untuk ganti Tahun
            showOn          : "button",
            buttonImage     : "<?php echo base_url();?>asset/images/calendar.gif",				
            buttonImageOnly : true
	});	

        $("#pegawai_penunjang").autocomplete({
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
                    id_pegawai=nip;
                    $("#nip_penunjang").val(nip);
                    $("#id_bagian_penunjang").val(ui.item.id); 
                    bagian(id_bag);
                    rujukan();
                    pasien(ui.item.id);
                    //kunjungan();
                    tagihan();
                }
        });        
              
	function bagian(id_bag){
            $.ajax({
               url : "<?php echo base_url(); ?>index.php/transaksi/penunjang/bagian",
               data : "id="+id_bag,
               type: 'POST',
               success: function(data){
                   $("#bagian_penunjang").val(data);
               },
               error: function(e){
                   alert("error bagian : "+e)
               }
            });
        }
        
        function pasien(nip){
            $.ajax({
               url : "<?php echo base_url(); ?>index.php/transaksi/penunjang/pasien",
               data : "id="+nip,
               type: 'POST',
               success: function(data){
                   $('#pasien_penunjang').html(data);
               },
               error: function(e){
                   alert("error pasien : "+e)
               }
            });
        }
        
        function rujukan(){
            $.ajax({
               url : "<?php echo base_url(); ?>index.php/transaksi/penunjang/rujukan",
               type: 'POST',
               success: function(data){
                   $('#rujukan_penunjang').html(data);
               },
               error: function(e){
                   alert("error rujukan : "+e)
               }
            });
        }
        /*
        function kunjungan(){
            $.ajax({
               url : "<?php echo base_url(); ?>index.php/transaksi/penunjang/kunjungan",
               type: 'POST',
               success: function(data){
                   $('#kunjungan_penunjang').html(data);
               },
               error: function(e){
                   alert("Error Kunjungan : "+e)
               }
            });
        }
        */
        $("#dokter_penunjang").autocomplete({
            minLength: 1,
            source:
            function(req, add){
                var id_rujukan=$('#rujukan_penunjang').val();
                var isi =$("#dokter_penunjang").val();
                if (id_rujukan == '')
                {
                    alert('Jenis Rujukan Harus Dipilih');
                    $("#dokter_penunjang").val("");
                    $('.ui-autocomplete-loading').removeClass("ui-autocomplete-loading");
                    $('#rujukan_penunjang').focus();
                    return false;
                }
                $.ajax({
                    url: "<?php echo base_url(); ?>index.php/transaksi/penunjang/lookdokter",
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
        
        $("#provider_penunjang").autocomplete({
            minLength: 1,
            source:
            function(req, add){
                $.ajax({
                    url: "<?php echo base_url(); ?>index.php/transaksi/penunjang/lookprovider",
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
            $('#pegawai_penunjang').val("");
            $('#pasien_penunjang').val("");
            $('#dokter_penunjang').val("");
            $('#rujukan_penunjang').val("");
            $('#provider_penunjang').val("");
            $('#nip_penunjang').val("");
            $('#tgl_trans_penunjang').val("");
            $('#no_surat_penunjang').val("");
            $('#no_bukti_penunjang').val("");
            $('#bagian_penunjang').val("");
            $('#tgl_kun_penunjang').val("");
            $('#buku_besar_penunjang').val("");          
            $('#restitusi_penunjang').attr('checked', false);
        }
        
        $(".button_penunjang").click(function() {                                         
            if ($('#pegawai_penunjang').val() == '') {
                alert('Pegawai harus di isi');
                $('#pegawai_penunjang').focus();
                return false;
            } 
            if ($('#buku_besar_penunjang').val() == '') {                
                alert('buku besar harus di isi');
                $('#buku_besar_penunjang').focus();
                return false;
            }
            if (id_pegawai == undefined) {                
                alert('Anda harus memasukkan data karyawan di master karyawan');
                return false;
            }
            
            var pegawai = $('#pegawai_penunjang').val(),
                pasien = $('#pasien_penunjang').val(),                
                dokter = $('#dokter_penunjang').val(),
                rujukan = $('#rujukan_penunjang').val(),
                provider = $('#provider_penunjang').val(),
                nip = $('#nip_penunjang').val(),
                tgl_trans = $('#tgl_trans_penunjang').val(),
                no_surat = $('#no_surat_penunjang').val(),
                no_bukti = $('#no_bukti_penunjang').val(),
                //selisih = $('#selisih_penunjang').val(),
                bagian = $('#bagian_penunjang').val(),
                tgl_kun = $('#tgl_kun_penunjang').val(),                
                buku_besar = $('#buku_besar_penunjang').val(),                
                restitusi;                
                if ($("#restitusi_penunjang").is(":checked")){
                    restitusi="y";
                } else {
                    restitusi="t";
                }                                             
                 
            data_penunjang = "&pasien="+pasien+"&id_dokter="+id_dokter
                +"&dokter="+dokter+"&rujukan="+rujukan+"&id_provider="+id_provider+"&provider="+provider
                +"&tgl_trans="+tgl_trans+"&no_surat="+no_surat+"&no_bukti="+no_bukti
                +"&bagian="+bagian+"&tgl_kun="+tgl_kun+"&buku_besar="+buku_besar+"&restitusi="+restitusi;   
            //alert(data_penunjang);
            //return false;
            $.ajax({
               url : "<?php echo base_url(); ?>index.php/transaksi/penunjang/simpandata",
               data : data_penunjang,
               type: 'get',
               success: function(data){
                   if (data!=null){
                      alert("Data tersimpan : "+data);
                      id_kunjungan=data;
                      resetKunjungan();       
                      $('#list_diagnosa_penunjang').trigger('reloadGrid');
                      $('#list_transaksi_penunjang').trigger('reloadGrid');
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
        
        $("#diagnosa_penunjang").autocomplete({
            minLength: 1,
            source:
            function(req, add){
                $.ajax({
                    url: "<?php echo base_url(); ?>index.php/transaksi/penunjang/lookdiagnosa",
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
        
        $(".button_diag_penunjang").click(function() {
            var diagnosa = $('#diagnosa_penunjang').val();            
            if (diagnosa == '') {
                alert('Diagnosa harus di isi');
                $('#diagnosa_penunjang').focus();
                return false;
            }
            if (id_kunjungan == undefined) {                
                alert('Isi Data Kunjungan dulu');
                //alert(diagnosa+":"+id_diagnosa);
                $('#pegawai_penunjang').focus();
                return false;
            }
            //alert(diagnosa+":"+id_diagnosa+":"+id_kunjungan);
            $.ajax({
               url : "<?php echo base_url(); ?>index.php/transaksi/penunjang/simpandiagnosa",
               data : "id="+id_kunjungan+"&diag="+diagnosa+"&id_diagnosa="+id_diagnosa,
               type: 'get',
               success: function(data){
                   if (data=="sukses"){
                       //resetDiagnosa();
                       $('#list_diagnosa_penunjang').trigger('reloadGrid');
                   } else {
                       alert("Gagal Menyimpan data");
                   } 
               },
               error: function(e){
                   alert("error pasien : "+e)
               }
            });
            $('#diagnosa_penunjang').val("");
            return false;
        });
        
        var grid = $("#list_diagnosa_penunjang");
    grid.jqGrid({
        url: '<?php echo base_url() ?>index.php/transaksi/penunjang/json', 
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
	pager: '#pager_diagnosa_penunjang',
	sortname: 'id_transaksi_diagnosa',
	viewrecords: true,
        shrinkToFit: false,
	sortorder: "desc",
	editurl: '<?php echo base_url() ?>index.php/transaksi/penunjang/crud', //URL Proses CRUD Nya
	multiselect: false, 
	caption: "Hasil Diagnosa" //Caption List					
    });
    grid.jqGrid('navGrid','#pager_diagnosa_penunjang',{search:false,view:false,edit:false,add:false,del:true},{},{},{});
                        
  //kanggo transaksi      
        function tagihan(){
            $.ajax({
               url : "<?php echo base_url(); ?>index.php/transaksi/penunjang/tagihan",
               type: 'POST',
               success: function(data){
                   $('#jenis_tagihan_penunjang').html(data);
               },
               error: function(e){
                   alert("error tagihan : "+e)
               }
            });
        } 
        
        $("#nama_tagihan_penunjang").autocomplete({
            minLength: 1,
            source:
            function(requ, add){
                var id_jenis=$('#jenis_tagihan_penunjang').val();
                var isi =$("#nama_tagihan_penunjang").val();
                if (id_jenis == '') {
                    alert('Jenis Tagihan Harus Dipilih');
                    $("#nama_tagihan_penunjang").val("");
                    $('.ui-autocomplete-loading').removeClass("ui-autocomplete-loading");
                    $('#jenis_tagihan_penunjang').focus();
                    return false;
                }
                
                $.ajax({
                    url: "<?php echo base_url(); ?>index.php/transaksi/penunjang/looktagihan",
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
                                $("#harga_standart_penunjang").val(""); 
                            }                         
                        }                    
                });
            },
            select:
                function(event, ui) {
                    $("#harga_standart_penunjang").val(ui.item.harga); 
                    id_item=ui.item.id;
                }
        });
        
        $('#jenis_tagihan_penunjang').change(function(){
            $('#nama_tagihan_penunjang').val("");
            $('#harga_standart_penunjang').val("");
            id_item=undefined;
        });
        
        function hitungSelisih(){
            var a=$('#harga_standart_penunjang').val();
            var b=$('#harga_satuan_penunjang').val();            
            var c=$('#jumlah_penunjang').val();
            
            $('#total_penunjang').val(b*c);
            $('#selisih_trans_penunjang').val(a*c-b*c);
        }
        
        $('#harga_standart_penunjang').keyup(function(){
            hitungSelisih();
        });
        
        $('#harga_satuan_penunjang').keyup(function(){
            hitungSelisih();
        });
        
        $('#jumlah_penunjang').keyup(function(){
            hitungSelisih();       
        });
        
        $("#rekomendasi_penunjang").autocomplete({
            minLength: 1,
            source:
            function(req, add){
                $.ajax({
                    url: "<?php echo base_url(); ?>index.php/transaksi/penunjang/lookrekomendasi",
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
        
        function resetTransaksi(){
            $('#jenis_tagihan_penunjang').val("");
            $('#nama_tagihan_penunjang').val("");
            $('#harga_standart_penunjang').val("");
            $('#harga_satuan_penunjang').val("");
            $('#jumlah_penunjang').val("");
            $('#total_penunjang').val("");
            $('#selisih_trans_penunjang').val("");
            $('#disetujui_penunjang').val("");
            //$('#doses_penunjang').val("");
            $('#rekomendasi_penunjang').val("");
            $('#nilai_penunjang').val("");
            $('#kesimpulan_penunjang').val("");
        }
        
        $(".button_trans_penunjang").click(function() {
            if ($('#nama_tagihan_penunjang').val() == '') {
                alert('Nama Tagihan harus di isi');
                $('#nama_tagihan_penunjang').focus();
                return false;
            }
            if (id_kunjungan == undefined) {                
                alert('Isi Data Kunjungan dulu');
                $('#pegawai_penunjang').focus();
                return false;
            }
            if ($('#doses_penunjang').val() == '') {
                alert('Doses harus di isi');
                $('#doses_penunjang').focus();
                return false;
            }
            var jenis_tagihan = $('#jenis_tagihan_penunjang').val(),
                nama_tagihan = $('#nama_tagihan_penunjang').val(),
                harga_standart = $('#harga_standart_penunjang').val(),
                harga_satuan = $('#harga_satuan_penunjang').val(),
                jumlah = $('#jumlah_penunjang').val(),
                //total = $('#total_penunjang').val(),
                //selisih_transaksi = $('#selisih_trans_penunjang').val(),
                disetujui = $('#disetujui_penunjang').val(),
                //doses = $('#doses_penunjang').val(),
                nilai = $('#nilai_penunjang').val(),
                kesimpulan = $('#kesimpulan_penunjang').val(),
                rekomendasi = $('#rekomendasi_penunjang').val();
            var isi;             
            isi="&jenis_tagihan="+jenis_tagihan+"&id_item="+id_item+"&kunjungan="+id_kunjungan+"&nama_tagihan="+nama_tagihan+
                "&harga_standart="+harga_standart+"&harga_satuan="+harga_satuan+
                "&jumlah="+jumlah+"&disetujui="+disetujui+"&nilai="+nilai+"&id_rekomendasi="+id_rekom+"&rekomendasi="+rekomendasi+"&kesimpulan="+kesimpulan;
            //alert(isi);
            //return false;
            $.ajax({
               url : "<?php echo base_url(); ?>index.php/transaksi/penunjang/simpanitem",
               data : isi,
               type: 'get',
               success: function(data){
                   if (data!=null){
                      //alert("Sukses gan");
                      resetTransaksi();
                      $('#list_transaksi_penunjang').trigger('reloadGrid');
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
        
        var grid2 = $("#list_transaksi_penunjang");
        grid2.jqGrid({
        url: '<?php echo base_url() ?>index.php/transaksi/penunjang/json2',
        datatype: "json",
	height: "auto",
	mtype: "GET",
	colNames: ['Id','Action','Jenis Tagihan','Nama Tagihan','Harga Standart','Harga Satuan','Jumlah','Total','Selisih','Nilai','Disetujui','Rekomendasi','Kesimpulan'],
	colModel: [
                    {name:'id_item_transaksi_penunjang', key:true, index:'id_item_transaksi_penunjang', hidden:true,editable:false,  editrules:{required:true}},
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
                    {name:'nilai',index:'nilai',width:100,editable:true,editrules:{required:true}},
                    {name:'disetujui',index:'disetujui',width:70,editable:true,editrules:{required:true}},                    
                    {name:'nama_rekomendasi',index:'nama_rekomendasi',width:100,editable:true,editrules:{required:true}},
                    {name:'kesimpulan',index:'kesimpulan',width:100,editable:true,editrules:{required:true}},
                    ],
        rownumbers:true,
	rowNum: 20,
	rowList: [10,20,30],
        postData: {idkunj : function(){
                    return id_kunjungan;
                  }},
        width:630,
	pager: '#pager_transaksi_penunjang',
	sortname: 'id_item_transaksi_penunjang',
        shrinkToFit: false,
	viewrecords: true,
	sortorder: "desc",
	editurl: '<?php echo base_url() ?>index.php/transaksi/penunjang/crud2', //URL Proses CRUD Nya
	multiselect: false, 
	caption: "Hasil Transaksi" //Caption List					
    });
    grid2.jqGrid('navGrid','#pager_transaksi_penunjang',{search:false, view:true,edit:false,add:false,del:true},{},{},{});				    
});
function isNumberKey(evt)
    {
        var charCode = (evt.which) ? evt.which : event.keyCode
	if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
	
        return true;
    }
</script>
<div id="trans_penunjangi" style="width: auto; height: auto; overflow: auto;">
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
                                    <input type="hidden" name="id_kunjungan_penunjang" id="id_kunjungan_penunjang">
                                    <tr>
                                        <td>Pegawai:</td>
                                        <td><input type="text" name="pegawai_penunjang" id="pegawai_penunjang" /></td>
                                    </tr>
                                    <tr>
                                        <td>Pasien:</td>
                                        <td><select id="pasien_penunjang" name="pasien_penunjang" style="width: 110px" >
                                                <option>Pilih Pasien</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Rujukan:</td>
                                        <td><select id="rujukan_penunjang" name="rujukan_penunjang" style="width: 110px" >
                                                <option>Pilih Rajukan</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Dokter:</td>
                                        <td><input type="text" name="dokter_penunjang" id="dokter_penunjang"></td>
                                    </tr>
                                    <tr>
                                        <td>Provider:</td>
                                        <td><input type="text" name="provider_penunjang" id="provider_penunjang"></td>
                                    </tr>
                                </table>
                            </td>
                            <td style="vertical-align: top">
                                <table width="265">
                                    <tr>
                                        <td>NIP:</td>
                                        <td>
                                            <input type="text" name="nip_penunjang" id="nip_penunjang">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Tgl. Transaksi:</td>
                                        <td>
                                            <input type="text" name="tgl_trans_penunjang" id="tgl_trans_penunjang">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>No. Surat:</td>
                                        <td>
                                            <input type="text" name="no_surat_penunjang" id="no_surat_penunjang">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>No. Bukti:</td>
                                        <td>
                                            <input type="text" name="no_bukti_penunjang" id="no_bukti_penunjang">
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <td>
                                <table width="265">
                                    <tr>
                                        <td>Bagian:</td>
                                        <td><input type="text" name="bagian_penunjang" id="bagian_penunjang"></td>
                                    </tr>
                                    <tr>
                                        <td>Tgl. Kunjungan:</td>
                                        <td><input type="text" name="tgl_kun_penunjang" id="tgl_kun_penunjang"></td>
                                    </tr>
                                    <tr>
                                        <td>Buku Besar:</td>
                                        <td><input type="text" name="buku_besar_penunjang" id="buku_besar_penunjang"></td>
                                    </tr>
                                    <tr>
                                        <td>Restitusi:</td>
                                        <td><input type="checkbox" name="restitusi_penunjang" id="restitusi_penunjang"></td>
                                    </tr>
                                    <tr>
                                        <td><input type="submit" value="Simpan" class="button_penunjang"></td>
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
                                                 <input type="text" name="diagnosa_penunjang" id="diagnosa_penunjang">
                                            </td>
                                            <td>
                                            <input type="submit" value="add" class="button_diag_penunjang">
                                            </td>
                                            </tr>
                                           </table>
                                        </td>
                                    </tr>
                                </table>
                            </form>
                            <table id="list_diagnosa_penunjang" class="scroll" cellpadding="0" cellspacing="0"></table>
                            <div id="pager_diagnosa_penunjang" class="scroll" style="text-align:center;"></div>
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
                                                    <td><select id="jenis_tagihan_penunjang" name="jenis_tagihan_penunjang" style="width: 110px">
                                                            <option>Jenis Tagihan</option>
                                                        </select>

                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Nama Tagihan:</td>
                                                    <td><input type="text" name="nama_tagihan_penunjang" id="nama_tagihan_penunjang" /></td>
                                                </tr>
                                                <tr>
                                                    <td>Harga Standart:</td>
                                                    <td><input type="text" name="harga_standart_penunjang" id="harga_standart_penunjang" onkeypress="return isNumberKey(event)" /></td>
                                                </tr>
                                                <tr>
                                                    <td>Harga Satuan:</td>
                                                    <td><input type="text" name="harga_satuan_penunjang" id="harga_satuan_penunjang" onkeypress="return isNumberKey(event)" /></td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td style="vertical-align: top">
                                            <table width="210">
                                                <tr>
                                                    <td>Jumlah:</td>
                                                    <td><input type="text" name="jumlah_penunjang" id="jumlah_penunjang" onkeypress="return isNumberKey(event)" /></td>
                                                </tr>
                                                <tr>
                                                    <td>Total:</td>
                                                    <td><input type="text" name="total_penunjang" id="total_penunjang" /></td>
                                                </tr>
                                                <tr>
                                                    <td>Selisih:</td>
                                                    <td><input type="text" name="selisih_trans_penunjang" id="selisih_trans_penunjang" /></td>
                                                </tr>
                                                <tr>
                                                    <td>Nilai:</td>
                                                    <td><input type="text" name="nilai_penunjang" id="nilai_penunjang" /></td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td style="vertical-align: top">
                                            <table width="210">
                                                <tr>
                                                    <td>Disetujui:</td>
                                                    <td>
                                                        <select id="disetujui_penunjang" name="disetujui_penunjang" style="width: 110px">
                                                            <option value="y">Ya</option>
                                                         <option value="t">Tidak</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Rekomendasi:</td>
                                                    <td><input type="text" name="rekomendasi_penunjang" id="rekomendasi_penunjang" /></td>
                                                </tr>
                                                <tr>
                                                    <td>Kesimpulan:</td>
                                                    <td><input type="text" name="kesimpulan_penunjang" id="kesimpulan_penunjang" /></td>
                                                </tr>
                                                <tr>
                                                    <td><input type="submit" value="Tambah" class="button_trans_penunjang" /></td>
                                                    <td></td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </form>
                            <table id="list_transaksi_penunjang" class="scroll" cellpadding="0" cellspacing="0"></table>
                            <div id="pager_transaksi_penunjang" class="scroll" style="text-align:center;"></div>
                        </fieldset>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</div>
                                                                   