<?php

namespace App\Client;

error_reporting(E_ALL);

require_once __DIR__.'/../vendor/autoload.php';

use Inbox\Inbox;
use Inbox\InboxServiceClient;
use Inbox\InboxServiceProcessor;
use Inbox\Message;
use Thrift\ClassLoader\ThriftClassLoader;
use Thrift\Protocol\TBinaryProtocol;
use Thrift\Transport\TBufferedTransport;
use Thrift\Transport\TSocket;
use Thrift\Transport\THttpClient;
use Thrift\Exception\TException;

$loader = new ThriftClassLoader();
$loader->registerNamespace('Thrift', __DIR__ . '/../vendor/apache/thrift/lib/php/lib');
$loader->registerNamespace('Inbox',  __DIR__.'/../gen-php');
$loader->register();

try {
    if (array_search('--http', $argv)) {
        $socket = new THttpClient('localhost', 8080, '/php/PhpServer.php');
    } else {
        $socket = new TSocket('localhost', 9090);
    }
    $transport = new TBufferedTransport($socket, 1024, 1024);
    $protocol = new TBinaryProtocol($transport);
    $client = new InboxServiceClient($protocol);

    $transport->open();

    $client->addMessage(/*...*/);

    $transport->close();

} catch (TException $tx) {
    print 'TException: '.$tx->getMessage()."\n";
}
