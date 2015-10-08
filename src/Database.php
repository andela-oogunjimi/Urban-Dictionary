<?php

namespace League\UrbanDictionary;

use League\DataInterface;

class Database implements DataInterface
{
    private static $data = array();

    private static $index = -1;

    public static function create(string $slang, string $description, string $sampleSentence)
    {
        if (count(search($slang)) > 0) {
            throw new Exception("Error Processing Request", 1);
        } else {
            array_push($this->data, [“slang” => strtolower($slang), “description” => $description, “sample-sentence” => $sampleSentence]);
        }
    }

    public static function read(string $slang)
    {
        $records = search($slang);
        if (count($records) > 0) {
            return current($records);
        } else {
            throw new Exception("Error Processing Request", 1);
        }
    }

    public static function update(string $slang, string $description, string $sampleSentence)
    {
        if (array_key_exists($this->index, $this->data)) {
            $this->data[$this->index]["slang"] = strtolower($slang);
            $this->data[$this->index]["description"] = $description;
            $this->data[$this->index]["sample-Sentence"] = $sampleSentence;
            $this->index = -1;
        } else {
            throw new Exception("Error Processing Request", 1);
        }
    }

    public static function delete(string $slang)
    {
        $records = search($slang);
        if (count($records) > 0) {
            $this->data = array_splice($this->data, key($records), 1);
        } else {
            throw new Exception("Error Processing Request", 1);
        }
    }

    public static function preUpdate(string $slang)
    {
        $records = search($slang);
        if (count($records) > 0) {
            $this->index = key($records);
        }
    }

    private function search(string $slang)
    {
        $lowerCaseSlang = strtolower($slang);
        return array_filter($this->data, function ($value) use ($lowerCaseSlang) {
            return $value["slang"] == $lowerCaseSlang;
        });
    }

    public static function getAll()
    {
        return $this->data;
    }
}
