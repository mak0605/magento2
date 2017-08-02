<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\Customer\Controller\Adminhtml\Index;

/**
 * Class \Magento\Customer\Controller\Adminhtml\Index\ProductReviews
 *
 * @since 2.0.0
 */
class ProductReviews extends \Magento\Customer\Controller\Adminhtml\Index
{
    /**
     * Get customer's product reviews list
     *
     * @return \Magento\Framework\View\Result\Layout
     * @since 2.0.0
     */
    public function execute()
    {
        $customerId = $this->initCurrentCustomer();
        $resultLayout = $this->resultLayoutFactory->create();
        $block = $resultLayout->getLayout()->getBlock('admin.customer.reviews');
        $block->setCustomerId($customerId)->setUseAjax(true);
        return $resultLayout;
    }
}
