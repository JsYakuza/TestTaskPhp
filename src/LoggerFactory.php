<?php
declare(strict_types=1);

namespace Test\Logger;

use Psr\Log\LoggerInterface;
use Test\Logger\loggerClasses\DatabaseLogger;
use Test\Logger\loggerClasses\FileLogger;
use Psr\Log\InvalidArgumentException;

final class LoggerFactory 
{

    public const DATABASE_TYPE = 'db';
    public const FILE_TYPE = 'file';

    public static function createLogger(string $type): LoggerInterface
    {
        switch($type) {
            case self::DATABASE_TYPE:
                return DatabaseLogger::getInstance();
            case self::FILE_TYPE:
                return FileLogger::getInstance();
            default:
                throw new InvalidArgumentException('Такого логера нет');
                return false;
        };
    }
}