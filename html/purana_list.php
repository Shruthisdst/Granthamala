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
                <li><a class="nav_kan" href="../index.html">ಮುಖಪುಟ</a></li>
				<li>|</li>
				<li><a class="nav_kan" href="granthamala.html">ಗ್ರಂಥರತ್ನಮಾಲಾ</a></li>
				<li>|</li>
                <li><a class="nav_kan" href="about.html">ಒಳನೋಟ</a></li>
				<li>|</li>
                <li><a class="nav_kan" href="anuvadakaru.html">ಅನುವಾದಕರ ಪಟ್ಟಿ</a></li>
				<li>|</li>
                <li><a class="active nav_kan" href="#">ಸಂಗ್ರಹ</a></li>
				<li>|</li>
                <li><a class="nav_kan" href="search.php">ಹುಡುಕಿ</a></li>
            </ul>
        </div>
        <div class="heading">ಗ್ರಂಥಗಳು</div>
        <div class="mainbody">

<?php
include("connect.php");

$db = mysql_connect("localhost",$user,$password) or die("Not connected to database");
$rs = mysql_select_db($database,$db) or die("No Database");
mysql_set_charset("utf8");

$query = "select distinct ctitle, cid from GM_Toc";
$result = mysql_query($query);
$num_rows = mysql_num_rows($result);

if($num_rows)
{
    echo "<ul>";
    for($i=1;$i<=$num_rows;$i++)
    {
        $row = mysql_fetch_assoc($result);
        $ctitle = $row['ctitle'];
        $cid = $row['cid'];
        
        $query1 = "select * from GM_Toc where cid = '$cid'";
        $result1 = mysql_query($query1);
        $num_rows1 = mysql_num_rows($result1);
        
         if($num_rows1)
        {
            $row1 = mysql_fetch_assoc($result1);
            $btitle = $row1['btitle'];
            $book_id = $row1['book_id'];
            $level = $row1['level'];
        
			$query2 = "select distinct book_id from GM_Toc where cid = '$cid'";
			$result2 = mysql_query($query2);
			$num_rows2 = mysql_num_rows($result2);
			$volume_count = $num_rows2;

			if($ctitle != $btitle)
			{
				echo "\n<li class=\"book_title\"><a href=\"volume_" . $cid .".html\">$ctitle&nbsp;(<span style=\"font-size: 0.85em;\">$volume_count</span>&nbsp;ಸಂಪುಟಗಳು)</a></li>";
			}
			else
			{
				if($level == 0)
				{
					echo "\n<li class=\"book_title\"><a href=\"../Volumes/$book_id/index.djvu\" target=\"_blank\">$btitle</a></li>";
				}
				else
				{
					echo "\n<li class=\"book_title\"><a href=\"toc_$book_id.html\">$btitle</a></li>";
				}
			}
		}
    }
    echo "</ul>";
}

?> 
		</div>
        <div id="footer">
			<div class="copyright"><p><a href="http://www.srirangadigital.com" target="_blank">Digitized by Sriranga Digital Software Technologies Pvt. Ltd.</a></p></div>
        </div>
    </div>
</body>
</html>
