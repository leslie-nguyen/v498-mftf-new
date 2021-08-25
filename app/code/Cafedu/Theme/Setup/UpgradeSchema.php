<?php
namespace Cafedu\Theme\Setup;
 
use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

 
class UpgradeSchema implements UpgradeSchemaInterface
{
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        if (version_compare($context->getVersion(), '1.1.0', '<')) {
            $this->addNewField($setup);
        }

        if (version_compare($context->getVersion(), '1.2.0', '<')) {
            $this->addCountryPhoneCode($setup);
        }

        if (version_compare($context->getVersion(), '1.3.0', '<')) {
            $this->addAdditionalField($setup);
        }
    }

    /**
     * Add new fields
     *
     * @param SchemaSetupInterface $setup
     * @return $this
     */
    protected function addNewField(SchemaSetupInterface $setup)
    {
        /** subscriber_country **/
        $setup->getConnection()->addColumn(
            $setup->getTable('newsletter_subscriber'),
            'subscriber_country',
            [
                'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                'length' => 10,
                'nullable' => true,
                'after' => 'subscriber_email',
                'comment' => 'Subscriber Country'
            ]
        );

        /** subscriber_gender **/
        $setup->getConnection()->addColumn(
            $setup->getTable('newsletter_subscriber'),
            'subscriber_gender',
            [
                'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                'length' => 10,
                'nullable' => true,
                'after' => 'subscriber_country',
                'comment' => 'Subscriber Gender'
            ]
        );

        return $this;
    }

    /**
     * Add new table
     *
     * @param SchemaSetupInterface $setup
     * @return $this
     */
    protected function addCountryPhoneCode(SchemaSetupInterface $setup)
    {
        $installer = $setup;
        $installer->startSetup();

        $table = $installer->getConnection()->newTable(
            $installer->getTable('cafedu_country_phone_code')
        )->addColumn(
            'phone_code_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
            'Country Phone Code Id'
        )->addColumn(
            'locale',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            5,
            ['nullable' => false, 'unsigned' => true],
            'Locale'
        )->addColumn(
            'country_code',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            5,
            ['nullable' => false],
            'Country Code'
        )->addColumn(
            'label',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            55,
            ['nullable' => false],
            'Label'
        )->addColumn(
            'phone_code',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            10,
            ['nullable' => false, 'unsigned' => true],
            'Phone Code'
        )->addColumn(
            'created_at',
            \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
            null,
            ['nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT],
            'Created at'
        )->setComment( 'Cafedu - CMS Builder' );
        $installer->getConnection()->createTable($table);
        $installer->endSetup();
    }

    /**
     * Add additional field
     *
     * @param SchemaSetupInterface $setup
     * @return $this
     */
    protected function addAdditionalField(SchemaSetupInterface $setup)
    { 
        $installer = $setup;
        $installer->startSetup();

        $installer->getConnection()->addColumn(
            $installer->getTable('quote_address'),
            'cafedu_phone_preffix',
            [
                'type' => 'varchar',
                'nullable' => true,
                'after' => 'country_id',
                'comment' => 'Country Code',
            ]
        );

        $installer->getConnection()->addColumn(
            $installer->getTable('sales_order_address'),
            'cafedu_phone_preffix',
            [
                'type' => 'varchar',
                'nullable' => true,
                'after' => 'email',
                'comment' => 'Country Code',
            ]
        );

        $setup->endSetup();
    }
}