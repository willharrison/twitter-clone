<?php namespace Twitter\Commands;

use Illuminate\Contracts\Queue\ShouldBeQueued;
use Twitter\Commands\Command;
use Twitter\User;

class CreateRePost extends Command implements ShouldBeQueued {

	public $user, $postId;

	public function __construct(User $user, $postId)
	{
		$this->user = $user;
		$this->postId = $postId;
	}

}
