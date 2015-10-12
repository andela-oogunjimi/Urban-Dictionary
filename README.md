# urban-dictionary

Make your dictionary of slangs.

## Install

Via Composer

``` bash
$ composer require codesoft/urban-dictionary
```

## Usage

Create a new word object
``` $word2 = new Word($slang, $description, $sampleSentences); ```

Add new word from dictionary.
``` Database::create($word2->slang, $word2->description, $word2->sampleSentence); ```

Read word from dictionary.
``` Database::read($slang); ```

Update word from dictionary.
``` Database::preUpdate($slang); ```
``` Database::Update($_slang, $_description, $_sampleSentence); ```

Delete word from dictionary
``` Database::delete($slang); ```

Retriving the entire dictionary
``` $dictionary = Database::getAll();  ```

Clearing the entire dictionary
``` $dictionary = Database::clear(); ```

Ranking words in a string
``` $RankArr = Rank::execute($string); ```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Testing

``` bash
$ phpunit
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CONDUCT](CONDUCT.md) for details.

## Security

If you discover any security related issues, please email opeyemi.ogunjimi@andela.com instead of using the issue tracker.

## Credits

- opeyemi ogunjimi

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.