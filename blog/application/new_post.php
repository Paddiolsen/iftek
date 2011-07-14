<?php

include("base_controller.php");
include("forms/post_form.php");
include("models/post.php");

login_required();
$form = new PostForm($_POST);

if($form->validate_on_submit()){
	$post = new Post();
	$form->populate_obj($post);
	
	// $db->session->add($post);
	// $db->session->save();
	// FIXME: include a message here
	
	header('Location: /posts.php');
	die();	
}

echo(render("new_post_form.html", array(form=>$form)));

?>
