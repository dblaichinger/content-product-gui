<?php
/**
 * (c) Copyright Spryker Systems GmbH 2015
 */
namespace Spryker\Shared\Lumberjack\Model;

use Spryker\Shared\Lumberjack\Model\Collector\DataCollectorInterface;
use Spryker\Shared\Lumberjack\Model\Writer\WriterInterface;

interface EventJournalInterface
{

    /**
     * @param DataCollectorInterface $dataCollector
     */
    public function addOrReplaceDataCollector(DataCollectorInterface $dataCollector);

    /**
     * @param EventInterface $event
     */
    public function applyCollectors(EventInterface $event);

    /**
     * @param EventInterface $event
     */
    public function saveEvent(EventInterface $event);

    /**
     * @param WriterInterface $writer
     */
    public function addOrReplaceEventWriter(WriterInterface $writer);

}