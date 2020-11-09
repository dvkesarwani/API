<?php
/**
 * PHP version >= 7.0.
 *
 * @category Console_Command
 */

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Interfaces\QuotesInterface;
use App\Http\Resources\ShoutJsonResource;

/**
 * Class deletePostsCommand.
 *
 * @category Console_Command
 */
class ShoutQuoteCommand extends Command
{
    private $_quotesRepository;

    public function __construct(QuotesInterface $quotesRepository)
    {
        $this->_quotesRepository = $quotesRepository;
        parent::__construct();
    }

    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'quote:shout';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Shout a quote from a given author.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $author = $this->ask('Enter the name of the author. You can use real name or the author`s slug.');
        $limit = $this->ask('Enter the number of quotes to retrieve. Min 1, max 10.');

        $validEntries = true;

        if (empty($author)) {
            $this->error('Please enter a valid author name.');
            $validEntries = false;
        }

        if (is_numeric($limit) == false || empty($limit) || $limit > 10 || $limit < 1) {
            $this->error('You have entered an invalid limit amount.');
            $validEntries = false;
        }

        if (!$validEntries) {
            $this->line('');

            return;
        }

        $quotes = $this->_quotesRepository->getQuotes(
            $author,
            $limit
        );

        $response = json_decode(
            response()->json(
                ShoutJsonResource::collection($quotes),
                200, [
                    'Content-Type' => 'application/json;charset=UTF-8',
                    'Charset' => 'utf-8',
                ],
                JSON_UNESCAPED_UNICODE
            )->content()
        );

        if (empty($response)) {
            $this->error('Quotes by '.$author.' cannot be found.');
        } else {
            foreach ($response as $quote) {
                $this->line($quote);
            }
        }

        $this->line('');

        return;
    }
}
