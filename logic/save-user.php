<?php
session_start();
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "***"; //请自己更改
$dbname = "***"; //请自己更改
$dbname = "blcu_site";

$name = $_SESSION['user'];   //学号
$nickname = $_POST['nickname'];
$vx = $_POST['vx'];


/* 保存数据到 message 表 */
try {
    $conn = new PDO("mysql:host=$dbhost;dbname=$dbname;charset=$charset", $dbuser, $dbpass);
    
    if($nickname){
        $sql = "update user set nickname='$nickname' where name='$name'";
        $conn->exec($sql);
    }
    
    if($_FILES["file"]["name"]){
        $filename = "../hphotos/" . time() . $_FILES["file"]["name"];
		$filename = iconv("UTF-8", "gb2312", $filename);
		//检查文件或目录是否存在
		if (file_exists($filename)) {
			echo "该文件已存在";
		} else {
			//保存文件,   move_uploaded_file 将上传的文件移动到新位置  
			move_uploaded_file($_FILES["file"]["tmp_name"], $filename); 
		}

		$sql = "update user set hphoto='$filename'  where name='$name'";
		$conn->exec($sql);
    }
    if($vx){
        $sql = "update user set vx='$vx' where name='$name'";
        $conn->exec($sql);
    }
    $conn = null; // 关闭连接
    echo "<script type='text/javascript'>alert('修改成功');location='../main/self.php';</script>";
		
} catch (PDOException $e) {
	echo $e->getMessage();
}

?>