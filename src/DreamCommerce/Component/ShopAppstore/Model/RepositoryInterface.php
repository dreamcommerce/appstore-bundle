<?php
namespace DreamCommerce\Bundle\ShopAppstoreBundle\Model;

/**
 * Class RepositoryInterface
 *
 * base interface for repositories
 *
 * @package DreamCommerce\Bundle\ShopAppstoreBundle\Model
 */
interface RepositoryInterface
{
    /**
     * @param $id
     * @return \stdClass
     */
    public function findById($id);
}