<?php

declare(strict_types=1);

namespace Mos\Dice;

/**
 * Class Dice.
 */
 class GraphicalDie
 {
     const FACES = 6;
     private $sum = 0;

     public function roll(): int
     {
         $this->sum = rand(1, self::FACES);
         return $this->sum;
     }

     public function getLastRoll(): int
     {
         return $this->sum;
     }
     public function graphic(): string
     {
    return "face-" . $this->getLastRoll();
    }
}
