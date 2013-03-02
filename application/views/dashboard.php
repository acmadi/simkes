<table width="800" border="0" align="center">
			    <tr>
			      <td>
                                <h4>Pemakaian Obat Terbanyak</h4>
                                <div id="chartobatdiv">
				  This text is replaced by chart.
				</div>
				<script type="text/javascript">
				   var dashboardobatterbanyak = new FusionCharts("<?php echo base_url();?>/asset/chart/FCF_Column2D.swf", "ChId1", "440", "400");
				   dashboardobatterbanyak.setDataURL(escape("<?php echo base_url();?>index.php/laporan/executive/getObat?bulan=<?php echo $bulan;?>&tahun=<?php echo $tahun;?>"));
				   dashboardobatterbanyak.render("chartobatdiv");
				</script>
                              </td>
			      <td><h4>Penyakit Terbanyak</h4>
                                
                                <div id="chartpenyakitdiv">
				  This text is replaced by chart.
				</div>
				<script type="text/javascript">
				   var dashboardpenyakitterbanyak = new FusionCharts("<?php echo base_url();?>/asset/chart/FCF_Column2D.swf", "ChId1", "440", "400");
				   dashboardpenyakitterbanyak.setDataURL(escape("<?php echo base_url();?>index.php/laporan/executive/getPenyakit?bulan=<?php echo $bulan;?>&tahun=<?php echo $tahun;?>"));
				   dashboardpenyakitterbanyak.render("chartpenyakitdiv");
				</script>
                              </td>
		        </tr>
		      </table>

