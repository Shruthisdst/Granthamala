<?php
require_once("html/connect.php");

$query = "select distinct book_id from GM_Toc order by book_id";
$result = $db->query($query); 
$num_rows = $result ? $result->num_rows : 0;

for($i=1;$i<=$num_rows;$i++)
{
	$row = $result->fetch_assoc();
	$book_id = $row['book_id'];
	$filename = "html/treeview_" . $book_id . ".html";
	$cmd = 'wget "http://localhost/grm/html/treeview.php?book_id=' . $book_id . '" --output-document=' . $filename . ' --quiet';
	system($cmd);
}
?>
