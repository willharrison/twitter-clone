<?php
/**
 * Created by PhpStorm.
 * User: will
 * Date: 2/23/15
 * Time: 4:09 PM
 */

namespace Twitter\Factories;


use Twitter\Message;

class MessageFactory {

    protected $factory;

    public function __construct(Message $factory)
    {
        $this->factory = $factory;
    }

    public function create($from, $to, $message)
    {
        $message = $this->factory->create([
            'from_id' => $from,
            'to_id' => $to,
            'message' => $message
        ]);

        return $message->id;
    }
}