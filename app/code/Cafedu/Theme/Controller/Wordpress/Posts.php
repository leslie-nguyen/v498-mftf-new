<?php
namespace Cafedu\Theme\Controller\Wordpress;

use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;

class Posts extends \Magento\Framework\App\Action\Action
{
  protected $_config;
  protected $_postCollection;

  public function __construct(
    Context $context,
    \FishPig\WordPress\Model\OptionManager $config,
    \FishPig\WordPress\Model\ResourceModel\Post\Collection $postCollection
  )
  {
    $this->_config = $config;
    $this->_postCollection = $postCollection;
    parent::__construct($context);
  }

  public function execute()
  {
    $_param = $this->getRequest()->getParams();

    if( isset($_param['page']) && !empty($_param['page']) ) {
      $html = '';
      $response_array = array();
      $_pagination = $this->_config->getOption('posts_per_page');

      $_collection = $this->_postCollection->addFieldToFilter('main_table.post_type','post')
        ->addFieldToFilter('main_table.post_status','publish');

      if( isset($_param['category']) && !empty($_param['category']) ) {
        $_collection->addCategoryIdFilter($_param['category']);
      }

      $_collection->setOrderByPostDate()->setCurPage($_param['page'])->setPageSize($_pagination);

      if( $_collection->getLastPageNumber() < $_param['page'] ) {
        return false;
      }

      if( $_count = $_collection->count() ) {
        foreach ($_collection as $post) {
          $category = $post->getParentTerm('category');

          $html .= '<div class="item-box">';
          $html .= '<div class="img-thumb">';

	  if ($image = $post->getImage()):
	      $html .= '<a href="'.$post->getUrl().'" title="'.$post->getName().'">';
	      $html .= '<img src="'.$image->getFullSizeImage().'" alt="'.$post->getName().'"/>';
	      $html .= '</a>';
          endif;

          $html .= '</div>';
          $html .= '<h2>';
          $html .= '<a href="'.$post->getUrl().'" title="'.$post->getName().'">'.$category->getName().'</a>';
          $html .= '</h2>';
          $html .= '<p>'.$post->getExcerpt(60).'</p>';
          $html .= '</div>';
        }

        $response_array['posts'] = $html;
      }

      if( $_param['page'] < $_collection->getLastPageNumber()) {
        $response_array['page'] = ($_param['page'] + 1);
        $response_array['category'] = ( isset($_param['category']) ? $_param['category'] : '' );
      }

      $response = $this->resultFactory->create(ResultFactory::TYPE_JSON);
      $response->setData($response_array);
      return $response;
    }
  }
}
