		<script type="text/javascript">
                    var bulan='';
                    var tahun='';
                    var bukuBesar='';
                    var filter='';
                    var pegawai='';
                    var bb='';
                    var nil=0;

                function setlaporanbukuBesarbukuBesar()
                {
                    //bulan= document.getElementById('laporanbukuBesarbulan');
                    bukuBesar = $('#laporanbukuBesarbukuBesar').val();
                    $('#listlaporanbukuBesar').trigger('reloadGrid');
                }
                
                function setlaporanbukuBesarfilter()
                {
                    filter = $('#laporanbukuBesarfilter').val();
                    $('#listlaporanbukuBesar').trigger('reloadGrid');
                }
                
                function setlaporanbukuBesarpegawai()
                {
                    pegawai = $('#laporanbukuBesarpegawai').val();
                    $('#listlaporanbukuBesar').trigger('reloadGrid');
                }

                function setlaporanbukuBesarbulan()
                {
                    //bulan= document.getElementById('laporanbukuBesarbulan');
                    bulan = $('#laporanbukuBesarbulan').val();
                    $('#listlaporanbukuBesar').trigger('reloadGrid');
                }

                function setlaporanbukuBesartahun()
                {
                     tahun = $('#laporanbukuBesartahun').val();
                $('#listlaporanbukuBesar').trigger('reloadGrid');
                }

                

                

		$(document).ready(function()
			{
				var grid = $("#listlaporanbukuBesar");
				grid.jqGrid({
					url: '<?php echo base_url() ?>index.php/laporan/bukuBesar/json', //URL Tujuan Yg Mengenerate data Json nya
					datatype: "json", //Datatype yg di gunakan
                                        height: "auto", //Mengset Tinggi table jadi Auto menyesuaikan dengan isi table
					mtype: "GET",
                                        postData:{bulan : function()
                                        {
                                         
                                         return bulan;
                                        },tahun : function()
                                        {
                                         
                                         return tahun;
                                        },bukuBesar:function()
                                        {
                                         return bukuBesar;
                                        },filter:function()
                                        {
                                         return filter;
                                        },pegawai:function()
                                        {
                                         return pegawai;
                                        }

                                        },
					colNames: ['buku_besar','No. Buku Besar','Total(Sebelum Koreksi)','Detail'],
					colModel: [
						{name:'buku_besar', key:true, index:'id_transaksi', hidden:true,editable:false,editrules:{required:true}},//name untuk variabel post yang dikirim saat menambah data
						{name:'buku_besar',index:'buku_besar',width:320,editable:true,editrules:{required:true}},//index untuk variabel yang digunakan saat pencarian
						{name:'total',index:'total',width:150,editable:true,editrules:{required:true},summaryType:'sum',align:'right',formatter:'currency',formatoptions: {thousandsSeparator:','}},
						{name:'detail',index:'detail',width:150,editable:true,align:'center',editrules:{required:true}}
					],
					rownumbers:true,
					rowNum: 10,
					rowList: [10,20,30],
					pager: '#pagerlaporanbukuBesar',
					sortname: 'buku_besar',
					viewrecords: true,
					sortorder: "desc",
					editurl: '<?php echo base_url() ?>index.php/laporan/bukuBesar/crud', //URL Proses CRUD Nya
					multiselect: false, 
					caption: "Data laporan bukuBesar" //Caption List					
				});
				grid.jqGrid('navGrid','#pagerlaporanbukuBesar',{view:true,edit:false,add:false,del:false},{},{},{},{closeOnEscape:true,closeAfterSearch:false,multipleSearch:false, multipleGroup:false, showQuery:false,drag:true,showOnLoad:false,sopt:['cn'],resize:false,caption:'Cari Record', Find:'Cari', Reset:'Batalkan Pencarian'});
				jQuery("#listlaporanbukuBesar")
                                .jqGrid('navButtonAdd','#pagerlaporanbukuBesar',{caption:"Print",
                                onClickButton:function()
                                {   var sidx = grid.jqGrid('getGridParam','sortname');
                                    var sord = grid.jqGrid('getGridParam','sortorder');
                                    var page = grid.jqGrid('getGridParam','page');
                                    var row  = grid.jqGrid('getGridParam','rowNum');
                                    
                                    window.location.href="<?php echo base_url() ?>index.php/laporan/bukuBesar/ekspor?bukuBesar="+bukuBesar+"&tahun="+tahun+"&bulan="+bulan+"&filter="+filter+"&pegawai="+pegawai+"&sidx="+sidx+"&page="+page+"&rows="+row+"&sord="+sord;

                                    //alert("BERHASIL ayo SEMANGAT kalahkan skripsi");
				}
				});
                                
            function ceknama()
            {
                if($("#laporanbukuBesarpegawai").val() == '')
                {

                }
            }
            $("#laporanbukuBesarpegawai").autocomplete({
            minLength: 1,
            source:
            function(req, add){
                $.ajax({
                    url: "<?php echo base_url(); ?>index.php/laporan/bukuBesar/lookpegawai",
                    dataType: 'json',
                    type: 'POST',
                    data: req,
                    success:
                        function(data)
                        {
                            if(data.response =="true"){
                                add(data.message);
                            } else if(data.response =="false") {
                                $('.ui-autocomplete-loading').removeClass("ui-autocomplete-loading");
                                //dokter="undefined";
                                //pegawai = $('#laporanbukuBesarpegawai').val();
                    //$('#listlaporanbukuBesar').trigger('reloadGrid');
                            }
                            //setlaporanverifikasidokter();
                        }
                });
            },
            select:
                function(event, ui)
                {
                    //dokter=ui.item.value;
                    pegawai = ui.item.value;
                    $('#listlaporanbukuBesar').trigger('reloadGrid');
                }
        });
           
           
        
        $('a.detail_bb').live('click',function(){
            var buku_besar=$(this).attr("href");
            bb=buku_besar;
            //alert(buku_besar);
            $("#dialog_bukuBesar").dialog({
                title:"Detail Buku Besar : "+bb, 
		resizable:false, 
		width:675, 
		height:250,
		show: 'drop',
		hide: 'scale',
		modal:true,
                open:function(){
                    
                   $("#dialog_bukuBesar").load("<?php echo base_url() ?>index.php/laporan/bukuBesar/detail?bukuBesar="+bb+"&bulan="+bulan+"&tahun="+tahun+"&filter="+filter+"&pegawai="+pegawai);
                },
		close:function(){
                    $(this).dialog('destroy');
                    //$('#detail-diagnosa').jqGrid('navButtonAdd').destroy()
		}
            });

            return false;
        });
        
			});
		</script>
