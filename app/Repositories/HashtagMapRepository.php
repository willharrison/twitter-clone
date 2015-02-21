<?php
/**
 * Created by PhpStorm.
 * User: will
 * Date: 2/20/15
 * Time: 10:24 PM
 */

namespace Twitter\Repositories;


use Twitter\HashtagMap;

class HashtagMapRepository {

    protected $map;

    public function __construct(HashtagMap $map)
    {
        $this->map = $map;
    }

    public function latest($count)
    {
        return $this->map->orderBy('created_at')->take($count)->get();
    }
}