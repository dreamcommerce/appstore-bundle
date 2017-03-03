<?php


namespace DreamCommerce\Bundle\ShopAppstoreBundle\Doctrine;


use Doctrine\ORM\EntityManager;
use DreamCommerce\Bundle\ShopAppstoreBundle\Model\ObjectManagerInterface;

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

    protected function getClassForInterface($arg){

        $class = null;

        if(!isset($this->classMappings[$arg])){
            if(!in_array($arg, array_values($this->classMappings))) {
                throw new \Exception(sprintf('Class %s not exists', $arg));
            }else{
                $class = $arg;
            }
        }else{
            $class = $this->classMappings[$arg];
        }

        return $class;
    }
}