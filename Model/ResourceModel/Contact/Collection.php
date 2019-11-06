<?php

namespace Xigen\ContactToDb\Model\ResourceModel\Contact;

/**
 * Collection class
 */
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'contact_id';

    /**
     * Define resource model
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            \Xigen\ContactToDb\Model\Contact::class,
            \Xigen\ContactToDb\Model\ResourceModel\Contact::class
        );
    }
}
