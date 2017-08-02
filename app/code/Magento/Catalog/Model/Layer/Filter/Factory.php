<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

/**
 * Layer filter factory
 */
namespace Magento\Catalog\Model\Layer\Filter;

/**
 * Class \Magento\Catalog\Model\Layer\Filter\Factory
 *
 * @since 2.0.0
 */
class Factory
{
    /**
     * Object Manager
     *
     * @var \Magento\Framework\ObjectManagerInterface
     * @since 2.0.0
     */
    protected $_objectManager;

    /**
     * Construct
     *
     * @param \Magento\Framework\ObjectManagerInterface $objectManager
     * @since 2.0.0
     */
    public function __construct(\Magento\Framework\ObjectManagerInterface $objectManager)
    {
        $this->_objectManager = $objectManager;
    }

    /**
     * Create layer filter
     *
     * @param string $className
     * @param array $data
     * @return \Magento\Catalog\Model\Layer\Filter\Attribute
     * @throws \Magento\Framework\Exception\LocalizedException
     * @since 2.0.0
     */
    public function create($className, array $data = [])
    {
        $filter = $this->_objectManager->create($className, $data);

        if (!$filter instanceof \Magento\Catalog\Model\Layer\Filter\AbstractFilter) {
            throw new \Magento\Framework\Exception\LocalizedException(
                __('%1 doesn\'t extends \Magento\Catalog\Model\Layer\Filter\AbstractFilter', $className)
            );
        }
        return $filter;
    }
}
