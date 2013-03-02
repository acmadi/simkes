<script type="text/javascript" >	 
$(this).ready( function() {
	var data_lab;        
        var id_kunjungan,
            id_pegawai,
            id_item,
            id_dokter,
            id_apotek,
            id_provider,
            id_diagnosa;
        $("#nip_lab").attr('disabled','disabled');
	$("#bagian_lab").attr('disabled','disabled');
        $("#selisih_lab").attr('disabled','disabled');
        $("#total_lab").attr('disabled','disabled');
        $("#selisih_trans_lab").attr('disabled','disabled');
        
        $(".button_lab").button();
        $(".button_diag_lab").button();
        $(".button_trans_lab").button();
        
        $( "#tgl_trans_lab" ).datepicker({
            changeMonth: true,
            changeYear: true,
            showOn: "button",
            buttonImage : "<?php echo base_url();?>asset/images/calendar.gif",				
            buttonImageOnly : true
	});
        
	$( "#tgl_kun_lab" ).datepicker({
            changeMonth     : true, // menampilkan dropdown untuk ganti bulan
            changeYear      : true, // menampilkan dropdown untuk ganti Tahun
            showOn          : "button",
            buttonImage     : "<?php echo base_url();?>asset/images/calendar.gif",				
            buttonImageOnly : true
	});	

        $("#pegawai_lab").autocomplete({
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
                    $("#nip_lab").val(nip);
                    $("#id_bagian_lab").val(ui.item.id); 
                    bagian(id_bag);
                    rujukan();
                    pasien(ui.item.id);
                    id_pegawai=nip;
                    //kunjungan();
                }
        });        
              
	function bagian(id_bag){
            $.ajax({
               url : "<?php echo base_url(); ?>index.php/transaksi/lab/bagian",
               data : "id="+id_bag,
               type: 'POST',
               success: function(data){
                   $("#bagian_lab").val(data);
               },
               error: function(e){
                   alert("error bagian : "+e)
               }
            });
        }
        
        function pasien(nip){
            $.ajax({
               url : "<?php echo base_url(); ?>index.php/transaksi/lab/pasien",
               data : "id="+nip,
               type: 'POST',
               success: function(data){
                   $('#pasien_lab').html(data);
               },
               error: function(e){
                   alert("error pasien : "+e)
               }
            });
        }
        
        function rujukan(){
            $.ajax({
               url : "<?php echo base_url(); ?>index.php/transaksi/lab/rujukan",
              // url : "<?php echo base_url(); ?>index.php/transaksi/dak/rujukan",

               type: 'POST',
               success: function(data){
                   $('#rujukan_lab').html(data);
               },
               error: function(e){
                   alert("error rujukan : "+e)
               }
            });
        }        
        
        $("#dokter_lab").autocomplete({
            minLength: 1,
            source:
            function(req, add){
                var id_rujukan=$('#rujukan_lab').val();
                var isi =$("#dokter_lab").val();
                if (id_rujukan == '')
                {
                    alert('Jenis Rujukan Harus Dipilih');
                    $("#dokter_lab").val("");
                    $('.ui-autocomplete-loading').removeClass("ui-autocomplete-loading");
                    $('#rujukan_lab').focus();
                    return false;
                }

                $.ajax({
                    url: "<?php echo base_url(); ?>index.php/transaksi/lab/lookdokter",
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
        
        $("#provider_lab").autocomplete({
            minLength: 1,
            source:
            function(req, add){
                $.ajax({
                    url: "<?php echo base_url(); ?>index.php/transaksi/lab/lookprovider",
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
            $('#pegawai_lab').val("");
            $('#pasien_lab').val("");
            $('#dokter_lab').val("");
            $('#rujukan_lab').val("");
            $('#provider_lab').val("");
            $('#nip_lab').val("");
            $('#tgl_trans_lab').val("");
            $('#no_surat_lab').val("");
            $('#no_bukti_lab').val("");
            $('#bagian_lab').val("");
            $('#tgl_kun_lab').val("");
            $('#buku_besar_lab').val("");          
            $('#restitusi_lab').attr('checked', false);
        }
        
        $(".button_lab").click(function() {                                         
            if ($('#pegawai_lab').val() == '') {
                alert('Pegawai harus di isi');
                $('#pegawai_lab').focus();
                return false;
            } 
            if ($('#buku_besar_lab').val() == '') {                
                alert('buku besar harus di isi');
                $('#buku_besar_lab').focus();
                return false;
            }
            if (id_pegawai == undefined) {                
                alert('Anda harus memasukkan data karyawan di master karyawan');
                return false;
            }
            
            var pegawai = $('#pegawai_lab').val(),
                pasien = $('#pasien_lab').val(),                
                dokter = $('#dokter_lab').val(),
                rujukan = $('#rujukan_lab').val(),
                provider = $('#provider_lab').val(),
                nip = $('#nip_lab').val(),
                tgl_trans = $('#tgl_trans_lab').val(),
                no_surat = $('#no_surat_lab').val(),
                no_bukti = $('#no_bukti_lab').val(),
                //selisih = $('#selisih_lab').val(),
                bagian = $('#bagian_lab').val(),
                tgl_kun = $('#tgl_kun_lab').val(),                
                buku_besar = $('#buku_besar_lab').val(),                
                restitusi;                
                if ($("#restitusi_lab").is(":checked")){
                    restitusi="y";
                } else {
                    restitusi="t";
                }                                             
                 
            data_lab = "&pegawai="+pegawai+"&pasien="+pasien+"&id_dokter="+id_dokter+"&dokter="+dokter+"&rujukan="+rujukan+"&id_provider="+id_provider+"&provider="+provider;
            data_lab = data_lab+"&nip="+nip+"&tgl_trans="+tgl_trans+"&no_surat="+no_surat+"&no_bukti="+no_bukti;
            data_lab = data_lab+"&bagian="+bagian+"&tgl_kun="+tgl_kun+"&buku_besar="+buku_besar+"&restitusi="+restitusi;            
            $.ajax({
               url : "<?php echo base_url(); ?>index.php/transaksi/lab/simpandata",
               data : data_lab,
               type: 'get',
               success: function(data){
                   if (data!=null){
                      alert("Data tersimpan : "+data);
                      id_kunjungan=data;
                      resetKunjungan();  
                      $('#list_diagnosa_lab').trigger('reloadGrid');
                      $('#list_transaksi_lab').trigger('reloadGrid');
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
        
        $("#diagnosa_lab").autocomplete({
            minLength: 1,
            source:
            function(req, add){
                $.ajax({
                    url: "<?php echo base_url(); ?>index.php/transaksi/lab/lookdiagnosa",
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
        
        $(".button_diag_lab").click(function() {
            var diagnosa = $('#diagnosa_lab').val();            
            if (diagnosa == '') {
                alert('Diagnosa harus di isi');
                $('#diagnosa_lab').focus();
                return false;
            }
            if (id_kunjungan == undefined) {                
                alert('Isi Data Kunjungan dulu');
                //alert(diagnosa+":"+id_diagnosa);
                $('#pegawai_lab').focus();
                return false;
            }
            //alert(diagnosa+":"+id_diagnosa+":"+id_kunjungan);
            $.ajax({
               url : "<?php echo base_url(); ?>index.php/transaksi/lab/simpandiagnosa",
               data : "id="+id_kunjungan+"&diag="+diagnosa+"&id_diagnosa="+id_diagnosa,
               type: 'get',
               success: function(data){
                   if (data=="sukses"){
                       $('#list_diagnosa_lab').trigger('reloadGrid');
                   } else {
                       alert("Gagal Menyimpan data");
                   } 
               },
               error: function(e){
                   alert("error pasien : "+e)
               }
            });
            $('#diagnosa_lab').val("");
            return false;
        });
        
        var grid = $("#list_diagnosa_lab");
    grid.jqGrid({
        url: '<?php echo base_url() ?>index.php/transaksi/lab/json', 
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
	pager: '#pager_diagnosa_lab',
	sortname: 'id_transaksi_diagnosa',
	viewrecords: true,
        shrinkToFit: false,
	sortorder: "desc",
	editurl: '<?php echo base_url() ?>index.php/transaksi/lab/crud', //URL Proses CRUD Nya
	multiselect: false, 
	caption: "Hasil Diagnosa" //Caption List					
    });
    grid.jqGrid('navGrid','#pager_diagnosa_lab',{search:false,view:false,edit:false,add:false,del:true},{},{},{});
                        
  //kanggo transaksi                      
        $("#nama_tagihan_lab").autocomplete({
            minLength: 1,
            source:
            function(requ, add){
                $.ajax({
                    url: "<?php echo base_url(); ?>index.php/transaksi/lab/looktagihan",
                    data: requ,
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
                                //$("#harga_standart_penunjang").val(""); 
                            }                         
                        }                    
                });
            },
            select:
                function(event, ui) {
                    id_item=ui.item.id;
                }
        });
        
        function resetTransaksi(){
            $('#nama_tagihan_lab').val("");
            $('#hasil_pemeriksaan_lab').val("");
            $('#nilai_lab').val("");
            $('#hasil_rontgen_lab').val("");
        }
        
        $(".button_trans_lab").click(function() {
            if ($('#nama_tagihan_lab').val() == '') {
                alert('Nama Tagihan harus di isi');
                $('#nama_tagihan_lab').focus();
                return false;
            }
            if (id_kunjungan == undefined) {                
                alert('Isi Data Kunjungan dulu');
                $('#pegawai_lab').focus();
                return false;
            }
            var nama_tagihan = $('#nama_tagihan_lab').val(),
                hasil_pemeriksaan = $('#hasil_pemeriksaan_lab').val(),
                nilai = $('#nilai_lab').val(),
                hasil_rontgen = $('#hasil_rontgen_lab').val();
            var isi;             
            isi="&kunjungan="+id_kunjungan+"&id_item="+id_item+"&nama_tagihan="+nama_tagihan+"&hasil_pemeriksaan="+hasil_pemeriksaan
                +"&nilai="+nilai+"&hasil_rontgen="+hasil_rontgen;            
            $.ajax({
               url : "<?php echo base_url(); ?>index.php/transaksi/lab/simpanitem",
               data : isi,
               type: 'get',
               success: function(data){
                   if (data!=null){
                      $('#list_transaksi_lab').trigger('reloadGrid');
                      resetTransaksi();
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
        
        var grid2 = $("#list_transaksi_lab");
        grid2.jqGrid({
        url: '<?php echo base_url() ?>index.php/transaksi/lab/json2',
        datatype: "json",
	height: "auto",
	mtype: "GET",
	colNames: ['Id','Action','Nama Tagihan','Hasil Pemeriksaan','Nilai','Hasil Rontgen'],
	colModel: [
                    {name:'id_item_transaksi_lab', key:true, index:'id_item_transaksi_lab', hidden:true,editable:false,  editrules:{required:true}},
                    {name: 'myac', width:40, fixed:true, sortable:false, search:false, align:'center', viewable: false, resizable: false, resize:false, formatter:'actions',
                        formatoptions:{keys:true,editbutton:false, delbutton: true}
                    },
                    {name:'nama_item',index:'nama_item',width:100,editable:true,editrules:{required:true}},
                    {name:'hasil',index:'hasil',width:100,editable:true,editrules:{required:true}},
                    {name:'nilai',index:'nilai',width:100,editable:true,editrules:{required:true}},
                    {name:'rontgen',index:'rontgen',width:100,editable:true,editrules:{required:true}},                                        
                    ],
        rownumbers:true,
	rowNum: 20,
	rowList: [10,20,30],
        postData: {idkunj : function(){
                    return id_kunjungan;
                  }},
        width:628,
	pager: '#pager_transaksi_lab',
	sortname: 'id_item_transaksi_lab',
        shrinkToFit: true,
	viewrecords: true,
	sortorder: "desc",
	editurl: '<?php echo base_url() ?>index.php/transaksi/lab/crud2', //URL Proses CRUD Nya
	multiselect: false, 
	caption: "Hasil Transaksi" //Caption List					
    });
    grid2.jqGrid('navGrid','#pager_transaksi_lab',{search:false, view:true,edit:false,add:false,del:true},{},{},{});				    
});
function isNumberKey(evt)
    {
        var charCode = (evt.which) ? evt.which : event.keyCode
	if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
	
        return true;
    }
</script>
<div id="trans_lab" style="width: auto; height: auto; overflow: auto;">
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
                                    <input type="hidden" name="id_kunjungan_lab" id="id_kunjungan_lab">
                                    <tr>
                                        <td>Pegawai:</td>
                                        <td><input type="text" name="pegawai_lab" id="pegawai_lab" /></td>
                                    </tr>
                                    <tr>
                                        <td>Pasien:</td>
                                        <td><select id="pasien_lab" name="pasien_lab" style="width: 110px">
                                                <option>Pilih Pasien</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Rujukan:</td>
                                        <td><select id="rujukan_lab" name="rujukan_lab" style="width: 110px">
                                                <option>Pilih Rujukan</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Dokter:</td>
                                        <td><input type="text" name="dokter_lab" id="dokter_lab"></td>
                                    </tr>
                                    <tr>
                                        <td>Provider:</td>
                                        <td><input type="text" name="provider_lab" id="provider_lab"></td>
                                    </tr>
                                </table>
                            </td>
                            <td style="vertical-align: top">
                                <table width="265">
                                    <tr>
                                        <td>NIP:</td>
                                        <td>
                                            <input type="text" name="nip_lab" id="nip_lab">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Tgl. Transaksi:</td>
                                        <td>
                                            <input type="text" name="tgl_trans_lab" id="tgl_trans_lab">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>No. Surat:</td>
                                        <td>
                                            <input type="text" name="no_surat_lab" id="no_surat_lab">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>No. Bukti:</td>
                                        <td>
                                            <input type="text" name="no_bukti_lab" id="no_bukti_lab">
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <td>
                                <table width="265">
                                    <tr>
                                        <td>Bagian:</td>
                                        <td><input type="text" name="bagian_lab" id="bagian_lab"></td>
                                    </tr>
                                    <tr>
                                        <td>Tgl. Kunjungan:</td>
                                        <td><input type="text" name="tgl_kun_lab" id="tgl_kun_lab"></td>
                                    </tr>
                                    <tr>
                                        <td>Buku Besar:</td>
                                        <td><input type="text" name="buku_besar_lab" id="buku_besar_lab"></td>
                                    </tr>
                                    <tr>
                                        <td>Restitusi:</td>
                                        <td><input type="checkbox" name="restitusi_lab" id="restitusi_lab"></td>
                                    </tr>
                                    <tr>
                                        <td><input type="submit" value="Simpan" class="button_lab"></td>
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
                                                 <input type="text" name="diagnosa_lab" id="diagnosa_lab">
                                            </td>
                                            <td>
                                            <input type="submit" value="add" class="button_diag_lab">
                                            </td>
                                            </tr>
                                           </table>
                                        </td>
                                    </tr>
                                </table>
                            </form>
                            <table id="list_diagnosa_lab" class="scroll" cellpadding="0" cellspacing="0"></table>
                            <div id="pager_diagnosa_lab" class="scroll" style="text-align:center;"></div>
                        </fieldset>
                    </td>
                    <td style="vertical-align: top">
                        <fieldset >
                            <legend>Item Transaksi</legend>
                            <form method="post" name="form3" action="" id="form3">
                                <table>
                                    <tr>
                                        <td>
                                            <table width="240">
                                                <tr>
                                                    <td>Nama Tagihan:</td>
                                                    <td><input type="text" name="nama_tagihan_lab" id="nama_tagihan_lab"/></td>
                                                </tr>
                                                <tr>
                                                    <td>Hasil Pemeriksaan:</td>
                                                    <td><textarea name="hasil_pemeriksaan_lab" id="hasil_pemeriksaan_lab"></textarea/></td>
                                                </tr>
                                                <tr>
                                                    <td>Nilai:</td>
                                                    <td><input type="text" name="nilai_lab" id="nilai_lab" onkeypress="return isNumberKey(event)"/></td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td style="vertical-align: top">
                                            <table width="240">
                                                <tr>
                                                    <td>Hasil Rontgen:</td>
                                                    <td><textarea name="hasil_rontgen_lab" id="hasil_rontgen_lab"></textarea></td>
                                                </tr>
                                                <tr>
                                                    <td><input type="submit" value="Tambah" class="button_trans_lab"/></td>
                                                    <td></td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </form>
                            <table id="list_transaksi_lab" class="scroll" cellpadding="0" cellspacing="0"></table>
                            <div id="pager_transaksi_lab" class="scroll" style="text-align:center;"></div>
                        </fieldset>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>      
</div>
                                                             