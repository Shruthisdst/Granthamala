<?php session_start();	?>
<!DOCTYPE HTML>
<html manifest="appcache.manifest">
<head>
	
	
	<title><?php $book['Title'] ?></title>
    <meta charset="UTF-8"/>
    <link rel="shortcut icon" type="image/ico" href="../../images/logo.ico" />
    <link rel="stylesheet" type="text/css" href="../static/BookReader/BookReader.css?v=1.0"/>
    <script type="text/javascript" src="../static/BookReader/jquery-1.4.2.min.js"></script>
    <script type="text/javascript" src="../static/BookReader/jquery-ui-1.8.5.custom.min.js"></script>
    <script type="text/javascript " src="../static/BookReader/dragscrollable.js"></script>
    <script type="text/javascript" src="../static/BookReader/jquery.colorbox-min.js"></script>
    <script type="text/javascript" src="../static/BookReader/jquery.ui.ipad.js"></script>
    <script type="text/javascript" src="../static/BookReader/jquery.bt.min.js"></script>
    <script type="text/javascript" src="../static/BookReader/BookReader.js?v=1.0"></script>
	
    <?php
		$bookID = $_GET['bookID'];
		
		$page = $_GET['pagenum'].".jpg";
		
		

		if(isset($_GET['searchText']) && $_GET['searchText'] != "")
		{
			$search = $_GET['searchText'];
			$book["searchText"] = $search;
		}
		$djvurl = "../../../Volumes/djvu/".$bookID;
		$imgurl = "../../../Volumes/jpg/2/".$bookID;
		
		$djvulist=scandir($djvurl);
		$imglist=scandir($imgurl);
		$cmd='';
		for($i=0;$i<count($imglist);$i++)
		{
			if($imglist[$i] != '.' && $imglist[$i] != '..' && preg_match('/(\.jpg)/' , $imglist[$i]))
			{
				//$img = preg_split("/\./",$imglist[$i]);
				$book["imglist"][$i]= $imglist[$i];
			}
		}
	
		$book["imglist"]=array_values($book["imglist"]);
		
		if(isset($_GET['bookreaderTitle'])) {
			$book["Title"] = 'ಶ್ರೀ ಜಯಚಾಮರಾಜೇಂದ್ರ ವೇದರತ್ನಮಾಲಾ';
		} else {
			$book["Title"] = "ಶ್ರೀ ಜಯಚಾಮರಾಜೇಂದ್ರ ಗ್ರಂಥರತ್ನಮಾಲಾ";
		}
	
		$book["TotalPages"] = count($book["imglist"]);	
		$book["SourceURL"] = "";
		$result = array_keys($book["imglist"], $page);
		
		$book["pagenum"] = $result[0];
		$book["bookID"] = $bookID;
		$book["imgurl"] = $imgurl;		
    ?>
	
	
<script type="text/javascript">
	var book = <?php echo json_encode($book); ?>;
</script>
<script>
	$.ajax({url: "filesRemover.php", async: true});
</script>
</head>
<script type="text/javascript" src="../static/BookReader/cacheUpdater.js"></script>
<script type="text/javascript" src="../static/BookReader/checkCached.js"></script>

<body style="background-color: #939598;">

<div id="BookReader">
    
</div>
<script type="text/javascript" src="../static/BookReaderJSSimple.js?v=1.0"></script>
</body>
</html>

<!-- ********************************************************************************************************************************************** -->
