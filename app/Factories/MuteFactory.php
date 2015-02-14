<?php
/**
 * Created by PhpStorm.
 * User: will
 * Date: 2/14/15
 * Time: 1:41 PM
 */

namespace Twitter\Factories;


use Twitter\Mute;

class MuteFactory {

    protected $mute;

    public function __construct(Mute $mute)
    {
        $this->mute = $mute;
    }

    public function create($userId, $muteId)
    {
        $this->mute->create([
            'user_id' => $userId,
            'muted_id' => $muteId
        ]);
    }
}