<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Interfaces\QuotesInterface;
use App\Http\Resources\ShoutJsonResource;
use Illuminate\Http\Request;

/**
 * @resource
 *
 * Shout API endpoint that handles all the shout request
 */
class QuoteController extends Controller
{
    private $_quotesRepository;

    public function __construct(QuotesInterface $quotesRepository)
    {
        $this->_quotesRepository = $quotesRepository;
    }

    /**
     * Outputs quotes based on the title case value of the $author paramenter.
     *
     * @param string  $author  The author's name as slug string\
     * @param Request $request Thes query parameters of the API request
     *
     * @return string Json encoded array of quotes
     */
    public function shout($author, Request $request)
    {
        $this->validate(
            $request, [
                'limit' => 'required|numeric|min:1|max:10',
            ]
        );

        $quotes = $this->_quotesRepository->getQuotes(
            $author,
            $request->limit
        );

        return response()->json(
            ShoutJsonResource::collection($quotes),
            200, [
                'Content-Type' => 'application/json;charset=UTF-8',
                'Charset' => 'utf-8',
            ],
            JSON_UNESCAPED_UNICODE
        );
    }
}
