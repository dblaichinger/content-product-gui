<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Unit\Spryker\Client\Search\Plugin\Elasticsearch\QueryExpander;

use Generated\Shared\Search\PageIndexMap;
use Generated\Shared\Transfer\FacetConfigTransfer;
use Spryker\Client\Search\Plugin\Config\FacetConfigBuilder;
use Spryker\Client\Search\Plugin\Config\PaginationConfigBuilder;
use Spryker\Client\Search\Plugin\Config\SearchConfig;
use Spryker\Client\Search\Plugin\Config\SortConfigBuilder;

abstract class AbstractResultFormatterPluginTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @return \Spryker\Client\Search\Dependency\Plugin\SearchConfigInterface
     */
    protected function createSearchConfigMock()
    {
        $searchConfigMock = $this->getMockBuilder(SearchConfig::class)
            ->disableOriginalConstructor()
            ->setMethods(['getFacetConfigBuilder', 'getPaginationConfigBuilder', 'getSortConfigBuilder'])
            ->getMock();

        $searchConfigMock
            ->method('getFacetConfigBuilder')
            ->willReturn(new FacetConfigBuilder());

        $searchConfigMock
            ->method('getPaginationConfigBuilder')
            ->willReturn(new PaginationConfigBuilder());

        $searchConfigMock
            ->method('getSortConfigBuilder')
            ->willReturn(new SortConfigBuilder());

        return $searchConfigMock;
    }

    /**
     * @return \Spryker\Client\Search\Dependency\Plugin\SearchConfigInterface
     */
    protected function createStringSearchConfig()
    {
        $searchConfig = $this->createSearchConfigMock();
        $searchConfig->getFacetConfigBuilder()
            ->addFacet(
                (new FacetConfigTransfer())
                    ->setName('foo')
                    ->setParameterName('foo')
                    ->setFieldName(PageIndexMap::STRING_FACET)
                    ->setType(FacetConfigBuilder::TYPE_ENUMERATION)
            );

        return $searchConfig;
    }

    /**
     * @return \Spryker\Client\Search\Dependency\Plugin\SearchConfigInterface
     */
    protected function createMultiStringSearchConfig()
    {
        $searchConfig = $this->createSearchConfigMock();
        $searchConfig->getFacetConfigBuilder()
            ->addFacet(
                (new FacetConfigTransfer())
                    ->setName('foo')
                    ->setParameterName('foo')
                    ->setFieldName(PageIndexMap::STRING_FACET)
                    ->setType(FacetConfigBuilder::TYPE_ENUMERATION)
            )
            ->addFacet(
                (new FacetConfigTransfer())
                    ->setName('bar')
                    ->setParameterName('bar')
                    ->setFieldName(PageIndexMap::STRING_FACET)
                    ->setType(FacetConfigBuilder::TYPE_ENUMERATION)
            )
            ->addFacet(
                (new FacetConfigTransfer())
                    ->setName('baz')
                    ->setParameterName('baz')
                    ->setFieldName(PageIndexMap::STRING_FACET)
                    ->setType(FacetConfigBuilder::TYPE_BOOL)
            );

        return $searchConfig;
    }

    /**
     * @return \Spryker\Client\Search\Dependency\Plugin\SearchConfigInterface
     */
    protected function createIntegerSearchConfig()
    {
        $searchConfig = $this->createSearchConfigMock();
        $searchConfig->getFacetConfigBuilder()
            ->addFacet(
                (new FacetConfigTransfer())
                    ->setName('foo')
                    ->setParameterName('foo')
                    ->setFieldName(PageIndexMap::INTEGER_FACET)
                    ->setType(FacetConfigBuilder::TYPE_ENUMERATION)
            );

        return $searchConfig;
    }

    /**
     * @return \Spryker\Client\Search\Dependency\Plugin\SearchConfigInterface
     */
    protected function createMultiIntegerSearchConfig()
    {
        $searchConfig = $this->createSearchConfigMock();
        $searchConfig->getFacetConfigBuilder()
            ->addFacet(
                (new FacetConfigTransfer())
                    ->setName('foo')
                    ->setParameterName('foo')
                    ->setFieldName(PageIndexMap::INTEGER_FACET)
                    ->setType(FacetConfigBuilder::TYPE_ENUMERATION)
            )
            ->addFacet(
                (new FacetConfigTransfer())
                    ->setName('bar')
                    ->setParameterName('bar')
                    ->setFieldName(PageIndexMap::INTEGER_FACET)
                    ->setType(FacetConfigBuilder::TYPE_ENUMERATION)
            )
            ->addFacet(
                (new FacetConfigTransfer())
                    ->setName('baz')
                    ->setParameterName('baz')
                    ->setFieldName(PageIndexMap::INTEGER_FACET)
                    ->setType(FacetConfigBuilder::TYPE_RANGE)
            );

        return $searchConfig;
    }

    /**
     * @return \Spryker\Client\Search\Dependency\Plugin\SearchConfigInterface
     */
    protected function createCategorySearchConfig()
    {
        $searchConfig = $this->createSearchConfigMock();
        $searchConfig->getFacetConfigBuilder()
            ->addFacet(
                (new FacetConfigTransfer())
                    ->setName('foo')
                    ->setParameterName('foo')
                    ->setFieldName(PageIndexMap::CATEGORY_ALL_PARENTS)
                    ->setType(FacetConfigBuilder::TYPE_CATEGORY)
            );

        return $searchConfig;
    }

}
