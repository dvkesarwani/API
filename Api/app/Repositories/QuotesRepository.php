<?php

namespace App\Repositories;

use App\Interfaces\QuotesInterface;
use Cache;

class QuotesRepository implements QuotesInterface
{
    private $_cacheLife = 120;

    public function getQuotes(string $author, int $limit)
    {
        $result = Cache::remember(
            $author.'-'.$limit.'.cache',
            $this->_cacheLife,
            function () use ($author, $limit) {
                $autorName = ucwords(str_replace('-', ' ', $author));
                $data_source = storage_path('data/quotes.json');
                $data = json_decode(file_get_contents($data_source));

                $quotesCollection = collect($data->quotes);

                return $quotesCollectionResult = $quotesCollection
                    ->where('author', $autorName)
                    ->take($limit);
            }
        );

        return $result;
    }
}
