<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link href="style/reset.css" media="screen" rel="stylesheet" type="text/css" />    
	<link href="style/style.css" media="screen" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="js/jquery-2.0.0.min.js" charset="UTF-8"></script>
	<script type="text/javascript" src="js/treeview.js"></script>   
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
                <li><a class="active nav_kan" href="purana_list.php">ಸಂಗ್ರಹ</a></li>
                <li>|</li>
                <li><a class="nav_kan" href="search.php">ಹುಡುಕಿ</a></li>
            </ul>
        </div>
        <div class="heading">ಗ್ರಂಥಗಳು</div>
        <div class="mainbody">

<?php
include("connect.php");

$ctitle = $_GET['ctitle'];

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

$query = $db->query("select distinct book_id, btitle from GM_Toc where ctitle = '$ctitle'");
$count = $query->rowCount();
if($count)
{
    echo "<ul>";
    while($row = $query->fetch(PDO::FETCH_OBJ))
    {
        $book_id = $row->book_id;
        $btitle = $row->btitle;
        $btitle = preg_replace('/-/'," &ndash; ", $btitle);

        $query1 = $db->query("select * from GM_Toc where book_id = '$book_id'");
        $row1 = $query1->fetch(PDO::FETCH_OBJ);
        $level = $row1->level;
        if($level == 0)
        {
            echo "\n<li class=\"book_title\"><a href=\"../Volumes/$book_id/index.djvu\" target=\"_blank\">$btitle</a></li>";
        }
        else
        {
            echo "\n<li class=\"book_title\"><a href=\"treeview.php?book_id=$book_id\">$btitle</a></li>";
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
