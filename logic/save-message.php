<?php
session_start();
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "***"; //请自己更改
$dbname = "***"; //请自己更改
$tbname = 'message'; 		//表格名称

$name = $_SESSION['user'];   //学号
$title = $_POST['title'];
$content = $_POST['content'];
$type = $_POST['type'];


/* 保存数据到 message 表 */
try {
    $conn = new PDO("mysql:host=$dbhost;dbname=$dbname;charset=$charset", $dbuser, $dbpass);
    
	if ($_FILES["file"]["error"]) {
	    
		$sql = "INSERT INTO message (name, title, content, likes, edate, type) VALUES(?,?,?,0,?,?)";

		$stmt = $conn->prepare($sql);
		$stmt->bindValue(1, $name); //绑定参数
		$stmt->bindValue(2, $title);
		$stmt->bindValue(3, $content);
		$stmt->bindValue(4, date('Y-m-d H:i:s', time()));
		$stmt->bindValue(5, $type);
		$count = $stmt->execute(); //执行预处理语句
		
	} else {
		$filename = "../userimg/" . time() . $_FILES["file"]["name"];
		$filename = iconv("UTF-8", "gb2312", $filename);
		//检查文件或目录是否存在
		if (file_exists($filename)) {
			echo "该文件已存在";
		} else {
			//保存文件,   move_uploaded_file 将上传的文件移动到新位置  
			move_uploaded_file($_FILES["file"]["tmp_name"], $filename); //将临时地址移动到指定地址    
		}

		$sql = "INSERT INTO message (name, title, content, img, likes, edate, type) VALUES(?,?,?,?,0,?,?)";

		$stmt = $conn->prepare($sql);
		$stmt->bindValue(1, $name); //绑定参数
		$stmt->bindValue(2, $title);
		$stmt->bindValue(3, $content);
		$stmt->bindValue(4, $filename);
		$stmt->bindValue(5, date('Y-m-d H:i:s', time()));
		$stmt->bindValue(6, $type);
		$count = $stmt->execute(); //执行预处理语句
	}
	
	if ($count <> 0) {
		$stmt = null; //释放
		$conn = null; // 关闭连接
		echo "<script type='text/javascript'>alert('发表成功');location='../main/share.php';</script>";
	} else {
		$stmt = null; //释放
		$conn = null; // 关闭连接
		echo "<script type='text/javascript'>alert('发表失败，请联系管理员解决');location='../main/share.php';</script>";
	}
		
} catch (PDOException $e) {
	echo $e->getMessage();
}

?>

