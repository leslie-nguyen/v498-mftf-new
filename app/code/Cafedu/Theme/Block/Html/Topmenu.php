<?php

namespace Cafedu\Theme\Block\Html;

use Magento\Framework\Data\Tree\NodeFactory;
use Magento\Framework\Data\TreeFactory;
use Magento\Framework\View\Element\Template;

class Topmenu extends \Magento\Theme\Block\Html\Topmenu
{
    /** set nav template */
	protected $_template = 'Cafedu_Theme::topmenu.phtml';

    /**
     * @var \Magento\Catalog\Helper\Category
     */
	protected $categoryHelper;

    /**
     * @var \Magento\Catalog\Model\ResourceModel\Category\CollectionFactory
     */
	protected $collectionFactory;

    /**
     * @var \FishPig\WordPress\Model\Homepage
     */
	protected $fishPigHomepage;

    /**
     * @var \FishPig\WordPress\Model\OptionManager
     */
	protected $fishPigConfig;

    /**
     * @var \Magento\Framework\DataObjectFactory
     */
	protected $dataObjectFactory;

    /**
     * Topmenu constructor.
     * @param Template\Context $context
     * @param NodeFactory $nodeFactory
     * @param TreeFactory $treeFactory
     * @param \Magento\Catalog\Helper\Category $categoryHelper
     * @param \Magento\Catalog\Model\ResourceModel\Category\CollectionFactory $collectionFactory
     * @param \FishPig\WordPress\Model\Homepage $fishPigHomepage
     * @param \FishPig\WordPress\Model\OptionManager $fishPigConfig
     * @param \Magento\Framework\DataObjectFactory $dataObjectFactory
     * @param array $data
     */
	public function __construct(
        Template\Context $context,
        NodeFactory $nodeFactory,
        TreeFactory $treeFactory,
        \Magento\Catalog\Helper\Category $categoryHelper,
        \Magento\Catalog\Model\ResourceModel\Category\CollectionFactory $collectionFactory,
        \FishPig\WordPress\Model\Homepage $fishPigHomepage, \FishPig\WordPress\Model\OptionManager $fishPigConfig,
        \Magento\Framework\DataObjectFactory $dataObjectFactory,
        array $data = []
    ) {
        parent::__construct(
            $context,
            $nodeFactory,
            $treeFactory,
            $data
        );

        $this->categoryHelper = $categoryHelper;
        $this->collectionFactory = $collectionFactory;
        $this->fishPigHomepage = $fishPigHomepage;
        $this->fishPigConfig = $fishPigConfig;
        $this->dataObjectFactory = $dataObjectFactory;
    }

    /**
     * Return categories helper
     */
    protected function getCategoryHelper()
    {
        return $this->categoryHelper;
    }

    /**
     * Return categories collection
     * @param $parentCategoryId
     * @return mixed
     */
    protected function getCategoriesCollection($parentCategoryId)
    {
        $parentCategoryId = str_replace('category-node-', '', $parentCategoryId);
        return $this->collectionFactory->create()
            ->addAttributeToSelect('*')
            ->addAttributeToFilter('parent_id', [$parentCategoryId])
            ->addAttributeToFilter('is_collections', '1');
    }

    /**
     * Return Category html
     * @param $categories
     * @return string
     */
    protected function getCategoryHtml($categories)
    {
        $html = '';

        if ($categories->count()) {
            foreach ($categories as $category) {
                if (!$category->getIsActive()) continue;

                $html .= '<li class="level1"><a href="' . $this->getCategoryHelper()->getCategoryUrl($category) . '"><span>' . $category->getName() . '</span></a></li>';
            }
        }

        return $html;
    }

    /**
     * Return html
     * @param $child
     * @return string
     */
    public function prepareHtml($child)
    {
        $categoriesCollection = $this->getCategoriesCollection($child->getId())->addOrderField('position');
        $htmlCategoryCollection = $this->getCategoryHtml($categoriesCollection);
        $html = '';

        if( $htmlCategoryCollection != '' ) {
            $html .= '<li class="cdc-navigation-item cdc-navigation-collections"><ul>';
            $html .= '<li class="level1 collection-title cdc-navigation-title">' . __('Collections') . '</li>';
            $html .= $htmlCategoryCollection;
            $html .= '</ul></li>';
        }

        return $html;
    }


