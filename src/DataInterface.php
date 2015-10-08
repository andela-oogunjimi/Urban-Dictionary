<?php

namespace League\UrbanDictionary;

interface DataInterface
{
    public static function create(string $slang, string $description, string $sampleSentence);

    public static function read(string $slang);

    public static function update(string $slang);

    public static function delete(string $slang);

    public static function preUpdate(string $slang);

    public static function getAll();
}
