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
$log->setLoggerTimeFormat("time.RFC3339");
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


/*
	ANSIC       = "Mon Jan _2 15:04:05 2006"
	UnixDate    = "Mon Jan _2 15:04:05 MST 2006"
	RubyDate    = "Mon Jan 02 15:04:05 -0700 2006"
	RFC822      = "02 Jan 06 15:04 MST"
	RFC822Z     = "02 Jan 06 15:04 -0700" // RFC822 with numeric zone
	RFC850      = "Monday, 02-Jan-06 15:04:05 MST"
	RFC1123     = "Mon, 02 Jan 2006 15:04:05 MST"
	RFC1123Z    = "Mon, 02 Jan 2006 15:04:05 -0700" // RFC1123 with numeric zone
	RFC3339     = "2006-01-02T15:04:05Z07:00"
	RFC3339Nano = "2006-01-02T15:04:05.999999999Z07:00"
	Kitchen     = "3:04PM"
	// Handy time stamps.
	Stamp      = "Jan _2 15:04:05"
	StampMilli = "Jan _2 15:04:05.000"
	StampMicro = "Jan _2 15:04:05.000000"
	StampNano  = "Jan _2 15:04:05.000000000"
*/


```



# Contributing

1. Create an issue, describe the bugfix/feature you wish to implement.
2. Fork the repository
3. Create your feature branch (`git checkout -b my-new-feature`)
4. Commit your changes (`git commit -am 'Add some feature'`)
5. Push to the branch (`git push origin my-new-feature`)
6. Create a new Pull Request

