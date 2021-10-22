<?php
session_start();
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "***"; //请自己更改
$dbname = "***"; //请自己更改

$name = $_SESSION['user'];   //学号
$content = $_POST['content'];


/* 保存数据到 message 表 */
try {
    $conn = new PDO("mysql:host=$dbhost;dbname=$dbname;charset=$charset", $dbuser, $dbpass);
	    
	$sql = "INSERT INTO comment (id, lou, content, user_id, edate) VALUES(?,?,?,?,?)";

	$stmt = $conn->prepare($sql);
	$stmt->bindValue(1, $_SESSION['message-id']);
	$stmt->bindValue(2, $_SESSION['lou']);
	$stmt->bindValue(3, $content);
	$stmt->bindValue(4, $name);
	$stmt->bindValue(5, date('Y-m-d H:i:s', time()));
	$count = $stmt->execute();
		
	$stmt = null; //释放
	$conn = null; // 关闭连接
	echo "<script type='text/javascript'>location='../main/share.php';</script>";
	
} catch (PDOException $e) {
	echo $e->getMessage();
}
?>