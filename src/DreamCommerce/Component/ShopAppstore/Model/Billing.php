<?php

namespace DreamCommerce\Component\ShopAppstore\Model;

use Sylius\Component\Resource\Model\ResourceInterface;

/**
 * Class Billing
 *
 * billing payment instance
 *
 * @package DreamCommerce\Component\ShopAppstore\Model
 */
class Billing implements BillingInterface
{
    /**
     * shop this information is bound to
     * @var ShopInterface
     */
    protected $shop;

    /**
     * @var int
     */
    protected $id;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }


    /**
     * when event occurred
     * @var \DateTime
     */
    protected $createdAt;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
    }

    /**
     * @inheritdoc
     */
    public function setShop(ShopInterface $shop)
    {
        $this->shop = $shop;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getShop()
    {
        return $this->shop;
    }

    /**
     * @inheritdoc
     */
    public function getCreatedAt() : \DateTime
    {
        return $this->createdAt;
    }

}
