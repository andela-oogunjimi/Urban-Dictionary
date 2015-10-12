<?php

namespace League\UrbanDictionary;

interface DataInterface
{
    /**
     * This method creates a record of a slang in the dictionary.
     * @param  string $slang          The new word or slang to be added to the dictionary
     * @param  string $description    The description of the slang
     * @param  string $sampleSentence Sentence examples where the word is being used
     * @return void
     */
    public static function create($slang, $description, $sampleSentence);

    /**
     * This method returns the record of the slang in the dictionary if it exists.
     * @param  string $slang The word to be read from the dictionary
     * @return array         The record of the slang in the dictionary
     */
    public static function read($slang);

    /**
     * This method selects a word/slang to be updated in the dictionary if it exists.
     * @param  string $slang The slang to be updated in the dictionary.
     * @return void
     */
    public static function preUpdate($slang);

    /**
     * This method updates a predetermined record in the dictionary.
     * @param  string $slang          An update to the slang in the dictionary
     * @param  string $description    An update to description in the dictionary
     * @param  string $sampleSentence An update to sample sentences in the dictionary
     * @return void
     */
    public static function update($slang, $description, $sampleSentence);

    /**
     * This method deletes a word/slang in the dictionary if it exists.
     * @param  string $slang The word or slang to be removed from the dictionary
     * @return void
     */
    public static function delete($slang);

    /**
     * This method returns the entire dictionary of words/slangs.
     * @return array A two-dimensional array serving as a dictionary of slangs.
     */
    public static function getAll();

    /**
     * This method empties the entire dictionary.
     * @return void
     */
    public static function clear();
}
