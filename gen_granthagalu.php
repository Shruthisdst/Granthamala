<?php
require_once("html/connect.php");

$query = "select distinct ctitle, cid from GM_Toc order by ctitle";
$result = $db->query($query); 
$num_rows = $result ? $result->num_rows : 0;

for($i=1;$i<=$num_rows;$i++)
{
	$row = $result->fetch_assoc();
	$ctitle = $row['ctitle'];
	$cid = $row['cid'];
	$filename = "html/granthagalu_" . $cid . ".html";
	$cmd = 'wget "http://localhost/grm/html/granthagalu.php?cid=' . $cid . '" --output-document=' . $filename . ' --quiet';
	system($cmd);
}
?>
