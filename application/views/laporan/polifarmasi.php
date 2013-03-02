<script type="text/javascript">
    var namaTb='polifarmasi',
        jenis='',
        bulan='',
        tahun='',
        tgl1='',
        tgl2='',
        karyawan='',
        dokter='';
        //polifarmasi='';

    function setPolifarmasiBerdasarkan()
    {
        jenis = $('#polifarmasi_berdasarkan').val();
        $('#listlaporanpolifarmasi').trigger('reloadGrid');
    }
                
    function setlaporanpolifarmasibulan()
    {
        //bulan= document.getElementById('laporanpolifarmasibulan');
        bulan = $('#laporanpolifarmasibulan').val();
        $('#listlaporanpolifarmasi').trigger('reloadGrid');
    }

    function setlaporanpolifarmasitahun()
    {
        tahun = $('#laporanpolifarmasitahun').val();
        $('#listlaporanpolifarmasi').trigger('reloadGrid');
    }
    
    function setlaporanpolifarmasitgl1()
    {
        tgl1 = $('#laporanpolifarmasitgl1').val();
        $('#listlaporanpolifarmasi').trigger('reloadGrid');
    }
    
    function setlaporanpolifarmasitgl2()
    {
        tgl2 = $('#laporanpolifarmasitgl2').val();
        $('#listlaporanpolifarmasi').trigger('reloadGrid');
    }
    
    function setlaporanpolifarmasikaryawan()
    {
        karyawan = $('#laporanpolifarmasikaryawan').val();
        $('#listlaporanpolifarmasi').trigger('reloadGrid');
    }
                
    $(document).ready(function()
    {
        $( "#laporanpolifarmasitgl1" ).datepicker({
            //dateFormat  : "dd MM yy",
            changeMonth: true,
            changeYear: true,
            showOn: "button",
            buttonImage : "<?php echo base_url();?>asset/images/calendar.gif",				
            buttonImageOnly : true
        });
        
        $( "#laporanpolifarmasitgl2" ).datepicker({
            //dateFormat  : "dd MM yy",
            changeMonth: true,
            changeYear: true,
            showOn: "button",
            buttonImage : "<?php echo base_url();?>asset/images/calendar.gif",				
            buttonImageOnly : true
        });
        
        $("#laporanpolifarmasidokter").autocomplete({
            minLength: 1,
            source:
            function(req, add){
                $.ajax({
                    url: "<?php echo base_url(); ?>index.php/laporan/polifarmasi/lookdokter",
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
                            //setlaporanpolifarmasidokter();
                        }          
                });
            },
            select:
                function(event, ui) {
                    //dokter=ui.item.value; 
                    dokter = ui.item.value;
                    $('#listlaporanpolifarmasi').trigger('reloadGrid');
                }
        });
        
        var grid = $("#listlaporanpolifarmasi");
	grid.jqGrid({
            url: '<?php echo base_url() ?>index.php/laporan/polifarmasi/json', //URL Tujuan Yg Mengenerate data Json nya
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
            colNames: ['Id Trans','Tgl Trans','Tgl Kunj','NIP','Penanggung','A/P','Pasien','Status','Dokter','Biaya','Jml. Item','Selisih','Detail'],
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
                        {name:'biaya',index:'biaya',width:70,editable:true,editrules:{required:true},align:'right',formatter:'currency',formatoptions: {thousandsSeparator:','}},
                        {name:'jumlah_item',index:'jumlah_item',width:50,editable:true,editrules:{required:true}},
                        {name:'selisih',index:'selisih',width:70,editable:true,editrules:{required:true},align:'right',formatter:'currency',formatoptions: {thousandsSeparator:','}},
                        {name:'detail',index:'detail',width:50,editable:true,editrules:{required:true}}
            ],
            rownumbers:true,
            rowNum: 10,
            rowList: [10,20,30],
            pager: '#pagerlaporanpolifarmasi',
            //sortname: 'id_transaksi',
            viewrecords: true,
            sortorder: "desc",
            editurl: '<?php echo base_url() ?>index.php/laporan/polifarmasi/crud', //URL Proses CRUD Nya
            multiselect: false, 
            
            sortname: 'nama_dokter', 
            grouping:true, 
            groupingView : { 
                groupField : ['nama_dokter'], 
               // groupSummary : [true], 
                groupColumnShow : [true],
                groupText : ['<b>Dokter: {0} - {1} Item</b>'], 
                groupCollapse : false,
                groupOrder: ['asc'] },
                
            caption: "Data Laporan Polifarmasi" //Caption List					
        });
	grid.jqGrid('navGrid','#pagerlaporanpolifarmasi',{view:true,edit:false,add:false,del:false},{},{},{},{closeOnEscape:true,closeAfterSearch:false,multipleSearch:false, multipleGroup:false, showQuery:false,drag:true,showOnLoad:false,sopt:['cn'],resize:false,caption:'Cari Record', Find:'Cari', Reset:'Batalkan Pencarian'});
	jQuery("#listlaporanpolifarmasi").jqGrid('navButtonAdd','#pagerlaporanpolifarmasi',{caption:"Print",
            onClickButton:function()
            {
                var isi="?namaTb="+namaTb+"&jenis="+jenis+"&bulan="+bulan+"&tahun="+tahun+"&tgl1="+tgl1+"&tgl2="+tgl2+"&karyawan="+karyawan+"&dokter="+dokter
                window.location.href="<?php echo base_url() ?>index.php/laporan/polifarmasi/ekspor"+isi;
		//alert("BERHASIL ayo SEMANGAT kalahkan skripsi");
                return false;
            }
	});
        
        $('a.detail_poli').live('click',function(){
            var id_trans=$(this).attr("href");
            //bb=buku_besar;
            $("#dialog_detailTemuan").dialog({
                title:"Detail Laporan Temuan : "+id_trans, 
		resizable:false, 
		width:675, 
		height:250,
		show: 'drop',
		hide: 'scale',
		modal:true,
                open:function(){
                    $("#dialog_detailTemuan").load("<?php echo base_url() ?>index.php/laporan/detailTemuan/detail?idTrans="+id_trans+"&jenis=polifarmasi");
                },
		close:function(){
                    $(this).dialog('destroy');
		}
            });

            return false;
        });
    });
