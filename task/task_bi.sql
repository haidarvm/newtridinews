-- table post
ALTER TABLE `wput_posts` CHANGE `description` `description` VARCHAR(160)  DEFAULT NULL;


-- table post for prepagate
add headline, reporter_id
ALTER TABLE `wpw4_posts` ADD `sub_heading` VARCHAR(2000) NOT NULL AFTER `post_title`; 
ALTER TABLE `wpw4_posts` ADD `img_caption` VARCHAR(2000) NOT NULL AFTER `guid`; 
ALTER TABLE `wpw4_posts` ADD `headline` INT(1) NULL AFTER `guid`; 
ALTER TABLE `wpw4_posts` ADD `reporter_id` INT(2) NULL AFTER `guid`; 
ALTER TABLE `wpw4_popular_posts` ADD INDEX(`post_id`);
ALTER TABLE `wpw4_posts` CHANGE `post_author` `post_author` BIGINT(20) UNSIGNED NULL DEFAULT '0'; 

-- get tag
SELECT object_id, slug, description, COUNT FROM wpw4_term_relationships 
INNER JOIN wpw4_posts ON wpw4_posts.ID = wpw4_term_relationships.object_id
INNER JOIN wpw4_term_taxonomy ON wpw4_term_taxonomy.term_taxonomy_id=wpw4_term_relationships.term_taxonomy_id
INNER JOIN wpw4_terms ON wpw4_terms.term_id=wpw4_term_taxonomy.term_id 
WHERE taxonomy="post_tag"
ORDER BY object_id DESC;

