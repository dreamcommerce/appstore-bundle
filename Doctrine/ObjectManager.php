<?php


namespace DreamCommerce\ShopAppstoreBundle\Doctrine;


use Doctrine\ORM\EntityManager;
use DreamCommerce\ShopAppstoreBundle\Model\ObjectManagerInterface;

class ObjectManager implements ObjectManagerInterface
{
    protected $em;
    /**
     * @var
     */
    protected $classMappings = [];

    public function __construct(EntityManager $em, $classMappings){
        $this->em = $em;
        $this->classMappings = $classMappings;
    }

    public function getRepository($class)
    {
        return $this->em->getRepository(
            $this->getClassForInterface($class)
        );
    }

    public function create($class)
    {
        $name = $this->getClassForInterface($class);
        $class = new $name;
        return $class;
    }

    public function save($entity, $commit = true){
        $this->em->persist($entity);
        $commit && $this->em->flush();
    }

    public function delete($entity){
        $this->em->remove($entity);
        $this->em->flush();
    }

    protected function getClassForInterface($class){
        if(!isset($this->classMappings[$class])){
            throw new \Exception(sprintf('Class %s not exists', $class));
        }

        return $this->classMappings[$class];
    }
}