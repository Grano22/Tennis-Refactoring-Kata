<?php

namespace TennisGame;

use TennisGame\Application\Repository\PlayersRepository;
use TennisGame\Domain\Exception\PlayerNickIsAlreadyTaken;
use TennisGame\Domain\Player;
use TennisGame\Domain\Policy\PlayerRegistrationPolicy;

class TennisGame1 implements TennisGame
{
    private $m_score1 = 0;
    private $m_score2 = 0;
    private $player1Name = '';
    private $player2Name = '';

    public function __construct(
        private readonly PlayerRegistrationPolicy $playerRegistrationPolicy,
        private readonly PlayersRepository $playersRepository,
        string $firstPlayerNick, string $secondPlayerNick
    ) {
        $this->registerPlayers(new Player($firstPlayerNick), new Player($secondPlayerNick));
    }

    public function wonPoint($playerName)
    {
        if ('player1' == $playerName) {
            $this->m_score1++;
        } else {
            $this->m_score2++;
        }
    }

    public function getScore()
    {
        $score = "";
        if ($this->m_score1 == $this->m_score2) {
            switch ($this->m_score1) {
                case 0:
                    $score = "Love-All";
                    break;
                case 1:
                    $score = "Fifteen-All";
                    break;
                case 2:
                    $score = "Thirty-All";
                    break;
                default:
                    $score = "Deuce";
                    break;
            }
        } elseif ($this->m_score1 >= 4 || $this->m_score2 >= 4) {
            $minusResult = $this->m_score1 - $this->m_score2;
            if ($minusResult == 1) {
                $score = "Advantage player1";
            } elseif ($minusResult == -1) {
                $score = "Advantage player2";
            } elseif ($minusResult >= 2) {
                $score = "Win for player1";
            } else {
                $score = "Win for player2";
            }
        } else {
            for ($i = 1; $i < 3; $i++) {
                if ($i == 1) {
                    $tempScore = $this->m_score1;
                } else {
                    $score .= "-";
                    $tempScore = $this->m_score2;
                }
                switch ($tempScore) {
                    case 0:
                        $score .= "Love";
                        break;
                    case 1:
                        $score .= "Fifteen";
                        break;
                    case 2:
                        $score .= "Thirty";
                        break;
                    case 3:
                        $score .= "Forty";
                        break;
                }
            }
        }
        return $score;
    }

    /**
     * @throws PlayerNickIsAlreadyTaken
     */
    private function registerPlayers(Player ...$players): void
    {
        foreach ($players as $player) {
            if (!$this->playerRegistrationPolicy->usernameIsUnique($player->nick)) {
                throw PlayerNickIsAlreadyTaken::forGivenNick($player->nick);
            }

            $this->playersRepository->store($player->nick);
        }

        $this->player1Name = $players[0]->nick;
        $this->player2Name = $players[1]->nick;
    }
}
