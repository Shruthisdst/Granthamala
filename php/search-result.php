<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link href="style/reset.css" media="screen" rel="stylesheet" type="text/css" />
	<link href="style/style.css" media="screen" rel="stylesheet" type="text/css" />
	<link rel="shortcut icon" type="image/ico" href="images/logo.ico" />
    <script type="text/javascript" src="js/jquery-2.0.0.min.js" charset="UTF-8"></script>
	<script type="text/javascript" src="js/kannada_kbd.js" charset="UTF-8"></script>
	<script type="text/javascript" src="js/scripts.js" charset="UTF-8"></script>
	<title>ಗ್ರಂಥರತ್ನಮಾಲಾ</title>
</head>

<body>
	<div class="page">
        <div class="header">
            <ul class="nav">
                <li><a class="nav_kan" href="../index.php">ಮುಖಪುಟ</a></li>
				<li>|</li>
				<li><a class="nav_kan" href="granthamala.php">ಗ್ರಂಥರತ್ನಮಾಲಾ</a></li>
				<li>|</li>
                <li><a class="nav_kan" href="about.php">ಒಳನೋಟ</a></li>
				<li>|</li>
                <li><a class="nav_kan" href="anuvadakaru.php">ಅನುವಾದಕರ ಪಟ್ಟಿ</a></li>
				<li>|</li>
                <li><a class="nav_kan" href="purana_list.php">ಸಂಗ್ರಹ</a></li>
				<li>|</li>
                <li><a class="active nav_kan" href="search.php">ಹುಡುಕಿ</a></li>
            </ul>
        </div>
        <div class="heading">ಶ್ರೀ ಜಯಚಾಮರಾಜೇಂದ್ರ   ಗ್ರಂಥರತ್ನಮಾಲಾ</div>
        <div class="mainbody">

<?php

include("connect.php");

$bl = $_POST['bl'];
$toc_title = $_POST['text'];

$toc_title = rtrim($toc_title);
$toc_title = preg_replace("/[ ]+/", " ", $toc_title);
$toc_title = preg_replace("/^ /", "", $toc_title);
$toc_title = preg_replace("/ $/", "", $toc_title);

if($toc_title=='')
{
	$toc_title='. *';
}

$btitle = $toc_title;

if($bl == "toctitle")
{
    $toctitle = $toc_title;
    $toctitle = rtrim($toctitle);
    $tx1 = preg_split('/ /',$toctitle);
    $text1 = '';
    $i1 = 1;    

    foreach($tx1 as $val1)
    {
		if($i1 > 1)
		{
			$text1 = $text1."|".$val1;
		}
		else
		{
			$text1 = $text1."".$val1;
		}

		$i1++;
	}
	$toctitle = $text1;
    #echo $toctitle;
    $query = "select * from GM_Toc where title REGEXP '$toctitle|$toc_title'";
    #echo $query;
}


if($bl == "btitle")
{
    $book = preg_replace("/[ ]+/", " ", $btitle);
    $book = preg_replace("/ $/", "", $book);
    $book = preg_replace("/^ /", "", $book);

    $query = "select distinct btitle, book_id from GM_Toc where btitle REGEXP '$book'";
    #echo $query;
}

$result = $db->query($query);
$num_rows = $result ? $result->num_rows : 0;

$b_id = 0;
$book_title = 1;
if ($num_rows > 0)
{
	echo "<span class=\"search-result\">ಫಲಿತಾಂಶಗಳು &#8212; $num_rows</span>";
}
if($num_rows)
{
	echo "<ul class=\"book_list\">";
    while($row = $result->fetch_assoc())
    {
        if($bl == "btitle")
        {
            $book_id = $row['book_id'];
            $btitle = $row['btitle'];
            
			$query1 = "select * from GM_Toc where book_id = $book_id";
			$result1 = $db->query($query1);
			$num_rows1 = $result1 ? $result1->num_rows : 0;
			if($num_rows1 > 0)
            {
                $row1 = $result1->fetch_assoc();
                
                $title = $row1['title'];
                $level = $row1['level'];
                $pages = $row1['start_pages'];

                $btitle = preg_replace('/-/'," &ndash; ", $btitle);
                $btitle = preg_replace("/$book/", "<span style=\"color: red\">$book</span>", $btitle);

                if($b_id != $book_id)
                {
                    if($level != 0)
                    {
                        echo "\n<li class=\"title_list\"><a href=\"treeview.php?book_id=$book_id\">$btitle</a></li>";
                        $b_id = $book_id;
                    }
                    else
                    {
                        echo "\n<li class=\"title_list\"><a href=\"../Volumes/$book_id/index.djvu\" target=\"_blank\">$btitle</a></li>";
                        $b_id = $book_id;
                    }
                }
            }

        }
        elseif($bl == "toctitle")
        {
            $book_id = $row['book_id'];
            $btitle = $row['btitle'];
            $title = $row['title'];
            $level = $row['level'];
            $pages = $row['start_pages'];
            
            $btitle = preg_replace('/-/'," &ndash; ", $btitle);
            $title = preg_replace('/-/'," &ndash; ", $title);
            if($book_title != $btitle)
            {
                echo "\n<li class=\"booktitle\">$btitle</li>";
                $book_title = $btitle;
            }
            $title = preg_replace("/$toc_title/", "<span style=\"color: red\">$toc_title</span>", $title);
            $toc = preg_split('/\|/',$toctitle);
            foreach($toc as $t_title)
            {
                $title = preg_replace("/$t_title/", "<span style=\"color: red\">$t_title</span>", $title);
            }

            echo "\n<li class=\"title_list\"><a href=\"../Volumes/$book_id/index.djvu?djvuopts&amp;page=$pages.djvu&amp;zoom=page\" target=\"_blank\">$title</a></li>";
        }
    }
    echo "</ul>";
}
else
{
	echo"<div class=\"goback\">ಫಲಿತಾಂಶಗಳು ಲಭ್ಯವಿಲ್ಲ</div>";
	echo"<div class=\"goback\"><a href=\"search.php\">ಹಿಂದಿನ ಪುಟಕ್ಕೆ ಹೋಗಿ ಮತ್ತೆ ಪ್ರಯತ್ನಿಸಿ</a></div>";
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
