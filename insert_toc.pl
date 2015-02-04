#!/usr/bin/perl

$host = $ARGV[0];
$db = $ARGV[1];
$usr = $ARGV[2];
$pwd = $ARGV[3];

use DBI();

open(IN,"grm_books_toc.xml") or die "can't open grm_books_toc.xml\n";

my $dbh=DBI->connect("DBI:mysql:database=$db;host=$host","$usr","$pwd");

$sth_enc=$dbh->prepare("set names utf8");
$sth_enc->execute();
$sth_enc->finish();

$sth1=$dbh->prepare("CREATE TABLE GM_Toc(
book_id varchar(4),
btitle varchar(2000),
ctitle varchar(2000),
level int(2),
title varchar(10000),
start_pages varchar(20),
end_pages varchar(20),
slno int(6) auto_increment, primary key(slno)) auto_increment=10001 ENGINE=MyISAM character set utf8 collate utf8_general_ci");

$sth1->execute();
$sth1->finish();

$line = <IN>;
$scount = 0;

while($line)
{
	chop($line);
	
	if($line =~ /<book code="(.*)"[\s]+btitle="(.*)"[\s]ctitle="(.*)"><\/book>/)
	{
		$book_id = $1;
		$btitle = $2;
		$ctitle = $3;
        #print $book_id ."\n";
        if($line =~ /<book code="(.*)"[\s]+btitle="ಂಇಸಿ"[\s]+ctitle="ಂಇಸಿ"><\/book>/)
        {
        }
        else
        {
            insert_to_db($book_id,$btitle,$ctitle);
        }
	}
    elsif($line =~ /<book code="(.*)"[\s]+btitle="(.*)"[\s]+ctitle="(.*)">/)
	{
		$book_id = $1;
		$btitle = $2;
        $ctitle = $3;

        #print $book_id."\n";
	}
	elsif($line =~ /<s([1-4]+)[\s]+title="(.*)"[\s]+page="(.*)-(.*)">/)
	{
		$level = $1;
		$title = $2;
		$start_pages = $3;
		$end_pages = $4;
        $start_pages =~ s/^[0]+//g;
        $end_pages =~ s/^[0]+//g;
        if($start_pages =~ /^[0+a-z]/)
        {
            $spage = "0000" . $start_pages;
        }
        elsif($start_pages < 10)
        {
            $spage = "000" . $start_pages;
        }
        elsif($start_pages < 100)
        {
            $spage = "00" . $start_pages;
        }
        elsif($start_pages < 1000)
        {
            $spage = "0" . $start_pages;
        }
        else
        {
            $spage = $start_pages;
        }

        if($end_pages < 10)
        {
            $epage = "000" . $end_pages;
        }
        elsif($end_pages < 100)
        {
            $epage = "00" . $end_pages;
        }
        elsif($end_pages < 1000)
        {
            $epage = "0" . $end_pages;
        }
        else
        {
            $epage = $end_pages;
        }
        #print $spage."-".$epage."\n";

		insert_to_db($book_id,$btitle,$ctitle,$level,$title,$spage,$epage);
		$title =  "";
		$level = "";
		$spage = "";
		$epage = "";
		$scount++;
	}
	elsif($line =~ /<s([1-4]+)[\s]+title="(.*)"[\s]+page="(.*)">/)
	{
		$level = $1;
		$title = $2;
		$start_pages = $3;
        #print $start_pages ."\n";
        
        $start_pages =~ s/^[0]+//g;

        if($start_pages =~ /^[0+a-z]/)
        {
            $spage = "0000" . $start_pages;
        }
        elsif($start_pages < 10)
        {
            $spage = "000" . $start_pages;
        }
        elsif($start_pages < 100)
        {
            $spage = "00" . $start_pages;
        }
        elsif($start_pages < 1000)
        {
            $spage = "0" . $start_pages;
        }
        else
        {
            $spage = $start_pages;
        }
        
        #print $spage ."\n"; 

		insert_to_db($book_id,$btitle,$ctitle,$level,$title,$spage);
		$title =  "";
		$level = "";
		$spage = "";
		$scount++;
	}
	elsif($line =~ /<\/s([1-4]+)>/)
	{
	}
	else
	{
		#~ print $line . "\n";
	}

$line = <IN>;
}

close(IN);


sub insert_to_db()
{
	my($book_id,$btitle,$ctitle,$level,$title,$spage,$epage) = @_;
	my($sth2);

	$btitle =~ s/'/\\'/g;
	$title =~ s/'/\\'/g;
    
    #~ print 'TOC->' . $book_id . "\n";
    
	$sth2=$dbh->prepare("insert into GM_Toc values('$book_id','$btitle','$ctitle','$level','$title','$spage','$epage','')");
	$sth2->execute();
	$sth2->finish();
}

