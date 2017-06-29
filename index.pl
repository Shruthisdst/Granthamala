#!/usr/bin/perl

$host = $ARGV[0];
$db = $ARGV[1];
$usr = $ARGV[2];
$pwd = $ARGV[3];

use DBI();

my $dbh=DBI->connect("DBI:mysql:database=$db;host=$host","$usr","$pwd");

$sth_enc=$dbh->prepare("set names utf8");
$sth_enc->execute();
$sth_enc->finish();

$sth11=$dbh->prepare("CREATE TABLE swara_index(
word varchar(100000), 
triplet varchar(1000000)) ENGINE=MyISAM character set utf8 collate utf8_general_ci");

$sth11->execute();
$sth11->finish(); 

my $dbh1=DBI->connect("DBI:mysql:database=$db;host=$host","$usr","$pwd") or die $DBI::errstr;
$dbh1->{'mysql_enable_utf8'} = 1;
$dbh1->do('set names utf8');

$sth1=$dbh->prepare("select distinct word from swara order by word");
$sth1->execute();
while($ref1 = $sth1->fetchrow_hashref())
{
	$word = $ref1->{'word'};
	$triplets = '';
	$sth=$dbh->prepare("select triplet from swara where word='$word'");
	$sth->execute();
	while ($ref = $sth->fetchrow_hashref())
	{
		$triplet = $ref->{'triplet'};
		$triplets = $triplets . ";" . $triplet;
	}
	$triplets =~ s/^;//;
	
	$sth2=$dbh->prepare("insert into swara_index values('$word','$triplets')");
	
	$sth2->execute();
	$sth2->finish();
	
}

$dbh1->disconnect();
$dbh->disconnect();
