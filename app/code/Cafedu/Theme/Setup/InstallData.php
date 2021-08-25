<?php
namespace Cafedu\Theme\Setup;

use Magento\Eav\Setup\EavSetup;
use Magento\Customer\Model\Customer;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Customer\Setup\CustomerSetupFactory;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class InstallData implements InstallDataInterface
{
	private $eavSetupFactory;
    private $customerSetupFactory;

	public function __construct(
		EavSetupFactory $eavSetupFactory,
        CustomerSetupFactory $customerSetupFactory
	)
	{
		$this->eavSetupFactory = $eavSetupFactory;
        $this->customerSetupFactory = $customerSetupFactory;
	}

	public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
	{
		$eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);

        /** Add CDC - Theme Settngs tab **/
        $groupName = 'CDC - Theme Settings';
        $entityTypeId = $eavSetup->getEntityTypeId('catalog_product');
        $attributeSetIds = $eavSetup->getAllAttributeSetIds($entityTypeId);
         
        foreach($attributeSetIds as $attributeSetId) {
            $eavSetup->addAttributeGroup($entityTypeId, $attributeSetId, $groupName, 3);
        }

		/** Add Cafedu category attribute **/
		$eavSetup->addAttribute(\Magento\Catalog\Model\Category::ENTITY, 'in_homepage', [
            'type'     => 'int',
            'label'    => 'Visible in Home Page',
            'input'    => 'boolean',
            'source'   => 'Magento\Eav\Model\Entity\Attribute\Source\Boolean',
            'visible'  => true,
            'default'  => '0',
            'required' => false,
            'global'   => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
            'group'    => 'cafedu_theme_settings',
            'note'     => 'Make \'Yes\' to show category on Home Page.',
        ]);

        $eavSetup->addAttribute(\Magento\Catalog\Model\Category::ENTITY, 'is_collections', [
            'type'     => 'int',
            'label'    => 'Include in Collections',
            'input'    => 'boolean',
            'source'   => 'Magento\Eav\Model\Entity\Attribute\Source\Boolean',
            'visible'  => true,
            'default'  => '0',
            'required' => false,
            'global'   => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
            'group'    => 'cafedu_theme_settings',
            'note'     => 'Set \'Yes\' to add category under \'Collection\' in navigation menu.',
        ]);

        $eavSetup->addAttribute(\Magento\Catalog\Model\Category::ENTITY, 'banner', [
            'type'     => 'varchar',
            'label'    => 'Home Page - Banner Image',
            'input'    => 'image',
            'backend'   => 'Cafedu\Theme\Model\Category\Attribute\Backend\Banner',
            'visible'  => true,
            'default'  => '',
            'required' => false,
            'global'   => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
            'group'    => 'cafedu_theme_settings',
            'note'     => 'Recommended resolution 2200 X 1111.',
        ]);

        $eavSetup->addAttribute(\Magento\Catalog\Model\Category::ENTITY, 'image_2', [
            'type'     => 'varchar',
            'label'    => 'Category Image 2',
            'input'    => 'image',
            'backend'   => 'Cafedu\Theme\Model\Category\Attribute\Backend\Image',
            'visible'  => true,
            'default'  => '',
            'required' => false,
            'global'   => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
            'group'    => 'cafedu_theme_settings',
            'note'     => 'Recommended resolution 860 X 950.',
        ]);

        /** related_blog **/
        $eavSetup->addAttribute(\Magento\Catalog\Model\Product::ENTITY, 'related_blog', [
            'type' => 'varchar',
            'backend' => '',
            'frontend' => '',
            'label' => 'Related Blog Slug',
            'input' => 'text',
            'class' => '',
            'source' => '',
            'global' => \Magento\Catalog\Model\ResourceModel\Eav\Attribute::SCOPE_STORE,
            'visible' => true,
            'required' => false,
            'user_defined' => false,
            'default' => '',
            'searchable' => false,
            'filterable' => false,
            'comparable' => false,
            'visible_on_front' => true,
            'used_in_product_listing' => false,
            'unique' => false,
            'apply_to' => ''
        ]);

        /** style_with **/
        $eavSetup->addAttribute(\Magento\Catalog\Model\Product::ENTITY, 'style_with', [
            'type' => 'text',
            'backend' => '',
            'frontend' => '',
            'label' => 'Style With',
            'input' => 'textarea',
            'class' => '',
            'source' => '',
            'global' => \Magento\Catalog\Model\ResourceModel\Eav\Attribute::SCOPE_STORE,
            'visible' => true,
            'required' => false,
            'user_defined' => false,
            'default' => '',
            'searchable' => false,
            'filterable' => false,
            'comparable' => false,
            'visible_on_front' => true,
            'used_in_product_listing' => false,
            'unique' => false,
            'apply_to' => ''
        ]);
	}
}