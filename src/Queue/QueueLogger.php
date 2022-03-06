<?php
declare(strict_types = 1);
namespace Inspire\Logger\Queue;

use Monolog\Handler\HandlerInterface;
use Psr\Log\LogLevel;
use Monolog\Logger;
use Monolog\DateTimeImmutable;

/**
 * Description of \Monolog\LoggerFactory
 *
 * @author aalves
 */
class QueueLogger extends \Monolog\Logger
{

    /**
     * Collection of Logger objects
     *
     * @var array
     */
    private ?array $logStreams = [];

    /**
     * An instance of \Inspire\Queue\QueueInterface
     *
     * @var \Inspire\Queue\QueueInterface
     */
    private \Inspire\Queue\QueueInterface $queue;

    /**
     *
     * @psalm-param array<callable(array): array> $processors
     *
     * @param string $name
     *            The logging channel, a simple descriptive name that is attached to all log records
     * @param HandlerInterface[] $handlers
     *            Optional stack of handlers, the first one in the array is called first, etc.
     * @param callable[] $processors
     *            Optional array of processors
     * @param \DateTimeZone|null $timezone
     *            Optional timezone, if not provided date_default_timezone_get($message, array $context = []): void will be used
     */
    public function __construct(string $name, array $handlers = [], array $processors = [], ?\DateTimeZone $timezone = null)
    {
        parent::__construct($name, $handlers, $processors, $timezone);
        $this->queue = \Inspire\Queue\Queue::on($this->name);
    }

    /**
     * Set log level INFO
     */
    public function info($message, array $context = []): void
    {
        $this->setLog(LogLevel::INFO, $message);
    }

    /**
     * Set log level DEBUG
     */
    public function debug($message, array $context = []): void
    {
        $this->setLog(LogLevel::DEBUG, $message);
    }

    /**
     * Set log level CRITICAL
     */
    public function critical($message, array $context = []): void
    {
        $this->setLog(LogLevel::CRITICAL, $message);
    }

    /**
     * Set log level ALERT
     */
    public function alert($message, array $context = []): void
    {
        $this->setLog(LogLevel::ALERT, $message);
    }

    /**
     * Set log level EMERGENCY
     */
    public function emergency($message, array $context = []): void
    {
        $this->setLog(LogLevel::EMERGENCY, $message);
    }

    /**
     * Set log level WARNING
     */
    public function warning($message, array $context = []): void
    {
        $this->setLog(LogLevel::WARNING, $message);
    }

    /**
     * Set log level ERROR
     */
    public function error($message, array $context = []): void
    {
        $this->setLog(LogLevel::ERROR, $message);
    }

    /**
     * Set log level NOTICE
     */
    public function notice($message, array $context = []): void
    {
        $this->setLog(LogLevel::NOTICE, $message);
    }

    /**
     * Set single logs
     */
    private function setLog(string $level, $message)
    {
        foreach ($this->handlers as $handler) {
            if ($message instanceof \Inspire\Support\Message\Serialize\MessageInterface) {
                /**
                 * If message is an intance of XmlMessage, create a new ArrayMessage, setting its contents in an index called 'xml'
                 * Do it to avoid XML data corruption (set level and time inside XML)
                 */
                if ($message instanceof \Inspire\Support\Message\Serialize\XmlMessage) {
                    $message = new \Inspire\Support\Message\Serialize\ArrayMessage([
                        'xml' => $message->toXml()
                    ]);
                }
                $message->set('level', $level);
                $message->set('time', date($handler->getFormatter()
                    ->getDateFormat()));
                $this->queue->add($message);
            } else {
                $formatted = rtrim($handler->getFormatter()->format([
                    'message' => $message,
                    'context' => [],
                    'level' => $level,
                    'level_name' => strtoupper($level),
                    'channel' => $this->name,
                    'datetime' => new DateTimeImmutable($this->microsecondTimestamps, $this->timezone),
                    'extra' => []
                ]), PHP_EOL);
                $this->queue->addString($formatted);
            }
        }
    }
}

