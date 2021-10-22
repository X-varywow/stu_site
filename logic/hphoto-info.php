<?php
session_start();

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "***"; //请自己更改
$dbname = "***"; //请自己更改
$tbname = 'message'; 		//表格名称

$name = $_SESSION['user'];   //学号

/* 获取服务器的消息 */
try {
	$conn = new PDO("mysql:host=$dbhost;dbname=$dbname;charset=$charset", $dbuser, $dbpass);
	
	$st = $conn->prepare("select * from user where name='$name'");
	$st->execute();
	$img_url = $st->fetch()['hphoto'];
	
	echo $img_url;

    $st = null;
	$conn = null; // 关闭连接
		
} catch (PDOException $e) {
	echo $e->getMessage();
}
?>