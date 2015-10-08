<?php

namespace League\UrbanDictionary;

class WordRank
{
    public static function rank(string $string)
    {
        $array = preg_split("(\s)", preg_replace("([^\w\s\-\'])", "", strtolower($string)));
        $result = array();
        foreach ($array as $value) {
            $result[$value] = (array_key_exists($value, $result)) ? $result[$value] + 1 : 1 ;
        }
        return $result;
    }
}
