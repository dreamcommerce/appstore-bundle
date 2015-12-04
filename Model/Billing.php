<?php

namespace DreamCommerce\ShopAppstoreBundle\Model;

/**
 * Class Billing
 *
 * billing payment instance
 *
 * @package DreamCommerce\ShopAppstoreBundle\Model
 */
abstract class Billing extends ShopDependent implements BillingInterface
{
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
    public function getCreatedAt(){
        return $this->createdAt;
    }

}
