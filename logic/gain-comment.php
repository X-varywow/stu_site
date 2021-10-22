<?php
session_start();

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "***"; //请自己更改
$dbname = "***"; //请自己更改

$name = $_SESSION['user'];
$id = $_POST['id'];
$_SESSION['message-id'] = $id;  //只有在查看评论，发表评论时才会用到
$_SESSION['lou'] = 1;    //每次获取评论都会初始化楼


function tranTime($time)
{
    $time = strtotime($time);
    $time = time() - $time;
          
    if ($time < 60)
    {
        $str = '刚刚';
    }
    elseif ($time < 60 * 60)
    {
        $min = floor($time/60);
        $str = $min.'分钟前';
    }
    elseif ($time < 60 * 60 * 24)
    {
        $h = floor($time/(60*60));
        $str = $h.'小时前';
    }
    elseif ($time < 60 * 60 * 24 * 30)
    {
        $d = floor($time/(60*60*24));
        if($d==1)
            $str = '昨天';
        else
            $str = $d.'天前';
    }
    elseif($time < 60 * 60 * 24 * 30 * 12)
    {
        $m = floor($time/(60*60*24*30));
        $str = $m.'月前';
    }else{
        $str = "1年前";
    }
    return $str;
} 

$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

$main_res = $conn->query("select * from message where id=$id")->fetch_assoc();
$main_title = $main_res["title"];
$main_content = $main_res["content"];
$main_img = $main_res["img"];
$main_name = $main_res["name"];

$card_res = $conn->query("select * from user where name=$main_name")->fetch_assoc();
$card_img = $card_res["hphoto"];
if(! $card_img){
    $card_img = "../hphotos/default.jpg";
}
$card_nickname = $card_res["nickname"];
	
echo <<<EOF
<section class='p-5' id=$id>
    <div class="layout">
    <span class = "close">X</span>
    <div class="wrapper">
    <div class="c-h">
    <img src="$card_img" width='60' height='60' class='rounded-circle'>
    <h5 style="margin-left:2rem;display:inline">$card_nickname</h5>
    </div>
    <div id="c-c"><p>$main_content</p><img src="$main_img" style="height:15vh"></div>
EOF;

$res = $conn->query("select * from comment where id=$id order by lou");

while($row = $res->fetch_assoc()) {
    echo "<div class='c-c-p'><h6>第".$_SESSION['lou']."楼：</h6><h6 id='c-c-t'>".tranTime($row["edate"])."</h6>";
    echo "<p>".$row["content"]."</p></div>";
    $_SESSION['lou'] += 1;
}
$conn = null; // 关闭连接

echo <<<EOF
    <form class="beginpl" action="../logic/give-comment.php" method="post" role="form" enctype="multipart/form-data">
          <div>
            <label for="exampleFormControlTextarea1" class="form-label">评论</label>
            <textarea class="form-control" name="content" placeholder="50字以内" id="exampleFormControlTextarea1" required rows="3" maxlength="50"></textarea>
          </div>
          <div>
            <button type="submit" class="btn btn-primary mt-3" style="float:right">发表</button>
          </div>
        </form>
    </div>
    </div>
    
</section>
<script>
  $(".close").click(function() {
    $(".layout").remove();
    $("body").css({overflow:"visible"})
  });
</script>
EOF;

?>