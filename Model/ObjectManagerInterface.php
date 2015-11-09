<?php


namespace DreamCommerce\ShopAppstoreBundle\Model;

interface ObjectManagerInterface
{
    public function getRepository($class);
    public function delete($entity);
    public function save($entity, $commit = true);
    public function create($class);
}