<?php

$filename = "html/granthamala.html";

$cmd = 'wget "http://localhost/grm/html/granthamala.php" --output-document=' . $filename . ' --quiet';

system($cmd);

?>
