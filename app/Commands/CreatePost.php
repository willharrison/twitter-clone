<?php namespace Twitter\Commands;

use Illuminate\Contracts\Queue\ShouldBeQueued;
use Twitter\Commands\Command;
use Twitter\User;

class CreatePost extends Command implements ShouldBeQueued {

    public $postString;

    public function __construct(User $user, $postString)
    {
        $this->user = $user;
        $this->postString = $postString;
    }
}
