<?php

namespace App\Interfaces;

interface QuotesInterface
{
    public function getQuotes(string $author, int $limit);
}
