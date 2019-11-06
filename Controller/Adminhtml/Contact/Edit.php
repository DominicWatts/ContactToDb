<?php

namespace Xigen\ContactToDb\Controller\Adminhtml\Contact;

/**
 * Edit class
 */
class Edit extends \Xigen\ContactToDb\Controller\Adminhtml\Contact
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory;

    /**
     * @var \Xigen\ContactToDb\Model\ContactFactory
     */
    private $contactFactory;

    /**
     * Edit constructor.
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
     * Edit action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        // 1. Get ID and create model
        $id = $this->getRequest()->getParam('contact_id');
        $model = $this->contactFactory->create();
        
        // 2. Initial checking
        if ($id) {
            $model->load($id);
            if (!$model->getId()) {
                $this->messageManager->addErrorMessage(__('This Contact no longer exists.'));
                /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/*/');
            }
        }
        $this->_coreRegistry->register('xigen_contacttodb_contact', $model);
        
        // 3. Build edit form
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $this->initPage($resultPage)->addBreadcrumb(
            $id ? __('Edit Contact') : __('New Site Contact'),
            $id ? __('Edit Contact') : __('New Site Contact')
        );
        $resultPage->getConfig()->getTitle()->prepend(__('Contacts'));
        $resultPage->getConfig()->getTitle()->prepend($model->getId() ? __('Edit Contact %1', $model->getId()) : __('New Contact'));
        return $resultPage;
    }
}
