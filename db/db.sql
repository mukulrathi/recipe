/*
SQLyog Ultimate v12.4.1 (64 bit)
MySQL - 5.7.21-0ubuntu0.17.10.1 : Database - yii-application
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `auth_assignment` */

DROP TABLE IF EXISTS `auth_assignment`;

CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`),
  CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `auth_assignment` */

insert  into `auth_assignment`(`item_name`,`user_id`,`created_at`) values 
('admin','1',1488911688),
('user','5',1519902110);

/*Table structure for table `auth_item` */

DROP TABLE IF EXISTS `auth_item`;

CREATE TABLE `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `idx-auth_item-type` (`type`),
  CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `auth_item` */

insert  into `auth_item`(`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) values 
('/*',2,NULL,NULL,NULL,1488911590,1488911590),
('/admin/*',2,NULL,NULL,NULL,1488911589,1488911589),
('/admin/assignment/*',2,NULL,NULL,NULL,1488911586,1488911586),
('/admin/assignment/assign',2,NULL,NULL,NULL,1488911586,1488911586),
('/admin/assignment/index',2,NULL,NULL,NULL,1488911586,1488911586),
('/admin/assignment/revoke',2,NULL,NULL,NULL,1488911586,1488911586),
('/admin/assignment/view',2,NULL,NULL,NULL,1488911586,1488911586),
('/admin/default/*',2,NULL,NULL,NULL,1488911586,1488911586),
('/admin/default/index',2,NULL,NULL,NULL,1488911586,1488911586),
('/admin/menu/*',2,NULL,NULL,NULL,1488911586,1488911586),
('/admin/menu/create',2,NULL,NULL,NULL,1488911586,1488911586),
('/admin/menu/delete',2,NULL,NULL,NULL,1488911586,1488911586),
('/admin/menu/index',2,NULL,NULL,NULL,1488911586,1488911586),
('/admin/menu/update',2,NULL,NULL,NULL,1488911586,1488911586),
('/admin/menu/view',2,NULL,NULL,NULL,1488911586,1488911586),
('/admin/permission/*',2,NULL,NULL,NULL,1488911587,1488911587),
('/admin/permission/assign',2,NULL,NULL,NULL,1488911587,1488911587),
('/admin/permission/create',2,NULL,NULL,NULL,1488911587,1488911587),
('/admin/permission/delete',2,NULL,NULL,NULL,1488911587,1488911587),
('/admin/permission/index',2,NULL,NULL,NULL,1488911586,1488911586),
('/admin/permission/remove',2,NULL,NULL,NULL,1488911587,1488911587),
('/admin/permission/update',2,NULL,NULL,NULL,1488911587,1488911587),
('/admin/permission/view',2,NULL,NULL,NULL,1488911587,1488911587),
('/admin/role/*',2,NULL,NULL,NULL,1488911587,1488911587),
('/admin/role/assign',2,NULL,NULL,NULL,1488911587,1488911587),
('/admin/role/create',2,NULL,NULL,NULL,1488911587,1488911587),
('/admin/role/delete',2,NULL,NULL,NULL,1488911587,1488911587),
('/admin/role/index',2,NULL,NULL,NULL,1488911587,1488911587),
('/admin/role/remove',2,NULL,NULL,NULL,1488911587,1488911587),
('/admin/role/update',2,NULL,NULL,NULL,1488911587,1488911587),
('/admin/role/view',2,NULL,NULL,NULL,1488911587,1488911587),
('/admin/route/*',2,NULL,NULL,NULL,1488911588,1488911588),
('/admin/route/assign',2,NULL,NULL,NULL,1488911587,1488911587),
('/admin/route/create',2,NULL,NULL,NULL,1488911587,1488911587),
('/admin/route/index',2,NULL,NULL,NULL,1488911587,1488911587),
('/admin/route/refresh',2,NULL,NULL,NULL,1488911587,1488911587),
('/admin/route/remove',2,NULL,NULL,NULL,1488911587,1488911587),
('/admin/rule/*',2,NULL,NULL,NULL,1488911588,1488911588),
('/admin/rule/create',2,NULL,NULL,NULL,1488911588,1488911588),
('/admin/rule/delete',2,NULL,NULL,NULL,1488911588,1488911588),
('/admin/rule/index',2,NULL,NULL,NULL,1488911588,1488911588),
('/admin/rule/update',2,NULL,NULL,NULL,1488911588,1488911588),
('/admin/rule/view',2,NULL,NULL,NULL,1488911588,1488911588),
('/admin/user/*',2,NULL,NULL,NULL,1488911589,1488911589),
('/admin/user/activate',2,NULL,NULL,NULL,1488911589,1488911589),
('/admin/user/change-password',2,NULL,NULL,NULL,1488911588,1488911588),
('/admin/user/delete',2,NULL,NULL,NULL,1488911588,1488911588),
('/admin/user/index',2,NULL,NULL,NULL,1488911588,1488911588),
('/admin/user/login',2,NULL,NULL,NULL,1488911588,1488911588),
('/admin/user/logout',2,NULL,NULL,NULL,1488911588,1488911588),
('/admin/user/request-password-reset',2,NULL,NULL,NULL,1488911588,1488911588),
('/admin/user/reset-password',2,NULL,NULL,NULL,1488911588,1488911588),
('/admin/user/signup',2,NULL,NULL,NULL,1488911588,1488911588),
('/admin/user/view',2,NULL,NULL,NULL,1488911588,1488911588),
('/blog/*',2,NULL,NULL,NULL,1490679009,1490679009),
('/blog/category/*',2,NULL,NULL,NULL,1490679009,1490679009),
('/blog/category/create',2,NULL,NULL,NULL,1490679009,1490679009),
('/blog/category/delete',2,NULL,NULL,NULL,1490679009,1490679009),
('/blog/category/index',2,NULL,NULL,NULL,1490679009,1490679009),
('/blog/category/update',2,NULL,NULL,NULL,1490679009,1490679009),
('/blog/category/view',2,NULL,NULL,NULL,1490679009,1490679009),
('/blog/default/*',2,NULL,NULL,NULL,1490679009,1490679009),
('/blog/default/create',2,NULL,NULL,NULL,1490679009,1490679009),
('/blog/default/delete',2,NULL,NULL,NULL,1490679009,1490679009),
('/blog/default/index',2,NULL,NULL,NULL,1490679009,1490679009),
('/blog/default/update',2,NULL,NULL,NULL,1490679009,1490679009),
('/blog/default/view',2,NULL,NULL,NULL,1490679009,1490679009),
('/cms/*',2,NULL,NULL,NULL,1488995571,1488995571),
('/cms/default/*',2,NULL,NULL,NULL,1488995571,1488995571),
('/cms/default/index',2,NULL,NULL,NULL,1488995571,1488995571),
('/debug/*',2,NULL,NULL,NULL,1488911589,1488911589),
('/debug/default/*',2,NULL,NULL,NULL,1488911589,1488911589),
('/debug/default/db-explain',2,NULL,NULL,NULL,1488911589,1488911589),
('/debug/default/download-mail',2,NULL,NULL,NULL,1488911589,1488911589),
('/debug/default/index',2,NULL,NULL,NULL,1488911589,1488911589),
('/debug/default/toolbar',2,NULL,NULL,NULL,1488911589,1488911589),
('/debug/default/view',2,NULL,NULL,NULL,1488911589,1488911589),
('/debug/user/*',2,NULL,NULL,NULL,1509330467,1509330467),
('/debug/user/reset-identity',2,NULL,NULL,NULL,1509330467,1509330467),
('/debug/user/set-identity',2,NULL,NULL,NULL,1509330467,1509330467),
('/email-templates/*',2,NULL,NULL,NULL,1517031072,1517031072),
('/email-templates/default/*',2,NULL,NULL,NULL,1517031072,1517031072),
('/email-templates/default/create',2,NULL,NULL,NULL,1517031071,1517031071),
('/email-templates/default/delete',2,NULL,NULL,NULL,1517031072,1517031072),
('/email-templates/default/delete-attachment',2,NULL,NULL,NULL,1517031072,1517031072),
('/email-templates/default/download-attachment',2,NULL,NULL,NULL,1517031072,1517031072),
('/email-templates/default/download-attachments',2,NULL,NULL,NULL,1517031072,1517031072),
('/email-templates/default/index',2,NULL,NULL,NULL,1517031071,1517031071),
('/email-templates/default/update',2,NULL,NULL,NULL,1517031072,1517031072),
('/email-templates/default/view',2,NULL,NULL,NULL,1517031071,1517031071),
('/gii/*',2,NULL,NULL,NULL,1488911589,1488911589),
('/gii/default/*',2,NULL,NULL,NULL,1488911589,1488911589),
('/gii/default/action',2,NULL,NULL,NULL,1488911589,1488911589),
('/gii/default/diff',2,NULL,NULL,NULL,1488911589,1488911589),
('/gii/default/index',2,NULL,NULL,NULL,1488911589,1488911589),
('/gii/default/preview',2,NULL,NULL,NULL,1488911589,1488911589),
('/gii/default/view',2,NULL,NULL,NULL,1488911589,1488911589),
('/gridview/*',2,NULL,NULL,NULL,1517031071,1517031071),
('/gridview/export/*',2,NULL,NULL,NULL,1517031071,1517031071),
('/gridview/export/download',2,NULL,NULL,NULL,1517031071,1517031071),
('/language/*',2,NULL,NULL,NULL,1490679009,1490679009),
('/language/default/*',2,NULL,NULL,NULL,1490679008,1490679008),
('/language/default/create',2,NULL,NULL,NULL,1490679008,1490679008),
('/language/default/delete',2,NULL,NULL,NULL,1490679008,1490679008),
('/language/default/index',2,NULL,NULL,NULL,1490679008,1490679008),
('/language/default/make-default',2,NULL,NULL,NULL,1490679008,1490679008),
('/language/default/update',2,NULL,NULL,NULL,1490679008,1490679008),
('/language/default/view',2,NULL,NULL,NULL,1490679008,1490679008),
('/log/*',2,NULL,NULL,NULL,1521309748,1521309748),
('/log/delete',2,NULL,NULL,NULL,1521309748,1521309748),
('/log/index',2,NULL,NULL,NULL,1521309748,1521309748),
('/log/view',2,NULL,NULL,NULL,1521309748,1521309748),
('/pages/*',2,NULL,NULL,NULL,1490679008,1490679008),
('/pages/default/*',2,NULL,NULL,NULL,1490679007,1490679007),
('/pages/default/create',2,NULL,NULL,NULL,1490679007,1490679007),
('/pages/default/delete',2,NULL,NULL,NULL,1490679007,1490679007),
('/pages/default/index',2,NULL,NULL,NULL,1490679007,1490679007),
('/pages/default/update',2,NULL,NULL,NULL,1490679007,1490679007),
('/pages/default/view',2,NULL,NULL,NULL,1490679007,1490679007),
('/setting/*',2,NULL,NULL,NULL,1500960215,1500960215),
('/setting/create',2,NULL,NULL,NULL,1500960215,1500960215),
('/setting/delete',2,NULL,NULL,NULL,1500960215,1500960215),
('/setting/index',2,NULL,NULL,NULL,1500960215,1500960215),
('/setting/update',2,NULL,NULL,NULL,1500960215,1500960215),
('/setting/update-all',2,NULL,NULL,NULL,1500960215,1500960215),
('/setting/view',2,NULL,NULL,NULL,1500960215,1500960215),
('/site-settings/*',2,NULL,NULL,NULL,1489167976,1489167976),
('/site-settings/index',2,NULL,NULL,NULL,1489167976,1489167976),
('/site/*',2,NULL,NULL,NULL,1488911590,1488911590),
('/site/about',2,NULL,NULL,NULL,1488912009,1488912009),
('/site/auth',2,NULL,NULL,NULL,1494582691,1494582691),
('/site/captcha',2,NULL,NULL,NULL,1488912027,1488912027),
('/site/change-password',2,NULL,NULL,NULL,1490679010,1490679010),
('/site/contact',2,NULL,NULL,NULL,1488912014,1488912014),
('/site/dashboard',2,NULL,NULL,NULL,1494585310,1494585310),
('/site/email-verification',2,NULL,NULL,NULL,1519902737,1519902737),
('/site/error',2,NULL,NULL,NULL,1488911589,1488911589),
('/site/index',2,NULL,NULL,NULL,1488911589,1488911589),
('/site/link-social-accounts',2,NULL,NULL,NULL,1494585591,1494585591),
('/site/login',2,NULL,NULL,NULL,1488911589,1488911589),
('/site/logout',2,NULL,NULL,NULL,1488911590,1488911590),
('/site/request-password-reset',2,NULL,NULL,NULL,1500960215,1500960215),
('/site/resend-verification-token',2,NULL,NULL,NULL,1519902626,1519902626),
('/site/reset-password',2,NULL,NULL,NULL,1500960216,1500960216),
('/site/robots',2,NULL,NULL,NULL,1521309796,1521309796),
('/site/settings',2,NULL,NULL,NULL,1509330467,1509330467),
('/site/signup',2,NULL,NULL,NULL,1488912022,1488912022),
('/site/social-auth',2,NULL,NULL,NULL,1517031072,1517031072),
('/testimonial/*',2,NULL,NULL,NULL,1490679008,1490679008),
('/testimonial/default/*',2,NULL,NULL,NULL,1490679008,1490679008),
('/testimonial/default/create',2,NULL,NULL,NULL,1490679008,1490679008),
('/testimonial/default/delete',2,NULL,NULL,NULL,1490679008,1490679008),
('/testimonial/default/index',2,NULL,NULL,NULL,1490679008,1490679008),
('/testimonial/default/update',2,NULL,NULL,NULL,1490679008,1490679008),
('/testimonial/default/view',2,NULL,NULL,NULL,1490679008,1490679008),
('/user/*',2,NULL,NULL,NULL,1488995571,1488995571),
('/user/default/*',2,NULL,NULL,NULL,1488995571,1488995571),
('/user/default/block-user',2,NULL,NULL,NULL,1490679007,1490679007),
('/user/default/create',2,NULL,NULL,NULL,1490679007,1490679007),
('/user/default/delete',2,NULL,NULL,NULL,1490679007,1490679007),
('/user/default/delete-multiple',2,NULL,NULL,NULL,1517031071,1517031071),
('/user/default/index',2,NULL,NULL,NULL,1488995571,1488995571),
('/user/default/mark-email-verified',2,NULL,NULL,NULL,1517031071,1517031071),
('/user/default/resend-verification-token',2,NULL,NULL,NULL,1517031071,1517031071),
('/user/default/suspend-user',2,NULL,NULL,NULL,1517031071,1517031071),
('/user/default/unblock-user',2,NULL,NULL,NULL,1490679007,1490679007),
('/user/default/update',2,NULL,NULL,NULL,1490679007,1490679007),
('/user/default/view',2,NULL,NULL,NULL,1490679006,1490679006),
('/user/profile-approval/*',2,NULL,NULL,NULL,1517032463,1517032463),
('/user/profile-approval/index',2,NULL,NULL,NULL,1517032461,1517032461),
('/user/profile-approval/review',2,NULL,NULL,NULL,1517032462,1517032462),
('/user/profile-approval/view',2,NULL,NULL,NULL,1517032463,1517032463),
('/user/status/*',2,NULL,NULL,NULL,1490679007,1490679007),
('/user/status/create',2,NULL,NULL,NULL,1490679007,1490679007),
('/user/status/delete',2,NULL,NULL,NULL,1490679007,1490679007),
('/user/status/index',2,NULL,NULL,NULL,1490679007,1490679007),
('/user/status/update',2,NULL,NULL,NULL,1490679007,1490679007),
('/user/status/view',2,NULL,NULL,NULL,1490679007,1490679007),
('admin',1,NULL,NULL,NULL,1488911603,1488911603),
('guest',1,NULL,NULL,NULL,1488911597,1488911597),
('guestPermission',2,NULL,NULL,NULL,1488996470,1488996470),
('user',1,NULL,NULL,NULL,1494582707,1494582707),
('userPermission',2,NULL,NULL,NULL,1494585320,1494585320);

/*Table structure for table `auth_item_child` */

DROP TABLE IF EXISTS `auth_item_child`;

CREATE TABLE `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`),
  CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `auth_item_child` */

insert  into `auth_item_child`(`parent`,`child`) values 
('admin','/*'),
('guestPermission','/site/about'),
('guestPermission','/site/auth'),
('guestPermission','/site/captcha'),
('userPermission','/site/change-password'),
('guestPermission','/site/contact'),
('userPermission','/site/dashboard'),
('guestPermission','/site/email-verification'),
('guestPermission','/site/error'),
('guestPermission','/site/index'),
('userPermission','/site/link-social-accounts'),
('guestPermission','/site/login'),
('userPermission','/site/logout'),
('guestPermission','/site/request-password-reset'),
('userPermission','/site/resend-verification-token'),
('guestPermission','/site/reset-password'),
('guestPermission','/site/robots'),
('guestPermission','/site/signup'),
('guest','guestPermission'),
('user','userPermission');

/*Table structure for table `auth_rule` */

DROP TABLE IF EXISTS `auth_rule`;

CREATE TABLE `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `auth_rule` */

/*Table structure for table `blog_post` */

DROP TABLE IF EXISTS `blog_post`;

CREATE TABLE `blog_post` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(510) DEFAULT NULL,
  `clicks` int(11) unsigned DEFAULT '0',
  `tags` text,
  `banner` text,
  `status_id` int(11) unsigned DEFAULT '1',
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk-blog_post-user_id` (`user_id`),
  KEY `fk-blog_post-status_id` (`status_id`),
  CONSTRAINT `fk-blog_post-status_id` FOREIGN KEY (`status_id`) REFERENCES `blog_post_status` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk-blog_post-user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `blog_post` */

/*Table structure for table `blog_post_categories_mapping` */

DROP TABLE IF EXISTS `blog_post_categories_mapping`;

CREATE TABLE `blog_post_categories_mapping` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` int(11) unsigned NOT NULL,
  `category_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk-blog_post_categories_mapping-post_id` (`post_id`),
  KEY `fk-blog_post_categories_mapping-category_id` (`category_id`),
  CONSTRAINT `fk-blog_post_categories_mapping-category_id` FOREIGN KEY (`category_id`) REFERENCES `blog_post_category` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk-blog_post_categories_mapping-post_id` FOREIGN KEY (`post_id`) REFERENCES `blog_post` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `blog_post_categories_mapping` */

/*Table structure for table `blog_post_category` */

DROP TABLE IF EXISTS `blog_post_category`;

CREATE TABLE `blog_post_category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(510) DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `blog_post_category` */

/*Table structure for table `blog_post_comments` */

DROP TABLE IF EXISTS `blog_post_comments`;

CREATE TABLE `blog_post_comments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` int(11) unsigned NOT NULL,
  `comment` text NOT NULL,
  `author` varchar(64) NOT NULL,
  `email` varchar(64) NOT NULL,
  `url` varchar(255) DEFAULT NULL,
  `status` varchar(32) DEFAULT 'active',
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk-blog_post_comments-post_id` (`post_id`),
  CONSTRAINT `fk-blog_post_comments-post_id` FOREIGN KEY (`post_id`) REFERENCES `blog_post` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `blog_post_comments` */

/*Table structure for table `blog_post_language` */

DROP TABLE IF EXISTS `blog_post_language`;

CREATE TABLE `blog_post_language` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` int(11) unsigned NOT NULL,
  `language` varchar(5) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text,
  `slug` varchar(510) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk-blog_post_language-post_id` (`post_id`),
  CONSTRAINT `fk-blog_post_language-post_id` FOREIGN KEY (`post_id`) REFERENCES `blog_post` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `blog_post_language` */

/*Table structure for table `blog_post_status` */

DROP TABLE IF EXISTS `blog_post_status`;

CREATE TABLE `blog_post_status` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `blog_post_status` */

insert  into `blog_post_status`(`id`,`title`,`description`) values 
(1,'Published',NULL),
(2,'Draft',NULL),
(3,'Pending',NULL),
(4,'Unpublished',NULL);

/*Table structure for table `cms_block` */

DROP TABLE IF EXISTS `cms_block`;

CREATE TABLE `cms_block` (
  `block_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(250) DEFAULT NULL,
  `contents` text,
  PRIMARY KEY (`block_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `cms_block` */

/*Table structure for table `cms_block_mapper` */

DROP TABLE IF EXISTS `cms_block_mapper`;

CREATE TABLE `cms_block_mapper` (
  `block_id` int(10) unsigned NOT NULL,
  `cms_id` int(10) unsigned NOT NULL,
  `order_by` int(10) unsigned NOT NULL,
  PRIMARY KEY (`block_id`,`cms_id`),
  KEY `cms_id` (`cms_id`),
  CONSTRAINT `cms_block_mapper_ibfk_1` FOREIGN KEY (`block_id`) REFERENCES `cms_block` (`block_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `cms_block_mapper_ibfk_2` FOREIGN KEY (`cms_id`) REFERENCES `cms_item` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `cms_block_mapper` */

/*Table structure for table `cms_category` */

DROP TABLE IF EXISTS `cms_category`;

CREATE TABLE `cms_category` (
  `category_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) unsigned DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text,
  `sort_order` int(11) DEFAULT NULL,
  `modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `create_date` datetime DEFAULT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `cms_category` */

/*Table structure for table `cms_category_mapper` */

DROP TABLE IF EXISTS `cms_category_mapper`;

CREATE TABLE `cms_category_mapper` (
  `cms_id` int(11) unsigned NOT NULL,
  `category_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`cms_id`,`category_id`),
  KEY `category_id` (`category_id`),
  CONSTRAINT `cms_category_mapper_ibfk_1` FOREIGN KEY (`cms_id`) REFERENCES `cms_item` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `cms_category_mapper_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `cms_category` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `cms_category_mapper` */

/*Table structure for table `cms_category_path` */

DROP TABLE IF EXISTS `cms_category_path`;

CREATE TABLE `cms_category_path` (
  `category_id` int(11) unsigned NOT NULL,
  `parent_id` int(11) unsigned NOT NULL,
  `level` int(11) NOT NULL,
  PRIMARY KEY (`category_id`,`parent_id`),
  KEY `parent_id` (`parent_id`),
  CONSTRAINT `cms_category_path_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `cms_category` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `cms_category_path_ibfk_2` FOREIGN KEY (`parent_id`) REFERENCES `cms_category` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `cms_category_path` */

/*Table structure for table `cms_comments` */

DROP TABLE IF EXISTS `cms_comments`;

CREATE TABLE `cms_comments` (
  `review_id` int(10) unsigned NOT NULL,
  `email` varchar(64) NOT NULL,
  `comment` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`review_id`),
  KEY `user_id` (`email`),
  CONSTRAINT `cms_comments_ibfk_2` FOREIGN KEY (`review_id`) REFERENCES `cms_reviews` (`review_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `cms_comments` */

/*Table structure for table `cms_field` */

DROP TABLE IF EXISTS `cms_field`;

CREATE TABLE `cms_field` (
  `field_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` int(10) unsigned DEFAULT NULL,
  `section` enum('None','Summary','Requirements','Skills') DEFAULT 'None',
  `field` varchar(100) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `type` enum('Text','TextArea','Radio','List','MultiList') DEFAULT 'Text',
  `order_by` int(10) unsigned DEFAULT NULL,
  `status` tinyint(3) DEFAULT NULL,
  PRIMARY KEY (`field_id`),
  KEY `category_id` (`category_id`),
  CONSTRAINT `cms_field_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `cms_category` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `cms_field` */

/*Table structure for table `cms_field_option` */

DROP TABLE IF EXISTS `cms_field_option`;

CREATE TABLE `cms_field_option` (
  `option_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `field_id` int(10) unsigned DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `value` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`option_id`),
  KEY `field_id` (`field_id`),
  CONSTRAINT `cms_field_option_ibfk_1` FOREIGN KEY (`field_id`) REFERENCES `cms_field` (`field_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `cms_field_option` */

/*Table structure for table `cms_field_value` */

DROP TABLE IF EXISTS `cms_field_value`;

CREATE TABLE `cms_field_value` (
  `value_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cms_id` int(10) unsigned NOT NULL,
  `field_id` int(10) unsigned NOT NULL,
  `value` varchar(250) NOT NULL,
  PRIMARY KEY (`value_id`),
  KEY `job_id` (`cms_id`),
  KEY `field_id` (`field_id`),
  CONSTRAINT `cms_field_value_ibfk_1` FOREIGN KEY (`cms_id`) REFERENCES `cms_item` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `cms_field_value_ibfk_2` FOREIGN KEY (`field_id`) REFERENCES `cms_field` (`field_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `cms_field_value` */

/*Table structure for table `cms_gallay` */

DROP TABLE IF EXISTS `cms_gallay`;

CREATE TABLE `cms_gallay` (
  `image_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cms_id` int(10) unsigned NOT NULL,
  `image` varchar(250) NOT NULL,
  PRIMARY KEY (`image_id`),
  KEY `cms_id` (`cms_id`),
  CONSTRAINT `cms_gallay_ibfk_1` FOREIGN KEY (`cms_id`) REFERENCES `cms_item` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `cms_gallay` */

/*Table structure for table `cms_item` */

DROP TABLE IF EXISTS `cms_item`;

CREATE TABLE `cms_item` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) unsigned DEFAULT NULL,
  `layout_id` int(10) unsigned DEFAULT '1',
  `slug` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `external_url` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `content` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `restricted` tinyint(3) unsigned DEFAULT '0',
  `status` smallint(3) DEFAULT '0',
  `meta_title` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `meta_description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `meta_keywords` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `create_date` datetime DEFAULT NULL,
  `modified_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`),
  KEY `parent_id` (`parent_id`),
  KEY `layout` (`layout_id`),
  CONSTRAINT `cms_item_ibfk_2` FOREIGN KEY (`parent_id`) REFERENCES `cms_item` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `cms_item_ibfk_3` FOREIGN KEY (`layout_id`) REFERENCES `cms_layout` (`layout_id`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `cms_item` */

/*Table structure for table `cms_keyword` */

DROP TABLE IF EXISTS `cms_keyword`;

CREATE TABLE `cms_keyword` (
  `keyword_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`keyword_id`),
  KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `cms_keyword` */

/*Table structure for table `cms_layout` */

DROP TABLE IF EXISTS `cms_layout`;

CREATE TABLE `cms_layout` (
  `layout_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  PRIMARY KEY (`layout_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `cms_layout` */

/*Table structure for table `cms_media` */

DROP TABLE IF EXISTS `cms_media`;

CREATE TABLE `cms_media` (
  `media_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cms_id` int(10) unsigned NOT NULL,
  `file` varchar(200) NOT NULL,
  `type` varchar(20) NOT NULL,
  PRIMARY KEY (`media_id`),
  KEY `cms_id` (`cms_id`),
  CONSTRAINT `cms_media_ibfk_1` FOREIGN KEY (`cms_id`) REFERENCES `cms_item` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `cms_media` */

/*Table structure for table `cms_menu` */

DROP TABLE IF EXISTS `cms_menu`;

CREATE TABLE `cms_menu` (
  `menu_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `parent_id` int(11) unsigned DEFAULT NULL,
  `route` varchar(255) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `data` text,
  PRIMARY KEY (`menu_id`),
  KEY `parent` (`parent_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `cms_menu` */

/*Table structure for table `cms_menu_path` */

DROP TABLE IF EXISTS `cms_menu_path`;

CREATE TABLE `cms_menu_path` (
  `menu_id` int(11) unsigned NOT NULL,
  `parent_id` int(11) unsigned NOT NULL,
  `level` int(11) NOT NULL,
  PRIMARY KEY (`menu_id`,`parent_id`),
  KEY `parent_id` (`parent_id`),
  CONSTRAINT `cms_menu_path_ibfk_1` FOREIGN KEY (`menu_id`) REFERENCES `cms_menu` (`menu_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `cms_menu_path_ibfk_2` FOREIGN KEY (`parent_id`) REFERENCES `cms_menu` (`menu_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `cms_menu_path` */

/*Table structure for table `cms_path` */

DROP TABLE IF EXISTS `cms_path`;

CREATE TABLE `cms_path` (
  `cms_id` int(10) unsigned NOT NULL,
  `path_id` int(10) unsigned NOT NULL,
  `level` int(11) DEFAULT NULL,
  PRIMARY KEY (`cms_id`,`path_id`),
  KEY `path_id` (`path_id`),
  CONSTRAINT `cms_path_ibfk_3` FOREIGN KEY (`cms_id`) REFERENCES `cms_item` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `cms_path_ibfk_4` FOREIGN KEY (`path_id`) REFERENCES `cms_item` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `cms_path` */

/*Table structure for table `cms_ratting` */

DROP TABLE IF EXISTS `cms_ratting`;

CREATE TABLE `cms_ratting` (
  `cms_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ratting` varchar(250) CHARACTER SET utf8 NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`cms_id`),
  CONSTRAINT `cms_ratting_ibfk_1` FOREIGN KEY (`cms_id`) REFERENCES `cms_item` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_mysql500_ci;

/*Data for the table `cms_ratting` */

/*Table structure for table `cms_relation` */

DROP TABLE IF EXISTS `cms_relation`;

CREATE TABLE `cms_relation` (
  `cms_id` int(10) unsigned NOT NULL,
  `keyword_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`cms_id`,`keyword_id`),
  KEY `cms_keyword_id` (`keyword_id`),
  CONSTRAINT `cms_relation_ibfk_3` FOREIGN KEY (`cms_id`) REFERENCES `cms_item` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `cms_relation_ibfk_4` FOREIGN KEY (`keyword_id`) REFERENCES `cms_keyword` (`keyword_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `cms_relation` */

/*Table structure for table `cms_reviews` */

DROP TABLE IF EXISTS `cms_reviews`;

CREATE TABLE `cms_reviews` (
  `review_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cms_id` int(10) unsigned NOT NULL,
  `email` varchar(64) NOT NULL,
  `ratting` varchar(64) NOT NULL,
  `review` text NOT NULL,
  `status` tinyint(1) DEFAULT '1',
  `date_modified` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`review_id`),
  KEY `cms_id` (`cms_id`),
  KEY `user_id` (`email`),
  CONSTRAINT `cms_reviews_ibfk_1` FOREIGN KEY (`cms_id`) REFERENCES `cms_item` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `cms_reviews` */

/*Table structure for table `cms_widget` */

DROP TABLE IF EXISTS `cms_widget`;

CREATE TABLE `cms_widget` (
  `widget_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `widget` varchar(250) NOT NULL,
  `data` text,
  PRIMARY KEY (`widget_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `cms_widget` */

/*Table structure for table `cms_widget_mapper` */

DROP TABLE IF EXISTS `cms_widget_mapper`;

CREATE TABLE `cms_widget_mapper` (
  `widget_id` int(10) unsigned NOT NULL,
  `cms_id` int(10) unsigned NOT NULL,
  `order_by` int(10) unsigned NOT NULL,
  PRIMARY KEY (`widget_id`,`cms_id`),
  KEY `cms_id` (`cms_id`),
  CONSTRAINT `cms_widget_mapper_ibfk_1` FOREIGN KEY (`widget_id`) REFERENCES `cms_widget` (`widget_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `cms_widget_mapper_ibfk_2` FOREIGN KEY (`cms_id`) REFERENCES `cms_item` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `cms_widget_mapper` */

/*Table structure for table `config` */

DROP TABLE IF EXISTS `config`;

CREATE TABLE `config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `value` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `config` */

/*Table structure for table `email_template` */

DROP TABLE IF EXISTS `email_template`;

CREATE TABLE `email_template` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tag` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tag` (`tag`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `email_template` */

insert  into `email_template`(`id`,`title`,`tag`,`description`,`created_at`,`updated_at`) values 
(1,'Email Verification','email-verification','Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem.',1500631987,1500631987),
(2,'New user registered','new-user-registered','',1503056125,1503056125),
(3,'Password Reset Token','password-reset-token','',1503056548,1503056548),
(4,'Resend Verification Email','resend-verification-email','',1503058840,1503058840),
(5,'New profile approval request','new-profile-approval-request','',1503059258,1503059258),
(6,'New Document Verification Request','new-document-verification-request','',1503059470,1503059470),
(7,'Admin Tasker Hire Notification','admin-tasker-hire-notification','',1503059781,1503059781),
(9,'Booking Approved','booking-approved','',1503214979,1503214979),
(10,'Booking Declined','booking-declined','',1503215132,1503215132),
(11,'Booking Completion Request','booking-completion-request','',1503219708,1503219708),
(12,'Payment Made','payment-made','',1503220067,1503220067),
(13,'Booking Completed','booking-completed','',1503220428,1503220428),
(14,'Booking Completion Request Declined','booking-completion-request-declined','',1503220700,1503220700),
(15,'Booking Cancelled','booking-cancelled','',1503221008,1503221008),
(16,'Amount Refund On Cancellation','amount-refund-on-cancellation','',1503221323,1503221323),
(17,'Document Verified','document-verified','',1504006035,1504006035),
(18,'Document Rejected','document-rejected','',1504006079,1504006079),
(19,'Send Message','send-message','',1504010653,1504010653);

/*Table structure for table `email_template_attachment` */

DROP TABLE IF EXISTS `email_template_attachment`;

CREATE TABLE `email_template_attachment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email_template_id` int(11) unsigned NOT NULL,
  `attachment` text COLLATE utf32_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk-email_template_email_template_id` (`email_template_id`),
  CONSTRAINT `fk-email_template_email_template_id` FOREIGN KEY (`email_template_id`) REFERENCES `email_template` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

/*Data for the table `email_template_attachment` */

/*Table structure for table `email_template_language` */

DROP TABLE IF EXISTS `email_template_language`;

CREATE TABLE `email_template_language` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email_template_id` int(11) unsigned NOT NULL,
  `language` varchar(5) COLLATE utf32_unicode_ci DEFAULT NULL,
  `subject` varchar(255) COLLATE utf32_unicode_ci NOT NULL,
  `body` text COLLATE utf32_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk-email_template_email_template_language_id` (`email_template_id`),
  CONSTRAINT `fk-email_template_email_template_language_id` FOREIGN KEY (`email_template_id`) REFERENCES `email_template` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

/*Data for the table `email_template_language` */

insert  into `email_template_language`(`id`,`email_template_id`,`language`,`subject`,`body`) values 
(1,1,'en','Please verify your account.','<p><strong>Hi {full_name},</strong></p>\r\n<p>Thanks &nbsp;for registering at HomeTalent. Please click on this <a href=\"{link}\">link</a>&nbsp;to verify your account.</p>'),
(2,1,'fr','Veuillez vérifier votre compte.','<p><strong>Bonjour {full_name},</strong></p>\r\n<p>Merci de vous inscrire &agrave; HomeTalent. Cliquez sur ce <a href=\"{link}\">link</a>&nbsp;pour v&eacute;rifier votre compte.</p>'),
(3,2,'en','New user registered','<p>Hi {full_name},</p>\r\n<p>Please find the details for new user:</p>\r\n<ul>\r\n<li>Full Name: {user_full_name}</li>\r\n<li>Email: {email}</li>\r\n<li>Contact No: {contact}</li>\r\n<li>Role: {role}</li>\r\n</ul>'),
(4,2,'fr','New user registered','<p>Hi {full_name},</p>\r\n<p>Please find the details for new user:</p>\r\n<ul>\r\n<li>Full Name: {user_full_name}</li>\r\n<li>Email: {email}</li>\r\n<li>Contact No: {contact}</li>\r\n<li>Role: {role}</li>\r\n</ul>'),
(5,3,'en','Password reset for HomeTalent','<p>Hi {full_name},</p>\r\n<p>Follow the link below to reset your password:</p>\r\n<p><a title=\"Reset Password\" href=\"{link}\">Reset Password</a></p>'),
(6,3,'fr','Password reset for HomeTalent','<p>Hi {full_name},</p>\r\n<p>Follow the link below to reset your password:</p>\r\n<p><a title=\"Reset Password\" href=\"{link}\">Reset Password</a></p>'),
(7,4,'en','Verify your email account','<p>Hi {full_name},</p>\r\n<p>Please click on this <a href=\"{link}\">link</a> to verify your email account.</p>'),
(8,4,'fr','Verify your email account','<p>Hi {full_name},</p>\r\n<p>Please click on this <a href=\"{link}\">link</a> to verify your email account.</p>'),
(9,5,'en','New profile approval request received','<p>Hi {full_name},</p>\r\n<p>Please find the details for user:</p>\r\n<ul>\r\n<li>Fullname: {user_full_name}</li>\r\n<li>Email: {email}</li>\r\n<li>Role: {role}</li>\r\n</ul>\r\n<p><a href=\"{link}\">View Profile</a></p>'),
(10,5,'fr','New profile approval request received','<p>Hi {full_name},</p>\r\n<p>Please find the details for user:</p>\r\n<ul>\r\n<li>Fullname: {user_full_name}</li>\r\n<li>Email: {email}</li>\r\n<li>Role: {role}</li>\r\n</ul>\r\n<p><a href=\"{link}\">View Profile</a></p>'),
(11,6,'en','New document verification request received','<p>Hi {full_name},</p>\r\n<p>Please find the details for user:</p>\r\n<ul>\r\n<li>Fullname: {user_full_name}</li>\r\n<li>Email: {email}</li>\r\n<li>Role: {role}</li>\r\n<li>Document Title: {title}</li>\r\n<li>Description: {description}</li>\r\n</ul>\r\n<p><a href=\"{link}\">Download Files</a></p>'),
(12,6,'fr','New document verification request received','<p>Hi {full_name},</p>\r\n<p>Please find the details for user:</p>\r\n<ul>\r\n<li>Fullname: {user_full_name}</li>\r\n<li>Email: {email}</li>\r\n<li>Role: {role}</li>\r\n<li>Document Title: {title}</li>\r\n<li>Description: {description}</li>\r\n</ul>\r\n<p><a href=\"{link}\">Download Files</a></p>'),
(13,7,'en','Tasker has been hired to performing task.','<p>Hi {full_name},</p>\r\n<p>A new booking has been recoreded. {tasker} has been hired by {asker}. Please find the booking details below:</p>\r\n<ul>\r\n<li>Booking ID: {booking_id}</li>\r\n<li>Task&nbsp;Description: {task_description}</li>\r\n<li>Total Amount: {total_amount}</li>\r\n<li>Service Date: {service_date}</li>\r\n</ul>\r\n<p>Please find the detailed schedule information:</p>\r\n<p>{schedules}</p>'),
(14,7,'fr','Tasker has been hired to performing task.','<p>Hi {full_name},</p>\r\n<p>A new booking has been recoreded. {tasker} has been hired by {asker}. Please find the booking details below:</p>\r\n<ul>\r\n<li>Booking ID: {booking_id}</li>\r\n<li>Task&nbsp;Description: {task_description}</li>\r\n<li>Total Amount: {total_amount}</li>\r\n<li>Service Date: {service_date}</li>\r\n</ul>\r\n<p>Please find the detailed schedule information:</p>\r\n<p>{schedules}</p>'),
(17,9,'en','Booking has been approved.','<p>Hi {full_name},</p>\r\n<p>Congratulations, {tasker} has approved your booking. The booking has been updated in your scheduler. Please find the details for your booking:</p>\r\n<ul>\r\n<li>\r\n<p>Booking ID: {booking_id}</p>\r\n</li>\r\n<li>\r\n<p>Task Description: {task_description}</p>\r\n</li>\r\n<li>\r\n<p>Total Amount: {total_amount}</p>\r\n</li>\r\n<li>\r\n<p>Service Date: {service_date}</p>\r\n</li>\r\n</ul>\r\n<p>{tasker} would be availble for the following schedule:</p>\r\n<p>{schedules}</p>'),
(18,9,'fr','Booking has been approved.','<p>Hi {full_name},</p>\r\n<p>Congratulations, {tasker} has approved your booking. The booking has been updated in your scheduler. Please find the details for your booking:</p>\r\n<ul>\r\n<li>\r\n<p>Booking ID: {booking_id}</p>\r\n</li>\r\n<li>\r\n<p>Task Description: {task_description}</p>\r\n</li>\r\n<li>\r\n<p>Total Amount: {total_amount}</p>\r\n</li>\r\n<li>\r\n<p>Service Date: {service_date}</p>\r\n</li>\r\n</ul>\r\n<p>{tasker} would be availble for the following schedule:</p>\r\n<p>{schedules}</p>'),
(19,10,'en','Booking has been declined.','<p>Hi {full_name},</p>\r\n<p>Unfortunately, {tasker} has declined your booking request. Although you can search for another tasker. Please find the details for your booking:</p>\r\n<ul>\r\n<li>\r\n<p>Booking ID: {booking_id}</p>\r\n</li>\r\n<li>\r\n<p>Task Description: {task_description}</p>\r\n</li>\r\n<li>\r\n<p>Total Amount: {total_amount}</p>\r\n</li>\r\n<li>\r\n<p>Service Date: {service_date}</p>\r\n</li>\r\n</ul>\r\n<p>&nbsp;</p>'),
(20,10,'fr','Booking has been declined.','<p>Hi {full_name},</p>\r\n<p>Unfortunately, {tasker} has declined your booking request. Although you can search for another tasker. Please find the details for your booking:</p>\r\n<ul>\r\n<li>\r\n<p>Booking ID: {booking_id}</p>\r\n</li>\r\n<li>\r\n<p>Task Description: {task_description}</p>\r\n</li>\r\n<li>\r\n<p>Total Amount: {total_amount}</p>\r\n</li>\r\n<li>\r\n<p>Service Date: {service_date}</p>\r\n</li>\r\n</ul>'),
(21,11,'en','Received booking completion request','<p>Hi {full_name},</p>\r\n<p>{tasker} has submitted a work completion request for <a href=\"{link}\">booking</a>. Please find the work details for booking:</p>\r\n<p><strong>{work}</strong></p>\r\n<p>To verify the completion request, use this {code} shared by <strong>{tasker}</strong>.</p>'),
(22,11,'fr','Received booking completion request','<p>Hi {full_name},</p>\r\n<p>{tasker} has submitted a work completion request for <a href=\"{link}\">booking</a>. Please find the work details for booking:</p>\r\n<p><strong>{work}</strong></p>\r\n<p>To verify the completion request, use this {code} shared by <strong>{tasker}</strong>.</p>'),
(23,12,'en','Payment has been made for booking','<p>Hi {full_name},</p>\r\n<p>{asker} has made a payment for task. Please find the details below:</p>\r\n<ul>\r\n<li>Booking ID: {booking_id}</li>\r\n<li>Total Amount Received: {tasker_amount}</li>\r\n</ul>\r\n<p>For more details, please visit the booking details page&nbsp;<a href=\"{link}\">here</a>.</p>'),
(24,12,'fr','Payment has been made for booking','<p>Hi {full_name},</p>\r\n<p>{asker} has made a payment for task. Please find the details below:</p>\r\n<ul>\r\n<li>Booking ID: {booking_id}</li>\r\n<li>Total Amount Received: {tasker_amount}</li>\r\n</ul>\r\n<p>For more details, please visit the booking details page&nbsp;<a href=\"{link}\">here</a>.</p>'),
(25,13,'en','Booking has been completed.','<p>Hi {full_name},</p>\r\n<p>{asker} has mark the booking as completed. Please provide your feedback to {asker} about your work experience. Visit this <a href=\"{link}\">link</a>&nbsp;for more details.</p>'),
(26,13,'fr','Booking has been completed.','<p>Hi {full_name},</p>\r\n<p>{asker} has mark the booking as completed. Please provide your feedback to {asker} about your work experience. Visit this <a href=\"{link}\">link</a>&nbsp;for more details.</p>'),
(27,14,'en','Your completion request has been rejected','<p>Hi {full_name},</p>\r\n<p>Your completion request has been declined by {asker}. Please find the reason mentioned by {asker} below. Visit this&nbsp;<a href=\"%7Blink%7D\">link</a>&nbsp;for more details.</p>\r\n<p><strong>Reason: {reason}</strong></p>'),
(28,14,'fr','Your completion request has been rejected','<p>Hi {full_name},</p>\r\n<p>Your completion request has been declined by {asker}. Please find the reason mentioned by {asker} below. Visit this&nbsp;<a href=\"%7Blink%7D\">link</a>&nbsp;for more details.</p>\r\n<p><strong>Reason: {reason}</strong></p>'),
(29,15,'en','Booking has been cancelled','<p>Hi {full_name},</p>\r\n<p>Unfortunately, {asker} has cancelled the task that you\'ve been hired to undertake. {asker} has mentioned the reason for cancelling the booking.&nbsp;</p>\r\n<p><strong>Reason: {reason}</strong></p>\r\n<p>Visit the&nbsp;<a href=\"{link}\">booking</a>&nbsp;for more details.</p>'),
(30,15,'fr','Booking has been cancelled','<p>Hi {full_name},</p>\r\n<p>Unfortunately, {asker} has cancelled the task that you\'ve been hired to undertake. {asker} has mentioned the reason for cancelling the booking.&nbsp;</p>\r\n<p><strong>Reason: {reason}</strong></p>\r\n<p>Visit the&nbsp;<a href=\"{link}\">booking</a>&nbsp;for more details.</p>'),
(31,16,'en','Amount refund on booking cancellation','<p>Hi {full_name},</p>\r\n<p>You just cancelled the booking on {app}. {amount} has been refunded in your stripe account. The refund amount as per the terms of {app}. Please visit your stripe dashboard for more information. Visit the&nbsp;<a href=\"{link}\">booking</a>&nbsp;for more details.</p>'),
(32,16,'fr','Amount refund on booking cancellation','<p>Hi {full_name},</p>\r\n<p>You just cancelled the booking on {app}. {amount} has been refunded in your stripe account. The refund amount as per the terms of {app}. Please visit your stripe dashboard for more information.&nbsp;Visit the&nbsp;<a href=\"{link}\">booking</a>&nbsp;for more details.</p>'),
(33,17,'en','Your documents has been approved.','<p>Hi {full_name},</p>\r\n<p>The documents submitted has been approved.&nbsp;</p>'),
(34,17,'fr','Your documents has been approved.','<p>Hi {full_name},</p>\r\n<p>The documents submitted has been approved.&nbsp;</p>'),
(35,18,'en','Your documents has been rejected.','<p>Hi {full_name},</p>\r\n<p>The documents submitted has been rejected. The reason for rejection is as follows:</p>\r\n<p>{reason}&nbsp;</p>'),
(36,18,'fr','Your documents has been rejected.','<p>Hi {full_name},</p>\r\n<p>The documents submitted has been rejected. The reason for rejection is as follows:</p>\r\n<p>{reason}&nbsp;</p>'),
(37,19,'en','Admin sent a message.','<p>Hi {full_name},</p>\r\n<p>Please find the message from administrator:</p>\r\n<p><strong>{message}</strong></p>'),
(38,19,'fr','Admin sent a message.','<p>Hi {full_name},</p>\r\n<p>Please find the message from administrator:</p>\r\n<p><strong>{message}</strong></p>');

/*Table structure for table `language` */

DROP TABLE IF EXISTS `language`;

CREATE TABLE `language` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `code` varchar(5) NOT NULL,
  `locale` varchar(255) NOT NULL,
  `image` text,
  `sort_order` int(11) DEFAULT '1',
  `status` smallint(6) DEFAULT '1',
  `is_default` smallint(6) DEFAULT '0',
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `language` */

insert  into `language`(`id`,`name`,`code`,`locale`,`image`,`sort_order`,`status`,`is_default`,`created_at`,`updated_at`) values 
(1,'English','en','en-US,en_US.UTF-8,en_US,en-gb,english',NULL,1,1,1,1489988305,1489988305);

/*Table structure for table `menu` */

DROP TABLE IF EXISTS `menu`;

CREATE TABLE `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `parent` int(11) DEFAULT NULL,
  `route` varchar(255) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `data` blob,
  PRIMARY KEY (`id`),
  KEY `parent` (`parent`),
  CONSTRAINT `menu_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `menu` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

/*Data for the table `menu` */

insert  into `menu`(`id`,`name`,`parent`,`route`,`order`,`data`) values 
(1,'Administration',NULL,'/site/index',1,NULL),
(2,'Frontend',NULL,'/site/index',2,NULL),
(3,'User Management',1,'/user/default/index',1,'return [\'icon\'=>\'users\'];'),
(4,'Role Management',1,'/admin/assignment/index',2,'return [\'icon\'=>\'shield\'];'),
(5,'Gii',1,'/gii/default/index',1000,'return [\'icon\'=>\'code\'];'),
(6,'System',1,'/site/settings',25,'return [\'icon\'=>\'cogs\'];'),
(7,'Site Settings',6,'/site/settings',1,'return [\'icon\'=>\'cogs\'];'),
(8,'Language',6,'/language/default/index',2,'return [\'icon\'=>\'language\'];'),
(9,'Testimonial',6,'/testimonial/default/index',3,'return [\'icon\'=>\'comments-o\'];'),
(10,'Blog',6,'/blog/default/index',4,'return [\'icon\'=>\'info\'];'),
(11,'Post',10,'/blog/default/index',1,'return [\'icon\'=>\'info\'];'),
(12,'Category',10,'/blog/category/index',2,'return [\'icon\'=>\'mars-double\'];'),
(13,'Email Templates',6,'/email-templates/default/index',5,NULL),
(14,'Social Auth Configuration',6,'/site/social-auth',6,NULL),
(15,'Profile Approvals',1,'/user/profile-approval/index',5,NULL),
(16,'System Logs',6,'/log/index',10,NULL),
(17,'Content Pages',6,'/pages/default/index',11,NULL);

/*Table structure for table `migration` */

DROP TABLE IF EXISTS `migration`;

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `migration` */

insert  into `migration`(`version`,`apply_time`) values 
('m000000_000000_base',1488909918),
('m130524_201442_init',1488909921),
('m140506_102106_rbac_init',1488911195),
('m140602_111327_create_menu_table',1488911212),
('m141106_185632_log_init',1521309644),
('m150125_135015_init_config',1489169787),
('m160312_050000_create_user',1488911212),
('m170219_102729_create_testimonial_table',1521307413),
('m170317_025912_create_email_templates_table',1509330336),
('m170318_041311_create_language_table',1490678892),
('m170318_165120_create_blog_post_category_table',1490678906),
('m170318_171600_create_blog_post_status_table',1490678907),
('m170318_171757_create_blog_post_table',1490678909),
('m170318_172406_create_blog_post_categories_mapping_table',1490678911),
('m170318_172626_create_blog_post_language_table',1490678913),
('m170318_173925_create_blog_post_comments_table',1490678914),
('m170323_022109_create_pages_table',1490678900),
('m170910_112333_create_settings_table',1509330307);

/*Table structure for table `pages` */

DROP TABLE IF EXISTS `pages`;

CREATE TABLE `pages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slug` varchar(510) DEFAULT NULL,
  `banner` text,
  `status` varchar(255) DEFAULT 'active',
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `pages` */

/*Table structure for table `pages_language` */

DROP TABLE IF EXISTS `pages_language`;

CREATE TABLE `pages_language` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `page_id` int(11) unsigned NOT NULL,
  `language` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text,
  `meta_title` varchar(255) NOT NULL,
  `meta_description` text,
  `meta_keywords` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk-post-page_id` (`page_id`),
  CONSTRAINT `fk-post-page_id` FOREIGN KEY (`page_id`) REFERENCES `pages` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `pages_language` */

/*Table structure for table `settings` */

DROP TABLE IF EXISTS `settings`;

CREATE TABLE `settings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(10) NOT NULL,
  `section` varchar(255) NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` text NOT NULL,
  `description` text,
  `status` smallint(6) NOT NULL DEFAULT '1',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

/*Data for the table `settings` */

insert  into `settings`(`id`,`type`,`section`,`key`,`value`,`description`,`status`,`created_at`,`updated_at`) values 
(1,'string','SiteConfiguration','appName','Yii Application',NULL,1,1509330615,1509330615),
(2,'string','SiteConfiguration','adminEmail','admin@example.com',NULL,1,1509330615,1509330615),
(3,'string','SiteConfiguration','adminTheme','skin-blue',NULL,1,1509330615,1521358789),
(4,'string','SiteConfiguration','googleAutocompleteApiKey','AIzaSyBb_ydf1LEK-UsZiOmFdlX3iQ0RsHCXHOQ',NULL,1,1509330615,1509330615),
(5,'string','SiteConfiguration','loginAfterEmailVerification','1',NULL,1,1517032120,1521304651),
(6,'string','SiteConfiguration','enableProfileApproval','1',NULL,1,1517032120,1521305811),
(7,'string','SiteConfiguration','copyrightYear','2018',NULL,1,1521307708,1521307740),
(8,'string','SiteConfiguration','enableRobots','0',NULL,1,1521358782,1521358782);

/*Table structure for table `site_settings` */

DROP TABLE IF EXISTS `site_settings`;

CREATE TABLE `site_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `field_name` varchar(255) DEFAULT NULL,
  `field_type` enum('textInput','textarea','fileInput') DEFAULT 'textInput',
  `value` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `sort_order` int(10) unsigned DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

/*Data for the table `site_settings` */

insert  into `site_settings`(`id`,`name`,`field_name`,`field_type`,`value`,`sort_order`) values 
(22,'site_title','Site Title','textInput','',1),
(23,'google_autocomplete_api_key','Google Autocomplete API Key','textInput',NULL,2);

/*Table structure for table `system_log` */

DROP TABLE IF EXISTS `system_log`;

CREATE TABLE `system_log` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `level` int(11) DEFAULT NULL,
  `category` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `log_time` double DEFAULT NULL,
  `prefix` text COLLATE utf8_unicode_ci,
  `message` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `idx_log_level` (`level`),
  KEY `idx_log_category` (`category`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `system_log` */

/*Table structure for table `testimonial` */

DROP TABLE IF EXISTS `testimonial`;

CREATE TABLE `testimonial` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `client_photo` varchar(255) DEFAULT 'default.png',
  `status` smallint(5) DEFAULT '1',
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `testimonial` */

/*Table structure for table `testimonial_language` */

DROP TABLE IF EXISTS `testimonial_language`;

CREATE TABLE `testimonial_language` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `testimonial_id` int(11) unsigned NOT NULL,
  `language` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text,
  `client_name` varchar(255) NOT NULL,
  `client_designation` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk-testimonial-testimonial_id` (`testimonial_id`),
  CONSTRAINT `fk-testimonial-testimonial_id` FOREIGN KEY (`testimonial_id`) REFERENCES `testimonial` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `testimonial_language` */

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(10) unsigned DEFAULT '2',
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`),
  KEY `status_id` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `user` */

insert  into `user`(`id`,`username`,`auth_key`,`password_hash`,`password_reset_token`,`email`,`status`,`created_at`,`updated_at`) values 
(1,'admin','yugRovG2S-1qnUVLZueSWrom31z6cB8L','$2y$13$8EHaa3Lg.bSDeqyvzWG5iebN0ZrNwqxlY869jy5SbVPh4pzBW732y',NULL,'alkurntest123@gmail.com',1,1488911411,1488911411);

/*Table structure for table `user_address` */

DROP TABLE IF EXISTS `user_address`;

CREATE TABLE `user_address` (
  `user_id` int(10) unsigned NOT NULL,
  `address_line` varchar(255) DEFAULT NULL,
  `locality` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `postal_code` varchar(255) DEFAULT NULL,
  `latitude` varchar(255) DEFAULT NULL,
  `longitude` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  CONSTRAINT `user_address_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `user_address` */

insert  into `user_address`(`user_id`,`address_line`,`locality`,`city`,`state`,`country`,`postal_code`,`latitude`,`longitude`) values 
(1,'San Francisco, San Antonio, TX, United States, San Francisco',NULL,NULL,NULL,NULL,'78201',NULL,NULL);

/*Table structure for table `user_document_verification` */

DROP TABLE IF EXISTS `user_document_verification`;

CREATE TABLE `user_document_verification` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `file_path` varchar(500) NOT NULL,
  `status` enum('pending','approved','rejected') DEFAULT 'pending',
  `reason` text,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `user_document_verification_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `user_document_verification` */

/*Table structure for table `user_notification` */

DROP TABLE IF EXISTS `user_notification`;

CREATE TABLE `user_notification` (
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `text_notification` tinyint(1) DEFAULT '0',
  `email_notification` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`user_id`),
  CONSTRAINT `user_notification_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `user_notification` */

/*Table structure for table `user_profile` */

DROP TABLE IF EXISTS `user_profile`;

CREATE TABLE `user_profile` (
  `user_id` int(10) unsigned NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT 'no-avatar.png',
  `gender` enum('male','female') DEFAULT NULL,
  `dob` datetime DEFAULT NULL,
  `designation` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `telephone` varchar(255) DEFAULT NULL,
  `about` text,
  `nationality` varchar(255) DEFAULT NULL,
  `marital_status` enum('married','unmarried') DEFAULT 'unmarried',
  `is_profile_approved` tinyint(5) DEFAULT '1',
  PRIMARY KEY (`user_id`),
  CONSTRAINT `user_profile_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `user_profile` */

insert  into `user_profile`(`user_id`,`first_name`,`last_name`,`avatar`,`gender`,`dob`,`designation`,`mobile`,`telephone`,`about`,`nationality`,`marital_status`,`is_profile_approved`) values 
(1,'John','Doe','no-avatar.png',NULL,NULL,NULL,'',NULL,NULL,NULL,'unmarried',1);

/*Table structure for table `user_profile_approval` */

DROP TABLE IF EXISTS `user_profile_approval`;

CREATE TABLE `user_profile_approval` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `rejection_reason` text,
  `status` tinyint(5) DEFAULT '0',
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `user_profile_approval_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `user_profile_approval` */

/*Table structure for table `user_social_auth` */

DROP TABLE IF EXISTS `user_social_auth`;

CREATE TABLE `user_social_auth` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `source` varchar(255) NOT NULL,
  `source_id` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `user_social_auth_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `user_social_auth` */

/*Table structure for table `user_verification` */

DROP TABLE IF EXISTS `user_verification`;

CREATE TABLE `user_verification` (
  `user_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `token` varchar(255) NOT NULL,
  `request_time` datetime NOT NULL,
  `responded` tinyint(5) DEFAULT '0',
  PRIMARY KEY (`user_id`),
  CONSTRAINT `user_verification_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `user_verification` */

insert  into `user_verification`(`user_id`,`token`,`request_time`,`responded`) values 
(1,'dGaqNc1iNh66XO7owuzQ6VD1zvswN2I5','2018-01-27 06:45:05',1);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
