<?php

namespace League\UrbanDictionary\Test;

use League\UrbanDictionary\Database;
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
        Database::clear();
        Database::create($slangs[0], $descriptions[0], $sampleSentences[0]);
        $expected = [["slang"=>strtolower($slangs[0]), "description"=>$descriptions[0], "sample-sentence"=>$sampleSentences[0]]];
        $this->assertEquals($expected, Database::getAll(), "Error: record(s) not properly inserted in the Database.");
        array_push($slangs, "Shit", "Broad", "Baller");
        array_push($descriptions, "Generic word ascribed to anything.", "Attractive young female adult.", "A great and interesting personality.");
        array_push($sampleSentences, "He took all my shit. I saw that shit on tv. Shit is going down. This shit is real.", "That broad believes she's the best thing that happened to the world. You better give that broad what she wants or else.", "Do you want to be a baller, shoot-caller hmm? Shiela is a baller, she's cool at everything she does.");
        for ($i = 1; $i < count($slangs) and count($descriptions) and count($sampleSentences) ; $i++) {
            Database::create($slangs[$i], $descriptions[$i], $sampleSentences[$i]);
        }
        $expected = [
                        ["slang"=>strtolower($slangs[0]), "description"=>$descriptions[0], "sample-sentence"=>$sampleSentences[0]],
                        ["slang"=>strtolower($slangs[1]), "description"=>$descriptions[1], "sample-sentence"=>$sampleSentences[1]],
                        ["slang"=>strtolower($slangs[2]), "description"=>$descriptions[2], "sample-sentence"=>$sampleSentences[2]],
                        ["slang"=>strtolower($slangs[3]), "description"=>$descriptions[3], "sample-sentence"=>$sampleSentences[3]]
                    ];
        Database::create($slangs[0], $descriptions[0], $sampleSentences[0]); # exception
        $this->assertEquals($expected, Database::getAll(), "Error: record(s) not properly inserted in the Database.");
    }

    /**
     * @expectedException Exception
     */
    public function testRead()
    {
        $slangs = array("Tight", "Shit", "Broad", "Baller");
        $descriptions = array("When someone performs an awesome task", "Generic word ascribed to anything.", "Attractive young female adult.", "A great and interesting personality.");
        $sampleSentences = array("Andrei: Prosper, Have you finished the curriculum?.\nProsper: Yes.\nAndrei: Tight, Tight, Tight!!!", "He took all my shit. I saw that shit on tv. Shit is going down. This shit is real.", "That broad believes she's the best thing that happened to the world. You better give that broad what she wants or else.", "Do you want to be a baller, shoot-caller hmm? Shiela is a baller, she's cool at everything she does.");
        Database::clear();
        for ($i = 0; $i < count($slangs) and count($descriptions) and count($sampleSentences); $i++) {
            Database::create($slangs[$i], $descriptions[$i], $sampleSentences[$i]);
        }
        $expected = [
                        ["slang"=>strtolower($slangs[0]), "description"=>$descriptions[0], "sample-sentence"=>$sampleSentences[0]],
                        ["slang"=>strtolower($slangs[1]), "description"=>$descriptions[1], "sample-sentence"=>$sampleSentences[1]],
                        ["slang"=>strtolower($slangs[2]), "description"=>$descriptions[2], "sample-sentence"=>$sampleSentences[2]],
                        ["slang"=>strtolower($slangs[3]), "description"=>$descriptions[3], "sample-sentence"=>$sampleSentences[3]]
                    ];
        for ($i = 0; $i < count($slangs) and count($descriptions) and count($sampleSentences); $i++) {
            $this->assertEquals($expected[$i], Database::read($slangs[$i]), "Error: Did not successfully read data $i");
        }
        Database::read("not-included"); #exception
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
        Database::clear();
        for ($i = 0; $i < count($slangs) and count($descriptions) and count($sampleSentences); $i++) {
            Database::create($slangs[$i], $descriptions[$i], $sampleSentences[$i]);
        }
        $expected = [
                        ["slang"=>strtolower($slangs[0]), "description"=>$descriptions[0], "sample-sentence"=>$sampleSentences[0]],
                        ["slang"=>strtolower($slangs[1]), "description"=>$descriptions[1], "sample-sentence"=>$sampleSentences[1]],
                        ["slang"=>strtolower($slangs[2]), "description"=>$descriptions[2], "sample-sentence"=>$sampleSentences[2]],
                        ["slang"=>strtolower($slangs[3]), "description"=>$descriptions[3], "sample-sentence"=>$sampleSentences[3]]
                    ];
        $index = self::getPrivateProperty("League\UrbanDictionary\Database", "index");
        $this->assertEquals(-1, $index->getValue("League\UrbanDictionary\Database"), "Error: Operation not successful.");
        for ($i = 0; $i < count($slangs) and count($descriptions) and count($sampleSentences); $i++) {
            Database::preUpdate($slangs[$i]);
            $this->assertEquals($i, $index->getValue("League\UrbanDictionary\Database"), "Error: Operation not successful.");
        }
        Database::preUpdate("not-included"); #use regex!
        $this->assertEquals(-1, $index->getValue("League\UrbanDictionary\Database"), "Error: Operation not successful.");
    }

    /**
     * @expectedException Exception
     */
    public function testUpdate()
    {
        $slangs = array("Tight", "Sit", "Broad", "Baller");
        $descriptions = array("When awesome task", "Generic word ascribed to anything.", "Attractive young female adult.", "A great and interesting personality.");
        $sampleSentences = array("Andrei: Prosper, Have you finished the curriculum?.\nProsper: Yes.\nAndrei: Tight, Tight, Tight!!!", "He took all my shit. I saw that shit on tv. Shit is going down. This shit is real.", "That broad believes she's the best thing that happened to the world. You better give that broad what she wants or else.", "Do you want to be a baller, shoot-caller hmm? Shiela is a baller, she's cool at everything she does.");
        Database::clear();
        for ($i = 0; $i < count($slangs) and count($descriptions) and count($sampleSentences); $i++) {
            Database::create($slangs[$i], $descriptions[$i], $sampleSentences[$i]);
        }
        $_slang = "Shit";
        $_description = "Generic word ascribed to anything. Can also be use to express suprise.";
        $_sampleSentence = "He took all my shit. I saw that shit on tv. Shit is going down. This shit is real. Shit!!!";
        Database::preUpdate($slangs[1]);
        Database::update($_slang, $_description, $_sampleSentence);
        $expected = ["slang"=>strtolower($_slang), "description"=>$_description, "sample-sentence"=>$_sampleSentence];
        $this->assertEquals($expected, Database::read($_slang));
        $_slang = "Tight";
        $_description = "When someone performs an awesome task";
        $_sampleSentence = "Andrei: Prosper, Have you finished the curriculum?.\nProsper: Yes.\nAndrei: Tight, Tight, Tight!!!";
        Database::preUpdate($slangs[0]);
        Database::update($_slang, $_description, $_sampleSentence);
        $expected = ["slang"=>strtolower($_slang), "description"=>$_description, "sample-sentence"=>$_sampleSentence];
        $this->assertEquals($expected, Database::read($_slang));
        # exception
        Database::preUpdate("not-included");
        Database::update($_slang, $_description, $_sampleSentence);
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
        Database::clear();
        for ($i = 0; $i < count($slangs) and count($descriptions) and count($sampleSentences); $i++) {
            Database::create($slangs[$i], $descriptions[$i], $sampleSentences[$i]);
        }
        Database::delete($slangs[2]);
        $expected = [
                        ["slang"=>strtolower($slangs[0]), "description"=>$descriptions[0], "sample-sentence"=>$sampleSentences[0]],
                        ["slang"=>strtolower($slangs[1]), "description"=>$descriptions[1], "sample-sentence"=>$sampleSentences[1]],
                        ["slang"=>strtolower($slangs[3]), "description"=>$descriptions[3], "sample-sentence"=>$sampleSentences[3]]
                    ];
        $this->assertEquals($expected, Database::getAll(), "Error: delete unsuccessful");
        Database::delete($slangs[3]);
        $expected = [
                        ["slang"=>strtolower($slangs[0]), "description"=>$descriptions[0], "sample-sentence"=>$sampleSentences[0]],
                        ["slang"=>strtolower($slangs[1]), "description"=>$descriptions[1], "sample-sentence"=>$sampleSentences[1]]
                    ];
        $this->assertEquals($expected, Database::getAll(), "Error: delete unsuccessful");
        Database::delete($slangs[3]); #exception
    }

    public function testGetAll()
    {
        $slangs = array("Tight", "Shit", "Broad", "Baller");
        $descriptions = array("When someone performs an awesome task", "Generic word ascribed to anything.", "Attractive young female adult.", "A great and interesting personality.");
        $sampleSentences = array("Andrei: Prosper, Have you finished the curriculum?.\nProsper: Yes.\nAndrei: Tight, Tight, Tight!!!", "He took all my shit. I saw that shit on tv. Shit is going down. This shit is real.", "That broad believes she's the best thing that happened to the world. You better give that broad what she wants or else.", "Do you want to be a baller, shoot-caller hmm? Shiela is a baller, she's cool at everything she does.");
        Database::clear();
        for ($i = 0; $i < count($slangs) and count($descriptions) and count($sampleSentences); $i++) {
            Database::create($slangs[$i], $descriptions[$i], $sampleSentences[$i]);
        }
        $expected = [
                        ["slang"=>strtolower($slangs[0]), "description"=>$descriptions[0], "sample-sentence"=>$sampleSentences[0]],
                        ["slang"=>strtolower($slangs[1]), "description"=>$descriptions[1], "sample-sentence"=>$sampleSentences[1]],
                        ["slang"=>strtolower($slangs[2]), "description"=>$descriptions[2], "sample-sentence"=>$sampleSentences[2]],
                        ["slang"=>strtolower($slangs[3]), "description"=>$descriptions[3], "sample-sentence"=>$sampleSentences[3]]
                    ];
        $this->assertEquals($expected, Database::getAll(), "Error: unsuccessful getting all records.");
    }

    public function testClear()
    {
        $slangs = array("Tight", "Shit", "Broad", "Baller");
        $descriptions = array("When someone performs an awesome task", "Generic word ascribed to anything.", "Attractive young female adult.", "A great and interesting personality.");
        $sampleSentences = array("Andrei: Prosper, Have you finished the curriculum?.\nProsper: Yes.\nAndrei: Tight, Tight, Tight!!!", "He took all my shit. I saw that shit on tv. Shit is going down. This shit is real.", "That broad believes she's the best thing that happened to the world. You better give that broad what she wants or else.", "Do you want to be a baller, shoot-caller hmm? Shiela is a baller, she's cool at everything she does.");
        Database::clear();
        for ($i = 0; $i < count($slangs) and count($descriptions) and count($sampleSentences); $i++) {
            Database::create($slangs[$i], $descriptions[$i], $sampleSentences[$i]);
        }
        $expected = [];
        Database::clear();
        $this->assertEquals($expected, Database::getAll(), "Error: unsuccessful clearing all records.");
    }
}
