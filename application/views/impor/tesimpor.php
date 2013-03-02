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
				url:'./hasil/<?php echo $data;?>/do_impor',
				secureuri:false,
				fileElementId:'<?php echo $id_file;?>',
				dataType: 'json',
				//data:{name:'logan', id:'id'},
				success: function (data)
				{
					if(typeof(data.error) != 'undefined')
					{
						if(data.error != '')
						{
							alert('Semangat Mas Bro');
                                                        alert('data.error');
							alert(data.error);
						}
                                                else
						{
							alert('data.msg'+data.msg);

							alert('data.pesan = '+data.pesan);
                                                        var datafile= document.getElementById("isitesimpor");
                                                        datafile.innerHTML = data.toSource();
							alert('data.aha = '+data.aha);
						}
					}
                                        $('<?php echo $id_grid;?>').trigger('reloadGrid'); //Triger Untuk Reload List JQGrid
                                        document.getElementById("<?php echo $id_file;?>").value = "";
				},
				error: function (data, status, e)
				{
					alert('Ayo jangan Patah Semangat');
					alert(e);

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
                echo $id_file;
                echo $id_grid;
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
				<td><input id="<?php echo $id_file;?>" type="file" size="45" name="<?php echo $id_file;?>" class="input"></td>			</tr>

		</tbody>
			<tfoot>
				<tr>
					<td><button class="button" id="buttonUpload" onclick="return <?php echo $namafungsi;?>;">Upload</button></td>
				</tr>
			</tfoot>

	      </table>
		</form>
    </div>
    <div id="isitesimpor">
        
    </div>

	</body>
</html>