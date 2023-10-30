<?php
require_once "..\common.php";

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

$conn = new AMQPStreamConnection(...config());
$channel = $conn->channel();

$channel->queue_declare('hello', auto_delete: false);
echo " [*] Waiting for messages. To exit press CTRL+C\n";

/**
 * @param $msg
 * @return void
 */
$fn = function ($msg) {
	echo "[x] I received {$msg->body}";
};

$channel->basic_consume('hello','', false, true, false, false, $fn);

try {
	$channel->consume();
}catch (\Throwable $th){
	echo $th->getMessage();
}