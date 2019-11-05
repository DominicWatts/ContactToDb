<?php

namespace Xigen\ContactToDb\Controller\Adminhtml\Contact;

/**
 * Delete class
 */
class Delete extends \Xigen\ContactToDb\Controller\Adminhtml\Contact
{
   /**
    * @var \Magento\Framework\View\Result\PageFactory
    */
    private $resultPageFactory;

    /**
     * @var \Xigen\ContactToDb\Model\ContactFactory
     */
    private $contactFactory;
    
    /**
     * Delete constructor.
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Registry $coreRegistry
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     * @param \Xigen\ContactToDb\Model\ContactFactory $contactFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Xigen\ContactToDb\Model\ContactFactory $contactFactory
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->contactFactory = $contactFactory;
        parent::__construct($context, $coreRegistry);
    }

    /**
     * Delete action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        // check if we know what should be deleted
        $id = $this->getRequest()->getParam('contact_id');
        if ($id) {
            try {
                // init model and delete
                $model = $this->contactFactory->create();
                $model->load($id);
                $model->delete();
                // display success message
                $this->messageManager->addSuccessMessage(__('You deleted the Contact.'));
                // go to grid
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                // display error message
                $this->messageManager->addErrorMessage($e->getMessage());
                // go back to edit form
                return $resultRedirect->setPath('*/*/edit', ['contact_id' => $id]);
            }
        }
        // display error message
        $this->messageManager->addErrorMessage(__('We can\'t find a Contact to delete.'));
        // go to grid
        return $resultRedirect->setPath('*/*/');
    }
}
