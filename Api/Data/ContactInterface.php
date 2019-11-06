<?php

namespace Xigen\ContactToDb\Api\Data;

interface ContactInterface extends \Magento\Framework\Api\ExtensibleDataInterface
{
    const EMAIL = 'email';
    const NAME = 'name';
    const UPDATED_AT = 'updated_at';
    const CONTACT_ID = 'contact_id';
    const CREATED_AT = 'created_at';
    const TELEPHONE = 'telephone';
    const COMMENT = 'comment';

    /**
     * Get contact_id
     * @return string|null
     */
    public function getContactId();

    /**
     * Set contact_id
     * @param string $contactId
     * @return \Xigen\ContactToDb\Api\Data\ContactInterface
     */
    public function setContactId($contactId);

    /**
     * Get name
     * @return string|null
     */
    public function getName();

    /**
     * Set name
     * @param string $name
     * @return \Xigen\ContactToDb\Api\Data\ContactInterface
     */
    public function setName($name);

    /**
     * Retrieve existing extension attributes object or create a new one.
     * @return \Xigen\ContactToDb\Api\Data\ContactExtensionInterface|null
     */
    public function getExtensionAttributes();

    /**
     * Set an extension attributes object.
     * @param \Xigen\ContactToDb\Api\Data\ContactExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        ContactExtensionInterface $extensionAttributes
    );

    /**
     * Get email
     * @return string|null
     */
    public function getEmail();

    /**
     * Set email
     * @param string $email
     * @return \Xigen\ContactToDb\Api\Data\ContactInterface
     */
    public function setEmail($email);

    /**
     * Get telephone
     * @return string|null
     */
    public function getTelephone();

    /**
     * Set telephone
     * @param string $telephone
     * @return \Xigen\ContactToDb\Api\Data\ContactInterface
     */
    public function setTelephone($telephone);

    /**
     * Get comment
     * @return string|null
     */
    public function getComment();

    /**
     * Set comment
     * @param string $comment
     * @return \Xigen\ContactToDb\Api\Data\ContactInterface
     */
    public function setComment($comment);

    /**
     * Get created_at
     * @return string|null
     */
    public function getCreatedAt();

    /**
     * Set created_at
     * @param string $createdAt
     * @return \Xigen\ContactToDb\Api\Data\ContactInterface
     */
    public function setCreatedAt($createdAt);

    /**
     * Get updated_at
     * @return string|null
     */
    public function getUpdatedAt();

    /**
     * Set updated_at
     * @param string $updatedAt
     * @return \Xigen\ContactToDb\Api\Data\ContactInterface
     */
    public function setUpdatedAt($updatedAt);
}
