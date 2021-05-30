<?php
class Db
{

    public static function getConnection()
    {
        /**$paramsPath = ROOT . '/config/db_params.php';
        $params = include($paramsPath);


        $dsn = "mysql:host={$params['host']};dbname={$params['dbname']}";
        $db = new PDO($dsn,$params['user'],$params['password']);


        return $db; */

        $servername = "localhost";
        $username = "root";
        $password = "admin";

        try {
            $conn = new PDO("mysql:host=$servername;dbname=super_mag", $username, $password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //echo "Connected successfully";
        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
        return $conn;
    }

}