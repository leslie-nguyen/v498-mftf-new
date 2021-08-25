<?php

namespace Cafedu\Theme\ViewModel;

use Magento\Framework\View\Element\Block\ArgumentInterface;

class Breadcrumbs implements ArgumentInterface
{
    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $storeManager;

    /**
     * @var \Cafedu\Catalog\ViewModel\Breadcrumbs
     */
    protected $_breadcrumbs;

    /**
     * Catalog constructor.
     * @param \Cafedu\Catalog\ViewModel\Breadcrumbs $breadcrumbs
     */
    public function __construct(
        \Cafedu\Catalog\ViewModel\Breadcrumbs $breadcrumbs
    ) {
        $this->_breadcrumbs = $breadcrumbs;
    }


    /**
     * @return string
     */
    public function getJsonData()
    {
        return $this->_breadcrumbs->getJsonData();
    }
}
