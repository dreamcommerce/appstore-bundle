<?php

namespace DreamCommerce\ShopAppstoreBundle\Model\Shop;

use DreamCommerce\ShopAppstoreBundle\Model\ShopDependent;

abstract class ResourceDependent extends ShopDependent implements ResourceDependentInterface
{
    /**
     * @return string
     */
    public function getResourceClassName()
    {
        throw new \RuntimeException('Not implemented yet!');
    }

    /**
     * @param int $id
     * @return $this
     */
    public function setResourceId($id)
    {
        throw new \RuntimeException('Not implemented yet!');
    }

    /**
     * @return int
     */
    public function getResourceId()
    {
        throw new \RuntimeException('Not implemented yet!');
    }

    /**
     * @return \DateTime|null
     * @throws \RuntimeException
     */
    public function getCreationDate()
    {
        throw new \RuntimeException('Not implemented yet!');
    }

    /**
     * @param \DateTime|null $creationDate
     * @return $this
     */
    public function setCreationDate($creationDate)
    {
        throw new \RuntimeException('Not implemented yet!');
    }

    /**
     * @return \DateTime|null
     */
    public function getModificationDate()
    {
        throw new \RuntimeException('Not implemented yet!');
    }

    /**
     * @param \DateTime|null $modificationDate
     * @return $this
     */
    public function setModificationDate($modificationDate)
    {
        throw new \RuntimeException('Not implemented yet!');
    }
}