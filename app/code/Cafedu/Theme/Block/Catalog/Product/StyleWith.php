<?php
  namespace Cafedu\Theme\Block\Catalog\Product;

  class StyleWith extends \Magento\Catalog\Block\Product\AbstractProduct
  {
    protected $_productFactory;
    protected $_categoryHelper;
    protected $_categoryFactory;

    public function __construct(
        \Magento\Catalog\Block\Product\Context $context, 
        \Magento\Catalog\Model\ProductFactory $productFactory,
        \Magento\Catalog\Helper\Category $categoryHelper,
        \Magento\Catalog\Model\CategoryFactory $categoryFactory
    ) {
        $this->_productFactory = $productFactory;
        $this->_categoryHelper = $categoryHelper;
        $this->_categoryFactory = $categoryFactory;
        parent::__construct($context);
    }

    public function isStyleWith()
    {
      $_product = $this->getProduct();

      return ( $_product->getStyleWithSection() && $_product->getStyleWith() ) ? true : false;
    }

    public function getStyleWithData()
    {
      $_product = $this->getProduct();

      return $_product->getStyleWith();
    }

    public function getImageUrl($image)
    {
      return $this->_storeManager->getStore()->getBaseUrl() . 'pub/media/cafedu/style-with/' . $image;
    }

    public function getProductDetails($id)
    {
      return $this->_productFactory->create()->load($id);
    }

    public function getProductImageUrl($image)
    {
      return $this->_storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA) . 'catalog/product' . $image;
    }

    public function getCatUrl($id)
    {
      $_category = $this->_categoryFactory->create()->load($id);

      return $this->_categoryHelper->getCategoryUrl($_category);
    }
	
	public function prepareWishlist($product)
    {
      if( $this->_wishlistHelper->getCustomer() ) {	  
        $html = '<a href="#" data-post="' . $this->escapeHtml($this->_wishlistHelper->getAddParams($product)) . '" data-action="add-to-wishlist">' . __('Save') . '</a>';
      } else {
        $_wishlist = json_decode($this->_wishlistHelper->getAddParams($product));
        $_action  = $_wishlist->action;
        $_product = $_wishlist->data->product;
        $_uenc    = $_wishlist->data->uenc;

        $html = '<a href="#" class="trigger-auth-wishlist-popup" data-wishlist="' . $_product . '" data-uenc="' . $_uenc . '" data-wishlist-action="' . $_action . '">' . __('Save') . '</a>';
      }

      return $html;
    }
  
    public function getSlider($data)
    {
      $html = '';

      $html .= '<div class="item">';

      /** image **/
      if(isset($data['image']) && !empty($data['image'])) {
        $html .= '<div class="left-img">';
        $html .= '<img src="'.$this->getImageUrl($data['image']).'" alt="CDC - Style With">';
        $html .= '</div>';
      }

      $html .= '<div class="right-shop-col">';

      $html .= '<ul>';
      for($j=1;$j<=4;$j++) {
        if(isset($data['prod-'.$j]) && !empty($data['prod-'.$j])) {
          $prod = $this->getProductDetails( $data['prod-'.$j] );
          $_categories = $prod->getCategoryIds();
		  //echo $prod->getUrlInStore();
		  //echo "@@@";
		  $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
		  $resource = $objectManager->get('Magento\Framework\App\ResourceConnection');
		  $connection = $resource->getConnection();
		  $tableName = $resource->getTableName('cdc_url_rewrite');
		  
		  //Select Data from table
		  $sql = "Select * FROM " . $tableName ." where `entity_id`= ".$prod->getId()." AND `store_id` = 1";
		  $result = $connection->fetchAll($sql);
		  $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
		  $storeManager = $objectManager->get('\Magento\Store\Model\StoreManagerInterface');
          $baseUrl = $storeManager->getStore()->getBaseUrl();
		  $urlProduct = $baseUrl.''.$result[0]['request_path'];
		  
          $html .= '<li>';
          $html .= '<div class="product-img">';
          $html .= '<a href="'.$urlProduct.'">';
          $html .= '<img src="'.$this->getProductImageUrl( $prod->getData('image') ).'" alt="'.$prod->getName().'">';
          $html .= '</a>';
          $html .= '</div>';
          $html .= '<div class="product-info">';
          $html .= '<h3><a href="'.$urlProduct.'">'.$prod->getName().'</a></h3>';
          $html .= '<h4>'. $prod->getTitle2ndLine() .'</h4>';
          $html .= '<div class="links">';

          //if( $_categories[0] ) {
            //$html .= '<p><a href="'.$this->getCatUrl( $_categories[0] ).'">'.__('Discover').'</a></p>';
			$html .= '<p><a href="'.$urlProduct.'">'.__('Discover').'</a></p>';
          //}

          $html .= '<p>' . $this->prepareWishlist($prod) . '</p>';
          $html .= '</div>';
          $html .= '</div>';
          $html .= '</li>';
        }   
      }
      $html .= '</ul>';

      /** url **/
      if(isset($data['url']) && !empty($data['url'])) {
        $html .= '<a class="button" href="'.$data['url'].'">'.__('view all looks').'</a>';
      }

      $html .= '</div>';
      $html .= '</div>';

      return $html;
    }
  }