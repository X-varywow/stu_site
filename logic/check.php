<?php

session_start();

// 登录验证

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "***"; //请自己更改
$dbname = "***"; //请自己更改
$tbname = 'user'; 		//表格名称
$name = $_POST['name'];
$password = $_POST['password'];

try {
	$conn = new PDO("mysql:host=$dbhost;dbname=$dbname;charset=$charset", $dbuser, $dbpass);
	$sql = "SELECT * FROM $tbname where name='$name'and pwd='$password'";

	if ($query = $conn->query($sql)) {
		if ($query->rowCount() < 1)	//如果数据库中找不到对应数据
		{
			echo "<script type='text/javascript'>alert('账号或密码错误'); location='../index.html';</script>";
		} else {
			//登录成功，保存会话，在浏览器生存周期内保存
			$_SESSION['logined'] = 1;   //判断是否已经登录的依据。
			$_SESSION['user'] = $name;  //记录当前登录用户的学号。
			echo "<script type='text/javascript'>location='../main/share.php';</script>";
		}
	} else {
		echo "Query failed\n";
	}
	$conn = null; // 关闭连接
} catch (PDOException $e) {
	echo $e->getMessage();
}
