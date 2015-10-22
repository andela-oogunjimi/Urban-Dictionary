<?php

namespace League\UrbanDictionary;

use InvalidArgumentException;

class Rank
{
    /**
     * This method ranks the words in sentences by the number of times the words occur in these sentences.
     *
     * @param string $string The string consisting of word(s) to be ranked.
     *
     * @return array An array of words in the string. Each array element in this format; "word"=>occurences. The word as the key of the element and the number of occurences as the value of the element.
     */
    public static function execute($string)
    {
        if (!is_string($string)) {
            throw new InvalidArgumentException("A string is expected as the argument. The argument is not a string.");
        }
        $array = preg_split("(\s)", preg_replace("([^\w\s\-\'])", "", strtolower($string)));
        $result = array();
        foreach ($array as $value) {
            $result[$value] = (array_key_exists($value, $result)) ? $result[$value] + 1 : 1 ;
        }
        return $result;
    }
}
