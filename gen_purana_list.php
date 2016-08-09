<?php

$filename = "html/purana_list.html";

$cmd = 'wget "http://localhost/grm/html/purana_list.php" --output-document=' . $filename . ' --quiet';

system($cmd);

?>
