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
<?php
include("connect.php");
include("common.php");

$mandala = $_GET['mandala'];
$sukta = $_GET['sukta'];
$number_name = array("1"=>"೧","2"=>"೨","3"=>"೩","4"=>"೪","5"=>"೫","6"=>"೬","7"=>"೭","8"=>"೮","9"=>" ೯","10"=>"೧೦");

echo "<br />";
echo "<span class=\"spantitle\">ಮಂಡಲ - $mandala&nbsp;&nbsp;&nbsp;ಸೂಕ್ತ - $sukta</span><br/><br/>";

$query1 = "SELECT * FROM Rukku_table where mandala = '$mandala' and sukta = '$sukta'";
$result1 = $db->query($query1);
$num_rows1 = $result1 ? $result1->num_rows : 0;

if($num_rows1 > 0)
{
	echo "<ol>";
	for($i=1;$i<=$num_rows1;$i++)
	{
		$row = $result1->fetch_assoc();
		$text1 = $row['text1'];

		$query2 = "SELECT page_no, vol_no from mandala_table where  mandala = '$mandala' and sukta = '$sukta' and rukku = '$i'";
		$result2 = $db->query($query2);
		$num_rows2 = $result2 ? $result2->num_rows : 0;

		if($num_rows2 > 0)
		{
			$row2 = $result2->fetch_assoc();
			$page_no = $row2['page_no'];
			$vol_no = $row2['vol_no'];
				
			$query3 = "SELECT * from prelim_table where vol_no = '$vol_no';";
			$result3 = $db->query($query3);
			$num_rows3 = $result3 ? $result3->num_rows : 0;
			if($num_rows3 > 0)
			{
				$row3 = $result3->fetch_assoc();
				$no = $row3['no_prelims'];
				$page_num = $page_no - $no;
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
				echo "<li class=\"rukku\"><a href=\"../../Volumes/$vnum/index.djvu?djvuopts&amp;page=$page_no.djvu&amp;zoom=page\" target=\"_blank\">$text1...</a></li>";
			}
		}
	}
	echo "</ol>";
}

if($result1){$result1->free();}
$db->close();

?>
	</div>
	</div>	
</body>
</html>
