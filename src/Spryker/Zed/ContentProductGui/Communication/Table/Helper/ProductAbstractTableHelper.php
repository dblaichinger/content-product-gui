<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\ContentProductGui\Communication\Table\Helper;

use Orm\Zed\Product\Persistence\SpyProductAbstract;
use Orm\Zed\Product\Persistence\SpyProductAbstractStore;
use Spryker\Zed\ContentProductGui\Dependency\Facade\ContentProductGuiToProductImageInterface;

class ProductAbstractTableHelper implements ProductAbstractTableHelperInterface
{
    /**
     * @var \Spryker\Zed\ContentProductGui\Dependency\Facade\ContentProductGuiToProductImageInterface
     */
    protected $productImageFacade;

    /**
     * @param \Spryker\Zed\ContentProductGui\Dependency\Facade\ContentProductGuiToProductImageInterface $productImageFacade
     */
    public function __construct(ContentProductGuiToProductImageInterface $productImageFacade)
    {
        $this->productImageFacade = $productImageFacade;
    }

    /**
     * @param \Orm\Zed\Product\Persistence\SpyProductAbstract $productAbstractEntity
     *
     * @return string
     */
    public function getProductPreview(SpyProductAbstract $productAbstractEntity)
    {
        return sprintf(
            '<img src="%s">',
            $this->getProductPreviewUrl($productAbstractEntity)
        );
    }

    /**
     * @param \Orm\Zed\Product\Persistence\SpyProductAbstract $productAbstractEntity
     *
     * @return string
     */
    public function getAbstractProductStatusLabel(SpyProductAbstract $productAbstractEntity)
    {
        $isActive = false;
        foreach ($productAbstractEntity->getSpyProducts() as $spyProductEntity) {
            if ($spyProductEntity->getIsActive()) {
                $isActive = true;
            }
        }

        return $this->getStatusLabel($isActive);
    }

    /**
     * @param \Orm\Zed\Product\Persistence\SpyProductAbstract $productAbstractEntity
     *
     * @return string
     */
    public function getDeleteButton(SpyProductAbstract $productAbstractEntity)
    {
        return sprintf(
            '<button type="button" data-id="%1$s" class="js-delete-product-abstract btn btn-xs btn-outline btn-danger"><i class="fa fa-trash"></i></button>',
            $productAbstractEntity->getIdProductAbstract()
        );
    }

    /**
     * @param \Orm\Zed\Product\Persistence\SpyProductAbstract $productAbstractEntity
     *
     * @return string
     */
    public function getAddButtonField(SpyProductAbstract $productAbstractEntity)
    {
        return sprintf(
            '<button type="button" data-id="%1$s" class="btn btn-sm btn-outline btn-create js-add-product-abstract"><i class="fa fa-plus"></i>Add to list</button>',
            $productAbstractEntity->getIdProductAbstract()
        );
    }

    /**
     * @param \Orm\Zed\Product\Persistence\SpyProductAbstractStore[] $spyProductAbstractStories
     *
     * @return string
     */
    public function getStoreNames(array $spyProductAbstractStories)
    {
        return implode(" ", array_map(
            function (SpyProductAbstractStore $spyProductAbstractStore) {
                return sprintf(
                    '<span class="label label-info">%s</span>',
                    $spyProductAbstractStore->getSpyStore()->getName()
                );
            },
            $spyProductAbstractStories
        ));
    }

    /**
     * @param \Orm\Zed\Product\Persistence\SpyProductAbstract $productAbstractEntity
     *
     * @return string|null
     */
    protected function getProductPreviewUrl(SpyProductAbstract $productAbstractEntity)
    {
        $productImageSetTransferCollection = $this->productImageFacade
            ->getProductImagesSetCollectionByProductAbstractId($productAbstractEntity->getIdProductAbstract());

        foreach ($productImageSetTransferCollection as $productImageSetTransfer) {
            foreach ($productImageSetTransfer->getProductImages() as $productImageTransfer) {
                $previewUrl = $productImageTransfer->getExternalUrlSmall();

                if ($previewUrl) {
                    return $previewUrl;
                }
            }
        }

        return null;
    }

    /**
     * @param bool $status
     *
     * @return string
     */
    protected function getStatusLabel($status)
    {
        if (!$status) {
            return '<span class="label label-danger">Inactive</span>';
        }

        return '<span class="label label-info">Active</span>';
    }
}