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
    $(document).ready(function() {
      $.post("../logic/hphoto-info.php",function(data,status){
          if(data){
              $("#hphoto").attr("src",data);
          }
      });
      // 提交一个ajax请求用于获取信息
      $.post("../logic/ajax-info.php",{typ:4}, function(data,status){
          $("header").after(data);
      });
    });
  </script>
  <title>吐槽</title>
</head>

<body class="content">
     <header class="p-2 mb-3 border-bottom">
        <div class="container">
          <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
              <li><a href="./share.php" class="nav-link px-2 link-dark">分享</a></li>
              <li><a href="./trans.php" class="nav-link px-2 link-dark">闲置</a></li>
              <li><a href="./ahelp.php" class="nav-link px-2 link-dark">求助</a></li>
              <li><a href="#" class="nav-link px-2 link-primary">吐槽</a></li>
              <li><a href="./activity.php" class="nav-link px-2 link-dark">活动</a></li>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
</body>

</html>