<?php
include_once 'upload.func.php';
$fileInfo=$_FILES['myFile'];
$allowExt=array('txt');
$newName=uploadfile($fileInfo,$allowExt,20480000,'imooc',false);
echo $newName;
?>
