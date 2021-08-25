<?php
namespace Cafedu\Theme\Controller\Adminhtml\Product;

use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Process extends \Magento\Framework\App\Action\Action
{
  protected $_scopeConfig;
  protected $_styleWithBlock;
  protected $_resultPageFactory;

  public function __construct(
    Context $context,
    PageFactory $resultPageFactory,
    \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
    \Cafedu\Theme\Block\Adminhtml\Catalog\Product\Tabs\StyleWith $styleWithBlock
  )
  {
    $this->_scopeConfig = $scopeConfig;
    $this->_styleWithBlock = $styleWithBlock;
    $this->_resultPageFactory = $resultPageFactory;
    parent::__construct($context);
  }

  public function execute()
  {
    $_param = $this->getRequest()->getParams();

    if( isset($_param['style_with']) ) {
      if( !empty($_param['style_with']) ) {
        $layout = '';
        $data = json_decode($_param['style_with'], true);
        $items = $data['style-with'];
        
        for($i=0;$i<count($items);$i++) {
          $layout .= $this->_styleWithBlock->prepareFields($i, $items[$i]);
        }

        echo $layout;
      }
    } elseif( isset($_param['action']) && ($_param['action'] == 'add') ) {
      echo $this->_styleWithBlock->prepareFields($_param['item_counter']);
    } elseif( isset($_param['action']) && ($_param['action'] == 'process') ) {
      echo json_encode($_param);
    }
  }
}
