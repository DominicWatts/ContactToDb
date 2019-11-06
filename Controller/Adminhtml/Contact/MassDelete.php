<?php

namespace Xigen\ContactToDb\Controller\Adminhtml\Contact;

/**
 * Mass-Delete Controller.
 */
class MassDelete extends \Magento\Backend\App\Action
{
    const ADMIN_RESOURCE = 'Xigen_ContactToDb::top_level';

    /**
     * @var \Magento\Ui\Component\MassAction\Filter
     */
    private $filter;

    /**
     * @var \Xigen\ContactToDb\Model\ContactFactory
     */
    private $contactFactory;

    /**
     * massDelete constructor
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Ui\Component\MassAction\Filter $filter
     * @param \Xigen\ContactToDb\Model\ResourceModel\Contact\CollectionFactory $collectionFactory
     * @param \Xigen\ContactToDb\Model\ContactFactory $contactFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Ui\Component\MassAction\Filter $filter,
        \Xigen\ContactToDb\Model\ResourceModel\Contact\CollectionFactory $collectionFactory,
        \Xigen\ContactToDb\Model\ContactFactory $contactFactory
    ) {
        $this->filter = $filter;
        $this->contactFactory = $contactFactory;
        parent::__construct($context);
    }

    /**
     * Execute action.
     * @return \Magento\Backend\Model\View\Result\Redirect
     * @throws \Magento\Framework\Exception\LocalizedException|\Exception
     */
    public function execute()
    {
        $ids = $this->getRequest()->getPost('selected');
        if ($ids) {
            $collection = $this->contactFactory->create()
                ->getCollection()
                ->addFieldToFilter('contact_id', ['in' => $ids]);
            $collectionSize = $collection->getSize();
            $deletedItems = 0;
            foreach ($collection as $item) {
                try {
                    $item->delete();
                    $deletedItems++;
                } catch (\Exception $e) {
                    $this->messageManager->addErrorMessage($e->getMessage());
                }
            }
            if ($deletedItems != 0) {
                if ($collectionSize != $deletedItems) {
                    $this->messageManager->addErrorMessage(
                        __('Failed to delete %1 contact item(s).', $collectionSize - $deletedItems)
                    );
                }
                $this->messageManager->addSuccessMessage(
                    __('A total of %1 contact item(s) have been deleted.', $deletedItems)
                );
            }
        }
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultFactory->create(\Magento\Framework\Controller\ResultFactory::TYPE_REDIRECT);
        return $resultRedirect->setPath('*/*/');
    }
}
