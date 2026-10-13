<?php

namespace app\admin\model;

use support\Model;
use support\Db;

class ProductModel extends Model {

    protected $table = 'product';

    protected $primaryKey = 'product_id';

    protected $tb_product_img = 'product_img';
    public $timestamps = false;

    public function getAllProduct() {
        return $this->orderBy('product_id', 'asc')->get();
    }

    public function getProduct($id) {
        return $this->where('product_id', $id)->first();
    }


    public function getDraftEmptyUser($user_id) {
        return $this->where(['status' => 0,  'user_id' => $user_id, 'name' => ''])->first();
    }

    public function insertImg($data) {
        return $this->from($this->tb_product_img)->insertGetId($data);
    }

    public function getProductMultiImg($product_id) {
        return $this->from($this->tb_product_img)->where('product_id',$product_id)->get();
    }

    public function updateImg($data, $id) {
        unset($data['product_img_id']);
        return $this->from($this->tb_product_img)->where('product_img_id', $id)->update($data);
    }

    public function newProduct($user_id) {
        $data['status'] = 0;
        $data['user_id'] = $user_id;
        $data['created_at'] = date('Y-m-d H:i:s');
        $product_id = $this->insertGetId($data);
        return $product_id;
    }

    public function saveProduct($data) {
        $data_Product = [
            'name' => $data['name'],
            'slug' => str_slug($data['name']),
            'price' => $data['price'],
            'description' => $data['description'],
            'status' => $data['status'],
            'meta_description' => $data['meta_description']
        ];
        $product_id = $data['product_id'];
        $this->where('product_id', $product_id)->update($data_Product);
    }
    

}