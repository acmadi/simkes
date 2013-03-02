<script type="text/javascript">
    var namaTb='obatkeluarga',
        jenis='',
        bulan='',
        tahun='',
        tgl1='',
        tgl2='',
        karyawan='',
        dokter='';

    function setobatKeluargaBerdasarkan()
    {
        jenis = $('#obatKeluarga_berdasarkan').val();
        $('#listlaporanobatKeluarga').trigger('reloadGrid');
    }
                
    function setlaporanobatKeluargabulan()
    {
        //bulan= document.getElementById('laporanobatKeluargabulan');
        bulan = $('#laporanobatKeluargabulan').val();
        $('#listlaporanobatKeluarga').trigger('reloadGrid');
    }

    function setlaporanobatKeluargatahun()
    {
        tahun = $('#laporanobatKeluargatahun').val();
        $('#listlaporanobatKeluarga').trigger('reloadGrid');
    }
    
    function setlaporanobatKeluargatgl1()
    {
        tgl1 = $('#laporanobatKeluargatgl1').val();
        $('#listlaporanobatKeluarga').trigger('reloadGrid');
    }
    
    function setlaporanobatKeluargatgl2()
    {
        tgl2 = $('#laporanobatKeluargatgl2').val();
        $('#listlaporanobatKeluarga').trigger('reloadGrid');
    }
    
    function setlaporanobatKeluargakaryawan()
    {
        karyawan = $('#laporanobatKeluargakaryawan').val();
        $('#listlaporanobatKeluarga').trigger('reloadGrid');
    }
                
    $(document).ready(function()
    {
        $( "#laporanobatKeluargatgl1" ).datepicker({
            //dateFormat  : "dd MM yy",
            changeMonth: true,
            changeYear: true,
            showOn: "button",
            buttonImage : "<?php echo base_url();?>asset/images/calendar.gif",				
            buttonImageOnly : true
        });
        
        $( "#laporanobatKeluargatgl2" ).datepicker({
            //dateFormat  : "dd MM yy",
            changeMonth: true,
            changeYear: true,
            showOn: "button",
            buttonImage : "<?php echo base_url();?>asset/images/calendar.gif",				
            buttonImageOnly : true
        });
        
        $("#laporanobatKeluargadokter").autocomplete({
            minLength: 1,
            source:
            function(req, add){
                $.ajax({
                    url: "<?php echo base_url(); ?>index.php/laporan/obatKeluarga/lookdokter",
                    dataType: 'json',
                    type: 'POST',
                    data: req,
                    success:
                        function(data){
                            if(data.response =="true"){
                                add(data.message);
                            } else if(data.response =="false") {
                                $('.ui-autocomplete-loading').removeClass("ui-autocomplete-loading");
                                //dokter="undefined";
                            }	
                            //setlaporanobatKeluargadokter();
                        }          
                });
            },
            select:
                function(event, ui) {
                    //dokter=ui.item.value; 
                    dokter = ui.item.value;
                    $('#listlaporanobatKeluarga').trigger('reloadGrid');
                }
        });
        
        var grid = $("#listlaporanobatKeluarga");
	grid.jqGrid({
            url: '<?php echo base_url() ?>index.php/laporan/obatKeluarga/json', //URL Tujuan Yg Mengenerate data Json nya
            datatype: "json", //Datatype yg di gunakan
            height: "auto", //Mengset Tinggi table jadi Auto menyesuaikan dengan isi table
            mtype: "GET",
            postData:{
                namaTb : namaTb,
                jenis : function()
                {
                    return jenis;
                },
                bulan : function()
                {
                    return bulan;
                },
                tahun : function()
                {
                    return tahun;
                },
                tgl1 : function()
                {
                    return tgl1;
                },
                tgl2 : function()
                {
                    return tgl2;
                },
                karyawan : function()
                {
                    return karyawan;
                },
                dokter : function()
                {
                    return dokter;
                }
            },
            colNames: ['Id Trans','Tgl Trans','Tgl Kunj','NIP','Penanggung','A/P','Pasien','Status','Dokter','Biaya','Detail'],
            colModel: [
                        //{name:'id_transaksi', key:true, index:'id_transaksi', hidden:true,editable:false,editrules:{required:true}},//name untuk variabel post yang dikirim saat menambah data
                        {name:'id_transaksi', index:'id_transaksi',width:50,editable:true,editrules:{required:true}},
			{name:'tgl_transaksi',index:'tgl_transaksi',width:100,editable:true,editrules:{required:true}},//index untuk variabel yang digunakan saat pencarian
			{name:'tgl_kunjungan',index:'tgl_kunjungan',width:100,editable:true,editrules:{required:true}},
			{name:'nip',index:'nip',width:70,editable:true,editrules:{required:true}},
			{name:'nama_karyawan',index:'nama_karyawan',width:150,align:'center',editable:true,editrules:{required:true}},
                        {name:'A/P',index:'A/P',width:30,align:'center',editable:true,editrules:{required:true}},
                        {name:'nama_tertanggung',index:'nama_tertanggung',width:150,editable:true,editrules:{required:true}},
                        {name:'status',index:'status',width:50,editable:true,editrules:{required:true}},
                        {name:'nama_dokter',index:'nama_dokter',width:150,editable:true,editrules:{required:true}},
                        //{name:'kategori',index:'kategori',width:70,editable:true,editrules:{required:true}},
                        {name:'biaya',index:'biaya',width:70,editable:true,editrules:{required:true},align:'right',formatter:'currency',formatoptions: {thousandsSeparator:','}},
                        //{name:'selisih',index:'selisih',width:70,editable:true,editrules:{required:true}},
                        {name:'detail',index:'detail',width:50,editable:true,editrules:{required:true}}
            ],
            rownumbers:true,
            rowNum: 10,
            rowList: [10,20,30],
            pager: '#pagerlaporanobatKeluarga',
            //sortname: 'id_transaksi',
            viewrecords: true,
            sortorder: "desc",
            editurl: '<?php echo base_url() ?>index.php/laporan/obatKeluarga/crud', //URL Proses CRUD Nya
            multiselect: false, 
            sortname: 'nama_dokter', 
            grouping:true, 
            groupingView : { 
                groupField : ['nama_karyawan'], 
                //groupSummary : [true], 
                groupColumnShow : [true],
                groupText : ['<b>Penanggung: {0} - {1} Item</b>'], 
                groupCollapse : false,
                groupOrder: ['asc'] },
            caption: "Data Laporan Berobat Keluarga" //Caption List					
        });
	grid.jqGrid('navGrid','#pagerlaporanobatKeluarga',{view:true,edit:false,add:false,del:true},{},{},{},{closeOnEscape:true,closeAfterSearch:false,multipleSearch:false, multipleGroup:false, showQuery:false,drag:true,showOnLoad:false,sopt:['cn'],resize:false,caption:'Cari Record', Find:'Cari', Reset:'Batalkan Pencarian'});
	jQuery("#listlaporanobatKeluarga").jqGrid('navButtonAdd','#pagerlaporanobatKeluarga',{caption:"Print",
            onClickButton:function()
            {
                var isi="?namaTb="+namaTb+"&jenis="+jenis+"&bulan="+bulan+"&tahun="+tahun+"&tgl1="+tgl1+"&tgl2="+tgl2+"&karyawan="+karyawan+"&dokter="+dokter
                window.location.href="<?php echo base_url() ?>index.php/laporan/obatKeluarga/ekspor"+isi;
		//alert("BERHASIL ayo SEMANGAT kalahkan skripsi");
                return false;
            }
	});
        
        $('a.detail_obat').live('click',function(){
            var id_trans=$(this).attr("href");
            $("#dialog_detailObat").dialog({
                title:"Detail Laporan Temuan : "+id_trans, 
		resizable:false, 
		width:675, 
		height:250,
		show: 'drop',
		hide: 'scale',
		modal:true,
                open:function(){
                    $("#dialog_detailObat").load("<?php echo base_url() ?>index.php/laporan/detailTemuan/detail?idTrans="+id_trans+"&jenis=obatkeluarga");
                },
		close:function(){
                    $(this).dialog('destroy');
		}
            });

            return false;
        });
    });
