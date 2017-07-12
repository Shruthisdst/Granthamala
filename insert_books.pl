#!/usr/bin/perl

$host = $ARGV[0];
$db = $ARGV[1];
$usr = $ARGV[2];
$pwd = $ARGV[3];

use DBI();

open(IN,"grm_books.xml") or die "can't open grm_books.xml\n";

my $dbh=DBI->connect("DBI:mysql:database=$db;host=$host","$usr","$pwd");

$sth_enc=$dbh->prepare("set names utf8");
$sth_enc->execute();
$sth_enc->finish();

$sth1=$dbh->prepare("CREATE TABLE GRM_books(
book_id varchar(10), 
level int(2),
title varchar(1000),
authid varchar(200),
authorname varchar(1000),
page varchar(4),
page_end varchar(4),
edition varchar(2),
volume varchar(3),
part varchar(2),
type varchar(1000),
year int(4),
month varchar(2),
slno int(6) auto_increment, primary key(slno)) auto_increment=10001 ENGINE=MyISAM character set utf8 collate utf8_general_ci");

$sth1->execute();
$sth1->finish();

$line = <IN>;
$scount = 0;

while($line)
{
	chop($line);
	if($line =~ /<s([0-9]+) title="(.*)" author="(.*)" page="(.*)" info="(.*)" type="(.*)" date="(.*)">/)
	{
		$level = $1;
		$title = $2;
		$authors = $3;
		if($authors ne "")
		{
			@list = split(/;/,$authors);
			for($i=0;$i<@list;$i++)
			{
				$authid = $authid . ";" . get_authid($list[$i]);
			}
			$authid =~ s/^;//;
		}
		else
		{
			$authid = "";
		}
		if($4 ne "")
		{
			($page,$page_end) = split(/-/,$4);
		}
		else
		{
			$page = "";
			$page_end = "";
		}
		if($5 ne "")
		{
			($edition,$volume,$part,$book_id) = split(/:/,$5);
			#~ print 'Book->' . $book_id . "\n";
		}
		else
		{
			$edition = "";
			$volume = "";
			$part = "";
			$book_id = "";
		}
		$type = $6;
		$date = $7;
		if($date ne "")
		{
			($day,$month,$year) = split(/:/,$date);
		}
		else
		{
			$year = 0;
			$month = "00";
		}
		insert_to_db($book_id,$level,$title,$authid,$authors,$page,$page_end,$edition,$volume,$part,$type,$year,$month);
		$title =  "";
		$level = "";
		$authid = "";
		$authors = "";
		$page = "";
		$page_end = "";
		$edition = "";
		$volume = "";
		$part = "";
		$book_id = "";
		$type = "";
		$date = "";
		$scount++;
		$year = 0;
		$month = "";
	}
	elsif($line =~ /<\/s([0-9]+)>/)
	{
	}
	else
	{
		#~ print $line . "\n";
	}
$line = <IN>;
}

close(IN);

#~ print "Total S count:" . $scount . "\n";

sub insert_to_db()
{
	my($book_id,$level,$title,$authid,$authors,$page,$page_end,$edition,$volume,$part,$type,$year,$month) = @_;
	my($sth2);

	$title =~ s/'/\\'/g;

	$sth2=$dbh->prepare("insert into GRM_books values('$book_id','$level','$title','$authid','$authors','$page','$page_end','$edition','$volume','$part','$type','$year','$month','0')");
	$sth2->execute();
	$sth2->finish();
}


sub get_authid()
{
	my($authorname) = @_;
	my($sth,$ref,$authid);

	$authorname =~ s/'/\\'/g;
	
	$sth=$dbh->prepare("select authid from GRM_author where authorname='$authorname'");
	$sth->execute();
			
	my $ref = $sth->fetchrow_hashref();
	$authid = $ref->{'authid'};
	$sth->finish();
	return($authid);
}
