<?php

namespace League\UrbanDictionary\Test;

use League\UrbanDictionary\Dictionary;
use League\UrbanDictionary\Rank;
use League\UrbanDictionary\Word;
use \stdClass;

class ExceptionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException Exception
     */
    public function testDictionaryCreateSlangArgException()
    {
        Dictionary::create(0, "string", "string");
    }

    /**
     * @expectedException Exception
     */
    public function testDictionaryCreateDescriptionArgException()
    {
        Dictionary::create("string", new stdClass(), "string");
    }

    /**
     * @expectedException Exception
     */
    public function testDictionaryCreateSampleSentenceArgException()
    {
        Dictionary::create("string", "string", false);
    }

    /**
     * @expectedException Exception
     */
    public function testDictionaryReadArgException()
    {
        Dictionary::read(false);
    }

    /**
     * @expectedException Exception
     */
    public function testDictionarySelectArgException()
    {
        Dictionary::select(false);
    }

    /**
     * @expectedException Exception
     */
    public function testDictionaryUpdateSlangArgException()
    {
        Dictionary::update(0, "string", "string");
    }

    /**
     * @expectedException Exception
     */
    public function testDictionaryUpdateDescriptionArgException()
    {
        Dictionary::update("string", new stdClass(), "string");
    }

    /**
     * @expectedException Exception
     */
    public function testDictionaryUpdateSampleSentenceArgException()
    {
        Dictionary::update("string", "string", false);
    }

    /**
     * @expectedException Exception
     */
    public function testDictionaryDeleteArgException()
    {
        Dictionary::delete(new stdClass());
    }

    /**
     * @expectedException Exception
     */
    public function testRankExecuteArgException()
    {
        Rank::execute(6);
    }

    /**
     * @expectedException Exception
     */
    public function testWordConstructorSlangArgException()
    {
        $word = new Word(new Dictionary(), 0, "string", "string");
    }

    /**
     * @expectedException Exception
     */
    public function testWordConstructorDescriptionArgException()
    {
        $word = new Word(new Dictionary(), "string", new stdClass(), "string");
    }

    /**
     * @expectedException Exception
     */
    public function testWordConstructorSampleSentenceArgException()
    {
        $word = new Word(new Dictionary(), "string", "string", false);
    }
}
