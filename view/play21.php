<?php
declare(strict_types=1);
use function Mos\Functions\url;

$header = $header ?? null;
$message = $message ?? null;
?>
<h1 class="game-title"><?= $header ?></h1>
<p>Start by choosing how many dice you want to play with<p>

<form action="<?= url("/play21/go")?>" method="post" class="numberOfDice">
    <div>
        <input type="radio" id="1" name="diceQty" value="1">
        <label for="1">1 die</label><br>
        <input type="radio" id="2" name="diceQty" value="2">
        <label for="2">2 dice</label><br>
    </div>
    <p>------------------------------------------------------------------</p>
    <div>
        <input type="radio" id="3faces"  name="faceQty" value="3">
        <label for="3faces">die/dice with 3 faces</label><br>
        <input type="radio" id="4faces" name="faceQty" value="4">
        <label for="4faces">die/dice with 4 faces</label><br>
        <input type="radio" id="5faces"  name="faceQty" value="5">
        <label for="5faces">die/dice with 5 faces</label><br>
        <input type="radio" id="6faces" name="faceQty" value="6">
        <label for="4faces">die/dice with 6 faces</label><br>
    <div>
    <p> </p>

    <button type="submit" class="new-game-button" name="start" value="Play">Play</button>
</form>
