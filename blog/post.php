<?php

require_once("controller.php");
require_once("db.php");

$id = $_GET['id'];
$sql = "SELECT * FROM posts WHERE id = ?";
$post = db_query_get($sql, array($id));

if(!$post){
    flash_error('Det post findes ikke!');
    header('Location: posts.php');
    die();
} 

$author = db_query_get("SELECT * FROM users WHERE id = ?", array($post['user_id']));

$template_data = array('post'=>$post, 'author'=>$author);
$html = render("post.html", $template_data);

echo($html);

?>
