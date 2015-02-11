<?php namespace Twitter\Commands;

use Illuminate\Contracts\Queue\ShouldBeQueued;
use Illuminate\Database\Eloquent\Model;
use Twitter\Commands\Command;

class AddPostToFavorites extends Command implements ShouldBeQueued {

	public $user, $postId;

	public function __construct(Model $user, $postId)
	{
		$this->user = $user;
		$this->postId = $postId;
	}

}
