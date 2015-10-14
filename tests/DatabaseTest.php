<?php

namespace League\UrbanDictionary\Test;

use League\UrbanDictionary\Dictionary;
use \ReflectionClass;

class DatabaseTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException Exception
     */
    public function testCreate()
    {
        $slangs = array("Tight");
        $descriptions = array("When someone performs an awesome task");
        $sampleSentences = array("Andrei: Prosper, Have you finished the curriculum?.\nProsper: Yes.\nAndrei: Tight, Tight, Tight!!!");
        Dictionary::clear();
        Dictionary::create($slangs[0], $descriptions[0], $sampleSentences[0]);
        $expected = [["slang"=>strtolower($slangs[0]), "description"=>$descriptions[0], "sample-sentence"=>$sampleSentences[0]]];
        $this->assertEquals($expected, Dictionary::getAll(), "Error: record(s) not properly inserted in the Dictionary.");
        array_push($slangs, "Shit", "Broad", "Baller");
        array_push($descriptions, "Generic word ascribed to anything.", "Attractive young female adult.", "A great and interesting personality.");
        array_push($sampleSentences, "He took all my shit. I saw that shit on tv. Shit is going down. This shit is real.", "That broad believes she's the best thing that happened to the world. You better give that broad what she wants or else.", "Do you want to be a baller, shoot-caller hmm? Shiela is a baller, she's cool at everything she does.");
        for ($i = 1; $i < count($slangs) and count($descriptions) and count($sampleSentences) ; $i++) {
            Dictionary::create($slangs[$i], $descriptions[$i], $sampleSentences[$i]);
        }
        $expected = [
                        ["slang"=>strtolower($slangs[0]), "description"=>$descriptions[0], "sample-sentence"=>$sampleSentences[0]],
                        ["slang"=>strtolower($slangs[1]), "description"=>$descriptions[1], "sample-sentence"=>$sampleSentences[1]],
                        ["slang"=>strtolower($slangs[2]), "description"=>$descriptions[2], "sample-sentence"=>$sampleSentences[2]],
                        ["slang"=>strtolower($slangs[3]), "description"=>$descriptions[3], "sample-sentence"=>$sampleSentences[3]]
                    ];
        Dictionary::create($slangs[0], $descriptions[0], $sampleSentences[0]); # exception
        $this->assertEquals($expected, Dictionary::getAll(), "Error: record(s) not properly inserted in the Dictionary.");
    }

    /**
     * @expectedException Exception
     */
    public function testRead()
    {
        $slangs = array("Tight", "Shit", "Broad", "Baller");
        $descriptions = array("When someone performs an awesome task", "Generic word ascribed to anything.", "Attractive young female adult.", "A great and interesting personality.");
        $sampleSentences = array("Andrei: Prosper, Have you finished the curriculum?.\nProsper: Yes.\nAndrei: Tight, Tight, Tight!!!", "He took all my shit. I saw that shit on tv. Shit is going down. This shit is real.", "That broad believes she's the best thing that happened to the world. You better give that broad what she wants or else.", "Do you want to be a baller, shoot-caller hmm? Shiela is a baller, she's cool at everything she does.");
        Dictionary::clear();
        for ($i = 0; $i < count($slangs) and count($descriptions) and count($sampleSentences); $i++) {
            Dictionary::create($slangs[$i], $descriptions[$i], $sampleSentences[$i]);
        }
        $expected = [
                        ["slang"=>strtolower($slangs[0]), "description"=>$descriptions[0], "sample-sentence"=>$sampleSentences[0]],
                        ["slang"=>strtolower($slangs[1]), "description"=>$descriptions[1], "sample-sentence"=>$sampleSentences[1]],
                        ["slang"=>strtolower($slangs[2]), "description"=>$descriptions[2], "sample-sentence"=>$sampleSentences[2]],
                        ["slang"=>strtolower($slangs[3]), "description"=>$descriptions[3], "sample-sentence"=>$sampleSentences[3]]
                    ];
        for ($i = 0; $i < count($slangs) and count($descriptions) and count($sampleSentences); $i++) {
            $this->assertEquals($expected[$i], Dictionary::read($slangs[$i]), "Error: Did not successfully read data $i");
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

    public function testPreUpdate()
    {
        $slangs = array("Tight", "Shit", "Broad", "Baller");
        $descriptions = array("When someone performs an awesome task", "Generic word ascribed to anything.", "Attractive young female adult.", "A great and interesting personality.");
        $sampleSentences = array("Andrei: Prosper, Have you finished the curriculum?.\nProsper: Yes.\nAndrei: Tight, Tight, Tight!!!", "He took all my shit. I saw that shit on tv. Shit is going down. This shit is real.", "That broad believes she's the best thing that happened to the world. You better give that broad what she wants or else.", "Do you want to be a baller, shoot-caller hmm? Shiela is a baller, she's cool at everything she does.");
        Dictionary::clear();
        for ($i = 0; $i < count($slangs) and count($descriptions) and count($sampleSentences); $i++) {
            Dictionary::create($slangs[$i], $descriptions[$i], $sampleSentences[$i]);
        }
        $expected = [
                        ["slang"=>strtolower($slangs[0]), "description"=>$descriptions[0], "sample-sentence"=>$sampleSentences[0]],
                        ["slang"=>strtolower($slangs[1]), "description"=>$descriptions[1], "sample-sentence"=>$sampleSentences[1]],
                        ["slang"=>strtolower($slangs[2]), "description"=>$descriptions[2], "sample-sentence"=>$sampleSentences[2]],
                        ["slang"=>strtolower($slangs[3]), "description"=>$descriptions[3], "sample-sentence"=>$sampleSentences[3]]
                    ];
        $index = self::getPrivateProperty("League\UrbanDictionary\Dictionary", "index");
        $this->assertEquals(-1, $index->getValue("League\UrbanDictionary\Dictionary"), "Error: Operation not successful.");
        for ($i = 0; $i < count($slangs) and count($descriptions) and count($sampleSentences); $i++) {
            Dictionary::preUpdate($slangs[$i]);
            $this->assertEquals($i, $index->getValue("League\UrbanDictionary\Dictionary"), "Error: Operation not successful.");
        }
        Dictionary::preUpdate("not-included"); #use regex!
        $this->assertEquals(-1, $index->getValue("League\UrbanDictionary\Dictionary"), "Error: Operation not successful.");
    }

    /**
     * @expectedException Exception
     */
    public function testUpdate()
    {
        $slangs = array("Tight", "Sit", "Broad", "Baller");
        $descriptions = array("When awesome task", "Generic word ascribed to anything.", "Attractive young female adult.", "A great and interesting personality.");
        $sampleSentences = array("Andrei: Prosper, Have you finished the curriculum?.\nProsper: Yes.\nAndrei: Tight, Tight, Tight!!!", "He took all my shit. I saw that shit on tv. Shit is going down. This shit is real.", "That broad believes she's the best thing that happened to the world. You better give that broad what she wants or else.", "Do you want to be a baller, shoot-caller hmm? Shiela is a baller, she's cool at everything she does.");
        Dictionary::clear();
        for ($i = 0; $i < count($slangs) and count($descriptions) and count($sampleSentences); $i++) {
            Dictionary::create($slangs[$i], $descriptions[$i], $sampleSentences[$i]);
        }
        $_slang = "Shit";
        $_description = "Generic word ascribed to anything. Can also be use to express suprise.";
        $_sampleSentence = "He took all my shit. I saw that shit on tv. Shit is going down. This shit is real. Shit!!!";
        Dictionary::preUpdate($slangs[1]);
        Dictionary::update($_slang, $_description, $_sampleSentence);
        $expected = ["slang"=>strtolower($_slang), "description"=>$_description, "sample-sentence"=>$_sampleSentence];
        $this->assertEquals($expected, Dictionary::read($_slang));
        $_slang = "Tight";
        $_description = "When someone performs an awesome task";
        $_sampleSentence = "Andrei: Prosper, Have you finished the curriculum?.\nProsper: Yes.\nAndrei: Tight, Tight, Tight!!!";
        Dictionary::preUpdate($slangs[0]);
        Dictionary::update($_slang, $_description, $_sampleSentence);
        $expected = ["slang"=>strtolower($_slang), "description"=>$_description, "sample-sentence"=>$_sampleSentence];
        $this->assertEquals($expected, Dictionary::read($_slang));
        # exception
        Dictionary::preUpdate("not-included");
        Dictionary::update($_slang, $_description, $_sampleSentence);
    }

    /**
     *
     * @expectedException Exception
     */
    public function testDelete()
    {
        $slangs = array("Tight", "Shit", "Broad", "Baller");
        $descriptions = array("When someone performs an awesome task", "Generic word ascribed to anything.", "Attractive young female adult.", "A great and interesting personality.");
        $sampleSentences = array("Andrei: Prosper, Have you finished the curriculum?.\nProsper: Yes.\nAndrei: Tight, Tight, Tight!!!", "He took all my shit. I saw that shit on tv. Shit is going down. This shit is real.", "That broad believes she's the best thing that happened to the world. You better give that broad what she wants or else.", "Do you want to be a baller, shoot-caller hmm? Shiela is a baller, she's cool at everything she does.");
        Dictionary::clear();
        for ($i = 0; $i < count($slangs) and count($descriptions) and count($sampleSentences); $i++) {
            Dictionary::create($slangs[$i], $descriptions[$i], $sampleSentences[$i]);
        }
        Dictionary::delete($slangs[2]);
        $expected = [
                        ["slang"=>strtolower($slangs[0]), "description"=>$descriptions[0], "sample-sentence"=>$sampleSentences[0]],
                        ["slang"=>strtolower($slangs[1]), "description"=>$descriptions[1], "sample-sentence"=>$sampleSentences[1]],
                        ["slang"=>strtolower($slangs[3]), "description"=>$descriptions[3], "sample-sentence"=>$sampleSentences[3]]
                    ];
        $this->assertEquals($expected, Dictionary::getAll(), "Error: delete unsuccessful");
        Dictionary::delete($slangs[3]);
        $expected = [
                        ["slang"=>strtolower($slangs[0]), "description"=>$descriptions[0], "sample-sentence"=>$sampleSentences[0]],
                        ["slang"=>strtolower($slangs[1]), "description"=>$descriptions[1], "sample-sentence"=>$sampleSentences[1]]
                    ];
        $this->assertEquals($expected, Dictionary::getAll(), "Error: delete unsuccessful");
        Dictionary::delete($slangs[3]); #exception
    }

    public function testGetAll()
    {
        $slangs = array("Tight", "Shit", "Broad", "Baller");
        $descriptions = array("When someone performs an awesome task", "Generic word ascribed to anything.", "Attractive young female adult.", "A great and interesting personality.");
        $sampleSentences = array("Andrei: Prosper, Have you finished the curriculum?.\nProsper: Yes.\nAndrei: Tight, Tight, Tight!!!", "He took all my shit. I saw that shit on tv. Shit is going down. This shit is real.", "That broad believes she's the best thing that happened to the world. You better give that broad what she wants or else.", "Do you want to be a baller, shoot-caller hmm? Shiela is a baller, she's cool at everything she does.");
        Dictionary::clear();
        for ($i = 0; $i < count($slangs) and count($descriptions) and count($sampleSentences); $i++) {
            Dictionary::create($slangs[$i], $descriptions[$i], $sampleSentences[$i]);
        }
        $expected = [
                        ["slang"=>strtolower($slangs[0]), "description"=>$descriptions[0], "sample-sentence"=>$sampleSentences[0]],
                        ["slang"=>strtolower($slangs[1]), "description"=>$descriptions[1], "sample-sentence"=>$sampleSentences[1]],
                        ["slang"=>strtolower($slangs[2]), "description"=>$descriptions[2], "sample-sentence"=>$sampleSentences[2]],
                        ["slang"=>strtolower($slangs[3]), "description"=>$descriptions[3], "sample-sentence"=>$sampleSentences[3]]
                    ];
        $this->assertEquals($expected, Dictionary::getAll(), "Error: unsuccessful getting all records.");
    }

    public function testClear()
    {
        $slangs = array("Tight", "Shit", "Broad", "Baller");
        $descriptions = array("When someone performs an awesome task", "Generic word ascribed to anything.", "Attractive young female adult.", "A great and interesting personality.");
        $sampleSentences = array("Andrei: Prosper, Have you finished the curriculum?.\nProsper: Yes.\nAndrei: Tight, Tight, Tight!!!", "He took all my shit. I saw that shit on tv. Shit is going down. This shit is real.", "That broad believes she's the best thing that happened to the world. You better give that broad what she wants or else.", "Do you want to be a baller, shoot-caller hmm? Shiela is a baller, she's cool at everything she does.");
        Dictionary::clear();
        for ($i = 0; $i < count($slangs) and count($descriptions) and count($sampleSentences); $i++) {
            Dictionary::create($slangs[$i], $descriptions[$i], $sampleSentences[$i]);
        }
        $expected = [];
        Dictionary::clear();
        $this->assertEquals($expected, Dictionary::getAll(), "Error: unsuccessful clearing all records.");
    }
}
