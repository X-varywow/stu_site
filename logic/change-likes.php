<?php
session_start();

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "***"; //请自己更改
$dbname = "***"; //请自己更改

$name = $_SESSION['user'];   //学号
$id = $_POST['id'];

/* 获取服务器的消息 */
try {
    $conn = new PDO("mysql:host=$dbhost;dbname=$dbname;charset=$charset", $dbuser, $dbpass);
	$con = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
	$res = $con->query("select * from likes where id=$id");
	$flag = 1;
	while($row = $res->fetch_assoc()) {
	    if($row["name"]==$name){
	        $flag = 0;
	        break;
	    }
	}
	if($flag){
	    $stmt = $conn->prepare("INSERT INTO likes (id, name) VALUES(?,?)");
        $stmt->bindValue(1, $id); //绑定参数
        $stmt->bindValue(2, $name);
        $stmt->execute(); 
        $stmt = null;
        echo 1;
	}else{
	    $stmt = $conn->prepare("delete from likes where id=$id and name=$name");
        $stmt->execute(); 
        $stmt = null;
	    
	}
    $con = null;
	$conn = null; // 关闭连接
} catch (PDOException $e) {
	echo $e->getMessage();
}
?>