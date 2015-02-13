<?php namespace Twitter\Commands;

use Illuminate\Contracts\Queue\ShouldBeQueued;
use Illuminate\Database\Eloquent\Model;
use Twitter\Commands\Command;

class AddPostToFavorites extends Command implements ShouldBeQueued {

    public $user, $post;

    public function __construct(User $user, Post $post)
    {
        $this->user = $user;
        $this->post = $post;
    }

}
