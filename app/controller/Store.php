<?php

namespace app\controller;

use app\model\ProductModel;
use support\Request;

class Store {
    protected $mproduct;

    public function __construct() {
        $this->mproduct = new ProductModel();
    }

    public function index(Request $request) {
        $data = $request->data;
        $data['request'] = $request;
        $data['mpop']->daily();
        $data['products'] = $this->mproduct->getAllProduct();
        return view('product_list_view', $data);
    }

    public function detail(Request $request, $store) {
        $product = $this->mproduct->getProductSlug($store);
        $data = $request->data;
        $data['request'] = $request;
        $data['mpop']->daily();
        $data['product'] = $product;
        $data['product_imgs'] = $this->mproduct->getProductMultiImg($product->product_id );
        $data['imgMid'] = $product->thumb;
        $data['title'] = $product->name;
        $data['metaDescription'] = $product->meta_description;
        return view("product_view", $data);
    }



}
