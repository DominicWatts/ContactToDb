<?php

namespace Xigen\ContactToDb\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface ContactRepositoryInterface
{

    /**
     * Save Contact
     * @param \Xigen\ContactToDb\Api\Data\ContactInterface $contact
     * @throws \Magento\Framework\Exception\LocalizedException
     * @return \Xigen\ContactToDb\Api\Data\ContactInterface
     */
    public function save(
        Data\ContactInterface $contact
    );

    /**
     * Retrieve Contact
     * @param string $contactId
     * @throws \Magento\Framework\Exception\LocalizedException
     * @return \Xigen\ContactToDb\Api\Data\ContactInterface
     */
    public function getById($contactId);

    /**
     * Retrieve Contact matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @throws \Magento\Framework\Exception\LocalizedException
     * @return \Xigen\ContactToDb\Api\Data\ContactSearchResultsInterface
     */
    public function getList(
        SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete Contact
     * @param \Xigen\ContactToDb\Api\Data\ContactInterface $contact
     * @throws \Magento\Framework\Exception\LocalizedException
     * @return bool true on success
     */
    public function delete(
        Data\ContactInterface $contact
    );

    /**
     * Delete Contact by ID
     * @param string $contactId
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     * @return bool true on success
     */
    public function deleteById($contactId);
}
