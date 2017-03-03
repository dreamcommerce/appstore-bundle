<?php
namespace DreamCommerce\Component\ShopAppstore\Model;

/**
 * Class RepositoryInterface
 *
 * base interface for repositories
 *
 * @package DreamCommerce\Component\ShopAppstore\Model
 */
interface RepositoryInterface
{
    /**
     * @param $id
     * @return \stdClass
     */
    public function findById($id);
}