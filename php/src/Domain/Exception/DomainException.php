<?php

namespace TennisGame\Domain\Exception;

interface DomainException
{
    public static function create(string $details): self;
}