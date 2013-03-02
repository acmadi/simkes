

        <form id="sheet" method="post" action="<?php echo base_url() ?>index.php/laporan/bulanan/laporanbulanan">
            <table>
            <tr>
            <td>Pilih Bulan</td>
            <td>:</td>
            <td><select id="laporanbulanan_bulan" name="bulan">
                    <option value="1">Januari</option>
                    <option value="2">Februari</option>
                    <option value="3">Maret</option>
                    <option value="4">April</option>
                    <option value="5">Mei</option>
                    <option value="6">Juni</option>
                    <option value="7">Juli</option>
                    <option value="8">Agustus</option>
                    <option value="9">September</option>
                    <option value="10">Oktober</option>
                    <option value="11">November</option>
                    <option value="12">Desember</option>
                </select></td>
            </tr>
            <tr>
              <td>Pilih Bulan</td>
            <td>:</td><td>
                <select id="laporanbulanan_tahun" name="tahun">
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
                </select></td>
            
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td><input type="submit" value="export" /></td>
            </tr>
            </table>
        </form>
   
