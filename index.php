<?php
require_once 'class_loader.php';

$sum1To10 = new AsyncJob(new Sum1To10Job());

echo 'Birden ona kadar olan sayıları toplayacak. <br/>';
echo 'Bu işlem 10 saniye sürecektir.<br/>';

var_dump($sum1To10->getResult());

echo 'İşlem bitti';
?>