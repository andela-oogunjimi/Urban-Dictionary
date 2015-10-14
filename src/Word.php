<?php

namespace League\UrbanDictionary;

use \Exception;

class Word
{
    /**  @var string The slang spelt out */
    public $slang;
    /** @var string A brief description of the slang */
    public $description;
    /** @var string Sentence examples where the slang is used*/
    public $sampleSentence;

    /**
     * The constructor method for a new Word. The method creates a new instance of Word.
     * @param string $slang          The slang/word
     * @param string $description    The description of the slang/word
     * @param string $sampleSentence Sentence examples where the slang/word is used
     */
    public function __construct($slang, $description, $sampleSentence)
    {
        if (!is_string($slang)) {
            throw new Exception("The slang argument is not a string");
        }
        if (!is_string($description)) {
            throw new Exception("The description argument is not a string");
        }
        if (!is_string($sampleSentence)) {
            throw new Exception("The sampleSentence argument is not a string ");
        }
        $this->slang = strtolower($slang);
        $this->description = $description;
        $this->sampleSentence = $sampleSentence;
    }
}
