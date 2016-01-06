<?php

/**
 * (c) Spryker Systems GmbH copyright protected
 */

namespace Unit\Spryker\Shared\Log;

use Codeception\TestCase\Test;
use Unit\Spryker\Shared\Log\Fixtures\TestLoggerConfig;
use Psr\Log\LoggerInterface;
use Spryker\Shared\Log\LoggerTrait;
use Unit\Spryker\Shared\Log\Fixtures\TestLoggerConfig2;

class LoggerTest extends Test
{

    use LoggerTrait;

    /**
     * @return void
     */
    public function testGetLoggerWithoutConfigShouldReturnDefaultLoggerInstance()
    {
        $this->assertInstanceOf(LoggerInterface::class, $this->getLogger());
    }

    /**
     * @return void
     */
    public function testGetLoggerWithSameConfigShouldReturnTheSameLoggerInstance()
    {
        $logger1 = $this->getLogger(new TestLoggerConfig());
        $logger2 = $this->getLogger(new TestLoggerConfig());

        $this->assertSame($logger1, $logger2);
    }

    /**
     * @return void
     */
    public function testGetLoggerWithDifferentConfigShouldReturnDifferentLoggerInstances()
    {
        $logger1 = $this->getLogger(new TestLoggerConfig());
        $logger2 = $this->getLogger(new TestLoggerConfig2());

        $this->assertNotSame($logger1, $logger2);
    }

}