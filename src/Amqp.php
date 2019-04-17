<?php

namespace Logging;

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

/**
 * @author : Saurav Suman
 * @description: This class is used for Connection with RabbitMQ and performs all the  operations.
 **/
class Amqp
{
    private $connection;
    private $channel;
    
    /**
     * This function gets the Amqp connection and creates a new channel. As we dont need any user inputs for these.. We
     * can create them in constructor
     */

    public function __construct($host, $port, $user, $password)
    {
        try {

            $this->connection = new AMQPStreamConnection($host, $port, $user, $password, "/");

            $this->channel = $this->connection->channel();
        } catch (\Exception  $e) {
            throw new \Exception("RabbitMQ Connection Failure - ".$e);
        }
    }

    /**
     * This function inserts a message in to the queue
     * @param $message is the message that needs to be sent.
     * @param $rmqQueueName is the queue name
     */
    public function insertMessage($message, $rmqQueueName)
    {
         try {
            $this->channel->queue_declare($rmqQueueName, false, false, false, false); 
            $msg = new AMQPMessage($message);
            $this->channel->basic_publish($msg, '', $rmqQueueName);
        } catch (\Exception  $e) {
            throw new \Exception("Error While Insertion - ".$e);
        }
    }
}