</script>
<div id="master_laporanobatKeluarga" style="width: auto; height: auto;overflow: auto">
<form>
    <table border="0" width="950">
        <tr>
            <td>
                <b>Tampilkan Berdasarkan :</b> 
                <select id="obatKeluarga_berdasarkan" onchange="setobatKeluargaBerdasarkan();">
                    <option value="" selected></option>
                    <option value="transaksi">Transaksi</option>
                    <option value="kunjungan">Kunjungan</option>
                </select>
            </td>
            <td>
                <b>Bulan :</b>
                <select id="laporanobatKeluargabulan" onchange="setlaporanobatKeluargabulan();">
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
                <input type="text" id="laporanobatKeluargatahun" size="5" onchange="setlaporanobatKeluargatahun();"/ >
            </td>
            <td>
                <b>dari Tanggal :</b>
                <input type="text" id="laporanobatKeluargatgl1" size="7" onchange="setlaporanobatKeluargatgl1();"/>
            </td>
            <td>
                <b>s/d :</b>
                <input type="text" id="laporanobatKeluargatgl2" size="7" onchange="setlaporanobatKeluargatgl2();"/>
            </td>
            <td>
                <b>Karyawan :</b>
                <select id="laporanobatKeluargakaryawan" onchange="setlaporanobatKeluargakaryawan();">
                    <option value="" selected>Semua</option>
                    <option value="a">Karyawan</option>
                    <option value="p">Pensiunan</option>
                </select>
            </td>
            <td>
                <b>Dokter :</b>
                <input type="text" id="laporanobatKeluargadokter" size="10"/>
            </td>
        </tr>
    </table>
</form>
		<table id="listlaporanobatKeluarga" class="scroll" cellpadding="0" cellspacing="0"></table>
		<div id="pagerlaporanobatKeluarga" class="scroll" style="text-align:center;"></div>
                <div id="laporanobatKeluargaimpor"></div>
</div>
<div id="dialog_detailObat" class="">
    
</div> 