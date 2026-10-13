<?php

namespace app\admin\controller;

use app\admin\model\AdsModel;
use support\Request;
use Gumlet\ImageResize;

class Ads {
    protected $mads;

    public function __construct() {
        $this->mads = new AdsModel();
    }

    public function index(Request $request) {
        $data['request'] = $request;
        $data['ads'] = $this->mads->getAllAds();
        return view('ads_list_view', $data);
    }

    public function edit(Request $request, $id) {
        $data['request'] = $request;
        $data['ads'] = $this->mads->getAds($id);
        return view('ads_view', $data);
    }

    public function save(Request $request) {
        $post = $request->post();
        $post_id = $this->mads->saveAds($post);
        return redirect('/admin/ads');
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
            $this->mads->updateImg($data_ori, $id);
            // $img_thumb = $this->resizeThumb($request, $fileloc, $id);
            $data['upload_data']['url'] = imgBasePathUrl($data_ori['path']);
            $data['success'] = true;
            $data['status'] = 200;
            return json($data);
        }
        return response('file not found');
    }

}
