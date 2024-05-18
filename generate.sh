#!/bin/sh

host="localhost"
db="grm"
usr="root"
pwd="Pass246!"

echo "DROP DATABASE IF EXISTS grm; CREATE DATABASE grm CHARACTER SET utf8 COLLATE utf8_general_ci;" | /usr/bin/mysql -uroot -p$pwd

#GRM
perl insert_author.pl $host $db $usr $pwd
perl insert_books.pl $host $db $usr $pwd
perl insert_toc.pl $host $db $usr $pwd

#Rigveda
perl akaradi.pl $host $db $usr $pwd
perl insert_rigtoc.pl $host $db $usr $pwd
perl rukku.pl $host $db $usr $pwd

#~ perl vol36_pada_index_insert.pl $host $db $usr $pwd
#~ perl vol36_triplet_index_insert.pl $host $db $usr $pwd

perl swara.pl $host $db $usr $pwd
perl index.pl $host $db $usr $pwd

/usr/bin/mysql -uroot -p$pwd $db < akaradi_index.sql
/usr/bin/mysql -uroot -p$pwd $db < mandala_table.sql
/usr/bin/mysql -uroot -p$pwd $db < prelim_table.sql

mysqldump grm swara -u root -p > swara.sql
mysqldump grm swara_index -u root -p > swara_index.sql

/usr/bin/mysql -uroot -p$pwd $db < swara.sql
/usr/bin/mysql -uroot -p$pwd $db < swara_index.sql 

# echo "DROP TABLE IF EXISTS swara;" | /usr/bin/mysql -uroot -p$pwd $db

