<?php
/**
 * Created by PhpStorm.
 * User: will
 * Date: 2/13/15
 * Time: 10:27 PM
 */

namespace Twitter\Repositories;


use Twitter\Hashtag;

class HashtagRepository {

    protected $hashtag;

    public function __construct(Hashtag $hashtag)
    {
        $this->hashtag = $hashtag;
    }

    public function findByName($name)
    {
        return $this->hashtag->where('hashtag', $name)->first();
    }
}