<?php

declare(strict_types=1);


namespace TennisGame\Application\Exception;

use RuntimeException;

final class GameIsNotConfigured extends RuntimeException
{
    public static function create(): self
    {
        return new self();
    }

    private function __construct() {
        parent::__construct('Game must be configured before performing some actions, please use setupGame');
    }
}
