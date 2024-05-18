<?php
	$jpg = 'find ../../../Volumes/jpg/2/ -mmin +10 -type f -name "*.jpg" -exec rm {} \;';
	exec($jpg);
	$tif = 'find ../../../Volumes/tif/ -mmin +10 -type f -name "*.tif" -exec rm {} \;';
	exec($tif);
	$pdf = 'find ../../../Volumes/PDF/ -mmin +5 -type f -name "*.pdf" -exec rm {} \;';
	exec($pdf);
?>
