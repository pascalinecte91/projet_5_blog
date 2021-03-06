<?php

namespace App\Model;

use App\Model\Comment;
use App\PaginatedQuery;
use \PDO;

final class CommentManager extends Manager
{
    protected $manager = "comment";
    protected $class = Comment::class;

    public function createComment(Comment $comment): void
    {
        $id = $this->create([
      'content' => $comment->getContent(),
      'created_at' => $comment->getCreatedAt()->format('Y-m-d H:i:s'),
      'author' => $comment->getAuthor(),
      'post_id' => $comment->getPostId()
    ]);
        $comment->setID($id);
    }

    public function updateComment(Comment $comment): void
    {
        $this->update([
      'content' => $comment->getContent(),
      'created_at' => $comment->getCreatedAt()->format('Y-m-d H:i:s'),
      'author' => $comment->getAuthor(),
    ], $comment->getID());
    }

    public function hydrateComments(array $comments)
    {
        foreach ($comments as $comment) {
            $comment->setComment([]);
        }
        $comments = $this->pdo
      ->query('SELECT content, post_id FROM comment WHERE post_id = ' . $comment->getPostId())
      ->fetchAll(PDO::FETCH_CLASS, $this->class);
    }

    public function findPaginated()
    {
        $paginatedQuery = new PaginatedQuery(
            "SELECT * FROM {$this->manager} ORDER BY created_at DESC",
            "SELECT COUNT(id) FROM {$this->manager}",
            $this->pdo
        );
        $comments = $paginatedQuery->getItems(Comment::class);

        (new CommentManager($this->pdo))->hydrateComments($comments);
        return [$comments, $paginatedQuery];
    }

    public function findByPostID($post_id, $is_valid = true)
    {
        $query = $this->pdo->prepare('SELECT * FROM ' . $this->manager  .  ' WHERE post_id = :post_id and is_valid= :is_valid');
        $query->execute(['post_id' => $post_id, 'is_valid' => $is_valid]);
        $query->setFetchMode(PDO::FETCH_CLASS, $this->class);
        $result = $query->fetchAll();


        return $result;
    }

    public function approve(Comment $comment): void
    {
        $this->update(['is_valid' => 1], $comment->getID());
    }


    public function findByID($comment_id)
    {
        $query = $this->pdo->prepare('SELECT * FROM ' . $this->manager  .  ' WHERE id= :id');
        $query->execute(['id' => $comment_id]);
        $query->setFetchMode(PDO::FETCH_CLASS, $this->class);
        $result = $query->fetch();

        return $result;
    }
    
}