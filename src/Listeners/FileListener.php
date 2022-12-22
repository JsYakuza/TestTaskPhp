<?php

namespace Test\Logger\Listeners;

use Exception;

final class FileListener
{
    public static function logInFile(
        string $message = '',
        string $level = '',
        string $filename = __DIR__ . 'test.txt',
        string $date = ''
    ): void {
        if (!$date) {
            $date = date('Y-m-d H:i:s');
        }
        try {
            $current = sprintf("Message: %s || Level: %s || Date: %s \n", $message, $level, $date);
            file_put_contents($filename, $current, FILE_APPEND | LOCK_EX);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}
