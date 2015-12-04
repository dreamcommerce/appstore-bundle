<?php

namespace DreamCommerce\ShopAppstoreBundle\Model\Shop;

interface UserGroupInterface extends ResourceDependentInterface
{
    /**
     * @return \ArrayAccess
     */
    public function getUsers();

    /**
     * @param UserInterface $user
     * @return $this
     */
    public function addUser(UserInterface $user);

    /**
     * @param \ArrayAccess $users
     * @return $this
     */
    public function setUsers($users);
}