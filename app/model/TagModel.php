<?php

namespace app\model;

use support\Model;

class TagModel extends Model {
    protected $table = 'keyword';

    protected $primaryKey = 'category_id';

    public function getAll($keyword, $limit, $page) {
        $page_limit = !empty($page) ? ($page - 1) * $limit : '';
        $data = $this->select('keyword', 'ID', 'post_title', 'post_date', 'img_thumb')
                ->join('list_keyword AS l', 'l.keyword_id', '=', 'keyword.keyword_id')
                ->join('posts AS p', 'p.ID', '=', 'l.post_id')
                ->join('image_featured AS f', 'p.ID', '=', 'f.post_id')
                ->groupBy('p.ID');
        return $data->where("keyword",  'like', '%' .$keyword.'%')->orderByDesc('post_date')->limit($limit)->offset($page_limit)->get();
    }
    
    public function getTotal($keyword) {
        $data = $this->select($this->raw('count(DISTINCT post_id) as total'))
                ->join('list_keyword AS l', 'l.keyword_id', '=', 'keyword.keyword_id');
        return $data->where("keyword", $keyword)->first()->total;
    }

    public function getCategory($id) {
       return $this->where('category_id', $id)->first();
    }

    public function getCatBySlug($slug) {
       return $this->where('slug', $slug)->first();
    }
}