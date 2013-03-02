		<script type="text/javascript">
                <?php
                $idgriddiagnosa="listdiagnosa".$namafile;
                $idpagergriddiagnosa="pagerdiagnosa".$namafile;
                $idgriditem="listitem".$namafile;
                $idpagergriditem="pageritem".$namafile;
                $fungsiadddiagnosa="adddiagnosa".$namafile;
                $idedititem=$namafile."edititem";
                ?>
		var idgriddiagnosa='#'+'<?php echo $idgriddiagnosa;?>';
                var idpagergriddiagnosa='#'+'<?php echo $idpagergriddiagnosa;?>';
                var idgriditem='#'+'<?php echo $idgriditem;?>';
                var idpagergriditem='#'+'<?php echo $idpagergriditem;?>';
                var idadddetaildiagnosa='#'+'<?php echo $fungsiadddiagnosa;?>';
                var idedititem='#'+'<?php echo $idedititem;?>';
         
                var id_diagnosa;

                $(document).ready(function()
			{       
                                        $('#hasilapotekedititem').dialog({
                                        autoOpen:false,
                                        title:"Detail Item",
                                        resizable:false,
                                        width:700,
                                        show: 'drop',
                                        hide: 'scale',
                                        modal:true
                                        }
                                        );
                                        
                            
                                $(idadddetaildiagnosa).autocomplete({
                                    minLength: 1,
                                    source:
                                    function(req, add){
                                        $.ajax({
                                        url: "<?php echo base_url(); ?>index.php/transaksi/apotek/lookdiagnosa",
                                        dataType: 'json',
                                        type: 'POST',
                                        data: req,
                                        success:
                                        function(data){
                                        if(data.response =="true")
                                        {
                                        add(data.message);
                                        } else if(data.response =="false")
                                        {
                                        $('.ui-autocomplete-loading').removeClass("ui-autocomplete-loading");
                                        id_diagnosa="undefined";
                                        }
                                        },
                                        error: function(e){
                                        alert("error apotek : "+e)
                                        }
                                        });

                                        },
                                        select:
                                        function(event, ui)
                                        {
                                        id_diagnosa=ui.item.id;
                                        }
                                });
            

            

            
//            $("#button_adddetaildiagnosa").click(function() {
//
//	});



				var grid = $(idgriddiagnosa);
				grid.jqGrid({
					url: '<?php echo base_url() ?>index.php/hasil/<?php echo $namafile;?>/detail_diagnosa/'+<?php echo $id_tran;?>, //URL Tujuan Yg Mengenerate data Json nya
					datatype: "json", //Datatype yg di gunakan
					height: "auto", //Mengset Tinggi table jadi Auto menyesuaikan dengan isi table
					mtype: "GET",
                                        
					colNames: ['Id Transaksi','Diagnosa'],
					colModel: [
						{name:'id_transaksi_diagnosa', key:true, index:'id_transaksi_diagnosa', hidden:true,editable:false,editrules:{required:true}},//name untuk variabel post yang dikirim saat menambah data
						{name:'nama_diagnosa',index:'nama_diagnosa',width:150,editable:true,editrules:{required:true}}//index untuk variabel yang digunakan saat pencarian
						
					],
					rownumbers:true,
					rowNum: 10,
					rowList: [10,20,30],
					pager: idpagergriddiagnosa,
					sortname: 'id_transaksi_diagnosa',
					viewrecords: true,
					sortorder: "desc",
					editurl: '<?php echo base_url() ?>index.php/hasil/<?php echo $namafile;?>/cruddiagnosa', //URL Proses CRUD Nya
					multiselect: false,
					caption: "Diagnosa" //Caption List
				});
				grid.jqGrid('navGrid',idpagergriddiagnosa,{view:false,edit:false,add:false,del:true},{},{},{},{closeOnEscape:true,closeAfterSearch:false,multipleSearch:false, multipleGroup:false, showQuery:false,drag:true,showOnLoad:false,sopt:['cn'],resize:false,caption:'Cari Record', Find:'Cari', Reset:'Batalkan Pencarian'});
                               
				var tes = $(idgriditem);
				tes.jqGrid({
					url: '<?php echo base_url() ?>index.php/hasil/<?php echo $namafile;?>/detail_item/'+<?php echo $id_tran;?>, //URL Tujuan Yg Mengenerate data Json nya
					datatype: "json", //Datatype yg di gunakan
					height: "auto", //Mengset Tinggi table jadi Auto menyesuaikan dengan isi table
					mtype: "GET",
                                        
					colNames: ['Id Transaksi','Jenis','Item','Jumlah','Hrg.Standar','Hrg.Satuan','Satuan','Kandungan','Dosis','Rekomendasi','Total'],
					colModel: [
						{name:'id_transaksi', key:true, index:'id_transaksi', hidden:true,editable:false,editrules:{required:true}},//name untuk variabel post yang dikirim saat menambah data
						{name:'jenis_item',index:'jenis_item',width:50,align:'center',editable:true,editrules:{required:true}},//index untuk variabel yang digunakan saat pencarian
						{name:'nama_item',index:'nama_item',width:40,align:'center',editable:true,editrules:{required:true}},
						{name:'jumlah',index:'jumlah', width:40,align:'center',editable:true,editrules:{required:true}},
						{name:'harga_item',index:'harga_item',width:55,align:'center',editable:true,editrules:{required:true}},
						{name:'hrg_satuan',index:'hrg_satuan',width:60,align:'center',editable:true,editrules:{required:true}},
						{name:'satuan',index:'satuan',width:40,align:'center',editable:true,editrules:{required:true}},
						{name:'kandungan',index:'kandungan',width:60,align:'center',editable:true,editrules:{required:true}},
						{name:'dosis',index:'dosis',width:30,align:'center',editable:true,editrules:{required:true}},
                                                {name:'rekomendasi',index:'rekomendasi',width:60,align:'center',editable:true,editrules:{required:true}},
                                                {name:'total',index:'total',width:50,align:'center',editable:true,editrules:{required:true}}
					],
					rownumbers:false,
                                        footerrow:true,
                                        userDataOnFooter:true,
                                        //altRows : true,
					rowNum: 10,
					rowList: [10,20,30],
					pager: idpagergriditem,
					sortname: 'id_transaksi',
					viewrecords: true,
					sortorder: "desc",
					editurl: '<?php echo base_url() ?>index.php/hasil/<?php echo $namafile;?>/cruditem', //URL Proses CRUD Nya
					multiselect: false,
                                        ondblClickRow: function(id_transaksi){

                                                    alert("You double click row with id: "+id_transaksi);
                                                    return false;
                                                    },
					caption: "Item Transaksi" //Caption List
				});
				tes.jqGrid('navGrid',idpagergriditem,{view:false,edit:false,add:false,del:true},{},{},{},{closeOnEscape:true,closeAfterSearch:false,multipleSearch:false, multipleGroup:false, showQuery:false,drag:true,showOnLoad:false,sopt:['cn'],resize:false,caption:'Cari Record', Find:'Cari', Reset:'Batalkan Pencarian'});
                                jQuery(idgriditem)
                                .jqGrid('navButtonAdd',idpagergriditem,{caption:"",buttonicon:"ui-icon-pencil",
                                onClickButton:function(){
                                var id = tes.jqGrid('getGridParam','selrow');
                                if (id) { var ret = tes.jqGrid('getRowData',id);
                                 }
                                else { alert("Please select row");}
                                alert("You double click row with id: "+id);
                                $('#hasilapotekedititem').dialog('open');
                                $("#hasilapotekedititem").load("<?php echo base_url() ?>index.php/hasil/hasilapotek/edititem/"+id);
                                return false;
                                }
				})
                                .jqGrid('navButtonAdd',idpagergriditem,{caption:"",buttonicon:"ui-icon-plus",
                                onClickButton:function()
                                {
                                     $("#hasilapotekedititem").load("<?php echo base_url() ?>index.php/hasil/<?php echo $namafile;?>/plusitem/"+<?php echo $id_tran;?>);
                                     $('#hasilapotekedititem').dialog('open');
                                }
				})
                         });
           
            function <?php echo $fungsiadddiagnosa;?>()
            {
             var diagnosa = $(idadddetaildiagnosa).val();
            if (diagnosa == '')
            {
                alert('Diagnosa harus di isi');
                $('#adddetaildiagnosa').focus();
                return false;
            }
            $.ajax({
               url : "<?php echo base_url(); ?>index.php/hasil/<?php echo $namafile?>/simpandiagnosa",
               data : "id="+<?php echo $id_tran;?>+"&diag="+diagnosa+"&id_diag="+id_diagnosa,
               type: 'get',
               success: function(data){
                   if (data=="sukses"){
                       resetDiagnosa();
                       $(idgriddiagnosa).trigger('reloadGrid');
                   } else {
                       alert("Gagal Menyimpan data");
                   }

               },
               error: function(e){
                   alert("error pasien : "+e)
               }
            });
            return false;
            }

            function resetDiagnosa(){
            $('#adddetaildiagnosa').val("");
            }

		</script>
<table>

<tr>
    <form>


      <td>
             <input type="text" name="<?php echo $fungsiadddiagnosa;?>" id="<?php echo $fungsiadddiagnosa;?>">
             <input type="button" value="add"  onclick="<?php echo $fungsiadddiagnosa."()";?>;" /></td>
             <td>&nbsp;</td>
             



    
</form>
</tr>
<tr>
    <td align="center" valign="top">
<div  style="width: auto; height: auto;overflow: auto">
                <table id="<?php echo $idgriddiagnosa;?>" class="scroll" cellpadding="0" cellspacing="0"></table>
                   <div id="<?php echo $idpagergriddiagnosa;?>" class="scroll" style="text-align:center;"></div>
         
  
</div>
</td>
<td align="center" valign="top">
    <div  style="width: auto; height: auto;overflow: auto">
		<table id="<?php echo $idgriditem?>" class="scroll" cellpadding="0" cellspacing="0"></table>
                <div id="<?php echo $idpagergriditem?>" class="scroll" style="text-align:center;"></div>
                
</div>
</td>
</tr>
</table>
<div id="<?php echo $idedititem?>"></div>