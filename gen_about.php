<?php

$filename = "html/about.html";

$cmd = 'wget "http://localhost/grm/html/about.php" --output-document=' . $filename . ' --quiet';

system($cmd);

?>
