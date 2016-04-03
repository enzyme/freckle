<?php

use Enzyme\Freckle\ArrayDotCollection;

class ArrayDotCollectionTest extends PHPUnit_Framework_TestCase
{
    public function test_collection_gets_null_on_non_existent_path()
    {
        $collection = [];
        $dotter = new ArrayDotCollection;
        $expected = null;
        $actual = $dotter->get($collection, 'foo');

        $this->assertEquals($expected, $actual);
    }

    public function test_collection_gets_shallow_path_value()
    {
        $collection = [
            'foo' => 'bar',
        ];
        $dotter = new ArrayDotCollection;
        $expected = 'bar';
        $actual = $dotter->get($collection, 'foo');

        $this->assertEquals($expected, $actual);
    }

    public function test_collection_gets_nested_path_value()
    {
        $collection = [
            'foo' => [
                'bar' => 'acme'
            ],
        ];
        $dotter = new ArrayDotCollection;
        $expected = 'acme';
        $actual = $dotter->get($collection, 'foo.bar');

        $this->assertEquals($expected, $actual);
    }

    public function test_collection_gets_deep_nested_path_value()
    {
        $collection = [
            'foo' => [
                'bar' => [
                    'acme' => [
                        'name' => 'Acme Corp',
                    ]
                ]
            ],
        ];
        $dotter = new ArrayDotCollection;
        $expected = 'Acme Corp';
        $actual = $dotter->get($collection, 'foo.bar.acme.name');

        $this->assertEquals($expected, $actual);
    }

    public function test_collection_gets_nested_path_with_numeric_keys_value()
    {
        $collection = [
            'foo' => [
                'bar' => [
                    ['name' => 'acme'],
                ]
            ],
        ];
        $dotter = new ArrayDotCollection;
        $expected = 'acme';
        $actual = $dotter->get($collection, 'foo.bar.name');

        $this->assertEquals($expected, $actual);
    }
}
