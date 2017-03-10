<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link href="style/reset.css" media="screen" rel="stylesheet" type="text/css" />
	<link href="style/style.css" media="screen" rel="stylesheet" type="text/css" />
	<link rel="shortcut icon" type="image/ico" href="images/logo.ico" />
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

$query = "select distinct ctitle from GM_Toc";
$result = $db->query($query);
$num_rows = $result ? $result->num_rows : 0;

if($num_rows > 0)
{
    echo "<ul>";
    while($row = $result->fetch_assoc())
    {
        $ctitle = $row['ctitle'];
        
        $query1 = "select * from GM_Toc where ctitle = '$ctitle'";
        $result1 = $db->query($query1);
        $num_rows1 = $result1 ? $result1->num_rows : 0;
        
        if($num_rows1 > 0)
		{
			$row1 = $result1->fetch_assoc();
            $btitle = $row1['btitle'];
            $book_id = $row1['book_id'];
            $level = $row1['level'];
        
			$query2 = "select distinct book_id from GM_Toc where ctitle = '$ctitle'";
			$result2 = $db->query($query2);
			$num_rows2 = $result2 ? $result2->num_rows : 0;
			$volume_count = $num_rows2;
			//~ if(!($num_rows2 >=36))

			if($ctitle != $btitle)
			{
				echo "\n<li class=\"book_title\"><a href=\"granthagalu.php?ctitle=".urlencode($ctitle)."\">$ctitle&nbsp;(<span style=\"font-size: 0.85em;\">$volume_count</span>&nbsp;ಸಂಪುಟಗಳು)</a></li>";
			}
			else
			{
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
