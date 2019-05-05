# Testing helpers (PHPUnit, Faker, etc....)

![License](https://img.shields.io/packagist/l/corex/testing.svg)
![Build Status](https://travis-ci.org/corex/testing.svg?branch=master)
![codecov](https://codecov.io/gh/corex/testing/branch/master/graph/badge.svg)


This package is using package fzaninotto/faker as base.
A few basic static methods has been added for easy access + a little more.


### Easy access to Faker
Faker can easily be reached through singleton method faker().
Documentation for Faker can be found on https://packagist.org/packages/fzaninotto/faker
```php
$faker = TestData::faker();
$faker->...
```


### Available static methods.
```php
// Get random number.
$number = TestData::number();

// Get random number between 10 and 20.
$number = TestData::number(10, 20);

// Get random string (alpha + numeric) 20 characters long.
$string = TestData::string();

// Get random string (alpha + numeric) 10 characters long.
$string = TestData::string(10);

// Get random string (alpha).
$string = TestData::stringAlpha();

// Get random string (alpha) 10 characters long (uppercase).
$string = TestData::stringAlpha(10, true);

// Get random string (numeric) 16 characters long (uppercase).
$string = TestData::stringNumeric(16, true);

// Get list of numbers from 10 to 20 as array.
$numbers = TestData::numbers(10, 20);

// Get 20 (default 10) people (id, firstname and lastname).
$people = TestData::people(20);
```
