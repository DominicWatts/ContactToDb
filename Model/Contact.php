<?php

namespace Xigen\ContactToDb\Model;

use Magento\Framework\Api\DataObjectHelper;
use Xigen\ContactToDb\Api\Data\ContactInterface;
use Xigen\ContactToDb\Api\Data\ContactInterfaceFactory;

/**
 * Undocumented class
 */
class Contact extends \Magento\Framework\Model\AbstractModel
{
    protected $dataObjectHelper;

    protected $_eventPrefix = 'xigen_contacttodb_contact';

    protected $contactDataFactory;

    /**
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param ContactInterfaceFactory $contactDataFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param \Xigen\ContactToDb\Model\ResourceModel\Contact $resource
     * @param \Xigen\ContactToDb\Model\ResourceModel\Contact\Collection $resourceCollection
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        ContactInterfaceFactory $contactDataFactory,
        DataObjectHelper $dataObjectHelper,
        ResourceModel\Contact $resource,
        ResourceModel\Contact\Collection $resourceCollection,
        array $data = []
    ) {
        $this->contactDataFactory = $contactDataFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

    /**
     * Retrieve contact model with contact data
     * @return ContactInterface
     */
    public function getDataModel()
    {
        $contactData = $this->getData();
        
        $contactDataObject = $this->contactDataFactory->create();
        $this->dataObjectHelper->populateWithArray(
            $contactDataObject,
            $contactData,
            ContactInterface::class
        );
        
        return $contactDataObject;
    }
}
