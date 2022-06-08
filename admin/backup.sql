

CREATE TABLE `accounts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `rolename` varchar(50) NOT NULL,
  `last_login` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO accounts VALUES("1","admin","$2y$10$MHzV3H489ypRvASQwFsA4.WHnSG75C8oOPuT3UIO46wHz8b2Hxeem","davidemasera@gmail.com","Admin","2022-06-08 14:18:10");



CREATE TABLE `categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO categories VALUES("1","Misc");



CREATE TABLE `color` (
  `id` int NOT NULL AUTO_INCREMENT,
  `color` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO color VALUES("1","#008db1");
INSERT INTO color VALUES("2","#00cc99");
INSERT INTO color VALUES("3","#000000");
INSERT INTO color VALUES("4","#ffffff");



CREATE TABLE `contacts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `reset` varchar(250) NOT NULL,
  `inbox` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO contacts VALUES("1","noreply@yoursite.com","info@yoursite.com");



CREATE TABLE `default_page` (
  `id` int NOT NULL AUTO_INCREMENT,
  `page_name` varchar(255) NOT NULL,
  `layout` varchar(255) NOT NULL DEFAULT 'default',
  `header` int DEFAULT '1',
  `img` varchar(255) NOT NULL DEFAULT 'visual.jpg',
  `block1_type` varchar(255) DEFAULT 't',
  `block1` text CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `block1_bg` varchar(255) DEFAULT 'none',
  `block1_text` varchar(255) DEFAULT '#000000',
  `block2_type` varchar(255) DEFAULT 'n',
  `block2` text CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci,
  `block2_bg` varchar(255) DEFAULT 'none',
  `block2_text` varchar(255) DEFAULT '#000000',
  `block3_type` varchar(255) DEFAULT 'n',
  `block3` text CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci,
  `block3_bg` varchar(255) DEFAULT 'none',
  `block3_text` varchar(255) DEFAULT '#000000',
  `block4_type` varchar(255) DEFAULT 'n',
  `block4` text CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci,
  `block4_bg` varchar(255) DEFAULT 'none',
  `block4_text` varchar(255) DEFAULT '#000000',
  `block5_type` varchar(255) DEFAULT 'n',
  `block5` text CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci,
  `block5_bg` varchar(255) DEFAULT 'none',
  `block5_text` varchar(255) DEFAULT '#000000',
  `block6_type` varchar(255) DEFAULT 'n',
  `block6` text CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci,
  `block6_bg` varchar(255) DEFAULT 'none',
  `block6_text` varchar(255) DEFAULT '#000000',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO default_page VALUES("1","index","default","1","visual.jpg","t","<p>This is your homepage</p>","none","#000000","n","","none","#000000","n","","none","#000000","n","","none","#000000","n","","none","#000000","n","","none","#000000");
INSERT INTO default_page VALUES("2","Blog","default","1","visual.jpg","t","","none","#000000","n","","none","#000000","n","","none","#000000","n","","none","#000000","n","","none","#000000","n","","none","#000000");
INSERT INTO default_page VALUES("3","Post","default","1","visual.jpg","t","","none","#000000","n","","none","#000000","n","","none","#000000","n","","none","#000000","n","","none","#000000","n","","none","#000000");
INSERT INTO default_page VALUES("4","Login","default","1","visual.jpg","t","","none","#000000","n","","none","#000000","n","","none","#000000","n","","none","#000000","n","","none","#000000","n","","none","#000000");
INSERT INTO default_page VALUES("5","Contact","default","1","visual.jpg","t","","none","#000000","n","","none","#000000","n","","none","#000000","n","","none","#000000","n","","none","#000000","n","","none","#000000");
INSERT INTO default_page VALUES("6","Gallery","default","1","visual.jpg","t","","none","#000000","n","","none","#000000","n","","none","#000000","n","","none","#000000","n","","none","#000000","n","","none","#000000");



CREATE TABLE `files` (
  `id` int NOT NULL AUTO_INCREMENT,
  `filename` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;




CREATE TABLE `menu` (
  `id` int NOT NULL AUTO_INCREMENT,
  `pagename` varchar(255) NOT NULL,
  `inmenu` int DEFAULT '0',
  `itemorder` int DEFAULT '0',
  `parent` tinyint(1) DEFAULT '0',
  `childof` varchar(255) DEFAULT 'none',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO menu VALUES("1","index","0","0","1","none");
INSERT INTO menu VALUES("2","Blog","0","0","1","none");
INSERT INTO menu VALUES("3","Login","1","0","1","none");
INSERT INTO menu VALUES("4","Contact","0","0","1","none");
INSERT INTO menu VALUES("19","Portfolio","0","0","0","none");
INSERT INTO menu VALUES("20","Portfolio","0","0","0","none");



CREATE TABLE `page` (
  `id` int NOT NULL AUTO_INCREMENT,
  `page_name` varchar(255) NOT NULL,
  `no_mod` int DEFAULT '0',
  `layout` varchar(255) NOT NULL DEFAULT 'default',
  `header` int DEFAULT '1',
  `img` varchar(255) NOT NULL DEFAULT 'visual.jpg',
  `block1_type` varchar(255) DEFAULT 't',
  `block1` text CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `block1_bg` varchar(255) DEFAULT 'none',
  `block1_text` varchar(255) DEFAULT '#000000',
  `block2_type` varchar(255) DEFAULT 'n',
  `block2` text CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci,
  `block2_bg` varchar(255) DEFAULT 'none',
  `block2_text` varchar(255) DEFAULT '#000000',
  `block3_type` varchar(255) DEFAULT 'n',
  `block3` text CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci,
  `block3_bg` varchar(255) DEFAULT 'none',
  `block3_text` varchar(255) DEFAULT '#000000',
  `block4_type` varchar(255) DEFAULT 'n',
  `block4` text CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci,
  `block4_bg` varchar(255) DEFAULT 'none',
  `block4_text` varchar(255) DEFAULT '#000000',
  `block5_type` varchar(255) DEFAULT 'n',
  `block5` text CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci,
  `block5_bg` varchar(255) DEFAULT 'none',
  `block5_text` varchar(255) DEFAULT '#000000',
  `block6_type` varchar(255) DEFAULT 'n',
  `block6` text CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci,
  `block6_bg` varchar(255) DEFAULT 'none',
  `block6_text` varchar(255) DEFAULT '#000000',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO page VALUES("20","Backup","1","default","1","visual.jpg","t","text","none","none","t"," text","none","none","t"," text","none","none","t","text ","none","none","t"," text","none","none","t"," text","none","none");



CREATE TABLE `password_reset_temp` (
  `email` varchar(250) NOT NULL,
  `token` varchar(250) NOT NULL,
  `expDate` datetime NOT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;




CREATE TABLE `plugins` (
  `id` int NOT NULL AUTO_INCREMENT,
  `plugin_name` varchar(255) NOT NULL,
  `link` varchar(255) DEFAULT NULL,
  `second_page` varchar(255) DEFAULT NULL,
  `description` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `sub_show_title` varchar(255) DEFAULT NULL,
  `sub_show_link` varchar(255) DEFAULT NULL,
  `sub_add_title` varchar(255) DEFAULT NULL,
  `sub_add_link` varchar(255) DEFAULT NULL,
  `active` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO plugins VALUES("2","Backup","index.php?man=backup&op=add","","Allows you to create a backup clone of your website with a db dump.","fa fa-database","side_backup","","","","","1");



CREATE TABLE `post` (
  `id` int NOT NULL AUTO_INCREMENT,
  `main_img` varchar(255) NOT NULL,
  `gall` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `summary` text CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `content` text CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `modified` datetime NOT NULL,
  `category_id` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO post VALUES("1","01.png","none","test","                d asfsadfgdsaf dsa sdaf          
            ","                sdf fhg rthu tfifcxcg sdrgdrf g        
            ","2022-05-25 13:45:55","1");



CREATE TABLE `roles` (
  `id` int NOT NULL AUTO_INCREMENT,
  `rolename` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO roles VALUES("1","Admin");
INSERT INTO roles VALUES("2","Editor");
INSERT INTO roles VALUES("3","Contributor");



CREATE TABLE `settings` (
  `id` int NOT NULL AUTO_INCREMENT,
  `site_name` varchar(255) NOT NULL,
  `site_description` varchar(255) NOT NULL,
  `use_text` int DEFAULT '1',
  `footer` varchar(255) NOT NULL,
  `dashboard_language` varchar(255) NOT NULL,
  `theme` varchar(255) NOT NULL,
  `dm` int DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO settings VALUES("1","Mini Cms","Create your own website","1","Your footer text","it","damares","1");



CREATE TABLE `verify` (
  `id` int NOT NULL AUTO_INCREMENT,
  `public` varchar(250) NOT NULL,
  `secret` varchar(250) NOT NULL,
  `active` int DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO verify VALUES("1","PUBLIC_KEY","SECRET_KEY","0");



CREATE TABLE `view_home` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name_function` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO view_home VALUES("1","post");
INSERT INTO view_home VALUES("2","color");
INSERT INTO view_home VALUES("20","backup");

