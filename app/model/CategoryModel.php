<?php

namespace app\model;

use support\Model;

class CategoryModel extends Model {
    protected $table = 'category';

    protected $primaryKey = 'category_id';

    public function getAll() {
        return $this->get();
    }

    public function getCategory($id) {
       return $this->where('category_id', $id)->first();
    }

    public function getCatBySlug($slug) {
       return $this->where('slug', $slug)->first();
    }
}