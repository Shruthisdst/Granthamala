<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link href="style/reset.css" media="screen" rel="stylesheet" type="text/css" />    
	<link href="style/style.css" media="screen" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="js/kannada_kbd.js" charset="UTF-8"></script>    
	<title>ಗ್ರಂಥಮಾಲಾ</title>
</head>

<body>
	<div class="page">
        <div class="header">
            <ul class="nav">
                <li><a class="nav_kan" href="../index.php">ಮುಖಪುಟ</a></li>
				<li>|</li>
                <li><a class="nav_kan" href="about.php">ಒಳನೋಟ</a></li>
				<li>|</li>
                <li><a class="nav_kan" href="anuvadakaru.php">ಅನುವಾದಕರ ಪಟ್ಟಿ</a></li>
				<li>|</li>
                <li><a class="nav_kan" href="purana_list.php">ಸಂಗ್ರಹ</a></li>
				<li>|</li>
                <li><a class="active nav_kan" href="#">ಹುಡುಕಿ</a></li>
            </ul>
        </div>
        <div class="heading">ಶ್ರೀ ಜಯಚಾಮರಾಜೇಂದ್ರ   ಗ್ರಂಥರತ್ನಮಾಲಾ</div>
        <div class="mainbody">
			<div class="intro_para">
				<div class="archive_holder">
					<div class="archive_title">ಹುಡುಕಿ</div>                  
                    <!--
                                        (ಗ್ರಂಥದ ಹೆಸರು / ಗ್ರಂಥದಲ್ಲಿನ  ವಿಷಯಾನುಕ್ರಮಣಿಕೆಯನ್ನು ನಮೂದಿಸಿ)
                    <div class="note">(ಸೂಚನೆ : ಇಲ್ಲಿ ಒಟ್ಟು ೩೨೪ ಗ್ರಂಥಗಳಿವೆ ಹಾಗು ಅದಕ್ಕೆ ಸಂಭಂದಿಸಿದ ವಿಷಯಾನುಕ್ರಮಣಿಕೆಗಳಿವೆ.  ನೀವು ಗ್ರಂಥದ ಹೆಸರು ಅಥವಾ ಗ್ರಂಥದ ವಿಷಯಾನುಕ್ರಮಣಿಕೆಯ ಹೆಸರನ್ನು ನಮೂದಿಸಬಹುದು.)</div> -->
					<div class="archive_search">
                        
<?php include("keyboard.php"); ?>

						<form method="POST" action="search-result.php">
							<table>
                                <tr>
									<td class="right">
										<span class="stitle"><input type="radio" name="bl" value="btitle" CHECKED />&nbsp;ಗ್ರಂಥಗಳ ಶೀರ್ಷಿಕೆ</span>
									</td>
								</tr>
								<tr>
									<td class="right">
										<span class="stitle"><input type="radio" name="bl" value="toctitle"/>&nbsp;ಗ್ರಂಥಗಳ ವಿಷಯಾನುಕ್ರಮಣಿಕೆ</span>
									</td>
								</tr>
								<tr>
									<td class="left"><span class="titlespan">ಪದಗಳನ್ನು ನಮೂದಿಸಿ</span></td>
									<td class="right"><input name="text" type="text" id="title" onfocus="SetId('title')" style="height: 1.8em; margin: 1em 0em 1em 0em;"/></td>
								</tr>
								 <tr>
									<td class="left">&nbsp;</td>
									<td class="submit">
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
        <div id="footer">
			<div class="terms"><p><a href="#">Terms of Use</a>&nbsp;|&nbsp;<a href="#">Privacy Policy</a>&nbsp;|&nbsp;<a href="#">Contact Us</a></p></div>
			<div class="copyright"><p><a href="http://www.srirangadigital.com">Copyright &copy; Sriranga Digital Software Technologies Pvt. Ltd.</a></p></div>
        </div>
    </div>
</body>
</html>
