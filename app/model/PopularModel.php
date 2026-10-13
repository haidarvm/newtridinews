<?php

namespace app\model;

use support\Model;

class PopularModel extends Model {
    protected $table = 'popular_posts';

    protected $primaryKey = 'popular_id';

    public $timestamps = false;

    public function insertPopularPosts($post_id) {
        return $this->insertGetId(['post_id' => $post_id, 'total_pageviews' => 1, 'date' => date("Y-m-d")]);
    }

    public function updatePopularPosts($post_id) {
        $popular = $this->where(['post_id' => $post_id, 'date' => date("Y-m-d")])->first();
        if ($popular) {
            $this->where(['post_id' => $post_id, 'date' => date("Y-m-d")])->increment('total_pageviews', 1);
            return $popular->total_pageviews;
        }
        $this->insertPopularPosts($post_id);
        return 1;
    }

    public function getPopular() {
        $data = $this->select('ca.category_name as cat_name', 'p.ID as ID', 'post_title', 'post_date','img_thumb', $this->raw('SUM(total_pageviews) as total_pageviews') )
        ->from('popular_posts AS pop')
        ->leftJoin('posts AS p',  'p.ID' , '=', 'pop.post_id')
        ->leftJoin('list_category AS c', 'c.post_id', '=', 'p.ID')
        ->leftJoin('category AS ca', 'ca.category_id', '=', 'c.category_id')
        ->leftJoin('image_featured AS f', 'p.ID', '=', 'f.post_id')
        ->whereDate("post_date", ">=" , date("Y-m-d", strtotime("-7 day")))
        ->groupBy('pop.post_id')
        ->orderByDesc('total_pageviews')
        ->limit(5);
        return $data->get();
    }

    public function daily() {
        $daily = $this->from('daily_traffic')->where('date', date("Y-m-d"))->first();
        if ($daily) {
            $this->from('daily_traffic')->where('date',  date("Y-m-d"))->increment('total_views', 1);
            return $daily->total_views;
        }
        $this->insertDaily();
        return 1;
    }    
    
    public function insertDaily() {
        return $this->from('daily_traffic')->insertGetId(['total_views' => 1]);
    }
 
}