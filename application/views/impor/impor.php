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
				url:'./master/<?php echo $data;?>/do_impor',
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
							
                                                        alert("Undefined Gagal Impor");
                                                        alert(data.error);
                                                        alert(data.pesan);
                                                        alert(data.isi);
                                                        var isi= document.getElementById("isiimpor");
                                                        isi.innerHTML = data.toSource();
						}
                                                else
						{
							//alert('data.msg'+data.msg);
                                                        alert('Berhasil Impor');
							//alert('data.pesan = '+data.pesan);
                                                        //var isi= document.getElementById("isiimpor");
                                                        //isi.innerHTML = data.toSource();
						}
					}
                                        $('<?php echo $id_grid;?>').trigger('reloadGrid'); //Triger Untuk Reload List JQGrid
                                        document.getElementById("<?php echo $id_file;?>").value = "";
				},
				error: function (data, e)
				{
					alert('Gagal Impor');
					alert(e);
                                        alert(data.error)
                                        var isi= document.getElementById("isiimpor");
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

		<img id="<?php echo $id_loading;?>" src="<?php echo base_url();?>asset/images/loading.gif" style="display:none;">
               
		<form name="form" action="" method="POST" enctype="multipart/form-data">
		<table cellpadding="0" cellspacing="0" class="tableForm">

		<thead>
			<tr>
				<th>Please select a file and click Upload button</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td><input id="<?php echo $id_file;?>" type="file" name="<?php echo $id_file;?>" class="input"></td>			</tr>

		</tbody>
			<tfoot>
				<tr>
					<td><button class="button" id="buttonUpload" onclick="return <?php echo $namafungsi;?>;">Upload</button></td>
				</tr>
			</tfoot>

	      </table>
		</form>
    </div>
    <div id="isiimpor">
        
    </div>

	</body>
</html>