#!/usr/bin/perl 

$host = $ARGV[0];
$db = $ARGV[1];
$usr = $ARGV[2];
$pwd = $ARGV[3];

use DBI();

open(IN, "Rigveda_uni.xml") or die "can't open Rigveda_uni.xml\n";

my $dbh=DBI->connect("DBI:mysql:database=$db;host=$host","$usr","$pwd");

$sth_enc=$dbh->prepare("set names utf8");
$sth_enc->execute();
$sth_enc->finish();

$sth11=$dbh->prepare("CREATE TABLE Rukku_table(mandala int(6),
sukta int(6),
rukku int(6),
rishi varchar(2000),
chandas varchar(200),
devata varchar(1000),
text1 varchar(5000),
text2 varchar(5000),
text3 varchar(5000),
rukku_id int(10) NOT NULL AUTO_INCREMENT,
PRIMARY KEY (rukku_id))AUTO_INCREMENT=1");

$sth11->execute();
$sth11->finish();

$line = <IN>;
while($line)
{
	if($line =~ /<mandala msankhya="(.*)">/)
	{
		$mandala = $1;
		print $mandala."\n";
	}
	elsif($line =~ /<\/mandala>/)
	{
		$mandala = "";
	}
	elsif($line =~ /<sukta ssankhya="(.*)">/)
	{
		$sukta = $1;
	}
	elsif($line =~ /<\/sukta>/)
	{
		$sukta = "";
	}
	elsif($line =~ /<mantra sankhya="(.*)">/)
	{
		$rukku = $1;
	}
	elsif($line =~ /<rishi>(.*)<\/rishi>/)
	{
		$rishi = $1;
		#print $rishi."\n";
	}
	elsif($line =~ /<chandas>(.*)<\/chandas>/)
	{
		$chandas = $1;
	}
	elsif($line =~ /<text1 devata="(.*)">(.*)<\/text1>/)
	{
		$devata = $1;
		$text1 = $2;
		#print $devata."->".$text1."\n";
		#print $text1."\n";
	}
	elsif($line =~ /<text2 devata="(.*)">(.*)<\/text2>/)
	{
		$text2 = $2;
		#print $text2."\n";
	}
	elsif($line =~ /<text3 devata="(.*)">(.*)<\/text3>/)
	{
		$text3 = $2;
		#print $text2."\n";
	}
	elsif($line =~ /<\/mantra>/)
	{
		insert_article($mandala,$sukta,$rukku,$rishi,$chandas,$devata,$text1,$text2,$text3);
		$rishi = "";
		$chandas = "";
		$devata = "";
		$text1 = "";
		$text2 = "";
		$text3 = "";
	}
	$line = <IN>;
}
close(IN);
$dbh->disconnect();

sub insert_article()
{
	my($mandala,$sukta,$rukku,$rishi,$chandas,$devata,$text1,$text2,$text3) = @_;
	my($sth1);

	$rishi =~ s/'/\\'/g;
	$chandas =~ s/'/\\'/g;
	$devata =~ s/'/\\'/g;
	$text1 =~ s/'/\\'/g;
	$text2 =~ s/'/\\'/g;
	$text3 =~ s/'/\\'/g;

	$sth1=$dbh->prepare("insert into Rukku_table values('$mandala','$sukta','$rukku','$rishi','$chandas','$devata','$text1','$text2','$text3','0')");
	$sth1->execute();

	$sth1->finish();
}
