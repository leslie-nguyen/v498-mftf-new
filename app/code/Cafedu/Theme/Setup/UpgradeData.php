<?php
namespace Cafedu\Theme\Setup;

use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Eav\Setup\EavSetupFactory;

class UpgradeData implements UpgradeDataInterface
{
    /**
     * @var EavSetupFactory
     */
    private $eavSetupFactory;

    /**
     * UpgradeData constructor.
     * @param EavSetupFactory $eavSetupFactory
     */
    public function __construct(
        EavSetupFactory $eavSetupFactory
    ) {
        $this->eavSetupFactory = $eavSetupFactory;
    }

    /**
     * @param ModuleDataSetupInterface $setup
     * @param ModuleContextInterface $context
     */
    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
        $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);
        if (version_compare($context->getVersion(), '1.3.1', '<')) {
            /**
             * @var \Magento\Eav\Setup\EavSetup $eavSetup
             */
            $eavSetup->addAttribute(\Magento\Catalog\Model\Category::ENTITY, 'large_image', [
                'type'     => 'varchar',
                'label'    => 'Large Image',
                'input'    => 'image',
                'backend'   => 'Cafedu\Theme\Model\Category\Attribute\Backend\Image',
                'visible'  => true,
                'default'  => '',
                'required' => false,
                'global'   => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
                'group'    => 'cafedu_theme_settings',
                'note'     => 'Category Large Image',
            ]);
        }

        if (version_compare($context->getVersion(), '1.3.2', '<')) {
            $this->addMobileBanner($eavSetup);
        }

        $setup->endSetup();
    }

    /**
     * @param \Magento\Eav\Setup\EavSetup $eavSetup
     */
    private function addMobileBanner($eavSetup)
    {
        $eavSetup->addAttribute(\Magento\Catalog\Model\Category::ENTITY, 'mobile_banner', [
            'type'     => 'varchar',
            'label'    => 'Home Page - Mobile Banner Image',
            'input'    => 'image',
            'backend'   => 'Cafedu\Theme\Model\Category\Attribute\Backend\Banner',
            'visible'  => true,
            'default'  => '',
            'required' => false,
            'global'   => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
            'group'    => 'cafedu_theme_settings',
            'note'     => 'Recommended resolution 768 x 400',
        ]);
    }
}
