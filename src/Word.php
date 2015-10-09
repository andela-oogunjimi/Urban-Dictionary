<?php

namespace League\UrbanDictionary;

class Word
{
    public $slang;
    public $description;
    public $sampleSentence;

    public function __construct($slang, $description, $sampleSentence)
    {
        $this->slang = strtolower($slang);
        $this->description = $description;
        $this->sampleSentence = $sampleSentence;
    }
}
