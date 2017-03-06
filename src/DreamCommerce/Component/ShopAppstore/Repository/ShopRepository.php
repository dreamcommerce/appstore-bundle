<?php
namespace DreamCommerce\Component\ShopAppstore\Repository;


use DreamCommerce\Component\ShopAppstore\Model\ShopRepositoryInterface;
use Sylius\Bundle\ResourceBundle\Doctrine\ORM\EntityRepository;

class ShopRepository extends EntityRepository implements ShopRepositoryInterface
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