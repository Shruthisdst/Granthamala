#!/usr/bin/perl

open(IN, "GRM_toc.xml") or die "Can't open GRM_toc.xml";
open(OUT, ">GRM_toc_uni.xml") or die "Can't open GRM_toc_uni.xml";

$line = <IN>;
$count = 0;

while($line)
{
	chop($line);
	
	if($line =~ /(.*)btitle="(.*)" ctitle="(.*)" cid="(.*)"/)
	{
		$btitle = $2;
		$btitle = gen_unicode($btitle);
        $ctitle = $3;
		$ctitle = gen_unicode($ctitle);        
		$line =~ s/btitle=".*" ctitle=".*" cid/btitle="$btitle" ctitle="$ctitle" cid/;
		print OUT $line . "\n";
	}
	elsif($line =~ /(.*)title="(.*)" page="(.*)"/)
	{
		$title = $2;
		$title = gen_unicode($title);
		$line =~ s/title=".*" page/title="$title" page/;
		print OUT $line . "\n";
	}
	else
	{
		print OUT $line . "\n";
	}
	
	$line = <IN>;
}

close(IN);
close(OUT);

print $count . "\n";

sub gen_unicode()
{
	my($kan_str) = @_;
	open(TMP, ">tmp.txt") or die "Can't open tmp.txt\n";
	my ($tmp,$flg,$i,$endash_uni,$endash,$flag);
	$flg = 1;

	$kan_str =~ s/\\ralign\{(.*?)\}/!E! $ralign_btag !K! $1 !E! $ralign_etag !K! /g;
	$kan_str =~ s/\\char'263/!E!&#x0CBD;!K!/g;
	$kan_str =~ s/\\char'365/!E!&#x0CC4;!K!/g;
	$kan_str =~ s/\\char'273/!E!&#x0CB1;!K!/g;
	$kan_str =~ s/\\char'366/nf/g;
	$kan_str =~ s/\\char'361/nf/g;
	$kan_str =~ s/\\s /!E!&#x0CBD;!K!/g;
	$kan_str =~ s/\\s/!E!&#x0CBD;!K!/g;
	$kan_str =~ s/\\S /!E!&#x0CBD;!K!/g;
	$kan_str =~ s/\\S/!E!&#x0CBD;!K!/g;
	$kan_str =~ s/RV/VR/g;
	$kan_str =~ s/qq/q/g;
	$kan_str =~ s/Ryx/yxR/g;
	$kan_str =~ s/RyX/yxR/g;
	$kan_str =~ s/Rq/qR/g;
	$kan_str =~ s/RY/YR/g;
	$kan_str =~ s/\\cdots/!E!&#x2026;!K!/g;
	$kan_str =~ s/&#x2014;/!E!&#x2014;!K!/g;
	$kan_str =~ s/&#8212;/ !E!&#x2014;!K! /g;


	$flag = 1;
	while($flag)
	{
		#print "HHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHH\n";
		if($kan_str =~ /\{\\rm (.*?)\}/)
		{
			$kan_str =~ s/\{\\rm (.*?)\}/!E!\1!K!/;
		}
		elsif($kan_str =~ /\$(.*?)\$/)
		{
			$kan_str =~ s/\$(.*?)\$/!E! \1 !K!/;
			$kan_str =~ s/\^\\circ/&#xB0;/g;
		}
		else
		{
			$flag = 0;
		}
	}

	$kan_str =~ s/\{//g;
	$kan_str =~ s/\}//g;

	
	#print $kan_str . "\n";
	
	#$endash = "&#x2014";
	#$endash_uni = chr(hex($endash));
	
	print TMP $kan_str;
	close(TMP);
	
	system("./to_unicode4 tmp.txt > tmp1.txt");
	open(UN, "tmp1.txt") or die "Can't open tmp1.txt\n";
	my $uni_str = <UN>;
	close(UN);
	
	#print FOUT $uni_str . "\n";
	
	
	
	my($decval,$val,$p);
	$uni_str =~ s/<br>//g;
	$uni_str =~ s/<\/br>//g;
	$uni_str =~ s/---/&#x2014;/g;
	$uni_str =~ s/--/&#x2013;/g;
	$uni_str =~ s/\|/&#x007C;/g;
	$uni_str =~ s/``/&#x201C;/g;	
	$uni_str =~ s/''/&#x201D;/g;
	$uni_str =~ s/`/&#x2018;/g;
	$uni_str =~ s/'/&#x2019;/g;
	$uni_str =~ s/&nbsp;/&#xa0;/g;
	#$uni_str =~ s/(&#x0CCD;)(&#x200C;)(&#x0C97;)(&#x0CCD;)/\1\3\4/;

	
		
	while($flg)
	{
		if($uni_str =~ /&#x([0-9A-F]+);/)
		{
			$val = $1;	
			$p = chr(hex($val));
			$uni_str =~ s/&#x$val;/$p/g;
		}
		else
		{
			$flg = 0;
		}
	}	

	#$uni_str =~ s/\bಸರ್‍\b/ಸರ್/g;
	return $uni_str;
}
