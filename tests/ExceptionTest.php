<?php

namespace Opeyemiabiodun\UrbanDictionary\Test;

use stdClass;
use Opeyemiabiodun\UrbanDictionary\Rank;
use Opeyemiabiodun\UrbanDictionary\Dictionary;

class ExceptionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException InvalidArgumentException
     */
    public function testDictionaryAddSlangArgException()
    {
        Dictionary::getInstance()->add(0, 'string', 'string');
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testDictionaryAddDescriptionArgException()
    {
        Dictionary::getInstance()->add('string', new stdClass(), 'string');
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testDictionaryAddSampleSentenceArgException()
    {
        Dictionary::getInstance()->add('string', 'string', false);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testDictionaryReadArgException()
    {
        Dictionary::getInstance()->read(false);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testDictionarySelectArgException()
    {
        Dictionary::getInstance()->select(false);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testDictionaryUpdateSlangArgException()
    {
        Dictionary::getInstance()->update(0, 'string', 'string');
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testDictionaryUpdateDescriptionArgException()
    {
        Dictionary::getInstance()->update('string', new stdClass(), 'string');
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testDictionaryUpdateSampleSentenceArgException()
    {
        Dictionary::getInstance()->update('string', 'string', false);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testDictionaryDeleteArgException()
    {
        Dictionary::getInstance()->delete(new stdClass());
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testRankExecuteArgException()
    {
        Rank::getInstance()->execute(6);
    }
}
