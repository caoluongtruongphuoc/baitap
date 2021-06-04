<?php
namespace AHT\CustomCheckout\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class InstallSchema implements InstallSchemaInterface
{
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;

        $installer->startSetup();

        $attributes = [
            'delivery_data' => [
                'type' => \Magento\Framework\DB\Ddl\Table::TYPE_DATETIME,
                'nullable' => false,
                'comment' => 'Delivery date'
            ],
            'delivery_comment' => [
                'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                'length' => '64k',
                'nullable' => true,
                'comment' => 'Delivery comment'
            ]
        ];
       
        foreach ($attributes as $key => $value) {
            $installer->getConnection()->addColumn(
                $installer->getTable('quote'),
                $key,
                $value
            );
            $installer->getConnection()->addColumn(
                $installer->getTable('sales_order'),
                $key,
                $value
            );
            $installer->getConnection()->addColumn(
                $installer->getTable('sales_order_grid'),
                $key,
                $value
            );
        }

        $installer->endSetup();

    }
}
