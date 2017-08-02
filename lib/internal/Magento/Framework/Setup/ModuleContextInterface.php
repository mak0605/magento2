<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\Framework\Setup;

/**
 * Context of a module being installed/updated: version, user data, etc.
 * @api
 * @since 2.0.0
 */
interface ModuleContextInterface
{
    /**
     * Gets current version of the module
     *
     * @return string
     * @since 2.0.0
     */
    public function getVersion();
}
