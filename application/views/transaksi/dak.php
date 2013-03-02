<script type="text/javascript" >	 
$(this).ready( function() {
	var data_dak;        
        var id_kunjungan,
            id_pegawai,
            id_item,
            id_dokter,
            //id_apotek,
            id_doses,
            id_diagnosa,
            id_rekom;
        $("#nip_dak").attr('disabled','disabled');
	$("#bagian_dak").attr('disabled','disabled');
        $("#bmi_dak").attr('disabled','disabled');
        
        $(".button_dak").button();
        $(".button_diag_dak").button();
        $(".button_trans_dak").button();
        
        $( "#tgl_trans_dak" ).datepicker({
            changeMonth: true,
            changeYear: true,
            showOn: "button",
            buttonImage : "<?php echo base_url();?>asset/images/calendar.gif",				
            buttonImageOnly : true
	});
        
	$( "#tgl_kun_dak" ).datepicker({
            changeMonth     : true, // menampilkan dropdown untuk ganti bulan
            changeYear      : true, // menampilkan dropdown untuk ganti Tahun
            showOn          : "button",
            buttonImage     : "<?php echo base_url();?>asset/images/calendar.gif",				
            buttonImageOnly : true
	});	

        $("#pegawai_dak").autocomplete({
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
                    $("#nip_dak").val(nip);
                    $("#id_bagian_dak").val(ui.item.id); 
                    bagian(id_bag);
                    rujukan();
                    pasien(ui.item.id);
                    kunjungan();
                    tagihan();
                }
        });        
              
	function bagian(id_bag){
            $.ajax({
               url : "<?php echo base_url(); ?>index.php/transaksi/dak/bagian",
               data : "id="+id_bag,
               type: 'POST',
               success: function(data){
                   $("#bagian_dak").val(data);
               },
               error: function(e){
                   alert("error bagian : "+e)
               }
            });
        }
        
        function pasien(id){
            $.ajax({
               url : "<?php echo base_url(); ?>index.php/transaksi/dak/pasien",
               data : "id="+id,
               type: 'POST',
               success: function(data){
                   $('#pasien_dak').html(data);
               },
               error: function(e){
                   alert("error pasien : "+e)
               }
            });
        }
        
        function rujukan(){
            $.ajax({
               url : "<?php echo base_url(); ?>index.php/transaksi/dak/rujukan",
               type: 'POST',
               success: function(data){
                   $('#rujukan_dak').html(data);
               },
               error: function(e){
                   alert("error rujukan : "+e)
               }
            });
        }
        
        function kunjungan(){
            $.ajax({
               url : "<?php echo base_url(); ?>index.php/transaksi/dak/kunjungan",
               type: 'POST',
               success: function(data){
                   $('#kunjungan_dak').html(data);
               },
               error: function(e){
                   alert("Error Kunjungan : "+e)
               }
            });
        }
        
        $("#dokter_dak").autocomplete({
            minLength: 1,
            source:
            function(req, add){
                var id_rujukan=$('#rujukan_dak').val();
                var isi =$("#dokter_dak").val();
                if (id_rujukan == '')
                {
                    alert('Jenis Rujukan Harus Dipilih');
                    $("#dokter_dak").val("");
                    $('.ui-autocomplete-loading').removeClass("ui-autocomplete-loading");
                    $('#rujukan_dak').focus();
                    return false;
                }

                $.ajax({
                    url: "<?php echo base_url(); ?>index.php/transaksi/dak/lookdokter",
                    dataType: 'json',
                    type: 'POST',
                    data: "&term="+isi+"&kat_dokter="+id_rujukan+"&gol_dokter=3",
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

        function hitungBmi(){
            var a=$('#berat_bdn_dak').val();
            var b=$('#tinggi_bdn_dak').val();
            if(a!='' && b!=''){
                var c=b/100;
                var d=a/(c*c);
                var e=d.toFixed(2)            
                $('#bmi_dak').val(e);
            }
        }
        
        $('#berat_bdn_dak').keyup(function(){
            hitungBmi()
        });
        
         $('#tinggi_bdn_dak').keyup(function(){
            hitungBmi()
        });
                       
	function resetKunjungan(){
            $('#pegawai_dak').val("");
            $('#pasien_dak').val("");
            $('#rujukan_dak').val("");
            $('#dokter_dak').val("");
            $('#nip_dak').val("");
            $('#tgl_trans_dak').val("");
            $('#no_surat_dak').val("");
            $('#no_bukti_dak').val("");
            $('#bagian_dak').val("");
            $('#tgl_kun_dak').val("");
                
            $('#kunjungan_dak').val("");
            $('#kond_pasien_dak').val("");
            $('#berat_bdn_dak').val("");
            $('#tinggi_bdn_dak').val("");
            $('#bmi_dak').val("");
            $('#keterangan_dak').val("");
            $('#kesadaran_dak').val("");
            $('#suhu_bdn_dak').val("");
            $('#tek_sistole_dak').val("");
            $('#tek_diastole_dak').val("");
            $('#anamnesis_dak').val("");
            $('#pernafasan_dak').val("");
            $('#nadi_dak').val("");
            $('#riwayat_alergi_dak').val("");
        }
        
        $(".button_dak").click(function() {                                         
            if ($('#pegawai_dak').val() == '') {
                alert('Pegawai harus di isi');
                $('#pegawai_dak').focus();
                return false;
            }
            if ($('#pasien_dak').val() == '') {
                alert('Anda harus memilih Pasien');
                $('#pasien_dak').focus();
                return false;
            }
            if ($('#rujukan_dak').val() == '') {
                alert('Anda harus memilih Rujukan');
                $('#rujukan_dak').focus();
                return false;
            }
            if ($('#kunjungan_dak').val() == '') {
                alert('Anda harus memilih Kunjungan');
                $('#kunjungan_dak').focus();
                return false;
            }
            if ($('#buku_besar_dak').val() == '') {                
                alert('buku besar harus di isi');
                $('#buku_besar_dak').focus();
                return false;
            }
            if (id_pegawai == undefined) {                
                alert('Nama yang anda masukkan tidak ditemukan\nAnda harus memasukkan data karyawan di master karyawan');
                return false;
            }
            
            var //pegawai = $('#pegawai_dak').val(),
                pasien = $('#pasien_dak').val(),
                rujukan = $('#rujukan_dak').val(),
                dokter = $('#dokter_dak').val(),
                //nip = $('#nip_dak').val(),
                tgl_trans = $('#tgl_trans_dak').val(),
                no_surat = $('#no_surat_dak').val(),
                no_bukti = $('#no_bukti_dak').val(),
                //bagian = $('#bagian_dak').val(),
                tgl_kun = $('#tgl_kun_dak').val(),
                
                kunjungan = $('#kunjungan_dak').val(),
                kond_pasien = $('#kond_pasien_dak').val(),
                berat_bdn = $('#berat_bdn_dak').val(),
                tinggi_bdn = $('#tinggi_bdn_dak').val(),
                //bmi = $('#bmi_dak').val(),
                keterangan = $('#keterangan_dak').val(),
                kesadaran = $('#kesadaran_dak').val(),
                suhu_bdn = $('#suhu_bdn_dak').val(),
                tek_sistole = $('#tek_sistole_dak').val(),
                tek_diastole = $('#tek_diastole_dak').val(),
                anamnesis = $('#anamnesis_dak').val(),
                pernafasan = $('#pernafasan_dak').val(),
                nadi = $('#nadi_dak').val(),
                riwayat_alergi = $('#riwayat_alergi_dak').val();
             
            data_dak = "&pasien="+pasien+"&rujukan="+rujukan+"&id_dokter="+id_dokter+"&dokter="+dokter;
            data_dak = data_dak+"&tgl_trans="+tgl_trans+"&no_surat="+no_surat+"&no_bukti="+no_bukti+"&tgl_kun="+tgl_kun;
            data_dak = data_dak+"&kunjungan="+kunjungan+"&kond_pasien="+kond_pasien+"&berat_bdn="+berat_bdn+"&tinggi_bdn="+tinggi_bdn+"&keterangan="+keterangan+"&kesadaran="+kesadaran;
            data_dak = data_dak+"&suhu_bdn="+suhu_bdn+"&tek_sistole="+tek_sistole+"&tek_diastole="+tek_diastole+"&anamnesis="+anamnesis+"&pernafasan="+pernafasan+"&nadi="+nadi+"&riwayat_alergi="+riwayat_alergi;
            $.ajax({
               url : "<?php echo base_url(); ?>index.php/transaksi/dak/simpandata",
               data : data_dak,
               type: 'get',
               success: function(data){
                   if (data!=null){
                      alert("Data tersimpan : "+data);
                      id_kunjungan=data;
                      resetKunjungan();
                      $('#list_diagnosa_dak').trigger('reloadGrid');
                      $('#list_transaksi_dak').trigger('reloadGrid');
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
        
        $("#diagnosa_dak").autocomplete({
            minLength: 1,
            source:
            function(req, add){
                $.ajax({
                    url: "<?php echo base_url(); ?>index.php/transaksi/dak/lookdiagnosa",
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
        
        $(".button_diag_dak").click(function() {
            var diagnosa = $('#diagnosa_dak').val();            
            if (diagnosa == '') {
                alert('Diagnosa harus di isi');
                $('#diagnosa_dak').focus();
                return false;
            }
            if (id_kunjungan == undefined) {                
                alert('Isi Data Kunjungan dulu');
                //alert(diagnosa+":"+id_diagnosa);
                $('#pegawai_dak').focus();
                return false;
            }
            
            $.ajax({
               url : "<?php echo base_url(); ?>index.php/transaksi/dak/simpandiagnosa",
               data : "id="+id_kunjungan+"&diag="+diagnosa+"&id_diagnosa="+id_diagnosa,
               type: 'get',
               success: function(data){
                   if (data=="sukses"){
                       //resetDiagnosa();
                       $('#list_diagnosa_dak').trigger('reloadGrid');
                   } else {
                       alert("Gagal Menyimpan data");
                   } 
               },
               error: function(e){
                   alert("error pasien : "+e)
               }
            });
            $('#diagnosa_dak').val("");
            return false;
        });
        
        var grid = $("#list_diagnosa_dak");
    grid.jqGrid({
        url: '<?php echo base_url() ?>index.php/transaksi/dak/json', 
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
	pager: '#pager_diagnosa_dak',
	sortname: 'id_transaksi_diagnosa',
	viewrecords: true,
        shrinkToFit: false,
	sortorder: "desc",
	editurl: '<?php echo base_url() ?>index.php/transaksi/dak/crud', //URL Proses CRUD Nya
	multiselect: false, 
	caption: "Hasil Diagnosa" //Caption List					
    });
    grid.jqGrid('navGrid','#pager_diagnosa_dak',{search:false,view:false,edit:false,add:false,del:true},{},{},{});
        
        
        
  //kanggo transaksi      
        function tagihan(){
            $.ajax({
               url : "<?php echo base_url(); ?>index.php/transaksi/dak/tagihan",
               type: 'POST',
               success: function(data){
                   $('#jenis_tagihan_dak').html(data);
               },
               error: function(e){
                   alert("error rujukan : "+e)
               }
            });
        }
        
        $("#nama_tagihan_dak").autocomplete({
            minLength: 1,
            source:
            function(requ, add){
                var id_jenis=$('#jenis_tagihan_dak').val();
                var isi =$("#nama_tagihan_dak").val();
                if (id_jenis == '') {
                    alert('Jenis Tagihan Harus Dipilih');
                    $("#nama_tagihan_dak").val("");
                    $('.ui-autocomplete-loading').removeClass("ui-autocomplete-loading");
                    $('#jenis_tagihan_dak').focus();
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
                            }                         
                        }                    
                });
            },
            select:
                function(event, ui) {
                    id_item=ui.item.id;
                }
        });
        
        $("#doses_dak").autocomplete({
            minLength: 1,
            source:
            function(req, add){
                $.ajax({
                    url: "<?php echo base_url(); ?>index.php/transaksi/dak/lookdosis",
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
        
        $("#rekomendasi_dak").autocomplete({
            minLength: 1,
            source:
            function(req, add){
                $.ajax({
                    url: "<?php echo base_url(); ?>index.php/transaksi/dak/lookrekomendasi",
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
            $('#jenis_tagihan_dak').val("");
            $('#nama_tagihan_dak').val("");
            $('#jumlah_dak').val("");
            $('#kandungan_dak').val("");
            $('#disetujui_dak').val("");
            $('#doses_dak').val("");
            $('#rekomendasi_dak').val("");
        }
        
        $(".button_trans_dak").click(function() {
            if ($('#nama_tagihan_dak').val() == '') {
                alert('Nama Tagihan harus di isi');
                $('#nama_tagihan_dak').focus();
                return false;
            }
            if (id_kunjungan == undefined) {                
                alert('Isi Data Kunjungan dulu');
                //alert(diagnosa+":"+id_diagnosa);
                $('#pegawai_dak').focus();
                return false;
            }
            
            var jenis_tagihan = $('#jenis_tagihan_dak').val(),
                nama_tagihan = $('#nama_tagihan_dak').val(),
                jumlah = $('#jumlah_dak').val(),
                kandungan = $('#kandungan_dak').val(),
                disetujui = $('#disetujui_dak').val(),
                doses = $('#doses_dak').val(),
                rekomendasi = $('#rekomendasi_dak').val();
            var isi; 
            if ($('#doses_dak').val() == '') {
               // alert('Doses harus di isi :' +jenis_tagihan);
                $('#doses_dak').focus();
                return false;
            }
            
            isi="&jenis_tagihan="+jenis_tagihan+"&kunjungan="+id_kunjungan+"&id_item="+id_item+"&nama_tagihan="+nama_tagihan;
            isi=isi+"&jumlah="+jumlah+"&kandungan="+kandungan+"&disetujui="+disetujui+"&id_dosis="+id_doses+"&dosis="+doses+"&id_rekomendasi="+id_rekom+"&rekomendasi="+rekomendasi;
            
            $.ajax({
               url : "<?php echo base_url(); ?>index.php/transaksi/dak/simpanitem",
               data : isi,
               type: 'get',
               success: function(data){
                   if (data!=null){
                      //alert("Sukses gan");
                      resetTransaksi();
                      $('#list_transaksi_dak').trigger('reloadGrid');
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
        
        var grid2 = $("#list_transaksi_dak");
        grid2.jqGrid({
        url: '<?php echo base_url() ?>index.php/transaksi/dak/json2',
        datatype: "json",
	height: "auto",
	mtype: "GET",
	colNames: ['Id','Action','Jenis Tagihan','Nama Tagihan','Jumlah','Kandungan','Disetujui','Doses','Rekomendasi'],
	colModel: [
                    {name:'id_transaksi', key:true, index:'id_item_transaksi_dak', hidden:true,editable:false,  editrules:{required:true}},
                    {name: 'myac', width:40, fixed:true, sortable:false, search:false, align:'center', viewable: false, resizable: false, resize:false, formatter:'actions',
                        formatoptions:{keys:true,editbutton:false, delbutton: true}
                    },
                    {name:'jenis_item',index:'jenis_item',width:70,editable:true,editrules:{required:true}},
                    {name:'nama_item',index:'nama_item',width:70,editable:true,editrules:{required:true}},
                    {name:'jumlah',index:'jumlah',width:70,editable:true,editrules:{required:true}},
                    {name:'racikan',index:'racikan',width:70,editable:true,editrules:{required:true}},
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
	pager: '#pager_transaksi_dak',
	sortname: 'id_item_transaksi_dak',
        shrinkToFit: false,
	viewrecords: true,
	sortorder: "desc",
	editurl: '<?php echo base_url() ?>index.php/transaksi/dak/crud2', //URL Proses CRUD Nya
	multiselect: false, 
	caption: "Hasil Transaksi" //Caption List					
    });
    grid2.jqGrid('navGrid','#pager_transaksi_dak',{search:false, view:true,edit:false,add:false,del:true},{},{},{});				    
});
function isNumberKey(evt)
    {
        var charCode = (evt.which) ? evt.which : event.keyCode
	if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
	
        return true;
    }
</script>
<div id="trans_dak" style="width: auto; height: auto; overflow: auto;">
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
                                    <input type="hidden" name="id_kunjungan_dak" id="id_kunjungan_dak">
                                    <tr>
                                        <td>Pegawai:</td>
                                        <td><input type="text" name="pegawai_dak" id="pegawai_dak"></td>
                                    </tr>
                                    <tr>
                                        <td>Pasien:</td>
                                        <td><select id="pasien_dak" name="pasien_dak" style="width: 110px">
                                                <option>Pilih Pasien</option>
                                            </select>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Rujukan:</td>
                                        <td><select id="rujukan_dak" name="rujukan_dak" style="width: 110px">
                                                <option>Pilih Rujukan</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Dokter:</td>
                                        <td><input type="text" name="dokter_dak" id="dokter_dak"></td>
                                    </tr>
                                </table>                                
                            </td>
                            <td>
                                <table width="265">
                                    <tr>
                                        <td>NIP:</td>
                                        <td>
                                            <input type="text" name="nip_dak" id="nip_dak">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Tgl. Transaksi:</td>
                                        <td>
                                            <input type="text" name="tgl_trans_dak" id="tgl_trans_dak">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>No. Surat:</td>
                                        <td>
                                            <input type="text" name="no_surat_dak" id="no_surat_dak">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>No. Bukti:</td>
                                        <td>
                                            <input type="text" name="no_bukti_dak" id="no_bukti_dak">
                                        </td>
                                    </tr>				                                                                       
                                </table>                                
                            </td>
                            <td style="vertical-align: top">
                                <table width="265">
                                    <tr>
                                        <td>Bagian:</td>
                                        <td><input type="text" name="bagian_dak" id="bagian_dak"></td>
                                    </tr>
                                    <tr>
                                        <td>Tgl. Kunjungan:</td>
                                        <td><input type="text" name="tgl_kun_dak" id="tgl_kun_dak"></td>
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
            <fieldset>
                <legend>Pemeriksaan</legend>
                <form method="post" name="form4">
                    <table cellpadding="3" border="0">
                        <tr>
                            <td>
                                <table width="265">
                                    <input type="hidden" name="id_kunjungan_dak" id="id_kunjungan_dak">
                                    <tr>
                                        <td>Kunjungan:</td>
                                        <td><select name="kunjungan_dak" id="kunjungan_dak" style="width: 110px">
                                                <option>Pilih Kunjungan</option>
                                            </select>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Kond. Pasien:</td>
                                        <td><input type="text" id="kond_pasien_dak" name="kond_pasien_dak"></td>
                                    </tr>
                                    <tr>
                                        <td>Berat Bdn:</td>
                                        <td><input type="text" onkeypress="return isNumberKey(event)" id="berat_bdn_dak" name="berat_bdn_dak"></td>
                                    </tr>
                                    <tr>
                                        <td>Tinggi Bdn:</td>
                                        <td><input type="text" onkeypress="return isNumberKey(event)" name="tinggi_bdn_dak" id="tinggi_bdn_dak"></td>
                                    </tr>
                                    <tr>
                                        <td>BodyMassIndex:</td>
                                        <td><input type="text" name="bmi_dak" id="bmi_dak"></td>
                                    </tr>
                                </table>                                
                            </td>
                            <td>
                                <table width="265">
                                    <tr>
                                        <td>Keterangan:</td>
                                        <td>
                                            <input type="text" name="keterangan_dak" id="keterangan_dak">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Kesadaran:</td>
                                        <td>
                                            <input type="text" name="kesadaran_dak" id="kesadaran_dak">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Suhu Bdn:</td>
                                        <td>
                                            <input type="text" name="suhu_bdn_dak" id="suhu_bdn_dak">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Tek.Sistole:</td>
                                        <td>
                                            <input type="text" name="tek_sistole_dak" id="tek_sistole_dak">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Tek.Diastole:</td>
                                        <td>
                                            <input type="text" name="tek_diastole_dak" id="tek_diastole_dak">
                                        </td>
                                    </tr>				                                                                       
                                </table>                                
                            </td>
                            <td>
                                <table width="265">
                                    <tr>
                                        <td>Anamnesis:</td>
                                        <td><input type="text" name="anamnesis_dak" id="anamnesis_dak"></td>
                                    </tr>
                                    <tr>
                                        <td>Pernafasan:</td>
                                        <td><input type="text" name="pernafasan_dak" id="pernafasan_dak"></td>
                                    </tr>
                                    <tr>
                                        <td>Nadi:</td>
                                        <td><input type="text" name="nadi_dak" id="nadi_dak"></td>
                                    </tr>
                                    <tr>
                                        <td>Riwayat Alergi:</td>
                                        <td><input type="text"  id="riwayat_alergi_dak" name="riwayat_alergi_dak"></td>
                                    </tr>
                                    <tr>
                                        <td><input type="submit" value="Simpan" class="button_dak"></td>
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
                                                 <input type="text" name="diagnosa_dak" id="diagnosa_dak">
                                            </td>
                                            <td>
                                            <input type="submit" value="add" class="button_diag_dak">
                                            </td>                                        
                                            </tr>                                    
                                           </table> 
                                        </td>
                                    </tr>
                                </table>                                
                            </form>
                            <table id="list_diagnosa_dak" class="scroll" cellpadding="0" cellspacing="0"></table>
                            <div id="pager_diagnosa_dak" class="scroll" style="text-align:center;"></div>
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
                                                    <td><select id="jenis_tagihan_dak" name="jenis_tagihan_dak" style="width: 110px">
                                                            <option>Jenis Tagihan</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Nama Tagihan:</td>
                                                    <td><input type="text" name="nama_tagihan_dak" id="nama_tagihan_dak" /></td>
                                                </tr>
                                                <tr>
                                                    <td>Jumlah:</td>
                                                    <td><input type="text" name="jumlah_dak" id="jumlah_dak" /></td>
                                                </tr>                                                                                                
                                            </table>
                                        </td>
                                        <td>
                                            <table width="210">
                                                <tr>
                                                    <td>Kandungan:</td>
                                                    <td><input type="text" name="kandungan_dak" id="kandungan_dak" /></td>
                                                </tr>
                                                <tr>
                                                    <td>Disetujui:</td>
                                                    <td>
                                                        <select id="disetujui_dak" name="disetujui_dak" style="width: 110px">
                                                            <option value="y">Ya</option>
                                                            <option value="t">Tidak</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Doses:</td>
                                                    <td><input type="text" name="doses_dak" id="doses_dak" /></td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td style="vertical-align: top">
                                            <table width="210">                                                
                                                <tr>
                                                    <td>Rekomendasi:</td>
                                                    <td><input type="text" name="rekomendasi_dak" id="rekomendasi_dak" /></td>
                                                </tr>
                                                <tr>
                                                    <td><input type="submit" value="Tambah" class="button_trans_dak" /></td>
                                                    <td></td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </form>
                            <table id="list_transaksi_dak" class="scroll" cellpadding="0" cellspacing="0"></table>
                            <div id="pager_transaksi_dak" class="scroll" style="text-align:center;"></div>
                        </fieldset>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</div>