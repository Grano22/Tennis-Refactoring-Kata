<?php

namespace TennisGame\Application\AggregateRoot;

interface TennisGame
{
    public function wonPoint(string $playerNick): void;
    public function getMatchScoreDescription(): string;
}
