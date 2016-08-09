<?php

$filename = "html/ananta.html";

$cmd = 'wget "http://localhost/grm/html/ananta.php" --output-document=' . $filename . ' --quiet';

system($cmd);

?>
