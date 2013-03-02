<html>
	<head>
	<title></title>
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
        var month = "januari" ;
        var year = "2012" ;

                function setuploadbulan()
                {
                 month = $("#uploadbulan").val();

                }

                function setuploadtahun()
                {
                 year = $("#uploadtahun").val();

                }
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
				data:{bulan:month, tahun:year},
				success: function (data)
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
              
		<form name="form" action="" method="POST" enctype="multipart/form-data">
		<table cellpadding="0" cellspacing="0" class="tableForm">
                
                        <tr>
                            <td>Bulan<td>
                            <td>:<td>
                            <td>
                                <select id="uploadbulan" onchange="setuploadbulan();">
                        <option value="" selected>Pilih Bulan</option>
                        <option value="Januari">Januari</option>
                        <option value="Februari">Februari</option>
                        <option value="Maret">Maret</option>
                        <option value="April">April</option>
                        <option value="Mei">Mei</option>
                        <option value="Juni">Juni</option>
                        <option value="Juli">Juli</option>
                        <option value="Agustus">Agustus</option>
                        <option value="September">September</option>
                        <option value="Oktober">Oktober</option>
                        <option value="November">November</option>
                        <option value="Desember">Desember</option>
                        </select>
                        </td>

                        </tr>
                        <tr>
                            <td>Tahun<td>
                            <td>:<td>
                            <td>
                                <select id="uploadtahun" onchange="setuploadtahun();" >
                            <option value=''> - </option>
                            <?php
                            $tahun=date('Y');
                            for($i=2011;$i<=$tahun;$i++)
                            {?>
                            <option value="<?php echo $i;?>">
                            <?php	echo $i; ?></option>

                            <?php
                            }
                            ?>
                            </select>
                        </td>

                        </tr>
                        
			<tr><td><td>
                            <td><td>
				<td><input id="<?php echo $id_file;?>" type="file" name="uploaddata" class="input"></td>
                        </tr>
                            	<tr>
                                <td><td>
                                <td><td>
                                <td><button class="button" id="buttonUpload" onclick="return <?php echo $namafungsi;?>;">Upload</button></td>
				</tr>
		

	</table>
		</form>
    </div>
            <div id="<?php echo $id_isi;?>">
    </div>


	</body>
</html>