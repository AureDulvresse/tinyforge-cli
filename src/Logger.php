<?php

namespace Forge\CLI;

use Monolog\Logger as MonologLogger;
use Monolog\Handler\StreamHandler;

class Logger
{
    protected MonologLogger $logger;

    public function __construct()
    {
        $this->logger = new MonologLogger('forge');
        $this->logger->pushHandler(new StreamHandler(__DIR__ . '/logs/forge.log', MonologLogger::DEBUG));
    }

    public function log(string $level, string $message): void
    {
        switch (strtolower($level)) {
            case 'info':
                $this->logger->info($message);
                break;
            case 'warning':
                $this->logger->warning($message);
                break;
            case 'error':
                $this->logger->error($message);
                break;
            default:
                $this->logger->debug($message);
        }
    }
}
