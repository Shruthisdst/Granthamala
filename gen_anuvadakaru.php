<?php

$filename = "html/anuvadakaru.html";

$cmd = 'wget "http://localhost/grm/html/anuvadakaru.php" --output-document=' . $filename . ' --quiet';

system($cmd);

?>
