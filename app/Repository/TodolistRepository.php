<?php 

namespace Todolist\PHP\Native\Repository;

use Todolist\PHP\Native\Domain\Todolist;

class TodolistRepository
{
    private \PDO $connection;

    public function __construct(\PDO $connection)
    { 
        $this->connection = $connection;
    }

    public function save(Todolist $todolist): Todolist
    {
        $statement = $this->connection->prepare("INSERT INTO todolist (content) VALUES (?)");
        $statement->execute([$todolist->task]);

        return $todolist;
    }

    public function findById(string $id): ?Todolist
    {
        $statement = $this->connection->prepare("SELECT id, content FROM todolist WHERE id = ?");
        $statement->execute([$id]);

        try {
            if ($row = $statement->fetch()) {
                $user = new Todolist();
                $user->id = $row["id"];
                $user->task = $row["content"];
                return $user;
            } else {
                return null;
            }
        } finally {
            $statement->closeCursor();
        }
    }

    public function show()  
    {
        $sql = "SELECT * FROM todolist LIMIT 0,5";
        $result = $this->connection->query($sql);
        $statement = $result->fetchAll();

        return $statement;
    }

    public function deleteById(string $id): void
    {
        $statement = $this->connection->prepare("DELETE FROM todolist WHERE id  = ?");
        $statement->execute([$id]);
    }
}