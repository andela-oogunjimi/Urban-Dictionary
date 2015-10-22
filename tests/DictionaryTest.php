<?php

namespace League\UrbanDictionary\Test;

use League\UrbanDictionary\Dictionary;
use ReflectionClass;

class DictionaryTest extends \PHPUnit_Framework_TestCase
{
    protected $slangs;

    protected $descriptions;

    protected $sampleSentences;

    protected $expected;

    protected function setUp()
    {
        $this->slangs = array("Tight", "Shit", "Broad", "Baller");
        $this->descriptions = array("When someone performs an awesome task", "Generic word ascribed to anything.", "Attractive young female adult.", "A great and interesting personality.");
        $this->sampleSentences = array("Andrei: Prosper, Have you finished the curriculum?.\nProsper: Yes.\nAndrei: Tight, Tight, Tight!!!", "He took all my shit. I saw that shit on tv. Shit is going down. This shit is real.", "That broad believes she's the best thing that happened to the world. You better give that broad what she wants or else.", "Do you want to be a baller, shoot-caller hmm? Shiela is a baller, she's cool at everything she does.");
        $this->expected = [
                        ["slang"=>strtolower($this->slangs[0]), "description"=>$this->descriptions[0], "sample-sentence"=>$this->sampleSentences[0]],
                        ["slang"=>strtolower($this->slangs[1]), "description"=>$this->descriptions[1], "sample-sentence"=>$this->sampleSentences[1]],
                        ["slang"=>strtolower($this->slangs[2]), "description"=>$this->descriptions[2], "sample-sentence"=>$this->sampleSentences[2]],
                        ["slang"=>strtolower($this->slangs[3]), "description"=>$this->descriptions[3], "sample-sentence"=>$this->sampleSentences[3]]
                    ];
        Dictionary::clear();
        for ($i = 0; $i < count($this->slangs) and count($this->descriptions) and count($this->sampleSentences); $i++) {
            Dictionary::create($this->slangs[$i], $this->descriptions[$i], $this->sampleSentences[$i]);
        }
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testCreate()
    {
        $this->assertEquals($this->expected, Dictionary::getAll(), "Error: record(s) not properly inserted in the Dictionary.");
        Dictionary::create($this->slangs[0], $this->descriptions[0], $this->sampleSentences[0]); # InvalidArgumentexception
        $this->assertEquals($this->expected, Dictionary::getAll(), "Error: record(s) not properly inserted in the Dictionary.");
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testRead()
    {
        for ($i = 0; $i < count($this->slangs) and count($this->descriptions) and count($this->sampleSentences); $i++) {
            $this->assertEquals($this->expected[$i], Dictionary::read($this->slangs[$i]), "Error: Did not successfully read data $i");
        }
        Dictionary::read("not-included"); #exception
    }

    private static function getPrivateProperty($obj, $name)
    {
        $class = new ReflectionClass($obj);
        $property = $class->getProperty($name);
        $property->setAccessible(true);
        return $property;
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testSelect()
    {
        $index = self::getPrivateProperty("League\UrbanDictionary\Dictionary", "index");
        $this->assertEquals(-1, $index->getValue("League\UrbanDictionary\Dictionary"), "Error: Operation not successful.");
        for ($i = 0; $i < count($this->slangs) and count($this->descriptions) and count($this->sampleSentences); $i++) {
            Dictionary::select($this->slangs[$i]);
            $this->assertEquals($i, $index->getValue("League\UrbanDictionary\Dictionary"), "Error: Operation not successful.");
        }
        Dictionary::select("not-included"); #use regex!
        $this->assertEquals(-1, $index->getValue("League\UrbanDictionary\Dictionary"), "Error: Operation not successful.");
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testUpdate()
    {
        $_slang = "Shit";
        $_description = "Generic word ascribed to anything. Can also be use to express suprise.";
        $_sampleSentence = "He took all my shit. I saw that shit on tv. Shit is going down. This shit is real. Shit!!!";
        Dictionary::select($this->slangs[1]);
        Dictionary::update($_slang, $_description, $_sampleSentence);
        $this->expected = ["slang"=>strtolower($_slang), "description"=>$_description, "sample-sentence"=>$_sampleSentence];
        $this->assertEquals($this->expected, Dictionary::read($_slang));
        $_slang = "Tight";
        $_description = "When someone performs an awesome task";
        $_sampleSentence = "Andrei: Prosper, Have you finished the curriculum?.\nProsper: Yes.\nAndrei: Tight, Tight, Tight!!!";
        Dictionary::select($this->slangs[0]);
        Dictionary::update($_slang, $_description, $_sampleSentence);
        $this->expected = ["slang"=>strtolower($_slang), "description"=>$_description, "sample-sentence"=>$_sampleSentence];
        $this->assertEquals($this->expected, Dictionary::read($_slang));
        # InvalidArgumentexception
        Dictionary::select("not-included");
        Dictionary::update($_slang, $_description, $_sampleSentence);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testDelete()
    {
        Dictionary::delete($this->slangs[2]);
        $this->expected = [
                        ["slang"=>strtolower($this->slangs[0]), "description"=>$this->descriptions[0], "sample-sentence"=>$this->sampleSentences[0]],
                        ["slang"=>strtolower($this->slangs[1]), "description"=>$this->descriptions[1], "sample-sentence"=>$this->sampleSentences[1]],
                        ["slang"=>strtolower($this->slangs[3]), "description"=>$this->descriptions[3], "sample-sentence"=>$this->sampleSentences[3]]
                    ];
        $this->assertEquals($this->expected, Dictionary::getAll(), "Error: delete unsuccessful");
        Dictionary::delete($this->slangs[3]);
        $this->expected = [
                        ["slang"=>strtolower($this->slangs[0]), "description"=>$this->descriptions[0], "sample-sentence"=>$this->sampleSentences[0]],
                        ["slang"=>strtolower($this->slangs[1]), "description"=>$this->descriptions[1], "sample-sentence"=>$this->sampleSentences[1]]
                    ];
        $this->assertEquals($this->expected, Dictionary::getAll(), "Error: delete unsuccessful");
        Dictionary::delete($this->slangs[3]); #exception
    }

    public function testGetAll()
    {
        $this->assertEquals($this->expected, Dictionary::getAll(), "Error: unsuccessful getting all records.");
    }

    public function testClear()
    {
        $this->expected = [];
        Dictionary::clear();
        $this->assertEquals($this->expected, Dictionary::getAll(), "Error: unsuccessful clearing all records.");
    }
}
