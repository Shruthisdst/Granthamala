<?php
	session_start();
	include("../../connect.php");
	$year = $_GET["year"];
	$month = $_GET["month"];
	$qtext = $_GET["q"];
	$stext  = $_GET["q"];
	$texts = '';
	$texts = preg_split("/ /", $qtext);
	$textFilter = "";
	$searchedPages = array_values(array_unique($_SESSION['sd'][$year.$month]));
	
	for($ic=0;$ic<sizeof($texts);$ic++)
	{
		$textFilter .= $texts[$ic] . "* ";
	}
	$db = @new mysqli('localhost', "$user", "$password", "$database");
	$db->set_charset("utf8");
	
	for($a=0;$a<count($searchedPages);$a++)
	{
		$query1 = "SELECT * FROM
						(SELECT * FROM
							(SELECT * FROM
								(SELECT * FROM word WHERE MATCH (word) AGAINST ('$textFilter' IN BOOLEAN MODE)) AS tb1 
							WHERE year = $year) as tb2
						WHERE month = $month) as tb3
					WHERE pagenum = $searchedPages[$a]";
					
		$result1 = $db->query($query1);
		$num_rows1 = $result1->num_rows;
		$cord = array();
		$array = "";
		
		for($b = 0; $b < $num_rows1; $b++)
		{
			$row1=$result1->fetch_assoc();
			$cord[] = array("l" => $row1['l'],"b" => $row1["b"],"r" => $row1["r"],"t" => $row1["t"]);
		}
		$row1["text"] = "Text Found in";
		$qtext = "Text";
		$row1["text"] = preg_replace("/Text/" , "{{{".$qtext."}}}" , $row1["text"]);
		$array["text"] = $row1["text"];
		$array["par"][] = array( "page" => $row1["pagenum"] , "boxes" => $cord);
		$sd["matches"][] = $array;
	}
	echo json_encode($sd);
?>
			
