<?php

namespace Logging;

use Exception;


class Logging
{
    /*
     * @var string|null Rabbit MQ URL
     */
    private $RabbitmqHost = null;


    /*
     * @var string|null Rabbit MQ User
     */
    private $RabbitmqUser = null;

    /*
     * @var string|null Rabbit MQ Password
     */
    private $RabbitmqPassword = null;


    /*
     * @var string|null Queue Name  Prefix
     */
    private $QueuePrefix = null;

    /*
     * @var array|null Queue Names
     * 
     *  Api:      "api",
	    Debug:    "debug",
		Info:     "info",
		Warn:     "warning",
		Error:    "error",
        Critical: "critical",
        
     */
    private $QueueNames = array();



    /*
     * @var object|null Amqp Object
     */
    private $amqpConnection = null;

    /**
     * Set the RabbitMQ URL
     *
     * @param string $url
     */
    public function setRabbitmqHost($host)
    {
        if (trim($host) == "") {
            throw new \Exception("Parameter Mismatch");
        } else {
            $this->RabbitmqHost = $host;
        }
    }


    /**
     * Set the RabbitMQ Port
     *
     * @param string $url
     */
    public function setRabbitmqPort($port)
    {
        if (trim($port) == "") {
            throw new \Exception("Parameter Mismatch");
        } else {
            $this->RabbitmqPort = $port;
        }
    }

    /**
     * Set the RabbitMQ URL
     *
     * @param string $url
     */
    public function setRabbitmqUser($user)
    {
        if (trim($user) == "") {
            throw new \Exception("Parameter Mismatch");
        } else {
            $this->RabbitmqUser = $user;
        }
    }

    /**
     * Set the RabbitMQ URL
     *
     * @param string $url
     */
    public function setRabbitmqPassword($password)
    {
        if (trim($password) == "") {
            throw new \Exception("Parameter Mismatch");
        } else {
            $this->RabbitmqPassword = $password;
        }
    }

    /**
     * Set the RabbitMQ Queue Prefix
     *
     * @param string $url
     */
    public function setQueuePrefix($prefix = "ayopop")
    {
        $this->QueuePrefix = $prefix;
    }



    /**
     * Set the RabbitMQ msg timestamp
     *
     * @param string $url
     */
    public function setQueueNames($queueArray)
    {
        $KeysToMatch = array(
            "Api",
            "Debug",
            "Info",
            "Warn",
            "Error",
            "Critical"
        );
        $KeysRecieved = array_keys($queueArray);
        $result = array_diff_key($KeysToMatch, $KeysRecieved);
        if (count($result) > 0) {
            throw new \Exception("Parameter Mismatch");
        } else {
            $this->QueueNames = $queueArray;
        }
    }

    /**
     * Get an instance.
     */
    public static function getInstance()
    {
        static $instance = null;

        if (null === $instance) {
            $instance = new static();
        }

        return $instance;
    }




    public function connect()
    {
        try {
            //getting the rabbitMQ connection
            $this->amqpConnection = new Amqp(
                $this->RabbitmqHost,
                $this->RabbitmqPort,
                $this->RabbitmqUser,
                $this->RabbitmqPassword
            );
        } catch (\Exception $e) {
            throw new \Exception("RabbitMQ Connection Failure - " . $e);
        }
    }



    public function publishMessage($message_details, $queueName)
    {
        try {
            $this->amqpConnection->insertMessage($message_details, $this->QueuePrefix, $queueName);
            return true;
        } catch (\Exception $e) {
            throw new \Exception("Error While Insertion - " . $e);
        }
    }

     /**
     * Send an api log
     *
     * @param array $message The log message
     * @param array $data Additional data
     */
    public function api($message, array $data = [])
    {
        $this->log('api', $message, $data);
    }

    /**
     * Send an info log
     *
     * @param array $message The log message
     * @param array $data Additional data
     */
    public function info($message, array $data = [])
    {
        $this->log('info', $message, $data);
    }

    /**
     * Send an warning log
     *
     * @param array $message The log message
     * @param array $data Additional data
     */
    public function warning($message, array $data = [])
    {
        $this->log('warn', $message, $data);
    }

    /**
     * Send an error log
     *
     * @param array $message The log message
     * @param array $data Additional data
     */
    public function error($message, array $data = [])
    {
        $this->log('error', $message, $data);
    }

    /**
     * Send an debug log
     *
     * @param array $message The log message
     * @param array $data Additional data
     */
    public function debug($message, array $data = [])
    {
        $this->log('debug', $message, $data);
    }


    /**
     * Send an CRITICAL log
     *
     * @param array $message The log message
     * @param array $data Additional data
     */
    public function critical($message, array $data = [])
    {
        $this->log('critical', $message, $data);
    }



    /**
     * Add the log to list or send now
     *
     * @param string $type The log type
     * @param array $message The log message
     * @param array $data Additional data
     */
    private function log($type, $message, array $data)
    {

        $this->sendLog(
            $this->makeLog($message, $data),
            $type
        );
    }

    /**
     * Send the log to Rabbit mq
     *
     * @param string $message The log formatted
     * @param string $type The log type and the queue name
     */
    private function sendLog($log, $type = '')
    {

        try {
            $this->publishMessage($log, $type);
        } catch (\Exception $e) {
            throw new \Exception("Error While Insertion - " . $e);
        }
    }

    /**
     * Format the log to send
     *
     * @param array $message The log message
     * @param array $data Additional data
     */
    private function makeLog($message, array $data = [])
    {
        $d = new \DateTime();
        $message['Timestamp'] = $d->format("Y-m-d H:i:s");
        return json_encode($message);
    }




    /**
     * Disable clone to prevent clonning.
     *
     * @return void
     */
    private function __clone()
    { }

    /**
     * Disable wakeup to prefent deserialization.
     *
     * @return void
     */
    private function __wakeup()
    { }

    /**
     * Disable constructor to prevent instantiation.
     */
    private function __construct()
    { }
}
