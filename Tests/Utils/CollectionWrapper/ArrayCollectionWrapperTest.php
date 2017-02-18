<?php
namespace DreamCommerce\ShopAppstoreBundle\Tests\Utils\CollectionWrapper;

use DreamCommerce\ShopAppstoreBundle\Utils\CollectionWrapper\ArrayCollectionWrapper;


Class ArrayCollectionWrapperTest extends AbstractCollectionWrapperTest
{
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