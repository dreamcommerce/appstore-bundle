<?php

namespace DreamCommerce\ShopAppstoreBundle\Model;

/**
 * Class Billing
 *
 * billing payment instance
 *
 * @package DreamCommerce\ShopAppstoreBundle\Model
 */
abstract class Billing implements BillingInterface
{
    /**
     * shop this information is bound to
     * @var ShopInterface
     */
    protected $shop;

    /**
     * when event occurred
     * @var \DateTime
     */
    protected $createdAt;

    public function __construct(){
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
    public function getCreatedAt(){
        return $this->createdAt;
    }

}
