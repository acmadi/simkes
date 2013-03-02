<?php
//$nama = $_GET('nama');
$data[0]='DAK';
$data[1]='Rumah Sakit';
$data[2]='Klinik';
echo "{";
for($i=0;$i<3;$i++)
{
$q=$i+1;
if($i==2)
{
	echo ($q.":'".$data[$i]."'");
}
else
{
	echo ($q.":'".$data[$i]."',");
}
}
echo "}";
//echo "Bismillah";
?>
