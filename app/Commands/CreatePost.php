<?php namespace Twitter\Commands;

use Illuminate\Contracts\Queue\ShouldBeQueued;
use Twitter\Commands\Command;
use Twitter\User;

class CreatePost extends Command implements ShouldBeQueued {

	public $user, $post;

	public function __construct(User $user, $post)
	{
		$this->user = $user;
		$this->post = $post;
	}

}
