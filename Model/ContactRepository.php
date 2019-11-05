<?php

namespace Xigen\ContactToDb\Model;

use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Api\ExtensibleDataObjectConverter;
use Magento\Framework\Api\ExtensionAttribute\JoinProcessorInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Reflection\DataObjectProcessor;
use Magento\Store\Model\StoreManagerInterface;
use Xigen\ContactToDb\Api\ContactRepositoryInterface;
use Xigen\ContactToDb\Api\Data\ContactInterfaceFactory;
use Xigen\ContactToDb\Api\Data\ContactSearchResultsInterfaceFactory;
use Xigen\ContactToDb\Model\ResourceModel\Contact as ResourceContact;
use Xigen\ContactToDb\Model\ResourceModel\Contact\CollectionFactory as ContactCollectionFactory;

class ContactRepository implements ContactRepositoryInterface
{
    protected $dataObjectHelper;

    private $storeManager;

    protected $searchResultsFactory;

    protected $dataObjectProcessor;

    protected $extensionAttributesJoinProcessor;

    private $collectionProcessor;

    protected $extensibleDataObjectConverter;

    protected $resource;

    protected $dataContactFactory;

    protected $contactCollectionFactory;

    protected $contactFactory;

    /**
     * @param ResourceContact $resource
     * @param ContactFactory $contactFactory
     * @param ContactInterfaceFactory $dataContactFactory
     * @param ContactCollectionFactory $contactCollectionFactory
     * @param ContactSearchResultsInterfaceFactory $searchResultsFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param DataObjectProcessor $dataObjectProcessor
     * @param StoreManagerInterface $storeManager
     * @param CollectionProcessorInterface $collectionProcessor
     * @param JoinProcessorInterface $extensionAttributesJoinProcessor
     * @param ExtensibleDataObjectConverter $extensibleDataObjectConverter
     */
    public function __construct(
        ResourceContact $resource,
        ContactFactory $contactFactory,
        ContactInterfaceFactory $dataContactFactory,
        ContactCollectionFactory $contactCollectionFactory,
        ContactSearchResultsInterfaceFactory $searchResultsFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        StoreManagerInterface $storeManager,
        CollectionProcessorInterface $collectionProcessor,
        JoinProcessorInterface $extensionAttributesJoinProcessor,
        ExtensibleDataObjectConverter $extensibleDataObjectConverter
    ) {
        $this->resource = $resource;
        $this->contactFactory = $contactFactory;
        $this->contactCollectionFactory = $contactCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataContactFactory = $dataContactFactory;
        $this->dataObjectProcessor = $dataObjectProcessor;
        $this->storeManager = $storeManager;
        $this->collectionProcessor = $collectionProcessor;
        $this->extensionAttributesJoinProcessor = $extensionAttributesJoinProcessor;
        $this->extensibleDataObjectConverter = $extensibleDataObjectConverter;
    }

    /**
     * {@inheritdoc}
     */
    public function save(
        \Xigen\ContactToDb\Api\Data\ContactInterface $contact
    ) {
        /* if (empty($contact->getStoreId())) {
            $storeId = $this->storeManager->getStore()->getId();
            $contact->setStoreId($storeId);
        } */
        
        $contactData = $this->extensibleDataObjectConverter->toNestedArray(
            $contact,
            [],
            \Xigen\ContactToDb\Api\Data\ContactInterface::class
        );
        
        $contactModel = $this->contactFactory->create()->setData($contactData);
        
        try {
            $this->resource->save($contactModel);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the contact: %1',
                $exception->getMessage()
            ));
        }
        return $contactModel->getDataModel();
    }

    /**
     * {@inheritdoc}
     */
    public function getById($contactId)
    {
        $contact = $this->contactFactory->create();
        $this->resource->load($contact, $contactId);
        if (!$contact->getId()) {
            throw new NoSuchEntityException(__('Contact with id "%1" does not exist.', $contactId));
        }
        return $contact->getDataModel();
    }

    /**
     * {@inheritdoc}
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $collection = $this->contactCollectionFactory->create();
        
        $this->extensionAttributesJoinProcessor->process(
            $collection,
            \Xigen\ContactToDb\Api\Data\ContactInterface::class
        );
        
        $this->collectionProcessor->process($criteria, $collection);
        
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        
        $items = [];
        foreach ($collection as $model) {
            $items[] = $model->getDataModel();
        }
        
        $searchResults->setItems($items);
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }

    /**
     * {@inheritdoc}
     */
    public function delete(
        \Xigen\ContactToDb\Api\Data\ContactInterface $contact
    ) {
        try {
            $contactModel = $this->contactFactory->create();
            $this->resource->load($contactModel, $contact->getContactId());
            $this->resource->delete($contactModel);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the Contact: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function deleteById($contactId)
    {
        return $this->delete($this->getById($contactId));
    }
}
