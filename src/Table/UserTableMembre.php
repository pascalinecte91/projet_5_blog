<?php

namespace App\Table;

use App\Model\UserMembre;
use App\Table\Exception\NotFoundException;

final class UserTableMembre extends Table
{
    protected $table = "user_membre";
    protected $class = UserMembre::class;

    public function findByUserMembre(string $usermembre)
    {
        $query = $this->pdo->prepare('SELECT * FROM ' . $this->table . ' WHERE user_membre = :user_membre');
        $query->execute(['user_membre' => $usermembre()]);
        $query->setFetchMode(\PDO::FETCH_CLASS, $this->class);
        $result = $query->fetch();
        if ($result === false) {
            throw new NotFoundException($this->table, $usermembre);
        }
        return $result;
        
    }
}
