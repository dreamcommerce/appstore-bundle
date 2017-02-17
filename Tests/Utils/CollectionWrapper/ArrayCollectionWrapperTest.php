<?php
namespace DreamCommerce\ShopAppstoreBundle\Tests\Utils\CollectionWrapper;

use PHPUnit\Framework\TestCase;
use DreamCommerce\ShopAppstoreBundle\Utils\CollectionWrapper\ArrayCollectionWrapper;


Class ArrayCollectionWrapperTest extends TestCase
{
    /**
     * @expectedException \InvalidArgumentException
     */
    public function testInvalidParameterSetToConstructor()
    {
        new ArrayCollectionWrapper('abc');
    }

    public function testGetCollection() {
        $arrayCollectorWrapper = new ArrayCollectionWrapper([1,2,3]);
        $arrayCollectorWrapper2 = new ArrayCollectionWrapper(['a', true, 'b']);
        $arrayCollectorWrapper3 = new ArrayCollectionWrapper(new \ArrayObject([1,2,3]));


        $this->assertEquals($arrayCollectorWrapper->getCollection(), new \ArrayObject([1,2,3]));
        $this->assertEquals($arrayCollectorWrapper2->getCollection(), new \ArrayObject(['a', true, 'b']));
        $this->assertEquals($arrayCollectorWrapper3->getCollection(), new \ArrayObject([1,2,3]));
    }

    public function testGetArray() {
        $arrayCollectorWrapper = new ArrayCollectionWrapper([1,2,3]);
        $arrayCollectorWrapper2 = new ArrayCollectionWrapper(['a', true, 'b']);
        $arrayCollectorWrapper3 = new ArrayCollectionWrapper(new \ArrayObject([1,2,3]));

        $this->assertEquals($arrayCollectorWrapper->getArray(), [1,2,3]);
        $this->assertEquals($arrayCollectorWrapper2->getArray(), ['a', true, 'b']);
        $this->assertEquals($arrayCollectorWrapper3->getArray(), [1,2,3]);
    }


    /**
     * @dataProvider listOfFieldDataProvider
     */
    public function testListOfField(array $data, \ArrayObject $expectedResult)
    {
        $arrayCollectorWrapper = new ArrayCollectionWrapper($data);
        $this->assertEquals($arrayCollectorWrapper->getListOfField('key'), $expectedResult);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testExceptionListOfField() {
        $arrayCollectorWrapper = new ArrayCollectionWrapper([['key' => 1], ['no-key' => 2]]);
        $arrayCollectorWrapper->getListOfField('key');
    }

    /**
     * @dataProvider appendCollectionDataProvider
     */
    public function testAppendCollection(array $a1,  $a2, $expectedResult)
    {
        $arrayCollectorWrapper = new ArrayCollectionWrapper($a1);
        $this->assertEquals($arrayCollectorWrapper->appendCollection($a2)->getCollection(), $expectedResult);
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
}