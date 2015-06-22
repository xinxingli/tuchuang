<?php
header('content-type:text/html;charset=utf-8');
$filename=$_FILES['myfile']['name'];
$type=$_FILES['myfile']['type'];
$tmp_name=$_FILES['myfile']['tmp_name'];
$error=$_FILES['myfile']['error'];
$size=$_FILES['myfile']['size'];
if($error==0){
	//move_uploaded_file($tmp_name,"upload/".$filename);
	if(move_uploaded_file($tmp_name,"upload/".$filename)){
		echo $filename." 上传成功！";
	}else{
		echo $filename." 上传失败！";
	}
}else{
	switch($error){
		case 1:
		echo "上传文件超过了PHP配置文件中upload_max_filesize的值！";
		break;
		case 2:
		echo "上传文件超过了HTML表单中MAX_FILE_SIZE指定的值！";
		break;
		case 3:
		echo "文件只有部分被上传！";
		break;
		case 4:
		echo "没有选择上传的文件！";
		break;
	}
	
}

?>
