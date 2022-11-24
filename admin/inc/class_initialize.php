<?php
$verify = new Verify($db);
$user = new User($db);
$time = new Time($db);
$settings = new Settings($db);
$role = new Role($db);
$post = new Post($db);
$plugins = new Plugins($db);
$page = new Page($db);
$menu = new Menu($db);
$home = new Home($db);
$file = new File($db);
$database = new Database($db);
$contact = new Contact($db);
$colors = new Colors($db);
$categories = new Categories($db);
?>