<?php
namespace app\middleware;

use Webman\MiddlewareInterface;
use app\model\HomeModel;
use Webman\Http\Response;
use Webman\Http\Request;
use app\model\PopularModel;
use app\model\AdsModelPublic;

class SidebarApi implements MiddlewareInterface
{
    public function process(Request $request, callable $next) : Response
    {
        $data['mpop'] = new PopularModel();
        $data['mhome'] = new HomeModel();
        $data['mads'] = new AdsModelPublic();
        $data['populars'] = $data['mpop']->getPopular();
        $request->data = $data;
        return $next($request);
    }
}
