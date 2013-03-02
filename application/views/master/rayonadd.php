<script type="text/javascript">
	$(document).ready(function()
	{
		//Mempercantik Button dengan Jquery UI
		$("#submit").button();
		$("#reset").button();
		//$("#tambahrayon").button();
                
        });
        function pilihmitra()
        {
            var objmitra = document.getElementById("mitra");
            var index = objmitra.selectedIndex;

         $.ajax(
         {
               url : "<?php echo base_url(); ?>index.php/master/rayon/getwilayah",
               data : "id="+index,
               type: 'POST',
               success: function(data)
               {
                     $("#wil").html(data);
               },
               error: function(e)
               {
                   alert("Data belum Diambil");
               }
         }
         );

        }
		
		function saverayon()
		{
		 $.ajax(
         {
            url : $("#rayonadd").attr("action"),
               data : $("#rayonadd").serialize(),
               type: $("#rayonadd").attr("method"),
               success: function(data)
               {
                   //alert ("Data udah dikirim");
				   
		   $('#listrayon').trigger('reloadGrid'); //Triger Untuk Reload List JQGrid
                   $('#addrayon').hide();
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
<div id="addrayon">
<fieldset>
	<legend>Add/Edit Data</legend>
	<form method="post" action="<?php echo base_url() ?>index.php/master/rayon/crud" name="rayonadd" id="rayonadd">
		<input type="hidden" name="oper" value="add">
		<table border="0" cellpadding="3" cellspacing="0">
			<tr>
				<td>Nama rayon</td>
				<td>:</td>
				<td><input type="text" name="nama_rayon" id="nama_rayon" class="ui-widget ui-widget-content padding ui-corner-all"></td>
			</tr>
			<tr>
				<td>Mitra</td>
				<td>:</td>
                                <td><select id="mitra" name="mitra" onchange="pilihmitra();">
								<option value="" >Pilih Mitra</option>
                                                                <?php
								for($i=0;$i<count($mitra);$i++)
								{?>
								<option value="<?php echo $mitra[$i]['id_mitra'];?>"><?php	echo $mitra[$i]['nama_mitra']; ?></option>
								
								<?php
								}
								?>
								</select></td>
			</tr>
			<tr>
				<td>Wilayah</td>
				<td>:</td>
                                <td><select id="wil" name="wil">
								<option value="">Pilih Wilayah</option>
								</select></td></tr>
			
			<tr>
                            <td colspan="3" align="center">
							<input type="button" value="Save" name="submit" id="submit" onclick="saverayon();" /><input type="reset" name="reset" id="reset" value="reset" /></td>
			</tr>
		</table>								
	</form>
</fieldset>
</div>

