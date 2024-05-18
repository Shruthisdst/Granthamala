#!/bin/sh

host="localhost"
db="grm"
usr="root"
pwd='Pass246!'

echo "DROP DATABASE IF EXISTS grm; CREATE DATABASE grm CHARACTER SET utf8 COLLATE utf8_general_ci;" | /usr/bin/mysql -uroot -p$pwd


perl akaradi.pl $host $db $usr $pwd
perl insert_rigtoc.pl $host $db $usr $pwd
perl rukku.pl $host $db $usr $pwd
perl vol36_pada_index_insert.pl $host $db $usr $pwd
perl vol36_triplet_index_insert.pl $host $db $usr $pwd

/usr/bin/mysql -uroot -p$pwd grm < akaradi_index.sql
/usr/bin/mysql -uroot -p$pwd grm < mandala_table.sql
/usr/bin/mysql -uroot -p$pwd grm < prelim_table.sql
