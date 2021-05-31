<?php
namespace AHT\Salesagent\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;

class InstallSchema implements InstallSchemaInterface
{
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;

        $installer->startSetup();

        $table = $installer->getConnection()
            ->newTable($installer->getTable('aht_salesagent_salesagent'))
            ->addColumn(
            'entity_id',
            Table::TYPE_INTEGER,
            null,
            ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
            'ID'
            )
            ->addColumn(
            'order_id',
            Table::TYPE_INTEGER,
            11,
            ['nullable' => false],
            'order id'
            )
            ->addColumn(
            'order_item_id',
            Table::TYPE_INTEGER,
            11,
            ['nullable' => false],
            'order item id'
            )
            ->addColumn(
            'order_item_sku',
            Table::TYPE_TEXT,
            255,
            ['nullable' => false],
            'level tree'
            )
            ->addColumn(
            'order_item_price',
            Table::TYPE_DECIMAL,
            '10,2',
            ['nullable' => false, 'default' => '0.00'],
            'order item price'
            )
            ->addColumn(
            'commision_type',
            Table::TYPE_INTEGER,
            11,
            ['nullable' => false],
            'commision type'
            )
            ->addColumn(
            'commision_value',
            Table::TYPE_DECIMAL,
            '10,2',
            ['nullable' => false, 'default' => '0.00'],
            'commision value'
            );
        $installer->getConnection()->createTable($table);
        
        $installer->endSetup();

    }
}
