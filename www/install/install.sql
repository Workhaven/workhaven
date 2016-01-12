CREATE TABLE IF NOT EXISTS `{prefix}roles` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `uniq_name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `{prefix}users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(127) NOT NULL,
  `password` varchar(256) DEFAULT NULL,
  `language` varchar(5) DEFAULT NULL,
  `logins` int(10) unsigned NOT NULL DEFAULT '0',
  `last_login` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `{prefix}roles_users` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY  (`user_id`,`role_id`),
  KEY `fk_role_id` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `{prefix}roles_users`
  ADD CONSTRAINT `roles_users_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `{prefix}users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `roles_users_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `{prefix}roles` (`id`) ON DELETE CASCADE;

CREATE TABLE IF NOT EXISTS `{prefix}systemsettings` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,  
  `name` varchar(32) DEFAULT '',
  `value` BLOB DEFAULT '',  
  PRIMARY KEY  (`id`),
  UNIQUE KEY `uniq_name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `{prefix}languages` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,  
  `code` varchar(5) NOT NULL,  
  `name` varchar(32) NOT NULL,  
  PRIMARY KEY  (`id`),
  UNIQUE KEY `uniq_name` (`code`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `{prefix}clients` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,  
  `user_id` int(11) UNSIGNED,  
  `name` varchar(64) NOT NULL,  
  `surname` varchar(64),  
  `email` varchar(255),  
  `description` TEXT,  
  `created` datetime DEFAULT CURRENT_TIMESTAMP,  
  PRIMARY KEY  (`id`)  
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

ALTER TABLE `{prefix}clients`
  ADD CONSTRAINT `clients_user_fk_1` FOREIGN KEY (`user_id`) REFERENCES `{prefix}users` (`id`) ON DELETE CASCADE;

CREATE TABLE IF NOT EXISTS `{prefix}projects_visibilities` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,  
  `name` varchar(6), 
  PRIMARY KEY (`id`)  
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `{prefix}projects` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `client_id` int(11) unsigned DEFAULT NULL,
  `user_id` int(11) unsigned DEFAULT NULL,
  `description` text,
  `share_hash` varchar(32) NOT NULL,
  `visibility_id` int(11) unsigned NOT NULL DEFAULT '1',
  `deadline` datetime DEFAULT NULL,
  `created` datetime DEFAULT CURRENT_TIMESTAMP,
  `share_password` varchar(256) DEFAULT NULL,
  `portfolio` int(1) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_client_id` (`client_id`),
  KEY `projects_user_fk_1` (`user_id`),
  KEY `visibility_id` (`visibility_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

ALTER TABLE `{prefix}projects`
  ADD CONSTRAINT `projects_fk_visibility_id` FOREIGN KEY (`visibility_id`) REFERENCES `{prefix}projects_visibilities` (`id`) ON DELETE RESTRICT,
  ADD CONSTRAINT `projects_client_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `{prefix}clients` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `projects_user_fk_1` FOREIGN KEY (`user_id`) REFERENCES `{prefix}users` (`id`) ON DELETE SET NULL;

CREATE TABLE IF NOT EXISTS `{prefix}images` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,  
  `project_id` int(11) UNSIGNED,    
  `discussion_id` int(11) UNSIGNED,      
  `filename` varchar(128), 
  `description` TEXT,     
  `background_color` varchar(7),   
  `created` datetime DEFAULT CURRENT_TIMESTAMP,  
  `portfolio` int(1) DEFAULT 1,
  PRIMARY KEY (`id`),
  KEY `fk_project_id` (`project_id`),
  KEY `fk_discussion_id` (`discussion_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

ALTER TABLE `{prefix}images`  
  ADD CONSTRAINT `images_belongs_to_projects` FOREIGN KEY (`fk_project_id`) REFERENCES `{prefix}projects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `images_have_discussion` FOREIGN KEY (`fk_discussion_id`) REFERENCES `{prefix}discussions` (`id`) ON DELETE CASCADE;

CREATE TABLE IF NOT EXISTS `{prefix}discussions` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,     
  `image_id` int(11) UNSIGNED NULL DEFAULT NULL, 
  PRIMARY KEY (`id`),
  KEY `fk_image_id` (`image_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

ALTER TABLE `{prefix}discussions`    
  ADD CONSTRAINT `discussions_image_id` FOREIGN KEY (`image_id`) REFERENCES `{prefix}images` (`id`) ON DELETE CASCADE;


CREATE TABLE IF NOT EXISTS `{prefix}comments` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,     
  `discussion_id` int(11) UNSIGNED NOT NULL,     
  `user_id` int(11) UNSIGNED NULL DEFAULT NULL, 
  `reply_comment_id` int(11) UNSIGNED NULL DEFAULT NULL,
  `text` TEXT, 
  `author_visitor` varchar(127) NULL DEFAULT NULL,
  `created` datetime DEFAULT CURRENT_TIMESTAMP,  
  PRIMARY KEY (`id`),
  KEY `fk_user_id` (`user_id`),
  KEY `fk_discussion_id` (`discussion_id`),
  KEY `fk_reply_comment_id` (`reply_comment_id`) 
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

ALTER TABLE `{prefix}comments`
  ADD CONSTRAINT `comments_belongs_to_users` FOREIGN KEY (`user_id`) REFERENCES `{prefix}users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_belongs_to_discussion` FOREIGN KEY (`discussion_id`) REFERENCES `{prefix}discussions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_has_many_comments_as_replies` FOREIGN KEY (`reply_comment_id`) REFERENCES `{prefix}comments` (`id`) ON DELETE CASCADE;

CREATE TABLE IF NOT EXISTS `{prefix}notes` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `left` varchar(32) NOT NULL,
  `top` varchar(32) NOT NULL,
  `width` varchar(32) NOT NULL,
  `height` varchar(32) NOT NULL,
  `text` TEXT,
  `image_id` int(11) UNSIGNED NOT NULL,  
  `user_id` int(11) UNSIGNED NULL DEFAULT NULL, 
  `author_visitor` varchar(127) NULL DEFAULT NULL,
  `link` TEXT,
  `created` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),  
  KEY `fk_image_id` (`image_id`),
  KEY `fk_user_id` (`user_id`) 
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

