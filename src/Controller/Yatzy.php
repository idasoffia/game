<?php

declare(strict_types=1);

namespace Mos\Controller;

use Nyholm\Psr7\Factory\Psr17Factory;
use Psr\Http\Message\ResponseInterface;
use Mos\Yatzy\ScoreChart;
use Mos\Yatzy\Logics;

use function Mos\Functions\destroySession;
use function Mos\Functions\renderView;
use function Mos\Functions\url;


/**
 * Controller for Yatzy game.
 */

class Yatzy
{
    use ControllerTrait;

    private Logics $logics;
    private ScoreChart $scoreChart;
    private array $currentSession;

    public function intro(): ResponseInterface
    {
        $this->initialize();
        $_SESSION['rollsLeft'] = 2;
        $this->uploadChart();

        $data = [
            "header" => "Yatzy",
        ];

        $body = renderView("layout/yatzy.php", $data);


        return $this->response($body);
    }


    public function play(): ResponseInterface
    {
        $this->initialize();

        if (!array_key_exists('rolledValues', $this->currentSession)) {
            $this->logics->rollHand();
            $rolledDiceValues = $this->logics->getRolledDiceValues();
            $_SESSION['rolledValues'] = $rolledDiceValues;
        }

        $data = [
            "header" => "Yatzy",
        ];

        $body = renderView("layout/yatzyGame.php", $data);

        return $this->response($body);
    }

    public function reroll(): ResponseInterface
    {
        $this->initialize();

        if ($_SESSION['rollsLeft'] > 0) {
            $this->rerollSelectedDice();
            $_SESSION['rollsLeft'] = $_SESSION['rollsLeft'] - 1;
        }
        return $this->redirect(url("/yatzy/play"));
    }

    public function score(): ResponseInterface
    {
        $this->initialize();

        $combos =  $this->logics->scorableCombos($_SESSION['rolledValues']);
        $possibleScores = $this->logics->comboTotal($combos);
        $_SESSION['possibleScores'] = $possibleScores;
        return $this->redirect(url("/yatzy/play"));
    }

    public function recordScore(): ResponseInterface
    {
        $this->initialize();

        if (isset($_POST['selectedScore'])) {
            $key = $_POST['selectedScore'];
            $this->logics->setScore($key, $_SESSION['possibleScores'][$key]);
            $_SESSION['chart'] = $this->logics->getScores();
        }
        unset($_SESSION['possibleScores']);
        unset($_SESSION['rolledValues']);
        $_SESSION['rollsLeft'] = 2;

        return $this->redirect(url("/yatzy/play"));
    }

    public function gameOver(): ResponseInterface
    {
        $this->scoreChart = new ScoreChart();
        $this->uploadChart();

        // destroySession();
        // $this->initialize();
        // $this->uploadChart();

        $_SESSION['rollsLeft'] = 2;
        return $this->redirect(url("/yatzy/play"));
    }

    private function initialize()
    {
        $this->currentSession = $_SESSION;
        if (array_key_exists('chart', $this->currentSession)) {
            $chartArray = $this->currentSession['chart'];
            $this->scoreChart = new ScoreChart($chartArray);
        } else {
            $newChart = new ScoreChart();
            $this->scoreChart = $newChart;
        }

        $this->logics = new Logics($this->scoreChart->getScoreChart());
    }


    private function rerollSelectedDice()
    {
        $originalRolls = $_SESSION['rolledValues'];
        if (!isset($_POST['selectedDice'])) {
            return;
        }
        $selectedDice = $_POST['selectedDice'];

        $newDiceQty = count($selectedDice);
        $newDiceValues = $this->logics->reRoll($newDiceQty);
        $ior = 0;

        foreach ($selectedDice as $selected) {
            $originalRolls[$selected - 1] = $newDiceValues[$ior];
            $ior++;
        }
        $_SESSION['rolledValues'] = $originalRolls;
    }


    private function uploadChart()
    {
        $_SESSION['chart'] = $this->scoreChart->getScoreChart();
    }
}
