-- table post
add headline, reporter_id
ALTER TABLE `wpci_posts` ADD `portal_id` SMALLINT(4) NOT NULL DEFAULT '0' AFTER `reporter_id`, ADD INDEX `portal` (`portal_id`);

ALTER TABLE `wprg_posts` ADD `img_caption` VARCHAR(5000) NULL AFTER `portal_id`;

ALTER TABLE `wpci_popular_posts` ADD INDEX(`post_id`);


-- direct publish all sajabar
UPDATE wprg_posts SET post_status = 'publish' 
where portal_id !=0

-- update headline
UPDATE wprg_posts 
INNER JOIN wprg_term_relationships ON wprg_posts.ID = wprg_term_relationships.object_id
INNER JOIN wprg_term_taxonomy ON wprg_term_taxonomy.term_taxonomy_id=wprg_term_relationships.term_taxonomy_id
INNER JOIN wprg_terms ON wprg_terms.term_id=wprg_term_taxonomy.term_id 
SET headline = 1
 WHERE taxonomy="post_tag" AND slug='headline'

 SELECT headline,ID FROM wprg_posts 
INNER JOIN  `wprg_keyword` ON wprg_posts.ID = wprg_keyword.post_id
 WHERE wprg_keyword.keyword LIKE '%headline%'

-- get tag
SELECT object_id, slug, description, COUNT FROM wprg_term_relationships 
INNER JOIN wprg_posts ON wprg_posts.ID = wprg_term_relationships.object_id
INNER JOIN wprg_term_taxonomy ON wprg_term_taxonomy.term_taxonomy_id=wprg_term_relationships.term_taxonomy_id
INNER JOIN wprg_terms ON wprg_terms.term_id=wprg_term_taxonomy.term_id 
WHERE taxonomy="post_tag"
ORDER BY object_id DESC;


-- get tag good 
SELECT group_concat(slug), object_id, description FROM wprg_term_relationships 
INNER JOIN wprg_posts ON wprg_posts.ID = wprg_term_relationships.object_id
INNER JOIN wprg_term_taxonomy ON wprg_term_taxonomy.term_taxonomy_id=wprg_term_relationships.term_taxonomy_id
INNER JOIN wprg_terms ON wprg_terms.term_id=wprg_term_taxonomy.term_id 
WHERE taxonomy="post_tag"
GROUP BY object_id
ORDER BY object_id DESC;

-- get headline tag
SELECT object_id, slug, description, COUNT FROM wprg_term_relationships 
INNER JOIN wprg_posts ON wprg_posts.ID = wprg_term_relationships.object_id
INNER JOIN wprg_term_taxonomy ON wprg_term_taxonomy.term_taxonomy_id=wprg_term_relationships.term_taxonomy_id
INNER JOIN wprg_terms ON wprg_terms.term_id=wprg_term_taxonomy.term_id 
WHERE taxonomy="post_tag" AND slug='headline'
ORDER BY object_id DESC;

