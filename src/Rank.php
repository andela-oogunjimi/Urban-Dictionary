<?php

namespace Opeyemiabiodun\UrbanDictionary;

use InvalidArgumentException;

class Rank
{
    /**
     * The variable to hold the only instance of Opeyemiabiodun\Rank
     * @var null
     */
    private static $instance;

    /**
     * Private Constructor for Opeyemiabiodun\Rank
     */
    private function __construct()
    {

    }

    /**
     * This method returns the only avaliable instance of Opeyemiabiodun\Rank
     * @return Opeyemiabiodun\Dictionary
     */
    public static function getInstance()
    {
        if (! self::$instance)
        {
            self::$instance = new Rank();
        }

        return self::$instance;
    }  

    /**
     * This method ranks the words in sentences by the number of times the words occur in these sentences.
     *
     * @param string $string The string consisting of word(s) to be ranked.
     *
     * @return array An array of words in the string. Each array element in this format; "word"=>occurences. The word as the key of the element and the number of occurences as the value of the element.
     */
    public function execute($string)
    {
        if (! is_string($string)) {
            throw new InvalidArgumentException('A string is expected as the argument. The argument is not a string.');
        }
        $array = preg_split("(\s)", preg_replace("([^\w\s\-\'])", '', strtolower($string)));
        $result = [];
        foreach ($array as $value) {
            $result[$value] = (array_key_exists($value, $result)) ? $result[$value] + 1 : 1;
        }

        return $result;
    }
}
