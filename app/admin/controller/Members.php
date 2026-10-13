<?php

namespace app\admin\controller;

use support\Request;

class Members {
    // public $info;
    protected $member;

    public function __construct() {
        // $this->info = 'check';
    }

    public function index(Request $request) {
        $data['request'] = $request;
        $data['page'] = "member";
        return view('member', $data);
    }

    public function data(Request $request) {
        return json(['data' => "haidar", 'request' => $request->get("draw")]);
    }

    public function edit(Request $request) {
        // $member = $this->member->getAll();
        // return view('dashboard', ['request' => $request, 'member' => $member]);
    }
}
