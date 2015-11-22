<?php

namespace League\UrbanDictionary;

use League\UrbanDictionary\Dictionary;
use InvalidArgumentException;

class Word
{
    /**
     * $slang The slang spelt out.
     *
     * @var string
     */
    public $slang;

    /**
     * $description A brief description of the slang.
     *
     * @var string
     */
    public $description;

    /**
     * $sampleSentence Sentence examples where the slang is used.
     *
     * @var string
     */
    public $sampleSentence;

    /**
     * The constructor method for a new Slang. The method creates a new instance of Slang.
     *
     * @param League\UrbanDictionary\Dictionary $dictionary The dictionary where the slang is created.
     *
     * @param string $slang The slang spelt out.
     *
     * @param string $description The description of the slang.
     *
     * @param string $sampleSentence Sentence examples where the slang is used.
     */
    public function __construct(DictionaryInterface $dictionary, $slang, $description, $sampleSentence)
    {
        if (!is_string($slang)) {
            throw new InvalidArgumentException("A string is expected as the second argument. The second argument is not a string.");
        }
        if (!is_string($description)) {
            throw new InvalidArgumentException("A string is expected as the third argument. The third argument is not a string.");
        }
        if (!is_string($sampleSentence)) {
            throw new InvalidArgumentException("A string is expected as the fourth argument. The fourth argument is not a string.");
        }
        $this->slang = strtolower($slang);
        $this->description = $description;
        $this->sampleSentence = $sampleSentence;
        $dictionary->insert($this);
    }
}
