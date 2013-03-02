<div>
    <table>
        <tr>
        <td>
            <h4>Rawat Jalan</h4>
                                <div id="chartrawatinap">
				  This text is replaced by chart.
				</div>
				<script type="text/javascript">
				   var chartrawatinap = new FusionCharts("<?php echo base_url();?>/asset/chart/FCF_Pie2D.swf", "ChId1", "440", "400");
				   chartrawatinap.setDataURL(escape("<?php echo base_url();?>index.php/laporan/executive/getRawatjalan?bulan=<?php echo $bulan;?>&tahun=<?php echo $tahun;?>"));
				   chartrawatinap.render("chartrawatinap");
				</script>
        </td>
        <td>
            <h4>Rawat Inap</h4>
                                <div id="chartrawatjalan">
				  This text is replaced by chart.
				</div>
				<script type="text/javascript">
				   var chartrawatjalan = new FusionCharts("<?php echo base_url();?>/asset/chart/FCF_Pie2D.swf", "ChId1", "440", "400");
				   chartrawatjalan.setDataURL(escape("<?php echo base_url();?>index.php/laporan/executive/getRawatinap?bulan=<?php echo $bulan;?>&tahun=<?php echo $tahun;?>"));
				   chartrawatjalan.render("chartrawatjalan");
				</script>
        </td>
        </tr>
    </table>
</div>
