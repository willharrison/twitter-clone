<?php
/**
 * Created by PhpStorm.
 * User: will
 * Date: 2/14/15
 * Time: 1:49 PM
 */

namespace Twitter\Repositories;


use Twitter\Mute;

class MuteRepository {

    protected $mute;

    public function __construct(Mute $mute)
    {
        $this->mute = $mute;
    }

    public function find($id)
    {
        return $this->mute->find($id)->first();
    }

    public function remove($userId, $muteId)
    {
        return $this->mute->where(['user_id' => $userId, 'muted_id' => $muteId])->delete();
    }
}