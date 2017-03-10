<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link href="style/reset.css" media="screen" rel="stylesheet" type="text/css" />	
	<link href="style/style.css" media="screen" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="js/jquery-2.0.0.min.js" charset="UTF-8"></script>
	<script type="text/javascript" src="js/treeview.js"></script>
	<title>ಋಗ್ವೇದ ಸಂಹಿತಾ</title>
</head>

<body>
	<div class="page">
		<div class="header">
			<ul class="head">
				<li class="first">ಸಾಯಣ ಭಾಷ್ಯ ಸಮೇತಾ</li>
				<li class="heading">ಋಗ್ವೇದ ಸಂಹಿತಾ</li>
				<li class="sub_title">(ಕನ್ನಡ ಭಾಷಾರ್ಥ, ಅನುವಾದ, ವಿವರಣೆಗಳೊಡನೆ)</li>
			</ul>
			<ul class="nav">
				<li><a class="nav_kan" href="../index.php">ಮನೆ</a></li>
				<li><a class="nav_kan" href="../html/mandali.html">ಸಂಪಾದಕ ಮಂಡಳಿ</a></li>
				<li><a class="nav_kan" href="../html/parividi.html">ಪರಿವಿಡಿ</a></li>
				<li><a class="nav_kan" href="search.php">ಹುಡುಕಿ</a></li>
			</ul>
		</div>
		<div class="mainbody">
		
<?php
include("connect.php");
include("common.php");

$bookID = $_GET['book_id'];

$query = "select * from Rig_Toc where book_id='$bookID'";
$result = $db->query($query);
$num_rows = $result ? $result->num_rows : 0;

$query1 = "select btitle from Rig_Toc where book_id='$bookID'";
$result1 = $db->query($query1);
$num_rows1 = $result1 ? $result1->num_rows : 0;

if($num_rows1)
{
	$row1 = $result1->fetch_assoc();
	$btitle = $row1['btitle'];
	echo "<div class=\"book\">$btitle</div>";
}

$stack = array();
$p_stack = array();
$first = 1;

$li_id = 0;
$ul_id = 0;

$plus_link = "<img src=\"images/plus.gif\" alt=\"\" onclick=\"display_block(this)\" />";
//$plus_link = "<a href=\"#\" onclick=\"display_block(this)\"><img src=\"plus.gif\" alt=\"\"></a>";
$bullet = "<img src=\"images/bullet_1.gif\" alt=\"\" />";

if($num_rows > 0)
{
	echo "<div class=\"treeview\">";
	$bookID = get_rigBookid($bookID);
	echo "<div class=\"starting_page\"><a href=\"../../Volumes/$bookID/index.djvu\" target=\"_blank\">ಮುನ್ನುಡಿ</a></div>";
	while($row = $result->fetch_assoc())
	{
		$book_id = $row['book_id'];
		$book_id = get_rigBookid($book_id);
		$btitle = $row['btitle'];
		$title = $row['title'];
		$level = $row['level'];
		$pages = $row['start_pages'];
		
		$title = preg_replace('/—/'," &mdash; ",$title);
		$title = preg_replace('/--/', "&ndash;", $title);
		
		if($first)
		{
			array_push($stack,$level);
			$ul_id++;
			echo "<ul id=\"ul_id$ul_id\">\n";
			array_push($p_stack,$ul_id);
			$li_id++;
			$deffer = display_tabs($level) . "<li id=\"li_id$li_id\">:rep:<span class=\"s1\"><a href=\"../../Volumes/$book_id/index.djvu?djvuopts&amp;page=$pages.djvu&amp;zoom=page\" target=\"_blank\">$title</a></span>";
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
			$deffer = $deffer . display_tabs($level) ."<li id=\"li_id$li_id\">:rep:<span class=\"s2\"><a href=\"../../Volumes/$book_id/index.djvu?djvuopts&amp;page=$pages.djvu&amp;zoom=page\" target=\"_blank\">$title</a></span>";
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
			$deffer = $deffer . display_tabs($level) ."<li id=\"li_id$li_id\">:rep:<span class=\"s1\"><a href=\"../../Volumes/$book_id/index.djvu?djvuopts&amp;page=$pages.djvu&amp;zoom=page\" target=\"_blank\">$title</a></span>";
		}
		elseif($level == $stack[sizeof($stack)-1])
		{
			$deffer = preg_replace('/:rep:/',"$bullet",$deffer);
			echo $deffer;
			$li_id++;
			$deffer = "</li>\n";
			$deffer = $deffer . display_tabs($level) ."<li id=\"li_id$li_id\">:rep:<span class=\"s1\"><a href=\"../../Volumes/$book_id/index.djvu?djvuopts&amp;page=$pages.djvu&amp;zoom=page\" target=\"_blank\">$title</a></span>";
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
	echo "No data in the database";
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

if($result){$result->free();}
$db->close();

?>
	</div>
</div>
</body>
</html>
