<div>
    <table>
        <tr>
        <td>
            <h4>Biaya Kesehatan</h4>
                                <div id="chartpostbiaya">
				  This text is replaced by chart.
				</div>
				<script type="text/javascript">
				   var chartpostbiaya = new FusionCharts("<?php echo base_url();?>/asset/chart/FCF_Column2D.swf", "ChId1", "440", "400");
				   chartpostbiaya.setDataURL(escape("<?php echo base_url();?>index.php/laporan/executive/getKesehatan?bulan=<?php echo $bulan;?>&tahun=<?php echo $tahun;?>"));
				   chartpostbiaya.render("chartpostbiaya");
				</script>
        </td>
        <td>

        </td>
        </tr>
    </table>
</div>
