		<script type="text/javascript">
                    var bulan='';
                    var tahun='';
                    var tgl1='';
                    var tgl2='';
                    var penanggung='';
                    var ap='';
                    var jns='';
                    var dokter='';
                

               

                function setkunjungankesehatanbulan()
                {
                    //bulan= document.getElementById('kunjungankesehatanbulan');
                    bulan = $('#kunjungankesehatanbulan').val();
                    $('#listkunjungankesehatan').trigger('reloadGrid');
                }

                function setkunjungankesehatantahun()
                {
                     alert("Semangat");
                     tahun = $('#kunjungankesehatantahun').val();
                     $('#listkunjungankesehatan').trigger('reloadGrid');
                }
                function setkunjungankesehatanfilter()
                {
                     ap = $('#kunjungankesehatanfilter').val();
                     $('#listkunjungankesehatan').trigger('reloadGrid');
                }
                function setkunjungankesehatanjns()
                {
                     jns = $('#kunjungankesehatanjenis').val();
                     $('#listkunjungankesehatan').trigger('reloadGrid');
                }

                function setkunjungankesehatanjnsdokter()
                {
                     dokter = $('#kunjungankesehatanjnsdokter').val();
                     $('#listkunjungankesehatan').trigger('reloadGrid');
                }
                

                

		$(document).ready(function()
			{
				var grid = $("#listkunjungankesehatan");
				grid.jqGrid({
					url: '<?php echo base_url() ?>index.php/laporan/kunjungankesehatan/json', //URL Tujuan Yg Mengenerate data Json nya
					datatype: "json", //Datatype yg di gunakan
                                        height: "auto", //Mengset Tinggi table jadi Auto menyesuaikan dengan isi table
					mtype: "GET",
                                        postData:{bulan : function()
                                        {
                                         
                                         return bulan;
                                        },tahun : function()
                                        {

                                         return tahun;
                                        },ap : function()
                                        {

                                         return ap;
                                        },jns : function()
                                        {

                                         return jns;
                                        },dokter : function()
                                        {

                                         return dokter;
                                        }

                                        },
					colNames: ['Id Transaksi','Tgl Kunjungan','NIP','Penanggung','A/P','Pasien','Status','Dokter','Diagnosa'],
					colModel: [
						{name:'id_provider', key:true, index:'id_transaksi', hidden:true,editable:false,editrules:{required:true}},//name untuk variabel post yang dikirim saat menambah data
						{name:'nama_provider',index:'tgl_kunjungan',width:120,editable:true,editrules:{required:true}},//index untuk variabel yang digunakan saat pencarian
						{name:'almt_provider',index:'nip',width:150,editable:true,editrules:{required:true}},
						{name:'langg_provider',index:'nama_karyawan', width:90, editable: true,edittype:"checkbox",editoptions: {value:"y:n"}},
						{name:'fax_provider',index:'ap',width:150,align:'center',editable:true,editrules:{required:true}},
                                                {name:'tlp_provider',index:'nama_tertanggung',width:150,align:'center',editable:true,editrules:{required:true}},
                                                {name:'tlp_provider',index:'status',width:150,align:'center',editable:true,editrules:{required:true}},
                                                {name:'tlp_provider',index:'nama_dokter',width:150,align:'center',editable:true,editrules:{required:true}},
                                                {name:'tlp_provider',index:'nama_diagnosa',width:150,align:'center',editable:true,editrules:{required:true}}
					],
					rownumbers:true,
					rowNum: 10,
					rowList: [10,20,30],
					pager: '#pagerkunjungankesehatan',
					sortname: 'id_transaksi',
					viewrecords: true,
					sortorder: "desc",
					editurl: '<?php echo base_url() ?>index.php/laporan/kunjungankesehatan/crud', //URL Proses CRUD Nya
					multiselect: false, 
					caption: "Data kunjungankesehatan" //Caption List					
				});
				grid.jqGrid('navGrid','#pagerkunjungankesehatan',{view:true,edit:false,add:false,del:true},{},{},{},{closeOnEscape:true,closeAfterSearch:false,multipleSearch:false, multipleGroup:false, showQuery:false,drag:true,showOnLoad:false,sopt:['cn'],resize:false,caption:'Cari Record', Find:'Cari', Reset:'Batalkan Pencarian'});
				jQuery("#listkunjungankesehatan")
                                .jqGrid('navButtonAdd','#pagerkunjungankesehatan',{caption:"Print",
                                onClickButton:function()
                                {   var sidx = grid.jqGrid('getGridParam','sortname');
                                    var sord = grid.jqGrid('getGridParam','sortorder');
                                    var page = grid.jqGrid('getGridParam','page');
                                    var row  = grid.jqGrid('getGridParam','rowNum');
                                    window.location.href="<?php echo base_url() ?>index.php/laporan/kunjungankesehatan/ekspor?jns="+jns+"&ap="+ap+"&penanggung="+penanggung+"&tgl2="+tgl2+"&tgl1="+tgl1+"&tahun="+tahun+"&bulan="+bulan+"&sidx="+sidx+"&page="+page+"&rows="+row+"&sord="+sord;

				//alert("BERHASIL ayo SEMANGAT kalahkan skripsi");
				}
				})
                                .jqGrid('navButtonAdd','#pagerkunjungankesehatan',{caption:"Impor",
                                onClickButton:function()
                                {
                                //alert('impor');
				$("#kunjungankesehatanimpor").load("<?php echo base_url() ?>index.php/laporan/kunjungankesehatan/impor");
				return false;
                                }
				});
                                

                                
                               
			});
		</script>
<form>
    <table border="0">
        <tr>
            <td>
             Jenis Kunjungan :
             <select id="kunjungankesehatanjenis" onchange="setkunjungankesehatanjns();">
                 <option value=""> - </option>
                 <option value="2">Dokter</option>
                 <option value="1">Rmh Sakit</option>
             </select>
            </td>
            <td>
            Jenis Dokter
            <select id="kunjungankesehatanjnsdokter" onchange="setkunjungankesehatanjnsdokter();">
                <option value ="">Semua </option>
                <option value ="r">Restitusi </option>
                <option value ="l">Langganan </option>
                <option value ="s">Spesialis </option>
            </select>
            </td>
            <td width="300">
                Pilih Bulan :
                <select id="kunjungankesehatanbulan" onchange="setkunjungankesehatanbulan();">
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
                <select id="kunjungandaktahun" onchange="setkunjungandaktahun();">
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
            
            <td width="200">
                Karyawan :
                <select id="kunjungankesehatanfilter" onchange="setkunjungankesehatanfilter();" >
                    <option value="">Semua</option>
                    <option value="a">Karyawan</option>
                    <option value="p">Pensiunan</option>
                </select>
            </td>
           
            
        </tr>
    </table>
</form>
<div id="kunjungankesehatan" style="width: auto; height: auto;overflow: auto">
		<table id="listkunjungankesehatan" class="scroll" cellpadding="0" cellspacing="0"></table>
		<div id="pagerkunjungankesehatan" class="scroll" style="text-align:center;"></div>
                <div id="kunjungankesehatanimpor"></div>
</div>