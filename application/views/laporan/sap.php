		<script type="text/javascript">
                    var bulan='';
                    var tahun='';
                    var sap='';

                function setlaporansapsap()
                {
                    //bulan= document.getElementById('laporansapbulan');
                    sap = $('#laporansapsap').val();
                    $('#listlaporansap').trigger('reloadGrid');
                }
                

                

                function setlaporansapbulan()
                {
                    //bulan= document.getElementById('laporansapbulan');
                    bulan = $('#laporansapbulan').val();
                    $('#listlaporansap').trigger('reloadGrid');
                }

                function setlaporansaptahun()
                {
                     tahun = $('#laporansaptahun').val();
                $('#listlaporansap').trigger('reloadGrid');
                }

                

                

		$(document).ready(function()
			{
				var grid = $("#listlaporansap");
				grid.jqGrid({
					url: '<?php echo base_url() ?>index.php/laporan/sap/json', //URL Tujuan Yg Mengenerate data Json nya
					datatype: "json", //Datatype yg di gunakan
                                        height: "auto", //Mengset Tinggi table jadi Auto menyesuaikan dengan isi table
					mtype: "GET",
                                        postData:{bulan : function()
                                        {
                                         
                                         return bulan;
                                        },tahun : function()
                                        {
                                         
                                         return tahun;
                                        },status:function()
                                        {
                                         return sap;
                                        }

                                        },
					colNames: ['No Buku Besar','Total(Sebelum Koreksi)'],
					colModel: [
						{name:'buku_besar', key:true, index:'buku_besar',editable:false,editrules:{required:true}},//name untuk variabel post yang dikirim saat menambah data
						{name:'jml_koreksi',index:'jml_koreksi',width:320,editable:true,editrules:{required:true}}//index untuk variabel yang digunakan saat pencarian
						],
					rownumbers:true,
					rowNum: 10,
					rowList: [10,20,30],
					pager: '#pagerlaporansap',
					sortname: 'buku_besar',
					viewrecords: true,
					sortorder: "desc",
					//editurl: '<?php echo base_url() ?>index.php/laporan/sap/crud', //URL Proses CRUD Nya
					multiselect: false, 
					caption: "Data laporansap" //Caption List					
				});
				grid.jqGrid('navGrid','#pagerlaporansap',{view:true,edit:false,add:false,del:false},{},{},{},{closeOnEscape:true,closeAfterSearch:false,multipleSearch:false, multipleGroup:false, showQuery:false,drag:true,showOnLoad:false,sopt:['cn'],resize:false,caption:'Cari Record', Find:'Cari', Reset:'Batalkan Pencarian'});
				jQuery("#listlaporansap")
                                .jqGrid('navButtonAdd','#pagerlaporansap',{caption:"Excel",
                                onClickButton:function()
                                {
                                    var id = jQuery("#listlaporansap").jqGrid('getGridParam','selrow');
                                    var no_buku=null;
                                    if (id)
                                    { var ret = jQuery("#listlaporansap").jqGrid('getRowData',id);
                                        //alert("id="+ret.id+" invdate="+ret.invdate+"...");
                                        alert(ret.buku_besar);
                                        no_buku=ret.buku_besar;
                                    }
                                    else { alert("Please select row");}
                                    window.location.href="<?php echo base_url() ?>index.php/laporan/sap/ekspor?buku_besar="+no_buku;

				}
				});
                               
                                

                                
                               
			});
		</script>
<form>
    <table border="0">
        <tr>
            
            <td width="200">
                Pilih Bulan :
                <select id="laporansapbulan" onchange="setlaporansapbulan();">
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
                <input type="text" id="laporansaptahun" onchange="setlaporansaptahun();"/>
            </td>
            <td width="200">
                sap :
                <input type="text" id="laporansapsap" onchange="setlaporansapsap();"/>
            </td>
            
            
        </tr>
    </table>
</form>
<div id="laporansap" style="width: auto; height: auto;overflow: auto">
		<table id="listlaporansap" class="scroll" cellpadding="0" cellspacing="0"></table>
		<div id="pagerlaporansap" class="scroll" style="text-align:center;"></div>
                <div id="laporansapimpor"></div>
</div>