-- table keyword
CREATE TABLE `wpw4_keyword` (
  `keyword_id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `keyword` varchar(5000) NOT NULL,
  PRIMARY KEY (`keyword_id`) USING BTREE,
  UNIQUE KEY `post_id` (`post_id`)
) ENGINE=MyISAM AUTO_INCREMENT=12404 DEFAULT CHARSET=latin1;

-- reporter 
CREATE TABLE `wpw4_reporter` (
  `reporter_id` tinyint(3) NOT NULL AUTO_INCREMENT,
  `name` varchar(500) NOT NULL,
  `address` varchar(500) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`reporter_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- create popular post

CREATE TABLE `wpw4_popular_posts` (
  `popular_id` bigint(25) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` int(11) DEFAULT NULL,
  `total_pageviews` bigint(20) NOT NULL DEFAULT 0,
  `last_view` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`popular_id`),
  KEY `post_id` (`post_id`),
  KEY `total_pageviews` (`total_pageviews`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- create table video
CREATE TABLE `wpw4_video` (
  `video_id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `link` varchar(5000) NOT NULL,
  `source` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1= youtube, 2=vidio',
  PRIMARY KEY (`video_id`) USING BTREE,
  KEY `post_id` (`post_id`)
) ENGINE=MyISAM AUTO_INCREMENT=12405 DEFAULT CHARSET=latin1;

-- select  category
SELECT t.name as cat_name, t.term_id, p.ID as ID FROM `wpw4_posts` as `p` INNER JOIN wpw4_users as u ON u.ID = p.post_author INNER JOIN wpw4_term_relationships as r ON r.object_id = p.ID INNER JOIN wpw4_term_taxonomy as x ON x.term_taxonomy_id = r.term_taxonomy_id INNER JOIN wpw4_terms as t ON t.term_id = x.term_id WHERE `p`.`post_type` = 'post' AND `post_status` = 'publish' AND `taxonomy` = 'category' ORDER BY `post_date` DESC LIMIT 100

-- select category and parent
select t.name cat, t.term_id cid, p.name parent , p.term_id pid
from wpw4_terms t, wpw4_term_taxonomy tt, wpw4_terms p
where tt.term_id=t.term_id and tt.parent=p.term_id



-- get all category
SELECT * FROM wpw4_list_category LIMIT 100;

SELECT *
FROM wpw4_term_relationships
LEFT JOIN wpw4_term_taxonomy
   ON (wpw4_term_relationships.term_taxonomy_id = wpw4_term_taxonomy.term_taxonomy_id)
LEFT JOIN wpw4_terms on wpw4_term_taxonomy.term_taxonomy_id = wpw4_terms.term_id
WHERE wpw4_term_taxonomy.taxonomy = 'category'
GROUP BY wpw4_term_taxonomy.term_id

-- get image thumbnail
SELECT post_id,date , CONCAT(LEFT(image, LENGTH(image) - LOCATE('.', REVERSE(image))),'-150x150.',SUBSTRING_INDEX(image, '.', -1)) AS image
FROM (
  SELECT    
  p.ID AS post_id, 
  p.post_date AS date,
  (SELECT `guid` FROM wpw4_posts WHERE id = m.meta_value) AS image
  FROM wpw4_posts p, wpw4_postmeta m
  WHERE p.post_type = 'post'
  AND p.post_status = 'publish'
  AND m.meta_key = '_thumbnail_id'
  AND p.id = m.post_id
  ORDER BY date DESC
) TT

-- insert into category


-- insert select category list
INSERT INTO wpw4_list_category (post_id,category_id, category_name) 
SELECT p.ID,
       t.term_id,
       t.name
FROM `wpw4_posts` as `p`
INNER JOIN wpw4_users as u ON u.ID = p.post_author
INNER JOIN wpw4_term_relationships as r ON r.object_id = p.ID
INNER JOIN wpw4_term_taxonomy as x ON x.term_taxonomy_id = r.term_taxonomy_id
INNER JOIN wpw4_terms as t ON t.term_id = x.term_id
WHERE `p`.`post_type` = 'post'
  AND `post_status` = 'publish'
  AND `taxonomy` = 'category'
ORDER BY `post_date` DESC;



-- insert select featured img 




-- alter 
ALTER TABLE wpw4_postmeta CONVERT TO CHARACTER SET utf8

-- replace https
UPDATE wpw4_image_featured
SET img_thumb = REPLACE(img_thumb, 'https', 'http'),
full_path = REPLACE(full_path, 'https', 'http')
WHERE full_path LIKE '%https%'

-- replace remove base_url
UPDATE wpw4_image_featured
SET img_thumb = REPLACE(img_thumb, 'http://www.beritainspiratif.com/wp-content/uploads/', ''),
full_path = REPLACE(full_path, 'http://www.beritainspiratif.com/wp-content/uploads/', '')

-- create img featured
CREATE TABLE `wpw4_image_featured` (
  `image_featured_id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `filename` varchar(1000)  DEFAULT NULL,
  `img_thumb` varchar(1000) NOT NULL,
  `img_mid` varchar(1000) DEFAULT NULL,
  `full_path` varchar(1000) NOT NULL,
  `created` timestamp NULL DEFAULT current_timestamp(),
  `original_name` varchar(1000)  DEFAULT NULL,
  `new_site` tinyint(1) NOT NULL DEFAULT 0,
  `update_date` timestamp NULL DEFAULT '2018-01-01 01:01:01' ON UPDATE current_timestamp(),
  PRIMARY KEY (`image_featured_id`),
  UNIQUE KEY `post_id` (`post_id`) USING BTREE
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;


-- insert data img
INSERT INTO wpw4_image_featured (post_id, created, img_thumb, img_mid, full_path)
SELECT post_id, date , CONCAT(LEFT(image, LENGTH(image) - LOCATE('.', REVERSE(image))),'-150x150.',SUBSTRING_INDEX(image, '.', -1)) AS image, image as img_mid, image as full_path
FROM (
  SELECT    
  p.ID AS post_id, 
  p.post_date AS date,
  (SELECT `guid` FROM wpw4_posts WHERE id = m.meta_value) AS image
  FROM wpw4_posts p, wpw4_postmeta m
  WHERE p.post_type = 'post'
  AND p.post_status = 'publish'
  AND m.meta_key = '_thumbnail_id'
  AND p.id = m.post_id
  ORDER BY date DESC
) TT

-- img mid
UPDATE wpw4_image_featured SET img_mid = full_path 

-- create wpw4 list category
CREATE TABLE `wpw4_list_category` (
  `list_id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `category_name` varchar(500) NOT NULL,
  PRIMARY KEY (`list_id`),
  KEY `post_id` (`post_id`),
  KEY `category_id` (`category_id`)
) ENGINE=MyISAM ;


-- create category
CREATE TABLE `wpw4_category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT '0',
  `slug` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `category_name` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `category_desc` varchar(2000) CHARACTER SET latin1 DEFAULT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- insert data category
INSERT INTO wpw4_category (category_id,parent_id,slug,category_name)
SELECT wpw4_terms.term_id,parent, slug,name
FROM wpw4_term_relationships
LEFT JOIN wpw4_term_taxonomy
   ON (wpw4_term_relationships.term_taxonomy_id = wpw4_term_taxonomy.term_taxonomy_id)
LEFT JOIN wpw4_terms on wpw4_term_taxonomy.term_taxonomy_id = wpw4_terms.term_id
WHERE wpw4_term_taxonomy.taxonomy = 'category'
GROUP BY wpw4_term_taxonomy.term_id
	
-- insert data		
-- INSERT INTO wpw4_posts_part
-- SELECT * FROM wpw4_posts

-- update error date
UPDATE wpw4_posts_bak set post_date_gmt=post_date 
WHERE post_date_gmt = '0000-00-00 00:00:00';

-- remove more than one img feature
DELETE n1
FROM wpw4_image_featured n1,
           wpw4_image_featured n2
WHERE n1.post_id < n2.post_id
  AND n1.name = n2.name;
  
  
-- update img
#update where jabarnews fullpath url

UPDATE wpw4_image_featured set img_mid = REPLACE(img_mid, '_thumb', '_mid');

SELECT * FROM `wpw4_image_featured` where img_mid IS NULL;

SELECT * FROM `wpw4_image_featured` where full_path LIKE 'http:%'

UPDATE wpw4_image_featured
SET img_thumb = REPLACE(img_thumb, 'http:', 'https:'),
img_mid = REPLACE(img_thumb, 'http:', 'https:'),
full_path = REPLACE(full_path, 'http:', 'https:')

UPDATE wpw4_image_featured
SET img_thumb = REPLACE(img_thumb, 'https://www.beritainspiratif.com/wp-content/uploads/', ''),
img_mid = REPLACE(img_thumb, 'https://www.beritainspiratif.com/wp-content/uploads/', ''),
full_path = REPLACE(full_path, 'https://www.beritainspiratif.com/wp-content/uploads/', '')

UPDATE wpw4_image_featured
SET img_thumb = REPLACE(img_thumb, 'https://www.beritainspiratif.com/', ''),
img_mid = REPLACE(img_thumb, 'https://www.beritainspiratif.com/', ''),
full_path = REPLACE(full_path, 'https://www.beritainspiratif.com/', '')


UPDATE wpw4_image_featured
SET img_thumb = REPLACE(img_thumb, 'https://www.www.beritainspiratif.com/wp-content/uploads/', ''),
img_mid = REPLACE(img_thumb, 'https://www.www.beritainspiratif.com/wp-content/uploads/', ''),
full_path = REPLACE(full_path, 'https://www.www.beritainspiratif.com/wp-content/uploads/', '')


UPDATE wpw4_image_featured set img_mid = REPLACE(img_mid, '_thumb', '_mid');

UPDATE wpw4_image_featured set img_mid = REPLACE(img_mid, '-150x150', '');

UPDATE `wpw4_image_featured` set img_mid = full_path WHERE img_mid IS NULL


SELECT `post_date`, `ID`, `post_title` FROM `wpw4_posts` WHERE post_date <= NOW() AND post_date >= DATE_SUB(NOW(), INTERVAL 7 MINUTE) AND `post_status` = 'future' ORDER BY `ID` DESC

