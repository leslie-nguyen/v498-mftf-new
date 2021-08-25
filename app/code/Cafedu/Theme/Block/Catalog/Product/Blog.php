<?php
namespace Cafedu\Theme\Block\Catalog\Product;

class Blog extends \Magento\Catalog\Block\Product\AbstractProduct
{
    protected $_postCollection; 
    
    public function __construct(
        \Magento\Catalog\Block\Product\Context $context,
        \FishPig\WordPress\Model\ResourceModel\Post\Collection $postCollection
    ) {
        $this->_postCollection = $postCollection;  
        parent::__construct($context);
    }

    /**
     * Return post object
     */
    public function getPostObject() {
        $product = $this->getProduct();

        if ( $product->getContentSection() && $product->getRelatedBlog() ) {
            $collection = $this->_postCollection
                ->addFieldToFilter('main_table.post_type', 'post')
                ->addFieldToFilter('main_table.post_status', 'publish')
                ->addFieldToFilter('main_table.post_name', $product->getRelatedBlog());
        
            if( $collection->count() ) {
                foreach ($collection as $post) {
                    return $post;
                }
            }
        }

        return false;
    } 
}
