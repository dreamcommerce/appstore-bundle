<?php
namespace DreamCommerce\Bundle\ShopAppstoreBundle\Tests\Utils\CollectionWrapper;

use DreamCommerce\Bundle\ShopAppstoreBundle\Utils\CollectionWrapper\ArrayCollectionWrapper;
use PHPUnit\Framework\TestCase;


Class ArrayCollectionWrapperTest extends TestCase
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

    public function listOfFieldDataProvider()
    {
        return [
            [
                [['key' => 1, 'field' => 1], ['key' => 2, 'field', 2], ['key' => 3, 'field' => 3]],
                new \ArrayObject([1, 2, 3])
            ],
            [
                [['key' => 'a', 'field' => 6], ['key' => 'b', 'field', 7], ['key' => 'c', 'field' => 3]],
                new \ArrayObject(['a', 'b', 'c'])
            ],
            [
                [['key' => true, 'field' => false], ['key' => [1,2,3], 'field', 2], ['key' => [], 'field' => 3]],
                new \ArrayObject([true, [1,2,3], []])
            ]
        ];
    }

    public function appendCollectionDataProvider()
    {
        return [
            [
                [1,2,3],
                [4,5,6],
                new \ArrayObject([1,2,3,4,5,6])
            ],
            [
                [['key' => 1, 'field' => 1], ['key' => 2, 'field', 2]],
                new \ArrayObject([4,5,6]),
                new \ArrayObject(
                    [ ['key' => 1, 'field' => 1], ['key' => 2, 'field', 2], 4,5,6])
            ],
            [
                [1,true, null],
                [1,false,2],
                new \ArrayObject([1, true, null,1,false,2])
            ]
        ];
    }

    public function getCollectionDataProvider()
    {
        return [
            [[1,2,3], new \ArrayObject([1,2,3])],
            [['a', true, 'b'], new \ArrayObject(['a', true, 'b'])],
            [new \ArrayObject([1,2,3]), new \ArrayObject([1,2,3])]
        ];
    }

    public function getArrayDataProvider() {
        return [
            [[1,2,3], [1,2,3]],
            [['a', true, 'b'], ['a', true, 'b']],
            [new \ArrayObject([1,2,3]), [1,2,3]],
            [['a' => '1', 'b' => 2, 'c' => 3], [1,2,3]]
        ];
    }

    public function collectionsArrayDataProvider() {
        return [
            [
                [
                    ['parama' => 1, 'b' => '1'], ['parama' => 1, 'b' => '2'],
                    ['parama' => 'test', 'b' => '1'], ['parama' => 'test', 'b' => '2'],
                    ['parama' => 3]
                ],
                [
                    1 =>        [['parama' => 1, 'b' => '1'], ['parama' => 1, 'b' => '2']],
                    'test' =>   [['parama' => 'test', 'b' => '1'], ['parama' => 'test', 'b' => '2']],
                    3 =>        [['parama' => '3']]
                ]
            ]
        ];
    }
}