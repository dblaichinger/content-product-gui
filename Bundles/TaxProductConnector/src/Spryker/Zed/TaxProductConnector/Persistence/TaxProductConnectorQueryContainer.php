<?php

/**
 * (c) Spryker Systems GmbH copyright protected
 */

namespace Spryker\Zed\TaxProductConnector\Persistence;

use Spryker\Zed\Kernel\Persistence\AbstractQueryContainer;
use Orm\Zed\Tax\Persistence\Map\SpyTaxSetTableMap;
use Orm\Zed\Product\Persistence\Map\SpyProductAbstractTableMap;
use Orm\Zed\Product\Persistence\SpyProductAbstractQuery;
use Propel\Runtime\ActiveQuery\Criteria;

/**
 * @method \Spryker\Zed\TaxProductConnector\Persistence\TaxProductConnectorPersistenceFactory getFactory()
 */
class TaxProductConnectorQueryContainer extends AbstractQueryContainer implements TaxProductConnectorQueryContainerInterface
{

    /**
     * @todo CD-427 Follow naming conventions and use method name starting with 'query*'
     *
     * @param int $idTaxRate
     *
     * @return \Orm\Zed\Product\Persistence\SpyProductAbstractQuery
     */
    public function getAbstractAbstractIdsForTaxRate($idTaxRate)
    {
        return $this->getFactory()->createProductAbstractQuery()
            ->select([
                SpyProductAbstractTableMap::COL_ID_PRODUCT_ABSTRACT,
            ])
            ->useSpyTaxSetQuery()
                ->useSpyTaxSetTaxQuery()
                    ->useSpyTaxRateQuery()
                    ->filterByIdTaxRate($idTaxRate)
                    ->endUse()
                ->endUse()
            ->endUse();
    }

    /**
     * @todo CD-427 Follow naming conventions and use method name starting with 'query*'
     *
     * @param int $idTaxSet
     *
     * @return \Orm\Zed\Product\Persistence\SpyProductAbstractQuery
     */
    public function getProductAbstractIdsForTaxSet($idTaxSet)
    {
        return $this->getFactory()->createProductAbstractQuery()
            ->addJoin(
                SpyProductAbstractTableMap::COL_FK_TAX_SET,
                SpyTaxSetTableMap::COL_ID_TAX_SET,
                Criteria::INNER_JOIN
            )
            ->filterByFkTaxSet($idTaxSet)
            ->select([
                SpyProductAbstractTableMap::COL_ID_PRODUCT_ABSTRACT,
            ]);
    }

}
