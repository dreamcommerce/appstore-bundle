<?php


namespace DreamCommerce\Bundle\ShopAppstoreBundle\Doctrine;


use Doctrine\ORM\EntityRepository;
use DreamCommerce\Bundle\ShopAppstoreBundle\Model\RepositoryInterface;

abstract class RepositoryAbstract extends EntityRepository implements RepositoryInterface
{

    /**
     * @inheritdoc
     */
    public function findById($id)
    {
        return $this->findOneBy([
            'id'=>$id
        ]);
    }

}