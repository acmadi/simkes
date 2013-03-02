<script type="text/javascript" >	 
$(this).ready( function() {
	var datanya;        
        var id_kunjungan,
            id_dokter,
            id_pegawai,
            id_item,
            id_apotek,
            id_doses,
            id_diagnosa,
            id_rekom;
        $("#transapotek_nip").attr('disabled','disabled');
	$("#transapotek_bagian").attr('disabled','disabled');
        $("#transapotek_total").attr('disabled','disabled');
        $("#transapotek_selisih").attr('disabled','disabled');
        
        $(".button").button();
        $(".button_diag").button();
        $(".button_trans").button();
		
        $("#transapotek_pegawai").autocomplete({
            minLength: 1,
            source:
            function(requ, add){
              $.ajax({
                url: "<?php echo base_url(); ?>index.php/master/tertanggung/lookpegawai",
                dataType: 'json',
                type: 'POST',
                data: requ,
                success:
                    function(data)
                    {
                        if(data.response =="true")
                        {
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
                    $("#transapotek_nip").val(nip);
                    $("#id_bagian").val(ui.item.id); 
                    bagian(id_bag);
                    rujukan();
                    pasien(ui.item.id);
                    tagihan();
                }
        });        
              
	function bagian(id_bag){
            $.ajax({
               url : "<?php echo base_url(); ?>index.php/transaksi/apotek/bagian",
               data : "id="+id_bag,
               type: 'POST',
               success: function(data)
               {
                   $("#transapotek_bagian").val(data);
               },
               error: function(e){
                   alert("error bagian : "+e)
               }
            });
        }
        
        function pasien(nip){
            $.ajax({
               url : "<?php echo base_url(); ?>index.php/transaksi/apotek/pasien",
               data : "id="+nip,
               type: 'POST',
               success: function(data){
                   $('#transapotek_pasien').html(data);
               },
               error: function(e){
                   alert("error pasien : "+e)
               }
            });
        }
        
        function rujukan(){
            $.ajax({
               url : "<?php echo base_url(); ?>index.php/transaksi/apotek/rujukan",
               type: 'POST',
               success: function(data){
                   $('#transapotek_rujukan').html(data);
                   //$('#jenis_tagihan').html(data);
               },
               error: function(e){
                   alert("error rujukan : "+e)
               }
            });
        }
        
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
        
        $("#transapotek_dokter").autocomplete({
            minLength: 1,
            source:
            function(req, add){
                var id_rujukan=$('#transapotek_rujukan').val();
                var isi =$("#transapotek_dokter").val();
                if (id_rujukan == '')
                {
                    alert('Jenis Rujukan Harus Dipilih');
                    $("#transapotek_dokter").val("");
                    $('.ui-autocomplete-loading').removeClass("ui-autocomplete-loading");
                    $('#transapotek_rujukan').focus();
                    return false;
                }
                $.ajax({
                    url: "<?php echo base_url(); ?>index.php/transaksi/apotek/lookdokter",
                    dataType: 'json',
                    data: "&term="+isi+"&kat_dokter="+id_rujukan+"&gol_dokter=3",
                    type: 'POST',
                    success:
                        function(data)
                        {
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


        
        $("#transapotek_apo").autocomplete({
            minLength: 1,
            source:
            function(req, add){
                $.ajax({
                    url: "<?php echo base_url(); ?>index.php/transaksi/apotek/lookapotek",
                    dataType: 'json',
                    type: 'POST',
                    data: req,
                    success:
                        function(data){
                            if(data.response =="true"){
                                add(data.message);
                            }	else if(data.response =="false"){
                                $('.ui-autocomplete-loading').removeClass("ui-autocomplete-loading");
                                
                                id_apotek="undefined";
                            }						
                        },
                    error: function(e){
                        alert("error apotek : "+e)
                    }    
                });
            },
            select:
                function(event, ui) {
                    id_apotek=ui.item.id;                    
                }
        });
        
        $("#transapotek_diagnosa").autocomplete({
            minLength: 1,
            source:
            function(req, add){
                $.ajax({
                    url: "<?php echo base_url(); ?>index.php/transaksi/apotek/lookdiagnosa",
                    dataType: 'json',
                    type: 'POST',
                    data: req,
                    success:
                        function(data){
                            if(data.response =="true")
                            {
                                add(data.message);
                            } else if(data.response =="false")
                            {
                                $('.ui-autocomplete-loading').removeClass("ui-autocomplete-loading");
                                 id_diagnosa="undefined";
                            }							
                        },
                        error: function(e){
                        alert("error apotek : "+e)
                                }
                        });
                        
                        },
                  select:
                function(event, ui)
                {
                    id_diagnosa=ui.item.id;
                }
        });
        
        $("#transapotek_tagihan").autocomplete({
            minLength: 1,
            source:
            function(requ, add)
           {
                var id_jenis=$('#jenis_tagihan').val();
                var isi =$("#transapotek_tagihan").val();
                if (id_jenis == '')
                {
                    alert('Jenis Tagihan Harus Dipilih');
                    $("#transapotek_tagihan").val("");
                    $('.ui-autocomplete-loading').removeClass("ui-autocomplete-loading");
                    $('#jenis_tagihan').focus();
                    return false;
                }
                
                $.ajax({
                    url: "<?php echo base_url(); ?>index.php/transaksi/apotek/looktagihan",
                    data: "&term="+isi+"&id="+id_jenis,
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
	/*	
            $("#transapotek_tagihan").autocomplete({
            minLength: 1,
            source:
            function(req, add){
            var isi=$('#jenis_tagihan').val();
            var isi_tag =$("#transapotek_tagihan").val();
            if (isi == '') {
                alert('Pilih tagihan dulu');
                $('#jenis_tagihan').focus();
                return false;
            }
                $.ajax({
                    url: "<?php echo base_url(); ?>index.php/transaksi/apotek/looktagihan",
                    data : "&id="+isi+"&term="+isi_tag,
                    dataType: 'json',
                    type: 'post',
                    //data: req,
                    success:
                        function(data){
                            if(data.response =="true"){
                                add(data.message);
                            }	else if(data.response =="false"){
                                $('.ui-autocomplete-loading').removeClass("ui-autocomplete-loading");
                                id_item=undefined;
                                
                            }						
                        },
                    error: function(e){
                        alert("error apotek : "+e)
                    }    
                });
            },
            select:
                function(event, ui)
                {
                  $("#transapotek_harga_standart").val(ui.item.harga);
                  $("#transapotek_racikan").val(ui.item.racikan);
                  id_item=ui.item.id;
                }
        });
*/
        $('#jenis_tagihan').change(function(){
            $('#transapotek_harga_standart').val("");
            $('#transapotek_tagihan').val("");
            id_item=undefined;
        });

	$( "#transapotek_tgl_trans" ).datepicker({
            //dateFormat  : "dd MM yy",
            changeMonth: true,
            changeYear: true,
            showOn: "button",
            buttonImage : "<?php echo base_url();?>asset/images/calendar.gif",				
            buttonImageOnly : true
	});
        
	$( "#transapotek_tgl_kun" ).datepicker({
            //dateFormat  : "dd MM yy",
            changeMonth     : true, // menampilkan dropdown untuk ganti bulan
            changeYear      : true, // menampilkan dropdown untuk ganti Tahun
            showOn          : "button",
            buttonImage     : "<?php echo base_url();?>asset/images/calendar.gif",				
            buttonImageOnly : true
	});
        
        function resetKunjungan(){
            $("#transapotek_pegawai").val("");
            //$("#transapotek_pasien").val("");
            //$('#transapotek_pasien').removeClass(html);
            $("#transapotek_rujukan").val("");
            $("#transapotek_dokter").val("");
            $("#transapotek_apo").val("");
            $("#transapotek_nip").val("");
            $("#transapotek_bagian").val("");
            $("#transapotek_tgl_trans").val("");
            $("#transapotek_no_surat").val("");
            $("#transapotek_no_bukti").val("");
            $("#transapotek_no_dak").val("");
            $("#id_bagian").val("");
            $("#transapotek_tgl_kun").val("");
            $("#transapotek_buku_besar").val("");
            $('#transapotek_restitusi').attr('checked', false);
        }
        
	$(".button").click(function() {
            var pegawai=$("#transapotek_pegawai").val(),
                pasien=$("#transapotek_pasien").val(),
                rujukan=$("#transapotek_rujukan").val(),
                dokter=$("#transapotek_dokter").val(),
                apotek=$("#transapotek_apo").val(),
                nip=$("#transapotek_nip").val(),
                tgl_trans=$("#transapotek_tgl_trans").val(),
                no_surat=$("#transapotek_no_surat").val(),
                no_bukti=$("#transapotek_no_bukti").val(),
                no_dak=$("#transapotek_no_dak").val(),
                id_bagian=$("#id_bagian").val(),
                tgl_kun=$("#transapotek_tgl_kun").val(),
                buku_besar=$("#transapotek_buku_besar").val(),
                
                restitusi;                
                if ($("#transapotek_restitusi").is(":checked")){
                    restitusi="y";
                } else {
                    restitusi="t";
                }          
            if ($('#transapotek_pegawai').val() == '') {
                alert('Pegawai harus di isi');
                $('#transapotek_pegawai').focus();
                return false;
            }
            if ($('#transapotek_pasien').val() == '') {
                alert('Pasien harus di isi');
                $('#transapotek_pasien').focus();
                return false;
            }
            if ($('#transapotek_rujukan').val() == '') {
                alert('Rujukan harus di isi');
                $('#transapotek_rujukan').focus();
                return false;
            }
            if ($('#transapotek_dokter').val() == '') {
                alert('Dokter harus di isi');
                $('#transapotek_dokter').focus();
                return false;
            }
            if ($('#transapotek_buku_besar').val() == '') {                
                alert('buku besar harus di isi');
                $('#transapotek_buku_besar').focus();
                return false;
            }
            
            /*datanya="&pasien="+pasien+"&rujukan="+rujukan+"&id_dokter="+id_dokter+"&apotek="+apotek+"&id_apotek="+id_apotek+"&nip="+nip;
            datanya=datanya+"&tgl_trans="+tgl_trans+"&no_surat="+no_surat+"&no_bukti="+no_bukti+"&no_dak="+no_dak+"&id_bagian="+id_bagian;
            datanya=datanya+"&tgl_kun="+tgl_kun+"&buku_besar="+buku_besar+"&restitusi="+restitusi;
            */
            datanya="&pasien="+pasien+"&rujukan="+rujukan+"&id_dokter="+id_dokter+"&id_apotek="+id_apotek+"&nip="+nip;
            datanya=datanya+"&tgl_trans="+tgl_trans+"&no_surat="+no_surat+"&no_bukti="+no_bukti+"&no_dak="+no_dak+"&id_bagian="+id_bagian;
            datanya=datanya+"&tgl_kun="+tgl_kun+"&buku_besar="+buku_besar+"&restitusi="+restitusi;
            
            
            $.ajax({
               url : "<?php echo base_url(); ?>index.php/transaksi/apotek/simpan",
               data : datanya,
               type: 'get',
               success: function(data){
                   if (data!=null){
                      alert("Data tersimpan : "+data);
                      id_kunjungan=data;
                      resetKunjungan();
                      $('#listdiagnosa').trigger('reloadGrid');
                      $('#listtransaksi').trigger('reloadGrid');
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
        
        $(".button_diag").click(function() {
            var diagnosa = $('#transapotek_diagnosa').val();
            if (diagnosa == '')
            {
                alert('Diagnosa harus di isi');
                //alert(id_kunjungan)
                $('#transapotek_diagnosa').focus();
                return false;
            }
            if (id_kunjungan == undefined)
            {
                alert('Isi data Kunjungan dulu');
                $('#transapotek_pegawai').focus();
                return false;
            }
            //var id_kun="23";
            $.ajax({
               url : "<?php echo base_url(); ?>index.php/transaksi/apotek/simpandiagnosa",
               data : "id="+id_kunjungan+"&diag="+diagnosa+"&id_diag="+id_diagnosa,
               type: 'get',
               success: function(data){
                   if (data=="sukses"){
                       resetDiagnosa();
                       $('#listdiagnosa').trigger('reloadGrid');
                   } else {
                       alert("Gagal Menyimpan data");
                   }
                   
               },
               error: function(e){
                   alert("error pasien : "+e)
               }
            });
            return false;
	});
        function resetDiagnosa(){
            $('#transapotek_diagnosa').val("");           
        }
        
        function jenis_tagihan(){
            $.ajax({
               url : "<?php echo base_url(); ?>index.php/transaksi/apotek/tagihan",
               //data : "id="+nip,
               type: 'POST',
               success: function(data){
                   $('#jenis_tagihan').html(data);
               },
               error: function(e){
                   alert("error jenis tagihan : "+e)
               }
            });
        };
        
        $(".edit").click(function(){
            alert("ok");
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

    var grid = $("#listtransaksi");
    grid.jqGrid({
        url: '<?php echo base_url() ?>index.php/transaksi/apotek/json2', //URL Tujuan Yg Mengenerate data Json nya
        datatype: "json", //Datatype yg di gunakan
	height: "auto", //Mengset Tinggi table jadi Auto menyesuaikan dengan isi table
	mtype: "GET",
	colNames: ['Id','Action','Jenis Tagihan','Nama Tagihan','Harga Standar','Harga Satuan','Jumlah','Total','Selisih','Racikan','Disetujui','Doses','Rekomendasi'],
	colModel: [
                    {name:'id_item_transaksi_apotek', key:true, index:'id_item_transaksi_apotek', hidden:true,editable:false,  editrules:{required:true}},//name untuk variabel post yang dikirim saat menambah data                    
                    //{name:'id_item', key:true,      index:'id_item', hidden:true,editable:false,editrules:{required:true}},
                    {name: 'myac', width:40, fixed:true, sortable:false, search:false, align:'center', viewable: false, resizable: false, resize:false, formatter:'actions',
                        formatoptions:{keys:true,editbutton:false, delbutton: true //Key True disini adalah untuk Shorcut Tombol Enter dan Esc, Enter untuk Save, dan Escape Untuk Batal, anda juga Membuatnya jadi False jika anda tidak ingin seperti itu	
			}
                    },
                    {name:'jenis_item',index:'jenis_item',width:100,editable:true,editrules:{required:true}},
                    {name:'nama_item',index:'nama_item',width:70,editable:true,editrules:{required:true}},
                    {name:'harga_item',index:'harga_item',width:70,editable:true,editrules:{required:true}},
                    {name:'hrg_satuan',index:'hrg_satuan',width:70,editable:true,editrules:{required:true}},
                    {name:'jumlah',index:'jumlah',width:70,editable:true,editrules:{required:true}},
                    {name:'total',index:'total',width:70,editable:true,editrules:{required:true}},
                    {name:'selisih',index:'selisih',width:70,editable:true,editrules:{required:true}},
                    {name:'racikan',index:'racikan',width:70,editable:true,editrules:{required:true}},
                    {name:'disetujui',index:'disetujui',width:70,editable:true,editrules:{required:true}},
                    {name:'nama_dosis',index:'nama_dosis',width:70,editable:true,editrules:{required:true}},
                    {name:'nama_rekomendasi',index:'nama_rekomendasi',width:100,editable:true,editrules:{required:true}},                    
                    ],
        rownumbers:true,
	rowNum: 20,
	rowList: [10,20,30],
        postData: {idkunj : function()
                  {
                    return id_kunjungan;
                  }},
        width:630,
	pager: '#pagertransaksi',
	sortname: 'id_item_transaksi_apotek',
        shrinkToFit: false,
	viewrecords: true,
	sortorder: "desc",
	editurl: '<?php echo base_url() ?>index.php/transaksi/apotek/crud2', //URL Proses CRUD Nya
	multiselect: false, 
	caption: "Item Transaksi" //Caption List					
    });
    grid.jqGrid('navGrid','#pagertransaksi',{search:false, view:true,edit:false,add:false,del:true},{},{},{});				
    
    ///////////////////////////////////////
    var grid2 = $("#listdiagnosa");
    grid2.jqGrid({
        url: '<?php echo base_url() ?>index.php/transaksi/apotek/json', //URL Tujuan Yg Mengenerate data Json nya
        datatype: "json", //Datatype yg di gunakan
     
	height: "auto", //Mengset Tinggi table jadi Auto menyesuaikan dengan isi table
	mtype: "GET",
	colNames: ['Id','Diagnosa','Act'],
	colModel: [
                    {name:'id_transaksi_diagnosa', key:true, index:'id_transaksi_diagnosa', hidden:true,editable:false,editrules:{required:true}},//name untuk variabel post yang dikirim saat menambah data                    
                    {name:'nama_diagnosa',index:'nama_diagnosa',width:70,editable:true,editrules:{required:true}},
                    {name: 'myac', width:40, fixed:true, sortable:false, search:false, align:'center', viewable: false, resizable: false, resize:false, formatter:'actions',
                        formatoptions:{keys:true,editbutton:false, delbutton: true //Key True disini adalah untuk Shorcut Tombol Enter dan Esc, Enter untuk Save, dan Escape Untuk Batal, anda juga Membuatnya jadi False jika anda tidak ingin seperti itu	
			}
                    }
                    ],
        rownumbers:true,
	rowNum: 20,
	rowList: [10,20,30],
        postData: {idkunj : function()
                  {
                        return id_kunjungan;
                  }},
	pager: '#pagerdiagnosa',
	sortname: 'id_transaksi_diagnosa',
	viewrecords: true,
        shrinkToFit: false,
	sortorder: "desc",
	editurl: '<?php echo base_url() ?>index.php/transaksi/apotek/crud', //URL Proses CRUD Nya
	multiselect: false, 
	caption: "Diagnosa" //Caption List					
    });
    grid2.jqGrid({},{},{search:false,view:false,edit:false,add:false,del:true},{},{},{});
    
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
});

function isNumberKey(evt)
    {
        var charCode = (evt.which) ? evt.which : event.keyCode
	if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
	
        return true;
    }
</script>


<div id="tabs-1" style="width: auto; height: auto; overflow: auto;">
<table  width="100%" border="0">
    <tr>
        <td>
            <fieldset>
                <legend>Kunjungan Apotek</legend>
                <form method="post" name="form">
                    <table cellpadding="3" border="0">
                        <tr>
                            <td>
                                <table width="265">
                                    <input type="hidden" name="id_kunjungan" id="id_kunjungan">
                                    <tr>
                                        <td>Pegawai:</td>
                                        <td><input type="text" name="transapotek_pegawai" id="transapotek_pegawai"></td>
                                    </tr>
                                    <tr>
                                        <td>Pasien:</td>
                                        <td><select id="transapotek_pasien" name="transapotek_pasien" style="width: 110px">
                                                <option>Pilih Pasien</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Rujukan:</td>
                                        <td><select id="transapotek_rujukan" name="transapotek_rujukan" style="width: 110px" >
                                                <option>Pilih Rujukan</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Dokter:</td>
                                        <td><input type="text" name="transapotek_dokter" id="transapotek_dokter"></td>
                                    </tr>
                                    <tr>
                                        <td>Apotek:</td>
                                        <td><input type="text" name="transapotek_apotek" id="transapotek_apo"></td>
                                    </tr>
                                </table>                                
                            </td>
                            <td>
                                <table width="265">
                                    <tr>
                                        <td>NIP:</td>
                                        <td>
                                            <input type="text" name="transapotek_nip" id="transapotek_nip">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Tgl. Transaksi:</td>
                                        <td>
                                            <input type="text" name="transapotek_tgl_trans" id="transapotek_tgl_trans">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>No. Surat:</td>
                                        <td>
                                            <input type="text" name="transapotek_no_surat" id="transapotek_no_surat">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>No. Bukti:</td>
                                        <td>
                                            <input type="text" name="transapotek_no_bukti" id="transapotek_no_bukti">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>No. DAK:</td>
                                        <td>
                                            <input type="text" name="transapotek_no_dak" id="transapotek_no_dak">
                                        </td>
                                    </tr>				                                                                       
                                </table>                                
                            </td>
                            <td>
                                <table width="300">
                                    <tr>
                                        <td>Bagian:</td>
                                        <td><input type="text" name="transapotek_bagian" id="transapotek_bagian"></td>
                                    </tr>
                                    <tr>
                                        <td>Tgl. Kunjungan:</td>
                                        <td><input type="text" name="transapotek_tgl_kun" id="transapotek_tgl_kun"></td>
                                    </tr>
                                    <tr>
                                        <td>Buku Besar:</td>
                                        <td><input type="text" name="transapotek_buku_besar" id="transapotek_buku_besar"></td>
                                    </tr>
                                    <tr>
                                        <td>Restitusi:</td>
                                        <td><input type="checkbox"  id="transapotek_restitusi" name="transapotek_restitusi"></td>
                                    </tr>
                                    <tr>
                                        <td><input type="submit" value="Simpan" class="button"></td>
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
                                                 <input type="text" name="transapotek_diagnosa" id="transapotek_diagnosa">
                                            </td>
                                            <td>
                                            <input type="submit" value="add" class="button_diag">
                                            </td>                                        
                                            </tr>                                    
                                           </table> 
                                        </td>
                                    </tr>
                                </table>                                
                            </form>
                            <table id="listdiagnosa" class="scroll" cellpadding="0" cellspacing="0"></table>
                            <div id="pagerdiagnosa" class="scroll" style="text-align:center;"></div>
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
                                                    <td><select id="jenis_tagihan" name="jenis_tagihan" style="width: 110px" >
                                                            <option>Jenis Tagihan</option>
                                                        </select>
                                                    </td>
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
                                                    <td>
                                                    <select id="transapotek_racikan" name="transapotek_racikan" >
                                                        <option value="y" selected>Ya</option>
                                                        <option value="t">Tidak</option>
                                                    </select>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td>
                                            <table width="210">
                                                <tr>
                                                    <td>Disetujui:</td>
                                                    <td>
                                                        <select id="transapotek_disetujui" name="transapotek_disetujui">
                                                            <option value="y" selected>Ya</option>
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
                                                    <td><input type="submit" value="Tambah" class="button_trans" /></td>
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
                            <table id="listtransaksi" class="scroll" cellpadding="0" cellspacing="0"></table>
                            <div id="pagertransaksi" class="scroll" style="text-align:center;"></div>
                        </fieldset>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td id="hasil">            
        </td>
    </tr>
</table>
</div>