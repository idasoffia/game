<?php

declare(strict_types=1);

use function Mos\Functions\url;
use function Mos\Functions\buttonRoll;
use function Mos\Functions\buttonPass;


$header = $header ?? null;
$n = 1;

$chartArray = $_SESSION['chart'];

?>
<div class="game21-wrapper">
    <h1 class="game-title"><?= $header ?></h1>

    <?php if ($chartArray["playsLeft"] > 0) { ?>
        <form method="POST" class="diceBox" action="<?= url("/yatzy/re-roll") ?>">

            <?php  foreach ($_SESSION['rolledValues'] as $dieface) { ?>
                <input type="checkbox" name="selectedDice[]" id="die<?= $n ?>" value=<?= $n ?> />
                <label name="selectedDice[]" for="die<?= $n ?>">
                    <img src="../img/dice-<?= $dieface ?>.png" alt="die<?= $dieface ?>">
                </label>
                <?php $n++;
            } ?>
            <div class="rerolls-section">
                <?php if ($_SESSION['rollsLeft'] > 0) {?>
                    <button type="submit" class="roll-button">Re-roll</button>
                <?php } else {?>
                    <h1 class >NO ROLLS LEFT</h1>
                <?php } ?>
            </div>
        </form>

        <form method="POST" action="<?= url("/yatzee/score") ?>" class="diceBox">
            <button type="submit" class="roll-button">CALCULATE</button>
        </form>

        <div class="possible-scores">
            <form method="POST" action="<?= url("/yatzee/record-score") ?>" class="diceBox">
                <div class="radio-scores">
                    <?php if (isset($_SESSION['possibleScores'])) {
                        foreach ($_SESSION['possibleScores'] as $key => $value) {?>
                                <input type="radio"  name="selectedScore" value="<?= $key ?>" id="<?= $key ?>"
                                <?php if (!empty($chartArray[$key]) || ($chartArray[$key] > -1)) { ?>
                                    disabled
                                <?php } ?> >
                                <label for="<?= $key ?>"
                                    <?php if (!empty($chartArray[$key]) || ($chartArray[$key] > -1)) { ?>
                                        style="text-decoration: line-through"
                                    <?php } ?>
                                >
                                <?= $key ?>'s score <?= $value ?>
                                </label><br>
                        <?php }
                    } ?>
                </div>
                <button type="submit" class="roll-button">Record Score</button>
            </form>
        </div>
    <?php } ?>

    <div class="game-score">
        <p>Score card</p>

        <table class="rounds">
            <tr>
                <th>Category</th>
                <th>Score</th>
            </tr>
            <?php
            if (!is_null($chartArray)) {
                foreach (array_keys($chartArray) as $key) :
                    if ($key != "playsLeft") {?>
                        <tr>
                            <td><?= $key ?></td>
                            <td><?= $chartArray[$key] ?></td>
                        </tr>
                    <?php }
                endforeach;
            }?>
        </table>

    </div>

    <p>
        <a href='<?= url('/yatzy/game-over')?>'>
            <input type='submit' class="new-game-button" value='RESET SCORE / PLAY NEW GAME'/>
        </a>
    </p>

</div>
