#!/usr/bin/perl

$host = $ARGV[0];
$db = $ARGV[1];
$usr = $ARGV[2];
$pwd = $ARGV[3];

use DBI();

open(IN,"toc_uni.xml") or die "can't open toc_uni.xml\n";

my $dbh=DBI->connect("DBI:mysql:database=$db;host=$host","$usr","$pwd");

$sth_enc=$dbh->prepare("set names utf8");
$sth_enc->execute();
$sth_enc->finish();

$sth1=$dbh->prepare("CREATE TABLE Rig_Toc(
book_id varchar(4), 
btitle varchar(2000),
level int(2),
title varchar(10000),
start_pages varchar(20),
end_pages varchar(20),
slno int(6) auto_increment, primary key(slno)) auto_increment=10001 ENGINE=MyISAM");

$sth1->execute();
$sth1->finish();

$line = <IN>;
$scount = 0;

while($line)
{
	chop($line);
	if($line =~ /<book code="(.*)"[\s]+btitle="(.*)"><\/book>/)
	{
		$book_id = $1;
		$btitle = $2;
		insert_to_db($book_id,$btitle);
	}
	elsif($line =~ /<book code="(.*)"[\s]+btitle="(.*)">/)
	{
		$book_id = $1;
		$btitle = $2;
	}
	elsif($line =~ /<s([1-4]+)[\s]+title="(.*)"[\s]+page="(.*)-(.*)">/)
	{
		$level = $1;
		$title = $2;
		$start_pages = $3;
		$end_pages = $4;

		insert_to_db($book_id,$btitle,$level,$title,$start_pages,$end_pages);
		$title =  "";
		$level = "";
		$start_pages = "";
		$end_pages = "";
		$scount++;
	}
	elsif($line =~ /<s([1-4]+)[\s]+title="(.*)"[\s]+page="(.*)">/)
	{
		$level = $1;
		$title = $2;
		$start_pages = $3;

		insert_to_db($book_id,$btitle,$level,$title,$start_pages);
		$title =  "";
		$level = "";
		$start_pages = "";
		$scount++;
	}
	elsif($line =~ /<\/s([1-4]+)>/)
	{
	}
	else
	{
		print $line . "\n";
	}
$line = <IN>;
}

close(IN);


sub insert_to_db()
{
	my($book_id,$btitle,$level,$title,$start_pages,$end_pages) = @_;
	my($sth2);

	$btitle =~ s/'/\\'/g;
	$title =~ s/'/\\'/g;

	$sth2=$dbh->prepare("insert into Rig_Toc values('$book_id','$btitle','$level','$title','$start_pages','$end_pages','0')");
	$sth2->execute();
	$sth2->finish();
}

