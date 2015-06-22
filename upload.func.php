<?php
$fileInfo=$_FILES['myFile'];
function uploadfile($fileInfo,$allowExt=array('jpeg','gif','jpg'),$maxSize='2048000',$uploadpath='uploads',$flag=true){
//error
if($fileInfo['error']>0){
    switch($fileInfo['error']){
		case 1:
		$mes="上传文件超过了PHP配置文件中upload_max_filesize的值！";
		break;
		case 2:
		$mes="上传文件超过了HTML表单中MAX_FILE_SIZE指定的值！";
		break;
		case 3:
		$mes="文件只有部分被上传！";
		break;
		case 4:
		$mes="没有选择上传的文件！";
		break;
}
exit($mes);
}

$ext=pathinfo($fileInfo['name'],PATHINFO_EXTENSION);
//$allowExt=array('gif','jpg','jpeg','png');
if(!in_array($ext,$allowExt)){
    exit('非法文本类型');
}

//$maxSize=2048000;
if($fileInfo['size']>$maxSize){
    exit("上传文件超过了PHP配置文件中upload_max_filesize的值");
}

//$flag=ture;
if($flag){
if(!getimagesize($fileInfo['tmp_name'])){
	exit('不是真实的图片！');
}
}

if(!is_uploaded_file($fileInfo['tmp_name'])){
    exit('文件不是通过POST方式上传！');
}

//$uploadpath='uploads';
if(!file_exists($uploadpath)){
	mkdir($uploadpath,0777,true);
	chmod($uploadpath,0777);
}
$uniName=md5(uniqid(microtime(true),true)).'.'.$ext;
$destination=$uploadpath.'/'.$uniName;
if(!@move_uploaded_file($fileInfo['tmp_name'],$destination)){
    exit('文件移动失败');
}
// echo "文件上传成功";
// return array(
	// 'newName'=> $destination,
	// 'size'=> $fileInfo['size'],
	// 'type'=> $fileInfo['type']	
// )
return $destination;
}

?>
