<div>
    <table>
        <tr>
        <td>
            <h4>Biaya Potret Kunjungan</h4>
                                <div id="chartpk">
				  This text is replaced by chart.
				</div>
				<script type="text/javascript">
				   var chartpk = new FusionCharts("<?php echo base_url();?>/asset/chart/FCF_Pie2D.swf", "ChId1", "440", "400");
				   chartpk.setDataURL(escape("<?php echo base_url();?>index.php/laporan/executive/getBiayapotretkunjungan?bulan=<?php echo $bulan;?>&tahun=<?php echo $tahun;?>"));
				   chartpk.render("chartpk");
				</script>
        </td>
        <td>
            <h4>Jumlah Potret Kunjungan</h4>
                                <div id="chartjmlpk">
				  This text is replaced by chart.
				</div>
				<script type="text/javascript">
				   var chartjmlpk = new FusionCharts("<?php echo base_url();?>/asset/chart/FCF_Pie2D.swf", "ChId1", "440", "400");
				   chartjmlpk.setDataURL(escape("<?php echo base_url();?>index.php/laporan/executive/getJumlahpotretkunjungan?bulan=<?php echo $bulan;?>&tahun=<?php echo $tahun;?>"));
				   chartjmlpk.render("chartjmlpk");
				</script>
        </td>
        </tr>
    </table>
</div>
