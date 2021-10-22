<?php

session_start();

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "***"; //请自己更改
$dbname = "***"; //请自己更改
$tbname = 'user'; 		//表格名称
$name = $_POST['name'];
$password = $_POST['password'];
$confirm = $_POST['confirm'];
$code = $_POST['code'];

/* 密码的验证 */
if ($password != $confirm) {
	echo "<script>alert('两次输入密码不一致！');location='../register.html';</script>";
}


/* 邀请码的查询 */
try {
	$conn = new PDO("mysql:host=$dbhost;dbname=$dbname;charset=$charset", $dbuser, $dbpass);

	$sql1 = "SELECT * FROM yqm where code='$code' and name is null";

	if ($query = $conn->query($sql1)) {
		/* 连接都是正常的 */
		/* 验证邀请码 */
		if ($query->rowCount() < 1) {
			echo "<script type='text/javascript'>alert('邀请码错误，请联系管理员（vx: hzxbetter） 获取'); location='../register.html';</script>";
			$conn = null; // 关闭连接
			exit;
		}

		/* 验证学号 */
		if ($conn->query("select * from user where name='$name'")->rowCount() >= 1) {
			echo "<script type='text/javascript'>alert('注册失败，该学号已被注册。'); location='../register.html';</script>";
			$conn = null; // 关闭连接
			exit;
		}

		/* 开始插入到 yqm 表 和 user 表 */
		$sql2 = "update yqm set name='$name' where code='$code'";
		$conn->exec($sql2);

		$sql3 = "INSERT INTO user (id, name, pwd, register_date,vx) VALUES(?,?,?,?,?)";


		$st = $conn->prepare("select * from yqm where code='$code'");
		$st->execute();
		$id = $st->fetch()['id'];

		$stmt = $conn->prepare($sql3);
		$stmt->bindValue(1, $id);
		$stmt->bindValue(2, $name);
		$stmt->bindValue(3, $password);
		$stmt->bindValue(4, date('Y-m-d H:i:s', time()));
		$stmt->bindValue(5, "无微信号");
		$count = $stmt->execute(); //执行预处理语句
		if ($count <> 0) {

			//登录成功，保存会话，在浏览器生存周期内保存
			$_SESSION['logined'] = 1;   //判断是否已经登录的依据。
			$_SESSION['user'] = $name;  //记录当前登录用户的学号。
			echo "<script type='text/javascript'>alert('注册成功，正在进入主页。');location='../main/share.php';</script>";
		} else {
			echo "<script type='text/javascript'>alert('注册失败，请使用其它用户名。'); location='../register.html';</script>";
		}
		$st = null;
		$stmt = null; //释放


	} else {
		echo "Query failed\n";
	}
	$conn = null; // 关闭连接
} catch (PDOException $e) {
	echo $e->getMessage();
}
