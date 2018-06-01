<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Service\FileManager;

interface FileManagerServiceInterface
{
    /**
     * Provides public url to the file
     *
     * @api
     *
     * @param string $fileName
     *
     * @return string
     */
    public function getPublicUrl(string $fileName);

    /**
     * Provides ZED url to the file
     *
     * @api
     *
     * @param string $fileName
     *
     * @return string
     */
    public function getZedUrl(string $fileName);

    /**
     * Reads the file
     *
     * @api
     *
     * @param string $fileName
     *
     * @throws \Spryker\Service\FileSystem\Dependency\Exception\FileSystemReadException
     * @throws \Spryker\Service\Kernel\Exception\Container\ContainerKeyNotFoundException
     *
     * @return \Generated\Shared\Transfer\FileManagerDataTransfer
     */
    public function read(string $fileName);

    /**
     * Retrieves a read-stream for the file
     *
     * @api
     *
     * @param string $fileName
     *
     * @throws \Spryker\Service\FileSystem\Dependency\Exception\FileSystemStreamException
     *
     * @return mixed
     */
    public function readStream(string $fileName);
}
