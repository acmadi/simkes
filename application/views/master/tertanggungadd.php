<script type="text/javascript">
	$(document).ready(function(){
		//Mempercantik Button dengan Jquery UI
		$("#submit").button();
		$("#reset_tertanggung").button();
	});
        $("#tgl_lahir_tertanggung").datepicker({
            //dateFormat  : "dd MM yy",
            changeMonth: true,
            changeYear: true,
            showOn: "button",
            buttonImage : "<?php echo base_url();?>asset/images/calendar.gif",
            buttonImageOnly : true
	});

	$("#nama_penanggung").autocomplete({
            minLength: 1,
            source:
            function(requ, add){
              $.ajax({
                //url: "<?php echo base_url(); ?>index.php/transaksi/dokter/lookpegawai",
                url: "<?php echo base_url(); ?>index.php/master/tertanggung/lookpegawai",
                dataType: 'json',
                type: 'POST',
                data: requ,
                success:
                    function(data){
                        if(data.response =="true"){
                            add(data.message);

                            $("#id_karyawan_tertanggung").val(ui.item.id);
                        }else if(data.response =="false") {
                            $('.ui-autocomplete-loading').removeClass("ui-autocomplete-loading");
                       
                        }
                    }
              });
            },
            select:
                function(event, ui) {
                    $("#id_karyawan_tertanggung").val(ui.item.id);
                  
                }
        });
        function resettertanggung()
        {
            $("#nama_tertanggung").val("");
            $("#nama_penanggung").val("");
            $("#sex_tertanggung").val("");
            $("#tgl_lahir_tertanggung").val("");
            $("#ditanggung_tertanggung").val("");
            $("#status_tertanggung").val("");

        }
         function savetertanggung() {
            if ($('#nama_tertanggung').val() == '') {
                alert('Nama Tertanggung harus di isi');
                $('#nama_tertanggung').focus();
                return false;
            }
       $.ajax({
               url : $("#tertanggungadd").attr("action"),
               data : $("#tertanggungadd").serialize(),
               type: $("#tertanggungadd").attr("method"),
               success: function(data){
                   if (data!=null){
                      alert("Data tersimpan : "+data);
                     $('#listtertanggung').trigger('reloadGrid');
                     resettertanggung();
                   } else {
                       alert("gagal gan");
                   }
               },
               error: function(e){
                   alert("error : "+e)
               }
            });
            return false;
	};
	
</script>
<?php
//echo count($bagian);
//print_r($bagian);
//print_r($rayon);
//echo count($rayon);


?>
<fieldset>
	<legend>Add/Edit Data</legend>
	<form method="post" action="<?php echo base_url() ?>index.php/master/tertanggung/crud" name="tertanggungadd" id="tertanggungadd">
		<input type="hidden" name="oper" value="add">
		<table border="0" cellpadding="3" cellspacing="0">
			<tr>
				<td>Nama tertanggung</td>
				<td>:</td>
				<td><input type="text" name="nama_tertanggung" id="nama_tertanggung" class="ui-widget ui-widget-content padding ui-corner-all"></td>
			</tr>
                        <tr>
                                <td>Nama Karyawan</td>
                                <td>:</td>
                                <td><input type="input" id="nama_penanggung" name="nama_penanggung" class="ui-widget ui-widget-content padding ui-corner-all" />

                                </td>
                        </tr>
			
			<tr>
				<td>sex</td>
				<td>:</td>
				<td>
                                    <select name="sex_tertanggung" id="sex_tertanggung" class="ui-widget ui-widget-content padding ui-corner-all">
                                        <option value="l" >Laki-laki</option>
                                        <option value="p" >Perempuan</option>
                                    </select>
                                </td>
			</tr>
			
			<tr>
				<td>Tanggal Lahir</td>
				<td>:</td>
				<td><input type="text" name="tgl_lahir_tertanggung" id="tgl_lahir_tertanggung" class="ui-widget ui-widget-content padding ui-corner-all"></td>
			</tr>
			<tr>
				<td>Status</td>
				<td>:</td>
				<td>
                                    <select name="status_tertanggung" id="status_tertanggung" class="ui-widget ui-widget-content padding ui-corner-all">
                                        <option value="ybs">YBS</option>
                                        <option value="istri">Istri</option>
                                        <option value="anak">Anak</option>
                                    </select>
                                </td>
			</tr>
			<tr>
				<td>Ditanggung</td>
				<td>:</td>
				<td>
                                    <select name="ditanggung_tertanggung" id="ditanggung_tertanggung" class="ui-widget ui-widget-content padding ui-corner-all">
                                        <option value="y">Ya</option>
                                        <option value="t">Tidak</option>
                                    </select>
                                </td>
			</tr>
			<tr>
                        <input id="id_karyawan_tertanggung" type="hidden" name="id_karyawan_tertanggung" >
                        <input id="opertertanggung" type="hidden" name="oper" value="add">
                            <td colspan="3" align="center"><input type="button" value="Save" name="submit" id="submit" onclick="savetertanggung();" /><input type="reset" name="reset_tertanggung" id="reset_tertanggung" value="reset" /></td>
			</tr>
		</table>								
	</form>
</fieldset>