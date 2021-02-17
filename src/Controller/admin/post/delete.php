<?php

use App\Connection;
use App\Table\PostManager;
use App\Auth;

Auth::check();

$pdo = Connection::getPDO();
$table = new PostManager($pdo);
$table->delete($params['id']);

header('Location:' . $router->url('admin_posts') . '?delete=1');
