<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link href="style/reset.css" media="screen" rel="stylesheet" type="text/css" />
	<link href="style/style.css" media="screen" rel="stylesheet" type="text/css" />
	<link rel="shortcut icon" type="image/ico" href="images/logo.ico" />
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
						<div class="letter"><a href='mantra.php?letter=ಅ'>ಅ</a></div>
						<div class="letter"><a href='mantra.php?letter=ಆ'>ಆ</a></div>
						<div class="letter"><a href='mantra.php?letter=ಇ'>ಇ</a></div>
						<div class="letter"><a href='mantra.php?letter=ಈ'>ಈ</a></div>
						<div class="letter"><a href='mantra.php?letter=ಉ'>ಉ</a></div>
						<div class="letter"><a href='mantra.php?letter=ಊ'>ಊ</a></div>
						<div class="letter"><a href='mantra.php?letter=ಋ'>ಋ</a></div>
						<div class="letter"><a href='mantra.php?letter=ಏ'>ಏ</a></div>
						<div class="letter"><a href='mantra.php?letter=ಐ'>ಐ</a></div>
						<div class="letter"><a href='mantra.php?letter=ಓ'>ಓ</a></div>
						<div class="letter"><a href='mantra.php?letter=ಔ'>ಔ</a></div>
						<div class="letter"><a href='mantra.php?letter=ಕ'>ಕ</a></div>
						<div class="letter"><a href='mantra.php?letter=ಖ'>ಖ</a></div>
						<div class="letter"><a href='mantra.php?letter=ಗ'>ಗ</a></div>
						<div class="letter"><a href='mantra.php?letter=ಘ'>ಘ</a></div>
					</td>
				</tr>
				<tr>
					<td class="level2">
						<div class="letter"><a href='mantra.php?letter=ಚ'>ಚ</a></div>
						<div class="letter"><a href='mantra.php?letter=ಛ'>ಛ</a></div>
						<div class="letter"><a href='mantra.php?letter=ಜ'>ಜ</a></div>
						<div class="letter"><a href='mantra.php?letter=ತ'>ತ</a></div>
						<div class="letter"><a href='mantra.php?letter=ದ'>ದ</a></div>
						<div class="letter"><a href='mantra.php?letter=ಧ'>ಧ</a></div>
						<div class="letter"><a href='mantra.php?letter=ನ'>ನ</a></div>
						<div class="letter"><a href='mantra.php?letter=ಪ'>ಪ</a></div>
						<div class="letter"><a href='mantra.php?letter=ಬ'>ಬ</a></div>
						<div class="letter"><a href='mantra.php?letter=ಭ'>ಭ</a></div>
						<div class="letter"><a href='mantra.php?letter=ಮ'>ಮ</a></div>
						<div class="letter"><a href='mantra.php?letter=ಯ'>ಯ</a></div>
						<div class="letter"><a href='mantra.php?letter=ರ'>ರ</a></div>
						<div class="letter"><a href='mantra.php?letter=ವ'>ವ</a></div>
						<div class="letter"><a href='mantra.php?letter=ಶ'>ಶ</a></div>
						<div class="letter"><a href='mantra.php?letter=ಷ'>ಷ</a></div>
						<div class="letter"><a href='mantra.php?letter=ಸ'>ಸ</a></div>
						<div class="letter"><a href='mantra.php?letter=ಹ'>ಹ</a></div>
					</td>
				</tr>
			</table>
			<div class="rule">&nbsp;</div>
			<div class="main">

<?php
include("connect.php");
include("common.php");

$letter = $_GET['letter'];

$query1 = "SELECT * from Rukku_table where text1 like '$letter%'";
$result1 = $db->query($query1);
$num_rows1 = $result1 ? $result1->num_rows : 0;

echo "<div class=\"letterspan\">$letter</div>";

if($num_rows1 > 0)
{
	echo "<ul>";
	while($row1 = $result1->fetch_assoc())
	{
		$mantra = $row1['text1'];
		$mandala = $row1['mandala'];
		$sukta = $row1['sukta'];
		$rukku = $row1['rukku'];

		$query2 = "SELECT * from mandala_table where mandala = '$mandala' and sukta = '$sukta' and rukku = '$rukku'";
		$result2 = $db->query($query2);
		$num_rows2 = $result2 ? $result2->num_rows : 0;

		if($num_rows2 > 0)
		{
			$row2 = $result2->fetch_assoc();

			$page = $row2['page_no'];
			$vol = $row2['vol_no'];

			$query3 = "SELECT * from prelim_table where vol_no = '$vol';";
			$result3 = $db->query($query3);
			$num_rows3 = $result3 ? $result3->num_rows : 0;

			if($num_rows3)
			{
				$row3 = $result3->fetch_assoc();

				$no = $row3['no_prelims'];
				$page_num = $page - $no;
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

				if($vol < 10)
				{
					$vnum = "00" . $vol;
				}
				else
				{
					$vnum = "0" . $vol;
				}
				$vnum = get_rigBookid($vnum);
				echo "<li class=\"mantra\"><a href=\"../../php/bookReader.php?bookID=$vnum&page=$page_no&bookreaderTitle=&\" target=\"_blank\">$mantra</a></li>";
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
