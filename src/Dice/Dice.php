<?php

declare(strict_types=1);

namespace Mos\Dice;

// use function Mos\Functions\{
//     destroySession,
//     redirectTo,
//     rend
class Dice
{
    const FACES = 6;
    private $sum = 0;

    public function roll($diceQty, $faces): int
    {
        $this->sum = rand(1, $faces);
        return $this->sum;
    }

    public function getLastRoll(): int
    {
        return $this->sum;
    }

    public function getRollSum(): int
    {
        return $this->sum;
    }
}

    // public function __construct(int $facesVar)
    // {
    // $this->faces = $facesVar;
    // }
