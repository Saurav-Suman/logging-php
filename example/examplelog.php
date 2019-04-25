<?php
require __DIR__.'../../vendor/autoload.php';

use Logging\Logging;

$log=Logging::getInstance();
$log->setRabbitmqHost("127.0.0.1");
$log->setRabbitmqPort("5672");
$log->setRabbitmqUser("guest");
$log->setRabbitmqPassword("guest");
$log->setQueuePrefix("ayopop");
$log->setQueueNames(array("Api" => "api",
    "Debug" => "debug",
    "Info" => "info",
    "Warn" => "warning",
    "Error" => "error",
    "Critical" => "critical"));

$log->connect();
$log->info(array("foo"=>"bar"));
$log->warning(array("foo"=>"bar"));


