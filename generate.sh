#!/bin/sh

host="localhost"
db="grm"
usr="root"
pwd="mysql"

echo "DROP DATABASE IF EXISTS grm; CREATE DATABASE grm;" | /usr/bin/mysql -uroot -pmysql

perl insert_author.pl $host $db $usr $pwd
perl insert_books.pl $host $db $usr $pwd
perl insert_toc.pl $host $db $usr $pwd
