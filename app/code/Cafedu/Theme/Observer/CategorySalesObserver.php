<?php
namespace Cafedu\Theme\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class CategorySalesObserver implements ObserverInterface
{
  private $registry;
  private $storeManager;

  /**
   * LayoutLoadBeforeObserver constructor.
   * @param CustomerSession $customerSession
   */
  public function __construct(
    \Magento\Framework\Registry $registry,
    \Magento\Store\Model\StoreManagerInterface $storeManager
  ) {
    $this->registry = $registry;
    $this->storeManager = $storeManager;
  }

  /**
   * @param Observer $observer
   * @return void
   */
  public function execute(Observer $observer)
  {
    $category = $this->registry->registry('current_category');
    if (!$category) {
      return $this;
    }

    $pageLayout = $category->getPageLayout();
    if ($pageLayout == "category-sales") {
      $layout = $observer->getEvent()->getData('layout');
      $layout->getUpdate()->addHandle('cafedu_category_sales_list');
    }
  }
}