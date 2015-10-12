<?php

namespace League\UrbanDictionary;

class Rank
{
    /**
     * This method ranks the words in sentences by the number of times the words occur in the sentences.
     * @param  string $string The string consisting of word(s) to be ranked
     * @return array          An array of words in the string. Each array element in this format; "word"=>count
     */
    public static function execute($string)
    {
        $array = preg_split("(\s)", preg_replace("([^\w\s\-\'])", "", strtolower($string)));
        $result = array();
        foreach ($array as $value) {
            $result[$value] = (array_key_exists($value, $result)) ? $result[$value] + 1 : 1 ;
        }
        return $result;
    }
}
