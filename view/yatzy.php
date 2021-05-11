<?php

/**
 * Standard view template to generate a simple web page, or part of a web page.
 */

declare(strict_types=1);

use function Mos\Functions\url;

$header = $header ?? null;

?>

<div class="game21-wrapper">
    <h1 class="game-title"><?= $header ?></h1>

    <form action="<?= url("/yatzy/play") ?>" method="POST" class="die-choice">
        <button type="submit" class="new-game-button" name="start" value="Play">Play!</button>
    </form>
</div>
