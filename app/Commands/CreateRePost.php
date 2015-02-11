<?php namespace Twitter\Commands;

use Illuminate\Contracts\Queue\ShouldBeQueued;
use Twitter\Commands\Command;

class CreateRePost extends Command implements ShouldBeQueued {

	public $userId, $postId;

	public function __construct($userId, $postId)
	{
		$this->userId = $userId;
		$this->postId = $postId;
	}

}
