<?php


use App\Connexion;
use App\Model\CommentManager;
use App\Model\PostManager;
use App\ObjectHelper;
use App\Auth;

Auth::check();

$router->layout = "admin/layouts/default";
$title = "Administration";
$pdo = Connexion::getPDO();
$link = $router->url('admin_comment_list');
[$posts, $pagination] = (new PostManager($pdo))->findPaginated();
[$comments, $pagination] = (new CommentManager($pdo))->findPaginated();


$postManager = new PostManager($pdo);
$commentManager = new CommentManager($pdo);
$comments = $commentManager->findByPostID($params['id'], false);
$approve = 1;
$post = $postManager->find($params['id']);
$is_no_valid = false;

if (!empty($_POST)) {
    ObjectHelper::hydrate($_POST, $comment, ['author', 'content', 'created_at']);
    if ($comment->validate()) {
        $success = true;
    }
}
   
require_once('../views/admin/comment/liste.php');
