<?php

namespace Xigen\ContactToDb\Model\Data;

use Xigen\ContactToDb\Api\Data\ContactInterface;

/**
 * Contact class
 */
class Contact extends \Magento\Framework\Api\AbstractExtensibleObject implements ContactInterface
{

    /**
     * Get contact_id
     * @return string|null
     */
    public function getContactId()
    {
        return $this->_get(self::CONTACT_ID);
    }

    /**
     * Set contact_id
     * @param string $contactId
     * @return \Xigen\ContactToDb\Api\Data\ContactInterface
     */
    public function setContactId($contactId)
    {
        return $this->setData(self::CONTACT_ID, $contactId);
    }

    /**
     * Get name
     * @return string|null
     */
    public function getName()
    {
        return $this->_get(self::NAME);
    }

    /**
     * Set name
     * @param string $name
     * @return \Xigen\ContactToDb\Api\Data\ContactInterface
     */
    public function setName($name)
    {
        return $this->setData(self::NAME, $name);
    }

    /**
     * Retrieve existing extension attributes object or create a new one.
     * @return \Xigen\ContactToDb\Api\Data\ContactExtensionInterface|null
     */
    public function getExtensionAttributes()
    {
        return $this->_getExtensionAttributes();
    }

    /**
     * Set an extension attributes object.
     * @param \Xigen\ContactToDb\Api\Data\ContactExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        \Xigen\ContactToDb\Api\Data\ContactExtensionInterface $extensionAttributes
    ) {
        return $this->_setExtensionAttributes($extensionAttributes);
    }

    /**
     * Get email
     * @return string|null
     */
    public function getEmail()
    {
        return $this->_get(self::EMAIL);
    }

    /**
     * Set email
     * @param string $email
     * @return \Xigen\ContactToDb\Api\Data\ContactInterface
     */
    public function setEmail($email)
    {
        return $this->setData(self::EMAIL, $email);
    }

    /**
     * Get telephone
     * @return string|null
     */
    public function getTelephone()
    {
        return $this->_get(self::TELEPHONE);
    }

    /**
     * Set telephone
     * @param string $telephone
     * @return \Xigen\ContactToDb\Api\Data\ContactInterface
     */
    public function setTelephone($telephone)
    {
        return $this->setData(self::TELEPHONE, $telephone);
    }

    /**
     * Get comment
     * @return string|null
     */
    public function getComment()
    {
        return $this->_get(self::COMMENT);
    }

    /**
     * Set comment
     * @param string $comment
     * @return \Xigen\ContactToDb\Api\Data\ContactInterface
     */
    public function setComment($comment)
    {
        return $this->setData(self::COMMENT, $comment);
    }

    /**
     * Get created_at
     * @return string|null
     */
    public function getCreatedAt()
    {
        return $this->_get(self::CREATED_AT);
    }

    /**
     * Set created_at
     * @param string $createdAt
     * @return \Xigen\ContactToDb\Api\Data\ContactInterface
     */
    public function setCreatedAt($createdAt)
    {
        return $this->setData(self::CREATED_AT, $createdAt);
    }

    /**
     * Get updated_at
     * @return string|null
     */
    public function getUpdatedAt()
    {
        return $this->_get(self::UPDATED_AT);
    }

    /**
     * Set updated_at
     * @param string $updatedAt
     * @return \Xigen\ContactToDb\Api\Data\ContactInterface
     */
    public function setUpdatedAt($updatedAt)
    {
        return $this->setData(self::UPDATED_AT, $updatedAt);
    }
}
