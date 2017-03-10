<?php

$preface_pagenum = array(
'001'=>"0000ah",
'002'=>"0000ah",
'003'=>"0000ah",
'004'=>"0000ag",
'005'=>"0000ah",
'006'=>"0000af",
'007'=>"0000ag",
'008'=>"0000af",
'009'=>"0000ah",
'010'=>"0000ag",
'011'=>"0000ag",
'012'=>"0000ag",
'013'=>"0000ag",
'014'=>"0000ag",
'015'=>"0000af",
'016'=>"0000af",
'017'=>"0000af",
'018'=>"0000af",
'019'=>"0000ag",
'020'=>"0000af",
'021'=>"0000af",
'022'=>"0000af",
'023'=>"0000af",
'024'=>"0000af",
'025'=>"0000ae",
'026'=>"0000af",
'027'=>"0000af",
'028'=>"0000ae",
'029'=>"0000af",
'030'=>"0000af",
'031'=>"0000ae",
'032'=>"0000ad",
'033'=>"0000ae",
'034'=>"0000ae",
'035'=>"0000ad",
'036'=>"0000ac"
);

function get_rigBookid($bookid)
{
	$bookid = preg_replace('/001/', '288', $bookid);
	$bookid = preg_replace('/002/', '289', $bookid);
	$bookid = preg_replace('/003/', '290', $bookid);
	$bookid = preg_replace('/004/', '291', $bookid);
	$bookid = preg_replace('/005/', '292', $bookid);
	$bookid = preg_replace('/006/', '293', $bookid);
	$bookid = preg_replace('/007/', '294', $bookid);
	$bookid = preg_replace('/008/', '295', $bookid);
	$bookid = preg_replace('/009/', '296', $bookid);
	$bookid = preg_replace('/010/', '297', $bookid);
	$bookid = preg_replace('/011/', '298', $bookid);
	$bookid = preg_replace('/012/', '299', $bookid);
	$bookid = preg_replace('/013/', '300', $bookid);
	$bookid = preg_replace('/014/', '301', $bookid);
	$bookid = preg_replace('/015/', '302', $bookid);
	$bookid = preg_replace('/016/', '303', $bookid);
	$bookid = preg_replace('/017/', '304', $bookid);
	$bookid = preg_replace('/018/', '305', $bookid);
	$bookid = preg_replace('/019/', '306', $bookid);
	$bookid = preg_replace('/020/', '307', $bookid);
	$bookid = preg_replace('/021/', '308', $bookid);
	$bookid = preg_replace('/022/', '309', $bookid);
	$bookid = preg_replace('/023/', '310', $bookid);
	$bookid = preg_replace('/024/', '311', $bookid);
	$bookid = preg_replace('/025/', '312', $bookid);
	$bookid = preg_replace('/026/', '313', $bookid);
	$bookid = preg_replace('/027/', '314', $bookid);
	$bookid = preg_replace('/028/', '315', $bookid);
	$bookid = preg_replace('/029/', '316', $bookid);
	$bookid = preg_replace('/030/', '317', $bookid);
	$bookid = preg_replace('/031/', '318', $bookid);
	$bookid = preg_replace('/032/', '319', $bookid);
	$bookid = preg_replace('/033/', '320', $bookid);
	$bookid = preg_replace('/034/', '321', $bookid);
	$bookid = preg_replace('/035/', '322', $bookid);
	$bookid = preg_replace('/036/', '323', $bookid);
	
	return $bookid;
}
?>
