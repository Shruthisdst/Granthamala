#!/bin/sh

host="localhost"
db="Granthamala"
usr="root"
pwd="mysql"

echo "drop database Granthamala; create database Granthamala;" | /usr/bin/mysql -uroot -pmysql

perl insert_toc.pl $host $db $usr $pwd
