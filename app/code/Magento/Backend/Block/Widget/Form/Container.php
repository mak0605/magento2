<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\Backend\Block\Widget\Form;

/**
 * Backend form container block
 *
 * @api
 * @deprecated 2.2.0 in favour of UI component implementation
 * @SuppressWarnings(PHPMD.NumberOfChildren)
 * @since 2.0.0
 */
class Container extends \Magento\Backend\Block\Widget\Container
{
    /**
     * @var string
     * @since 2.0.0
     */
    protected $_objectId = 'id';

    /**
     * @var string[]
     * @since 2.0.0
     */
    protected $_formScripts = [];

    /**
     * @var string[]
     * @since 2.0.0
     */
    protected $_formInitScripts = [];

    /**
     * @var string
     * @since 2.0.0
     */
    protected $_mode = 'edit';

    /**
     * @var string
     * @since 2.0.0
     */
    protected $_blockGroup = 'Magento_Backend';
    
    /**
     *  @var string
     */
    const PARAM_BLOCK_GROUP = 'block_group';

    /**
     *  @var string
     */
    const PARAM_MODE = 'mode';

    /**
     * @var string
     * @since 2.0.0
     */
    protected $_template = 'Magento_Backend::widget/form/container.phtml';

    /**
     * @return void
     * @since 2.0.0
     */
    protected function _construct()
    {
        parent::_construct();
        if ($this->hasData(self::PARAM_BLOCK_GROUP)) {
            $this->_blockGroup = $this->_getData(self::PARAM_BLOCK_GROUP);
        }
        if ($this->hasData(self::PARAM_MODE)) {
            $this->_mode = $this->_getData(self::PARAM_MODE);
        }

        $this->addButton(
            'back',
            [
                'label' => __('Back'),
                'onclick' => 'setLocation(\'' . $this->getBackUrl() . '\')',
                'class' => 'back'
            ],
            -1
        );
        $this->addButton(
            'reset',
            ['label' => __('Reset'), 'onclick' => 'setLocation(window.location.href)', 'class' => 'reset'],
            -1
        );

        $objId = $this->getRequest()->getParam($this->_objectId);

        if (!empty($objId)) {
            $this->addButton(
                'delete',
                [
                    'label' => __('Delete'),
                    'class' => 'delete',
                    'onclick' => 'deleteConfirm(\'' . __(
                        'Are you sure you want to do this?'
                    ) . '\', \'' . $this->getDeleteUrl() . '\')'
                ]
            );
        }

        $this->addButton(
            'save',
            [
                'label' => __('Save'),
                'class' => 'save primary',
                'data_attribute' => [
                    'mage-init' => ['button' => ['event' => 'save', 'target' => '#edit_form']],
                ]
            ],
            1
        );
    }

    /**
     * Create form block
     *
     * @return $this
     * @since 2.0.0
     */
    protected function _prepareLayout()
    {
        if ($this->_blockGroup && $this->_controller && $this->_mode && !$this->_layout->getChildName(
            $this->_nameInLayout,
            'form'
        )
        ) {
            $this->addChild('form', $this->_buildFormClassName());
        }
        return parent::_prepareLayout();
    }

    /**
     * Build child form class name
     *
     * @return string
     * @since 2.0.0
     */
    protected function _buildFormClassName()
    {
        return $this->nameBuilder->buildClassName(
            [$this->_blockGroup, 'Block', $this->_controller, $this->_mode, 'Form']
        );
    }

    /**
     * Get URL for back (reset) button
     *
     * @return string
     * @since 2.0.0
     */
    public function getBackUrl()
    {
        return $this->getUrl('*/*/');
    }

    /**
     * @return string
     * @since 2.0.0
     */
    public function getDeleteUrl()
    {
        return $this->getUrl('*/*/delete', [$this->_objectId => $this->getRequest()->getParam($this->_objectId)]);
    }

    /**
     * Get form save URL
     *
     * @see getFormActionUrl()
     * @return string
     * @since 2.0.0
     */
    public function getSaveUrl()
    {
        return $this->getFormActionUrl();
    }

    /**
     * Get form action URL
     *
     * @return string
     * @since 2.0.0
     */
    public function getFormActionUrl()
    {
        if ($this->hasFormActionUrl()) {
            return $this->getData('form_action_url');
        }
        return $this->getUrl('*/*/save');
    }

    /**
     * @return string
     * @since 2.0.0
     */
    public function getFormHtml()
    {
        $this->getChildBlock('form')->setData('action', $this->getSaveUrl());
        return $this->getChildHtml('form');
    }

    /**
     * @return string
     * @since 2.0.0
     */
    public function getFormInitScripts()
    {
        if (!empty($this->_formInitScripts) && is_array($this->_formInitScripts)) {
            return '<script>' . implode("\n", $this->_formInitScripts) . '</script>';
        }
        return '';
    }

    /**
     * @return string
     * @since 2.0.0
     */
    public function getFormScripts()
    {
        if (!empty($this->_formScripts) && is_array($this->_formScripts)) {
            return '<script>' . implode("\n", $this->_formScripts) . '</script>';
        }
        return '';
    }

    /**
     * @return string
     * @since 2.0.0
     */
    public function getHeaderWidth()
    {
        return '';
    }

    /**
     * @return string
     * @since 2.0.0
     */
    public function getHeaderCssClass()
    {
        return 'icon-head head-' . strtr($this->_controller, '_', '-');
    }

    /**
     * @return string
     * @since 2.0.0
     */
    public function getHeaderHtml()
    {
        return '<h3 class="' . $this->getHeaderCssClass() . '">' . $this->getHeaderText() . '</h3>';
    }

    /**
     * Set data object and pass it to form
     *
     * @param \Magento\Framework\DataObject $object
     * @return $this
     * @since 2.0.0
     */
    public function setDataObject($object)
    {
        $this->getChildBlock('form')->setDataObject($object);
        return $this->setData('data_object', $object);
    }
}
