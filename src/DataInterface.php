<?php

namespace League\UrbanDictionary;

interface DataInterface
{
    public static function create($slang, $description, $sampleSentence);

    public static function read($slang);

    public static function preUpdate($slang);

    public static function update($slang, $description, $sampleSentence);

    public static function delete($slang);

    public static function getAll();

    public static function clear();
}
