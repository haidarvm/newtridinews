<?php

namespace app\admin\model;

use support\Model;

class BacaModel extends Model {
    protected $table = 'posts';

    protected $primaryKey = 'ID';

    public $timestamps = false;

    public function getTitle($page = 1, $limit = null, $search = null) {
        $page_limit = ($page - 1) * $limit;
        $data = $this->select('post_title', 'img_caption', 'description')
            ->orderByDesc('ID');
        !empty($search) ? $data->where('post_title', 'like', '%' . $search . '%')->orWhere('img_caption', 'like', '%' . $search . '%')->orWhere('description', 'like', '%' . $search . '%') : $data;
        return !empty($page) ? $data->limit($limit, $page_limit)->get() : $data->get();
    }

    public function getTitleTotal( $search = null) {
        $data = $this->select($this->raw('count(DISTINCT ID) as total'))
            ->orderByDesc('ID');
        !empty($search) ? $data->where('post_title', 'like', '%' . $search . '%')->orWhere('img_caption', 'like', '%' . $search . '%')->orWhere('description', 'like', '%' . $search . '%') : $data;
        return $data->first()->total;
    }

    public function getTitleId($id, $limit, $search = null) {
        return $this->select('p.ID', 'p.post_title', 'p.post_date', 'p.post_author','p.img_author' , 'p.post_status', 'image_featured_id', 'f.img_thumb as img_thumb', 'f.img_mid', 'u.display_name', 'p.headline', 'p.post_content', 'p.reporter_id', 'img_caption', 'v.link')
            ->from('posts AS p')
            // ->orderByDesc('post_date')
            ->leftJoin('users as u', 'u.ID', '=', 'p.post_author')
            ->where('p.ID', '=', $id)
            ->first();
    }
}
