<script type="text/javascript">
                <?php
                $namafile="hasilapotek";
                $idgriditem="listitem1".$namafile;
                $idpagergriditem="pageritem1".$namafile;
                ?>
//                var idgriditem='#'+'<?php echo $idgriditem;?>';
//                var idpagergriditem='#'+'<?php echo $idpagergriditem;?>';

                var id_kunjungan =10;
                
                function tagihan(){
            $.ajax({
               url : "<?php echo base_url(); ?>index.php/transaksi/apotek/tagihan",
               type: 'POST',
               success: function(data)
			   {
                   $('#jenis_tagihan').html(data);
               },
               error: function(e){
                   alert("Error Kunjungan : "+e)
               }
            });
                }

                function edititem()
                {
                $.ajax({
               url : "<?php echo base_url(); ?>index.php/transaksi/apotek/tagihan",
               type: 'POST',
               success: function(data)
			   {
                   $('#jenis_tagihan').html(data);
               },
               error: function(e){
                   alert("Error Kunjungan : "+e)
               }
               });    
                }

            $("#transapotek_tagihan").autocomplete({
            minLength: 1,
            source:
            function(requ, add){
                var id_jenis=$('#jenis_tagihan').val();
                var isi =$("#transapotek_tagihan").val();
                if (id_jenis == '') {
                    alert('Jenis Tagihan Harus Dipilih');
                    $("#transapotek_tagihan").val("");
                    $('.ui-autocomplete-loading').removeClass("ui-autocomplete-loading");
                    $('#jenis_tagihan').focus();
                    return false;
                }

                $.ajax({
                    url: "<?php echo base_url(); ?>index.php/transaksi/apotek/looktagihan",
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
                                $("#transapotek_harga_standart").val("");
                            }
                        }
                });
            },
            select:
                function(event, ui) {
                    $("#transapotek_harga_standart").val(ui.item.harga);
                    id_item=ui.item.id;
                }
        });


    function isNumberKey(evt)
    {
        var charCode = (evt.which) ? evt.which : event.keyCode
	if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

        return true;
    }
    function selisih(){
        var a=$('#transapotek_jumlah').val();
        var b=$('#transapotek_harga_satuan').val();
        var c=$('#transapotek_harga_standart').val();

        $('#transapotek_total').val(a*b);
        $('#transapotek_selisih').val(a*c-a*b);
    }
    $('#transapotek_harga_satuan').keyup(function(){
        selisih();
    });
    $('#transapotek_harga_standart').keyup(function(){
        selisih();
    });
    $('#transapotek_jumlah').keyup(function(){
        selisih();
    });
     $("#transapotek_rekomendasi").autocomplete({
            minLength: 1,
            source:
            function(req, add){
                $.ajax({
                    url: "<?php echo base_url(); ?>index.php/transaksi/apotek/lookrekomendasi",
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
    $("#transapotek_doses").autocomplete({
            minLength: 1,
            source:
            function(req, add){
                $.ajax({
                    url: "<?php echo base_url(); ?>index.php/transaksi/apotek/lookdosis",
                    dataType: 'json',
                    type: 'POST',
                    data: req,
                    success:
                        function(data){
                            if(data.response =="true"){
                                add(data.message);
                            } else if(data.response =="false"){
                                $('.ui-autocomplete-loading').removeClass("ui-autocomplete-loading");
                                id_doses="undefined";
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

         $(".button_trans").click(function() {
            if (id_kunjungan== undefined) {
                alert('Isi data Kunjungan dulu');
                $('#transapotek_pegawai').focus();
                return false;
            }
            if ($('#transapotek_tagihan').val() == '') {
                alert('Nama Tagihan harus di isi');
                $('#transapotek_tagihan').focus();
                return false;
            }
            if ($('#transapotek_harga_standart').val() == '') {
                alert('Harga Standart harus di isi');
                $('#transapotek_harga_standart').focus();
                alert(id_doses);
                alert(id_rekom);
                return false;
            }
            var jenis_tagihan=$('#jenis_tagihan').val(),
                nama_tagihan=$('#transapotek_tagihan').val(),
                harga_standart=$('#transapotek_harga_standart').val(),
                harga_satuan=$('#transapotek_harga_satuan').val(),
                jumlah=$('#transapotek_jumlah').val(),
                //total=$('#transapotek_total').val(),
                //selisih=$('#transapotek_selisih').val(),
                racikan=$('#transapotek_racikan').val(),
                disetujui=$('#transapotek_disetujui').val(),
                doses=$('#transapotek_doses').val(),
                rekomendasi=$('#transapotek_rekomendasi').val();
            var isi;
            isi="&jenis_tagihan="+jenis_tagihan+"&kunjungan="+id_kunjungan+"&nama_tagihan="+nama_tagihan+"&id_item="+id_item+"&harga_standart="+harga_standart+"&harga_satuan="+harga_satuan;
            isi=isi+"&jumlah="+jumlah+"&racikan="+racikan+"&disetujui="+disetujui+"&id_dosis="+id_doses+"&dosis="+doses+"&id_rekomendasi="+id_rekom+"&rekomendasi="+rekomendasi;

            $.ajax({
               url : "<?php echo base_url(); ?>index.php/transaksi/apotek/simpanitem",
               data : isi,
               type: 'get',
               success: function(data){
                   if (data!=null){
                      //alert("Sukses gan");
                      resetTransaksi();
                      $('#listtransaksi').trigger('reloadGrid');
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

        function resetTransaksi(){
            $('#jenis_tagihan').val("");
            $('#transapotek_tagihan').val("");
            $('#transapotek_harga_standart').val("");
            $('#transapotek_harga_satuan').val("");
            $('#transapotek_jumlah').val("");
            $('#transapotek_total').val("");
            $('#transapotek_selisih').val("");
            $('#transapotek_racikan').val("");
            $('#transapotek_doses').val("");
            $('#transapotek_rekomendasi').val("");
        }
        

</script>

<div id="tabs-1" style="width: auto; height: auto; overflow: auto;">
<table  width="70%" border="0">
    
    <tr>
        <td>
            <table>
                <tr>
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
                                                    <td><select id="jenis_tagihan" name="jenis_tagihan" onfocus="tagihan();">
                                                        <option>--pilih--</option>
                                                        </select></td>
                                                </tr>
                                                <tr>
                                                    <td>Nama Tagihan:</td>
                                                    <td><input type="text" name="transapotek_tagihan" id="transapotek_tagihan" /></td>
                                                </tr>
                                                <tr>
                                                    <td>Harga Standart:</td>
                                                    <td><input type="text" name="transapotek_harga_standart" onkeypress="return isNumberKey(event)" id="transapotek_harga_standart" /></td>
                                                </tr>
                                                <tr>
                                                    <td>Harga Satuan:</td>
                                                    <td><input type="text" name="transapotek_harga_satuan" onkeypress="return isNumberKey(event)" id="transapotek_harga_satuan" /></td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td>
                                            <table width="210">
                                                <tr>
                                                    <td>Jumlah:</td>
                                                    <td><input type="text" name="transapotek_jumlah" onkeypress="return isNumberKey(event)" id="transapotek_jumlah" /></td>
                                                </tr>
                                                <tr>
                                                    <td>Total:</td>
                                                    <td><input type="text" name="transapotek_total" id="transapotek_total" /></td>
                                                </tr>
                                                <tr>
                                                    <td>Selisih:</td>
                                                    <td><input type="text" name="transapotek_selisih" id="transapotek_selisih" /></td>
                                                </tr>
                                                <tr>
                                                    <td>Racikan:</td>
                                                    <td><input type="text" name="transapotek_racikan" id="transapotek_racikan" /></td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td>
                                            <table width="110" >
                                                <tr>
                                                    <td>Disetujui:</td>
                                                    <td>
                                                        <select id="transapotek_disetujui" name="transapotek_disetujui">
                                                            <option value="y">Ya</option>
                                                            <option value="t">Tidak</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Doses:</td>
                                                    <td><input type="text" name="transapotek_doses" id="transapotek_doses" /></td>
                                                </tr>
                                                <tr>
                                                    <td>Rekomendasi:</td>
                                                    <td><input type="text" name="transapotek_rekomendasi" id="transapotek_rekomendasi" /></td>
                                                </tr>
                                                <tr>
                                                    <td><input type="button" value="Tambah" class="button_trans" /></td>
                                                    <td></td>
                                                </tr>
                                            </table>
                                            
                                        </td>
                                        
                                        <td>
                                            <table width="210">
                                               
                                            </table>

                                        </td>
                                    </tr>
                                </table>
                            </form>
                        </fieldset>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    
</table>
</div>