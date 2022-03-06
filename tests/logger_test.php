<?php
use Psr\Log\LogLevel;
use Inspire\Logger\Log;
use Inspire\Support\Message\Serialize\JsonMessage;
use Inspire\Support\Message\Serialize\ArrayMessage;
use Inspire\Support\Message\Serialize\XmlMessage;

define('APP_NAME', 'test');
include dirname(__DIR__) . '/vendor/autoload.php';
// Load a single file
echo Inspire\Config\Config::loadFromFile('config/log.php') . " loaded config from log.php\n";
echo Inspire\Config\Config::loadFromFile('config/queue.php') . " loaded config from queue.php\n";

Log::info('Test direct default info log')->infoMulti('Test info channel default', 'multi default 2')->error('Error default channel');
Log::on('warnapp')->info('Test info')
    ->infoMulti('Test info channel multi', 'multi 2', 'multi 3', 'multi 4')
    ->error('Error log')
    ->notice('Notice log')
    ->warning('Warning log');
Log::on(APP_NAME)->infoMulti('Test', 'multi', 'info', 'channel', APP_NAME)->errorMulti('multi', 'error', 'too');
Log::warning('Test warning');
Log::on('warnapp')->info('this is a file log')
    ->error('error on file log')
    ->debug('debug to file log')
    ->warning('waring file log');

Log::on('redislog')->info('info queue redis')
    ->debug('debug queue redis')
    ->infoMulti('multi queue test ', 'multi', 'info', 'channel', APP_NAME)
    ->info(new JsonMessage([
    'test' => 'json message serializaer test'
]));
Log::on('redisall')->info('this is a queue log')
    ->error('error on queue log')
    ->debug('debug to queue log')
    ->debugMulti('multi queue test ', 'multi', 'info', 'channel', APP_NAME)
    ->warning('waring queue log');
Log::on('rabbit')->info('test rabbit queue')
    ->debug('debug rabbit')
    ->noticeMulti('multi queue test ', 'multi', 'info', 'channel', APP_NAME)
    ->alertMulti(new JsonMessage([
    'test' => 'json message serializer test rabbit'
]), new ArrayMessage([
    'test' => 'array message serializer test rabbit',
    'name' => 'another field'
]), new JsonMessage([
    'test' => 'json message serializer test rabbit',
    'desc' => 'JSON can have another field too'
]), new XmlMessage("<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>  
<note>  
  <to>Tove</to>  
  <from>Jani</from>  
  <heading>Reminder</heading>  
  <body>Don't forget me this weekend!</body>  
</note>"));
    
    
    
    
    