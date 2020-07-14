<?php include_once "../base.php";

$id = $_GET['id'];

$news = $News->find($id);
echo "<h4>",$news['title'],"</h4><br>";
echo nl2br($news['text']);
