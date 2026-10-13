<?php

namespace app\controller;

use app\admin\model\AuthModel;
use support\Request;
use Gregwar\Captcha\CaptchaBuilder;

class Auth {
    protected $authModel;

    public function __construct() {
        $this->authModel = new AuthModel();
    }

    public function index(Request $request) {
        // $builder = new CaptchaBuilder;
        // $builder->build();
        $data['session'] = $request->session()->all();
        // $data['builder'] = $builder;

        // $_SESSION['phrase'] = $builder->getPhrase();
        // echo $_SESSION['phrase'];
        if ($request->session()->get('user_id')) {
            // return "berhasil";
            return redirect('/admin/posts/index');
        }
        return view('login', $data);
    }

    public function getcaptcha(Request $request) {
        $builder = new CaptchaBuilder;
        $data['builder'] = $builder->build();
        return view('captcha', $data);
    }

    public function test(Request $request) {
        // return  $request->getLocalPort();
    }

    public function pos(Request $request) {
        return $request->rawBody();
    }

    public function get(Request $request) {
        return json($request->get());
    }

    public function login(Request $request) {
        $post = $request->post();
        $logged_in = $this->authModel->login($post['username'], $post['password']);
        if (!empty($logged_in->ID)) {
            // if (strtolower($_SESSION['phrase']) == strtolower($post['captcha'])) {
            $user_data = ['user_id' => $logged_in->ID,
                'username' => $logged_in->user_login,
                'fullname' => $logged_in->display_name,
                'level' => $logged_in->level,
                'message' => 'Logged In'];
            $request->session()->put($user_data);
            return redirect('/admin/posts');
            // } else {
            //     // user phrase is wrong
            //     $request->session()->set('message', 'Sorry Wrong Captca');
            //     return redirect('/auth');
            // }
        } elseif ($request->session()->get('user_id')) {
            return redirect('/admin/posts');
        } else {
            $request->session()->set('message', 'Sorry Wrong User / Pass');
            return redirect('/auth');
        }
    }

    public function logout(Request $request) {
        $request->session()->flush();
        return redirect('/auth');
    }
}
