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
        <div class="mainbody">
            
<?php
include("connect.php");

$book_id = $_GET['book_id'];

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

$stack = array();
$p_stack = array();
$first = 1;
$flag = 1;
$li_id = 0;
$ul_id = 0;

$plus_link = "<img src=\"images/plus.gif\" alt=\"\" onclick=\"display_block(this)\" />";
//$plus_link = "<a href=\"#\" onclick=\"display_block(this)\"><img src=\"plus.gif\" alt=\"\"></a>";
$bullet = "<img src=\"images/bullet_1.gif\" alt=\"\" />";

$query = $db->query("select * from GM_Toc where book_id='$book_id'");
$count = $query->rowCount();
if($count)
{
    echo "<div class=\"treeview\">";
    while($row = $query->fetch(PDO::FETCH_OBJ))
    {
        $book_id = $row->book_id;
        $btitle = $row->btitle;
        $title = $row->title;
        $level = $row->level;
        $pages = $row->start_pages;
           
        $btitle = preg_replace('/-/'," &ndash; ", $btitle);
        $btitle = preg_replace('/—/'," &mdash; ", $btitle);
        if($flag)
        {
            echo "<div class=\"book\">$btitle</div>";
            echo "<div class=\"starting_page\"><a href=\"../Volumes/$book_id/index.djvu\" target=\"_blank\">ಆರಂಭಿಕ ಪುಟ</a></div>";
            echo "<div class=\"toc_title\">ವಿಷಯಾನುಕ್ರಮಣಿಕೆ</div>";
            $flag = 0;
        }
        $title = preg_replace('/—/',"",$title);
        $title = preg_replace('/-/'," &ndash; ", $title);
        if($first)
        {
            array_push($stack,$level);
            $ul_id++;
            echo "<ul id=\"ul_id$ul_id\">\n";
            array_push($p_stack,$ul_id);
            $li_id++;
            $deffer = display_tabs($level) . "<li id=\"li_id$li_id\">:rep:<span class=\"s1\"><a href=\"../Volumes/$book_id/index.djvu?djvuopts&amp;page=$pages.djvu&amp;zoom=page\" target=\"_blank\">$title</a></span>";
            $first = 0;
        }
        elseif($level > $stack[sizeof($stack)-1])
        {
            $deffer = preg_replace('/:rep:/',"$plus_link",$deffer);
            echo $deffer;
            $ul_id++;
            $li_id++;
            array_push($stack,$level);
            array_push($p_stack,$ul_id);
            $deffer = "\n" . display_tabs(($level-1)) . "<ul class=\"dnone\" id=\"ul_id$ul_id\">\n";
            $deffer = $deffer . display_tabs($level) ."<li id=\"li_id$li_id\">:rep:<span class=\"s2\"><a href=\"../Volumes/$book_id/index.djvu?djvuopts&amp;page=$pages.djvu&amp;zoom=page\" target=\"_blank\">$title</a></span>";
        }
        elseif($level < $stack[sizeof($stack)-1])
        {
            $deffer = preg_replace('/:rep:/',"$bullet",$deffer);
            echo $deffer;
            for($k=sizeof($stack)-1;(($k>=0) && ($level != $stack[$k]));$k--)
            {
                echo "</li>\n". display_tabs($level) ."</ul>\n";
                $top = array_pop($stack);
                $top1 = array_pop($p_stack);
            }
            $li_id++;
            $deffer = display_tabs($level) . "</li>\n";
            $deffer = $deffer . display_tabs($level) ."<li id=\"li_id$li_id\">:rep:<span class=\"s1\"><a href=\"../Volumes/$book_id/index.djvu?djvuopts&amp;page=$pages.djvu&amp;zoom=page\" target=\"_blank\">$title</a></span>";
        }
        elseif($level == $stack[sizeof($stack)-1])
        {
            $deffer = preg_replace('/:rep:/',"$bullet",$deffer);
            echo $deffer;
            $li_id++;
            $deffer = "</li>\n";
            $deffer = $deffer . display_tabs($level) ."<li id=\"li_id$li_id\">:rep:<span class=\"s1\"><a href=\"../Volumes/$book_id/index.djvu?djvuopts&amp;page=$pages.djvu&amp;zoom=page\" target=\"_blank\">$title</a></span>";
        }
    }
    $deffer = preg_replace('/:rep:/',"$bullet",$deffer);
    echo $deffer;

    for($i=0;$i<sizeof($stack);$i++)
    {
        echo "</li>\n". display_tabs($level) ."</ul>\n";
    }
    echo "</div>";
}
else
{
	echo"<div class=\"goback\">ಫಲಿತಾಂಶಗಳು ಲಭ್ಯವಿಲ್ಲ</div>";
}
function display_stack($stack)
{
	for($j=0;$j<sizeof($stack);$j++)
	{
		$disp_array = $disp_array . $stack[$j] . ",";
	}
	return $disp_array;
}

function display_tabs($num)
{
	$str_tabs = "";
	
	if($num != 0)
	{
		for($tab=1;$tab<=$num;$tab++)
		{
			$str_tabs = $str_tabs . "\t";
		}
	}
	
	return $str_tabs;
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
