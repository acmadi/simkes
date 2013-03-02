<script type="text/javascript">
    var namaTb='obatberlebih',
        jenis='',
        bulan='',
        tahun='',
        tgl1='',
        tgl2='',
        karyawan='',
        dokter='';
        //obatBerlebih='';

    function setobatBerlebihBerdasarkan()
    {
        jenis = $('#obatBerlebih_berdasarkan').val();
        $('#listlaporanobatBerlebih').trigger('reloadGrid');
    }
                
    function setlaporanobatBerlebihbulan()
    {
        //bulan= document.getElementById('laporanobatBerlebihbulan');
        bulan = $('#laporanobatBerlebihbulan').val();
        $('#listlaporanobatBerlebih').trigger('reloadGrid');
    }

    function setlaporanobatBerlebihtahun()
    {
        tahun = $('#laporanobatBerlebihtahun').val();
        $('#listlaporanobatBerlebih').trigger('reloadGrid');
    }
    
    function setlaporanobatBerlebihtgl1()
    {
        tgl1 = $('#laporanobatBerlebihtgl1').val();
        $('#listlaporanobatBerlebih').trigger('reloadGrid');
    }
    
    function setlaporanobatBerlebihtgl2()
    {
        tgl2 = $('#laporanobatBerlebihtgl2').val();
        $('#listlaporanobatBerlebih').trigger('reloadGrid');
    }
    
    function setlaporanobatBerlebihkaryawan()
    {
        karyawan = $('#laporanobatBerlebihkaryawan').val();
        $('#listlaporanobatBerlebih').trigger('reloadGrid');
    }
                
    $(document).ready(function()
    {
        $( "#laporanobatBerlebihtgl1" ).datepicker({
            //dateFormat  : "dd MM yy",
            changeMonth: true,
            changeYear: true,
            showOn: "button",
            buttonImage : "<?php echo base_url();?>asset/images/calendar.gif",				
            buttonImageOnly : true
        });
        
        $( "#laporanobatBerlebihtgl2" ).datepicker({
            //dateFormat  : "dd MM yy",
            changeMonth: true,
            changeYear: true,
            showOn: "button",
            buttonImage : "<?php echo base_url();?>asset/images/calendar.gif",				
            buttonImageOnly : true
        });
        
        $("#laporanobatBerlebihdokter").autocomplete({
            minLength: 1,
            source:
            function(req, add){
                $.ajax({
                    url: "<?php echo base_url(); ?>index.php/laporan/obatBerlebih/lookdokter",
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
                            //setlaporanobatBerlebihdokter();
                        }          
                });
            },
            select:
                function(event, ui) {
                    //dokter=ui.item.value; 
                    dokter = ui.item.value;
                    $('#listlaporanobatBerlebih').trigger('reloadGrid');
                }
        });
        
        var grid = $("#listlaporanobatBerlebih");
	grid.jqGrid({
            url: '<?php echo base_url() ?>index.php/laporan/obatBerlebih/json', //URL Tujuan Yg Mengenerate data Json nya
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
            colNames: ['Id Trans','Tgl Trans','Tgl Kunj','NIP','Penanggung','A/P','Pasien','Status','Dokter','Item Trans','Jumlah','Harga Standar','Harga Satuan','Doses','Selisih'],
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
                        {name:'nama_dokter',index:'nama_dokter',width:150,editable:true,editrules:{required:true}},
                        {name:'nama_item',index:'nama_item',width:70,editable:true,editrules:{required:true}},
                        {name:'jumlah',index:'jumlah',width:70,editable:true,editrules:{required:true}},
                        {name:'harga_item',index:'harga_item',width:70,editable:true,editrules:{required:true},align:'right',formatter:'currency',formatoptions: {thousandsSeparator:','}},
                        {name:'hrg_satuan',index:'hrg_satuan',width:70,editable:true,editrules:{required:true},align:'right',formatter:'currency',formatoptions: {thousandsSeparator:','}},
                        {name:'nama_dosis',index:'nama_dosis',width:70,editable:true,editrules:{required:true}},
                        {name:'selisih',index:'selisih',width:70,editable:true,editrules:{required:true},summaryType:'sum',align:'right',formatter:'currency',formatoptions: {thousandsSeparator:','}}
            ],
            rownumbers:true,
            rowNum: 10,
            rowList: [10,20,30],
            pager: '#pagerlaporanobatBerlebih',
            //sortname: 'id_transaksi',
            viewrecords: true,
            sortorder: "desc",
            editurl: '<?php echo base_url() ?>index.php/laporan/obatBerlebih/crud', //URL Proses CRUD Nya
            multiselect: false, 
            sortname: 'nama_dokter', 
            grouping:true, 
            groupingView : { 
                groupField : ['nama_dokter'], 
                groupSummary : [true], 
                groupColumnShow : [true],
                groupText : ['<b>Dokter: {0} - {1} Item</b>'], 
                groupCollapse : false,
                groupOrder: ['asc'] },
            caption: "Data Laporan Resep Mahal" //Caption List					
        });
	grid.jqGrid('navGrid','#pagerlaporanobatBerlebih',{view:true,edit:false,add:false,del:false},{},{},{},{closeOnEscape:true,closeAfterSearch:false,multipleSearch:false, multipleGroup:false, showQuery:false,drag:true,showOnLoad:false,sopt:['cn'],resize:false,caption:'Cari Record', Find:'Cari', Reset:'Batalkan Pencarian'});
	jQuery("#listlaporanobatBerlebih").jqGrid('navButtonAdd','#pagerlaporanobatBerlebih',{caption:"Print",
            onClickButton:function()
            {
                var isi="?namaTb="+namaTb+"&jenis="+jenis+"&bulan="+bulan+"&tahun="+tahun+"&tgl1="+tgl1+"&tgl2="+tgl2+"&karyawan="+karyawan+"&dokter="+dokter
                window.location.href="<?php echo base_url() ?>index.php/laporan/obatBerlebih/ekspor"+isi;
		//alert("BERHASIL ayo SEMANGAT kalahkan skripsi");
                return false;
            }
	});                                                                                               
    });
