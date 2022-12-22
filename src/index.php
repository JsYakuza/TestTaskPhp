<?php

require_once '../vendor/autoload.php';

use Test\Logger\LoggerFactory;

$dbLogger = LoggerFactory::createLogger(LoggerFactory::DATABASE_TYPE);
$dbLogger->debug('test debug');
$fileLogger = LoggerFactory::createLogger(LoggerFactory::FILE_TYPE);
$fileLogger->critical('test critical');