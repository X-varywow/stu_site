<?php
session_start();
if (!$_SESSION['logined']) {
  header("Location: ../index.html");
}
?>
<!DOCTYPE html>
<html lang="zh-CN">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="keywords" content="北语" />
  <meta name="description" content="校园生活信息整理" />
  <meta name="author" content="hzxbetter" />
  <link rel="shortcut icon" href="../favicons/1.png">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/main.css">
  <link href="https://cdn.bootcdn.net/ajax/libs/twitter-bootstrap/5.0.2/css/bootstrap.min.css" rel="stylesheet">
  <script src="../js/jquery.min.js" type="text/javascript"></script>
  <script>
      $.post("../logic/hphoto-info.php",function(data,status){
          if(data){
              $("#hphoto").attr("src",data);
          }
      });
  </script>
  <title>活动</title>
</head>

<body class="content">
     <header class="p-2 mb-3 border-bottom">
        <div class="container">
          <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
              <li><a href="./share.php" class="nav-link px-2 link-dark"><i class="fa fa-comment-o"></i>&nbsp;分享</a></li>
              <li><a href="./trans.php" class="nav-link px-2 link-dark ">闲置</a></li>
              <li><a href="./ahelp.php" class="nav-link px-2 link-dark">求助</a></li>
              <li><a href="./tucao.php" class="nav-link px-2 link-dark">吐槽</a></li>
              <li><a href="#" class="nav-link px-2 link-primary">活动</a></li>
            </ul>
    
            <form method="post" class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3">
              <input type="search" class="form-control" name="pat" placeholder="Search..." aria-label="Search">
            </form>
    
            <div class="dropdown text-end">
              <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="../hphotos/default.jpg" width="32" height="32" class="rounded-circle" id="hphoto">
              </a>
              <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser1">
                <li><a class="dropdown-item" href="./self.php">个人中心</a></li>
                <li><a class="dropdown-item" href="./publish.php">发表</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="../index.html">退出</a></li>
              </ul>
            </div>
          </div>
        </div>
      </header>
    <main>
      <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    
    <section class="p-5">
      <div class="contaiter">
        <h3 style="text-align:center;">该栏目用于以后展示一些活动，为北语的同学营造一个友善和谐的本校网络社区。</h3>
        <h2 style="margin-top: 5rem; color:#f77f00;">暂未开放</h2>
        <h2 style="text-align:right">未完待续。。。</h2>
        <div class='info'>
        <text>
            <h3>一些想说的话:</h3>
            <ul>
                <li>❤感谢到访</li>
                <li>登录界面右上角是北语的图标，点击会显示更新公告</li>
                <li>看着自己写出来的网站，真的超开心</li>
                <li>建站的技术栈：linux, nginx, html, css, js, jquery, ajax, bootstrap5, php, mysql, phpmyadmin</li>
                <li>当时是一时觉得无聊想建个网站，还能放简历里</li>
                <li>现在网站主要以实用性为主，欢迎同学们多多宣传，有好的idea都可以联系的。</li>
            </ul>
        </text>
        </div>
        <h3 style="color:#6247aa">网站交流反馈群：</h3>
        <img src ="../img/code.jpg" class="img-fluid" style="max-width:300px">
      </div>
    </section>
    </main>
</body>

</html>