</script>
<div id="master_laporanobatBerlebih" style="width: auto; height: auto;overflow: auto">
<form>
    <table border="0" width="950">
        <tr>
            <td>
                <b>Tampilkan Berdasarkan :</b> 
                <select id="obatBerlebih_berdasarkan" onchange="setobatBerlebihBerdasarkan();">
                    <option value="" selected></option>
                    <option value="transaksi">Transaksi</option>
                    <option value="kunjungan">Kunjungan</option>
                </select>
            </td>
            <td>
                <b>Bulan :</b>
                <select id="laporanobatBerlebihbulan" onchange="setlaporanobatBerlebihbulan();">
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
                <input type="text" id="laporanobatBerlebihtahun" size="5" onchange="setlaporanobatBerlebihtahun();"/ >
            </td>
            <td>
                <b>dari Tanggal :</b>
                <input type="text" id="laporanobatBerlebihtgl1" size="7" onchange="setlaporanobatBerlebihtgl1();"/>
            </td>
            <td>
                <b>s/d :</b>
                <input type="text" id="laporanobatBerlebihtgl2" size="7" onchange="setlaporanobatBerlebihtgl2();"/>
            </td>
            <td>
                <b>Karyawan :</b>
                <select id="laporanobatBerlebihkaryawan" onchange="setlaporanobatBerlebihkaryawan();">
                    <option value="" selected>Semua</option>
                    <option value="a">Karyawan</option>
                    <option value="p">Pensiunan</option>
                </select>
            </td>
            <td>
                <b>Dokter :</b>
                <input type="text" id="laporanobatBerlebihdokter" size="10"/>
            </td>
        </tr>
    </table>
</form>
		<table id="listlaporanobatBerlebih" class="scroll" cellpadding="0" cellspacing="0"></table>
		<div id="pagerlaporanobatBerlebih" class="scroll" style="text-align:center;"></div>
                <div id="laporanobatBerlebihimpor"></div>
</div>