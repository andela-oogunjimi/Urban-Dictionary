<?php

namespace League\UrbanDictionary\Test;

use stdClass;
use League\UrbanDictionary\Rank;
use League\UrbanDictionary\Dictionary;

class ExceptionTest extends \PHPUnit_Framework_TestCase
{
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
        Dictionary::update(0, 'string', 'string');
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testDictionaryUpdateDescriptionArgException()
    {
        Dictionary::update('string', new stdClass(), 'string');
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testDictionaryUpdateSampleSentenceArgException()
    {
        Dictionary::update('string', 'string', false);
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
