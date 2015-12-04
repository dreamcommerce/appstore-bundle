<?php

namespace DreamCommerce\ShopAppstoreBundle\Model\Shop;

use DreamCommerce\ShopAppstoreBundle\Model\ShopDependentInterface;

interface ResourceDependentInterface extends ShopDependentInterface
{
    /**
     * @return string
     */
    public function getResourceClassName();

    /**
     * @param int $id
     * @return $this
     */
    public function setResourceId($id);

    /**
     * @return int
     */
    public function getResourceId();

    /**
     * @return \DateTime|null
     */
    public function getCreationDate();

    /**
     * @param \DateTime|null $creationDate
     * @return $this
     */
    public function setCreationDate($creationDate);

    /**
     * @return \DateTime|null
     */
    public function getModificationDate();

    /**
     * @param \DateTime|null $modificationDate
     * @return $this
     */
    public function setModificationDate($modificationDate);

}