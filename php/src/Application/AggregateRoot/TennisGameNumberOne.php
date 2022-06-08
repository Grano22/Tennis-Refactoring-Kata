<?php

namespace TennisGame\Application\AggregateRoot;

use TennisGame\Application\Composite\GamePointsMessageCompositeSpecification;
use TennisGame\Application\Composite\GamePointsMessageStrategyComposite;
use TennisGame\Application\Repository\PlayersRepository;
use TennisGame\Domain\Entity\Player;
use TennisGame\Domain\Exception\PlayerNickIsAlreadyTaken;
use TennisGame\Domain\Policy\PlayerRegistrationPolicy;

class TennisGameNumberOne implements TennisGame
{
    private $player1Name = '';
    private $player2Name = '';

    public function __construct(
        private readonly PlayerRegistrationPolicy $playerRegistrationPolicy,
        private readonly PlayersRepository $playersRepository,
        private readonly ScoreCollector $scoreCollector,
        string $firstPlayerNick,
        string $secondPlayerNick
    ) {
        $this->registerPlayers(new Player($firstPlayerNick), new Player($secondPlayerNick));
        $this->scoreCollector->initiateForPlayer($firstPlayerNick);
        $this->scoreCollector->initiateForPlayer($secondPlayerNick);
    }

    public function wonPoint(string $playerNick): void
    {
        $this->scoreCollector->addPointToPlayer($playerNick);
    }

    public function getMatchScoreDescription(): string
    {
        list($playerNumberOne, $playerNumberTwo) = $this->playersRepository->findAll()->toArray();

        $firstPlayerPoints = $this->scoreCollector->getByPlayer($playerNumberOne->nick);
        $secondPlayerPoints = $this->scoreCollector->getByPlayer($playerNumberTwo->nick);

        $specificationDetails = (new GamePointsMessageCompositeSpecification())
            ->isSatisfiedBy($firstPlayerPoints, $secondPlayerPoints);

        return (new GamePointsMessageStrategyComposite())
            ->produceMessageFromStrategiesWhichSupportSpecification(
                $specificationDetails,
                $firstPlayerPoints,
                $secondPlayerPoints
            );
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
