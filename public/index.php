<?php

require '../vendor/autoload.php';
use App\Router;

define('DEBUG_TIME', microtime(true));

$whoops = new \Whoops\Run ;
$whoops -> pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops -> register();


if (isset($_GET['page']) && $_GET['page'] ==='1') {
    $uri = explode('?', $_SERVER['REQUEST_URI'])[0];
    $get = $_GET;
    unset($get['page']);
    $query = http_build_query($get);
    if (!empty($query)) {
        $uri = $uri. '?' . $query;
    }
    http_response_code(301);
    header('Location: ' . $uri);
    exit();
}

    $router = new App\Router() ;
    $router
    ->get('/', 'home/index', 'home')
    ->get('/blog', 'post/index', 'blog')
    ->get('/blog',  'comment/index','comment')
    ->get('/blog/category/[*:slug]-[i:id]', 'category/show', 'category')
    ->get('/blog/[*:slug]-[i:id]', 'post/show', 'post')
    ->match('/login', 'auth/login', 'login')
    ->post('/logout', 'auth/logout', 'logout')


    //ADMIN
    // GESTION DES ARTICLES
    ->get('/admin', 'admin/post/index', 'admin_posts')
    ->get('/admin', 'admin/comment/index', 'admin_comment')
    ->match('/admin/post/[i:id]', 'admin/post/edit', 'admin_post')
    ->post('/admin/post/[i:id]/delete', 'admin/post/delete', 'admin_post_delete')
    ->match('/admin/post/new', 'admin/post/new', 'admin_post_new')


    //GESTION CATEGORIES
    ->get('/admin/categories', 'admin/category/index', 'admin_categories')
    ->match('/admin/category/[i:id]', 'admin/category/edit', 'admin_category')
    ->post('/admin/category/[i:id]/delete', 'admin/category/delete', 'admin_category_delete')
    ->match('/admin/category/new', 'admin/category/new', 'admin_category_new')
    ->run();
