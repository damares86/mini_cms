<?php
$verify = new Verify($db);
$user = new User($db);
$settings = new Settings($db);
$role = new Role($db);
$post = new Post($db);
$portfolio = new Portfolio($db);
$plugins = new Plugins($db);
$page = new Page($db);
$menu = new Menu($db);
$home = new Home($db);
$file = new File($db);
$database = new Database($db);
$contact = new Contact($db);
$colors = new Colors($db);
$categories_portfolio = new Categories_Portfolio($db);
$categories = new Categories($db);
?>