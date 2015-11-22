<?php

namespace Opeyemiabiodun\UrbanDictionary;

use InvalidArgumentException;

class Dictionary
{
    /**
     * $data The dictionary, a two-dimensional array of arrays, each array representing a slang.
     *
     * @var array
     */
    private $data = [];

    /**
     * $index The index of a particular selected slang in the dictionary.
     *
     * @var int
     */
    private $index = -1;

    /**
     * The variable to hold the only instance of Opeyemiabiodun\UrbanDictionary\Dictionary.
     * @var null
     */
    private static $instance;

    /**
     * Private Constructor for Opeyemiabiodun\UrbanDictionary\Dictionary.
     */
    private function __construct()
    {
    }

    /**
     * This method returns the only avaliable instance of Opeyemiabiodun\UrbanDictionary\Dictionary.
     * @return Opeyemiabiodun\UrbanDictionary\Dictionary
     */
    public static function getInstance()
    {
        if (! self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * This method finds a slang in the dictionary.
     *
     * @param string $slang The slang searched for in the dictionary.
     *
     * @return array The record(s) of slang in the dictionary.
     */
    private function search($slang)
    {
        $lowerCaseSlang = strtolower($slang);

        return array_filter($this->data, function ($value) use ($lowerCaseSlang) {
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
     * @return bool
     */
    public function add($slang, $description, $sampleSentence)
    {
        $_added = false;
        if (! is_string($slang)) {
            throw new InvalidArgumentException('A string is expected as the first argument. The first argument is not a string.');
        }
        if (! is_string($description)) {
            throw new InvalidArgumentException('A string is expected as the second argument. The second argument is not a string.');
        }
        if (! is_string($sampleSentence)) {
            throw new InvalidArgumentException('A string is expected as the third argument. The third argument is not a string.');
        }
        if (count(self::search($slang)) > 0) {
            throw new InvalidArgumentException('The slang already exists in the dictionary.');
        } else {
            array_push($this->data, ['slang' => strtolower($slang), 'description' => $description, 'sample-sentence' => $sampleSentence]);
            $_added = true;
        }

        return $_added;
    }

    /**
     * This method returns the record of the slang in the dictionary if it exists.
     *
     * @param string $slang The slang to be read from the dictionary.
     *
     * @return array The record of the slang in the dictionary.
     */
    public function read($slang)
    {
        if (! is_string($slang)) {
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
     * @return bool
     */
    public function select($slang)
    {
        $_selected = false;
        $this->index = -1;
        if (! is_string($slang)) {
            throw new InvalidArgumentException('A string is expected as the argument. The argument is not a string.');
        }
        $records = self::search($slang);
        if (count($records) > 0) {
            $this->index = key($records);
            $_selected = true;
        } else {
            throw new InvalidArgumentException('The slang is not in the dictionary.');
        }

        return $_selected;
    }

    /**
     * This method updates a selected record in the dictionary.
     *
     * @param string $slang          An update to the slang in the dictionary.
     * @param string $description    An update to the description in the dictionary.
     * @param string $sampleSentence An update to the sample sentences in the dictionary.
     *
     * @return bool
     */
    public function update($slang, $description, $sampleSentence)
    {
        $_updated = false;
        if (! is_string($slang)) {
            throw new InvalidArgumentException('A string is expected as the first argument. The first argument is not a string.');
        }
        if (! is_string($description)) {
            throw new InvalidArgumentException('A string is expected as the second argument. The second argument is not a string.');
        }
        if (! is_string($sampleSentence)) {
            throw new InvalidArgumentException('A string is expected as the third argument. The third argument is not a string.');
        }
        if (array_key_exists($this->index, $this->data)) {
            $this->data[$this->index]['slang'] = strtolower($slang);
            $this->data[$this->index]['description'] = $description;
            $this->data[$this->index]['sample-sentence'] = $sampleSentence;
            $this->index = -1;
            $_updated = true;
        }

        return $_updated;
    }

    /**
     * This method deletes a slang in the dictionary if it exists.
     *
     * @param string $slang The slang to be removed from the dictionary
     *
     * @return bool
     */
    public function delete($slang)
    {
        $_deleted = false;
        if (! is_string($slang)) {
            throw new InvalidArgumentException('A string is expected as the argument. The argument is not a string.');
        }
        $records = self::search($slang);
        if (count($records) > 0) {
            array_splice($this->data, key($records), 1);
            $_deleted = true;
        } else {
            throw new InvalidArgumentException('The slang is not in the dictionary.');
        }

        return $_deleted;
    }

    /**
     * This method returns the entire dictionary of words/slangs.
     *
     * @return array A two-dimensional array serving as a dictionary of slangs.
     */
    public function getAll()
    {
        return $this->data;
    }

    /**
     * This method empties the entire dictionary.
     *
     * @return void
     */
    public function clear()
    {
        $this->data = [];
        $this->index = -1;
    }
}
