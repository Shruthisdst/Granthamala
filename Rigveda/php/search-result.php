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
				<li><a class="nav_kan active" href="search.php">ಹುಡುಕಿ</a></li>
			</ul>
		</div>
	<div class="mainbody">
<?php

include("connect.php");
include("common.php");

$pada = $_POST['text'];
$mantra = $_POST['text'];
$title = $_POST['text'];
$vol_no=$_POST['vol_no'];
$bl=$_POST['bl'];

$pada = preg_replace("/[\t]+/", " ", $pada);
$pada = preg_replace("/[ ]+/", " ", $pada);
$pada = preg_replace("/^ /", "", $pada);

$mantra = preg_replace("/[\t]+/", " ", $mantra);
$mantra = preg_replace("/[ ]+/", " ", $mantra);
$mantra = preg_replace("/^ /", "", $mantra);

$title = preg_replace("/[\t]+/", " ", $title);
$title = preg_replace("/[ ]+/", " ", $title);
$title = preg_replace("/^ /", "", $title);

if($pada=='')
{
	$pada='[a-z]*';
}
if($mantra=='')
{
	$mantra='[a-z]*';
}
if($title=='')
{
	$title='[a-z]*';
}

if($pada!='')
{
	if ($bl == "pada")
	{
		$query="SELECT * FROM pada_index where word like '$pada%'";
	}
}
if($mantra!='')
{
	if ($bl == "mantra")
	{
		$query="SELECT * FROM Rukku_table where text1 REGEXP '$mantra' or text2 REGEXP '$mantra' or text3 REGEXP '$mantra'";
	}
}
if($title!='' && $vol_no!='')
{
	if ($bl == "title")
	{
		$query="SELECT * FROM Rig_Toc where title REGEXP '$title' and book_id = $vol_no";
	}
}
if($title!='' && $vol_no=='')
{
	if ($bl == "title")
	{
		$query="SELECT * FROM Rig_Toc where title REGEXP '$title'";
	}
}

$result = $db->query($query);
$num_results = $result ? $result->num_rows : 0;

