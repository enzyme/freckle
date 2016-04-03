<?php

use Enzyme\Freckle\Dot;

class DotTest extends PHPUnit_Framework_TestCase
{
    public function test_dot_resolves_array_collection_and_returns_expected_value()
    {
        $dot = new Dot;
        $collection = [
            'foo' => [
                'bar' => 'acme',
            ]
        ];
        $expected = 'acme';
        $actual = $dot->get($collection, 'foo.bar');

        $this->assertEquals($expected, $actual);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function test_dot_throws_exception_on_invalid_collection_type()
    {
        $dot = new Dot;
        $collection = 5;
        $actual = $dot->get($collection, 'foo.bar');
    }
}
