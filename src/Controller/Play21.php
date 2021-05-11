<?php

declare(strict_types=1);

namespace Mos\Controller;

use Nyholm\Psr7\Factory\Psr17Factory;
use Psr\Http\Message\ResponseInterface;

use function Mos\Functions\renderView;
use function Mos\Functions\resetGame;
use function Mos\Functions\url;

/**
 * Controller for the index route.
 */
class Play21
{
    use ControllerTrait;

    public function play21Start(): ResponseInterface
    {
        $data = [
            "header" => "Play 21",
        ];

        // $playerNumberOfRolls = 0;
        // $compNumberOfRolls = 0;
        $_SESSION['diceQty'] = 2;
        $_SESSION['faceQty'] = 6;
        $_SESSION['totalScore'] = array(0 , 0);
        $_SESSION['winningsPlayer'] = 0;
        $_SESSION['winningsComp'] = 0;
        $_SESSION['rolls'] = array(0, 0);
        $_SESSION['message'] = "";
        $body = renderView("layout/play21.php", $data);

        return $this->response($body);
    }

    public function play21Play(): ResponseInterface
    {
        $data = [
            "header" => "Play 21",
        ];

        $body = renderView("layout/play.php", $data);

        return $this->response($body);
    }

    public function play21Sethand(): ResponseInterface
    {
        if (!isset($_POST['diceQty'])) {
            $diceQty = 1;
            $_SESSION['diceQty'] = $diceQty;
            return $this->redirect(url("/play21/play"));
        }

        $diceQty = $_POST['diceQty'];
        $_SESSION['diceQty'] = $diceQty;
        return $this->redirect(url("/play21/play"));
    }

    public function play21Reset(): ResponseInterface
    {
        resetGame();
        return $this->redirect(url("/play21/play"));
    }
}
