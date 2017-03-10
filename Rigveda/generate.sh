#!/bin/sh

host="localhost"
db="Rigveda1"
usr="root"
pwd='mysql'

echo "DROP DATABASE IF EXISTS Rigveda1; CREATE DATABASE Rigveda1 CHARACTER SET utf8 COLLATE utf8_general_ci;" | /usr/bin/mysql -uroot -p$pwd


perl akaradi.pl $host $db $usr $pwd
perl insert_toc.pl $host $db $usr $pwd
perl rukku.pl $host $db $usr $pwd
perl vol36_pada_index_insert.pl $host $db $usr $pwd
perl vol36_triplet_index_insert.pl $host $db $usr $pwd

/usr/bin/mysql -uroot -p$pwd Rigveda1 < akaradi_index.sql
/usr/bin/mysql -uroot -p$pwd Rigveda1 < mandala_table.sql
/usr/bin/mysql -uroot -p$pwd Rigveda1 < prelim_table.sql
