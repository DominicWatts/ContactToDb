<?php


namespace Xigen\ContactToDb\Api\Data;

interface ContactInterface extends \Magento\Framework\Api\ExtensibleDataInterface
{

    const EMAIL = 'email';
    const TELEPHONE = 'telephone';
    const NAME = 'name';
    const COMMENT = 'comment';
    const CONTACT_ID = 'contact_id';

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
        \Xigen\ContactToDb\Api\Data\ContactExtensionInterface $extensionAttributes
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
}
