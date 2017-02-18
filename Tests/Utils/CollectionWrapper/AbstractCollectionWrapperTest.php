<?php
/**
 * Created by PhpStorm.
 * User: daniel
 * Date: 18.02.17
 * Time: 11:38
 */

namespace DreamCommerce\ShopAppstoreBundle\Tests\Utils\CollectionWrapper;

use DreamCommerce\ShopAppstoreBundle\Utils\CollectionWrapper\ArrayCollectionWrapper;

use PHPUnit\Framework\TestCase;

abstract class AbstractCollectionWrapperTest extends TestCase
{
    /**
     * @expectedException \InvalidArgumentException
     */
    public function testInvalidParameterSetToConstructor()
    {
        new ArrayCollectionWrapper('abc');
    }

    /**
     * @dataProvider getCollectionDataProvider
     */
    public function testGetCollection($data, \ArrayObject $expectedResult) {
        $collectionWrapper = new ArrayCollectionWrapper($data);

        $this->assertEquals($collectionWrapper->getCollection(), $expectedResult);
    }

    /**
     * @dataProvider getArrayDataProvider
     */
    public function testGetArray($data, array $expectedResult) {
        $collectionWrapper = new ArrayCollectionWrapper($data);

        $this->assertEquals($collectionWrapper->getArray(), $expectedResult);
    }

    /**
     * @dataProvider listOfFieldDataProvider
     */
    public function testListOfField(array $data, \ArrayObject $expectedResult)
    {
        $collectionWrapper = new ArrayCollectionWrapper($data);
        $this->assertEquals($collectionWrapper->getListOfField('key'), $expectedResult);

        return;
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testExceptionListOfField() {
        $collectionWrapper = new ArrayCollectionWrapper([['key' => 1], ['no-key' => 2]]);
        $collectionWrapper->getListOfField('key');
    }

    /**
     * @dataProvider appendCollectionDataProvider
     */
    public function testAppendCollection(array $a1,  $a2, $expectedResult)
    {
        $collectionWrapper = new ArrayCollectionWrapper($a1);
        $this->assertEquals($collectionWrapper->appendCollection($a2)->getCollection(), $expectedResult);
    }

    /**
     * @dataProvider collectionsArrayDataProvider
     */
    public function testCollectionsArray(array $data, $expectedResult)
    {
        $collectionWrapper = new ArrayCollectionWrapper($data);
        $this->assertEquals($collectionWrapper->getCollectionsArray('parama'), new \ArrayObject($expectedResult));
    }

    /**
     * @dataProvider collectionsArrayDataProvider
     * @expectedException InvalidArgumentException
     */
    public function testNonExistingKeyInCollectionsArray(array $data, $expectedResult)
    {
        $collectionWrapper = new ArrayCollectionWrapper($data);
        $this->assertEquals($collectionWrapper->getCollectionsArray('some-non-existing-key'), new \ArrayObject($expectedResult));
    }
}