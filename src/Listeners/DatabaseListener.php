<?php

namespace Test\Logger\Listeners;

use PDO;
use PDOException;

final class DatabaseListener
{
    private const HOST = '127.0.0.1';
    private const DB = 'devdb';
    private const USER = 'root';
    private const PASSWORD = '1111';
    private const CHARSET = 'utf8';
    private const OPTIONS = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];

    public static function logInDB(string $message = '', string $level = '', string $date = ''): void 
    {
        if(!$date) {
            $date = date('Y-m-d H:i:s');
        }
        $dsn = sprintf("mysql:host=%s;dbname=%s;charset=%s", self::HOST, self::DB, self::CHARSET);
        try {
            $pdo = new PDO($dsn, self::USER, self::PASSWORD, self::OPTIONS);
            $stmt = $pdo->prepare('INSERT INTO logs (message, level, log_date) VALUES (:message, :level, :log_date)');
            $stmt->execute(['message' => $message, 'level' => $level, 'log_date' => $date]);
        } catch (PDOException $e) {
            die('Подключение не удалось: ' . $e->getMessage());
        }
    }
}
