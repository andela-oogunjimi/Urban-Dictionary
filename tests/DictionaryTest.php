<?php

namespace League\UrbanDictionary\Test;

use League\UrbanDictionary\Dictionary;
use ReflectionClass;

class DictionaryTest extends \PHPUnit_Framework_TestCase
{

    protected function setUp()
    {
        Dictionary::add("Tight", "When someone performs an awesome task", "Andrei: Prosper, Have you finished the curriculum?.\nProsper: Yes.\nAndrei: Tight, Tight, Tight!!!");
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testAdd()
    {
        $this->assertTrue(Dictionary::add("Baller", "A great and interesting personality.", "Do you want to be a baller, shoot-caller hmm? Shiela is a baller, she's cool at everything she does."));
        Dictionary::add("Tight", "When someone performs an awesome task", "Andrei: Prosper, Have you finished the curriculum?.\nProsper: Yes.\nAndrei: Tight, Tight, Tight!!!"); #InvalidArgumentexception
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testRead()
    {
        $expected = [
                        "slang" => "tight",
                        "description" => "When someone performs an awesome task",
                        "sample-sentence" => "Andrei: Prosper, Have you finished the curriculum?.\nProsper: Yes.\nAndrei: Tight, Tight, Tight!!!"
                    ];
        $this->assertEquals($expected, Dictionary::read("Tight"));
        Dictionary::read("not-included"); #InvalidArgumentException
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testSelect()
    {
        assertType("League\UrbanDictionary\Dictionary", Dictionary::select("Tight"));
        Dictionary::select("not-included"); #InvalidArgumentException
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testUpdate()
    {
        $this->assertTrue(Dictionary::select("Tight")->update("Shit", "Generic word ascribed to anything. Can also be use to express suprise.", "He took all my shit. I saw that shit on tv. Shit is going down. This shit is real. Shit!!!"));
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testDelete()
    {
        $this->assertTrue(Dictionary::delete("Tight"));
        Dictionary::delete("Tight"); #InvalidArgumentException
    }

    public function testGetAll()
    {
        $expected = [
                        [
                            "slang" => "tight",
                            "description" => "When someone performs an awesome task",
                            "sample-sentence" => "Andrei: Prosper, Have you finished the curriculum?.\nProsper: Yes.\nAndrei: Tight, Tight, Tight!!!"
                        ]
                    ];
        $this->assertEquals($expected, Dictionary::getAll(), 'Error: unsuccessful getting all records.');
    }

    public function testClear()
    {
        Dictionary::clear();
        $this->assertEquals([], Dictionary::getAll(), 'Error: unsuccessful clearing all records.');
    }
}
