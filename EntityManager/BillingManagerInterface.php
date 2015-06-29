<?php
/**
 * Created by PhpStorm.
 * User: eRIZ
 * Date: 2015-03-18
 * Time: 17:00
 */
namespace DreamCommerce\ShopAppstoreBundle\EntityManager;


use DreamCommerce\ShopAppstoreBundle\Model\BillingInterface;

interface BillingManagerInterface
{
    public function save(BillingInterface $billingInterface);
}