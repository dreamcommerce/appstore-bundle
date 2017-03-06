<?php
namespace DreamCommerce\Component\ShopAppstore\Model;

use Sylius\Component\Resource\Repository\RepositoryInterface;

/**
 * Interface ShopRepositoryInterface
 * @package DreamCommerce\Component\ShopAppstore\Model
 */
interface ShopRepositoryInterface extends RepositoryInterface
{

    /**
     * find shops by application
     * @param string $application
     * @return ShopInterface[]
     */
    public function findByApplication($application);

    /**
     * find shop by its name/ID
     * @param string $name
     * @return ShopInterface
     */
    public function findOneByName($name);

    /**
     * find one shop by name and application
     * @param string $name shop name
     * @param string $application application name
     * @return ShopInterface
     */
    public function findOneByNameAndApplication($name, $application);

}
