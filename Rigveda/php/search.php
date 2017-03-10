<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link href="style/reset.css" media="screen" rel="stylesheet" type="text/css" />	
	<link href="style/style.css" media="screen" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="js/kannada_kbd.js" charset="UTF-8"></script>
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
				<li><a class="active nav_kan" href="search.php">ಹುಡುಕಿ</a></li>
			</ul>
		</div>
		<div class="mainbody">
		<br/>
			<div class="intro_para">
				<div class="archive_holder">
					<div class="archive_title">ಹುಡುಕಿ</div>
					<div class="archive_search">
<?php include("keyboard.php"); ?>
						
						<form method="POST" action="search-result.php">
							<table>
								<tr>
									<td class="right">
										<span class="stitle"><input type="radio" name="bl" value="pada" CHECKED />&nbsp;ಪದ</span>
									</td>
								</tr>
								<tr>
									<td class="right">
										<span class="stitle"><input type="radio" name="bl" value="mantra" />&nbsp;ಮಂತ್ರಗಳು</span>
									</td>
								</tr>
								<tr>
									<td class="right">
										<span class="stitle"><input type="radio" name="bl" value="title" />&nbsp;ವಿಷಯಾನುಕ್ರಮಣಿಕೆ</span>
									</td>
								</tr>
								<tr>
									<td class="left"><span class="titlespan">ಪದಗಳನ್ನು ನಮೂದಿಸಿ</span></td>
									<td class="right"><input name="text" type="text" id="title" onfocus="SetId('title')" style="height: 1.8em; margin: 1em 0em 1em 0em;"/></td>
								</tr> 
								<tr>
									<td class="sleft">ಸಂಪುಟಗಳು</td>
									<td class="sright">
										<select name="vol_no" id="vol_no">
											<option value="">ಎಲ್ಲ</option>
											<option value="001">1</option>
											<option value="002">2</option>
											<option value="003">3</option>
											<option value="004">4</option>
											<option value="005">5</option>
											<option value="006">6</option>
											<option value="007">7</option>
											<option value="008">8</option>
											<option value="009">9</option>
											<option value="010">10</option>
											<option value="011">11</option>
											<option value="012">12</option>
											<option value="013">13</option>
											<option value="014">14</option>
											<option value="015">15</option>
											<option value="016">16</option>
											<option value="017">17</option>
											<option value="018">18</option>
											<option value="019">19</option>
											<option value="020">20</option>
											<option value="021">21</option>
											<option value="022">22</option>
											<option value="023">23</option>
											<option value="024">24</option>
											<option value="025">25</option>
											<option value="026">26</option>
											<option value="027">27</option>
											<option value="028">28</option>
											<option value="029">29</option>
											<option value="030">30</option>
											<option value="031">31</option>
											<option value="032">32</option>
											<option value="033">33</option>
											<option value="034">34</option>
											<option value="035">35</option>
										</select>
									</td>
								</tr>
								 <tr>
									<td class="left">&nbsp;</td>
									<td class="right">
										<input name="button1" type="submit" class="titlespan" id="button" value="ಹುಡುಕಿ"/>
										<input name="button2" type="reset" class="titlespan" id="button2" value="ಅಳಿಸಿ"/>
									</td>
								</tr>
							</table>
						</form>
					</div>
				</div>
			</div>
		</div>
		</div>
	</body>
</html>
