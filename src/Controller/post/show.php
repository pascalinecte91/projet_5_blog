<?php

use App\Connection;
use App\Table\PostTable;

$slug =$params['slug'];

$id =(int)$params['id'];



$pdo = Connection::getPDO();
$post = (new PostTable($pdo))->find($id);



if($post->getSlug() !== $slug) {
    $url = $router->url('post', ['slug'=> $post->getSlug(), 'id' => $id]);
    http_response_code(301); 
    header('Location: ' . $url);

}   
require_once ('../views/post/show.php');