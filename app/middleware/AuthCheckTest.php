<?php

namespace app\middleware;

use ReflectionClass;
use Webman\MiddlewareInterface;
use Webman\Http\Response;
use Webman\Http\Request;

class AuthCheckTest implements MiddlewareInterface {
    public function process(Request $request, callable $handler): Response {
        $session = $request->session();
        if (!$session->get('user_id')) {
            return redirect('/');
        }
        return $handler($request);
    }
}
