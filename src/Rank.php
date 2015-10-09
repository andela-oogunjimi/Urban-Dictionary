<?php

namespace League\UrbanDictionary;

class Rank
{
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
