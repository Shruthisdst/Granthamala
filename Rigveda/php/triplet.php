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

$word = $_GET['word'];

echo "<br/><br/>";
echo "<span class=\"wordspan\">$word</span>";
echo "<br/><br/>";

$query2 = "SELECT * from swara_index where word = '$word'";
$result2 = $db->query($query2);
$num_rows2 = $result2 ? $result2->num_rows : 0;
$temp = '';
if($num_rows2 > 0)
{
	while($row1 = $result2->fetch_assoc())
	{
		$tripletGrp = $row1['triplet'];
	
		$triplets = preg_split('/;/',$tripletGrp);

		if(count($triplets))
		{
			echo "<table>";
			for($i=0;$i<count($triplets);++$i)
			{
				if(!$i)
				{
					echo "<tr>";
				}
				elseif(!($i % 4))
				{
					echo "</tr>";
					echo "<tr>";
				}
				$ids = explode('.', $triplets[$i]);
				$mandala = $ids[0];
				$sukta = $ids[1];
				$rukku = $ids[2];
				$query1 = "SELECT * FROM mandala_table where mandala = '$mandala' and sukta = '$sukta' and rukku = '$rukku'";
				$result1 = $db->query($query1);
				$num_rows1 = $result1 ? $result1->num_rows : 0;

				if($num_rows1 > 0)
				{
					while($row = $result1->fetch_assoc())
					{
						$page = $row['page_no'];
						$vol = $row['vol_no'];

						$query3 = "SELECT * from prelim_table where vol_no = '$vol'";
						$result3 = $db->query($query3);
						$num_rows3 = $result3 ? $result3->num_rows : 0;

						if($num_rows3 > 0)
						{
							while($row3 = $result3->fetch_assoc())
							{
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
								echo "<td>";
								echo "<div class=\"triplet\"><a href=\"../../php/bookReader.php?bookID=$vnum&page=$page_no&bookreaderTitle=&\" target=\"_blank\">$mandala-$sukta-$rukku</a></div>";
								echo "</td>";
							}
						}
					}
				}
			}
			echo "</tr>";
			echo "</table>";
		} 
	}
}

if($result2){$result2->free();}
$db->close();

?>
	</div>
	</div>
</body>
</html>
