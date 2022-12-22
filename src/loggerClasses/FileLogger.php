<?php
declare(strict_types=1);

namespace Test\Logger\loggerClasses;

use Psr\Log\LoggerInterface;
use Psr\Log\AbstractLogger;
use Exception;
use Test\Logger\Listeners\FileListener;
use Test\Logger\Helpers\Helpers;

class FileLogger extends AbstractLogger implements LoggerInterface
{

    private static ?FileLogger $instance = null;

    public static function getInstance(): FileLogger
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    private function __construct()
    {
    }

    private function __clone()
    {
    }

    public function __wakeup()
    {
        throw new Exception("Cannot unserialize singleton");
    }

    public function log($level, $message, array $context = array())
    {
        $message = Helpers::interpolate(strval($message), $context);
        FileListener::logInFile($message, $level);
    }
}
