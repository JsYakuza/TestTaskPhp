<?php
declare(strict_types=1);

namespace Test\Logger\loggerClasses;

use Psr\Log\LoggerInterface;
use Psr\Log\AbstractLogger;
use Test\Logger\Listeners\DatabaseListener;
use Test\Logger\Helpers\Helpers;
use Exception;

class DatabaseLogger extends AbstractLogger implements LoggerInterface
{

    private static ?DatabaseLogger $instance = null;

    public static function getInstance(): DatabaseLogger
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
        DatabaseListener::logInDB($message, $level);
    }
}
