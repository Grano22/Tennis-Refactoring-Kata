<?php

declare(strict_types=1);


namespace TennisGame\Application\Factory;

use TennisGame\Application\GameMode\FirstGameMode;
use TennisGame\Application\GameMode\GameMode;
use TennisGame\Domain\Exception\UnsupportedGameMode;

final class GameModeFactory extends PreparedFactory
{
    public const SUPPORTED_PRESCRIPTIONS = [
        FirstGameMode::class
    ];

    public function __construct()
    {
    }

    /**
     * @throws UnsupportedGameMode
     */
    public function create(string $gameMode): GameMode
    {
        if (!in_array($gameMode, self::SUPPORTED_PRESCRIPTIONS, true)) {
            throw UnsupportedGameMode::create($gameMode);
        }

        return new $gameMode;
    }
}
