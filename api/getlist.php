<?php include_once "../base.php";

$type=$_GET['type'];

$news=$News->all(['type'=>$type]);
foreach($news as $n){
    echo "<div>";
    echo "<a href='javascript:getNews(".$n['id'].")'>".$n['title']."</a>";
    echo "</div>";
}