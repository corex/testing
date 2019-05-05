<?php

declare(strict_types=1);

namespace CoRex\Testing;

use Exception;
use Faker\Factory;
use Faker\Generator;

class TestData
{
    public const CHARACTER_MAP = '0123456789abcdefghijklmnopqrstuvwxyz';

    /** @var Generator */
    private static $faker;

    /**
     * Faker.
     *
     * @return Generator
     */
    public static function faker(): Generator
    {
        if (self::$faker === null) {
            self::$faker = Factory::create();
        }
        return self::$faker;
    }

    /**
     * Number.
     *
     * @param int $min
     * @param int $max
     * @return int
     * @throws Exception
     */
    public static function number(int $min = 0, int $max = PHP_INT_MAX): int
    {
        return (int)random_int($min, $max);
    }

    /**
     * String.
     *
     * @param int $length
     * @param bool $toUpper
     * @return string
     */
    public static function string(int $length = 20, bool $toUpper = false): string
    {
        $result = self::generateString($length, true, true);
        if ($toUpper) {
            $result = strtoupper($result);
        }
        return $result;
    }

    /**
     * String with only alpha characters.
     *
     * @param int $length
     * @param bool $toUpper
     * @return string
     */
    public static function stringAlpha(int $length = 20, bool $toUpper = false): string
    {
        $result = self::generateString($length, false, true);
        if ($toUpper) {
            $result = strtoupper($result);
        }
        return $result;
    }

    /**
     * String with only numeric characters.
     *
     * @param int $length
     * @param bool $toUpper
     * @return string
     */
    public static function stringNumeric(int $length = 20, bool $toUpper = false): string
    {
        $result = self::generateString($length, true, false);
        if ($toUpper) {
            $result = strtoupper($result);
        }
        return $result;
    }

    /**
     * Numbers.
     *
     * @param int $min
     * @param int $max
     * @return int[]
     */
    public static function numbers(int $min = 0, int $max = 10): array
    {
        $numbers = [];
        for ($number = $min; $number <= $max; $number++) {
            $numbers[] = $number;
        }
        return $numbers;
    }

    /**
     * People.
     *
     * @param int $count
     * @return mixed[] (id, firstname, lastname)
     * @throws Exception
     */
    public static function people(int $count = 10): array
    {
        $numbers = self::numbers(0, $count);
        $result = [];
        if ($count > 0) {
            for ($c1 = 0; $c1 < $count; $c1++) {
                $id = array_shift($numbers);
                $result[] = [
                    'id' => $id,
                    'firstname' => self::faker()->firstName,
                    'lastname' => self::faker()->lastName
                ];
            }
        }
        return $result;
    }

    /**
     * Person.
     *
     * @return mixed[] (id, firstname, lastname)
     */
    public static function person(): array
    {
        return [
            'id' => self::faker()->numberBetween(1, 100),
            'firstname' => self::faker()->firstName,
            'lastname' => self::faker()->lastName
        ];
    }

    /**
     * Generate string.
     *
     * @param int $length
     * @param bool $numeric
     * @param bool $alpha
     * @return string
     */
    private static function generateString(int $length, bool $numeric, bool $alpha): string
    {
        $characterMap = self::CHARACTER_MAP;

        // Remove all numeric.
        if (!$numeric) {
            $characterMap = preg_replace('/[0-9]+/', '', $characterMap);
        }

        // Remove all alpha.
        if (!$alpha) {
            $characterMap = preg_replace('/[^0-9]/', '', $characterMap);
        }

        // Generate string.
        $result = '';
        if ($length > 0 && strlen($characterMap) > 0) {
            while (strlen($result) < $length) {
                $result .= str_shuffle($characterMap);
            }
            $result = substr($result, 0, $length);
        }

        return (string)$result;
    }
}