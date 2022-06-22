<?php

declare(strict_types=1);


namespace TennisGame\Application\Service;

use TennisGame\Application\Repository\PlayerRepository;
use TennisGame\Domain\Entity\Player;
use TennisGame\Domain\Exception\PlayerNickIsAlreadyTaken;
use TennisGame\Domain\Policy\PlayerRegistrationPolicy;

final class PlayerRegistration
{
    public function __construct(
        private readonly PlayerRegistrationPolicy $playerRegistrationPolicy,
        private readonly PlayerRepository $playersRepository,
    ) {
    }

    /**
     * @throws PlayerNickIsAlreadyTaken
     */
    public function registerPlayers(Player ...$players): void
    {
        foreach ($players as $player) {
            if (!$this->playerRegistrationPolicy->usernameIsUnique($player->nick)) {
                throw PlayerNickIsAlreadyTaken::forGivenNick($player->nick);
            }

            $this->playersRepository->store($player->nick);
        }
    }

    public function unregisterAll(): void
    {
        $this->playersRepository->clear();
    }
}
