<?php

namespace League\UrbanDictionary\Test;

use League\UrbanDictionary\Rank;

class RankTest extends \PHPUnit_Framework_TestCase
{
    public function testExecute()
    {
        $string = "Andrei: Prosper, Have you finished the curriculum?.\nProsper: Yes.\nAndrei: Tight, Tight, Tight!!!";
        $result = Rank::execute($string);
        /*$this->assertTrue(is_array($result), "Error: 'WordRank::rank' should return an array.");
        $this->assertEquals(str_word_count($string), array_sum($result), 'Error: the number of words in the string must equal the sum of the values in the returned array');*/
        foreach ($result as $key => $value) {
            $this->assertAttributeSame($value, $key, "array");
            /*$this->assertNotEquals(false, strripos($string, $key), 'Error: a key in the returned array is not contained in the string passed into WordRank::rank');
            $this->assertNotEquals(0, $value, 'Error: no element in the returned array should have a value of 0');*/
        }
    }
}
