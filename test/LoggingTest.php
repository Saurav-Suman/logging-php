<?php
namespace LoggingTest;

use Logging\Logging;
use PHPUnit\Framework\TestCase;

class LoggingTest extends TestCase
{


    protected $Logger;
    protected $Loggertest;
    /**
     * Set up.
     */
    public function setUp()
    {
        parent::setUp();
    }
    /**
     * @expectedException Exception
     */
    public function testConnectionInvalidHost()
    {
        $this->Loggertest = Logging::getInstance();
        $this->Loggertest->setRabbitmqHost("192.168.0.4");
        $this->Loggertest->setRabbitmqPort("5672");
        $this->Loggertest->setRabbitmqUser("guest");
        $this->Loggertest->setRabbitmqPassword("guest");
        $this->Loggertest->setLoggerTimeFormat("time.RFC3339");
        $this->Loggertest->setQueuePrefix("ayopop");
        $this->Loggertest->setQueueNames(array(
            "Api" => "api",
            "Debug" => "debug",
            "Info" => "info",
            "Warn" => "warning",
            "Error" => "error",
            "Critical" => "critical"
        ));

        $this->Loggertest->connect();
    }

    /**
     * @expectedException Exception
     */
    public function testConnectionInvalidPort()
    {
        $this->Loggertest = Logging::getInstance();
        $this->Loggertest->setRabbitmqHost("127.0.0.1");
        $this->Loggertest->setRabbitmqPort("56720");
        $this->Loggertest->setRabbitmqUser("guest");
        $this->Loggertest->setRabbitmqPassword("guest");
        $this->Loggertest->setLoggerTimeFormat("time.RFC3339");
        $this->Loggertest->setQueuePrefix("ayopop");
        $this->Loggertest->setQueueNames(array(
            "Api" => "api",
            "Debug" => "debug",
            "Info" => "info",
            "Warn" => "warning",
            "Error" => "error",
            "Critical" => "critical"
        ));

        $this->Loggertest->connect();
    }

    /**
     * @expectedException Exception
     */
    public function testConnectionInvalidUser()
    {
        $this->Loggertest = Logging::getInstance();
        $this->Loggertest->setRabbitmqHost("127.0.0.1");
        $this->Loggertest->setRabbitmqPort("5672");
        $this->Loggertest->setRabbitmqUser("saurav");
        $this->Loggertest->setRabbitmqPassword("guest");
        $this->Loggertest->setLoggerTimeFormat("time.RFC3339");
        $this->Loggertest->setQueuePrefix("ayopop");
        $this->Loggertest->setQueueNames(array(
            "Api" => "api",
            "Debug" => "debug",
            "Info" => "info",
            "Warn" => "warning",
            "Error" => "error",
            "Critical" => "critical"
        ));

        $this->Loggertest->connect();
    }


    public function testConnectionInvalidQueueName()
    {
        try {
            $this->Loggertest = Logging::getInstance();
            $this->Loggertest->setRabbitmqHost("127.0.0.1");
            $this->Loggertest->setRabbitmqPort("5672");
            $this->Loggertest->setRabbitmqUser("guest");
            $this->Loggertest->setRabbitmqPassword("guest");
            $this->Loggertest->setLoggerTimeFormat("time.RFC3339");
            $this->Loggertest->setQueuePrefix("ayopop");
            $this->Loggertest->setQueueNames(array(
                "Api" => "api",
                "Debug" => "debug",
                "Info" => "info",
                "Warn" => "warning",
                "Error" => "error",
                //"Critical" => "critical"
            ));
            $this->Loggertest->connect();
        } catch (\Exception $e) {
            $emess = $e->getMessage();
           // echo $emess;
        }
        $this->assertEquals($emess, 'Parameter Mismatch');
    }


    public function testGetInstance()
    {
        $Logger = Logging::getInstance();
        $Logger->setRabbitmqHost("127.0.0.1");
        $Logger->setRabbitmqPort("5672");
        $Logger->setRabbitmqUser("guest");
        $Logger->setRabbitmqPassword("guest");
        $Logger->setLoggerTimeFormat("time.RFC3339");
        $Logger->setQueuePrefix("ayopop");
        $Logger->setQueueNames(array(
            "Api" => "api",
            "Debug" => "debug",
            "Info" => "info",
            "Warn" => "warning",
            "Error" => "error",
            "Critical" => "critical"
        ));

        $Logger->connect();
        $first = $Logger;
        $second = Logging::getInstance();
        $this->assertSame($first, $second);
    }

    /**
     * @expectedException \ArgumentCountError
     */
    public function testpublishMessage()
    {

        $Logger = Logging::getInstance();
        $Logger->setRabbitmqHost("127.0.0.1");
        $Logger->setRabbitmqPort("5672");
        $Logger->setRabbitmqUser("guest");
        $Logger->setRabbitmqPassword("guest");
        $Logger->setLoggerTimeFormat("time.RFC3339");
        $Logger->setQueuePrefix("ayopop");
        $Logger->setQueueNames(array(
            "Api" => "api",
            "Debug" => "debug",
            "Info" => "info",
            "Warn" => "warning",
            "Error" => "error",
            "Critical" => "critical"
        ));

        $Logger->connect();

        $Logger->publishMessage();
    }

    /**
     * @expectedException \TypeError
     */

    public function testTypeInfo()
    {

        $Logger = Logging::getInstance();
        $Logger->setRabbitmqHost("127.0.0.1");
        $Logger->setRabbitmqPort("5672");
        $Logger->setRabbitmqUser("guest");
        $Logger->setRabbitmqPassword("guest");
        $Logger->setLoggerTimeFormat("time.RFC3339");
        $Logger->setQueuePrefix("ayopop");
        $Logger->setQueueNames(array(
            "Api" => "api",
            "Debug" => "debug",
            "Info" => "info",
            "Warn" => "warning",
            "Error" => "error",
            "Critical" => "critical"
        ));

        $Logger->connect();
        $Logger->info("saurav", "test");
    }

    /**
     * @expectedException \ArgumentCountError
     */

    public function testArgumentInfo()
    {

        $Logger = Logging::getInstance();
        $Logger->setRabbitmqHost("127.0.0.1");
        $Logger->setRabbitmqPort("5672");
        $Logger->setRabbitmqUser("guest");
        $Logger->setRabbitmqPassword("guest");
        $Logger->setLoggerTimeFormat("time.RFC3339");
        $Logger->setQueuePrefix("ayopop");
        $Logger->setQueueNames(array(
            "Api" => "api",
            "Debug" => "debug",
            "Info" => "info",
            "Warn" => "warning",
            "Error" => "error",
            "Critical" => "critical"
        ));

        $Logger->connect();
        $Logger->info();
    }
}
