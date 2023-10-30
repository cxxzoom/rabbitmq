<?php
require_once "..\common.php";

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;


$connection = new AMQPStreamConnection(...config());
$channel = $connection->channel();

$channel->queue_declare('hello', false, false, false, false);

for ($i = 0; $i < 21; $i++) {
	$msg_str = "'wq!'{$i}";
	$msg = new AMQPMessage($msg_str);
	$channel->basic_publish($msg, '', 'hello');
	echo " [x] Sent {$msg_str}\n";
}
$channel->close();
$connection->close();