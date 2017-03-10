<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link href="style/reset.css" media="screen" rel="stylesheet" type="text/css" />    
	<link href="style/style.css" media="screen" rel="stylesheet" type="text/css" />
	<link rel="shortcut icon" type="image/ico" href="images/logo.ico" />
	<script type="text/javascript" src="js/jquery-2.0.0.min.js" charset="UTF-8"></script>
	<script type="text/javascript" src="js/treeview.js"></script>   
	<title>ಗ್ರಂಥರತ್ನಮಾಲಾ</title>
</head>

<body>
	<div class="page">
        <div class="header">
            <ul class="nav">
                <li><a class="nav_kan" href="../index.php">ಮುಖಪುಟ</a></li>
				<li>|</li>
				<li><a class="nav_kan" href="list.php">ಗ್ರಂಥರತ್ನಮಾಲಾ</a></li>
				<li>|</li>
				<li><a class="nav_kan" href="../Rigveda/index.php" target="_blank">ಋಗ್ವೇದಸಂಹಿತಾ</a></li>
				<li>|</li>
                <li><a class="nav_kan" href="about.php">ಒಳನೋಟ</a></li>
				<li>|</li>
                <li><a class="nav_kan" href="anuvadakaru.php">ಅನುವಾದಕರ ಪಟ್ಟಿ</a></li>
				<li>|</li>
                <li><a class="nav_kan" href="search.php">ಹುಡುಕಿ</a></li>
            </ul>
        </div>
        <div class="heading">ಗ್ರಂಥಗಳು</div>
        <div class="mainbody">

<?php
include("connect.php");

$ctitle = $_GET['ctitle'];

$query = "select distinct book_id, btitle from GM_Toc where ctitle = '$ctitle'";
$result = $db->query($query);
$num_rows = $result ? $result->num_rows : 0;

if($num_rows > 0)
{
	echo "<ul>";
	while($row = $result->fetch_assoc())
	{
		$book_id = $row['book_id'];
        $btitle = $row['btitle'];
        $btitle = preg_replace('/-/'," &ndash; ", $btitle);

        $query1 = "select * from GM_Toc where book_id = '$book_id'";
        $result1 = $db->query($query1);
        $num_rows1 = $result1 ? $result1->num_rows : 0;
        if($num_rows1 > 0)
        {
            $row1 = $result1->fetch_assoc();
            $level = $row1['level'];
			if($level == 0)
			{
				echo "\n<li class=\"book_title\"><a href=\"../Volumes/$book_id/index.djvu\" target=\"_blank\">$btitle</a></li>";
			}
			else
			{
				echo "\n<li class=\"book_title\"><a href=\"treeview.php?book_id=$book_id\">$btitle</a></li>";
			}
		}
    }
    echo "</ul>";
}
if($result){$result->free();}
$db->close();
?>
        </div>
        <div id="footer">
			<div class="copyright"><p><a href="http://www.srirangadigital.com" target="_blank">Digitized by Sriranga Digital Software Technologies Pvt. Ltd.</a></p></div>
        </div>
    </div>
</body>
</html>
