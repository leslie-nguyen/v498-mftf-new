<?php
namespace Cafedu\Theme\Controller\Customer;

use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;

class Order extends \Magento\Framework\App\Action\Action
{
  protected $_listProduct;
  protected $_orderFactory;
  protected $_productFactory;
  protected $_customerSession;

  public function __construct(
    Context $context,
    \Magento\Sales\Model\OrderFactory $orderFactory,
    \Magento\Store\Model\StoreManager $storeManager,
    \Magento\Customer\Model\Session $customerSession,
    \Magento\Catalog\Model\ProductFactory $productFactory,
    \Magento\Catalog\Block\Product\ListProduct $listProduct
  )
  {
    $this->_listProduct = $listProduct;
    $this->_orderFactory = $orderFactory;
    $this->_productFactory = $productFactory;
    $this->_customerSession = $customerSession;
    parent::__construct($context);
  }

  public function execute()
  {
    if( $this->_customerSession->isLoggedIn() ) {
      $layout = '';
      $order_id = $this->getRequest()->getParam('order_id');

      if( $order_id ) {
        $order = $this->_orderFactory->create()->load( $order_id );
        $orderItems = $order->getAllItems();

        $layout .= '<tr class="cafedu-details-row" id="cafedu-details-row-' . $order_id . '">';
        $layout .= '<td colspan="4">';
        foreach ($orderItems as $item) {
          if(!$item->getParentItemId()) {
            $product = $this->_productFactory->create()->load($item->getProductId());
            $_image = $this->_listProduct->getImage($product, 'category_page_grid')->toHtml();

            $_title = $item->getName();
            $_option = '';
            if($item->getProductOptions()) {
              foreach ($item->getProductOptions() as $key => $option) {
                if($key == 'attributes_info') {
                  foreach ($option as $value) {
                    $_option .= $value['label'] . ': ' . $value['value'];
                  }
                }
              }
            }

            $_amount = $order->formatPrice($item->getRowTotalInclTax());

            /** prepare layout **/
            $layout .= '<div class="item-info-container">';
            $layout .= '<div class="item-image">' . $_image . '</div>';
            $layout .= '<div class="item-info">';
            $layout .= '<div class="item-title">' . $_title . '</div>';
            $layout .= '<div class="item-options">' . $_option . '</div>';
            $layout .= '</div>';
            $layout .= '<div class="item-price">' . $_amount . '</div>';
            $layout .= '</div>';
          }
        }
        $layout .= '</td>';
        $layout .= '</tr>';

        echo $layout;
        die;
      }
    } else {
      $this->messageManager->addError(__('Your current session has been expired.'));
      $this->_redirect('customer/account/login');
    }
  }
}
