<?php

namespace Xigen\ContactToDb\Plugin\Magento\Contact\Controller\Index;

/**
 * Post class
 */
class Post
{
    /**
     * @var \Xigen\ContactToDb\Api\Data\ContactInterfaceFactory
     */
    private $contactInterfaceFactory;

    /**
     * @var \Xigen\ContactToDb\Api\ContactRepositoryInterface
     */
    private $contactRepositoryInterface;

    /**
     * @var \Psr\Log\LoggerInterface
     */
    private $logger;

    /**
     * Post constructor.
     * @param \Xigen\ContactToDb\Api\Data\ContactInterfaceFactory $contactInterfaceFactory
     * @param \Xigen\ContactToDb\Api\ContactRepositoryInterface $contactRepositoryInterface
     * @param \Psr\Log\LoggerInterface $logger
     */
    public function __construct(
        \Xigen\ContactToDb\Api\Data\ContactInterfaceFactory $contactInterfaceFactory,
        \Xigen\ContactToDb\Api\ContactRepositoryInterface $contactRepositoryInterface,
        \Psr\Log\LoggerInterface $logger
    ) {
        $this->contactInterfaceFactory = $contactInterfaceFactory;
        $this->contactRepositoryInterface = $contactRepositoryInterface;
        $this->logger = $logger;
    }

    /**
     * afterExecute method
     * @param \Magento\Contact\Controller\Index\Post $subject
     * @param \Magento\Framework\Controller\Result\Redirect\Interceptor $result
     * @return \Magento\Framework\Controller\Result\Redirect\Interceptor
     * @throws \Exception
     */
    public function afterExecute(
        \Magento\Contact\Controller\Index\Post $subject,
        $result
    ) {

        if ($request = $subject->getRequest()) {

            if (!$this->validatedParams($request)) {
                return $result;
            }

            $post = $request->getPostValue();

            $contact = $this->contactInterfaceFactory
                ->create()
                ->setName($post['name'] ?: null)
                ->setEmail($post['email'] ?: null)
                ->setTelephone($post['telephone'] ?: null)
                ->setComment($post['comment'] ?: null);

            try {
                $product = $this->contactRepositoryInterface->save($contact);
            } catch (\Exception $e) {
                $this->logger->critical($e);
            }

        }

        return $result;
    }

    /**
     * Server side validation - only store valid data
     * @param Magento\Framework\App\Request\Http $request
     * @return array
     * @throws \Exception
     */
    private function validatedParams($request)
    {
        if (trim($request->getParam('name')) === '') {
            return false;
        }
        if (trim($request->getParam('comment')) === '') {
            return false;
        }
        if (false === \strpos($request->getParam('email'), '@')) {
            return false;
        }
        if (trim($request->getParam('hideit')) !== '') {
            return false;
        }
        return true;
    }
}
