<script type="text/javascript">
    var namaTb='biaya',
        jenis='',
        bulan='',
        tahun='',
        tgl1='',
        tgl2='',
        karyawan='',
        dokter='';
        //biaya='';

    function setbiayaBerdasarkan()
    {
        jenis = $('#biaya_berdasarkan').val();
        $('#listlaporanbiaya').trigger('reloadGrid');
    }
                
    function setlaporanbiayabulan()
    {
        //bulan= document.getElementById('laporanbiayabulan');
        bulan = $('#laporanbiayabulan').val();
        $('#listlaporanbiaya').trigger('reloadGrid');
    }

    function setlaporanbiayatahun()
    {
        tahun = $('#laporanbiayatahun').val();
        $('#listlaporanbiaya').trigger('reloadGrid');
    }
    
    function setlaporanbiayatgl1()
    {
        tgl1 = $('#laporanbiayatgl1').val();
        $('#listlaporanbiaya').trigger('reloadGrid');
    }
    
    function setlaporanbiayatgl2()
    {
        tgl2 = $('#laporanbiayatgl2').val();
        $('#listlaporanbiaya').trigger('reloadGrid');
    }
    
    function setlaporanbiayakaryawan()
    {
        karyawan = $('#laporanbiayakaryawan').val();
        $('#listlaporanbiaya').trigger('reloadGrid');
    }
                
    $(document).ready(function()
    {
        $( "#laporanbiayatgl1" ).datepicker({
            //dateFormat  : "dd MM yy",
            changeMonth: true,
            changeYear: true,
            showOn: "button",
            buttonImage : "<?php echo base_url();?>asset/images/calendar.gif",				
            buttonImageOnly : true
        });
        
        $( "#laporanbiayatgl2" ).datepicker({
            //dateFormat  : "dd MM yy",
            changeMonth: true,
            changeYear: true,
            showOn: "button",
            buttonImage : "<?php echo base_url();?>asset/images/calendar.gif",				
            buttonImageOnly : true
        });
        
        $("#laporanbiayadokter").autocomplete({
            minLength: 1,
            source:
            function(req, add){
                $.ajax({
                    url: "<?php echo base_url(); ?>index.php/laporan/biaya/lookdokter",
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
                            //setlaporanbiayadokter();
                        }          
                });
            },
            select:
                function(event, ui) {
                    //dokter=ui.item.value; 
                    dokter = ui.item.value;
                    $('#listlaporanbiaya').trigger('reloadGrid');
                }
        });
        
        var grid = $("#listlaporanbiaya");
	grid.jqGrid({
            url: '<?php echo base_url() ?>index.php/laporan/biaya/json', //URL Tujuan Yg Mengenerate data Json nya
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
            colNames: ['','Id Trans','Tgl Trans','Tgl Kunj','Buku Besar','NIP','Penanggung','A/P','Pasien','Status','Dokter','Item Trans','Jumlah','Harga Standart','Harga Satuan','Selisih','Setuju','Rekomendasi','Ket. Rekom'],
            colModel: [
                        {name:'id', key:true, index:'id', hidden:true,editable:false,editrules:{required:true}},//name untuk variabel post yang dikirim saat menambah data
                        {name:'id_transaksi', index:'id_transaksi',width:70,editable:true,editrules:{required:true},summaryType:'count', summaryTpl : '({0}) Total'},
			{name:'tgl_transaksi',index:'tgl_transaksi',width:100,editable:true,align:'center',editrules:{required:true}},//index untuk variabel yang digunakan saat pencarian
			{name:'tgl_kunjungan',index:'tgl_kunjungan',width:100,editable:true,align:'center',editrules:{required:true}},
			{name:'buku_besar',index:'buku_besar',width:70,editable:true,editrules:{required:true}},
                        {name:'nip',index:'nip',width:70,editable:true,editrules:{required:true},align:'center'},
			{name:'nama_karyawan',index:'nama_karyawan',width:150,editable:true,editrules:{required:true}},
                        {name:'A/P',index:'A/P',width:30,align:'center',editable:true,editrules:{required:true}},
                        {name:'nama_tertanggung',index:'nama_tertanggung',width:150,editable:true,editrules:{required:true}},
                        {name:'status',index:'status',width:50,editable:true,editrules:{required:true}},
                        {name:'nama_dokter',index:'nama_dokter',width:150,editable:true,editrules:{required:true}},
                        {name:'nama_item',index:'nama_item',width:70,editable:true,editrules:{required:true}},
                        {name:'jumlah',index:'jumlah',width:70,editable:true,align:'center',editrules:{required:true}},
                        {name:'harga_item',index:'harga_item',width:70,editable:true,editrules:{required:true},summaryType:'sum',align:'right',formatter:'currency',formatoptions: {thousandsSeparator:','}},
                        {name:'hrg_satuan',index:'hrg_satuan',width:70,editable:true,editrules:{required:true},summaryType:'sum',align:'right',formatter:'currency',formatoptions: {thousandsSeparator:','}},
                        {name:'selisih',index:'selisih',width:70,editable:true,editrules:{required:true},summaryType:'sum',align:'right',formatter:'currency',formatoptions: {thousandsSeparator:','}},
                        {name:'disetujui',index:'disetujui',width:70,editable:true,editrules:{required:true}, align:'center'},
                        {name:'nama_rekomendasi',index:'nama_rekomendasi',width:150,editable:true,editrules:{required:true}},
                        {name:'ket_rekom',index:'ket_rekom',width:100,editable:true,editrules:{required:true}}
            ],
            rownumbers:true,
            rowNum: 10,
            rowList: [10,20,30],
            pager: '#pagerlaporanbiaya',
            sortname: 'id_transaksi',
            viewrecords: true,
            sortorder: "desc",
            editurl: '<?php echo base_url() ?>index.php/laporan/biaya/crud', //URL Proses CRUD Nya
            multiselect: false, 
            sortname: 'nama_dokter', 
            //grouping:true, 
            /*
            groupingView : { 
                groupField : ['nama_dokter'], 
                groupSummary : [true], 
                groupColumnShow : [true],
                groupText : ['<b>Dokter: {0} - {1} Item</b>'], 
                groupCollapse : false,
                groupOrder: ['asc'] },
                */
            caption: "Data Laporan biaya" //Caption List					
        });
	grid.jqGrid('navGrid','#pagerlaporanbiaya',{view:true,edit:false,add:false,del:false},{},{},{},{closeOnEscape:true,closeAfterSearch:false,multipleSearch:false, multipleGroup:false, showQuery:false,drag:true,showOnLoad:false,sopt:['cn'],resize:false,caption:'Cari Record', Find:'Cari', Reset:'Batalkan Pencarian'});
	jQuery("#listlaporanbiaya").jqGrid('navButtonAdd','#pagerlaporanbiaya',{caption:"Print",
            onClickButton:function()
            {
                var isi="?namaTb="+namaTb+"&jenis="+jenis+"&bulan="+bulan+"&tahun="+tahun+"&tgl1="+tgl1+"&tgl2="+tgl2+"&karyawan="+karyawan+"&dokter="+dokter
                window.location.href="<?php echo base_url() ?>index.php/laporan/biaya/ekspor"+isi;
		//alert("BERHASIL ayo SEMANGAT kalahkan skripsi");
                return false;
            }
	});                                                                                               
    });
