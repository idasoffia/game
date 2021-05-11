<?php
declare(strict_types=1);
use function Mos\Functions\url;
use Mos\Dice\GraphicalDie;


$header = $header ?? null;
$message = $message ?? null;
$graphicalDie = new GraphicalDie();
$graphicalDie->roll();
?>
<h1 class="game-title"><?= $header ?></h1>
<p>Press roll to roll the die!<p>

<!-- <form action="<?= url("/dice")?>" method="post" class="numberOfDice">
    <button type="submit" name="diceQty" value="1">Roll die!</button>
</form> -->


<p>Graphical die rolls:</p>
<p><?= $graphicalDie->getLastRoll() ?></p>
<img src="../htdocs/<?= $graphicalDie->graphic() ?>.png" alt="die">

<p>Hit refresh to roll again</p>
