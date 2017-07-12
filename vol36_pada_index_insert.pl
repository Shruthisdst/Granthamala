#!/usr/bin/perl

use DBI();

open(IN, "89-1098_uni.txt") or die "Can't open 89-1098_uni.txt";

$host = $ARGV[0];
$db = $ARGV[1];
$usr = $ARGV[2];
$pwd = $ARGV[3];

my $dbh=DBI->connect("DBI:mysql:database=$db;host=$host","$usr","$pwd");

$sth_enc=$dbh->prepare("set names utf8");
$sth_enc->execute();
$sth_enc->finish();

$sth11=$dbh->prepare("CREATE TABLE pada_index(
word varchar(2000), 
occurrence int(2), 
index_id int(10) auto_increment, primary key(index_id))auto_increment=10001 ENGINE=MyISAM character set utf8 collate utf8_general_ci");
$sth11->execute();
$sth11->finish(); 

$line = <IN>;

while($line)
{
	chop($line);
	if($line =~ /<(.*)><([0-9]+)><([0-9]+)>/)
	{
		$word = $1;
		$page = $2;
		$occurrence = $3;
		insert_word($word,$occurrence);
	}
	$line = <IN>;
}

close(IN);
$dbh->disconnect();
#print $count . "\n";


sub insert_word()
{
	my($word,$occurrence) = @_;
	
	$word =~ s/'/\'/g;
	$word =~ s/\\//g;

	$sth12=$dbh->prepare("insert into pada_index values('$word','$occurrence','0')");
	$sth12->execute();
	$sth12->finish();
}
