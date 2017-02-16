#!/bin/sh

rm html/toc*.html
rm html/volume*.html

php gen_about.php
php gen_ananta.php
php gen_nagaraj.php
php gen_anuvadakaru.php
php gen_purana_list.php
php gen_treeview.php
php gen_granthagalu.php
