<?php
function getPDO():PDO
{
    define('CONFIG_PATH', '.env.local.ini');
    if (file_exists(CONFIG_PATH)) {
        $config = parse_ini_file(CONFIG_PATH, true);
    } else {
        die('yo tu te trompes');
    }
    $dsn = sprintf('%s:host=%s;dbname=%s;port=%s',
        $config['database']['DB_DRIVER'],
        $config['database']['DB_HOST'],
        $config['database']['DB_NAME'],
        $config['database']['DB_PORT']
    );
    $username = $config['database']['DB_USERNAME'];
    $password = $config['database']['DB_PASSWORD'];
    $options = [
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ];
    try {
        return new PDO($dsn, $username, $password, $options);
    } catch (PDOException $exception) {
        die('Il y a un problème de connection avec la base de donnée, veuillez contacter l‘administrateur');
    }
}