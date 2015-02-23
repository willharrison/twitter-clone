<?php
/**
 * Created by PhpStorm.
 * User: will
 * Date: 2/23/15
 * Time: 9:17 PM
 */

namespace Twitter\Factories;


use Twitter\MessageAlert;

class MessageAlertFactory {

    protected $factory;

    public function __construct(MessageAlert $factory)
    {
        $this->factory = $factory;
    }

    public function create($to, $message, $messageId)
    {
        $this->factory->create([
            'user_id' => $to,
            'message_id' => $messageId,
            'message' => $message
        ]);
    }
}