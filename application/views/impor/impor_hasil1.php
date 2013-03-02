<html>
	<head>
	<title>Ajax File Uploader Plugin For Jquery</title>
	<link href="ajaxfileupload.css" type="text/css" rel="stylesheet">
	<script type="text/javascript" src="<?php echo base_url()?>asset/js/ajaxfileupload.js"></script>
        <?php
        $id_loading="#loading_".$data;
        $id_file="upload".$data;
        $id_grid="#list".$data;
        $fungsi="ajaxImpor".$data;
        $id_isi="isi_".$data;
        $namafungsi=$fungsi."()";
        ?>
	<script type="text/javascript">
	function <?php echo $fungsi;?>()
	{
		$("<?php echo $id_loading;?>")
		.ajaxStart(function(){
			$(this).show();
		})
		.ajaxComplete(function(){
			$(this).hide();
		});

		$.ajaxFileUpload
		(
			{
                                url:'<?php echo base_url()?>/index.php/laporan/upload/do_impor',
				secureuri:false,
				fileElementId:'<?php echo $id_file;?>',
				dataType: 'json',
				//data:{name:'logan', id:'id'},
				success: function (data, status)
				{
					if(typeof(data.error) != 'undefined')
					{
						if(data.error != '')
						{
							
                                                        alert('data.error Semangat');
							alert(data.error);
                                                        var isi = document.getElementById("<?php echo $id_isi;?>");
                                                        isi.innerHTML = data.toSource();
						}
                                                else
						{
							alert('Berhasil Disimpan');
                                                        alert(data.pesan);
                                                        var isi = document.getElementById("<?php echo $id_isi;?>");
                                                        isi.innerHTML = data.toSource();
						}
					}
                                        $('<?php echo $id_grid;?>').trigger('reloadGrid'); //Triger Untuk Reload List JQGrid
                                        document.getElementById("<?php echo $id_file;?>").value = "";
				},
				error: function (data, e)
				{
					alert('Ayo jangan Patah Semangat');
					alert(e);
                                        var isi = document.getElementById("<?php echo $id_isi;?>");
                                        isi.innerHTML = data.toSource();
				}
			}
		)

		return false;

	}
	</script>
	</head>

	<body>

    <div id="content">

		<img id="<?php echo $id_loading;?>" src="loading.gif" style="display:none;">
                <?php echo $data;
                //echo $id_file;
                //echo $id_grid;
                ?>

		<form name="form" action="" method="POST" enctype="multipart/form-data">
		<table cellpadding="0" cellspacing="0" class="tableForm">

		<thead>
			<tr>
				<th>Please select a file and click Upload button</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td><input id="<?php echo $id_file;?>" type="file" size="45" name="uploaddata" class="input"></td>			</tr>

		</tbody>
			<tfoot>
				<tr>
					<td><button class="button" id="buttonUpload" onclick="return <?php echo $namafungsi;?>;">Upload</button></td>
				</tr>
			</tfoot>

	</table>
		</form>
    </div>
           <div id="<?php echo $id_isi;?>">
    </div>


	</body>
</html>