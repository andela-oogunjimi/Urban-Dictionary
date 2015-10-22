<?php

namespace League\UrbanDictionary\Test;

use League\UrbanDictionary\Dictionary;
use League\UrbanDictionary\Word;

class WordTest extends \PHPUnit_Framework_TestCase
{
    public function testWordConstructor()
    {
        $_slang = 'Tight';
        $_description = 'When someone performs an awesome task';
        $_sampleSentence = "Andrei: Prosper, Have you finished the curriculum?.\nProsper: Yes.\nAndrei: Tight, Tight, Tight!!!";
        $word = new Word(new Dictionary(), $_slang, $_description, $_sampleSentence);
        $this->assertEquals('object', gettype($word), 'Error: Slang is not an object.');
        $this->assertInstanceOf("League\UrbanDictionary\Word", $word, 'Error: object is not an instance of Slang.');
        $this->assertobjectHasAttribute('slang', $word, "Error: object has no 'slang' attribute.");
        $this->assertobjectHasAttribute('description', $word, "Error: object has no 'description' attribute.");
        $this->assertobjectHasAttribute('sampleSentence', $word, "Error: object has no 'sampleSentence' attribute.");
        $this->assertEquals(strtolower($_slang), $word->slang, "Error: 'slang' attribute is not assigned properly.");
        $this->assertEquals($_description, $word->description, "Error: 'description' attribute is not assigned properly.");
        $this->assertEquals($_sampleSentence, $word->sampleSentence, "Error: 'description' attribute is not assigned properly.");
    }
}