if($bl == "pada")
{
	echo "<div class=\"search-result\">ಫಲಿತಾಂಶಗಳು &#8212; $num_results</div>";
    if($num_results > 0)
    {
        while($row1 = $result->fetch_assoc())
        {
            $word = $row1['word'];
            $id = $row1['index_id'];

            if($pada!='')
            {
                $query1 = "SELECT * from triplet_index where index_id = '$id'";
            }
            
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
                
            if($num_rows1 > 0)
            {
                echo "<div class=\"wordspan gap-above-large\">$word</div>";
                echo "<table>";
                for($x=1;$x<=$rows;$x++)
                {
                    echo "<tr>";
                    for($y=1;$y<=$column;$y++)
                    {
                        echo "<td class=\"triplet\">";
                        $row2 = $result1->fetch_assoc();
                        $mandala1 = $row2['mandala'];
                        $sukta1 = $row2['sukta'];
                        $rukku1 = $row2['rukku'];
                        if($vol_no != '')
                        {
                            $query4 = "SELECT * FROM mandala_table where mandala = '$mandala1' and sukta = '$sukta1' and rukku = '$rukku1' and vol_no = '$vol_no'";
                        }
                        else
                        {
                            $query4 = "SELECT * FROM mandala_table where mandala = '$mandala1' and sukta = '$sukta1' and rukku = '$rukku1'";
                        }
                        $result4 = $db->query($query4);
                        $num_rows4 = $result4 ? $result4->num_rows : 0;
                        if($num_rows4 > 0)
                        {
							$row4 = $result4->fetch_assoc();

                            $page4 = $row4['page_no'];
                            $vol4 = $row4['vol_no'];
                            
                            $query5 = "SELECT * from prelim_table where vol_no = '$vol4'";
                            $result5 = $db->query($query5);
                            $num_rows5 = $result5 ? $result5->num_rows : 0;
                            if($num_rows5 > 0)
                            {
                                $row5 = $result5->fetch_assoc();
                                $no5 = $row5['no_prelims'];
                                $page_num5 = $page4 - $no5;
                                if($page_num5 < 10)
                                {
                                    $page_no5 = "000".$page_num5;
                                }
                                elseif($page_num5 < 100)
                                {
                                    $page_no5 = "00".$page_num5;
                                }
                                elseif($page_num5 < 1000)
                                {
                                    $page_no5 = "0".$page_num5;
                                }
                                else
                                {
                                    $page_no5 = $page_num5;
                                }

                                if($vol4 < 10)
                                {
                                    $vnum4 = "00" . $vol4;
                                }
                                else
                                {
                                    $vnum4 = "0" . $vol4;
                                }
                                $vnum4 = get_rigBookid($vnum4);
                                echo "<a href=\"../../Volumes/$vnum4/index.djvu?djvuopts&amp;page=$page_no5.djvu&amp;zoom=page\" target=\"_blank\">$mandala1-$sukta1-$rukku1</a>";
                            }
                        }
                        echo "</td>";
                    }
                    echo "</tr>";
                }
                echo "</table>";
            }
        }
    }
    else
    {
        echo"<span class=\"goback\">ಫಲಿತಾಂಶಗಳು ಲಭ್ಯವಿಲ್ಲ</span><br /><br />";
        echo"<span class=\"goback\"><a href=\"search.php\">ಹಿಂದಿನ ಪುಟಕ್ಕೆ ಹೋಗಿ ಮತ್ತೆ ಪ್ರಯತ್ನಿಸಿ</a></span>";
    }
}
if($bl == "mantra")
{
	echo "<div class=\"search-result\">ಫಲಿತಾಂಶಗಳು &#8212; $num_results</div>";
    if($num_results)
    {
        while($row1 = $result->fetch_assoc())
        {
            $rukku_id = $row1['rukku_id'];
            $text1 = $row1['text1'];
            $text2 = $row1['text2'];
            $text3 = $row1['text3'];
            $rukku = $row1['rukku'];

            
			if($mantra!='' && $vol_no!='')
			{
				$query2 = "SELECT * FROM mandala_table where id = '$rukku_id'  and vol_no = $vol_no";
			}
			else
			{
				$query2 = "SELECT * FROM mandala_table where id = '$rukku_id'";
			}
			$result2 = $db->query($query2);
            $num_rows2 = $result2 ? $result2->num_rows : 0;
            if($num_rows2 > 0)
            {
                while($row2 = $result2->fetch_assoc())
                {
                    $page = $row2['page_no'];
                    $vol = $row2['vol_no'];
                    
                    $query3 = "SELECT * from prelim_table where vol_no = '$vol'";
                    $result3 = $db->query($query3);
					$num_rows3 = $result3 ? $result3->num_rows : 0;

                    if($num_rows3 > 0)
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
                        if($mantra!='')
                        {
							$text1 = preg_replace("/$mantra/", "<span style=\"color: red\">$mantra</span>", $text1);
							$text2 = preg_replace("/$mantra/", "<span style=\"color: red\">$mantra</span>", $text2);
							$text3 = preg_replace("/$mantra/", "<span style=\"color: red\">$mantra</span>", $text3);
                            if ($bl == "mantra")
                            {
                                echo "<ul>";
                                echo "<li class=\"man\">";
                                if($text3 != '')
                                {
                                    echo "<a href=\"../../Volumes/$vnum/index.djvu?djvuopts&amp;page=$page_no.djvu&amp;zoom=page\" target=\"_blank\">$text1&nbsp;|<br/>$text2&nbsp;|<br/>$text3&nbsp;||$rukku||</a>";
                                }
                                elseif($text2 != '')
                                {
                                    echo "<a href=\"../../Volumes/$vnum/index.djvu?djvuopts&amp;page=$page_no.djvu&amp;zoom=page\" target=\"_blank\">$text1&nbsp;|<br/>$text2&nbsp;||$rukku||</a>";
                                }
                                else
                                {
                                    echo "<a href=\"../../Volumes/$vnum/index.djvu?djvuopts&amp;page=$page_no.djvu&amp;zoom=page\" target=\"_blank\">$text1&nbsp;||$rukku||</a>";
                                }
                                echo "</li></ul>";
                            }
                        }
                    }
                }
            }
		}
    }
    else
    {
        echo"<span class=\"goback\">ಫಲಿತಾಂಶಗಳು ಲಭ್ಯವಿಲ್ಲ</span><br /><br />";
        echo"<span class=\"goback\"><a href=\"search.php\">ಹಿಂದಿನ ಪುಟಕ್ಕೆ ಹೋಗಿ ಮತ್ತೆ ಪ್ರಯತ್ನಿಸಿ</a></span>";
    }
}
if($bl == "title")
{
	$book_title = '';
	echo "<div class=\"search-result\">ಫಲಿತಾಂಶಗಳು &#8212; $num_results</div>";
    if($num_results > 0)
    {
        echo "<ul>";
        while($row1 = $result->fetch_assoc())
        {
            $btitle = $row1['btitle'];
            if($book_title != $btitle)
            {
                echo "\n<li class=\"booktitle\">$btitle</li>";
                $book_title = $btitle;
            }
            $title1 = $row1['title'];
            $pages = $row1['start_pages'];
            $book_id = $row1['book_id'];
            $book_id = get_rigBookid($book_id);
            
            $title1 = preg_replace('/—/'," &mdash; ",$title1);
            $title1 = preg_replace("/$title/", "<span style=\"color: red\">$title</span>", $title1);
            if ($bl == "title")
            {
                echo "<li class=\"tocspan\"><a href=\"../../Volumes/$book_id/index.djvu?djvuopts&amp;page=$pages.djvu&amp;zoom=page\" target=\"_blank\">$title1</a></li>";
            }
        }
        echo "</ul>";
    }
    else
    {
        echo"<span class=\"goback\">ಫಲಿತಾಂಶಗಳು ಲಭ್ಯವಿಲ್ಲ</span><br /><br />";
        echo"<span class=\"goback\"><a href=\"search.php\">ಹಿಂದಿನ ಪುಟಕ್ಕೆ ಹೋಗಿ ಮತ್ತೆ ಪ್ರಯತ್ನಿಸಿ</a></span>";
    }
}
if($result){$result->free();}
$db->close();

?>

		</div>
		</div>
	</body>
</html>
