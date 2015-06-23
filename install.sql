create database website;

drop table `page_views`;
create table `page_views` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`page_name` varchar(255) DEFAULT NULL,
	`counter` int(11) DEFAULT 0,
	`created_at` DATETIME NOT NULL,
	`updated_at` DATETIME NOT NULL,
	PRIMARY KEY(`id`),
	UNIQUE(`page_name`)
);
