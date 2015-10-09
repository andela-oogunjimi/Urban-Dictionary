<?php

namespace League\UrbanDictionary;

use League\UrbanDictionary\DataInterface;
use \Exception;

class Database implements DataInterface
{
    private static $data = array();

    private static $index = -1;

    private static function search($slang)
    {
        $lowerCaseSlang = strtolower($slang);
        return array_filter(self::$data, function ($value) use ($lowerCaseSlang) {
            return $value["slang"] == $lowerCaseSlang;
        });
    }

    public static function create($slang, $description, $sampleSentence)
    {
        if (count(self::search($slang)) > 0) {
            throw new Exception("Error Processing Request", 1);
        } else {
            array_push(self::$data, ["slang" => strtolower($slang), "description" => $description, "sample-sentence" => $sampleSentence]);
        }
    }

    public static function read($slang)
    {
        $records = self::search($slang);
        if (count($records) > 0) {
            return current($records);
        } else {
            throw new Exception("Error Processing Request", 1);
        }
    }

    public static function preUpdate($slang)
    {
        self::$index = -1;
        $records = self::search($slang);
        if (count($records) > 0) {
            self::$index = key($records);
        }
    }

    public static function update($slang, $description, $sampleSentence)
    {
        if (array_key_exists(self::$index, self::$data)) {
            self::$data[self::$index]["slang"] = strtolower($slang);
            self::$data[self::$index]["description"] = $description;
            self::$data[self::$index]["sample-sentence"] = $sampleSentence;
            self::$index = -1;
        } else {
            throw new Exception("Error Processing Request", 1);
        }
    }

    public static function delete($slang)
    {
        $records = self::search($slang);
        if (count($records) > 0) {
            array_splice(self::$data, key($records), 1);
        } else {
            throw new Exception("Error Processing Request", 1);
        }
    }

    public static function getAll()
    {
        return self::$data;
    }

    public static function clear()
    {
        self::$data = array();
        self::$index = -1;
    }
}
