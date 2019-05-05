<?php

declare(strict_types=1);

namespace Tests\CoRex\Testing;

use CoRex\Testing\TestData;
use Exception;
use Faker\Generator;
use PHPUnit\Framework\TestCase;

class TestDataTest extends TestCase
{
    /**
     * Test Faker instance.
     */
    public function testFakerInstance(): void
    {
        $this->assertInstanceOf(Generator::class, TestData::faker());
    }

    /**
     * Test number.
     *
     * @throws Exception
     */
    public function testNumber(): void
    {
        $this->assertIsInt(TestData::number());
    }

    /**
     * Test string.
     */
    public function testString(): void
    {
        $characterMap = TestData::CHARACTER_MAP;

        // Compare in lower-case.
        $string = TestData::string(strlen($characterMap));
        $this->checkIfStringContainsCharacters($characterMap, $string, false);

        // Compare in lower-case.
        $string = TestData::string(strlen($characterMap), true);
        $this->checkIfStringContainsCharacters($characterMap, $string, true);
    }

    /**
     * Test string alpha.
     */
    public function testStringAlpha(): void
    {
        $characterMap = preg_replace('/[0-9]+/', '', TestData::CHARACTER_MAP);

        // Compare in lower-case.
        $string = TestData::stringAlpha(strlen($characterMap));
        $this->checkIfStringContainsCharacters($characterMap, $string, false);

        // Compare in lower-case.
        $string = TestData::stringAlpha(strlen($characterMap), true);
        $this->checkIfStringContainsCharacters($characterMap, $string, true);
    }

    /**
     * Test string numeric.
     */
    public function testStringNumeric(): void
    {
        $characterMap = preg_replace('/[^0-9]/', '', TestData::CHARACTER_MAP);

        // Compare in lower-case.
        $string = TestData::stringNumeric(strlen($characterMap));
        $this->checkIfStringContainsCharacters($characterMap, $string, false);

        // Compare in lower-case.
        $string = TestData::stringNumeric(strlen($characterMap), true);
        $this->checkIfStringContainsCharacters($characterMap, $string, true);
    }

    /**
     * Test people.
     *
     * @throws Exception
     */
    public function testPeople(): void
    {
        $count = TestData::number(1, 10);
        $people = TestData::people($count);
        $this->assertCount($count, $people);
        foreach ($people as $person) {
            $this->assertIsInt($person['id']);
            $this->assertIsString($person['firstname']);
            $this->assertIsString($person['lastname']);
        }
    }

    /**
     * Test person.
     */
    public function testPerson(): void
    {
        $person = TestData::person();
        $this->assertIsInt($person['id']);
        $this->assertIsString($person['firstname']);
        $this->assertIsString($person['lastname']);
    }

    /**
     * Check if string contains characters.
     *
     * @param string $characterMap
     * @param string $characters
     * @param bool $toUpper
     */
    private function checkIfStringContainsCharacters(string $characterMap, string $characters, bool $toUpper): void
    {
        $this->assertEquals(strlen($characterMap), strlen($characters));
        $this->assertNotEquals($characterMap, $characters);
        for ($c1 = 0; $c1 < strlen($characterMap); $c1++) {
            $character = $characterMap[$c1];
            if ($toUpper) {
                $character = strtoupper($character);
            }
            $this->assertStringContainsString($character, $characters);
        }
    }
}