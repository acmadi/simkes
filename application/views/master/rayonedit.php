<script type="text/javascript">
	$(document).ready(function(){
		//Mempercantik Button dengan Jquery UI
		$("#submit").button();
		$("#reset").button();
	});
</script>
<?php
	$db = mysql_connect("localhost","root","pandalu");
    $con = mysql_select_db("simdak",$db);
    if(!$con){
       echo "Something Problem";
    }
	$id=$_GET['id'];
	$query=mysql_query('SELECT * FROM simdak WHERE id='.$id);
	$row=mysql_fetch_array($query);
?>
<fieldset>
	<legend>Edit Data</legend>
	<form method="post" action="<?php echo base_url() ?>index.php/master/rayon/crud" name="form1" id="form1">
		<input type="hidden" name="id" value="<?php echo $row['id'] ?>">
		<input type="hidden" name="oper" value="edit">
		<table border="0" cellpadding="3" cellspacing="0">
			<tr>
				<td>Nama Rayon</td>
				<td>:</td>
				<td><input type="text" value="<?php echo $row['nama_rayon'] ?>" name="nama" id="nama" class="ui-widget ui-widget-content padding ui-corner-all"></td>
			</tr>
                        <tr>
                            <td>Wilayah</td>
				<td>:</td>
                                <td>
				<select>
				<option></option>
				</select>
                                </td>
                        </tr>
				
			<tr>
				<td colspan="3" align="center"><input type="button" value="Update" name="submit" id="submit" /><input type="reset" name="reset" id="reset" value="reset" /></td>
			</tr>
		</table>								
	</form>
</fieldset>