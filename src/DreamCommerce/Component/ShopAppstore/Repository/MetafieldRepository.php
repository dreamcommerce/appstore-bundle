<?php
namespace DreamCommerce\Component\ShopAppstore\Repository;


use DreamCommerce\Component\ShopAppstore\Model\Shop\Metafield;
use DreamCommerce\Component\ShopAppstore\Model\Shop\MetafieldValue;
use Sylius\Bundle\ResourceBundle\Doctrine\ORM\EntityRepository;

class MetafieldRepository extends EntityRepository
{
    const ALIAS = 'metafield';


    public function getValuesByType(Metafield $metafield, string $type): array
    {
        $metafieldValues = [];

        /** @var MetafieldValue $metafieldValue */
        foreach ($metafield->getMetafieldValues() as $metafieldValue) {
            if ($metafieldValue->getType() === $type) {
                $metafieldValues[] = $metafieldValue;
            }
        }

        return $metafieldValues;
    }


    public function getLastValue(Metafield $metafield, string $type=null)
    {
        $query = $this->createQueryBuilder()
            ->select('metafieldValue')
            ->from(MetafieldValue::class)
            ->andWhere('metafield=:metafield')
            ->setParameter('metafield', $metafield)
            ->orderBy('metafieldValue.id', 'DESC')
            ->setMaxResults(1)
        ;

        if ($type !== null) {
            $query
                ->where('metafieldValue.type=:type')
                ->setParameter('metafieldValue.type', $type)
            ;
        }

        $result = $query
            ->getQuery()
            ->getOneOrNullResult()
        ;

        if (empty($result)) {
            return null;
        }

        return $result;
    }
}