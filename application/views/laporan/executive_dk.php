<div>
    <table>
        <tr>
        <td>
        <?php echo $tahun;?>
            <h4>Promotif, Preventif & Kuratif</h4>
                                <div id="chartobat">
				  This text is replaced by chart.
				</div>
				<script type="text/javascript">
				   var chartobat = new FusionCharts("<?php echo base_url();?>/asset/chart/FCF_Column2D.swf", "ChId1", "440", "400");
				   chartobat.setDataURL(escape("<?php echo base_url();?>index.php/laporan/executive/getPpk?bulan=<?php echo $bulan;?>&tahun=<?php echo $tahun;?>"));
				   chartobat.render("chartobat");
				</script>
        </td>
        <td>
            <h4>Potret Kunjungan</h4>
                                <div id="charttes">
				  This text is replaced by chart.
				</div>
				<script type="text/javascript">
				   var charttes = new FusionCharts("<?php echo base_url();?>/asset/chart/FCF_Column2D.swf", "ChId1", "440", "400");
				   charttes.setDataURL(escape("<?php echo base_url();?>index.php/laporan/executive/getPotretkunjungan"));
				   charttes.render("charttes");
				</script>
        </td>
        </tr>
    </table>
</div>
