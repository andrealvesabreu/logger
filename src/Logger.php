<?php
declare(strict_types = 1);
namespace Inspire\Logger;

use Psr\Log\LogLevel;

/**
 *
 * @author aalves
 *        
 */
final class Logger
{

    /**
     * Collection of Logger objects
     *
     * @var array
     */
    private ?array $logStreams = [];

    /**
     * Channel who this Logger belong to
     *
     * @var string
     */
    private string $channel = 'default';

    public function __construct(?string $channel = null)
    {
        $this->channel = $channel ?? 'default';
    }

    /**
     * Initialize instance level log
     *
     * @param string $level
     * @return boolean
     */
    public function initLevel(string $level)
    {
        return $this->exists($level);
    }

    /**
     * Set log level INFO
     */
    public function infoMulti()
    {
        $this->setLogMulti(LogLevel::INFO, func_get_args());
        return $this;
    }

    /**
     * Set log level DEBUG
     */
    public function debugMulti()
    {
        $this->setLogMulti(LogLevel::DEBUG, func_get_args());
        return $this;
    }

    /**
     * Set log level CRITICAL
     */
    public function criticalMulti()
    {
        $this->setLogMulti(LogLevel::CRITICAL, func_get_args());
        return $this;
    }

    /**
     * Set log level ALERT
     */
    public function alertMulti()
    {
        $this->setLogMulti(LogLevel::ALERT, func_get_args());
        return $this;
    }

    /**
     * Set log level EMERGENCY
     */
    public function emergencyMulti()
    {
        $this->setLogMulti(LogLevel::EMERGENCY, func_get_args());
        return $this;
    }

    /**
     * Set log level WARNING
     */
    public function warningMulti()
    {
        $this->setLogMulti(LogLevel::WARNING, func_get_args());
        return $this;
    }

    /**
     * Set log level ERROR
     */
    public function errorMulti()
    {
        $this->setLogMulti(LogLevel::ERROR, func_get_args());
        return $this;
    }

    /**
     * Set log level NOTICE
     */
    public function noticeMulti()
    {
        $this->setLogMulti(LogLevel::NOTICE, func_get_args());
        return $this;
    }

    /**
     * Set log level INFO
     */
    public function info()
    {
        $this->setLog(LogLevel::INFO, func_get_args()[0] ?? null);
        return $this;
    }

    /**
     * Set log level DEBUG
     */
    public function debug()
    {
        $this->setLog(LogLevel::DEBUG, func_get_args()[0] ?? null);
        return $this;
    }

    /**
     * Set log level CRITICAL
     */
    public function critical()
    {
        $this->setLog(LogLevel::CRITICAL, func_get_args()[0] ?? null);
        return $this;
    }

    /**
     * Set log level ALERT
     */
    public function alert()
    {
        $this->setLog(LogLevel::ALERT, func_get_args()[0] ?? null);
        return $this;
    }

    /**
     * Set log level EMERGENCY
     */
    public function emergency()
    {
        $this->setLog(LogLevel::EMERGENCY, func_get_args()[0] ?? null);
        return $this;
    }

    /**
     * Set log level WARNING
     */
    public function warning()
    {
        $this->setLog(LogLevel::WARNING, func_get_args()[0] ?? null);
        return $this;
    }

    /**
     * Set log level ERROR
     */
    public function error()
    {
        $this->setLog(LogLevel::ERROR, func_get_args()[0] ?? null);
        return $this;
    }

    /**
     * Set log level NOTICE
     */
    public function notice()
    {
        $this->setLog(LogLevel::NOTICE, func_get_args()[0] ?? null);
        return $this;
    }

    /**
     * Set all logs
     */
    private function setLogMulti(string $level, array $messages)
    {
        if (($logStream = $this->exists($level)) !== null) {
            foreach ($messages as $message) {
                $this->setLog($level, $message, $logStream);
            }
        }
    }

    /**
     * Set single logs
     */
    private function setLog(string $level, $message, \Monolog\Logger $logStream = null)
    {
        if ($logStream !== null || ($logStream = $this->exists($level)) !== null) {
            $logStream->$level($message);
        }
    }

    /**
     * Check if Logger exists and try to create if not exists
     *
     * @param string $level
     * @return bool
     */
    private function exists(string $level): ?\Monolog\Logger
    {
        if (! isset($this->logStreams[$level])) {
            if (($logger = LoggerFactory::create($level, $this->channel)) !== null) {
                $this->logStreams[$level] = $logger;
                return $this->logStreams[$level];
            }
            return null;
        }
        return $this->logStreams[$level];
    }
}

