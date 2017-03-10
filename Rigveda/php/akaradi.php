<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link href="style/reset.css" media="screen" rel="stylesheet" type="text/css" />	
	<link href="style/style.css" media="screen" rel="stylesheet" type="text/css" />
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
			<table class="ptab">
				<tr>
					<td class="level1">
						<div class="letter"><a href='akaradi.php?letter=ಅ'>ಅ</a></div>
						<div class="letter"><a href='akaradi.php?letter=ಆ'>ಆ</a></div>
						<div class="letter"><a href='akaradi.php?letter=ಇ'>ಇ</a></div>
						<div class="letter"><a href='akaradi.php?letter=ಈ'>ಈ</a></div>
						<div class="letter"><a href='akaradi.php?letter=ಉ'>ಉ</a></div>
						<div class="letter"><a href='akaradi.php?letter=ಊ'>ಊ</a></div>
						<div class="letter"><a href='akaradi.php?letter=ಋ'>ಋ</a></div>
						<div class="letter"><a href='akaradi.php?letter=ಎ'>ಎ</a></div>
						<div class="letter"><a href='akaradi.php?letter=ಏ'>ಏ</a></div>
						<div class="letter"><a href='akaradi.php?letter=ಐ'>ಐ</a></div>
						<div class="letter"><a href='akaradi.php?letter=ಒ'>ಒ</a></div>
						<div class="letter"><a href='akaradi.php?letter=ಓ'>ಓ</a></div>
						<div class="letter"><a href='akaradi.php?letter=ಔ'>ಔ</a></div>
						<div class="letter"><a href='akaradi.php?letter=ಕ'>ಕ</a></div>
						<div class="letter"><a href='akaradi.php?letter=ಖ'>ಖ</a></div>
						<div class="letter"><a href='akaradi.php?letter=ಗ'>ಗ</a></div>
						<div class="letter"><a href='akaradi.php?letter=ಘ'>ಘ</a></div>
					</td>
				</tr>
				<tr>
					<td class="level2">
						<div class="letter"><a href='akaradi.php?letter=ಚ'>ಚ</a></div>
						<div class="letter"><a href='akaradi.php?letter=ಛ'>ಛ</a></div>
						<div class="letter"><a href='akaradi.php?letter=ಜ'>ಜ</a></div>
						<div class="letter"><a href='akaradi.php?letter=ತ'>ತ</a></div>
						<div class="letter"><a href='akaradi.php?letter=ದ'>ದ</a></div>
						<div class="letter"><a href='akaradi.php?letter=ಧ'>ಧ</a></div>
						<div class="letter"><a href='akaradi.php?letter=ನ'>ನ</a></div>
						<div class="letter"><a href='akaradi.php?letter=ಪ'>ಪ</a></div>
						<div class="letter"><a href='akaradi.php?letter=ಫ '>ಫ</a></div>
						<div class="letter"><a href='akaradi.php?letter=ಬ'>ಬ</a></div>
						<div class="letter"><a href='akaradi.php?letter=ಭ'>ಭ</a></div>
						<div class="letter"><a href='akaradi.php?letter=ಮ'>ಮ</a></div>
						<div class="letter"><a href='akaradi.php?letter=ಯ'>ಯ</a></div>
						<div class="letter"><a href='akaradi.php?letter=ರ'>ರ</a></div>
						<div class="letter"><a href='akaradi.php?letter=ವ'>ವ</a></div>
						<div class="letter"><a href='akaradi.php?letter=ಶ'>ಶ</a></div>
						<div class="letter"><a href='akaradi.php?letter=ಷ'>ಷ</a></div>
						<div class="letter"><a href='akaradi.php?letter=ಸ'>ಸ</a></div>
						<div class="letter"><a href='akaradi.php?letter=ಹ'>ಹ</a></div>
						<div class="letter"><a href='akaradi.php?letter=ಕ್ಷ '>ಕ್ಷ </a></div>
					</td>
				</tr>
		</table>
		<div class="rule">&nbsp;</div>
		<div class="main">
			

<?php
include("connect.php");
include("common.php");

$letter = $_GET['letter'];

echo "<div class=\"letterspan\">$letter</div>";

$query1 = "SELECT * from akaradi_table where akaradi like '$letter%'";

$result1 = $db->query($query1);
$num_rows1 = $result1 ? $result1->num_rows : 0;

if($num_rows1 > 0)
{
	echo "<ul>";
	while($row1 = $result1->fetch_assoc())
	{
		$word =$row1['akaradi'];
		$id = $row1['akaradi_id'];

		$query2 = "SELECT * FROM akaradi_index where akaradi_id = '$id'";
		$result2 = $db->query($query2);
		$num_rows2 = $result2 ? $result2->num_rows : 0;
		
		if($num_rows2 > 0)
		{
			while($row2 = $result2->fetch_assoc())
			{
				$vol_no = $row2['volume'];
				$page_num = $row2['page'];

				if($page_num < 10)
				{
					$page_no = "000".$page_num;
				}
				elseif($page_num < 100)
				{
					$page_no = "00".$page_num;
				}
				elseif($page_num < 1000)
				{
					$page_no = "0".$page_num;
				}
				else
				{
					$page_no = $page_num;
				}
				if($vol_no < 10)
				{
					$vnum = "00" . $vol_no;
				}
				else
				{
					$vnum = "0" . $vol_no;
				}
				$vnum = get_rigBookid($vnum);
				echo "<li class=\"mantra\"><a href=\"../../Volumes/$vnum/index.djvu?djvuopts&amp;page=$page_no.djvu\" target=\"_blank\">$word</a></li>";
			}
		}
	}
	echo "</ul>";
}
if($result1){$result1->free();}
$db->close();

?>
	
	</div>
	</div>
	</div>
</body>
</html>
