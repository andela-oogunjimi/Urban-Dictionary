<?php

namespace League\UrbanDictionary\Test;

use League\UrbanDictionary\Database;
use League\UrbanDictionary\Rank;
use League\UrbanDictionary\Word;
use \stdClass;

class ExceptionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException Exception
     */
    public function testDatabaseCreateSlangArgException()
    {
        Database::create(0, "string", "string");
    }

    /**
     * @expectedException Exception
     */
    public function testDatabaseCreateDescriptionArgException()
    {
        Database::create("string", new stdClass(), "string");
    }

    /**
     * @expectedException Exception
     */
    public function testDatabaseCreateSampleSentenceArgException()
    {
        Database::create("string", "string", false);
    }

    /**
     * @expectedException Exception
     */
    public function testDatabaseReadArgException()
    {
        Database::read(false);
    }

    /**
     * @expectedException Exception
     */
    public function testDatabasePreUpdateArgException()
    {
        Database::preUpdate(false);
    }

    /**
     * @expectedException Exception
     */
    public function testDatabaseUpdateSlangArgException()
    {
        Database::update(0, "string", "string");
    }

    /**
     * @expectedException Exception
     */
    public function testDatabaseUpdateDescriptionArgException()
    {
        Database::update("string", new stdClass(), "string");
    }

    /**
     * @expectedException Exception
     */
    public function testDatabaseUpdateSampleSentenceArgException()
    {
        Database::update("string", "string", false);
    }

    /**
     * @expectedException Exception
     */
    public function testDatabaseDeleteArgException()
    {
        Database::delete(new stdClass());
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
        $word = new Word(0, "string", "string");
    }

    /**
     * @expectedException Exception
     */
    public function testWordConstructorDescriptionArgException()
    {
        $word = new Word("string", new stdClass(), "string");
    }

    /**
     * @expectedException Exception
     */
    public function testWordConstructorSampleSentenceArgException()
    {
        $word = new Word("string", "string", false);
    }
}
