<?php

namespace League\UrbanDictionary;

use League\UrbanDictionary\Word;

interface DictionaryInterface
{
    /**
     * This method inserts a word into the dictionary.
     *
     * @param  League\UrbanDictionary\Word $word The word to be placed in the dictionary.
     */
    public function insert(Word $word);
}
