<?php

namespace App\Server;

error_reporting(E_ALL);

require_once __DIR__.'/../vendor/autoload.php';

use Inbox\Inbox;
use Inbox\InboxServiceIf;
use Inbox\InboxServiceProcessor;
use Inbox\Message;
use Thrift\ClassLoader\ThriftClassLoader;
use Thrift\Protocol\TBinaryProtocol;
use Thrift\Transport\TBufferedTransport;
use Thrift\Transport\TPhpStream;

$loader = new ThriftClassLoader();
$loader->registerNamespace('Thrift', __DIR__ . '/../vendor/apache/thrift/lib/php/lib');
$loader->registerNamespace('Inbox',  __DIR__.'/../gen-php');
$loader->register();

if (php_sapi_name() == 'cli') {
    ini_set("display_errors", "stderr");
}

header('Content-Type', 'application/x-thrift');
if (php_sapi_name() == 'cli') {
    echo "\r\n";
}

$handler = new class implements InboxServiceIf {
    /**
     * @inheritDoc
     */
    public function addMessage($inboxID, Message $message)
    {
        // TODO: Implement addMessage() method.
    }

    /**
     * @inheritDoc
     */
    public function openMessage(Message $message)
    {
        // TODO: Implement openMessage() method.
    }

    /**
     * @inheritDoc
     */
    public function deleteMessage(Message $message)
    {
        // TODO: Implement deleteMessage() method.
    }

    /**
     * @inheritDoc
     */
    public function createInbox(Inbox $inbox)
    {
        // TODO: Implement createInbox() method.
    }

    /**
     * @inheritDoc
     */
    public function getInbox($inboxID)
    {
        // TODO: Implement getInbox() method.
    }
};

$transport = new TBufferedTransport(new TPhpStream(TPhpStream::MODE_R | TPhpStream::MODE_W));
$protocol = new TBinaryProtocol($transport, true, true);
$transport->open();
(new InboxServiceProcessor($handler))->process($protocol, $protocol);
$transport->close();
