<?php


namespace DreamCommerce\Bundle\ShopAppstoreBundle\Doctrine;


use Doctrine\ORM\EntityRepository;
use DreamCommerce\Component\ShopAppstore\Model\ShopRepositoryInterface;

class ShopRepository extends RepositoryAbstract implements ShopRepositoryInterface
{

    public function findByApplication($application){
        return $this->findBy([
            'app'=>$application
        ]);
    }

    public function findOneByName($name)
    {
        return $this->findOneBy([
            'name'=>$name,
        ]);

    }

    public function findOneByNameAndApplication($name, $application)
    {
        return $this->findOneBy([
            'name'=>$name,
            'app'=>$application
        ]);
    }
}