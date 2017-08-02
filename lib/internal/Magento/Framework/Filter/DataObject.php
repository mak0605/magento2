<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\Framework\Filter;

/**
 * Class \Magento\Framework\Filter\DataObject
 *
 * @since 2.0.0
 */
class DataObject extends \Zend_Filter
{
    /**
     * @var array
     * @since 2.0.0
     */
    protected $_columnFilters = [];

    /**
     * @var \Magento\Framework\Data\Collection\EntityFactoryInterface
     * @since 2.0.0
     */
    protected $_entityFactory;

    /**
     * @param \Magento\Framework\Data\Collection\EntityFactoryInterface $entityFactory
     * @since 2.0.0
     */
    public function __construct(\Magento\Framework\Data\Collection\EntityFactoryInterface $entityFactory)
    {
        $this->_entityFactory = $entityFactory;
    }

    /**
     * @param \Zend_Filter_Interface $filter
     * @param string $column
     * @return null|\Zend_Filter
     * @since 2.0.0
     */
    public function addFilter(\Zend_Filter_Interface $filter, $column = '')
    {
        if ('' === $column) {
            parent::addFilter($filter);
        } else {
            if (!isset($this->_columnFilters[$column])) {
                $this->_columnFilters[$column] = new \Zend_Filter();
            }
            $this->_columnFilters[$column]->addFilter($filter);
        }
    }

    /**
     * @param \Magento\Framework\DataObject $object
     * @return \Magento\Framework\DataObject
     * @throws \Exception
     * @since 2.0.0
     */
    public function filter($object)
    {
        if (!$object instanceof \Magento\Framework\DataObject) {
            throw new \InvalidArgumentException('Expecting an instance of \Magento\Framework\DataObject');
        }
        $class = get_class($object);
        $out = $this->_entityFactory->create($class);
        foreach ($object->getData() as $column => $value) {
            $value = parent::filter($value);
            if (isset($this->_columnFilters[$column])) {
                $value = $this->_columnFilters[$column]->filter($value);
            }
            $out->setData($column, $value);
        }
        return $out;
    }
}