<form>
    <table border="0">
        <tr>
            
            <td>
                <b>Pilih Bulan :</b>
                <select id="laporanbukuBesarbulan" onchange="setlaporanbukuBesarbulan();">
                    <option value="" selected>Pilih Bulan</option>
                    <option value="1">Januari</option>
                    <option value="2">Februari</option>
                    <option value="3">Maret</option>
                    <option value="4">April</option>
                    <option value="5">Mei</option>
                    <option value="6">Juni</option>
                    <option value="7">Juli</option>
                    <option value="8">Agustus</option>
                    <option value="9">September</option>
                    <option value="10">Oktober</option>
                    <option value="11">November</option>
                    <option value="12">Desember</option>
                </select>
            </td>
            <td>
                <b>Tahun :</b>
                <input type="text" id="laporanbukuBesartahun" onchange="setlaporanbukuBesartahun();"/>
            </td>
            <td>
                <b>Filter ID :</b>
                <select id="laporanbukuBesarfilter" onchange="setlaporanbukuBesarfilter();">
                    <option value="" selected>Semua</option>
                    <option value="a">Aktif</option>
                    <option value="p">Pensiunan</option>
                </select>
            </td>
            <td>
                <b>bukuBesar :</b>
                <input type="text" id="laporanbukuBesarbukuBesar" onchange="setlaporanbukuBesarbukuBesar();"/>
            </td>
            <td>
                <b>Nama Pegawai :</b>
                <input type="text" id="laporanbukuBesarpegawai" onchange="setlaporanbukuBesarpegawai();"  />
            </td>
            
        </tr>
    </table>
</form>
<div id="laporanbukuBesar" style="width: auto; height: auto;overflow: auto">
		<table id="listlaporanbukuBesar" class="scroll" cellpadding="0" cellspacing="0"></table>
		<div id="pagerlaporanbukuBesar" class="scroll" style="text-align:center;"></div>
                <div id="laporanbukuBesarimpor"></div>
</div>
<div id="dialog_bukuBesar" class="">
    
</div>                