ALTER TABLE `{prefix}notes`    
  ADD CONSTRAINT `notes_belongs_to_images` FOREIGN KEY (`image_id`) REFERENCES `{prefix}images` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `notes_belongs_to_users` FOREIGN KEY (`user_id`) REFERENCES `{prefix}users` (`id`) ON DELETE CASCADE;

CREATE TABLE IF NOT EXISTS `{prefix}projects_teams` (
  `project_id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  PRIMARY KEY (`project_id`, `user_id`),  
  KEY `fk_project_id` (`project_id`),
  KEY `fk_user_id` (`user_id`) 
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

ALTER TABLE `{prefix}projects_teams`
  ADD CONSTRAINT `projects_teams_projects_constraint` FOREIGN KEY (`project_id`) REFERENCES `{prefix}projects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `projects_teams_users_constraint` FOREIGN KEY (`user_id`) REFERENCES `{prefix}users` (`id`) ON DELETE CASCADE;

CREATE TABLE IF NOT EXISTS `{prefix}projects_permissions` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(16),  
  PRIMARY KEY (`id`)  
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `{prefix}projects_granted_permissions` (
  `project_id` int(11) UNSIGNED NOT NULL,
  `permission_id` int(11) UNSIGNED NOT NULL,
  PRIMARY KEY (`project_id`, `permission_id`),
  KEY `fk_project_id` (`project_id`),
  KEY `fk_permission_id` (`permission_id`) 
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

ALTER TABLE `{prefix}projects_granted_permissions`
  ADD CONSTRAINT `pgp_project_id_constraint` FOREIGN KEY (`project_id`) REFERENCES `{prefix}projects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pgp_permission_id_constraint` FOREIGN KEY (`permission_id`) REFERENCES `{prefix}projects_permissions` (`id`) ON DELETE RESTRICT;

INSERT INTO `{prefix}roles` (`id`, `name`, `description`) VALUES(1, 'admin', 'Administrative user, has access to everything.');
INSERT INTO `{prefix}roles` (`id`, `name`, `description`) VALUES(2, 'internal', 'Employee with limited permissons.');

INSERT INTO `{prefix}projects_permissions` (`id`, `name`) VALUES(1, "Comments");
INSERT INTO `{prefix}projects_permissions` (`id`, `name`) VALUES(2, "Image notes");

INSERT INTO `{prefix}projects_visibilities` (`id`, `name`) VALUES(1, "privat");
INSERT INTO `{prefix}projects_visibilities` (`id`, `name`) VALUES(2, "public");
INSERT INTO `{prefix}projects_visibilities` (`id`, `name`) VALUES(3, "secure");

INSERT INTO `{prefix}languages` (`code`, `name`) VALUES("cs", "Czech");
INSERT INTO `{prefix}languages` (`code`, `name`) VALUES("en", "English");

INSERT INTO `{prefix}systemsettings` (`name`, `value`) VALUES("name", "");
INSERT INTO `{prefix}systemsettings` (`name`, `value`) VALUES("email", "");
INSERT INTO `{prefix}systemsettings` (`name`, `value`) VALUES("language", "en");
INSERT INTO `{prefix}systemsettings` (`name`, `value`) VALUES("title", "");
INSERT INTO `{prefix}systemsettings` (`name`, `value`) VALUES("keywords", "");
INSERT INTO `{prefix}systemsettings` (`name`, `value`) VALUES("description", "");
INSERT INTO `{prefix}systemsettings` (`name`, `value`) VALUES("copyright", "");
INSERT INTO `{prefix}systemsettings` (`name`, `value`) VALUES("template", "default");
INSERT INTO `{prefix}systemsettings` (`name`, `value`) VALUES("logo_ext", "");

-- If you need an SQL example of admin user account, this is for account admin@admin.cz with password admin123. Never use this account in your live applcation.

-- INSERT INTO `{prefix}users` (`id`, `email`, `password`, `language`, `logins`, `last_login`) VALUES (1, 'admin@admin.cz', 'fe6ea15103dd7ef4a606152b6c374cbc7bcaf3526f4162eb749686ffc87d5695', NULL, 1, 1400345046);
-- INSERT INTO `{prefix}roles_users` (`user_id`, `role_id`) VALUES (1, 1);
