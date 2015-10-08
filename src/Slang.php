<?php

namespace League\UrbanDictionary;

class Slang
{
    public $slang;
    public $description;
    public $sampleSentence;

    public function __construct(sting $slang, string $description,string $sampleSentence)
    {
        $this->slang = $slang;
        $this->description = $description;
        $this->sampleSentence = $sampleSentence;
    }
}
