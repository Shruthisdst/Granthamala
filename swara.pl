#!/usr/bin/perl

$host = $ARGV[0];
$db = $ARGV[1];
$usr = $ARGV[2];
$pwd = $ARGV[3];

use DBI();

open(IN, "swara.xml") or die "Can't open swara.xml";

my $dbh=DBI->connect("DBI:mysql:database=$db;host=$host","$usr","$pwd");

$sth_enc=$dbh->prepare("set names utf8");
$sth_enc->execute();
$sth_enc->finish();

$sth11=$dbh->prepare("CREATE TABLE swara(
word text DEFAULT NULL, 
alias_word text DEFAULT NULL, 
triplet text DEFAULT NULL) ENGINE=MyISAM character set utf8 collate utf8_general_ci");

$sth11->execute();
$sth11->finish(); 

$line = <IN>;
while($line)
{
	chop($line);
	if($line =~ /<entry rukkuid="(.*)">/)
	{
		$triplet = $1;
		#~ print $triplet . "\n";
	}
	elsif($line =~ /<word>(.*)<\/word>/)
	{
		$word = $1;
		insert_swara($word, $triplet);
	}
	$line = <IN>;
}
close(IN);
$dbh->disconnect();

sub insert_swara()
{
	my($word, $triplet) = @_;
	my($sth1);

	$word =~ s/'/\\'/g;
	$pada = $word;
	$pada =~ s/॒//g;
	$pada =~ s/॑//g;
	
	$sth1=$dbh->prepare("insert into swara values('$word','$pada','$triplet')");
	
	$sth1->execute();
	$sth1->finish();
}

