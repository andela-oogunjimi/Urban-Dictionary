<?php

namespace League\UrbanDictionary;

use League\UrbanDictionary\Word;

interface DictionaryInterface
{
    /**
     * [create description]
     * @param  Word   $word The word to be placed in the dictionary.
     */
    public function insert(Word $word);
}
