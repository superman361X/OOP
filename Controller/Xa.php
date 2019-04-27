<?php

namespace Controller;


class Xa
{
    public function index()
    {

        $conn1 = new \mysqli("127.0.0.1", "root", "root", "study", "3306");
        $conn2 = new \mysqli("127.0.0.1", "root", "root", "study2", "3306");

        $grid = uniqid("");

        $conn1->query("SET autocommit=0;");
        $conn2->query("SET autocommit=0;");
        $conn1->query("XA START '$grid'");
        $conn2->query("XA START '$grid'");

        $user_id = \Models\Snow::createOnlyId();
        $name = time() . '@qq.com';
        $age = rand(16, 60);
        try {

            $return11 = $conn1->query("INSERT INTO t_user1 (`user_id`, `name`,`age`) VALUES ('$user_id', '$name','$age')");
            if ($return11 == false) {
                throw new \Exception("conn1 fail 11");
            }

            $return12 = $conn1->query("INSERT INTO t_user2 (`user_id`, `name`,`age`) VALUES ('$user_id', '$name','$age')");
            if ($return12 == false) {
                throw new \Exception("conn1 fail 12");
            }

            $return21 = $conn2->query("INSERT INTO t_user3 (`user_id`, `name`,`age`) VALUES ('$user_id', '$name','$age')");
            if ($return21 == false) {
                throw new \Exception("conn1 fail 21");
            }

            $return22 = $conn2->query("INSERT INTO t_user4 (`user_id`, `name`,`age`) VALUES ('$user_id', '$name','$age')");
            if ($return22 == false) {
                throw new \Exception("conn2 fail 22");
            }

            $conn1->query("XA END '$grid'");
            $conn2->query("XA END '$grid'");

            $conn1->query("XA PREPARE '$grid'");
            $conn2->query("XA PREPARE '$grid'");

            $conn1->query("XA COMMIT '$grid'");
            $conn2->query("XA COMMIT '$grid'");
        } catch (\Exception $e) {

            $conn1->query("XA END '$grid'");
            $conn2->query("XA END '$grid'");

            $conn2->query("XA ROLLBACK '$grid'");
            $conn1->query("XA ROLLBACK '$grid'");
            print $e->getMessage();
        }
        $conn1->query("SET autocommit=1;");
        $conn2->query("SET autocommit=1;");

        $conn1->close();
        $conn2->close();
    }
}