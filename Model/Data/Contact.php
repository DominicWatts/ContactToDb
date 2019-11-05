<?php

namespace Xigen\ContactToDb\Model\Data;

use Xigen\ContactToDb\Api\Data\ContactInterface;

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
}
