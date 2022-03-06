<?php
declare(strict_types = 1);
namespace Inspire\Logger\Queue;

use Monolog\Handler\ProcessableHandlerTrait;
use Monolog\Handler\FormattableHandlerTrait;

/**
 * Description of \Monolog\LoggerFactory
 *
 * @author aalves
 */
class QueueHandler extends \Monolog\Handler\AbstractProcessingHandler
{
    use ProcessableHandlerTrait;
    use FormattableHandlerTrait;

    protected function write(array $record): void
    {}
}

