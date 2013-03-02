<script type="text/javascript">
	$(document).ready(function(){
		//Mempercantik Button dengan Jquery UI
		$("#submit").button();
		$("#reset").button();
	});
</script>
<fieldset>
	<legend>Add/Edit Data</legend>
	<form method="post" action="crud.php" name="form1" id="form1">
		<input type="hidden" name="oper" value="add">
		<table border="0" cellpadding="3" cellspacing="0">
			<tr>
				<td>Nama Buku</td>
				<td>:</td>
				<td><input type="text" name="nama" id="nama" class="ui-widget ui-widget-content padding ui-corner-all"></td>
			</tr>
			<tr>
				<td>Pengarang</td>
				<td>:</td>
				<td><input type="text" name="pengarang" id="pengarang" class="ui-widget ui-widget-content padding ui-corner-all"></td>
			</tr>
			<tr>
				<td>Tahun terbit</td>
				<td>:</td>
				<td><input type="text" onkeypress="return isNumberKey(event)" name="tahun" size="4" maxlength="4" id="tahun" class="ui-widget ui-widget-content padding ui-corner-all" style="text-align: center"></td>
			</tr>
			<tr>
				<td>Penerbit</td>
				<td>:</td>
				<td><input type="text" name="penerbit" id="penerbit" class="ui-widget ui-widget-content padding ui-corner-all"></td>
			</tr>
			<tr>
				<td colspan="3" align="center"><input type="button" value="Save" name="submit" id="submit" /><input type="reset" name="reset" id="reset" value="reset" /></td>
			</tr>
		</table>								
	</form>
</fieldset>