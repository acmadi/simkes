<html>
<head>
<title>Welcome to CodeIgniter</title>
<script type="text/javascript" src="<?php echo base_url();?>/asset/js/FusionCharts.js"></script>

</head>
<body>

<div id="chart1Div">
				  This text is replaced by chart.
				</div>
				<script type="text/javascript">
				   var chart1 = new FusionCharts("<?php echo base_url();?>/asset/chart/FCF_Column2D.swf", "ChId1", "440", "400");
				   chart1.setDataURL("<?php echo base_url();?>/data impor/ItemsSold.xml");
				   chart1.render("chart1Div");
				</script>
</body>
</html>
