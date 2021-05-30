<?php

class Database
{
    public static function getConnection()
    {

        $params = array(
            'host' => 'localhost',
            'dbname' => 'super_mag',
            'user' => 'root',
            'password' => 'admin',


        );


        $dsn = "mysql:host={$params['host']};dbname={$params['dbname']}";
        $db = new PDO($dsn, $params['user'], $params['password']);
        $db->exec("set names utf8");

        return $db;
    }
}