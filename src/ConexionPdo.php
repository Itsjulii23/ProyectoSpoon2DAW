<?php

namespace src;

require_once __DIR__ . '/../config.php';

use PDO;
use PDOException;

class ConexionPdo
{
    public static function conectar(string $bd = '')
    {
        $usuario = $_ENV['DB_USERNAME'];
        $clave = $_ENV['DB_PASSWORD'];

        $opciones = [
            PDO::ATTR_EMULATE_PREPARES => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4",
        ];

        $pdo = null;

        try {
            if (empty($bd)) {
                $pdo = new PDO("mysql:host=localhost;", $usuario, $clave, $opciones);
            } else {
                $pdo = new PDO("mysql:dbname=$bd;host=localhost;", $usuario, $clave, $opciones);
            }
        } catch (PDOException $e) {
            echo "[x] Conexion fallida: " . $e->getMessage();
        }

        return $pdo;
    }
}
