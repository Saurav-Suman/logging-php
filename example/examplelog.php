<?php
require __DIR__.'../../vendor/autoload.php';

use Logging\Logging;

$log=new Logging();
$log->setRabbitmqHost("127.0.0.1");
$log->setRabbitmqPort("5672");
$log->setRabbitmqUser("guest");
$log->setRabbitmqPassword("guest");
$log->setLoggerTimeFormat("time.RFC3339");
$log->setQueuePrefix("ayopop");
$log->setQueueNames(array("Api" => "api",
    "Debug" => "debug",
    "Info" => "info",
    "Warn" => "warning",
    "Error" => "error",
    "Critical" => "critical"));

$log->connect();
$log->info("saurav",array("sd"=>"Sdsd"));
$log->warning("saurav",array("sd"=>"Sdsd"));
