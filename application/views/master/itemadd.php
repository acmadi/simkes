<script type="text/javascript">
	$(document).ready(function(){
		//Mempercantik Button dengan Jquery UI
		$("#submit_item").button();
		$("#reset_item").button();
	});
	
	function saveitem()
		{
		 $.ajax(
               {
               url : $("#itemadd").attr("action"),
               data : $("#itemadd").serialize(),
               type: $("#itemadd").attr("method"),
               success: function(data)
               {
                   //alert ("Data udah dikirim");
				   
				   $('#listitem').trigger('reloadGrid'); //Triger Untuk Reload List JQGrid
                              
                   //$("#wil").html(data);
               },
               error: function(e)
               {
                   alert("Data belum Diambil");
               }
         }
         );
		}
	
</script>

<fieldset>
	<legend>Add/Edit Data</legend>
	<form method="post" action="<?php echo base_url() ?>index.php/master/item/crud" name="itemadd" id="itemadd">
		<input type="hidden" name="oper" value="add">
		<table border="0" cellpadding="3" cellspacing="0">
			<tr>
				<td>Nama Item</td>
				<td>:</td>
				<td><input type="text" name="nama_item" id="nama_item" class="ui-widget ui-widget-content padding ui-corner-all"></td>
			</tr>
			<tr>
				<td>Jenis Tagihan</td>
				<td>:</td>
				<td>
				<select name="jns_item" id="jns_item">
				<?php
				for($i=0;$i<count($item);$i++)
				{?>
				<option value="<?php echo $item[$i]->idjns_item;?>"><?php echo $item[$i]->jenis_item;?></option>
				<?php
				}
				?>
				
				</select></td>
                
			</tr>
			<tr>
				<td>HBA</td>
				<td>:</td>
                <td><input type="text" name="hba_item" id="hba_item" class="ui-widget ui-widget-content padding ui-corner-all"></td>
			<tr>
				<td>Harga</td>
				<td>:</td>
				<td><input type="text" name="harga_item" id="harga_item" class="ui-widget ui-widget-content padding ui-corner-all"></td>
			</tr>
			<tr>
				<td>Formularium</td>
				<td>:</td>
				<td>
				<select name="formularium_item" id="formularium_item">
				<option value="y">Formularium</option>
				<option value="t">Tdk Formularium</option>
				</select></td>
			</tr>
			<tr>
				<td>Jenis Obat</td>
				<td>:</td>
				<td>
				<select name="oral_item" id="oral_item">
				<option value="y">Oral</option>
				<option value="t">Non Oral</option>
				</select></td></tr>
			<tr>
				<td>Kelas</td>
				<td>:</td>
				<td>
				<select name="kls_item" id="kls_item">
				<option value="0">Tidak Ada Kelas</option>
				<option value="1">Kelas I</option>
				<option value="2">Kelas II</option>
				<option value="3">Kelas III</option>
				</select></td>
			</tr>
			<tr>
				<td>Provider</td>
				<td>:</td>
				<td><input type="text" name="provider_item" id="provider_item" class="ui-widget ui-widget-content padding ui-corner-all"></td>
			</tr>
			<tr>
				<td>Entri</td>
				<td>:</td>
				<td><input type="text" name="entri_item" id="entri_item" class="ui-widget ui-widget-content padding ui-corner-all"></td>
			</tr>
			<tr>
                <td colspan="3" align="center"><input type="button" value="Save" name="submit" id="submit_item" onclick="saveitem();" /><input type="reset" name="reset_item" id="reset_item" value="reset" /></td>
			</tr>
		</table>								
	</form>
</fieldset>