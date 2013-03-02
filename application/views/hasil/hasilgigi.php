		<script type="text/javascript">
					var bulanhasilgigi='';
                    var tahunhasilgigi='';
                    var tgl1hasilgigi='';
                    var tgl2hasilgigi='';
                    var penanggunghasilgigi='';
					var jns_tanggalhasilgigi='';

                function sethasilgigijns_tanggal()
                {
                   jns_tanggalhasilgigi= $('#hasilgigijenis').val();
                   $('#listhasilgigi').trigger('reloadGrid');
                }

                

                function sethasilgigitanggal()
                {
                    if($('#hasilgigitanggal1').val()=='')
                        {
                            alert('Isi dulu tanggal awalnya');
                        }
                    else
                    {
                    tgl1hasilgigi=$('#hasilgigitanggal1').val();
                    tgl2hasilgigi=$('#hasilgigitanggal2').val();
                    //alert(tgl1);alert(tgl2);
                    $('#listhasilgigi').trigger('reloadGrid');
                    }
                    
                }

                function sethasilgigibulan()
                {
                    //bulan= document.getElementById('hasilgigibulan');
                    bulanhasilgigi = $('#hasilgigibulan').val();
                    $('#listhasilgigi').trigger('reloadGrid');
                }

                function sethasilgigitahun()
                {
                     tahunhasilgigi = $('#hasilgigitahun').val();
                $('#listhasilgigi').trigger('reloadGrid');
                }

                

                $( "#hasilgigitanggal1" ).datepicker({
                //dateFormat  : "dd MM yy",
                changeMonth: true,
                changeYear: true,
                showOn: "button",
                buttonImage : "<?php echo base_url();?>asset/images/calendar.gif",
                buttonImageOnly : true
                });

                $( "#hasilgigitanggal2" ).datepicker({
                //dateFormat  : "dd MM yy",
                changeMonth     : true, // menampilkan dropdown untuk ganti bulan
                changeYear      : true, // menampilkan dropdown untuk ganti Tahun
                showOn          : "button",
                buttonImage     : "<?php echo base_url();?>asset/images/calendar.gif",
                buttonImageOnly : true
                });
                $(document).ready(function()
			{       $('#hasilgigiimpor').dialog({
                                        autoOpen:false,
                                        title:"Import Data Transaksi Gigi",
                                        resizable:false,
                                        width:350,
                                        height:150,
                                        show: 'drop',
                                        hide: 'scale',
                                        modal:true
                                        }
                                        );
                                $('#detailhasilgigi').dialog({
                                        autoOpen:false,
                                        title:"Detail",
                                        resizable:false,
                                        width:750,
                                        show: 'drop',
                                        hide: 'scale',
                                        modal:true
                                        }
                                        );


				var grid = $("#listhasilgigi");
				grid.jqGrid({
					url: '<?php echo base_url() ?>index.php/hasil/hasilgigi/json', //URL Tujuan Yg Mengenerate data Json nya
					datatype: "json", //Datatype yg di gunakan
					height: "auto", //Mengset Tinggi table jadi Auto menyesuaikan dengan isi table
					mtype: "GET",
                                        postData:{
                                        jns_tanggal : function()
                                        {

                                         return jns_tanggalhasilgigi;
                                        },bulan : function()
                                        {

                                         return bulanhasilgigi;
                                        },tahun : function()
                                        {

                                         return tahunhasilgigi;
                                        },tgl1 : function()
                                        {

                                         return tgl1hasilgigi;
                                        },tgl2 : function()
                                        {

                                         return tgl2hasilgigi;
                                        }

                                        },
					colNames: ['Id Transaksi','Tl Trans.','Tgl Kunjungan','Surat','No. Bukti','No Buku Besar','Restitusi','NIP','Penanggung','Pasien','Dokter','Provider','Diagnosa'],
					colModel: [
						{name:'id_transaksi', key:true, index:'id_transaksi', hidden:true,editable:false,editrules:{required:true}},//name untuk variabel post yang dikirim saat menambah data
						{name:'nama_provider',index:'nama_provider',width:120,editable:true,editrules:{required:true}},//index untuk variabel yang digunakan saat pencarian
						{name:'almt_provider',index:'almt_provider',width:150,editable:true,editrules:{required:true}},
						{name:'langg_provider',index:'langg_provider', width:90, editable: true,edittype:"checkbox",editoptions: {value:"y:n"}},
						{name:'email_provider',index:'email_provider',width:150,align:'center',editable:true,editrules:{required:true}},
						{name:'fax_provider',index:'fax_provider',width:150,align:'center',editable:true,editrules:{required:true}},
						{name:'fax_provider',index:'fax_provider',width:150,align:'center',editable:true,editrules:{required:true}},
						{name:'fax_provider',index:'fax_provider',width:150,align:'center',editable:true,editrules:{required:true}},
						{name:'fax_provider',index:'fax_provider',width:150,align:'center',editable:true,editrules:{required:true}},
						{name:'fax_provider',index:'fax_provider',width:150,align:'center',editable:true,editrules:{required:true}},
						{name:'fax_provider',index:'fax_provider',width:150,align:'center',editable:true,editrules:{required:true}},
						{name:'fax_provider',index:'fax_provider',width:150,align:'center',editable:true,editrules:{required:true}},
                        {name:'tlp_provider',index:'tlp_provider',width:150,align:'center',editable:true,editrules:{required:true}}
					],
					rownumbers:true,
					rowNum: 10,
					rowList: [10,20,30],
					pager: '#pagerhasilgigi',
					sortname: 'id_transaksi',
					viewrecords: true,
                                        ondblClickRow: function(id_transaksi)
                                                    {

                                                    alert("You double click row with id: "+id_transaksi);
                                                    $('#detailhasilgigi').dialog('open');
                                                    $("#detailhasilgigi").load("<?php echo base_url() ?>index.php/hasil/hasilgigi/detail/"+id_transaksi);
                                                   
                                                    return false;
                                                    },
					sortorder: "desc",
					editurl: '<?php echo base_url() ?>index.php/hasil/hasilgigi/crud', //URL Proses CRUD Nya
					multiselect: false, 
					caption: "Data hasilgigi" //Caption List					
				});
				grid.jqGrid('navGrid','#pagerhasilgigi',{view:true,edit:false,add:false,del:true},{},{},{},{closeOnEscape:true,closeAfterSearch:false,multipleSearch:false, multipleGroup:false, showQuery:false,drag:true,showOnLoad:false,sopt:['cn'],resize:false,caption:'Cari Record', Find:'Cari', Reset:'Batalkan Pencarian'});
				jQuery("#listhasilgigi")
                                .jqGrid('navButtonAdd','#pagerhasilgigi',{caption:"Excel",buttonicon:"ui-icon-print",
                                onClickButton:function()
                                {
                                    var sidx = grid.jqGrid('getGridParam','sortname');
                                    var sord = grid.jqGrid('getGridParam','sortorder');
                                    var page = grid.jqGrid('getGridParam','page');
                                    var row  = grid.jqGrid('getGridParam','rowNum');
                                   window.location.href="<?php echo base_url() ?>index.php/hasil/hasilgigi/ekspor?tgl2="+tgl2hasilgigi+"&tgl1="+tgl1hasilgigi+"&tahun="+tahunhasilgigi+"&bulan="+bulanhasilgigi+"&sidx="+sidx+"&page="+page+"&rows="+row+"&sord="+sord;
				//alert("BERHASIL ayo SEMANGAT kalahkan skripsi");
				}
				})
                                .jqGrid('navButtonAdd','#pagerhasilgigi',{caption:"Impor",buttonicon:"ui-icon-folder-open",
                                onClickButton:function()
                                {
                                var status = <?php echo $this->session->userdata('level')?>;
                                if(status == 7)
                                {
                                $("#hasilgigiimpor").load("<?php echo base_url() ?>index.php/hasil/hasilgigi/impor");
                                $('#hasilgigiimpor').dialog('open');
				}
                                else
                                {
                                alert("Tidak Bisa Impor Karena Anda Administrator");
                                }
				return false;
                                }
				});
                                

                                
                               
			});
		</script>
