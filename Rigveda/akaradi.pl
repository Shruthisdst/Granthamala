#!/usr/bin/perl

$host = $ARGV[0];
$db = $ARGV[1];
$usr = $ARGV[2];
$pwd = $ARGV[3];

use DBI();

open(IN, "akaradi_uni.tex") or die "Can't open akaradi_uni.tex";

my $dbh=DBI->connect("DBI:mysql:database=$db;host=$host","$usr","$pwd");
$sth11=$dbh->prepare("CREATE TABLE akaradi_table(
akaradi varchar(5000), 
akaradi_id int(10) auto_increment, primary key(akaradi_id))auto_increment=1001 ENGINE=MyISAM character set utf8 collate utf8_general_ci");
$sth11->execute();
$sth11->finish(); 


$line = <IN>;

while($line)
{
	if($line =~ /<(.*)>/)
	{
		$words = $1;
		insert_word($words);
	}
	$line = <IN>;
}

close(IN);
$dbh->disconnect();
#print $count . "\n";


sub insert_word()
{
	my($words) = @_;
	
	$words =~ s/'/\'/g;
	$words =~ s/\\//g;

	$sth12=$dbh->prepare("insert into akaradi_table values('$words','')");
	$sth12->execute();
	$sth12->finish();
}
