<?php

namespace app\model;

use support\Model;

class ProductModel extends Model {

    protected $table = 'product';
    protected $primaryKey = 'product_id';
    public $timestamps = false;
    protected $tb_product_img = 'product_img';

    public function getAllProduct() {
        return $this->orderBy('product_id', 'asc')->get();
    }

    public function getProduct($id) {
        return $this->where('product_id', $id)->first();
    }

    public function getMultiImg($id) {
        // return $this->
    }

    public function getProductMultiImg($product_id) {
        return $this->from($this->tb_product_img)->where('product_id',$product_id)->get();
    }

    public function getProductSlug($name) {
        return $this->where('slug', $name)->first();
    }

}