<?php
require __DIR__.'../../vendor/autoload.php';

use Logging\Logging;

$log=Logging::getInstance();
$log->setRabbitmqHost("13.232.191.83");
$log->setRabbitmqPort("31395");
$log->setRabbitmqUser("ayopop");
$log->setRabbitmqPassword("reverse_J2Vcx");
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


