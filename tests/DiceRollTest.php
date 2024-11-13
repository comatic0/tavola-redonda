<?php
use PHPUnit\Framework\TestCase;

class DiceRollTest extends TestCase
{
    public function testRollDiceD4()
    {
        $result = DiceRoller::roll(4);
        $this->assertGreaterThanOrEqual(1, $result);
        $this->assertLessThanOrEqual(4, $result);
    }

    public function testRollDiceD6()
    {
        $result = DiceRoller::roll(6);
        $this->assertGreaterThanOrEqual(1, $result);
        $this->assertLessThanOrEqual(6, $result);
    }

    public function testRollDiceD8()
    {
        $result = DiceRoller::roll(8);
        $this->assertGreaterThanOrEqual(1, $result);
        $this->assertLessThanOrEqual(8, $result);
    }

    public function testRollDiceD10()
    {
        $result = DiceRoller::roll(10);
        $this->assertGreaterThanOrEqual(1, $result);
        $this->assertLessThanOrEqual(10, $result);
    }

    public function testRollDiceD12()
    {
        $result = DiceRoller::roll(12);
        $this->assertGreaterThanOrEqual(1, $result);
        $this->assertLessThanOrEqual(12, $result);
    }

    public function testRollDiceD20()
    {
        $result = DiceRoller::roll(20);
        $this->assertGreaterThanOrEqual(1, $result);
        $this->assertLessThanOrEqual(20, $result);
    }

    public function testRollDiceD100()
    {
        $result = DiceRoller::roll(100);
        $this->assertGreaterThanOrEqual(1, $result);
        $this->assertLessThanOrEqual(100, $result);
    }

    public function testRollCustomDice()
    {
        $sides = 20;
        $result = DiceRoller::roll($sides);
        $this->assertGreaterThanOrEqual(1, $result);
        $this->assertLessThanOrEqual($sides, $result);
    }
}

class DiceRoller
{
    public static function roll($sides)
    {
        return rand(1, $sides);
    }
}