<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\SalesRule\Observer;

use Magento\Framework\Event\Observer as EventObserver;
use Magento\Framework\Event\ObserverInterface;

/**
 * Class \Magento\SalesRule\Observer\CatalogAttributeDeleteAfterObserver
 *
 * @since 2.0.0
 */
class CatalogAttributeDeleteAfterObserver implements ObserverInterface
{
    /**
     * @var \Magento\SalesRule\Observer\CheckSalesRulesAvailability
     * @since 2.0.0
     */
    protected $checkSalesRulesAvailability;

    /**
     * @param CheckSalesRulesAvailability $checkSalesRulesAvailability
     * @since 2.0.0
     */
    public function __construct(
        \Magento\SalesRule\Observer\CheckSalesRulesAvailability $checkSalesRulesAvailability
    ) {
        $this->checkSalesRulesAvailability = $checkSalesRulesAvailability;
    }

    /**
     * After delete attribute check rules that contains deleted attribute
     * If rules was found they will seted to inactive and added notice to admin session
     *
     * @param EventObserver $observer
     * @return $this
     * @since 2.0.0
     */
    public function execute(EventObserver $observer)
    {
        $attribute = $observer->getEvent()->getAttribute();
        if ($attribute->getIsUsedForPromoRules()) {
            $this->checkSalesRulesAvailability->checkSalesRulesAvailability($attribute->getAttributeCode());
        }

        return $this;
    }
}
