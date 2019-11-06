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
    /**
     * @var DataObjectHelper
     */
    protected $dataObjectHelper;

    /**
     * @var string
     */
    protected $_eventPrefix = 'xigen_contacttodb_contact';

    /**
     * @var ContactInterfaceFactory
     */
    protected $contactDataFactory;

    /**
     * @var \Magento\Framework\Stdlib\DateTime\DateTime
     */
    private $dateTime;

    /**
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param ContactInterfaceFactory $contactDataFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param \Xigen\ContactToDb\Model\ResourceModel\Contact $resource
     * @param \Xigen\ContactToDb\Model\ResourceModel\Contact\Collection $resourceCollection
     * @param \Magento\Framework\Stdlib\DateTime\DateTime $dateTime,
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        ContactInterfaceFactory $contactDataFactory,
        DataObjectHelper $dataObjectHelper,
        ResourceModel\Contact $resource,
        ResourceModel\Contact\Collection $resourceCollection,
        \Magento\Framework\Stdlib\DateTime\DateTime $dateTime,
        array $data = []
    ) {
        $this->contactDataFactory = $contactDataFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dateTime = $dateTime;
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

    /**
     * Before save
     */
    public function beforeSave()
    {
        $this->setUpdatedAt($this->dateTime->gmtDate());
        if ($this->isObjectNew()) {
            $this->setCreatedAt($this->dateTime->gmtDate());
        }
        return parent::beforeSave();
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
