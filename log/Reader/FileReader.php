<?php

namespace Log\Reader;

class FileReader implements Reader
{
    private \SplFileObject $file;

    public function __construct(string $path)
    {
        $this->file = new \SplFileObject($path);
    }

    public function hasMoreLines(): bool
    {
        return !$this->file->eof();
    }

    public function nextLine(): string
    {
        return str_replace(PHP_EOL, '', $this->file->fgets());
    }
}