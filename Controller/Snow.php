<?php

namespace Controller;


class Snow
{
    public function snow()
    {
        $user_id = \Models\Snow::createOnlyId();
        $table = $this->getTable($user_id);
        $name = time() . '@qq.com';
        $age = rand(16, 60);

        $conn = new \mysqli("127.0.0.1", "root", "root", "study", "3306");
        $conn->query("INSERT INTO {$table} (`user_id`, `name`, `age`) VALUES ('$user_id', '$name','$age')");
    }


    private function getTable($user_id, $sub = 5)
    {
        return 't_user' . (($user_id % $sub) + 1);
    }
}