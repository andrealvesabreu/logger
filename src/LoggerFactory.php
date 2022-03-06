<?php
declare(strict_types = 1);
namespace Inspire\Logger;

/**
 * Description of \Monolog\LoggerFactory
 *
 * @author aalves
 */
final class LoggerFactory
{

    /**
     * Get logger instance
     *
     * @param string $level
     * @return \Monolog\Logger|null
     */
    public static function create(string $level, ?string $channel = null): ?\Monolog\Logger
    {
        if (($logs = \Inspire\Config\Config::get("log")) !== null) {
            /**
             * Filter only configuratons applyable to this channel
             * We can segment logger by channel to create different instances of the same logger class
             */
            $channel = $channel === 'default' ? null : $channel;
            $logs = array_filter($logs, function ($item) use ($channel) {
                if ($channel === null) {
                    return ! isset($item['channel']) || $item['channel'] === null || $item['channel'] === 'default';
                } else {
                    return isset($item['channel']) && $item['channel'] == $channel;
                }
            });
            /**
             * It is possible to have different instances for each log level, too
             */
            $type = $level;
            $index = array_search($level, array_column($logs, 'level'));
            if ($index === false) {
                $index = array_search('all', array_column($logs, 'level'));
                $type = 'all';
            }
            if ($index !== false) {
                $settings = array_values($logs)[$index];
                $settings['name'] = array_keys($logs)[$index];
                /**
                 * Specific configuration for each logger adapter
                 *
                 * @var \Monolog\Formatter\\Monolog\Formatter\LineFormatter; $formatter
                 */
                switch ($settings['adapter']) {
                    /**
                     * Using RotatingFileHandler for log file adapter
                     */
                    case 'file':
                        $formatter = new \Monolog\Formatter\LineFormatter($settings['format'] ?? null, $settings['date_format'] ?? "Y-m-d H:i:s", true, true);
                        $formatter->setDateFormat($settings['date_format'] ?? "Y-m-d H:i:s");

                        $streamHandler = new \Monolog\Handler\RotatingFileHandler($settings['filename'], $settings['max_files'], $level, true, $settings['file_perms'] ?? 1363);
                        $streamHandler->setFormatter($formatter);

                        $logger = new \Monolog\Logger($channel ?? 'default');
                        $logger->pushHandler($streamHandler);
                        break;
                    /**
                     * Using \Inspire\Queue\QueueInterface for log queue adapter
                     */
                    case 'queue':
                        $formatter = new \Monolog\Formatter\LineFormatter($settings['format'] ?? null, $settings['date_format'] ?? "Y-m-d H:i:s", true, true);
                        $formatter->setDateFormat($settings['date_format'] ?? "Y-m-d H:i:s");

                        $streamHandler = new \Inspire\Logger\Queue\QueueHandler();
                        $streamHandler->setFormatter($formatter);

                        $logger = new \Inspire\Logger\Queue\QueueLogger($channel ?? 'default');
                        $logger->pushHandler($streamHandler);
                        break;
                }
                return $logger;
            }
        }
        return null;
    }
}
