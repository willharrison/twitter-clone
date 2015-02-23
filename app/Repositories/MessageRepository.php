<?php
/**
 * Created by PhpStorm.
 * User: will
 * Date: 2/23/15
 * Time: 4:09 PM
 */

namespace Twitter\Repositories;


use Twitter\Message;

class MessageRepository {

    protected $repo;

    public function __construct(Message $repo)
    {
        $this->repo = $repo;
    }
}