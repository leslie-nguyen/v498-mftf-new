<?php
namespace Cafedu\Theme\Block\Adminhtml\Catalog\Product\Tabs;
 
use Magento\Backend\Block\Template\Context;
use Cafedu\CmsBuilder\Helper\Products;
use Magento\Framework\Registry;
 
class StyleWith extends \Magento\Framework\View\Element\Template
{
    /**
     * @var string
     */
    protected $_template = 'product/edit/style-with.phtml';
 
    /**
     * Core registry
     *
     * @var Registry
     */
    protected $_cmsbuilderProducts;
    protected $_coreRegistry = null;
 
    public function __construct(
        Context $context,
        Registry $registry,
        Products $helperProducts,
        array $data = []
    )
    {
        $this->_coreRegistry = $registry;
        $this->_cmsbuilderProducts = $helperProducts;
        parent::__construct($context, $data);
    }
 
    /**
     * Retrieve product
     *
     * @return \Magento\Catalog\Model\Product
     */
    public function getProduct()
    {
        return $this->_coreRegistry->registry('current_product');
    }

    public function getImageUrl($image = '')
    {
        return $this->getBaseUrl() . 'pub/media/cafedu/style-with/' . $image;
    }

    public function getProcessUrl()
    {
        return $this->getUrl('cafedu_theme/product/process', ['_secure' => true]);
    }

    public function getUploaderUrl()
    {
        return $this->getUrl('cafedu_theme/product/uploader', ['_secure' => true]);
    }

    protected function prepareProductList($i, $key, $data) {
        $filed = '';
        $options = $this->_cmsbuilderProducts->getOptionArray();

        for($j=1;$j<=4;$j++) {
            $filed .= '<div class="fieldset admin__fieldset fieldset-wide cdc-style-with-field">';
            $filed .= '<div class="admin__field field field-style-with-'.$i.'-prod-'.$j.'">';
            $filed .= '<label for="style-with['.$i.'][prod-'.$j.']" class="label admin__field-label"><span> '.__('Style With Product ').$j.'</span></label>';
            $filed .= '<div class="admin__field-control control">';
            $filed .= '<select class="select admin__control-select" name="style-with['.$i.'][prod-'.$j.']" id="style-with['.$i.'][prod-'.$j.']">';
            foreach ($options as $option) {
                if( isset($data['prod-'.$j]) && ($option['value'] == $data['prod-'.$j]) ) {
                    $filed .= '<option value="'.$option['value'].'" selected="selected">'.$option['label'].'</option>';
                } else {
                     $filed .= '<option value="'.$option['value'].'">'.$option['label'].'</option>';
                }
            }
            $filed .= '</select>';
            $filed .= '</div>';
            $filed .= '</div>';
            $filed .= '</div>';
        }

        return $filed;
    }

    public function prepareFields($i, $data = array()) {
        $formLayout = '';

        $formLayout .= '<div class="cdc-style-with-fieldset" id="cdc-style-with-fieldset-'.$i.'">';
        $formLayout .= '<p class="cdc-style-with-fieldset-remove" data-fieldset="'.$i.'">'.__('Remove').'</p>';
        $formLayout .= '<div class="side-col cdc-style-with-side-col">';
        $formLayout .= '<div class="cdc-style-with-preview" id="style-with-image-'.$i.'-preview">';

        if(isset($data['image']) && !empty($data['image'])) {
          $formLayout .= '<img alt="Preview" src="'.$this->getImageUrl($data['image']).'">';  
        }
        
        $formLayout .= '</div>';
        $formLayout .= '<div class="cdc-style-with-uploader">';
        $formLayout .= '<input type="hidden" name="style-with['.$i.'][image]" id="style-with-image-'.$i.'-path" value="'.(isset($data['image']) ? $data['image'] : '').'">';
        $formLayout .= '<input type="file" class="input-file cdc-style-with-uploader-field" id="style-with-image-'.$i.'" title="Upload your image" name="image-'.$i.'">';
        $formLayout .= '<div id="cdc-style-with-uploader-note" class="note">Recommended resolution 550 X 800. Allow image type: jpg, jpeg, png</div>';
        $formLayout .= '</div>';
        $formLayout .= '</div>';
        $formLayout .= '<div class="main-col cdc-style-with-main-col">';
        $formLayout .= $this->prepareProductList($i, 'product_1', $data);
        $formLayout .= '<div class="fieldset admin__fieldset fieldset-wide cdc-style-with-field">';
        $formLayout .= '<div class="admin__field field style-with['.$i.'][url]">';
        $formLayout .= '<label for="style-with['.$i.'][url]" class="label admin__field-label"><span>'.__('View All Looks').'</span></label>';
        $formLayout .= '<div class="admin__field-control control">';
        $formLayout .= '<input type="text" class="input-text admin__control-text" name="style-with['.$i.'][url]" id="style-with['.$i.'][url]" value="'.(isset($data['url']) ? $data['url'] : '').'">';
        $formLayout .= '</div>';
        $formLayout .= '</div>';
        $formLayout .= '</div>';
        $formLayout .= '</div>';
        $formLayout .= '</div>';

        return $formLayout;                
    }
}