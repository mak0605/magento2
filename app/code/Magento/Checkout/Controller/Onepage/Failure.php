<?php
/**
 *
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\Checkout\Controller\Onepage;

/**
 * Class \Magento\Checkout\Controller\Onepage\Failure
 *
 * @since 2.0.0
 */
class Failure extends \Magento\Checkout\Controller\Onepage
{
    /**
     * @return \Magento\Framework\View\Result\Page|\Magento\Framework\Controller\Result\Redirect
     * @since 2.0.0
     */
    public function execute()
    {
        $lastQuoteId = $this->getOnepage()->getCheckout()->getLastQuoteId();
        $lastOrderId = $this->getOnepage()->getCheckout()->getLastOrderId();

        if (!$lastQuoteId || !$lastOrderId) {
            return $this->resultRedirectFactory->create()->setPath('checkout/cart');
        }

        return $this->resultPageFactory->create();
    }
}
