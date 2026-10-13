
ALTER TABLE `wput_popular_posts` CHANGE `date` `date` DATE NOT NULL DEFAULT CURRENT_TIMESTAMP; 

UPDATE `wput_popular_posts`  set date = date(`last_view`) where `date` is NULL;

ALTER TABLE `wput_reporter` ADD `active` TINYINT(1) NOT NULL DEFAULT '1' AFTER `email`; 


select `wput_ca`.`category_name` as `cat_name`, `wput_p`.`ID` as `ID`, `post_title`, `post_date`, `post_author`, `full_path`, `img_mid`, `display_name` from `wput_posts` as `wput_p` 
left join `wput_users` as `wput_u` on `wput_u`.`ID` = `wput_p`.`post_author` 
left join `wput_list_category` as `wput_c` on `wput_c`.`post_id` = `wput_p`.`ID` 
left join `wput_category` as `wput_ca` on `wput_ca`.`category_id` = `wput_c`.`category_id` 
left join `wput_image_featured` as `wput_f` on `wput_p`.`ID` = `wput_f`.`post_id` 
where (`post_status` = 'publish' and `post_type` = 'post' and `headline` = 1) group by `wput_p`.`ID` order by `post_date` desc limit 3;


select  `wput_p`.`ID` as `ID`, `post_title`,  `img_mid`, `post_date`, `post_author`,  `display_name` from `wput_posts` as `wput_p` 
left join `wput_users` as `wput_u` on `wput_u`.`ID` = `wput_p`.`post_author` 
left join `wput_list_category` as `wput_c` on `wput_c`.`post_id` = `wput_p`.`ID` 
left join `wput_category` as `wput_ca` on `wput_ca`.`category_id` = `wput_c`.`category_id` 
left join `wput_image_featured` as `wput_f` on `wput_p`.`ID` = `wput_f`.`post_id` 
where (`post_status` = 'publish' and `post_type` = 'post' and `headline` = 1) group by `wput_p`.`ID` order by `post_date` desc limit 3;