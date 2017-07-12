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

$sth11=$dbh->prepare("CREATE TABLE GRM_author(authorname varchar(400), authid int(6) auto_increment, primary key(authid))auto_increment=10001 ENGINE=MyISAM character set utf8 collate utf8_general_ci;");
$sth11->execute();
$sth11->finish();

$line = <IN>;

while($line)
{
	if($line =~ /<s([0-9]+) title="(.*)" author="(.*)" page="(.*)" info="(.*)" type="(.*)" date="(.*)">/)
	{
		$authorname = $3;
		insert_authors($authorname);
    }
	$line = <IN>;
}

close(IN);
$dbh->disconnect();


sub insert_authors()
{
	my($authorname) = @_;

	$authorname =~ s/'/\\'/g;
	
	my($sth,$ref,$sth1);
	$sth = $dbh->prepare("select authid from GRM_author where authorname='$authorname'");
	$sth->execute();
	$ref=$sth->fetchrow_hashref();
	if($sth->rows()==0)
	{
		$sth1=$dbh->prepare("insert into GRM_author values('$authorname','0')");
		$sth1->execute();
		$sth1->finish();
	}
	$sth->finish();
}
