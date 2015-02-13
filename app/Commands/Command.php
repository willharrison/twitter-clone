<?php namespace Twitter\Commands;

use Twitter\Post;
use Twitter\User;

abstract class Command {

    public $user, $post;

    public function __construct(User $user, Post $post)
    {
        $this->user = $user;
        $this->post = $post;
    }

}
