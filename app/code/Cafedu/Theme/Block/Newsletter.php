<?php

namespace Cafedu\Theme\Block;

class Newsletter extends \Magento\Newsletter\Block\Subscribe
{
    /**
     * @var \Magento\Directory\Model\ResourceModel\Country\CollectionFactory
     */
    protected $countryCollectionFactory;

    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $storeManagerInterface;

    /**
     * @var \Magento\Directory\Helper\Data
     */
    protected $directoryHelper;

    /**
     * @var array
     */
    protected $countryOptions;

    protected $codeList = [
        'FR' => ['fr_fr', 'en_fr'],
        'GB' => ['en_uk', 'fr_uk'],
        'DE' => ['de_de', 'en_de'],
        'US' => ['en_us', 'fr_us'],
        'CA' => ['en_ca', 'fr_ca'],
        'AU' => ['en_au', 'fr_au'],
        'JP' => ['jp_ja', 'en_ja'],
    ];

    /**
     * Newsletter constructor.
     * @param \Magento\Directory\Model\ResourceModel\Country\CollectionFactory $countryCollectionFactory
     * @param \Magento\Store\Model\StoreManagerInterface $storeManagerInterface
     * @param \Magento\Directory\Helper\Data $directoryHelper
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param array $data
     */
    public function __construct(
        \Magento\Directory\Model\ResourceModel\Country\CollectionFactory $countryCollectionFactory,
        \Magento\Store\Model\StoreManagerInterface $storeManagerInterface,
        \Magento\Directory\Helper\Data $directoryHelper,
        \Magento\Framework\View\Element\Template\Context $context,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->countryCollectionFactory = $countryCollectionFactory;
        $this->storeManagerInterface = $storeManagerInterface;
        $this->directoryHelper = $directoryHelper;
    }

    /**
     * Get List of country sort by Alphabetically
     * @return array
     */
    public function getCountryCollection()
    {
        if (!isset($this->countryOptions)) {
            $this->countryOptions = $this->countryCollectionFactory->create()->toOptionArray();
            $this->countryOptions = $this->orderCountryOptions($this->countryOptions);
        }

        return $this->countryOptions;
    }

    /**
     * Get current Store code
     * @return mixed
     */
    public function getStoreCode()
    {
        return $this->storeManagerInterface->getStore()->getCode();
    }

    /**
     * Sort country options by top country codes.
     *
     * @param array $countryOptions
     * @return array
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
            'label' => '---------------------',
            'disabled' => true,
        ]];
        foreach ($countryOptions as $countryOption) {
            if (empty($countryOption['value']) || in_array($countryOption['value'], $topCountryCodes)) {
                $headOptions[] = $countryOption;
            } else {
                $tailOptions[] = $countryOption;
            }
        }
        return array_merge($headOptions, $tailOptions);
    }
}
