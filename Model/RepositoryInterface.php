<?php
namespace DreamCommerce\ShopAppstoreBundle\Model;

/**
 * Class RepositoryInterface
 *
 * base interface for repositories
 *
 * @package DreamCommerce\ShopAppstoreBundle\Model
 */
interface RepositoryInterface
{
    /**
     * @param $id
     * @return \stdClass
     */
    public function findById($id);
}