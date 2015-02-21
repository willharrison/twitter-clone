<?php
/**
 * Created by PhpStorm.
 * User: will
 * Date: 2/20/15
 * Time: 10:21 PM
 */

namespace Twitter\Services;

use Twitter\Repositories\HashtagMapRepository;

class Trending {

    private $bucket;
    protected $mapRepo;

    public function __construct(HashtagMapRepository $mapRepo)
    {
        $this->mapRepo = $mapRepo;
        $this->bucket = [];
    }

    public function get($count, $outof)
    {
        foreach ($this->mapRepo->latest($outof) as $map)
        {
            $name = $map->hashtag->hashtag;
            if (array_key_exists($name, $this->bucket))
            {
                $this->bucket[$name] = $this->bucket[$name] + 1;
            }
            else
            {
                $this->bucket[$name] = 1;
            }
        }

        array_multisort($this->bucket, SORT_DESC, SORT_NUMERIC);
        return array_slice($this->bucket, 0, $count, true);
    }
}