<?php
$verify = new Verify($db);
$verify->prx = "test__";
$user = new User($db);
$user->prx = "test__";
$settings = new Settings($db);
$settings->prx = "test__";
$role = new Role($db);
$role->prx = "test__";
$plugins = new Plugins($db);
$plugins->prx = "test__";
$page = new Page($db);
$page->prx = "test__";
$menu = new Menu($db);
$menu->prx = "test__";
$home = new Home($db);
$home->prx = "test__";
$file = new File($db);
$file->prx = "test__";
$database = new Database($db);
$database->prx = "test__";
$contact = new Contact($db);
$contact->prx = "test__";
$colors = new Colors($db);
$colors->prx = "test__";
?>