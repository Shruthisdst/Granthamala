<?php session_start();	?>
<!DOCTYPE HTML>
<html manifest="appcache.manifest">
<head>

    <title>$book['Title']</title>
    <meta charset="UTF-8"/>
    <link rel="shortcut icon" type="image/ico" href="../../images/logo.ico" />
    <link rel="stylesheet" type="text/css" href="../static/BookReader/BookReader.css"/>
    <script type="text/javascript" src="../static/BookReader/jquery-1.4.2.min.js"></script>
    <script type="text/javascript" src="../static/BookReader/jquery-ui-1.8.5.custom.min.js"></script>
    <script type="text/javascript " src="../static/BookReader/dragscrollable.js"></script>
    <script type="text/javascript" src="../static/BookReader/jquery.colorbox-min.js"></script>
    <script type="text/javascript" src="../static/BookReader/jquery.ui.ipad.js"></script>
    <script type="text/javascript" src="../static/BookReader/jquery.bt.min.js"></script>
    <script type="text/javascript" src="../static/BookReader/BookReader.js"></script>
    
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
		$cmd='';
		for($i=0;$i<count($djvulist);$i++)
		{
			if($djvulist[$i] != '.' && $djvulist[$i] != '..' && preg_match('/(\.djvu)/' , $djvulist[$i]) && !preg_match('/(index\.djvu)/' , $djvulist[$i]))
			{
				$img = preg_split("/\./",$djvulist[$i]);
				$book["imglist"][$i]= $img[0].".jpg";
			}
		}
	
		$book["imglist"]=array_values($book["imglist"]);
		$book["Title"] = "ಗ್ರಂಥರತ್ನಮಾಲಾ";
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
<script type="text/javascript" src="../static/BookReaderJSSimple.js"></script>
<span>suresh</span>
</body>
</html>
