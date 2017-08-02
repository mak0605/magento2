<?php
/**
 * Google AdWords conversation value type source
 *
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\GoogleAdwords\Model\Config\Source;

/**
 * @api
 * @since 2.0.0
 */
class ValueType implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * Get conversation value type option
     *
     * @return array
     * @since 2.0.0
     */
    public function toOptionArray()
    {
        return [
            [
                'value' => \Magento\GoogleAdwords\Helper\Data::CONVERSION_VALUE_TYPE_DYNAMIC,
                'label' => __('Dynamic'),
            ],
            [
                'value' => \Magento\GoogleAdwords\Helper\Data::CONVERSION_VALUE_TYPE_CONSTANT,
                'label' => __('Constant')
            ]
        ];
    }
}
