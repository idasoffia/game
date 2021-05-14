<?php

declare(strict_types=1);

use function Mos\Functions\url;
use function Mos\Functions\buttonRoll;
use function Mos\Functions\buttonPass;


$header = $header ?? null;
$n = 1;

$chartArray = $_SESSION['chart'];

?>
<div class="wrap">
    <h1><?= $header ?></h1>
    <p>Choose wich dice to roll by checking the corresponding box and then hit "roll"
        to throw the choosen dice again. You have 3 goes for each round. Good luck!</p>

        <p>The five dice below shows:</p>

    <?php if ($chartArray["playsLeft"] > 0) { ?>
        <form method="POST" class="diceBox" action="<?= url("/yatzy/re-roll") ?>">

            <?php  foreach ($_SESSION['rolledValues'] as $dieface) { ?>
                <ul><li>
                <input type="checkbox" name="selectedDice[]" id="<?= $n ?>" value=<?= $n ?> />
                <label name="selectedDice[]" for="die<?= $n ?>">
                    <!-- <img src="../img/dice-<?= $dieface ?>.png" alt="die<?= $dieface ?>"> -->
                    <?= $dieface ?>
                </label>
            <li></ul>
                <?php $n++;
            } ?>
            <div class="rerolls-section">
                <?php if ($_SESSION['rollsLeft'] > 0) {?>
                    <button type="submit" class="roll-button">Roll!</button>
                <?php } else {?>
                    <h3 class >Choose wich dice to save by clicking "Save":</h3>
        </form>
        <form method="POST" action="<?= url("/yatzy/score") ?>" class="diceBox">
            <button type="submit" class="roll-button">Save</button>
        </form>
        <?php } ?>
        </div>


        <div class="possible-scores">
            <form method="POST" action="<?= url("/yatzy/record-score") ?>" class="diceBox">
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
                        <?php } ?>
                        <button type="submit" class="roll-button">Yes, I've made my choice</button>
                    <?php } ?>
                </div>

            </form>
        </div>
    <?php } ?>

    <div class="game-score">
        <!-- <p>Score card</p> -->

        <table class="ScoreChart">
            <tr>
                <th>Score Chart</th>
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
            <input type='submit' class="new-game-button" value='New game'/>
        </a>
    </p>

</div>
