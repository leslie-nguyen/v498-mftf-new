<?php
namespace Cafedu\Theme\Block;

use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\Template;

class Home extends Template
{
    protected $_categoryHelper;
    protected $categoryFlatConfig;
    protected $topMenu;
    protected $_categoryCollection;
    protected $_homePage;
    protected $_config;

    public function __construct(
        Template\Context $context,
        \Magento\Catalog\Helper\Category $categoryHelper,
        \Magento\Catalog\Model\Indexer\Category\Flat\State $categoryFlatState,
        \Magento\Theme\Block\Html\Topmenu $topMenu,
        \Magento\Catalog\Model\ResourceModel\Category\CollectionFactory $categoryCollection,
        \FishPig\WordPress\Model\Homepage $homePage,
        \FishPig\WordPress\Model\OptionManager $config
    ) {
        $this->_categoryHelper = $categoryHelper;
        $this->_homePage = $homePage;
        $this->_config = $config;
        $this->_categoryCollection = $categoryCollection;
        parent::__construct($context);
    }

    /**
     * Return categories helper
     */
    public function getCategoryHelper()
    {
        return $this->_categoryHelper;
    }

    public function getCategoryBanner($category, $mobile = false)
    {
        $banner = $category->getBanner();
        if ($mobile && $category->getMobileBanner()) {
            $banner = $category->getMobileBanner();
        }
        $bannerUrl = $this->_storeManager->getStore()->getBaseUrl(UrlInterface::URL_TYPE_MEDIA ) . 'catalog/category/' . $banner;

        return $bannerUrl;
    }

    public function getCategoryCollection()
    {
        $collection = $this->_categoryCollection->create()
            ->addAttributeToSelect('*')
            ->addAttributeToFilter('in_homepage', '1')
            ->addAttributeToFilter('include_in_menu', '1')
            ->setPageSize(4);

        return $collection;
    }

    public function getStoreUrl()
    {
        $storeUrl = $this->_storeManager->getStore()->getBaseUrl();

        return $storeUrl;
    }

    public function getCafeduImage($data)
    {
        $bannerUrl = $this->_storeManager->getStore()->getBaseUrl(UrlInterface::URL_TYPE_MEDIA) . 'catalog/category/' . $data->getImage2();

        return $bannerUrl;
    }

    public function getAjaxAction()
    {
        return $this->getUrl('cafedu_theme/index/index', ['_secure' => true]);
    }

    public function getBlogPanel()
    {
        $html = '';

        $html .= '<li>
        <a class="main-block-link" href="'.$this->_homePage->getUrl().'">'.$this->_config->getOption('nav_label').'</a>
        <div 
          class="banner-bg hover-visible" 
          data-type="background" 
          data-src="'.$this->_config->getOption('home_banner').'" 
          style="background-image: url('.$this->_config->getOption('home_banner').');"></div>
      </li>';

        return $html;
    }
}
