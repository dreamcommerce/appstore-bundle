<?php
/**
 * Created by PhpStorm.
 * User: eRIZ
 * Date: 2015-03-19
 * Time: 14:31
 */
namespace DreamCommerce\ShopAppstoreBundle\EntityManager;


use DreamCommerce\ShopAppstoreBundle\Model\TokenInterface;

interface TokenManagerInterface
{
    /**
     * @return TokenInterface
     */
    public function create();

    public function save(TokenInterface $token);
}