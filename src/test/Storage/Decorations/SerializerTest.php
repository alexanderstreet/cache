<?php

namespace Chemisus\Storage\Decorations;

use Chemisus\Serialization\JsonSerializer;
use PHPUnit_Framework_TestCase;

class SerializerTest extends PHPUnit_Framework_TestCase
{
    public function testConstruct()
    {
        $serializer = new JsonSerializer();
        $decoration = new Serialize($serializer);
        self::assertEquals($serializer, $decoration->serializer());
    }

    public function testSerializer()
    {
        $serializer = new JsonSerializer();
        $decoration = new Serialize($serializer);

        $entries = array('a' => 'A', 'b' => 'B');
        $original = $entries;

        $decoration->beforePut($entries);
        self::assertNotEquals($original, $entries);
        self::assertEquals($original['a'], json_decode($entries['a']));
        self::assertEquals($original['b'], json_decode($entries['b']));
        $decoration->afterGet($entries);
        self::assertEquals($original, $entries);
    }
}