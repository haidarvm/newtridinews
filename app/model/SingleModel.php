<?php

namespace app\model;

use support\Model;
use support\Db;

class SingleModel extends Model {
    protected $table = 'posts';

    protected $primaryKey = 'ID';

    public $timestamps = true;

    public function read($id, $slug = null) {
        $data = $this->select('p.ID', 'cat.category_name as cat_name','c.category_id as cat_id', 'p.post_title', 'p.post_date', 'p.post_author', 'p.post_status', 'image_featured_id', 'img_mid', 'full_path', 'u.display_name', 'p.headline', 'p.post_content', 'p.reporter_id', 'img_caption', 'r.name', 'v.link', 'description')
        ->from('posts AS p')
        ->leftJoin('list_category AS c', 'c.post_id', '=', 'p.ID')
        ->leftJoin('category AS cat', 'cat.category_id', '=', 'c.category_id')
        ->leftJoin('users as u', 'u.ID', '=', 'p.post_author')
        ->leftJoin('reporter as r', 'p.reporter_id', '=', 'r.reporter_id')
        ->leftJoin('image_featured as f', 'p.ID', '=', 'f.post_id')
        ->leftJoin('video as v', 'p.ID', '=', 'v.post_id');
        $where = !empty($id) ? $data->where('p.ID', $id) : $data->where('post_name', $slug);
        return !empty($where->exists()) ? $where->first() : false;
    }

    public function getPost($id, $next) {
        $order = $next == '>' ? 'ASC' : 'DESC';
        $data = $this->select('ID', 'p.post_title', 'p.post_date')
        ->from('posts AS p')
        ->where('p.ID', $next, $id)
        ->where(['p.post_type' => 'post', 'p.post_status' => 'publish'])
        ->orderBy('p.ID', $order)
        ->first();
        return !empty($data->ID) ? $data : (object) ['ID' => 0, 'post_title' => 'tidak tersedia', 'post_date' => date('Y-m-d H:i:s')];
    }

    public function getPhotos($id) {
        return $this->from('photos')->where("post_id", $id)->get();
    }

    public function getAllKeyword($id) {
        return $this->select('k.keyword_id', 'keyword')->from('keyword as k')
            ->leftJoin('list_keyword AS lk', 'lk.keyword_id', '=', 'k.keyword_id')
            ->where('lk.post_id', $id)
            ->get();
    }

    public function getVid($id) {
        return $this->from('video')->where('post_id', $id)->first();
    }
}
