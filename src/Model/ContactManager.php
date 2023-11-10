<?php

namespace App\Model;

use PDO;

class ContactManager extends AbstractManager
{
    public const TABLE = 'contact';

    public function insert(array $contact): int
    {
            $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE .
            " (lastname,firstname,phone,email,reason,content) 
            VALUES (:lastname, :firstname, :phone, :email, :reason, :content)");
            $statement->bindValue('lastname', $contact['lastname'], PDO::PARAM_STR);
            $statement->bindValue('firstname', $contact['firstname'], PDO::PARAM_STR);
            $statement->bindValue('phone', $contact['phone'], PDO::PARAM_INT);
            $statement->bindValue('email', $contact['email'], PDO::PARAM_STR);
            $statement->bindValue(':reason', $contact['reason']);
            $statement->bindValue('content', $contact['content'], PDO::PARAM_STR);

            $statement->execute();
            return (int)$this->pdo->lastInsertId();
    }
}
