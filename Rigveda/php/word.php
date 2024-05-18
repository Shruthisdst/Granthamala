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
					<div class="letter"><a href='word.php?letter=ಅ'>ಅ</a></div>
					<div class="letter"><a href='word.php?letter=ಆ'>ಆ</a></div>
					<div class="letter"><a href='word.php?letter=ಇ'>ಇ</a></div>
					<div class="letter"><a href='word.php?letter=ಈ'>ಈ</a></div>
					<div class="letter"><a href='word.php?letter=ಉ'>ಉ</a></div>
					<div class="letter"><a href='word.php?letter=ಊ'>ಊ</a></div>
					<div class="letter"><a href='word.php?letter=ಋ'>ಋ</a></div>
					<div class="letter"><a href='word.php?letter=ಏ'>ಏ</a></div>
					<div class="letter"><a href='word.php?letter=ಐ'>ಐ</a></div>
					<div class="letter"><a href='word.php?letter=ಓ'>ಓ</a></div>
					<div class="letter"><a href='word.php?letter=ಔ'>ಔ</a></div>
					<div class="letter"><a href='word.php?letter=ಕ'>ಕ</a></div>
					<div class="letter"><a href='word.php?letter=ಖ'>ಖ</a></div>
					<div class="letter"><a href='word.php?letter=ಗ'>ಗ</a></div>
					<div class="letter"><a href='word.php?letter=ಘ'>ಘ</a></div>
				</td>
			</tr>
			<tr>
				<td class="level2">
					<div class="letter"><a href='word.php?letter=ಚ'>ಚ</a></div>
					<div class="letter"><a href='word.php?letter=ಛ'>ಛ</a></div>
					<div class="letter"><a href='word.php?letter=ಜ'>ಜ</a></div>
					<div class="letter"><a href='word.php?letter=ತ'>ತ</a></div>
					<div class="letter"><a href='word.php?letter=ದ'>ದ</a></div>
					<div class="letter"><a href='word.php?letter=ಧ'>ಧ</a></div>
					<div class="letter"><a href='word.php?letter=ನ'>ನ</a></div>
					<div class="letter"><a href='word.php?letter=ಪ'>ಪ</a></div>
					<div class="letter"><a href='word.php?letter=ಫ '>ಫ</a></div>
					<div class="letter"><a href='word.php?letter=ಬ'>ಬ</a></div>
					<div class="letter"><a href='word.php?letter=ಭ'>ಭ</a></div>
					<div class="letter"><a href='word.php?letter=ಮ'>ಮ</a></div>
					<div class="letter"><a href='word.php?letter=ಯ'>ಯ</a></div>
					<div class="letter"><a href='word.php?letter=ರ'>ರ</a></div>
					<div class="letter"><a href='word.php?letter=ಲ'>ಲ</a></div>
					<div class="letter"><a href='word.php?letter=ವ'>ವ</a></div>
					<div class="letter"><a href='word.php?letter=ಶ'>ಶ</a></div>
					<div class="letter"><a href='word.php?letter=ಷ'>ಷ</a></div>
					<div class="letter"><a href='word.php?letter=ಸ'>ಸ</a></div>
					<div class="letter"><a href='word.php?letter=ಹ'>ಹ</a></div>
				</td>
			</tr>
	</table>
	<div class="rule">&nbsp;</div>
	<div class="main">
		

<?php
include("connect.php");

$letter = $_GET['letter'];

$query1 = "SELECT * from swara_index where word like '$letter%' order by alias_word";
$result1 = $db->query($query1);
$num_rows1 = $result1 ? $result1->num_rows : 0;

$quotient = intval($num_rows1 / 4);
$remainder = $num_rows1 % 4;
$column = 4;
if($remainder == 0)
{
	$rows = $quotient;
}
else
{
	$rows = $quotient + 1;
}


echo "<div class=\"letterspan\">$letter</div>";

if($num_rows1)
{
	echo "<table>";
	for($i=1;$i<=$rows;$i++)
	{
		echo "<tr>";
		for($a=1;$a<=$column;$a++)
		{
			echo "<td>";
			$row1 = $result1->fetch_assoc();
			$word =$row1['word'];
			echo "<div class=\"pada\"><a href=\"triplet.php?word=$word\">$word</a></div>";
			echo "</td>";
		}
		echo "</tr>";
	}
	echo "</table>";
}

if($result1){$result1->free();}
$db->close();

?>
	
	</div>
	</div>
	</div>
</body>
</html>
