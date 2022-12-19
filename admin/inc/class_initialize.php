<?php
$verify = new Verify($db);
$verify->prx = "dm_";
$user = new User($db);
$user->prx = "dm_";
$settings = new Settings($db);
$settings->prx = "dm_";
$role = new Role($db);
$role->prx = "dm_";
$plugins = new Plugins($db);
$plugins->prx = "dm_";
$page = new Page($db);
$page->prx = "dm_";
$menu = new Menu($db);
$menu->prx = "dm_";
$home = new Home($db);
$home->prx = "dm_";
$file = new File($db);
$file->prx = "dm_";
$database = new Database($db);
$database->prx = "dm_";
$contact = new Contact($db);
$contact->prx = "dm_";
$colors = new Colors($db);
$colors->prx = "dm_";
?>