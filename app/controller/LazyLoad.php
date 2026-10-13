<?php

namespace app\controller;

use support\Request;
use support\Redis;

class LazyLoad {

    public function getContent(Request $request, $content) {
        $data['title'] = $content == 'popular' ? 'Terpopuler' : ucfirst($content);
        $data['articles'] = !empty(Redis::get($content)) ? json_decode(Redis::get($content)) : [];
        return view('lazy_side', $data);
    }

    public function getLatest(Request $request) {
        $data['title'] = 'Berita Terkini';
        $data['latest'] = !empty(Redis::get('terkini')) ? json_decode(Redis::get('terkini')) : [];
        return view('terkini', $data);
    }

    public function getTeras(Request $request) {
        $data['title'] = 'Teras Bandung';
        $data['articles'] = !empty(Redis::get('teras')) ? json_decode(Redis::get('teras')) : [];
        return view('teras', $data);
    }
}
