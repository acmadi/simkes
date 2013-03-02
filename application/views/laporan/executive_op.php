<div>
    <table>
        <tr>
        
        <td>
            <h4>Sepuluh Besar Penyakit</h4>
                                <div id="chartpenyakitterbanyak">
				  This text is replaced by chart.
				</div>
				<script type="text/javascript">
				   var chartpenyakitterbanyak = new FusionCharts("<?php echo base_url();?>/asset/chart/FCF_Column2D.swf", "ChId1", "440", "400");
				   chartpenyakitterbanyak.setDataURL(escape("<?php echo base_url();?>index.php/laporan/executive/getPenyakit?bulan=<?php echo $bulan;?>&tahun=<?php echo $tahun;?>"));
				   chartpenyakitterbanyak.render("chartpenyakitterbanyak");
				</script>
        </td>
        <td>
            <h4>Sepuluh Besar Pemakaian Obat</h4>
                                <div id="chartobatterbanyak">
				  This text is replaced by chart.
				</div>
				<script type="text/javascript">
				   var chartobatterbanyak = new FusionCharts("<?php echo base_url();?>/asset/chart/FCF_Column2D.swf", "ChId1", "440", "400");
				   chartobatterbanyak.setDataURL(escape("<?php echo base_url();?>index.php/laporan/executive/getObat?bulan=<?php echo $bulan;?>&tahun=<?php echo $tahun;?>"));
				   chartobatterbanyak.render("chartobatterbanyak");
				</script>
        </td>
        </tr>
    </table>
</div>
