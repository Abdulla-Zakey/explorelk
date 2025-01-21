<?php

class Admin
{
    use Model;

    protected $table = 'admin';

    protected $allowedColumns = [
        'admin_id',
        'name',
        'email',
        'password',    
    ];

    public function findEmail($email){
        $query = "SELECT * FROM $this->table WHERE email = :email";
        $params = [':email' => $email];
        $result = $this->query($query, $params);
        return $result ? $result[0]: null;
    }

}