<?php
session_start();

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "***"; //请自己更改
$dbname = "***"; //请自己更改

$name = $_SESSION['user'];   //学号
$type = $_POST["typ"];
          
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

/* 获取服务器的消息 */
try {
	$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
	if($type==9){
	    $result = $conn->query("select * from message where name=$name ORDER BY edate DESC");
	}else{
	    $result = $conn->query("select * from message where type=$type ORDER BY edate DESC");
	}
	
	echo "<section class='p-0'>";
	echo "<div class='container'>";
	echo "<div class='row row-cols-1 row-cols-xl-4 g-4'>";
	while($row = $result->fetch_assoc()) {
	    $card_name = $row["name"];
	    $card_id = $row["id"];
    	$st = $conn->query("select * from user where name= $card_name");
    	$user_row = $st->fetch_assoc();
    	$st = null;
    	
    	$likes_flag=$conn->query("select * from likes where name= $name and id=$card_id")->num_rows;
    	
    	$likes = $conn->query("select * from likes where id=$card_id")->num_rows;
    	$pl_cnt=$conn->query("select * from comment where id=$card_id")->num_rows;
	
	    echo "<div class='col'>";
	    echo "<div class='card h-100' id='$card_id'>";
	    echo "<div class='card-body'>";
	    if($user_row["hphoto"]){
	       echo "<div class='card-title'><img src='" .$user_row["hphoto"]. "' width='32' height='32' data-bs-toggle='tooltip' data-bs-placement='top' title=".$user_row['vx']." class='rounded-circle message-img'><h6>";
	    }else{
	        echo "<div class='card-title'><img src='../hphotos/default.jpg' width='32' height='32' data-bs-toggle='tooltip' data-bs-placement='top' title=".$user_row['vx']." class='rounded-circle message-img'><h6>";
	    }
	    echo $user_row['nickname']."</h6></div>";
	    
	    echo "<p class='card-text'><h5>".$row["title"]."</h5>".$row["content"]."</p>";
	    if ($row["img"]){
	        echo "<img src=". $row["img"] . " class='card-img' alt='...'>";
	    }
	    echo "</div>";
	    echo "<div class='card-footer'>";
        echo "<div class='pl'><img class='pl-ico' src='../favicons/comment.png' alt=''><span id='pl-cnt'>".$pl_cnt."</span></div>";
        if($likes_flag){
            echo "<div class='dianzan'><img class='likes-ico' src='../favicons/liker.png' alt=''><span id='likes-cnt'>".$likes."</span></div>";
        }else{
            echo "<div class='dianzan'><img class='likes-ico' src='../favicons/like.png' alt=''><span id='likes-cnt'>".$likes."</span></div>";
        }
        echo "<small class='text-muted'>".tranTime($row["edate"])."</small>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
    }
    echo "</div>";
    echo "</div>";
    echo "</section>";
    echo <<<EOF
<script>
$(document).ready(function() {
  $(".likes-ico").click(function() {
      var tmp = $(this);
      $.post("../logic/change-likes.php",{id:$(this).parent().parent().parent()[0].id},function(data,status){
          if(data){
            tmp.next()[0].innerHTML++;
            tmp.attr("src", "../favicons/liker.png");  
          }else{
            tmp.next()[0].innerHTML--;
            tmp.attr("src", "../favicons/like.png");  
          }
      });
  });
  $(".pl-ico").click(function() {
      $.post("../logic/gain-comment.php",{id:$(this).parent().parent().parent()[0].id},function(data,status){
      $("body").append(data);
      $("body").css({overflow:"hidden"});
      });
  });
  $(".card-img").click(function(){
      window.open($(this)[0].src);
  });
});
var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
  return new bootstrap.Tooltip(tooltipTriggerEl)
})
</script>
EOF;

	$conn = null; // 关闭连接
		
} catch (PDOException $e) {
	echo $e->getMessage();
}


?>