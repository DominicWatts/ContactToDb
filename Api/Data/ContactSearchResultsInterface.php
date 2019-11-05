<?php


namespace Xigen\ContactToDb\Api\Data;

interface ContactSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{

    /**
     * Get Contact list.
     * @return \Xigen\ContactToDb\Api\Data\ContactInterface[]
     */
    public function getItems();

    /**
     * Set name list.
     * @param \Xigen\ContactToDb\Api\Data\ContactInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
