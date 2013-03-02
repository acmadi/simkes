<script type="text/javascript">
	$(document).ready(function(){
		//Mempercantik Button dengan Jquery UI
		$("#submit").button();
		$("#reset_karyawan").button();
	});
        $( "#ttl_karyawan" ).datepicker({
                //dateFormat  : "dd MM yy",
                changeMonth: true,
                changeYear: true,
                showOn: "button",
                buttonImage : "<?php echo base_url();?>asset/images/calendar.gif",
                buttonImageOnly : true
                });
	
	function savekaryawan()
		{
		 $.ajax(
                {
                url : $("#karyawanadd").attr("action"),
               data : $("#karyawanadd").serialize(),
               type: $("#karyawanadd").attr("method"),
               success: function(data)
               {
                   //alert ("Data udah dikirim");
				   
				   $('#listkaryawan').trigger('reloadGrid'); //Triger Untuk Reload List JQGrid
                              
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
<?php
//echo count($bagian);
//print_r($bagian);
//print_r($rayon);
//echo count($rayon);


?>
<fieldset>
	<legend>Add/Edit Data</legend>
	<form method="post" action="<?php echo base_url() ?>index.php/master/karyawan/crud" name="karyawanadd" id="karyawanadd">
		<input type="hidden" name="oper" value="add">
		<table border="0" cellpadding="3" cellspacing="0">
			<tr>
				<td>Nama Karyawan</td>
				<td>:</td>
				<td><input type="text" name="nama_karyawan" id="nama_karyawan" class="ui-widget ui-widget-content padding ui-corner-all"></td>
			</tr>
			<tr>
				<td>Rayon</td>
				<td>:</td>
                                <td><select id="id_rayon" name="id_rayon" class="ui-widget ui-widget-content padding ui-corner-all">
								<option value="">Pilih Rayon</option>
								<?php
								for($i=0;$i<count($rayon);$i++)
								{?>
								<option value="<?php echo $rayon[$i]->id_rayon;?>"><?php	echo $rayon[$i]->nama_rayon; ?></option>
								
								<?php
								}
								?>
								</select></td>
			</tr>
			<tr>
				<td>Bagian</td>
				<td>:</td>
                                <td><select id="id_bagian" name="id_bagian" class="ui-widget ui-widget-content padding ui-corner-all">
								<option value="">Pilih Bagian</option>

								<?php
								for($i=0;$i<count($bagian);$i++)
								{?>
								<option value="<?php echo $bagian[$i]->id_bagian;?>"><?php	echo $bagian[$i]->nama_bagian; ?></option>
								
								<?php
								}
								?>
								</select></td></tr>
			<tr>
				<td>alamat</td>
				<td>:</td>
				<td><input type="text" name="alamat_karyawan" id="alamat_karyawan" class="ui-widget ui-widget-content padding ui-corner-all"></td>
			</tr>
			<tr>
				<td>sex</td>
				<td>:</td>
				<td><input type="text" name="sex_karyawan" id="sex_karyawan" class="ui-widget ui-widget-content padding ui-corner-all"></td>
			</tr>
			<tr>
				<td>telepon</td>
				<td>:</td>
				<td><input type="text" name="telp_karyawan" id="telp_karyawan" class="ui-widget ui-widget-content padding ui-corner-all"></td>
			</tr>
			<tr>
				<td>Tanggal Lahir</td>
				<td>:</td>
				<td><input type="text" name="ttl_karyawan" id="ttl_karyawan" class="ui-widget ui-widget-content padding ui-corner-all"></td>
			</tr>
			<tr>
				<td>A/P</td>
				<td>:</td>
				<td><!-- <input type="text" name="ap_karyawan" id="ap_karyawan" class="ui-widget ui-widget-content padding ui-corner-all">
                                    -->
                                    <select id="ap_karyawan" name="ap_karyawan" class="ui-widget ui-widget-content padding ui-corner-all"> 
                                        <option value="a">Aktif</option>
                                        <option value="p">Pensiun</option>
                                    </select>

                                </td>
			</tr>
			<tr>
				<td>Status</td>
				<td>:</td>
				<td>
                                        <select id="status_karyawan" name="status_karyawan" class="ui-widget ui-widget-content padding ui-corner-all">
                                        <option value="1">Suami</option>
                                        <option value="2">Istri</option>
                                        <option value="3">Anak</option>
                                        <option value="4">Menikah</option>
                                        <option value="5">Single</option>
                                    </select>
                                </td>
			</tr>
			<tr>
				<td>Kelas Kamar</td>
				<td>:</td>
				<td><input type="text" name="kls_kmr" id="kls_kmr" class="ui-widget ui-widget-content padding ui-corner-all"></td>
			</tr>
			<tr>
                            <td colspan="3" align="center"><input type="button" value="Save" name="submit" id="submit" onclick="savekaryawan();" />
                                <input type="reset" name="reset_karyawan" id="reset_karyawan" value="reset" /></td>
			</tr>
		</table>								
	</form>
</fieldset>