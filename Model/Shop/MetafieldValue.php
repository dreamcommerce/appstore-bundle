<?php
namespace DreamCommerce\Bundle\ShopAppstoreBundle\Model\Shop;


abstract class MetafieldValue implements MetafieldValueInterface
{
    /**
     * @var int
     */
    protected $type;

    /**
     * @var int
     */
    protected $id;

    /**
     * @var \AppBundle\Entity\Metafield
     */
    protected $metafield;

    /**
     * @var int
     */
    protected $externalObjectId;

    /**
     * @return int
     */
    public function getType(): int
    {
        return $this->type;
    }


    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return Metafield
     */
    public function getMetafield(): Metafield
    {
        return $this->metafield;
    }

    /**
     * @param Metafield $metafield
     */
    public function setMetafield(Metafield $metafield)
    {
        $this->metafield = $metafield;
    }

    /**
     * @return int
     */
    public function getExternalObjectId(): int
    {
        return $this->externalObjectId;
    }

    /**
     * @param int $externalObjectId
     */
    public function setExternalObjectId(int $externalObjectId)
    {
        $this->externalObjectId = $externalObjectId;
    }


}
