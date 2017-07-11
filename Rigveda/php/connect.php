<?php
$user='root';
$password='mysql';
$database='grm';

$db = @new mysqli('localhost', "$user", "$password", "$database");
$db->set_charset('utf8');

if($db->connect_errno > 0)
{
	echo '<span class="aFeature clr2">Not connected to the Database</span>';
	echo '</div> <!-- cd-container -->';
	echo '</div> <!-- cd-scrolling-bg -->';
	echo '</main> <!-- cd-main-content -->';

    exit(1);
}

?>
