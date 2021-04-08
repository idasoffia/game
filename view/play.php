<?php

/**
 * Standard view template to generate a simple web page, or part of a web page.
 */

declare(strict_types=1);

use function Mos\Functions\play;
use function Mos\Functions\url;
use function Mos\Functions\pass;

use Mos\Dice\GraphicalDice;
use Mos\Dice\Dice;
use Mos\Dice\DiceHand;

$header = $header ?? null;

?>
<h1 class="game-title"><?= $header ?></h1>

<?php
$print = "You are playing with " . $_SESSION['diceQty'] . " dice and each die have " . $_SESSION['faceQty']." faces.";
echo $print;
if (array_key_exists('button1', $_POST)) {
    play();
} else if (array_key_exists('button2', $_POST)) {
    pass();
}

if ($_SESSION['message'] == "") { ?>
    <form method="post"class="play-panel">
        <input type="submit" name="button1"  value="Roll!" />
        <input type="submit" name="button2" value="Pass" />
    </form>

<?php }?>


<div>
<h1 style="color: red;"><?= $_SESSION['message'] ?></h1>
<p id="sum ">You rolled : <?= $_SESSION['rolls'][0] ?> Total: <?= $_SESSION['totalScore'][0] ?></p>
<p>Computer rolled: <?= $_SESSION['rolls'][1] ?> Total: <?= $_SESSION['totalScore'][1] ?></p>

<p>Winnings player: <?php echo $_SESSION['winningsPlayer']?></p>
<p>Winnings computer: <?php echo $_SESSION['winningsComp']?></p>

</div>
<p><a href='<?= url('/play21')?>'><input type='submit' value='Reset'/></a></p>
