<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link href="style/reset.css" media="screen" rel="stylesheet" type="text/css" />    
	<link href="style/style.css" media="screen" rel="stylesheet" type="text/css" />
	<title>ಗ್ರಂಥಮಾಲಾ</title>
</head>

<body>
	<div class="page">
        <div class="header">
            <ul class="nav">
                <li><a class="nav_kan" href="../index.php">ಮುಖಪುಟ</a></li>
				<li>|</li>
                <li><a class="nav_kan" href="about.php">ಒಳನೋಟ</a></li>
				<li>|</li>
                <li><a class="nav_kan" href="anuvadakaru.php">ಅನುವಾದಕರ ಪಟ್ಟಿ</a></li>
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

$query = "select distinct ctitle from GM_Toc";
$result = mysql_query($query);
$num_rows = mysql_num_rows($result);

if($num_rows)
{
    echo "<ul>";
	for($i=1;$i<=$num_rows;$i++)
	{
		$row = mysql_fetch_assoc($result);
        $ctitle = $row['ctitle'];
        $query1 = "select * from GM_Toc where ctitle = '$ctitle'";
        $result1 = mysql_query($query1);
        $num_rows1 = mysql_num_rows($result1);

        if($num_rows1)
        {
            $row1 = mysql_fetch_assoc($result1);
            $btitle = $row1['btitle'];
            $book_id = $row1['book_id'];
            $level = $row1['level'];
            if($ctitle != $btitle)
            {
                 
                echo "<li class=\"book_title\"><a href=\"granthagalu.php?ctitle=".replace_space($ctitle)."\">$ctitle</a></li>";
            }
            else
            {
                if($level == 0)
                {
                    echo "<li class=\"book_title\"><a href=\"../Volumes/$book_id/index.djvu\" target=\"_blank\">$btitle</a></li>\n";
                }
                else
                {
                    echo "<li class=\"book_title\"><a href=\"treeview.php?book_id=$book_id\">$btitle</a></li>\n";
                }
            }
        }
    }
    echo "</ul>";
}     
mysql_close($db);

function replace_space($str)
{
   $str = preg_replace('/ /', "%20", $str);
   return $str;
}
?> 
		</div>
        <div id="footer">
			<div class="terms"><p><a href="#">Terms of Use</a>&nbsp;|&nbsp;<a href="#">Privacy Policy</a>&nbsp;|&nbsp;<a href="#">Contact Us</a></p></div>
			<div class="copyright"><p><a href="http://www.srirangadigital.com">Copyright &copy; Sriranga Digital Software Technologies Pvt. Ltd.</a></p></div>
        </div>
    </div>
</body>
</html>
