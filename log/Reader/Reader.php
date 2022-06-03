<?php

namespace Log\Reader;

interface Reader
{
    public function hasMoreLines(): bool;
    public function nextLine(): string;

}