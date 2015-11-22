<?php

namespace Opeyemiabiodun\UrbanDictionary\Test;

use Opeyemiabiodun\UrbanDictionary\Dictionary;

class DictionaryTest extends \PHPUnit_Framework_TestCase
{
    protected $data;

    protected function setUp()
    {
        $this->data = [
                            [
                                'slang' => 'tight',
                                'description' => 'When someone performs an awesome task',
                                'sample-sentence' => "Andrei: Prosper, Have you finished the curriculum?.\nProsper: Yes.\nAndrei: Tight, Tight, Tight!!!",
                            ],
                        ];
        Dictionary::getInstance()->clear();
        Dictionary::getInstance()->add('Tight', 'When someone performs an awesome task', "Andrei: Prosper, Have you finished the curriculum?.\nProsper: Yes.\nAndrei: Tight, Tight, Tight!!!");
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testAdd()
    {
        $this->assertTrue(Dictionary::getInstance()->add('Baller', 'A great and interesting personality.', "Do you want to be a baller, shoot-caller hmm? Shiela is a baller, she's cool at everything she does."));
        Dictionary::getInstance()->add('Tight', 'When someone performs an awesome task', "Andrei: Prosper, Have you finished the curriculum?.\nProsper: Yes.\nAndrei: Tight, Tight, Tight!!!"); #InvalidArgumentexception
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testRead()
    {
        $this->assertEquals($this->data[0], Dictionary::getInstance()->read('Tight'));
        Dictionary::getInstance()->read('not-included'); #InvalidArgumentException
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testSelect()
    {
        $this->assertTrue(Dictionary::getInstance()->select('Tight'));
        Dictionary::getInstance()->select('not-included'); #InvalidArgumentException
    }

    public function testUpdate()
    {
        Dictionary::getInstance()->select('Tight');
        $this->assertTrue(Dictionary::getInstance()->update('Shit', 'Generic word ascribed to anything. Can also be use to express suprise.', 'He took all my shit. I saw that shit on tv. Shit is going down. This shit is real. Shit!!!'));
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testDelete()
    {
        $this->assertTrue(Dictionary::getInstance()->delete('Tight'));
        Dictionary::getInstance()->delete('Tight'); #InvalidArgumentException
    }

    public function testGetAll()
    {
        $this->assertEquals($this->data, Dictionary::getInstance()->getAll(), 'Error: unsuccessful getting all records.');
    }

    public function testClear()
    {
        Dictionary::getInstance()->clear();
        $this->assertEquals([], Dictionary::getInstance()->getAll(), 'Error: unsuccessful clearing all records.');
    }
}
