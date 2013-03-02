		<script type="text/javascript">
					var bulanhasillain='';
                    var tahunhasillain='';
                    var tgl1hasillain='';
                    var tgl2hasillain='';
                    var penanggunghasillain='';
					var jns_tanggalhasillain='';

                function sethasillainjns_tanggal()
                {
                   jns_tanggalhasillain= $('#hasillainjenis').val();
                   $('#listhasillain').trigger('reloadGrid');
                }



                function sethasillaintanggal()
                {
                    if($('#hasillaintanggal1').val()=='')
                        {
                            alert('Isi dulu tanggal awalnya');
                        }
                    else
                    {
                    tgl1hasillain=$('#hasillaintanggal1').val();
                    tgl2hasillain=$('#hasillaintanggal2').val();
                    //alert(tgl1);alert(tgl2);
                    $('#listhasillain').trigger('reloadGrid');
                    }

                }

                function sethasillainbulan()
                {
                    //bulan= document.getElementById('hasillainbulan');
                    bulanhasillain = $('#hasillainbulan').val();
                    $('#listhasillain').trigger('reloadGrid');
                }

                function sethasillaintahun()
                {
                     tahunhasillain = $('#hasillaintahun').val();
                $('#listhasillain').trigger('reloadGrid');
                }



                $( "#hasillaintanggal1" ).datepicker({
                //dateFormat  : "dd MM yy",
                changeMonth: true,
                changeYear: true,
                showOn: "button",
                buttonImage : "<?php echo base_url();?>asset/images/calendar.gif",
                buttonImageOnly : true
                });

                $( "#hasillaintanggal2" ).datepicker({
                //dateFormat  : "dd MM yy",
                changeMonth     : true, // menampilkan dropdown untuk ganti bulan
                changeYear      : true, // menampilkan dropdown untuk ganti Tahun
                showOn          : "button",
                buttonImage     : "<?php echo base_url();?>asset/images/calendar.gif",
                buttonImageOnly : true
                });
		$(document).ready(function()
			{       $('#hasillainimpor').dialog({
                                        autoOpen:false,
                                        title:"Import Data Lain",
                                        resizable:false,
                                        width:350,
                                        height:150,
                                        show: 'drop',
                                        hide: 'scale',
                                        modal:true
                                        }
                                        );
                                $('#detailhasillain').dialog({
                                        autoOpen:false,
                                        title:"Detail",
                                        resizable:false,
                                        width:750,
                                        show: 'drop',
                                        hide: 'scale',
                                        modal:true
                                        }
                                        );
				var grid = $("#listhasillain");
				grid.jqGrid({
					url: '<?php echo base_url() ?>index.php/hasil/hasillain/json', //URL Tujuan Yg Mengenerate data Json nya
					datatype: "json", //Datatype yg di gunakan
					height: "auto", //Mengset Tinggi table jadi Auto menyesuaikan dengan isi table
					mtype: "GET",
                                        postData:{
                                        jns_tanggal : function()
                                        {

                                         return jns_tanggalhasillain;
                                        },bulan : function()
                                        {

                                         return bulanhasillain;
                                        },tahun : function()
                                        {

                                         return tahunhasillain;
                                        },tgl1 : function()
                                        {

                                         return tgl1hasillain;
                                        },tgl2 : function()
                                        {

                                         return tgl2hasillain;
                                        }

                                        },
					colNames: ['Id Transaksi','Tl Trans.','Tgl Kunjungan','Surat','No. Bukti','No Buku Besar','Restitusi','NIP','Penanggung','Pasien','Rujukan','Dokter','Provider','Diagnosa'],
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
						{name:'fax_provider',index:'fax_provider',width:150,align:'center',editable:true,editrules:{required:true}},
                        {name:'tlp_provider',index:'tlp_provider',width:150,align:'center',editable:true,editrules:{required:true}}
					],
					rownumbers:true,
					rowNum: 10,
					rowList: [10,20,30],
					pager: '#pagerhasillain',
					sortname: 'id_transaksi',
                                        ondblClickRow: function(id_transaksi)
                                                    {

                                                    alert("You double click row with id: "+id_transaksi);
                                                    $('#detailhasillain').dialog('open');
                                                    $("#detailhasillain").load("<?php echo base_url() ?>index.php/hasil/hasillain/detail/"+id_transaksi);
                                                    
                                                    return false;
                                                    },
					viewrecords: true,
					sortorder: "desc",
					editurl: '<?php echo base_url() ?>index.php/hasil/hasillain/crud', //URL Proses CRUD Nya
					multiselect: false, 
					caption: "Data hasillain" //Caption List					
				});
				grid.jqGrid('navGrid','#pagerhasillain',{view:true,edit:false,add:false,del:true},{},{},{},{closeOnEscape:true,closeAfterSearch:false,multipleSearch:false, multipleGroup:false, showQuery:false,drag:true,showOnLoad:false,sopt:['cn'],resize:false,caption:'Cari Record', Find:'Cari', Reset:'Batalkan Pencarian'});
				jQuery("#listhasillain")
                                .jqGrid('navButtonAdd','#pagerhasillain',{caption:"Excel",buttonicon:"ui-icon-print",
                                onClickButton:function()
                                {   var sidx = grid.jqGrid('getGridParam','sortname');
                                    var sord = grid.jqGrid('getGridParam','sortorder');
                                    var page = grid.jqGrid('getGridParam','page');
                                    var row  = grid.jqGrid('getGridParam','rowNum');
                                   window.location.href="<?php echo base_url() ?>index.php/hasil/hasillain/ekspor?tgl2="+tgl2hasillain+"&tgl1="+tgl1hasillain+"&tahun="+tahunhasillain+"&bulan="+bulanhasillain+"&sidx="+sidx+"&page="+page+"&rows="+row+"&sord="+sord;

                                    //alert("BERHASIL ayo SEMANGAT kalahkan skripsi");
				}
				})
                                .jqGrid('navButtonAdd','#pagerhasillain',{caption:"Impor",buttonicon:"ui-icon-folder-open",
                                onClickButton:function()
                                {
                                var status = <?php echo $this->session->userdata('level')?>;
                                if(status == 7)
                                {
                                $("#hasillainimpor").load("<?php echo base_url() ?>index.php/hasil/hasillain/impor");
                                $('#hasillainimpor').dialog('open');
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
                <select id="hasillainjenis" onchange="sethasillainjns_tanggal();">
                <option>Pilih Jenis</option>
                <option selected value="t">Transaksi</option>
                <option value="k">Kunjungan</option>
                </select>
            </td>
            <td width="300">
                Pilih Bulan :
                <select id="hasillainbulan" onchange="sethasillainbulan();">
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
                <select id="hasillaintahun" onchange="sethasillaintahun();">
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
                <input type="text" id="hasillaintanggal1" name="hasillaintanggal1"/>
            </td>
            <td>
                s/d
                <input type="text" id="hasillaintanggal2" name="hasillaintanggal2" onchange="sethasillaintanggal();"/>
            </td>

        </tr>
    </table>
</form>
<div id="master_hasillain" style="width: auto; height: auto;overflow: auto">
		<table id="listhasillain" class="scroll" cellpadding="0" cellspacing="0"></table>
		<div id="pagerhasillain" class="scroll" style="text-align:center;"></div>
                <div id="hasillainimpor"></div>
                <div id="detailhasillain"></div>
</div>