<?php

declare(strict_types=1);


namespace TennisGame\Domain\Policy;

use TennisGame\Application\Repository\PlayersRepository;

final class PlayerRegistrationPolicy
{
    public function __construct(private readonly PlayersRepository $playersRepository) {}

    public function usernameIsUnique(string $givenUsername): bool
    {
        return !$this->playersRepository->hasWithNick($givenUsername);
    }
}
