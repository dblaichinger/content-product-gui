<?php

/**
 * (c) Spryker Systems GmbH copyright protected
 */

namespace Spryker\Zed\Acl\Dependency\Facade;

use Generated\Shared\Transfer\UserTransfer;

interface AclToUserInterface
{

    /**
     * @param UserTransfer $user
     *
     * @return bool
     */
    public function isSystemUser(UserTransfer $user);


    /**
     * @param string $username
     *
     * @return UserTransfer
     */
    public function getUserByUsername($username);


    /**
     * @return bool
     */
    public function hasCurrentUser();

    /**
     * @return UserTransfer
     */
    public function getCurrentUser();

}