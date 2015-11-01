<?php

namespace League\UrbanDictionary\Test;

use League\UrbanDictionary\Dictionary;
use League\UrbanDictionary\Rank;
use League\UrbanDictionary\Word;
use stdClass;

class ExceptionTest extends \PHPUnit_Framework_TestCase
{

    protected function setUp()
    {
        Dictionary::add("Tight", "When someone performs an awesome task", "Andrei: Prosper, Have you finished the curriculum?.\nProsper: Yes.\nAndrei: Tight, Tight, Tight!!!");
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testDictionaryAddSlangArgException()
    {
        Dictionary::add(0, 'string', 'string');
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testDictionaryAddDescriptionArgException()
    {
        Dictionary::add('string', new stdClass(), 'string');
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testDictionaryAddSampleSentenceArgException()
    {
        Dictionary::add('string', 'string', false);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testDictionaryReadArgException()
    {
        Dictionary::read(false);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testDictionarySelectArgException()
    {
        Dictionary::select(false);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testDictionaryUpdateSlangArgException()
    {
        Dictionary::select("Tight")->update(0, 'string', 'string');
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testDictionaryUpdateDescriptionArgException()
    {
        Dictionary::select("Tight")->update('string', new stdClass(), 'string');
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testDictionaryUpdateSampleSentenceArgException()
    {
        Dictionary::select("Tight")->update('string', 'string', false);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testDictionaryDeleteArgException()
    {
        Dictionary::delete(new stdClass());
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testRankExecuteArgException()
    {
        Rank::execute(6);
    }
}
