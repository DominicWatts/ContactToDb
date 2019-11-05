<?php

namespace Xigen\ContactToDb\Controller\Adminhtml\Contact;

/**
 * InlineEdit class
 */
class InlineEdit extends \Magento\Backend\App\Action
{
    /**
     * @var \Magento\Framework\Controller\Result\JsonFactory
     */
    protected $jsonFactory;

    /**
     * @var \Xigen\ContactToDb\Model\ContactFactory
     */
    private $contactFactory;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Controller\Result\JsonFactory $jsonFactory
     * @param \Xigen\ContactToDb\Model\ContactFactory $contactFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Controller\Result\JsonFactory $jsonFactory,
        \Xigen\ContactToDb\Model\ContactFactory $contactFactory
    ) {
        parent::__construct($context);
        $this->jsonFactory = $jsonFactory;
        $this->contactFactory = $contactFactory;
    }

    /**
     * Inline edit action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Framework\Controller\Result\Json $resultJson */
        $resultJson = $this->jsonFactory->create();
        $error = false;
        $messages = [];
        
        if ($this->getRequest()->getParam('isAjax')) {
            $postItems = $this->getRequest()->getParam('items', []);
            if (!count($postItems)) {
                $messages[] = __('Please correct the data sent.');
                $error = true;
            } else {
                foreach (array_keys($postItems) as $modelId) {
                    /** @var \Xigen\ContactToDb\Model\Contact $model */
                    $model = $this->contactFactory->create();
                    try {
                        $model->setData($postItems[$modelId] + $model->getData());
                        $model->save();
                    } catch (\Exception $e) {
                        $messages[] = "[Contact ID: {$modelId}]  {$e->getMessage()}";
                        $error = true;
                    }
                }
            }
        }
        
        return $resultJson->setData([
            'messages' => $messages,
            'error' => $error
        ]);
    }
}
