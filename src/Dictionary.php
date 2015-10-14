<?php

namespace League\UrbanDictionary;

use League\UrbanDictionary\DictionaryInterface;
use League\UrbanDictionary\Word;
use \Exception;

class Dictionary implements DictionaryInterface
{
    /** @var array A two-dimensional array of arrays, each array representing a word/slang */
    private static $data = array();

    /** @var integer The index of a particular selected word/slang in $data  */
    private static $index = -1;

    /**
     * This method finds a word or slang in the dictionary.
     * @param  string $slang word or slang searched for $data
     * @return array  record(s) of slang in $data
     */
    private static function search($slang)
    {
        $lowerCaseSlang = strtolower($slang);
        return array_filter(self::$data, function ($value) use ($lowerCaseSlang) {
            return $value["slang"] == $lowerCaseSlang;
        });
    }

    /**
     * This method creates a record of a slang in the dictionary.
     * @param  string $slang          The new word or slang to be added to the dictionary
     * @param  string $description    The description of the slang
     * @param  string $sampleSentence Sentence examples where the word is being used
     * @return void
     */
    public static function create($slang, $description, $sampleSentence)
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
        if (count(self::search($slang)) > 0) {
            throw new Exception("The slang already exists in the dictionary.");
        } else {
            array_push(self::$data, ["slang" => strtolower($slang), "description" => $description, "sample-sentence" => $sampleSentence]);
        }
    }

    /**
     * [create description]
     * @param  Word   $word The word to be placed in the dictionary.
     */
    public function insert(Word $word)
    {
        self::create($word->slang, $word->description, $word->sampleSentence);
    }

    /**
     * This method returns the record of the slang in the dictionary if it exists.
     * @param  string $slang The word to be read from the dictionary
     * @return array         The record of the slang in the dictionary
     */
    public static function read($slang)
    {
        if (!is_string($slang)) {
            throw new Exception("The slang argument is not a string.");
        }
        $records = self::search($slang);
        if (count($records) > 0) {
            return current($records);
        } else {
            throw new Exception("The slang is not in the dictionary.");
        }
    }


    /**
     * This method selects a word/slang to be updated in the dictionary if it exists.
     * @param  string $slang The slang to be updated in the dictionary.
     * @return void
     */
    public static function preUpdate($slang)
    {
        if (!is_string($slang)) {
            throw new Exception("The slang argument is not a string.");
        }
        self::$index = -1;
        $records = self::search($slang);
        if (count($records) > 0) {
            self::$index = key($records);
        }
    }

    /**
     * This method updates a predetermined record in the dictionary.
     * @param  string $slang          An update to the slang in the dictionary
     * @param  string $description    An update to description in the dictionary
     * @param  string $sampleSentence An update to sample sentences in the dictionary
     * @return void
     */
    public static function update($slang, $description, $sampleSentence)
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
        if (array_key_exists(self::$index, self::$data)) {
            self::$data[self::$index]["slang"] = strtolower($slang);
            self::$data[self::$index]["description"] = $description;
            self::$data[self::$index]["sample-sentence"] = $sampleSentence;
            self::$index = -1;
        } else {
            throw new Exception("The slang is not in the dictionary.");
        }
    }

    /**
     * This method deletes a word/slang in the dictionary if it exists.
     * @param  string $slang The word or slang to be removed from the dictionary
     * @return void
     */
    public static function delete($slang)
    {
        if (!is_string($slang)) {
            throw new Exception("The slang argument is not a string");
        }
        $records = self::search($slang);
        if (count($records) > 0) {
            array_splice(self::$data, key($records), 1);
        } else {
            throw new Exception("The slang is not in the dictionary.");
        }
    }

    /**
     * This method returns the entire dictionary of words/slangs.
     * @return array A two-dimensional array serving as a dictionary of slangs.
     */
    public static function getAll()
    {
        return self::$data;
    }

    /**
     * This method empties the entire dictionary.
     * @return void
     */
    public static function clear()
    {
        self::$data = array();
        self::$index = -1;
    }
}
