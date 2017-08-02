<?php
/**
 * Collection of various useful functions
 *
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\Framework;

/**
 * Class \Magento\Framework\Util
 *
 * @since 2.0.0
 */
class Util
{
    /**
     * Return PHP version without optional suffix
     * Scheme: major.minor.release
     * @return string
     * @since 2.0.0
     */
    public function getTrimmedPhpVersion()
    {
        return implode('.', [PHP_MAJOR_VERSION, PHP_MINOR_VERSION, PHP_RELEASE_VERSION]);
    }
}
