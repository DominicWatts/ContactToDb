<?php

namespace Xigen\ContactToDb\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

/**
 * InstallSchema class
 */
class InstallSchema implements InstallSchemaInterface
{
    /**
     * {@inheritdoc}
     */
    public function install(
        SchemaSetupInterface $setup,
        ModuleContextInterface $context
    ) {
        $table_xigen_contacttodb_contact = $setup->getConnection()
            ->newTable($setup->getTable('xigen_contacttodb_contact'));

        $table_xigen_contacttodb_contact->addColumn(
            'contact_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            ['identity' => true, 'nullable' => false, 'primary' => true, 'unsigned' => true, ],
            'Entity ID'
        );

        $table_xigen_contacttodb_contact->addColumn(
            'name',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            255,
            [],
            'Name'
        );

        $table_xigen_contacttodb_contact->addColumn(
            'email',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            255,
            [],
            'Email'
        );

        $table_xigen_contacttodb_contact->addColumn(
            'telephone',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            255,
            [],
            'Telephone'
        );

        $table_xigen_contacttodb_contact->addColumn(
            'comment',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            2048,
            [],
            'Comment'
        );

        $table_xigen_contacttodb_contact->addColumn(
            'created_at',
            \Magento\Framework\DB\Ddl\Table::TYPE_DATETIME,
            null,
            [],
            'Created At'
        );

        $table_xigen_contacttodb_contact->addColumn(
            'updated_at',
            \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
            null,
            [],
            'Updated At'
        );

        $setup->getConnection()->createTable($table_xigen_contacttodb_contact);
    }
}
