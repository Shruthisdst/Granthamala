#!/usr/bin/perl

$host = $ARGV[0];
$db = $ARGV[1];
$usr = $ARGV[2];
$pwd = $ARGV[3];

use DBI();

open(IN, "89-1098_uni.txt") or die "Can't open 89-1098_uni.txt";
#open(FPLOG, "insert_log.txt") or die "Can't open insert_log.txt";

my $dbh=DBI->connect("DBI:mysql:database=$db;host=$host","$usr","$pwd");
$sth11=$dbh->prepare("CREATE TABLE triplet_index(
index_id int(5), 
mandala int(6),
sukta int(6),
rukku int(6)) ENGINE=MyISAM character set utf8 collate utf8_general_ci");

$sth11->execute();
$sth11->finish(); 

$line = <IN>;
$ln = 1;

while($line)
{
	chop($line);
	if($line =~ /<(.*)><([0-9]+)><([0-9]+)>/)
	{
		$word = $1;
		$page = $2;
		$occurrence = $3;
	}
	elsif($line =~ /([0-9]+)-([0-9]+)-([0-9]+)/)
	{
		$mandala = $1;
		$sukta = $2;
		$rukku = $3;
		insert_triplet($word,$occurrence,$mandala,$sukta,$rukku);
	}
	elsif($line =~ /([0-9]+)-([0-9]+)-([0-9]+)-([0-9]+)/)
	{
		$mandala = $1;
		$sukta = $2;
		$rukku = $3;
		$range = $4;
		for($i=$rukku;$i<=$range;$i++)
		{
			insert_triplet($word,$occurrence,$mandala,$sukta,$i);
		}
	}
	elsif($line =~ /^[\s]*$/)
	{
		print OUT $line . "\n";
	}
	else
	{
		print $line . "-->$ln\n";
	}
	$line = <IN>;
	$ln++;
}

close(IN);
$dbh->disconnect();
#print $count . "\n";


sub insert_triplet()
{
	my($word,$occurrence,$mandala,$sukta,$rukku) = @_;
	
	$word =~ s/'/\'/g;
	$word =~ s/\\//g;

	$sth12 = $dbh->prepare("select index_id from pada_index where word='$word' and occurrence='$occurrence'");
	$sth12->execute();	

	if($sth12->rows() > 0)
	{
		$ref12=$sth12->fetchrow_hashref();		
		$index_id = $ref12->{'index_id'};
		$sth12->finish();
				
		$sth13=$dbh->prepare("insert into triplet_index values('$index_id','$mandala','$sukta','$rukku')") or print FPLOG "$ln";
		$sth13->execute();
		$sth13->finish();
	}
	else
	{
		print "Problem-->$ln\n";
	}

}
