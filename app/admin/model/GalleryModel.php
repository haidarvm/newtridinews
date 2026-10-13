<?php

namespace app\admin\model;

use support\Model;
use support\Db;

class GalleryModel extends Model {
    protected $table = 'image_featured';

    protected $primaryKey = 'image_featured_id';

    public $timestamps = false;

    public function getGallery($page = 1, $limit = null, $search = null) {
        $page_limit = ($page - 1) * $limit;
        $data = $this->select('img_thumb', 'post_title', 'img_caption', 'img_author' , 'image_featured_id')
            ->from('image_featured AS i')
            ->leftjoin('posts as p', 'p.ID', '=', 'i.post_id')
            ->groupBy('i.filename')
            ->orderByDesc('image_featured_id');
        !empty($search) ? $data->where('post_title', 'like', '%' . $search . '%')->orWhere('img_caption', 'like', '%' . $search . '%')->orWhere('img_author', 'like', '%' . $search . '%') : $data;
        return !empty($page) ? $data->limit($limit, $page_limit)->get() : $data->get();
    }

    public function getGalleryTotal( $search = null) {
        $data = $this->select($this->raw('count(DISTINCT ID) as total'))
            ->from('image_featured AS i')
            ->leftjoin('posts as p', 'p.ID', '=', 'i.post_id')
            ->groupBy('i.filename')
            ->orderByDesc('image_featured_id');
        !empty($search) ? $data->where('post_title', 'like', '%' . $search . '%')->orWhere('img_caption', 'like', '%' . $search . '%')->orWhere('img_author', 'like', '%' . $search . '%') : $data;
        return $data->first()->total;
    }


    public function getGalleryId($id, $limit, $search = null) {
        return $this->select('p.ID', 'p.post_title', 'p.post_date', 'p.post_author','p.img_author' , 'p.post_status', 'image_featured_id', 'f.img_thumb as img_thumb', 'f.img_mid', 'u.display_name', 'p.headline', 'p.post_content', 'p.reporter_id', 'img_caption', 'v.link')
            ->from('posts AS p')
            // ->orderByDesc('post_date')
            ->leftJoin('users as u', 'u.ID', '=', 'p.post_author')
            ->where('p.ID', '=', $id)
            ->first();
    }

    public function galUpate($id, $data) {
        $data_post = [
            'img_caption' => $data['img_caption'],
            // 'sub_heading' => $data['sub_heading'],k
            'author' => str_slug($data['post_title'])
        ];
        return $this->where('ID', $data['ID'])->update($data_post);
    }
}
