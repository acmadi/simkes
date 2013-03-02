<script type="text/javascript">
    var namaTb='lebihhet',
        jenis='',
        bulan='',
        tahun='',
        tgl1='',
        tgl2='',
        karyawan='',
        dokter='';
        //lebihHet='';

    function setlebihHetBerdasarkan()
    {
        jenis = $('#lebihHet_berdasarkan').val();
        $('#listlaporanlebihHet').trigger('reloadGrid');
    }
                
    function setlaporanlebihHetbulan()
    {
        //bulan= document.getElementById('laporanlebihHetbulan');
        bulan = $('#laporanlebihHetbulan').val();
        $('#listlaporanlebihHet').trigger('reloadGrid');
    }

    function setlaporanlebihHettahun()
    {
        tahun = $('#laporanlebihHettahun').val();
        $('#listlaporanlebihHet').trigger('reloadGrid');
    }
    
    function setlaporanlebihHettgl1()
    {
        tgl1 = $('#laporanlebihHettgl1').val();
        $('#listlaporanlebihHet').trigger('reloadGrid');
    }
    
    function setlaporanlebihHettgl2()
    {
        tgl2 = $('#laporanlebihHettgl2').val();
        $('#listlaporanlebihHet').trigger('reloadGrid');
    }
    
    function setlaporanlebihHetkaryawan()
    {
        karyawan = $('#laporanlebihHetkaryawan').val();
        $('#listlaporanlebihHet').trigger('reloadGrid');
    }
                
    $(document).ready(function()
    {
        $( "#laporanlebihHettgl1" ).datepicker({
            //dateFormat  : "dd MM yy",
            changeMonth: true,
            changeYear: true,
            showOn: "button",
            buttonImage : "<?php echo base_url();?>asset/images/calendar.gif",				
            buttonImageOnly : true
        });
        
        $( "#laporanlebihHettgl2" ).datepicker({
            //dateFormat  : "dd MM yy",
            changeMonth: true,
            changeYear: true,
            showOn: "button",
            buttonImage : "<?php echo base_url();?>asset/images/calendar.gif",				
            buttonImageOnly : true
        });
        
        $("#laporanlebihHetdokter").autocomplete({
            minLength: 1,
            source:
            function(req, add){
                $.ajax({
                    url: "<?php echo base_url(); ?>index.php/laporan/lebihHet/lookdokter",
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
                            //setlaporanlebihHetdokter();
                        }          
                });
            },
            select:
                function(event, ui) {
                    //dokter=ui.item.value; 
                    dokter = ui.item.value;
                    $('#listlaporanlebihHet').trigger('reloadGrid');
                }
        });
        
        var grid = $("#listlaporanlebihHet");
	grid.jqGrid({
            url: '<?php echo base_url() ?>index.php/laporan/lebihHet/json', //URL Tujuan Yg Mengenerate data Json nya
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
            colNames: ['Id Trans','Tgl Trans','Tgl Kunj','NIP','Penanggung','A/P','Pasien','Status','Provider','Rawat','Item Transaksi','Jumlah','HET','Harga Satuan','Selisih'],
            colModel: [
                        //{name:'id_transaksi', key:true, index:'id_transaksi', hidden:true,editable:false,editrules:{required:true}},//name untuk variabel post yang dikirim saat menambah data
                        {name:'id_transaksi', index:'id_transaksi',width:70,editable:true,editrules:{required:true},summaryType:'count', summaryTpl : '({0}) Total'},
			{name:'tgl_transaksi',index:'tgl_transaksi',width:100,editable:true,editrules:{required:true}},//index untuk variabel yang digunakan saat pencarian
			{name:'tgl_kunjungan',index:'tgl_kunjungan',width:100,editable:true,editrules:{required:true}},
			{name:'nip',index:'nip',width:70,editable:true,editrules:{required:true}},
			{name:'nama_karyawan',index:'nama_karyawan',width:150,align:'center',editable:true,editrules:{required:true}},
                        {name:'A/P',index:'A/P',width:30,align:'center',editable:true,editrules:{required:true}},
                        {name:'nama_tertanggung',index:'nama_tertanggung',width:150,editable:true,editrules:{required:true}},
                        {name:'status',index:'status',width:50,editable:true,editrules:{required:true}},
                        {name:'nama_provider',index:'nama_provider',width:150,editable:true,editrules:{required:true}},
                        {name:'rawat',index:'rawat',width:70,editable:true,editrules:{required:true}},
                        {name:'nama_item',index:'nama_item',width:70,editable:true,editrules:{required:true}},
                        {name:'jumlah',index:'jumlah',width:70,editable:true,editrules:{required:true}},
                        {name:'het',index:'het',width:70,editable:true,editrules:{required:true},align:'right',formatter:'currency',formatoptions: {thousandsSeparator:','}},
                        {name:'hrg_satuan',index:'hrg_satuan',width:70,editable:true,editrules:{required:true},align:'right',formatter:'currency',formatoptions: {thousandsSeparator:','}},
                        {name:'selisih',index:'selisih',width:70,editable:true,editrules:{required:true},summaryType:'sum',align:'right',formatter:'currency',formatoptions: {thousandsSeparator:','}}
            ],
            rownumbers:true,
            rowNum: 10,
            rowList: [10,20,30],
            pager: '#pagerlaporanlebihHet',
            //sortname: 'id_transaksi',
            viewrecords: true,
            sortorder: "desc",
            editurl: '<?php echo base_url() ?>index.php/laporan/lebihHet/crud', //URL Proses CRUD Nya
            multiselect: false, 
            sortname: 'nama_provider', 
            grouping:true, 
            groupingView : { 
                groupField : ['nama_provider'], 
                groupSummary : [true], 
                groupColumnShow : [true],
                groupText : ['<b>Provider: {0} - {1} Item</b>'], 
                groupCollapse : false,
                groupOrder: ['asc'] },
            caption: "Data Laporan Het" //Caption List					
        });
	grid.jqGrid('navGrid','#pagerlaporanlebihHet',{view:true,edit:false,add:false,del:false},{},{},{},{closeOnEscape:true,closeAfterSearch:false,multipleSearch:false, multipleGroup:false, showQuery:false,drag:true,showOnLoad:false,sopt:['cn'],resize:false,caption:'Cari Record', Find:'Cari', Reset:'Batalkan Pencarian'});
	jQuery("#listlaporanlebihHet").jqGrid('navButtonAdd','#pagerlaporanlebihHet',{caption:"Print",
            onClickButton:function()
            {
                var isi="?namaTb="+namaTb+"&jenis="+jenis+"&bulan="+bulan+"&tahun="+tahun+"&tgl1="+tgl1+"&tgl2="+tgl2+"&karyawan="+karyawan+"&dokter="+dokter
                window.location.href="<?php echo base_url() ?>index.php/laporan/lebihHet/ekspor"+isi;
		//alert("BERHASIL ayo SEMANGAT kalahkan skripsi");
                return false;
            }
	});                                                                                               
    });
