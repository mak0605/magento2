<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\Checkout\Block\Checkout;

use Magento\Directory\Helper\Data as DirectoryHelper;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Store\Api\StoreResolverInterface;
use Magento\Framework\App\ObjectManager;

/**
 * Directory data processor.
 *
 * This class adds various country and region dictionaries to checkout page.
 * This data can be used by other UI components during checkout flow.
 * @since 2.2.0
 */
class DirectoryDataProcessor implements \Magento\Checkout\Block\Checkout\LayoutProcessorInterface
{
    /**
     * @var array
     * @since 2.2.0
     */
    private $countryOptions;

    /**
     * @var array
     * @since 2.2.0
     */
    private $regionOptions;

    /**
     * @var \Magento\Directory\Model\ResourceModel\Region\CollectionFactory
     * @since 2.2.0
     */
    private $regionCollectionFactory;

    /**
     * @var \Magento\Directory\Model\ResourceModel\Region\CollectionFactory
     * @since 2.2.0
     */
    private $countryCollectionFactory;

    /**
     * @var StoreManagerInterface
     * @since 2.2.0
     */
    private $storeManager;

    /**
     * @var DirectoryHelper
     * @since 2.2.0
     */
    private $directoryHelper;

    /**
     * @param \Magento\Directory\Model\ResourceModel\Country\CollectionFactory $countryCollection
     * @param \Magento\Directory\Model\ResourceModel\Region\CollectionFactory $regionCollection
     * @param StoreResolverInterface $storeResolver @deprecated
     * @param DirectoryHelper $directoryHelper
     * @param StoreManagerInterface $storeManager
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     * @since 2.2.0
     */
    public function __construct(
        \Magento\Directory\Model\ResourceModel\Country\CollectionFactory $countryCollection,
        \Magento\Directory\Model\ResourceModel\Region\CollectionFactory $regionCollection,
        StoreResolverInterface $storeResolver,
        DirectoryHelper $directoryHelper,
        StoreManagerInterface $storeManager = null
    ) {
        $this->countryCollectionFactory = $countryCollection;
        $this->regionCollectionFactory = $regionCollection;
        $this->directoryHelper = $directoryHelper;
        $this->storeManager = $storeManager ?: ObjectManager::getInstance()->get(StoreManagerInterface::class);
    }

    /**
     * Process js Layout of block
     *
     * @param array $jsLayout
     * @return array
     * @since 2.2.0
     */
    public function process($jsLayout)
    {
        if (!isset($jsLayout['components']['checkoutProvider']['dictionaries'])) {
            $jsLayout['components']['checkoutProvider']['dictionaries'] = [
                'country_id' => $this->getCountryOptions(),
                'region_id' => $this->getRegionOptions(),
            ];
        }

        return $jsLayout;
    }

    /**
     * Get country options list.
     *
     * @return array
     * @since 2.2.0
     */
    private function getCountryOptions()
    {
        if (!isset($this->countryOptions)) {
            $this->countryOptions = $this->countryCollectionFactory->create()->loadByStore(
                $this->storeManager->getStore()->getId()
            )->toOptionArray();
            $this->countryOptions = $this->orderCountryOptions($this->countryOptions);
        }

        return $this->countryOptions;
    }

    /**
     * Get region options list.
     *
     * @return array
     * @since 2.2.0
     */
    private function getRegionOptions()
    {
        if (!isset($this->regionOptions)) {
            $this->regionOptions = $this->regionCollectionFactory->create()->addAllowedCountriesFilter(
                $this->storeManager->getStore()->getId()
            )->toOptionArray();
        }

        return $this->regionOptions;
    }

    /**
     * Sort country options by top country codes.
     *
     * @param array $countryOptions
     * @return array
     * @since 2.2.0
     */
    private function orderCountryOptions(array $countryOptions)
    {
        $topCountryCodes = $this->directoryHelper->getTopCountryCodes();
        if (empty($topCountryCodes)) {
            return $countryOptions;
        }

        $headOptions = [];
        $tailOptions = [[
            'value' => 'delimiter',
            'label' => '──────────',
            'disabled' => true,
        ]];
        foreach ($countryOptions as $countryOption) {
            if (empty($countryOption['value']) || in_array($countryOption['value'], $topCountryCodes)) {
                array_push($headOptions, $countryOption);
            } else {
                array_push($tailOptions, $countryOption);
            }
        }
        return array_merge($headOptions, $tailOptions);
    }
}
