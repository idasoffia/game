<?php

declare(strict_types=1);

namespace Mos\Dice;

// use function Mos\Functions\{
//     destroySession,
//     redirectTo,
//     renderView,
//     renderTwigView,
//     sendResponse,
//     url
// };

/**
 * Class Router.
 */
class DiceHand
{
    private $allDice = array();



    private $sum = 0;

    public function __construct(int $diceQty, $faces)
    {
        for ($i = 0; $i < $diceQty; $i++) {
            $this->allDice[$i] = new Dice($faces);
        }
    }

    public function roll(int $diceQty, $faces): void
    {
        $this->sum = 0;
        for ($i = 0; $i < $diceQty; $i++) {
            $this->sum += $this->allDice[$i]->roll($diceQty, $faces);
        }
    }

    public function getLastHandRoll(int $diceQty): string
    {
        $res = "";
        for ($i = 0; $i < $diceQty; $i++) {
            $res .= $this->allDice[$i]->getLastRoll() . ", ";
        }
        return $res . " = " . $this->sum;
    }

    public function getRollSum(): int
    {
        return $this->sum;
    }

    public function getLastHandRollArray(int $diceQty): array
    {
        $res = array();
        for ($i = 0; $i < $diceQty; $i++) {
            $res[$i] = $this->allDice[$i]->getLastRoll();
        }
        return $res;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getAllDice(): array
    {
        return $this->allDice;
    }

}
