<?php

namespace app\admin\controller;

use app\admin\model\ProductModel;
use support\Request;
use Gumlet\ImageResize;

class Product {
    protected $mproduct;

    public function __construct() {
        $this->mproduct = new ProductModel();
    }

    public function index(Request $request) {
        $data['request'] = $request;
        $data['product'] = $this->mproduct->getAllProduct();
        return view('product_list_view', $data);
    }

    public function add(Request $request) {
        $getDraftEmpty = $this->mproduct->getDraftEmptyUser($request->session()->get('user_id'));
        // echo $getDraftEmpty;
        if (empty($getDraftEmpty)) {
            $product_id = $this->mproduct->newProduct($request->session()->get('user_id'));
            if (!empty($product_id)) {
                return redirect('/admin/product/edit/' . $product_id);
            } else {
                return false;
            }
        } else {
            return redirect('/admin/product/edit/' . $getDraftEmpty->ID);
        }
    }

    public function edit(Request $request, $id) {
        $data['request'] = $request;
        $data['product_imgs'] = $this->mproduct->getProductMultiImg($id);
        $data['product'] = $this->mproduct->getProduct($id);
        return view('product_view', $data);
    }

    public function save(Request $request) {
        $post = $request->post();
        $product_id = $this->mproduct->saveProduct($post);
        return redirect('/admin/product');
    }

    public function img(Request $request, $id) {
        $file = $request->file('filename');
        if ($file && $file->isValid()) {
            $fileloc = public_path() .  imgFull() . getFileName($file->getUploadName()) . '-' . shortUniq() . '.' . $file->getUploadExtension();
            $file->move($fileloc);
            $data_ori = [
                'path' =>    imgPath() .getFileName($fileloc) . '.' . $file->getUploadExtension(),
                'filename' => getFileName($fileloc),
                'original_name' => $file->getUploadName(),
                'type' => $file->getUploadExtension()
            ];
            $this->mproduct->updateImg($data_ori, $id);
            $img_thumb = $this->resizeThumb($request, $fileloc, $id);
            $data['upload_data']['url'] = imgBasePathUrl($data_ori['path']);
            $data['success'] = true;
            $data['status'] = 200;
            return json($data);
        }
        return response('file not found');
    }

    public function img_multi_upload(Request $request, $id) {
        $file = $request->file('filename');
        if ($file && $file->isValid()) {            
            $fileloc = public_path() . imgFull() . getFileName($file->getUploadName()) . '-' . shortUniq() . '.' . $file->getUploadExtension();
            $file->move($fileloc);
            $data_ori = [
                'product_id' => $id,
                'original' => imgPath() . getFileName($fileloc) . '.' . $file->getUploadExtension(),
                'original_name' => getFileName($fileloc),
            ];

            $product_img_id = $this->mproduct->insertImg($data_ori);
            $img_thumb = $this->resizeThumbMulti($request, $fileloc, $product_img_id);
            $imgMid = $this->resizeMidMuli($request, $fileloc, $product_img_id);
            $data['data']['url'] = $img_thumb;
            // $data['data']['imgMid'] = $imgMid;
            $data['data']['link'] = $img_thumb;
            $data['success'] = true;
            $data['status'] = 200;
            return json($data);
        }
        return response('file not found');
    }

    private function resizeThumb($request, $file, $id) {
        $image = new ImageResize($file);
        $image->crop(400, 300, true, ImageResize::CROPCENTER);
        $image->quality_jpg = 90;
        $newfile = saveNewFile($file, 'thumb', public_path());
        $image->save($newfile, IMAGETYPE_JPEG);
        $data['thumb'] = imgPath() . getFileNameExt($newfile);
        $this->mproduct->updateImg($data, $id);
        return pathToUrl($newfile);
    }

    private function resizeThumbMulti($request, $file, $id) {
        $image = new ImageResize($file);
        $image->crop(200, 112, true, ImageResize::CROPCENTER);
        $image->quality_jpg = 70;
        $newfile = saveNewFile($file, 'thumb', public_path());
        $image->save($newfile, IMAGETYPE_JPEG);
        $data['thumb'] = imgPath() . getFileNameExt($newfile);
        $this->mproduct->updateImg($data, $id);
        return pathToUrl($newfile);
    }

    private function resizeMidMuli($request, $file, $id) {
        $image = new ImageResize($file);
        $image->resizeToBestFit(720, 389);
        $image->quality_jpg = 90;
        $newfile = saveNewFile($file, 'mid', public_path());
        $image->save($newfile);
        $data['img_mid'] = imgPath() . getFileNameExt($newfile);
        $this->mproduct->updateImg($data, $id);
        return pathToUrl($newfile);
    }

}
