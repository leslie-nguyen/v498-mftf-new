<?php
  namespace Cafedu\Theme\Controller\Index;

  use Magento\Framework\App\Action\Context;
  use Magento\Framework\Controller\ResultFactory;

  class Index extends \Magento\Framework\App\Action\Action
  {
    protected $fileSystem;
    protected $_storeManager;
    protected $_listProduct;
    protected $_productFactory;

    public function __construct(
      Context $context,
      \Magento\Store\Model\StoreManagerInterface $storeManager,
      \Magento\Framework\Filesystem $fileSystem,
      \Magento\Catalog\Block\Product\ListProduct $listProduct,
      \Magento\Catalog\Model\ProductFactory $productFactory
    )
    {
      $this->fileSystem = $fileSystem;
      $this->_productFactory = $productFactory;
      $this->_storeManager = $storeManager;
      $this->_listProduct = $listProduct;
      parent::__construct($context);
    }

    public function execute()
    {
      $post = $this->getRequest()->getPostValue();
      $_data = json_decode($post['cafedu_random']);
      if( sizeof($_data) > 0 ) {
		$largeImage = array();
		foreach($_data as $child){ 
			$productData = $this->_productFactory->create()->load( $child );
			$largeImage[] = $productData->getBaseLarge();		
		}
		$ImagewithValue = array_diff($largeImage, array('no_selection'));
		$ImagewithValueCount = count($ImagewithValue);
		if($ImagewithValueCount > 1){
			$randomValue = array_rand($ImagewithValue, 1);
			$randomImageValue = array_rand($ImagewithValue);
			$productbaseLargeImage = $ImagewithValue[$randomImageValue];
		}else{
			foreach($ImagewithValue as $imageval){
				
				$imageval;
			}
		$productbaseLargeImage = $imageval;
		}
		$response = $this->resultFactory->create(ResultFactory::TYPE_JSON);
        $response->setData($productbaseLargeImage);
        return $response;
		//exit();
		  
		
        /*$_randomId = array_rand($_data, 1);

        $pos = $this->_listProduct->getPositioned();
        $random_product = $this->_productFactory->create()->load( $_data[$_randomId] );

        if( $random_product->getBaseLarge() == 'no_selection') {
          return false;
        }
      
        $productImage = $this->_listProduct->getImage($random_product, 'category_page_random_pickup');
        if ($pos != null) {
          $position = ' style="left:' . $productImage->getWidth() . 'px;' . 'top:' . $productImage->getHeight() . 'px;"';
        }

        $response_array = array(
          'url' => $random_product->getProductUrl(),
          'img' => $productImage->toHtml()
        );

        $response = $this->resultFactory->create(ResultFactory::TYPE_JSON);
        $response->setData($response_array);
        return $response;*/
      }
    }
  }