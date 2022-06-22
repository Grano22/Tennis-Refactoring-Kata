<?php

namespace TennisGame\Application\AggregateRoot;

use TennisGame\Application\Repository\PlayerRepository;
use TennisGame\Application\Service\PlayerRegistration;

class TennisGameNumberThree implements TennisGame
{
    private $p2 = 0;
    private $p1 = 0;
    private $p1N = '';
    private $p2N = '';

    public function __construct(
        private readonly PlayerRegistration $playerRegistration,
        private readonly PlayerRepository   $playersRepository,
        private readonly ScoreCollector     $scoreCollector,
        string $firstPlayerNick,
        string $secondPlayerNick
    )
    {
        $this->p1N = $p1N;
        $this->p2N = $p2N;
    }

    public function getMatchScoreDescription(): string
    {
        if ($this->p1 < 4 && $this->p2 < 4 && !($this->p1 + $this->p2 == 6)) {
            $p = array("Love", "Fifteen", "Thirty", "Forty");
            $s = $p[$this->p1];
            return ($this->p1 == $this->p2) ? "{$s}-All" : "{$s}-{$p[$this->p2]}";
        } else {
            if ($this->p1 == $this->p2) {
                return "Deuce";
            }
            $s = $this->p1 > $this->p2 ? $this->p1N : $this->p2N;
            return (($this->p1 - $this->p2) * ($this->p1 - $this->p2) == 1) ? "Advantage {$s}" : "Win for {$s}";
        }
    }
}
