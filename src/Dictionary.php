<?php

namespace League\UrbanDictionary;

use InvalidArgumentException;

class Dictionary implements DictionaryInterface
{
    /**
     * $data The dictionary, a two-dimensional array of arrays, each array representing a slang.
     *
     * @var array
     */
    private static $data = [];

    /**
     * $index The index of a particular selected slang in the dictionary.
     *
     * @var int
     */
    private static $index = -1;

    /**
     * This method finds a slang in the dictionary.
     *
     * @param string $slang The slang searched for in the dictionary.
     *
     * @return array The record(s) of slang in the dictionary.
     */
    private static function search($slang)
    {
        $lowerCaseSlang = strtolower($slang);

        return array_filter(self::$data, function ($value) use ($lowerCaseSlang) {
            return $value['slang'] == $lowerCaseSlang;
        });
    }

    /**
     * This method creates a record of a slang in the dictionary.
     *
     * @param string $slang          The slang to be added to the dictionary.
     * @param string $description    The description of the slang.
     * @param string $sampleSentence Sentence examples where the slang is used.
     *
     * @return void
     */
    public static function create($slang, $description, $sampleSentence)
    {
        if (!is_string($slang)) {
            throw new InvalidArgumentException('A string is expected as the first argument. The first argument is not a string.');
        }
        if (!is_string($description)) {
            throw new InvalidArgumentException('A string is expected as the second argument. The second argument is not a string.');
        }
        if (!is_string($sampleSentence)) {
            throw new InvalidArgumentException('A string is expected as the third argument. The third argument is not a string.');
        }
        if (count(self::search($slang)) > 0) {
            throw new InvalidArgumentException('The slang already exists in the dictionary.');
        } else {
            array_push(self::$data, ['slang' => strtolower($slang), 'description' => $description, 'sample-sentence' => $sampleSentence]);
        }
    }

    /**
     * This method creates a record of a slang in the dictionary.
     *
     * @param League\UrbanDictionary\Word $word The word to be placed in the dictionary.
     *
     * @return void
     */
    public function insert(Word $word)
    {
        self::create($word->slang, $word->description, $word->sampleSentence);
    }

    /**
     * This method returns the record of the slang in the dictionary if it exists.
     *
     * @param string $slang The slang to be read from the dictionary.
     *
     * @return array The record of the slang in the dictionary.
     */
    public static function read($slang)
    {
        if (!is_string($slang)) {
            throw new InvalidArgumentException('A string is expected as the argument. The argument is not a string.');
        }
        $records = self::search($slang);
        if (count($records) > 0) {
            return current($records);
        } else {
            throw new InvalidArgumentException('The slang is not in the dictionary.');
        }
    }

    /**
     * This method selects a slang to be updated in the dictionary if it exists. It sets the $index property of the dictionary to the key for the slang record in the dictionary. The index is set to -1 if the slang is not in the dictionary.
     *
     * @param string $slang The slang to be updated in the dictionary.
     *
     * @return void
     */
    public static function select($slang)
    {
        if (!is_string($slang)) {
            throw new InvalidArgumentException('A string is expected as the argument. The argument is not a string.');
        }
        self::$index = -1;
        $records = self::search($slang);
        if (count($records) > 0) {
            self::$index = key($records);
        } else {
            throw new InvalidArgumentException('The slang is not in the dictionary.');
        }
    }

    /**
     * This method updates a selected record in the dictionary.
     *
     * @param string $slang          An update to the slang in the dictionary.
     * @param string $description    An update to the description in the dictionary.
     * @param string $sampleSentence An update to the sample sentences in the dictionary.
     *
     * @return void
     */
    public static function update($slang, $description, $sampleSentence)
    {
        if (!is_string($slang)) {
            throw new InvalidArgumentException('A string is expected as the first argument. The first argument is not a string.');
        }
        if (!is_string($description)) {
            throw new InvalidArgumentException('A string is expected as the second argument. The second argument is not a string.');
        }
        if (!is_string($sampleSentence)) {
            throw new InvalidArgumentException('A string is expected as the third argument. The third argument is not a string.');
        }
        if (array_key_exists(self::$index, self::$data)) {
            self::$data[self::$index]['slang'] = strtolower($slang);
            self::$data[self::$index]['description'] = $description;
            self::$data[self::$index]['sample-sentence'] = $sampleSentence;
            self::$index = -1;
        } else {
            self::$index = -1;
            throw new Exception('The slang is not in the dictionary.');
        }
    }

    /**
     * This method deletes a slang in the dictionary if it exists.
     *
     * @param string $slang The slang to be removed from the dictionary
     *
     * @return void
     */
    public static function delete($slang)
    {
        if (!is_string($slang)) {
            throw new InvalidArgumentException('A string is expected as the argument. The argument is not a string.');
        }
        $records = self::search($slang);
        if (count($records) > 0) {
            array_splice(self::$data, key($records), 1);
        } else {
            throw new InvalidArgumentException('The slang is not in the dictionary.');
        }
    }

    /**
     * This method returns the entire dictionary of words/slangs.
     *
     * @return array A two-dimensional array serving as a dictionary of slangs.
     */
    public static function getAll()
    {
        return self::$data;
    }

    /**
     * This method empties the entire dictionary.
     *
     * @return void
     */
    public static function clear()
    {
        self::$data = [];
        self::$index = -1;
    }
}
