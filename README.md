# What is `logging-php`?

`logging-php` supports log levels And you can publish log to rabbitMQ for now.

# _Another_ logging library, Why?

> Logging libraries are like opinions, everyone needs one depends upon the need.


## And how is `logging-php` different?

- RabbitMQ Integration



# Usage/examples:



Publish to RabbitMQ using a logging-php instantiated like so:

```php

<?php
require __DIR__.'../../vendor/autoload.php';

use Logging\Logging;

$log=new Logging();
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
$log->info("saurav",array("foo"=>"bar"));
$log->warning("saurav",array("foo"=>"bar"));





```



# Contributing

1. Create an issue, describe the bugfix/feature you wish to implement.
2. Fork the repository
3. Create your feature branch (`git checkout -b my-new-feature`)
4. Commit your changes (`git commit -am 'Add some feature'`)
5. Push to the branch (`git push origin my-new-feature`)
6. Create a new Pull Request

