<?php
$config_db_host = "localhost";
$config_db_dbname = "project";
$config_db_acc = "root";
$config_db_pwd = "password";
$config_db_dsn = "mysql:host=".$config_db_host.";dbname=".$config_db_dbname.";charset=utf8";

try {
    $db = new PDO(
        $config_db_dsn,
        $config_db_acc,
        $config_db_pwd,
        array(
            PDO::ATTR_EMULATE_PREPARES => false,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        )
    );
    $db->query('SET NAMES "utf8"');
} catch (PDOException $e) {
    //throw new PDOException($e);
}
