<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\Newsletter\Block\Adminhtml;

use Magento\Newsletter\Model\ResourceModel\Problem\Collection;

/**
 * Newsletter problem block template.
 *
 * @api
 * @author      Magento Core Team <core@magentocommerce.com>
 * @since 2.0.0
 */
class Problem extends \Magento\Backend\Block\Template
{
    /**
     * @var string
     * @since 2.0.0
     */
    protected $_template = 'problem/list.phtml';

    /**
     * @var \Magento\Newsletter\Model\ResourceModel\Problem\Collection
     * @since 2.0.0
     */
    protected $_problemCollection;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param Collection $problemCollection
     * @param array $data
     * @since 2.0.0
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        Collection $problemCollection,
        array $data = []
    ) {
        $this->_problemCollection = $problemCollection;
        parent::__construct($context, $data);
    }

    /**
     * @return void
     * @SuppressWarnings(PHPMD.UnusedLocalVariable)
     * @since 2.0.0
     */
    protected function _construct()
    {
        parent::_construct();

        $collection = $this->_problemCollection->addSubscriberInfo()->addQueueInfo();
    }

    /**
     * Prepare for the newsletter block layout
     *
     * @return $this
     * @since 2.0.0
     */
    protected function _prepareLayout()
    {
        $this->setChild(
            'deleteButton',
            $this->getLayout()->createBlock(
                \Magento\Backend\Block\Widget\Button::class,
                'del.button'
            )->setData(
                ['label' => __('Delete Selected Problems'), 'onclick' => 'problemController.deleteSelected();']
            )
        );

        $this->setChild(
            'unsubscribeButton',
            $this->getLayout()->createBlock(
                \Magento\Backend\Block\Widget\Button::class,
                'unsubscribe.button'
            )->setData(
                ['label' => __('Unsubscribe Selected'), 'onclick' => 'problemController.unsubscribe();']
            )
        );
        return parent::_prepareLayout();
    }

    /**
     * Get the html element for unsubscribe button
     *
     * @return $string
     * @since 2.0.0
     */
    public function getUnsubscribeButtonHtml()
    {
        return $this->getChildHtml('unsubscribeButton');
    }

    /**
     * Get the html element for delete button
     *
     * @return $string
     * @since 2.0.0
     */
    public function getDeleteButtonHtml()
    {
        return $this->getChildHtml('deleteButton');
    }

    /**
     * Return true if the size is greater than 0
     *
     * @return bool
     * @SuppressWarnings(PHPMD.BooleanGetMethodName)
     * @since 2.0.0
     */
    public function getShowButtons()
    {
        return $this->_problemCollection->getSize() > 0;
    }
}