    /**
     * Add sub menu HTML code for current menu item
     * @param $child
     * @param $childLevel
     * @param $childrenWrapClass
     * @param $limit
     * @return string
     */
    protected function _addSubMenu($child, $childLevel, $childrenWrapClass, $limit)
    {
        $html = '';
        if (!$child->hasChildren()) {
            return $html;
        }

         $colStops = [];
        if ($childLevel == 0 && $limit) {
            $colStops = $this->_columnBrake($child->getChildren(), $limit);
        }

        $html .= '<ul class="level' . $childLevel . ' submenu">';
        $html .= '<li><ul>';
        $html .= $this->_getHtml( $child, $childrenWrapClass, $limit, $colStops );
        $html .= '</ul></li>';
        $html .= $this->prepareHtml( $child );
        $html .= '</ul>';

        return $html;
    }

    /**
     * @param \Magento\Framework\Data\Tree\Node $menuTree
     * @param $childrenWrapClass
     * @param $limit
     * @param array $colBrakes
     * @return string
     */
    protected function _getCdcHtml(
        \Magento\Framework\Data\Tree\Node $menuTree,
        $childrenWrapClass,
        $limit,
        $colBrakes = []
    ) {
        $html = '';

        $children = $menuTree->getChildren();
        $parentLevel = $menuTree->getLevel();
        $childLevel = $parentLevel === null ? 0 : $parentLevel + 1;

        $counter = 1;
        $itemPosition = 1;
        $childrenCount = $children->count();

        $parentPositionClass = $menuTree->getPositionClass();
        $itemPositionClassPrefix = $parentPositionClass ? $parentPositionClass . '-' : 'nav-';

        /** @var \Magento\Framework\Data\Tree\Node $child */
        foreach ($children as $child) {
            if ($childLevel === 0 && $child->getData('is_parent_active') === false) {
                continue;
            }
            $child->setLevel($childLevel);
            $child->setIsFirst($counter == 1);
            $child->setIsLast($counter == $childrenCount);
            $child->setPositionClass($itemPositionClassPrefix . $counter);

            $outermostClassCode = '';
            $outermostClass = $menuTree->getOutermostClass();

            if ($childLevel == 0 && $outermostClass) {
                $outermostClassCode = ' class="' . $outermostClass . '" ';
                $child->setClass($outermostClass);
            }

            if (count($colBrakes) && $colBrakes[$counter]['colbrake']) {
                $html .= '</ul></li><li class="column"><ul>';
            }

            $html .= '<li ' . $this->_getRenderedMenuItemAttributes($child) . '>';
            $html .= '<a href="' . $child->getUrl() . '" ' . $outermostClassCode . '><span>' . $this->escapeHtml(
                $child->getName()
            ) . '</span></a>' . $this->_addSubMenu(
                $child,
                $childLevel,
                $childrenWrapClass,
                $limit
            ) . '</li>';

            if( $counter == 2 ) {
                $_homePage = $this->fishPigHomepage;
                $_config   = $this->fishPigConfig;
                $html .= '<li class="level0 nav-wp level-top ui-menu-item">';
                $html .= '<a href="'.$_homePage->getUrl().'" ' . $outermostClassCode . '><span>' . $this->escapeHtml( $_config->getOption('nav_label') ) . '</span></a></li>';
            }

            $itemPosition++;
            $counter++;
        }

        if (count($colBrakes) && $limit) {
            $html = '<li class="column"><ul>' . $html . '</ul></li>';
        }

        return $html;
    }

    /**
     * Get top menu html
     *
     * @param string $outermostClass
     * @param string $childrenWrapClass
     * @param int $limit
     * @return string
     */
    public function getHtml($outermostClass = '', $childrenWrapClass = '', $limit = 0)
    {
        $this->_eventManager->dispatch(
            'page_block_html_topmenu_gethtml_before',
            ['menu' => $this->getMenu(), 'block' => $this, 'request' => $this->getRequest()]
        );

        $this->getMenu()->setOutermostClass($outermostClass);
        $this->getMenu()->setChildrenWrapClass($childrenWrapClass);

        $html = $this->_getCdcHtml($this->getMenu(), $childrenWrapClass, $limit);

        $transportObject = $this->dataObjectFactory->create()->setData(['html' => $html]);
        $this->_eventManager->dispatch(
            'page_block_html_topmenu_gethtml_after',
            ['menu' => $this->getMenu(), 'transportObject' => $transportObject]
        );
        $html = $transportObject->getHtml();
        return $html;
    }
}