-- table keyword
CREATE TABLE `wprg_keyword` (
  `keyword_id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `keyword` varchar(5000) NOT NULL,
  PRIMARY KEY (`keyword_id`) USING BTREE,
  UNIQUE KEY `post_id` (`post_id`)
) ENGINE=MyISAM AUTO_INCREMENT=12404 DEFAULT CHARSET=latin1;


-- select  category
SELECT t.name as cat_name, t.term_id, p.ID as ID FROM `wprg_posts` as `p` INNER JOIN wprg_users as u ON u.ID = p.post_author INNER JOIN wprg_term_relationships as r ON r.object_id = p.ID INNER JOIN wprg_term_taxonomy as x ON x.term_taxonomy_id = r.term_taxonomy_id INNER JOIN wprg_terms as t ON t.term_id = x.term_id WHERE `p`.`post_type` = 'post' AND `post_status` = 'publish' AND `taxonomy` = 'category' ORDER BY `post_date` DESC LIMIT 100

-- select category and parent
select t.name cat, t.term_id cid, p.name parent , p.term_id pid
from wprg_terms t, wprg_term_taxonomy tt, wprg_terms p
where tt.term_id=t.term_id and tt.parent=p.term_id



-- get all category
SELECT * FROM wprg_list_category LIMIT 100;

SELECT *
FROM wprg_term_relationships
LEFT JOIN wprg_term_taxonomy
   ON (wprg_term_relationships.term_taxonomy_id = wprg_term_taxonomy.term_taxonomy_id)
LEFT JOIN wprg_terms on wprg_term_taxonomy.term_taxonomy_id = wprg_terms.term_id
WHERE wprg_term_taxonomy.taxonomy = 'category'
GROUP BY wprg_term_taxonomy.term_id

-- get image thumbnail
SELECT post_id,date , CONCAT(LEFT(image, LENGTH(image) - LOCATE('.', REVERSE(image))),'-150x150.',SUBSTRING_INDEX(image, '.', -1)) AS image
FROM (
  SELECT    
  p.ID AS post_id, 
  p.post_date AS date,
  (SELECT `guid` FROM wprg_posts WHERE id = m.meta_value) AS image
  FROM wprg_posts p, wprg_postmeta m
  WHERE p.post_type = 'post'
  AND p.post_status = 'publish'
  AND m.meta_key = '_thumbnail_id'
  AND p.id = m.post_id
  ORDER BY date DESC
) TT

-- insert into category


-- insert select category list
INSERT INTO wprg_list_category (post_id,category_id, category_name) 
SELECT p.ID,
       t.term_id,
       t.name
FROM `wprg_posts` as `p`
INNER JOIN wprg_users as u ON u.ID = p.post_author
INNER JOIN wprg_term_relationships as r ON r.object_id = p.ID
INNER JOIN wprg_term_taxonomy as x ON x.term_taxonomy_id = r.term_taxonomy_id
INNER JOIN wprg_terms as t ON t.term_id = x.term_id
WHERE `p`.`post_type` = 'post'
  AND `post_status` = 'publish'
  AND `taxonomy` = 'category'
ORDER BY `post_date` DESC;



-- insert select featured img 




-- alter 
ALTER TABLE wprg_postmeta CONVERT TO CHARACTER SET utf8

-- replace https
UPDATE wprg_image_featured
SET img_thumb = REPLACE(img_thumb, 'https', 'http'),
full_path = REPLACE(full_path, 'https', 'http')
WHERE full_path LIKE '%https%'

-- replace remove base_url
UPDATE wprg_image_featured
SET img_thumb = REPLACE(img_thumb, 'http://jabarnews.com/wp-content/uploads/', ''),
full_path = REPLACE(full_path, 'http://jabarnews.com/wp-content/uploads/', '')

-- create img featured
CREATE TABLE `wprg_image_featured` (
  `image_featured_id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `filename` varchar(1000) NOT NULL,
  `img_thumb` varchar(1000) NOT NULL,
  `img_mid` varchar(1000) DEFAULT NULL,
  `full_path` varchar(1000) NOT NULL,
  `created` timestamp NULL DEFAULT current_timestamp(),
  `original_name` varchar(1000) NOT NULL,
  `new_site` tinyint(1) NOT NULL DEFAULT 0,
  `update_date` timestamp NULL DEFAULT '2018-01-01 01:01:01' ON UPDATE current_timestamp(),
  PRIMARY KEY (`image_featured_id`),
  UNIQUE KEY `post_id` (`post_id`) USING BTREE
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;


-- insert data img
INSERT INTO wprg_image_featured (post_id, created, img_thumb, img_mid, full_path)
SELECT post_id, date , CONCAT(LEFT(image, LENGTH(image) - LOCATE('.', REVERSE(image))),'-150x150.',SUBSTRING_INDEX(image, '.', -1)) AS image, image as full_path
FROM (
  SELECT    
  p.ID AS post_id, 
  p.post_date AS date,
  (SELECT `guid` FROM wprg_posts WHERE id = m.meta_value) AS image
  FROM wprg_posts p, wprg_postmeta m
  WHERE p.post_type = 'post'
  AND p.post_status = 'publish'
  AND m.meta_key = '_thumbnail_id'
  AND p.id = m.post_id
  ORDER BY date DESC
) TT

-- create wprg list category
CREATE TABLE `wprg_list_category` (
  `list_id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `category_name` varchar(500) NOT NULL,
  PRIMARY KEY (`list_id`),
  KEY `post_id` (`post_id`),
  KEY `category_id` (`category_id`)
) ENGINE=MyISAM ;


-- create category
CREATE TABLE `wprg_category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT '0',
  `slug` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `category_name` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `category_desc` varchar(2000) CHARACTER SET latin1 DEFAULT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- insert data category
INSERT INTO wprg_category (category_id,parent_id,slug,category_name)
SELECT wprg_terms.term_id,parent, slug,name
FROM wprg_term_relationships
LEFT JOIN wprg_term_taxonomy
   ON (wprg_term_relationships.term_taxonomy_id = wprg_term_taxonomy.term_taxonomy_id)
LEFT JOIN wprg_terms on wprg_term_taxonomy.term_taxonomy_id = wprg_terms.term_id
WHERE wprg_term_taxonomy.taxonomy = 'category'
GROUP BY wprg_term_taxonomy.term_id

-- create popular post

CREATE TABLE `wprg_popular_posts` (
  `popular_id` bigint(25) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` int(11) DEFAULT NULL,
  `total_pageviews` bigint(20) NOT NULL DEFAULT 0,
  `last_view` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`popular_id`),
  KEY `post_id` (`post_id`),
  KEY `total_pageviews` (`total_pageviews`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- create reporter

CREATE TABLE `wprg_reporter` (
  `reporter_id` tinyint(3) NOT NULL AUTO_INCREMENT,
  `name` varchar(500) NOT NULL,
  `address` varchar(500) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`reporter_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- create table video
CREATE TABLE `wprg_video` (
  `video_id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `link` varchar(5000) NOT NULL,
  `source` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1= youtube, 2=vidio',
  PRIMARY KEY (`video_id`) USING BTREE,
  KEY `post_id` (`post_id`)
) ENGINE=MyISAM AUTO_INCREMENT=12405 DEFAULT CHARSET=latin1;



-- get video insert
INSERT into wprg_video
(post_id, link, source)
SELECT post_id, meta_value, 1 FROM wprg_postmeta
WHERE meta_key = '_format_video_embed'
AND meta_value != '';

	
-- insert data		
-- INSERT INTO wprg_posts_part
-- SELECT * FROM wprg_posts

-- update error date
UPDATE wprg_posts_bak set post_date_gmt=post_date 
WHERE post_date_gmt = '0000-00-00 00:00:00';

-- update error date
UPDATE wprg_posts set post_date_gmt=post_date 
WHERE post_date_gmt = '0000-00-00 00:00:00';


UPDATE wprg_posts SET post_date_gmt = '2018-01-01 00:00:00' WHERE post_date_gmt < '0000-01-01 00:00:00'
UPDATE wprg_posts SET post_modified_gmt = '2018-01-01 00:00:00' WHERE post_modified_gmt < '0000-01-01 00:00:00'


-- remove more than one img feature
DELETE n1
FROM wprg_image_featured n1,
           wprg_image_featured n2
WHERE n1.post_id < n2.post_id
  AND n1.name = n2.name;



select substring_index(substring_index(r.keyword, ',', n.index), ',', -1) as word,
       count(*)
from wprg_keyword r join
     wprg_iterator n
     on n.index <= length(keyword) - length(replace(keyword, ',', '')) + 1
group by keyword
ORDER BY count(*) DESC;
