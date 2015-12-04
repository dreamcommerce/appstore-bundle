<?php

namespace DreamCommerce\ShopAppstoreBundle\Model\Shop;

use DreamCommerce\ShopAppstoreBundle\Model\ShopDependentInterface;

interface UserAdditionalFieldInterface extends ShopDependentInterface
{
    /**
     * @return UserInterface
     */
    public function getUser();

    /**
     * @param UserInterface $user
     * @return $this
     */
    public function setUser(UserInterface $user);

    /**
     * @return AdditionalFieldInterface
     */
    public function getAdditionalField();

    /**
     * @param AdditionalFieldInterface $additionalField
     * @return $this
     */
    public function setAdditionalField(AdditionalFieldInterface $additionalField);
}