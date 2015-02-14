<?php
/**
 * Created by PhpStorm.
 * User: will
 * Date: 2/13/15
 * Time: 10:31 PM
 */

namespace Twitter\Factories;


use Illuminate\Database\QueryException;
use Illuminate\Log\Writer;
use Twitter\Hashtag;
use Twitter\Repositories\HashtagRepository;

class HashtagFactory {

    protected $hashtag, $repo, $logger;

    public function __construct(
        Hashtag $hashtag,
        HashtagRepository $repo,
        Writer $logger)
    {
        $this->hashtag = $hashtag;
        $this->repo = $repo;
        $this->logger = $logger;
    }

    public function create($name)
    {
        try
        {
            $this->hashtag->create([
                "hashtag" => $name
            ]);
        }
        catch(QueryException $e)
        {
            $this->logger->info(
                "Hashtag already exists",
                ['message' => $e->getMessage()]
			);
        }
    }
}