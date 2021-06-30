<?php

require dirname(__FILE__, 4) . '/vendor/autoload.php';

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class Queue
{
    protected $connection;

    protected $channel;

    public function __construct($registry)
    {
        $config = $registry->get('config');

        $this->connection = new AMQPStreamConnection(
            $config->get('rabbitmq_host'),
            $config->get('rabbitmq_port'),
            $config->get('rabbitmq_user'),
            $config->get('rabbitmq_pass')
        );
        $this->channel = $this->connection->channel();
    }

    public function addTask(string $queueName, array $data = [])
    {
        $this->channel->queue_declare($queueName, false, true, false, false);

        $msg = new AMQPMessage(
            json_encode($data),
            array('delivery_mode' => AMQPMessage::DELIVERY_MODE_PERSISTENT)
        );

        $this->channel->basic_publish($msg, '', $queueName);

        $this->channel->close();
        $this->connection->close();
    }
}