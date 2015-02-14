<?php
/**
 * Created by PhpStorm.
 * User: will
 * Date: 2/8/15
 * Time: 4:04 PM
 */

namespace Twitter\Factories;


use Twitter\Alert;

class AlertFactory {

    protected $alert;

    public function __construct(Alert $alert)
    {
        $this->alert = $alert;
    }

    public function create($userId, $message)
    {
        $this->alert->create([
            "user_id" => $userId,
            "message" => $message
        ]);
    }
}