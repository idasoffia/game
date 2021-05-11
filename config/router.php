<?php

/**
 * Load the routes into the router, this file is included from
 * `htdocs/index.php` during the bootstrapping to prepare for the request to
 * be handled.
 */

declare(strict_types=1);

use FastRoute\RouteCollector;

$router->addRoute("GET", "/test", function () {
    // A quick and dirty way to test the router or the request.
    return "Testing response";
});

$router->addRoute("GET", "/", "\Mos\Controller\Index");
$router->addRoute("GET", "/debug", "\Mos\Controller\Debug");
$router->addRoute("GET", "/twig", "\Mos\Controller\TwigView");

$router->addGroup("/play21", function (RouteCollector $router) {
    $router->addRoute("GET", "", ["\Mos\Controller\play21", "play21Start"]);
    $router->addRoute("POST", "/set-hand", ["\Mos\Controller\Play21", "play21Sethand"]);
    $router->addRoute("GET", "/reset", ["\Mos\Controller\Play21", "play21Reset"]);
    $router->addRoute("POST", "/reset", ["\Mos\Controller\Play21", "play21Reset"]);
    $router->addRoute("GET", "/play", ["\Mos\Controller\Play21", "play21Play"]);
    $router->addRoute("POST", "/play", ["\Mos\Controller\Play21", "play21Play"]);
});

$router->addRoute("GET", "/dice", "\Mos\Controller\Dice");

$router->addGroup("/yatzy", function (RouteCollector $router) {
    $router->addRoute("GET", "", ["\Mos\Controller\Yatzy", "intro"]);
    $router->addRoute("POST", "/play", ["\Mos\Controller\Yatzy", "play"]);
    $router->addRoute("GET", "/play", ["\Mos\Controller\Yatzy", "play"]);
    $router->addRoute("POST", "/re-roll", ["\Mos\Controller\Yatzy", "reroll"]);
    $router->addRoute("POST", "/score", ["\Mos\Controller\Yatzy", "score"]);
    $router->addRoute("POST", "/record-score", ["\Mos\Controller\Yatzy", "recordScore"]);
    $router->addRoute("GET", "/game-over", ["\Mos\Controller\Yatzy", "gameOver"]);
});

$router->addGroup("/session", function (RouteCollector $router) {
    $router->addRoute("GET", "", ["\Mos\Controller\Session", "index"]);
    $router->addRoute("GET", "/destroy", ["\Mos\Controller\Session", "destroy"]);
});

$router->addGroup("/some", function (RouteCollector $router) {
    $router->addRoute("GET", "/where", ["\Mos\Controller\Sample", "where"]);
});
