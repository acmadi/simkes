<script type="text/javascript" >	 
$(this).ready( function() {
	var data_kunjunganrs;        
        var id_kunjungan,
            id_dokter,
            id_rs;
        $("#nip_kunjunganrs").attr('disabled','disabled');
	$("#bagian_kunjunganrs").attr('disabled','disabled');
        $("#selisih_trans_kunjunganrs").attr('disabled','disabled');
        
        $(".button_kunjunganrs").button();        
        
        $( "#tgl_trans_kunjunganrs" ).datepicker({
            changeMonth: true,
            changeYear: true,
            showOn: "button",
            buttonImage : "<?php echo base_url();?>asset/images/calendar.gif",				
            buttonImageOnly : true
	});
        
        $( "#tgl_masuk_kunjunganrs" ).datepicker({
            changeMonth     : true, // menampilkan dropdown untuk ganti bulan
            changeYear      : true, // menampilkan dropdown untuk ganti Tahun
            showOn          : "button",
            buttonImage     : "<?php echo base_url();?>asset/images/calendar.gif",				
            buttonImageOnly : true
	});
        
	$( "#tgl_keluar_kunjunganrs" ).datepicker({
            changeMonth     : true, // menampilkan dropdown untuk ganti bulan
            changeYear      : true, // menampilkan dropdown untuk ganti Tahun
            showOn          : "button",
            buttonImage     : "<?php echo base_url();?>asset/images/calendar.gif",				
            buttonImageOnly : true
	});	

        $("#pegawai_kunjunganrs").autocomplete({
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
                        }                        
                    }                    
              });
            },
            select:
                function(event, ui) {
                    var id_bag=ui.item.bagian,
                        nip=ui.item.nip;
                    $("#nip_kunjunganrs").val(nip);
                    $("#id_bagian_kunjunganrs").val(ui.item.id); 
                    bagian(id_bag);
                    //rujukan();
                    pasien(ui.item.id);
                    //kunjungan();
                    //tagihan();
                }
        });        
              
	function bagian(id_bag){
            $.ajax({
               url : "<?php echo base_url(); ?>index.php/transaksi/kunjunganrs/bagian",
               data : "id="+id_bag,
               type: 'POST',
               success: function(data){
                   $("#bagian_kunjunganrs").val(data);
               },
               error: function(e){
                   alert("error bagian : "+e)
               }
            });
        }
        
        function pasien(nip){
            $.ajax({
               url : "<?php echo base_url(); ?>index.php/transaksi/kunjunganrs/pasien",
               data : "id="+nip,
               type: 'POST',
               success: function(data){
                   $('#pasien_kunjunganrs').html(data);
               },
               error: function(e){
                   alert("error pasien : "+e)
               }
            });
        }        
        
        $("#rumah_sakit_kunjunganrs").autocomplete({
            minLength: 1,
            source:
            function(req, add){
                $.ajax({
                    url: "<?php echo base_url(); ?>index.php/transaksi/kunjunganrs/lookrs",
                    dataType: 'json',
                    type: 'POST',
                    data: req,
                    success:
                        function(data){
                            if(data.response =="true"){
                                add(data.message);
                            } else if(data.response =="false") {
                                $('.ui-autocomplete-loading').removeClass("ui-autocomplete-loading");
                                id_rs="undefined";
                            }							
                        }          
                });
            },
            select:
                function(event, ui) {
                    id_rs=ui.item.id;                    
                }
        });
        
        $("#dokter_kunjunganrs").autocomplete({
            minLength: 1,
            source:
            function(req, add){
                $.ajax({
                    url: "<?php echo base_url(); ?>index.php/transaksi/kunjunganrs/lookdokter",
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
           
	function resetKunjungan(){
            $('#pegawai_kunjunganrs').val("");
            $('#pasien_kunjunganrs').val("");
            $('#rumah_sakit_kunjunganrs').val("");
            $('#nip_kunjunganrs').val("");
            $('#tgl_trans_kunjunganrs').val("");
            $('#tgl_masuk_kunjunganrs').val("");
            $('#bagian_kunjunganrs').val("");
            $('#tgl_keluar_kunjunganrs').val("");
            $('#no_surat_kunjunganrs').val("");
            
            $('#diagnosa_masuk_kunjunganrs').val("");
            $('#kondisi_umum_kunjunganrs').val("");
            $('#dokter_rawat_kunjunganrs').val("");
            $('#dokter_kunjunganrs').val("");
            $('#jumlah_obat_kunjunganrs').val("");
            $('#rencana_tindakan_kunjunganrs').val("");
        }
        
        $(".button_kunjunganrs").click(function() {                                         
            if ($('#pegawai_kunjunganrs').val() == '') {
                alert('Pegawai harus di isi');
                $('#pegawai_kunjunganrs').focus();
                return false;
            }             
            
            var pegawai = $('#pegawai_kunjunganrs').val(),
                pasien = $('#pasien_kunjunganrs').val(),                                
                rumah_sakit = $('#rumah_sakit_kunjunganrs').val(),
                nip = $('#nip_kunjunganrs').val(),
                tgl_trans = $('#tgl_trans_kunjunganrs').val(),
                tgl_masuk = $('#tgl_masuk_kunjunganrs').val(),
                bagian = $('#bagian_kunjunganrs').val(),
                tgl_keluar = $('#tgl_keluar_kunjunganrs').val(),                
                no_surat = $('#no_surat_kunjunganrs').val(),
                
                diagnosa_masuk = $('#diagnosa_masuk_kunjunganrs').val(),
                kondisi_umum = $('#kondisi_umum_kunjunganrs').val(),
                dokter_rawat = $('#dokter_rawat_kunjunganrs').val(),
                dokter = $('#dokter_kunjunganrs').val(),
                jumlah_obat = $('#jumlah_obat_kunjunganrs').val(),
                rencana_tindakan = $('#rencana_tindakan_kunjunganrs').val();
            
            
            data_kunjunganrs = "&pegawai="+pegawai+"&pasien="+pasien+"&id_rs="+id_rs+"&rumah_sakit="+rumah_sakit+"&nip="+nip+"&tgl_trans="+tgl_trans;
            data_kunjunganrs = data_kunjunganrs+"&tgl_masuk="+tgl_masuk+"&tgl_keluar="+tgl_keluar+"&no_surat="+no_surat;
            data_kunjunganrs = data_kunjunganrs+"&diagnosa_masuk="+diagnosa_masuk+"&kondisi_umum="+kondisi_umum;            
            data_kunjunganrs = data_kunjunganrs+"&dokter_rawat="+dokter_rawat+"&id_dokter="+id_dokter+"&dokter="+dokter+"&jumlah_obat="+jumlah_obat+"&rencana_tindakan="+rencana_tindakan;
            //alert(data_kunjunganrs);
            
            $.ajax({
               url : "<?php echo base_url(); ?>index.php/transaksi/kunjunganrs/simpandata",
               data : data_kunjunganrs,
               type: 'get',
               success: function(data){
                   if (data=="sukses"){
                      alert("Data berhasil disimpan");
                      resetKunjungan();                     
                   } else {
                       alert("Data gagal disimpan "+data);
                   }                   
               },
               error: function(e){
                   alert("error : "+e)
               }
            });
            
            return false;
	});                				    
});
</script>
<div id="trans_kunjunganrs" style="width: auto; height: auto; overflow: auto;">
<table  width="100%" border="0">
    <tr>
        <td>
            <fieldset>
                <legend>Data Pasien</legend>
                <form method="post" name="form">
                    <table cellpadding="3" border="0">
                        <tr>
                            <td>
                                <table width="265">
                                    <input type="hidden" name="id_kunjungan_kunjunganrs" id="id_kunjungan_kunjunganrs">
                                    <tr>
                                        <td>Pegawai:</td>
                                        <td><input type="text" name="pegawai_kunjunganrs" id="pegawai_kunjunganrs"></td>
                                    </tr>
                                    <tr>
                                        <td>Pasien:</td>
                                        <td><select id="pasien_kunjunganrs" name="pasien_kunjunganrs" style="width: 110px">
                                                <option>Pilih Pasien</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Rumah Sakit:</td>
                                        <td><input type="text" name="rumah_sakit_kunjunganrs" id="rumah_sakit_kunjunganrs"></td>
                                    </tr>
                                </table>
                            </td>
                            <td style="vertical-align: top">
                                <table width="265">
                                    <tr>
                                        <td>NIP:</td>
                                        <td>
                                            <input type="text" name="nip_kunjunganrs" id="nip_kunjunganrs">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Tgl. Transaksi:</td>
                                        <td>
                                            <input type="text" name="tgl_trans_kunjunganrs" id="tgl_trans_kunjunganrs">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Tgl. Masuk:</td>
                                        <td>
                                            <input type="text" name="tgl_masuk_kunjunganrs" id="tgl_masuk_kunjunganrs">
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <td>
                                <table width="265">
                                    <tr>
                                        <td>Bagian:</td>
                                        <td><input type="text" name="bagian_kunjunganrs" id="bagian_kunjunganrs"></td>
                                    </tr>
                                    <tr>
                                        <td>Tgl. Keluar:</td>
                                        <td><input type="text" name="tgl_keluar_kunjunganrs" id="tgl_keluar_kunjunganrs"></td>
                                    </tr>
                                    <tr>
                                        <td>No Surat:</td>
                                        <td><input type="text" name="no_surat_kunjunganrs" id="no_surat_kunjunganrs"></td>
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
                <legend>Hasil Pemeriksaan</legend>
                <form method="post" name="form">
                    <table cellpadding="3" border="0">
                        <tr>
                            <td style="vertical-align: top">
                                <table width="265">
                                    <tr>
                                        <td>Diagnosa Masuk:</td>
                                        <td><input type="text" name="diagnosa_masuk_kunjunganrs" id="diagnosa_masuk_kunjunganrs"></td>
                                    </tr>
                                    <tr>
                                        <td>Kondisi Umum:</td>
                                        <td><textarea id="kondisi_umum_kunjunganrs" name="kondisi_umum_kunjunganrs"></textarea></td>
                                    </tr>
                                </table>
                            </td>
                            <td style="vertical-align: top">
                                <table width="265">
                                    <tr>
                                        <td>Dokter Rawat:</td>
                                        <td>
                                            <select name="dokter_rawat_kunjunganrs" id="dokter_rawat_kunjunganrs" style="width: 110px">
                                                <option></option>
                                                <option>Rawat Bersama</option>
                                                <option>Rawat Tunggal</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Dokter:</td>
                                        <td>
                                            <input type="text" name="dokter_kunjunganrs" id="dokter_kunjunganrs">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Jenis Jumlah Obat:</td>
                                        <td>
                                            <select name="jumlah_obat_kunjunganrs" id="jumlah_obat_kunjunganrs" style="width: 110px">
                                                <option></option>
                                                <option><5 macam</option>
                                                <option>5 macam</option>
                                                <option>>5 macam</option>
                                            </select>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <td style="vertical-align: top">
                                <table width="265">
                                    <tr>
                                        <td>Rencana Tindakan:</td>
                                        <td><input type="text" name="rencana_tindakan_kunjunganrs" id="rencana_tindakan_kunjunganrs"></td>
                                    </tr>
                                    <tr>
                                        <td><input type="submit" value="Simpan" class="button_kunjunganrs"></td>
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
</table>
</div>
                                                                   