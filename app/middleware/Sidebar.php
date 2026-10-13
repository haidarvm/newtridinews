<?php

namespace app\middleware;

use Webman\MiddlewareInterface;
use Webman\Http\Response;
use Webman\Http\Request;
use app\model\HomeModel;
use app\model\AdsModelPublic;

class Sidebar implements MiddlewareInterface {
    protected $mads;

    public function process(Request $request, callable $next): Response {
        $data['mhome'] = new HomeModel();
        $data['mads'] = new AdsModelPublic();
        // $data['terass']  = $data['mhome']->getLatestApiDb();
        $request->data = $data;
        return $next($request);
    }
}
