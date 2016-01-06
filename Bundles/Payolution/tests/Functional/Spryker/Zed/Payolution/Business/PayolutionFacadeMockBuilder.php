<?php

/**
 * (c) Spryker Systems GmbH copyright protected
 */

namespace Functional\Spryker\Zed\Payolution\Business;

use Spryker\Zed\Payolution\Business\Api\Adapter\AdapterInterface;
use Spryker\Zed\Payolution\Business\PayolutionBusinessFactory;
use Spryker\Zed\Payolution\Business\PayolutionFacade;
use Spryker\Zed\Payolution\PayolutionConfig;
use Spryker\Zed\Payolution\Persistence\PayolutionQueryContainer;

class PayolutionFacadeMockBuilder
{

    /**
     * @param AdapterInterface $adapter
     *
     * @return PayolutionFacade
     */
    public static function build(AdapterInterface $adapter, \PHPUnit_Framework_TestCase $testCase)
    {

        // Mock business factory to override return value of createExecutionAdapter to
        // place a mocked adapter that doesn't establish an actual connection.
        $businessFactoryMock = self::getBusinessFactoryMock($testCase);
        $businessFactoryMock->setConfig(new PayolutionConfig());
        $businessFactoryMock
            ->expects($testCase->any())
            ->method('createAdapter')
            ->will($testCase->returnValue($adapter));

        // Business factory always requires a valid query container. Since we're creating
        // functional/integration tests there's no need to mock the database layer.
        $queryContainer = new PayolutionQueryContainer();
        $businessFactoryMock->setQueryContainer($queryContainer);

        // Mock the facade to override getFactory() and have it return out
        // previously created mock.
        $facade = $testCase->getMock(
            'Spryker\Zed\Payolution\Business\PayolutionFacade',
            ['getFactory']
        );
        $facade->expects($testCase->any())
            ->method('getFactory')
            ->will($testCase->returnValue($businessFactoryMock));

        return $facade;
    }

    /**
     * @param \PHPUnit_Framework_TestCase $testCase
     *
     * @return \PHPUnit_Framework_MockObject_MockObject|PayolutionBusinessFactory
     */
    protected static function getBusinessFactoryMock(\PHPUnit_Framework_TestCase $testCase)
    {
        $businessFactoryMock = $testCase->getMock(
            'Spryker\Zed\Payolution\Business\PayolutionBusinessFactory',
            ['createAdapter']
        );

        return $businessFactoryMock;
    }

}