<?php

namespace DreamCommerce\ShopAppstoreBundle\Model\Shop;

interface UserInterface extends LanguageDependentInterface, ResourceDependentInterface
{
    /**
     * @return \ArrayAccess
     */
    public function getGroups();

    /**
     * @param UserGroupInterface $group
     * @return $this
     */
    public function addGroup(UserGroupInterface $group);

    /**
     * @param \ArrayAccess $groups
     * @return $this
     */
    public function setGroups($groups);

    /**
     * @return \ArrayAccess
     */
    public function getAddresses();

    /**
     * @param UserAddressInterface $address
     * @return $this
     */
    public function addAddress(UserAddressInterface $address);

    /**
     * @param \ArrayAccess $addresses
     * @return $this
     */
    public function setAddresses($addresses);

    /**
     * @return \ArrayAccess
     */
    public function getAdditionalFields();

    /**
     * @param UserAdditionalFieldInterface $additionalField
     * @return $this
     */
    public function addAdditionalField(UserAdditionalFieldInterface $additionalField);

    /**
     * @param \ArrayAccess $additionalFields
     * @return $this
     */
    public function setAdditionalFields($additionalFields);
}