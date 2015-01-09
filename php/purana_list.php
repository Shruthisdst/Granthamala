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

try
{
    $db = new PDO("mysql:host=localhost;dbname=".$database.";charset=utf8", $user, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e)
{
    echo $e->getMessage();
    die();
}

$query = $db->query("select distinct ctitle from GM_Toc");
$count = $query->rowCount();
if($count)
{
    echo "<ul>";
    while($row = $query->fetch(PDO::FETCH_OBJ))
    {
        $ctitle = $row->ctitle;
    
        $query1 = $db->query("select * from GM_Toc where ctitle = '$ctitle'");
        $row1 = $query1->fetch(PDO::FETCH_OBJ);
        
        $btitle = $row1->btitle;
        $book_id = $row1->book_id;
        $level = $row1->level;
        
        $query2 = $db->query("select distinct book_id from GM_Toc where ctitle = '$ctitle'");
        $volume_count = $query2->rowCount();

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
    echo "</ul>";
}
else
{
	echo"<div class=\"goback\">ಫಲಿತಾಂಶಗಳು ಲಭ್ಯವಿಲ್ಲ</div>";
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
