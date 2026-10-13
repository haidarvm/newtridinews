<?php

namespace app\admin\model;

use support\Model;
use support\Db;

class CategoryModel extends Model {
    protected $table = 'category';

    protected $primaryKey = 'category_id';
    
    public function getAllCategory(){
        return $this->orderBy('category_id', 'asc')->get();
    }

    public function getCategory($category_id){
        return $this->where('category_id', $category_id)->first();
    }

    public function getListCategoryPostId($post_id) {
        return Db::table("list_category")->where('post_id', $post_id)->get();
    }

    public function getCatBySlug($slug) {
        return $this->where('slug', $slug)->first();
     }

}