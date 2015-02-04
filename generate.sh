#!/bin/sh

host="localhost"
db="Granthamala"
usr="root"
pwd="mysql"

echo "drop database if exists Granthamala; create database Granthamala;" | /usr/bin/mysql -uroot -pmysql


perl GRM_author.pl $host $db $usr $pwd
perl GRM_bookid.pl $host $db $usr $pwd
perl insert_toc.pl $host $db $usr $pwd
