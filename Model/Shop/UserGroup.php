<?php

namespace DreamCommerce\ShopAppstoreBundle\Model\Shop;

class UserGroup extends ResourceDependent implements UserGroupInterface
{
    /**
     * @var int
     */
    protected $groupId;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var float
     */
    protected $discount;

    /**
     * @var \ArrayAccess
     */
    protected $users;

    public function __construct()
    {
        $this->users = new \ArrayObject();

        parent::__construct();
    }

    /**
     * @return int
     */
    public function getGroupId()
    {
        return $this->groupId;
    }

    /**
     * @param int $groupId
     * @return $this
     */
    public function setGroupId($groupId)
    {
        $this->groupId = $groupId;
        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return float
     */
    public function getDiscount()
    {
        return $this->discount;
    }

    /**
     * @param float $discount
     * @return $this
     */
    public function setDiscount($discount)
    {
        $this->discount = $discount;
        return $this;
    }

    /**
     * @return \ArrayAccess
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * @param UserInterface $user
     * @return $this
     */
    public function addUser(UserInterface $user)
    {
        $this->users[] = $user;
        return $this;
    }

    /**
     * @param \ArrayAccess $users
     * @return $this
     */
    public function setUsers($users)
    {
        $this->users = $users;
        return $this;
    }

    /**
     * @return string
     */
    public function getResourceClassName()
    {
        return '\\DreamCommerce\\Resource\\Auction';
    }

    /**
     * @return int
     */
    public function getResourceId()
    {
        return $this->groupId;
    }

    /**
     * @param int $id
     * @return $this
     */
    public function setResourceId($id)
    {
        $this->groupId = $id;
        return $this;
    }
}