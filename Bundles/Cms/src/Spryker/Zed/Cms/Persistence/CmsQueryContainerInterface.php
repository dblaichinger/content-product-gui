<?php

/**
 * (c) Spryker Systems GmbH copyright protected.
 */

namespace Spryker\Zed\Cms\Persistence;

use Orm\Zed\Cms\Persistence\SpyCmsBlockQuery;
use Orm\Zed\Cms\Persistence\SpyCmsGlossaryKeyMappingQuery;
use Orm\Zed\Cms\Persistence\SpyCmsPageQuery;
use Orm\Zed\Cms\Persistence\SpyCmsTemplateQuery;

interface CmsQueryContainerInterface
{

    /**
     * @return SpyCmsTemplateQuery
     */
    public function queryTemplates();

    /**
     * @param string $path
     *
     * @return SpyCmsTemplateQuery
     */
    public function queryTemplateByPath($path);

    /**
     * @param int $id
     *
     * @return SpyCmsTemplateQuery
     */
    public function queryTemplateById($id);

    /**
     * @return SpyCmsPageQuery
     */
    public function queryPages();

    /**
     * @return SpyCmsBlockQuery
     */
    public function queryBlocks();

    /**
     * @param int $id
     *
     * @return SpyCmsPageQuery
     */
    public function queryPageById($id);

    /**
     * @param int $idPage
     * @param string $placeholder
     *
     * @return SpyCmsGlossaryKeyMappingQuery
     */
    public function queryGlossaryKeyMapping($idPage, $placeholder);

    /**
     * @param int $idMapping
     *
     * @return SpyCmsGlossaryKeyMappingQuery
     */
    public function queryGlossaryKeyMappingById($idMapping);

    /**
     * @return SpyCmsGlossaryKeyMappingQuery
     */
    public function queryGlossaryKeyMappings();

    /**
     * @param int $idCmsPage
     *
     * @return SpyCmsGlossaryKeyMappingQuery
     */
    public function queryGlossaryKeyMappingsByPageId($idCmsPage);

    /**
     * @param int $idCmsPage
     *
     * @return SpyCmsBlockQuery
     */
    public function queryBlockByIdPage($idCmsPage);

    /**
     * @param string $blockName
     * @param string $blockType
     * @param string $blockValue
     *
     * @return SpyCmsBlockQuery
     */
    public function queryBlockByNameAndTypeValue($blockName, $blockType, $blockValue);

    /**
     * @param int $idCategoryNode
     *
     * @return SpyCmsBlockQuery
     */
    public function queryBlockByIdCategoryNode($idCategoryNode);

}