</script>
<div id="master_laporanbiaya" style="width: auto; height: auto;overflow: auto">
<form>
    <table border="0" width="950">
        <tr>
            <td>
                <b>Tampilkan Berdasarkan :</b> 
                <select id="biaya_berdasarkan" onchange="setbiayaBerdasarkan();">
                    <option value="" selected></option>
                    <option value="transaksi">Transaksi</option>
                    <option value="kunjungan">Kunjungan</option>
                </select>
            </td>
            <td>
                <b>Bulan :</b>
                <select id="laporanbiayabulan" onchange="setlaporanbiayabulan();">
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
                <input type="text" id="laporanbiayatahun" size="5" onchange="setlaporanbiayatahun();"/ >
            </td>
            <td>
                <b>dari Tanggal :</b>
                <input type="text" id="laporanbiayatgl1" size="7" onchange="setlaporanbiayatgl1();"/>
            </td>
            <td>
                <b>s/d :</b>
                <input type="text" id="laporanbiayatgl2" size="7" onchange="setlaporanbiayatgl2();"/>
            </td>
            <td>
                <b>Karyawan :</b>
                <select id="laporanbiayakaryawan" onchange="setlaporanbiayakaryawan();">
                    <option value="" selected>Semua</option>
                    <option value="a">Karyawan</option>
                    <option value="p">Pensiunan</option>
                </select>
            </td>
            <td>
                <b>Dokter :</b>
                <input type="text" id="laporanbiayadokter" size="10"/>
            </td>
        </tr>
    </table>
</form>
		<table id="listlaporanbiaya" class="scroll" cellpadding="0" cellspacing="0"></table>
		<div id="pagerlaporanbiaya" class="scroll" style="text-align:center;"></div>
                <div id="laporanbiayaimpor"></div>
</div>