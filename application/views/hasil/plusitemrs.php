<script type="text/javascript">
                <?php
                //$namafile="hasil".$modul;
                $idgriditem="listitem1_".$namafile;
                $idpagergriditem="pageritem1_".$namafile;
                $idtagihan=$namafile."_tagihan";
                $idhrg_standart=$namafile."_harga_standart";
                $idhrg_satuan=$namafile."_harga_satuan";
                $idjumlah=$namafile."_jumlah";
                $idtotal=$namafile."_total";
                $idselisih=$namafile."_selisih";
                $idracikan=$namafile."_racikan";
                $iddisetujui=$namafile."_disetujui";
                $iddoses=$namafile."_doses";
                $idrekomendasi=$namafile."_rekomendasi";
                $fungsiadditem=$namafile."simpanitem";
                $fungsitagihan=$namafile."tagihan";
                $iddokter=$namafile."_dokter";
                $idtglresep=$namafile."_tglresep";
                $idnilai=$namafile."_nilai";
                $idkandungan=$namafile."_kandungan";
                ?>
                var idgriditem='#'+'<?php echo $idgriditem;?>';
                var idpagergriditem='#'+'<?php echo $idpagergriditem;?>';
                var idtagihan='#'+'<?php echo $idtagihan;?>';
                var idhrg_standart='#'+'<?php echo $idhrg_standart;?>';
                var idhrg_satuan='#'+'<?php echo $idhrg_satuan;?>';
                var idjumlah='#'+'<?php echo $idjumlah;?>';
                var idtotal='#'+'<?php echo $idtotal;?>';
                var idselisih='#'+'<?php echo $idselisih;?>';
                var idracikan='#'+'<?php echo $idracikan;?>';
                var iddisetujui='#'+'<?php echo $iddisetujui;?>';
                var iddoses='#'+'<?php echo $iddoses;?>';
                var idrekomendasi='#'+'<?php echo $idrekomendasi;?>';
                var iddokter='#'+'<?php echo $iddokter;?>';
                var idtglresep='#'+'<?php echo $idtglresep;?>';
                var idnilai='#'+'<?php echo $idnilai;?>';
                var idkandungan='#'+'<?php echo $idkandungan;?>';

                var id_kunjungan =10;
                var id_dokter;

            $( "#tgl_resep_rs" ).datepicker({
            changeMonth: true,
            changeYear: true,
            showOn: "button",
            buttonImage : "<?php echo base_url();?>asset/images/calendar.gif",
            buttonImageOnly : true
	    });


            function <?php echo $fungsitagihan;?>(){
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

            $("#dokter_rs").autocomplete({
            minLength: 1,
            source:
            function(req, add){
                $.ajax({
                    url: "<?php echo base_url(); ?>index.php/transaksi/rs/lookdokter",
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


            $(idtagihan).autocomplete({
            minLength: 1,
            source:
            function(requ, add){
                var id_jenis=$('#jenis_tagihan').val();
                var isi =$(idtagihan).val();
                if (id_jenis == '') {
                    alert('Jenis Tagihan Harus Dipilih');
                    $(idtagihan).val("");
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
                                $(idhrg_standart).val("");
                            }
                        }
                });
            },
            select:
                function(event, ui) {
                    $(idhrg_standart).val(ui.item.harga);
                    id_item=ui.item.id;
                }
        });



                                var plusitem = $(idgriditem);
				plusitem.jqGrid({
					url: '<?php echo base_url() ?>index.php/hasil/<?php echo $namafile;?>/detail_item/'+<?php echo $idtrans;?>, //URL Tujuan Yg Mengenerate data Json nya
					datatype: "json", //Datatype yg di gunakan
					height: "auto", //Mengset Tinggi table jadi Auto menyesuaikan dengan isi table
					mtype: "GET",

					colNames: ['Id Transaksi','Jenis','Item','Jumlah','Hrg.Standar','Hrg.Satuan','Satuan','Kandungan','Dosis','Rekomendasi','Total'],
					colModel: [
						{name:'id_transaksi', key:true, index:'id_transaksi', hidden:true,editable:false,editrules:{required:true}},//name untuk variabel post yang dikirim saat menambah data
						{name:'jenis_item',index:'jenis_item',width:50,align:'center',editable:true,editrules:{required:true}},//index untuk variabel yang digunakan saat pencarian
						{name:'nama_item',index:'nama_item',width:40,align:'center',editable:true,editrules:{required:true}},
						{name:'jumlah',index:'jumlah', width:40,align:'center',editable:true,editrules:{required:true}},
						{name:'harga_item',index:'harga_item',width:55,align:'center',editable:true,editrules:{required:true}},
						{name:'hrg_satuan',index:'hrg_satuan',width:60,align:'center',editable:true,editrules:{required:true}},
						{name:'satuan',index:'satuan',width:40,align:'center',editable:true,editrules:{required:true}},
						{name:'kandungan',index:'kandungan',width:60,align:'center',editable:true,editrules:{required:true}},
						{name:'dosis',index:'dosis',width:30,align:'center',editable:true,editrules:{required:true}},
                                                {name:'rekomendasi',index:'rekomendasi',width:60,align:'center',editable:true,editrules:{required:true}},
                                                {name:'total',index:'total',width:50,align:'center',editable:true,editrules:{required:true}}
					],
					rownumbers:false,
                                        footerrow:true,
                                        userDataOnFooter:true,
                                        //altRows : true,
					rowNum: 10,
					rowList: [10,20,30],
					pager: idpagergriditem,
					sortname: 'id_transaksi',
                                        ondblClickRow: function(id_transaksi){
                                                    alert("You double click row with id: "+id_transaksi);
                                                    return false;
                                                    },
					viewrecords: true,
					sortorder: "desc",
					multiselect: false,
					caption: "Item Transaksi" //Caption List
				});
				plusitem.jqGrid('navGrid',idpagergriditem,{view:false,edit:false,add:false,del:false},{},{},{},{closeOnEscape:true,closeAfterSearch:false,multipleSearch:false, multipleGroup:false, showQuery:false,drag:true,showOnLoad:false,sopt:['cn'],resize:false,caption:'Cari Record', Find:'Cari', Reset:'Batalkan Pencarian'});
    function isNumberKey(evt)
    {
        var charCode = (evt.which) ? evt.which : event.keyCode
	if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

        return true;
    }
    function selisih(){
        var a=$(idjumlah).val();
        var b=$(idhrg_satuan).val();
        var c=$(idhrg_standart).val();

        $(idtotal).val(a*b);
        $(idselisih).val(a*c-a*b);
    }
    $(idhrg_satuan).keyup(function(){
        selisih();
    });
    $(idhrg_standart).keyup(function(){
        selisih();
    });
    $(idjumlah).keyup(function(){
        selisih();
    });
     $(idrekomendasi).autocomplete({
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
    $(iddoses).autocomplete({
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

        function <?php echo $fungsiadditem;?>()
        {
            if ($(idtagihan).val() == '') {
                alert('Nama Tagihan harus di isi');
                $(idtagihan).focus();
                return false;
            }
            if ($(iddoses).val() == '') {
                alert('Doses harus di isi');
                $(iddoses).focus();
                return false;
            }
            if ($(idrekomendasi).val() == '') {
                alert('Rekomendasi harus di isi');
                $(idrekomendasi).focus();
                return false;
            }
            if ($(idhrg_standart).val() == '') {
                alert('Harga Standart harus di isi');
                $(idhrg_standart).focus();

                return false;
            }
            var jenis_tagihan=$('#jenis_tagihan').val(),
                nama_tagihan=$(idtagihan).val(),
                harga_standart=$(idhrg_standart).val(),
                harga_satuan=$(idhrg_satuan).val(),
                jumlah=$(idjumlah).val(),
                //total=$('#hasilapotek_total').val(),
                //selisih=$('#hasilapotek_selisih').val(),
                disetujui=$(iddisetujui).val(),
                doses=$(iddoses).val(),
                rekomendasi=$(idrekomendasi).val();
            var dokter = $(iddokter).val(),
                tgl_resep = $(idtglresep).val(),
                nilai = $(idnilai).val(),
                kandungan = $(idkandungan).val();
            var isi;
            isi="&id_dokter="+id_dokter+"&dokter="+dokter+"&id_item="+id_item+"&jenis_tagihan="+jenis_tagihan
                +"&nama_tagihan="+nama_tagihan+"&id_transaksi="+<?php echo $idtrans;?>+"&harga_satuan="+harga_satuan+"&harga_standart="+harga_standart
                +"&jumlah="+jumlah+"&tgl_resep="+tgl_resep+"&nilai="+nilai+"&disetujui="+disetujui+"&id_dosis="+id_doses
                +"&dosis="+doses+"&kandungan="+kandungan+"&id_rekomendasi="+id_rekom+"&rekomendasi="+rekomendasi;
            //alert(isi);

            $.ajax({
               url : "<?php echo base_url(); ?>index.php/transaksi/rs/simpanitem",
               data : isi,
               type: 'get',
               success: function(data){
                   if (data!=null){
                      resetTransaksi();
                      $('#list_transaksi_rs').trigger('reloadGrid');
                   } else {
                       alert("gagal gan");
                   }
               },
               error: function(e){
                   alert("error : "+e);
               }
            });

            return false;
	}

        function resetTransaksi(){
            $('#jenis_tagihan').val("");
            $(idtagihan).val("");
            $(idhrg_standart).val("");
            $(idhrg_satuan).val("");
            $(idjumlah).val("");
            $(idtotal).val("");
            $(idselisih).val("");
            $(idracikan).val("");
            $(iddoses).val("");
            $(idrekomendasi).val("");
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
                                                    <td>Dokter:</td>
                                                    <td><input type="text" id="<?php echo $iddokter;?>" name="<?php echo $iddokter;?>" /></td>
                                                </tr>
                                                <tr>
                                                    <td>Jenis Tagihan:</td>
                                                    <td><select id="jenis_tagihan" name="jenis_tagihan" onfocus="<?php echo $fungsitagihan."()";?>;">
                                                        <option>--pilih--</option>
                                                        </select></td>
                                                </tr>
                                                <tr>
                                                    <td>Nama Tagihan:</td>
                                                    <td><input type="text" name="<?php echo $idtagihan;?>" id="<?php echo $idtagihan;?>" /></td>
                                                </tr>
                                                <tr>
                                                    <td>Harga Standart:</td>
                                                    <td><input type="text" name="<?php echo $idhrg_standart;?>" onkeypress="return isNumberKey(event)" id="<?php echo $idhrg_standart;?>" /></td>
                                                </tr>
                                                <tr>
                                                    <td>Harga Satuan:</td>
                                                    <td><input type="text" name="<?php echo $idhrg_satuan;?>" onkeypress="return isNumberKey(event)" id="<?php echo $idhrg_satuan;?>" /></td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td>
                                            <table width="210">
                                                <tr>
                                                    <td>Jumlah:</td>
                                                    <td><input type="text" name="<?php echo $idjumlah;?>" onkeypress="return isNumberKey(event)" id="<?php echo $idjumlah;?>" /></td>
                                                </tr>
                                                <tr>
                                                    <td>Total:</td>
                                                    <td><input type="text" name="<?php echo $idtotal;?>" id="<?php echo $idtotal;?>" /></td>
                                                </tr>
                                                <tr>
                                                    <td>Selisih:</td>
                                                    <td><input type="text" name="<?php echo $idselisih;?>" id="<?php echo $idselisih;?>" /></td>
                                                </tr>
                                                <tr>
                                                    <td>Tanggal Resep:</td>
                                                    <td><input type="text" name="<?php echo $idtglresep;?>" id="<?php echo $idtglresep;?>" /></td>
                                                </tr>
                                                <tr>
                                                    <td>Nilai:</td>
                                                    <td><input type="text" name="<?php echo $idnilai;?>" id="<?php echo $idnilai;?>" /></td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td>
                                            <table width="110" >
                                                <tr>
                                                    <td>Disetujui:</td>
                                                    <td>
                                                        <select id="<?php echo $iddisetujui;?>" name="<?php echo $iddisetujui;?>">
                                                            <option value="y">Ya</option>
                                                            <option value="t">Tidak</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Doses:</td>
                                                    <td><input type="text" name="<?php echo $iddoses;?>" id="<?php echo $iddoses;?>" /></td>
                                                </tr>
                                                <tr>
                                                    <td>Kandungan:</td>
                                                    <td><input type="text" name="<?php echo $idkandungan;?>" id="<?php echo $idkandungan;?>" /></td>
                                                </tr>
                                                <tr>
                                                    <td>Rekomendasi:</td>
                                                    <td><input type="text" name="<?php echo $idrekomendasi;?>" id="<?php echo $idrekomendasi;?>" /></td>
                                                </tr>
                                                <tr>
                                                    <td><input type="button" value="Tambah" onclick="<?php echo $fungsiadditem."()";?>;" /></td>
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
                            <table id="<?php echo $idgriditem;?>" class="scroll" cellpadding="0" cellspacing="0"></table>
                            <div id="<?php echo $idpagergriditem;?>" class="scroll" style="text-align:center;"></div>
                        </fieldset>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    
</table>
</div>