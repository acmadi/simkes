<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>


</head>
<body>

	<?php foreach($data as $row):?>
	<h3><?php echo $row->id_karyawan;?></h3>
	<div><?php echo $row->nama_karyawan;?></div>
	<?php endforeach;?>

</body>
</html>