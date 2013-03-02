<script type="text/javascript" >	 
$(this).ready( function() {
	var data_gigi;        
        var id_kunjungan,
            id_pegawai,
            id_item,
            id_dokter,
            id_lab_gigi,
            id_diagnosa,
            id_rekom;
        $("#nip_gigi").attr('disabled','disabled');
	$("#bagian_gigi").attr('disabled','disabled');
        $("#total_gigi").attr('disabled','disabled');
        $("#selisih_trans_gigi").attr('disabled','disabled');
        
        $(".button_gigi").button();
        $(".button_diag_gigi").button();
        $(".button_trans_gigi").button();
        
        $( "#tgl_trans_gigi" ).datepicker({
            changeMonth: true,
            changeYear: true,
            showOn: "button",
            buttonImage : "<?php echo base_url();?>asset/images/calendar.gif",				
            buttonImageOnly : true
	});
        
	$( "#tgl_kun_gigi" ).datepicker({
            changeMonth     : true, // menampilkan dropdown untuk ganti bulan
            changeYear      : true, // menampilkan dropdown untuk ganti Tahun
            showOn          : "button",
            buttonImage     : "<?php echo base_url();?>asset/images/calendar.gif",				
            buttonImageOnly : true
	});	

        $("#pegawai_gigi").autocomplete({
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
                    $("#nip_gigi").val(nip);
                    $("#id_bagian_gigi").val(ui.item.id); 
                    bagian(id_bag);
                    //rujukan();
                    pasien(ui.item.id);
                    //kunjungan();
                    tagihan();
                }
        });        
              
	function bagian(id_bag){
            $.ajax({
               url : "<?php echo base_url(); ?>index.php/transaksi/gigi/bagian",
               data : "id="+id_bag,
               type: 'POST',
               success: function(data){
                   $("#bagian_gigi").val(data);
               },
               error: function(e){
                   alert("error bagian : "+e)
               }
            });
        }
        
        function pasien(nip){
            $.ajax({
               url : "<?php echo base_url(); ?>index.php/transaksi/gigi/pasien",
               data : "id="+nip,
               type: 'POST',
               success: function(data){
                   $('#pasien_gigi').html(data);
               },
               error: function(e){
                   alert("error pasien : "+e)
               }
            });
        }
        /*
        function rujukan(){
            $.ajax({
               url : "<?php echo base_url(); ?>index.php/transaksi/gigi/rujukan",
               type: 'POST',
               success: function(data){
                   $('#rujukan_gigi').html(data);
               },
               error: function(e){
                   alert("error rujukan : "+e)
               }
            });
        }
        
        function kunjungan(){
            $.ajax({
               url : "<?php echo base_url(); ?>index.php/transaksi/gigi/kunjungan",
               type: 'POST',
               success: function(data){
                   $('#kunjungan_gigi').html(data);
               },
               error: function(e){
                   alert("Error Kunjungan : "+e)
               }
            });
        }
        */
        $("#dokter_gigi").autocomplete({
            minLength: 1,
            source:
            function(req, add){
                
                $.ajax({
                    url: "<?php echo base_url(); ?>index.php/transaksi/gigi/lookdokter",
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
        
        $("#lab_gigi_gigi").autocomplete({
            minLength: 1,
            source:
            function(req, add){
                $.ajax({
                    url: "<?php echo base_url(); ?>index.php/transaksi/gigi/looklabgigi",
                    dataType: 'json',
                    type: 'POST',
                    data: req,
                    success:
                        function(data){
                            if(data.response =="true"){
                                add(data.message);
                            } else if(data.response =="false") {
                                $('.ui-autocomplete-loading').removeClass("ui-autocomplete-loading");
                                id_lab_gigi="undefined";
                            }							
                        }          
                });
            },
            select:
                function(event, ui) {
                    id_lab_gigi=ui.item.id;                    
                }
        });
                       
	function resetKunjungan(){
            $('#pegawai_gigi').val("");
            $('#pasien_gigi').val("");
            $('#dokter_gigi').val("");
            $('#lab_gigi_gigi').val("");
            //$('#tarif_satuan_gigi').val("");
            $('#nip_gigi').val("");
            $('#tgl_trans_gigi').val("");
            $('#no_surat_gigi').val("");
            $('#no_bukti_gigi').val("");
            //$('#selisih_gigi').val("");
            $('#bagian_gigi').val("");
            $('#tgl_kun_gigi').val("");
            $('#buku_besar_gigi').val("");          
            $('#restitusi_gigi').attr('checked', false);
        }
        
        $(".button_gigi").click(function() {                                         
            if ($('#pegawai_gigi').val() == '') {
                alert('Pegawai harus di isi');
                $('#pegawai_gigi').focus();
                return false;
            } 
            if ($('#buku_besar_gigi').val() == '') {                
                alert('buku besar harus di isi');
                $('#buku_besar_gigi').focus();
                return false;
            }
            if (id_pegawai == undefined) {                
                alert('Anda harus memasukkan data karyawan di master karyawan');
                return false;
            }
            
            var //pegawai = $('#pegawai_gigi').val(),
                pasien = $('#pasien_gigi').val(),                
                dokter = $('#dokter_gigi').val(),
                lab_gigi = $('#lab_gigi_gigi').val(),
                //nip = $('#nip_gigi').val(),
                tgl_trans = $('#tgl_trans_gigi').val(),
                no_surat = $('#no_surat_gigi').val(),
                no_bukti = $('#no_bukti_gigi').val(),
               // selisih = $('#selisih_gigi').val(),
                //bagian = $('#bagian_gigi').val(),
                tgl_kun = $('#tgl_kun_gigi').val(),                
                buku_besar = $('#buku_besar_gigi').val(),                
                restitusi;                
                if ($("#restitusi_gigi").is(":checked")){
                    restitusi="y";
                } else {
                    restitusi="t";
                } 
              
            data_gigi = "&pasien="+pasien+"&id_dokter="+id_dokter+"&dokter="+dokter+"&id_lab_gigi="+id_lab_gigi+"&lab_gigi="+lab_gigi;
            data_gigi = data_gigi+"&tgl_trans="+tgl_trans+"&no_surat="+no_surat+"&no_bukti="+no_bukti;
            data_gigi = data_gigi+"&tgl_kun="+tgl_kun+"&buku_besar="+buku_besar+"&restitusi="+restitusi;            
            $.ajax({
               url : "<?php echo base_url(); ?>index.php/transaksi/gigi/simpandata",
               data : data_gigi,
               type: 'get',
               success: function(data){
                   if (data!=null){
                      alert("Data tersimpan, id kunjungan : "+data);
                      id_kunjungan=data;
                      resetKunjungan(); 
                      $('#list_diagnosa_gigi').trigger('reloadGrid');
                      $('#list_transaksi_gigi').trigger('reloadGrid');
                   } else {
                       alert("gagal menyimpan data");
                   }                   
               },
               error: function(e){
                   alert("error : "+e)
               }
            }); 
            return false;
	});
        
        $("#diagnosa_gigi").autocomplete({
            minLength: 1,
            source:
            function(req, add){
                $.ajax({
                    url: "<?php echo base_url(); ?>index.php/transaksi/gigi/lookdiagnosa",
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
        
        $(".button_diag_gigi").click(function() {
            var diagnosa = $('#diagnosa_gigi').val();            
            if (diagnosa == '') {
                alert('Diagnosa harus di isi');
                $('#diagnosa_gigi').focus();
                return false;
            }
            if (id_kunjungan == undefined) {                
                alert('Isi Data Kunjungan dulu');
                //alert(diagnosa+":"+id_diagnosa);
                $('#pegawai_gigi').focus();
                return false;
            }
            //alert(diagnosa+":"+id_diagnosa+":"+id_kunjungan);
            $.ajax({
               url : "<?php echo base_url(); ?>index.php/transaksi/gigi/simpandiagnosa",
               data : "id="+id_kunjungan+"&diag="+diagnosa+"&id_diagnosa="+id_diagnosa,
               type: 'get',
               success: function(data){
                   if (data=="sukses"){
                       //resetDiagnosa();
                       $('#list_diagnosa_gigi').trigger('reloadGrid');
                   } else {
                       alert("Gagal Menyimpan data");
                   } 
               },
               error: function(e){
                   alert("error pasien : "+e)
               }
            });
            $('#diagnosa_gigi').val("");
            return false;
        });
        
        var grid = $("#list_diagnosa_gigi");
    grid.jqGrid({
        url: '<?php echo base_url() ?>index.php/transaksi/gigi/json', 
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
	pager: '#pager_diagnosa_gigi',
	sortname: 'id_transaksi_diagnosa',
	viewrecords: true,
        shrinkToFit: false,
	sortorder: "desc",
	editurl: '<?php echo base_url() ?>index.php/transaksi/gigi/crud', //URL Proses CRUD Nya
	multiselect: false, 
	caption: "Hasil Diagnosa" //Caption List					
    });
    grid.jqGrid('navGrid','#pager_diagnosa_gigi',{search:false,view:false,edit:false,add:false,del:true},{},{},{});
                        
  //kanggo transaksi      
        function tagihan(){
            $.ajax({
               url : "<?php echo base_url(); ?>index.php/transaksi/gigi/tagihan",
               type: 'POST',
               success: function(data){
                   $('#jenis_tagihan_gigi').html(data);
               },
               error: function(e){
                   alert("error rujukan : "+e)
               }
            });
        }                
        
        $("#nama_tagihan_gigi").autocomplete({
            minLength: 1,
            source:
            function(requ, add){
                var id_jenis=$('#jenis_tagihan_gigi').val();
                var isi =$("#nama_tagihan_gigi").val();
                if (id_jenis == '') {
                    alert('Jenis Tagihan Harus Dipilih');
                    $("#nama_tagihan_gigi").val("");
                    $('.ui-autocomplete-loading').removeClass("ui-autocomplete-loading");
                    $('#jenis_tagihan_gigi').focus();
                    return false;
                }
                
                $.ajax({
                    url: "<?php echo base_url(); ?>index.php/transaksi/gigi/looktagihan",
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
                                $("#harga_standart_gigi").val(""); 
                            }                         
                        }                    
                });
            },
            select:
                function(event, ui) {
                    $("#harga_standart_gigi").val(ui.item.harga); 
                    id_item=ui.item.id;
                }
        });
        
        $('#jenis_tagihan_gigi').change(function(){
            $('#nama_tagihan_gigi').val("");
            $('#harga_standart_gigi').val("");
            id_item=undefined;
        });
        
        function hitungSelisih(){
            var a=$('#harga_standart_gigi').val();
            var b=$('#harga_satuan_gigi').val();            
            var c=$('#jumlah_gigi').val();
            
            $('#total_gigi').val(b*c);
            $('#selisih_trans_gigi').val(a*c-b*c);
        }
        
        $('#harga_standart_gigi').keyup(function(){
            hitungSelisih();
        });
        
        $('#harga_satuan_gigi').keyup(function(){
            hitungSelisih();
        });
        
        $('#jumlah_gigi').keyup(function(){
            hitungSelisih();       
        });
        
        $("#rekomendasi_gigi").autocomplete({
            minLength: 1,
            source:
            function(req, add){
                $.ajax({
                    url: "<?php echo base_url(); ?>index.php/transaksi/gigi/lookrekomendasi",
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
            $('#jenis_tagihan_gigi').val("");
            $('#nama_tagihan_gigi').val("");
            $('#harga_standart_gigi').val("");
            $('#harga_satuan_gigi').val("");
            $('#jumlah_gigi').val("");
            $('#total_gigi').val("");
            $('#selisih_trans_gigi').val("");
            $('#disetujui_gigi').val("");
            $('#satuan_gigi').val("");
            $('#rekomendasi_gigi').val("");
        }
        
        $(".button_trans_gigi").click(function() {
            if ($('#nama_tagihan_gigi').val() == '') {
                alert('Nama Tagihan harus di isi');
                $('#nama_tagihan_gigi').focus();
                return false;
            }
            if (id_kunjungan == undefined) {                
                alert('Isi Data Kunjungan dulu');
                $('#pegawai_gigi').focus();
                return false;
            }
            if ($('#doses_gigi').val() == '') {
                alert('Doses harus di isi');
                $('#doses_gigi').focus();
                return false;
            }
            var jenis_tagihan = $('#jenis_tagihan_gigi').val(),
                nama_tagihan = $('#nama_tagihan_gigi').val(),
                harga_standart = $('#harga_standart_gigi').val(),
                harga_satuan = $('#harga_satuan_gigi').val(),
                jumlah = $('#jumlah_gigi').val(),
                total = $('#total_gigi').val(),
                selisih_transaksi = $('#selisih_trans_gigi').val(),
                satuan = $('#satuan_gigi').val(),
                disetujui = $('#disetujui_gigi').val(),
                //doses = $('#doses_gigi').val(),
                rekomendasi = $('#rekomendasi_gigi').val();
            var isi;             
            isi="&jenis_tagihan="+jenis_tagihan+"&kunjungan="+id_kunjungan+"&id_item="+id_item+"&nama_tagihan="+nama_tagihan+"&harga_standart="+harga_standart+"&harga_satuan="+harga_satuan;
            isi=isi+"&jumlah="+jumlah+"&total="+total+"&selisih="+selisih_transaksi+"&satuan="+satuan;
            isi=isi+"&disetujui="+disetujui+"&id_rekomendasi="+id_rekom+"&rekomendasi="+rekomendasi;
            
            $.ajax({
               url : "<?php echo base_url(); ?>index.php/transaksi/gigi/simpanitem",
               data : isi,
               type: 'get',
               success: function(data){
                   if (data!=null){
                      //alert("Sukses gan");
                      resetTransaksi();
                      $('#list_transaksi_gigi').trigger('reloadGrid');
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
        
        var grid2 = $("#list_transaksi_gigi");
        grid2.jqGrid({
        url: '<?php echo base_url() ?>index.php/transaksi/gigi/json2',
        datatype: "json",
	height: "auto",
	mtype: "GET",
	colNames: ['Id','Action','Jenis Tagihan','Nama Tagihan','Harga Standart','Harga Satuan','Jumlah','Total','Selisih','Satuan','Disetujui','Rekomendasi'],
	colModel: [
                    {name:'id_item_transaksi_gigi', key:true, index:'id_item_transaksi_gigi', hidden:true,editable:false,  editrules:{required:true}},
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
                    {name:'satuan',index:'satuan',width:70,editable:true,editrules:{required:true}},
                    {name:'disetujui',index:'disetujui',width:70,editable:true,editrules:{required:true}},
                    //{name:'nama_dosis',index:'nama_dosis',width:70,editable:true,editrules:{required:true}},
                    {name:'nama_rekomendasi',index:'nama_rekomendasi',width:100,editable:true,editrules:{required:true}},                    
                    ],
        rownumbers:true,
	rowNum: 20,
	rowList: [10,20,30],
        postData: {idkunj : function(){
                    return id_kunjungan;
                  }},
        width:630,
	pager: '#pager_transaksi_gigi',
	sortname: 'id_item_transaksi_gigi',
        shrinkToFit: false,
	viewrecords: true,
	sortorder: "desc",
	editurl: '<?php echo base_url() ?>index.php/transaksi/gigi/crud2', //URL Proses CRUD Nya
	multiselect: false, 
	caption: "Hasil Transaksi" //Caption List					
    });
    grid2.jqGrid('navGrid','#pager_transaksi_gigi',{search:false, view:true,edit:false,add:false,del:true},{},{},{});				    
});
function isNumberKey(evt)
    {
        var charCode = (evt.which) ? evt.which : event.keyCode
	if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
	
        return true;
    }
</script>
<div id="trans_gigi" style="width: auto; height: auto; overflow: auto;">
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
                                    <input type="hidden" name="id_kunjungan_gigi" id="id_kunjungan_gigi">
                                    <tr>
                                        <td>Pegawai:</td>
                                        <td><input type="text" name="pegawai_gigi" id="pegawai_gigi"></td>
                                    </tr>
                                    <tr>
                                        <td>Pasien:</td>
                                        <td><select id="pasien_gigi" name="pasien_gigi" style="width: 110px">
                                                <option>Pilih Pasien</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Dokter:</td>
                                        <td><input type="text" name="dokter_gigi" id="dokter_gigi"></td>
                                    </tr>
                                    <tr>
                                        <td>Lab Gigi:</td>
                                        <td><input type="text" name="lab_gigi_gigi" id="lab_gigi_gigi"></td>
                                    </tr>
                                </table>
                            </td>
                            <td style="vertical-align: top">
                                <table width="265">
                                    <tr>
                                        <td>NIP:</td>
                                        <td>
                                            <input type="text" name="nip_gigi" id="nip_gigi">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Tgl. Transaksi:</td>
                                        <td>
                                            <input type="text" name="tgl_trans_gigi" id="tgl_trans_gigi">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>No. Surat:</td>
                                        <td>
                                            <input type="text" name="no_surat_gigi" id="no_surat_gigi">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>No. Bukti:</td>
                                        <td>
                                            <input type="text" name="no_bukti_gigi" id="no_bukti_gigi">
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <td style="vertical-align: top">
                                <table width="265">
                                    <tr>
                                        <td>Bagian:</td>
                                        <td><input type="text" name="bagian_gigi" id="bagian_gigi"></td>
                                    </tr>
                                    <tr>
                                        <td>Tgl. Kunjungan:</td>
                                        <td><input type="text" name="tgl_kun_gigi" id="tgl_kun_gigi"></td>
                                    </tr>
                                    <tr>
                                        <td>Buku Besar:</td>
                                        <td><input type="text" name="buku_besar_gigi" id="buku_besar_gigi"></td>
                                    </tr>
                                    <tr>
                                        <td>Restitusi:</td>
                                        <td><input type="checkbox" name="restitusi_gigi" id="restitusi_gigi"></td>
                                    </tr>
                                    <tr>
                                        <td><input type="submit" value="Simpan" class="button_gigi"></td>
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
                                                 <input type="text" name="diagnosa_gigi" id="diagnosa_gigi">
                                            </td>
                                            <td>
                                            <input type="submit" value="add" class="button_diag_gigi">
                                            </td>
                                            </tr>
                                           </table>
                                        </td>
                                    </tr>
                                </table>
                            </form>
                            <table id="list_diagnosa_gigi" class="scroll" cellpadding="0" cellspacing="0"></table>
                            <div id="pager_diagnosa_gigi" class="scroll" style="text-align:center;"></div>
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
                                                    <td><select id="jenis_tagihan_gigi" name="jenis_tagihan_gigi" style="width: 110px">
                                                            <option>Jenis Tagihan</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Nama Tagihan:</td>
                                                    <td><input type="text" name="nama_tagihan_gigi" id="nama_tagihan_gigi" /></td>
                                                </tr>
                                                <tr>
                                                    <td>Harga Standart:</td>
                                                    <td><input type="text" name="harga_standart_gigi" id="harga_standart_gigi" onkeypress="return isNumberKey(event)" /></td>
                                                </tr>
                                                <tr>
                                                    <td>Harga Satuan:</td>
                                                    <td><input type="text" name="harga_satuan_gigi" id="harga_satuan_gigi" onkeypress="return isNumberKey(event)" /></td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td style="vertical-align: top">
                                            <table width="210">
                                                <tr>
                                                    <td>Jumlah:</td>
                                                    <td><input type="text" name="jumlah_gigi" id="jumlah_gigi" onkeypress="return isNumberKey(event)" /></td>
                                                </tr>
                                                <tr>
                                                    <td>Total:</td>
                                                    <td><input type="text" name="total_gigi" id="total_gigi" /></td>
                                                </tr>
                                                <tr>
                                                    <td>Selisih:</td>
                                                    <td><input type="text" name="selisih_trans_gigi" id="selisih_trans_gigi" /></td>
                                                </tr>
												<tr>
                                                    <td>Satuan:</td>
                                                    <td><input type="text" name="satuan_gigi" id="satuan_gigi" /></td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td style="vertical-align: top">
                                            <table width="210">
                                                <tr>
                                                    <td>Disetujui:</td>
                                                    <td>
                                                        <select id="disetujui_gigi" name="disetujui_gigi" style="width: 110px">
                                                            <option value="y">Ya</option>
                                                            <option value="t">Tidak</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Rekomendasi:</td>
                                                    <td><input type="text" name="rekomendasi_gigi" id="rekomendasi_gigi" /></td>
                                                </tr>
                                                <tr>
                                                    <td><input type="submit" value="Tambah" class="button_trans_gigi" /></td>
                                                    <td></td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </form>
                            <table id="list_transaksi_gigi" class="scroll" cellpadding="0" cellspacing="0"></table>
                            <div id="pager_transaksi_gigi" class="scroll" style="text-align:center;"></div>
                        </fieldset>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>   
</div>
                                                                