<form>
    <table border="0">
        <tr>
            <td width="300">Tampilkan Berdasarkan :
                <select id="hasilgigijenis" onchange="sethasilgigijns_tanggal();">
                <option>Pilih Jenis</option>
                <option selected value="t">Transaksi</option>
                <option value="k">Kunjungan</option>
                </select>
            </td>
            <td width="300">
                Pilih Bulan :
                <select id="hasilgigibulan" onchange="sethasilgigibulan();">
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
            <td width="200">
                Tahun :
                <select id="hasilgigitahun" onchange="sethasilgigitahun();">
                    <option value=''> - </option>
                    <?php
                    $tahun=date('Y');
                    for($i=2011;$i<=$tahun;$i++)
                    {?>
		     <option value="<?php echo $i;?>">
                     <?php	echo $i; ?></option>

		    <?php
		     }
                    ?>
                </select>
            </td>
            <td width="250">
                atau dari Tanggal :
                <input type="text" id="hasilgigitanggal1" name="hasilgigitanggal1"/>
            </td>
            <td>
                s/d
                <input type="text" id="hasilgigitanggal2" name="hasilgigitanggal2" onchange="sethasilgigitanggal();"/>
            </td>

        </tr>
    </table>
</form>
<div id="master_hasilgigi" style="width: auto; height: auto;overflow: auto">
		<table id="listhasilgigi" class="scroll" cellpadding="0" cellspacing="0"></table>
		<div id="pagerhasilgigi" class="scroll" style="text-align:center;"></div>
                <div id="hasilgigiimpor"></div>
                <div id="detailhasilgigi"></div>
</div>