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
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="keywords" content="北语" />
  <meta name="description" content="校园生活信息整理" />
  <meta name="author" content="hzxbetter" />
  <link rel="shortcut icon" href="../favicons/1.png">
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
  <title>发表</title>
</head>

<body class="content">
     <header class="p-2 mb-3 border-bottom">
        <div class="container">
          <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
              <li><a href="./share.php" class="nav-link px-2 link-dark">分享</a></li>
              <li><a href="./trans.php" class="nav-link px-2 link-dark">闲置</a></li>
              <li><a href="./ahelp.php" class="nav-link px-2 link-dark">求助</a></li>
              <li><a href="./tucao.php" class="nav-link px-2 link-dark">吐槽</a></li>
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
  <main>
      <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

    <section class="p-5">
      <div class="container">
        <form class="row g-3" action="../logic/save-message.php" method="post" role="form" enctype="multipart/form-data">

          <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">标题</label>
            <input type="text" name="title" class="form-control" maxlength="20" id="exampleFormControlInput1" placeholder="20字以内（一般不选）" >
          </div>

          <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">内容</label>
            <textarea class="form-control" name="content" placeholder="160字以内" id="exampleFormControlTextarea1" required rows="6" maxlength="160"></textarea>
          </div>

          <div class="mb-3">
            <label for="formFileMultiple" class="form-label">上传图片</label>
            <input class="form-control" type="file" name="file" accept="image/*" id="formFileMultiple">
            <img class="rounded" style="height:200px;margin-top:30px" src="" alt="" id="preview">
          </div>

          <div class="col-md-3">
            <label for="form-selects" class="form-label">选择分类</label>
            <select class="form-select" name="type" aria-label="Default select example" required>
              <option selected disabled value="">请选择分类</option>
              <option value="1">分享</option>
              <option value="2">闲置</option>
              <option value="3">求助</option>
              <option value="4">吐槽</option>
            </select>
          </div>

          <div class="col-md-3">
            <label for="form-selects" class="form-label">添加标签</label>
            <select class="form-select" aria-label="Default select example">
              <option selected>暂不开放</option>
              <option value="1">tags1</option>
              <option value="2">tags2</option>
              <option value="3">tags3</option>
              <option value="4">tags4</option>
              <option value="5">tags5</option>
            </select>
          </div>

          <div class="col-12">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" id="gridCheck">
              <label class="form-check-label" for="gridCheck">
                请文明言语，友善交流。
              </label>
            </div>
          </div>

          <div class="col-12">
            <button type="submit" class="btn btn-primary">提交</button>
          </div>
        </form>
      </div>
    </section>
  </main>
  <script>
    $('input[type="file"]').change(function(e) {
      reader = new FileReader();
      reader.readAsDataURL(e.target.files[0]);
      reader.onload = function() {
        $('#preview').attr('src', reader.result);
      };
    });
  </script>
</body>

</html>