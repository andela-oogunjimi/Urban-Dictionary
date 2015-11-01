# Urban-Dictionary

[![Latest Version on Packagist](https://img.shields.io/badge/packagist-v1.0.0-orange.svg)](https://packagist.org/packages/codesoft/urban-dictionary)
[![Software License][ico-license]](LICENSE.md)
[![Build Status](https://travis-ci.org/andela-oogunjimi/Urban-Dictionary.svg?branch=master)](https://travis-ci.org/andela-oogunjimi/Urban-Dictionary)
[![Code Coverage](https://scrutinizer-ci.com/g/andela-oogunjimi/Urban-Dictionary/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/andela-oogunjimi/Urban-Dictionary/?branch=master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/andela-oogunjimi/Urban-Dictionary/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/andela-oogunjimi/Urban-Dictionary/?branch=master)

###### CheckPoint 1/a; Urban-Dictionary Agnostic PHP Package
The package enables the non-persistent storage of data. Specifically; slangs, their meanings and examples of sentences where they are used. Creating, reading, updating and deleting records of these slangs are also made possible by this package. Finally, the package can also rank words within sentences by the number of occurences of these words within the sentences. PSR-2 coding standard was adopted in writing the package. The PSR-4 autoloading convention was also adopted.

## Install

Via Composer

``` bash
$ composer require league/Urban-Dictionary
```

## Usage

``` php
<?php
    require "vendor/autoload.php";

    use League/UrbanDictionary/Dictionary;
    use League/UrbanDictionary/Rank;

    /*
     The following methods below perform CRUD operations in the dictionary.
     The arguments passed into the methods are strings.
    */
    Dictionary::add($slang, $description, $sampleSentence);
    Dictionary::read($slang);
    Dictionary::select($slang)->update($_slang, $_description, $_sampleSentence);
    Dictionary::delete($slang);
    Dictionary::getAll();
    Dictionary::clear();

    $_sentences = “Andrei: Prosper, Have you finished the curriculum?.
                  Prosper: Yes.
                  Andrei: Tight, Tight, Tight!!!”

    $wordsRank = Rank::execute($_sentences);
    /*
     $wordsRank = [“Tight” => 3, “Prosper” => 2, “Yes” => 1, “Have” => 1, “you” => 1,
                    “finished” => 1, “the” => 1, “curriculum?” => 1];
    */
?>
```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CONDUCT](CONDUCT.md) for details.

## Security

If you discover any security related issues, please email opeyemi.ogunjimi@andela.com instead of using the issue tracker.

## Credits

- [Opeyemi Ogunjimi][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/league/Urban-Dictionary.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/thephpleague/Urban-Dictionary/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/thephpleague/Urban-Dictionary.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/thephpleague/Urban-Dictionary.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/league/Urban-Dictionary.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/league/Urban-Dictionary
[link-travis]: https://travis-ci.org/thephpleague/Urban-Dictionary
[link-scrutinizer]: https://scrutinizer-ci.com/g/thephpleague/Urban-Dictionary/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/thephpleague/Urban-Dictionary
[link-downloads]: https://packagist.org/packages/league/Urban-Dictionary
[link-author]: https://github.com/opeyemiabiodun
[link-contributors]: ../../contributors