</script>
<div id="master_laporanpolifarmasi" style="width: auto; height: auto;overflow: auto">
<form>
    <table border="0" width="950">
        <tr>
            <td>
                <b>Tampilkan Berdasarkan :</b> 
                <select id="polifarmasi_berdasarkan" onchange="setpolifarmasiBerdasarkan();">
                    <option value="" selected></option>
                    <option value="transaksi">Transaksi</option>
                    <option value="kunjungan">Kunjungan</option>
                </select>
            </td>
            <td>
                <b>Bulan :</b>
                <select id="laporanpolifarmasibulan" onchange="setlaporanpolifarmasibulan();">
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
                <input type="text" id="laporanpolifarmasitahun" size="5" onchange="setlaporanpolifarmasitahun();"/ >
            </td>
            <td>
                <b>dari Tanggal :</b>
                <input type="text" id="laporanpolifarmasitgl1" size="7" onchange="setlaporanpolifarmasitgl1();"/>
            </td>
            <td>
                <b>s/d :</b>
                <input type="text" id="laporanpolifarmasitgl2" size="7" onchange="setlaporanpolifarmasitgl2();"/>
            </td>
            <td>
                <b>Karyawan :</b>
                <select id="laporanpolifarmasikaryawan" onchange="setlaporanpolifarmasikaryawan();">
                    <option value="" selected>Semua</option>
                    <option value="a">Karyawan</option>
                    <option value="p">Pensiunan</option>
                </select>
            </td>
            <td>
                <b>Dokter :</b>
                <input type="text" id="laporanpolifarmasidokter" size="10"/>
            </td>
        </tr>
    </table>
</form>
		<table id="listlaporanpolifarmasi" class="scroll" cellpadding="0" cellspacing="0"></table>
		<div id="pagerlaporanpolifarmasi" class="scroll" style="text-align:center;"></div>
                <div id="laporanpolifarmasiimpor"></div>
</div>
<div id="dialog_detailTemuan" class="">
    
</div> 