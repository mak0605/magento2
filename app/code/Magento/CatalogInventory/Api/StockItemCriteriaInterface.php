<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\CatalogInventory\Api;

/**
 * Interface StockItemCriteriaInterface
 * @api
 * @since 2.0.0
 */
interface StockItemCriteriaInterface extends \Magento\Framework\Api\CriteriaInterface
{
    /**
     * Add Criteria object
     *
     * @param \Magento\CatalogInventory\Api\StockItemCriteriaInterface $criteria
     * @return bool
     * @since 2.0.0
     */
    public function addCriteria(\Magento\CatalogInventory\Api\StockItemCriteriaInterface $criteria);

    /**
     * Join Stock Status to collection
     *
     * @param int $storeId
     * @return bool
     * @since 2.0.0
     */
    public function setStockStatus($storeId = null);

    /**
     * Add stock filter to collection
     *
     * @param \Magento\CatalogInventory\Api\Data\StockInterface $stock
     * @return bool
     * @since 2.0.0
     */
    public function setStockFilter($stock);

    /**
     * Add scope filter to collection
     *
     * @param int $scope
     * @return bool
     * @since 2.0.0
     */
    public function setScopeFilter($scope);

    /**
     * Add product filter to collection
     *
     * @param int|int[] $products
     * @return bool
     * @since 2.0.0
     */
    public function setProductsFilter($products);

    /**
     * Add Managed Stock products filter to collection
     *
     * @param bool $isStockManagedInConfig
     * @return bool
     * @since 2.0.0
     */
    public function setManagedFilter($isStockManagedInConfig);

    /**
     * Add filter by quantity to collection
     *
     * @param string $comparisonMethod
     * @param float $qty
     * @return bool
     * @since 2.0.0
     */
    public function setQtyFilter($comparisonMethod, $qty);
}
