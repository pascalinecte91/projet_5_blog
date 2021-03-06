<?php
session_start();

require '../vendor/autoload.php';
use App\Router;

define('DEBUG_TIME', microtime(true));

$whoops = new \Whoops\Run ;
$whoops -> pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops -> register();

define('UPLOAD_PATH', __DIR__ . DIRECTORY_SEPARATOR . 'uploads');

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
    ->get('/blog', 'comment/index', 'comment')
    ->get('/blog/[*:slug]-[i:id]', 'post/show', 'post')
    ->post('/blog/[*:slug]-[i:id]/comments', 'comment/new', 'comment_new')
    ->match('/login_member', 'auth/login_member', 'login_member')
    ->match('/login_register', 'auth/login_register', 'login_register')
    ->match('/login_admin', 'auth/login_admin', 'login_admin')
    ->get('/logout', 'auth/logout', 'logout')

    //FORMULAIRE
    ->post('/contact', 'home/contact', 'send')


    //ADMIN
    // GESTION DES ARTICLES
    ->get('/admin', 'admin/post/index', 'admin_posts')
    ->match('/admin/post/[i:id]', 'admin/post/edit', 'admin_post')
    ->post('/admin/post/[i:id]/delete', 'admin/post/delete', 'admin_post_delete')
    ->match('/admin/post/new', 'admin/post/new', 'admin_post_new')


    //GESTION COMMENTAIRES
    ->get('/admin', 'admin/comment/index', 'admin_comments')
    ->match('/admin/[i:id]/comment', 'admin/comment/liste', 'admin_comment_list')
    ->match('/admin/[i:id]/comment', 'admin/comment/liste_delete', 'admin_comment_list_delete')
    ->match('/admin/[i:id]/comment', 'admin/comment/liste_approve', 'admin_comment_list_approve')
    ->get('/admin/comment/[i:id]/delete', 'admin/comment/delete', 'admin_comment_delete')
    ->get('/admin/comment/[i:id]/approve', 'admin/comment/approve', 'admin_comment_approve')
    ->match('/admin/comment/[i:id]', 'admin/comment/edit', 'admin_comment')
    ->match('/admin/comment/new', 'admin/comment/new', 'admin_comment_new')
    ->run();