</script>
<div id="master_laporanlebihHet" style="width: auto; height: auto;overflow: auto">
<form>
    <table border="0" width="950">
        <tr>
            <td>
                <b>Tampilkan Berdasarkan :</b> 
                <select id="lebihHet_berdasarkan" onchange="setlebihHetBerdasarkan();">
                    <option value="" selected></option>
                    <option value="transaksi">Transaksi</option>
                    <option value="kunjungan">Kunjungan</option>
                </select>
            </td>
            <td>
                <b>Bulan :</b>
                <select id="laporanlebihHetbulan" onchange="setlaporanlebihHetbulan();">
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
                <input type="text" id="laporanlebihHettahun" size="5" onchange="setlaporanlebihHettahun();"/ >
            </td>
            <td>
                <b>dari Tanggal :</b>
                <input type="text" id="laporanlebihHettgl1" size="7" onchange="setlaporanlebihHettgl1();"/>
            </td>
            <td>
                <b>s/d :</b>
                <input type="text" id="laporanlebihHettgl2" size="7" onchange="setlaporanlebihHettgl2();"/>
            </td>
            <td>
                <b>Karyawan :</b>
                <select id="laporanlebihHetkaryawan" onchange="setlaporanlebihHetkaryawan();">
                    <option value="" selected>Semua</option>
                    <option value="a">Karyawan</option>
                    <option value="p">Pensiunan</option>
                </select>
            </td>
            <td>
                <b>Dokter :</b>
                <input type="text" id="laporanlebihHetdokter" size="10"/>
            </td>
        </tr>
    </table>
</form>
		<table id="listlaporanlebihHet" class="scroll" cellpadding="0" cellspacing="0"></table>
		<div id="pagerlaporanlebihHet" class="scroll" style="text-align:center;"></div>
                <div id="laporanlebihHetimpor"></div>
</div>