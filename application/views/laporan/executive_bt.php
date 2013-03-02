<script type="text/javascript">
    $(document).ready(function(){

        var grid = $('#sum_biayaterbesar');
	grid.jqGrid({
	url: '<?php echo base_url() ?>index.php/laporan/executive/getBiayaterbesarjson', //URL Tujuan Yg Mengenerate data Json nya
	datatype: "json", //Datatype yg di gunakan
	height: "auto", //Mengset Tinggi table jadi Auto menyesuaikan dengan isi table
	mtype: "GET",
        postData:{bulan : function()
                 {
                     return bulan1;
                 },tahun : function()
                 {
                     return tahun1;
                 }
                 },
        colNames: ['NIP','Nama','Jumlah'],
	colModel: [
                    {name:'nip',index:'post_biaya',width:120,editable:true,editrules:{required:true}},
                    {name:'nama',index:'karyawan',width:120,editable:true,editrules:{required:true}},
                    {name:'jumlah',index:'kel_karyawan',width:120,editable:true,editrules:{required:true}}
                  ],
	rownumbers:true,
	rowNum: 10,
	rowList: [10,20,30],
	pager: '#sum_pager_biayaterbesar',
	sortname: 'nip',
	viewrecords: true,
	sortorder: "desc",
	multiselect: false,
	caption: "Biaya Terbesar" //Caption List
	});
	grid.jqGrid('navGrid','#sum_pager_biayaterbesar',{view:false,edit:false,add:false,del:false},{},{},{},{closeOnEscape:true,closeAfterSearch:false,multipleSearch:false, multipleGroup:false, showQuery:false,drag:true,showOnLoad:false,sopt:['cn'],resize:false,caption:'Cari Record', Find:'Cari', Reset:'Batalkan Pencarian'});

        var grid = $('#sum_biayajabatan');
	grid.jqGrid({
	url: '<?php echo base_url() ?>index.php/laporan/executive/getBiayajabatanjson', //URL Tujuan Yg Mengenerate data Json nya
	datatype: "json", //Datatype yg di gunakan
	height: "auto", //Mengset Tinggi table jadi Auto menyesuaikan dengan isi table
	mtype: "GET",
        postData:{bulan : function()
                 {
                     return bulan1;
                 },tahun : function()
                 {
                     return tahun1;
                 }
                 },
        colNames: ['Id Bagian','Nama','Jumlah'],
	colModel: [
                    {name:'id_bagian', key:true, index:'id_bagian', hidden:true,editable:false,editrules:{required:true}},//name untuk variabel post yang dikirim saat menambah data
                    {name:'nama_bagian',index:'nama_bagian',width:520,editable:true,editrules:{required:true}},
                    {name:'total',index:'total',width:120,editable:true,editrules:{required:true}}
                  ],
	rownumbers:true,
	rowNum: 10,
	rowList: [10,20,30],
	pager: '#sum_pager_biayajabatan',
	sortname: 'id_bagian',
	viewrecords: true,
	sortorder: "desc",
	multiselect: false,
	caption: "Penggunaan Biaya Berdasarkan Jabatan" //Caption List
	});
	grid.jqGrid('navGrid','#sum_pager_biayajabatan',{view:false,edit:false,add:false,del:false},{},{},{},{closeOnEscape:true,closeAfterSearch:false,multipleSearch:false, multipleGroup:false, showQuery:false,drag:true,showOnLoad:false,sopt:['cn'],resize:false,caption:'Cari Record', Find:'Cari', Reset:'Batalkan Pencarian'});

    })
</script>
<div>
    <table>
        <tr>
        <td align="center" valign="top">
        <div  style="width: auto; height: auto;overflow: auto">
		<table id="sum_biayaterbesar" class="scroll" cellpadding="0" cellspacing="0"></table>
                <div id="sum_pager_biayaterbesar" class="scroll" style="text-align:center;"></div>
        </div>
        </td>
        <td align="center" valign="top">
        <div  style="width: auto; height: auto;overflow: auto">
		<table id="sum_biayajabatan" class="scroll" cellpadding="0" cellspacing="0"></table>
                <div id="sum_pager_biayajabatan" class="scroll" style="text-align:center;"></div>
        </div>
        </td>
        </tr>
    </table>
</div>
