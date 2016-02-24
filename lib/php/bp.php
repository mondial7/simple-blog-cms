<?php

$date = date("Y-m-d-h-i-sa");

$n_1 = count(scandir("backup/data/"));
$source_1 = "user.json";
$newname_1 = "user_data".$n_1."_".$date.".json";
$bp_1 = "backup/data/".$newname_1;
copy($source_1,$bp_1);

echo 'Backup eseguito';

?>