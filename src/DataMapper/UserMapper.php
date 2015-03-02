<?php

namespace Regitec\DataMapper;

use Regitec\Entities\User;
use Regitec\Resources\Databases\MySqlPDO;

class UserMapper
{
    protected $db;

    public function __construct()
    {
        $this->db = new MySqlPDO();
    }

    public function saveUser(User $user)
    {
        $statement = $this->db->dbh->prepare("INSERT INTO Regitec.User (
                                                            firstname,
                                                            lastname,
                                                            patronymic,
                                                            password,
                                                            email,
                                                            phone,
                                                            iconAvatar,
                                                            previewAvatar,
                                                            largeAvatar
                                            ) values ( :firstname,
                                                            :lastname,
                                                            :patronymic,
                                                            :password,
                                                            :email,
                                                            :phone,
                                                            :iconAvatar,
                                                            :previewAvatar,
                                                            :largeAvatar
                                            )");
        $statement->execute($user->getAllData());

        return $this->db->dbh->lastInsertId();
    }

    public function getUser($id)
    {
        $statment = $this->db->dbh->prepare('SELECT * FROM Regitec.User WHERE id = :id');
        $statment->execute(array(':id' => $id));
        $result = $statment->fetch();

        return $result;
    }
}