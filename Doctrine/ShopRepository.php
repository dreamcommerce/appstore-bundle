<?php

namespace DreamCommerce\ShopAppstoreBundle\Doctrine;

use DreamCommerce\ShopAppstoreBundle\Model\ShopInterface;
use DreamCommerce\ShopAppstoreBundle\Model\ShopRepositoryInterface;

class ShopRepository extends RepositoryAbstract implements ShopRepositoryInterface
{
    /**
     * @param string $application
     * @return array
     */
    public function findByApplication($application){
        return $this->findBy([
            'app'=>$application
        ]);
    }

    /**
     * @param string $name
     * @return null|ShopInterface
     */
    public function findOneByName($name)
    {
        return $this->findOneBy([
            'name'=>$name,
        ]);
    }

    /**
     * @param string $name
     * @param string $application
     * @return null|ShopInterface
     */
    public function findOneByNameAndApplication($name, $application)
    {
        return $this->findOneBy([
            'name'=>$name,
            'app'=>$application
        ]);
    }
}