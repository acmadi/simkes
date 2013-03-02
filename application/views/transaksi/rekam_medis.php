<script type="text/javascript" >	 
$(this).ready( function() {
	var id_rs;
        
        $("#nip_rm").attr('disabled','disabled');
	$("#bagian_rm").attr('disabled','disabled');
        
        $(".button_rm").button();        
        
        $( "#tgl_trans_rm" ).datepicker({
            changeMonth: true,
            changeYear: true,
            showOn: "button",
            buttonImage : "<?php echo base_url();?>asset/images/calendar.gif",				
            buttonImageOnly : true
	});
        
        $( "#tgl_masuk_rm" ).datepicker({
            changeMonth     : true, // menampilkan dropdown untuk ganti bulan
            changeYear      : true, // menampilkan dropdown untuk ganti Tahun
            showOn          : "button",
            buttonImage     : "<?php echo base_url();?>asset/images/calendar.gif",				
            buttonImageOnly : true
	});
        
	$( "#tgl_keluar_rm" ).datepicker({
            changeMonth     : true, // menampilkan dropdown untuk ganti bulan
            changeYear      : true, // menampilkan dropdown untuk ganti Tahun
            showOn          : "button",
            buttonImage     : "<?php echo base_url();?>asset/images/calendar.gif",				
            buttonImageOnly : true
	});	

        $("#pegawai_rm").autocomplete({
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
                    $("#nip_rm").val(nip);
                    bagian(id_bag);
                    pasien(ui.item.id);
                }
        });        
              
	function bagian(id_bag){
            $.ajax({
               url : "<?php echo base_url(); ?>index.php/transaksi/rekam_medis/bagian",
               data : "id="+id_bag,
               type: 'POST',
               success: function(data){
                   $("#bagian_rm").val(data);
               },
               error: function(e){
                   alert("error bagian : "+e)
               }
            });
        }
        
        function pasien(nip){
            $.ajax({
               url : "<?php echo base_url(); ?>index.php/transaksi/rekam_medis/pasien",
               data : "id="+nip,
               type: 'POST',
               success: function(data){
                   $('#pasien_rm').html(data);
               },
               error: function(e){
                   alert("error pasien : "+e)
               }
            });
        }        
        
        $("#rumah_sakit_rm").autocomplete({
            minLength: 1,
            source:
            function(req, add){
                $.ajax({
                    url: "<?php echo base_url(); ?>index.php/transaksi/rekam_medis/lookrs",
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
           
	function resetKunjungan(){
            $('#pegawai_rm').val("");
            $('#pasien_rm').val("");
            $('#rumah_sakit_rm').val("");
            $('#nip_rm').val("");
            $('#tgl_trans_rm').val("");
            $('#tgl_masuk_rm').val("");
            $('#bagian_rm').val("");
            $('#tgl_keluar_rm').val("");
            $('#no_surat_rm').val("");
            
            $('#diagnosa_masuk_rm').val("");
            $('#diagnosa_keluar_rm').val("");
            $('#riwayat_penyakit_rm').val("");
            $('#pemeriksaan_fisik_rm').val("");
            $('#hasil_lab_rm').val("");
            $('#hasil_rontgen_rm').val("");
            $('#pemeriksaan_lain_rm').val("");
            $('#progres_harian_rm').val("");
            $('#pasca_rawat_rm').val("");
            $('#tindakan_rm').val("");
        }
        
        $(".button_rm").click(function() {                                         
            if ($('#pegawai_rm').val() == '') {
                alert('Pegawai harus di isi');
                $('#pegawai_rm').focus();
                return false;
            }             
            
            var pegawai = $('#pegawai_rm').val(),
                pasien = $('#pasien_rm').val(),                                
                rumah_sakit = $('#rumah_sakit_rm').val(),
                nip = $('#nip_rm').val(),
                tgl_trans = $('#tgl_trans_rm').val(),
                tgl_masuk = $('#tgl_masuk_rm').val(),
                tgl_keluar = $('#tgl_keluar_rm').val(),                
                no_surat = $('#no_surat_rm').val(),
                
                diagnosa_masuk = $('#diagnosa_masuk_rm').val(),
                diagnosa_keluar = $('#diagnosa_keluar_rm').val(),
                riwayat_penyakit = $('#riwayat_penyakit_rm').val(),
                pemeriksaan_fisik = $('#pemeriksaan_fisik_rm').val(),
                hasil_lab = $('#hasil_lab_rm').val(),
                hasil_rontgen = $('#hasil_rontgen_rm').val(),
                pemeriksaan_lain = $('#pemeriksaan_lain_rm').val(),
                progres_harian = $('#progres_harian_rm').val(),
                pasca_rawat = $('#pasca_rawat_rm').val(),
                tindakan = $('#tindakan_rm').val();
                             
            var data_rm = "&pegawai="+pegawai+"&pasien="+pasien+"&id_rs="+id_rs+"&rumah_sakit="+rumah_sakit+"&nip="+nip+"&tgl_trans="+tgl_trans
                        +"&tgl_masuk="+tgl_masuk+"&tgl_keluar="+tgl_keluar+"&no_surat="+no_surat
                        +"&diagnosa_masuk="+diagnosa_masuk+"&diagnosa_keluar="+diagnosa_keluar+"&riwayat_penyakit="+riwayat_penyakit+"&pemeriksaan_fisik="+pemeriksaan_fisik
                        +"&hasil_lab="+hasil_lab+"&hasil_rontgen="+hasil_rontgen+"&pemeriksaan_lain="+pemeriksaan_lain
                        +"&progres_harian="+progres_harian+"&pasca_rawat="+pasca_rawat+"&tindakan="+tindakan;
            //alert(data_rm);
            
            $.ajax({
               url : "<?php echo base_url(); ?>index.php/transaksi/rekam_medis/simpandata",
               data : data_rm,
               type: 'get',
               success: function(data){
                   if (data=="sukses"){
                      alert("Data berhasil disimpan");
                      resetKunjungan();                     
                   } else {
                       alert("Gagal Menyimpan Data!");
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
<div id="trans_rekam_medis" style="width: auto; height: auto; overflow: auto;">
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
                                    <tr>
                                        <td>Pegawai:</td>
                                        <td><input type="text" name="pegawai_rm" id="pegawai_rm"></td>
                                    </tr>
                                    <tr>
                                        <td>Pasien:</td>
                                        <td><select id="pasien_rm" name="pasien_rm" style="width: 110px">
                                                <option>Pilih Pasien</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Rumah Sakit:</td>
                                        <td><input type="text" name="rumah_sakit_rm" id="rumah_sakit_rm"></td>
                                    </tr>
                                </table>
                            </td>
                            <td style="vertical-align: top">
                                <table width="265">
                                    <tr>
                                        <td>NIP:</td>
                                        <td>
                                            <input type="text" name="nip_rm" id="nip_rm">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Tgl. Transaksi:</td>
                                        <td>
                                            <input type="text" name="tgl_trans_rm" id="tgl_trans_rm">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Tgl. Masuk:</td>
                                        <td>
                                            <input type="text" name="tgl_masuk_rm" id="tgl_masuk_rm">
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <td>
                                <table width="265">
                                    <tr>
                                        <td>Bagian:</td>
                                        <td><input type="text" name="bagian_rm" id="bagian_rm"></td>
                                    </tr>
                                    <tr>
                                        <td>Tgl. Keluar:</td>
                                        <td><input type="text" name="tgl_keluar_rm" id="tgl_keluar_rm"></td>
                                    </tr>
                                    <tr>
                                        <td>No RM:</td>
                                        <td><input type="text" name="no_surat_rm" id="no_surat_rm"></td>
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
                                        <td><input type="text" name="diagnosa_masuk_rm" id="diagnosa_masuk_rm"></td>
                                    </tr>
                                    <tr>
                                        <td>Diagnosa Keluar:</td>
                                        <td><input type="text" name="diagnosa_keluar_rm" id="diagnosa_keluar_rm"></td>
                                    </tr>
                                    <tr>
                                        <td>Riwayat Penyakit:</td>
                                        <td><textarea name="riwayat_penyakit_rm" id="riwayat_penyakit_rm"></textarea></td>
                                    </tr>
                                    <tr>
                                        <td>Pemeriksaan Fisik:</td>
                                        <td><textarea name="pemeriksaan_fisik_rm" id="pemeriksaan_fisik_rm"></textarea></td>
                                    </tr>
                                </table>
                            </td>
                            <td style="vertical-align: top">
                                <table width="265">
                                    <tr>
                                        <td>Hasil Lab:</td>
                                        <td><textarea name="hasil_lab_rm" id="hasil_lab_rm"></textarea></td>
                                    </tr>
                                    <tr>
                                        <td>Hasil Rontgen:</td>
                                        <td><textarea name="hasil_rontgen_rm" id="hasil_rontgen_rm"></textarea></td>
                                    </tr>
                                    <tr>
                                        <td>Hasil Pemeriksaan Lain:</td>
                                        <td><textarea name="pemeriksaan_lain_rm" id="pemeriksaan_lain_rm"></textarea></td>
                                    </tr>
                                </table>
                            </td>
                            <td style="vertical-align: top">
                                <table width="265">
                                    <tr>
                                        <td>Progres Harian:</td>
                                        <td><textarea name="progres_harian_rm" id="progres_harian_rm"></textarea></td>
                                    </tr>
                                    <tr>
                                        <td>Keadaan Pasca Rawat:</td>
                                        <td><textarea name="pasca_rawat_rm" id="pasca_rawat_rm"></textarea></td>
                                    </tr>
                                    <tr>
                                        <td>Tindakan:</td>
                                        <td><input type="text" name="tindakan_rm" id="tindakan_rm"></td>
                                    </tr>
                                    <tr>
                                        <td><input type="submit" value="Simpan" class="button_rm"></td>
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
                                                              