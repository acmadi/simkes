<html>
	<head>
	<title></title>
        <script type="text/javascript">
            var downloadbulan, downloadtahun;

            function setbulandownload()
            {
                downloadbulan = $("#downloadbulan").val();
            }

            function settahundownload()
            {
                downloadtahun = $("#downloadtahun").val();
            }

            $("#tomboldownload").click(function()
            {
               
                $.ajax({
                    url : "<?php base_url()?>laporan/download/tes/",
                    type: "post",
                    data : "bulan="+downloadbulan+"&tahun="+downloadtahun,
                    cache : false,
                    success : function($pesan)
                    {
                        //$("#downloadfile").html($pesan);
                        if($pesan=="")
                            {
                                alert("File Belum Diupload");
                            }
                        else
                            {
                            window.location.href="<?php base_url()?>laporan/download/do_download/"+$pesan;
                            }
                    }
                });
            });
        </script>
	</head>

	<body>

    <div id="content">

		<!--<img id="<?php echo $id_loading;?>" src="loading.gif" style="display:none;">
                -->
               <table cellpadding="0" cellspacing="0" class="tableForm">
                
                        <tr>
                            <td>Bulan<td>
                            <td>:<td>
                            <td>
                                <select id="downloadbulan"  onchange="setbulandownload();">
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
                                <select id="downloadtahun"  onchange="settahundownload();">
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
                        
			
                            	<tr>
                                <td><td>
                                <td><td>
                                <td>
                                <input type="button" value="Bismillah" id="tomboldownload"/>
                                </td>
                                </tr>
		

	</table>
               
    </div>
            <div id="downloadfile"></div>
	</body>
</html>