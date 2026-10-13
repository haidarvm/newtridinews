<?php

namespace app\controller;

use app\model\HomeModel;
use app\model\SingleModel;
use app\model\ApiModel;
use app\model\PopularModel;
use support\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use support\Redis;

class Api {
    protected $mhome;
    protected $mpop;
    protected $mcat;
    protected $msingle;

    public function __construct() {
        $this->mhome = new HomeModel();
        $this->msingle = new SingleModel();

    }

    public function index(Request $request) {
        return json('bismillah');
    }

    public function keyword(Request $request) {
        $data['request'] = $request;
        $data = $this->mhome->getAllKeywords($request->get('term'));
        return json($data);
    }

    public function news(Request $request) {
        $data['data'] = $this->mhome->getLatestAPI(null, 20);
        return json($data);
    }

    public function latest(Request $request, $page = null) {
        $page = !empty($page) ? $page : null;
        $data = $this->mhome->getLatestAPI(null, 10, null, null, null, $page);
        return json($data);
    }

    public function read(Request $request, $id) {
        $data = $this->msingle->read($id);
        return json($data);
    }

    public function popular(Request $request) {
        $data = !empty(Redis::get('popular')) ? json_decode(Redis::get('popular')) : [];
        return json(['code' => 200, 'msg' => 'success', 'data' => $data]);
    }

    public function read_slug(Request $request, $slug) {
        $data = $this->msingle->read('', $slug);
        return json($data);
    }

    public function latest_api() {
        $data['client'] = new Client();
        $mapi = new ApiModel();
        $body  = '';
        try {
            $responseApi = $data['client']->get('https://terasbandung.com/api/latest/', [
                'timeout' => 3, // Response timeout
                'connect_timeout' => 3, // Connection timeout
            ]);
            $body = json_decode($responseApi->getBody(), true);
            $mapi->truncateData();
            $i = 0;
            foreach ($body as $row) {
                if ($i == 5) {
                    break;
                }
                $data_row['post_id'] = $row['ID'];
                $data_row['title'] = $row['post_title'];
                $data_row['date'] = $row['post_date'];
                $data_row['img_thumb'] = $row['thumbnail'];
                $data_row['img_mid'] = $row['img'];
                $data_row['display_name'] = $row['display_name'];
                $data_row['url'] = $row['url'];
                $data_row['slug'] = str_slug($row['post_title']);
                $insert = $mapi->insertLatest($data_row);
                $i++;
            }
        } catch (ClientException $e) {
            $responseApi = $e->getResponse();
            $body = $responseApi->getBody()->getContents();
        }
        // $data['latest_rb'] = $body[0]['cat_name'];
        return json($data_row);
    }

    public function getSidebar(Request $request, $content) {
        $data = !empty(Redis::get($content)) ? json_decode(Redis::get($content)) : [];
        return json(['code' => 200, 'msg' => 'success', 'data' => $data]);
    }

    public function checkAuth(Request $request) {
        $authHeader = $request->header('authorization'); // lowercase!

        if (!$authHeader) {
            return response(json_encode(['error' => 'Missing Authorization header']), 401);
        }

        $token = str_replace('Bearer ', '', $authHeader);
        if ($token !== env('API_KEY_HAIDAR')) {
            return response(json_encode(['error' => 'Invalid API token']), 403);
        }
        return true;
    }

    public function get_future() {
        $future = $this->mhome->getFuturePosts();
        if (!empty($future[0]->ID)) {
            foreach ($future as $row) {
                // echo $row->post_title . ' ' . $row->post_date;
                return $this->mhome->setPublishFuturePosts($row->ID);
            }
        } else {
            return 'no data';
        }
    }

    public function latest_home(Request $request, $page = null) {
        $page = !empty($page) ? $page : null;
        $data = $this->mhome->getLatestAPI(null, 10, null, null, null, $page);
        return json($data);
    }

    public function haidar(Request $request) {
        $killdate = date('Y-m-d H:i:s');
        return json($killdate);
    }
}
