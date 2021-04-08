<?php

declare(strict_types=1);
namespace Mos\Router;

use function Mos\Functions\destroySession;
use function Mos\Functions\redirectTo;
use function Mos\Functions\renderView;
use function Mos\Functions\renderTwigView;
use function Mos\Functions\sendResponse;
use function Mos\Functions\url;
use function Mos\Functions\reset;

class Router
{
    public static function dispatch(string $method, string $path): void
    {
        if ($method === "GET" && $path === "/" || $path === "/dice") {
            $data = [
                "header" => "Let's roll!",
                "message" => "Play with a singel die or a dicehand",
            ];
            $body = renderView("layout/dice.php", $data);
            sendResponse($body);
            return;
        } else if ($method === "GET" && $path === "/play21") {
            $data = [
                "header" => "Let's play the game of 21!",
                "message" => "Play with a singel die or a dicehand",
            ];

            $playerNumberOfRolls = 0;
            $compNumberOfRolls = 0;
            $_SESSION['rolls'] = array($playerNumberOfRolls, $compNumberOfRolls);
            $_SESSION['totalScore'] = array(0 , 0);
            $_SESSION['message'] = "";
            $_SESSION['winningsPlayer'] = 0;
            $_SESSION['winningsComp'] = 0;
            $body = renderView("layout/play21.php", $data);
            sendResponse($body);
            return;
        } else if ($method === "POST" && $path === "/play21/go") {
            $diceQty = (int)$_POST['diceQty'] ?? 1;
            $faceQty = (int)$_POST['faceQty'] ?? 6;
            $_SESSION['faceQty'] = $faceQty;
            $_SESSION['diceQty'] = $diceQty;

            redirectTo(url("/play21/play"));
            return;
        } else if ($method === "GET" && $path === "/play21/reset") {
            reset();
            redirectTo(url("/play21/play"));
            return;
        } else if ($method === "GET" || $method === "POST" && $path === "/play21/play") {
            $data = [
                "header" => "GAME 21",
            ];

            $body = renderView("layout/play.php", $data);
            sendResponse($body);

            return;
        }
    }
}
