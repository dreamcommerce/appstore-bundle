<?php
/**
 * Created by PhpStorm.
 * User: daniel
 * Date: 18.02.17
 * Time: 17:07
 */

namespace DreamCommerce\ShopAppstoreBundle\Tests\Utils\CollectionWrapper;


use DreamCommerce\ShopAppstoreBundle\Utils\CollectionWrapper\ObjectCollectionWrapper;
use PHPUnit\Framework\TestCase;

class ObjectCollectionWrapperTest extends TestCase
{
    /**
     * @dataProvider listOfFieldDataProvider
     */
    public function testListOfFields($data, $expectedResult)
    {
        $collectionWrapper = new ObjectCollectionWrapper($data);
        $this->assertEquals($collectionWrapper->getListOfField('field'), new \ArrayObject($expectedResult));
    }

    /**
     * @dataProvider invalidObjectDataProvider
     * @expectedException \InvalidArgumentException
     */
    public function testInvalidObjectTest($data)
    {
        $collectionWrapper = new ObjectCollectionWrapper($data);
        $this->assertEquals($collectionWrapper->getListOfField('param'), new \ArrayObject(['someField']));
    }

    public function testGetCollectionArray()
    {
        $dataSet = [
            new SomeObject('1'),
            new SomeObject('1'),
            new SomeObject('2'),
            new SomeObject('3'),
        ];

        $collectionWrapper = new ObjectCollectionWrapper($dataSet);
        $result = $collectionWrapper->getCollectionsArray('field');

        $this->assertArrayHasKey(1, $result);
        $this->assertArrayHasKey(2, $result);
        $this->assertArrayHasKey(3, $result);

        $this->assertCount(2, $result[1]);
        $this->assertCount(1, $result[2]);
        $this->assertCount(1, $result[3]);

        $this->assertContainsOnlyInstancesOf(SomeObject::class, $result[1]);
        $this->assertContainsOnlyInstancesOf(SomeObject::class, $result[2]);
        $this->assertContainsOnlyInstancesOf(SomeObject::class, $result[3]);
    }

    public function listOfFieldDataProvider() {
        return [
            [
                [new SomeObject(1), new SomeObject(2), new SomeObject(3), new SomeObject(4)],
                [1,2,3,4]
            ],
            [
                [new SomeObject('a'), new SomeObject('b'), new SomeObject('c'), new SomeObject('d')],
                ['a', 'b', 'c', 'd']
            ],
            [
                [new SomeObject([]), new SomeObject(null), new SomeObject(true), new SomeObject('')],
                [[], null, true, '']
            ]
        ];
    }

    public function invalidObjectDataProvider()
    {
        return [
            [new SomeObject('a')],
            [['test']],
            [1],
            [false],
            [null]
        ];
    }

}