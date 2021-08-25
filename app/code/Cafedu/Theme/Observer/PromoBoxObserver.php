<?php
namespace Cafedu\Theme\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class PromoBoxObserver implements ObserverInterface
{
  private $_blockFactory;
  private $_storeManager;
  private $_actionContext;

  /**
   * LayoutLoadBeforeObserver constructor.
   * @param CustomerSession $customerSession
   */
  public function __construct(
    \Magento\Cms\Model\BlockFactory $blockFactory,
    \Magento\Framework\App\Action\Context $actionContext,
    \Magento\Store\Model\StoreManagerInterface $storeManager
  ) {
    $this->_blockFactory = $blockFactory;
    $this->_storeManager = $storeManager;
    $this->_actionContext = $actionContext;
  }

  /**
   * @param Observer $observer
   * @return void
   */
  public function execute(Observer $observer)
  {
    $request = $this->_actionContext->getRequest()->getFullActionName();

    if( $request != 'cms_index_index' && $request != 'checkout_index_index' ) {
      $layout = $observer->getEvent()->getData('layout');
      $storeId = $this->_storeManager->getStore()->getId();
      $block = $this->_blockFactory->create();
      $block->setStoreId($storeId)->load('home_promo_box');

      if($block->isActive()) {
        $layout->getUpdate()->addHandle('cafedu_promo_box');
      }
    }
  }
}