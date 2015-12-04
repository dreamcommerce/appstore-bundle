<?php

namespace DreamCommerce\ShopAppstoreBundle\Model\Shop;

interface UserAddressInterface extends ResourceDependentInterface
{
    /**
     * @return UserInterface
     */
    public function getUser();

    /**
     * @param UserInterface $user
     */
    public function setUser($user);
}