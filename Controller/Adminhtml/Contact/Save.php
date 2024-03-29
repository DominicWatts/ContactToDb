<?php

namespace Xigen\ContactToDb\Controller\Adminhtml\Contact;

use Magento\Framework\Exception\LocalizedException;

/**
 * Save class
 */
class Save extends \Magento\Backend\App\Action
{
    /**
     * @var \Magento\Framework\App\Request\DataPersistorInterface
     */
    protected $dataPersistor;

    /**
     * @var \Xigen\ContactToDb\Model\ContactFactory
     */
    private $contactFactory;

    /**
     * Save constructor.
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\App\Request\DataPersistorInterface $dataPersistor
     * @param \Xigen\ContactToDb\Model\ContactFactory $contactFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\App\Request\DataPersistorInterface $dataPersistor,
        \Xigen\ContactToDb\Model\ContactFactory $contactFactory
    ) {
        $this->dataPersistor = $dataPersistor;
        $this->contactFactory = $contactFactory;
        parent::__construct($context);
    }

    /**
     * Save action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();
        if ($data) {
            $id = $this->getRequest()->getParam('contact_id');
        
            $model = $this->contactFactory->create();
            if (!$model->getId() && $id) {
                $this->messageManager->addErrorMessage(__('This Contact no longer exists.'));
                return $resultRedirect->setPath('*/*/');
            }
        
            $model->setData($data);
        
            try {
                $model->save();
                $this->messageManager->addSuccessMessage(__('You saved the Contact.'));
                $this->dataPersistor->clear('xigen_contacttodb_contact');
        
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['contact_id' => $model->getId()]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the Contact.'));
            }
        
            $this->dataPersistor->set('xigen_contacttodb_contact', $data);
            return $resultRedirect->setPath('*/*/edit', ['contact_id' => $id]);
        }
        return $resultRedirect->setPath('*/*/');
    }
}
