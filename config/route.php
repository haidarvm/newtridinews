<?php
/**
 * This file is part of webman.
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the MIT-LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @author    walkor<walkor@workerman.net>
 * @copyright walkor<walkor@workerman.net>
 * @link      http://www.workerman.net/
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */

use Webman\Route;

Route::any('/test', function ($request) {
    return response('test');
});

// Route::any('/home/read/{id}', 'app\controller\Home@read');
// Route::any('/(id:\d+)/', 'app\controller\Read@index');
Route::any('/store', 'app\controller\Store@index');
Route::any('/testclass', [app\controller\Home::class, 'index']);
Route::any('/', 'app\controller\Home@index');
Route::get('/rss', 'app\controller\Rss@index');
Route::get('/rss/{cat}', 'app\controller\Rss@index');
Route::any('/auth', 'app\controller\Auth@index');
Route::any('/logout', 'app\controller\Auth@logout');

Route::any('/admin/robots.txt', function ($request) {
    return response()->withFile(public_path().'/admin/robots.txt');
});
Route::any('/admin', 'app\admin\controller\Posts@index');
// Route::any('/admin/', 'app\admin\controller\Posts@index');
// Route::any('/admin/posts', 'app\admin\controller\Posts@index');
// Route::any('/admin/posts/all/{category}/{date}/{search}/{author}/{page}', 'app\admin\controller\Posts@all');
Route::any('/admin/posts/all/{category}/{daterange}/{search}/{author}/{reporter}/{page}', 'app\admin\controller\Posts@all');
Route::any('/admin/posts/img/{id}', 'app\admin\controller\Posts@img');
Route::any('/admin/posts/img_center/{id}', 'app\admin\controller\Posts@img_center');
Route::any('/admin/posts/photo_upload/{id}', 'app\admin\controller\Posts@photo_upload');
Route::any('/admin/posts/edit_post/{id}', 'app\admin\controller\Posts@edit_post');
Route::any('/admin/posts/edit_photo/{id}', 'app\admin\controller\Posts@edit_photo');
Route::any('/admin/posts/delete/{id}', 'app\admin\controller\Posts@delete');
Route::post('/admin/posts/delete_photo/{photo_id}', 'app\admin\controller\Posts@delete_photo');
Route::any('/admin/posts/pages/{date}/{search}/{author}/{page}', 'app\admin\controller\Posts@pages');
Route::any('/admin/posts/edit_page/{id}', 'app\admin\controller\Posts@edit_page');
Route::any('/admin/posts/add_post', 'app\admin\controller\Posts@add_post');
Route::post('/admin/product/img_multi_upload/{id}', 'app\admin\controller\Product@img_multi_upload');
Route::group('/admin/ads', function () {
    Route::any('', 'app\admin\controller\Ads@index');
    Route::any('/', 'app\admin\controller\Ads@index');
    Route::any('/edit/{id}', 'app\admin\controller\Ads@edit');
    Route::any('/img/{id}', 'app\admin\controller\Ads@img');
})->middleware([
    support\middleware\SuperAdminOnly::class
]);
Route::group('/admin/product', function () {
    Route::any('', 'app\admin\controller\Product@index');
    Route::any('/', 'app\admin\controller\Product@index');
    Route::any('/add', 'app\admin\controller\Product@add');
    Route::any('/edit/{id}', 'app\admin\controller\Product@edit');
    Route::any('/img/{id}', 'app\admin\controller\Product@img');
})->middleware([
    support\middleware\SuperAdminOnly::class
]);
Route::any('/admin/gallery/{page}/{limit}/{search}', 'app\admin\controller\Gallery@index');
Route::any('/admin/gallery/{page}/{limit}', 'app\admin\controller\Gallery@index');
Route::any('/admin/gallery/view/{id}', 'app\admin\controller\Gallery@get_detail');
Route::any('/admin/gallery/update/{id}', 'app\admin\controller\Gallery@update');
Route::any('/admin/baca/{page}/{limit}/{search}', 'app\admin\controller\Baca@index');
Route::any('/admin/baca/{page}/{limit}', 'app\admin\controller\Baca@index');
Route::any('/read/{id}', 'app\controller\Read@index');
Route::any('/read/{id}/', 'app\controller\Read@index');
Route::any('/read/{id}/{slug}', 'app\controller\Read@index');
Route::get('/api/sidebar/{content}', 'app\controller\Api@getSidebar');
Route::get('/api/popular', 'app\controller\Api@popular');
Route::get('/lazy/teras', 'app\controller\LazyLoad@getTeras');
Route::get('/lazy/terkini', 'app\controller\LazyLoad@getLatest');
Route::get('/lazy/{content}', 'app\controller\LazyLoad@getContent');
Route::any('/robots.txt', function ($request) {
    return response()->withFile(public_path().'/robots.txt');
});
Route::any('/favicon.ico', function ($request) {
    return response()->withFile(public_path().'/favicon.ico');
});
Route::any('/favicon.png', function ($request) {
    return response()->withFile(public_path().'/favicon.png');
});
Route::any('/ads.txt', function ($request) {
    return response()->withFile(public_path().'/ads.txt');
});
Route::any('/{year}/{month}/{date}/{slug}', 'app\controller\Read@date_slug');
Route::any('/{year}/{month}/{date}/{slug}/', 'app\controller\Read@date_slug');
Route::any('/amp/{year}/{month}/{date}/{slug}', 'app\controller\Read@date_slug_amp');
Route::any('/amp/{year}/{month}/{date}/{slug}/', 'app\controller\Read@date_slug_amp');
// Route::any('/amp/{id}', 'app\controller\Read@amp_read');
Route::any('/amp/{slug}', 'app\controller\Read@amp_slug');
Route::any('/{slug}', 'app\controller\Read@slug');
Route::any('/page/{slug}', 'app\controller\Page@index');
// Route::any('/{slug}/', 'app\controller\Read@slug');
// Route::any('/read/{slug}', 'app\controller\Read@single');
// Route::any('/read/{id}/{title}', 'app\controller\Read@single');
Route::any('/check/{id}', 'app\controller\Read@check');
Route::any('/ads/{id}', 'app\controller\Home@ads');
Route::any('/category/{slug}', 'app\controller\Category@index');
Route::any('/category/{slug}/', 'app\controller\Category@index');
Route::any('/category/{slug}/{page}', 'app\controller\Category@index');
Route::any('/tag/{slug}', 'app\controller\Tag@index');
Route::any('/tag/{slug}/', 'app\controller\Tag@index');
Route::any('/tag/{slug}/{page}', 'app\controller\Tag@index');
Route::any('/search/post', 'app\controller\Search@post');
Route::any('/search/{search}', 'app\controller\Search@index');
Route::any('/search/{search}/', 'app\controller\Search@index');
Route::any('/search/{search}/{page}', 'app\controller\Search@index');
Route::any('/api/latest/{page}', 'app\controller\Api@latest');
Route::any('/api/latest_home/{page}', 'app\controller\Api@latest_home');
Route::any('/api/read/{id}', 'app\controller\Api@read');
Route::any('/api/reads/{slug}', 'app\controller\Api@read_slug');
Route::any('/store/{slug}', 'app\controller\Store@detail');
// Route::any('/route-test', 'app\controller\Index@index');
// Route::any('/admin/dashboard', 'app\admin\controller\Dashboard@index');
// Route::any('/dashboard', 'app\admin\controller\Dashboard@index');
// Route::any('/home', 'app\controller\Home');
