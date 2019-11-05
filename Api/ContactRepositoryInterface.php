<?php


namespace Xigen\ContactToDb\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface ContactRepositoryInterface
{

    /**
     * Save Contact
     * @param \Xigen\ContactToDb\Api\Data\ContactInterface $contact
     * @return \Xigen\ContactToDb\Api\Data\ContactInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        \Xigen\ContactToDb\Api\Data\ContactInterface $contact
    );

    /**
     * Retrieve Contact
     * @param string $contactId
     * @return \Xigen\ContactToDb\Api\Data\ContactInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($contactId);

    /**
     * Retrieve Contact matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Xigen\ContactToDb\Api\Data\ContactSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete Contact
     * @param \Xigen\ContactToDb\Api\Data\ContactInterface $contact
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \Xigen\ContactToDb\Api\Data\ContactInterface $contact
    );

    /**
     * Delete Contact by ID
     * @param string $contactId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($contactId);
}
